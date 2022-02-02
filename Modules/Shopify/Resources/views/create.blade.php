@extends('shopify::layouts.master')

@section('content')
    <!-- content @s -->
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-block nk-block-lg">
                <div class="nk-block-between mb-2">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Add Shopify Store</h3>
                    </div><!-- .nk-block-head-content -->
                    <div class="nk-block-head-content">
                        <!-- <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                            <div class="toggle-expand-content" data-content="pageMenu">
                                 Shopify Store / Add Shopify Store
                            </div>
                        </div> -->
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
                        <form method="POST" action="{{route('shopify.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Store Address:*</label>
                                <div class="col-sm-10">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="shop" placeholder="Store Name" aria-label="Recipient's username" required aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">.myshopify.com</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="text-danger">Note: Please enter the default URL provided by Shopify. You can find it in your Shopify admin.</p>
                            <p>Installation Steps :</p>
                            <ol>
                                <li>Log into your Shopify Admin</li>
                                <li>Copy the URL which says your store name: store-name.myshopify.com</li>
                                <li>Fill in the blank field above with the store ID, please do not include .myshopify.com</li>
                                <li>Click the "install app" button on the Shopify authorization page</li>
                            </ol>


                            <button type="submit" class="btn btn-primary float-right">Submit</button>

                        </form>
                    </div>
                </div>

                <!-- card -->
            </div>
        </div>
    </div>
    <!-- content @e -->

@endsection

