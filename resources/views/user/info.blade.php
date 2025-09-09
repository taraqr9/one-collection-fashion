@extends('user.master')

@section('title')
    {{ config('app.name') }}
@endsection

@section('page_content')
    <div class="static_page section_padding_b">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <!-- Page Title -->
                    <h2 class="text-center mt-3 mb-3">{{ $info?->name }}</h2>
                    <hr class="mx-auto mb-4" style="width:100%;height:3px;background:#000;border:0;">

                    <!-- Page Content -->
                    <div class="page_content">
                        {!! $info?->value['content'] !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

