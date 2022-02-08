<?php

namespace Modules\Shopify\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use Modules\Product\Entities\Product;
use Modules\Shopify\Entities\Shopify;
use Modules\Shopify\Entities\ShopifyProduct;
use Modules\Shopify\Interfaces\ShopifyInterface;
use Auth;
class ShopifyController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    private $shopifyRepository;

    public function __construct(ShopifyInterface $shopifyRepository)
    {
        $this->shopifyRepository = $shopifyRepository;
    }
    public function index()
    {
        $shopifies=$this->shopifyRepository->allShopifies();
        return view('shopify::index',compact('shopifies'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('shopify::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        return $this->install($request);
        $this->shopifyRepository->createshopify($request->except('_token'));
        return redirect()->route('shopify.all')->with('success','shopify Store added');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('shopify::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('shopify::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $this->shopifyRepository->deleteshopify($id);
        return redirect()->route('shopify.all')->with('success','shopify Store deleted successfully');
    }
    public function syncProducts($id){
        Shopify::synProducts($id);
        return redirect()->route('shopify.all')->with('success','Products syronized successfully');
    }
    public function shopifyProducts($storeId=''){
        $data=$this->shopifyRepository->myshopifyProducts($storeId);
        $data['storeId']=$storeId;
        return view('shopify::my-products')->with($data);
    }
    public function install(Request $request)
    {
        // Set variables for our request
        $shop = $request->shop;
        $api_key = "8f423c4b4657354a5bb5663f70f017c3";
        $scopes = "read_orders,write_products";
        $redirect_uri = url('/')."/generate_token";

        // Build install/approval URL to redirect to
        $install_url = "https://" . $shop . ".myshopify.com/admin/oauth/authorize?client_id=" . $api_key . "&scope=" . $scopes . "&redirect_uri=" . urlencode($redirect_uri);

        // Redirect
        header("Location: " . $install_url);
        die();

        return $request;
    }

    public function generate_token(Request $request)
    {

        // Set variables for our request
        $api_key = "8f423c4b4657354a5bb5663f70f017c3";
        $shared_secret = "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";
        $params = $request->all(); // Retrieve all request parameters
        $hmac = $request->hmac; // Retrieve HMAC request parameter

        $params = array_diff_key($params, array('hmac' => '')); // Remove hmac from params
        ksort($params); // Sort params lexographically

        $computed_hmac = hash_hmac('sha256', http_build_query($params), $shared_secret);

        // Use hmac data to check that the response is from Shopify or not
        if (hash_equals($hmac, $computed_hmac)) {

            // Set variables for our request
            $query = array(
                "client_id" => $api_key, // Your API key
                "client_secret" => $shared_secret, // Your app credentials (secret key)
                "code" => $params['code'] // Grab the access key from the URL
            );

            // Generate access token URL
            $access_token_url = "https://" . $params['shop'] . "/admin/oauth/access_token";

            // Configure curl client and execute request
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $access_token_url);
            curl_setopt($ch, CURLOPT_POST, count($query));
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($query));
            $result = curl_exec($ch);
            curl_close($ch);

            // Store the access token
            $result = json_decode($result, true);
            $access_token = $result['access_token'];

            // Show the access token (don't do this in production!)
            $user = \Illuminate\Support\Facades\Auth::user();
            $shopify = $user->shopify()->create(['token' => $access_token, 'shop' => substr($params['shop'],0,-14)]);

            if ($shopify){
                $shop = $shopify->shop;
                $token = $shopify->token;


                $query = array(
                    'webhook' => [
                        "topic" => "orders/create",
                        "address" => env('APP_URL').'/api'.'/shopify_order_created',
                        "format" => "json",
                    ]
                );
                $response = $this->shopify_call($token, $shop, "/admin/webhooks.json", $query, 'POST');
            }

            return redirect('/admin/shopify');

        } else {
            // Someone is trying to be shady!
            die('This request is NOT from Shopify!');
        }
    }

    public function shopifyProductsConnect(Request $request){
        if ($request->type == 'internal'){
            $product = Product::find($request->product_id);
            $product_name = $product->name;
            $product_description = $product->description;
            $product_category_name = $product->category->name;
            $product_tags = $product->tags;
            $product_price = $product->price_1;

            // for image
            $path = public_path('/').'/'.$product->thumbnail;
            $imagedata = file_get_contents($path);
            $base64 = base64_encode($imagedata);
            $image_query = [
                "image" => [
                    "position" => 1,
                    "attachment" => $base64
                ]
            ];

        }elseif ($request->type == 'external'){

            $product = external_product($request->product_id);
            $product = $product['product'];
            $product_name = $product['Title'];
//            $product_description = $product['Description'];
            $product_description = '';
            $product_category_name = '';
            $product_tags = '';

            //for price
            $data = price_external_product($product['Id'],1);
            $product_price = $data['f_price'];

            // for image
            $image_query = [
                "image" => [
                    "position" => 1,
                    "src" => $product['Pictures'][0]['Url']
                ]
            ];

        }

        $shopify = Shopify::where('id',$request->shopify_id)->first();
        // Set variables for our request
        $shop = $shopify->shop;
        $token = $shopify->token;

        // adding product
        $query = [
            "product" => [
                "title" => $product_name,
                "body_html" => $product_description,
                "vendor" => "",
                "product_type" => $product_category_name,
                "tags" => $product_tags
            ]
        ];
        $response = $this->shopify_call($token, $shop, "/admin/products.json", $query, 'POST');

        //adding image
        $product_id = json_decode($response['response'])->product->id;
        $response = $this->shopify_call($token, $shop, "/admin/products/".$product_id."/images.json", $image_query, 'POST');

        // adding price
        $response = $this->shopify_call($token, $shop, "/admin/products/".$product_id."/variants.json", array(), 'GET');
        $variant_id =json_decode($response['response'])->variants[0]->id;
        $query = [
            "variant" => [
                "id" => $variant_id,
                "price" => $product_price
            ]
        ];
        $response = $this->shopify_call($token, $shop, "/admin/variants/".$variant_id.".json", $query, 'PUT');
        return back()->with('success', 'Product Connected Successfully');
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

    public  function products($selected = null){
//        $user = Auth::user();
//        $products = array();
//        $shopifies = $user->shopify()->get();
//        if($user->user_type == 'seller'){
//
//            if ($selected != null){
//                $stores = $user->shopify()->where('id',$selected)->get();
//            }else{
//                $stores = $user->shopify()->get();
//            }
//            foreach ($stores as $shopify){
//                // Set variables for our request
//                $shop = $shopify->shop;
//                $token = $shopify->token;
//                $query = array(
//                    "Content-type" => "application/json" // Tell Shopify that we're expecting a response in JSON format
//                );
//
//                // Run API call to get all products
//                $response = $this->shopify_call($token, $shop, "/admin/products.json", array(), 'GET');
//                if(!isset(json_decode($response['response'])->errors)){
//                    // Get response
//                    $products = json_decode($response['response'])->products;
//                }
//            }
//            return view('frontend.user.seller.shopify.products',compact('products', 'shopifies', 'selected'));
//        }
//        else {
//            abort(404);
//        }
    }

    public function shopifyProductsSync($id){

        $shopify = Shopify::where('id',$id)->first();
        // Set variables for our request
        $shop = $shopify->shop;
        $token = $shopify->token;
        $query = array(
            "Content-type" => "application/json" // Tell Shopify that we're expecting a response in JSON format
        );

        // Run API call to get all products
        $response = $this->shopify_call($token, $shop, "/admin/products.json", array(), 'GET');
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

        if(Auth::user()->user_type == 'admin'){
            return redirect()->route('shopifyProducts.index');
        }
        else{
            return redirect()->route('shopifyProducts.index');
        }
    }


    public function connectProduct(Request $request)
    {
        try {
            dd($request->all());
            return back()->with('success', 'Product Connected Successfully');
        } catch (Exception $th) {
            // dd($th);
            return back()->with('error', 'Product Connection failed');
        }
    }
}
