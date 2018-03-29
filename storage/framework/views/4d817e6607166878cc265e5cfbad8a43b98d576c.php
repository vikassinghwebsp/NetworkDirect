<?php echo $__env->make('frontend.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

<div class="container content profile">
<?php if(Session::has('error')): ?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">×</span>
                <span class="sr-only">Close</span>
            </button>
            <strong>Error!</strong> <?php echo e(Session::get('error')); ?>

        </div>
        <?php endif; ?>
        <?php if(Session::has('success')): ?>
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">×</span>
                <span class="sr-only">Close</span>
            </button>
            <strong><?php echo e(Session::get('success')); ?></strong> 
        </div>
        <?php endif; ?>

    <div class="col-sm-3">
        <div class="user-panel">
            <div class="margin-bottom-20">
                <h3>Customer panel</h3>
            </div>
            <div class="margin-bottom-20">
                <h4>Orders</h4>
                <ul class="list-unstyled">
                    <li><a href="<?php echo e(url('myaccount/order-history')); ?>">History </a></li>
                </ul>
            </div>
<!--            <div class="margin-bottom-20">
                <h4>Inquiries</h4>
                <ul class="list-unstyled">
                    <li><a href="offer-history.html">History</a></li>
                </ul>
            </div>-->

            <div class="margin-bottom-20">
                <h4>Manage your account</h4>
                <ul class="list-unstyled mng-acc">


                    <li><a href="<?php echo e(url('myaccount/my-details')); ?>">My Details</a></li>
                    <li><a href="<?php echo e(url('myaccount/shipping-address')); ?>">Shipping Address</a></li>
<!--                    <li><a href="#">Enduser data</a></li>-->
                    <li><a href="<?php echo e(url('myaccount/payment-methods')); ?>">Payment and delivery methods</a></li>
                    <li><a href="<?php echo e(url('myaccount/change-password')); ?>">Change password</a></li>
                </ul>
            </div>

<!--            <div class="margin-bottom-30">
                <h4>RMA Form</h4>
                <ul class="list-unstyled">


                    <li><a href="rma.html"> Send request</a></li>

                </ul>
            </div>-->

        </div>

    </div>
    <!-- tab content -->
    <div class="col-sm-9">
        <div class="panel-content">
            <h2 class="heading-md">Orders – History</h2>
            <ul class="list-inline">
                <li>Home ></li>  <li>Orders  - History</li>

            </ul>

            <div class="table-responsive">
                <table class="table table-hover  table-striped">
                    <thead>
                        <tr>
                            <th>Order Id</th>
                            <th>Your Name</th>
                            <th>Product Name</th>
                            <th class="hidden-sm">Contact Number</th>
                            <th>Address</th>
                            <th>City</th>

                            <th>Postal Code</th>
                        </tr>
                    </thead>
                    <tbody>
                         <?php if(!empty($orders)): ?>
                       <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e((!empty($item->order_id))?$item->order_id:''); ?></td>
                            <td><?php echo e((!empty($item->full_name))?$item->full_name:''); ?></td>
                            <td>
                                <a href="#"><?php echo e((!empty($item->product_name))?$item->product_name:''); ?></a>
                            </td>
                            <td><?php echo e((!empty($item->mobile_no))?$item->mobile_no:''); ?></td>
                            <td><?php echo e((!empty($item->address1))?$item->address1:''); ?> <?php echo e((!empty($item->address2))?$item->address2:''); ?></td>
                            <td>
                                <?php echo e((!empty($item->city))?$item->city:''); ?>

                            </td>
                            <td><?php echo e((!empty($item->postal_code))?$item->postal_code:''); ?></td>

                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                    
                    <tr><td colspan="6" style="text-align: center"><h2>No Record Found</h2></td></tr>
                    
                    <?php endif; ?>
                       

                    </tbody>
                </table>
            </div>


        </div>


    </div>


</div>
<?php echo $__env->make('frontend.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;