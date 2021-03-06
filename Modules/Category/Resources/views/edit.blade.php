@extends('category::layouts.master')

@section('content')
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-block nk-block-lg">
            <div class="nk-block-between mb-2">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Edit Category</h3>
                    </div><!-- .nk-block-head-content -->
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                            <div class="toggle-expand-content" data-content="pageMenu">
                                 {{-- Category / Edit Category --}}
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

              <form method="POST" action="{{ route('category.update',['id'=>$category->id]) }}" enctype="multipart/form-data">
                @csrf
                 @method('PUT')
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Name*</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" placeholder="Name" value="{{$category->name}}" required>
                    </div>
                </div>
{{--                <div class="form-group row">--}}
{{--                    <label class="col-sm-2 col-form-label">Parent Category</label>--}}
{{--                    <div class="col-sm-10">--}}
{{--                         <select class="form-select select2-hidden-accessible" name="parent_category"  data-search="on" data-select2-id="6" tabindex="-1" aria-hidden="true"><option value="default_option" data-select2-id="8">Default Option</option>--}}
{{--                             <option value=" " selected disabled>Select Parent Category, leave empty if none</option>--}}
{{--                            @foreach($categories as $cat)--}}
{{--                                <option value="{{$cat->id}}" @if($cat->id == $category->parent_category) selected @endif>{{$cat->name}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Order Number (1 for first 9 for last)</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="{{$category->order_level}}" placeholder="Order Number (1 for first 9 for last)" name="order_level">
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
{{--                <div class="form-group row">--}}
{{--                    <label class="col-sm-2 col-form-label">Category Icon*</label>--}}
{{--                    <div class="col-sm-10">--}}
{{--                          <div class="upload-zone needsclick dropzone" id="document-dropzone" data-max-files="1">--}}
{{--                            <div class="dz-message" data-dz-message>--}}
{{--                               <span class="dz-message-text">Drag and drop file</span>--}}
{{--                                <span class="dz-message-text">or</span>--}}
{{--                                <span class="dz-message-text">Click to shoose your file</span>--}}

{{--                            </div>--}}
{{--                        </div>--}}
{{--                        --}}{{-- <div class="needsclick dropzone" id="document-dropzone">--}}

{{--                         </div> --}}
{{--                        --}}{{-- <input type="file" class="form-control" name="icon" > --}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Meta Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="{{$category->meta_title}}" placeholder="Meta Title" name="meta_title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Meta description</label>
                    <div class="col-sm-10">
                        <textarea rows="5" cols="5" class="form-control" name="meta_description" placeholder="Meta description">{{$category->meta_description}}</textarea>
                    </div>
                </div>
                  @php
                      $price1=$category->prices->where('qty',1)->first()?$category->prices->where('qty',1)->first()->value:0;
                      $price500=$category->prices->where('qty',500)->first()?$category->prices->where('qty',500)->first()->value:0;
                      $price1000=$category->prices->where('qty',1000)->first()?$category->prices->where('qty',1000)->first()->value:0;
                      $increased_by=$category->prices->where('qty',1)->first();
                  @endphp
                  <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Price increment for third parties</label>
                      <div class="col-sm-4">
                          <label for="quantity">Increment By </label>
                          <select name="price_increment_type" class="form-control">
                              <option @if(isset($increased_by->type) && $increased_by->type=='amount') selected @endif value="amount">By Amount</option>
                              <option @if(isset($increased_by->type) && $increased_by->type=='percentage') selected @endif value="percentage">By Percentage</option>
                          </select>
                      </div>

                      <div class="form-group col-md-2 px-2">
                          <label for="quantity">For 1 Product</label>
                          <input type="number" step="any" value="{{ $price1 }}"
                                 class="form-control" id="price_1" name="price[1]">
                      </div>
                      <div class="form-group col-md-2 px-2">
                          <label for="quantity">For 500 </label>
                          <input type="number" step="any" value="{{ $price500 }}"
                                 class="form-control" id="price_500" name="price[500]">
                      </div>
                      <div class="form-group col-md-2 px-2">
                          <label for="quantity">For 1000 and above</label>
                          <input type="number" step="any" value="{{ $price1000 }}"
                                 class="form-control" id="price_1000" name="price[1000]">
                      </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Shipping Cost</label>
                      <div class="form-group col-md-10 d-flex">
                          <div class="form-group col-md-4 px-2">
                              <label for="quantity">For 1 Unit</label>
                              <input type="number" step="any" value="{{ $category->shipping_cost_1 }}"
                                     class="form-control" id="shipping_cost_1" name="shipping_cost_1">
                          </div>
                          <div class="form-group col-md-4 px-2">
                              <label for="quantity">For 500 Unit</label>
                              <input type="number" step="any" value="{{ $category->shipping_cost_500 }}"
                                     class="form-control" id="shipping_cost_500" name="shipping_cost_500">
                          </div>
                          <div class="form-group col-md-4 px-2">
                              <label for="quantity">For 1000 and above Unit</label>
                              <input type="number" value="{{ $category->shipping_cost_1000 }}" step="any"
                                     class="form-control" id="shipping_cost_1000" name="shipping_cost_1000">
                          </div>
                      </div>

                  </div>
                <button type="submit" class="btn btn-primary float-right">Submit</button>
            </form>
            </div>
         </div>

    <!-- card -->
        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
        var uploadedDocumentMap = {}
        Dropzone.options.documentDropzone = {
            paramName: "icon",
            url: "{{ route('form.storeMedia') }}",
            // maxFilesize: 2, // MB
            addRemoveLinks: true,
             acceptedFiles: 'image/*',
            timeout: 50000
            maxFiles:1,
            dictRemoveFile: 'Supprimer',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(file, response) {
                {{-- console.log(response.image); --}}
                $('form').append('<input type="hidden" name="icon" value="'+response.image+'">')
                uploadedDocumentMap[file.name] = response.image
            },
            removeFilePromise: function() {
                return new Promise((resolve, reject) => {
                    let rand = Math.floor(Math.random() * 3)
                    console.log(rand);
                    if (rand == 0) reject('didnt remove properly');
                    if (rand > 0) resolve();
                });
            },
            removedfile: function(file) {
                console.log("In remove options");
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedDocumentMap[file.name]
                }
                $.ajax({
                    type: 'POST',
                    url: "{{ route('form.removeMedia') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        name: name
                    },
                    success: function(data) {
                        console.log(data.msg);
                        file.previewElement.remove()
                        $('form').find('input[name="document[]"][value="' + name + '"]').remove()
                    },
                    error: function(jqxhr, status, exception) {
                        console.log(JSON.stringify(jqxhr));
                        console.log(exception);
                    }
                });
            },
            init: function() {
                this.on("complete", function(file) {
                    $(".dz-remove").html(
                        "<div><span class='fa fa-trash text-danger' style='font-size: 1.5em'></span></div>"
                    );
                });
                @if(isset($project) && $project -> document)
                var files = {
                    !!json_encode($project -> document) !!
                }
                for (var i in files) {
                    var file = files[i]
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="icon" value="' + file.file_name + '">')
                }
                @endif
            }
        }
         var uploadedDocumentMap = {}
        Dropzone.options.imageDropzone = {
            paramName: "image",
            url: "{{ route('form.storeMedia') }}",
            // maxFilesize: 2, // MB
            addRemoveLinks: true,
             maxFiles:1,
            uploadMultiple:false,
             acceptedFiles: 'image/*',
            timeout: 50000,
            dictRemoveFile: 'Supprimer',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(file, response) {
                $('form').append('<input type="hidden" name="image" value="'+response.image+'">')
                uploadedDocumentMap[file.name] = response.image
            },
            removeFilePromise: function() {
                return new Promise((resolve, reject) => {
                    let rand = Math.floor(Math.random() * 3)
                    console.log(rand);
                    if (rand == 0) reject('didnt remove properly');
                    if (rand > 0) resolve();
                });
            },
            removedfile: function(file) {
                console.log("In remove options");
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedDocumentMap[file.name]
                }
                $.ajax({
                    type: 'POST',
                    url: "{{ route('form.removeMedia') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        name: name
                    },
                    success: function(data) {
                        console.log(data.msg);
                        file.previewElement.remove()
                        $('form').find('input[name="document[]"][value="' + name + '"]').remove()
                    },
                    error: function(jqxhr, status, exception) {
                        console.log(JSON.stringify(jqxhr));
                        console.log(exception);
                    }
                });
            },
            init: function() {
                this.on("complete", function(file) {
                    $(".dz-remove").html(
                        "<div><span class='fa fa-trash text-danger' style='font-size: 1.5em'></span></div>"
                    );
                });
                @if(isset($project) && $project -> document)
                var files = {
                    !!json_encode($project -> document) !!
                }
                for (var i in files) {
                    var file = files[i]
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="icon" value="' + file.file_name + '">')
                }
                @endif
            }
        }
    </script>
@endsection
