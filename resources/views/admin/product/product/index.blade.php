@php use App\Enums\ProductStatusEnum;use Illuminate\Support\Facades\Storage; @endphp
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
    <div class="card">
        <div class="card-body">
            <div class="col-md-12">
                <form class="form-horizontal form-label-left" method="get"
                      action="{{ url('admin/products/product') }}">
                    <div class="row">

                        <div class="form-group col-md-2">
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">Name:</label>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input class="form-control style-input" type="text" name="name"
                                       value="{{ request('name') ?? '' }}" placeholder="Name">
                            </div>
                        </div>

                        <div class="form-group col-md-2">
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">Category:</label>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <select name="category_id" class="form-control style-input">
                                    <option value="">All</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" @selected((request('category_id') == $category->id))>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-2">
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">Status:</label>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <select name="status" class="form-control style-input">
                                    <option value="" selected>All</option>
                                    @foreach(ProductStatusEnum::cases() as $status)
                                        <option value="{{ $status }}" @selected($status->value == request('status'))>
                                            {{ $status->value }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="col-md-1">
                            <label class="fw-bold col-md-12 col-sm-0 col-xs-0">&nbsp;</label>
                            <button type="submit" class="btn bg-dark text-white">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="row justify-content-center">
            @forelse($products as $product)
                <div class="card col-lg-2 m-1">
                    <div class="card-body">
                        <div class="card-img-actions mb-3">
                            <div class="d-flex justify-content-center align-items-center position-relative">
                                <img class="card-img img-fluid w-80px h-80px"
                                     src="{{ Storage::url($product->thumbnail) }}"
                                     alt="Product Image">
                                <div class="card-img-actions-overlay card-img position-absolute">
                                    <a href="{{ url('admin/products/product/'.$product->id.'/edit') }}"
                                       class="btn btn-outline-white btn-icon rounded-pill">
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
                            <span
                                class="badge bg-{{ ProductStatusEnum::ACTIVE->value == $product->status ? 'success' : 'warning' }}">
                                 {{ $product->status }}
                            </span>
                        </ul>
                    </div>

                    <div class="card-footer d-flex">
                        <a href="{{ url('admin/products/product/'.$product->id.'/edit') }}"
                           class="d-inline-flex align-items-center me-2">Edit <i class="ph-arrow-circle-right ms-2"></i></a>
                        <a href="{{ url('admin/products/product/'.$product->id.'/delete') }}"
                           onclick="return confirm('Are you sure?')"
                           class="d-inline-flex align-items-center ms-auto">Delete <i class="ph-minus-circle ms-2"></i></a>
                    </div>
                </div>
            @empty
                <h4 class="col-lg-2 m-1">No data found!</h4>
            @endforelse
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
