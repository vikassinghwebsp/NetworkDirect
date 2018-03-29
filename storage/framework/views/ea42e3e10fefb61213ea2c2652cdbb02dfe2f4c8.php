<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Networks Direct | Backend</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Canonical SEO -->
        <link rel="canonical" href="<?php echo e((!empty($arrContent['url']))?arrContent['url']:url('/')); ?>" />
        <!--  Social tags      -->
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <meta name="keywords" content="<?php echo e((!empty($arrContent['keywords']))?$arrContent['keywords']:' Best coupon codes for online shoping , mobile recharge, bill payments, dth recharge, cashback'); ?>">
        <meta name="description" content="<?php echo e((!empty($arrContent['description']))?$arrContent['description']:' Best coupon codes for online shoping , mobile recharge, bill payments, dth recharge, cashback'); ?>">
        <!-- Schema.org markup for Google+ -->
        <meta itemprop="name" content="<?php echo e((!empty($arrContent['title']))?$arrContent['title']:' Coupon Codes'); ?>">
        <meta itemprop="description" content="<?php echo e((!empty($arrContent['description']))?$arrContent['description']:' Best coupon codes for online shoping , mobile recharge, bill payments, dth recharge, cashback'); ?>">
        <meta itemprop="image" content="<?php echo e((!empty($arrContent['image']))?$arrContent['image']:url('public/assets/images/slider/sl91/2.png')); ?>">
        <!-- Twitter Card data -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@codeyiizen">
        <meta name="twitter:title" content="<?php echo e((!empty($arrContent['title']))?$arrContent['title']:' Coupon Codes'); ?>">
        <meta name="twitter:description" content="<?php echo e((!empty($arrContent['description']))?$arrContent['description']:' Best coupon codes for online shoping , mobile recharge, bill payments, dth recharge, cashback'); ?>">
        <meta name="twitter:creator" content="@codeyiizen">
        <meta name="twitter:image" content="<?php echo e((!empty($arrContent['image']))?$arrContent['image']:url('public/assets/images/slider/sl91/2.png')); ?>">
        <!-- Open Graph data -->
        <meta property="fb:app_id" content="655968634437471">
        <meta property="og:title" content="<?php echo e((!empty($arrContent['title']))?$arrContent['title']:' Coupont Codes'); ?>" />
        <meta property="og:type" content="article" />
        <meta property="og:url" content="<?php echo e((!empty($arrContent['url']))?arrContent['url']:url('/')); ?>" />
        <meta property="og:image" content="<?php echo e((!empty($arrContent['image']))?$arrContent['image']:url('public/assets/images/slider/sl91/2.png')); ?>"/>
        <meta property="og:description" content="<?php echo e((!empty($arrContent['description']))?$arrContent['description']:' Best coupon codes for online shoping , mobile recharge, bill payments, dth recharge, cashback'); ?>" />
        <meta property="og:site_name" content="Coupnt Codes" />
        <style type="text/css">
            @font-face {
                font-family: Synergyhiring-Font;
                src: url(<?php echo e(url('public/backend')); ?>/fonts/Synergyhiring-Font.woff2) format('woff2'),
            url(<?php echo e(url('public/backend')); ?>/fonts/Synergyhiring-Font.woff) format('woff'), 
            url(<?php echo e(url('public/backend')); ?>/fonts/Synergyhiring-Font.ttf) format('truetype')
            }
            @font-face {
                font-family: "Synergyhiring Design Icons";
                src: url(<?php echo e(url('public/backend')); ?>/fonts/synergyhiringicons-webfont.eot);
            src: url(<?php echo e(url('public/backend')); ?>/fonts/synergyhiringicons-webfont.eot) format("embedded-opentype"),
            url(<?php echo e(url('public/backend')); ?>/fonts/synergyhiringicons-webfont.woff2) format("woff2"), 
            url(<?php echo e(url('public/backend')); ?>/fonts/synergyhiringicons-webfont.woff) format("woff"), 
            url(<?php echo e(url('public/backend')); ?>/fonts/synergyhiringicons-webfont.ttf) format("truetype"), 
            url(<?php echo e(url('public/backend')); ?>/fonts/synergyhiringicons-webfont.svg) format("svg");
            font-weight: 400;
            font-style: normal
            }
        </style>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700|Poppins:300,400,500,600" rel="stylesheet">
        <link rel="icon" href="" type="image/x-icon">
        <link rel="stylesheet" href="<?php echo e(url('public/backend/css/vendor.bundle.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(url('public/backend/css/app.bundle.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(url('public/backend/css/theme-a.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(url('public/backend/css/custom.css')); ?>">
        <script type="text/javascript">
            var BASE_URL = "<?php echo e(url('backend')); ?>";
        </script>
    </head>
    <?php //$searchArray = array('backend'); ?>

    <?php
