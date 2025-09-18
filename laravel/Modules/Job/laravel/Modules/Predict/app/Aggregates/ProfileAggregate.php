<?php

declare(strict_types=1);
/**
 * @see https://github.com/cnastasi/event-sourcing-with-laravel/blob/main/app/Aggregates/ProductAggregate.php
 */

namespace Modules\Predict\Aggregates;

use Modules\Predict\Datas\AddedCreditsData;
use Modules\Predict\Datas\RemovedCreditsData;
use Modules\Predict\Events\Profile\CreditsAdded;
use Modules\Predict\Events\Profile\CreditsRemoved;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

class ProfileAggregate extends AggregateRoot
{
    public function creditAdded(AddedCreditsData $command): self
    {
        $event = new CreditsAdded(
            profileId: $command->profileId,
            userId: $command->userId,
            credit: $command->credit
        );
        $this->recordThat($event);

        $this->persist();

        return $this;
    }

    public function creditRemoved(RemovedCreditsData $command): self
    {
        $event = new CreditsRemoved(
            profileId: $command->profileId,
            userId: $command->userId,
            credit: $command->credit
        );
        $this->recordThat($event);

        $this->persist();

        return $this;
    }
}
