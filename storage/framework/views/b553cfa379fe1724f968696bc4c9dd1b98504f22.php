<?php

$address = app('App\Http\Controllers\Backend\BackendController')->getAddressData();
$social = app('App\Http\Controllers\Backend\BackendController')->getSocialMediaData();

//var_dump($address[0]->address);exit;

?>
<footer id="mt-footer" class="style2 wow " data-wow-delay="0.3s">
    <!-- F Promo Box of the Page -->
    <aside class="f-promo-box dark">
        <div class="container divider">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-4 mt-paddingbottomsm">
                    <!-- F Widget Item of the Page -->
                    <div class="f-widget-item">
                        <span class="widget-icon"><i class="fa fa-plane"></i></span>
                        <div class="txt-holder">
                            <h1 class="f-promo-box-heading">FREE SHIPPING</h1>
                            <p>Free shipping on all US order</p>
                        </div>
                    </div>
                    <!-- F Widget Item of the Page end -->
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4 mt-paddingbottomsm">
                    <!-- F Widget Item of the Page -->
                    <div class="f-widget-item">
                        <span class="widget-icon"><i class="fa fa-life-ring"></i></span>
                        <div class="txt-holder">
                            <h1 class="f-promo-box-heading">SUPPORT 24/7</h1>
                            <p>We support 24 hours a day</p>
                        </div>
                    </div>
                    <!-- F Widget Item of the Page -->
                </div>
                
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <!-- F Widget Item of the Page -->
                    <div class="f-widget-item">
                        <span class="widget-icon"><i class="fa fa-money"></i></span>
                        <div class="txt-holder">
                            <h1 class="f-promo-box-heading">PAYMENT 100% SECURE</h1>
                            <p>Payment 100% secure</p>
                        </div>
                    </div>
                    <!-- F Widget Item of the Page -->
                </div>
            </div>
        </div>
    </aside>
    <!-- F Promo Box of the Page end -->
    <!-- Footer Holder of the Page -->
    <div class="footer-holder dark">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-5 col-md-4 mt-paddingbottomxs">
                    <!-- F Widget About of the Page -->
                    <div class="f-widget-about">
                        <div class="logo">
                            <a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(URL::asset('public/assets/images/logo.png')); ?>" alt="logo"></a>
                        </div>
                        
                        <ul class="list-unstyled address-list">
                            <li><i class="fa fa-map-marker"></i><address><?php echo(!empty($address[0]->address)?$address[0]->address:'') ?></address></li>
                            <li><i class="fa fa-phone"></i><a href="tel:<?php echo (!empty($address[0]->contact_no)?$address[0]->contact_no:'') ?>"><?php echo (!empty($address[0]->contact_no)?$address[0]->contact_no:'') ?></a></li>
                            <li><i class="fa fa-envelope-o"></i>
                                <a href="mailto:info@example.com"> <?php echo (!empty($address[0]->official_email)?$address[0]->official_email:''); ?></a></li>
                        </ul>
                    </div>
                    <!-- F Widget About of the Page -->
                </div>
                <nav class="col-xs-12 col-sm-7 col-md-5 mt-paddingbottomxs">
                    <!-- Footer Nav of the Page -->
                    <div class="nav-widget-1">
                        <h3 class="f-widget-heading">Categories</h3>
                        <ul class="list-unstyled f-widget-nav">
                            <li><a href="<?php echo e(url('/menuproducts/'.'CISCO SWITCHES')); ?>">CISCO SWITCHES</a></li>
                            <li><a href="<?php echo e(url('/menuproducts/'.'CISCO ROUTERS')); ?>">CISCO ROUTERS</a></li>
                            <li><a href="<?php echo e(url('/menuproducts/'.'CISCO SECURITY')); ?>">CISCO SECURITY</a></li>
                            <li><a href="<?php echo e(url('/menuproducts/'.'CISCO WIRELESS')); ?>">CISCO WIRELESS</a></li>
                            <li><a href="<?php echo e(url('/menuproducts/'.'CISCO ACCESSORIES')); ?>">CISCO ACCESSORIES</a></li>
                            <li><a href="<?php echo e(url('/menuproducts/'.'CISCO IP PHONES')); ?>">CISCO IP PHONES</a></li>
                            <li><a href="<?php echo e(url('/menuproducts/'.'CISCO MERAKI')); ?>">CISCO MERAKI</a></li>
                        </ul>
                    </div>
                    <!-- Footer Nav of the Page end -->
                    <!-- Footer Nav of the Page -->
                    <div class="nav-widget-1">
                        <h3 class="f-widget-heading">Information</h3>
                        <ul class="list-unstyled f-widget-nav">
                            <li><a href="<?php echo e(url('about')); ?>">About Us</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="<?php echo e(url('terms')); ?>">Terms &amp; Conditions</a></li>
