@extends('backend._layout.main')
@section('content')
<div id="header_wrapper" class="header-sm">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <header id="header">
                    <h1>Add Submenu</h1>
                    <ol class="breadcrumb">
                        <li><a href="{{ url('backend/') }}">Dashboard</a></li>
                        <li><a href="{{ url('backend/subcategory') }}">Sub Menu</a></li>
                        <li class="active">Add Submenu</li>
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
                        <h2 class="card-title">New Submenu</h2>
                        <ul class="card-actions icons right-top">
                        </ul>
                    </header>
                    <div class="card-body">

                        <div class="form-group label-floating is-empty">
                            <label class="control-label">Sub Menu Name</label>
                            <input type="text" name="submenu_name" class="form-control">
                        </div>
                        <div class="form-group label-floating is-empty">
                            <label for="textArea" class="control-label">Sub Menu URL</label>
                            <textarea class="form-control" name="submenu_url" rows="4" id="textArea"></textarea>
                        </div>
                        <div class="form-group label-floating is-empty">
                            <select class="select form-control" name="menu_id">
                                <option value="" selected="">Select Menu</option>
                                @if(!empty($arrContent['menus']))
                                @foreach($arrContent['menus'] as $menus)
                                    <option value="{{ $menus->id }}">{{ $menus->menu_name }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary btn-flat " type="reset">Reset</button>
                        <button class="btn btn-primary" type="submit">Add New Sub Menu</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection('content')