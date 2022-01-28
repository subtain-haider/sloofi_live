<?php

namespace Modules\Warehouse\Interfaces;

interface WarehouseInterface
{
    public function allWarehouse();
    public function createWarehouse(array $warehouseData);
    public function editWarehouse($warehouseId);
    public function updateWarehouse(array $warehouseData,$warehouseId);
    public function deleteWarehouse($warehouseId);
}
