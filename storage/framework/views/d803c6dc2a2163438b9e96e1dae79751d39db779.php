<?php $__env->startSection('content'); ?>
<?php 
$arrCouponType = \App\library\Customlibrary::getCouponType();
?>
<div id="header_wrapper" class="header-sm">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <header id="header">
                    <h1>Add Products</h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo e(url('backend/')); ?>">Dashboard</a></li>
                        <li><a href="<?php echo e(url('backend/coupon')); ?>">Products</a></li>
                        <li class="active">Add Products</li>
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
            <form method="POST" enctype="multipart/form-data" action="">
                <div class="card">
                    <header class="card-heading p-b-0 ">
                        <h2 class="card-title">New Product</h2>
                        <ul class="card-actions icons right-top">
                        </ul>
                    </header>
                    <div class="card-body">

                        <div class="form-group is-empty">
                            <div class="input-group">
                                <label class="control-label">Product CSV</label>
                                <input type="file" class="form-control" placeholder="File Upload..." name="csv_file">
                                <div class="input-group">
                                    <input type="text" readonly="" class="form-control" placeholder="Upload one or more files...">
                                    <span class="input-group-btn input-group-sm">
                                        <button type="button" class="btn btn-primary btn-fab btn-fab-sm">
                                            <i class="zmdi zmdi-attachment-alt"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                       
                    <div class="card-footer text-right">
                        <button class="btn btn-primary btn-flat ">Reset</button>
                        <button class="btn btn-primary" type="submit">Import File</button>
                    </div>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('extraContent'); ?>
<script src="<?php echo e(url('public/backend/js/tinymce')); ?>/tinymce.min.js"></script>
<script>tinymce.init({ selector:'#terms' });</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend._layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>