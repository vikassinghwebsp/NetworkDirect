<?php echo $__env->make('frontend.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;


<div class="register-sec">      
    <div class="container">  
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
        <form class="form-horizontal" action="" method="POST" id="registrationForm">

            <div class="row">
                <div class="col-md-6">

                    <div class="form-group">

                        <div class="col-sm-12"> 
                            <h4>Account details:</h4>
                        </div>
                    </div>
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
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Confirm Password:</label>
                        <div class="col-sm-10"> 
                            <input type="password" class="form-control" id="cpwd" name="cpassword" required="">
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">

                        <div class="col-sm-12"> 
                            <div class="form-group">

                                <div class="col-sm-12"> 
                                    <h4>Customer type :</h4>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12"> 
                                    <div class="radio">
                                        <label><input type="radio" name="optradio">Company(If You are a Company)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="radio">
                                        <label><input type="radio" name="user" checked="">Individual customer</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-md-6">

                    <div class="form-group">

                        <div class="col-sm-12"> 
                            <h4>Invoice data:</h4>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Name and surname :</label>
                        <div class="col-sm-10"> 
                            <input type="text" class="form-control" id="name" name="fullname" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Telephone :</label>
                        <div class="col-sm-10"> 
                            <input type="text" class="form-control" id="Telephone" name="mobile_no" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Company name : </label>
                        <div class="col-sm-10"> 
                            <input type="text" class="form-control" id="Company" name="company_name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Address line 1:</label>
                        <div class="col-sm-10"> 
                            <textarea  class="form-control" name="address1" required=""></textarea>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Address line 2:</label>
                        <div class="col-sm-10"> 
                            <textarea  class="form-control" name="address2"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">City:</label>
                        <div class="col-sm-10"> 
                            <input type="text" class="form-control" id="City" name="city" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Postcode:</label>
                        <div class="col-sm-10"> 
                            <input type="text" class="form-control" id="Postcode" name="postal_code" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="Country">Country:</label>
                        <div class="col-sm-10"> 
                            <select class="form-control" name="country">
                                <option value="">Country...</option>
                                <?php if(!empty($country)): ?>
                                <?php $__currentLoopData = $country; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $countries): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e((!empty($countries->country_code))?$countries->country_code:''); ?>"><?php echo e((!empty($countries->country_name))?$countries->country_name:''); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Tax reg. no:</label>
                        <div class="col-sm-10"> 
                            <input type="text" class="form-control" id="Tax" name="tax_reg_no">
                        </div>
                    </div>

                    <div class="form-group"> 
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label><input type="checkbox" name="agree" value="yes" required=""> I agree to receive electronic invoices.</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group"> 
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label><input type="checkbox" name="confirm" value="yes" required=""> I confirm that I have read and accept the <a href="#"> terms and conditions</a> of the eshop online shop.</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group"> 
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-info">Register</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6"> 
                    <div class="form-group">

                        <div class="col-sm-12"> 
                            <h4>Delivery details:</h4>
                        </div>
                    </div>

                    <div class="col-sm-12"> 
                        <div class="checkbox">
                            <label><input type="checkbox" name="invoice_address" value="yes">The same as invoice address</label>
                        </div>
                    </div>



                </div>


            </div> 



        </form>


    </div>
</div>

<?php echo $__env->make('frontend.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;
<script>
    $('#registrationForm').formValidation({

        fields: {

            confirm: {
                validators: {
                    notEmpty: {
                        message: 'You must agree with the terms and conditions'
                    }
                }
            }
        }
    });


</script>