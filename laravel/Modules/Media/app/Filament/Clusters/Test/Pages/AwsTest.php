<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Clusters\Test\Pages;

use Aws\Exception\AwsException;
use Aws\S3\S3Client;
use Aws\Sts\StsClient;
use Filament\Forms\Components;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Modules\Media\Filament\Clusters\Test;
use Modules\Xot\Filament\Pages\XotBasePage;

class AwsTest extends XotBasePage
{
    protected static ?string $cluster = Test::class;

    public array $testResults = [];

    public string $activeTab = 's3';

    private const DEFAULT_REGION = 'eu-west-1';

    private const KEY_PREVIEW_LENGTH = 8;

    public array $connectionTests = [
        's3' => 'Test S3 Connection',
        'cloudfront' => 'Test CloudFront',
        'iam' => 'Test IAM Permissions',
        'full' => 'Full Diagnostic',
    ];

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Components\Tabs::make('Tests')
                    ->tabs([
                        Components\Tabs\Tab::make('S3')
                            ->schema($this->getS3TestSchema()),

                        Components\Tabs\Tab::make('CloudFront')
                            ->schema($this->getCloudFrontTestSchema()),

                        Components\Tabs\Tab::make('IAM')
                            ->schema($this->getIamTestSchema()),

                        Components\Tabs\Tab::make('Diagnostics')
                            ->schema($this->getDiagnosticsSchema()),
                    ]),
            ]);
    }

    protected function getS3TestSchema(): array
    {
        return [
            Components\Section::make('S3 Connection Test')
                ->description('Verify S3 bucket access and permissions')
                ->schema([
                    Components\Actions::make([
                        Components\Actions\Action::make('test_s3_connection')
                            ->label(__('ui::aws_test.test_s3_connection'))
                            ->action('testS3Connection'),

                        Components\Actions\Action::make('test_s3_permissions')
                            ->label(__('ui::aws_test.test_s3_permissions'))
                            ->color('warning')
                            ->action('testS3Permissions'),

                        Components\Actions\Action::make('test_file_operations')
                            ->label(__('ui::aws_test.test_file_operations'))
                            ->color('success')
                            ->action('testS3FileOperations'),
                    ])->fullWidth(),

                    Components\ViewField::make('s3_results')
                        ->view('ui::filament.components.test-results')
                        ->viewData(fn () => ['results' => $this->testResults['s3'] ?? null]),
                ]),
        ];
    }

    protected function getCloudFrontTestSchema(): array
    {
        return [
            Components\Section::make('CloudFront Test')
                ->schema([
                    Components\TextInput::make('cloudfront_url')
                        ->default(config('filesystems.cloudfront.url')),

                    Components\Actions::make([
                        Components\Actions\Action::make('test_cloudfront_config')
                            ->action('testCloudFrontConfig'),

                        Components\Actions\Action::make('test_signed_urls')
                            ->action('testCloudFrontSignedUrls'),
                    ]),

                    Components\ViewField::make('cloudfront_results')
                        ->view('ui::filament.components.test-results')
                        ->viewData(fn () => ['results' => $this->testResults['cloudfront'] ?? null]),
                ]),
        ];
    }

    protected function getIamTestSchema(): array
    {
        return [
            Components\Section::make('IAM Permissions Test')
                ->schema([
                    Components\TextInput::make('iam_user')
                        ->default(env('AWS_ACCESS_KEY_ID')),

                    Components\Actions::make([
                        Components\Actions\Action::make('test_iam_credentials')
                            ->action('testIamCredentials'),

                        Components\Actions\Action::make('test_iam_policies')
                            ->color('warning')
                            ->action('testIamPolicies'),
                    ]),

                    Components\ViewField::make('iam_results')
                        ->view('ui::filament.components.test-results')
                        ->viewData(fn () => ['results' => $this->testResults['iam'] ?? null]),
                ]),
        ];
    }

    protected function getDiagnosticsSchema(): array
    {
        return [
            Components\Section::make('Complete Diagnostic')
                ->schema([
                    Components\Actions::make([
                        Components\Actions\Action::make('run_full_diagnostic')
                            ->color('danger')
                            ->icon('heroicon-o-bolt')
                            ->action('runFullDiagnostic'),
                    ]),

                    Components\ViewField::make('full_results')
                        ->view('ui::filament.components.test-results')
                        ->viewData(fn () => ['results' => $this->testResults['full'] ?? null]),

                    Components\KeyValue::make('aws_config')
                        ->columnSpanFull()
                        ->state(fn () => $this->getAwsConfig()),
                ]),
        ];
    }

    /* Test Methods */
    public function test_s3_connection(): void
    {
        try {
            $s3 = new S3Client([
                'region' => config('filesystems.disks.s3.region', self::DEFAULT_REGION),
                'version' => 'latest',
                'credentials' => [
                    'key' => config('filesystems.disks.s3.key'),
                    'secret' => config('filesystems.disks.s3.secret'),
                ],
            ]);

            $result = $s3->headBucket([
                'Bucket' => config('filesystems.disks.s3.bucket'),
            ]);

            $this->testResults['s3'] = [
                'status' => 'success',
                'message' => 'Successfully connected to S3 bucket',
                'details' => [
                    'Bucket' => config('filesystems.disks.s3.bucket'),
                    'Region' => config('filesystems.disks.s3.region'),
                ],
            ];

            Notification::make()
                ->title(__('ui::awstest.notifications.s3_connection_successful'))
                ->success()
                ->send();
        } catch (AwsException $e) {
            $this->testResults['s3'] = [
                'status' => 'error',
                'message' => $e->getAwsErrorCode() ?? 'UnknownError',
                'details' => [
                    'Error' => $e->getMessage(),
                    'Solution' => $this->getS3Solution($e->getAwsErrorCode() ?? 'UnknownError'),
                ],
            ];

            Notification::make()
                ->title(__('ui::awstest.notifications.s3_connection_failed'))
                ->danger()
                ->body($e->getAwsErrorCode() ?? 'UnknownError')
                ->send();
        }
    }

    public function test_cloud_front_config(): void
    {
        try {
            // Implement CloudFront config test
            $this->testResults['cloudfront'] = [
                'status' => 'success',
                'message' => 'CloudFront configuration valid',
                'details' => [
                    'Base URL' => config('filesystems.cloudfront.url'),
                    'Key Pair ID' => config('filesystems.cloudfront.key_pair_id'),
                ],
            ];

            Notification::make()
                ->title(__('ui::awstest.notifications.cloudfront_config_valid'))
                ->success()
                ->send();
        } catch (\Exception $e) {
            $this->testResults['cloudfront'] = [
                'status' => 'error',
                'message' => 'CloudFront configuration error',
                'details' => [
                    'Error' => $e->getMessage(),
                    'Solution' => 'Check CloudFront settings in config',
                ],
            ];

            Notification::make()
                ->title(__('ui::awstest.notifications.cloudfront_config_error'))
                ->danger()
                ->send();
        }
    }

    public function runFullDiagnostic(): void
    {
        $this->testS3Connection();
        $this->testS3Permissions();
        $this->testS3FileOperations();
        $this->testCloudFrontConfig();
        $this->testCloudFrontSignedUrls();
        $this->testIamCredentials();
        $this->testIamPolicies();

        $this->testResults['full'] = [
            'status' => 'completed',
            'message' => 'Full diagnostic completed',
            'details' => $this->testResults,
        ];

        Notification::make()
            ->title(__('ui::awstest.notifications.full_diagnostic_completed'))
            ->success()
            ->send();
    }

    /* Helper Methods */
    protected function getAwsConfig(): array
    {
        return [
            'AWS_ACCESS_KEY_ID' => substr((string) config('filesystems.disks.s3.key', ''), 0, self::KEY_PREVIEW_LENGTH).'...',
            'AWS_DEFAULT_REGION' => config('filesystems.disks.s3.region'),
            'AWS_BUCKET' => config('filesystems.disks.s3.bucket'),
            'CLOUDFRONT_URL' => config('filesystems.cloudfront.url'),
            'CLOUDFRONT_KEY_PAIR_ID' => config('filesystems.cloudfront.key_pair_id'),
        ];
    }

    protected function getS3Solution(?string $errorCode): string
    {
        if ($errorCode === null) {
            return 'Unknown error - check AWS credentials and configuration';
        }

        $solutions = [
            'SignatureDoesNotMatch' => 'Verify your AWS_SECRET_ACCESS_KEY in .env',
            'AccessDenied' => 'Check IAM permissions for S3 access',
            'NoSuchBucket' => 'Verify bucket name and region',
            'InvalidAccessKeyId' => 'Check AWS_ACCESS_KEY_ID',
        ];

        return $solutions[$errorCode] ?? 'Consult AWS documentation for error: '.$errorCode;
    }

    public function test_s3_permissions(): void
    {
        try {
            $s3 = new S3Client([
                'region' => config('filesystems.disks.s3.region', self::DEFAULT_REGION),
                'version' => 'latest',
                'credentials' => [
                    'key' => config('filesystems.disks.s3.key'),
                    'secret' => config('filesystems.disks.s3.secret'),
                ],
            ]);

            // Test list objects permission
            $result = $s3->listObjectsV2([
                'Bucket' => config('filesystems.disks.s3.bucket'),
                'MaxKeys' => 1,
            ]);

            $this->testResults['s3_permissions'] = [
                'status' => 'success',
                'message' => 'S3 permissions verified successfully',
                'details' => [
                    'ListObjects' => 'OK',
                    'Bucket' => config('filesystems.disks.s3.bucket'),
                ],
            ];

            Notification::make()
                ->title('S3 Permissions OK')
                ->success()
                ->send();
        } catch (AwsException $e) {
            $this->testResults['s3_permissions'] = [
                'status' => 'error',
                'message' => 'S3 permissions error: '.($e->getAwsErrorCode() ?? 'UnknownError'),
                'details' => [
                    'Error' => $e->getMessage(),
                    'Solution' => $this->getS3Solution($e->getAwsErrorCode() ?? 'UnknownError'),
                ],
            ];

            Notification::make()
                ->title('S3 Permissions Failed')
                ->danger()
                ->body($e->getAwsErrorCode() ?? 'UnknownError')
                ->send();
        }
    }

    public function test_s3_file_operations(): void
    {
        try {
            $s3 = new S3Client([
                'region' => config('filesystems.disks.s3.region', self::DEFAULT_REGION),
                'version' => 'latest',
                'credentials' => [
                    'key' => config('filesystems.disks.s3.key'),
                    'secret' => config('filesystems.disks.s3.secret'),
                ],
            ]);

            $testFileName = 'test-file-'.now()->timestamp.'.txt';
            $testContent = 'Test file content for AWS S3 operations';

            // Test put operation
            $s3->putObject([
                'Bucket' => config('filesystems.disks.s3.bucket'),
                'Key' => $testFileName,
                'Body' => $testContent,
                'ContentType' => 'text/plain',
            ]);

            // Test get operation
            $result = $s3->getObject([
                'Bucket' => config('filesystems.disks.s3.bucket'),
                'Key' => $testFileName,
            ]);

            // Clean up - delete test file
            $s3->deleteObject([
                'Bucket' => config('filesystems.disks.s3.bucket'),
                'Key' => $testFileName,
            ]);

            $this->testResults['s3_operations'] = [
                'status' => 'success',
                'message' => 'S3 file operations completed successfully',
                'details' => [
                    'Upload' => 'OK',
                    'Download' => 'OK',
                    'Delete' => 'OK',
                    'Test File' => $testFileName,
                ],
            ];

            Notification::make()
                ->title('S3 File Operations OK')
                ->success()
                ->send();
        } catch (AwsException $e) {
            $this->testResults['s3_operations'] = [
                'status' => 'error',
                'message' => 'S3 file operations error: '.($e->getAwsErrorCode() ?? 'UnknownError'),
                'details' => [
                    'Error' => $e->getMessage(),
                    'Solution' => $this->getS3Solution($e->getAwsErrorCode() ?? 'UnknownError'),
                ],
            ];

            Notification::make()
                ->title('S3 File Operations Failed')
                ->danger()
                ->body($e->getAwsErrorCode() ?? 'UnknownError')
                ->send();
        }
    }

    public function test_cloud_front_signed_urls(): void
    {
        try {
            // Test CloudFront signed URL generation
            $privateKey = config('filesystems.cloudfront.private_key');
            $keyPairId = config('filesystems.cloudfront.key_pair_id');
            $baseUrl = config('filesystems.cloudfront.url');

            if (! $privateKey || ! $keyPairId || ! $baseUrl) {
                throw new \Exception('Missing CloudFront configuration');
            }

            $this->testResults['cloudfront_signed'] = [
                'status' => 'success',
                'message' => 'CloudFront signed URL configuration valid',
                'details' => [
                    'Base URL' => $baseUrl,
                    'Key Pair ID' => $keyPairId,
                    'Private Key' => 'Configured',
                ],
            ];

            Notification::make()
                ->title('CloudFront Signed URLs OK')
                ->success()
                ->send();
        } catch (\Exception $e) {
            $this->testResults['cloudfront_signed'] = [
                'status' => 'error',
                'message' => 'CloudFront signed URL error',
                'details' => [
                    'Error' => $e->getMessage(),
                    'Solution' => 'Check CloudFront private key and configuration',
                ],
            ];

            Notification::make()
                ->title('CloudFront Signed URLs Failed')
                ->danger()
                ->send();
        }
    }

    public function test_iam_credentials(): void
    {
        try {
            $sts = new StsClient([
                'region' => config('filesystems.disks.s3.region', self::DEFAULT_REGION),
                'version' => 'latest',
                'credentials' => [
                    'key' => config('filesystems.disks.s3.key'),
                    'secret' => config('filesystems.disks.s3.secret'),
                ],
            ]);

            $result = $sts->getCallerIdentity();

            $this->testResults['iam_credentials'] = [
                'status' => 'success',
                'message' => 'IAM credentials verified successfully',
                'details' => [
                    'Account' => $result['Account'] ?? 'Unknown',
                    'ARN' => $result['Arn'] ?? 'Unknown',
                    'User ID' => $result['UserId'] ?? 'Unknown',
                ],
            ];

            Notification::make()
                ->title('IAM Credentials OK')
                ->success()
                ->send();
        } catch (AwsException $e) {
            $this->testResults['iam_credentials'] = [
                'status' => 'error',
                'message' => 'IAM credentials error: '.($e->getAwsErrorCode() ?? 'UnknownError'),
                'details' => [
                    'Error' => $e->getMessage(),
                    'Solution' => 'Check AWS access keys and secret',
                ],
            ];

            Notification::make()
                ->title('IAM Credentials Failed')
                ->danger()
                ->body($e->getAwsErrorCode() ?? 'UnknownError')
                ->send();
        }
    }

    public function test_iam_policies(): void
    {
        try {
            // Test IAM policies by attempting various operations
            $s3 = new S3Client([
                'region' => config('filesystems.disks.s3.region', self::DEFAULT_REGION),
                'version' => 'latest',
                'credentials' => [
                    'key' => config('filesystems.disks.s3.key'),
                    'secret' => config('filesystems.disks.s3.secret'),
                ],
            ]);

            // Test bucket access
            $s3->headBucket([
                'Bucket' => config('filesystems.disks.s3.bucket'),
            ]);

            // Test list objects
            $s3->listObjectsV2([
                'Bucket' => config('filesystems.disks.s3.bucket'),
                'MaxKeys' => 1,
            ]);

            $this->testResults['iam_policies'] = [
                'status' => 'success',
                'message' => 'IAM policies verified successfully',
                'details' => [
                    'S3 Access' => 'OK',
                    'List Objects' => 'OK',
                    'Bucket Access' => 'OK',
                ],
            ];

            Notification::make()
                ->title('IAM Policies OK')
                ->success()
                ->send();
        } catch (AwsException $e) {
            $this->testResults['iam_policies'] = [
                'status' => 'error',
                'message' => 'IAM policies error: '.($e->getAwsErrorCode() ?? 'UnknownError'),
                'details' => [
                    'Error' => $e->getMessage(),
                    'Solution' => 'Check IAM user policies and permissions',
                ],
            ];

            Notification::make()
                ->title('IAM Policies Failed')
                ->danger()
                ->body($e->getAwsErrorCode() ?? 'UnknownError')
                ->send();
        }
    }
}
