@extends('admin.master')

@section('title')
    Category
@endsection

@section('breadcrumb')
    <span class="breadcrumb-item active">Category</span>
@endsection


@section('page_actions')
    <div class="dropdown ms-lg-3">
        <a href="#" class="d-flex align-items-center text-body dropdown-toggle py-2" data-bs-toggle="dropdown">
            <i class="ph-gear me-2"></i>
            <span class="flex-1">Actions</span>
        </a>

        <div class="dropdown-menu dropdown-menu-end w-100 w-lg-auto">
            <a href="{{ url('admin/products/category/create') }}" class="dropdown-item">
                <i class="ph-gear me-2"></i>
                Add New
            </a>
        </div>
    </div>
@endsection

@section('page_content')
    <div class="col-12">
        <div class="row card">
            <div class="card-body">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped text-center">
                            <thead>
                            <tr class="bg-dark text-white">
                                <th>#</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <a href="{{ url('admin/products/category/'.$category->id.'/edit') }}"
                                           class="btn btn-outline-dark btn-sm">
                                            <i class="ph-pencil-line"></i>
                                        </a>

                                        <a
                                            onclick="return confirm('Are you sure?')"
                                            href="{{ url('admin/products/category/'.$category->id.'/delete') }}"
                                            class="btn btn-outline-danger btn-sm">
                                            <i class="ph-minus-circle"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10">
                                        <h4>No data found!</h4>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
