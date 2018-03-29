<?php $__env->startSection('content'); ?>
<div id="header_wrapper" class="header-sm">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <header id="header">
                    <h1>Sub Category</h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo e(url('backend/')); ?>">Dashboard</a></li>
                        <li class="active">Sub Category</li>
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
                    <h2 class="card-title">Sub Categories</h2>
                    <p>All Sub Category List will show here</p>
                    <div class="card-search">
                        <div id="productsTable_wrapper" class="form-group label-floating is-empty">
                            <i class="zmdi zmdi-search search-icon-left"></i>
                            <input type="text" class="form-control filter-input" placeholder="Filter Products..." autocomplete="off" id="myInput">
                            <a href="javascript:void(0)" class="close-search" data-card-search="close" data-toggle="tooltip" data-placement="top" title="Close"><i class="zmdi zmdi-close"></i></a>
                        </div>
                    </div>
                    <ul class="card-actions icons right-top">
                        
                        <li>
                            <a href="javascript:void(0)" data-card-search="open" data-toggle="tooltip" data-placement="top" data-original-title="Filter Products">
                                <i class="zmdi zmdi-filter-list"></i>
                            </a>
                        </li>
                        
                  
                    </ul>
                </header>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="productsTabless"  class="table table-hover">
                            <thead>
                                <tr>
                                    <th data-orderable="false">#</th>
                                    <th data-orderable="false">Category Name</th>
                                    <th data-orderable="false">Sub Category Name</th>
<!--                                    <th data-orderable="false">Sub Category Description</th>
                                    <th data-orderable="false">Parent Category</th>
                                    <th data-orderable="false">Active</th>-->
                                    <th data-orderable="false">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($arrContent['subcategories'])): ?>
                                 <?php
                                        if(!empty($_GET['page']) && $_GET['page'] > 1){
                                             $i=15;
                                             $i = $i*($_GET['page']-1)+1;
                                         }else{
                                            $i=1; 
                                         }
                                    ?>
                                <?php $__currentLoopData = $arrContent['subcategories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr>
                                    <th scope="row"><?php echo e($i++); ?></th>
                                    <td><?php echo e((!empty($subcategory->category_name))?$subcategory->category_name:''); ?></td>
                                    <td><?php echo e((!empty($subcategory->subcategory_name))?$subcategory->subcategory_name:''); ?></td>
<!--                                    <td><?php echo e((!empty($subcategory->subcategory_description))?substr($subcategory->subcategory_description,0,50):''); ?></td>
                                    <td><?php echo e((!empty($subcategory->cat))?substr($subcategory->cat,0,50):''); ?></td>
                                    <td>
                                        <div class="togglebutton">
                                            <label>
                                              
                                            </label>
                                      </div>
                                    </td>-->
                                    <td>
                                        <nav class="btn-fab-group">
                                            <button title="Actions" class="btn btn-primary btn-fab fab-menu" data-fab="left">
                                                <i  class="zmdi zmdi-plus"></i>
                                            </button>

                                            <ul class="nav-sub">

                                                <li> <a href="<?php echo e(url('/backend/subcategory/edit/'.$subcategory->subcategory_slug)); ?>" data-toggle="tooltip" data-placement="top" title="Edit SubCategory" class="btn btn-blue btn-fab btn-fab-sm cat_et"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></a></li>
                                                <li> <a data-href="<?php echo e(url('/backend/subcategory/rm/'.$subcategory->subcategory_slug)); ?>" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Remove SubCategory" class="btn btn-danger btn-fab btn-fab-sm subcat_rm"><i class="zmdi zmdi-delete"></i></a></li>


                                            </ul>
                                        </nav>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                <tr><td colspan="8" style="text-align: center"><h2>No Record Found</h2></td></tr>
                                <?php endif; ?>

                            </tbody>
                        </table>
                        <div>
                  <?php echo e($arrContent['subcategories']->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Confirmation Modeal -->
<button style="display: none" class="btn btn-primary btn-block subcat_remove_modal" data-toggle="modal" data-target="#toolabr_modal">Trigger</button>
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
                <a href="" class="btn btn-primary subcat_remove_href">Yes ! i am sure</a>
            </div>
        </div>
        <!-- modal-content -->
    </div>
    <!-- modal-dialog -->
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend._layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>