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
                    <h1>Add Terms & Condition</h1>
                    <ol class="breadcrumb">
                        <li><a href="{{ url('backend/') }}">Dashboard</a></li>
                        <li><a href="{{ url('backend/coupon') }}">Terms & Condition</a></li>
                        <li class="active">Add Terms & Condition</li>
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
                        <h2 class="card-title">Terms & Condition</h2>
                        <ul class="card-actions icons right-top">
                        </ul>
                    </header>
                    <div class="card-body">

                        <div class="form-group label-floating is-empty">
                            <label class="control-label">Title</label>
                            <input type="text" name="title" class="form-control" value="{{ !empty($arrContent['termsData'][0]->title)?$arrContent['termsData'][0]->title:'' }}">
                        </div>

                        <!--                        <div class="form-group is-empty">
                                                    <div class="input-group">
                                                        <label class="control-label">About us Image</label>
                                                        <input type="file" class="form-control" placeholder="File Upload..." name="aboutus_image">
                                                        <div class="input-group">
                                                            <input type="text" readonly="" class="form-control" placeholder="Upload one or more files...">
                                                            <span class="input-group-btn input-group-sm">
                                                                <button type="button" class="btn btn-primary btn-fab btn-fab-sm">
                                                                    <i class="zmdi zmdi-attachment-alt"></i>
                                                                </button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>-->

                        <div class="form-group label-floating is-empty">
                            <label for="textArea" class="control-label"> Description</label>
                        </div>
                        <input type="hidden" name="terms_id" value="{{ !empty($arrContent['termsData'][0]->id)?$arrContent['termsData'][0]->id:'' }}">
                        <div class="form-group label-floating is-empty">
                            <textarea class="form-control" name="description" rows="4" id="terms">{{ !empty($arrContent['termsData'][0]->description)?$arrContent['termsData'][0]->description:'' }}</textarea>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary btn-flat ">Reset</button>



                        <?php
                        if (!empty($arrContent['termsData'])) {
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