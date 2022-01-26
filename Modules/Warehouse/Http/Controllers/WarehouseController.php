<?php

namespace Modules\Warehouse\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Warehouse\Entities\Warehouse;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $warehouses = new Warehouse();
        if ($request->search){
            $warehouses = $warehouses->where('name', 'like', '%'.$request->search.'%');
        }
        $warehouses = $warehouses->get();
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
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'monthly' => 'required',
        ]);
        $warehouse = new Warehouse;
        $warehouse->name = $request->name;
        $warehouse->address = $request->address;
        $warehouse->city = $request->city;
        $warehouse->country = $request->country;
        $warehouse->monthly = $request->monthly;
        $warehouse->save();
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
        $warehouse=Warehouse::find($id);
        return view('warehouse::edit',compact('warehouse'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {   $warehouse=Warehouse::find($id);
        $warehouse->name = $request->name;
        $warehouse->address = $request->address;
        $warehouse->city = $request->city;
        $warehouse->country = $request->country;
        $warehouse->monthly = $request->monthly;
        $warehouse->save();
        return redirect('/warehouse/all')->with('success', 'Warehouse Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $warehouse=Warehouse::find($id);
        $warehouse->delete();
        return back()->with('success', 'Warehouse Deleted Successfully');
    }
}
