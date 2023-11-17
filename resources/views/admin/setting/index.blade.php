@extends('admin.master')

@section('title')
    Setting
@endsection

@section('breadcrumb')
    <span class="breadcrumb-item active">Setting</span>
@endsection

@section('page_content')
    <form class="tab-content flex-lg-fill" action="{{ url('/setting') }}" method="post">
        @csrf
        <div class="tab-pane fade active show" id="generalInfo">
            <div class="card">
                <div class="card-header header-elements-sm-inline">
                    <h5 class="card-title">Setting</h5>
                </div>

                <div class="card-body form-group">
                    <div class="col-md-6">
                        <label class="fw-bold">Career Youtube URL</label>
                        <input type="text" class="form-control" name="career_youtube_url"
                               value="{{ $setting['value'] ?? '' }}"
                               placeholder="Youtube URL" required autocomplete="off">
                    </div>
                </div>
            </div>
        </div>

        @if (checkAuthorization(config('access.settings.setting'), auth()->user()->roles))
            <div class="text-end">
                <button type="submit" class="btn btn-outline-dark">Submit</button>
            </div>
        @endif
    </form>
@endsection
