@extends('user.master')

@section('title')
    {{ config('app.name') }}
@endsection

@section('page_content')
    <!-- breadcrumbs -->
    <div class="container">
        <div class="breadcrumbs">
            <a href="#"><i class="las la-home"></i></a>
            <a href="#" class="active">Shopping Cart</a>
        </div>
    </div>

    <div class="modal fade" id="exampleModalCenterTitle" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" onclick="performDelete()">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- model 2 -->
    <div class="modal fade" id="exampleModalCenterTitle2" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" onclick="performDelete()">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- model 3 -->
    <div class="modal fade" id="exampleModalCenterTitle3" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" onclick="performDelete()">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal end -->
    <div class="cart_area section_padding_b">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <h4 class="shop_cart_title sopcart_ttl d-none d-lg-flex">
                        <span>Product</span>
                        <span>Quantity</span>
                        <span>Total Price</span>
                    </h4>
                    <div class="shop_cart_wrap">
                        <div class="single_shop_cart d-flex align-items-center flex-wrap">
                            <div class="cart_img mb-4 mb-md-0">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultyx">
                            </div>
                            <label class="cart_img mb-4 mb-md-0" for="flexCheckDefaultyx">
                                <img loading="lazy" src="assets/images/headphone-4.png" alt="product" />
                            </label>
                            <div class="cart_cont">
                                <a href="product-view.html">
                                    <h5>XB450AP Extra Bass Headphones</h5>
                                </a>
                                <p class="price">TK 45.00</p>
                                <div class="d-flex align-items-center gap-2">
                                    <div class=" size mb-0">Size: M</div>
                                    <div class="size mb-0 d-flex align-items-center gap-2">
                                        color:
                                        <div class="single_size_opt">
                                            <input type="radio" hidden name="color" class="" id="color-purple" />
                                            <label for="color-purple" class="" data-bs-toggle="tooltip"
                                                   title="Rose Red"><img src="/assets/images/headphone-4.png" height="25px"
                                                                         width="25px" alt="Rose Red"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="cart_qnty d-flex align-items-center ms-md-auto">
                                <div class="cart_qnty_btn">
                                    <i class="las la-minus"></i>
                                </div>
                                <div class="cart_count">4</div>
                                <div class="cart_qnty_btn">
                                    <i class="las la-plus"></i>
                                </div>
                            </div>
                            <div class="cart_price ms-auto">
                                <p>TK 45.00</p>
                            </div>
                            <div class="cart_remove ms-auto" data-toggle="modal" data-target="#exampleModalCenterTitle">
                                <i class=" icon-trash"></i>
                            </div>
                        </div>
                        <div class="single_shop_cart d-flex align-items-center flex-wrap">
                            <div class="cart_img mb-4 mb-md-0">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultx">
                            </div>
                            <label class="cart_img mb-4 mb-md-0" for="flexCheckDefaultx">
                                <img loading="lazy" src="assets/images/headphone-4.png" alt="product" />
                            </label>
                            <div class="cart_cont">
                                <a href="product-view.html">
                                    <h5>XB450AP Extra Bass Headphones</h5>
                                </a>
                                <p class="price">TK 45.00</p>
                                <div class="d-flex align-items-center gap-2">
                                    <div class=" size mb-0">Size: M</div>
                                    <div class="size mb-0 d-flex align-items-center gap-2">
                                        color:
                                        <div class="single_size_opt">
                                            <input type="radio" hidden name="color" class="" id="color-purple" />
                                            <label for="color-purple" class="" data-bs-toggle="tooltip"
                                                   title="Rose Red"><img src="/assets/images/headphone-4.png" height="25px"
                                                                         width="25px" alt="Rose Red"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="cart_qnty d-flex align-items-center ms-md-auto">
                                <div class="cart_qnty_btn">
                                    <i class="las la-minus"></i>
                                </div>
                                <div class="cart_count">4</div>
                                <div class="cart_qnty_btn">
                                    <i class="las la-plus"></i>
                                </div>
                            </div>
                            <div class="cart_price ms-auto">
                                <p>TK 45.00</p>
                            </div>
                            <div class="cart_remove2 ms-auto" data-toggle="modal"
                                 data-target="#exampleModalCenterTitle2">
                                <i class=" icon-trash"></i>
                            </div>
                        </div>
                        <div class="single_shop_cart d-flex align-items-center flex-wrap">
                            <div class="cart_img mb-4 mb-md-0">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            </div>
                            <label class="cart_img mb-4 mb-md-0" for="flexCheckDefault">
                                <img loading="lazy" src="assets/images/headphone-4.png" alt="product" />
                            </label>
                            <div class="cart_cont">
                                <a href="product-view.html">
                                    <h5>XB450AP Extra Bass Headphones</h5>
                                </a>
                                <p class="price">TK 45.00</p>
                                <div class="d-flex align-items-center gap-2">
                                    <div class=" size mb-0">Size: M</div>
                                    <div class="size mb-0 d-flex align-items-center gap-2">
                                        color:
                                        <div class="single_size_opt">
                                            <input type="radio" hidden name="color" class="" id="color-purple" />
                                            <label for="color-purple" class="" data-bs-toggle="tooltip"
                                                   title="Rose Red"><img src="/assets/images/headphone-4.png" height="25px"
                                                                         width="25px" alt="Rose Red"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="cart_qnty d-flex align-items-center ms-md-auto">
                                <div class="cart_qnty_btn">
                                    <i class="las la-minus"></i>
                                </div>
                                <div class="cart_count">4</div>
                                <div class="cart_qnty_btn">
                                    <i class="las la-plus"></i>
                                </div>
                            </div>
                            <div class="cart_price ms-auto">
                                <p>TK 45.00</p>
                            </div>
                            <div class="cart_remove3 ms-auto" data-toggle="modal"
                                 data-target="#exampleModalCenterTitle3">
                                <i class=" icon-trash"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mt-4 mt-lg-0">
                    <div class="cart_summary">
                        <h4>Order Summary</h4>
                        <div class="cartsum_text d-flex justify-content-between">
                            <p class="text-semibold">Subtotal</p>
                            <p class="text-semibold">TK 45.00</p>
                        </div>
                        <div class="cartsum_text d-flex justify-content-between">
                            <p>Delivery</p>
                            <p>Free</p>
                        </div>
                        <div class="cartsum_text d-flex justify-content-between">
                            <p>Tax</p>
                            <p>Free</p>
                        </div>
                        <div class="cart_sum_total d-flex justify-content-between">
                            <p>Total</p>
                            <p>TK 45.00</p>
                        </div>
                        <div class="cart_sum_coupon">
                            <input type="text" placeholder="Enter coupon" />
                            <button>apply</button>
                        </div>
                        <div class="cart_sum_pros">
                            <button>Proccees to checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
