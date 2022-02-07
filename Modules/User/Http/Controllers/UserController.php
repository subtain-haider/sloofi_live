<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use Hash,Auth;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $rows=User::whereHas('roles', function ($query) {
            $query->where('name','!=', 'super_admin');
        })->paginate(10);
        return view('user::index',compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('user::create');
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
        $user=User::find($id);
        return view('user::detail',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('user::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request)
    {
        $user=User::find($request->id);
        $user->name=$request->name;
        if($request->password){
            $user->password=Hash::make($request->password);
        }
        $user->save();
        return back()->with('success','Updated Successfully');
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
    public function becomeAVendor(){
        return view('user::become-a-vendor');
    }
    public function becomeAVendorPost(Request $request){
        $user = Auth::user();
        $user->shop()->create([
            'name' => $request->name,
            'address' => $request->address,
        ]);
        $user->assignRole('vendor');
        return redirect('/dashboard')->with('success','You successfully become a vendor');
    }
    public function becomeADropshipper(){
        return view('user::become-a-dropshipper');
    }
    public function becomeADropshipperPost(){
        $user = Auth::user();
        $user->assignRole('dropshipper');
        return redirect('/dashboard')->with('success','You successfully become a Dropshipper');
    }
}
