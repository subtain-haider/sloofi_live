@extends('rolepermission::layouts.master')

@section('content')

    <div class="components-preview">

        <div class="nk-block">
            <div class="nk-block-head">
                <div class="nk-block-head-content">
                    <h4 class="nk-block-title">All Permissions
                        @can('add_permission')
                        <a href="{{route('permission.create')}}" class="btn btn-primary float-right"><em class="icon ni ni-plus"></em><span>Add Permission</span></a>
                        @endcan
                    </h4>

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
                            <th class="nk-tb-col nk-tb-col-check"></th>
                            <th class="nk-tb-col"><span class="sub-text">Name</span></th>
                            <th class="nk-tb-col tb-col-lg"><span class="sub-text"></span></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rows as $row)
                            <tr class="nk-tb-item">
                                <td class="nk-tb-col nk-tb-col-check">
                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                        <input type="checkbox" class="custom-control-input" id="{{$row->id}}">
                                        <label class="custom-control-label" for="{{$row->id}}"></label>
                                    </div>
                                </td>
                                <td class="nk-tb-col">
                                    {{ str_replace('_',' ',$row->name,) }}
                                </td>
                                <td class="nk-tb-col">
                                    <ul class="nk-tb-actions gx-1">
                                        <li>
                                            <div class="drodown">
                                                <a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul class="link-list-opt no-bdr">
                                                        @can('edit_permission')
                                                            <li><a href="{{ route('permission.edit',["id"=>$row->id])  }}"><em class="icon ni ni-edit"></em><span>Edit Permission</span></a></li>
                                                        @endcan
                                                        @can('delete_permission')
                                                            <li><a  href="{{ route('permission.delete',["id"=>$row->id]) }}"><em class="icon ni ni-delete"></em><span>Delete Permission</span></a></li>
                                                        @endcan
                                                    </ul>
                                                </div>
                                            </div>
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

@endsection
