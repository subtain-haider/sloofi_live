@extends('user::layouts.master')

@section('content')
    <div class="nk-content " style="width: 100%;">
        <div class="">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="components-preview">

                        <div class="row g-gs">
                            <div class="col-xxl-4 col-md-6">
                                <div class="card h-100" style="background : #e70f0fd9">
                                    <div class="nk-ecwg nk-ecwg1">
                                        <div class="card-inner">
                                            <div class="card-title-group">
                                                <div class="card-title">
                                                    <h6 class="title text-white">Available Balance</h6>
                                                </div>
                                            </div>
                                            <div class="data">
                                                <div class="amount text-white">${{$user->wallet}}</div>
                                            </div>
                                        </div><!-- .card-inner -->
                                    </div><!-- .nk-ecwg -->
                                </div><!-- .card -->
                            </div><!-- .col -->

                        </div>
                        <br>
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
                                            <th class="nk-tb-col tb-col-md"><span class="sub-text">Amount</span></th>
                                            <th class="nk-tb-col tb-col-lg"><span class="sub-text">Notes</span></th>
                                            <th class="nk-tb-col tb-col-lg"><span class="sub-text">File</span></th>
                                            <th class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></th>
                                            <th class="nk-tb-col tb-col-md"><span class="sub-text">Created At</span></th>
                                            <!-- <th class="nk-tb-col nk-tb-col-tools text-right">
                                            </th> -->
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

