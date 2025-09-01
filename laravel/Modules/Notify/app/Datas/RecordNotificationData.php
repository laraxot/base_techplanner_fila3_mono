<?php

declare(strict_types=1);

namespace Modules\Notify\Datas;

use Modules\Notify\Actions\SMS\NormalizePhoneNumberAction;
use Modules\Xot\Contracts\UserContract;
use Spatie\LaravelData\Data;
use Webmozart\Assert\Assert;

class RecordNotificationData extends Data
{
    public UserContract $record;

    public string $channel;

    public function getChannel(): string
    {
        return $this->channel;
    }

    public function getRoute(): string
    {
        switch ($this->channel) {
            case 'mail':
                Assert::string($email = $this->record->email);

                return $email;
            case 'sms':
                Assert::string($phone = $this->record->phone);
                $phone = app(NormalizePhoneNumberAction::class)->execute($phone);

                return $phone;
        }
        throw new \Exception('Channel ['.$this->channel.'] not supported');
    }
}
