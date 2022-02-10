<?php

namespace Modules\Frontend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Modules\Frontend\Entities\Basket;
use Modules\Frontend\Entities\Order;
use Modules\Product\Entities\Property;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\Section;
use Modules\Shopify\Entities\Shopify;
use Modules\Stock\Entities\StockRequest;
use Modules\ThirdPartyApi\Entities\ApiCategory;
use Modules\Warehouse\Entities\Warehouse;
use Modules\Woocommerce\Entities\Woocommerce;
use Session;
use Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $categories=Category::all();
        $sections=Section::all();
        $warehouses=Warehouse::all();
        return view('frontend::index',compact('categories','sections','warehouses'));
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
    public function external_productDetail($id){
        $data = external_product($id);
        $product = $data['product'];
        $shopifies=Shopify::all();
        $woocommerces=Woocommerce::all();
        $warehouses =Warehouse::all();
        return view('frontend::external-product-detail',compact('product','shopifies','woocommerces','warehouses'));
    }
    public function addToCart(Request $request){
        $cart = session()->get('cart', []);
        if(isset($cart[$request->id])) {
            $cart[$request->id]['quantity'] = $cart[$request->id]['quantity'] + $request->qty;
        } else {
            $cart[$request->id] = [
                "type" => $request->type,
                "quantity" => $request->qty,
                "warehouse_id" => $request->warehouse_id,
                "country"=>$request->country,
                'shipping_method'=>$request->shipping_method,
                'color'=>$request->color,
                'size'=>$request->size,
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success','Product add successfully');
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
            if(array_key_exists('type', $qty)){
                if ($qty['type'] == 'internal'){
                    $cartItems[$key]['product']=Product::find($key);
                }else{
                    $cartItems[$key]['product']=external_product($key);
                }
                $cartItems[$key]['type']=$qty['type'];
                $cartItems[$key]['quantity']=$qty['quantity'];
                $cartItems[$key]['country']=$qty['country'];
                $cartItems[$key]['shipping_method']=$qty['shipping_method'];
                $cartItems[$key]['warehouse_id']=$qty['warehouse_id'];
                $count++;

            }

        }
        return view('frontend::cart', compact('cartItems'));
    }
    public function checkout(){
        $cartItems=[];
//        dd(session()->get('cart', []));
        foreach (session()->get('cart', []) as $key=>$qty){
            if(array_key_exists('type', $qty)) {
                if ($qty['type'] == 'internal') {
                    $cartItems[$key]['product'] = Product::find($key);
                } else {
                    $cartItems[$key]['product'] = external_product($key);
                }
                $cartItems[$key]['type'] = $qty['type'];
                $cartItems[$key]['quantity'] = $qty['quantity'];
            }
        }
        return view('frontend::checkout', compact('cartItems'));
    }
    public function removeCart($id){
        $cartItems= session()->pull('cart', []);
        unset($cartItems[$id]);
        session()->put('cart', $cartItems);
        return redirect()->back();
    }
    public function paymentPage(Request $request){
//        dd($request->all());
        $cartItems = session()->get('cart',[]);

        $total = 0;
        if (count($cartItems) <= 0){
            return back();
        }
        foreach ($cartItems as $key=>$item){
            if(array_key_exists('type', $item)) {
                if ($item['type'] == 'internal') {
                    $product = Product::find($key);
//            dd($product);
                    $price1 = $product->prices->where('qty', 1)->first() ? $product->prices->where('qty', 1)->first()->value : 0;
                    $price100 = $product->prices->where('qty', 100)->first() ? $product->prices->where('qty', 100)->first()->value : 0;
                    $price1000 = $product->prices->where('qty', 1000)->first() ? $product->prices->where('qty', 1000)->first()->value : 0;
                    if ($item['quantity'] > 0 && $item['quantity'] < 100) {
                        $price = $price1;
                    } elseif ($item['quantity'] > 99 && $item['quantity'] < 1000) {
                        $price = $price100;
                    } elseif ($item['quantity'] > 999) {
                        $price = $price1000;
                    } else {
                        $price = 0;
                    }
                    $total += $item['quantity'] * $price;
                }else {
                    $data = price_external_product($key,1);
                    $f_price = $data['f_price'];
                    $total+=$item['quantity']*$f_price;
                }
            }
        }
        $order = new Order();
        $user = Auth::user();
//dd( $request->all());
        $order->user_id = $user->id;
        $order->name = $user->name;
        $order->email = $user->email;
        $order->account = 'login';

//        $order->payment_company = $request->payment_company;
        $order->payment_address_1 = $request->address;
//        $order->payment_address_2 = $request->payment_address_2;
//        $order->payment_city = $request->payment_city;
//        $order->payment_postcode = $request->payment_postcode;
        $order->payment_country = $request->country;

//        $order->shipping_address = $request->shipping_address;

//        if ($request->shipping_address != 1){
//            $order->shipping_firstname = $request->shipping_firstname;
//            $order->shipping_lastname = $request->shipping_lastname;
//            $order->shipping_company = $request->shipping_company;
//            $order->shipping_address_1 = $request->shipping_address_1;
//            $order->shipping_city = $request->shipping_city;
//            $order->shipping_country = $request->shipping_country;
//        }

//        $order->shipping_method = $request->shipping_method;
        $order->payment_method = $request->payment_method;
//        $order->comment = $request->comment;
        $order->total = $total;
        $order->save();

        foreach ($cartItems as $key => $item){
            //todo remove this line
            if(array_key_exists('type', $item)) {
                if ($item['type'] == 'internal') {
                    $product = Product::find($key);
                    $price1 = $product->prices->where('qty', 1)->first() ? $product->prices->where('qty', 1)->first()->value : 0;
                    $price100 = $product->prices->where('qty', 100)->first() ? $product->prices->where('qty', 100)->first()->value : 0;
                    $price1000 = $product->prices->where('qty', 1000)->first() ? $product->prices->where('qty', 1000)->first()->value : 0;
                    if ($item['quantity'] < 100) {
                        $price = $price1;
                    } elseif ($item['quantity'] > 99 && $item['quantity'] < 999) {
                        $price = $price100 > 0 ? $price100 : $price1;
                    } elseif ($item['quantity'] > 999) {
                        if ($price1000) {
                            $price = $price1000;
                        } elseif ($price100) {
                            $price = $price100;
                        } else {
                            $price = $price1;
                        }
                    }


                    if ($product->user_id == 1) {
                        $owner = 'sloofi';
                    } else {
                        $owner = 'vendor';
                    }
                } elseif ($item['type'] == 'external') {
                    $owner = 'sloofi';
                    $data = price_external_product($key, 1);
                    $price = $data['f_price'];
                }
                $basket = new Basket();
                $basket->price = $price;
                $basket->quantity = $item['quantity'];
                $basket->type = $item['type'];
                $basket->owner = $owner;
                $basket->product_id = $key;
                $basket->warehouse_id = $item['warehouse_id'];
                $basket->country = $item['country'];
                $basket->shipping_method = $item['shipping_method'];
                $basket->color = $item['color'];
                $basket->size = $item['size'];
                $order->baskets()->save($basket);
            }
        }
        session()->forget('cart');
        return redirect()->route('order.all')->with('success','Order Created Successfully');
    }
    public function searchProduct(Request $request){
        $products = new Product;
        $user = Auth::user();
        if ($request->search){
            $products = $products->where('name', 'like', '%'.$request->search.'%')->get();;
        }else{
            $products=[];
        }
        return view('frontend::search',compact('products'));
    }
}
