@extends('frontend::layouts.master')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://www.paypal.com/sdk/js?client-id=ARSF761nLnocqXAS7DbR-v0brxFfEo9r4y3-pIx6emNm69_Ao4OQuooZaAH3R5ELU87sIq-aark8K3E1'"></script>

@endsection
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

                        @if(\Session::has('error'))
                            <div class="alert alert-danger">{{ \Session::get('error') }}</div>
                            {{ \Session::forget('error') }}
                        @endif
                        @if(\Session::has('success'))
                            <div class="alert alert-success">{{ \Session::get('success') }}</div>
                            {{ \Session::forget('success') }}
                        @endif
                        <div class="productInfoo paymentWrp">
                            @if(!isset(Auth::user()->id))
                                <div class="form-check">
                                    <span><a href="{{url('/login')}}">Proceed Order</a></span>
                                </div>
                                @else
                            <div class="form-check">
                                <input name="payment_method"  value="stripe" class="form-check-input payment_method" type="radio" name="flexRadioDefault" id="flexRadioDefault21">
                                <label class="form-check-label StyleBox" for="flexRadioDefault21">
                                    <img src="images/credit_card.png">
                                    <h5>Credit Card</h5>
                                </label>
                            </div>
                            <div class="form-check">
                                <input name="payment_method"  value="paypal" class="form-check-input payment_method" type="radio" name="flexRadioDefault" id="flexRadioDefault22" checked="">
                                <label class="form-check-label StyleBox" for="flexRadioDefault22">
                                    <img src="images/paypal.png">
                                    <h5>Paypal</h5>
                                </label>
                            </div>
                            @endif
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
                                <input type="text" class="form-control" id="name" name="name" placeholder="NAME" required>
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
                                <input type="text" name="country" id="country" class="form-control" placeholder="COUNTRY" required>
                            </div>

{{--                            <div class="input-group">--}}
{{--                                <input type="text" class="form-control" placeholder="EMAIL" name="">--}}
{{--                            </div>--}}


                            <div class="input-group">
                                <input type="text" name="address"  id="address" class="form-control" placeholder="ADDRESS" required>
                            </div>

                            <div class="input-group checkbox">
                                <input type="checkbox" name="img" value="yes" required id="3dgraphic">
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
                            @if(isset(Auth::user()->id) && $total>0)
                            <span  id="checkout_button"><a href="javascript:void(0)" onclick="checkForm()" >Proceed Order</a></span>
                            @endif
{{--
 <span id="paypal_button"><a href="{{ route('paypal.processTransaction') }}" @if(!isset(Auth::user()->id)) disabled="true" @endif>Pay with paypal</a></span>--}}

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
<script>
    function checkForm(){
        var address=$('#address').val();
        var country=$('#country').val();
        var name=$('#name').val();
        if(address=='' || country=='' || name==''){
            alert('Please Fill all the fields');
        }else{
            if($('#3dgraphic').is(':checked')){
                $('#payment-form').submit();
            }else{
                alert('Check Teams And Conditions');
            }
        }


    }

</script>
@endsection
