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
                    <h1>Add Coupon</h1>
                    <ol class="breadcrumb">
                        <li><a href="{{ url('backend/') }}">Dashboard</a></li>
                        <li><a href="{{ url('backend/coupon') }}">Coupons</a></li>
                        <li class="active">Add Coupon</li>
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
                        <h2 class="card-title">New Coupon</h2>
                        <ul class="card-actions icons right-top">
                        </ul>
                    </header>
                    <div class="card-body">
                        <div class="form-group label-floating is-empty">
                            <label class="control-label">Coupon Code</label>
                            <input type="text" name="coupon_code" id="coupon_code" class="form-control">
                            <p id="show_coupan" style="color:red;"></p>
                        </div>
                        <div class="form-group label-floating is-empty">
                            <label class="control-label">Coupon Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group label-floating is-empty">
                            <label for="textArea" class="control-label">Coupons Description</label>
                            <textarea class="form-control" name="description" rows="4" id="textArea"></textarea>
                        </div>
                        <div class="form-group label-floating is-empty">
                            <select class="select form-control" name="coupon_type">
                                <option value="" selected="">Select Coupon Type</option>
                                @if(!empty($arrCouponType))
                                @foreach($arrCouponType as $key=>$val)
                                <option value="{{ $key }}">{{ $val }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                         <div class="form-group label-floating is-empty">
                            <select class="select form-control" name="offer_type">
                                <option value="" selected="">Select Offer Type</option>
                                <option value="per">Persantage(%)</option>
                                <option value="inr">INR</option>
                            </select>
                        </div>
                        <div class="form-group label-floating is-empty">
                            <label class="control-label">Coupon Offer</label>
                            <input type="text" name="off" class="form-control">
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
<!--                        <div class="form-group label-floating is-empty">
                            <select class="select form-control" name="subcat_id" id="select_subcat">
                                <option value="" selected="">Select Sub category</option>
                                
                            </select>
                        </div>-->
                        <div class="form-group label-floating is-empty">
                           <label for="" class="control-label">Select Sub category</label>
                             <select multiple="multiple" data-rule-required="true" class="form-control select" name="subcat_id[]" id="select_subcat" aria-required="true" placeholder="Select one or more options">
                               
                            </select>
                       </div>
                        
                        <div class="form-group label-floating is-empty">
                            <select class="select form-control" name="store" id="store_id">
                                <option value="" selected="">Select Store</option>
                               
                            </select>
                        </div>
                        <div class="form-group label-floating is-empty">
                            <label class="control-label">Activate Datee (yyyy-mm-dd)</label>
                            <input class="form-control" type="text" name="activatedate" id="activatedate" value="">
                        </div>
                        <div class="form-group label-floating is-empty">
                            <label class="control-label">Expairy Date (yyyy-mm-dd)</label>
                            <input class="form-control" type="text" name="expdate" id="expdate" value="" >
                        </div>
                        <div class="form-group label-floating is-empty">
                            <label class="control-label">External Link</label>
                            <input type="text" name="link" class="form-control">
                        </div>
                        <div class="form-group label-floating is-empty">
                           <label for="" class="control-label">Multiselect Example</label>
                            <select multiple="multiple" data-rule-required="true" class="form-control select" name="multi_city[]" aria-required="true" placeholder="Select one or more options">
                               @if(!empty($arrContent['cities']))
                                @foreach($arrContent['cities'] as $cities)
                                <option value="{{ $cities->ID }}">{{ $cities->Name }}</option>
                                @endforeach
                                @endif
                            </select>
                      </div>
                        <div class="form-group label-floating is-empty">
                            <label for="textArea" class="control-label">Coupons Terms</label>
                        </div>
                        <div class="form-group label-floating is-empty">
                            <textarea class="form-control" name="terms" rows="4" id="terms"></textarea>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary btn-flat ">Reset</button>
                        <button class="btn btn-primary" type="submit">Add New Coupon</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection('content')
@section('extraContent')
<script src="{{ url('public/backend/js/tinymce') }}/tinymce.min.js"></script>
<script>tinymce.init({ selector:'#terms' });</script>
@endsection('content')