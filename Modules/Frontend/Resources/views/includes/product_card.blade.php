@php
    $value = 0;
    if($category->prices()->where('qty',1)->first()){
        $value = $category->prices()->where('qty',1)->first()->value;
    }
@endphp
<div class="product_list">
    <div class="product_img">
        <a href="{{ route('frontend.product-detail',['id'=>$product->id]) }}">
            <img @if($product->getMedia('thumbnail')->first()) src="{{$product->getMedia('thumbnail')->first()->getUrl()}}" @else src="{{url('/frontend')}}/images/deal_img.jpg" @endif>
        </a>
    </div>
    <div class="product_box">
        <div class="product_info">
            <h4><a href="{{ route('frontend.product-detail',['id'=>$product->id]) }}">{{$product->name}}</a></h4>
            <p>{{$product->categories[0]->name??''}}</p>
            @php
                $price1=$product->prices->where('qty',1)->first()?$product->prices->where('qty',1)->first()->value:0;
                $price100=$product->prices->where('qty',100)->first()?$product->prices->where('qty',100)->first()->value:0;
                $price1000=$product->prices->where('qty',1000)->first()?$product->prices->where('qty',1000)->first()->value:0;

            $price1 += $value;
            $price100 += $value;
            $price1000 += $value;
            @endphp
            <div class="pricetext">${{$price1}}@if($price100 || $price1000)-{{$price1000>0?$price1000:$price100}} @endif</div>
            <div class="readmore"><a href="{{ route('frontend.product-detail',['id'=>$product->id]) }}">Connect</a> <a class="btn_bg" href="{{ route('frontend.product-detail',['id'=>$product->id]) }}">Buy Now</a></div>
{{--            <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>--}}
        </div>
    </div>
</div>
