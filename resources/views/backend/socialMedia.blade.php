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
                    <h1>Add Social Media</h1>
                    <ol class="breadcrumb">
                        <li><a href="{{ url('backend/') }}">Dashboard</a></li>
                        <li><a href="{{ url('backend/coupon') }}">Social Media</a></li>
                        <li class="active">Add Social Media </li>
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
                        <h2 class="card-title">Social Media Links</h2>
                        <ul class="card-actions icons right-top">
                        </ul>
                    </header>
                    <div class="card-body">

                        <div class="form-group label-floating is-empty">
                            <label class="control-label">Twitter</label>
                            
                            <input type="text" name="twitter" class="form-control" value="{{ !empty($arrContent['aboutData'][0]->twitter)?$arrContent['aboutData'][0]->twitter:'' }}">
                        </div>


                        
                        <input type="hidden" name="socialmedia_id" value="{{ !empty($arrContent['aboutData'][0]->id)?$arrContent['aboutData'][0]->id:'' }}">
                        <div class="form-group label-floating is-empty">
                            <label class="control-label">Facebook</label>
                            <?php //var_dump($arrContent['aboutData'][0]); ?>
                            <input type="text" name="facebook" class="form-control" value="{{ !empty($arrContent['aboutData'][0]->facebook)?$arrContent['aboutData'][0]->facebook:'' }}">
                        </div>
                        <div class="form-group label-floating is-empty">
                            <label class="control-label">Google Plus</label>
                            <?php //var_dump($arrContent['aboutData'][0]); ?>
                            <input type="text" name="googleplus" class="form-control" value="{{ !empty($arrContent['aboutData'][0]->googleplus)?$arrContent['aboutData'][0]->googleplus:'' }}">
                        </div>
                        <div class="form-group label-floating is-empty">
                            <label class="control-label">Youtube</label>
                            <?php //var_dump($arrContent['aboutData'][0]); ?>
                            <input type="text" name="youtube" class="form-control" value="{{ !empty($arrContent['aboutData'][0]->youtube)?$arrContent['aboutData'][0]->youtube:'' }}">
                        </div>
                        <div class="form-group label-floating is-empty">
                            <label class="control-label">LinkedIn</label>
                            <?php //var_dump($arrContent['aboutData'][0]); ?>
                            <input type="text" name="linkedin" class="form-control" value="{{ !empty($arrContent['aboutData'][0]->linkedin)?$arrContent['aboutData'][0]->linkedin:'' }}">
                        </div>
                        <div class="form-group label-floating is-empty">
                            <label class="control-label">Whats App</label>
                            <?php //var_dump($arrContent['aboutData'][0]); ?>
                            <input type="text" name="whatsapp" class="form-control" value="{{ !empty($arrContent['aboutData'][0]->whatsapp)?$arrContent['aboutData'][0]->whatsapp:'' }}">
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