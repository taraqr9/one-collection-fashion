@extends('admin.master')

@section('title')
    Edit Category
@endsection

@section('breadcrumb')
    <a href="{{ url('admin/products/category') }}" class="breadcrumb-item">Category</a>
    <span class="breadcrumb-item active">Edit Category</span>
@endsection

@section('page_content')
    <section style="background-color: #ffffff;">
        <div class="container py-5">
            <div class="row justify-content-center align-items-center">
                <form method="post" class="col-lg-8 border rounded-xl p-2"
                      action="{{ url('admin/products/category/'.$category->id.'/edit') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row m-1">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-outline-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
