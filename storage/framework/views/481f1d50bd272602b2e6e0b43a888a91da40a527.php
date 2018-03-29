<?php $__env->startSection('content'); ?>
<div id="header_wrapper" class="header-sm">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <header id="header">
                    <h1>All Orders List</h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo e(url('backend/')); ?>">Dashboard</a></li>
                        <li class="active">Orders</li>
                    </ol>
                </header>
            </div>
        </div>
    </div>
</div>

<div id="content" class="container-fluid">
    <div class="content-body">
        <div class="col-xs-12 col-sm-12 col-md-12">
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
                <strong>Well Done !! </strong> <?php echo e(Session::get('success')); ?>

            </div>
            <?php endif; ?>
            <div class="card">
                <header class="card-heading ">
                    <h2 class="card-title">Orders</h2>
                    <p>All Orders List will show here</p>

                </header>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order ID</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Customer Name</th>
                                    <th>Order Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($arrContent['orders'])): ?>
                                <?php
                                if (!empty($_GET['page']) && $_GET['page'] > 1) {
                                    $i = 15;
                                    $i = $i * ($_GET['page'] - 1) + 1;
                                } else {
                                    $i = 1;
                                }
                                ?>
                                <?php $__currentLoopData = $arrContent['orders']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orders): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr>
                                    <th scope="row"><?php echo e($i++); ?></th>
                                    <td><?php echo e((!empty($orders->order_id))?$orders->order_id:''); ?></td>
                                    <td><?php echo e((!empty($orders->product_name))?$orders->product_name:''); ?></td>
                                    <td>$<?php echo e((!empty($orders->total_price))?$orders->total_price:''); ?></td>
                                    <td><?php echo e((!empty($orders->full_name))?$orders->full_name:''); ?></td>
                                    <td>
                                        <?php
                                        $newDate = date("d-M-Y ", strtotime($orders->order_date));
                                        echo $newDate;
                                        ?>
                                    </td>

                                    <td>
                                        <select class="dropdown" id="order_status">
                                            <option value="1" <?php if ($orders->status == '1') { ?> selected="selected"<?php } ?>>In Process</option>
                                            <option value="2" <?php if ($orders->status == '2') { ?> selected="selected"<?php } ?>>Dispatch</option>
                                            <option value="3" <?php if ($orders->status == '3') { ?> selected="selected"<?php } ?>>Delivered</option>
                                        </select>
                                        <input type="hidden" value="<?php echo e((!empty($orders->order_id))?$orders->order_id:''); ?>" name="order_id" id="order_id">
                                        <input type="hidden" value="<?php echo e((!empty($orders->email))?$orders->email:''); ?>" name="email_id" id="email_id">
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                <tr><td colspan="8" style="text-align: center"><h2>No Record Found</h2></td></tr>
                                <?php endif; ?>

                            </tbody>
                        </table>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Confirmation Modeal -->
<button style="display: none" class="btn btn-primary btn-block cat_remove_modal" data-toggle="modal" data-target="#toolabr_modal">Trigger</button>
<div class="modal fade" id="toolabr_modal" tabindex="-1" role="dialog" aria-labelledby="toolabr_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="card m-0">
                <header class="card-heading p-b-20">
                    <h2 class="card-title">Confirmation</h2>

                    <ul class="card-actions icons right-top">

                        <li>
                            <a href="javascript:void(0)" data-dismiss="modal" aria-label="Close">
                                <i class="zmdi zmdi-close"></i>
                            </a>
                        </li>
                    </ul>
                </header>
            </div>
            <div class="modal-body">
                <p>Are your sure ! want remove this category?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Cancel</button>
                <a href="" class="btn btn-primary cat_remove_href">Yes ! i am sure</a>
            </div>
        </div>
        <!-- modal-content -->
    </div>
    <!-- modal-dialog -->
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend._layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>