<?php

declare(strict_types=1);

namespace WireElements\Pro\Components\Insert;

use Illuminate\Support\Collection;

class InsertQueryResults
{
    private Collection $results;

    public function __construct(Collection $results)
    {
        $this->results = $results;
    }

    public function getResults(): Collection
    {
        return $this->results;
    }

    public static function make(Collection $results): self
    {
        // self::validate($results);

        return new self($results);
    }

    private static function validate(Collection $results): void
    {
        if ($results->filter(fn ($r) => $r instanceof InsertQueryResult)->isEmpty()) {
            throw new \UnexpectedValueException('InsertQueryResults contains invalid objects');
        }
    }
}
