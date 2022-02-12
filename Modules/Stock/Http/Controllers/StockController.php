<?php

namespace Modules\Stock\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Stock\Entities\Stock;
use Modules\Stock\Entities\StockRequest;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('stock::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('stock::create');
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
        return view('stock::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('stock::edit');
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
    public function approve($id){
//        dd($id);
        $p_stock = StockRequest::find($id);
        $stock = Stock::where('user_id', $p_stock->user_id)->where('product_id', $p_stock->product_id)->where('warehouse_id', $p_stock->warehouse_id)->first();
        if (!$stock){
            Stock::create([
                'user_id' => $p_stock->user_id,
                'type' => $p_stock->type,
                'product_id' => $p_stock->product_id,
                'quantity' => $p_stock->quantity,
                'warehouse_id' => $p_stock->warehouse_id,
            ]);
        }else{
            $stock->increment('quantity', $p_stock->quantity);
        }
        $p_stock->update([
            'status' => 'approved'
        ]);
        return redirect()->route('warehouse.manage-stock',['id'=>$p_stock->warehouse_id])->with('success','updated');
    }
    public function reject($id){
        $p_stock = StockRequest::find($id);
        $p_stock->update([
            'status' => 'rejected'
        ]);
        $user = User::find($p_stock->user_id);
        $user->increment('wallet', $p_stock->amount);
        return redirect()->route('warehouse.manage-stock',['id'=>$id])->with('success','updated');
    }
}
