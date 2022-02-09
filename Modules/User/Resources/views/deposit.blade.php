@extends('user::layouts.master')

@section('content')
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-block nk-block-lg">
                <div class="nk-block-between mb-2">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Deposit Amount</h3>
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

                        <form method="POST" action="{{route('user.deposit.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Amount in USD*</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="total_amount" name="amount" placeholder="Amount" autofocus="" required>
                                    <input type="hidden" name="transaction_id" id="transaction_id">
                                    <input type="hidden" name="status" id="status">
                                    <input type="hidden" name="total_paid" id="total_paid">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Notes</label>
                                <div class="col-sm-10">
                                    <textarea rows="5" cols="5" class="form-control" name="notes" placeholder="Notes"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Payment Type</label>
                                <div class="col-sm-10">
                                   <select name="type" class="form-control" id="type">
                                       <option value="card">With card</option>
                                       <option value="bank">Bank Transfer</option>
                                   </select>
                                </div>
                            </div>
                            <div class="form-group row" id="card">
                                <label class="col-sm-2 col-form-label">Amount</label>
                                <div style="width: 50%"  id="paypaldev"> <div id="paypal-button-container"></div></div>
                            </div>
                            <div class="form-group row" style="display:none;" id="bank_transfer">
                                <label class="col-sm-2 col-form-label">Document</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="file">
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary float-right">Submit</button>

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

        $('#total_amount').keyup(function (){
            total=$('#total_amount').val();
        })

    </script>
    @include('payment::paypal')
    <script>
        $('#type').change(function (){
           var type=$(this).val();
           if(type=='bank'){
               $('#card').hide();
               $('#bank_transfer').show();
           }else{
               $('#card').show();
               $('#bank_transfer').hide();
           }
        });
    </script>
@endsection
