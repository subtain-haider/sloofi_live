@extends('product::layouts.master')

@section('content')
@section('content')
    <!-- content @s -->
    <div class="nk-content " style="width: 100%;">
        <div class="" >
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="components-preview">

                        <div class="nk-block">
                            <div class="nk-block-head">
                                <div class="nk-block-head-content">
                                    <h4 class="nk-block-title">Products</h4>
                                    <div class="nk-block-des">

                                    </div>
                                </div>
                            </div>
                            <div class="card card-preview">
                                <div class="card-inner">
                                    <table style="width: 100%;" class="datatable-init-export nk-tb-list nk-tb-ulist" data-export-title="Export" data-auto-responsive="false">
                                        <thead>
                                        <tr class="nk-tb-item nk-tb-head">
                                            <th class="nk-tb-col nk-tb-col-check">
                                            </th>

                                            <th class="nk-tb-col"><span class="sub-text">Thumbnail</span></th>
                                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Name</span></th>
                                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Category</span></th>
                                            <th class="nk-tb-col tb-col-lg"><span class="sub-text">Tags</span></th>
                                            <th class="nk-tb-col nk-tb-col-tools text-right">
                                            </th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($products as $product)
                                            <tr class="nk-tb-item">
                                                <td class="nk-tb-col nk-tb-col-check">
                                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                                        <input type="checkbox" class="product custom-control-input" name="selectData[]" value="{{$product->id}}" id="dat-{{$product->id}}">
                                                        <label class="custom-control-label" for="dat-{{$product->id}}"></label>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col">
                                                    <div class="user-card">
                                                        <span><img src="{{$product->getFirstMediaUrl('thumbnail')}}" height="100" width="100" alt=""></span>
                                                    </div>
                                                </td>

                                                <td class="nk-tb-col tb-col-md">
                                                    <span>{{$product->name}}</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                    <span>{{$product->categories[0]->name??''}}</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                    <span>{{$product->tags}}</span>
                                                </td>
                                                <td class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-1">
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="{{route('product.edit',['id'=>$product->id])}}" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Edit">
                                                                <em class="icon ni ni-edit-fill"></em>
                                                            </a>
                                                        </li>
                                                        <li class="nk-tb-action-hidden">
                                                            <a role="button" data-toggle="modal" data-target="#stockModal_{{$product->id}}" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Stock">
                                                                <em class="icon ni ni-eye-fill"></em>
                                                            </a>
                                                        </li>
                                                        <li class="nk-tb-action-hidden">
                                                            <a role="button" data-toggle="modal" data-target="#addStockModal_{{$product->id}}" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Add Stock">
                                                                <em class="icon ni ni-plus"></em>
                                                            </a>
                                                        </li>
                                                        <li class="nk-tb-action-hidden">
                                                            <form action="{{route('product.delete',['id'=>$product->id])}}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button  type="submit" onclick="return confirm('Are you sure you want to delete this item?')" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                    <em class="icon ni ni-trash-fill"></em>
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                    <!-- Modal1 -->
                                                    <div class="modal fade" id="stockModal_{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Current Stock</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="card-block">
                                                                        <div class="table-responsive dt-responsive">
                                                                            <table class="table table-striped table-bordered nowrap">
                                                                                <thead>
                                                                                <tr>
                                                                                    <th>Warehouse name</th>
                                                                                    <th>Available Stock</th>
                                                                                </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                @foreach($product->stocks as $stock)
                                                                                    <tr>
                                                                                        <td>{{$stock->warehouse->name??''}}</td>
                                                                                        <td>{{$stock->quantity}}</td>
                                                                                    </tr>
                                                                                @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Modal2 -->
                                                    <div class="modal fade" id="addStockModal_{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Add Stock</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="POST" action="{{route('product.add-stock')}}">
                                                                        @csrf
                                                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                                                        <div class="form-group">
                                                                            <label for="quantity">Quantity</label>
                                                                            <input type="number" class="form-control" id="quantity" name="quantity" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="warehouse">Warehouse</label>
                                                                            <select class="form-select select2-hidden-accessible" name="warehouse_id" id="warehouse" required>
                                                                                @foreach($warehouses as $warehouse)
                                                                                    <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>

                                                                        <button type="submit" class="btn btn-primary">Add</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- .card-preview -->
                        </div> <!-- nk-block -->

                    </div><!-- .components-preview -->
                </div>
            </div>
        </div>
    </div>
    <!-- content @e -->


@endsection
