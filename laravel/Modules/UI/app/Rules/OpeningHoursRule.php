<?php

declare(strict_types=1);
// app/Rules/OpeningHoursRule.php
namespace Modules\UI\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Carbon\Carbon;
use Illuminate\Translation\PotentiallyTranslatedString;

class OpeningHoursRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $days = collect([
            Carbon::MONDAY,
            Carbon::TUESDAY,
            Carbon::WEDNESDAY,
            Carbon::THURSDAY,
            Carbon::FRIDAY,
            Carbon::SATURDAY,
        ])->mapWithKeys(function ($day) {
            /** @phpstan-ignore method.nonObject */
            $dayKey = strtolower(Carbon::create()->startOfWeek()->addDays($day - 1)->format('l'));
            /** @phpstan-ignore method.nonObject */
            $dayLabel = ucfirst(Carbon::create()->startOfWeek()->addDays($day - 1)->isoFormat('dddd'));

            return [$dayKey => $dayLabel];
        })->toArray();
        /*
        foreach ($days as $dayKey => $dayLabel) {
            $hours = $value[$dayKey];
                
            foreach ($hours as $hourKey => $hour) {
                if(is_string($hour) && $hour===''){
                    
                    $fail("L'orario di {$hourKey} deve essere impostato per il {$dayLabel}.");
                }
            }
        }
        */
        
    }
}