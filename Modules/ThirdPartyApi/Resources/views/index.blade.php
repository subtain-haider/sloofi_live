@extends('thirdpartyapi::layouts.master')

@section('content')
    <div class="nk-content " style="width: 100%;">
        <div class="">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="components-preview">

                        <div class="nk-block">
                            <div class="nk-block-head">
                                <div class="nk-block-head-content">
                                    <h4 class="nk-block-title">All Categories from {{$name}}</h4>
                                    <div class="nk-block-des">
                                        <!-- <p>Using the most basic table markup, here’s how <code class="code-class">.table</code> based tables look by default.</p> -->
                                    </div>
                                </div>
                            </div>

                            <div class="card card-preview">

                                <div class="card-inner">
                                    <table style="width: 100%;" class="datatable-init-export nk-tb-list nk-tb-ulist" data-export-title="Export" data-auto-responsive="false">
                                        <thead>
                                        <tr class="nk-tb-item nk-tb-head">
                                            <th class="nk-tb-col nk-tb-col-check">
                                            </th>

                                            <th class="nk-tb-col"><span class="sub-text">ID</span></th>
                                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Name</span></th>
                                            <th class="nk-tb-col tb-col-md"><span class="sub-text">Attach</span></th>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($tp_categories))
                                        @foreach($tp_categories as $otapi)
                                            <tr class="nk-tb-item">
                                                <td class="nk-tb-col nk-tb-col-check">
                                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                                        <input type="checkbox" class="custom-control-input" id="{{$otapi['Id']}}">
                                                        <label class="custom-control-label" for="{{$otapi['Id']}}"></label>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col">
                                                    <span>{{$otapi['Id']}}</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                    <span>{{$otapi['Name']}}</span>
                                                </td>

                                                <td class="nk-tb-col tb-col-md"> <span>


                                                <select class="form-select select2-hidden-accessible" name="category" required onchange="attach_cat('{{$otapi['Id']}}','{{$otapi['Name']}}',this.value, '{{$name}}')" data-search="on" >
                                                    <option value="" selected disabled>Select Category</option>
                                                    @php
                                                        $api_category = \Modules\ThirdPartyApi\Entities\ApiCategory::where('external_id', $otapi['Id'])->first();
                                                    @endphp
                                                    @foreach($internal_categories as $category)
                                                        @if(count($category->getSubCategory()) > 0)
                                                            <optgroup label="{{$category->name}}">
                                                                @foreach($category->getSub() as $cat)
                                                                    <option value="{{$cat->id}}"
                                                                            @if(!empty($api_category))
                                                                            @if($cat->id == $api_category->category_id)
                                                                            selected
                                                                    @endif
                                                                    @endif

                                                                    <b>{{$cat->name}}</b>
                                                                    </option>
                                                                @endforeach
                                                            </optgroup>
                                                        @else
                                                            <option value="{{$category->id}}"
                                                                    @if(!empty($api_category))
                                                                    @if($category->id == $api_category->category_id)
                                                                    selected
                                                                        @endif
                                                                    @endif
                                                            >
                                                                <b>{{$category->name}}</b>
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </span></td>
                                            </tr>
                                        @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- .card-preview -->
                        </div> <!-- nk-block -->

                    </div><!-- .components-preview -->
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        function attach_cat(otpid, name, catid, type ){

            axios.post('{{route('thirdpartyapi.attach.tp')}}', {
                otp_id: otpid,
                catid: catid,
                type: type,
                name: name
            })
                .then(function (response) {
                })
                .catch(function (error) {
                });
        }
    </script>
@endsection
