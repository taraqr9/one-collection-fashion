<?php

if (! function_exists('checkAuthorization')) {
    function checkAuthorization($access, $roles): bool
    {
        $roles = json_decode($roles == '' ? '[]' : $roles, false);
        if (in_array($access, $roles)) {
            return true;
        } else {
            return false;
        }
    }
}

if (! function_exists('getDateDBFormatFromDateRange')) {
    function getDateDBFormatFromDateRange($date_range): array
    {
        $date_range = explode(' - ', $date_range);
        $dates['from_date'] = date_format(date_create_from_format('d/m/Y', $date_range[0]), 'Y-m-d');
        $dates['to_date'] = date_format(date_create_from_format('d/m/Y', $date_range[1]), 'Y-m-d');

        return $dates;
    }
}

if (! function_exists('getDateDifferenceInDays')) {
    function getDateDifferenceInDays($from_date, $to_date): int
    {
        return (int) floor((strtotime($to_date) - strtotime($from_date)) / (60 * 60 * 24));
    }
}

if (! function_exists('isAllowedDateDiffServiceWise')) {
    function isAllowedDateDiffServiceWise($date_diff): bool|string
    {
        if ($date_diff >= 0 && $date_diff <= config('app.allowed_number_of_days_reporting')) {
            return true;
        }

        return false;
    }
}

if (!function_exists('storage_url')) {
    function storage_url($path) {
        return asset('storage/' . ltrim($path, '/'));
    }
}
