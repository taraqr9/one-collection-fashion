@extends('user.master')

@section('title')
    {{ config('app.name') }}
@endsection

@section('page_content')
    <div class="container-lg home_2_hero_wrp home-3">
        <div class="row">
            <div class="col-xl-9 col-sm-12">
                <div class="home_2_hero">
                    <div class="container">
                        <div class="hero_slider_active">
                            <div class="single_hero_slider bg-3">
                                <div class="container">
                                    <div class="row align-items-center">
                                        <div class="col-lg-12 col-sm-12">
                                            <!-- something write here -->
                                            <div class="hero_img">
                                                <img loading="lazy"
                                                     src="{{ url()->asset('user/assets/images/men-1.png') }}"
                                                     alt="shirt"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single_hero_slider bg-2">
                                <div class="container">
                                    <div class="row align-items-center">
                                        <div class="col-sm-12">
                                            <!-- something write here -->
                                            <div class="hero_img">
                                                <img loading="lazy"
                                                     src="{{ url()->asset('user/assets/images/men-1.png') }}"
                                                     alt="shirt"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single_hero_slider bg-1">
                                <div class="container">
                                    <div class="row align-items-center">
                                        <div class="col-sm-12">
                                            <!-- something write here -->
                                            <div class="hero_img">
                                                <img loading="lazy"
                                                     src="{{ url()->asset('user/assets/images/men-1.png') }}"
                                                     alt="shirt"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single_hero_slider bg-2">
                                <div class="container">
                                    <div class="row align-items-center">
                                        <div class="col-sm-12">
                                            <!-- something write here -->
                                            <div class="hero_img">
                                                <img loading="lazy"
                                                     src="{{ url()->asset('user/assets/images/men-1.png') }}"
                                                     alt="shirt"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 d-none d-sm-block">
                <div
                    class="banner_collection home_3_hero mt-5 pt-2 pt-xl-0 mt-xl-0 d-flex flex-xl-column single_hero_slider sm:d-none flex-row gap-3">
                    <div class="single_picture_active single_bannercol">
                        <a href="#" class="single_bannercol">
                            <!-- <h4>Sunglasses Collection</h4>
                            <h5>20% off</h5> -->
                            <div class="bancol_img">
                                <img loading="lazy" src="{{ url()->asset('user/assets/images/headphone-1.png') }}"
                                     alt="shoes"/>
                            </div>
                        </a>
                        <a href="#" class="single_bannercol">
                            <div class="bancol_img">
                                <img loading="lazy" src="{{ url()->asset('user/assets/images/glass.png') }}"
                                     alt="shoes"/>
                            </div>
                        </a>
                        <a href="#" class="single_bannercol">
                            <div class="bancol_img">
                                <img loading="lazy" src="{{ url()->asset('user/assets/images/headphone-3.png') }}"
                                     alt="shoes"/>
                            </div>
                        </a>
                    </div>
                    <div class="single_picture_active single_bannercol">
                        <a href="#" class="single_bannercol">
                            <div class="bancol_img">
                                <img loading="lazy" src="{{ url()->asset('user/assets/images/shoes-1.png') }}"
                                     alt="shoes"/>
                            </div>
                        </a>
                        <a href="#" class="single_bannercol">
                            <div class="bancol_img">
                                <img loading="lazy" src="{{ url()->asset('user/assets/images/shoes-3.png') }}"
                                     alt="shoes"/>
                            </div>
                        </a>
                        <a href="#" class="single_bannercol">
                            <div class="bancol_img">
                                <img loading="lazy" src="{{ url()->asset('user/assets/images/shoes-4.png') }}"
                                     alt="shoes"/>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- features area -->
    <section class="features_area section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="row justify-content-center gx-2 gx-md-4">
                        <div class="col-sm-4 mb-3 mb-sm-0">
                            <div
                                class="single_feature d-flex flex-column flex-sm-row align-items-center justify-content-center">
                                <div class="feature_icon">
                                    <img loading="lazy"
                                         src="{{ url()->asset('user/assets/images/svg/delivery-van.svg') }}"
                                         alt="icon"/>
                                </div>
                                <div class="feature_content">
                                    <h4>Free shipping</h4>
                                    <p>Orders over TK 200</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 mb-3 mb-sm-0">
                            <div
                                class="single_feature d-flex flex-column flex-sm-row align-items-center justify-content-center">
                                <div class="feature_icon">
                                    <img loading="lazy"
                                         src="{{ url()->asset('user/assets/images/svg/money-back.svg') }}" alt="icon"/>
                                </div>
                                <div class="feature_content">
                                    <h4>Money Returns</h4>
                                    <p>30 Days money return</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div
                                class="single_feature d-flex flex-column flex-sm-row align-items-center justify-content-center">
                                <div class="feature_icon">
                                    <img loading="lazy"
                                         src="{{ url()->asset('user/assets/images/svg/service-hours.svg') }}"
                                         alt="icon"/>
                                </div>
                                <div class="feature_content">
                                    <h4>24/7 Support</h4>
                                    <p>Customer support</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- categories -->
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

    <!-- top new arrival -->
    <div class="top_arrival_wrp home-3 section_padding_b">
        <div class="container">
            <h2 class="section_title_3">Top New Arrival</h2>
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div></div>
                <!-- timer -->
                <div class="seemore_2">
                    <a href="#">See More <span><i class="las la-angle-right"></i></span></a>
                </div>
            </div>
            <div class="product_slider_2">
                <div class="single_toparrival">
                    <a href="#">
                        <div class="topariv_img">
                            <img loading="lazy" src="{{ url()->asset('user/assets/images/parse.png') }}" alt="product"/>
                            <div class="prod_soh">
                                <div class="adto_wish">
                                    <i class="icon-heart"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="topariv_cont">
                        <a href="product-view.html">
                            <h4 class="text-truncate">Women Scrub Leather</h4>
                        </a>
                        <div class="price mb-1 mt-2">
                            <span class="org_price">TK 745.00</span>
                            <span class="org_price"><del>900.00</del></span>
                        </div>
                    </div>
                    <div class="full_atc_btn">
                        <button>
                            <span class="me-1"><i class="icon-cart"></i></span>
                            buy now
                        </button>
                    </div>
                </div>
                <div class="single_toparrival">
                    <a href="#">
                        <div class="topariv_img">
                            <img loading="lazy" src="{{ url()->asset('user/assets/images/shirt-2.png') }}"
                                 alt="product"/>
                            <div class="prod_soh">
                                <div class="adto_wish">
                                    <i class="icon-cart"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="topariv_cont">
                        <a href="product-view.html">
                            <h4 class="text-truncate">Men T-SHIRT ΚΑΝΟΝΙΚΗ</h4>
                        </a>
                        <div class="price mb-1 mt-2">
                            <span class="org_price">TK 500.00</span>
                            <span class="org_price"><del>700.00</del></span>
                        </div>

                    </div>
                    <div class="full_atc_btn">
                        <button>
                            <span class="me-1"><i class="icon-cart"></i></span>
                            buy now
                        </button>
                    </div>
                </div>
                <div class="single_toparrival">
                    <a href="#">
                        <div class="topariv_img">
                            <img loading="lazy" src="{{ url()->asset('user/assets/images/toy.png') }}" alt="product"/>
                            <div class="prod_soh">
                                <div class="adto_wish">
                                    <i class="icon-cart"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="topariv_cont">
                        <a href="product-view.html">
                            <h4 class="text-truncate">Playmobil Princess M</h4>
                        </a>
                        <div class="price mb-1 mt-2">
                            <span class="org_price">TK 45.00</span>
                            <span class="org_price"><del>450.00</del></span>
                        </div>

                    </div>
                    <div class="full_atc_btn">
                        <button>
                            <span class="me-1"><i class="icon-cart"></i></span>
                            buy now
                        </button>
                    </div>
                </div>
                <div class="single_toparrival">
                    <a href="#">
                        <div class="topariv_img">
                            <img loading="lazy" src="{{ url()->asset('user/assets/images/shoes-5.png') }}"
                                 alt="product"/>
                            <div class="prod_soh">
                                <div class="adto_wish">
                                    <i class="icon-cart"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="topariv_cont">
                        <a href="product-view.html">
                            <h4 class="text-truncate">Men's Running Shoes</h4>
                        </a>
                        <div class="price mb-1 mt-2">
                            <span class="org_price">TK 45.00</span>
                            <span class="org_price "><del>450.00</del></span>
                        </div>
                    </div>
                    <div class="full_atc_btn">
                        <button>
                            <span class="me-1"><i class="icon-cart"></i></span>
                            buy now
                        </button>
                    </div>
                </div>
                <div class="single_toparrival">
                    <a href="#">
                        <div class="topariv_img">
                            <img loading="lazy" src="{{ url()->asset('user/assets/images/shoes-3.png') }}'"
                                 alt="product"/>
                            <div class="prod_soh">
                                <div class="adto_wish">
                                    <i class="icon-cart"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="topariv_cont">
                        <a href="product-view.html">
                            <h4 class="text-truncate">Women Hill Leather</h4>
                        </a>
                        <div class="price mb-1 mt-2">
                            <span class="org_price">TK 850.00</span>
                            <span class="org_price"><del>900.00</del></span>
                        </div>
                    </div>
                    <div class="full_atc_btn">
                        <button>
                            <span class="me-1"><i class="icon-cart"></i></span>
                            buy now
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ad banner -->
    <div class="offer_banner_area section_padding_b">
        <div class="container">
            <div class="add_slider">
                <div class="hero_area">
                    <a href="#">
                        <picture>
                            <source media="(min-width: 768px)"
                                    srcset="{{ url()->asset('user/assets/images/offer.jpg') }}"/>
                            <img loading="lazy" src="{{ url()->asset('user/assets/images/offer-mobile-2.jpg') }}"
                                 alt="ad"/>
                        </picture>
                    </a>
                </div>
                <div class="hero_area">
                    <a href="#">
                        <picture>
                            <source media="(min-width: 768px)"
                                    srcset="{{ url()->asset('user/assets/images/offer.jpg') }}"/>
                            <img loading="lazy" src="{{ url()->asset('user/assets/images/offer-mobile-2.jpg') }}"
                                 alt="ad"/>
                        </picture>
                    </a>
                </div>
                <div class="hero_area">
                    <a href="#">
                        <picture>
                            <source media="(min-width: 768px)"
                                    srcset="{{ url()->asset('user/assets/images/offer.jpg') }}"/>
                            <img loading="lazy" src="{{ url()->asset('user/assets/images/offer-mobile-2.jpg') }}"
                                 alt="ad"/>
                        </picture>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="top_arrival_wrp home-3 section_padding_b">
        <div class="container">
            <h2 class="section_title_3">Recommended for you</h2>
            <div class="product_slider_2">
                <div class="single_toparrival">
                    <a href="#">
                        <div class="topariv_img">
                            <img loading="lazy" src="{{ url()->asset('user/assets/images/parse.png') }}" alt="product"/>
                            <div class="prod_soh">
                                <div class="adto_wish">
                                    <i class="icon-cart"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="topariv_cont">
                        <a href="product-view.html">
                            <h4 class="text-truncate">Women Scrub Leather</h4>
                        </a>
                        <div class="price mb-1 mt-2">
                            <span class="org_price">TK 850.00</span>
                            <span class="org_price"><del>950</del></span>
                        </div>
                    </div>
                    <div class="full_atc_btn">
                        <button>
                            <span class="me-1"><i class="icon-cart"></i></span>
                            buy now
                        </button>
                    </div>
                </div>
                <div class="single_toparrival">
                    <a href="#">
                        <div class="topariv_img">
                            <img loading="lazy" src="{{ url()->asset('user/assets/images/shirt-2.png') }}"
                                 alt="product"/>
                            <div class="prod_soh">
                                <div class="adto_wish">
                                    <i class="icon-cart"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="topariv_cont">
                        <a href="product-view.html">
                            <h4 class="text-truncate">Men T-SHIRT ΚΑΝΟΝΙΚΗ</h4>
                        </a>
                        <div class="price mb-1 mt-2">
                            <span class="org_price">TK 850.00</span>
                            <span class="org_price"><del>950</del></span>
                        </div>

                    </div>
                    <div class="full_atc_btn">
                        <button>
                            <span class="me-1"><i class="icon-cart"></i></span>
                            buy now
                        </button>
                    </div>
                </div>
                <div class="single_toparrival">
                    <a href="#">
                        <div class="topariv_img">
                            <img loading="lazy" src="{{ url()->asset('user/assets/images/toy.png') }}" alt="product"/>
                            <div class="prod_soh">
                                <div class="adto_wish">
                                    <i class="icon-cart"></i>
                                </div>

                            </div>
                        </div>
                    </a>
                    <div class="topariv_cont">
                        <a href="product-view.html">
                            <h4 class="text-truncate">Playmobil Princess M</h4>
                        </a>
                        <div class="price mb-1 mt-2">
                            <span class="org_price">TK 850.00</span>
                            <span class="org_price"><del>950</del></span>
                        </div>
                    </div>
                    <div class="full_atc_btn">
                        <button>
                            <span class="me-1"><i class="icon-cart"></i></span>
                            buy now
                        </button>
                    </div>
                </div>
                <div class="single_toparrival">
                    <a href="#">
                        <div class="topariv_img">
                            <img loading="lazy" src="{{ url()->asset('user/assets/images/shoes-5.png') }}"
                                 alt="product"/>
                            <div class="prod_soh">
                                <div class="adto_wish">
                                    <i class="icon-cart"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="topariv_cont">
                        <a href="product-view.html">
                            <h4 class="text-truncate">Men's Running Shoes</h4>
                        </a>
                        <div class="price mb-1 mt-2">
                            <span class="org_price">TK 850.00</span>
                            <span class="org_price"><del>950</del></span>
                        </div>
                    </div>
                    <div class="full_atc_btn">
                        <button>
                            <span class="me-1"><i class="icon-cart"></i></span>
                            buy now
                        </button>
                    </div>
                </div>
                <div class="single_toparrival">
                    <a href="#">
                        <div class="topariv_img">
                            <img loading="lazy" src="{{ url()->asset('user/assets/images/shoes-3.png') }}'"
                                 alt="product"/>
                            <div class="prod_soh">
                                <div class="adto_wish">
                                    <i class="icon-cart"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="topariv_cont">
                        <a href="product-view.html">
                            <h4 class="text-truncate">Women Hill Leather</h4>
                        </a>
                        <div class="price mb-1 mt-2">
                            <span class="org_price">TK 850.00</span>
                            <span class="org_price"><del>950</del></span>
                        </div>

                    </div>
                    <div class="full_atc_btn">
                        <button>
                            <span class="me-1"><i class="icon-cart"></i></span>
                            buy now
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
