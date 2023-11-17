<?php

namespace App\Services;

use App\Constants\CacheKey;
use App\Constants\CareerJobStatus;
use App\Models\CardDivision;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CacheService
{
    public function getCareerBanners()
    {
        return Cache::rememberForever(CacheKey::CAREER_BANNER_CACHE_KEY, function () {
            $data = DB::table('settings')
                      ->where('key', 'card_banners')
                      ->first();
            return $data != null ? json_decode($data->value, true) : [];
        });
    }
    public function getActiveCareerJobs()
    {
        return Cache::rememberForever(CacheKey::CAREER_JOBS_CACHE_KEY, function () {
            return DB::table('career_jobs')
                ->select('id', 'title', 'department', 'salary_range', 'employment_status', 'deadline', 'location', 'no_of_vacancy', 'status', 'created_at' )
                ->where('status', CareerJobStatus::ACTIVE)->get();
        });
    }

    public function getCardDivisionWiseCounter()
    {
        return Cache::rememberForever(CacheKey::CARD_DIVISION_WISE_COUNTER_CACHE_KEY, function () {
            return CardDivision::query()
                               ->select('id', 'name', 'name_in_bangla')
                               ->with([
                                   'areas' => function ($query) {
                                       $query->select('id', 'name', 'name_in_bangla', 'card_division_id', 'status');
                                       $query->where('status', 1);
                                   },
                                   'areas.counters' => function ($query) {
                                       $query->select('id', 'name', 'name_in_bangla', 'card_area_id', 'status');
                                       $query->where('status', 1);
                                   },
                               ])
                               ->where('status', 1)
                               ->orderBy('id', 'asc')
                               ->get();
        });
    }

    public function forgetCareerBanner(): bool
    {
        return Cache::forget(CacheKey::CAREER_BANNER_CACHE_KEY);
    }

    public function forgetCardDivisionWiseCounter(): bool
    {
        return Cache::forget(CacheKey::CARD_DIVISION_WISE_COUNTER_CACHE_KEY);
    }
    public function forgetActiveCareerJobs(): bool
    {
        return Cache::forget(CacheKey::CAREER_JOBS_CACHE_KEY);
    }

}
