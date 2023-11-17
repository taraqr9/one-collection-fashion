@extends('admin.master')

@section('title')
    Division
@endsection

@section('breadcrumb')
    <span class="breadcrumb-item active">Division</span>
@endsection


@section('page_actions')
    @if(in_array(config('access.cards.division'), $admin_roles))
        <div class="dropdown ms-lg-3">
            <a href="#" class="d-flex align-items-center text-body dropdown-toggle py-2" data-bs-toggle="dropdown">
                <i class="ph-gear me-2"></i>
                <span class="flex-1">Actions</span>
            </a>

            <div class="dropdown-menu dropdown-menu-end w-100 w-lg-auto">
                <a href="{{url('cards/division/create')}}" class="dropdown-item">
                    <i class="icon-map me-2"></i>
                    Add New
                </a>
            </div>
        </div>
    @endif
@endsection

@section('page_content')
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
                                <th>Status</th>
                                @if(in_array(config('access.cards.division'), $admin_roles))
                                    <th class="text-center">Edit</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($divisions as $key => $division)
                                <tr>
                                    <td>{{  $loop->iteration }}</td>
                                    <td>{{ $division->name }}</td>
                                    <td>{{ $division->name_in_bangla }}</td>
                                    <td>
                                        <span
                                            class="badge bg-{{ $division->status == \App\Constants\CardIntegerStatus::ACTIVE ? 'success' : 'warning' }}">
                                            {{ ucwords(strtolower(str_replace("_", " ", \App\Constants\CardIntegerStatus::getKeyByValue($division->status)))) }}
                                        </span>
                                    </td>
                                    @if(in_array(config('access.cards.division'), $admin_roles))
                                        <td><a
                                                href="{{ url('/cards/division/'.$division->id.'/edit') }}"
                                                class="btn btn-outline-dark btn-sm"><i class="ph-pencil-line"></i></a>
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
            </div>
        </div>
    </div>
@endsection
