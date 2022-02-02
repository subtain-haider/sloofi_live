@extends('woocommerce::layouts.master')

@section('content')
@section('content')
    <div class="nk-content">
        <div class="">
            <div class="nk-block">
                <div class="nk-block-between mb-2">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Woocommerce</h3>
                    </div><!-- .nk-block-head-content -->
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                            <div class="toggle-expand-content" data-content="pageMenu">
                                <form class="form-inline">
                                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Select Store</label>
                                    <select class="form-control" id="inlineFormCustomSelectPref" onchange="woocommerce_change(this.value)">
                                        <option selected value="all">All Stores</option>
                                        @foreach($allMyStores  as $woocommerce_single)
                                            <option @if(isset($selected) && $selected == $woocommerce_single->id) selected @endif value="{{$woocommerce_single->id}}">{{$woocommerce_single->url}}</option>
                                        @endforeach


                                    </select>

                                </form>

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

                <div class="card card-preview">

                    <div class="card-inner">
                        <table style="width: 100%;" class="datatable-init-export nk-tb-list nk-tb-ulist" data-export-title="Export" data-auto-responsive="false">
                            <thead>
                            <tr class="nk-tb-item nk-tb-head">
                                <th class="nk-tb-col nk-tb-col-check">
                                </th>

                                <th class="nk-tb-col"><span class="sub-text">#</span></th>
                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Image</span></th>
                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Title</span></th>
                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Description</span></th>
                                <th class="nk-tb-col tb-col-lg"><span class="sub-text">Product Type</span></th>
                                <th class="nk-tb-col tb-col-lg"><span class="sub-text">Status</span></th>
                                <th class="nk-tb-col tb-col-lg"><span class="sub-text">Tags</span></th>
                                <!-- <th class="nk-tb-col nk-tb-col-tools text-right">
                                </th> -->
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($products as $key => $product)
                                <tr class="nk-tb-item">
                                    <td class="nk-tb-col nk-tb-col-check">
                                        <div class="custom-control custom-control-sm custom-checkbox notext">
                                            <input type="checkbox" class="custom-control-input" id="{{$product->id}}">
                                            <label class="custom-control-label" for="{{$product->id}}"></label>
                                        </div>
                                    </td>
                                    <td class="nk-tb-col">
                                        <span>{{$key}}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <div class="user-card">
                                            <span><img width="50px" height="50px" src="{{ $product->image }}" alt=""></span>
                                        </div>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{$product->title}}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{$product->description}}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{$product->product_type}}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span class="tb-status text-{{ $product->status == 'publish' ? 'success' : 'danger' }} ">{{$product->status}}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{$product->tags}}</span>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>


                <!-- card -->
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{url('/')}}/admin/backend/assets/js/libs/datatable-btns.js?ver=2.9.0"></script>
    <script>
        function woocommerce_change(value){
            if (value == 'all'){
                var url = '{{url('/')}}'
                window.location.replace(url+"/admin/woocommerceProducts");
            }else{
                var url = '{{url('/')}}'
                window.location.replace(url+"/admin/woocommerceProducts/"+value);
            }
        }
    </script>
@endsection
