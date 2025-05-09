
<!doctype html>
<html lang="en">
<head>
    @include('frontend.includes.head')
    @include('frontend.includes.css')
    </head>

<body>

    <!-- body_wrap - start -->
    <div class="body_wrap">
        
        <!-- backtotop - start -->
        <div class="backtotop">
            <a href="#" class="scroll">
                <i class="far fa-arrow-up"></i>
            </a>
        </div>
        <!-- backtotop - end -->

        <!-- preloader - start -->
        <div id="preloader"></div>
        <!-- preloader - end -->

        
        <!-- header_section - start
        ================================================== -->
        @include('frontend.includes.header_top')
        <!-- header_section - end
        ================================================== -->
        
        <!-- main body - start
        ================================================== -->
        <main>
          
            @yield('content')
            <!-- newsletter_section - start
            ================================================== -->
            @include('frontend.includes.subscribe')
            <!-- newsletter_section - end
            ================================================== -->
        
        </main>
        <!-- main body - end
        ================================================== -->
        
        <!-- footer_section - start
        ================================================== -->
        @include('frontend.includes.footer')
        <!-- footer_section - end
        ================================================== -->

    </div>
    <!-- body_wrap - end -->
    @include('frontend.includes.script')
   
</body>
</html>