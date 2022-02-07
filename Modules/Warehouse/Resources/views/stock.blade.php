@extends('warehouse::layouts.master')

@section('content')
    <div class="pcoded-content">

        <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="feather icon-inbox bg-c-blue"></i>
                        <div class="d-inline">
                            <h5>{{$warehouse->name}}</h5>
                            {{--                            <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span>--}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="page-header-breadcrumb">
                        <ul class=" breadcrumb breadcrumb-title">
                            <li class="breadcrumb-item">
                                <a href="index.html"><i class="feather icon-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Warehouses</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Manage Stock</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="pcoded-inner-content">

            <div class="main-body m-5">
                <div class="page-wrapper">

                    <div class="page-body">

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="approved-tab" data-toggle="tab" href="#approved" role="tab" >Total Stock</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="profile" aria-selected="false">Stock Requests</a>
                            </li>

                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="approved" role="tabpanel" aria-labelledby="home-tab">
                                <div class="card">
                                    <div class="card-header">
                                        <form action="{{route('warehouse.manage-stock',['id'=>$warehouse->id])}}" method="POST" >
                                            @csrf
                                            <div class="row">
                                                <div class="col">
                                                    <h5>Country: {{$warehouse->country}}</h5>
                                                </div>

                                                <div class="col">
                                                    <select name="product_id" class="form-control">
                                                        <option selected disabled> Select Product</option>
                                                        @foreach($products as $product)
                                                            <option value="{{$product->id}}" @if(array_key_exists('product_id', $filters) == $product->id) selected @endif>{{$product->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col">

                                                    <select name="type" class="form-control">
                                                        <option selected disabled> Select Product Type</option>
                                                        <option value="internal" @if(array_key_exists('type', $filters) == 'internal') selected @endif>Internal</option>
                                                        <option value="external" @if(array_key_exists('type', $filters) == 'external') selected @endif>External</option>
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    @if(\Illuminate\Support\Facades\Auth::user()->getRoleNames()=='super_admin'))
                                                        <select name="user_id" class="form-control">
                                                            <option selected disabled> Select User</option>
                                                            @foreach($users as $single_user)
                                                                <option value="{{$single_user->id}}" @if(array_key_exists('user_id', $filters) == $single_user->id) selected @endif>{{$single_user->name}} ({{$single_user->email}})</option>
                                                            @endforeach
                                                        </select>
                                                    @endif
                                                </div>
                                                <div class="col d-flex btn-sm">

                                                    <button type="submit" class="btn btn-success btn-sm">Search</button>
                                                    <a href="/admin/manage_stock/{{$warehouse->id}}" class="btn btn-danger btn-sm">Clear Filter</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="card-block">
                                        <div class="table-responsive dt-responsive">
                                            <table class="table table-striped table-bordered nowrap">
                                                <thead>
                                                <tr>


                                                    <th>Product Image</th>
                                                    <th>Product Name</th>
                                                    <th>Product Type</th>
                                                    <th>User Name</th>
                                                    <th>User Email</th>
                                                    <th>Quantity</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($stocks as $stock)
                                                    @if($stock->type == 'internal')
                                                        <tr>

                                                            <td><img src="{{url('/')}}/{{$stock->product->thumbnail}}" height="100" width="100" alt=""></td>
                                                            <td>{{$stock->product->name}}</td>
                                                            <td>{{$stock->type}}</td>
                                                            <td>{{$stock->user->name}}</td>
                                                            <td>{{$stock->user->email}}</td>
                                                            <td>{{$stock->quantity}}</td>

                                                        </tr>
                                                    @elseif($stock->type == 'external')
                                                        @php
                                                            $product = external_product($stock->product_id);
                                                            $product = $product['product'];
                                                        @endphp
                                                        <tr>

                                                            <td><img src="{{$product['Pictures'][0]['Url']}}" height="100" width="100" alt=""></td>
                                                            <td>{{$product['Title']}}</td>
                                                            <td>{{$stock->type}}</td>
                                                            <td>{{$stock->user->name}}</td>
                                                            <td>{{$stock->user->email}}</td>
                                                            <td>{{$stock->quantity}}</td>

                                                        </tr>
                                                    @endif
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>Product Image</th>
                                                    <th>Product Name</th>
                                                    <th>Product Type</th>
                                                    <th>User Name</th>
                                                    <th>User Email</th>
                                                    <th>Quantity</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                            <div class="d-flex justify-content-center">
                                                {!! $stocks->links() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="pending" role="tabpanel" >
                                <div class="card">
                                    <div class="card-header">
                                    </div>
                                    <div class="card-block">
                                        <div class="table-responsive dt-responsive">
                                            <table class="table table-striped table-bordered nowrap">
                                                <thead>
                                                <tr>
                                                    <th>Product Image</th>
                                                    <th>Product Name</th>
                                                    <th>Product Type</th>
                                                    <th>User Name</th>
                                                    <th>User Email</th>
                                                    <th>Quantity</th>
                                                    <th>Status</th>
                                                    <th>Created At</th>
                                                    <th>Action</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($stock_requests as $stock)
                                                    @if($stock->type == 'internal')
                                                        <tr>
                                                            <td><img src="{{url('/')}}/{{$stock->product->thumbnail}}" height="100" width="100" alt=""></td>

                                                            <td>{{$stock->product->name}}</td>
                                                            <td>{{$stock->type}}</td>
                                                            <td>{{$stock->user->name}}</td>
                                                            <td>{{$stock->user->email}}</td>
                                                            <td>{{$stock->quantity}}</td>
                                                            <td>
                                                                @if($stock->status == 'approved')
                                                                    <button class="btn btn-sm btn-round btn-success">Approved</button>
                                                                @else
                                                                    <button class="btn btn-sm btn-round btn-danger">{{$stock->status}}</button>
                                                                @endif
                                                            </td>
                                                            <td>{{$stock->created_at}}</td>
                                                            <td>
                                                                @if($stock->status == 'pending' and \Illuminate\Support\Facades\Auth::user()->is_admin)
                                                                    <a href="/admin/stock/approve/{{$stock->id}}" onclick="if (confirm('Are you sure you want to approve this request?')){return true;}else{event.stopPropagation(); event.preventDefault();};" class="btn btn-success btn-sm">Approve</a>
                                                                    <a href="/admin/stock/reject/{{$stock->id}}" onclick="if (confirm('Are you sure you want to reject this request?')){return true;}else{event.stopPropagation(); event.preventDefault();};" class="btn btn-danger btn-sm">Reject</a>
                                                                @endif
                                                            </td>

                                                        </tr>
                                                    @elseif($stock->type == 'external')
                                                        @php
                                                            $product = external_product($stock->product_id);
                                                            $product = $product['product'];
                                                        @endphp
                                                        <tr>

                                                            <td><img src="{{$product['Pictures'][0]['Url']}}" height="100" width="100" alt=""></td>
                                                            <td>{{$product['Title']}}</td>
                                                            <td>{{$stock->type}}</td>
                                                            <td>{{$stock->user->name}}</td>
                                                            <td>{{$stock->user->email}}</td>
                                                            <td>{{$stock->quantity}}</td>
                                                            <td>
                                                                @if($stock->status == 'approved')
                                                                    <button class="btn btn-sm btn-round btn-success">Approved</button>
                                                                @else
                                                                    <button class="btn btn-sm btn-round btn-danger">{{$stock->status}}</button>
                                                                @endif
                                                            </td>
                                                            <td>{{$stock->created_at}}</td>
                                                            <td>
                                                                @if($stock->status == 'pending' and \Illuminate\Support\Facades\Auth::user()->is_admin)
                                                                    <a href="/admin/stock/approve/{{$stock->id}}" onclick="if (confirm('Are you sure you want to approve this request?')){return true;}else{event.stopPropagation(); event.preventDefault();};" class="btn btn-success">Approve</a>
                                                                    <a href="/admin/stock/reject/{{$stock->id}}" onclick="if (confirm('Are you sure you want to reject this request?')){return true;}else{event.stopPropagation(); event.preventDefault();};" class="btn btn-danger">Reject</a>
                                                                @endif
                                                            </td>

                                                        </tr>
                                                    @endif
                                                @endforeach

                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>Product Image</th>
                                                    <th>Product Name</th>
                                                    <th>Product Type</th>
                                                    <th>User Name</th>
                                                    <th>User Email</th>
                                                    <th>Quantity</th>
                                                    <th>Status</th>
                                                    <th>Created At</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                            <div class="d-flex justify-content-center">
                                                {!! $stock_requests->links() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>

                </div>
            </div>

            <div id="styleSelector">
            </div>
        </div>
    </div>
@endsection

