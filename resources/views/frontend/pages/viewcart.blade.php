@extends('frontend.template.layout')
@section('content')
<section class="cart_section section_space">
    <div class="container">

        <div class="cart_table">
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">Remove</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $subtotal = 0;
                    $delivery = 20;
                    $total = 0;
                    ?>
                    @foreach ($items as $item)
                        <?php
                        $subtotal += $item['price'] * $item['quantity'];
                        
                        ?>
                        <tr>
                            <td>
                                <div class="cart_product">
                                    <img src="{{ asset('backend/product/' . $item['image']) }}" alt="image_not_found">
                                    <h3><a href="shop_details.html">{{ $item['name'] }}</a></h3>
                                </div>
                            </td>
                            <td class="text-center"><span class="price_text">${{ $item['name'] }}</span></td>
                            <td class="text-center">
                                <form action="#">
                                    <div class="quantity_input">
                                        <button type="button" class="input_number_decrement">
                                            <i class="fal fa-minus"></i>
                                        </button>
                                        <input class="input_number_2" type="text" value="{{ $item['quantity'] }}">
                                        <button type="button" class="input_number_increment">
                                            <i class="fal fa-plus"></i>
                                        </button>
                                    </div>
                                </form>
                            </td>
                            <td class="text-center"><span class="price_text">${{ $item['price'] }}</span></td>
                            <td class="text-center"><button type="button" class="remove_btn"><i
                                        class="fal fa-trash-alt"></i></button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="cart_btns_wrap">
            <div class="row">
                <div class="col col-lg-6">
                    <div class="coupon_form form_item mb-0">
                        <input type="text" class="txtcoupon" placeholder="Coupon Code...">
                        <button type="button" class="btnapplycoupon btn btn-dark">Apply Coupon</button>
                        <div class="info_icon">
                            <i class="fas fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Your Info Here"></i>
                        </div>
                    </div>
                </div>

                <div class="col col-lg-6">
                    <ul class="btns_group ul_li_right">
                        <li><a class="btn border_black" href="#!">Update Cart</a></li>
                        <li><a class="btn btn_dark" href="{{ route('exampleHostedCheckout') }}">Prceed To Checkout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        majid
        <button class="your-button-class btn btn-info" id="sslczPayBtn" token="if you have any token validation"
            postdata="your javascript arrays or objects which requires in backend"
            order="If you already have the transaction generated for current order" endpoint="/pay-via-ajax"> Pay Now
        </button>
        <div class="row">
            <div class="col col-lg-6">
                <div class="calculate_shipping">
                    <h3 class="wrap_title">Calculate Shipping <span class="icon"><i
                                class="far fa-arrow-up"></i></span></h3>
                    <form action="#">
                        <div class="select_option clearfix">
                            <select>
                                <option value="">Select Your Option</option>
                                <option value="1">Inside City</option>
                                <option value="2">Outside City</option>
                            </select>
                        </div>
                        <br>
                        <button type="submit" class="btn btn_primary rounded-pill">Update Total</button>
                    </form>
                </div>
            </div>

            <div class="col col-lg-6">
                <div class="cart_total_table">
                    <h3 class="wrap_title">Cart Totals</h3>
                    <ul class="ul_li_block">
                        <li>
                            <span>Cart Subtotal</span>
                            <span class="cartsubtotal">{{ $subtotal }}</span>
                        </li>
                        <li>
                            <span>Delivery Charge</span>
                            <span class="delivery">{{ $delivery }}</span>
                        </li>
                        <li>
                            <span>Order Total</span>
                            <span class="total_price">{{ $subtotal + $delivery }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
