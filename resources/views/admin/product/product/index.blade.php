@php use Illuminate\Support\Facades\Storage; @endphp
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
            @foreach($products as $product)
                <div class="card col-lg-2 m-1">
                    <div class="card-body">
                        <div class="card-img-actions mb-3">
                            <div class="d-flex justify-content-center align-items-center position-relative">
                                <img class="card-img img-fluid w-80px h-80px"
                                     src="{{ Storage::url($product->thumbnail) }}"
                                     alt="Product Image">
                                <div class="card-img-actions-overlay card-img position-absolute">
                                    <a href="{{ url('admin/products/product/'.$product->id.'/edit') }}" class="btn btn-outline-white btn-icon rounded-pill">
                                        <i class="ph-pencil-line"></i>
                                    </a>
                                </div>
                            </div>
                        </div>


                        <h5 class="card-title pt-1 mb-1 title-truncate">
                            <a href="#" class="text-body">{{ $product->name }}</a>
                        </h5>

                        <ul class="list-inline list-inline-bullet text-muted mb-3">
                            <li>Category : {{ $product->category->name }}</li>
                            <li>{{ $product->subCategory ? 'Sub Category : '.$product->subCategory->name : '' }}</li>
                            <li>Price : {{ $product->price }} BDT</li>
                            <li>Offer Price : {{ $product->offer_price }} BDT</li>
                            <li>Stock : {{ $product->stock }}</li>
                        </ul>
                    </div>

                    <div class="card-footer">
                        <a href="{{ url('admin/products/product/'.$product->id.'/edit') }}" class="d-inline-flex align-items-center ms-auto">Edit <i
                                class="ph-arrow-circle-right ms-2"></i></a>
                    </div>
                </div>
            @endforeach
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
