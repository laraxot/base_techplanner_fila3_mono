<?php

declare(strict_types=1);

namespace Modules\Notify\Filament\Resources\NotificationTemplateResource\Pages;

use Modules\Notify\Filament\Resources\NotificationTemplateResource;
use Modules\Xot\Filament\Resources\Pages\XotBasePage;

class PreviewNotificationTemplate extends XotBasePage
{
    protected static string $resource = NotificationTemplateResource::class;

    protected static string $view = 'notify::filament.resources.notification-template-resource.pages.preview-notification-template';
}
