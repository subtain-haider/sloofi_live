@extends('woocommerce::layouts.master')

@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="components-preview">

                <div class="nk-block ">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title">Woocommerce</h4>
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

                                    <th class="nk-tb-col"><span class="sub-text">#</span></th>
                                    <th class="nk-tb-col tb-col-mb"><span class="sub-text">URL</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Created At</span></th>
                                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Sync Products</span></th>
                                    <th class="nk-tb-col nk-tb-col-tools text-right">
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($woocommerces as $key => $woocomerce)
                                    <tr class="nk-tb-item">
                                        <td class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input" id="{{$woocomerce->id}}">
                                                <label class="custom-control-label" for="{{$woocomerce->id}}"></label>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col">
                                            <span>{{$key}}</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            <span>{{$woocomerce->url}}</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            <span>{{$woocomerce->created_at}}</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                                <span>
                                                    <a href="{{ route('woocommerce.products.sync', ['id'=>$woocomerce->id]) }}" class="btn btn-success btn-sm text-white">Sync New Products</a>
                                                </span>
                                        </td>

                                        <td class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1">
                                                <li class="nk-tb-action-hidden">
                                                    <form action="{{ route('woocommerce.delete',['id'=>$woocomerce->id]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this item?')" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Delete">
                                                            <em class="icon ni ni-trash-fill"></em>
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div><!-- .card-preview -->
                </div> <!-- nk-block -->


            </div><!-- .components-preview -->
        </div>
    </div>
@endsection
