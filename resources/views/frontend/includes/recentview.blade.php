<!-- viewed_products_section - start
            ================================================== -->

@php
    $viewedProducts = DB::table('products')->where('status', 1)->inRandomOrder()->take(6)->get()->chunk(3);
@endphp
<section class="viewed_products_section section_space">
    <div class="container">

        <div class="sec-title-link mb-0">
            <h3>Recently Viewed Products</h3>
        </div>

        <div class="viewed_products_wrap arrows_topright">
            <div class="viewed_products_carousel row" data-slick='{"dots": false}'>
                @foreach ($viewedProducts as $productChunk)
                    @foreach ($productChunk as $data)
                        <div class="slider_item col">
                            <div class="viewed_product_item">
                                <div class="item_image">
                                    <img src="{{ asset('backend') }}/product/{{$data->thumbnails}}" 
                                        alt="image_not_found">
                                </div>
                                <div class="item_content">
                                    <h4><a href="#">{{ $data->product_name }}</a></h4>
                                    <p><a href="#">{{ $data->short_description }}</a></p>
                                    <span class="price">
                                        <ins>
                                            <span class="woocommerce-Price-amount amount">
                                                <bdi>
                                                    <span
                                                        class="woocommerce-Price-currencySymbol">৳</span>{{ $data->product_price }}
                                                </bdi>
                                            </span>
                                        </ins>
                                    </span>
                                    <div class="add-cart-area">
                                        <button value="{{ $data->id }}" class="btnaddtoCart add-to-cart">Add to
                                            cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
            <div class="carousel_nav">
                <button type="button" class="vpc_left_arrow"><i class="fal fa-long-arrow-alt-left"></i></button>
                <button type="button" class="vpc_right_arrow"><i class="fal fa-long-arrow-alt-right"></i></button>
            </div>
        </div>
    </div>
</section>
<!-- viewed_products_section - end
            ================================================== -->
