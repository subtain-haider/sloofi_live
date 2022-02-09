<?php

namespace Modules\User\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\Deposit;
use Auth;
class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('user::index');
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
        return view('user::show');
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
    public function update(Request $request, $id)
    {
        //
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
    public function deposit(){
        return view('user::deposit');
    }
    public function depositStore(Request $request){
        $request->validate([
            'amount' => 'required',
        ]);
        $unique_id = strtoupper(uniqid());
        $deposit = 'test';
        while ($deposit){
            $unique_id = strtoupper(uniqid());
            $deposit = Deposit::where('unique_id', $unique_id)->first();
        }
        $user = Auth::user();
        $deposit=$user->deposits()->create([
            'amount' => $request->amount,
            'file' => '',
            'notes' => $request->notes,
            'unique_id' => $unique_id,
            'status'=>$request->type=='card'?'approved':'pending'
        ]);
        if($request->type=='card'){
            $user=User::find(Auth::user()->id);
            $user->wallet=$user->wallet+ $request->amount;
            $user->save();
        }
        if($request->file ){
            $deposit->addMediaFromRequest('file')->toMediaCollection('file');
        }
        return redirect()->route('user.my-wallet')->with('success','Deposit Added');
    }
    public function myWallet(){
        $user = Auth::user();
        $deposits = $user->deposits()->orderBy('id', 'desc')->get();
        return view('user::my-wallet',compact('user','deposits'));
    }
    public function depositPending(){
        $deposits = Deposit::orderBy('id', 'desc')->where('status','pending')->get();
        return view('user::deposits',compact('deposits'));
    }
    public function depositUpdate($id,$type){
        $deposit=Deposit::find($id);
        Deposit::where('id',$id)->update(['status'=>$type]);
        if($type=='approved'){
            $user=User::where('id',$deposit->user_id)->first();
            $user->wallet=$user->wallet+$deposit->amount;
            $user->save();
        }
        return redirect()->route('user.deposit.all')->with('success','Updated');
    }
}
