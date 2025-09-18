<?php

declare(strict_types=1);

namespace WireElements\Pro\Icons;

class PlusSmall extends Icon
{
    public function svg(): string
    {
        return <<<'blade'
			<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6"/></svg>
			blade;
    }
}
