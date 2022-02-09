<?php

namespace Modules\Package\Http\Controllers;


use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Package\Entities\Package;
use Spatie\Permission\Models\Role;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $packages=Package::all();
        return view('package::index',compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $roles=Role::where('name','<>','super_admin')->get();
        return view('package::create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
       Package::create($request->except('_token'));
       return redirect()->route('package.all')->with('success','Created');;
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('package::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $roles=Role::where('name','<>','super_admin')->get();
        $package=Package::find($id);
        return view('package::edit',compact('package','roles'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        Package::where('id',$id)->update($request->except('_token'));
        return redirect()->route('package.all')->with('success','Updated');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        Package::where('id',$id)->delete();
        return redirect()->route('package.all')->with('success','Deleted');
    }
}
