<?php $__env->startSection('content'); ?>
<?php //echo $_GET['page'];?>
<div id="header_wrapper" class="header-sm">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <header id="header">
                    <h1> Subscriber Users</h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo e(url('backend/')); ?>">Dashboard</a></li>
                        <li class="active">Subscriber Users</li>
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
                    <h2 class="card-title">Users</h2>
                    <p>All Subscriber List will show here</p>
                    <div class="card-search">
                        <div id="productsTable_wrapper" class="form-group label-floating is-empty">
                            <i class="zmdi zmdi-search search-icon-left"></i>
                            <input type="text" class="form-control filter-input" placeholder="Filter Products..." autocomplete="off">
                            <a href="javascript:void(0)" class="close-search" data-card-search="close" data-toggle="tooltip" data-placement="top" title="Close"><i class="zmdi zmdi-close"></i></a>
                        </div>
                    </div>
                    <ul class="card-actions icons right-top">
                        <li id="deleteItems" style="display: none;">
                            <span class="label label-info pull-left m-t-5 m-r-10 text-white"></span>
                            <a href="javascript:void(0)" id="confirmDelete" data-toggle="tooltip" data-placement="top" data-original-title="Delete Product(s)">
                                <i class="zmdi zmdi-delete"></i>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" data-card-search="open" data-toggle="tooltip" data-placement="top" data-original-title="Filter Products">
                                <i class="zmdi zmdi-filter-list"></i>
                            </a>
                        </li>
                        <li class="dropdown" data-toggle="tooltip" data-placement="top" data-original-title="Show Entries">
                            <a href="javascript:void(0)" data-toggle="dropdown">
                                <i class="zmdi zmdi-more-vert"></i>
                            </a>
                            <div id="dataTablesLength">
                            </div>
                        </li>

                        <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Add New Product">
                            <a href="<?php echo e(url('backend/product/add')); ?>"><i class="zmdi zmdi-assignment zmdi-hc-fw"></i></a>
                        </li>

                    </ul>
                </header>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="productsTable"  class="table table-hover">
                            <thead>
                                <tr>
                                    <th data-orderable="false">#</th>
                                    
                                    <th data-orderable="false">Email</th>
                                   
                                    <th data-orderable="false">Subscribed On</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($arrContent['users'])): ?>
                                <?php
                                if (!empty($_GET['page']) && $_GET['page'] > 1) {
                                    $i = 15;
                                    $i = $i * ($_GET['page'] - 1) + 1;
                                } else {
                                    $i = 1;
                                }
                                //var_dump($arrContent['products']);exit;
                                ?>
                                <?php $__currentLoopData = $arrContent['users']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $couponData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                // $categoryData = app('App\Http\Controllers\Backend\CategoryController')->getAllCategory($couponData->category_id);
                                //$storeData = app('App\Http\Controllers\Backend\CategoryController')->getAllStore($couponData->store_id);
                                //var_dump($storeData[0]->store_name);exit;
                                if (!empty($_GET['page'])) {
                                    echo $i;
                                }
                                //var_dump($couponData->product_image);exit;
                                ?>

                                <tr>
                                    <th scope="row"><?php echo e($i++); ?></th>

                                    
                                    <td><?php echo e((!empty($couponData->subs_emailid))?$couponData->subs_emailid:''); ?></td>
                                    <td>
                                        <?php
                                         $newDate = date("d-M-Y ", strtotime($couponData->subs_date));
                                         echo $newDate;
                                        ?>
                                    </td>
                                    
                                   

                                </tr>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                <tr><td colspan="8" style="text-align: center"><h2>No Record Found</h2></td></tr>
                                <?php endif; ?>

                            </tbody>
                        </table>
                        <div>
                            <?php echo e($arrContent['users']->links()); ?>

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