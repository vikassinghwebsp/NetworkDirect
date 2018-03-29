@extends('backend._layout.main')
@section('content')
<div id="header_wrapper" class="header-sm">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <header id="header">
                    <h1>Edit Category</h1>
                    <ol class="breadcrumb">
                        <li><a href="{{ url('backend/') }}">Dashboard</a></li>
                        <li><a href="{{ url('backend/category') }}">Category</a></li>
                        <li class="active">Edit Category</li>
                    </ol>
                </header>
            </div>
        </div>
    </div>
</div>
<?php //var_dump($arrContent['category'][0]);exit;?>
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
            <form method="post" action="{{ url('backend/category/edit_submit')}}">
                <div class="card">
                    <header class="card-heading p-b-0 ">
                        <h2 class="card-title">Edit category</h2>
                        <ul class="card-actions icons right-top">
                        </ul>
                    </header>
                    <div class="card-body">

                        <div class="form-group label-floating">
                            <label class="control-label">Category Name</label>
                            <input type="text" name="category_name" class="form-control" value="{{ $arrContent['category'][0]->category_name }}">
                        </div>
                        
                         <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </div>
                    <div class="card-footer text-right">
                        <a class="btn btn-primary btn-flat" href="{{ url('backend/category')}}">Back</a>
                        <input type="hidden" name="hidcategory_id" value="{{$arrContent['category'][0]->category_id }}">
                        <button class="btn btn-primary" type="submit">Update Category</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection('content')