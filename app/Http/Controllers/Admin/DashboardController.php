<?php

namespace App\Http\Controllers\Admin;

use App\Constants\CareerJobStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DashboardRequest;
use App\Models\CardCounter;
use App\Models\CardHelpRequest;
use App\Models\CareerJob;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(DashboardRequest $request): View
    {
        view()->share('page', config('app.nav')['dashboard']);

        $date_range = getDateDBFormatFromDateRange(date('d/m/Y') . ' - ' . date('d/m/Y'));

        if (isset($request->date_range)) {
            $date_range = getDateDBFormatFromDateRange($request->date_range);
        }

        $from = $date_range['from_date'];
        $to = $date_range['to_date'];

        $total_active_jobs = CareerJob::query()
            ->where('status', CareerJobStatus::getKeyByValue(CareerJobStatus::ACTIVE))
            ->where('created_at', '>=', $from)
            ->where('created_at', '<=', $to . ' 23:59:59')
            ->get();

        $total_card_help_requests = CardHelpRequest::query()
            ->select('created_at')
            ->where('created_at', '>=', $from)
            ->where('created_at', '<=', $to . ' 23:59:59')
            ->get();

        $total_card_counters = CardCounter::query()
            ->select('created_at')
            ->where('created_at', '>=', $from)
            ->where('created_at', '<=', $to . ' 23:59:59')
            ->get();

        $dashboard_summaries['total_active_jobs'] = $total_active_jobs->count();
        $dashboard_summaries['total_card_help_requests'] = $total_card_help_requests->count();
        $dashboard_summaries['total_card_counters'] = $total_card_counters->count();

        return view('admin.dashboard', compact( 'date_range', 'dashboard_summaries'));
    }

}
