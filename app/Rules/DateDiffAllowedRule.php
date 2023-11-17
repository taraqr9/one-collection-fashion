<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class DateDiffAllowedRule implements ValidationRule
{

    public function __construct()
    {
    }

    /**
     * Run the validation rule.
     *
     * @param \Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $dateRange = getDateDBFormatFromDateRange($value);

        $dateDiff = getDateDifferenceInDays($dateRange['from_date'], $dateRange['to_date']);
        if (!isAllowedDateDiffServiceWise($dateDiff + 1)) {
            $fail('Maximum allowed ' . config('app.allowed_number_of_days_reporting') . '  days exceed.');
        }
    }
}
