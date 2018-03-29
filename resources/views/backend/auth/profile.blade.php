@extends('backend._layout.main')
@section('content')
<?php
$rol = App\library\Customlibrary::getUserRole();
$user = \Illuminate\Support\Facades\Auth::user();
$userAdminDetail = \App\library\Customlibrary::getUserAdmin($user->id);
$userImage = (!empty($userAdminDetail)) ? \App\library\Customlibrary::getUserImage($userAdminDetail->profile) : '';
?>
<style type="text/css">
    .custom_header_methoad{
        background-image:  url({{ url('public/backend') }}/img/headers/profile-header.jpg);
    height: 320px;
    min-height: 320px;
    max-height: 320px;
    padding: 25px;
    background-repeat: no-repeat;
    background-size: cover;
    background-position: 0 90%!important;

    }
    .form-group input[type=file]{
        opacity:1 !important;
        position: relative !important;
    }

</style>
<div class="row">
    </br>
    </br>
    </br>
</div>
<div id="content" class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <div class="card card-transparent">
                <div class="card-body wrapper">
                    <div class="row">
                        <div class="col-md-12 col-lg-3">
                            <div class="card type--profile">
                                <header class="card-heading">
                                    <img src="<?php echo (!empty($userAdminDetail)) ? \App\library\Customlibrary::getUserImage($userAdminDetail->profile) : ''; ?>" alt="" class="img-circle animated tada">
                                    <ul class="card-actions icons right-top">

                                    </ul>
                                </header>
                                <div class="card-body">
                                    <h3 class="name">{{ $content['full_name'] }}</h3>
                                    <span class="title">Company Account</span>

                                </div>

                            </div>
                        </div>
                        <div class="col-md-12 col-lg-8">
                            <div class="card">
                                <header class="card-heading p-0">
                                    <div class="tabpanel m-b-30">
                                        <ul class="nav nav-tabs nav-justified">
                                            <li class="active " role="presentation"><a href="#profile-timeline" data-toggle="tab" aria-expanded="true">Profile</a></li>


                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="tab-pane fadeIn active" id="profile-timeline">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                        <article>
                                                            @if(Session::has('EditSuccess'))
                                                            <div class="alert alert-success" role="alert">
                                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                <strong>Success!</strong> {{ Session::get('EditSuccess') }}.
                                                            </div>
                                                            @endif
                                                            <form action="{{url('backend/profile/submit')}}" role="form" id="user_add" method="post" class="validate" novalidate="novalidate" enctype="multipart/form-data">
                                                                <div class="panel-body">
                                                                    <div class="row col-margin">
                                                                        <div class="form-group label-floating col-xs-6 col-md-6">
                                                                            <label class="control-label">User Name<small style="color: red;">*</small></label> <br>
                                                                            <input class="form-control" name="admin_name" id="user_email" value="{{ $content['full_name'] }}" placeholder="User Name" required="" aria-required="true" type="text">&nbsp;<br>

                                                                        </div>
                                                                        <div class="form-group label-floating col-xs-6  col-md-6">
                                                                            <label class="control-label">User Email Id</label> <br>
                                                                            <input class="form-control" name="admin_email" id="user_email" value="{{ $content['email'] }}" placeholder="User Email Id" readonly="" aria-required="true" type="text">&nbsp;<br>

                                                                        </div>
                                                                        <div class="form-group label-floating col-xs-6  col-md-6">
                                                                            <label class="control-label">User Phone No<small style="color: red;">*</small></label> <br>
                                                                            <input class="form-control" name="admin_phoneno" id="user_phoneno" value="{{ $content['mobile'] }}" placeholder="User Phone No" required="" aria-required="true" type="text">&nbsp;<br>

                                                                        </div>

                                                                        <div class="form-group label-floating col-xs-6  col-md-6">
                                                                            <label class="control-label">Address<small style="color: red;">*</small></label> <br>
                                                                            <input class="form-control" name="admin_address" id="user_address" value="{{ $content['address'] }}" placeholder="Address" type="text">&nbsp;<br>

                                                                        </div>
                                                                        <div class="form-group label-floating col-xs-6 col-md-6">
                                                                            <label class="control-label">City<small style="color: red;">*</small></label> <br>
                                                                            <input class="form-control" name="admin_city" id="user_address" value="{{ $content['city'] }}" placeholder="City" required="" aria-required="true" type="text">&nbsp;<br>

                                                                        </div>
                                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                        <div class="form-group label-floating col-xs-6 col-md-6">
                                                                            <label class="control-label">Profile Image<small style="color: red;">*</small></label> <br>
                                                                            <input class="form-control" name="admin_image" style="" id="profilepic" value="" placeholder="Profile Picture" type="file">&nbsp;<br>


                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 col-md-6">
                                                                        <button type="submit" id="btn" class="btn btn-success">Update</button>
                                                                    </div>



                                                                </div></form> 
                                                        </article>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('extraContent')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!--<link rel="stylesheet" href="/resources/demos/style.css">-->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(function () {
    $("#datepicker").datepicker({
        dateFormat: 'yy-mm-dd',
        changeYear: true,
        maxDate: '2000-12-31'
    });

});
</script>

@endsection