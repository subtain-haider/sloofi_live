
    <script
        src="https://www.paypal.com/sdk/js?client-id=AZwVefyA0CbM0FGkmhyumhE9gDfnxAa3lV0PbEGodd2kq9zhs0wj7Vh_OfDjRIh3xkcqWrtap1zmKEIk">
</script>
<script>
var total="{{$total}}";
    paypal.Buttons({
        createOrder: function(data, actions) {
            // This function sets up the details of the transaction, including the amount and line item details.
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: total
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
                $('#total_paid').val(total);
                $('#process_button').prop("disabled",false);
                $( "#paypaldev" ).html('<p>You Paid $'+total+' Your Transaction id is:<b>'+details.id+'</b></p>');
            });
        }
    }).render('#paypal-button-container');
    //This function displays Smart Payment Buttons on your web page.


</script>
