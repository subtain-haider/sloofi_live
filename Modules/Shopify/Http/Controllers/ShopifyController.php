<?php

namespace Modules\Shopify\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Shopify\Entities\Shopify;
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
            $user = Auth::user();
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
}
