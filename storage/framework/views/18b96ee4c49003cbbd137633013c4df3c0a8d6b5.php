<?php $__env->startSection('content'); ?>
<?php //echo $_GET['page'];?>
<div id="header_wrapper" class="header-sm">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <header id="header">
                    <h1>Products</h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo e(url('backend/')); ?>">Dashboard</a></li>
                        <li class="active">Products</li>
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
                    <h2 class="card-title">Products</h2>
                    <p>All Products List will show here</p>
                     <?php if(empty($arrContent['products'])): ?>
                  
                            <a class="btn btn-primary" href="<?php echo e(url('/backend/deleteAllProduct/1')); ?>">Delete All</a>
                   <?php endif; ?>
                    <ul class="card-actions icons right-top">
                        
                        <li id="deleteItems" style="display: none;">
                            
                        </li>
                        <li>
                            
                            
                        </li>
                        

                    </ul>
                </header>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="productsTable"  class="table table-hover">
                            <thead>
                                <tr>
                                    <th data-orderable="false">#</th>
                                    
                                   
                                    <th data-orderable="false">Product Name</th>
                                    <th data-orderable="false">Specifications</th>
                                    
                                    <th data-orderable="false">Category Name</th>
                                    <th data-orderable="false">Price</th>
                                    <th data-orderable="false">Cost</th>
                                    <th data-orderable="false">Stock</th>
<!--                                    <th data-orderable="false">Active</th>-->
                                    <th data-orderable="false">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($arrContent['products'])): ?>
                                 <?php
                                        if(!empty($_GET['page']) && $_GET['page'] > 1){
                                             $i=15;
                                             $i = $i*($_GET['page']-1)+1;
                                         }else{
                                            $i=1; 
                                         }
                                         //var_dump($arrContent['products']);exit;
                                    ?>
                                <?php $__currentLoopData = $arrContent['products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $couponData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!empty($couponData->product_name)): ?>
                                <?php 
                                 $categoryData = app('App\Http\Controllers\Backend\CategoryController')->getAllCategory($couponData->category_id);
                                 //$storeData = app('App\Http\Controllers\Backend\CategoryController')->getAllStore($couponData->store_id);
                                 //var_dump($storeData[0]->store_name);exit;
                                 if(!empty($_GET['page'])){
                                     //echo $i;
                                 }
                                 
                                 ?>

                                <tr>
                                    <th scope="row"><?php echo e($i++); ?></th>

                                    
                                    <td><?php echo e((!empty($couponData->product_name))?$couponData->product_name:''); ?></td>
                                    <td><?php echo e((!empty($couponData->product_description))?substr($couponData->product_description,0,50):''); ?></td>
                                    
                                    <td><?php echo e((!empty($couponData->category_name))?$couponData->category_name:''); ?></td>
                                    
                                  

                                    
                                    <td><?php echo e((!empty($couponData->product_price))?$couponData->product_price:''); ?></td>
                                    <td><?php echo e((!empty($couponData->product_cost))?$couponData->product_cost:''); ?></td>
                                    <td><?php echo e((!empty($couponData->stock))?$couponData->stock:''); ?></td>
                                    
                                    <td>
                                        <nav class="btn-fab-group">
                                            <button title="Actions" class="btn btn-primary btn-fab fab-menu" data-fab="left">
                                                <i  class="zmdi zmdi-plus"></i>
                                            </button>

                                            <ul class="nav-sub">

                                                <li> <a href="<?php echo e(url('/backend/product/edit/'.$couponData->product_slug)); ?>" data-toggle="tooltip" data-placement="top" title="Edit Product" class="btn btn-blue btn-fab btn-fab-sm cat_et"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></a></li>
                                                <li> <a data-href="<?php echo e(url('/backend/product/rm/'.$couponData->id)); ?>" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Remove Product" class="btn btn-danger btn-fab btn-fab-sm coupon_rm"><i class="zmdi zmdi-delete"></i></a></li>


                                            </ul>
                                        </nav>
                                    </td>
                                </tr>
                               <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                <tr><td colspan="8" style="text-align: center"><h2>No Record Found</h2></td></tr>
                                <?php endif; ?>

                            </tbody>
                        </table>
                        <div>
                          <?php echo e($arrContent['products']->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Confirmation Modeal -->
<button style="display: none" class="btn btn-primary btn-block coupon_remove_modal" data-toggle="modal" data-target="#toolabr_modal">Trigger</button>
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
                <p>Are your sure ! want remove this sub category?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Cancel</button>
                <a href="" class="btn btn-primary coupon_remove_href">Yes ! i am sure</a>
            </div>
        </div>
        <!-- modal-content -->
    </div>
    <!-- modal-dialog -->
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend._layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>