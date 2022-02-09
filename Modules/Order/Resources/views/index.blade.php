@extends('order::layouts.master')

@section('content')
    <!-- content @s -->
    <div class="nk-content " style="width: 100%;">
        <div class="">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="components-preview">

                        <div class="nk-block">
                            <div class="nk-block-head">
                                <div class="nk-block-head-content">
                                    <h4 class="nk-block-title">All Orders</h4>
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
                                            <th class="nk-tb-col tb-col-lg"><span class="sub-text">Email</span></th>
                                            <th class="nk-tb-col tb-col-lg"><span class="sub-text">Payment Address</span></th>
                                            <th class="nk-tb-col tb-col-md"><span class="sub-text">Payment City</span></th>
                                            {{-- <th>Payment Country</th>
                                            <th>Shipping Address</th>
                                            <th>Shipping City</th>
                                            <th>Shipping Country</th>
                                            <th>Shipping Method</th>
                                            <th>Payment Method</th>
                                            <th>Comment</th>
                                            <th>Status</th> --}}
                                            <th class="nk-tb-col nk-tb-col-tools text-right">
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @php($x =1)
                                        @if($orders && count($orders))
                                        @foreach($orders as $order)
                                            <tr class="nk-tb-item">
                                                <td class="nk-tb-col nk-tb-col-check">
                                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                                        <input type="checkbox" class="custom-control-input" id="{{$order->id}}">
                                                        <label class="custom-control-label" for="{{$order->id}}"></label>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col">
                                                    <span>{{$order->id}}</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                    <span>{{$order->name}}</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                    <span>{{$order->email}}</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                    <span>{{$order->payment_address_1}} {{$order->payment_address_2}}</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                    <span>{{$order->payment_city}}</span>
                                                </td>

                                                {{-- <td>{{$order->payment_country}}</td>
                                                <td>{{$order->shipping_address_1}} {{$order->shipping_address_2}}</td>
                                                <td>{{$order->shipping_city}}</td>
                                                <td>{{$order->shipping_country}}</td>
                                                <td>{{$order->shipping_method}}</td>
                                                <td>{{$order->payment_method}}</td>
                                                <td>{{$order->comment}}</td>
                                                <td>{{$order->status}}</td> --}}
                                                <td class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-1">
                                                        <li class="nk-tb-action-hidden">
                                                            <a role="button"  data-toggle="modal" onclick="orderDetail({{$order->id}})" data-target="#orderdetail" value="{{$order->id}}" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Order Detail">
                                                                <em class="icon ni ni-edit-fill"></em>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            @php($x++)
                                        @endforeach
                                        @endif
                                        @if(!$orders)
                                            <tr>
                                                <td colspan="14">No data available</td>
                                            </tr>
                                        @endif

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
    <div class="modal fade" id="orderdetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Order Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-block">
                        <div class="table-responsive dt-responsive">
                            <table class="table table-striped table-bordered nowrap">
                                <thead >
                                <tr>
                                    <th>Product Name</th>
                                    <th>Available Stock</th>
                                </tr>
                                </thead>
                                <tbody class="orderRows">

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{url('/')}}/admin/backend/assets/js/libs/datatable-btns.js?ver=2.9.0"></script>
    <script>
        function orderDetail(id){
            $.ajax({
                url: "{{ route('order.detail') }}",
                data: {
                    id: id
                },
                success: function(data) {
                    console.log(data);
                   $('.orderRows').html(data)
                },
                error: function(jqxhr, status, exception) {
                   
                }
            });
        }
    </script>
@endsection
