@extends('frontend::layouts.master')
@section('content')
<section class="detailsHeader">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 col-md-9 col-sm-12"><img src="{{ asset('/frontend/images/s-logo.png')}}" />
                <h2>Supplier: Sloofi DropShipping Co. Ltd</h2>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-12">
                <div class="readmore"><a href="#">Visit Store</a></div>
            </div>
        </div>
    </div>
</section>
<!-- detailsHeader End -->
<!-- page-title-area Start -->
<section class="page-title-area">
    <div class="container-fluid">
        <div class="page-title-content">
            <ul class="breadcrumb-nav">
                <li><a href="/">{{$product->categories[0]->name}}</a></li>
            </ul>
        </div>
    </div>
</section>
<!-- page-title-area End -->
<!-- productDetail Start -->
<section class="productDetail">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-5">
                @php
                $price1=$product->prices->where('qty',1)->first()?$product->prices->where('qty',1)->first()->value:0;
                $price100=$product->prices->where('qty',100)->first()?$product->prices->where('qty',100)->first()->value:0;
                $price1000=$product->prices->where('qty',1000)->first()?$product->prices->where('qty',1000)->first()->value:0;
                @endphp
                <div class="aboveSlider">
                    <h5><a class="nav-link active" type="button">1 Product <span>${{ $price1 }} </span></a></h5>
                    @if($price100)<h5><a class="nav-link" type="button">100 Product <span>${{ $price100 }} </span></a></h5>@endif
                    @if($price1000)<h5><a class="nav-link" type="button">1000 Product <span>${{ $price1000 }} </span></a></h5>@endif
                </div>
                <div id="main" role="main">
                    <div class="slider">
                        <div id="slider" class="flexslider">
                            <ul class="slides linkk">
                               @php
                               $images=$product->getMedia('images');
                               @endphp
                               @foreach ($images as $image)
                               <li><img src="{{ $image->getUrl()}}" /></li>
                               @endforeach

                            </ul>
                            <div class="downloadLink"><a href="images/slider-img.png')}}" download="Saloofi"><i class="fas fa-download"></i></a></div>
                        </div>
                        <div id="carousel" class="flexslider">
                            <ul class="slides">
                                @foreach ($images as $image)
                                <li><img src="{{ $image->getUrl()}}" /></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <ul class="afterSlider">
                    <li><a href="#">Share</a></li>
                    <li><a href="#">Wishlist</a></li>
                    <li><a href="#">Report</a></li>
                </ul>
                <div class="videoBox">
                    <h6>Video ID: CJYZ1080928</h6>
                    <p>Note: This video is available to be downloaded without the watermark and in high-resolution. Please before downloading. <br>Your recommendation will encourage us to roll out more services to you forfree!</p>
                    <div class="readmore"><a href="#">Free Download</a></div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="productDetailContent">
                    <h2>Product Title: {{ $product->name }}</h2>
                    <div class="pricebox">
                        <div class="row align-items-center">
                            <div class="col-lg-3 col-md-3 col-sm-4">
                                <h5>Product Price:</h5>
                            </div>
                            <div class="col-lg-9 col-md-9  col-sm-8">
                                <h1>${{$price1}} @if($price100 || $price1000)-{{$price1000>0?$price1000:$price100}} @endif</h1>
                                <p>Price Updated on June 19, 2020 </p>
                            </div>
                        </div>
                    </div>
                    <form class="productInfoo" id="addToCart" method="get" action="{{ route('frontend.add-to-cart',['id'=>$product->id]) }}">
                       <input type="hidden" name="id" value="{{ $product->id }}">
                        <div class="row align-items-center pb-3 pt-4">
                            <div class="col-lg-3 col-md-3">
                                <label for="inputPassword6" class="col-form-label">Color:</label>
                            </div>
                            <div class="col-lg-9  col-md-9">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1"> </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                    <label class="form-check-label" for="flexRadioDefault2"> </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                                    <label class="form-check-label" for="flexRadioDefault3"> </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4">
                                    <label class="form-check-label" for="flexRadioDefault4"> </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault5">
                                    <label class="form-check-label" for="flexRadioDefault5"> </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault6">
                                    <label class="form-check-label" for="flexRadioDefault6"></label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault7">
                                    <label class="form-check-label" for="flexRadioDefault7"></label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault8">
                                    <label class="form-check-label" for="flexRadioDefault8"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center pb-4">
                            <div class="col-lg-3 col-md-3">
                                <label for="inputPassword6" class="col-form-label">Style:</label>
                            </div>
                            <div class="col-lg-9 col-md-9">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault10">
                                    <label class="form-check-label StyleBox" for="flexRadioDefault10"> </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault11" checked>
                                    <label class="form-check-label StyleBox" for="flexRadioDefault11"> </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault12">
                                    <label class="form-check-label StyleBox" for="flexRadioDefault12"> </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault13">
                                    <label class="form-check-label StyleBox" for="flexRadioDefault13"> </label>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center pb-4">
                            <div class="col-lg-3 col-md-3">
                                <label for="inputPassword6" class="col-form-label">Quantity::</label>
                            </div>
                            <div class="col-lg-9 col-md-9">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault21">
                                    <label class="form-check-label StyleBox" for="flexRadioDefault21"> </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault22" checked>
                                    <label class="form-check-label StyleBox" for="flexRadioDefault22"> </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault23">
                                    <label class="form-check-label StyleBox" for="flexRadioDefault23"> </label>
                                </div>
                            </div>
                        </div>

                        <div class="row align-items-center pb-4">
                            <div class="col-lg-3 col-md-3">
                                <label for="inputPassword6" class="col-form-label">Shipping From:</label>
                            </div>
                            <div class="col-lg-9 col-md-9">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="text" name="shipping_from1" aria-describedby="text">
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" name="shipping_from2" id="text2" aria-describedby="text2">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center pb-4">
                            <div class="col-lg-3 col-md-3">
                                <label for="inputPassword6" class="col-form-label">Platform:</label>
                            </div>
                            <div class="col-lg-9 col-md-9">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="text"  name="platform" class="form-control" id="text" aria-describedby="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center pb-4">
                            <div class="col-lg-3 col-md-3">
                                <label for="inputPassword6" class="col-form-label">Shipping To:</label>
                            </div>
                            <div class="col-lg-9 col-md-9">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <input type="text"  name="shipping_to" class="form-control" id="text" aria-describedby="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-lg-3 col-md-3">
                                <label for="inputPassword6" class="col-form-label">Shipping Method</label>
                            </div>
                            <div class="col-lg-9 col-md-9">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <input type="text"  name="shipping_method" class="form-control" id="text" aria-describedby="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="spacer"></div>
                        <div class="row align-items-center pb-3 pt-4">
                            <div class="col-lg-3 col-md-3">
                                <label for="inputPassword6" class="col-form-label">Shipping Cost:</label>
                            </div>
                            <div class="col-lg-9 col-md-9">
                                <div class="col-form-label text-center ps-0"> $6.70-25.76</div>
                            </div>
                        </div>
                        <div class="row align-items-center pb-3 pt-4">
                            <div class="col-lg-3 col-md-3">
                                <label for="inputPassword6" class="col-form-label">Quantity:</label>
                            </div>
                            <div class="col-lg-9 col-md-9">
                                <div class="quantity text-center">
                                    {{-- <input type="button" class="minus priceCal" value="-"> --}}
                                    <input type="number" class="input-text qty text" data-price1="{{$price1}}" data-price100="{{$price100}}" data-price1000="{{$price1000}}" id="qty" name="qty" title="Qty" value="1">
                                    {{-- <input type="button" class="plus priceCal" value="+"> --}}
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center pb-3 pt-4">
                            <div class="col-lg-3 col-md-3">
                                <label for="inputPassword6" class="col-form-label">Total Dropshipping Price:</label>
                            </div>
                            <div class="col-lg-9 col-md-9">
                                <div class="col-form-label text-center ps-0">$<span id="price-cal"  >{{$price1}}</span></div>
                            </div>
                        </div>
                        <div class="row align-items-center pb-3 pt-4">
                            <div class="col-lg-4 col-md-4">
                                <div class="readmore-second "><a href="java:void(0)" onclick="openModel('woocommerce')">Connect to Woocommerce</a></div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="readmore-second"><a href="java:void(0)" onclick="openModel('shopify')">Connect to Shopify</a></div>
                            </div>
                        </div>
                        <div class="row align-items-center pb-3 pt-2">
                            {{-- <div class="col-lg-4 col-md-4">
                                <div class="readmore-second"><a href="#">Text Here</a></div>
                            </div>--}}
                            <div class="col-lg-4 col-md-4">
                                <div class="readmore-second"><a href="java:void(0)" onclick="openModel('stock')" data-toggle="modal" data-target="#stockModal">Add Stock</a></div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="readmore-second"><a onclick='$("#addToCart").submit()'  class="active" >Buy Now</a></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="product-info-tabs">
    <div class="container-fluid">
        <div class="prod-tabs">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Description</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Comment (4)</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Review (0)</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="content">
                        <p>{{ $product->description }}</p>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="row ">
                        <div class="col-lg-9">
                            <div class="reviews-container">
                                <div class="add-review">
                                    <h2>Comments</h2>
                                    <div class="review-box clearfix">
                                    <figure class="rev-thumb"><img src="{{ asset('/frontend/images/thumbnail.png')}}" alt=""></figure>
                                    <div class="rev-content">
                                        <div class="rev-header clearfix">
                                            <h4>Michel Britney</h4>
                                            <div class="rating"><span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star-o"></span> <span class="fa fa-star-o"></span></div>
                                            <div class="time">18 Hours Ago</div>
                                        </div>
                                        <div class="rev-text">The mad lightning no one you beat of just one drum they call him Flipper Flipper faster than lightning no one you see is smarter each week my friends you are sure to get a smile from seven stranded cast aways here on Gilligans Isle they call him Flipper Flipper faster.</div>
                                    </div>
                                </div>
                                <!--Review-->
                                <div class="review-box clearfix">
                                <figure class="rev-thumb"><img src="{{ asset('/frontend/images/thumbnail.png')}}" alt=""></figure>
                                <div class="rev-content">
                                    <div class="rev-header clearfix">
                                        <h4>Denny</h4>
                                        <div class="rating"><span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star-o"></span> <span class="fa fa-star-o"></span></div>
                                        <div class="time">18 Hours Ago</div>
                                    </div>
                                    <div class="rev-text">The mad lightning no one you beat of just one drum they call him Flipper Flipper faster than lightning no one you see is smarter each week my friends you are sure to get a smile from seven stranded cast aways here on Gilligans Isle they call him Flipper Flipper faster than lightning no one you see is smarter than he loveable space that needs your face threes company too.</div>
                                </div>
                            </div>
                            <div class="review-box clearfix">
                            <figure class="rev-thumb"><img src="{{ asset('/frontend/images/thumbnail.png')}}" alt=""></figure>
                            <div class="rev-content">
                                <div class="rev-header clearfix">
                                    <h4>Michel Britney</h4>
                                    <div class="rating"><span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star-o"></span> <span class="fa fa-star-o"></span></div>
                                    <div class="time">18 Hours Ago</div>
                                </div>
                                <div class="rev-text">The mad lightning no one you beat of just one drum they call him Flipper Flipper faster than lightning no one you see is smarter each week my friends you are sure to get a smile from seven stranded cast aways here on Gilligans Isle they call him Flipper Flipper faster.</div>
                            </div>
                        </div>
                        <!--Review-->
                        <div class="review-box clearfix">
                        <figure class="rev-thumb"><img src="{{ asset('/frontend/images/thumbnail.png')}}" alt=""></figure>
                        <div class="rev-content">
                            <div class="rev-header clearfix">
                                <h4>Denny</h4>
                                <div class="rating"><span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star-o"></span> <span class="fa fa-star-o"></span></div>
                                <div class="time">18 Hours Ago</div>
                            </div>
                            <div class="rev-text">The mad lightning no one you beat of just one drum they call him Flipper Flipper faster than lightning no one you see is smarter each week my friends you are sure to get a smile from seven stranded cast aways here on Gilligans Isle they call him Flipper Flipper faster than lightning no one you see is smarter than he loveable space that needs your face threes company too.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
    <div class="row ">
        <div class="col-lg-9">
            <div class="reviews-container">
                <div class="add-review">
                    <h2>Add a Review</h2>
                    <form method="post" action="#">
                        <div class="row">
                            <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                <label>Name *</label>
                                <input type="text" name="name" value="" placeholder="" >
                            </div>
                            <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                <label>Email *</label>
                                <input type="email" name="email" value="" placeholder="" >
                            </div>
                            <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                <label>Website *</label>
                                <input type="text" name="website" value="" placeholder="" >
                            </div>
                            <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                <label>Rating </label>
                                <div class="rating"> <a href="#" class="rate-box" title="1 Out of 5"><span class="fa fa-star"></span></a> <a href="#" class="rate-box" title="2 Out of 5"><span class="fa fa-star"></span> <span class="fa fa-star"></span></a> <a href="#" class="rate-box" title="3 Out of 5"><span class="fa fa-star"></span> <span class="fa fa-star"> </span> <span class="fa fa-star"></span></a> <a href="#" class="rate-box" title="4 Out of 5"><span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span></a> <a href="#" class="rate-box" title="5 Out of 5"><span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span></a> </div>
                            </div>
                            <div class="mb-3 col-lg-12 col-md-12">
                                <label>Your Review</label>
                                <textarea name="review-message"></textarea>
                            </div>
                            <div class="col-lg-12">
                                <button type="button" class="btn">Add Review</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
    <div class="modal fade" id="shopifyConnect" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Connect Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3>Please Select Shopify Store</h3>
                    <form action="{{ route('frontend.shopify.products.connect') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <input type="hidden" name="type" value="internal">
                            <select name="shopify_id" class="form-control" id="exampleFormControlSelect1">
                                @foreach($shopifies as $shopify)
                                    <option value="{{$shopify->id}}">{{$shopify->shop}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Connect</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="woocommerceModal" tabindex="-1" role="dialog" aria-labelledby="woocommerceModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="woocommerceModalLabel">Connect Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3>Please Select Woocommerce Store</h3>
                    <form action="{{ route('frontend.woocommerce.products.connect') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <input type="hidden" name="type" value="internal">
                            <select name="woocommerce_id" class="form-control" id="exampleFormControlSelect1">
                                @foreach($woocommerces as $woocommerce)
                                    <option value="{{$woocommerce->id}}">{{$woocommerce->url}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Connect</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="stockModal" tabindex="-1" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add to Stock</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table border">
                        <tr>
                            <th>Wallet Balance: ${{\Illuminate\Support\Facades\Auth::user()->wallet}}</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td>Price 1 pcs:</td>
                            <td>${{price_internal_product($product->id, 1)}}</td>
                        </tr>
                        @if($product->price_100 > 0)
                            <tr>
                                <td>Price above 100 pcs:</td>
                                <td>${{price_internal_product($product->id, 100)}}</td>
                            </tr>
                        @endif
                        @if($product->price_1000 > 0)
                            <tr>
                                <td>Price above 1000 pcs:</td>
                                <td>${{price_internal_product($product->id, 1000)}}</td>
                            </tr>
                        @endif
                    </table>
                    <form action="{{ route('frontend.add_to_stock_simple') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        <div class="mb-3 row">
                            <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="number" name="quantity" id="cart_quantity" value="1" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="quantity" class="col-sm-2 col-form-label">Warehouse</label>
                            <div class="col-sm-10">
                                <select name="warehouse_id" class="form-control" required>
                                    @foreach($warehouses as $warehouse)
                                        <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mb-2">Add to Stock</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
@section('js')
<script>
    $('#qty').change(function(event) {
       var qty=$(this).val();
       var price1=$(this).data('price1');
        var price100=$(this).data('price100');
        var price1000=$(this).data('price1000');
        var price=price1;
        if(qty<100){
            price=qty*price1;
        }else if(qty>99 && qty<1000){
            price=qty*price100;
        }else if(qty>999){
            price=qty*price1000;
        }
        $('#price-cal').html(price);
    });
    function openModel(type){
        if(type=='woocommerce'){
            $('#woocommerceModal').modal('show');;
        }else if(type=='shopify'){
            $('#shopifyConnect').modal('show');
        }else if(type=='stock'){
            $('#stockModal').modal('show');
        }
    }
</script>
<script defer src="{{ asset('/frontend/js/jquery.flexslider.js') }}"></script>
<script defer src="{{ asset('/frontend/js/common.js') }}"></script>

@endsection
