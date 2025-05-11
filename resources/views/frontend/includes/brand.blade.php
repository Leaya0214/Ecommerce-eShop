 <!-- brand_section - start
            ================================================== -->
            @php
                $brands = App\Models\Brand::all();
            @endphp
            <div class="brand_section pb-0">
                <div class="container">
                    <div class="brand_carousel">
                        @foreach($brands as $brand)
                        <div class="slider_item">
                            <a class="product_brand_logo" href="#!">
                                <img src="{{ asset('backend') }}/brand/{{$brand->logo}}" alt="image_not_found">
                                <img src="{{ asset('backend') }}/brand/{{$brand->logo}}" alt="image_not_found">
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- brand_section - end
            ================================================== -->
            