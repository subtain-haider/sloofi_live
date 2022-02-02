<?php

namespace Modules\Frontend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Modules\Product\Entities\Property;
use Modules\Product\Entities\Product;
use Session;

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
        return view('frontend::product-detail',compact('product'));
    }
    public function addToCart(Request $request){
        $products=Session::get('cart');
        // dd($products);
        $exist=0;
        if(isset($products) && count($products)){
            foreach($products as $key=>$product){
                if($product['id']==$request->id){
                    $product['qty']= $product['qty']+$request->qty;
                    $exist=1;
                    $products[$key]=$product;
                }
            }
        }
        if(!$exist){
            $data['id']=$request->id;
            $data['shipping_from1']=$request->shipping_from1;
            $data['shipping_from2']=$request->shipping_from2;
            $data['platform']=$request->platform;
            $data['shipping_to']=$request->shipping_to;
            $data['shipping_method']=$request->shipping_method;
            $data['qty']=$request->qty;
            $products[$products?count($products):0]=$data;
        }
        Session::put(['cart'=>$products]);
        return redirect()->route('frontend.product-detail',['id'=>$request->id])->with('success','Product add successfully');
    }
}
