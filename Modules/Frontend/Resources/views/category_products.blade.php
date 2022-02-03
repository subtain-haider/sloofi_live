@extends('frontend::layouts.master')
@section('content')

    <!-- Content Start -->
    <div class="category_wrap">
        <div class="container-fluid">


            <div class="row mb-5">
                <div class="col-lg-2">
                    <h5>You are in:</h5>
                </div>

                <div class="col-lg-10">
                    <div class="improve-bg">
                        <h3 >{{$category->name}}</h3>
{{--                        <div class="dropdown">--}}
{{--                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                                Home Improvement--}}
{{--                            </button>--}}
{{--                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">--}}
{{--                                <li><a class="dropdown-item" href="#">dummy</a></li>--}}
{{--                                <li><a class="dropdown-item" href="#">dummy</a></li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
                    </div>
                </div>

            </div>


            <div class="row mb-5">
                <div class="col-lg-2">
                    <h5>Filter by:</h5>
                </div>

                <div class="col-lg-10">

                    <div class="row filterWrp">
                        <div class="col-lg-2 col-md-6">
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    All Warehouses
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="#">dummy</a></li>
                                    <li><a class="dropdown-item" href="#">dummy</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-6">
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    All Types
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="#">dummy</a></li>
                                    <li><a class="dropdown-item" href="#">dummy</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-4">


                            <form>



                                <div class="row">
                                    <div class="col-lg-3">
                                        <label>Price</label>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <input type="text" class="form-control" placeholder="Min" name="">
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <input type="text" class="form-control" placeholder="Max" name="">
                                    </div>


                                </div>
                            </form>

                        </div>


                        <div class="col-lg-4">

                            <div class="radio form-group">
                                <div id="forprofile" class="radiobtn">
                                    <input type="radio" value="Yes" name="visa_adv_service">
                                    <i class="checkmark"></i> Free Shipping </div>
                            </div>

                        </div>



                    </div>
                </div>


            </div>




            <div class="row mb-5">
                <div class="col-lg-2">
                    <h5>Sort by:</h5>
                </div>

                <div class="col-lg-10">

                    <div class="row filterWrp">
                        <div class="col-lg-2 col-md-6">
                            <label><a href="#">Best Match</a></label>
                        </div>

                        <div class="col-lg-2 col-md-6">
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Lists
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="#">dummy</a></li>
                                    <li><a class="dropdown-item" href="#">dummy</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-4">


                            <form>



                                <div class="row">
                                    <div class="col-lg-3">
                                        <label>Price</label>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <input type="text" class="form-control" placeholder="Min" name="">
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <input type="text" class="form-control" placeholder="Max" name="">
                                    </div>


                                </div>
                            </form>

                        </div>


                        <div class="col-lg-4">

                            <label><a href="#">Newest</a></label>

                        </div>



                    </div>
                </div>




                <div class="btn-section">
                    <button type="submit" class="btn btn-primary">  Confirm</button>
                </div>
            </div>

        </div>
    </div>

    <div class="products-wrap category_related">
        <div class="container-fluid">
            <!-- Super Deals Start -->
            <div class="product_sec">
                <ul class="row">
                    @foreach($products as $product)
                    <li class="col-lg-3 col-md-6">
                        @include('frontend::includes.product_card')
                    </li>
                    @endforeach
                    @php
                        $tps = ['p_1688', 'p_Alibaba', 'p_Aliexpress', 'p_Taobao', 'p_Ebay'];
                    @endphp
                    @foreach($tps as $tp)
                        @if(!empty($e_products[$tp]))
                            @foreach($e_products[$tp] as $product)
                                <li class="col-lg-3 col-md-6">
                                    @include('frontend::includes.external_product_card')
                                </li>
                            @endforeach
                        @endif
                    @endforeach

                </ul>
            </div>
        </div>
    </div>
    <!-- Content End -->
@endsection