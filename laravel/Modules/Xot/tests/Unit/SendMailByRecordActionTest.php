<?php

declare(strict_types=1);

namespace Modules\Xot\Tests\Unit\SendMailByRecordActionTest;


    };

    expect(fn () => app(SendMailByRecordAction::class)->execute($record, \Illuminate\Mail\Mailable::class))
        ->toThrow(InvalidArgumentException::class);
});