<!--                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Customer Service</a></li>
                            <li><a href="#">FAQs</a></li>-->
                        </ul>
                    </div>
                    <!-- Footer Nav of the Page end -->
                    <!-- Footer Nav of the Page -->
                    <?php
                    if (Session::get('user')) {
                        $sessionData = Session::get('user');
                        //var_dump($sessionData[0][0]->full_name);exit;
                        ?>
                        <div class="nav-widget-1">
                            <h3 class="f-widget-heading">Account</h3>
                            <ul class="list-unstyled f-widget-nav">
                                <li><a href="<?php echo e(url('myaccount/order-history')); ?>">My Account</a></li>


                                <!--                            <li><a href="#">Shopping Cart</a></li>
                                                            <li><a href="#">Checkout</a></li>-->
                            </ul>
                        </div>
                    <?php } ?>
                    <!-- Footer Nav of the Page end -->
                </nav>
                <div class="col-xs-12 col-md-3 text-right hidden-sm">
                    <!-- F Widget Newsletter of the Page -->
                    <div class="f-widget-newsletter">
                        <h3 class="f-widget-heading">Sign Up Newsletter</h3>
                        <div class="holder">
                            <form class="newsletter-form form2" action="<?php echo e(url('subscribe')); ?>" method="post">
                                <fieldset>
                                    <input type="email" class="form-control" name="subs_email" placeholder="Your e-mail">
                                    <button type="submit">Subscribe</button>
                                </fieldset>
                            </form>
                        </div>
                        <!-- F Widget Newsletter of the Page end -->
                        <h4 class="f-widget-heading follow">Follow Us</h4>
                        <!-- Social Network of the Page -->
                        <ul class="list-unstyled social-network social-icon">
                            <li><a href="<?php echo (!empty($social[0]->twitter)?$social[0]->twitter:''); ?>"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="<?php echo (!empty($social[0]->facebook)?$social[0]->facebook:''); ?>"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="<?php echo (!empty($social[0]->facebook)?$social[0]->googleplus:''); ?>"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="<?php echo (!empty($social[0]->facebook)?$social[0]->youtube:''); ?>"><i class="fa fa-youtube"></i></a></li>
                            <li><a href="<?php echo (!empty($social[0]->facebook)?$social[0]->linkedin:''); ?>"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="tel:<?php echo (!empty($social[0]->facebook)?$social[0]->whatsapp:''); ?>"><i class="fa fa-whatsapp"></i> </a></li>
                        </ul>
                        <!-- Social Network of the Page end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Holder of the Page end -->
    <!-- Footer Area of the Page -->
    <div class="footer-area">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <p>© <a href="#">Networks Direct</a> - All rights Reserved Developed By -<a href="http://www.webspreadtech.com">WebSpreadTech</a></p>
                </div>
                <div class="col-xs-12 col-sm-6 text-right">
                    <div class="bank-card">
                        <img src="<?php echo e(URL::asset('public/assets/images/bank-card.png')); ?>" alt="bank-card">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Area of the Page end -->
</footer>
<!-- footer of the Page end -->
</div>
<!-- W1 end here -->
<span id="back-top" class="fa fa-arrow-up"></span>
</div>

