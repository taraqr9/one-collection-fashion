<?php

namespace App\Filter;

use Illuminate\Http\Request;

class ProductFilter
{
    public static function applyFilters($query, Request $request)
    {
        if ($request->filled('_id')) {
            $query->where('department_id', $request->input('department_id'));
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->input('user_id'));
        }

        if ($request->filled('start_date')) {
            $query->where('response_datetime', '>=', $request->input('start_date').' 00:00:00');
        }

        if ($request->filled('end_date')) {
            $query->where('response_datetime', '<=', $request->input('end_date').' 23:59:59');
        }

        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function ($q) use ($keyword) {
                $q->orWhere('id', 'like', '%'.$keyword.'%');
            });
        }

        return $query;
    }
    //    public static function applyFilters($query, Request $request)
    //    {
    //        if ($request->filled('department_id')) {
    //            $query->where('department_id', $request->input('department_id'));
    //        }
    //
    //        if ($request->filled('user_id')) {
    //            $query->where('user_id', $request->input('user_id'));
    //        }
    //
    //        if ($request->filled('service_impact')) {
    //            $query->where('service_impact', $request->input('service_impact'));
    //        }
    //
    //        if ($request->filled('ticket_status') && $request->input('ticket_status') != "All") {
    //            $query->where('ticket_status', $request->input('ticket_status'));
    //        }
    //        elseif (!$request->has('ticket_status') && !$request->filled('department_id')) {
    //            $request->merge(['ticket_status' => IncidentTicketStatusConstant::OPEN]);
    //            $query->where('ticket_status', IncidentTicketStatusConstant::OPEN);
    //        }
    //
    //        if ($request->filled('start_date')) {
    //            $query->where('response_datetime', '>=', $request->input('start_date') . ' 00:00:00');
    //        }
    //
    //        if ($request->filled('end_date')) {
    //            $query->where('response_datetime', '<=', $request->input('end_date') . ' 23:59:59');
    //        }
    //
    //        if ($request->filled('keyword')) {
    //            $keyword = $request->input('keyword');
    //            $query->where(function ($q) use ($keyword) {
    //                $q->orWhere('id', 'like', '%'.$keyword.'%');
    //            });
    //        }
    //
    //        return $query;
    //    }
}
