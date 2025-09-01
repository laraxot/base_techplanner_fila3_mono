<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Tables\Columns;

use Filament\Tables\Columns\IconColumn;
use Modules\Media\Actions\CloudFront\GetCloudFrontSignedUrlAction;

class CloudFrontIconMediaColumn extends IconColumn
{
    protected function setUp(): void
    {
        parent::setUp();
        $attachment = $this->getName();

        $this->default(
            fn ($record) => $record->getFirstMedia($attachment))
            ->icon('heroicon-o-document-text')
            ->color(fn ($record) => $record->getFirstMedia($attachment) ? 'success' : 'danger')
            ->tooltip(fn ($record) => $record->getFirstMedia($attachment)->file_name ?? 'Documento non caricato')
            ->url(function ($record) use ($attachment) {
                $media = $record->getFirstMedia($attachment);
                if (! $media) {
                    return;
                }
                $signedUrl = app(GetCloudFrontSignedUrlAction::class)->execute($media->getPath(), 60);

                return $signedUrl;
            })
            ->openUrlInNewTab();

    }
}
