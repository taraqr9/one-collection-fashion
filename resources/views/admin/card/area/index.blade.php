@extends('admin.master')

@section('title')
    Area
@endsection

@section('breadcrumb')
    <span class="breadcrumb-item active">Area</span>
@endsection

@section('page_actions')
    @if(in_array(config('access.cards.area'), $admin_roles))
        <div class="dropdown ms-lg-3">
            <a href="#" class="d-flex align-items-center text-body dropdown-toggle py-2" data-bs-toggle="dropdown">
                <i class="ph-gear me-2"></i>
                <span class="flex-1">Actions</span>
            </a>

            <div class="dropdown-menu dropdown-menu-end w-100 w-lg-auto">
                <a href="{{url('cards/area/create')}}" class="dropdown-item">
                    <i class="icon-location3 me-2"></i>
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
                      action="{{ url('/cards/area') }}">
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">Divisions:</label>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <select name="division" class="form-control style-input">
                                    <option value="">All</option>
                                    @foreach($divisions as $key => $division)
                                        <option
                                                value="{{ $division->id }}" {{ (request('division') == $division->id) ? 'selected' : '' }}>
                                            {{ $division->name }} - {{ $division->name_in_bangla }}</option>
                                    @endforeach
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
                                <th>Division</th>
                                <th>Status</th>
                                @if(in_array(config('access.cards.area'), $admin_roles))
                                    <th>Edit</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($areas as $key => $area)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $area->name }}</td>
                                    <td>{{ $area->name_in_bangla }}</td>
                                    <td>{{ $area->division->name }}</td>
                                    <td>
                                        <span
                                                class="badge bg-{{ $area->status == \App\Constants\CardIntegerStatus::ACTIVE ? 'success' : 'warning' }}">
                                            {{ ucwords(strtolower(str_replace("_", " ", \App\Constants\CardIntegerStatus::getKeyByValue($area->status)))) }}
                                        </span>
                                    </td>
                                    @if(in_array(config('access.cards.area'), $admin_roles))
                                        <td><a
                                                    href="{{ url('/cards/area/'.$area->id.'/edit') }}"
                                                    class="btn btn-outline-dark btn-sm"><i
                                                        class="ph-pencil-line"></i></a>
                                        </td>
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
                    {{ $areas->appends(request()->all())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
