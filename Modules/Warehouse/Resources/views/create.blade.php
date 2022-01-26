@extends('rolepermission::layouts.master')

@section('content')
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-block nk-block-lg">
            <div class="nk-block-between mb-2">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Add Warehouse</h3>
                    </div><!-- .nk-block-head-content -->
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                            <div class="toggle-expand-content" data-content="pageMenu">
                                 {{-- Warehouse / Add Warehouse --}}
                            </div>
                        </div>
                    </div><!-- .nk-block-head-content -->
            </div><!-- .nk-block-between -->
            <div class="card">
            <div class="card-inner">
              <form method="POST" action="{{ route('warehouse.store') }}" >
                @csrf
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Name*</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" placeholder="Name" autofocus required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Address*</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="address" placeholder="Address"  required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">City*</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="city" placeholder="City"  required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Country*</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="country" placeholder="Country"  required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Monthly Charge (USD)*</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="monthly" placeholder="Monthly Charge (USD)"  required>
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