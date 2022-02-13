@extends('user::layouts.master')

@section('content')
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-block nk-block-lg">
                <div class="nk-block-between mb-2">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Become a Dropshipper</h3>
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
                <div class="card">
                    <div class="card-inner">

                        <form method="POST" action="{{ route('user.become-a-dropshipper.post') }}" enctype="multipart/form-data" name="demoform" id="demoform">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Select Package</label>
                                <div class="col-sm-10">
                                    <select name="package_price" id="package" class="form-control">
                                        @foreach($packages as $package)
                                            <option value="{{$package->price}}">{{$package->name}}(${{$package->price}})</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="transaction_id" id="transaction_id">
                                    <input type="hidden" name="status" id="status">
                                    <input type="hidden" name="total_paid" id="total_paid">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Payment Type</label>
                                <div class="col-sm-10">
                                    <select name="type" class="form-control" id="type">
                                        <option value="card">Paypal or Credit card</option>
                                        <option value="stripe">Pay with Stripe</option>
                                        <option value="bank">Bank Transfer</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row" id="card">
                                <label class="col-sm-2 col-form-label">Amount</label>
                                <div style="width: 50%"  id="paypaldev"> <div id="paypal-button-container"></div></div>
                            </div>
                            <div class="form-group row" id="stripe" style="display: none">
                                <label class="col-sm-2 col-form-label">Card Info</label>
                                <div > @include('payment::stripe-card')</div>

                            </div>
                            <div class="form-group row" style="display:none;" id="bank_transfer">
                                <label class="col-sm-2 col-form-label">Document</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="file">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12 text-center">
                                    <button type="submit" id="" class="btn btn-primary float-right">Become a Dropshipper</button>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div><!-- card -->

        </div>
    </div>
@endsection
@section('script')
    <script>
        var total=0;

        total=$('#package').val()

    </script>
    @include('payment::paypal')
    @include('payment::stripe')
    <script>
        $('#type').change(function (){
            var type=$(this).val();
            if(type=='bank'){
                $('#card').hide();
                $('#bank_transfer').show();
                $('#stripe').hide();
            }else if(type=='stripe') {
                $('#card').hide();
                $('#bank_transfer').hide();
                $('#stripe').show();
            }else{
                $('#card').show();
                $('#bank_transfer').hide();
                $('#stripe').hide();
            }
        });
    </script>
@endsection
