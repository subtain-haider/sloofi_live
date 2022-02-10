<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\Product;
use Modules\Product\Interfaces\ProductInterface;
use Modules\Shopify\Entities\Shopify;
use Modules\Warehouse\Entities\Warehouse;
use Modules\Woocommerce\Entities\Woocommerce;
use Auth;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    private $productRepository;

    public function __construct(ProductInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    public function index()
    {
        $data=$this->productRepository->allProduct();
        return view('product::index',)->with($data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $data=$this->productRepository->createProduct();
        return view('product::create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $this->productRepository->storeProduct($request->except('_token'));
        return redirect()->route('product.all')->with('success', 'Product Added Successfully');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('product::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $data= $this->productRepository->editProduct($id);
        return view('product::edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $this->productRepository->updateProduct($request->except('_token'),$id);
        return redirect()->route('product.all')->with('success', 'Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $this->productRepository->deleteProduct($id);
        return redirect()->route('product.all')->with('success', 'Product Deleted Successfully');
    }
    public function addStock(Request $request){
        $this->productRepository->addStock($request->except('_token'));
        return redirect()->route('product.all')->with('success', 'Stock added Successfully');
    }
    public function connectWoocommerce(Request $request)
    {
        try {
            $products_ids=explode(',',$request->products_ids);
            //connect the wocommerce using helper function
            $woocommerce=Woocommerce::connect($request->id);

            foreach( $products_ids as $item){
                $product = Product::find($item);
                $price1=$product->prices->where('qty',1)->first()?$product->prices->where('qty',1)->first()->value:0;
                $product_name = $product->name;
                $product_description = $product->description;
                $product_category_name = $product->categories[0]->name;
                $product_tags = $product->tags;
                $product_price = $price1;
                if($request->increased_by=='by_amount'){
                    $product_price+=$request->increment_in_price;
                }elseif($request->increased_by=='by_percencate'){
                    $product_price+=(($request->increment_in_price/100)*$product_price);
                }
                $slug = 'SLI_'.$product->id;

                // for image
                $path = $product->getFirstMediaUrl('thumbnail');
                //todo make check webp not allowed
                $image_query = [
                    [
                        "src" =>$path
                    ]
                ];
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
            }
            return back()->with('success', 'Products Connected Successfully');
        } catch (Exception $th) {
            // dd($th);
            return back()->with('error', 'Product Connection failed');
        }
    }
    public function connectShopify(Request $request)
    {
        try {
            $products_ids=explode(',',$request->products_ids);
            foreach($products_ids as $item){
                $product = Product::find($item);
                $product_name = $product->name;
                $product_description = $product->description;
                $product_category_name = $product->categories[0]->name;
                $product_tags = $product->tags;
                $product_price=$product->prices->where('qty',1)->first()?$product->prices->where('qty',1)->first()->value:0;

                // for image
                $path = $product->getFirstMediaUrl('thumbnail');
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
                $response = Shopify::shopify_call($token, $shop, "/admin/products.json", $query, 'POST');

                //adding image
                $product_id = json_decode($response['response'])->product->id;
                $response = Shopify::shopify_call($token, $shop, "/admin/products/".$product_id."/images.json", $image_query, 'POST');

                // adding price
                $response = Shopify::shopify_call($token, $shop, "/admin/products/".$product_id."/variants.json", array(), 'GET');
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
                $response = Shopify::shopify_call($token, $shop, "/admin/variants/".$variant_id.".json", $query, 'PUT');
            }

            return back()->with('success', 'Products Connected Successfully');
        } catch (Exception $th) {
            // dd($th);
            return back()->with('error', 'Product Connection failed');
        }
    }
    public function list (){
        $products = Product::get();
        $warehouses=Warehouse::all();
        $woocommerces = Woocommerce::where('user_id',Auth::user()->id)->get();
        $shopify_strores= Shopify::where('user_id',Auth::user()->id)->get();
        return view('product::list',compact('products','warehouses','woocommerces','shopify_strores'));
    }

}
