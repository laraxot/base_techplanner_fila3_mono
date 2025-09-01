<?php

declare(strict_types=1);

namespace Modules\Notify\Datas\SMS;

use Illuminate\Support\Arr;
use Spatie\LaravelData\Data;
use Webmozart\Assert\Assert;
use Illuminate\Support\Facades\Config;
use Modules\Tenant\Services\TenantService;

class PlivoData extends Data
{
    public ?string $auth_id;
    public ?string $auth_token;
    public ?string $base_url;
    public string $auth_type = 'basic';
    public int $timeout = 30;

    private static ?self $instance = null;

    public static function make(): self
    {
        if (! self::$instance instanceof PlivoData) {
            /*
            $data = TenantService::getConfig('sms');
            $data = Arr::get($data, 'drivers.plivo', []);
            */
            $data = Config::array('sms.drivers.plivo');
            self::$instance = self::from($data);
        }

        return self::$instance;
    }

    public function getAuthHeaders(): array
    {
        switch ($this->auth_type) {
            case 'basic':
            default:
                return [
                    'Authorization' => 'Basic ' . base64_encode($this->auth_id . ':' . $this->auth_token),
                    'Content-Type' => 'application/json'
                ];
        }
    }

    public function getBaseUrl(): string
    {
        return $this->base_url ?? 'https://api.plivo.com';
    }

    public function getTimeout(): int
    {
        return $this->timeout;
    }
}
