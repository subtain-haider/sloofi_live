<?php

namespace Modules\RolePermission\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Permission;
use Auth;
class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $rows=Permission::paginate(20);
        return view('rolepermission::permissions.list',compact('rows'));
    }

   /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('rolepermission::permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
       $request->validate([
            'name'=>'required|unique:permissions,name',
        ]);
        $role =new Permission();
        $role->name=$request->name;
        $role->save();
        return redirect('permission/all')->with('success','Successfully Added');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('role::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $row=Permission::find($id);
        return view('rolepermission::permissions.edit',compact('row'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:permissions,name,'.$request->id.',id',
        ]);
        $row=Permission::find($request->id);
        $row->name=$request->name;
        $row->save();
        return redirect('permission/all')->with('success','Successfully Updated');
       
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        if(Auth::user()->can('delete_permission')){
            Permission::find($id)->delete();
            return redirect('permission/all')->with('success','Successfully Deleted');
        }else{
            return redirect('permission/all')->with('error','Not authorized');
        }
        
    }
}
