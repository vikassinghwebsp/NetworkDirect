@include('frontend.header');
<div class="content container">


   

       

            


            <?php
            if (Session::get('user')) {
                $sessionData = Session::get('user');
                $invoiceAddress = \App\library\Customlibrary::getUserInvoice($sessionData[0]->id);
                //var_dump($sessionData);exit;
                ?>
                <label class="checkbox text-left" style="padding-left: 35px;">
                    <input type="checkbox" name="checkbox" onclick="SetBilling(this.checked);" value="yes"/>
                    <i></i>
                    Ship item to the above billing address
                </label>
                <div class="col-md-6 md-margin-bottom-40">
                    <h2 class="title-type">Billing Address</h2>
                    <div class="billing-info-inputs checkbox-list">


                        <input id="name" type="text" value="{{ (!empty($invoiceAddress->full_name))?$invoiceAddress->full_name:'' }}" placeholder="First Name" name="full_name" class="form-control required" >

                        <div class="row">
                            <div class="col-sm-6">
                                <input id="email" type="text" value="{{ (!empty($invoiceAddress->email))?$invoiceAddress->email:'' }}" placeholder="Email" name="email" class="form-control required email">

                            </div>
                            <div class="col-sm-6">
                                <input id="phone" type="tel" value="{{ (!empty($invoiceAddress->mobile_no))?$invoiceAddress->mobile_no:'' }}" placeholder="Phone" name="mobile_no" class="form-control required">
                            </div>
                        </div>
                        <input id="billingAddress" type="text" value="{{ (!empty($invoiceAddress->address1))?$invoiceAddress->address1:'' }}" placeholder="Address Line 1" name="address1" class="form-control required">
                        <input id="billingAddress2" type="text" value="{{ (!empty($invoiceAddress->address2))?$invoiceAddress->address2:'' }}" placeholder="Address Line 2" name="address2" class="form-control required">
                        <div class="row">
                            <div class="col-sm-6">
                                <input id="city" type="text" value="{{ (!empty($invoiceAddress->city))?$invoiceAddress->city:'' }}" placeholder="City" name="city" class="form-control required">
                            </div>
                            <div class="col-sm-6">
                                <input id="zip" type="text" value="{{ (!empty($invoiceAddress->postal_code))?$invoiceAddress->postal_code:'' }}" placeholder="Zip/Postal Code" name="postal_code" class="form-control required">
                            </div>
                        </div>
                        <input id="country" type="text" value="{{ (!empty($invoiceAddress->country))?$invoiceAddress->country:'' }}" placeholder="Address Line 2" name="country" class="form-control required">


                    </div>
                </div>

                <div class="col-md-6">

                    <h2 class="title-type">Shipping Address</h2>
                    <form method="post" id="shipping_address" action="{{ url('payment') }}">
                        <div class="billing-info-inputs checkbox-list">

                            <input id="shippingName" type="text"  placeholder=" Name" name="shippingName" class="form-control required" value="<?php
                            if ($invoiceAddress->invoice_address == '1') {
                                echo $invoiceAddress->full_name;
                            }
                            ?>">

                            <div class="row">
                                <div class="col-sm-6">
                                    <input id="shippingEmail" type="text"  placeholder="Email" name="shippingEmail" class="form-control required email" value="<?php
                                    if ($invoiceAddress->invoice_address == '1') {
                                        echo $invoiceAddress->email;
                                    }
                                    ?>">

                                </div>
                                <div class="col-sm-6">
                                    <input id="shippingPhone" type="tel" placeholder="Phone" name="shippingPhone" class="form-control required" value="<?php
                                    if ($invoiceAddress->invoice_address == '1') {
                                        echo $invoiceAddress->mobile_no;
                                    }
                                    ?>">
                                </div>
                            </div>
                            <input id="shippingAddress" type="text" placeholder="Address Line 1" name="shippingAddress" class="form-control required" value="<?php
                            if ($invoiceAddress->invoice_address == '1') {
                                echo $invoiceAddress->address1;
                            }
                            ?>">
                            <input id="shippingAddress2" type="text"  placeholder="Address Line 2" name="shippingAddress2" class="form-control required" value="<?php
                            if ($invoiceAddress->invoice_address == '1') {
                                echo $invoiceAddress->address2;
                            }
                            ?>">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input id="shippingCity" type="text" placeholder="City" name="shippingCity" class="form-control required" value="<?php
                                    if ($invoiceAddress->invoice_address == '1') {
                                        echo $invoiceAddress->city;
                                    }
                                    ?>">
                                </div>
                                <div class="col-sm-6">
                                    <input id="shippingZip" type="text"  placeholder="Zip/Postal Code" name="shippingZip" class="form-control required" value="<?php
                                    if ($invoiceAddress->invoice_address == '1') {
                                        echo $invoiceAddress->postal_code;
                                    }
                                    ?>">
                                </div>
                            </div>
                            <input id="shippingCountry" type="text" placeholder="Country" name="shippingCountry" class="form-control required" value="<?php
                            if ($invoiceAddress->invoice_address == '1') {
                                echo $invoiceAddress->country;
                            }
                            ?>">
                        </div>
                        <input type="submit" style="display:none" />
                    </form>
                </div>
    <div class="add-to-cart-footer">

                <div class="column text-lg">Subtotal: <span class="text-medium btn btn-success price"><?php
                                                if (Session::get('money')) {
                                                    $userData = Session::get('money');
                                                    $curr = $userData[0]['currency'];
                                                    $currency = strtolower($curr);
                                                    echo "<i class='fa fa-$currency'></i>";
                                                } else {
                                                    echo '<i class="fa fa-usd"></i>';
                                                }
                                                ?> {{Cart::subtotal()}}</span></div>
            </div>


           <div class="checkout-footer">
                <div class="column"><a class="btn btn-outline-secondary" href="{{ url('cart') }}"><i class="icon-arrow-left"></i><span class="hidden-xs-down">&nbsp;Back To Cart</span></a></div>
                <div class="column" id="paymentbtn"><a class="btn btn-primary" ><span class="hidden-xs-down">Continue&nbsp;</span><i class="icon-arrow-right"></i></a></div>
            </div>
            <?php } else { ?>
                <div class="container">    
                    <div id="loginbox"  class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
                        <div class="panel panel-info" >
                            <div class="panel-heading">
                                <div class="panel-title">Login</div>
                                <div style="float:right; font-size: 80%; position: relative; top:-10px"></div>
                            </div>     

                            <div style="overflow:auto; padding:30px;" class="panel-body" >
                                @if(Session::has('success'))
                                <div class="alert alert-success">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Success!</strong> {{ Session::get('success') }}.
                                </div>

                                @endif
                                @if(Session::has('error'))
                                <div class="alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Error!</strong> {{ Session::get('error') }}.
                                </div>
                                @endif
                                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                                <form method="POST" action="{{ url('signIn') }}">


                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input id="login-username" type="text" class="form-control" name="email" value="" placeholder="Email">                                        
                                    </div>

                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                        <input id="login-password" type="password" class="form-control" name="password" placeholder="Password">
                                    </div>





                                    <div class="row margin-bottom-10">
                                       

                                        <div class="col-sm-12 controls">
                                            <input id="btn-login" href="#" class="btn btn-info" type="submit" value="Login" name="cart_login">
                                            

                                        </div>
                                    </div>

                               <div class="row">


                                    <div class="col-md-6 control text-center">
                                        <div style="border-top: 1px solid #ccc;  font-size:85%" >

                                            <h4 class="widget-title">New User? <a href="{{ url('register') }}">Register Here</a></h4>


                                        </div>
                                    </div>
                                       

                                    <div class="col-md-6 control text-center">
                                        <div style="border-top: 1px solid #ccc; font-size:100%" >

                                            <h4>Forget Password?  <a href="#" > Click here</a></h4>
                                        </div>
                                    </div>


                                </div>   

                                </form>
                                

                                




                            </div>                     
                        </div>  
                    </div>
                    
                    
                    

                </div>


            <?php } ?>
            
        
   


