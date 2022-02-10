@extends('frontend::layouts.master')
@section('css')
    <link rel="stylesheet" href="{{asset('/frontend/css/flexslider.css')}}" />
    @endsection
@section('content')
<section class="detailsHeader">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 col-md-9 col-sm-12"><img src="{{ asset('/frontend/images/s-logo.png')}}" />
                <h2>Supplier:{{$product->user->shop->name??'Sloofi DropShipping Co. Ltd'}} </h2>
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
                <li><a href="{{route('category.products', $product->categories[0]->id)}}">{{$product->categories[0]->name}}</a></li>
            </ul>
        </div>
    </div>
</section>
<!-- page-title-area End -->
<!-- productDetail Start -->
<section class="productDetail">
    <div class="container-fluid">
        <div class="row">
            @php
                $price1=$product->prices->where('qty',1)->first()?$product->prices->where('qty',1)->first()->value:0;
                $price100=$product->prices->where('qty',100)->first()?$product->prices->where('qty',100)->first()->value:0;
                $price1000=$product->prices->where('qty',1000)->first()?$product->prices->where('qty',1000)->first()->value:0;
            @endphp
            <div class="col-lg-5">
                <div class="aboveSlider">
                    <h5><a class="nav-link" type="button" onclick="price(1,{{ $price1 }})">1 Product <span>${{ $price1 }} </span></a></h5>
                    @if($price100)<h5><a class="nav-link" onclick="price(100,{{ $price100 }})" type="button">100 Product <span>${{ $price100 }} </span></a></h5>@endif
                    @if($price1000)<h5><a class="nav-link" onclick="price(1000,{{ $price1000 }})" type="button">1000 Product <span>${{ $price1000 }} </span></a></h5>@endif
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
                            <div class="downloadLink"><a href="{{$images[0]->getUrl()}}" download="Saloofi"><i class="fas fa-download"></i></a></div>
                        </div>
                        <div id="carousel" class="flexslider">
                            <ul class="slides">
                                @php
                                    $images=$product->getMedia('images');
                                @endphp
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
{{--                <div class="videoBox">--}}
{{--                    <h6>Video ID: CJYZ1080928</h6>--}}
{{--                    <p>Note: This video is available to be downloaded without the watermark and in high-resolution. Please before downloading. <br>Your recommendation will encourage us to roll out more services to you forfree!</p>--}}
{{--                    <div class="readmore"><a href="#">Free Download</a></div>--}}
{{--                </div>--}}
            </div>
            <div class="col-lg-7">
                <div class="productDetailContent">
                    <h2>{{ $product->name }}</h2>
                    <div class="pricebox">
                        <div class="row align-items-center">
                            <div class="col-lg-3 col-md-3 col-sm-4">
                                <h5>Product Price:</h5>
                            </div>
                            <div class="col-lg-9 col-md-9  col-sm-8">
                                <h1 id="product_price">${{$price1}}
{{--                                    @if($price100 || $price1000)-{{$price1000>0?$price1000:$price100}} @endif--}}
                                </h1>
                                <p>Price Updated on {{$product->prices->where('qty',1)->first()->updated_at}} </p>
                            </div>
                        </div>
                    </div>
                    <form class="productInfoo" id="addToCart" method="get" action="{{ route('frontend.add-to-cart',['id'=>$product->id]) }}">
                       <input type="hidden" name="id" value="{{ $product->id }}">
                        @if(count($product->colors) > 0)
                        <div class="row align-items-center pb-3 pt-4">
                            <div class="col-lg-3 col-md-3">
                                <label for="inputPassword6" class="col-form-label">Color:</label>
                            </div>
                            <div class="col-lg-9  col-md-9">
                                @foreach($product->colors as $color)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="color" value="{{$color->color}}" id="color{{$color->id}}">
                                    <label style="background:{{$color->color}}" class="form-check-label" for="color{{$color->id}}"> </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        @if(count($product->sizes) > 0)
                        <div class="row align-items-center pb-4">
                            <div class="col-lg-3 col-md-3">
                                <label for="inputPassword6" class="col-form-label">Size:</label>
                            </div>
                            <div class="col-lg-9 col-md-9">
                                @foreach($product->sizes as $size)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="size" value="{{$size->size}}" id="size{{$size->id}}">
                                    <label class="form-check-label StyleBox" for="size{{$size->id}}"> {{$size->size}} </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
{{--                        <div class="row align-items-center pb-4">--}}
{{--                            <div class="col-lg-3 col-md-3">--}}
{{--                                <label for="inputPassword6" class="col-form-label">Quantity::</label>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-9 col-md-9">--}}
{{--                                <div class="form-check">--}}
{{--                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault21">--}}
{{--                                    <label class="form-check-label StyleBox" for="flexRadioDefault21"> </label>--}}
{{--                                </div>--}}
{{--                                <div class="form-check">--}}
{{--                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault22" checked>--}}
{{--                                    <label class="form-check-label StyleBox" for="flexRadioDefault22"> </label>--}}
{{--                                </div>--}}
{{--                                <div class="form-check">--}}
{{--                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault23">--}}
{{--                                    <label class="form-check-label StyleBox" for="flexRadioDefault23"> </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="row align-items-center pb-4 my-2">
                            <div class="col-lg-3 col-md-3">
                                <label for="inputPassword6" class="col-form-label">Shipping From:</label>
                            </div>
                            <div class="col-lg-9 col-md-9">
                                <div class="row">
                                    <div class="col-lg-6">
                                        @php($warehouses=[])
                                        <select name="warehouse_id" class="form-control" required>
                                            @foreach($product->stocks as $stock)
                                                @if(!in_array($stock->warehouse->name,$warehouses))
                                                <option value="{{$stock->warehouse->id}}">{{$stock->warehouse->name}}</option>
                                                @else
                                                    @php(array_push($warehouses,$stock->warehouse->name))
                                                    @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
{{--                        <div class="row align-items-center pb-4">--}}
{{--                            <div class="col-lg-3 col-md-3">--}}
{{--                                <label for="inputPassword6" class="col-form-label">Platform:</label>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-9 col-md-9">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-lg-6">--}}
{{--                                        <input type="text"  name="platform" class="form-control" id="text" aria-describedby="text">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="row align-items-center pb-4">
                            <div class="col-lg-3 col-md-3">
                                <label for="inputPassword6" class="col-form-label">Shipping To:</label>
                            </div>
                            <div class="col-lg-9 col-md-9">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <select id="country" name="country" class="form-control">
                                            <option value="Afghanistan">Afghanistan</option>
                                            <option value="Åland Islands">Åland Islands</option>
                                            <option value="Albania">Albania</option>
                                            <option value="Algeria">Algeria</option>
                                            <option value="American Samoa">American Samoa</option>
                                            <option value="Andorra">Andorra</option>
                                            <option value="Angola">Angola</option>
                                            <option value="Anguilla">Anguilla</option>
                                            <option value="Antarctica">Antarctica</option>
                                            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                            <option value="Argentina">Argentina</option>
                                            <option value="Armenia">Armenia</option>
                                            <option value="Aruba">Aruba</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Austria">Austria</option>
                                            <option value="Azerbaijan">Azerbaijan</option>
                                            <option value="Bahamas">Bahamas</option>
                                            <option value="Bahrain">Bahrain</option>
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="Barbados">Barbados</option>
                                            <option value="Belarus">Belarus</option>
                                            <option value="Belgium">Belgium</option>
                                            <option value="Belize">Belize</option>
                                            <option value="Benin">Benin</option>
                                            <option value="Bermuda">Bermuda</option>
                                            <option value="Bhutan">Bhutan</option>
                                            <option value="Bolivia">Bolivia</option>
                                            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                            <option value="Botswana">Botswana</option>
                                            <option value="Bouvet Island">Bouvet Island</option>
                                            <option value="Brazil">Brazil</option>
                                            <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                            <option value="Brunei Darussalam">Brunei Darussalam</option>
                                            <option value="Bulgaria">Bulgaria</option>
                                            <option value="Burkina Faso">Burkina Faso</option>
                                            <option value="Burundi">Burundi</option>
                                            <option value="Cambodia">Cambodia</option>
                                            <option value="Cameroon">Cameroon</option>
                                            <option value="Canada">Canada</option>
                                            <option value="Cape Verde">Cape Verde</option>
                                            <option value="Cayman Islands">Cayman Islands</option>
                                            <option value="Central African Republic">Central African Republic</option>
                                            <option value="Chad">Chad</option>
                                            <option value="Chile">Chile</option>
                                            <option value="China">China</option>
                                            <option value="Christmas Island">Christmas Island</option>
                                            <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                            <option value="Colombia">Colombia</option>
                                            <option value="Comoros">Comoros</option>
                                            <option value="Congo">Congo</option>
                                            <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                                            <option value="Cook Islands">Cook Islands</option>
                                            <option value="Costa Rica">Costa Rica</option>
                                            <option value="Cote D'ivoire">Cote D'ivoire</option>
                                            <option value="Croatia">Croatia</option>
                                            <option value="Cuba">Cuba</option>
                                            <option value="Cyprus">Cyprus</option>
                                            <option value="Czech Republic">Czech Republic</option>
                                            <option value="Denmark">Denmark</option>
                                            <option value="Djibouti">Djibouti</option>
                                            <option value="Dominica">Dominica</option>
                                            <option value="Dominican Republic">Dominican Republic</option>
                                            <option value="Ecuador">Ecuador</option>
                                            <option value="Egypt">Egypt</option>
                                            <option value="El Salvador">El Salvador</option>
                                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                                            <option value="Eritrea">Eritrea</option>
                                            <option value="Estonia">Estonia</option>
                                            <option value="Ethiopia">Ethiopia</option>
                                            <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                            <option value="Faroe Islands">Faroe Islands</option>
                                            <option value="Fiji">Fiji</option>
                                            <option value="Finland">Finland</option>
                                            <option value="France">France</option>
                                            <option value="French Guiana">French Guiana</option>
                                            <option value="French Polynesia">French Polynesia</option>
                                            <option value="French Southern Territories">French Southern Territories</option>
                                            <option value="Gabon">Gabon</option>
                                            <option value="Gambia">Gambia</option>
                                            <option value="Georgia">Georgia</option>
                                            <option value="Germany">Germany</option>
                                            <option value="Ghana">Ghana</option>
                                            <option value="Gibraltar">Gibraltar</option>
                                            <option value="Greece">Greece</option>
                                            <option value="Greenland">Greenland</option>
                                            <option value="Grenada">Grenada</option>
                                            <option value="Guadeloupe">Guadeloupe</option>
                                            <option value="Guam">Guam</option>
                                            <option value="Guatemala">Guatemala</option>
                                            <option value="Guernsey">Guernsey</option>
                                            <option value="Guinea">Guinea</option>
                                            <option value="Guinea-bissau">Guinea-bissau</option>
                                            <option value="Guyana">Guyana</option>
                                            <option value="Haiti">Haiti</option>
                                            <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                                            <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                            <option value="Honduras">Honduras</option>
                                            <option value="Hong Kong">Hong Kong</option>
                                            <option value="Hungary">Hungary</option>
                                            <option value="Iceland">Iceland</option>
                                            <option value="India">India</option>
                                            <option value="Indonesia">Indonesia</option>
                                            <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                            <option value="Iraq">Iraq</option>
                                            <option value="Ireland">Ireland</option>
                                            <option value="Isle of Man">Isle of Man</option>
                                            <option value="Israel">Israel</option>
                                            <option value="Italy">Italy</option>
                                            <option value="Jamaica">Jamaica</option>
                                            <option value="Japan">Japan</option>
                                            <option value="Jersey">Jersey</option>
                                            <option value="Jordan">Jordan</option>
                                            <option value="Kazakhstan">Kazakhstan</option>
                                            <option value="Kenya">Kenya</option>
                                            <option value="Kiribati">Kiribati</option>
                                            <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                            <option value="Korea, Republic of">Korea, Republic of</option>
                                            <option value="Kuwait">Kuwait</option>
                                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                                            <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                            <option value="Latvia">Latvia</option>
                                            <option value="Lebanon">Lebanon</option>
                                            <option value="Lesotho">Lesotho</option>
                                            <option value="Liberia">Liberia</option>
                                            <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                            <option value="Liechtenstein">Liechtenstein</option>
                                            <option value="Lithuania">Lithuania</option>
                                            <option value="Luxembourg">Luxembourg</option>
                                            <option value="Macao">Macao</option>
                                            <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                                            <option value="Madagascar">Madagascar</option>
                                            <option value="Malawi">Malawi</option>
                                            <option value="Malaysia">Malaysia</option>
                                            <option value="Maldives">Maldives</option>
                                            <option value="Mali">Mali</option>
                                            <option value="Malta">Malta</option>
                                            <option value="Marshall Islands">Marshall Islands</option>
                                            <option value="Martinique">Martinique</option>
                                            <option value="Mauritania">Mauritania</option>
                                            <option value="Mauritius">Mauritius</option>
                                            <option value="Mayotte">Mayotte</option>
                                            <option value="Mexico">Mexico</option>
                                            <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                            <option value="Moldova, Republic of">Moldova, Republic of</option>
                                            <option value="Monaco">Monaco</option>
                                            <option value="Mongolia">Mongolia</option>
                                            <option value="Montenegro">Montenegro</option>
                                            <option value="Montserrat">Montserrat</option>
                                            <option value="Morocco">Morocco</option>
                                            <option value="Mozambique">Mozambique</option>
                                            <option value="Myanmar">Myanmar</option>
                                            <option value="Namibia">Namibia</option>
                                            <option value="Nauru">Nauru</option>
                                            <option value="Nepal">Nepal</option>
                                            <option value="Netherlands">Netherlands</option>
                                            <option value="Netherlands Antilles">Netherlands Antilles</option>
                                            <option value="New Caledonia">New Caledonia</option>
                                            <option value="New Zealand">New Zealand</option>
                                            <option value="Nicaragua">Nicaragua</option>
                                            <option value="Niger">Niger</option>
                                            <option value="Nigeria">Nigeria</option>
                                            <option value="Niue">Niue</option>
                                            <option value="Norfolk Island">Norfolk Island</option>
                                            <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                            <option value="Norway">Norway</option>
                                            <option value="Oman">Oman</option>
                                            <option value="Pakistan">Pakistan</option>
                                            <option value="Palau">Palau</option>
                                            <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                            <option value="Panama">Panama</option>
                                            <option value="Papua New Guinea">Papua New Guinea</option>
                                            <option value="Paraguay">Paraguay</option>
                                            <option value="Peru">Peru</option>
                                            <option value="Philippines">Philippines</option>
                                            <option value="Pitcairn">Pitcairn</option>
                                            <option value="Poland">Poland</option>
                                            <option value="Portugal">Portugal</option>
                                            <option value="Puerto Rico">Puerto Rico</option>
                                            <option value="Qatar">Qatar</option>
                                            <option value="Reunion">Reunion</option>
                                            <option value="Romania">Romania</option>
                                            <option value="Russian Federation">Russian Federation</option>
                                            <option value="Rwanda">Rwanda</option>
                                            <option value="Saint Helena">Saint Helena</option>
                                            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                            <option value="Saint Lucia">Saint Lucia</option>
                                            <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                            <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                                            <option value="Samoa">Samoa</option>
                                            <option value="San Marino">San Marino</option>
                                            <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                            <option value="Saudi Arabia">Saudi Arabia</option>
                                            <option value="Senegal">Senegal</option>
                                            <option value="Serbia">Serbia</option>
                                            <option value="Seychelles">Seychelles</option>
                                            <option value="Sierra Leone">Sierra Leone</option>
                                            <option value="Singapore">Singapore</option>
                                            <option value="Slovakia">Slovakia</option>
                                            <option value="Slovenia">Slovenia</option>
                                            <option value="Solomon Islands">Solomon Islands</option>
                                            <option value="Somalia">Somalia</option>
                                            <option value="South Africa">South Africa</option>
                                            <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                                            <option value="Spain">Spain</option>
                                            <option value="Sri Lanka">Sri Lanka</option>
                                            <option value="Sudan">Sudan</option>
                                            <option value="Suriname">Suriname</option>
                                            <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                            <option value="Swaziland">Swaziland</option>
                                            <option value="Sweden">Sweden</option>
                                            <option value="Switzerland">Switzerland</option>
                                            <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                            <option value="Taiwan">Taiwan</option>
                                            <option value="Tajikistan">Tajikistan</option>
                                            <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                            <option value="Thailand">Thailand</option>
                                            <option value="Timor-leste">Timor-leste</option>
                                            <option value="Togo">Togo</option>
                                            <option value="Tokelau">Tokelau</option>
                                            <option value="Tonga">Tonga</option>
                                            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                            <option value="Tunisia">Tunisia</option>
                                            <option value="Turkey">Turkey</option>
                                            <option value="Turkmenistan">Turkmenistan</option>
                                            <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                            <option value="Tuvalu">Tuvalu</option>
                                            <option value="Uganda">Uganda</option>
                                            <option value="Ukraine">Ukraine</option>
                                            <option value="United Arab Emirates">United Arab Emirates</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option value="United States">United States</option>
                                            <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                            <option value="Uruguay">Uruguay</option>
                                            <option value="Uzbekistan">Uzbekistan</option>
                                            <option value="Vanuatu">Vanuatu</option>
                                            <option value="Venezuela">Venezuela</option>
                                            <option value="Viet Nam">Viet Nam</option>
                                            <option value="Virgin Islands, British">Virgin Islands, British</option>
                                            <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                            <option value="Wallis and Futuna">Wallis and Futuna</option>
                                            <option value="Western Sahara">Western Sahara</option>
                                            <option value="Yemen">Yemen</option>
                                            <option value="Zambia">Zambia</option>
                                            <option value="Zimbabwe">Zimbabwe</option>
                                        </select>
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
                                        <select name="shipping_method" class="form-control" id="">
                                            <option value="DHL">DHL</option>
                                            <option value="Royal Mail">Royal Mail</option>
                                            <option value="Fast Delivery">Fast Delivery</option>
                                        </select>
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
                                <div class="col-form-label text-center ps-0"> $0</div>
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
                            @can('product_connect_to_woocommerce')
                            <div class="col-lg-4 col-md-4">
                                <div class="readmore-second "><a href="java:void(0)" onclick="openModel('woocommerce')">Connect to Woocommerce</a></div>
                            </div>
                            @endcan
                                @can('product_connect_to_shopify')
                            <div class="col-lg-4 col-md-4">
                                <div class="readmore-second"><a href="java:void(0)" onclick="openModel('shopify')">Connect to Shopify</a></div>
                            </div>
                                @endcan
                        </div>
                        <div class="row align-items-center pb-3 pt-2">
                            {{-- <div class="col-lg-4 col-md-4">
                                <div class="readmore-second"><a href="#">Text Here</a></div>
                            </div>--}}
                            @can('product_add_stock')
                            <div class="col-lg-4 col-md-4">
                                <div class="readmore-second"><a href="java:void(0)" onclick="openModel('stock')" data-toggle="modal" data-target="#stockModal">Add Stock</a></div>
                            </div>
                            @endcan
                            <div class="col-lg-4 col-md-4">
                                <div class="readmore-second buy_now"><a onclick='$("#addToCart").submit()'  class="active" >Buy Now</a></div>
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
                        <div class="form-group">
                            <label for="warehouse">Price Increase by</label>
                            <select class="form-control" name="increased_by">
                                <option value="by_amount">By Amount</option>
                                <option value="by_percencate">By Percentage</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Add In Price</label>
                            <input type="number" class="form-control" name="increment_in_price" required>
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
                        <div class="form-group">
                            <label for="warehouse">Price Increase by</label>
                            <select class="form-control" name="increased_by">
                                <option value="by_amount">By Amount</option>
                                <option value="by_percencate">By Percentage</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Add In Price</label>
                            <input type="number" class="form-control" name="increment_in_price" required>
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
                        @if(\Illuminate\Support\Facades\Auth::user())
                        <tr>
                            <th>Wallet Balance: ${{\Illuminate\Support\Facades\Auth::user()->wallet}}</th>
                            <th></th>
                        </tr>
                        @endif
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
    function price(qty,price){
        $('#product_price').html('$'+price)
        $('#price-cal').html(price*qty);
        $('#qty').val(qty)
    }
</script>
<script defer src="{{ asset('/frontend/js/jquery.flexslider.js') }}"></script>
<script defer src="{{ asset('/frontend/js/common.js') }}"></script>

@endsection
