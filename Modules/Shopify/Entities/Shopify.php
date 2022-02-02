<?php

namespace Modules\Shopify\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Artisan;
use Auth;
class Shopify extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Modules\Shopify\Database\factories\ShopifyFactory::new();
    }
    public function shopify_products()
    {
        return $this->hasMany(ShopifyProduct::class);
    }
    public  function synProducts($id){
        $shopify = Shopify::where('id',$id)->first();
            // Set variables for our request
        $shop = $shopify->shop;
        $token = $shopify->token;
        $query = array(
        "Content-type" => "application/json" // Tell Shopify that we're expecting a response in JSON format
        );

            // Run API call to get all products
        $response = Shopify::shopify_call($token, $shop, "/admin/products.json", array(), 'GET');
        if(!isset(json_decode($response['response'])->errors)){
            // Get response
        $products = json_decode($response['response'])->products;
        foreach ($products as $product){
        $product_exist = ShopifyProduct::where('title', $product->title)->first();
        if (!$product_exist){
        $shopify->shopify_products()->create(['image'=> $product->image->src ?? '', 'title' => $product->title, 'vendor' => $product->vendor, 'product_type' => $product->product_type, 'status' => $product->status, 'tags' => $product->tags]);
        }
        }
        }

        Artisan::call('view:clear');
        Artisan::call('cache:clear');
        return 1;
        }
        public function allProducts($storeId){
            $user = Auth::user();
            $products = array();
            $shopifies = $user->shopify()->get();
            foreach ($shopifies as $shopify){
                // Set variables for our request
                $shop = $shopify->shop;
                $token = $shopify->token;
                $query = array(
                    "Content-type" => "application/json" // Tell Shopify that we're expecting a response in JSON format
                );

                // Run API call to get all products
                $response = Shopify::shopify_call($token, $shop, "/admin/products.json", array(), 'GET');
                if(isset(json_decode($response['response'])->errors)){
                    // Get response
                    $shopify->update(['status' => 0]);
                }else{
                    if(isset(json_decode($response['response'])->products)){
                        $shopify_products=json_decode($response['response'])->products;
                        $products=array_merge($shopify_products,$products);
                    }

                }
            }
            $data['products']=$products;
            $data['shopifies']=$shopifies;
            return $data;
        }
        public function shopify_call($token, $shop, $api_endpoint, $query = array(), $method = 'GET', $request_headers = array()) {

    // Build URL
    $url = "https://" . $shop . ".myshopify.com" . $api_endpoint;
    if (!is_null($query) && in_array($method, array('GET', 	'DELETE'))) $url = $url . "?" . http_build_query($query);

    // Configure cURL
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, TRUE);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($curl, CURLOPT_MAXREDIRS, 3);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 3);
    // curl_setopt($curl, CURLOPT_SSLVERSION, 3);
    curl_setopt($curl, CURLOPT_USERAGENT, 'My New Shopify App v.1');
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($curl, CURLOPT_TIMEOUT, 30);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);

    // Setup headers
    $request_headers[] = "";
    if (!is_null($token)) $request_headers[] = "X-Shopify-Access-Token: " . $token;
    curl_setopt($curl, CURLOPT_HTTPHEADER, $request_headers);

    if ($method != 'GET' && in_array($method, array('POST', 'PUT'))) {
        if (is_array($query)) $query = http_build_query($query);
        curl_setopt ($curl, CURLOPT_POSTFIELDS, $query);
    }

    // Send request to Shopify and capture any errors
    $response = curl_exec($curl);
    $error_number = curl_errno($curl);
    $error_message = curl_error($curl);

    // Close cURL to be nice
    curl_close($curl);

    // Return an error is cURL has a problem
    if ($error_number) {
        return $error_message;
    } else {

        // No error, return Shopify's response by parsing out the body and the headers
        $response = preg_split("/\r\n\r\n|\n\n|\r\r/", $response, 2);

        // Convert headers into an array
        $headers = array();
        $header_data = explode("\n",$response[0]);
        $headers['status'] = $header_data[0]; // Does not contain a key, have to explicitly set
        array_shift($header_data); // Remove status, we've already set it above
        foreach($header_data as $part) {
            $h = explode(":", $part);
            $headers[trim($h[0])] = trim($h[1]);
        }

        // Return headers and Shopify's response
        return array('headers' => $headers, 'response' => $response[1]);

    }

}
}
