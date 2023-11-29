@extends('admin.master')

@section('title')
    Edit Sub Category
@endsection

@section('breadcrumb')
    <a href="{{ url('admin/products/category') }}" class="breadcrumb-item">Sub Category</a>
    <span class="breadcrumb-item active">Edit Sub Category</span>
@endsection

@section('page_content')
    <section style="background-color: #ffffff;">
        <div class="container py-5">
            <div class="row justify-content-center align-items-center">
                <form method="post" class="col-lg-8 border rounded-xl p-2"
                      action="{{ url('admin/products/sub_category/'.$sub_category->id.'/edit') }}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row m-1">
                        <label class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-10">
                            <select name="parent_id" class="form-control" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" @selected($category->id == $sub_category->parent_id)>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row m-1">
                        <label class="col-sm-2 col-form-label">Name {{ $sub_category->parent_id }}</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" value="{{ $sub_category->name }}"
                                   required>
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
