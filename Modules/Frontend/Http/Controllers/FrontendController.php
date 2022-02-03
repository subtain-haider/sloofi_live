<?php

namespace Modules\Frontend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Modules\Product\Entities\Property;
use Modules\Product\Entities\Product;
use Modules\Shopify\Entities\Shopify;
use Modules\Stock\Entities\StockRequest;
use Modules\ThirdPartyApi\Entities\ApiCategory;
use Modules\Warehouse\Entities\Warehouse;
use Modules\Woocommerce\Entities\Woocommerce;
use Session;
use Auth;
class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $categories=Category::all();
        $properties=Property::all();

        return view('frontend::index',compact('categories','properties'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('frontend::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('frontend::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('frontend::edit');
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
        //
    }
    public function productDetail($id){
        $product=Product::find($id);
        $shopifies=Shopify::all();
        $woocommerces=Woocommerce::all();
        $warehouses =Warehouse::all();
        return view('frontend::product-detail',compact('product','shopifies','woocommerces','warehouses'));
    }
    public function addToCart(Request $request){
        $cart = session()->get('cart', []);
        if(isset($cart[$request->id])) {
            $cart[$request->id]['quantity'] = $cart[$request->id]['quantity'] + $request->qty;
        } else {
            $cart[$request->id] = [
                "quantity" => $request->qty,
                "type" => $request->shipping_method,
            ];
        }
        session()->put('cart', $cart);
        return redirect()->route('frontend.product-detail',['id'=>$request->id])->with('success','Product add successfully');
    }
    public function cartList(){
        $cartItems = \Cart::getContent();
        // dd($cartItems);
        return view('cart', compact('cartItems'));
    }

    public function category_products(Category $category, $f_size=0){
        if ($f_size <= 1){
            $size = 0;
        }else{
            $size = $f_size * 20;
        }
        $products= $category->products()->skip($size)->take(20)->get();

        $e_categories = ApiCategory::where('category_id', $category->id)->get();
        $e_products = get_tp_products($e_categories, $size);

        return view('frontend::category_products', compact('category', 'products', 'e_products', 'f_size'));
    }
    public function connectToWoocommerce(Request $request){

        $woocommerce = Woocommerce::connect($request->woocommerce_id);
        if ($request->type == 'internal'){
            $product = Product::find($request->product_id);
            $product_name = $product->name;
            $product_description = $product->description;
            $product_category_name = $product->categories[0]->name;
            $product_tags = $product->tags;
            $product_price = $product->price_1;
            $slug = 'SLI_'.$product->id;

            // for image
            $path = url('/').'/'.$product->thumbnail;
            $image_query = [
                [
                    "src" => $path
                ]
            ];

        }elseif ($request->type == 'external'){

            $product = external_product($request->product_id);
            $product = $product['product'];
            $product_name = $product['Title'];
            $product_description = $product['Description'];
            $product_category_name = '';
            $product_tags = '';
            $slug = 'SLE_'.$product['Id'];

            //for price
            $data = price_external_product($product['Id'],1);
            $product_price = $data['f_price'];

            // for image
            $image_query = [
                [
                    "src" => $product['Pictures'][0]['Url']
                ]
            ];

        }
        $data = [
            'name' => $product_name,
            'slug' => $slug,
            'type' => 'simple',
            'regular_price' => "$product_price",
            'description' => $product_description,
            'categories' => [
            ],
            'images' => $image_query
        ];
        $woocommerce->post('products', $data);
        return back()->with('success', 'Product Connected Successfully');
    }
    public function connectToShopify(Request $request){
        try {
            $products_ids=explode(',',$request->product_id);
            foreach($products_ids as $item){
                $product = Product::find($item);
                $product_name = $product->name;
                $product_description = $product->description;
                $product_category_name = $product->categories[0]->name;
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
                if($request->increased_by=='by_amount'){
                    $product_price+=$request->increment_in_price;
                }elseif($request->increased_by=='by_percencate'){
                    $product_price+=($request->increment_in_price/100)*$product_price;
                }
                $query = [
                    "variant" => [
                        "id" => $variant_id,
                        "price" => $product_price
                    ]
                ];
                $response = $this->shopify_call($token, $shop, "/admin/variants/".$variant_id.".json", $query, 'PUT');
            }

            return back()->with('success', 'Products Connected Successfully');
        } catch (Exception $th) {
            // dd($th);
            return back()->with('error', 'Product Connection failed');
        }
    }
    public function addStock(Request $request){
        $product = Product::find($request->product_id);
        $user = Auth::user();
        $price = price_internal_product($request->product_id, $request->quantity);
        $total = $price *  $request->quantity;
//        if ($product->user->id != $user->id){
//            if ($user->wallet > $total)
//            {
//                $user->decrement('wallet', $total);
//            }else{
//                return back()->with('danger', 'Not enough amount in wallet');
//            }
//        }

        $stock = StockRequest::where('user_id', $user->id)->where('status', 'pending')->where('product_id', $request->product_id)->where('warehouse_id', $request->warehouse_id)->first();
        if (!$stock){
            StockRequest::create([
                'user_id' => $user->id,
                'type' => 'internal',
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'warehouse_id' => $request->warehouse_id,
                'amount' => $total,
            ]);
        }else{
            $stock->increment('quantity', $request->quantity);
        }
        return back()->with('success', 'Stock Request Generated Successfully, Please wait for admin approval');
    }
    public function cart(){
        $cartItems=[];
        $count=0;
        foreach (session()->get('cart', []) as $key=>$qty){
//            dd($qty);
            $cartItems[$count]['product']=Product::find($key);
            $cartItems[$count]['quantity']=$qty['quantity'];
            $count++;
        }
        return view('frontend::cart', compact('cartItems'));
    }
    public function checkout(){
        $cartItems=[];
        $count=0;
        foreach (session()->get('cart', []) as $key=>$qty){
            $cartItems[$count]['product']=$qty['product'];
            $cartItems[$count]['quantity']=$qty['quantity'];
            $count++;
        }
        return view('frontend::checkout', compact('cartItems'));
    }
    public function removeCart($id){
        $cartItems=[];
        $count=0;
        foreach (session()->get('cart', []) as $key=>$qty){
            if($key!=$id){
                $cartItems[$count]['product']=Product::find($key);;
                $cartItems[$count]['quantity']=$qty['quantity'];
                $count++;
            }

        }
        session()->put('cart', $cartItems);
        return view('frontend::cart', compact('cartItems'));
    }
}
