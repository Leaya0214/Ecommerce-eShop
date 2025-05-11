@extends('frontend.template.layout')
@section('content')
<section class="cart_section section_space">
    <div class="container">
        @if(count($items) > 0)
        <div class="cart_table">
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $subtotal = 0;
                        $delivery = 20;
                    @endphp
                    
                    @foreach ($items as $item)
                        @php
                            $itemTotal = $item['price'] * $item['quantity'];
                            $subtotal += $itemTotal;
                        @endphp
                        <tr>
                            <td>
                                <div class="cart_product">
                                    <img src="{{ asset('backend/product/' . $item['image']) }}" alt="{{ $item['name'] }}">
                                    {{-- <h3><a href="{{ route('product.details', $item['id']) }}">{{ $item['name'] }}</a></h3> --}}
                                </div>
                            </td>
                            <td class="text-center"><span class="price_text">${{ number_format($item['price'], 2) }}</span></td>
                            <td class="text-center">
                                {{-- <form action="{{ route('cart.update', $item['id']) }}" method="POST"> --}}
                                    @csrf
                                    <div class="quantity_input">
                                        <button type="button" class="input_number_decrement">
                                            <i class="fal fa-minus"></i>
                                        </button>
                                        <input class="input_number_2" type="number" name="quantity" value="{{ $item['quantity'] }}" min="1">
                                        <button type="button" class="input_number_increment">
                                            <i class="fal fa-plus"></i>
                                        </button>
                                    </div>
                                {{-- </form> --}}
                            </td>
                            <td class="text-center"><span class="price_text">${{ number_format($itemTotal, 2) }}</span></td>
                            <td class="text-center">
                                {{-- <form action="{{ route('cart.remove', $item['id']) }}" method="POST"> --}}
                                    {{-- @csrf
                                    @method('DELETE') --}}
                                    <button type="submit" class="remove_btn"><i class="fal fa-trash-alt"></i></button>
                                {{-- </form> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="cart_btns_wrap">
            <div class="row">
                <div class="col col-lg-6">
                    {{-- <form action="{{ route('coupon.apply') }}" method="POST">
                        @csrf --}}
                        <div class="coupon_form form_item mb-0">
                            <input type="text" name="coupon_code" class="txtcoupon" placeholder="Coupon Code..." required>
                            <button type="submit" class="btn btn-dark">Apply Coupon</button>
                            <div class="info_icon">
                                <i class="fas fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Enter your coupon code for discounts"></i>
                            </div>
                        </div>
                    {{-- </form> --}}
                </div>

                <div class="col col-lg-6">
                    <ul class="btns_group ul_li_right">
                        <li><a class="btn border_black" href="">Continue Shopping</a></li>
                        <li><a class="btn btn_dark" href="">Proceed To Checkout</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col col-lg-6">
                <div class="calculate_shipping">
                    <h3 class="wrap_title">Calculate Shipping <span class="icon"><i class="far fa-arrow-up"></i></span></h3>
                    {{-- <form action="{{ route('shipping.calculate') }}" method="POST"> --}}
                        {{-- @csrf --}}
                        <div class="select_option clearfix">
                            <select name="shipping_option" required>
                                <option value="">Select Your Option</option>
                                <option value="inside">Inside City ($10)</option>
                                <option value="outside">Outside City ($20)</option>
                            </select>
                        </div>
                        <br>
                        <button type="submit" class="btn btn_primary rounded-pill">Calculate Shipping</button>
                    {{-- </form> --}}
                </div>
            </div>

            <div class="col col-lg-6">
                <div class="cart_total_table">
                    <h3 class="wrap_title">Cart Totals</h3>
                    <ul class="ul_li_block">
                        <li>
                            <span>Cart Subtotal</span>
                            <span>${{ number_format($subtotal, 2) }}</span>
                        </li>
                        <li>
                            <span>Delivery Charge</span>
                            <span>${{ number_format($delivery, 2) }}</span>
                        </li>
                        @if(session('discount'))
                        <li>
                            <span>Discount ({{ session('coupon_code') }})</span>
                            <span>-${{ number_format(session('discount'), 2) }}</span>
                        </li>
                        @endif
                        <li>
                            <span>Order Total</span>
                            <span class="total_price">${{ number_format($subtotal + $delivery - (session('discount') ?? 0), 2) }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        @else
        <div class="empty_cart text-center">
            <i class="fal fa-shopping-cart fa-4x mb-4"></i>
            <h3>Your cart is empty</h3>
            <p>Looks like you haven't added any items to your cart yet</p>
            {{-- <a href="{{ route('shop') }}" class="btn btn_dark mt-3">Continue Shopping</a> --}}
        </div>
        @endif
    </div>
</section>
@endsection