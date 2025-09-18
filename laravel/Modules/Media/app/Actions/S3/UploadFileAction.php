<?php

declare(strict_types=1);

namespace Modules\Media\Actions\S3;

use Aws\Exception\MultipartUploadException;
use Aws\S3\Exception\S3Exception;
use Aws\S3\MultipartUploader;
use Aws\S3\ObjectUploader;

use function Safe\fclose;
use function Safe\filesize;
use function Safe\fopen;
use function Safe\mime_content_type;
use function Safe\rewind;

class UploadFileAction extends BaseS3Action
{
    /**
     * Upload a file to S3
     *
     * @param array<string, mixed> $options
     * @return array<string, mixed>
     */
    public function execute(string $localFilePath, string $destinationFilePath, array $options = []): array
    {
        // Validation
        if (!file_exists($localFilePath)) {
            $error = "Local file does not exist: {$localFilePath}";
            $this->logger->error($error);
            return ['success' => false, 'error' => $error];
        }

        if (!is_readable($localFilePath)) {
            $error = "Local file is not readable: {$localFilePath}";
            $this->logger->error($error);
            return ['success' => false, 'error' => $error];
        }

        $sourceFile = null;

        try {
            $sourceFile = fopen($localFilePath, 'rb');

            // Default options with proper typing
            $defaultOptions = [
                'ACL' => 'private',
                'ContentType' => mime_content_type($localFilePath) ?: 'application/octet-stream',
            ];

            $uploadOptions = array_merge($defaultOptions, $options);

            // Ensure ACL is string for type safety
            $acl = is_string($uploadOptions['ACL']) ? $uploadOptions['ACL'] : 'private';

            // Use ObjectUploader with proper type casting
            $uploader = new ObjectUploader(
                $this->s3Client,
                $this->bucketName,
                $destinationFilePath,
                $sourceFile,
                (string) ($uploadOptions['ACL'] ?? 'private'),
                $uploadOptions,
            );

            $this->logger->info('Uploading file to S3', [
                'localPath' => $localFilePath,
                's3Key' => $destinationFilePath,
                'fileSize' => filesize($localFilePath),
            ]);

            $result = $uploader->upload();

            // Close the file after successful upload
            fclose($sourceFile);

            $this->logger->info('File uploaded successfully to S3', [
                'localPath' => $localFilePath,
                's3Key' => $destinationFilePath,
                'objectUrl' => $result['ObjectURL'] ?? null,
            ]);

            return [
                'success' => true,
                'objectUrl' => $result['ObjectURL'] ?? null,
                'etag' => $result['ETag'] ?? null,
                'key' => $destinationFilePath,
                'bucket' => $this->bucketName,
            ];
        } catch (\Exception $exception) {
            // Initialize $sourceFile as null if not already defined
            $sourceFile ??= null;

            if (isset($sourceFile) && is_resource($sourceFile)) {
                fclose($sourceFile);
            }

            $this->logger->error('Error uploading file to S3', [
                'localPath' => $localFilePath,
                's3Key' => $destinationFilePath,
                'error' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString(),
            ]);

            return [
                'success' => false,
                'error' => $exception->getMessage(),
                'errorTrace' => $exception->getTraceAsString(),
            ];
        }
    }
}
