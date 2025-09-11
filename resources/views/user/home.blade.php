@php
    use App\Enums\SettingKeyEnum;
    use Illuminate\Support\Facades\Storage;
@endphp
@extends('user.master')

@section('title')
    Home
@endsection

@section('page_content')
    <div class="container-lg home_2_hero_wrp home-3">
        <div class="row">
            <div class="col-xl-12 col-sm-12 mb-5">
                <div class="home_2_hero">
                    <div class="container">
                        <div class="hero_slider_active">
                            @foreach(getSettingImages($settings, SettingKeyEnum::TopBanner->value)['images'] as $image)
                                <div class="single_hero_slider bg-3">
                                    <div class="container">
                                        <div class="row align-items-center">
                                            <div class="col-lg-12 col-sm-12">
                                                <!-- something write here -->
                                                <div class="hero_img">
                                                    <img loading="lazy"
                                                         src="{{ Storage::url($image) }}"
                                                         alt="top banner"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="shop_bycat section_padding_b">
        <div class="container">
            <h2 class="section_title_3">Shop by category</h2>
            <div class="row gx-2 gy-2">
                @if(!empty(getSettingImages($settings, SettingKeyEnum::ShopByCategoryOne->value)['images'][0]))
                    <div class="col-lg-4 col-6">
                        <a href="#" class="single_shopbycat bg_1"
                           style="background-image: url({{ Storage::url(getSettingImages($settings, SettingKeyEnum::ShopByCategoryOne->value)['images'][0]) ?? '' }})">
                            <div class="shopcat_cont">
                                <h4>{{ getSettingImages($settings, SettingKeyEnum::ShopByCategoryOne->value)['name'] ?? '' }}</h4>
                                <div class="icon">
                                    <i class="las la-long-arrow-alt-right"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif

                @if(!empty(getSettingImages($settings, SettingKeyEnum::ShopByCategoryTwo->value)['images'][0]))
                    <div class="col-lg-4 col-6">
                        <a href="#" class="single_shopbycat bg_1"
                           style="background-image: url({{ Storage::url(getSettingImages($settings, SettingKeyEnum::ShopByCategoryTwo->value)['images'][0]) ?? '' }})">
                            <div class="shopcat_cont">
                                <h4>{{ getSettingImages($settings, SettingKeyEnum::ShopByCategoryTwo->value)['name'] ?? '' }}</h4>
                                <div class="icon">
                                    <i class="las la-long-arrow-alt-right"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif

                @if(!empty(getSettingImages($settings, SettingKeyEnum::ShopByCategoryThree->value)['images'][0]))
                    <div class="col-lg-4 col-6">
                        <a href="#" class="single_shopbycat bg_1"
                           style="background-image: url({{ Storage::url(getSettingImages($settings, SettingKeyEnum::ShopByCategoryThree->value)['images'][0]) ?? '' }})">
                            <div class="shopcat_cont">
                                <h4>{{ getSettingImages($settings, SettingKeyEnum::ShopByCategoryThree->value)['name'] ?? ''}}</h4>
                                <div class="icon">
                                    <i class="las la-long-arrow-alt-right"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif

                @if(!empty(getSettingImages($settings, SettingKeyEnum::ShopByCategoryFour->value)['images'][0]))
                    <div class="col-lg-4 col-6">
                        <a href="#" class="single_shopbycat bg_1"
                           style="background-image: url({{ Storage::url(getSettingImages($settings, SettingKeyEnum::ShopByCategoryFour->value)['images'][0]) }})">
                            <div class="shopcat_cont">
                                <h4>{{ getSettingImages($settings, SettingKeyEnum::ShopByCategoryFour->value)['name'] }}</h4>
                                <div class="icon">
                                    <i class="las la-long-arrow-alt-right"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif

                @if(!empty(getSettingImages($settings, SettingKeyEnum::ShopByCategoryFive->value)['images'][0]))
                    <div class="col-lg-4 col-6">
                        <a href="#" class="single_shopbycat bg_1"
                           style="background-image: url({{ Storage::url(getSettingImages($settings, SettingKeyEnum::ShopByCategoryFive->value)['images'][0]) }})">
                            <div class="shopcat_cont">
                                <h4>{{ getSettingImages($settings, SettingKeyEnum::ShopByCategoryFive->value)['name'] }}</h4>
                                <div class="icon">
                                    <i class="las la-long-arrow-alt-right"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif

                @if(!empty(getSettingImages($settings, SettingKeyEnum::ShopByCategorySix->value)['images'][0]))
                    <div class="col-lg-4 col-6">
                        <a href="#" class="single_shopbycat bg_1"
                           style="background-image: url({{ Storage::url(getSettingImages($settings, SettingKeyEnum::ShopByCategorySix->value)['images'][0]) }})">
                            <div class="shopcat_cont">
                                <h4>{{ getSettingImages($settings, SettingKeyEnum::ShopByCategorySix->value)['name'] }}</h4>
                                <div class="icon">
                                    <i class="las la-long-arrow-alt-right"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- top new arrival -->
    <div class="top_arrival_wrp home-3 section_padding_b">
        <div class="container">
            <h2 class="section_title_3">Top New Arrival</h2>
            <div class="product_slider_2">
                @foreach($top_arrival as $product)
                    <div class="single_toparrival">
                        <a href="{{ route('products.show', $product) }}">
                            <div class="topariv_img">
                                <img loading="lazy"
                                     src="{{ $product->thumbnail?->url ? Storage::url($product->thumbnail->url) : asset('assets/images/no-image.png') }}"
                                     alt="{{ $product->name }}"/>
                            </div>

                            <div class="topariv_cont">
                                <h4 class="text-truncate">{{ $product->name }}</h4>
                                <div class="price mb-1 mt-2">
                                    @if(($product->offer_price ?? 0) > 0)
                                        <span class="org_price">TK {{ number_format($product->offer_price, 2) }}</span>
                                        <span class="org_price"><del>{{ number_format($product->price, 2) }}</del></span>
                                    @else
                                        <span class="org_price">TK {{ number_format($product->price, 2) }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="full_atc_btn">
                                <button>
                                    <span class="me-1"><i class="icon-cart"></i></span>
                                    View Details
                                </button>
                            </div>
                        </a>
                    </div>

                @endforeach
            </div>
        </div>
    </div>

    <!-- ad banner -->
    <div class="offer_banner_area section_padding_b">
        <div class="container">
            <div class="add_slider">
                @foreach(getSettingImages($settings, SettingKeyEnum::MidBanner->value)['images'] as $image)
                    <div class="hero_area">
                        <a href="#">
                            <picture>
                                <source media="(min-width: 768px)" srcset="{{ Storage::url($image) }}"/>
                                <img loading="lazy" src="{{ Storage::url($image) }}"
                                     alt="ad"/>
                            </picture>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="top_arrival_wrp home-3 section_padding_b">
        <div class="container">
            <h2 class="section_title_3">Recommended for you</h2>
            <div class="product_slider_2">
                @foreach($recommended_products as $product)
                    <div class="single_toparrival">
                        <a href="{{ route('products.show', $product) }}">
                            <div class="topariv_img">
                                <img loading="lazy"
                                     src="{{ $product->thumbnail?->url ? Storage::url($product->thumbnail->url) : asset('assets/images/no-image.png') }}"
                                     alt="{{ $product->name }}"/>
                            </div>

                            <div class="topariv_cont">
                                <h4 class="text-truncate">{{ $product->name }}</h4>
                                <div class="price mb-1 mt-2">
                                    @if(($product->offer_price ?? 0) > 0)
                                        <span class="org_price">TK {{ number_format($product->offer_price, 2) }}</span>
                                        <span class="org_price"><del>{{ number_format($product->price, 2) }}</del></span>
                                    @else
                                        <span class="org_price">TK {{ number_format($product->price, 2) }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="full_atc_btn">
                                <button>
                                    <span class="me-1"><i class="icon-cart"></i></span>
                                    View Details
                                </button>
                            </div>
                        </a>
                    </div>

                @endforeach
            </div>
        </div>
    </div>

@endsection
