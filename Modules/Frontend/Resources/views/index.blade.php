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
              <li><a href="{{route('category.products', $category->id)}}">{{$category->name}}</a></li>
                @endforeach
            </ul>
            <ul class="mobile_categories row">
              @foreach($categories as $category)
              <li class="col-md-4 col-6"><span><img src="{{$category->getFirstMediaUrl('icon')}}"></span><a href="{{route('category.products', $category->id)}}"> {{$category->name}}</a></li>
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
            </div>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="{{url('/frontend')}}/images/slider.jpg" class="d-block w-100" alt="">
              </div>
              <div class="carousel-item">
                <img src="{{url('/frontend')}}/images/slider2.jpg" class="d-block w-100" alt="">
              </div>
              <div class="carousel-item">
                <img src="{{url('/frontend')}}/images/slider3.jpg" class="d-block w-100" alt="">
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
            <div class="sloofi-icon"><img src="{{url('/frontend')}}/images/sloofi-icon.png"></div>
            <h3>Welcome to Sloofi!</h3>
            @if(!\Illuminate\Support\Facades\Auth::user())
            <div class="sign_btns">
              <span><a href="{{route('register')}}">Register</a></span>
              <span><a href="{{route('login')}}">Sign In</a></span>
            </div>
            @endif
          </div>
          <div class="help_center">
            <div class="help_heading">
              <h4>Help Center</h4>
              <div class="view_more"><a href="">View More <i class="fas fa-chevron-right"></i></a></div>
            </div>
            <ul>
              <li>Customer Support</li>
              <li>Shopify Connectivity Support</li>
              <li>WooCommerce Connectivity Support</li>
              <li>Drop shipping Documentation</li>
              <li>Warehouse Support</li>
              <li>API connectivity</li>
              <li>Refund Policy</li>
              <li>Privacy Policy</li>
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
        @foreach($sections as $section)
      <div class="product_sec">
        <h3>{{$section->name}}</h3>
        <ul class="owl-carousel">
            @foreach($section->products as $product)
                <li class="item">
                  @include('frontend::includes.product_card')
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
            @foreach($warehouses as $warehouse)
          <div class="col-lg-6 my-3">
            <div class="globelWrp">
              <h5>{{$warehouse->name}}</h5>
              <ul class="owl-carousel globel_products">
                  @foreach($warehouse->stocks as $stock)
                      @php
                          $price1=$stock->product->prices->where('qty',1)->first()?$stock->product->prices->where('qty',1)->first()->value:0;
                          $price100=$stock->product->prices->where('qty',100)->first()?$stock->product->prices->where('qty',100)->first()->value:0;
                          $price1000=$stock->product->prices->where('qty',1000)->first()?$stock->product->prices->where('qty',1000)->first()->value:0;
                      @endphp
                <li class="item">
                  <div class="product_list">
                    <div class="product_img"><img src="{{$stock->product->getMedia('thumbnail')->first()->getUrl()}}"></div>
                    <div class="product_box">
                      <div class="product_info">
                        <h4>{{$stock->product->name??''}}</h4>
                        <p>{{ $stock->product->categories[0]->name??''}}</p>
                        <div class="pricetext">
                             <span>${{ $price1 }} </span>
{{--                            @if($price100)<span>${{ $price100 }} </span>@endif--}}
{{--                            @if($price1000)<span>${{ $price1000 }} </span>@endif--}}
                        </div>
                        <div class="readmore"><a href="{{route('frontend.product-detail',['id'=>$stock->product->id])}}">Connect</a> <a class="btn_bg" href="{{route('frontend.product-detail',['id'=>$stock->product->id])}}">Buy Now</a></div>
{{--                        <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>--}}
                      </div>
                    </div>
                  </div>
                </li>
                  @endforeach
              </ul>
            </div>
          </div>
            @endforeach
        </div>
      </div>
      <!-- Globel Warehouses End -->
      <!-- New Products Start -->
      <!-- Recommended Products End -->
    </div>
  </div>
@endsection
