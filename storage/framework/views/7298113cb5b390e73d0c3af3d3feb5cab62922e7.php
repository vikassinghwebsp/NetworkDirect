<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Post a job position or create your online resume by TheJobs!">
        <meta name="keywords" content="Login page For Coupon Backend">

        <!-- Canonical SEO -->
        <link rel="canonical" href="<?php echo e(url('backend/auth')); ?>" />
        <!--  Social tags      -->
        <meta name="keywords" content="Login page For Coupon Backend">
        <meta name="description" content="Login page For Coupon Backend">
        <!-- Schema.org markup for Google+ -->
        <meta itemprop="name" content="Login page For Coupon Backend">
        <meta itemprop="description" content="Login page For Coupon Backend">
        <meta itemprop="image" content="<?php echo e(url('public/backend/images')); ?>/synergylogo.png">
        <!-- Twitter Card data -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@codeyiizen">
        <meta name="twitter:title" content="Login page For Coupon Backend">
        <meta name="twitter:description" content="Login page For Coupon Backend">
        <meta name="twitter:creator" content="@codeyiizen">
        <meta name="twitter:image" content="<?php echo e(url('public/backend/images')); ?>/synergylogo.png">
        <!-- Open Graph data -->
        <meta property="fb:app_id" content="655968634437471">
        <meta property="og:title" content="Login page For Coupon Backend" />
        <meta property="og:type" content="article" />
        <meta property="og:url" content="<?php echo e(url('backend/auth')); ?>" />
        <meta property="og:image" content="<?php echo e(url('public/assets/images/slider/sl91/2.png')); ?>" />
        <meta property="og:description" content="Login page For Coupon Backend" />
        <meta property="og:site_name" content="Coupont Code" />
        <title>Backend Login | Coupont Code</title>

        <style type="text/css">
            @font-face {
                font-family: Synergyhiring-Font;
                src: url(<?php echo e(url('public/backend')); ?>/fonts/Synergyhiring-Font.woff2) format('woff2'),
            url(<?php echo e(url('public/backend')); ?>/fonts/Synergyhiring-Font.woff) format('woff'), 
            url(<?php echo e(url('public/backend')); ?>/fonts/Synergyhiring-Font.ttf) format('truetype')
            }

        </style>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700|Poppins:300,400,500,600" rel="stylesheet">
        <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="<?php echo e(url('public/backend/css/vendor.bundle.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(url('public/backend/css/app.bundle.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(url('public/backend/css/theme-a.css')); ?>">
    </head>
    <body id="auth_wrapper" >
        <div id="login_wrapper">

            <div id="login_content">
                <div class="" style="margin-bottom: 5%;text-align: center;">
                    
                    <h4>Networks Direct | Backend</h4>
                </div>
                <h1 class="login-title">
                    Sign In As Admin
                </h1>
                <div class="login-body">
                    <form method="post" action="" role="form" id="login" class="login-form fade-in-effect">
                        <?php if(Session::has('success')): ?>
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">
                                <span aria-hidden="true">×</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <strong>success!</strong> <?php echo e(Session::get('success')); ?>

                        </div>
                        <?php endif; ?>
                        <?php if(Session::has('error')): ?>
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert">
                                <span aria-hidden="true">×</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <strong>Error!</strong> <?php echo e(Session::get('error')); ?>

                        </div>
                        <?php endif; ?>
                        <div class="form-group label-floating is-empty">
                            <label class="control-label">Email</label>
                            <input type="text" class="form-control" name="email" id="username" autocomplete="off" >
                        </div>
                        <div class="form-group label-floating is-empty">
                            <label class="control-label">Password</label>
                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                            <input type="password" class="form-control" name="password" id="passwd" autocomplete="off" >
                        </div>
                        <a href="<?php echo e(url('').'/forgot_password'); ?>" data-href="" id="super_forgotpassword" class="forgot-pass pull-right">Forgot Password?</a>
                        <div class="checkbox inline-block">
                            <label>
                                <input type="checkbox" name="remember" class="checkbox-inline">
                                Remember Me
                            </label>
                        </div>
                        <button type="submit" class="btn btn-info btn-block m-t-40">Sign In</button>                        
                        <div class="login-options">

                        </div>

                    </form>
                </div>

            </div>
        </div>
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
        <script type="text/javascript">
var BASE_URL_ADMIN = "<?php echo url('backend'); ?>";
jQuery(document).ready(function ($)
{	// Reveal Login form
    //alert('dfhdh');

    setTimeout(function () {
        $(".fade-in-effect").addClass('in');
    }, 1);
    // Validation and Ajax action
    $("form#login").validate({
        rules: {
            username: {
                required: true
            },
            passwd: {
                required: true
            }
        },
        messages: {
            username: {
                required: 'Please enter your email.'
            },
            passwd: {
                required: 'Please enter your password.'
            }
        },
    });

    // Set Form focus
    $("form#login .form-group:has(.form-control):first .form-control").focus();
});
        </script>

        <script src="<?php echo e(url('public/backend')); ?>/js/jquery-validate/jquery.validate.min.js"></script>
        <script src="<?php echo e(url('public/backend/js/vendor.bundle.js')); ?>"></script>
        <script src="<?php echo e(url('public/backend/js/app.bundle.js')); ?>"></script>
        <script type="text/javascript">
var rec_login = "<?php echo e(url('recruiter/auth')); ?>";
var company_login = "<?php echo e(url('backend/auth/login/post')); ?>";
$("body").on('change', '#login-as', function () {
    //alert('asdf');
    if ($(this).val() == 1 || $(this).val() == 2 || $(this).val() == 3) {
        $("#login").attr('action', rec_login);
    } else {
        $("#login").attr('action', company_login);
    }
});

        </script>
    </body>
</html>
