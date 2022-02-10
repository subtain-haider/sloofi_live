@extends('user::layouts.master')

@section('content')
<div class="nk-content-inner">
    <div class="nk-content-body">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">User Lists</h3>
                </div><!-- .nk-block-head-content -->
                {{-- <div class="nk-block-head-content">
                    <div class="toggle-wrap nk-block-tools-toggle">
                        <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="more-options"><em class="icon ni ni-more-v"></em></a>
                        <div class="toggle-expand-content" data-content="more-options">
                            <ul class="nk-block-tools g-3">
                                <li>
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-right">
                                            <em class="icon ni ni-search"></em>
                                        </div>
                                        <input type="text" class="form-control" id="default-04" placeholder="Search by name">
                                    </div>
                                </li>
                                <li>
                                    <div class="drodown">
                                        <a href="#" class="dropdown-toggle dropdown-indicator btn btn-outline-light btn-white" data-toggle="dropdown">Status</a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <ul class="link-list-opt no-bdr">
                                                <li><a href="#"><span>Active</span></a></li>
                                                <li><a href="#"><span>Inactived</span></a></li>
                                                <li><a href="#"><span>Blocked</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div><!-- .nk-block-head-content --> --}}
            </div><!-- .nk-block-between -->
        </div><!-- .nk-block-head -->
        <div class="nk-block">
            <div class="nk-tb-list is-separate mb-3">
                <div class="nk-tb-item nk-tb-head">
                    <div class="nk-tb-col nk-tb-col-check">
                        <div class="custom-control custom-control-sm custom-checkbox notext">
                            <input type="checkbox" class="custom-control-input" id="uid">
                            <label class="custom-control-label" for="uid"></label>
                        </div>
                    </div>
                    <div class="nk-tb-col"><span class="sub-text">User</span></div>
                    <div class="nk-tb-col"><span class="sub-text">Roles</span></div>
                    <div class="nk-tb-col tb-col-md"><span class="sub-text">Sign Up Date</span></div>
                    <div class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></div>
                    <div class="nk-tb-col nk-tb-col-tools">
                    </div>
                </div><!-- .nk-tb-item -->
                @foreach ($rows as $row)
                <div class="nk-tb-item">
                    <div class="nk-tb-col nk-tb-col-check">
                        <div class="custom-control custom-control-sm custom-checkbox notext">
                            <input type="checkbox" class="custom-control-input" id="uid1">
                            <label class="custom-control-label" for="uid1"></label>
                        </div>
                    </div>
                    <div class="nk-tb-col">
                        <a href="{{ route('user.detail',['id'=>$row->id]) }}">
                            <div class="user-card">
                                <div class="user-avatar bg-primary">
                                    <span>{{  strtoupper(substr($row->name, 0, 2)) }}</span>
                                </div>
                                <div class="user-info">
                                    <span class="tb-lead">{{ $row->name }} <span class="dot dot-success d-md-none ml-1"></span></span>
                                    <span>{{ $row->email }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="nk-tb-col tb-col-lg">
                        @php
                            $roles=$row->getRoleNames()->toArray();
                        @endphp
                        <span>@foreach($roles as $key=>$role) {{str_replace('_',' ',$role)}} @if($key+1!=count($roles)) ,@endif @endforeach</span>
                    </div>
                    <div class="nk-tb-col tb-col-lg">
                        <span>{{ date_format($row->created_at,"d M Y H:i:s") }}</span>
                    </div>
                    <div class="nk-tb-col tb-col-md">
                        <span class="tb-status text-success">Active</span>
                    </div>
                    <div class="nk-tb-col nk-tb-col-tools">
                        <ul class="nk-tb-actions gx-1">
                            {{-- <li class="nk-tb-action-hidden">
                                <a href="#" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Send Email">
                                    <em class="icon ni ni-mail-fill"></em>
                                </a>
                            </li>
                            <li class="nk-tb-action-hidden">
                                <a href="#" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Suspend">
                                    <em class="icon ni ni-user-cross-fill"></em>
                                </a>
                            </li> --}}
                            {{-- <li>
                                <div class="drodown">
                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <ul class="link-list-opt no-bdr">
                                            <li><a href="html/ecommerce/customer-details.html"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                            <li><a href="#"><em class="icon ni ni-repeat"></em><span>Orders</span></a></li>
                                            <li><a href="#"><em class="icon ni ni-activity-round"></em><span>Activities</span></a></li>
                                            <li class="divider"></li>
                                            <li><a href="#"><em class="icon ni ni-shield-star"></em><span>Reset Pass</span></a></li>
                                            <li><a href="#"><em class="icon ni ni-na"></em><span>Suspend</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li> --}}
                        </ul>
                    </div>
                </div><!-- .nk-tb-item -->
                @endforeach
            </div><!-- .nk-tb-list -->
            <div class="card">
                <div class="card-inner">
                    <div class="nk-block-between-md g-3">
                        <div class="g">
                            {{$rows->links()}}
                        </div>
                    </div><!-- .nk-block-between -->
                </div><!-- .card-inner -->
            </div><!-- .card -->
        </div><!-- .nk-block -->
    </div>
</div>
@endsection
