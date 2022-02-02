@extends('frontend::layouts.master')
@section('content')
<div class="sliderSec-wrap">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-3">
          <div class="categories_wrp">
            <h3>All Categories</h3>
            <ul class="categoryList">
                @foreach($categories as $category)
              <li><a href="#">{{$category->name}}</a></li>
                @endforeach
            </ul>
            <ul class="mobile_categories row">
              @foreach($categories as $category)
              <li class="col-md-4 col-6"><span><img src="images/cateImg.png"></span><a href="{{$category->id}}"> {{$category->name}}</a></li>
                @endforeach

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
                <img src="images/slider.jpg" class="d-block w-100" alt="">
              </div>
              <div class="carousel-item">
                <img src="images/slider2.jpg" class="d-block w-100" alt="">
              </div>
              <div class="carousel-item">
                <img src="images/slider.jpg" class="d-block w-100" alt="">
              </div>
              <div class="carousel-item">
                <img src="images/slider2.jpg" class="d-block w-100" alt="">
              </div>
              <div class="carousel-item">
                <img src="images/slider.jpg" class="d-block w-100" alt="">
              </div>
              <div class="carousel-item">
                <img src="images/slider2.jpg" class="d-block w-100" alt="">
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
            <div class="sloofi-icon"><img src="images/sloofi-icon.png"></div>
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
        @foreach($properties as $property)
      <div class="product_sec">
        <h3>{{$property->name}}</h3>
        <ul class="owl-carousel">
            @foreach($property->products as $product)
                <li class="item">
            <div class="product_list">
              <div class="product_img"><img @if($product->getMedia('thumbnail')->first()) src="{{$product->getMedia('thumbnail')->first()->getUrl()}}" @else src="images/deal_img.jpg" @endif></div>
              <div class="product_box">
                <div class="product_info">
                  <h4>{{$product->name}}</h4>
                  <p>{{$product->categories[0]->name??''}}</p>
                    @php
                        $price1=$product->prices->where('qty',1)->first()?$product->prices->where('qty',1)->first()->value:0;
                        $price100=$product->prices->where('qty',100)->first()?$product->prices->where('qty',100)->first()->value:0;
                        $price1000=$product->prices->where('qty',1000)->first()?$product->prices->where('qty',1000)->first()->value:0;
                    @endphp
                  <div class="pricetext">${{$price1}} @if($price100 || $price1000)-{{$price1000>0?$price1000:$price100}} @endif</div>
                  <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
                  <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
                </div>
              </div>
            </div>
          </li>
            @endforeach
        </ul>
      </div>
    @endforeach
      <!-- Super Deals End -->
      <!-- Trending Products Start -->

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
                    <div class="product_img"><img src="images/deal_img.jpg"></div>
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
                    <div class="product_img"><img src="images/deal_img.jpg"></div>
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
                    <div class="product_img"><img src="images/deal_img.jpg"></div>
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
                    <div class="product_img"><img src="images/deal_img.jpg"></div>
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
                    <div class="product_img"><img src="images/deal_img.jpg"></div>
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
                    <div class="product_img"><img src="images/deal_img.jpg"></div>
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
                    <div class="product_img"><img src="images/deal_img.jpg"></div>
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
                    <div class="product_img"><img src="images/deal_img.jpg"></div>
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
      <!-- Recommended Products End -->
    </div>
  </div>
@endsection
