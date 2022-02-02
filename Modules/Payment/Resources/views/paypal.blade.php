<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Pay $1000</title>
    <script src="https://www.paypal.com/sdk/js?client-id={{ env('ARSF761nLnocqXAS7DbR-v0brxFfEo9r4y3-pIx6emNm69_Ao4OQuooZaAH3R5ELU87sIq-aark8K3E1') }}"></script>
</head>
<body>
<a class="btn btn-primary m-3" href="{{ route('paypal.processTransaction') }}">Pay $1000</a>
@if(\Session::has('error'))
    <div class="alert alert-danger">{{ \Session::get('error') }}</div>
    {{ \Session::forget('error') }}
@endif
@if(\Session::has('success'))
    <div class="alert alert-success">{{ \Session::get('success') }}</div>
    {{ \Session::forget('success') }}
@endif
</body>
</html>
