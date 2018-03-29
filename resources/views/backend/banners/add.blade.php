@extends('backend._layout.main')
@section('content')
<?php 
 $type = App\library\Customlibrary::bannerType();
 
?>
<div id="header_wrapper" class="header-sm">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <header id="header">
                    <h1>Add Banner</h1>
                    <ol class="breadcrumb">
                        <li><a href="{{ url('backend/') }}">Dashboard</a></li>
                        <li><a href="{{ url('backend/banner') }}">Banner</a></li>
                        <li class="active">Add Banner</li>
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
            <form method="post" enctype="multipart/form-data">
                <div class="card">
                    <header class="card-heading p-b-0 ">
                        <h2 class="card-title">New Banner</h2>
                        <ul class="card-actions icons right-top">
                        </ul>
                    </header>
                    <div class="card-body">

<!--                        <div class="form-group label-floating is-empty">
                            <select class="select form-control" name="type">
                                <option value="" selected="">Select Banner Type</option>
                                @if(!empty($type))
                                @foreach($type as $key=>$val)
                                    <option value="{{ $key }}">{{ $val }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>-->
                        <div class="form-group label-floating is-empty">
                            
                            <select class="select form-control" name="banner">
                                <option value="" selected="">Select Banner </option>
                                @if(!empty($arrContent['banner']))
                                @foreach($arrContent['banner'] as $banner)
                                    <option value="{{ $banner->id }}">{{ $banner->banner_name }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group is-empty">
                            <div class="input-group">
                                <label class="control-label">Banner Image</label>
                                <input type="file" class="form-control" placeholder="File Upload..." name="banner_file">
                                <div class="input-group">
                                    <input type="text" readonly="" class="form-control" placeholder="Upload one file...">
                                    <span class="input-group-btn input-group-sm">
                                        <button type="button" class="btn btn-primary btn-fab btn-fab-sm">
                                            <i class="zmdi zmdi-attachment-alt"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group label-floating is-empty">
                            <label class="control-label">Banner Url</label>
                            <input type="text" name="banner_url" class="form-control">
                        </div>

                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary btn-flat " type="reset">Reset</button>
                        <button class="btn btn-primary" type="submit">Add New Banner</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection('content')