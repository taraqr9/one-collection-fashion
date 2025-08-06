@extends('user.master')

@section('title')
    {{ config('app.name') }}
@endsection

@section('page_content')
    <!-- breadcrumbs -->
    <div class="container">
        <div class="breadcrumbs">
            <a href="index-1.html"><i class="las la-home"></i></a>
            <a href="#">Shop</a>
            <a href="#" class="active">Checkout</a>
        </div>
    </div>

    <div class="cart_area section_padding_b">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-7 col-md-6">
                    <h4 class="shop_cart_title mb-4 ps-3">Billing details</h4>
                    <form class="billing_form">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="single_billing_inp">
                                    <label for="full_name">Full Name <span>*</span></label>
                                    <input type="text" id="full_name" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="single_billing_inp">
                                    <label for="phone_no">Phone Number <span>*</span></label>
                                    <input type="number" id="phone_no" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="single_billing_inp">
                                    <label for="full_address">Address <span>*</span></label>
                                    <textarea rows="3" type="text" id="full_address"></textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="single_billing_inp">
                                    <label for="city">City <span>*</span></label>
                                    <input type="text" id="city" />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="single_billing_inp">
                                    <label for="email_addr">Email Address <span>*</span></label>
                                    <input type="email" id="email_addr" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="single_billing_inp">
                                    <label for="district_city">District <span>*</span></label>
                                    <input type="text" id="town_city" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="single_billing_inp select-container">
                                    <label for="option">Select Option <span>*</span></label>
                                    <select type="text" id="option" class="select-box">
                                        <option class="" disabled>select option</option>
                                        <option value="inSide_Dhaka">Inside Dhaka</option>
                                        <option value="outSide_Dhaka">Outside Dhaka</option>
                                    </select>
                                    <div class="icon-container">
                                        <i class="fa-solid fa-caret-down"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-xl-4 col-lg-5 col-md-6">
                    <h4 class="shop_cart_title ps-3">Your order</h4>
                    <div class="checkout_order mt-4">
                        <h4>product</h4>
                        <div class="single_check_order">
                            <div class="checkorder_cont">
                                <h5>Beigh Knitted Shoes</h5>
                                <div class="d-flex align-items-center gap-2">
                                    <div class=" size mb-0">
                                        <p>Size: M</p>
                                    </div>
                                    <div class="size mb-0 d-flex align-items-center gap-2">
                                        <P>color
                                        <div class="single_size_opt">
                                            <input type="radio" hidden name="color" class="" id="color-purple" />
                                            <label for="color-purple" class="" data-bs-toggle="tooltip"
                                                   title="Rose Red"><img src="/assets/images/shoes-4.png" height="20px"
                                                                         width="20px" alt="Rose Red"></label>
                                        </div>
                                        </P>

                                    </div>
                                </div>
                            </div>
                            <p class="checkorder_qnty">x1</p>
                            <p class="checkorder_price">TK 84.00</p>
                        </div>
                        <div class="single_check_order">
                            <div class="checkorder_cont">
                                <h5>Beigh Knitted Shoes</h5>
                                <div class="d-flex align-items-center gap-2">
                                    <div class=" size mb-0">
                                        <p>Size: M</p>
                                    </div>
                                    <div class="size mb-0 d-flex align-items-center gap-2">
                                        <P>color
                                        <div class="single_size_opt">
                                            <input type="radio" hidden name="color" class="" id="color-purple" />
                                            <label for="color-purple" class="" data-bs-toggle="tooltip"
                                                   title="Rose Red"><img src="/assets/images/shoes-3.png" height="20px"
                                                                         width="20px" alt="Rose Red"></label>
                                        </div>
                                        </P>

                                    </div>
                                </div>
                            </div>
                            <p class="checkorder_qnty">x2</p>
                            <p class="checkorder_price">TK 84.00</p>
                        </div>
                        <div class="single_check_order">
                            <div class="checkorder_cont">
                                <h5>Beigh Knitted Shoes</h5>
                                <div class="d-flex align-items-center gap-2">
                                    <div class=" size mb-0">
                                        <p>Size: M</p>
                                    </div>
                                    <div class="size mb-0 d-flex align-items-center gap-2">
                                        <P>color
                                        <div class="single_size_opt">
                                            <input type="radio" hidden name="color" class="" id="color-purple" />
                                            <label for="color-purple" class="" data-bs-toggle="tooltip"
                                                   title="Rose Red"><img src="/assets/images/shoes-1.png" height="20px"
                                                                         width="20px" alt="Rose Red"></label>
                                        </div>
                                        </P>

                                    </div>
                                </div>
                            </div>
                            <p class="checkorder_qnty">x1</p>
                            <p class="checkorder_price">TK 84.00</p>
                        </div>
                        <div class="single_check_order subs">
                            <div class="checkorder_cont subtotal-h">
                                <h5>Subtotal</h5>
                            </div>
                            <p class="checkorder_price">TK 140.00</p>
                        </div>
                        <div class="single_check_order subs">
                            <div class="checkorder_cont subtotal-h">
                                <h5>Shipping</h5>
                            </div>
                            <p class="checkorder_price">Free</p>
                        </div>
                        <div class="single_check_order total">
                            <div class="checkorder_cont">
                                <h5>Total</h5>
                            </div>
                            <p class="checkorder_price">TK 140.00</p>
                        </div>
                        <div class="checkorder_agree custom_check check_2">
                            <input type="checkbox" class="check_inp" hidden id="save-default" />
                            <label for="save-default">Agree to our <a href="#" class="text-color">terms &
                                    conditions</a></label>
                        </div>

                        <div class="checkorder_btn">
                            <button class="default_btn rounded w-100">place order</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
