@php
    use App\Enums\DefaultSortingEnum;
    use Illuminate\Support\Facades\Storage;
@endphp
@extends('user.master')

@section('title')
    Orders
@endsection

@section('external_css')
    <style>
        .order-table {
            border-collapse: separate;
            border-spacing: 0 8px;
            width: 100%;
            table-layout: fixed;
        }

        .order-table thead th {
            background: #e8e1e1;
            font-weight: 600;
            padding: 10px 12px;
            border: 0;
        }

        .order-table tbody td {
            background: #fff;
            border: 1px solid #eee;
            padding: 12px;
            vertical-align: middle;
        }

        .order-table tbody tr td:first-child {
            border-top-left-radius: 6px;
            border-bottom-left-radius: 6px;
        }

        .order-table tbody tr td:last-child {
            border-top-right-radius: 6px;
            border-bottom-right-radius: 6px;
        }

        .col-product {
            width: auto;
        }

        .col-qty {
            width: 120px;
        }

        .col-total {
            width: 180px;
        }

        .order-table .thumb {
            width: 80px;
            height: 80px;
            object-fit: cover;
            object-position: center;
            display: block;
            border-radius: 4px;
        }

        .order-table .details .name {
            font-size: 14px;
            margin-bottom: 4px;
        }

        .order-table .details .price {
            font-size: 13px;
            margin-bottom: 2px;
        }

        .order-table .details .variant,
        .order-table .align-middle {
            font-size: 13px;
        }

        .product-link {
            color: #212529; /* normal dark text */
            text-decoration: none; /* no underline by default */
            transition: color 0.2s ease, text-decoration 0.2s ease;
        }

        .product-link:hover {
            color: #0d6efd; /* Bootstrap primary blue, or your brand color */
            text-decoration: underline; /* underline on hover */
        }


    </style>
@endsection

@section('page_content')
    <!-- breadcrumbs -->
    <div class="container">
        <div class="breadcrumbs">
            <a href="{{ route('home') }}"><i class="las la-home"></i></a>
            <a href="#" class="active">Ordered List</a>
        </div>
    </div>

    <div class="cart_area section_padding_b">
        <div class="container">
            <div class="col-lg-12">
                <table class="table order-table w-100">
                    <thead>
                    <tr>
                        <th class="col-product">Product</th>
                        <th class="col-qty text-center">Quantity</th>
                        <th class="col-total text-end">Total Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        @foreach($order?->items as $item)
                            <tr>
                                <td class="product-cell">
                                    <div class="d-flex align-items-center">
                                        <a href="{{ route('products.show', $item?->product) }}">
                                            <img
                                                loading="lazy"
                                                src="{{ Storage::url($item?->product?->thumbnail->url) }}"
                                                alt="product"
                                                class="thumb me-3"
                                            />
                                        </a>
                                        <div class="details">
                                            <div class="name">
                                                <a href="{{ route('products.show', $item?->product) }}"
                                                   class="product-link">
                                                    {{ $item?->product?->name }}
                                                </a>
                                            </div>
                                            <div
                                                class="price text-danger fw-semibold">TK {{ number_format($item->price, 2) }}</div>
                                            <div class="variant">
                                                {{ $item?->stock?->type?->name }}: {{ $item?->stock?->value }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="text-center align-middle">
                                    {{ $item->quantity }}
                                </td>

                                <td class="text-end align-middle">
                                    TK {{ number_format($item->total, 2) }}<br>
                                    <span class="badge text-bg-secondary mt-1">{{ $item->status }}</span>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
