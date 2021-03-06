<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="{{ asset('/frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/frontend/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('/frontend/css/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('/frontend/css/style.css') }}" rel="stylesheet">
    <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=61fd9f8e97a9c5001998eb2b&product=inline-share-buttons" async="async"></script>
    <title>Sloofi</title>
      @yield('css')
      <style>
          @media screen and (max-width : 1920px){
              .div-only-mobile{
                  visibility:hidden;
              }
          }
          @media screen and (max-width : 906px){
              .desk{
                  visibility:hidden;
              }
              .div-only-mobile{
                  visibility:visible;
              }
          }
      </style>
  </head>
  <body>
    <!-- Topbar Start -->
    <div class="topbar-wrap">
      <div class="container-fluid">
        <div class="row">
          <div class="col-xl-2">
            <div class="language">Language <span><img src="{{ asset('/frontend/images/usa-flag.png')}}"></span> /
            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
              USD
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="#">English</a></li>
                <li><a class="dropdown-item" href="#">Arabic</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-xl-8 col-lg-9">
          <nav class="navbar navbar-expand-lg navbar-light">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <button class="close-toggler" type="button" data-toggle="offcanvas"> <span><i class="fas fa-times" aria-hidden="true"></i></span> </button>
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  @if(!Auth::user())
                  <li class="nav-item div-only-mobile desk">
                      <a class="nav-link" href="{{url('/register')}}">Sign Up</a>
                  </li>
                  <li class="nav-item div-only-mobile desk">
                      <a class="nav-link" href="{{url('/login')}}">Login</a>
                  </li>
                  @else
                      <li class="nav-item div-only-mobile desk">
                          <a class="nav-link" href="javascript:void(0)" onclick="$('#logout-form').submit();">
                              Logout
                          </a>
                      </li>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                  @endif
                  <li class="nav-item">
                      <a class="nav-link" href="#">Print on Demand</a>
                  </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Authorization
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                  </ul>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Wishlist</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Warehouses
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>

                  </ul>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Print on Demand</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Sourcing</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link slolfi_btn" href="{{route('dashboard')}}">My Sloofi</a>
                </li>
              </ul>


            </div>
          </nav>
        </div>

          @if(!\Illuminate\Support\Facades\Auth::user())
        <div class="col-xl-2 col-lg-3">
          <div class="sign-wrap">
            <span><a href="{{route('login')}}">Sign In</a></span>
            <span class="register"><a href="{{route('register')}}">Register</a></span>
          </div>
        </div>
            @else
                <div class="col-xl-2 col-lg-3">
                <div class="sign-wrap">
                    <span><a href="javascript:void(0)" onclick="$('#logout-form').submit();">
                    Logout
                </a></span>
                </div>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endif
      </div>
    </div>
  </div>
  <!-- Topbar End -->
  <!-- Header Start -->
  <div class="header-wrap">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-3  navbar-light">
            <div class="sloofi-logo"><a href="{{url('/')}}"><img src="{{ asset('/frontend/images/sloofi-logo.png')}}"></a></div>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
          </button>

        </div>
        <div class="col-xl-5 ">
            <form action="{{route('frontend.search-product')}}" id="search-form">
              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search products by keywords, SKU, Ali Express URL" aria-label="Recipient's username" aria-describedby="basic-addon2" name="search" required>
                <span class="input-group-text" id="basic-addon2"><a href="javascript:void(0)" onclick="$('#search-form').submit();"><img src="{{ asset('/frontend/images/search.png')}}"></span></a>
              </div>
            </form>
        </div>
        <div class="col-xl-4">

          <div class="header_btns">
            <ul>
              <li><a href="{{route('frontend.cart')}}"><img src="{{ asset('/frontend/images/cart.png')}}"></a></li>
              <li><a href="#">Source More</a></li>
              <li><a href="#">Categories</a></li>
              <li><a href="#">Our Services</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Header End -->
  <!-- Slider Section Start -->
    <div class="col-lg-12">
        @if(session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session()->get('success') }}
            </div>
        @endif
    </div>

    </div>
  @yield('content')
  <!-- Products End -->
  <!-- App Start -->
  <div class="app_wrap">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-5">
          <h3>Put Sloofi into your pocket</h3>
          <div class="app_sec row">
            <div class="col-lg-5">
              <div class="qr_check"><img src="{{ asset('/frontend/images/qr_check.png')}}"></div>
            </div>
            <div class="col-lg-7">
              <div class="appstore">
                <span><img src="{{ asset('/frontend/images/app_store.png')}}"></span> <span><img src="{{ asset('/frontend/images/app_store2.png')}}"></span></div>
              </div>
            </div>
            <div class="scanText">Scan the QR code to download Sloofi for Mobile.</div>
          </div>
          <div class="col-lg-7">
            <div class="app_img"><img src="{{ asset('/frontend/images/sloofi_app.png')}}"></div>
          </div>
        </div>
      </div>
    </div>
    <!-- App End -->
    <!-- Shipment Start -->
    <div class="shipmentWrp">
      <div class="container-fluid">
        <h3>You sell your products <span>We source & ship for you!</span></h3>
        <div class="tagline">We will source your products in lowest price and highest quality worldwide.</div>
        <div class="row">
          <div class="col-lg-3">
            <div class="ship_sec mt-5">
              <div class="shipImg"><img src="{{ asset('/frontend/images/warehouse.jpg')}}"></div>
              <div class="warehouse_info">
                <h5>Globel Warehouse</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus luctus hendrerit quam, non pellentesque purus efficitur nec. </p>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="ship_sec">
              <div class="shipImg"><img src="{{ asset('/frontend/images/service.jpg')}}"></div>
              <div class="warehouse_info">
                <h5 class="service_heading">Professional Dropshipping Services</h5>
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="ship_sec mt-5">
              <div class="shipImg"><img src="{{ asset('/frontend/images/delivery.jpg')}}"></div>
              <div class="warehouse_info">
                <h5>Efficient Delivery</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus luctus hendrerit quam, non pellentesque purus efficitur nec. </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Shipment End -->

    <div class="track_wrp">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6">
            <div class="sloofi_van"><img src="{{ asset('/frontend/images/sloofi_van.png')}}"></div>
          </div>
          <div class="col-lg-6">
            <div class="input-group mb-3 mt-120">
              <input type="text" class="form-control" placeholder="Please enter the tracking number" aria-label="Recipient's username" aria-describedby="basic-addon2">
              <span class="input-group-text" id="basic-addon2">Track Product</span>
            </div>
            <div class="readmore text-center mt-5 ship_btn"><a href="#">Shipping Cost & Time</a></div>
          </div>
        </div>
      </div>
    </div>
    <div class="partner_wrp">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6">
            <h3>Sloofi <span>
            Partnerships</span></h3>
            <div class="readmore"><a href="#">Partner Network</a> <a class="btn_bg" href="#">Affiliate Program</a></div>
          </div>
          <div class="col-lg-6">
            <div class="row">
              <div class="col-lg-4 col-md-4 col-4">
                <div class="partnerships_img"><img src="{{ asset('/frontend/images/partnerships_img.png')}}"></div>
              </div>
              <div class="col-lg-4 col-md-4 col-4">
                <div class="partnerships_img"><img src="{{ asset('/frontend/images/partnerships_img2.png')}}"></div>
              </div>
              <div class="col-lg-4 col-md-4 col-4">
                <div class="partnerships_img"><img src="{{ asset('/frontend/images/partnerships_img3.png')}}"></div>
              </div>
              <div class="col-lg-4 col-md-4 col-4">
                <div class="partnerships_img"><img src="{{ asset('/frontend/images/partnerships_img4.png')}}"></div>
              </div>
              <div class="col-lg-4 col-md-4 col-4">
                <div class="partnerships_img"><img src="{{ asset('/frontend/images/partnerships_img5.png')}}"></div>
              </div>
              <div class="col-lg-4 col-md-4 col-4">
                <div class="partnerships_img"><img src="{{ asset('/frontend/images/partnerships_img6.png')}}"></div>
              </div>
              <div class="col-lg-4 col-md-4 col-4">
                <div class="partnerships_img"><img src="{{ asset('/frontend/images/partnerships_img7.png')}}"></div>
              </div>
              <div class="col-lg-4 col-md-4 col-4">
                <div class="partnerships_img"><img src="{{ asset('/frontend/images/partnerships_img8.png')}}"></div>
              </div>
              <div class="col-lg-4 col-md-4 col-4">
                <div class="partnerships_img"><img src="{{ asset('/frontend/images/partnerships_img9.png')}}"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


