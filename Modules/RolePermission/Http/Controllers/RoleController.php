<?php

namespace Modules\RolePermission\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $rows=Role::where('name','!=','super_admin')->get();
        return view('rolepermission::roles.list',compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('rolepermission::roles.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:roles,name',
        ]);
        $role =new Role();
        $role->name=$request->name;
        $role->save();
        return redirect('role/all')->with('success','Successfully Added');
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
        $row=Role::find($id);
        return view('rolepermission::roles.edit',compact('row'));
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
            'name'=>'required|unique:roles,name,'.$request->id.',id',
        ]);
        $row=Role::find($request->id);
        $row->name=$request->name;
        $row->save();
        return redirect('role/all')->with('success','Successfully Updated');
       
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $role=Role::find($id);
        if($role->users()->count()>0){
            return redirect('role/all')->with('error','Can not delete this role because users exist of this role.');
        }else{
            $row=Role::find($id)->delete();
            return redirect('role/all')->with('success','Successfully Deleted');
        }
    }
}
