<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- set the encoding of your site -->
        <meta charset="utf-8">
        <!-- set the viewport width and initial-scale on mobile devices -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Networks Direct</title>
        <link rel="shortcut icon" href="<?php echo e(URL::asset('public/assets/images/favicon.ico')); ?>" type="image/x-icon" />
        <!-- include the site stylesheet -->
        <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900,900italic%7cMontserrat:400,700%7cOxygen:400,300,700' rel='stylesheet' type='text/css'>
        <!-- include the site stylesheet -->
        <link rel="stylesheet" href="<?php echo e(URL::asset('public/assets/css/bootstrap.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(URL::asset('public/assets/css/font-awesome.min.css')); ?>">
        <!-- include the site stylesheet -->
        <link rel="stylesheet" href="<?php echo e(URL::asset('public/assets/css/animate.css')); ?>">
        <!-- include the site stylesheet -->
        <link rel="stylesheet" href="<?php echo e(URL::asset('public/assets/css/icon-fonts.css')); ?>">
        <!-- include the site stylesheet -->
        <link rel="stylesheet" href="<?php echo e(URL::asset('public/assets/css/profile.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(URL::asset('public/assets/css/main.css')); ?>">
        <!-- include the site stylesheet -->
        <link rel="stylesheet" href="<?php echo e(URL::asset('public/assets/css/responsive.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(URL::asset('public/assets/css/sky-forms.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(URL::asset('public/assets/css/custom-sky-forms.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(URL::asset('public/assets/css/shop.style.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(URL::asset('public/assets/css/custom-jquery.steps.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(URL::asset('public/assets/css/custom.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(URL::asset('public/assets/css/jquery.fancybox.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(URL::asset('public/assets/css/style.css')); ?>">

        <script type="text/javascript">
            function googleTranslateElementInit() {
                new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
            }


        </script>

        <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

        <!--        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
    </head>

    <?php
    $switches = app('App\Http\Controllers\FrontendController')->getSwitches('Cisco Switches');
    
    $routers = app('App\Http\Controllers\FrontendController')->getSwitches('Cisco Routers');
    $security = app('App\Http\Controllers\FrontendController')->getSwitches('Cisco Security');
    $wireless = app('App\Http\Controllers\FrontendController')->getSwitches('Cisco Wireless');
    $accessories = app('App\Http\Controllers\FrontendController')->getSwitches('Cisco Accessories');
    $ip = app('App\Http\Controllers\FrontendController')->getSwitches('Cisco IP Phones');
    $meraki = app('App\Http\Controllers\FrontendController')->getSwitches('Cisco Meraki');
    
    
    //dd($switches);
    //$stores = app('App\Http\Controllers\frontend\CategoryController')->getAllStore();
    ?>

    <body>
        <!-- main container of all the page elements -->
        <div id="wrapper">
            <!-- Page Loader -->
            <!--            <div id="pre-loader" class="loader-container">
                            <div class="loader">
                                <img src="<?php echo e(URL::asset('public/assets/images/rings.svg')); ?>" alt="loader">
                            </div>
                        </div>-->
            <!-- W1 start here -->
            <div class="w1">
                <!-- mt header style3 start here -->
                <header id="mt-header" class="style3">
                    <!-- mt top bar start here -->
                    <div class="mt-top-bar">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12 col-sm-4">

                                </div>
                                <div class="col-xs-12 col-sm-8 text-right">
                                    <!-- mt top list start here -->
                                    <ul class="mt-top-list">

                                        <?php
                                        if (Session::get('user')) {
                                            $sessionData = Session::get('user');
                                            //var_dump($sessionData[0][0]->full_name);exit;
                                            ?>

                                            <li><a href="#">HELLO, <?php echo strtoupper($sessionData[0]->full_name); ?> </a></li>
                                            <li><a href="<?php echo e(url('myaccount/order-history')); ?>">MY ACCOUNT</a></li>
                                            <li><a href="<?php echo e(url('logout')); ?>">LOGOUT</a></li>
                                        <?php } else { ?>

                                            <li><a  data-toggle="modal" id="login_link">LOGIN</a></li>
                                            <li><a href="<?php echo e(url('register')); ?>">REGISTER</a></li>



                                        <?php } ?>
                                        <li id="google_translate_element" ></li>
                                        <li id="my-element" class="element"></li>
