@php use Illuminate\Support\Facades\Storage; @endphp
@extends('user.master')

@section('title')
    {{ config('app.name') }}
@endsection

@section('page_content')
    <!-- breadcrumbs -->
    <div class="container">
        <div class="breadcrumbs">
            <a href="{{ route('home') }}"><i class="las la-home"></i></a>
            <a href="#" class="active">Shop</a>
        </div>
    </div>

    <div class="shop_wrap section_padding_b">
        <div class="container">
            <div class="row">
                {{--                <div class="col-xl-3 col-lg-4 position-relative">--}}
                {{--                    <div class="filter_box py-3 px-3 shadow_sm">--}}
                {{--                        <div class="close_filter d-block d-lg-none"><i class="las la-times"></i></div>--}}
                {{--                        <div class="shop_filter d-block d-sm-none">--}}
                {{--                            <h4 class="filter_title">Sort by</h4>--}}
                {{--                            <div class="sorting_filter mb-2">--}}
                {{--                                <select class="nice_select">--}}
                {{--                                    <option value="">Default sorting</option>--}}
                {{--                                    <option value="">Price low-high</option>--}}
                {{--                                    <option value="">Price high-low</option>--}}
                {{--                                </select>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}

                {{--                        <div class="shop_filter">--}}
                {{--                            <h4 class="filter_title">Categories</h4>--}}
                {{--                            <div class="filter_list">--}}
                {{--                                @foreach($categories->where('parent_id', null)->sortBy('name') as $category)--}}
                {{--                                    <div class="custom_check d-flex align-items-center">--}}
                {{--                                        <input type="checkbox" class="check_inp" hidden id="cat-women" checked/>--}}
                {{--                                        <label for="cat-women">{{ $category->name }}</label>--}}
                {{--                                        <p class="mb-0 ms-auto">({{ $category->products->count() }})</p>--}}
                {{--                                    </div>--}}
                {{--                                @endforeach--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <div class="shop_filter">--}}
                {{--                            <h4 class="filter_title">Sub Categories</h4>--}}
                {{--                            <div class="filter_list">--}}
                {{--                                @foreach($categories->whereNotNull('parent_id')->sortBy('name') as $category)--}}
                {{--                                    <div class="custom_check d-flex align-items-center">--}}
                {{--                                        <input type="checkbox" class="check_inp" hidden id="bnd-adidas" checked/>--}}
                {{--                                        <label for="cat-women">{{ $category->name }}</label>--}}
                {{--                                        <p class="mb-0 ms-auto">({{ $category->parent->name }})</p>--}}
                {{--                                    </div>--}}
                {{--                                @endforeach--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <div class="shop_filter">--}}
                {{--                            <h4 class="filter_title">Price</h4>--}}
                {{--                            <div class="price-range-slider">--}}
                {{--                                <div id="slider-range" class="range-bar"></div>--}}
                {{--                                <p class="range-value">--}}
                {{--                                    <input type="text" id="amount" readonly/>--}}
                {{--                                </p>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <div class="shop_filter">--}}
                {{--                            <h4 class="filter_title">Size</h4>--}}
                {{--                            <div class="size_selector d-flex">--}}
                {{--                                <div class="single_size_opt">--}}
                {{--                                    <input type="radio" hidden name="size" class="size_inp" id="size-xs"/>--}}
                {{--                                    <label for="size-xs">XS</label>--}}
                {{--                                </div>--}}
                {{--                                <div class="single_size_opt ms-2">--}}
                {{--                                    <input type="radio" hidden name="size" class="size_inp" id="size-s"/>--}}
                {{--                                    <label for="size-s">S</label>--}}
                {{--                                </div>--}}
                {{--                                <div class="single_size_opt ms-2">--}}
                {{--                                    <input type="radio" hidden name="size" class="size_inp" id="size-m" checked/>--}}
                {{--                                    <label for="size-m">M</label>--}}
                {{--                                </div>--}}
                {{--                                <div class="single_size_opt ms-2">--}}
                {{--                                    <input type="radio" hidden name="size" class="size_inp" id="size-l"/>--}}
                {{--                                    <label for="size-l">L</label>--}}
                {{--                                </div>--}}
                {{--                                <div class="single_size_opt ms-2">--}}
                {{--                                    <input type="radio" hidden name="size" class="size_inp" id="size-xl"/>--}}
                {{--                                    <label for="size-xl">XL</label>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <div class="shop_filter border-bottom-0 pb-0 mb-0">--}}
                {{--                            <h4 class="filter_title">Color</h4>--}}
                {{--                            <div class="size_selector color_selector d-flex align-items-center">--}}
                {{--                                <div class="single_size_opt">--}}
                {{--                                    <input type="radio" hidden name="color" class="size_inp" id="color-purple"/>--}}
                {{--                                    <label for="color-purple" class="bg-color" data-bs-toggle="tooltip"--}}
                {{--                                           title="Rose Red"></label>--}}
                {{--                                </div>--}}
                {{--                                <div class="single_size_opt ms-2">--}}
                {{--                                    <input type="radio" hidden name="color" class="size_inp" id="color-red"/>--}}
                {{--                                    <label for="color-red" class="bg-white" data-bs-toggle="tooltip"--}}
                {{--                                           title="White"></label>--}}
                {{--                                </div>--}}
                {{--                                <div class="single_size_opt ms-2">--}}
                {{--                                    <input type="radio" hidden name="color" class="size_inp" id="color-green" checked/>--}}
                {{--                                    <label for="color-green" class="bg-dark" data-bs-toggle="tooltip"--}}
                {{--                                           title="Black"></label>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                <div class="col-xl-9 col-lg-8">
                    <div class="d-flex align-items-center">
                        <div class="d-block d-lg-none">
                            <button class="default_btn py-2 me-3 rounded" id="mobile_filter_btn">Filter</button>
                        </div>

                        <div class="sorting_filter d-none d-sm-block m-2">
                            <select id="category_select" class="nice_select">
                                <option value="">Select Category</option>
                                @foreach ($categories->where('parent_id', null)->sortBy('name') as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="sorting_filter d-none d-sm-block m-2">
                            <select id="subcategory_select" class="nice_select">
                                <option value="">Select Sub Category</option>
                                <!-- Options will be added dynamically -->
                            </select>
                        </div>


                        <div class="sorting_filter d-none d-sm-block m-2">
                            <select class="nice_select">
                                <option value="">Default sorting</option>
                                <option value="">Price low-high</option>
                                <option value="">Price high-low</option>
                            </select>
                        </div>
                        <div class="view_filter d-flex align-items-center ms-auto">
                            <a href="#">
                                <div class="view_icon active"><i class="icon-grid"></i></div>
                            </a>
                            <!-- <a href="shop-list.html">
                                    <div class="view_icon"><i class="las la-list-ul"></i></div>
                                </a> -->
                        </div>
                    </div>
                    <div class="shop_products">
                        <div class="row gy-4">
                            @foreach($products as $product)
                                <div class="col-md-4 col-sm-6">
                                    <div class="single_new_arrive">
                                        <div class="sna_img">
                                            <img loading="lazy" class="prd_img"
                                                 src="{{ $product->thumbnail_url }}"
                                                 alt="product"/>

                                        </div>
                                        <div class="sna_content">
                                            <a href="product-view.html">
                                                <h4>{{ $product->name }}</h4>
                                            </a>
                                            <div class="ratprice">
                                                <div class="price">
                                                    <span class="org_price"> TK {{ $product->price }}</span>
                                                    @if($product->offer_price > 0)
                                                        <span class="prev_price"> TK {{ $product->offer_price }}</span>
                                                    @endif
                                                </div>

                                            </div>
                                            <div class="product_adcart">
                                                <button class="default_btn">Buy Now</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="pagination_wrp d-flex align-items-center justify-content-center mt-4">
                            <div class="single_paginat active">1</div>
                            <div class="single_paginat">2</div>
                            <div class="single_paginat">3</div>
                            <div class="single_paginat">4</div>
                            <div class="single_paginat"><i class="las la-long-arrow-alt-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer_js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const categorySelect = document.getElementById('category_select');
            const subcategorySelect = document.getElementById('subcategory_select');

            categorySelect.addEventListener('change', function () {
                const categoryId = this.value;

                // Reset subcategory select
                subcategorySelect.innerHTML = '<option value="">Select Sub Category</option>';

                if (!categoryId) return;

                fetch(`/subcategories/${categoryId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(sub => {
                            const option = document.createElement('option');
                            option.value = sub.id;
                            option.textContent = sub.name;
                            subcategorySelect.appendChild(option);
                        });

                        // Refresh Nice Select after updating options
                        $(subcategorySelect).niceSelect('update');
                    })
                    .catch(error => console.error('Error fetching subcategories:', error));
            });
        });
    </script>
@endsection

