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
                        @if($product->productImages->count() > 0)
                            @foreach($product->productImages as $img)
                                <div class="single_viewslider">
                                    <a data-fancybox data-src="{{ url()->asset('assets/images/slider-1.png') }}"
                                       data-caption="Hello world">
                                        <img loading="lazy" src="{{Storage::url( $img->url) }}"
                                             alt="{{ $product->name }}">
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <div class="single_viewslider">
                                <a data-fancybox data-src="{{ url()->asset('assets/images/slider-1.png') }}"
                                   data-caption="Hello world">
                                    <img loading="lazy" src="{{ asset('assets/images/no-image.png') }}">
                                </a>
                            </div>
                        @endif
                    </div>
                    <!-- sub thumb -->
                    <div class="product_viewslid_nav">
                        @if($product->productImages->count() > 0)
                            @foreach($product->productImages as $img)
                                <div class="single_viewslid_nav" data-fancybox="gallery"
                                     data-src="assets/images/slider-1.png">
                                    <img loading="lazy" src="{{Storage::url( $img->url) }}" alt="{{ $product->name }}">
                                </div>
                            @endforeach
                        @endif
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
                            @if($product->stocks->count() > 0 )
                                <div class="shop_filter border-bottom-0 pb-0">
                                    <div class="size_selector mb-3">
                                        <h5>{{ $product->stocks?->first()->type->name }}</h5>
                                        <div class="d-flex align-items-center">
                                            @foreach($product->stocks as $stock)
                                                <div class="single_size_opt me-2">
                                                    <input type="radio" hidden name="stock_id" class="size_inp"
                                                           id="stock-{{ $stock->id }}"
                                                           value="{{ $stock->id }}"
                                                        @checked($loop->first)>
                                                    <label for="stock-{{ $stock->id }}">{{ $stock->value }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div id="size-error" class="text-danger mt-1"></div>
                                    </div>
                                </div>
                            @endif
                            <div class="cart_qnty ms-md-auto">
                                <p>Quantity</p>
                                <div class="input-group" style="width: 120px;">
                                    <button class="btn btn-outline-secondary minus" type="button">-</button>
                                    <input type="number" name="quantity" class="form-control text-center" value="1"
                                           min="1">
                                    <button class="btn btn-outline-secondary plus" type="button">+</button>
                                </div>

                            </div>
                        </div>

                        @if($product->stocks()->sum('stock')>0)
                            <div class="product_buttons">
                                <a href="#" id="buy-now"
                                   data-url="{{ route('carts.buy-now') }}"
                                   data-product-id="{{ $product->id }}"
                                   class="default_btn small rounded me-sm-3 me-2 px-4">
                                    <i class="icon-cart me-2"></i> Buy Now
                                </a>

                                <a href="#" id="add-to-cart"
                                   data-url="{{ route('products.add-to-cart') }}"
                                   data-product-id="{{ $product->id }}"
                                   class="default_btn small rounded me-sm-3 me-2 px-4">
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
                <div class="pv_tab_buttons spec_text">
                    <div class="pbt_single_btn active" data-target=".info">Product Info</div>
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
            </div>
        </div>
    </div>

    <!-- new arrive -->
    <section class="new_arrive section_padding_b">
        <div class="container">
            <div class="d-flex align-items-start justify-content-between border-bottom">
                <h2 class="section_title_2">Related products</h2>
            </div>
            <div class="row gy-4 mt-3">
                @foreach($product->category->products()->where('id', '!=', $product->id)->inRandomOrder()->take(4)->get() as $product)
                    <div class="col-lg-3 col-sm-6">
                        <a href="{{ route('products.show', $product) }}">
                            <div class="single_new_arrive">
                                <div class="sna_img">
                                    <img loading="lazy" class="prd_img"
                                         src="{{ $product->thumbnail?->url ? Storage::url($product->thumbnail->url) : asset('assets/images/no-image.png') }}"
                                         alt="product"/>

                                </div>
                                <div class="sna_content">
                                    <h4>{{ $product->name }}</h4>

                                    <div class="ratprice">
                                        <div class="price">
                                            @if(($product->offer_price ?? 0) > 0)
                                                <span class="org_price">TK {{ $product->offer_price }}</span>
                                                <span class="org_price"><del>{{ $product->price }}</del></span>
                                            @else
                                                <span class="org_price">TK {{ $product->price }}</span>
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

            // Ensure quantity input never goes below 1 when user leaves the field
            const qtyInput = document.querySelector("input[name='quantity']");

            qtyInput.addEventListener("blur", function () {
                if (parseInt(qtyInput.value) < 1 || isNaN(qtyInput.value)) {
                    qtyInput.value = 1;
                }
            });

            document.getElementById("add-to-cart").addEventListener("click", function (e) {
                e.preventDefault();

                const url = this.getAttribute("data-url");
                const productId = this.getAttribute("data-product-id");
                const stockSelected = document.querySelector("input[name='stock_id']:checked");
                const quantity = parseInt(document.querySelector("input[name='quantity']").value);
                const errorBox = document.getElementById("size-error");

                // Check if size is selected
                if (!stockSelected) {
                    errorBox.textContent = "Please select a size.";
                    return;
                }

                errorBox.textContent = ""; // clear previous errors

                // Create form dynamically and submit
                const form = document.createElement("form");
                form.method = "POST";
                form.action = url;

                // CSRF token
                const csrfInput = document.createElement("input");
                csrfInput.type = "hidden";
                csrfInput.name = "_token";
                csrfInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
                form.appendChild(csrfInput);

                // Product ID
                const productInput = document.createElement("input");
                productInput.type = "hidden";
                productInput.name = "product_id";
                productInput.value = productId;
                form.appendChild(productInput);

                // Stock ID
                const stockInput = document.createElement("input");
                stockInput.type = "hidden";
                stockInput.name = "stock_id";
                stockInput.value = stockSelected.value;
                form.appendChild(stockInput);

                // Quantity
                const qtyInput = document.createElement("input");
                qtyInput.type = "hidden";
                qtyInput.name = "quantity";
                qtyInput.value = quantity;
                form.appendChild(qtyInput);

                document.body.appendChild(form);
                form.submit();
            });

            document.getElementById("buy-now").addEventListener("click", function (e) {
                e.preventDefault();

                const url = this.getAttribute("data-url");
                const productId = this.getAttribute("data-product-id");
                const stockSelected = document.querySelector("input[name='stock_id']:checked");
                const quantity = parseInt(document.querySelector("input[name='quantity']").value);
                const errorBox = document.getElementById("size-error");

                if (!stockSelected) {
                    errorBox.textContent = "Please select a size.";
                    return;
                }
                errorBox.textContent = "";

                const form = document.createElement("form");
                form.method = "POST";
                form.action = url;

                const csrf = document.createElement("input");
                csrf.type = "hidden";
                csrf.name = "_token";
                csrf.value = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
                form.appendChild(csrf);

                const pid = document.createElement("input");
                pid.type = "hidden";
                pid.name = "product_id";
                pid.value = productId;
                form.appendChild(pid);

                const sid = document.createElement("input");
                sid.type = "hidden";
                sid.name = "stock_id";
                sid.value = stockSelected.value;
                form.appendChild(sid);

                const qty = document.createElement("input");
                qty.type = "hidden";
                qty.name = "quantity";
                qty.value = quantity;
                form.appendChild(qty);

                document.body.appendChild(form);
                form.submit();
            });


        });
    </script>
@endsection
