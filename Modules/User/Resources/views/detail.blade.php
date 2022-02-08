@extends('user::layouts.master')

@section('content')
<div class="nk-block">
    <div class="card">
        <div class="card-aside-wrap">
            <div class="card-inner card-inner-lg">
                <div class="nk-block-head nk-block-head-lg">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title">Personal Information</h4>
                        </div>
                        <div class="nk-block-head-content align-self-start d-lg-none">
                            <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                        </div>
                    </div>
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="nk-data data-list">
                        <form method="post" action="{{ route('user.update') }}">
                            @csrf
                            <div class="data-head">
                                <h6 class="overline-title">Basics</h6>
                            </div>
                            <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                <div class="data-col">
                                    <span class="data-label">Full Name</span>
                                    <input name="name" class="form-control" value="{{ $user->name }}">
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                </div>
                            </div><!-- data-item -->
                            <div class="data-item">
                                <div class="data-col">
                                    <span class="data-label">Email</span>
                                    <span class="data-value">{{ $user->email }}</span>
                                </div>
                            </div><!-- data-item -->
                            <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                <div class="data-col">
                                    <span class="data-label">Change Password</span>
                                    <input name="password" type="password" class="form-control" placeholder="New Password" >
                                </div>
                            </div><!-- data-item -->
                            @if($user->id!=1)
                                @can('user_update')
                                    <button type="submit" class="btn btn-lg btn-primary my-3 right-pull">Save Changes</button>
                                @endcan
                            @endif
                        </form>
                    </div><!-- data-list -->
                </div><!-- .nk-block -->
            </div>
            <div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg" data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
                <div class="card-inner-group" data-simplebar>
                    <div class="card-inner">
                        <div class="user-card">
                            <div class="user-avatar bg-primary">
                                <span>{{  strtoupper(substr($user->name, 0, 2)) }}</span>
                            </div>
                            <div class="user-info">
                                <span class="lead-text">{{ $user->name }}</span>
                                <span class="sub-text">{{ $user->email }}</span>
                            </div>
                            {{-- <div class="user-action">
                                <div class="dropdown">
                                    <a class="btn btn-icon btn-trigger mr-n2" data-toggle="dropdown" href="#"><em class="icon ni ni-more-v"></em></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <ul class="link-list-opt no-bdr">
                                            <li><a href="#"><em class="icon ni ni-camera-fill"></em><span>Change Photo</span></a></li>
                                            <li><a href="#"><em class="icon ni ni-edit-fill"></em><span>Update Profile</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div> --}}
                        </div><!-- .user-card -->
                    </div><!-- .card-inner -->
                    <div class="card-inner">
                        <div class="user-account-info py-0">
                            <h6 class="overline-title-alt">Sign Up Date</h6>
                            <div class="user-balance">{{ date_format($user->created_at,"d M Y H:i:s") }}</div>
                        </div>
                    </div><!-- .card-inner -->
                    <div class="card-inner p-0">
                        <ul class="link-list-menu">
                            <li><a class="active" href="{{ url('user/detail/'.$user->id) }}"><em class="icon ni ni-user-fill-c"></em><span>Personal Infomation</span></a></li>
                            {{-- <li><a href="html/user-profile-notification.html"><em class="icon ni ni-bell-fill"></em><span>Notifications</span></a></li>
                            <li><a href="html/user-profile-activity.html"><em class="icon ni ni-activity-round-fill"></em><span>Account Activity</span></a></li> --}}
                        </ul>
                    </div><!-- .card-inner -->
                </div><!-- .card-inner-group -->
            </div><!-- card-aside -->
        </div><!-- .card-aside-wrap -->
    </div><!-- .card -->
</div><!-- .nk-block -->
@endsection
