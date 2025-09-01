<?php

declare(strict_types=1);

<<<<<<< HEAD
namespace Modules\Xot\Tests\Unit;

use Illuminate\Database\Eloquent\Model;
use Modules\Xot\Actions\Mail\SendMailByRecordAction;

it('throws if record has no email', function (): void {
    $record = new class extends Model
    {
        // no email attribute
        public function option(string $key): ?string
        {
            return null;
        }

        public function myLogs()
        {
            return new class
            {
                public function create(array $data): void {}
            };
        }
=======
use Modules\Xot\Actions\Mail\SendMailByRecordAction;
use Illuminate\Database\Eloquent\Model;

it('throws if record has no email', function (): void {
    $record = new class extends Model {
        // no email attribute
        public function option(string $key): ?string { return null; }
        public function myLogs() { return new class {
            public function create(array $data): void {}
        };}
>>>>>>> e697a77b (.)
    };

    expect(fn () => app(SendMailByRecordAction::class)->execute($record, \Illuminate\Mail\Mailable::class))
        ->toThrow(InvalidArgumentException::class);
});
