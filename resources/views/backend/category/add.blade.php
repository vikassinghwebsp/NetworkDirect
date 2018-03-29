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
                        <li><a href="{{ url('backend/category') }}">Category</a></li>
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
                            <select class="select form-control" name="menu_id">
                                <option selected="">Select Menu</option>

                                <option value="1">CISCO SWITCHES</option>
                                <option value="2">CISCO ROUTERS</option>
                                <option value="3">CISCO SECURITY</option>
                                <option value="4">CISCO WIRELESS</option>
                                <option value="5">CISCO ACCESSORIES</option>
                                <option value="6">CISCO IP PHONES</option>
                                <option value="7">CISCO MERAKI</option>
                                
                                

                            </select>
                        </div>

                        <div class="form-group label-floating is-empty">
                            <label class="control-label">Category Name</label>
                            <input type="text" name="category_name" class="form-control">
                        </div>
<!--                        <div class="form-group label-floating is-empty">
                            <label for="textArea" class="control-label">Category Description</label>
                            <textarea class="form-control" name="description" rows="4" id="textArea"></textarea>
                        </div>-->

                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary btn-flat ">Cancel</button>
                        <button class="btn btn-primary" type="submit">Add New Category</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection('content')