@extends('frontend::layouts.master')
@section('content')
    <div class="inner_content">
        <div class="container-fluid">
            <form class="checkout_form" id="payment-form" method="post" action="{{route('frontend.payment-page')}}">
                @csrf
            <div class="row">
                <div class="col-lg-8">
                    <div class="cart_list">
                        <h3><a href="#"><i class="fas fa-arrow-left"></i> Checkout</a></h3>
                        <h5 class="mt-4">SELECT PAYMENT METHOD</h5>


                        <div class="productInfoo paymentWrp">
                            <div class="form-check">
                                <input name="payment_method" value="stripe" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault21">
                                <label class="form-check-label StyleBox" for="flexRadioDefault21">
                                    <img src="images/credit_card.png">
                                    <h5>Credit Card</h5>
                                </label>
                            </div>
                            <div class="form-check">
                                <input name="payment_method" value="paypal" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault22" checked="">
                                <label class="form-check-label StyleBox" for="flexRadioDefault22">
                                    <img src="images/paypal.png">
                                    <h5>Paypal</h5>
                                </label>
                            </div>
{{--                            <div class="form-check">--}}
{{--                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault23">--}}
{{--                                <label class="form-check-label StyleBox" for="flexRadioDefault23">--}}
{{--                                    <img src="images/stripe.png">--}}
{{--                                    <h5>Stripe</h5>--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                            <div class="form-check">--}}
{{--                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault24">--}}
{{--                                <label class="form-check-label StyleBox" for="flexRadioDefault24">--}}
{{--                                    <img src="images/pay.png">--}}
{{--                                    <h5>Stripe</h5>--}}
{{--                                </label>--}}
{{--                            </div>--}}
                        </div>


                        <h4 class="mt-4">Basi Info</h4>


                            <div class="input-group">
                                <input type="text" class="form-control" name="name" placeholder="NAME" name="">
                            </div>
{{--                            <div class="input-group">--}}
{{--                                <input type="text" class="form-control" placeholder="ENTER CREDIT CARD NUMBER" name="">--}}
{{--                            </div>--}}
                            <div class="row">
{{--                                <div class="col-lg-4">--}}
{{--                                    <div class="input-group">--}}
{{--                                        <input type="text" class="form-control" placeholder="MONTH" name="">--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="col-lg-4">--}}
{{--                                    <div class="input-group">--}}
{{--                                        <input type="text" class="form-control" placeholder="YEAR" name="">--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="col-lg-4">--}}
{{--                                    <div class="input-group">--}}
{{--                                        <input type="text" class="form-control" placeholder="CVV" name="">--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                            </div>

                            <div class="input-group">
                                <input type="text" name="country" class="form-control" placeholder="COUNTRY" name="">
                            </div>

{{--                            <div class="input-group">--}}
{{--                                <input type="text" class="form-control" placeholder="EMAIL" name="">--}}
{{--                            </div>--}}


                            <div class="input-group">
                                <input type="text" name="address" class="form-control" placeholder="ADDRESS" name="">
                            </div>

                            <div class="input-group checkbox">
                                <input type="checkbox" name="img" value="yes" id="3dgraphic">
                                <label for="3dgraphic"></label>
                                by confirming this box, i agree to the terms and conditions, privicy policy</div>

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
                        <h5>ORDER SUMMARY</h5>
                        <div class="table-responsive mb--30">
                            <table class="table cart-table ">
                                <!-- Table Head -->
                                <thead>
                                <tr>
                                    <th class="number">Product Name</th>
                                    <th class="total">Quantity</th>
                                    <th class="remove">Price</th>
                                </tr>
                                </thead>
                                <!-- Table Body -->
                                <tbody>
                                @php
                                    $total=0;
                                @endphp
                                @foreach($cartItems as $item)
                                    @php
                                        $price1=$item['product']->prices->where('qty',1)->first()?$item['product']->prices->where('qty',1)->first()->value:0;
                                        $price100=$item['product']->prices->where('qty',100)->first()?$item['product']->prices->where('qty',100)->first()->value:0;
                                        $price1000=$item['product']->prices->where('qty',1000)->first()?$item['product']->prices->where('qty',1000)->first()->value:0;
                                        if($item['quantity']>0 && $item['quantity']<100){
                                            $price=$price1;
                                        }elseif($item['quantity']>99 && $item['quantity']<1000){
                                            $price=$price100;
                                        }elseif($item['quantity']>999){
                                             $price=$price1000;
                                        }else{
                                             $price=0;
                                        }
                                        $total+=$item['quantity']*$price;
                                    @endphp
                                <tr>

                                    <td>
                                        <p>{{$item['product']->name}}</p>
                                    </td>
                                    <td>
                                        <p class="cart-pro-price">x{{$item['quantity']}}</p>
                                    </td>
                                    <td>
                                        <p class="cart-price-total">${{$item['quantity']*$price}}</p>
                                    </td>

                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>



                        <ul class="total_price">
{{--                            <li>Total price: <span>$12.00</span></li>--}}
{{--                            <li>Discount: <span>$12.00</span></li>--}}
                            <li>Total price: <span>${{$total}}</span></li>
                        </ul>
                        <hr/>
                        <div class="readmore purchase_btn btn_bg">
                            <span><a href="javascript:void(0)" onclick="$('#payment-form').submit();">Proceed Order</a></span>
                        </div>
                        <div class="readmore purchase_btn grey_btn btn_bg">
                            <span> <a href="#">Continue Shopping</a></span>
                        </div>
                    </div>
                </div>
            </div>
    </form>
        </div>
    </div>
@endsection
@section('js')

@endsection
