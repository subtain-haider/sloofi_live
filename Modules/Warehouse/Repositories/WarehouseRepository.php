<?php

namespace Modules\Warehouse\Repositories;


use Modules\Warehouse\Interfaces\WarehouseInterface;
use Modules\Warehouse\Entities\Warehouse;

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
}

