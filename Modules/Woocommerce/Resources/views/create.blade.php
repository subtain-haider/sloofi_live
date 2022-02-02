@extends('woocommerce::layouts.master')

@section('content')
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-block nk-block-lg">
                <div class="nk-block-between mb-2">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Add Woocommerce Store</h3>
                    </div><!-- .nk-block-head-content -->
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                            <div class="toggle-expand-content" data-content="pageMenu">
                                Woocommerce Store / Add Woocommerce Store
                            </div>
                        </div>
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
                <div class="col-lg-12">
                    @if(session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                </div>
                <div class="card">
                    <div class="card-inner">
                        <form method="POST" action="{{route('woocommerce.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Store URL:*</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="url" placeholder="https://example.com" autofocus required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Consumer Key*</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="consumer_key" placeholder="ck_xxxxxxxxxxxxxxxx" autofocus required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Consumer Secret*</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="consumer_secret" placeholder="cs_xxxxxxxxxxxxxxxx" autofocus required>
                                </div>
                            </div>
                            <p class="text-danger">Note: Please enter the default URL of wordpress site. .</p>
                            <p>Installation Steps :</p>
                            <ol>
                                <li>Log into your Wordpress Admin</li>
                                <li>Go to WooCommerce > Settings</li>
                                <li>Click on "Advanced"</li>
                                <li>Click on "Rest API"</li>
                                <li>Click on "Add Key" or "Create an API KEY"</li>
                                <li>In Description add "Sloofi"</li>
                                <li>In permissions select "READ/WRITE"</li>
                                <li>Click on "Generate API key"</li>
                                <li>Copy and paste the "Consumer Key" and "Consumer Secret"</li>
                            </ol>


                            <button type="submit" class="btn btn-primary float-right">Submit</button>

                        </form>
                    </div>
                </div>

                <!-- card -->
            </div>
        </div>
    </div>
@endsection
