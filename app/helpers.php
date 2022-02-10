<?php
if (!function_exists('get_tp_api')){
    function get_tp_api(){
        $instance_key = env('otp_instanceKey');
        $url = 'http://otapi.net/service-json/GetRootCategoryInfoList?instanceKey='.$instance_key;
        // Configure curl client and execute request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);
        $results = json_decode($result, true);
        if($results['ErrorCode'] == 'Ok'){
            $results = $results['CategoryInfoList'];
            $results = $results['Content'];
            return $results;
        }
        return false;
    }
}
if (!function_exists('get_tp_categories')){
    function get_tp_categories($id){
        $instance_key = env('otp_instanceKey');
        $url = 'http://otapi.net/service-json/GetCategorySubcategoryInfoList?instanceKey='.$instance_key.'&parentCategoryId='.$id;
        // Configure curl client and execute request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);
        $results = json_decode($result, true);
        if($results['ErrorCode'] == 'Ok'){
            $results = $results['CategoryInfoList'];
            $results = $results['Content'];
            return $results;
        }
        return false;
    }
}
if (!function_exists('get_tp_products')){
    function get_tp_products($e_categories, $size){
        $e_products = [];
        foreach ($e_categories as $cat){
            $instance_key = env('otp_instanceKey');
            $url = 'http://otapi.net/service-json/BatchSearchItemsFrame?instanceKey='.$instance_key. '&language=en&signature=&timestamp=&sessionId=&xmlParameters=<SearchItemsParameters><CategoryId>'.$cat->external_id.'<%2FCategoryId><%2FSearchItemsParameters>&framePosition='.$size.'&frameSize=20&blockList=';
            // Configure curl client and execute request
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            $result = curl_exec($ch);
            curl_close($ch);
            $results = json_decode($result, true);

            if ($results['ErrorCode'] == 'Ok'){
                $results = $results['Result'];
                $results = $results['Items'];
                $results = $results['Items'];
                $results = $results['Content'];
                $e_products[$cat->provider_type] = $results;
            }
        }
        return $e_products;
    }
}
if (!function_exists('external_product')){
    function external_product($product_id){
        $instance_key = env('otp_instanceKey');
        $url = 'http://otapi.net/service-json/BatchGetItemFullInfo?instanceKey='.$instance_key.'&language=en&itemId='.$product_id.'&blockList=Description';
        // Configure curl client and execute request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);
        $results = json_decode($result, true);
        $product = $results['Result']['Item'];

        // for related products
        $instance_key = env('otp_instanceKey');
        $url = 'http://otapi.net/service-json/BatchSearchItemsFrame?instanceKey='.$instance_key. '&language=en&signature=&timestamp=&sessionId=&xmlParameters=<SearchItemsParameters><CategoryId>'.$product['CategoryId'].'<%2FCategoryId><%2FSearchItemsParameters>&framePosition=0&frameSize=4&blockList=';
        // Configure curl client and execute request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);
        $results = json_decode($result, true);
        $r_products = [];
        if (!$results['ErrorCode']){
            $results = $results['Result'];
            $results = $results['Items'];
            $results = $results['Items'];
            $t_results = $results['Content'];
            $r_products = $t_results;
        }
        return array(
            'product' => $product,
            'r_products' => $r_products,
            'results' =>$results
        );
    }
}
if (!function_exists('price_internal_product')) {
    function price_internal_product($product_id, $quantity)
    {
        $product =  \Modules\Product\Entities\Product::find($product_id);
        if($quantity < 100){
            $price = $product->price_1;
        }elseif ($quantity >= 100){
            if ($product->price_100 > 0){
                $price = $product->price_100;
            }else{
                $price = $product->price_1;
            }
        }elseif ($quantity >= 1000){
            if ($product->price_1000 > 0){
                $price = $product->price_1000;
            }elseif ($product->price_100 > 0){
                $price = $product->price_100;
            }else{
                $price = $product->price_1;
            }
        }
        if($product->discount > 0){
            $price = $price - ($price*($product->discount/$price));
        }
        return $price;
    }
}
if (!function_exists('price_external_product')) {
    function price_external_product($product_id, $quantity)
    {
        $data = external_product($product_id);
        $product = $data['product'];
        if(count($product['ConfiguredItems']) > 0){
            $first = $product['ConfiguredItems'][0];
            $sign = $first['Price']['ConvertedPriceList']['Internal']['Sign'];
            $f_price = $first['Price']['ConvertedPriceList']['Internal']['Price'];

            $last = $product['ConfiguredItems'][count($product['ConfiguredItems'])-1];
            $l_price = $last['Price']['ConvertedPriceList']['Internal']['Price'];
        }else{
            $f_price = $product['Price']['ConvertedPriceList']['Internal']['Price'];
            $sign = $product['Price']['ConvertedPriceList']['Internal']['Sign'];
            $l_price = null;
        }
        return array(
            'f_price' => $f_price,
            'l_price' => $l_price,
            'sign' => $sign,
        );
    }
}
if (!function_exists('cart_total')) {
    function cart_total($cartItems)
    {
        $total = 0;
        foreach ($cartItems as $key => $item){
            if(array_key_exists('type', $item)) {
                if ($item['type'] == 'internal') {
                    $product = \Modules\Product\Entities\Product::find($key);
                    $price = price_internal_product($product->id, $item['quantity']);
                    $price = $price * $item['quantity'];
                    $total = $total + $price;
                } elseif ($item['type'] == 'external') {
                    $data = external_product($key);
                    $product = $data['product'];
                    $data = price_external_product($product['Id'], $item['quantity']);
                    $price = $data['f_price'] * $item['quantity'];
                    $total = $total + $price;
                }
            }
        }
        return $total;
    }
}
