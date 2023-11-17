@extends('admin.master')

@section('title')
    Add Department
@endsection

@section('breadcrumb')
    <a href="{{ url('/careers/department') }}" class="breadcrumb-item">Department</a>
    <span class="breadcrumb-item active">Add Department</span>
@endsection

@section('page_content')
    <section style="background-color: #ffffff;">
        <div class="container py-5">
            <div class="row justify-content-center align-items-center">
                <form method="post" class="col-lg-8 border rounded-xl p-2" action="{{ url('/careers/department') }}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row m-1">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" placeholder="Department name"
                                   value="{{ old('name') }}">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row m-1">
                        <label class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <select name="status" class="form-control" required>
                                <option value="" selected>Select Status</option>
                                @foreach(\App\Constants\CareerIntegerStatus::all() as $key => $value)
                                    <option value="{{ $value }}">{{ str_replace("_", " ", $key) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-outline-primary">Add Department</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
