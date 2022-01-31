<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Product\Interfaces\ProductInterface;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    private $productRepository;

    public function __construct(ProductInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    public function index()
    {
        $data=$this->productRepository->allProduct();
        return view('product::index',)->with($data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $data=$this->productRepository->createProduct();
        return view('product::create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $this->productRepository->storeProduct($request->except('_token'));
        return redirect()->route('product.all')->with('success', 'Product Added Successfully');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('product::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $data= $this->productRepository->editProduct($id);
        return view('product::edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $this->productRepository->updateProduct($request->except('_token'),$id);
        return redirect()->route('product.all')->with('success', 'Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $this->productRepository->deleteProduct($id);
        return redirect()->route('product.all')->with('success', 'Product Deleted Successfully');
    }
    public function addStock(Request $request){
        $this->productRepository->addStock($request->except('_token'));
        return redirect()->route('product.all')->with('success', 'Stock added Successfully');
    }
}
