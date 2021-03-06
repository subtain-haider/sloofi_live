@extends('warehouse::layouts.master')

@section('content')
<div class="nk-content" style="width: 100%;">
    <div class="">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview">

                    <div class="nk-block">
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <h4 class="nk-block-title">Warehouses</h4>
                                <div class="nk-block-des">
                                    <!-- <p>Using the most basic table markup, here’s how <code class="code-class">.table</code> based tables look by default.</p> -->
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

                                            <th class="nk-tb-col"><span class="sub-text">Name</span></th>
                                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Address</span></th>
                                            <th class="nk-tb-col tb-col-md"><span class="sub-text">City</span></th>
                                            <th class="nk-tb-col tb-col-lg"><span class="sub-text">Country</span></th>
                                            <th class="nk-tb-col tb-col-lg"><span class="sub-text">Monthly Charge (USD)</span></th>
                                            <th class="nk-tb-col tb-col-md"><span class="sub-text">Manage Stock</span></th>
                                            @can('view_warehouse')
                                            <th class="nk-tb-col nk-tb-col-tools text-right">
                                            </th>
                                            @endcan

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($warehouses as $warehouse)
                                        <tr class="nk-tb-item">
                                            <td class="nk-tb-col nk-tb-col-check">
                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                    <input type="checkbox" class="custom-control-input" id="{{$warehouse->id}}">
                                                    <label class="custom-control-label" for="{{$warehouse->id}}"></label>
                                                </div>
                                            </td>
                                            <td class="nk-tb-col">
                                                <span>{{$warehouse->name}}</span>
                                            </td>
                                            <td class="nk-tb-col tb-col-md">
                                                <span>{{$warehouse->address}}</span>
                                            </td>
                                            <td class="nk-tb-col tb-col-md">
                                                <span>{{$warehouse->city}}</span>
                                            </td>
                                            <td class="nk-tb-col tb-col-md">
                                                <span>{{$warehouse->country}}</span>
                                            </td>
                                            <td class="nk-tb-col tb-col-md">
                                                <span>{{$warehouse->monthly}}</span>
                                            </td>
                                            <td class="nk-tb-col tb-col-md">
                                                <span><a href="{{route('warehouse.manage-stock',['id'=>$warehouse->id])}}" class="btn btn-primary btn-sm">Manage Stock</a></span>
                                            </td>

                                            @can('view_warehouse')
                                            <td class="nk-tb-col nk-tb-col-tools">
                                                <ul class="nk-tb-actions gx-1">
                                                    @can('edit_warehouse')
                                                    <li class="nk-tb-action-hidden">
                                                        <a href="{{ route('warehouse.edit',['id'=>$warehouse->id]) }}" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Edit">
                                                            <em class="icon ni ni-edit-fill"></em>
                                                        </a>
                                                    </li>
                                                    @endcan
                                                        @can('delete_warehouse')
                                                    <li class="nk-tb-action-hidden">
                                                        <form action="{{ route('warehouse.delete',['id'=>$warehouse->id]) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" onclick="return confirm('Are you sure you want to delete this item?')" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                <em class="icon ni ni-trash-fill"></em>
                                                            </button>
                                                        </form>
                                                    </li>
                                                        @endcan
                                                </ul>
                                            </td>
                                            @endcan
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
@section('js')
<script src="{{url('/')}}/admin/backend/assets/js/libs/datatable-btns.js?ver=2.9.0"></script>
@endsection
