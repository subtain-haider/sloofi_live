@extends('rolepermission::layouts.master')

@section('content')
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-block nk-block-lg">
            <div class="nk-block-between mb-2">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Edit Warehouse</h3>
                    </div><!-- .nk-block-head-content -->
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                            <div class="toggle-expand-content" data-content="pageMenu">
                                 {{-- Warehouse / Edit Warehouse --}}
                            </div>
                        </div>
                    </div><!-- .nk-block-head-content -->
            </div><!-- .nk-block-between -->
            <div class="card">
            <div class="card-inner">
              <form method="POST" action="{{ route('warehouse.update',['id'=>$warehouse->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Name*</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" value="{{$warehouse->name}}" placeholder="Name" autofocus required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Address*</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="address" value="{{$warehouse->address}}" placeholder="Address" autofocus required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">City*</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="city" value="{{$warehouse->city}}" placeholder="City" autofocus required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Country*</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="country" value="{{$warehouse->country}}" placeholder="Country" autofocus required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Monthly Charge (USD)*</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="monthly" value="{{$warehouse->monthly}}" placeholder="Monthly Charge (USD)"  required>
                        </div>
                    </div>



                    <button type="submit" class="btn btn-primary float-right">Submit</button>

                </form>
        </div>
    </div>

    <!-- card -->
        </div>
    </div>
</div>
@endsection