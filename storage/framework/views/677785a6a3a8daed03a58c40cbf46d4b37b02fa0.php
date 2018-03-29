<?php $__env->startSection('content'); ?>
<?php
$arrCouponType = \App\library\Customlibrary::getCouponType();
?>
<div id="header_wrapper" class="header-sm">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <header id="header">
                    <h1>Add About Us</h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo e(url('backend/')); ?>">Dashboard</a></li>
                        <li><a href="<?php echo e(url('backend/coupon')); ?>">About Us</a></li>
                        <li class="active">Add About Us</li>
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
            <form method="post" enctype="multipart/form-data">
                <div class="card">
                    <header class="card-heading p-b-0 ">
                        <h2 class="card-title">New About Us</h2>
                        <ul class="card-actions icons right-top">
                        </ul>
                    </header>
                    <div class="card-body">

                        <div class="form-group label-floating is-empty">
                            <label class="control-label">Title</label>
                            <?php //var_dump($arrContent['aboutData'][0]); ?>
                            <input type="text" name="title" class="form-control" value="<?php echo e(!empty($arrContent['aboutData'][0]->aboutus_title)?$arrContent['aboutData'][0]->aboutus_title:''); ?>">
                        </div>

                        <div class="form-group is-empty">
                            <div class="input-group">
                                <label class="control-label">About us Image</label>
                                <input type="file" class="form-control" placeholder="File Upload..." name="aboutus_image">
                                <div class="input-group">
                                    <input type="text" readonly="" class="form-control" placeholder="Upload one or more files..." value="<?php echo e(!empty($arrContent['aboutData'][0]->aboutus_image)?$arrContent['aboutData'][0]->aboutus_image:''); ?>">
                                    <span class="input-group-btn input-group-sm">
                                        <button type="button" class="btn btn-primary btn-fab btn-fab-sm">
                                            <i class="zmdi zmdi-attachment-alt"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group label-floating is-empty">
                            <label for="textArea" class="control-label"> Description</label>
                        </div>
                        <input type="hidden" name="about_id" value="<?php echo e(!empty($arrContent['aboutData'][0]->id)?$arrContent['aboutData'][0]->id:''); ?>">
                        <div class="form-group label-floating is-empty">
                            <textarea class="form-control" name="description" rows="4" id="terms"> <?php echo e(!empty($arrContent['aboutData'][0]->aboutus_desc)?$arrContent['aboutData'][0]->aboutus_desc:''); ?></textarea>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary btn-flat ">Reset</button>
                        <?php
                        if (!empty($arrContent['aboutData'])) {
                            ?>
                            <button class="btn btn-primary" type="submit">Update Details</button>
                        <?php } else { ?>
                            <button class="btn btn-primary" type="submit">Submit Details</button>
                        <?php } ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('extraContent'); ?>
<script src="<?php echo e(url('public/backend/js/tinymce')); ?>/tinymce.min.js"></script>
<script>tinymce.init({selector: '#terms'});</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend._layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>