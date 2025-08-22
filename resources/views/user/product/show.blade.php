@php use App\Enums\StockTypeEnum;use Illuminate\Support\Facades\Storage; @endphp
@extends('user.master')

@section('title')
    {{ config('app.name') }}
@endsection

@section('external_css')
    <style>
        /* Chrome, Safari, Edge, Opera  --- remove type = number arrow */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        .pbt_info_text img {
            max-width: 100%;
            height: auto;
            display: block; /* keeps images starting from left */
        }

        .pbt_info_text table {
            width: 100%; /* table fills container but stays left-aligned */
            border-collapse: collapse;
        }



    </style>
@endsection

@section('page_content')
    <!-- breadcrumbs -->
    <div class="container">
        <div class="breadcrumbs">
            <a href="{{ route('home') }}"><i class="las la-home"></i></a>
            <a href="{{ route('products.index') }}">Shop</a>
            <a href="{{ route('products.index', ['category_id' => $product->category->id]) }}">{{ $product->category->name }}</a>
            @if($product->subCategory)
                <a href="{{ route('products.index', [
                        'category_id' => $product->category->id,
                        'sub_category_id' => $product->subCategory->id
                        ]) }}">
                    {{ $product->subCategory->name }}
                </a>
            @endif
            <a href="#" class="active">{{ $product->name }}</a>
        </div>
    </div>

    <div class="product_view_wrap section_padding_b">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product_view_slider">
                        @foreach($product->productImages as $img)
                            <div class="single_viewslider">
                                <a data-fancybox data-src="{{ url()->asset('assets/images/slider-1.png') }}"
                                   data-caption="Hello world">
                                    <img loading="lazy" src="{{Storage::url( $img->url) }}" alt="{{ $product->name }}">
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <!-- sub thumb -->
                    <div class="product_viewslid_nav">
                        @foreach($product->productImages as $img)
                            <div class="single_viewslid_nav" data-fancybox="gallery"
                                 data-src="assets/images/slider-1.png">
                                <img loading="lazy" src="{{Storage::url( $img->url) }}" alt="{{ $product->name }}">
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="product_info_wrapper">
                        <div class="product_base_info">
                            <h1>{{ $product->name }}</h1>

                            <div class="product_other_info">
                                <p>
                                    <span>Availability:</span>
                                    @if($product->stocks()->sum('stock')>0)
                                        <span class="text-green">In Stock</span>
                                    @else
                                        <span class="text-red">Out Of Stock</span>
                                    @endif
                                </p>
                                @if($product->brand)
                                    <p><span>Brand:</span>{{ $product->brand }}</p>
                                @endif
                                <p><span>Category:</span>{{ $product->category->name }}</p>
                                @if($product->subCategory)
                                    <p>
                                        <span>Sub Category:</span>{{ $product->subCategory->name }}
                                    </p>
                                @endif

                                @if($product->sku)
                                    <p><span>SKU:</span>{{ $product->sku }}</p>
                                @endif
                            </div>
                            <div class="price mt-3 mb-3 d-flex align-items-center">
                                @if($product->offer_price > 0)
                                    <span class="prev_price ms-0">TK {{ $product->price }}</span>
                                    <span class="org_price ms-2">TK {{ $product->offer_price }}</span>
                                    <div class="disc_tag ms-3">-{{ $product->discountPercentage() }}%</div>
                                @else
                                    <span class="org_price ms-0">TK {{ $product->price }}</span>
                                @endif
                            </div>
                            <div class="shop_filter border-bottom-0 pb-0">
                                <div class="size_selector mb-3">
                                    <h5>{{ $product->stocks->first()->type->name }}</h5>
                                    <div class="d-flex align-items-center">
                                        @foreach($product->stocks as $stock)
                                            <div class="single_size_opt me-2">
                                                <input type="radio" hidden name="size" class="size_inp"
                                                       id="{{ $stock->value }}"/>
                                                <label for="{{ $stock->value }}">{{ $stock->value }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="cart_qnty ms-md-auto">
                                <p>Quantity</p>
                                <div class="input-group" style="width: 120px;">
                                    <button class="btn btn-outline-secondary minus" type="button">-</button>
                                    <input type="number" name="quantity" class="form-control text-center" value="1" min="1">
                                    <button class="btn btn-outline-secondary plus" type="button">+</button>
                                </div>

                            </div>
                        </div>

                        @if($product->stocks()->sum('stock')>0)
                        <div class="product_buttons">
                            <a href="#" class="default_btn small rounded me-sm-3 me-2 px-4">
                                <i class="icon-cart me-2"></i> Buy Now
                            </a>

                            <a href="#" class="default_btn small rounded me-sm-3 me-2 px-4">
                                <i class="icon-card me-2"></i> Add to Cart
                            </a>
                        </div>
                        @else
                            <div class="product_buttons">
                                <p class="default_btn small rounded me-sm-3 me-2 px-4">
                                    <i class="icon-warning me-2"></i> Out of Stock
                                </p>
                            </div>
                        @endif
                        <div class="share_icons footer_icon d-flex">
                            <a href="#"><i class="lab la-facebook-f"></i></a>
                            <a href="#"><i class="lab la-twitter"></i></a>
                            <a href="#"><i class="lab la-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product_view_tabs mt-4">
                <div class="pv_tab_buttons" class="spec_text">
                    <div class="pbt_single_btn active" data-target=".info">Product Info</div>
                    {{--                    <div class="pbt_single_btn" data-target=".qna">Question & Answer</div>--}}
                    {{--                    <div class="pbt_single_btn" data-target=".review">Review (10)</div>--}}
                </div>
                <div class="pb_tab_content info active">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="pbt_info_text">
                                {!! $product->description !!}
                            </div>
                        </div>
                    </div>
                </div>


                {{--                <div class="pb_tab_content qna">--}}
                {{--                    <h4>Question about this product (3)</h4>--}}
                {{--                    <div class="pbqna_wrp">--}}
                {{--                        <div class="single_pbqna">--}}
                {{--                            <div class="pbqna_icon">--}}
                {{--                                <i class="icon-user-line"></i>--}}
                {{--                            </div>--}}
                {{--                            <div class="pbqna_content">--}}
                {{--                                <h5>Any discount?</h5>--}}
                {{--                                <p>Dr.SaifuzZ. - 27 Oct 2021</p>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <div class="single_pbqna">--}}
                {{--                            <div class="pbqna_icon">--}}
                {{--                                <i class="las la-headset"></i>--}}
                {{--                            </div>--}}
                {{--                            <div class="pbqna_content">--}}
                {{--                                <h5>There is no discount sir</h5>--}}
                {{--                                <p>Store Admin - 27 Oct 2021</p>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                    <div class="pbqna_wrp">--}}
                {{--                        <div class="single_pbqna">--}}
                {{--                            <div class="pbqna_icon">--}}
                {{--                                <i class="icon-user-line"></i>--}}
                {{--                            </div>--}}
                {{--                            <div class="pbqna_content">--}}
                {{--                                <h5>Any discount?</h5>--}}
                {{--                                <p>Dr.SaifuzZ. - 27 Oct 2021</p>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <div class="single_pbqna">--}}
                {{--                            <div class="pbqna_icon">--}}
                {{--                                <i class="las la-headset"></i>--}}
                {{--                            </div>--}}
                {{--                            <div class="pbqna_content">--}}
                {{--                                <h5>There is no discount sir</h5>--}}
                {{--                                <p>Store Admin - 27 Oct 2021</p>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}

                {{--                    <div class="pbqna_form">--}}
                {{--                        <form action="#">--}}
                {{--                            <textarea placeholder="Type your question"></textarea>--}}
                {{--                            <button class="default_btn rounded">Ask Question</button>--}}
                {{--                        </form>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                {{--                <div class="pb_tab_content review">--}}
                {{--                    <div class="review_rating">--}}
                {{--                        <div class="total_rating">--}}
                {{--                            <div class="trating_number">--}}
                {{--                                <span class="avrage">4.9</span>--}}
                {{--                                <span class="from">/5</span>--}}
                {{--                            </div>--}}
                {{--                            <div class="rating_star">--}}
                {{--                                <span><i class="las la-star"></i></span>--}}
                {{--                                <span><i class="las la-star"></i></span>--}}
                {{--                                <span><i class="las la-star"></i></span>--}}
                {{--                                <span><i class="las la-star"></i></span>--}}
                {{--                                <span><i class="las la-star"></i></span>--}}
                {{--                            </div>--}}
                {{--                            <div class="trating_count">20 Ratings</div>--}}
                {{--                        </div>--}}
                {{--                        <div class="overall_rating">--}}
                {{--                            <div class="single_ovrating d-flex align-items-center">--}}
                {{--                                <div class="rating_star">--}}
                {{--                                    <span><i class="las la-star"></i></span>--}}
                {{--                                    <span><i class="las la-star"></i></span>--}}
                {{--                                    <span><i class="las la-star"></i></span>--}}
                {{--                                    <span><i class="las la-star"></i></span>--}}
                {{--                                    <span><i class="las la-star"></i></span>--}}
                {{--                                </div>--}}
                {{--                                <div class="rating_pbox"><span style="width: 70%"></span></div>--}}
                {{--                                <p class="rating_count">18</p>--}}
                {{--                            </div>--}}
                {{--                            <div class="single_ovrating d-flex align-items-center">--}}
                {{--                                <div class="rating_star">--}}
                {{--                                    <span><i class="las la-star"></i></span>--}}
                {{--                                    <span><i class="las la-star"></i></span>--}}
                {{--                                    <span><i class="las la-star"></i></span>--}}
                {{--                                    <span><i class="las la-star"></i></span>--}}
                {{--                                    <span><i class="lar la-star"></i></span>--}}
                {{--                                </div>--}}
                {{--                                <div class="rating_pbox"><span style="width: 20%"></span></div>--}}
                {{--                                <p class="rating_count">2</p>--}}
                {{--                            </div>--}}
                {{--                            <div class="single_ovrating d-flex align-items-center">--}}
                {{--                                <div class="rating_star">--}}
                {{--                                    <span><i class="las la-star"></i></span>--}}
                {{--                                    <span><i class="las la-star"></i></span>--}}
                {{--                                    <span><i class="las la-star"></i></span>--}}
                {{--                                    <span><i class="lar la-star"></i></span>--}}
                {{--                                    <span><i class="lar la-star"></i></span>--}}
                {{--                                </div>--}}
                {{--                                <div class="rating_pbox"><span style="width: 0%"></span></div>--}}
                {{--                                <p class="rating_count">0</p>--}}
                {{--                            </div>--}}
                {{--                            <div class="single_ovrating d-flex align-items-center">--}}
                {{--                                <div class="rating_star">--}}
                {{--                                    <span><i class="las la-star"></i></span>--}}
                {{--                                    <span><i class="las la-star"></i></span>--}}
                {{--                                    <span><i class="lar la-star"></i></span>--}}
                {{--                                    <span><i class="lar la-star"></i></span>--}}
                {{--                                    <span><i class="lar la-star"></i></span>--}}
                {{--                                </div>--}}
                {{--                                <div class="rating_pbox"><span style="width: 0%"></span></div>--}}
                {{--                                <p class="rating_count">0</p>--}}
                {{--                            </div>--}}
                {{--                            <div class="single_ovrating d-flex align-items-center">--}}
                {{--                                <div class="rating_star">--}}
                {{--                                    <span><i class="las la-star"></i></span>--}}
                {{--                                    <span><i class="lar la-star"></i></span>--}}
                {{--                                    <span><i class="lar la-star"></i></span>--}}
                {{--                                    <span><i class="lar la-star"></i></span>--}}
                {{--                                    <span><i class="lar la-star"></i></span>--}}
                {{--                                </div>--}}
                {{--                                <div class="rating_pbox"><span style="width: 0%"></span></div>--}}
                {{--                                <p class="rating_count">0</p>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                    <div class="review_header d-flex align-items-center justify-content-between">--}}
                {{--                        <p class="m-0 text-semibold">Product Reviews</p>--}}
                {{--                        <div class="review_filters">--}}
                {{--                            <select class="nice_select">--}}
                {{--                                <option value="">Sort by</option>--}}
                {{--                                <option value="">Price low-high</option>--}}
                {{--                                <option value="">Price high-low</option>--}}
                {{--                            </select>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                    <div class="review_cont_wrap">--}}
                {{--                        <div class="single_review_wrp">--}}
                {{--                            <div class="review_avatar">--}}
                {{--                                <img loading="lazy" src="assets/images/avatar.png" alt="user"/>--}}
                {{--                            </div>--}}
                {{--                            <div class="review_content">--}}
                {{--                                <h5>by Sadat A.</h5>--}}
                {{--                                <div class="rating_star">--}}
                {{--                                    <span><i class="las la-star"></i></span>--}}
                {{--                                    <span><i class="las la-star"></i></span>--}}
                {{--                                    <span><i class="las la-star"></i></span>--}}
                {{--                                    <span><i class="las la-star"></i></span>--}}
                {{--                                    <span><i class="las la-star"></i></span>--}}
                {{--                                </div>--}}
                {{--                                <div class="review_date">30 Jul 2021</div>--}}
                {{--                                <div class="review_body">--}}
                {{--                                    <p>Lorem Ipsumin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem--}}
                {{--                                       quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.--}}
                {{--                                       Duis sed odio sit amet nibh vulputate</p>--}}
                {{--                                    <div class="review_imgs">--}}
                {{--                                        <img loading="lazy" src="assets/images/product.png" alt="review"/>--}}
                {{--                                        <img loading="lazy" src="assets/images/product.png" alt="review"/>--}}
                {{--                                        <img loading="lazy" src="assets/images/product.png" alt="review"/>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <div class="single_review_wrp border-bottom-0 mb-0 pb-0">--}}
                {{--                            <div class="review_avatar">--}}
                {{--                                <img loading="lazy" src="assets/images/avatar.png" alt="user"/>--}}
                {{--                            </div>--}}
                {{--                            <div class="review_content">--}}
                {{--                                <h5>by Sadat A.</h5>--}}
                {{--                                <div class="rating_star">--}}
                {{--                                    <span><i class="las la-star"></i></span>--}}
                {{--                                    <span><i class="las la-star"></i></span>--}}
                {{--                                    <span><i class="las la-star"></i></span>--}}
                {{--                                    <span><i class="las la-star"></i></span>--}}
                {{--                                    <span><i class="lar la-star"></i></span>--}}
                {{--                                </div>--}}
                {{--                                <div class="review_date">30 Jul 2021</div>--}}
                {{--                                <div class="review_body">--}}
                {{--                                    <p>Lorem Ipsumin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem--}}
                {{--                                       quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.--}}
                {{--                                       Duis sed odio sit amet nibh vulputate</p>--}}
                {{--                                    <div class="review_imgs">--}}
                {{--                                        <img loading="lazy" src="assets/images/product.png" alt="review"/>--}}
                {{--                                        <img loading="lazy" src="assets/images/product.png" alt="review"/>--}}
                {{--                                        <img loading="lazy" src="assets/images/product.png" alt="review"/>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
        </div>
    </div>

    <!-- new arrive -->
    <section class="new_arrive section_padding_b">
        <div class="container">
            <div class="d-flex align-items-start justify-content-between">
                <h2 class="section_title_2">Related products</h2>
            </div>
            <div class="row gy-4">
                @foreach($product->category->products()->where('id', '!=', $product->id)->inRandomOrder()->take(4)->get() as $product)
                    <div class="col-lg-3 col-sm-6">
                        <a href="{{ route('products.show', $product) }}">
                            <div class="single_new_arrive">
                                <div class="sna_img">
                                    <img loading="lazy" class="prd_img"
                                         src="{{ Storage::url($product->thumbnail->url) }}" alt="product"/>

                                </div>
                                <div class="sna_content">
                                    <h4>{{ $product->name }}</h4>

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
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
@endsection

@section('footer_js')
    <script src="{{ url()->asset('assets/js/fancybox.umd.js') }}"></script>
    <script src="{{ url()->asset('assets/js/fontawesome.js') }}"></script>
    <script src="{{ url()->asset('assets/js/app.js') }}"></script>
    <script src="{{ url()->asset('assets/js/main.js') }}"></script>

    <script>

        document.addEventListener("DOMContentLoaded", () => {
            // Select all cart wrappers, in case you have more in future
            document.querySelectorAll('.input-group').forEach(wrapper => {
                const input = wrapper.querySelector('input');
                const minusBtn = wrapper.querySelector('.minus');
                const plusBtn = wrapper.querySelector('.plus');

                minusBtn.addEventListener('click', () => {
                    if (input.value > 1) input.value = parseInt(input.value) - 1;
                });

                plusBtn.addEventListener('click', () => {
                    input.value = parseInt(input.value) + 1;
                });
            });


        });
    </script>
@endsection
