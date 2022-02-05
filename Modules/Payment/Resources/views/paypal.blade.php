@extends('frontend::layouts.master')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://www.paypal.com/sdk/js?client-id=ARSF761nLnocqXAS7DbR-v0brxFfEo9r4y3-pIx6emNm69_Ao4OQuooZaAH3R5ELU87sIq-aark8K3E1'"></script>

@endsection
@section('content')
    <div style="margin: 50px;text-align: center">

        <a class="btn btn-primary m-3" href="{{ route('paypal.processTransaction',['order_id'=>$order->id]) }}" style="background: #d93644">Pay Now ${{$order->id}}</a>
    </div>
@if(\Session::has('error'))
    <div class="alert alert-danger">{{ \Session::get('error') }}</div>
    {{ \Session::forget('error') }}
@endif
@if(\Session::has('success'))
    <div class="alert alert-success">{{ \Session::get('success') }}</div>
    {{ \Session::forget('success') }}
@endif
@endsection
