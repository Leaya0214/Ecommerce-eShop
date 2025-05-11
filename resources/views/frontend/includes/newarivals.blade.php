 <!-- new_arrivals_section - start
            ================================================== -->

            @php
                $newArrivals = DB::table('products')->where('status', 1)->latest()->take(4)->get();
                $newArrivals1 = DB::table('products')->where('status', 1)->latest()->first();
                
            @endphp
            <section class="new_arrivals_section section_space">
                <div class="container">
                    <div class="sec-title-link">
                        <h3>New Arrivals</h3>
                    </div>
                    
                    <div class="row newarrivals_products">
                        {{-- <div class="col col-lg-5">
                            <div class="deals_product_layout1">
                                <div class="bg_area">
                                    <h3 class="item_title">Best <span>Product</span> Deals</h3>
                                    <p>
                                        Get a 20% Cashback when buying From eShop.
                                    </p>
                                        <button value="{{ $newArrivals1->id }}" class="btnaddtoCart add-to-cart">Add to cart</button>
                                </div>
                            </div>
                        </div> --}}
                        
                        <div class="col col-lg-12">
                            <div class="new-arrivals-grids clearfix">
                                @foreach($newArrivals as $data)
                                <div class="grid">
                                    <div class="product-pic">
                                        <img src="{{ asset('backend') }}/product/{{$data->thumbnails}}" alt>
                                        <div class="actions">
                                            <ul>
                                                <li>
                                                    <a href="#"><svg role="img" xmlns="http://www.w3.org/2000/svg" width="48px" height="48px" viewBox="0 0 24 24" stroke="#2329D6" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title>Favourite</title> <path d="M12,21 L10.55,19.7051771 C5.4,15.1242507 2,12.1029973 2,8.39509537 C2,5.37384196 4.42,3 7.5,3 C9.24,3 10.91,3.79455041 12,5.05013624 C13.09,3.79455041 14.76,3 16.5,3 C19.58,3 22,5.37384196 22,8.39509537 C22,12.1029973 18.6,15.1242507 13.45,19.7149864 L12,21 Z"/> </svg></a>
                                                </li>
                                                {{-- <li>
                                                    <a href="#"><svg role="img" xmlns="http://www.w3.org/2000/svg" width="48px" height="48px" viewBox="0 0 24 24" stroke="#2329D6" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title>Shuffle</title> <path d="M21 16.0399H17.7707C15.8164 16.0399 13.9845 14.9697 12.8611 13.1716L10.7973 9.86831C9.67384 8.07022 7.84196 7 5.88762 7L3 7"/> <path d="M21 7H17.7707C15.8164 7 13.9845 8.18388 12.8611 10.1729L10.7973 13.8271C9.67384 15.8161 7.84196 17 5.88762 17L3 17"/> <path d="M19 4L22 7L19 10"/> <path d="M19 13L22 16L19 19"/> </svg></a>
                                                </li> --}}
                                                <li>
                                                    <a class="quickview_btn" data-id="{{ $data->id }}" data-bs-toggle="modal" href="#quickview_popup" role="button" tabindex="0"><svg width="48px" height="48px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" stroke="#2329D6" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title>Visible (eye)</title> <path d="M22 12C22 12 19 18 12 18C5 18 2 12 2 12C2 12 5 6 12 6C19 6 22 12 22 12Z"/> <circle cx="12" cy="12" r="3"/> </svg></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="details">
                                        <h4><a href="#">{{$data->product_name}}</a></h4>
                                        <p><a href="#">{{$data->short_description}}</a></p>
                                        <span class="price">
                                            <ins>
                                                <span class="woocommerce-Price-amount amount">
                                                    <bdi>
                                                        <span class="woocommerce-Price-currencySymbol">৳</span>{{$data->product_price}}
                                                    </bdi>
                                                </span>
                                            </ins>
                                        </span>
                                        <div class="add-cart-area">
                                            <button class="add-to-cart">Add to cart</button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- new_arrivals_section - end
            ================================================== -->
            