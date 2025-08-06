@extends('user.master')

@section('title')
    {{ config('app.name') }}
@endsection

@section('page_content')
    <!-- breadcrumbs -->
    <div class="container">
        <div class="breadcrumbs">
            <a href="{{ route('home') }}"><i class="las la-home"></i></a>
            <a href="{{ route('products.index') }}">Shop</a>
            <a href="#" class="active">{{ $product->name }}</a>
        </div>
    </div>

    <div class="product_view_wrap section_padding_b">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product_view_slider">
                        <div class="single_viewslider">
                            <a data-fancybox data-src="assets/images/slider-1.png" data-caption="Hello world">
                                <img loading="lazy" src="assets/images/slider-1.png" alt="product"/>
                            </a>
                        </div>
                        <div class="single_viewslider">
                            <img loading="lazy" src="assets/images/slider-2.png" alt="product"/>
                        </div>
                        <div class="single_viewslider">
                            <img loading="lazy" src="assets/images/slider-3.png" alt="product"/>
                        </div>
                        <div class="single_viewslider">
                            <img loading="lazy" src="assets/images/slider-4.png" alt="product"/>
                        </div>
                        <div class="single_viewslider">
                            <img loading="lazy" src="assets/images/slider-5.png" alt="product"/>
                        </div>
                        <div class="single_viewslider">
                            <img loading="lazy" src="assets/images/slider-1.png" alt="product"/>
                        </div>
                        <div class="single_viewslider">
                            <a href="javascript:;" data-fancybox-trigger="gallery" data-fancybox-index="0">
                                <img src="assets/images/slider-1.png"/>
                            </a>
                        </div>
                    </div>
                    <!-- sub thumb -->
                    <div class="product_viewslid_nav">
                        <div class="single_viewslid_nav" data-fancybox="gallery" data-src="assets/images/slider-1.png">
                            <img loading="lazy" src="assets/images/slider-1.png" alt="product"/>
                        </div>
                        <div class="single_viewslid_nav" data-fancybox="gallery" data-src="assets/images/slider-2.png">
                            <img loading="lazy" src="assets/images/slider-2.png" alt="product"/>
                        </div>
                        <div class="single_viewslid_nav" data-fancybox="gallery" data-src="assets/images/slider-3.png">
                            <img loading="lazy" src="assets/images/slider-3.png" alt="product"/>
                        </div>
                        <div class="single_viewslid_nav" data-fancybox="gallery" data-src="assets/images/slider-4.png">
                            <img loading="lazy" src="assets/images/slider-4.png" alt="product"/>
                        </div>
                        <div class="single_viewslid_nav" data-fancybox="gallery" data-src="assets/images/slider-5.png">
                            <img loading="lazy" src="assets/images/slider-5.png" alt="product"/>
                        </div>
                        <div class="single_viewslid_nav" data-fancybox="gallery" data-src="assets/images/slider-1.png">
                            <img loading="lazy" src="assets/images/slider-1.png" alt="product"/>
                        </div>
                        <div class="single_viewslid_nav" data-fancybox="gallery" data-src="assets/images/slider-2.png">
                            <img loading="lazy" src="assets/images/slider-1.png" alt="product"/>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product_info_wrapper">
                        <div class="product_base_info">
                            <h1>{{ $product->name }}</h1>

                            <div class="product_other_info">
                                <p>
                                    <span>Availability:</span>
                                    @if($product->stock > 0)
                                        <span class="text-green">In Stock</span>
                                    @else
                                        <span class="text-danger">Out of Stock</span>
                                    @endif
                                </p>

                                @if($product->brand)
                                    <p><span>Brand:</span>{{ $product->brand }}</p>
                                @endif
                                <p><span>Category:</span>{{ $product->category->name }}</p>
                                @if($product->sku)
                                    <p><span>SKU:</span>BE45VGRT</p>
                                @endif
                            </div>
                            <div class="price mt-3 mb-3 d-flex align-items-center">
                                @if ($product->offer_price && $product->offer_price < $product->price)
                                    <span class="prev_price ms-0">TK {{ number_format($product->price, 2) }}</span>
                                    <span class="org_price ms-2">TK {{ number_format($product->offer_price, 2) }}</span>
                                    <div class="disc_tag ms-3">
                                        -{{ round((($product->price - $product->offer_price) / $product->price) * 100) }}%
                                    </div>
                                @else
                                    <span class="org_price ms-0">TK {{ number_format($product->price, 2) }}</span>
                                @endif
                            </div>

                            <div class="pd_dtails">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim exercitationem quaerat
                                   excepturi labore blanditiis</p>
                            </div>
                            <div class="shop_filter border-bottom-0 pb-0">
                                <div class="size_selector mb-3">
                                    <h5>Size</h5>
                                    <div class="d-flex align-items-center">
                                        <div class="single_size_opt">
                                            <input type="radio" hidden name="size" class="size_inp" id="size-xs"/>
                                            <label for="size-xs">XS</label>
                                        </div>
                                        <div class="single_size_opt ms-2">
                                            <input type="radio" hidden name="size" class="size_inp" id="size-s"/>
                                            <label for="size-s">S</label>
                                        </div>
                                        <div class="single_size_opt ms-2">
                                            <input type="radio" hidden name="size" class="size_inp" id="size-m"
                                                   checked/>
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
                                <div class="size_selector color_selector">
                                    <h5>Color:</h5>
                                    <div class="d-flex align-items-center gap-1">
                                        <div class="single_size_opt">
                                            <input type="radio" hidden name="color" class="" id="color-purple"/>
                                            <label for="color-purple" class="" data-bs-toggle="tooltip"
                                                   title="Rose Red"><img src="/assets/images/slider-1.png" height="30px"
                                                                         width="30px" alt="Rose Red"></label>
                                        </div>
                                        <div class="single_size_opt ms-2">
                                            <input type="radio" hidden name="color" class="" id="color-red"/>
                                            <label for="color-red" class="" data-bs-toggle="tooltip" title="White"><img
                                                    src="/assets/images/slider-2.png" height="30px" width="30px"
                                                    alt="White"></label>
                                        </div>
                                        <div class="single_size_opt ms-2">
                                            <input type="radio" hidden name="color" class="" id="color-green"/>
                                            <label for="color-green" class="" data-bs-toggle="tooltip"
                                                   title="Black"><img src="/assets/images/slider-3.png" height="30px"
                                                                      width="30px" alt="Black"></label>
                                        </div>

                                        <div class="single_size_opt ms-2">
                                            <input type="radio" hidden name="color" class="" id="color-gray"/>
                                            <label for="color-gray" class="" data-bs-toggle="tooltip" title="Black"><img
                                                    src="/assets/images/slider-5.png" height="30px" width="30px"
                                                    alt="Black"></label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="cart_qnty ms-md-auto">
                                <p>Quantity</p>
                                <div class="d-flex align-items-center">
                                    <div class="cart_qnty_btn">
                                        <i class="las la-minus"></i>
                                    </div>
                                    <div class="cart_count">4</div>
                                    <div class="cart_qnty_btn">
                                        <i class="las la-plus"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product_buttons">
                            <a href="#" class="default_btn small rounded me-sm-3 me-2 px-4"><i
                                    class="icon-cart me-2"></i> Buy Now</a>

                        </div>
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
                    <div class="pbt_single_btn" data-target=".qna">Question & Answer</div>
                    <div class="pbt_single_btn" data-target=".review">Review (10)</div>
                </div>
                <div class="pb_tab_content info active">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="pbt_info_text">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Est nec condimentum lorem
                                   lacus. Lectus libero in vulputate quis massa nisl risus, libero ut. Morbi praesent
                                   ipsum sed morbi turpis sed. Amet sed fames fermentum, augue dignissim. Montes, velit
                                   velit eu gravida nibh in feugiat.</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Est nec condimentum lorem
                                   lacus. Lectus libero in vulputate quis massa nisl risus, libero ut. Morbi praesent
                                   ipsum sed morbi turpis sed. Amet sed fames fermentum, augue dignissim. Montes, velit
                                   velit eu gravida nibh in feugiat.</p>
                            </div>
                            <div class="pbt_info_table">
                                <div class="pbtit_single">
                                    <p class="specs">Color</p>
                                    <p class="spec_text">Black, Brown, Red</p>
                                </div>
                                <div class="pbtit_single">
                                    <p class="specs">Material</p>
                                    <p class="spec_text">Artificial Leather</p>
                                </div>
                                <div class="pbtit_single">
                                    <p class="specs">Weight</p>
                                    <p class="spec_text">0.5kg</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb_tab_content qna">
                    <h4>Question about this product (3)</h4>
                    <div class="pbqna_wrp">
                        <div class="single_pbqna">
                            <div class="pbqna_icon">
                                <i class="icon-user-line"></i>
                            </div>
                            <div class="pbqna_content">
                                <h5>Any discount?</h5>
                                <p>Dr.SaifuzZ. - 27 Oct 2021</p>
                            </div>
                        </div>
                        <div class="single_pbqna">
                            <div class="pbqna_icon">
                                <i class="las la-headset"></i>
                            </div>
                            <div class="pbqna_content">
                                <h5>There is no discount sir</h5>
                                <p>Store Admin - 27 Oct 2021</p>
                            </div>
                        </div>
                    </div>
                    <div class="pbqna_wrp">
                        <div class="single_pbqna">
                            <div class="pbqna_icon">
                                <i class="icon-user-line"></i>
                            </div>
                            <div class="pbqna_content">
                                <h5>Any discount?</h5>
                                <p>Dr.SaifuzZ. - 27 Oct 2021</p>
                            </div>
                        </div>
                        <div class="single_pbqna">
                            <div class="pbqna_icon">
                                <i class="las la-headset"></i>
                            </div>
                            <div class="pbqna_content">
                                <h5>There is no discount sir</h5>
                                <p>Store Admin - 27 Oct 2021</p>
                            </div>
                        </div>
                    </div>

                    <div class="pbqna_form">
                        <form action="#">
                            <textarea placeholder="Type your question"></textarea>
                            <button class="default_btn rounded">Ask Question</button>
                        </form>
                    </div>
                </div>
                <div class="pb_tab_content review">
                    <div class="review_rating">
                        <div class="total_rating">
                            <div class="trating_number">
                                <span class="avrage">4.9</span>
                                <span class="from">/5</span>
                            </div>
                            <div class="rating_star">
                                <span><i class="las la-star"></i></span>
                                <span><i class="las la-star"></i></span>
                                <span><i class="las la-star"></i></span>
                                <span><i class="las la-star"></i></span>
                                <span><i class="las la-star"></i></span>
                            </div>
                            <div class="trating_count">20 Ratings</div>
                        </div>
                        <div class="overall_rating">
                            <div class="single_ovrating d-flex align-items-center">
                                <div class="rating_star">
                                    <span><i class="las la-star"></i></span>
                                    <span><i class="las la-star"></i></span>
                                    <span><i class="las la-star"></i></span>
                                    <span><i class="las la-star"></i></span>
                                    <span><i class="las la-star"></i></span>
                                </div>
                                <div class="rating_pbox"><span style="width: 70%"></span></div>
                                <p class="rating_count">18</p>
                            </div>
                            <div class="single_ovrating d-flex align-items-center">
                                <div class="rating_star">
                                    <span><i class="las la-star"></i></span>
                                    <span><i class="las la-star"></i></span>
                                    <span><i class="las la-star"></i></span>
                                    <span><i class="las la-star"></i></span>
                                    <span><i class="lar la-star"></i></span>
                                </div>
                                <div class="rating_pbox"><span style="width: 20%"></span></div>
                                <p class="rating_count">2</p>
                            </div>
                            <div class="single_ovrating d-flex align-items-center">
                                <div class="rating_star">
                                    <span><i class="las la-star"></i></span>
                                    <span><i class="las la-star"></i></span>
                                    <span><i class="las la-star"></i></span>
                                    <span><i class="lar la-star"></i></span>
                                    <span><i class="lar la-star"></i></span>
                                </div>
                                <div class="rating_pbox"><span style="width: 0%"></span></div>
                                <p class="rating_count">0</p>
                            </div>
                            <div class="single_ovrating d-flex align-items-center">
                                <div class="rating_star">
                                    <span><i class="las la-star"></i></span>
                                    <span><i class="las la-star"></i></span>
                                    <span><i class="lar la-star"></i></span>
                                    <span><i class="lar la-star"></i></span>
                                    <span><i class="lar la-star"></i></span>
                                </div>
                                <div class="rating_pbox"><span style="width: 0%"></span></div>
                                <p class="rating_count">0</p>
                            </div>
                            <div class="single_ovrating d-flex align-items-center">
                                <div class="rating_star">
                                    <span><i class="las la-star"></i></span>
                                    <span><i class="lar la-star"></i></span>
                                    <span><i class="lar la-star"></i></span>
                                    <span><i class="lar la-star"></i></span>
                                    <span><i class="lar la-star"></i></span>
                                </div>
                                <div class="rating_pbox"><span style="width: 0%"></span></div>
                                <p class="rating_count">0</p>
                            </div>
                        </div>
                    </div>
                    <div class="review_header d-flex align-items-center justify-content-between">
                        <p class="m-0 text-semibold">Product Reviews</p>
                        <div class="review_filters">
                            <select class="nice_select">
                                <option value="">Sort by</option>
                                <option value="">Price low-high</option>
                                <option value="">Price high-low</option>
                            </select>
                        </div>
                    </div>
                    <div class="review_cont_wrap">
                        <div class="single_review_wrp">
                            <div class="review_avatar">
                                <img loading="lazy" src="assets/images/avatar.png" alt="user"/>
                            </div>
                            <div class="review_content">
                                <h5>by Sadat A.</h5>
                                <div class="rating_star">
                                    <span><i class="las la-star"></i></span>
                                    <span><i class="las la-star"></i></span>
                                    <span><i class="las la-star"></i></span>
                                    <span><i class="las la-star"></i></span>
                                    <span><i class="las la-star"></i></span>
                                </div>
                                <div class="review_date">30 Jul 2021</div>
                                <div class="review_body">
                                    <p>Lorem Ipsumin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem
                                       quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.
                                       Duis sed odio sit amet nibh vulputate</p>
                                    <div class="review_imgs">
                                        <img loading="lazy" src="assets/images/product.png" alt="review"/>
                                        <img loading="lazy" src="assets/images/product.png" alt="review"/>
                                        <img loading="lazy" src="assets/images/product.png" alt="review"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single_review_wrp border-bottom-0 mb-0 pb-0">
                            <div class="review_avatar">
                                <img loading="lazy" src="assets/images/avatar.png" alt="user"/>
                            </div>
                            <div class="review_content">
                                <h5>by Sadat A.</h5>
                                <div class="rating_star">
                                    <span><i class="las la-star"></i></span>
                                    <span><i class="las la-star"></i></span>
                                    <span><i class="las la-star"></i></span>
                                    <span><i class="las la-star"></i></span>
                                    <span><i class="lar la-star"></i></span>
                                </div>
                                <div class="review_date">30 Jul 2021</div>
                                <div class="review_body">
                                    <p>Lorem Ipsumin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem
                                       quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.
                                       Duis sed odio sit amet nibh vulputate</p>
                                    <div class="review_imgs">
                                        <img loading="lazy" src="assets/images/product.png" alt="review"/>
                                        <img loading="lazy" src="assets/images/product.png" alt="review"/>
                                        <img loading="lazy" src="assets/images/product.png" alt="review"/>
                                    </div>
                                </div>
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
            <div class="d-flex align-items-start justify-content-between">
                <h2 class="section_title_2">Related products</h2>
            </div>
            <div class="row gy-4">
                <div class="col-lg-3 col-sm-6">
                    <div class="single_new_arrive">
                        <div class="sna_img">
                            <a href="product-view.html">
                                <img loading="lazy" class="prd_img" src="assets/images/laptop-3.png" alt="product"/>
                            </a>
                            <span class="tag">Hot</span>

                        </div>
                        <div class="sna_content">
                            <a href="product-view.html">
                                <h4>HP Pavilion 15</h4>
                            </a>
                            <div class="ratprice">
                                <div class="price">
                                    <span class="org_price">TK 45.00</span>
                                    <span class="prev_price">TK 55.45</span>
                                </div>

                            </div>
                            <div class="product_adcart">
                                <button class="default_btn">Buy Now</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single_new_arrive">
                        <div class="sna_img">
                            <a href="product-view.html">
                                <img loading="lazy" class="prd_img" src="assets/images/shoes-1.png" alt="product"/>
                            </a>
                        </div>
                        <div class="sna_content">
                            <a href="product-view.html">
                                <h4>Red Casual Shoes</h4>
                            </a>
                            <div class="ratprice">
                                <div class="price">
                                    <span class="org_price">TK 45.00</span>
                                    <span class="prev_price">TK 55.45</span>
                                </div>

                            </div>
                            <div class="product_adcart">
                                <button class="default_btn">Buy Now</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single_new_arrive">
                        <div class="sna_img">
                            <a href="product-view.html">
                                <img loading="lazy" class="prd_img" src="assets/images/headphone-3.png" alt="product"/>
                            </a>
                        </div>
                        <div class="sna_content">
                            <a href="product-view.html">
                                <h4>COWIN E7 Active</h4>
                            </a>
                            <div class="ratprice">
                                <div class="price">
                                    <span class="org_price">TK 45.00</span>
                                    <span class="prev_price">TK 55.45</span>
                                </div>
                            </div>
                            <div class="product_adcart">
                                <button class="default_btn">Buy Now</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single_new_arrive">
                        <div class="sna_img">
                            <a href="product-view.html">
                                <img loading="lazy" class="prd_img" src="assets/images/phone-1.png" alt="product"/>
                            </a>

                        </div>
                        <div class="sna_content">
                            <a href="product-view.html">
                                <h4>Xiaomi Note 7 Pro</h4>
                            </a>
                            <div class="ratprice">
                                <div class="price">
                                    <span class="org_price">TK 45.00</span>
                                    <span class="prev_price">TK 55.45</span>
                                </div>
                            </div>
                            <div class="product_adcart">
                                <button class="default_btn">Buy Now</button>
                            </div>
                        </div>
                    </div>
                </div>
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
        Fancybox.bind('[data-fancybox="gallery"]', {})
    </script>
@endsection
