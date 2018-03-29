<?php $__env->startSection('content'); ?>
<div id="header_wrapper" class="header-sm">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <header id="header">
                    <h1>Front Category</h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo e(url('backend/')); ?>">Dashboard</a></li>
                        <li class="active">Front Category</li>
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
            <form method="post">
                <div class="card">
                    <header class="card-heading p-b-0 ">
                        <h2 class="card-title">Front Category</h2>
                        <ul class="card-actions icons right-top">
                        </ul>
                    </header>
                    <div class="card-body">
                       
                        <div class="form-group label-floating is-empty">
                            <label class="control-label">Title</label>
                            <input type="text" name="title" class="form-control" id="title" required="">
                            
                        </div>
                        
                        <div class="form-group label-floating is-empty">
                            <select class="select form-control" name="frontCat" id="frontCat">
                                <option value="" selected="">Select Menu</option>
                                <?php if(!empty($arrContent['category'])): ?>
                                <?php $__currentLoopData = $arrContent['category']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($menus->category_id); ?>"><?php echo e($menus->category_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                        </div>
                      
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary btn-flat " type="reset">Reset</button>
                        <button class="btn btn-primary" type="button" id="submitCatbtn">Add New Front Category</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend._layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>