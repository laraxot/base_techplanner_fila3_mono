<?php

declare(strict_types=1);

namespace Modules\Job\Actions;

use Exception;
use Spatie\QueueableAction\QueueableAction;

class GetTaskFrequenciesAction
{
    use QueueableAction;

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    /**
     * @return array<string, mixed>
     */
    public function execute(): array
    {
        $res = config('totem.frequencies');
        if (\is_array($res)) {
            /** @var array<string, mixed> */
=======
=======
>>>>>>> 2e199498 (.)
=======
>>>>>>> eaeb6531 (.)
    public function execute(): array
    {
        $res = config('totem.frequencies');
        if (is_array($res)) {
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> de0f89b5 (.)
=======
>>>>>>> 2e199498 (.)
=======
>>>>>>> eaeb6531 (.)
            return $res;
        }

        throw new Exception('['.__LINE__.']['.class_basename($this).']');
    }
}