//            $user = \Illuminate\Support\Facades\Auth::user();
//            $userAdminDetail = \App\library\Customlibrary::getUserAdmin($user->id);
//            // var_dump($userAdminDetail->username);exit;
//            $userImage = (!empty($userAdminDetail)) ? \App\library\Customlibrary::getUserImage($userAdminDetail->profile) : '';
    ?>
    <body>
        <div id="app_wrapper">
            <header id="app_topnavbar-wrapper">
                <nav role="navigation" class="navbar topnavbar">
                    <div class="nav-wrapper">
                        <div id="logo_wrapper" class="nav navbar-nav">
                            <ul>
                                <li class="logo-icon">
                                    <a href="<?php echo e(url('/backend')); ?>">

                                        <img src="<?php echo e(URL::asset('public/assets/images/logo.png')); ?>" alt="Logo">


                                    </a>
                                </li>
                            </ul>
                        </div>
                        <ul class="nav navbar-nav left-menu ">
                            <li class="menu-icon">
                                <a  data-toggle="tooltip" data-placement="bottom" data-original-title="Main Menues" class="is-active" href="javascript:void(0)" role="button" data-toggle-state="app_sidebar-menu-collapsed" data-key="leftSideBar">
                                    <i class="mdi mdi-backburger"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav left-menu">
                            <li>
                                <a  data-toggle="tooltip" data-placement="bottom" data-original-title="User Profile" href="javascript:void(0)" class="nav-link" data-toggle-profile="profile-open">
                                    <i class="zmdi zmdi-account"></i>
                                </a>
                            </li>
                            <li>

                            </li>


                        </ul>
                        <ul class="nav navbar-nav pull-right">
                            <!--                            <li>
                                                            <a  data-toggle="tooltip" data-placement="bottom" data-original-title="Quick Search" href="javascript:void(0)" data-navsearch-open>
                                                                <i class="zmdi zmdi-search"></i>
                                                            </a>
                                                        </li>-->
                            <li class="select-menu hidden-xs hidden-sm">
                                <a data-toggle="tooltip" data-placement="bottom" data-original-title="Logout" href="<?php echo e(url('/backend/logout')); ?>"><i class="zmdi zmdi-power zmdi-hc-fw"></i></a>
                            </li>

                        </ul>
                    </div>
                    <form action="/search" role="search" action="" class="navbar-form" id="navbar_form">
                        <div class="form-group">
                            <input type="text" placeholder="Search and press enter..." class="form-control" name="q" id="navbar_search" autocomplete="off">
                            <i data-navsearch-close class="zmdi zmdi-close close-search"></i>
                        </div>
                        <button type="submit" class="hidden btn btn-default">Submit</button>
                    </form>
                </nav>
            </header>
            <aside id="app_sidebar-left">
                <nav id="app_main-menu-wrapper" class="scrollbar">
                    <div class="sidebar-inner sidebar-push">
                        <div class="card profile-menu" id="profile-menu">
                            <header class="card-heading card-img alt-heading">
                                <div class="profile">
                                    <header class="card-heading card-background" id="card_img_02">
                                        <img src="" alt="" class="img-circle max-w-75 mCS_img_loaded">
                                    </header>
                                    <a href="javascript:void(0)" class="info" data-profile="open-menu"><span></span></a>
                                </div>
                            </header>
                            <ul class="submenu">

                                <li>
                                    <a href="<?php echo e(url('backend/profile')); ?>"><i class="zmdi zmdi-account"></i>Admin Profile </a>
                                </li>

                                <li>
                                    <a href="<?php echo e(url('backend/logout')); ?>"><i class="zmdi zmdi-power"></i> Log Out</a>
                                </li>
                            </ul>
                        </div>
                        <ul class="nav nav-pills nav-stacked">
                            <li class="sidebar-header">NAVIGATION</li>
                            <li class="<?php echo \App\library\Customlibrary::currentRoute('/backend'); ?>"><a href="<?php echo e(url('/backend')); ?>"><i class="zmdi zmdi-view-dashboard"></i>Dashboard</a></li>
                            <li class="nav-dropdown <?php echo \App\library\Customlibrary::currentRoute('backend/category,backend/category/add', 'open'); ?>">
                                <a href="#"><span></span><i class="zmdi zmdi-label-heart"></i>Category Management</a>
                                <ul class="nav-sub" data-index="1" style="display: none;">
                                    <li class="sidebar-header">Category</li>

                                    <li class="<?php echo \App\library\Customlibrary::currentRoute('backend/category'); ?>"><a href="<?php echo e(url('backend/category')); ?>">Category</a></li>
                                    <li class="<?php echo \App\library\Customlibrary::currentRoute('backend/category/add'); ?>"><a href="<?php echo e(url('backend/category/add')); ?>">Add Category</a></li>                                            
                                    <li class="sidebar-header">Sub Category</li>


                                    <li class="<?php echo \App\library\Customlibrary::currentRoute('backend/subcategory'); ?>"><a href="<?php echo e(url('backend/subcategory')); ?>">Sub Category</a></li>
                                    <li class="<?php echo \App\library\Customlibrary::currentRoute('backend/subcategory/add'); ?>"><a href="<?php echo e(url('backend/subcategory/add')); ?>">Add Sub Category</a></li>
                                    <!--                                    <li class="sidebar-header">Sub's Sub Category</li>
                                                                        <li class="<?php echo \App\library\Customlibrary::currentRoute('backend/subsubcategory'); ?>"><a href="<?php echo e(url('backend/subsubcategory')); ?>">Sub SubCategory</a></li>
                                                                        <li class="<?php echo \App\library\Customlibrary::currentRoute('backend/addSubSubCat/add'); ?>"><a href="<?php echo e(url('backend/addSubSubCat/add')); ?>">Add Sub SubCategory</a></li>-->
                                </ul>
                            </li>
