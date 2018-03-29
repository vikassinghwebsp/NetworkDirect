@extends('backend._layout.main')
@section('content')
<div id="header_wrapper" class="header-sm">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <header id="header">
                    <h1>Edit Sub Category</h1>
                    <ol class="breadcrumb">
                        <li><a href="{{ url('backend/') }}">Dashboard</a></li>
                        <li><a href="{{ url('backend/subcategory') }}">Sub Category</a></li>
                        <li class="active">Edit Sub Category</li>
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
            <form method="post" action="{{ url('backend/subcategory/edit_submit') }}">
                <div class="card">
                    <header class="card-heading p-b-0 ">
                        <h2 class="card-title">Edit Sub category</h2>
                        <ul class="card-actions icons right-top">
                        </ul>
                    </header>
                    <div class="card-body">

                        <div class="form-group label-floating">
                            <label class="control-label">Sub Category Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $arrContent['subcategory'][0]->subcategory_name }}">
                        </div>
                        <div class="form-group label-floating">
                            <label for="textArea" class="control-label">Sub Category Link</label>
                            <textarea class="form-control" name="description" rows="4" id="textArea">{{ $arrContent['subcategory'][0]->subcategory_link}}</textarea>
                        </div>
                        
                    </div>
                    <div class="card-footer text-right">
                        <input type="hidden" name="hidsubcategory_id" value="{{ $arrContent['subcategory'][0]->subcategory_slug }}">
                        <button class="btn btn-primary btn-flat " type="reset">Reset</button>
                        <button class="btn btn-primary" type="submit">Submit Sub Category</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection('content')