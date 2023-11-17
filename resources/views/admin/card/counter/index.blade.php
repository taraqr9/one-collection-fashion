@extends('admin.master')

@section('title')
    Counter
@endsection

@section('breadcrumb')
    <span class="breadcrumb-item active">Counter</span>
@endsection

@section('page_actions')

    @if(in_array(config('access.cards.counter'), $admin_roles))
        <div class="dropdown ms-lg-3">
            <a href="#" class="d-flex align-items-center text-body dropdown-toggle py-2" data-bs-toggle="dropdown">
                <i class="ph-gear me-2"></i>
                <span class="flex-1">Actions</span>
            </a>

            <div class="dropdown-menu dropdown-menu-end w-100 w-lg-auto">
                <a href="{{url('cards/counter/create')}}" class="dropdown-item">
                    <i class="icon-location4 me-2"></i>
                    Add New
                </a>
            </div>
        </div>
    @endif

@endsection

@section('page_content')
    <div class="card">
        <div class="card-body">
            <div class="col-md-12">
                <form class="form-horizontal form-label-left" method="get"
                      action="{{ url('/cards/counter') }}">
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">Counter Name:</label>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input class="form-control style-input" type="text" name="counter_name"
                                       value="{{ request('counter_name') ?? '' }}" placeholder="Counter Name">
                            </div>
                        </div>

                        <div class="form-group col-md-2">
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">Divisions:</label>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <select name="card_division_id" class="form-control input-division"
                                        onchange="divisionOnchangeEvent()">
                                    <option value="" selected>All</option>
                                    @foreach($divisions as $division)
                                        <option
                                                value="{{ $division->id }}" {{ (request('card_division_id') == $division->id) ? 'selected' : '' }}>
                                            {{ $division->name .' - '. $division->name_in_bangla }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div
                                class="form-group col-md-2 input-area-div @if(!request('card_division_id')) {{'d-none'}} @endif">
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">Areas</label>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <select name="area" class="form-control input-area">
                                    <option value="">All</option>
                                    @if(isset($areas_of_a_division))
                                        @foreach($areas_of_a_division as $area)
                                            <option
                                                    value="{{ $area->id }}" {{ (request('area') == $area->id) ? 'selected' : '' }}>
                                                {{ $area->name }} - {{ $area->name_in_bangla }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-2">
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">Status:</label>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <select name="status" class="form-control style-input">
                                    <option value="">All</option>
                                    @foreach(\App\Constants\CardIntegerStatus::all() as $key => $value)
                                        <option value="{{ $value }}" {{ (request('status') == $value) ? 'selected' : '' }}>
                                            {{  ucwords(strtolower(str_replace("_", " ", $key))) }}
                                        </option>
                                    @endforeach
                                </select>
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
                                <th>Name in Bangla</th>
                                <th>Area</th>
                                <th>Division</th>
                                <th>Status</th>
                                @if(in_array(config('access.cards.area'), $admin_roles))
                                    <th>Edit</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($counters as $key => $counter)
                                <tr>
                                    <td>{{  $loop->iteration }}</td>
                                    <td>{{ $counter->name }}</td>
                                    <td>{{ $counter->name_in_bangla }}</td>
                                    <td>{{ $counter->area->name }}</td>
                                    <td>{{ $counter->area->division->name }}</td>
                                    <td>
                                        <span class="badge bg-{{ $counter->status == \App\Constants\CardIntegerStatus::ACTIVE ? 'success' : 'warning' }}">
                                            {{ ucwords(strtolower(str_replace("_", " ", \App\Constants\CardIntegerStatus::getKeyByValue($counter->status)))) }}
                                        </span>
                                    </td>
                                    @if(in_array(config('access.cards.area'), $admin_roles))
                                        <td>
                                            <a
                                                    href="{{ url('/cards/counter/'.$counter->id.'/edit') }}"
                                                    class="btn btn-outline-dark btn-sm">
                                                <i class="ph-pencil-line"></i>
                                            </a>
                                            <a
                                                    onclick="return confirm('Are you sure?')"
                                                    href="{{ url('/cards/counter/'.$counter->id.'/delete') }}"
                                                    class="btn btn-outline-danger btn-sm">
                                                <i class="ph-minus-circle"></i>
                                            </a>
                                    @endif
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="10">
                                        <h4>No data found!</h4>
                                    </td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-12 mt-3">
                    {{ $counters->appends(request()->all())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_js')
    <script>
        function divisionOnchangeEvent() {
            const division_id = $(".input-division").val();
            ``
            $('.input-area').find('option').not(':first').remove();
            if (division_id !== '' && division_id !== null) {
                $(".input-area-div").removeClass('d-none');
                getDivisionWiseArea(division_id).then((res) => {
                    if (res) {
                        if (res.length > 0) {
                            $.each(res, function (i, item) {
                                $('.input-area').append($('<option>', {
                                    value: item.id,
                                    text: item.name + ' - ' + item.name_in_bangla
                                }));
                            });
                        }
                    }
                });
            } else {
                $(".input-area-div").addClass('d-none');
            }
        }

        function getDivisionWiseArea(division_id) {
            return $.ajax({
                url: "/cards/division/" + division_id,    //the page containing php script
                type: "get",    //request type,
                dataType: 'json',
                success: function (res) {
                }
            });
        }
    </script>
@endsection
