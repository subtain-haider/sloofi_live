<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="{{ asset('/frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/frontend/css/all.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/frontend/css/flexslider.css') }}" />
    <link href="{{ asset('/frontend/css/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('/frontend/css/style.css') }}" rel="stylesheet">

    <title>Sloofi | Register</title>
</head>

<body>



<section class="login-section">
    <div class="container">
        <div class="innerLogin">

            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12 align-items-center float-right">
                    <div class="about-img-pro" style="background-image:url({{url('/frontend')}}/images/right_side_img.png)"></div>
                    <div class="login-right">
                        <div class="login_wrp">
                            <div class="login_logo"><a href="/"><img src="{{url('/frontend')}}/images/sloofi_login.png"></a></div>
                            <h4 class="mt-5">welcome!</h4>
                            <p>Enter your details and start journey with us</p>
                            <div class="signup readmore mt-5"><a href="{{route('login')}}">SIGN IN</a></div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-6 col-lg-6 col-md-12 align-items-center">
                    <div class="login-form mtb-110">
                        <div class="login-title">
                            <h2>  Register Account</h2>
                        </div>
                        <div class="form-sec">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="mb-4">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Full Name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    <i class="fas fa-user input-icon"></i>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email">
                                    <i class="fas fa-envelope input-icon"></i>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="new-password">
                                    <i class="fas fa-key input-icon"></i>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                                    <i class="fas fa-key input-icon"></i>

                                </div>
                                <div class="btn-section">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-user-plus"></i> REGISTER</button>
                                </div>
                            </form>
                            <div class="connect-with">
                                <div class="login-fotter-links"><a href="{{route('login')}}">Already Have Account</a></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- Footer Fix Start -->
<div class="footer_fix">
    <div class="container">
        <ul>
            <li><a href="#"><img src="images/home-icon.png"></a></li>
            <li class="product-box"><a href="#"><img src="images/product-icon.png"> Products</a></li>
            <li><a href="#"><img src="images/cart-icon.png"></a></li>
            <li><a href="#"><img src="images/user-icon.png"></a></li>
        </ul>

    </div>
</div>
<!-- Footer Fix Start -->

<!-- Bootstrap Bundle with Popper -->
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/jquery-min.js"></script>
<script defer src="js/jquery.flexslider.js"></script>
<script defer src="js/common.js"></script>
<script defer src="js/script.js"></script>

</body>

</html>