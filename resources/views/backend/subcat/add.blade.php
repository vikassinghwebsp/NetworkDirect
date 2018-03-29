@extends('backend._layout.main')
@section('content')
<div id="header_wrapper" class="header-sm">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <header id="header">
                    <h1>Add Category</h1>
                    <ol class="breadcrumb">
                        <li><a href="{{ url('backend/') }}">Dashboard</a></li>
                        <li><a href="{{ url('backend/subcategory') }}">Sub Category</a></li>
                        <li class="active">Add Category</li>
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
            <form method="post">
                <div class="card">
                    <header class="card-heading p-b-0 ">
                        <h2 class="card-title">New category</h2>
                        <ul class="card-actions icons right-top">
                        </ul>
                    </header>
                    <div class="card-body">

                        <div class="form-group label-floating is-empty">
                            <label class="control-label">Sub Category Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group label-floating is-empty">
                            <label for="textArea" class="control-label">Sub Category Description</label>
                            <textarea class="form-control" name="description" rows="4" id="textArea"></textarea>
                        </div>
                        <div class="form-group label-floating is-empty">
                            <select class="select form-control" name="cat_id" id="select_cat">
                                <option value="" selected="">Select Category</option>
                                @if(!empty($arrContent['categories']))
                                @foreach($arrContent['categories'] as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group label-floating is-empty">
                            <label for="" class="control-label">Select Sub category</label>
                            <select  data-rule-required="true" class="form-control select" name="subcat_id" id="select_subcat" aria-required="true">

                            </select>
                        </div>
                        
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary btn-flat " type="reset">Reset</button>
                        <button class="btn btn-primary" type="submit">Add New Sub Category</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection('content')
<script>
    
</script>