@extends('rolepermission::layouts.master')

@section('content')
<div class="components-preview wide-md mx-auto">
    <div class="nk-block-head nk-block-head-lg wide-sm">
        <div class="nk-block-head-content">
            <h2 class="nk-block-title fw-normal">Edit Permission</h2>
        </div>
    </div><!-- .nk-block -->
    <div class="nk-block nk-block-lg">
        <div class="row g-gs">
            <div class="col-lg-12">
                <div class="card h-100">
                    <div class="card-inner">
                        <div class="card-head">
                            <h5 class="card-title">Permission Info</h5>
                        </div>
                        <form method="post" action="{{ route('permission.update') }}" >
                            @csrf
                            <div class="form-group">
                                <label class="form-label" for="full-name">Permission Name</label>
                                <div class="form-control-wrap">
                                    <input type="hidden" name="id" value="{{ $row->id }}">
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $row->name }}" required>
                                </div>
                                @can('edit permission')
                                <div class="form-control-wrap my-2">
                                    <button type="submit" class="btn btn-lg btn-primary">Update</button>
                                </div>
                                @endcan
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- .components-preview -->

@endsection
