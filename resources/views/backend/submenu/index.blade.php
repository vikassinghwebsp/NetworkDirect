@extends('backend._layout.main')
@section('content')
<div id="header_wrapper" class="header-sm">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <header id="header">
                    <h1>Sub Menu</h1>
                    <ol class="breadcrumb">
                        <li><a href="{{ url('backend/') }}">Dashboard</a></li>
                        <li class="active">Sub Menu</li>
                    </ol>
                </header>
            </div>
        </div>
    </div>
</div>

<div id="content" class="container-fluid">
    <div class="content-body">
        <div class="col-xs-12 col-sm-12 col-md-12">
            @if(Session::has('error'))
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>Error!</strong> {{ Session::get('error') }}
            </div>
            @endif
            @if(Session::has('success'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>Well Done !! </strong> {{ Session::get('success') }}
            </div>
            @endif
            <div class="card">
                <header class="card-heading ">
                    <h2 class="card-title">Sub Menus</h2>
                    <p>All Sub Menus List will show here</p>
                    <div class="card-search">
                        <div id="productsTable_wrapper" class="form-group label-floating is-empty">
                            <i class="zmdi zmdi-search search-icon-left"></i>
                            <input type="text" class="form-control filter-input" placeholder="Filter Products..." autocomplete="off">
                            <a href="javascript:void(0)" class="close-search" data-card-search="close" data-toggle="tooltip" data-placement="top" title="Close"><i class="zmdi zmdi-close"></i></a>
                        </div>
                    </div>
                    <ul class="card-actions icons right-top">
                        <li id="deleteItems" style="display: none;">
                            <span class="label label-info pull-left m-t-5 m-r-10 text-white"></span>
                            <a href="javascript:void(0)" id="confirmDelete" data-toggle="tooltip" data-placement="top" data-original-title="Delete Product(s)">
                                <i class="zmdi zmdi-delete"></i>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" data-card-search="open" data-toggle="tooltip" data-placement="top" data-original-title="Filter Products">
                                <i class="zmdi zmdi-filter-list"></i>
                            </a>
                        </li>
                        <li class="dropdown" data-toggle="tooltip" data-placement="top" data-original-title="Show Entries">
                            <a href="javascript:void(0)" data-toggle="dropdown">
                                <i class="zmdi zmdi-more-vert"></i>
                            </a>
                            <div id="dataTablesLength">
                            </div>
                        </li>
                       
                        <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Add New Subcategory">
                            <a href="http://localhost/coupon/backend/subcategory/add"><i class="zmdi zmdi-assignment zmdi-hc-fw"></i></a>
                        </li>
                  
                    </ul>
                </header>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="productsTable"  class="table table-hover">
                            <thead>
                                <tr>
                                    <th data-orderable="false">#</th>
                                    <th data-orderable="false">Sub Menu Name</th>
                                    <th data-orderable="false">Sub Menu URL</th>
                                    <th data-orderable="false">Parent Menu</th>
                                    <th data-orderable="false">Active</th>
                                    <th data-orderable="false">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($arrContent['submenus']))
                                 <?php
                                        if(!empty($_GET['page']) && $_GET['page'] > 1){
                                             $i=15;
                                             $i = $i*($_GET['page']-1)+1;
                                         }else{
                                            $i=1; 
                                         }
                                    ?>
                                @foreach($arrContent['submenus'] as $submenu)

                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ (!empty($submenu->submenu_name))?$submenu->submenu_name:'' }}</td>
                                    <td>{{ (!empty($submenu->submenu_url))?substr($submenu->submenu_url,0,50):'' }}</td>
                                    <td>{{ (!empty($submenu->menu_name))?substr($submenu->menu_name,0,50):'' }}</td>
                                    <td>
                                        <div class="togglebutton">
                                            <label>
                                              <input data-attr="{{ $submenu->status }}" data-id="{{ $submenu->id }}" type="checkbox" class="toggle-info subcategoryactive" <?php if($submenu->status == 1){?>checked<?php }?>>
                                            </label>
                                      </div>
                                    </td>
                                    <td>
                                        <nav class="btn-fab-group">
                                            <button title="Actions" class="btn btn-primary btn-fab fab-menu" data-fab="left">
                                                <i  class="zmdi zmdi-plus"></i>
                                            </button>

                                            <ul class="nav-sub">

                                                <li> <a href="{{ url('/backend/subcategory/edit/'.$submenu->id) }}" data-toggle="tooltip" data-placement="top" title="Edit SubCategory" class="btn btn-blue btn-fab btn-fab-sm cat_et"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></a></li>
                                                <li> <a data-href="{{ url('/backend/subcategory/rm/'.$submenu->id) }}" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Remove SubCategory" class="btn btn-danger btn-fab btn-fab-sm subcat_rm"><i class="zmdi zmdi-delete"></i></a></li>


                                            </ul>
                                        </nav>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr><td colspan="8" style="text-align: center"><h2>No Record Found</h2></td></tr>
                                @endif

                            </tbody>
                        </table>
                        <div>
                        {{ $arrContent['submenus']->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Confirmation Modeal -->
<button style="display: none" class="btn btn-primary btn-block subcat_remove_modal" data-toggle="modal" data-target="#toolabr_modal">Trigger</button>
<div class="modal fade" id="toolabr_modal" tabindex="-1" role="dialog" aria-labelledby="toolabr_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="card m-0">
                <header class="card-heading p-b-20">
                    <h2 class="card-title">Confirmation</h2>

                    <ul class="card-actions icons right-top">

                        <li>
                            <a href="javascript:void(0)" data-dismiss="modal" aria-label="Close">
                                <i class="zmdi zmdi-close"></i>
                            </a>
                        </li>
                    </ul>
                </header>
            </div>
            <div class="modal-body">
                <p>Are your sure ! want remove this sub category?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Cancel</button>
                <a href="" class="btn btn-primary subcat_remove_href">Yes ! i am sure</a>
            </div>
        </div>
        <!-- modal-content -->
    </div>
    <!-- modal-dialog -->
</div>
@endsection('content')