<?php $__env->startSection('content'); ?>
<div id="header_wrapper" class="header-sm">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <header id="header">
                    <h1>Add Sub Category</h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo e(url('backend/')); ?>">Dashboard</a></li>
                        <li><a href="<?php echo e(url('backend/subcategory')); ?>">Sub Category</a></li>
                        <li class="active">Add Category</li>
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
                        <h2 class="card-title">New category</h2>
                        <ul class="card-actions icons right-top">
                        </ul>
                    </header>
                    <div class="card-body">

                        <div class="form-group label-floating is-empty">
                            <label class="control-label">Sub Category Name</label>
                            <input type="text" name="subcategory_name" class="form-control">
                        </div>
                        <div class="form-group label-floating is-empty">
                            <label for="textArea" class="control-label">Sub Category Link</label>
                           <input type="text" name="subcategory_link" class="form-control">
                        </div>
                        <div class="form-group label-floating is-empty">
                            <select class="select form-control" name="menu_id" id="menu_id_select">
                                <option>Select Menu</option>

                                <option value="1">CISCO SWITCHES</option>
                                <option value="2">CISCO ROUTERS</option>
                                <option value="3">CISCO SECURITY</option>
                                <option value="4">CISCO WIRELESS</option>
                                <option value="5">CISCO ACCESSORIES</option>
                                <option value="6">CISCO IP PHONES</option>
                                <option value="7">CISCO MERAKI</option>
                                
                                

                            </select>
                        </div>
                        <div class="form-group label-floating is-empty">
                            <select class="select form-control" name="category_id" id="category_id">
                                
                            </select>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary btn-flat " type="reset">Reset</button>
                        <button class="btn btn-primary" type="submit">Add New Sub Category</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend._layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>