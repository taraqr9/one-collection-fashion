@extends('admin.master')

@section('title')
    Application
@endsection

@section('breadcrumb')
    <span class="breadcrumb-item active">Application</span>
@endsection

@section('page_actions')
    @if(in_array(config('access.careers.application'), $admin_roles))
        <div class="dropdown ms-lg-3">
            <a href="#" class="d-flex align-items-center text-body dropdown-toggle py-2" data-bs-toggle="dropdown">
                <i class="ph-gear me-2"></i>
                <span class="flex-1">Actions</span>
            </a>

            <div class="dropdown-menu dropdown-menu-end w-100 w-lg-auto">
                <form method="get" action="{{ url('/careers/application/'.request('job_id').'/csv') }}">
                    @csrf
                    <div class="dropdown-item">
                        <button type="submit" class="btn"><i class="ph-file-csv me-2"></i>Export to CSV</button>
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
                      action="{{ url('/careers/application/'.request('job_id')) }}">
                    <div class="row">

                        <div class="form-group col-md-2">
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">A.Name:</label>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input class="form-control style-input" type="text" name="name"
                                       value="{{ request('name') ?? '' }}" placeholder="Name">
                            </div>
                        </div>

                        <div class="form-group col-md-2">
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">Email:</label>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input class="form-control style-input" type="text" name="email"
                                       value="{{ request('email') ?? '' }}" placeholder="Email">
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
                                <th>Job</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Linkedin Profile</th>
                                <th>Applied At</th>
                                <th>
                                    @if(in_array(config('access.careers.banner'), $admin_roles))
                                        Actions
                                    @endif
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($career_applications as $key => $application)
                                <tr>
                                    <td>{{  $loop->iteration }}</td>
                                    <td>
                                        <a href="{{ url('/careers/job/details/'.$application->job->id) }}">
                                            {{ $application->job->title }}
                                        </a>
                                    </td>
                                    <td>{{ $application->name }}</td>
                                    <td>{{ $application->email }}</td>
                                    <td>{{ $application->mobile_number }}</td>
                                    <td>
                                        <a href="{{$application->linkedin_profile}}">
                                            Linkedin
                                        </a>
                                    </td>
                                    <td>{{ date('d-m-Y g:i A', strtotime($application->created_at)) }}</td>

                                    <td>
                                        <a href="{{ \Illuminate\Support\Facades\Storage::url($application->resume) }}"
                                           target="_blank"
                                           class="btn btn-outline-dark btn-sm"><i class="ph-eye"></i></a>

                                        <a download
                                           href="{{ \Illuminate\Support\Facades\Storage::url($application->resume) }}"
                                           target="_blank"
                                           class="btn btn-outline-dark btn-sm"><i class="ph-download"></i></a>
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

            </div>
        </div>
    </div>
    <div class="col-md-12 mt-3">
        {{ $career_applications->appends(request()->all())->links() }}
    </div>
@endsection
