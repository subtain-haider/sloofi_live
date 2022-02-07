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
                <div class="card">
                    <div class="card-inner">

                        <form method="POST" action="{{ route('user.become-a-vendor.post') }}" enctype="multipart/form-data" name="demoform" id="demoform">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Shop Name*</label>
                                <div class="col-sm-10">
                                    <input type="hidden" name="transaction_id" id="transaction_id">
                                    <input type="hidden" name="status" id="status">
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
    <script
        src="https://www.paypal.com/sdk/js?client-id=AZwVefyA0CbM0FGkmhyumhE9gDfnxAa3lV0PbEGodd2kq9zhs0wj7Vh_OfDjRIh3xkcqWrtap1zmKEIk">
    </script>
    <script>

        paypal.Buttons({
            createOrder: function(data, actions) {
                // This function sets up the details of the transaction, including the amount and line item details.
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '10'
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                // This function captures the funds from the transaction.
                return actions.order.capture().then(function(details) {
                    console.log(details);
                    // This function shows a transaction success message to your buyer.

                    alert('Transaction completed by ' + details.payer.name.given_name + ' Kindly click on confirm order button to continue');
                    $( "#so-checkout-confirm-button" ).css("display","block");
                    $('#status').val(details.status)
                    $('#transaction_id').val(details.id);
                    $('#process_button').prop("disabled",false);
                    $( "#paypaldev" ).html('<p>You Paid $10. Your Transaction id is:<b>'+details.id+'</b></p>');
                });
            }
        }).render('#paypal-button-container');
        //This function displays Smart Payment Buttons on your web page.


    </script>
@endsection
