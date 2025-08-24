@php use App\Enums\SettingKeyEnum;use Illuminate\Support\Facades\Storage; @endphp
<header class="">
    <div class="container">
        <div class="d-flex align-items-center justify-content-sm-between">
            <div class="logo">
                <a href="{{ route('home') }}">
                    <img src="{{ isset(getSettingImages($settings, SettingKeyEnum::Logo->value)['images'][0])
                                ? Storage::url(getSettingImages($settings, SettingKeyEnum::Logo->value)['images'][0])
                                : '' }}" alt="logo"/>
                </a>
            </div>

            <form action="{{ route('products.index') }}" method="get">
                <div class="search_wrap d-none d-lg-block">
                    <div class="search d-flex">
                        <div class="search_input">
                            <input type="text" placeholder="Search" name="keyword"/>
                        </div>
                        <div class="search_subimt">
                            <button>
                                <span class="d-none d-sm-inline-block">Search</span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            <div class="header_icon d-flex align-items-center ms-auto ms-sm-0">
                <div class="shopcart">
                    <a href="{{ route('carts.index') }}" class="icon_wrp text-center d-none d-lg-block">
							<span class="icon">
								<i class="icon-cart"></i>
							</span>
                        <span class="icon_text">Cart</span>
                        <span class="pops">{{ auth()->user() ? auth()->user()->carts()->count() : 0 }}</span>
                    </a>
                </div>
                <div class="position-relative myacwrap home-1">
                    <a href="javascript:void(0)" class="icon_wrp text-center myacc">
							<span class="icon">
								<i class="icon-user-line"></i>
							</span>
                        <span class="icon_text">Account</span>
                    </a>
                    <div class="myacc_cont" style="margin-top: -10px">
                        @auth
                            <div class="ac_links">
                                <a href="#">
                                    <i class="las la-arrows-alt-v"></i>
                                    My Profile
                                </a>
                                <a href="{{ route('orders.index') }}">
                                    <i class="las la-gift"></i>
                                    My Order
                                </a>
                                <a href="{{ route('carts.index') }}">
                                    <i class="icon-cart"></i>
                                    My Cart
                                </a>
                                <a href="{{ route('logout') }}">
                                    <i class="las la-power-off"></i>
                                    Logout
                                </a>
                            </div>
                        @else
                            <div class="ac_join">
                                <div class="account_btn d-flex justify-content-between">
                                    <a href="{{ route('login') }}" class="default_btn">Login</a>
                                    <a href="{{ route('register') }}" class="default_btn second">Sign Up</a>
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
