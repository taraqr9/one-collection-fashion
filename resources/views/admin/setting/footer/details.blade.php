@extends('admin.master')

@section('title')
    Footer
@endsection

@section('breadcrumb')
    <a href="{{ url('admin/settings/footer') }}" class="breadcrumb-item">Footer</a>
    <span class="breadcrumb-item active">{{ strtoupper(str_replace('_', ' ', $type)) }}</span>
@endsection

@section('page_content')
    <div class="content d-flex justify-content-center align-items-center">
        <div class="flex-fill">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label d-flex justify-content-center h2 text-decoration-underline">{{ strtoupper(str_replace('_', ' ', $type)) }}</label>
                                    <div class="form-control-feedback form-control-feedback-start">
                                        {!! $data->value ?? 'N/A' !!}
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
