<?php

namespace Modules\Warehouse\Repositories;


use App\Models\User;
use Modules\Product\Entities\Product;
use Modules\Stock\Entities\StockRequest;
use Modules\Warehouse\Interfaces\WarehouseInterface;
use Modules\Warehouse\Entities\Warehouse;
use Auth;
class WarehouseRepository implements WarehouseInterface
{
    public function allWarehouse(){
        return Warehouse::all();
    }
    public function createWarehouse(array $warehouseData)
    {
        return Warehouse::create($warehouseData);
    }
    public function editWarehouse($warehouseId){
        return Warehouse::findOrFail($warehouseId);
    }
    public function updateWarehouse(array $warehouseData, $warehouseId)
    {
        return Warehouse::whereId($warehouseId)->update($warehouseData);
    }
    public function deleteWarehouse($warehouseId)
    {
        return Warehouse::destroy($warehouseId);
    }
    public function manageStock($warehouseData,$warehouseId){
        $products = [];
        $warehouse = Warehouse::find($warehouseId);
        $filters = [];
        if (count($warehouseData) > 0){
            if (Auth::user()->getRoleNames()=='super_admin'){
                $stocks = $warehouse->stocks()->where($warehouseData);
            }else{
                $stocks = $warehouse->stocks()->where('user_id', Auth::id())->where($warehouseData);
            }
            $filters = $warehouseData;
        }else{
            if (Auth::user()->getRoleNames()!='super_admin'){
                $stocks = $warehouse->stocks()->where('user_id', Auth::id());
            }else {
                $stocks = $warehouse->stocks();
            }
        }
        if (Auth::user()->getRoleNames()=='super_admin'){
            $users = User::get();
            $products = Product::has('stocks')->get();
        }else{
            $products = Product::has('stocks')->where('user_id',Auth::id())->get();
            $users = '';
        }
        $data['products'] =$products;
        $data['stocks'] = $stocks->paginate(10);
        $data['stock_requests'] = StockRequest::paginate();
        $data['warehouse']=$warehouse;
        $data['filters']=$filters;
        return $data;
    }
}

