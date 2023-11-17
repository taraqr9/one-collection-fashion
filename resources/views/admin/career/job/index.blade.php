@extends('admin.master')

@section('title')
    Job
@endsection

@section('breadcrumb')
    <span class="breadcrumb-item active">Job</span>
@endsection

@section('page_actions')
    @if(in_array(config('access.careers.job'), $admin_roles))
        <div class="dropdown ms-lg-3">
            <a href="#" class="d-flex align-items-center text-body dropdown-toggle py-2" data-bs-toggle="dropdown">
                <i class="ph-gear me-2"></i>
                <span class="flex-1">Actions</span>
            </a>

            <div class="dropdown-menu dropdown-menu-end w-100 w-lg-auto">
                <a href="{{url('careers/job/create')}}" class="dropdown-item">
                    <i class="ph-briefcase-metal me-2"></i>
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
                      action="{{ url('/careers/job') }}">
                    <div class="row">

                        <div class="form-group col-md-2">
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">Title:</label>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input class="form-control style-input" type="text" name="title"
                                       value="{{ request('title') ?? '' }}" placeholder="Title">
                            </div>
                        </div>

                        <div class="form-group col-md-2">
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">Department:</label>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <select name="department" class="form-control style-input">
                                    <option value="">All
                                    </option>
                                    @foreach($career_departments as $department)
                                        <option value="{{ $department->name }}" {{ (request('department') == $department->name) ? 'selected' : '' }}>
                                            {{ $department->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-2">
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">Employment Status:</label>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <select name="employment_status" class="form-control style-input">
                                    <option value="">All
                                    </option>
                                    @foreach(\App\Constants\CareerJobEmploymentStatus::all() as $key => $value)
                                        <option
                                            value="{{ $key }}" {{ (request('employment_status') == $key) ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-2">
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">Status:</label>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <select name="status" class="form-control style-input">
                                    <option value="all" {{ (request('status') == 'all') ? 'selected' : '' }}>All</option>
                                    @foreach(\App\Constants\CareerJobStatus::all() as $key => $value)
                                        <option value="{{ $key }}" {{ (request('status') == $key) ? 'selected' : '' }}
                                            {{ empty(request('status')) && $value == \App\Constants\CareerJobStatus::ACTIVE ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="col-md-1">
                            <label class="fw-bold col-md-12 col-sm-0 col-xs-0">&nbsp;</label>
                            <button type="submit" class="btn bg-dark text-white">Search</button>
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
                                <th>Title</th>
                                <th>Department</th>
                                <th>E. Status</th>
                                <th>Location</th>
                                <th>Vacancy</th>
                                <th>Deadline</th>
                                <th>Created At</th>
                                <th>Status</th>
                                <th>
                                    @if(in_array(config('access.careers.banner'), $admin_roles))
                                        Actions
                                    @endif
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($career_jobs as $key => $job)
                                <tr>
                                    <td>{{  $loop->iteration }}</td>
                                    <td>
                                        <a href="{{ url('/careers/job/details/'.$job->id) }}">
                                            {{ $job->title }}
                                        </a>
                                    </td>
                                    <td>{{ $job->department }}</td>
                                    <td>{{ \App\Constants\CareerJobEmploymentStatus::getValueByKey($job->employment_status) }}</td>
                                    <td>{{ $job->location }}</td>
                                    <td>{{ $job->no_of_vacancy }}</td>
                                    <td>{{ date('d-m-Y g:i A', strtotime($job->deadline)) }}</td>
                                    <td>{{ date('d-m-Y g:i A', strtotime($job->created_at)) }}</td>
                                    <td>
                                        <span
                                            class="badge bg-{{ \App\Constants\CareerJobStatus::getValueByKey($job->status) == \App\Constants\CareerJobStatus::ACTIVE ? 'success' : 'warning' }}">
                                            {{ \App\Constants\CareerJobStatus::getValueByKey($job->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if(in_array(config('access.careers.job'), $admin_roles))
                                            <a href="{{ url('/careers/job/details/'.$job->id) }}"
                                               class="btn btn-outline-dark btn-sm"><i class="ph-eye"></i></a>

                                            <a href="{{ url('/careers/job/'.$job->id.'/application') }}"
                                               class="btn btn-outline-dark btn-sm"><i class="ph-user-circle"></i>{{ $job->applications_count }}</a>

                                            <a href="{{ url('/careers/job/'.$job->id.'/edit') }}"
                                               class="btn btn-outline-dark btn-sm"><i class="ph-pencil-line"></i></a>
                                        @endif
                                    </td>
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
                    {{ $career_jobs->appends(request()->all())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
