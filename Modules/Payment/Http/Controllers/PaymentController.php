<?php

namespace Modules\Payment\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Frontend\Entities\Order;
use Session;
use Stripe;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('payment::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('payment::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('payment::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('payment::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
    public function stripe()
    {
        return view('payment::stripe');
    }
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey('sk_test_wcBdkjNQv3hpOHjTSaFI0TEt');
        $order=Order::find($request->order_id);
        Stripe\Charge::create ([
            "amount" => $order->total * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test payment from itsolutionstuff.com."
        ]);
        Session::flash('success', 'Payment successful!');

        $order->status='paid';
        $order->save();
        return redirect('/');
    }
    public function createTransaction()
    {
        return view('payment::paypal');
    }
    public function processTransaction(Request $request ,$order_id)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
$order=Order::find($order_id);
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal.successTransaction',['id'=>$order_id]),
                "cancel_url" => route('paypal.cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $order->total
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {

            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }

            return redirect()
                ->route('paypal.createTransaction')
                ->with('error', 'Something went wrong.');

        } else {
            return redirect()
                ->route('paypal.createTransaction')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    /**
     * success transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function successTransaction(Request $request,$id)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        $order=Order::find($id);
        $order->status='paid';
        $order->save();
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            return redirect()
                ->route('paypal.createTransaction')
                ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->route('paypal.createTransaction')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    /**
     * cancel transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelTransaction(Request $request)
    {
        return redirect()
            ->route('paypal.createTransaction')
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }
}
