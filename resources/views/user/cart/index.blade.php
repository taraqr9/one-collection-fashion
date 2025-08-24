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

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this item?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="deleteForm" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="cart_area section_padding_b">
        <div class="container">
            <form action="{{ route('orders.store') }}" method="POST" id="checkoutForm">
                @csrf
                <div class="row">
                    <!-- Product List -->
                    <div class="col-lg-8">
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

                                    <!-- Hidden inputs for checkout -->
                                    <input type="hidden" name="products[{{ $product->id }}][product_id]" value="{{ $product->product_id }}">
                                    <input type="hidden" name="products[{{ $product->id }}][stock_id]" value="{{ $product->stock_id }}">
                                    <input type="hidden" name="products[{{ $product->id }}][quantity]" class="input-quantity-{{ $product->id }}" value="{{ $product->quantity }}">


                                    <div class="cart_remove ms-auto" data-toggle="modal"
                                         data-target="#exampleModalCenterTitle"
                                         data-id="{{ $product->id }}">
                                        <i class="icon-trash"></i>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Billing Form -->
                    <div class="col-lg-4">
                        <h4 class="shop_cart_title mb-4">Billing Details</h4>
                        <div class="billing_form">
                            <div class="mb-2 single_billing_inp">
                                <label for="full_name">Full Name <span>*</span></label>
                                <input type="text" id="user_name" name="user_name" class="form-control" required/>
                            </div>
                            <div class="mb-2 single_billing_inp">
                                <label for="phone_no">Phone Number <span>*</span></label>
                                <input type="number" id="user_phone" name="user_phone" class="form-control" required/>
                            </div>
                            <div class="mb-2 single_billing_inp">
                                <label for="full_address">Address <span>*</span></label>
                                <textarea rows="3" id="user_address" name="user_address" class="form-control" required></textarea>
                            </div>

                            <!-- Order Summary -->
                            <div class="cart_summary mt-4">
                                <h4>Order Summary</h4>
                                <div class="d-flex justify-content-between">
                                    <p class="text-semibold">Subtotal</p>
                                    <p class="text-semibold">TK <span id="subtotal">0.00</span></p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p>Delivery</p>
                                    <p>TK <span id="delivery-fee">50.00</span></p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p>Total</p>
                                    <p>TK <span id="total">0.00</span></p>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 mt-2">Proceed to checkout</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

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
                let productId = $btn.closest(".single_shop_cart").find("input[name*='products']").val();

                if ($btn.hasClass("plus")) {
                    quantity++;
                } else if ($btn.hasClass("minus") && quantity > 1) {
                    quantity--;
                }

                $countEl.text(quantity);
                $totalEl.text((price * quantity).toFixed(2));

                // update hidden input
                let input = $btn.closest(".single_shop_cart").find(".input-quantity-" + productId);
                input.val(quantity);

                updateSummary();
            });


            // initial load
            updateSummary();


            let deleteUrlTemplate = "{{ route('carts.destroy', ':id') }}";

            // When delete button clicked
            $(".cart_remove").on("click", function () {
                let id = $(this).data("id");
                let url = deleteUrlTemplate.replace(':id', id);
                $("#deleteForm").attr("action", url);
                $("#deleteModal").modal("show");
            });
        });
    </script>


@endsection
