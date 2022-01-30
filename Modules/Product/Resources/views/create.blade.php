@extends('product::layouts.master')

@section('content')
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-block nk-block-lg">
                <div class="nk-block-between mb-2">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Add Product</h3>
                    </div><!-- .nk-block-head-content -->
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                            <div class="toggle-expand-content" data-content="pageMenu">
                                {{--  Product / Add Product  --}}
                            </div>
                        </div>
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
                <div class="card">
                    <div class="card-inner">
                        <form method="POST" action="{{route('product.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Name*</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" placeholder="Name" autofocus required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Category*</label>
                                <div class="col-sm-10">
                                    <select class="form-select select2-hidden-accessible" name="category_id" data-search="on" data-select2-id="6" tabindex="-1" aria-hidden="true">
                                        <option value="default_option"  disabled>Select category</option>

                                        @foreach($categories as $category)
                                            @if(count($category->getSubCategory()) > 0)
                                                <optgroup label="{{$category->name}}">
                                                    @foreach($category->getSubCategory() as $cat)
                                                        <option value="{{$cat->id}}">
                                                            <b>{{$cat->name}}</b>
                                                        </option>
                                                    @endforeach
                                                </optgroup>
                                            @else
                                                <option value="{{$category->id}}">
                                                    <b>{{$category->name}}</b>
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tags (Seperated by Comma)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Tags (Seperated by Comma)" name="tags">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Thumbnail*<br><span style="color: red">600 X 600</span></label>
                                  <div class="form-control-wrap col-sm-10">
                                      <div class="custom-file">
                                          <input type="file" class="custom-file-input" id="thumbnail" name="thumbnail">
                                          <label class="custom-file-label" for="thumbnail">Choose file</label>
                                      </div>
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Select Multiple Images*</label>
                                  <div class="form-control-wrap col-sm-10">
                                      <div class="custom-file">
                                          <input type="file" class="custom-file-input" multiple id="images" name="images[]">
                                          <label class="custom-file-label" for="images">Choose files</label>
                                      </div>
                                  </div>
                              </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Product Description*</label>
                                <div class="col-sm-10">
                                    <textarea rows="5" cols="5" class="form-control" name="description" placeholder="Product Description" required></textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Select Properties</label>
                                <div class="col">
                                    <div class="form-control-wrap">
                                        <select class="form-select" multiple="multiple" name="properties[]" data-placeholder="Select Multiple options">
                                            @foreach($properties as  $property)
                                            <option value="{{$property->id}}">{{$property->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- Published: <input type="checkbox" class="js-single" name="published" value="1" checked /> -->
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col">
                                    1 Piece Price*:<input type="number" class="form-control" placeholder="1 Piece Price" name="price[1]" value="0" required>
                                </div>
                                <div class="col">
                                    100 Pieces Price*:<input type="number" class="form-control" placeholder="100 Piece Price" name="price[100]" value="0" required>
                                </div>
                                <div class="col">
                                    1000 Pieces Price*:<input type="number" class="form-control" placeholder="1000 Piece Price" name="price[1000]" value="0" required>
                                </div>
                                <div class="col">
                                    Purchase Price*:<input type="number" class="form-control" placeholder="Purchase Price" name="purchase_price" value="0" required>
                                </div>
                                <div class="col">
                                    Discount Percent*:<input type="number" class="form-control" placeholder="Discount" name="discount" value="0" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                {{--                                <div class="col">--}}
                                {{--                                    Minimum Quantity*:<input type="number" class="form-control" placeholder="Minimum Quantity" name="min_qty" required>--}}
                                {{--                                </div>--}}
                                <div class="col">
                                    Shipping Type*:
                                    <select name="shipping_type" class="form-select select2-hidden-accessible" required>
                                        <option value="free" selected>Free</option>
                                        <option value="paid">Paid</option>

                                    </select>
                                </div>
                                <div class="col">
                                    Shipping Days:<input type="number" class="form-control" placeholder="Shipping Days" name="shipping_days" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col">
                                    1 Piece Shipping:<input type="number" class="form-control" placeholder="1 Shipping Price" name="shipping_1" value="0" >
                                </div>
                                <div class="col">
                                    100 Pieces Shipping:<input type="number" class="form-control" placeholder="100 Shipping Price" name="shipping_100" value="0" >
                                </div>
                                <div class="col">
                                    1000 Pieces Shipping:<input type="number" class="form-control" placeholder="1000 Shipping Price" name="shipping_1000" value="0">
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
                                    <textarea rows="5" cols="5" class="form-control" name="meta_description" placeholder="Meta description" ></textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Manage Stock*</label>
                                <div class="col-sm-10">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        @php($first = true)
                                        @foreach($warehouses as $warehouse)
                                            <li class="nav-item">
                                                <a class="nav-link @if($first) active @endif" id="warehouse-tab_{{$warehouse->id}}" data-toggle="tab" href="#warehouse_{{$warehouse->id}}" role="tab" >{{$warehouse->name}}</a>
                                            </li>
                                            @php($first = false)
                                        @endforeach
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        @php($first = true)
                                        @foreach($warehouses as $warehouse)
                                            <div class="tab-pane fade @if($first) show active @endif" id="warehouse_{{$warehouse->id}}" role="tabpanel" >
                                                <br>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Available Quantity*:</label>
                                                    <div class="col-sm-3">
                                                        <input type="number" class="form-control" placeholder="Available Quantity" name="qty[{{$warehouse->id}}][]" value="0" required>
                                                    </div>
                                                </div>
                                            </div>
                                            @php($first = false)
                                        @endforeach

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
            url: "{{ route('product.form.storeMedia') }}",
            // maxFilesize: 2, // MB
            acceptedFiles: 'image/*',
            addRemoveLinks: true,
            timeout: 50000,
            dictRemoveFile: 'Delete',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(file, response) {
                console.log(response);
                $('form').append('<input type="hidden" name="images[]" value="'+response.image+'">')
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
                    url: "{{ route('product.form.storeMediaProduct') }}",
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
            url: "{{ route('product.form.storeMediaProduct') }}",
            // maxFilesize: 2, // MB
            addRemoveLinks: true,
            maxFiles:1,
            uploadMultiple:false,
            acceptedFiles: 'image/*',
            timeout: 50000,
            dictRemoveFile: 'Delete',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(file, response) {
                $('form').append('<input type="hidden" name="thumbnail" value="'+response.image+'">')
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
                    url: "{{ route('product.form.removeMediaProduct') }}",
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
