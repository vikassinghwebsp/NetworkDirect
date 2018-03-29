<?php $__env->startSection('content'); ?>
<div id="header_wrapper" class="header-sm">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <header id="header">
                    <h1>Dashboard</h1>
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
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card app_accent_bg">
                    <div class="card-body p-b-0">
                        <div class="text-left">
                            <h3 class="m-0 text-white">Total Products Created</h3>
                            <span class="text-white block m-b-20"><?php echo e((!empty($arrContent['products']->count))?$arrContent['products']->count:0); ?></span>
                        </div>
                    </div>
                    <div class="card-footer p-5">
                        <ul class="card-actions left-bottom">
                            <li>
                                <a href="<?php echo e(url('backend/product')); ?>" class="btn btn-default btn-flat text-white">
                                    View Details
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card app_primary_bg">
                    <div class="card-body p-b-0">
                        <div class="text-left">
                            <h3 class="m-0 text-white">Last 5 Orders</h3>
                            <span class="text-white block m-b-20"><?php echo e((!empty($arrContent['orders']))?count($arrContent['orders']):0); ?></span>
                        </div>
                    </div>
                    <div class="card-footer p-5">
                        <ul class="card-actions left-bottom">
                            <li>
                                <a href="<?php echo e(url('backend/lastOrders')); ?>" class="btn btn-default btn-flat text-white">
                                    View Details
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card app_accent_bg" style="background-color: #ec407a !important;">
                    <div class="card-body p-b-0">
                        <div class="text-left">
                            <h3 class="m-0 text-white">Life Time Sales</h3>
                            <span class="text-white block m-b-20">$<?php echo e((!empty($arrContent['total_sale'])) ? sprintf('%0.2f', $arrContent['total_sale']) : ''); ?></span>
                        </div>
                    </div>
                    <div class="card-footer p-5">
                        <ul class="card-actions left-bottom">
<!--                            <li>
                                <a href="<?php echo e(url('backend/store')); ?>" class="btn btn-default btn-flat text-white">
                                    View Details
                                </a>
                            </li>-->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
            </div>
        </div>
        <?php $__env->stopSection(); ?>
<?php echo $__env->make('backend._layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>