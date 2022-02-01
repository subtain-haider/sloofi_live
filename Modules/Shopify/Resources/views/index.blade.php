@extends('shopify::layouts.master')

@section('content')
    <!-- content @s -->
    <div class="nk-content " style="width:100%">
        <div class="">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="components-preview">

                        <div class="nk-block">
                            <div class="nk-block-head">
                                <div class="nk-block-head-content">
                                    <h4 class="nk-block-title">Shopify Stores</h4>
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

                                            <th class="nk-tb-col"><span class="sub-text">ID</span></th>
                                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Name</span></th>
                                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Shopify Status</span></th>
                                            <th class="nk-tb-col tb-col-md"><span class="sub-text">Created At</span></th>
                                            <th class="nk-tb-col tb-col-lg"><span class="sub-text">Sync Products</span></th>
                                            <th class="nk-tb-col nk-tb-col-tools text-right">
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach ($shopifies as $key => $shopify)
                                            <tr class="nk-tb-item">
                                                <td class="nk-tb-col nk-tb-col-check">
                                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                                        <input type="checkbox" class="custom-control-input" id="{{$shopify->id}}">
                                                        <label class="custom-control-label" for="{{$shopify->id}}"></label>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col">
                                                    <span>{{$shopify->id}}</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                    <span>{{$shopify->shop}}</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                <span>
                                                    @if($shopify->status == 0 )
                                                        <span> <a href="https://{{$shopify->shop}}.myshopify.com/admin" target="_blank" class="btn btn-danger btn-sm text-white">Unauthorised</a> </span>
                                                    @else
                                                        <span class="tb-status text-success">Authorised</span>
                                                    @endif
                                                </span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                    <span>{{$shopify->created_at}}</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                <span>
                                                @if($shopify->status == 0 )

                                                    @else
                                                        <a href="{{ route('shopify.products.sync', $shopify->id) }}" class="btn btn-success btn-sm text-white">Sync New Products</a>
                                                    @endif

                                                </span>
                                                </td>

                                                <td class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-1">
                                                        <li class="nk-tb-action-hidden">
                                                            <form action="{{ route('shopify.delete',['id'=>$shopify->id]) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" onclick="return confirm('Are you sure you want to delete this item?')" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                    <em class="icon ni ni-trash-fill"></em>
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
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
@section('js')
    <script src="{{url('/')}}/admin/backend/assets/js/libs/datatable-btns.js?ver=2.9.0"></script>

    <script type="2d8d78e876b340f9029c575b-text/javascript" src="{{url('/')}}/admin/js/jquery.min.js"></script>

    <script type="2d8d78e876b340f9029c575b-text/javascript" src="{{url('/')}}/admin/js/jquery-ui.min.js"></script>
    <script type="2d8d78e876b340f9029c575b-text/javascript" src="{{url('/')}}/admin/js/popper.min.js"></script>
    <script type="2d8d78e876b340f9029c575b-text/javascript" src="{{url('/')}}/admin/js/bootstrap.min.js"></script>



    <script src="{{url('/')}}/admin/js/curvedlines.js" type="2d8d78e876b340f9029c575b-text/javascript"></script>



    <script type="2d8d78e876b340f9029c575b-text/javascript" src="{{url('/')}}/admin/js/crm-dashboard.min.js"></script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13" type="2d8d78e876b340f9029c575b-text/javascript"></script>

@endsection
