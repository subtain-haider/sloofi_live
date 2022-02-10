<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use Modules\Package\Entities\Package;
use Hash,Auth;
use Modules\User\Entities\Deposit;

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
        $packages=Package::all();
        return view('user::become-a-dropshipper',compact('packages'));
    }
    public function becomeADropshipperPost(Request $request){
        $package=Package::where('price',$request->package_price)->first();
        $user = User::find(Auth::user()->id);
        $unique_id = strtoupper(uniqid());
        $deposit = 'test';
        while ($deposit){
            $unique_id = strtoupper(uniqid());
            $deposit = Deposit::where('unique_id', $unique_id)->first();
        }
        if($request->type=='bank'){
            $deposit=$user->deposits()->create([
                'amount' => $package->price,
                'file' => '',
                'notes' => '',
                'unique_id' => $unique_id,
                'status'=>'pending',
                'type'=>'buy_package'
            ]);
            if($request->file ){
                $deposit->addMediaFromRequest('file')->toMediaCollection('file');
            }
            $user->package_id=$package->id;
            $user->save();
            $user->assignRole('dropshipper');
        }else{
            $user->package_id=$package->id;
            $user->save();
            $user->assignRole('dropshipper');
        }


        return redirect('/dashboard')->with('success','You successfully become a Dropshipper');
    }
    public function profile(){
        return view('user::profile');
    }
    public function profileUpdate(Request $request){
        $user=User::find(Auth::user()->id);
        $user->name=$request->name;
        if($request->password){
            $user->password=Hash::make($request->password);
        }
        $user->save();
        return redirect('/dashboard')->with('success','Updated');
    }
}
