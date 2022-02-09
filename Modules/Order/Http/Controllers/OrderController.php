<?php

namespace Modules\Order\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Auth;
use Modules\Frontend\Entities\Basket;
use Modules\Frontend\Entities\Order;
use Modules\Order\Entities\ExternalOrder;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $orders = $user->orders;
        return view('order::index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('order::create');
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
    public function show(Request $request)
    {
        $order=Order::find($request->id);
        $html='';
        foreach ($order->baskets as $item){
            $pro=$item->product;
            $html=$html.'<tr><td>'.$pro->name.'</td><td>'.$item->quantity.'</td></tr>';
        }
        return $html;
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('order::edit');
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
    public function sloofiOrders(){
        $baskets = Basket::where('owner','sloofi')->pluck('basketable_id')->toArray();;
        $orders = Order::wherein('id',$baskets)->paginate(10);
        $owner = 'sloofi';

        return view('order::index', compact('orders','owner'));
    }
    public function internalOrders(){
        $user = Auth::user();
        $owner = 'vendor_internal';
        if ($user->is_admin){
            $baskets = Basket::where('owner',$owner);
        }else{
            $products = $user->products()->pluck('id')->toArray();
            $baskets = Basket::wherein('product_id',$products);
        }
        $baskets = $baskets->pluck('basketable_id')->toArray();
        $orders = Order::wherein('id',$baskets)->paginate(10);
        return view('order::index', compact('orders','owner'));
    }
    public function externalOrders(){
        $user = Auth::user();
        if ($user->is_admin){
            $owner = '';
            $orders = ExternalOrder::paginate(10);
        }else{
            $owner = 'vendor';
            $orders = $user->externalOrders()->paginate(10);
        }
        return view('order::index', compact('orders','owner'));
    }
    public function order_detail(Request $request){
        $order = Order::find($request->order_id);
        $owner = $request->owner;
        return view('front.ajax.order_detail', compact('order', 'owner'));
    }

    public function external_order_detail(Request $request){
        $order = ExternalOrder::find($request->order_id);
        $owner = $request->owner;
        return view('front.ajax.external_order_detail', compact('order', 'owner'));
    }
}
