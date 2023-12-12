<header class="">
    <div class="container">
        <div class="d-flex align-items-center justify-content-sm-between">
            <div class="logo">
                <a href="{{ route('home') }}">
                    <img loading="lazy" src="{{ url()->asset('user/assets/images/svg/logo.svg') }}" alt="logo"/>
                </a>
            </div>
            <div class="search_wrap d-none d-lg-block">
                <div class="search d-flex">
                    <div class="search_input">
                        <input type="text" placeholder="Search" id="show_suggest"/>
                    </div>
                    <div class="search_subimt">
                        <button>
                            <span class="d-none d-sm-inline-block">Search</span>
                        </button>
                    </div>
                    <div class="search_suggest shadow-sm">
                        <div class="search_result_product">
                            <a href="#" class="single_sresult_product">
                                <div class="sresult_img">
                                    <img loading="lazy" src="{{ url()->asset('user/assets/images/laptop-2.png') }}"
                                         alt="product"/>
                                </div>
                                <div class="sresult_content">
                                    <h4>HP Pavilion 15</h4>
                                    <div class="price">
                                        <span class="org_price">TK 850.00</span>
                                        <span class="org_price"><del>950</del></span>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="single_sresult_product">
                                <div class="sresult_img">
                                    <img loading="lazy" src="{{ url()->asset('user/assets/images/laptop-1.png') }}"
                                         alt="product"/>
                                </div>
                                <div class="sresult_content">
                                    <h4>HP Pavilion 15</h4>
                                    <div class="price">
                                        <span class="org_price">&#2547;45.00</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header_icon d-flex align-items-center ms-auto ms-sm-0">
                <div class="shopcart">
                    <a href="#" class="icon_wrp text-center d-none d-lg-block">
							<span class="icon">
								<i class="icon-cart"></i>
							</span>
                        <span class="icon_text">Cart</span>
                        <span class="pops">0</span>
                    </a>
                    <div class="shopcart_dropdown">
                        <div class="cart_droptitle">
                            <h4 class="text_lg">2 Items</h4>
                        </div>
                        <div class="cartsdrop_wrap">
                            <a href="#" class="single_cartdrop mb-3">
                                <span class="remove_cart"><i class="las la-times"></i></span>
                                <div class="cartdrop_img">
                                    <img loading="lazy" src="{{ url()->asset('user/assets/images/shoes-5.png') }}"
                                         alt="product"/>
                                </div>
                                <div class="cartdrop_cont">
                                    <h5 class="text_lg mb-0 default_link">Men casual shoes</h5>
                                    <p class="mb-0 text_xs text_p">x1 <span class="ms-2">TK 450</span></p>
                                </div>
                            </a>
                            <a href="#" class="single_cartdrop">
                                <span class="remove_cart"><i class="las la-times"></i></span>
                                <div class="cartdrop_img">
                                    <img loading="lazy" src="{{ url()->asset('user/assets/images/headphone-2.png') }}"
                                         alt="product"/>
                                </div>
                                <div class="cartdrop_cont">
                                    <h5 class="text_lg mb-0 default_link">Men casual shoes</h5>
                                    <p class="mb-0 text_xs text_p">x1 <span class="ms-2">TK 450</span></p>
                                </div>
                            </a>
                        </div>
                        <div class="total_cartdrop">
                            <h4 class="text_lg text-uppercase mb-0">Sub Total:</h4>
                            <h4 class="text_lg mb-0 ms-2">TK 980.00</h4>
                        </div>
                        <div class="cartdrop_footer d-flex mt-3">
                            <a href="#" class="default_btn w-50 text_xs px-1">View Cart</a>
                            <a href="#" class="default_btn second ms-3 w-50 text_xs px-1">Checkout</a>
                        </div>
                    </div>
                </div>
                <div class="position-relative myacwrap home-1">
                    <a href="javascript:void(0)" class="icon_wrp text-center myacc">
							<span class="icon">
								<i class="icon-user-line"></i>
							</span>
                        <span class="icon_text">Account</span>
                    </a>
                    <div class="myacc_cont">
                        @if(!auth()->user())
                        <div class="ac_join">
                            <div class="account_btn d-flex justify-content-between">
                                <a href="#" class="default_btn">Join</a>
                                <a href="#" class="default_btn second">Sing in</a>
                            </div>
                        </div>
                        @else
                        <div class="ac_links">
                            <a href="#" class="myac">
                                <i class="lar la-id-card"></i>
                                My Account
                            </a>
                            <a href="#">
                                <i class="las la-gift"></i>
                                My Order
                            </a>
                            <a href="#">
                                <i class="lar la-heart"></i>
                                My Wishlist
                            </a>
                            <a href="#">
                                <i class="icon-cart"></i>
                                My Cart
                            </a>
                            <a href="#">
                                <i class="las la-power-off"></i>
                                Log out
                            </a>
                        </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
