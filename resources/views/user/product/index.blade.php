@extends('user.master')

@section('title')
    {{ config('app.name') }}
@endsection

@section('page_content')
    <!-- breadcrumbs -->
    <div class="container">
        <div class="breadcrumbs">
            <a href="index-1.html"><i class="las la-home"></i></a>
            <a href="#" class="active">Shop</a>
        </div>
    </div>

    <div class="shop_wrap section_padding_b">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 position-relative">
                    <div class="filter_box py-3 px-3 shadow_sm">
                        <div class="close_filter d-block d-lg-none"><i class="las la-times"></i></div>
                        <div class="shop_filter d-block d-sm-none">
                            <h4 class="filter_title">Sort by</h4>
                            <div class="sorting_filter mb-2">
                                <select class="nice_select">
                                    <option value="">Default sorting</option>
                                    <option value="">Price low-high</option>
                                    <option value="">Price high-low</option>
                                </select>
                            </div>
                        </div>

                        <div class="shop_filter">
                            <h4 class="filter_title">Categories</h4>
                            <div class="filter_list">
                                <div class="custom_check d-flex align-items-center">
                                    <input type="checkbox" class="check_inp" hidden id="cat-women" checked/>
                                    <label for="cat-women">Women</label>
                                    <p class="mb-0 ms-auto">(16)</p>
                                </div>
                                <div class="custom_check d-flex align-items-center">
                                    <input type="checkbox" class="check_inp" hidden id="cat-men"/>
                                    <label for="cat-men">Men</label>
                                    <p class="mb-0 ms-auto">(9)</p>
                                </div>
                                <div class="custom_check d-flex align-items-center">
                                    <input type="checkbox" class="check_inp" hidden id="cat-shoes"/>
                                    <label for="cat-shoes">Shoes</label>
                                    <p class="mb-0 ms-auto">(19)</p>
                                </div>
                                <div class="custom_check d-flex align-items-center">
                                    <input type="checkbox" class="check_inp" hidden id="cat-computer"/>
                                    <label for="cat-computer">Computer</label>
                                    <p class="mb-0 ms-auto">(35)</p>
                                </div>
                            </div>
                        </div>
                        <div class="shop_filter">
                            <h4 class="filter_title">Brands</h4>
                            <div class="filter_list">
                                <div class="custom_check d-flex align-items-center">
                                    <input type="checkbox" class="check_inp" hidden id="bnd-adidas" checked/>
                                    <label for="bnd-adidas">Adidas</label>
                                </div>
                                <div class="custom_check d-flex align-items-center">
                                    <input type="checkbox" class="check_inp" hidden id="bnd-nike"/>
                                    <label for="bnd-nike">Nike</label>
                                </div>
                                <div class="custom_check d-flex align-items-center">
                                    <input type="checkbox" class="check_inp" hidden id="bnd-easy"/>
                                    <label for="bnd-easy">Easy</label>
                                </div>
                                <div class="custom_check d-flex align-items-center">
                                    <input type="checkbox" class="check_inp" hidden id="bnd-arong"/>
                                    <label for="bnd-arong">Arong</label>
                                </div>
                            </div>
                        </div>
                        <div class="shop_filter">
                            <h4 class="filter_title">Price</h4>
                            <div class="price-range-slider">
                                <div id="slider-range" class="range-bar"></div>
                                <p class="range-value">
                                    <input type="text" id="amount" readonly/>
                                </p>
                            </div>
                        </div>
                        <div class="shop_filter">
                            <h4 class="filter_title">Size</h4>
                            <div class="size_selector d-flex">
                                <div class="single_size_opt">
                                    <input type="radio" hidden name="size" class="size_inp" id="size-xs"/>
                                    <label for="size-xs">XS</label>
                                </div>
                                <div class="single_size_opt ms-2">
                                    <input type="radio" hidden name="size" class="size_inp" id="size-s"/>
                                    <label for="size-s">S</label>
                                </div>
                                <div class="single_size_opt ms-2">
                                    <input type="radio" hidden name="size" class="size_inp" id="size-m" checked/>
                                    <label for="size-m">M</label>
                                </div>
                                <div class="single_size_opt ms-2">
                                    <input type="radio" hidden name="size" class="size_inp" id="size-l"/>
                                    <label for="size-l">L</label>
                                </div>
                                <div class="single_size_opt ms-2">
                                    <input type="radio" hidden name="size" class="size_inp" id="size-xl"/>
                                    <label for="size-xl">XL</label>
                                </div>
                            </div>
                        </div>
                        <div class="shop_filter border-bottom-0 pb-0 mb-0">
                            <h4 class="filter_title">Color</h4>
                            <div class="size_selector color_selector d-flex align-items-center">
                                <div class="single_size_opt">
                                    <input type="radio" hidden name="color" class="size_inp" id="color-purple"/>
                                    <label for="color-purple" class="bg-color" data-bs-toggle="tooltip"
                                           title="Rose Red"></label>
                                </div>
                                <div class="single_size_opt ms-2">
                                    <input type="radio" hidden name="color" class="size_inp" id="color-red"/>
                                    <label for="color-red" class="bg-white" data-bs-toggle="tooltip"
                                           title="White"></label>
                                </div>
                                <div class="single_size_opt ms-2">
                                    <input type="radio" hidden name="color" class="size_inp" id="color-green" checked/>
                                    <label for="color-green" class="bg-dark" data-bs-toggle="tooltip"
                                           title="Black"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8">
                    <div class="d-flex align-items-center">
                        <div class="d-block d-lg-none">
                            <button class="default_btn py-2 me-3 rounded" id="mobile_filter_btn">Filter</button>
                        </div>
                        <div class="sorting_filter d-none d-sm-block">
                            <select class="nice_select">
                                <option value="">Default sorting</option>
                                <option value="">Price low-high</option>
                                <option value="">Price high-low</option>
                            </select>
                        </div>
                        <div class="view_filter d-flex align-items-center ms-auto">
                            <a href="shop-grid.html">
                                <div class="view_icon active"><i class="icon-grid"></i></div>
                            </a>
                            <!-- <a href="shop-list.html">
                                    <div class="view_icon"><i class="las la-list-ul"></i></div>
                                </a> -->
                        </div>
                    </div>
                    <div class="shop_products">
                        <div class="row gy-4">
                            @foreach ($products as $product)
                                <div class="col-md-4 col-sm-6">
                                    <div class="single_new_arrive">
                                        <div class="sna_img">
                                            <img loading="lazy" class="prd_img" src="{{ storage_url($product->thumbnail) }}" alt="product" />
                                        </div>
                                        <div class="sna_content">
                                            <a href="{{ route('products.show', $product->id) }}">
                                                <h4>{{ $product->name }}</h4>
                                            </a>
                                            <div class="ratprice">
                                                <div class="price">
                                                    @if($product->offer_price && $product->offer_price < $product->price)
                                                        <span class="org_price">TK {{ number_format($product->offer_price) }}</span>
                                                        <span class="prev_price">TK {{ number_format($product->price) }}</span>
                                                    @else
                                                        <span class="org_price">TK {{ number_format($product->price) }}</span>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="product_adcart">
                                                <a href="{{ route('products.show', $product->id) }}" class="default_btn">Buy Now</a>
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
