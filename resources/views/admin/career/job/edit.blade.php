@extends('admin.master')

@section('title')
    Edit Job
@endsection

@section('external_js')
    <script src="{{ url()->asset('assets/js/ckeditor/editor_ckeditor_classic.js') }}"></script>
    <script src="{{ url()->asset('assets/js/ckeditor/ckeditor_classic.js') }}"></script>
@endsection

@section('breadcrumb')
    <a href="{{ url('/careers/job') }}" class="breadcrumb-item">Job</a>
    <span class="breadcrumb-item active">Edit Job</span>
@endsection

@section('page_content')
    <div class="d-md-flex align-items-md-start">
        <form class="tab-content flex-lg-fill" action="{{ url('/careers/job/'.$job->id.'/edit') }}" method="post"
              enctype="multipart/form-data">
            @csrf

            <div class="tab-pane fade active show" id="generalInfo">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <span class="h5">Edit Job</span>
                            <span class="h5 d-block text-center mx-auto">{{ $job->title }}</span>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="fw-bold">Title:</label>
                                <div class="form-control custom-disabled-bg">
                                    {{ $job->title }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold">Department:</label>
                                <div class="form-control custom-disabled-bg">
                                    {{ $job->department }}
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="fw-bold">Salary Range:</label>
                                <input type="text" class="form-control" name="salary_range"
                                       value="{{ $job->salary_range }}"
                                       placeholder="Enter Salary Range" autocomplete="off" required>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold">Employment Status:</label>
                                <select name="employment_status" class="form-control" required>
                                    <option value="" selected>Select Employment Status</option>
                                    @foreach(\App\Constants\CareerJobEmploymentStatus::all() as $key => $value)
                                        <option
                                            value="{{ $key }}" {{ ($job->employment_status == $key) ? 'selected' : '' }}>
                                            {{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="fw-bold">Location:</label>
                                <input type="text" class="form-control" name="location" value="{{ $job->location }}"
                                       placeholder="Enter Location"
                                       autocomplete="off" required>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold">Deadline:</label>
                                <input type="date" class="form-control" name="deadline"
                                       value="{{ date('Y-m-d', strtotime($job->deadline)) }}"
                                       placeholder="Enter Deadline"
                                       autocomplete="off" required>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="fw-bold">No of Vacancy:</label>
                                <input type="number" class="form-control" name="no_of_vacancy"
                                       value="{{ $job->no_of_vacancy }}"
                                       placeholder="Enter Number of Vacancy"
                                       autocomplete="off" required>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold">Status:</label>
                                <select name="status" class="form-control {{$job->status ==
                                        \App\Constants\CareerJobStatus::getKeyByValue(\App\Constants\CareerJobStatus::IN_ACTIVE) ? 'custom-disabled-bg' : ''}}"
                                        required>
                                    <option value="" selected>Select Status</option>
                                    @foreach(\App\Constants\CareerJobStatus::all() as $key => $value)
                                        <option
                                            value="{{ $key }}" {{ ($job->status == $key) ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <br>

                        <label class="fw-bold">Job Details:</label>
                        <div class="mb-3">
                            <textarea class="form-control" id="ckeditor_classic_empty" name="job_details"
                                      placeholder="Enter your text...">
                                {!! $job->job_details !!}
                            </textarea>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-outline-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
