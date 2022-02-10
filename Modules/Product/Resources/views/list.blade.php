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
                                        <div class="pull-right">
                                            {{-- <a href="javascript(0)" data-url="{{ route('shopifyProducts.connect') }}" onclick="connectShPBtn(event,this)" class="pull-right btn-sm btn btn-primary mr-2"></a> --}}
                                            <button type="button" onclick="connectWCBtn(this)" class="pull-right btn-sm btn btn-primary mr-2" >
                                                Connect to Woocommerce
                                            </button>
                                            <button type="button" onclick="connectShPBtn(this)" class="pull-right btn-sm btn btn-primary mr-2" >
                                                Connect to Shopify
                                            </button>
                                            {{-- <a href="javascript(0)" data-url="{{ route('woocommerceProducts.connect') }}" onclick="connectBtn(event,this)" class="pull-right btn-sm btn btn-primary">Connect to Woocommerce</a> --}}
                                        </div>
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
    <div class="modal fade" id="connectToWoocommerce" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Connect to Woocommerce </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form  action="{{ route('product.connect.woocommerce') }}">
                        <input type="hidden" name="products_ids" class="products_ids">
                        <div class="form-group">
                            <label for="warehouse">Select Woocimmerce store</label>
                            <select class="form-control" name="woocommerce_id">
                                @if($woocommerces && count($woocommerces))
                                    @foreach($woocommerces as $item)
                                        <option value="{{ $item->id }}">{{ $item->url }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="warehouse">Price Incraese by</label>
                            <select class="form-control" name="increased_by">
                                <option value="by_amount">By Amount</option>
                                <option value="by_percencate">By Percentage</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Add In Price</label>
                            <input type="number" class="form-control" id="increment_in_price" name="increment_in_price" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Connect to Woocommerce</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="connectToShopify" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Connect to Shopify </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form  action="{{ route('product.connect.shopify') }}">
                        <input type="hidden" name="products_ids" class="products_ids">
                        <div class="form-group">
                            <label for="warehouse">Select Shopify store</label>
                            <select class="form-control" name="shopify_id">
                                @if($shopify_strores && count($shopify_strores))
                                    @foreach($shopify_strores as $item)
                                        <option value="{{ $item->id }}">{{ $item->shop }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="warehouse">Price Incraese by</label>
                            <select class="form-control" name="increased_by">
                                <option value="by_amount">By Amount</option>
                                <option value="by_percencate">By Percentage</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Add In Price</label>
                            <input type="number" class="form-control" id="increment_in_price" name="increment_in_price" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Connect to Shopify</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')

    <script src="{{url('/')}}/admin/backend/assets/js/libs/datatable-btns.js?ver=2.9.0"></script>
    <script>

        selected_products = [];
        $(".product").on( 'change', function(){
            if (this.checked) {
                selected_products.push($(this).val());
            }else{
                selected_products= selected_products.filter(item => item !==  $(this).val())
            }
            $('.products_ids').val(selected_products);

        });
        function connectShPBtn(e){
            // e.preventDefault();
            if (selected_products === undefined || selected_products.length == 0) {
                alert("None value selected, Please select at least one");
                return false;
            }else{
                $('#connectToShopify').modal('toggle');
            }
        }
        function connectWCBtn(e) {
            console.log(selected_products)
            // e.preventDefault();
            // var url = $(d).attr('data-url');
            // var val = [];
            // $("input[name='selectData[]']").each(function(){
            //     if (this.checked) {
            //         val.push($(this).val());
            //     }
            // });
            if (selected_products === undefined || selected_products.length == 0) {
                alert("None value selected, Please select at least one");
                return false;
            }else{
                $('#connectToWoocommerce').modal('toggle');
            }
        }

    </script>

@endsection
