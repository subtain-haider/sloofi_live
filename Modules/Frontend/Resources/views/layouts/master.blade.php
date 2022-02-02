<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="{{asset('assets/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/frontend/css/all.css')}}" rel="stylesheet">
    <link href="{{asset('assets/frontend/css/owl.carousel.css')}}" rel="stylesheet">
    <link href="{{asset('assets/frontend//css/style.css')}}" rel="stylesheet">
    <title>Hello, world!</title>
</head>
<body>
<!-- Topbar Start -->
<div class="topbar-wrap">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-2">
                <div class="language">Language <span><img src="{{asset('assets/frontend/images/usa-flag.png')}}"></span> /
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
                                <a class="nav-link slolfi_btn" href="#">My Sloofi</a>
                            </li>
                        </ul>


                    </div>
                </nav>
            </div>

            <div class="col-xl-2 col-lg-3">
                <div class="sign-wrap">
                    <span><a href="#">Sign In</a></span>
                    <span class="register"><a href="#">Register</a></span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->
<!-- Header Start -->
<div class="header-wrap">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3  navbar-light">
                <div class="sloofi-logo"><img src="{{asset('assets/frontend/images/sloofi-logo.png')}}"></div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

            </div>
            <div class="col-xl-5 ">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search products by keywords, SKU, Ali Express URL" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <span class="input-group-text" id="basic-addon2"><img src="{{asset('assets/frontend/images/search.png')}}"></span>
                </div>

            </div>
            <div class="col-xl-4">

                <div class="header_btns">
                    <ul>
                        <li><a href="#"><img src="{{asset('assets/frontend/images/cart.png')}}"></a></li>
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
@yield('content')



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
                        <div class="partnerships_img"><img src="{{asset('assets/frontend/images/partnerships_img.png')}}"></div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-4">
                        <div class="partnerships_img"><img src="{{asset('assets/frontend/images/partnerships_img.png')}}"></div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-4">
                        <div class="partnerships_img"><img src="{{asset('assets/frontend/images/partnerships_img.png')}}"></div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-4">
                        <div class="partnerships_img"><img src="{{asset('assets/frontend/images/partnerships_img.png')}}"></div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-4">
                        <div class="partnerships_img"><img src="{{asset('assets/frontend/images/partnerships_img.png')}}"></div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-4">
                        <div class="partnerships_img"><img src="{{asset('assets/frontend/images/partnerships_img.png')}}"></div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-4">
                        <div class="partnerships_img"><img src="{{asset('assets/frontend/images/partnerships_img.png')}}"></div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-4">
                        <div class="partnerships_img"><img src="{{asset('assets/frontend/images/partnerships_img.png')}}"></div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-4">
                        <div class="partnerships_img"><img src="{{asset('assets/frontend/images/partnerships_img.png')}}"></div>
                    </div>


                </div>

            </div>

        </div>


    </div>
</div>




<!-- Bootstrap Bundle with Popper -->
<script src="{{asset('assets/frontend/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/jquery-min.js')}}"></script>
<!-- Load JS siles -->
<script src="{{asset('assets/frontend/js/owl.carousel.js')}}"></script>
<script src="{{asset('assets/frontend/js/script.js')}}"></script>

</body>
</html>

