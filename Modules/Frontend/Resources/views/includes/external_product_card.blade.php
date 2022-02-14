@php
    $int_product = \Modules\Product\Entities\Product::where('external_id', $product['Id'])->first();
    if ($int_product != null){
        $route = route('frontend.product-detail',['id'=>$int_product->id]);
    }else{
        $route = route('frontend.external_product_detail',['id'=>$product['Id']]);
    }
@endphp
<div class="product_list">
    <div class="product_img"><a href="{{ $route }}"><img src="{{$product['MainPictureUrl']}}" alt="{{$product['Title']}}" title="{{$product['Title']}}"></a></div>
    <div class="product_box">
        <div class="product_info">
            <h4><a href="{{ $route }}">{{$product['Title']}}</a></h4>
            <div class="pricetext">{{$product['Price']['ConvertedPriceList']['Internal']['Sign']}}{{$product['Price']['ConvertedPriceList']['Internal']['Price']}}</div>
            <div class="readmore"><a href="#">Contact Us</a> <a class="btn_bg" href="#">Buy Now</a></div>
            <div class="readmore queue_btn"><a href="#">Add to Queue</a></div>
        </div>
    </div>
</div>