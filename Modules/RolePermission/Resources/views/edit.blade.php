@extends('rolepermission::layouts.master')

@section('content')
<div class="components-preview mx-auto">
    <div class="nk-block-head nk-block-head-lg wide-sm">
        <div class="nk-block-head-content">
            <h2 class="nk-block-title fw-normal">Edit Role Permissions</h2>
        </div>
    </div><!-- .nk-block -->
    
    <div class="nk-block nk-block-lg">
        <div class="row g-gs">
            <div class="col-lg-12">
                <div class="card h-100">
                    <div class="card-inner">
                        <div class="card-head">
                            <h5 class="card-title">Role Info</h5>
                        </div>
                        <form method="post" action="{{ route('rolepermission.update') }}" >
                            @csrf
                            <div class="form-group">
                                <label class="form-label" for="full-name">Role Name</label>
                                <div class="form-control-wrap">
                                    <input type="hidden" name="role_id" value="{{ $role->id }}">
                                    <input type="text" class="form-control" id="name" name="role_name" value="{{ $role->name }}" readonly>
                                </div>
                                <div class="form-group my-4">
                                    <label class="form-label">Permissions</label>
                                    <ul class="custom-control-group g-3 align-center">
                                        @foreach ($permissions as $item)
                                        @php
                                            $permission=$role->permissions->where('id',$item->id)->count();
                                        @endphp
                                            <li>
                                                <div class="custom-control custom-control-sm custom-checkbox">
                                                    <input type="checkbox" value="{{ $item->id }}" class="custom-control-input" @if($permission>0) checked="true" @endif name="permissions[{{ $item->id }}]" id="permissions_{{  $item->id }}">
                                                    <label class="custom-control-label"  for="permissions_{{  $item->id }}">{{ $item->name }}</label>
                                                </div>
                                            </li>
                                        @endforeach
                                </div>
                                <div class="form-control-wrap my-2">
                                    <button type="submit" class="btn btn-lg btn-primary">Update</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- .components-preview -->
</div>
@endsection
