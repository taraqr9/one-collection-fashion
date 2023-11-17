@extends('admin.master')

@section('title')
    Details
@endsection

@section('breadcrumb')
    <a href="{{ url('/careers/job') }}" class="breadcrumb-item">Job</a>
    <span class="breadcrumb-item active">Details</span>
@endsection

@section('page_content')
    <div class="content d-flex justify-content-center align-items-center">
        <div class="flex-fill">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <h1 class="mb-0">{{ $job->title }}</h1>
                                <hr>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Title</label>
                                        <div class="form-control-feedback form-control-feedback-start">
                                            {{ $job->title }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Department</label>
                                        <div class="form-control-feedback form-control-feedback-start">
                                            {{ $job->department }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Salary Range</label>
                                        <div class="form-control-feedback form-control-feedback-start">
                                            {{ $job->salary_range }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Employment Status</label>
                                        <div class="form-control-feedback form-control-feedback-start">
                                            {{ \App\Constants\CareerJobEmploymentStatus::getValueByKey($job->employment_status) }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Location</label>
                                        <div class="form-control-feedback form-control-feedback-start">
                                            {{ $job->location }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Deadline</label>
                                        <div class="form-control-feedback form-control-feedback-start">
                                            {{ date('d-m-Y g:i A', strtotime($job->deadline)) }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">No of Vacancy</label>
                                        <div class="form-control-feedback form-control-feedback-start">
                                            {{ $job->no_of_vacancy }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <div class="form-control-feedback form-control-feedback-start">
                                            {{ \App\Constants\CareerJobStatus::getValueByKey($job->status) }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Created At</label>
                                    <div class="form-control-feedback form-control-feedback-start">
                                        {{ date('d-m-Y g:i A', strtotime($job->created_at)) }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Job Details</label>
                                    <div class="form-control-feedback form-control-feedback-start">
                                        {!! $job->job_details ?? 'N/A' !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