<!--                                            <li><a href="<?php echo e(url('cart')); ?>"><i class="fa fa-shopping-cart"></i><?php echo e(Cart::count()); ?> CART</a></li>-->
                                    </ul>
                                    <!-- mt top list end here -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-top-searchbar">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12 col-sm-3">
                                    <div class="logo"><a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(URL::asset('public/assets/images/logo.png')); ?>" class="img-responsive" alt="logo"></a></div>
                                </div>
                                <div class="col-xs-12 col-sm-5 text-right">
                                    <!-- mt top list start here -->

                                    <div class="search-box">
                                        <form method="GET" action="<?php echo e(url('product/search')); ?>">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Search for products, brands, shops" name="product">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-default" type="submit">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>				</div>


                                <div class="col-xs-12 col-sm-2 hidden-xs">
                                    <div class="cart">
                                        <a href="<?php echo e(url('cart')); ?>" style="color:white;"> <i class="fa fa-shopping-cart fa-2x"><span><?php echo e((!empty(Cart::count())) ?Cart::count():''); ?></span></i></a>
                                    </div>

                                </div>
                                <div class="col-xs-12 col-sm-2 hidden-xs">
                                    <div class="sale">
                                        <img src="<?php echo e(URL::asset('public/assets/images/tag.png')); ?>">
                                    </div>             
                                </div>  
                            </div>
                        </div>
                    </div>

                    <!-- mt top bar end here -->
                    <!-- mt bottom bar start here -->
                    <div class="mt-bottom-bar">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12">
                                    <!-- mt logo start here -->
                                    <!--<div class="mt-logo"><a href="#"><img src="assets/images/mt-logo.png" alt="schon"></a></div> -->
                                    <!-- mt sh cart start here -->

                                    <!-- mt sh cart end here -->
                                    <!-- mt icon list start here -->
                                    <ul class="mt-icon-list">
                                        <li class="hidden-lg hidden-md">
                                            <a href="#" class="bar-opener mobile-toggle">
                                                <span class="bar"></span>
                                                <span class="bar small"></span>
                                                <span class="bar"></span>
                                            </a>
                                        </li>

                                    </ul><!-- mt icon list end here -->
                                    <!-- navigation start here -->
                                    <nav id="nav">
                                        <ul>

                                            <li class="drop">
                                                <a href="#">CISCO SWITCHES <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                                <!-- mt dropmenu start here -->
                                                <div class="mt-dropmenu text-left">
                                                    <!-- mt frame start here -->
                                                    <div class="mt-frame" >
                                                        <!-- mt f box start here -->

                                                        <div class="mt-f-box">
                                                            <?php
                                                            $i = 0;
                                                            foreach ($switches as $kicks) {

                                                                $i++;
                                                                ?>
                                                                <div class="mt-col-3">
                                                                    <div class="sub-dropcont">
                                                                        <a href="<?php echo e(url('/products/'.$kicks->category_id)); ?>"><strong class="title"><?php echo $kicks->category_name; ?></strong></a>
                                                                        <!-- mt col3 start here -->
                                                                        <?php
                                                                        $subcat = app('App\Http\Controllers\FrontendController')->getSubcategoryData($kicks->category_id);

                                                                        foreach ($subcat as $kicks) {
                                                                            //var_dump($kicks->subcategory_slug); exit;
                                                                            ?>
                                                                            <div class="sub-drop">
                                                                                <ul>
                                                                                    <li ><a href="<?php echo $kicks->subcategory_link; ?>" ><?php echo $kicks->subcategory_name; ?></a></li>

                                                                                </ul>
                                                                            </div>
                                                                        <?php } ?>
                                                                        <div class="clearfix"></div>
                                                                        <?php if ($i == 5) { ?>
                                                                            <?php
                                                                            $i = 0;
                                                                        }
                                                                        ?>

                                                                    </div>


                                                                </div>

<?php } ?>
                                                        </div>


                                                        <!-- mt f box end here -->
                                                    </div>
                                                    <!-- mt frame end here -->
                                                </div>
                                                <!-- mt dropmenu end here -->
                                                <span class="mt-mdropover"></span>
                                            </li>

                                            <li class="drop">
                                                <a href="#"> CISCO ROUTERS  <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                                <!-- mt dropmenu start here -->
                                                <div class="mt-dropmenu text-left">
                                                    <!-- mt frame start here -->
                                                    <div class="mt-frame" >
                                                        <!-- mt f box start here -->

                                                        <div class="mt-f-box">
                                                            <?php
                                                            $i = 0;
                                                            foreach ($routers as $kicks) {

                                                                $i++;
                                                                ?>
                                                                <div class="mt-col-3">
                                                                    <div class="sub-dropcont">
                                                                        <a href="<?php echo e(url('/products/'.$kicks->category_id)); ?>"><strong class="title"><?php echo $kicks->category_name; ?></strong></a>
                                                                        <!-- mt col3 start here -->
                                                                        <?php
                                                                        $subcat = app('App\Http\Controllers\FrontendController')->getSubcategoryData($kicks->category_id);

                                                                        foreach ($subcat as $kicks) {
                                                                            //var_dump($kicks->subcategory_slug); exit;
                                                                            ?>
                                                                            <div class="sub-drop">
                                                                                <ul>
                                                                                    <li ><a href="<?php echo e(url('/subcatproducts/'.$kicks->subcategory_name)); ?>" ><?php echo $kicks->subcategory_name; ?></a></li>

                                                                                </ul>
                                                                            </div>
                                                                        <?php } ?>
                                                                        <div class="clearfix"></div>
                                                                        <?php if ($i == 5) { ?>
                                                                            <?php
                                                                            $i = 0;
                                                                        }
                                                                        ?>

                                                                    </div>


                                                                </div>

<?php } ?>
                                                        </div>


                                                        <!-- mt f box end here -->
                                                    </div>
                                                    <!-- mt frame end here -->
                                                </div>
                                                <!-- mt dropmenu end here -->
                                                <span class="mt-mdropover"></span>
                                            </li>


                                            <li class="drop">
                                                <a href="#">Cisco Security <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                                <!-- mt dropmenu start here -->
                                                <div class="mt-dropmenu text-left">
                                                    <!-- mt frame start here -->
                                                    <div class="mt-frame" >
                                                        <!-- mt f box start here -->

                                                        <div class="mt-f-box">
                                                            <?php
                                                            $i = 0;
                                                            foreach ($security as $kicks) {

                                                                $i++;
                                                                ?>
                                                                <div class="mt-col-3">
                                                                    <div class="sub-dropcont">
                                                                        <a href="<?php echo e(url('/products/'.$kicks->category_id)); ?>"><strong class="title"><?php echo $kicks->category_name; ?></strong></a>
                                                                        <!-- mt col3 start here -->
                                                                        <?php
                                                                        $subcat = app('App\Http\Controllers\FrontendController')->getSubcategoryData($kicks->category_id);

                                                                        foreach ($subcat as $kicks) {
                                                                            //var_dump($kicks->subcategory_slug); exit;
                                                                            ?>
                                                                            <div class="sub-drop">
                                                                                <ul>
                                                                                    <li ><a href="<?php echo e(url('/subcatproducts/'.$kicks->subcategory_name)); ?>" ><?php echo $kicks->subcategory_name; ?></a></li>

                                                                                </ul>
                                                                            </div>
                                                                        <?php } ?>
                                                                        <div class="clearfix"></div>
                                                                        <?php if ($i == 5) { ?>
                                                                            <?php
                                                                            $i = 0;
                                                                        }
                                                                        ?>

                                                                    </div>


                                                                </div>

<?php } ?>
                                                        </div>


                                                        <!-- mt f box end here -->
                                                    </div>
                                                    <!-- mt frame end here -->
                                                </div>
                                                <!-- mt dropmenu end here -->
                                                <span class="mt-mdropover"></span>
                                            </li>


                                            <li class="drop">
                                                <a href="#">Cisco Wireless <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                                <!-- mt dropmenu start here -->
                                                <div class="mt-dropmenu text-left">
                                                    <!-- mt frame start here -->
                                                    <div class="mt-frame" >
                                                        <!-- mt f box start here -->

                                                        <div class="mt-f-box">
                                                            <?php
                                                            $i = 0;
                                                            foreach ($wireless as $kicks) {

                                                                $i++;
                                                                ?>
                                                                <div class="mt-col-3">
                                                                    <div class="sub-dropcont">
                                                                        <a href="<?php echo e(url('/products/'.$kicks->category_id)); ?>"><strong class="title"><?php echo $kicks->category_name; ?></strong></a>
                                                                        <!-- mt col3 start here -->
                                                                        <?php
                                                                        $subcat = app('App\Http\Controllers\FrontendController')->getSubcategoryData($kicks->category_id);

                                                                        foreach ($subcat as $kicks) {
                                                                            //var_dump($kicks->subcategory_slug); exit;
                                                                            ?>
                                                                            <div class="sub-drop">
                                                                                <ul>
                                                                                    <li ><a href="<?php echo e(url('/subcatproducts/'.$kicks->subcategory_name)); ?>" ><?php echo $kicks->subcategory_name; ?></a></li>

                                                                                </ul>
                                                                            </div>
                                                                        <?php } ?>
                                                                        <div class="clearfix"></div>
                                                                        <?php if ($i == 5) { ?>
                                                                            <?php
                                                                            $i = 0;
                                                                        }
                                                                        ?>

                                                                    </div>


                                                                </div>

<?php } ?>
                                                        </div>


                                                        <!-- mt f box end here -->
                                                    </div>
                                                    <!-- mt frame end here -->
                                                </div>
                                                <!-- mt dropmenu end here -->
                                                <span class="mt-mdropover"></span>
                                            </li>


                                            <li class="drop">
                                                <a href="#">Cisco Accessories <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                                <!-- mt dropmenu start here -->
                                                <div class="mt-dropmenu text-left">
                                                    <!-- mt frame start here -->
                                                    <div class="mt-frame" >
                                                        <!-- mt f box start here -->

                                                        <div class="mt-f-box">
                                                            <?php
                                                            $i = 0;
                                                            foreach ($accessories as $kicks) {

                                                                $i++;
                                                                ?>
                                                                <div class="mt-col-3">
                                                                    <div class="sub-dropcont">
                                                                        <a href="<?php echo e(url('/products/'.$kicks->category_id)); ?>"><strong class="title"><?php echo $kicks->category_name; ?></strong></a>
                                                                        <!-- mt col3 start here -->
                                                                        <?php
                                                                        $subcat = app('App\Http\Controllers\FrontendController')->getSubcategoryData($kicks->category_id);

                                                                        foreach ($subcat as $kicks) {
                                                                            //var_dump($kicks->subcategory_slug); exit;
                                                                            ?>
                                                                            <div class="sub-drop">
                                                                                <ul>
                                                                                    <li ><a href="<?php echo e(url('/subcatproducts/'.$kicks->subcategory_name)); ?>" ><?php echo $kicks->subcategory_name; ?></a></li>

                                                                                </ul>
                                                                            </div>
                                                                        <?php } ?>
                                                                        <div class="clearfix"></div>
                                                                        <?php if ($i == 5) { ?>
                                                                            <?php
                                                                            $i = 0;
                                                                        }
                                                                        ?>

                                                                    </div>


                                                                </div>

<?php } ?>
                                                        </div>


                                                        <!-- mt f box end here -->
                                                    </div>
                                                    <!-- mt frame end here -->
                                                </div>
                                                <!-- mt dropmenu end here -->
                                                <span class="mt-mdropover"></span>
                                            </li>


                                            <li class="drop">
                                                <a href="#">Cisco IP Phones <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                                <!-- mt dropmenu start here -->
                                                <div class="mt-dropmenu text-left">
                                                    <!-- mt frame start here -->
                                                    <div class="mt-frame" >
                                                        <!-- mt f box start here -->

                                                        <div class="mt-f-box">
                                                            <?php
                                                            $i = 0;
                                                            foreach ($ip as $kicks) {

                                                                $i++;
                                                                ?>
                                                                <div class="mt-col-3">
                                                                    <div class="sub-dropcont">
                                                                        <a href="<?php echo e(url('/products/'.$kicks->category_id)); ?>"><strong class="title"><?php echo $kicks->category_name; ?></strong></a>
                                                                        <!-- mt col3 start here -->
                                                                        <?php
                                                                        $subcat = app('App\Http\Controllers\FrontendController')->getSubcategoryData($kicks->category_id);

                                                                        foreach ($subcat as $kicks) {
                                                                            //var_dump($kicks->subcategory_slug); exit;
                                                                            ?>
                                                                            <div class="sub-drop">
                                                                                <ul>
                                                                                    <li ><a href="<?php echo e(url('/subcatproducts/'.$kicks->subcategory_name)); ?>" ><?php echo $kicks->subcategory_name; ?></a></li>

                                                                                </ul>
                                                                            </div>
                                                                        <?php } ?>
                                                                        <div class="clearfix"></div>
                                                                        <?php if ($i == 5) { ?>
                                                                            <?php
                                                                            $i = 0;
                                                                        }
                                                                        ?>

                                                                    </div>


                                                                </div>

<?php } ?>
                                                        </div>


                                                        <!-- mt f box end here -->
                                                    </div>
                                                    <!-- mt frame end here -->
                                                </div>
                                                <!-- mt dropmenu end here -->
                                                <span class="mt-mdropover"></span>
                                            </li>

                                            <li class="drop">
                                                <a href="#">Cisco Meraki <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                                <!-- mt dropmenu start here -->
                                                <div class="mt-dropmenu text-left">
                                                    <!-- mt frame start here -->
                                                    <div class="mt-frame" >
                                                        <!-- mt f box start here -->

                                                        <div class="mt-f-box">
                                                            <?php
                                                            $i = 0;
                                                            foreach ($meraki as $kicks) {

                                                                $i++;
                                                                ?>
                                                                <div class="mt-col-3">
                                                                    <div class="sub-dropcont">
                                                                        <a href="<?php echo e(url('/products/'.$kicks->category_id)); ?>"><strong class="title"><?php echo $kicks->category_name; ?></strong></a>
                                                                        <!-- mt col3 start here -->
                                                                        <?php
                                                                        $subcat = app('App\Http\Controllers\FrontendController')->getSubcategoryData($kicks->category_id);

                                                                        foreach ($subcat as $kicks) {
                                                                            //var_dump($kicks->subcategory_slug); exit;
                                                                            ?>
                                                                            <div class="sub-drop">
                                                                                <ul>
                                                                                    <li ><a href="<?php echo e(url('/subcatproducts/'.$kicks->subcategory_name)); ?>" ><?php echo $kicks->subcategory_name; ?></a></li>

                                                                                </ul>
                                                                            </div>
                                                                        <?php } ?>
                                                                        <div class="clearfix"></div>
                                                                        <?php if ($i == 5) { ?>
                                                                            <?php
                                                                            $i = 0;
                                                                        }
                                                                        ?>

                                                                    </div>


                                                                </div>

<?php } ?>
                                                        </div>


                                                        <!-- mt f box end here -->
                                                    </div>
                                                    <!-- mt frame end here -->
                                                </div>
                                                <!-- mt dropmenu end here -->
                                                <span class="mt-mdropover"></span>
                                            </li>



                                        </ul>
                                    </nav>
                                    <!-- mt icon list end here -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- mt bottom bar end here -->
                    <span class="mt-side-over"></span>
                </header><!-- mt header end here -->
                <!-- mt search popup start here -->
                <div class="mt-search-popup">
                    <div class="mt-holder">
                        <a href="#" class="search-close"><span></span><span></span></a>
                        <div class="mt-frame">
                            <form action="#">
                                <fieldset>
                                    <input type="text" placeholder="Search...">
                                    <span class="icon-microphone"></span>
                                    <button class="icon-magnifier" type="submit"></button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>



                <div id="login-user" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header btn-info">
                                <button type="button" class="close" data-dismiss="modal">x</button>
                                <h4 class="modal-title"  style="color:#fff;" >Customer's account</h4>

                            </div>
                           
                            <div class="modal-body">
                                  <h4 class="alert msg" style="color:red;"></h4>
                                <form class="form-horizontal" action="<?php echo e(url('signIn')); ?>" method="post" id="myForm">


                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="email">Email:</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="email" name="email" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="pwd">Password:</label>
                                        <div class="col-sm-10"> 
                                            <input type="password" class="form-control" id="pwd" name="password" required="">
                                        </div>
                                    </div>
                                    <span id='message'></span>
                                    <div class="form-group"> 
                                        <div class="col-sm-offset-2 col-sm-2">
                                            <button type="button" class="btn btn-info  formsubmitbuttons">Log In</button>
                                        </div>
                                        
                                         <div class=" col-sm-4"> 
                                             <div class="forget-pass">
                                            <a href="#">Forgot password ?</a>
                                           </div>
                                        </div>
                                        
                                        <div class=" col-sm-4"> 
                                            <div class="reg-sec">
                                            <a href="<?php echo e(url('register')); ?>">Register Here</a>
                                            </div>
                                        </div>
                                        
                                    </div>

                                    

                                    


                                </form>


                            </div>

                        </div>

                    </div>
                </div>
