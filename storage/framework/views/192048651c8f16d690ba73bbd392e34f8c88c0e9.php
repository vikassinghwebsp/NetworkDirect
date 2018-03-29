<?php $__env->startSection('content'); ?>
<?php 
 $type = App\library\Customlibrary::bannerType();
 
?>
<div id="header_wrapper" class="header-sm">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <header id="header">
                    <h1>Add Banner</h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo e(url('backend/')); ?>">Dashboard</a></li>
                        <li><a href="<?php echo e(url('backend/banner')); ?>">Banner</a></li>
                        <li class="active">Add Banner</li>
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
                        <h2 class="card-title">New Banner</h2>
                        <ul class="card-actions icons right-top">
                        </ul>
                    </header>
                    <div class="card-body">

<!--                        <div class="form-group label-floating is-empty">
                            <select class="select form-control" name="type">
                                <option value="" selected="">Select Banner Type</option>
                                <?php if(!empty($type)): ?>
                                <?php $__currentLoopData = $type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key); ?>"><?php echo e($val); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                        </div>-->
                        <div class="form-group label-floating is-empty">
                            
                            <select class="select form-control" name="banner">
                                <option value="" selected="">Select Banner </option>
                                <?php if(!empty($arrContent['banner'])): ?>
                                <?php $__currentLoopData = $arrContent['banner']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($banner->id); ?>"><?php echo e($banner->banner_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="form-group is-empty">
                            <div class="input-group">
                                <label class="control-label">Banner Image</label>
                                <input type="file" class="form-control" placeholder="File Upload..." name="banner_file">
                                <div class="input-group">
                                    <input type="text" readonly="" class="form-control" placeholder="Upload one file...">
                                    <span class="input-group-btn input-group-sm">
                                        <button type="button" class="btn btn-primary btn-fab btn-fab-sm">
                                            <i class="zmdi zmdi-attachment-alt"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group label-floating is-empty">
                            <label class="control-label">Banner Url</label>
                            <input type="text" name="banner_url" class="form-control">
                        </div>

                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary btn-flat " type="reset">Reset</button>
                        <button class="btn btn-primary" type="submit">Add New Banner</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend._layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>