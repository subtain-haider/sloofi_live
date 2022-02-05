@extends('category::layouts.master')

@section('content')
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-block nk-block-lg">
            <div class="nk-block-between mb-2">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Add Category</h3>
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

              <form method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data" name="demoform" id="demoform">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Name*</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" placeholder="Name" autofocus required>
                    </div>
                </div>
{{--                <div class="form-group row">--}}
{{--                    <label class="col-sm-2 col-form-label">Parent Category</label>--}}
{{--                    <div class="col-sm-10">--}}
{{--                        <select class="form-select select2-hidden-accessible" name="parent_category" data-search="on" data-select2-id="6" tabindex="-1" aria-hidden="true">--}}
{{--                            <option value=" " selected disabled>Select Parent Category, leave empty if none</option>--}}
{{--                            @foreach($categories as $category)--}}
{{--                                <option value="{{$category->id}}">{{$category->name}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}

{{--                    </div>--}}
{{--                </div>--}}
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Order Number (1 for first 9 for last)</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Order Number (1 for first 9 for last)" name="order_level">
                    </div>
                </div>
                  <div class="form-group row">
                      <label class="col-sm-2 col-form-label form-label">Category Icon <br><span style="color: red">1980 X 180</span></label>
                      <div class="form-control-wrap">
                          <div class="custom-file">
                              <input type="file" class="custom-file-input" id="icon" name="icon">
                              <label class="custom-file-label" for="icon">Choose file</label>
                          </div>
                      </div>
                  </div>
{{--                  <div class="form-group row">--}}
{{--                      <label class="col-sm-2 col-form-label form-label">Category Banner <br><span style="color: red">1980 X 180</span></label>--}}
{{--                      <div class="form-control-wrap">--}}
{{--                          <div class="custom-file">--}}
{{--                              <input type="file" class="custom-file-input" id="banner" name="banner">--}}
{{--                              <label class="custom-file-label" for="banner">Choose file</label>--}}
{{--                          </div>--}}
{{--                      </div>--}}
{{--                  </div>--}}

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Meta Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Meta Title" name="meta_title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Meta description</label>
                    <div class="col-sm-10">
                        <textarea rows="5" cols="5" class="form-control" name="meta_description" placeholder="Meta description"></textarea>
                    </div>
                </div>
                  <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Price increment for third parties</label>
                      <div class="col-sm-4">
                          <label for="quantity">Increment By </label>
                          <select name="price_increment_type" class="form-control">
                              <option value="amount">By Amount</option>
                              <option value="percentage">By Percentage</option>
                          </select>
                      </div>
                      <div class="form-group col-md-2 px-2">
                          <label for="quantity">For 1 Product</label>
                          <input type="number" step="any" class="form-control" id="price_1"  name="price[1]" >
                      </div>
                      <div class="form-group col-md-2 px-2">
                          <label for="quantity">For 500 </label>
                          <input type="number" step="any" class="form-control" id="price_500" name="price[500]" >
                      </div>
                      <div class="form-group col-md-2 px-2">
                          <label for="quantity">For 1000 and above</label>
                          <input type="number" step="any" class="form-control" id="price_1000" name="price[1000]" >
                      </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Shipping Cost</label>
                      <div class="form-group col-md-10 d-flex">
                          <div class="form-group col-md-4 px-2">
                              <label for="quantity">For 1 Unit</label>
                              <input type="number" step="any" class="form-control" id="shipping_cost_1"  name="shipping_cost_1" >
                          </div>
                          <div class="form-group col-md-4 px-2">
                              <label for="quantity">For 500 Unit</label>
                              <input type="number" step="any" class="form-control" id="shipping_cost_500" name="shipping_cost_500" >
                          </div>
                          <div class="form-group col-md-4 px-2">
                              <label for="quantity">For 1000 and above Unit</label>
                              <input type="number" step="any" class="form-control" id="shipping_cost_1000" name="shipping_cost_1000" >
                          </div>
                      </div>

                  </div>
                <button type="submit" class="btn btn-primary float-right">Submit</button>

            </form>
        </div>
    </div><!-- card -->

    </div>
</div>
@endsection