</div>
<script type="text/javascript">

    function SetBilling(checked) {

        if (checked) {
            document.getElementById('shippingName').value = document.getElementById('name').value;
            document.getElementById('shippingEmail').value = document.getElementById('email').value;
            document.getElementById('shippingPhone').value = document.getElementById('phone').value;
            document.getElementById('shippingCity').value = document.getElementById('city').value;
            document.getElementById('shippingZip').value = document.getElementById('zip').value;
            document.getElementById('shippingAddress').value = document.getElementById('billingAddress').value;
            document.getElementById('shippingAddress2').value = document.getElementById('billingAddress2').value;
            document.getElementById('shippingCountry').value = document.getElementById('country').value;
        } else {
            document.getElementById('BillingAddress').value = '';
            document.getElementById('BillingCity').value = '';
            document.getElementById('BillingState').value = '';
            document.getElementById('BillingZip').value = '';
            document.getElementById('BillingCountry').value = '';
        }
    }



</script>

@include('frontend.footer');
<script>
    $(document).ready(function () {
        $("#paymentbtn").click(function () {
            $("#shipping_address").submit();
             var data =  $('#form0').serialize();
              $.ajax({
      type: "POST",
      url: $('form').attr("action"),   
      data: {data:data},
      success: function (result) {
         // do somthing here
      }
 });
            console.log(data);exit;
        });
    });
</script>