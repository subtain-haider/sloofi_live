@extends('user::layouts.master')

@section('content')
    <div class="nk-content " style="width: 100%;">
        <div class="">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="components-preview">
                        <div class="nk-block">
                            <div class="nk-block-between mb-2">
                                <div class="nk-block-head-content">
                                    <h3 class="nk-block-title page-title">My Deposits</h3>
                                </div><!-- .nk-block-head-content -->
                                <div class="nk-block-head-content">
                                    <div class="toggle-wrap nk-block-tools-toggle">
                                        <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                        <div class="toggle-expand-content" data-content="pageMenu">
                                            {{--  Products / All Products  --}}
                                        </div>
                                    </div>
                                </div><!-- .nk-block-head-content -->
                            </div><!-- .nk-block-between -->

                            <div class="card card-preview">
                                <div class="card-inner">
                                    <table style="width: 100%;" class="datatable-init-export nk-tb-list nk-tb-ulist" data-export-title="Export" data-auto-responsive="false">
                                        <thead>
                                        <tr class="nk-tb-item nk-tb-head">
                                            <th class="nk-tb-col nk-tb-col-check">
                                            </th>

                                            <th class="nk-tb-col"><span class="sub-text">ID</span></th>
                                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Unique ID</span></th>
                                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">User</span></th>
                                            <th class="nk-tb-col tb-col-md"><span class="sub-text">Amount</span></th>
                                            <th class="nk-tb-col tb-col-lg"><span class="sub-text">Notes</span></th>
                                            <th class="nk-tb-col tb-col-lg"><span class="sub-text">File</span></th>
                                            <th class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></th>
                                            <th class="nk-tb-col tb-col-md"><span class="sub-text">Created At</span></th>
                                            <th class="nk-tb-col nk-tb-col-tools text-right">
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>


                                        @foreach($deposits as $deposit)
                                            <tr class="nk-tb-item">
                                                <td class="nk-tb-col nk-tb-col-check">
                                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                                        <input type="checkbox" class="custom-control-input" id="{{$deposit->id}}">
                                                        <label class="custom-control-label" for="{{$deposit->id}}"></label>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col">
                                                    <span>{{$deposit->id}}</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                    <span>{{$deposit->unique_id}}</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                    <span>{{$deposit->user->name}}</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                    <span>{{$deposit->amount}}</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                    <span>{{$deposit->notes}}</span>
                                                </td>

                                                <td> <span>
                                                @if($deposit->file != '') <a href="{{url('/'). '/' . $deposit->file}}" target="_blank" class="btn btn-primary">Download File</a> @endif</td>
                                                </span>
                                                <td>
                                                    @if($deposit->status == 'approved')
                                                        <span class="tb-status text-success">Approved</span>
                                                    @else
                                                        <span class="tb-status text-danger">{{$deposit->status}}</span>
                                                    @endif
                                                </td>

                                                <td class="nk-tb-col tb-col-md">
                                                    <span>{{$deposit->created_at}}</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                    @if($deposit->status=='pending')
                                                        <form action="{{route('user.deposit.update',['id'=>$deposit->id,'type'=>'approved'])}}" method="POST">
                                                                @csrf
                                                                <button  type="submit" value="approve" onclick="return confirm('Are you sure you want to approve this item?')" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Approve">
                                                                    <em class="icon ni ni-check-circle-fill"></em>
                                                                </button>
                                                            </form>
                                                        <form action="{{route('user.deposit.update',['id'=>$deposit->id,'type'=>'reject'])}}" method="POST">
                                                            @csrf
                                                            <button  type="submit" value="reject" onclick="return confirm('Are you sure you want to reject this item?')" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Reject">
                                                                <em class="icon ni ni-cross-circle-fill"></em>
                                                            </button>
                                                        </form>
@endif
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
@endsection
