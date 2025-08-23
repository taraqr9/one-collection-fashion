@php use Illuminate\Support\Facades\Storage; @endphp
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
                    @foreach($products as $product)
                        @php
                            $unitPrice = $product->product->offer_price ?? $product->product->price;
                        @endphp
                        <div class="shop_cart_wrap">
                            <div class="single_shop_cart d-flex align-items-center flex-wrap">
                                <label class="cart_img mb-4 mb-md-0" for="flexCheckDefaultyx">
                                    <img loading="lazy" src="{{ Storage::url($product->product->thumbnail->url) }}"
                                         alt="product"/>
                                </label>
                                <div class="cart_cont">
                                    <h5>{{ $product->product->name }}</h5>
                                    <p class="price">TK {{ $unitPrice }}</p>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="size mb-0">{{ $product->stock->type->name }}: {{ $product->stock->value }}</div>
                                    </div>
                                </div>
                                <div class="cart_qnty d-flex align-items-center ms-md-auto">
                                    <div class="cart_qnty_btn minus" data-price="{{ $unitPrice }}">
                                        <i class="las la-minus"></i>
                                    </div>
                                    <div class="cart_count" data-quantity="{{ $product->quantity }}">{{ $product->quantity }}</div>
                                    <div class="cart_qnty_btn plus" data-price="{{ $unitPrice }}">
                                        <i class="las la-plus"></i>
                                    </div>
                                </div>
                                <div class="cart_price ms-auto">
                                    <p>TK <span class="total-price">{{ $unitPrice * $product->quantity }}</span></p>
                                </div>
                                <div class="cart_remove ms-auto" data-toggle="modal"
                                     data-target="#exampleModalCenterTitle">
                                    <i class="icon-trash"></i>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="col-lg-3 mt-4 mt-lg-0">
                    <div class="cart_summary">
                        <h4>Order Summary</h4>
                        <div class="cartsum_text d-flex justify-content-between">
                            <p class="text-semibold">Subtotal</p>
                            <p class="text-semibold">TK <span id="subtotal">0.00</span></p>
                        </div>
                        <div class="cartsum_text d-flex justify-content-between">
                            <p>Delivery</p>
                            <p>TK <span id="delivery-fee">50.00</span></p> {{-- keep static for now --}}
                        </div>
                        <div class="cart_sum_total d-flex justify-content-between">
                            <p>Total</p>
                            <p>TK <span id="total">0.00</span></p>
                        </div>
                        <div class="cart_sum_pros">
                            <button>Proceed to checkout</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('footer_js')
    <script>
        $(document).ready(function () {
            function updateSummary() {
                let subtotal = 0;

                $(".single_shop_cart").each(function () {
                    let totalPrice = parseFloat($(this).find(".total-price").text());
                    subtotal += totalPrice;
                });

                let delivery = parseFloat($("#delivery-fee").text());
                let grandTotal = subtotal + delivery;

                $("#subtotal").text(subtotal.toFixed(2));
                $("#total").text(grandTotal.toFixed(2));
            }

            $(".cart_qnty_btn").click(function () {
                let $btn = $(this);
                let $countEl = $btn.closest(".cart_qnty").find(".cart_count");
                let quantity = parseInt($countEl.text());
                let price = parseFloat($btn.data("price"));
                let $totalEl = $btn.closest(".single_shop_cart").find(".total-price");

                if ($btn.hasClass("plus")) {
                    quantity++;
                } else if ($btn.hasClass("minus") && quantity > 1) {
                    quantity--;
                }

                $countEl.text(quantity);
                $totalEl.text((price * quantity).toFixed(2));

                // update order summary
                updateSummary();
            });

            // initial load
            updateSummary();
        });
    </script>


@endsection
