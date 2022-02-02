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
        $cart = session()->get('cart', []);

        if(isset($cart[$request->id])) {
            $cart[$request->id]['quantity'] = $cart[$request->id]['quantity'] + $request->qty;
        } else {
            $cart[$request->product_id] = [
                "quantity" => $request->qty,
                "type" => $request->shipping_method,
            ];
        }
        return redirect()->route('frontend.product-detail',['id'=>$request->id])->with('success','Product add successfully');
    }
    public function cartList(){
        $cartItems = \Cart::getContent();
        // dd($cartItems);
        return view('cart', compact('cartItems'));
    }
}
