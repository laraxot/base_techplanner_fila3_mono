<?php

declare(strict_types=1);

namespace WireElements\Pro\Components\Insert\Types;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Str;
use WireElements\Pro\Components\Insert\InsertQueryResults;

abstract class InsertType implements Arrayable
{
    protected string $delimiter = '@';

    protected string $match = '\w{1,20}$';

    public function getExpression(): string
    {
        return "^{$this->delimiter}{$this->match}";
    }

    public function initSearch($query, $scope = []): InsertQueryResults
    {
        return $this->search(
            $this->removeDelimiterFromString($query),
            $scope,
        );
    }

    private function removeDelimiterFromString($query): string
    {
        return Str::of($query)->remove($this->delimiter)->__toString();
    }

    public function toArray(): array
    {
        return [
            'expression' => $this->getExpression(),
        ];
    }
}
