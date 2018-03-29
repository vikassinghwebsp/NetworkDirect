<?php $__env->startSection('content'); ?>
<div id="header_wrapper" class="header-sm">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <header id="header">
                    <h1>Edit Category</h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo e(url('backend/')); ?>">Dashboard</a></li>
                        <li><a href="<?php echo e(url('backend/category')); ?>">Category</a></li>
                        <li class="active">Edit Category</li>
                    </ol>
                </header>
            </div>
        </div>
    </div>
</div>
<?php //var_dump($arrContent['category'][0]);exit;?>
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
            <form method="post" action="<?php echo e(url('backend/category/edit_submit')); ?>">
                <div class="card">
                    <header class="card-heading p-b-0 ">
                        <h2 class="card-title">Edit category</h2>
                        <ul class="card-actions icons right-top">
                        </ul>
                    </header>
                    <div class="card-body">

                        <div class="form-group label-floating">
                            <label class="control-label">Category Name</label>
                            <input type="text" name="category_name" class="form-control" value="<?php echo e($arrContent['category'][0]->category_name); ?>">
                        </div>
                        
                         <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                    </div>
                    <div class="card-footer text-right">
                        <a class="btn btn-primary btn-flat" href="<?php echo e(url('backend/category')); ?>">Back</a>
                        <input type="hidden" name="hidcategory_id" value="<?php echo e($arrContent['category'][0]->category_id); ?>">
                        <button class="btn btn-primary" type="submit">Update Category</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend._layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>