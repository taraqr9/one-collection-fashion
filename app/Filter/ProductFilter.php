<?php

namespace App\Filter;

use App\Enums\DefaultSortingEnum;
use Illuminate\Http\Request;

class ProductFilter
{
    public static function applyFilters($query, Request $request)
    {
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        if ($request->filled('sub_category_id')) {
            $query->where('sub_category_id', $request->input('sub_category_id'));
        }

        if ($request->filled('sort') && $request->input('sort') != DefaultSortingEnum::DefaultSorting->value) {
            switch ($request->input('sort')) {
                case DefaultSortingEnum::PriceLowHigh->value:
                    $query->orderBy('price', 'asc');
                    break;

                case DefaultSortingEnum::PriceHighLow->value:
                    $query->orderBy('price', 'desc');
                    break;
            }
        }

        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function ($q) use ($keyword) {
                $q->orWhere('name', 'like', '%'.$keyword.'%');
            });
        }

        return $query;
    }
}
