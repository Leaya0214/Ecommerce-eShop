 <div class="header_top">
            <div class="container">
                <div class="row align-items-center">
                   <!-- Left Side: Shop Info -->
                    <div class="col col-md-6">
                        <div class="d-flex align-items-center">
                            <!-- Logo -->
                            {{-- <div class="brand_logo me-3">
                                <a class="brand_link" href="{{ url('/') }}">
                                    <img src="{{ asset('frontend/assets/images/logo/logo1.png') }}" 
                                        alt="Logo" 
                                        style="height: 70px; width: 70px;">
                                </a>
                            </div> --}}
                            <!-- Shop Name & Tagline -->
                            <div class="shop_info text-white">
                                <p style="margin-top: 5px" class="text-white"> Welcome to <strong>eShop</strong></small>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side: Contact Info -->
                    <div class="col col-md-6 text-md-end">
                        <p class="header_hotline mb-0 text-white">
                            📞 Customer Support: <strong>+880 1700 123 456</strong><br>
                            ✉️ Email: <strong>support@eshop.com</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
            <div class="header_middle">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col col-lg-3 col-md-3 col-sm-12">
                            <div class="d-flex align-items-center">
                            <!-- Logo -->
                            {{-- <div class="brand_logo me-3">
                                <a class="brand_link" href="{{ url('/') }}">
                                    <img src="{{ asset('frontend/assets/images/logo/logo1.png') }}" 
                                        alt="Logo" 
                                        style="height: 70px; width: 70px;">
                                </a>
                            </div> --}}
                            <!-- Shop Name & Tagline -->
                            <div class="shop_info">
                                <h5 class="mb-0 fw-bold">eShop</h5>
                                <small class="">  <strong>eShop</strong> – Your trusted online store.</small>
                            </div>
                        </div>
                        </div>
                        <div class="col col-lg-6 col-md-6 col-sm-12">
                            <form action="{{ route('category.search') }}" method="GET">
                                <div class="advance_serach">
                                    <div class="select_option mb-0 clearfix">
                                        <select>
                                            <option data-display="All Categories">Select A Category</option>
                                            @foreach($categories as $categorie)
                                                <option value="1">{{$categorie->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form_item">
                                        <input type="search" name="search" placeholder="Search Prudcts...">
                                        <button type="submit" class="search_btn"><i class="far fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col col-lg-3 col-md-3 col-sm-12">
                            <button class="mobile_menu_btn2 navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_menu_dropdown" aria-controls="main_menu_dropdown" aria-expanded="false" aria-label="Toggle navigation">
                                <i class="fal fa-bars"></i>
                            </button>
                            <button type="button" class="cart_btn">
                               <ul class="header_icons_group ul_li_right">
                                    <li>
                                        <a href="wishlist.html">
                                            <svg role="img" xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 24 24" stroke="#051d43" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title>Favourite</title> <path d="M12,21 L10.55,19.7051771 C5.4,15.1242507 2,12.1029973 2,8.39509537 C2,5.37384196 4.42,3 7.5,3 C9.24,3 10.91,3.79455041 12,5.05013624 C13.09,3.79455041 14.76,3 16.5,3 C19.58,3 22,5.37384196 22,8.39509537 C22,12.1029973 18.6,15.1242507 13.45,19.7149864 L12,21 Z"/> </svg>
                                            <span class="wishlist_counter">3</span>
                                        </a>
                                    </li>
                                    <li>
                                        <span class="cart_icon">
                                            <i class="icon icon-ShoppingCart"></i>
                                            <small class="cart_counter"></small>
                                        </span>
                                    </li>
                               </ul>
                            </button>
                        </div>
                    </div>
                </div>
            </div>