@extends('rolepermission::layouts.master')

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
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Parent Category</label>
                    <div class="col-sm-10">
                        <select class="form-select select2-hidden-accessible" name="parent_category" data-search="on" data-select2-id="6" tabindex="-1" aria-hidden="true">
                            <option value=" " disabled selected >Select category</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Order Number (1 for first 9 for last)</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Order Number (1 for first 9 for last)" name="order_level">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label form-label">Category Banner* <br><span style="color: red">1980 X 180</span></label>
                    <div class="col-sm-10">
                        <div class="upload-zone needsclick dropzone" id="image-dropzone" data-max-files="1">
                            <div class="dz-message" data-dz-message>
                                <span class="dz-message-text">Drag and drop file</span>
                                <span class="dz-message-text">or</span>
                                <span class="dz-message-text">Click to choose your file</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Category Icon*</label>
                    <div class="col-sm-10">
                         <div class="upload-zone needsclick dropzone" id="document-dropzone"  data-max-files="1">
                            <div class="dz-message" data-dz-message>
                                <span class="dz-message-text">Drag and drop file</span>
                                <span class="dz-message-text">or</span>
                                <span class="dz-message-text">Click to choose your file</span>
                            </div>
                        </div>
                    </div>
                </div>
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
                          <input type="number" step="any" class="form-control" id="price_1"  name="price_1" >
                      </div>
                      <div class="form-group col-md-2 px-2">
                          <label for="quantity">For 500 </label>
                          <input type="number" step="any" class="form-control" id="price_500" name="price_500" >
                      </div>
                      <div class="form-group col-md-2 px-2">
                          <label for="quantity">For 1000 and above</label>
                          <input type="number" step="any" class="form-control" id="price_1000" name="price_1000" >
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
@section('js')
<script>
        var uploadedDocumentMap = {}
        Dropzone.options.documentDropzone = {
            paramName: "icon",
            url: "{{ route('form.storeMedia') }}",
            // maxFilesize: 2, // MB
            addRemoveLinks: true,
            timeout: 50000,
             acceptedFiles: 'image/*',
            dictRemoveFile: 'Delete',
             maxFiles:1,
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
             acceptedFiles: 'image/*',
            dictRemoveFile: 'Delete',
             maxFiles:1,
            timeout: 50000,
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