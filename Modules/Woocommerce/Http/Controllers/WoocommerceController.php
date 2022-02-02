<?php

namespace Modules\Woocommerce\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Woocommerce\Entities\Woocommerce;
use Modules\Woocommerce\Interfaces\WoocommerceInterface;

class WoocommerceController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    private $woocommerceRepository;

    public function __construct(WoocommerceInterface $woocommerceRepository)
    {
        $this->woocommerceRepository = $woocommerceRepository;
    }
    public function index()
    {
        $woocommerces=$this->woocommerceRepository->allWoocommerces();
        return view('woocommerce::index',compact('woocommerces'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('woocommerce::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $this->woocommerceRepository->createWoocommerce($request->except('_token'));
        return redirect()->route('woocommerce.all')->with('success','Woocommerce Store added');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('woocommerce::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('woocommerce::edit');
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
        $this->woocommerceRepository->deleteWoocommerce($id);
        return redirect()->route('woocommerce.all')->with('success','Woocommerce Store deleted successfully');
    }
    public function syncProducts($id){
        $woocommerce=Woocommerce::connect($id);
        $products =$woocommerce->get('products');
        Woocommerce::synProducts($products,$id);
        return redirect()->route('woocommerce.all')->with('success','Products syronized successfully');
    }
    public function woocommerceProducts($storeId=''){
        $data=$this->woocommerceRepository->myWoocommerceProducts($storeId);
        $data['storeId']=$storeId;
        return view('woocommerce::my-products')->with($data);
    }
}
