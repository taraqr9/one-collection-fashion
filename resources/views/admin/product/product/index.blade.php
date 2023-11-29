@extends('admin.master')

@section('title')
    Product
@endsection

@section('breadcrumb')
    <span class="breadcrumb-item active">Product</span>
@endsection


@section('page_actions')
    <div class="dropdown ms-lg-3">
        <a href="#" class="d-flex align-items-center text-body dropdown-toggle py-2" data-bs-toggle="dropdown">
            <i class="ph-gear me-2"></i>
            <span class="flex-1">Actions</span>
        </a>

        <div class="dropdown-menu dropdown-menu-end w-100 w-lg-auto">
            <a href="{{ url('admin/products/product/create') }}" class="dropdown-item">
                <i class="ph-gear me-2"></i>
                Add New
            </a>
        </div>
    </div>
@endsection

@section('page_content')
    <div class="content">
        <div class="row justify-content-center">
            <div class="card col-lg-3 m-1">
                <div class="card-body">
                    <div class="card-img-actions mb-3">
                        <img class="card-img img-fluid"
                             src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                             alt="">
                        <div class="card-img-actions-overlay card-img">
                            <a href="#" class="btn btn-outline-white btn-icon rounded-pill">
                                <i class="ph-link"></i>
                            </a>
                        </div>
                    </div>

                    <h5 class="card-title pt-1 mb-1 title-truncate">
                        <a href="#" class="text-body">Domestic confined any but son Domestic confined any but son
                            Domestic confined any but son</a>
                    </h5>

                    <ul class="list-inline list-inline-bullet text-muted mb-3">
                        <li>Category : Men</li>
                        <li>Sub Category : T-shirt</li>
                        <li>Price : 2000 BDT</li>
                        <li>Stock : 100</li>
                    </ul>
                </div>

                <div class="card-footer">
                    <a href="#" class="d-inline-flex align-items-center ms-auto">Edit <i
                            class="ph-arrow-circle-right ms-2"></i></a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var titleElements = document.querySelectorAll('.title-truncate');

            titleElements.forEach(function (titleElement) {
                var originalTitle = titleElement.innerText;
                titleElement.innerText = originalTitle.split(' ').slice(0, 5).join(' ') + '...';
            });
        });
    </script>
@endsection