<!--                            <li class="nav-dropdown <?php //echo \App\library\Customlibrary::currentRoute('backend/store,backend/store/add', 'open');     ?>">
                                <a href="#"><span></span><i class="zmdi zmdi-shopping-cart"></i>Store Management</a>
                                <ul class="nav-sub" data-index="1" style="display: none;">
                                    <li class="sidebar-header">Stores</li>

                                    <li class="<?php //echo \App\library\Customlibrary::currentRoute('backend/store');     ?>"><a href="">Store</a></li>
                                    <li class="<?php //echo \App\library\Customlibrary::currentRoute('backend/store/add');     ?>"><a href="">Add Store</a></li>                                            

                                </ul>
                            </li>-->
<!--                            <li class="nav-dropdown <?php //echo \App\library\Customlibrary::currentRoute('backend/category,backend/category/add', 'open');     ?>">
                                <a href="#"><span></span><i class="zmdi zmdi-label-heart"></i>Menu Management</a>
                                <ul class="nav-sub" data-index="1" style="display: none;">
                                    <li class="sidebar-header">Menu</li>

                                    <li class="<?php echo \App\library\Customlibrary::currentRoute('backend/menu'); ?>"><a href="<?php echo e(url('backend/menu')); ?>">Menu</a></li>
                                    <li class="<?php echo \App\library\Customlibrary::currentRoute('backend/menu/add'); ?>"><a href="<?php echo e(url('backend/menu/add')); ?>">Add Menu</a></li>                                            
                                    <li class="sidebar-header">Sub Menu</li>


                                    <li class="<?php echo \App\library\Customlibrary::currentRoute('backend/submenu'); ?>"><a href="<?php echo e(url('backend/submenu')); ?>">Sub Menu</a></li>
                                    <li class="<?php echo \App\library\Customlibrary::currentRoute('backend/submenu/add'); ?>"><a href="<?php echo e(url('backend/submenu/add')); ?>">Add Sub Menu</a></li>
                                </ul>
                            </li>-->
                            <li class="nav-dropdown <?php echo \App\library\Customlibrary::currentRoute('backend/banner,backend/banner/add', 'open'); ?>">
                                <a href="#"><span></span><i class="zmdi zmdi-image"></i>Banner Management</a>
                                <ul class="nav-sub" data-index="1" >
                                    <li class="sidebar-header">Banners</li>

                                    <li class="<?php echo \App\library\Customlibrary::currentRoute('backend/banner'); ?>"><a href="<?php echo e(url('backend/banner')); ?>">Banner</a></li>
                                    <li class="<?php echo \App\library\Customlibrary::currentRoute('backend/banner/add'); ?>"><a href="<?php echo e(url('backend/banner/add')); ?>">Add Banner</a></li>                                            

                                </ul>
                            </li>

                            <li class="nav-dropdown <?php echo \App\library\Customlibrary::currentRoute('backend/product,backend/product/add', 'open'); ?>">
                                <a href="#"><span></span><i class="zmdi zmdi-dropbox"></i>Products Management</a>
                                <ul class="nav-sub" data-index="1" style="display: none;">
                                    <li class="sidebar-header">Products</li>

                                    <li class="<?php echo \App\library\Customlibrary::currentRoute('backend/product'); ?>"><a href="<?php echo e(url('backend/product')); ?>">Products List</a></li>
                                    <li class="<?php echo \App\library\Customlibrary::currentRoute('backend/product/add'); ?>"><a href="<?php echo e(url('backend/product/add')); ?>">Add Products</a></li>
                                    <li class="<?php echo \App\library\Customlibrary::currentRoute('backend/addProductCSV'); ?>"><a href="<?php echo e(url('backend/addProductCSV')); ?>">Add Products Via CSV</a></li>

                                </ul>
                            </li>
                            <li class="nav-dropdown <?php //echo \App\library\Customlibrary::currentRoute('backend/subscibeemail', 'open');     ?>">
                                <a href="#"><span></span><i class="zmdi zmdi-accounts-list"></i>All Users Management</a>
                                <ul class="nav-sub" data-index="1" style="display: none;">
                                    <li class="sidebar-header">Users</li>
                                    <li class="<?php echo \App\library\Customlibrary::currentRoute('backend/allUsers'); ?>"><a href="<?php echo e(url('backend/allUsers')); ?>">All Users List</a></li>
                                    <li class="<?php echo \App\library\Customlibrary::currentRoute('backend/allSubscribedUsers');     ?>"><a href="<?php echo e(url('backend/allSubscribedUsers')); ?>">Subscibe Emaillist</a></li>


                                </ul>
                            </li>
                            <li class="nav-dropdown <?php //echo \App\library\Customlibrary::currentRoute('backend/subscibeemail', 'open');     ?>">
                                <?php $subCat = app('App\Http\Controllers\backend\BackendController')->getNotification() ?>
                                <a href="#"><span></span><i class="zmdi zmdi-apps"></i>All Orders <?php  if($subCat > 1) { ?><span class="label label-success" style="font-size:15px !important;right: 35px;"><?php echo e($subCat = app('App\Http\Controllers\backend\BackendController')->getNotification()); ?></span><?php } ?></a>
                                <ul class="nav-sub" data-index="1" style="display: none;">
                                    <li class="sidebar-header">Orders</li>
                                    <li class="<?php echo \App\library\Customlibrary::currentRoute('backend/ordersList'); ?>"><a href="<?php echo e(url('backend/ordersList')); ?>">All Orders List<?php  if($subCat > 1) { ?><span class="label label-success" style="font-size:10px !important;"><?php echo e($subCat = app('App\Http\Controllers\backend\BackendController')->getNotification()); ?></span><?php } ?></a></li>



                                </ul>
                            </li>


                            <li class="nav-dropdown <?php echo \App\library\Customlibrary::currentRoute('backend/banner,backend/aboutus', 'open'); ?>">
                                <a href="#"><span></span><i class="zmdi zmdi-image"></i>Custom Pages</a>
                                <ul class="nav-sub" data-index="1" >
                                    <li class="sidebar-header">Pages</li>

                                    <li class="<?php echo \App\library\Customlibrary::currentRoute('backend/aboutus'); ?>"><a href="<?php echo e(url('backend/aboutus')); ?>">About Us</a></li>
                                    <li class="<?php echo \App\library\Customlibrary::currentRoute('backend/terms'); ?>"><a href="<?php echo e(url('backend/terms')); ?>">Terms & Conditions</a></li>
                                    <li class="<?php echo \App\library\Customlibrary::currentRoute('backend/addBrand'); ?>"><a href="<?php echo e(url('backend/addBrand')); ?>">Add Brands</a></li>

                                </ul>
                            </li>
                            <li class="<?php echo \App\library\Customlibrary::currentRoute('backend/frontCategory'); ?>"><a href="<?php echo e(url('backend/frontCategory')); ?>"><i class="zmdi zmdi-label-heart"></i>Front Category</a></li>
                            <li class="<?php echo \App\library\Customlibrary::currentRoute('backend/add_address'); ?>"><a href="<?php echo e(url('backend/add_address')); ?>"><i class="zmdi zmdi-label-heart"></i>Address</a></li>
                            <li class="<?php echo \App\library\Customlibrary::currentRoute('backend/add_socialMedia'); ?>"><a href="<?php echo e(url('backend/add_socialMedia')); ?>"><i class="zmdi zmdi-label-heart"></i>Social Media Links</a></li>                    
                    </div>
                </nav>
            </aside>
            <section id="content_outer_wrapper">
                <div id="content_wrapper" class="<?php //echo (!empty(\Illuminate\Support\Facades\Route::getFacadeRoot()->current()->uri()) && \Illuminate\Support\Facades\Route::getFacadeRoot()->current()->uri() == "backend/profile") ? "card-overlay" : '';     ?>">
                    <?php echo $__env->yieldContent('content'); ?>

                </div>
                <footer id="footer_wrapper">
                    <div class="footer-content">
                        <div class="row copy-wrapper">
                            <div class="col-xs-8">
                                <p>Developed by <a target="_blank" style="color: yellow" href="http://www.webspreadtech.com/">WebSpreadTech.com</a></p>
                            </div>
                        </div>
                    </div>
                </footer>
            </section>


        </div>
        <script src="<?php echo e(url('public/backend/js/vendor.bundle.js')); ?>"></script>
        <script src="<?php echo e(url('public/backend/js/app.bundle.js')); ?>"></script>
        <script src="<?php echo e(url('public/backend')); ?>/js/custom/custom.js"></script>
        <script src="<?php echo e(url('public/backend')); ?>/js/jquery-validate/jquery.validate.min.js"></script>
        <script src="<?php echo e(url('public/backend')); ?>/js/custom/contomvalidation.js"></script>
        <?php echo $__env->yieldContent('extraContent'); ?>
    </body>
</html>
