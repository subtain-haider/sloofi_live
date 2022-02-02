@extends('frontend::layouts.master')
@section('content')
    <div class="sliderSec-wrap">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3">
                    <div class="categories_wrp">
                        <h3>All Categories</h3>
                        <ul class="categoryList">

                            <li><a href="#">Computer & Office</a></li>
                            <li><a href="#">Bags & Shoes</a></li>
                            <li><a href="#">Jewelry & Watches</a></li>
                            <li><a href="#">Health, Beauty & Hair</a></li>
                            <li><a href="#">Women's Clothing</a></li>
                            <li><a href="#">Sports & Outdoors</a></li>
                            <li><a href="#">Home, Garden & Furniture</a></li>
                            <li><a href="#">Home Improvement</a></li>
                            <li><a href="#">Automobiles & Motorcycles</a></li>
                            <li><a href="#">Toys, Kids & Babies</a></li>
                            <li><a href="#">Men's Clothing</a></li>
                            <li><a href="#">Consumer Electronics</a></li>
                            <li><a href="#">Phones & Accessories</a></li>

                        </ul>


                        <ul class="mobile_categories row">

                            <li class="col-md-4 col-6"><span><img src="{{asset('assets/frontend/images/cateImg.png')}}"></span><a href="#"> Computer & Office</a></li>
                            <li class="col-md-4 col-6"><span><img src="{{asset('assets/frontend/images/cateImg.png')}}"></span><a href="#"> Bags & Shoes</a></li>
                            <li class="col-md-4 col-6"><span><img src="{{asset('assets/frontend/images/cateImg.png')}}"></span><a href="#"> Jewelry & Watches</a></li>
                            <li class="col-md-4 col-6"><span><img src="{{asset('assets/frontend/images/cateImg.png')}}"></span><a href="#"> Health, Beauty & Hair</a></li>
                            <li class="col-md-4 col-6"><span><img src="{{asset('assets/frontend/images/cateImg.png')}}"></span><a href="#"> Women's Clothing</a></li>
                            <li class="col-md-4 col-6"><span><img src="{{asset('assets/frontend/images/cateImg.png')}}"></span><a href="#"> Sports & Outdoors</a></li>
                            <li class="col-md-4 col-6"><span><img src="{{asset('assets/frontend/images/cateImg.png')}}"></span><a href="#"> Home, Garden & Furniture</a></li>
                            <li class="col-md-4 col-6"><span><img src="{{asset('assets/frontend/images/cateImg.png')}}"></span><a href="#"> Home Improvement</a></li>
                            <li class="col-md-4 col-6"><span><img src="{{asset('assets/frontend/images/cateImg.png')}}"></span><a href="#"> Automobiles & Motorcycles</a></li>
                            <li class="col-md-4 col-6"><span><img src="{{asset('assets/frontend/images/cateImg.png')}}"></span><a href="#"> Toys, Kids & Babies</a></li>
                            <li class="col-md-4 col-6"><span><img src="{{asset('assets/frontend/images/cateImg.png')}}"></span><a href="#"> Men's Clothing</a></li>
                            <li class="col-md-4 col-6"><span><img src="{{asset('assets/frontend/images/cateImg.png')}}"></span><a href="#"> Consumer Electronics</a></li>


                        </ul>




                    </div>
                </div>

                <div class="col-xl-5">
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 6"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{asset('assets/frontend/images/slider.jpg')}}" class="d-block w-100" alt="">
                            </div>
                            <div class="carousel-item">
                                <img src="{{asset('assets/frontend/images/slider2.jpg')}}" class="d-block w-100" alt="">
                            </div>
                            <div class="carousel-item">
                                <img src="{{asset('assets/frontend/images/slider.jpg')}}" class="d-block w-100" alt="">
                            </div>
                            <div class="carousel-item">
                                <img src="{{asset('assets/frontend/images/slider2.jpg')}}" class="d-block w-100" alt="">
                            </div>
                            <div class="carousel-item">
                                <img src="{{asset('assets/frontend/images/slider.jpg')}}" class="d-block w-100" alt="">
                            </div>
                            <div class="carousel-item">
                                <img src="{{asset('assets/frontend/images/slider2.jpg')}}" class="d-block w-100" alt="">
                            </div>
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>

                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="welcome_box">
                        <div class="sloofi-icon"><img src="{{asset('assets/frontend/images/sloofi-icon.png')}}"></div>
                        <h3>Welcome to Sloofi!</h3>
                        <div class="sign_btns">
                            <span><a href="#">Sign In</a></span>
                            <span><a href="#">Sign In</a></span>
                        </div>
                    </div>
                    <div class="help_center">
                        <div class="help_heading">
                            <h4>Help Center</h4>
                            <div class="view_more"><a href="">View More <i class="fas fa-chevron-right"></i></a></div>
                        </div>
                        <ul>
                            <li>Lorem ipsum dolor sit amet</li>
                            <li>Lorem ipsum dolor sit amet</li>
                            <li>Lorem ipsum dolor sit amet</li>
                            <li>Lorem ipsum dolor sit amet</li>
                            <li>Lorem ipsum dolor sit amet</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Slider Section Start -->
    <!-- Products Start -->
    <div class="products-wrap">
        <div class="container-fluid">
            <!-- Super Deals Start -->
            <div class="product_sec">
                <h3>Super Deals</h3>
                <ul class="owl-carousel">
                    <li class="item">
                        <div class="product_list">
                            <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                            <div class="product_box">
                                <div class="product_info">
                                    <h4>Automobiles & Motorcycles 123456...</h4>
                                    <p>List 1</p>
                                    <div class="pricetext">$0.62-6.52</div>
                                    <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                                    <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product_list">
                            <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                            <div class="product_box">
                                <div class="product_info">
                                    <h4>Automobiles & Motorcycles 123456...</h4>
                                    <p>List 1</p>
                                    <div class="pricetext">$0.62-6.52</div>
                                    <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                                    <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product_list">
                            <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                            <div class="product_box">
                                <div class="product_info">
                                    <h4>Automobiles & Motorcycles 123456...</h4>
                                    <p>List 1</p>
                                    <div class="pricetext">$0.62-6.52</div>
                                    <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                                    <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product_list">
                            <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                            <div class="product_box">
                                <div class="product_info">
                                    <h4>Automobiles & Motorcycles 123456...</h4>
                                    <p>List 1</p>
                                    <div class="pricetext">$0.62-6.52</div>
                                    <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                                    <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product_list">
                            <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                            <div class="product_box">
                                <div class="product_info">
                                    <h4>Automobiles & Motorcycles 123456...</h4>
                                    <p>List 1</p>
                                    <div class="pricetext">$0.62-6.52</div>
                                    <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                                    <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product_list">
                            <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                            <div class="product_box">
                                <div class="product_info">
                                    <h4>Automobiles & Motorcycles 123456...</h4>
                                    <p>List 1</p>
                                    <div class="pricetext">$0.62-6.52</div>
                                    <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                                    <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- Super Deals End -->
            <!-- Trending Products Start -->
            <div class="product_sec">
                <h3>Trending Products</h3>
                <ul class="owl-carousel">
                    <li class="item">
                        <div class="product_list">
                            <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                            <div class="product_box">
                                <div class="product_info">
                                    <h4>Automobiles & Motorcycles 123456...</h4>
                                    <p>List 1</p>
                                    <div class="pricetext">$0.62-6.52</div>
                                    <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                                    <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product_list">
                            <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                            <div class="product_box">
                                <div class="product_info">
                                    <h4>Automobiles & Motorcycles 123456...</h4>
                                    <p>List 1</p>
                                    <div class="pricetext">$0.62-6.52</div>
                                    <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                                    <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product_list">
                            <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                            <div class="product_box">
                                <div class="product_info">
                                    <h4>Automobiles & Motorcycles 123456...</h4>
                                    <p>List 1</p>
                                    <div class="pricetext">$0.62-6.52</div>
                                    <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                                    <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product_list">
                            <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                            <div class="product_box">
                                <div class="product_info">
                                    <h4>Automobiles & Motorcycles 123456...</h4>
                                    <p>List 1</p>
                                    <div class="pricetext">$0.62-6.52</div>
                                    <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                                    <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product_list">
                            <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                            <div class="product_box">
                                <div class="product_info">
                                    <h4>Automobiles & Motorcycles 123456...</h4>
                                    <p>List 1</p>
                                    <div class="pricetext">$0.62-6.52</div>
                                    <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                                    <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product_list">
                            <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                            <div class="product_box">
                                <div class="product_info">
                                    <h4>Automobiles & Motorcycles 123456...</h4>
                                    <p>List 1</p>
                                    <div class="pricetext">$0.62-6.52</div>
                                    <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                                    <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- Trending Products End -->
            <!-- New Products Start -->
            <div class="product_sec">
                <h3>New Products</h3>
                <ul class="owl-carousel">
                    <li class="item">
                        <div class="product_list">
                            <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                            <div class="product_box">
                                <div class="product_info">
                                    <h4>Automobiles & Motorcycles 123456...</h4>
                                    <p>List 1</p>
                                    <div class="pricetext">$0.62-6.52</div>
                                    <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                                    <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product_list">
                            <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                            <div class="product_box">
                                <div class="product_info">
                                    <h4>Automobiles & Motorcycles 123456...</h4>
                                    <p>List 1</p>
                                    <div class="pricetext">$0.62-6.52</div>
                                    <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                                    <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product_list">
                            <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                            <div class="product_box">
                                <div class="product_info">
                                    <h4>Automobiles & Motorcycles 123456...</h4>
                                    <p>List 1</p>
                                    <div class="pricetext">$0.62-6.52</div>
                                    <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                                    <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product_list">
                            <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                            <div class="product_box">
                                <div class="product_info">
                                    <h4>Automobiles & Motorcycles 123456...</h4>
                                    <p>List 1</p>
                                    <div class="pricetext">$0.62-6.52</div>
                                    <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                                    <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product_list">
                            <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                            <div class="product_box">
                                <div class="product_info">
                                    <h4>Automobiles & Motorcycles 123456...</h4>
                                    <p>List 1</p>
                                    <div class="pricetext">$0.62-6.52</div>
                                    <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                                    <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product_list">
                            <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                            <div class="product_box">
                                <div class="product_info">
                                    <h4>Automobiles & Motorcycles 123456...</h4>
                                    <p>List 1</p>
                                    <div class="pricetext">$0.62-6.52</div>
                                    <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                                    <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- New Products End -->
            <!-- Hot Selling Categories Start -->
            <div class="product_sec hot_selling">
                <h3>Hot Selling Categories</h3>
                <ul class="owl-carousel selling_category">
                    <li class="item">
                        <div class="product_list">
                            <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                            <h4><a href="#">Home, Garden & Furniture</a></h4>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product_list">
                            <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                            <h4><a href="#">Jewelry & Watches</a></h4>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product_list">
                            <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                            <h4><a href="#">Women's Clothing</a></h4>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product_list">
                            <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                            <h4><a href="#">Health, Beauty & Hair</a></h4>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- Hot Selling Categories End -->

            <!-- Globel Warehouses Start -->
            <div class="product_sec">
                <h3>Globel Warehouses</h3>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="globelWrp">
                            <h5>US Warehouse</h5>
                            <ul class="owl-carousel globel_products">
                                <li class="item">
                                    <div class="product_list">
                                        <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                                        <div class="product_box">
                                            <div class="product_info">
                                                <h4>Automobiles & Motorcycles 123456...</h4>
                                                <p>List 1</p>
                                                <div class="pricetext">$0.62-6.52</div>
                                                <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                                                <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="item">
                                    <div class="product_list">
                                        <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                                        <div class="product_box">
                                            <div class="product_info">
                                                <h4>Automobiles & Motorcycles 123456...</h4>
                                                <p>List 1</p>
                                                <div class="pricetext">$0.62-6.52</div>
                                                <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                                                <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="item">
                                    <div class="product_list">
                                        <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                                        <div class="product_box">
                                            <div class="product_info">
                                                <h4>Automobiles & Motorcycles 123456...</h4>
                                                <p>List 1</p>
                                                <div class="pricetext">$0.62-6.52</div>
                                                <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                                                <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="item">
                                    <div class="product_list">
                                        <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                                        <div class="product_box">
                                            <div class="product_info">
                                                <h4>Automobiles & Motorcycles 123456...</h4>
                                                <p>List 1</p>
                                                <div class="pricetext">$0.62-6.52</div>
                                                <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                                                <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="globelWrp">
                            <h5>Finance Warehouse</h5>
                            <ul class="owl-carousel globel_products">
                                <li class="item">
                                    <div class="product_list">
                                        <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                                        <div class="product_box">
                                            <div class="product_info">
                                                <h4>Automobiles & Motorcycles 123456...</h4>
                                                <p>List 1</p>
                                                <div class="pricetext">$0.62-6.52</div>
                                                <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                                                <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="item">
                                    <div class="product_list">
                                        <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                                        <div class="product_box">
                                            <div class="product_info">
                                                <h4>Automobiles & Motorcycles 123456...</h4>
                                                <p>List 1</p>
                                                <div class="pricetext">$0.62-6.52</div>
                                                <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                                                <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="item">
                                    <div class="product_list">
                                        <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                                        <div class="product_box">
                                            <div class="product_info">
                                                <h4>Automobiles & Motorcycles 123456...</h4>
                                                <p>List 1</p>
                                                <div class="pricetext">$0.62-6.52</div>
                                                <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                                                <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="item">
                                    <div class="product_list">
                                        <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                                        <div class="product_box">
                                            <div class="product_info">
                                                <h4>Automobiles & Motorcycles 123456...</h4>
                                                <p>List 1</p>
                                                <div class="pricetext">$0.62-6.52</div>
                                                <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                                                <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Globel Warehouses End -->
            <!-- New Products Start -->
            <div class="product_sec">
                <h3>New Products</h3>
                <ul class="owl-carousel">
                    <li class="item">
                        <div class="product_list">
                            <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                            <div class="product_box">
                                <div class="product_info">
                                    <h4>Automobiles & Motorcycles 123456...</h4>
                                    <p>List 1</p>
                                    <div class="pricetext">$0.62-6.52</div>
                                    <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                                    <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product_list">
                            <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                            <div class="product_box">
                                <div class="product_info">
                                    <h4>Automobiles & Motorcycles 123456...</h4>
                                    <p>List 1</p>
                                    <div class="pricetext">$0.62-6.52</div>
                                    <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                                    <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product_list">
                            <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                            <div class="product_box">
                                <div class="product_info">
                                    <h4>Automobiles & Motorcycles 123456...</h4>
                                    <p>List 1</p>
                                    <div class="pricetext">$0.62-6.52</div>
                                    <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                                    <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product_list">
                            <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                            <div class="product_box">
                                <div class="product_info">
                                    <h4>Automobiles & Motorcycles 123456...</h4>
                                    <p>List 1</p>
                                    <div class="pricetext">$0.62-6.52</div>
                                    <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                                    <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product_list">
                            <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                            <div class="product_box">
                                <div class="product_info">
                                    <h4>Automobiles & Motorcycles 123456...</h4>
                                    <p>List 1</p>
                                    <div class="pricetext">$0.62-6.52</div>
                                    <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                                    <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product_list">
                            <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                            <div class="product_box">
                                <div class="product_info">
                                    <h4>Automobiles & Motorcycles 123456...</h4>
                                    <p>List 1</p>
                                    <div class="pricetext">$0.62-6.52</div>
                                    <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                                    <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- New Products End -->
            <!-- Print on Demand Start -->
            <div class="product_sec">
                <h3>Print on Demand</h3>
                <ul class="owl-carousel">
                    <li class="item">
                        <div class="product_list">
                            <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                            <div class="product_box">
                                <div class="product_info">
                                    <h4>Automobiles & Motorcycles 123456...</h4>
                                    <p>List 1</p>
                                    <div class="pricetext">$0.62-6.52</div>
                                    <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                                    <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product_list">
                            <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                            <div class="product_box">
                                <div class="product_info">
                                    <h4>Automobiles & Motorcycles 123456...</h4>
                                    <p>List 1</p>
                                    <div class="pricetext">$0.62-6.52</div>
                                    <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                                    <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product_list">
                            <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                            <div class="product_box">
                                <div class="product_info">
                                    <h4>Automobiles & Motorcycles 123456...</h4>
                                    <p>List 1</p>
                                    <div class="pricetext">$0.62-6.52</div>
                                    <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                                    <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product_list">
                            <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                            <div class="product_box">
                                <div class="product_info">
                                    <h4>Automobiles & Motorcycles 123456...</h4>
                                    <p>List 1</p>
                                    <div class="pricetext">$0.62-6.52</div>
                                    <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                                    <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product_list">
                            <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                            <div class="product_box">
                                <div class="product_info">
                                    <h4>Automobiles & Motorcycles 123456...</h4>
                                    <p>List 1</p>
                                    <div class="pricetext">$0.62-6.52</div>
                                    <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                                    <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product_list">
                            <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                            <div class="product_box">
                                <div class="product_info">
                                    <h4>Automobiles & Motorcycles 123456...</h4>
                                    <p>List 1</p>
                                    <div class="pricetext">$0.62-6.52</div>
                                    <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                                    <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- Print on Demand End -->
            <!-- Recommended Products Start -->
            <div class="product_sec">
                <h3>Recommended Products</h3>
                <ul class="owl-carousel">
                    <li class="item">
                        <div class="product_list">
                            <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                            <div class="product_box">
                                <div class="product_info">
                                    <h4>Automobiles & Motorcycles 123456...</h4>
                                    <p>List 1</p>
                                    <div class="pricetext">$0.62-6.52</div>
                                    <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                                    <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product_list">
                            <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                            <div class="product_box">
                                <div class="product_info">
                                    <h4>Automobiles & Motorcycles 123456...</h4>
                                    <p>List 1</p>
                                    <div class="pricetext">$0.62-6.52</div>
                                    <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                                    <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product_list">
                            <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                            <div class="product_box">
                                <div class="product_info">
                                    <h4>Automobiles & Motorcycles 123456...</h4>
                                    <p>List 1</p>
                                    <div class="pricetext">$0.62-6.52</div>
                                    <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                                    <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product_list">
                            <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                            <div class="product_box">
                                <div class="product_info">
                                    <h4>Automobiles & Motorcycles 123456...</h4>
                                    <p>List 1</p>
                                    <div class="pricetext">$0.62-6.52</div>
                                    <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                                    <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product_list">
                            <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                            <div class="product_box">
                                <div class="product_info">
                                    <h4>Automobiles & Motorcycles 123456...</h4>
                                    <p>List 1</p>
                                    <div class="pricetext">$0.62-6.52</div>
                                    <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                                    <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product_list">
                            <div class="product_img"><img src="{{asset('assets/frontend/images/deal_img.jpg')}}"></div>
                            <div class="product_box">
                                <div class="product_info">
                                    <h4>Automobiles & Motorcycles 123456...</h4>
                                    <p>List 1</p>
                                    <div class="pricetext">$0.62-6.52</div>
                                    <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                                    <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- Recommended Products End -->

        </div>
    </div>
    <!-- Products End -->

    <!-- App Start -->
    <div class="app_wrap">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-5">
                    <h3>Put Sloofi into your pocket</h3>
                    <div class="app_sec row">
                        <div class="col-lg-5">
                            <div class="qr_check"><img src="{{asset('assets/frontend/images/qr_check.png')}}"></div>
                        </div>
                        <div class="col-lg-7">
                            <div class="appstore">
                                <span><img src="{{asset('assets/frontend/images/app_store.png')}}"></span> <span><img src="{{asset('assets/frontend/images/app_store2.png')}}"></span></div>
                        </div>
                    </div>

                    <div class="scanText">Scan the QR code to download Sloofi for Mobile.</div>
                </div>
                <div class="col-lg-7">
                    <div class="app_img"><img src="{{asset('assets/frontend/images/sloofi_app.png')}}"></div>
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
                        <div class="shipImg"><img src="{{asset('assets/frontend/images/warehouse.jpg')}}"></div>
                        <div class="warehouse_info">
                            <h5>Globel Warehouse</h5>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus luctus hendrerit quam, non pellentesque purus efficitur nec. </p>
                        </div>
                    </div>
                </div>


                <div class="col-lg-6">
                    <div class="ship_sec">
                        <div class="shipImg"><img src="{{asset('assets/frontend/images/service.jpg')}}"></div>
                        <div class="warehouse_info">
                            <h5 class="service_heading">Professional Dropshipping Services</h5>
                        </div>
                    </div>
                </div>


                <div class="col-lg-3">
                    <div class="ship_sec mt-5">
                        <div class="shipImg"><img src="{{asset('assets/frontend/images/delivery.jpg')}}"></div>
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
                    <div class="sloofi_van"><img src="{{asset('assets/frontend/images/sloofi_van.png')}}"></div>
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
    @endsection
