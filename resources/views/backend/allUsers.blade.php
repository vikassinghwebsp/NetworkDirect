@extends('backend._layout.main')
@section('content')
<?php //echo $_GET['page'];?>
<div id="header_wrapper" class="header-sm">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <header id="header">
                    <h1>Users</h1>
                    <ol class="breadcrumb">
                        <li><a href="{{ url('backend/') }}">Dashboard</a></li>
                        <li class="active">Users</li>
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
                    <h2 class="card-title">Users</h2>
                    <p>All Users List will show here</p>
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

                        <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Add New Product">
                            <a href="{{ url('backend/product/add') }}"><i class="zmdi zmdi-assignment zmdi-hc-fw"></i></a>
                        </li>

                    </ul>
                </header>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="productsTable"  class="table table-hover">
                            <thead>
                                <tr>
                                    <th data-orderable="false">#</th>
                                    <th data-orderable="false">Name</th>
                                    <th data-orderable="false">Email</th>
                                    <th data-orderable="false">Mobile No.</th>
                                    <th data-orderable="false">Address</th>
                                    <th data-orderable="false">City</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($arrContent['users']))
                                <?php
                                if (!empty($_GET['page']) && $_GET['page'] > 1) {
                                    $i = 15;
                                    $i = $i * ($_GET['page'] - 1) + 1;
                                } else {
                                    $i = 1;
                                }
                                //var_dump($arrContent['products']);exit;
                                ?>
                                @foreach($arrContent['users'] as $couponData)
                                <?php
                                // $categoryData = app('App\Http\Controllers\Backend\CategoryController')->getAllCategory($couponData->category_id);
                                //$storeData = app('App\Http\Controllers\Backend\CategoryController')->getAllStore($couponData->store_id);
                                //var_dump($storeData[0]->store_name);exit;
                                if (!empty($_GET['page'])) {
                                    echo $i;
                                }
                                //var_dump($couponData->product_image);exit;
                                ?>

                                <tr>
                                    <th scope="row">{{ $i++ }}</th>

                                    <td>{{ (!empty($couponData->full_name))?$couponData->full_name:'' }}</td>
                                    <td>{{ (!empty($couponData->email))?$couponData->email:'' }}</td>
                                    <td>{{ (!empty($couponData->mobile_no))?substr($couponData->mobile_no,0,50):'' }}</td>
                                    <td>{{ (!empty($couponData->address1))?$couponData->address1:'' }}</td>
                                    <td>{{ (!empty($couponData->city))?$couponData->city:'' }}</td>

                                </tr>

                                @endforeach
                                @else
                                <tr><td colspan="8" style="text-align: center"><h2>No Record Found</h2></td></tr>
                                @endif

                            </tbody>
                        </table>
                        <div>
                            {{ $arrContent['users']->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Confirmation Modeal -->
<button style="display: none" class="btn btn-primary btn-block coupon_remove_modal" data-toggle="modal" data-target="#toolabr_modal">Trigger</button>
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
                <a href="" class="btn btn-primary coupon_remove_href">Yes ! i am sure</a>
            </div>
        </div>
        <!-- modal-content -->
    </div>
    <!-- modal-dialog -->
</div>
@endsection('content')