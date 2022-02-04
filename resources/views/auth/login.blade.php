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

    <title>Sloofi | Login</title>
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
                            <h4 class="mt-5">Welcome!</h4>
                            <p>Enter your details and start journey with us</p>
                            <div class="signup readmore mt-5"><a href="{{route('register')}}">SIGNUP</a></div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-6 col-lg-6 col-md-12 align-items-center ">
                    <div class="login-form mtb-110">
                        <div class="login-title">
                            <h2>Login please</h2>
                        </div>
                        <div class="form-sec">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="mb-4">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus aria-describedby="emailHelp" placeholder="Input your user ID or Email">
                                    <i class="fas fa-envelope input-icon"></i>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mb-5">
                                    <input type="password" class="form-control" lass="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Input your password">
                                    <i class="fas fa-key input-icon"></i>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="bottom-sec mb-5">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Remember me</label>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <a class="ms-auto form-check-label" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                                <div class="btn-section">
                                    <button type="submit" class="btn btn-primary"> <i class="fas fa-sign-in-alt"></i> LOG IN</button>
                                </div>
                            </form>
                            <div class="connect-with">
                                <h6><span>OR Connect With</span></h6>
                                <div class="social-links">
                                    <a class="social-link facebook" href="#">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a class="social-link twitter" href="#">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a class="social-link envelope" href="#">
                                        <i class="far fa-envelope"></i>
                                    </a>
                                    <a class="social-link apple" href="#">
                                        <i class="fab fa-apple"></i>
                                    </a>
                                </div>
                                <div class="login-fotter-links"><a href="#">Create New Account</a></div>
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
            <li><a href="#"><img src="{{url('/frontend')}}/images/home-icon.png"></a></li>
            <li class="product-box"><a href="#"><img src="{{url('/frontend')}}/images/product-icon.png"> Products</a></li>
            <li><a href="#"><img src="{{url('/frontend')}}/images/cart-icon.png"></a></li>
            <li><a href="#"><img src="{{url('/frontend')}}/images/user-icon.png"></a></li>
        </ul>

    </div>
</div>
<!-- Footer Fix Start -->

<!-- Bootstrap Bundle with Popper -->
<script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery-min.js') }}"></script>
<script defer src="{{ asset('frontend/js/jquery.flexslider.js') }}"></script>
<script defer src="{{ asset('frontend/js/common.js') }}"></script>
<script src="{{ asset('frontend/js/owl.carousel.js') }}"></script>
<script src="{{ asset('frontend/js/script.js') }}"></script>


</body>

</html>