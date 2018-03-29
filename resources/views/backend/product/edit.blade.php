@extends('backend._layout.main')
@section('content')

<div id="header_wrapper" class="header-sm">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <header id="header">
                    <h1>Edit Product</h1>
                    <ol class="breadcrumb">
                        <li><a href="{{ url('backend/') }}">Dashboard</a></li>
                        <li><a href="{{ url('backend/product') }}">Product</a></li>
                        <li class="active">Edit Product</li>
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
            <form method="post" action="{{ url('backend/product/editsubmit') }}" enctype="multipart/form-data">
                <div class="card">
                    <header class="card-heading p-b-0 ">
                        <h2 class="card-title">Edit Product</h2>
                        <ul class="card-actions icons right-top">
                        </ul>
                    </header>
                    <div class="card-body">
                      
                        
                        <div class="form-group label-floating is-empty">
                            <label class="control-label">Product Name</label>
                            <input type="text" name="product_name" class="form-control" value="{{ $arrContent['product'][0]->product_name }}">
                            <input type="hidden" name="product_slug" class="form-control" value="{{ $arrContent['product'][0]->product_slug }}">
                            <input type="hidden" name="product_id" class="form-control" value="{{ $arrContent['product'][0]->id }}">
                        </div>
                               
                        <div class="form-group label-floating is-empty">
                            <label class="control-label">Stock</label>
                            <input type="text" name="stock" class="form-control" value="{{ $arrContent['product'][0]->stock }}">
                        </div>

                        <div class="form-group label-floating is-empty">
                            <label class="control-label">Product Price</label>
                            <input type="text" name="product_price" class="form-control" value="{{ $arrContent['product'][0]->product_price }}">
                        </div>
                        <div class="form-group label-floating is-empty">
                            <label class="control-label">Product Cost</label>
                            <input type="text" name="product_cost" class="form-control" value="{{ $arrContent['product'][0]->product_cost }}">
                        </div>
                        
                       
                        <div class="form-group label-floating is-empty">
                            <label class="control-label">Product Description</label>
                            <textarea class="form-control" name="product_description" rows="4" id="textArea">{{ $arrContent['product'][0]->product_description }}</textarea>

                        </div>
                        
                        <div class="form-group label-floating is-empty">
                            <label class="control-label">Category Name</label>
                            <input type="text" name="category_name" class="form-control" value="{{ $arrContent['product'][0]->category_name }}">
                        </div>
                        
                        <div class="form-group label-floating is-empty">
                            <label class="control-label">SubCategory Name</label>
                            <input type="text" name="subcategory_name" class="form-control" value="{{ $arrContent['product'][0]->subcategory_name }}">
                        </div>
                        
                        <div class="form-group is-empty">
                            <div class="input-group">
                                <label class="control-label">Product Image</label>
                                <input type="file" class="form-control" placeholder="File Upload..." name="product_file[]" value="{{ (!empty($arrContent['product'][0]->product_file)?$arrContent['product'][0]->product_file:'') }}" multiple="">
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
                        
                       
                       
                       
                        <div class="card-footer text-right">
                            <input type="hidden" name="id" value="{{ $arrContent['product'][0]->id }}">
                            <button class="btn btn-primary btn-flat " type="reset">Reset</button>
                            <button class="btn btn-primary" type="submit">Submit Product</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection('content')
@section('extraContent')
<script src="{{ url('public/backend/js/tinymce') }}/tinymce.min.js"></script>
<script>tinymce.init({selector: '#terms'});</script>
@endsection('extraContent')