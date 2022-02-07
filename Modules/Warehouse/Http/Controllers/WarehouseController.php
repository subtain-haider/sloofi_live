<?php

namespace Modules\Warehouse\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Warehouse\Http\Requests\WarehouseRequest;
use Modules\Warehouse\Interfaces\WarehouseInterface;
class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    private $warehouseRepository;

    public function __construct(WarehouseInterface $warehouseRepository)
    {
        $this->warehouseRepository = $warehouseRepository;
    }

    public function index()
    {
        $warehouses = $this->warehouseRepository->allWarehouse();
        return view('warehouse::index', compact('warehouses'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('warehouse::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(WarehouseRequest $request)
    {
        $this->warehouseRepository->createWarehouse($request->except('_token'));
        return back()->with('success', 'Warehouse Added Successfully');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('warehouse::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $warehouse=$this->warehouseRepository->editWarehouse($id);
        return view('warehouse::edit',compact('warehouse'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(WarehouseRequest $request, $id)
    {   $this->warehouseRepository->updateWarehouse($request->except('_token','_method'),$id);
        return redirect('/warehouse/all')->with('success', 'Warehouse Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $this->warehouseRepository->deleteWarehouse($id);
        return redirect('/warehouse/all')->with('success', 'Warehouse Deleted Successfully');
    }
    public function manageStock(Request $request,$id){
        $data=$this->warehouseRepository->manageStock($request->except('_token'),$id);
       return view('warehouse::stock')->with($data);
    }
}
