@extends('backend._layout.main')
@section('content')
<?php
$arrCouponType = \App\library\Customlibrary::getCouponType();
?>
<div id="header_wrapper" class="header-sm">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <header id="header">
                    <h1>Add About Us</h1>
                    <ol class="breadcrumb">
                        <li><a href="{{ url('backend/') }}">Dashboard</a></li>
                        <li><a href="{{ url('backend/coupon') }}">Address</a></li>
                        <li class="active">Add Address </li>
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
                        <h2 class="card-title">New About Us</h2>
                        <ul class="card-actions icons right-top">
                        </ul>
                    </header>
                    <div class="card-body">

                        <div class="form-group label-floating is-empty">
                            <label class="control-label">Address</label>
                            <?php //var_dump($arrContent['aboutData'][0]); ?>
                            <input type="text" name="address" class="form-control" value="{{ !empty($arrContent['aboutData'][0]->address)?$arrContent['aboutData'][0]->address:'' }}">
                        </div>


                        
                        <input type="hidden" name="address_id" value="{{ !empty($arrContent['aboutData'][0]->id)?$arrContent['aboutData'][0]->id:'' }}">
                        <div class="form-group label-floating is-empty">
                            <label class="control-label">Contact Number</label>
                            <?php //var_dump($arrContent['aboutData'][0]); ?>
                            <input type="text" name="contact_no" class="form-control" value="{{ !empty($arrContent['aboutData'][0]->contact_no)?$arrContent['aboutData'][0]->contact_no:'' }}">
                        </div>
                        <div class="form-group label-floating is-empty">
                            <label class="control-label">Email Id</label>
                            <?php //var_dump($arrContent['aboutData'][0]); ?>
                            <input type="text" name="official_email" class="form-control" value="{{ !empty($arrContent['aboutData'][0]->official_email)?$arrContent['aboutData'][0]->official_email:'' }}">
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary btn-flat ">Reset</button>
                        <?php
                        if (!empty($arrContent['aboutData'])) {
                            ?>
                            <button class="btn btn-primary" type="submit">Update Details</button>
                        <?php } else { ?>
                            <button class="btn btn-primary" type="submit">Submit Details</button>
                        <?php } ?>
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
@endsection('content')