@php use Illuminate\Support\Facades\Storage; @endphp
@extends('admin.master')

@section('title')
    Shop By Category
@endsection

@section('breadcrumb')
    <span class="breadcrumb-item active">Shop By Category</span>
@endsection


@section('page_actions')
    <div class="dropdown ms-lg-3">
        <a href="#" class="d-flex align-items-center text-body dropdown-toggle py-2" data-bs-toggle="dropdown">
            <i class="ph-gear me-2"></i>
            <span class="flex-1">Actions</span>
        </a>

        <div class="dropdown-menu dropdown-menu-end w-100 w-lg-auto">

            <button type="button" class="dropdown-item" data-bs-toggle="modal"
                    data-bs-target="#banner_image" id="add_banner_image">
                <i class="ph-image me-2"></i>&nbsp; Add New
            </button>
        </div>
    </div>
@endsection

@section('page_content')
    <div class="shop_bycat section_padding_b">
        <div class="container">
            <h2 class="section_title_3">Shop by category</h2>
            <div class="row gx-2 gy-2">
                <div class="col-lg-4 col-6">
                    <a href="#" class="single_shopbycat bg_1"
                       style="background-image: url({{ url()->asset('user/assets/images/category-1.jpg') }})">
                        <div class="shopcat_cont">
                            <h4>Bedroom</h4>
                            <div class="icon">
                                <i class="las la-long-arrow-alt-right"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-6">
                    <a href="#" class="single_shopbycat bg_1"
                       style="background-image: url({{ url()->asset('user/assets/images/category-2.jpg') }})">
                        <div class="shopcat_cont">
                            <h4>Mattresses</h4>
                            <div class="icon">
                                <i class="las la-long-arrow-alt-right"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-6">
                    <a href="#" class="single_shopbycat bg_1"
                       style="background-image: url({{ url()->asset('user/assets/images/category-3.jpg') }})">
                        <div class="shopcat_cont">
                            <h4>Office</h4>
                            <div class="icon">
                                <i class="las la-long-arrow-alt-right"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-6">
                    <a href="#" class="single_shopbycat bg_1"
                       style="background-image: url({{ url()->asset('user/assets/images/category-4.jpg') }})">
                        <div class="shopcat_cont">
                            <h4>Outdoor</h4>
                            <div class="icon">
                                <i class="las la-long-arrow-alt-right"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-6">
                    <a href="#" class="single_shopbycat bg_1"
                       style="background-image: url({{ url()->asset('user/assets/images/category-5.jpg') }})">
                        <div class="shopcat_cont">
                            <h4>Lounges & Sofas</h4>
                            <div class="icon">
                                <i class="las la-long-arrow-alt-right"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-6">
                    <a href="#" class="single_shopbycat bg_1"
                       style="background-image: url({{ url()->asset('user/assets/images/category-6.jpg') }})">
                        <div class="shopcat_cont">
                            <h4>Living & Dining</h4>
                            <div class="icon">
                                <i class="las la-long-arrow-alt-right"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

