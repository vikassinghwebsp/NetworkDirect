@extends('backend._layout.main')
@section('content')
<div id="header_wrapper" class="header-sm">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <header id="header">
                    <h1>Front Category</h1>
                    <ol class="breadcrumb">
                        <li><a href="{{ url('backend/') }}">Dashboard</a></li>
                        <li class="active">Front Category</li>
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
                        <h2 class="card-title">Front Category</h2>
                        <ul class="card-actions icons right-top">
                        </ul>
                    </header>
                    <div class="card-body">
                       
                        <div class="form-group label-floating is-empty">
                            <label class="control-label">Title</label>
                            <input type="text" name="title" class="form-control" id="title" required="">
                            
                        </div>
                        
                        <div class="form-group label-floating is-empty">
                            <select class="select form-control" name="frontCat" id="frontCat">
                                <option value="" selected="">Select Menu</option>
                                @if(!empty($arrContent['category']))
                                @foreach($arrContent['category'] as $menus)
                                <option value="{{ $menus->category_id }}">{{ $menus->category_name }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                      
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary btn-flat " type="reset">Reset</button>
                        <button class="btn btn-primary" type="button" id="submitCatbtn">Add New Front Category</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection('content')