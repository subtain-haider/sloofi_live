@extends('user::layouts.master')

@section('content')
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-block nk-block-lg">
                <div class="nk-block-between mb-2">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Shop Information</h3>
                    </div><!-- .nk-block-head-content -->
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                            <div class="toggle-expand-content" data-content="pageMenu">
                                {{-- Categories/Add Category --}}
                            </div>
                        </div>
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
                @php($total=10)
                <div class="card">
                    <div class="card-inner">

                        <form method="POST" action="{{ route('user.become-a-vendor.post') }}" enctype="multipart/form-data" name="demoform" id="demoform">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Shop Name*</label>
                                <div class="col-sm-10">
                                    <input type="hidden" name="transaction_id" id="transaction_id">
                                    <input type="hidden" name="status" id="status">
                                    <input type="hidden" name="total_paid" id="total_paid">
                                    <input type="text" class="form-control" name="name" placeholder="Shop Name" autofocus required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Shop Address</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="address" name="address" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Pay Fee</label>
                                <div style="width: 50%"  id="paypaldev"> <div id="paypal-button-container"></div></div>
                            </div>
                            <button type="submit" id="process_button" class="btn btn-primary float-right" disabled>Submit</button>

                        </form>
                    </div>
                    </div>
                </div><!-- card -->

            </div>
        </div>
@endsection
@section('script')
    <script>
        var total=10;
    </script>
   @include('payment::paypal')

@endsection
