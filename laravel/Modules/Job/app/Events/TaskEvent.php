<?php

declare(strict_types=1);

namespace Modules\Job\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\Job\Models\Task;

class TaskEvent extends Event
{
    use Dispatchable;
    use SerializesModels;

    /**
     * Constructor.
     */
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    public function __construct(): void {}
=======
    public function __construct(public Task $task) {}
>>>>>>> de0f89b5 (.)
=======
    public function __construct(public Task $task) {}
>>>>>>> 2e199498 (.)
=======
    public function __construct(public Task $task) {}
>>>>>>> eaeb6531 (.)
}