<!-- Footer Fix Start -->
<div class="footer_fix">
  <div class="container">
      @php
      $menu='Home';
      $url=URL::full();
        if(str_contains($url,'cart')){
            $menu='Cart';
        }
        elseif(str_contains($url,'profile')){
            $menu='Profile';
        }elseif(str_contains($url,'search-product')){
            $menu='Products';
        }


      @endphp
    <ul>
      <li class="menu-item @if($menu=='Home') product-box  @endif " id="home_li" onclick="mobileMenu('Home')"><a href="{{url('/')}}"><img src="{{ asset('/frontend/images/home-icon.png')}}"><span class="menu-item-text">@if($menu=='Home'){{$menu}}@endif</span></a></li>
      <li class="menu-item @if($menu=='Products') product-box @endif " id="products_li" onclick="mobileMenu('Products')"><a href="{{route('frontend.search-product')}}"><img src="{{ asset('/frontend/images/product-icon.png')}}"><span class="menu-item-text">@if($menu=='Products'){{$menu}}@endif</span></a></li>
      <li class="menu-item @if($menu=='Cart')product-box @endif " id="cart_li" onclick="mobileMenu('Cart')"><a href="{{route('frontend.cart')}}"><img src="{{ asset('/frontend/images/cart-icon.png')}}"><span class="menu-item-text">@if($menu=='Cart'){{$menu}}@endif</span></a></li>
      <li class="menu-item @if($menu=='Profile') product-box @endif " id="profile_li" onclick="mobileMenu('Profile')"><a href="{{route('user.profile')}}"><img src="{{ asset('/frontend/images/user-icon.png')}}"><span class="menu-item-text">@if($menu=='Profile'){{$menu}}@endif</span></a></li>
    </ul>
  </div>
</div>
<!-- Footer Fix Start -->






    <!-- Bootstrap Bundle with Popper -->
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery-min.js') }}"></script>
    <!-- Load JS siles -->
    <script src="{{ asset('frontend/js/owl.carousel.js') }}"></script>
    <script src="{{ asset('frontend/js/script.js') }}"></script>
    <script>
        function mobileMenu(menu){
            $('.menu-item').each(function (){
                $(this).removeClass('product-box')
            })
            $('.menu-item-text').each(function (){
                $(this).html('')
            })
            if(menu=='Products'){
                $('#products_li').addClass('product-box');
            }
            if(menu=='Cart'){
                $('#cart_li').addClass('product-box');
            }
            if(menu=='Profile'){
                $('#profile_li').addClass('product-box');
            }
            if(menu=='Home'){
                $('#home_li').addClass('product-box');
            }
        }
    </script>
    @yield('js')
  </body>
</html>
