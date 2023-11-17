@extends('admin.master')

@section('title')
    Help Request
@endsection

@section('external_js')
    <script src="{{ url()->asset('assets/js/pickers/daterangepicker.js') }}"></script>
    <script src="{{ url()->asset('assets/js/pickers/picker_date.js') }}"></script>
@endsection

@section('breadcrumb')
    <span class="breadcrumb-item active">Help Request</span>
@endsection

@section('page_actions')
    @if(in_array(config('access.cards.help_request'), $admin_roles))
        <div class="dropdown ms-lg-3">
            <a href="#" class="d-flex align-items-center text-body dropdown-toggle py-2" data-bs-toggle="dropdown">
                <i class="ph-gear me-2"></i>
                <span class="flex-1">Actions</span>
            </a>

            <div class="dropdown-menu dropdown-menu-end w-100 w-lg-auto">
                <form method="get" action="{{ url('/cards/help_request/csv') }}">
                    <div class="dropdown-item">
                        <button type="submit" class="btn"><i class="ph-file-csv me-2"></i>Export to CSV</button>
                        <input type="text" name="date_range"
                               autocomplete="off"
                               value="{{ request('date_range') ?? date('d/m/Y') . ' - ' . date('d/m/Y') }}"
                               data-format="d/m/Y - d/m/Y"
                               hidden>
                    </div>
                </form>
            </div>
        </div>
    @endif
@endsection

@section('page_content')
    <div class="card">
        <div class="card-body">
            <div class="col-md-12">
                <form class="form-horizontal form-label-left" method="get"
                      action="{{ url('/cards/help_request') }}">
                    <div class="row">

                        <div class="form-group col-md-3">
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">Date Range: </label>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input type="text" class="form-control daterange-basic" name="date_range"
                                       autocomplete="off"
                                       value="{{ request('date_range') ?? date('d/m/Y') . ' - ' . date('d/m/Y') }}"
                                       data-format="d/m/Y - d/m/Y"
                                       readonly>
                            </div>
                        </div>

                        <div class="form-group col-md-2">
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">Phone:</label>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input class="form-control style-input" type="text" name="mobile_number"
                                       value="{{ request('mobile_number') ?? '' }}" placeholder="Phone number">
                            </div>
                        </div>

                        <div class="col-md-1">
                            <label class="fw-bold col-md-12 col-sm-0 col-xs-0">&nbsp;</label>
                            <button type="submit"
                                    class="btn bg-dark text-white">Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
    <div class="col-12">
        <div class="row card">
            <div class="card-body">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped text-center">
                            <thead>
                            <tr class="bg-dark text-white">
                                <th>#</th>
                                <th>Name</th>
                                <th>Mobile Number</th>
                                <th>City</th>
                                <th>Profession</th>
                                <th>Created At</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($card_help_requests as $key => $help_request)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $help_request->name }}</td>
                                    <td>{{ $help_request->mobile_number }}</td>
                                    <td>{{ $help_request->city }}</td>
                                    <td>{{ $help_request->profession ?? 'N/A' }}</td>
                                    <td>{{ date('d-m-Y g:i A', strtotime($help_request->created_at)) }}</td>
                                </tr>

                            @empty
                                <tr>
                                    <td class="text-center" colspan="10">
                                        <h4>No data found!</h4>
                                    </td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-12 mt-3">
                    {{ $card_help_requests->appends(request()->all())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