<!-- Popup Holder of the Page -->
<!-- Popup Holder of the Page end -->
<!-- include jQuery -->
<script src="<?php echo e(URL::asset('public/assets/js/jquery.js')); ?>"></script>
<!-- include jQuery -->
<script src="<?php echo e(URL::asset('public/assets/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('public/assets/js/plugins.js')); ?>"></script>
<script src="<?php echo e(URL::asset('public/assets/js/jquery-migrate.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('public/assets/js/jquery.mCustomScrollbar.concat.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('public/assets/js/jquery.validate.min.js')); ?>"></script>
<!-- include jQuery -->

<script src="<?php echo e(URL::asset('public/assets/js/jquery.main.js')); ?>"></script>
<script src="<?php echo e(URL::asset('public/assets/js/page_login.js')); ?>"></script>
<script src="<?php echo e(URL::asset('public/assets/js/shop.app.js')); ?>"></script>
<script src="<?php echo e(URL::asset('public/assets/js/jquery.steps.js')); ?>"></script>
<script src="<?php echo e(URL::asset('public/assets/js/stepWizard.js')); ?>"></script>
<script src="<?php echo e(URL::asset('public/assets/js/product-quantity.js')); ?>"></script>

<script src="<?php echo e(URL::asset('public/assets/js/jquery.fancybox.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('public/assets/js/custom.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('public/assets/js/curry.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('public/assets/js/bootbox.min.js')); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>

<script>
$(document).ready(function () {

    $(document).ready(function () {
        $(".fancybox").fancybox();
    });




// Launch MODAL BOX if the Login Link is clicked

    $("#login_link").click(function () {
        $('#login-user').modal();
    });
});
</script>
<script type="text/javascript">

    $('document').ready(function () {

        var savedRate = Cookies.get('site_rate') || 1;
        var savedCurrency = Cookies.get('site_currency') || 'USD';


        var customCurrency = {
            'USD': 1,
            'GBP': 0.71,
            'EUR': 0.80
        };

        var symbols = {
            'USD': '$ ',
            'GBP': '£ ',
            'EUR': '€ '
        }
        $(function () {
            $('#my-element').curry({
                change: true,
                base: savedCurrency,
                symbols: symbols,
                target: '.price',
                //customCurrency: customCurrency
            }).change(function () {
                var selected = $(this).find(':selected'), // get selected currency
                        rate = selected.data('rate'), // get currency rate
                        // rate = rate + 500;
                        currency = selected.val(); // get currency name
                //console.log(rate);
                var APP_URL = <?php echo json_encode(url('curr')); ?>

                //alert(APP_URL);
                $.ajax({
                    type: "POST",
                    url: APP_URL,
                    data: {currency: currency, rate: rate},
                    success: function (response) {
                        //alert(response);
                    }
                });
                Cookies.remove('site_currency', {path: ''});
                //Cookies.remove('site_rate', {path: ''});
                Cookies.set('site_currency', currency, {expires: 7, path: '/'});
                //Cookies.set('site_rate', rate, {expires: 7, path: '/'});

            });
        });



        var CookieSet = Cookies.get('site_currency')

        if (CookieSet == 'undefined') {
            savedRate = 1;
            savedCurrency = '$ USD';
            //console.log('CookieSet Empty. Set to ' + savedCurrency);
        } else {
            savedRate = Cookies.get('site_rate');
            savedCurrency = Cookies.get('site_currency');
            //console.log(savedCurrency, savedRate);
            //console.log('CookieSet readed from cookie. Saved Rate: ' + savedRate + ' Saved currency: ' + savedCurrency);
        }

        //$('#my-element').val(savedCurrency);


    });

</script>
<script>

    $(".formsubmitbuttons").click(function (event) {
        
        event.preventDefault(); //prevent default action 
        var email = $('#email').val(); //get form action url
        var password = $('#pwd').val(); //get form GET/POST method

        var BASE_URL = <?php echo json_encode(url('signIn')); ?>


        $.ajax({
            url: BASE_URL,
            type: "POST",
            data: {email: email, password: password}
        }).done(function (response) {
            //alert(response);
            if (response == '2')
                $('.msg').html('Invalid Password You have entered');

            else if (response == '3')
                $('.msg').html('You are not registered with us. Please Sign Up');

            else
                location.reload();



        })
                .fail(function (data) {
                    alert(data);
                });

    });
    
    
    
   
</script>

</body>
</html>