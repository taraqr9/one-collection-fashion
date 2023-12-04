@extends('admin.master')

@section('title')
    Footer
@endsection

@section('breadcrumb')
    <a href="{{ url('admin/settings/footer') }}" class="breadcrumb-item">Footer</a>
    <span class="breadcrumb-item active">{{ strtoupper(str_replace('_', ' ', $type)) }}</span>
@endsection

@section('external_js')
    <script src="{{ url()->asset('assets/js/ckeditor/ckeditor_classic.js') }}"></script>
    <script src="{{ url()->asset('assets/js/ckeditor/editor_ckeditor_classic.js') }}"></script>
@endsection

@section('page_content')
    <section style="background-color: #ffffff;">
        <div class="container py-5">
            <div class="row justify-content-center align-items-center">
                <form method="post" class="col-lg-8 border rounded-xl p-2" action="{{ url('admin/settings/footer') }}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row m-1">
                        <label for="staticEmail" class="d-flex justify-content-center h2 text-decoration-underline">{{ strtoupper(str_replace('_', ' ', $type)) }}</label>
                        <div class="mb-3">
                            <textarea class="form-control" id="ckeditor_classic_empty" name="data"
                                      placeholder="Enter your content here">{!! old('data') ?? $data->value ?? '' !!}</textarea>
                        </div>
                    </div>

                    <input type="text" value="{{ $type }}" name="type" hidden>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-outline-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
