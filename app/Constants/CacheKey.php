<?php

namespace App\Constants;
class CacheKey
{
    const CACHE_TIME = 3600;  //unit -> second
    const CACHE_TIME_15M = 900;  //unit -> second
    const CACHE_TIME_3H = 10800;  //unit -> second

    const CACHE_TIME_6H = 21600; //unit -> second

    const CAREER_BANNER_CACHE_KEY = 'CAREER_BANNER_CACHE_KEY';
    const CARD_DIVISION_WISE_COUNTER_CACHE_KEY = 'CARD_DIVISION_WISE_COUNTER_CACHE_KEY';
    const CAREER_JOBS_CACHE_KEY = 'CAREER_JOBS_CACHE_KEY';
}
