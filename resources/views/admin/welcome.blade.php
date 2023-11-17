@extends('admin.master')

@section('title')
    Dashboard
@endsection

@section('breadcrumb')
    <span class="breadcrumb-item active">Dashboard</span>
@endsection

@section('page_content')
    <div class="row">
        <div class="col-12">
            <h2>Welcome to {{ config('app.name') }}</h2>
        </div>
    </div>
@endsection
