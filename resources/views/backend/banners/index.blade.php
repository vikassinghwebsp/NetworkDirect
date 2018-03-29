@extends('backend._layout.main')
@section('content')
<div id="header_wrapper" class="header-sm">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <header id="header">
                    <h1>Banners</h1>
                    <ol class="breadcrumb">
                        <li><a href="{{ url('backend/') }}">Dashboard</a></li>
                        <li class="active">Banners</li>
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
                    <h2 class="card-title">Banners</h2>
                    <p>All Banners List will show here</p>
                    <ul class="card-actions icons right-top">
                        <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Add New Banner">
                            <a href="{{ url('backend/banner/add') }}"><i class="zmdi zmdi-assignment zmdi-hc-fw"></i></a>
                        </li>
                    </ul>
                </header>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    
                                    <th>Banner Name</th>
                                    <th>Banner URL</th>
                                     <th>Banner Image</th>
<!--                                    <th>Active</th>-->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($arrContent['banner']))
                                <?php
                                    if(!empty($_GET['page']) && $_GET['page'] > 1){
                                         $i=15;
                                         $i = $i*($_GET['page']-1)+1;
                                     }else{
                                        $i=1; 
                                     }
                                    ?>
                                @foreach($arrContent['banner'] as $banner)

                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ (!empty($banner->banner_name))? $banner->banner_name:'' }}</td>
                                    <td>{{ (!empty($banner->banner_url))?$banner->banner_url:'' }}</td>
                                    <td><img style="width: 80px" src="{{ \App\library\Customlibrary::getBannerImage($banner->banner_image_name) }}"></td>
<!--                                    <td>
                                        <div class="togglebutton">
                                        <label>
                                          <input data-attr="{{ $banner->status }}" data-id="{{ $banner->id }}" type="checkbox" class="toggle-info banneractive" <?php if($banner->status == 1){?>checked<?php }?>>
                                        </label>
                                      </div>
                                    </td>-->
                                    <td>
                                        <nav class="btn-fab-group">
                                            <button title="Actions" class="btn btn-primary btn-fab fab-menu" data-fab="left">
                                                <i  class="zmdi zmdi-plus"></i>
                                            </button>

                                            <ul class="nav-sub">

                                                <li> <a data-href="{{ url('/backend/banner/rm/'.$banner->id) }}" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Remove Banner" class="btn btn-danger btn-fab btn-fab-sm banner_rm"><i class="zmdi zmdi-delete"></i></a></li>


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
                        {{ $arrContent['banner']->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Confirmation Modeal -->
<button style="display: none" class="btn btn-primary btn-block banner_remove_modal" data-toggle="modal" data-target="#toolabr_modal">Trigger</button>
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
                <p>Are your sure ! want remove this banner?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Cancel</button>
                <a href="" class="btn btn-primary banner_remove_href">Yes ! i am sure</a>
            </div>
        </div>
        <!-- modal-content -->
    </div>
    <!-- modal-dialog -->
</div>
@endsection('content')