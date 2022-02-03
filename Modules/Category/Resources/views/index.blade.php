@extends('rolepermission::layouts.master')

@section('content')
<div class="nk-content " style="width: 100%;">
    <div class="">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview">

                    <div class="nk-block">
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <h4 class="nk-block-title">All Categories</h4>
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

                                            <th class="nk-tb-col"><span class="sub-text">Icon</span></th>
                                            <th class="nk-tb-col"><span class="sub-text">Name</span></th>
                                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Parent Category</span></th>
                                            <th class="nk-tb-col tb-col-md"><span class="sub-text">Order level</span></th>
{{--                                            <th class="nk-tb-col tb-col-lg"><span class="sub-text">Banner</span></th>--}}
{{--                                            <th class="nk-tb-col tb-col-lg"><span class="sub-text">Icon</span></th>--}}
                                            <th class="nk-tb-col tb-col-md"><span class="sub-text">Meta title</span></th>
                                            <th class="nk-tb-col nk-tb-col-tools text-right">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($categories as $category)
                                        <tr class="nk-tb-item">
                                            <td class="nk-tb-col nk-tb-col-check">
                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                    <input type="checkbox" class="custom-control-input" id="{{$category->id}}">
                                                    <label class="custom-control-label" for="{{$category->id}}"></label>
                                                </div>
                                            </td>
                                            <td class="nk-tb-col">
                                                <div class="user-card">
                                                    <span><img src="{{$category->getFirstMediaUrl('icon')}}" height="100" width="100" alt=""></span>
                                                </div>
                                            </td>
                                            <td class="nk-tb-col">
                                                <span>{{$category->name}}</span>
                                            </td>
                                            <td class="nk-tb-col tb-col-md">
                                                <span>{{$category->parent_category}}</span>
                                            </td>
                                            <td class="nk-tb-col tb-col-md">
                                                <span>{{$category->order_level}}</span>
                                            </td>
{{--                                            <td class="nk-tb-col tb-col-md">--}}
{{--                                                <div class="user-card">--}}
{{--                                                    <span><img src="{{$category->getFirstMediaUrl('banner')}}" height="60" width="60" alt=""></span>--}}
{{--                                                </div>--}}
{{--                                            </td>--}}
{{--                                            <td class="nk-tb-col tb-col-md">--}}
{{--                                                <div class="user-card">--}}
{{--                                                    <span><img src="{{$category->getFirstMediaUrl('icon')}}" height="20" width="20" alt=""></span>--}}
{{--                                                </div>--}}
{{--                                            </td>--}}
                                            <td class="nk-tb-col tb-col-md">
                                                <span>{{$category->meta_title}}</span>
                                            </td>
                                            <td class="nk-tb-col nk-tb-col-tools">
                                                <ul class="nk-tb-actions gx-1">
                                                    <li class="nk-tb-action-hidden">
                                                        <a href="{{ route('category.edit',['id'=>$category->id]) }}" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Edit">
                                                            <em class="icon ni ni-edit-fill"></em>
                                                        </a>
                                                    </li>
                                                    <li class="nk-tb-action-hidden">
                                                        <form action="{{ route('category.delete',['id'=>$category->id]) }}" method="POST">
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
    </div>
</div>
@endsection
