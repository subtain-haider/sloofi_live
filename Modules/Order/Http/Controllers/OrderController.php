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
        if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('super_admin')){
            $orders = Order::all();
        }else{
            $orders = $user->orders;
        }

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
        $user = Auth::user();
        foreach ($order->baskets as $item){
            $pro=$item->product;
            $vendor = $item->product->user->name;
            if($user->hasRole('admin') || $user->hasRole('super_admin')){

            }else{
                if ($user->email != $item->product->user->email)
                {
                    continue;
                }
            }
            $html=$html.'<tr><td><img width="100px" height="100px" src="'.$pro->getMedia('thumbnail')->first()->getUrl().'" alt=""></td><td>'.$pro->name.'</td><td>'.$vendor.'</td><td>'.$item->quantity.'</td><td><div style="width: 50px; height: 50px; background-color: '.$item->color.'"></div></td><td>'.$item->size.'</td></tr>';
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
        $owner = 'sloofi';
        $baskets = Basket::where('owner',$owner)->pluck('basketable_id')->toArray();;
        $orders = Order::wherein('id',$baskets)->paginate(10);

        return view('order::index', compact('orders','owner'));
    }
    public function internalOrders(){
        $user = Auth::user();
        $owner = 'vendor_internal';
        if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('super_admin')){
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
        if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('super_admin')){
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
