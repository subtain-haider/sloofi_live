@extends('frontend::layouts.master')
@section('content')
    <div class="inner_content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="cart_list">
                        <h3><a href="#"><i class="fas fa-arrow-left"></i> Continue Shopping</a></h3>
                        <h5 class="mt-4">Shopping Cart</h5>
                        <div class="sortby">
                            <div class="cart_heading">You have 4 items in your cart</div>
                            <div class="sort"><span>Sort by</span> <div class="dropdown">
                                    <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        Price
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="#">$111.00</a></li>
                                        <li><a class="dropdown-item" href="#">$111.00</a></li>
                                    </ul>
                                </div></div>
                        </div>
                        <div class="clearfix"></div>
                        <ul>
                            @php
                                $total=0;
                            @endphp
                            @foreach($cartItems as $key=>$item)
                            <li>
                                <div class="shopping_list">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-2 col-2">
                                            <div class="d-flex">
                                                @php
                                                    $image=$item['product']->getMedia('images')->first();
                                                @endphp
                                                <div class="cartImg"><img src="{{$image->getUrl()}}"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-9 col-md-8 col-8">
                                            <div class="row">
                                                <div class="col-lg-7 col-md-7">
                                                    <div class="cart_info">
                                                        <h5>{{$item['product']->name}}</h5>
                                                        <p>{{$item['product']->categories[0]->name??''}}</p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-2 ">
                                                    <div class="x2">x{{$item['qty']}}</div>
                                                </div>
                                                @php
                                                    $price1=$item['product']->prices->where('qty',1)->first()?$item['product']->prices->where('qty',1)->first()->value:0;
                                                    $price100=$item['product']->prices->where('qty',100)->first()?$item['product']->prices->where('qty',100)->first()->value:0;
                                                    $price1000=$item['product']->prices->where('qty',1000)->first()?$item['product']->prices->where('qty',1000)->first()->value:0;
                                                    if($item['qty']>0 && $item['qty']<100){
                                                        $price=$price1;
                                                    }elseif($item['qty']>99 && $item['qty']<1000){
                                                        $price=$price100;
                                                    }elseif($item['qty']>999){
                                                         $price=$price1000;
                                                    }else{
                                                         $price=0;
                                                    }
                                                    $total+=$item['qty']*$price;
                                                @endphp
                                                <div class="col-lg-2 col-md-2 ">
                                                    <div class="cart_price">${{$item['qty']*$price}}</div>
                                                </div></div>

                                        </div>
                                        <div class="col-lg-1 col-md-2 col-2">
                                            <div class="cross_icon"><a href="#" onclick="removeCart(this)" data-price="{{$item['qty']*$price}}" data-id="{{$item['product']->id}}"><img src="images/basket.png"></a></div>
                                        </div>
                                    </div>
                                    <div class="quantity shop_page text-center">
                                        <input type="button" class="minus" value="-">
                                        <input type="text" class="input-text qty text" title="Qty" value="1" name="quantity">
                                        <input type="button" class="plus" value="+">
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart_widget">
                        <h3>Have coupon?</h3>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Coupon Code" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <span class="input-group-text" id="basic-addon2">Apply</span>
                        </div>
                    </div>
                    <div class="cart_widget mt-4">
                        <ul class="total_price">
                            <li>Total price: $<span id="total">{{$total}}</span></li>
{{--                            <li>Discount: <span>$12.00</span></li>--}}
{{--                            <li>Total price: $<span>{{$total}}</span></li>--}}
                        </ul>
                        <hr/>
                        <div class="readmore purchase_btn btn_bg">
                            <span><a href="{{route('frontend.checkout')}}">Checkout</a></span>
                        </div>
                        <div class="readmore purchase_btn grey_btn btn_bg">
                            <span> <a href="#">Continue Shopping</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
    function removeCart(e){
        var id=$(e).data('id');
        var price=$(e).data('price');
        $(e).parent().parent().parent().parent().hide();
        var total=$('#total').html();
        total=parseFloat(total);
        $('#total').html(total-price);
    }
    </script>
@endsection
