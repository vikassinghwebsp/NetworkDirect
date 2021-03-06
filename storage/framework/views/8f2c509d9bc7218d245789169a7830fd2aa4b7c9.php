<?php echo $__env->make('frontend.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;
<div class="content-md margin-bottom-30">
    <div class="container">


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
            <strong><?php echo e(Session::get('success')); ?></strong> 
        </div>
        <?php endif; ?>
        <div class="table-responsive add-to-cart">
            <table class="table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">SubTotal</th>
<!--                        <th class="text-center"><a class="btn btn-sm btn-outline-danger" href="#">Clear Cart</a></th>-->
                    </tr>
                </thead>
                <tbody>



                    <?php if(!empty($cart)): ?>
                    <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <div class="product-item">
                                <div class="product-info">
                                    <h4 class="product-title"><a href="<?php echo e(url('/product-details/'. $item->name)); ?>"><?php echo e((!empty($item->name))?$item->name:''); ?></a></h4><span><em>Brand: </em><?php echo e((!empty($item->brand_name))?$item->brand_name:''); ?></span><span><em>Color:</em> Turquoise</span>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">

                            <div class="count-sec">
                                <a href='<?php echo e(url("cart?product_id=$item->id&decrease=1&rowId=$item->rowId")); ?>' type="button" class="quantity-button" name="subtract" onclick="javascript: subtractQty1();" >-</a>
                                <input type="text" class="quantity-field" name="qty1" value="<?php echo e((!empty($item->qty))?$item->qty:''); ?>" id="qty1">
                                <a href='<?php echo e(url("cart?product_id=$item->id&increment=1&rowId=$item->rowId")); ?>' type="button" class="quantity-button" name="add" onclick="javascript: document.getElementById( & quot; qty1 & quot; ).value++;" >+</a>

                            </div>
                        </td>
                        <td class="text-center text-lg text-medium price">
                            <?php
                            if (Session::get('money')) {
                                $userData = Session::get('money');
                                $curr = $userData[0]['currency'];
                                $currency = strtolower($curr);
                                echo "<spna class='fa fa-$currency'></span>";
                            } else {
                                echo '<span class="fa fa-usd"></span>';
                            }
                            ?>
                            <?php echo e((!empty($item->price))?sprintf('%0.2f', $item->price):''); ?></td>
                        <td class="text-center price"><?php
                            if (Session::get('money')) {
                                $userData = Session::get('money');
                                $curr = $userData[0]['currency'];
                                $currency = strtolower($curr);
                                echo "<spna class='fa fa-$currency'></span>";
                            } else {
                                echo '<span class="fa fa-usd"></span>';
                            }
                            ?> <?php echo e((!empty($item->price))?sprintf('%0.2f', $item->subtotal):''); ?></td>
                        <td class="text-center"><a class="remove-from-cart"  data-toggle="tooltip" title="" data-original-title="Remove item" href="<?php echo e(url('cart/remove')); ?>/<?php echo $item->rowId; ?>"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>

                    <tr><td colspan="5" style="text-align: center"><h2>No Record Found</h2></td></tr>

                    <?php endif; ?>

                </tbody>
            </table>
        </div>

        <div class="add-to-cart-footer">
            <!--            <div class="column">
                            <form class="coupon-form" method="post">
                                <input class="form-control form-control-sm" type="text" placeholder="Coupon code" required>
                                <button class="btn btn-outline-primary btn-sm" type="submit">Apply Coupon</button>
                            </form>
                        </div>-->
            <div class="column text-lg">Subtotal: <span class="text-medium btn btn-success price"><?php
                    if (Session::get('money')) {
                        $userData = Session::get('money');
                        $curr = $userData[0]['currency'];
                        $currency = strtolower($curr);
                        echo "<spna class='fa fa-$currency'></span>";
                    } else {
                        echo '<span class="fa fa-usd"></span>';
                    }
                    ?> <?php echo e(Cart::subtotal()); ?></span></div>
        </div>

        <div class="add-to-cart-footer">
            <div class="column"><a class="btn btn-outline-secondary" href="<?php echo e(url('/')); ?>"><i class="icon-arrow-left"></i>&nbsp;Back to Shopping</a></div>
            <div class="column"><a class="btn btn-success" href="<?php echo e(url('shipping')); ?>">Checkout</a></div>
            <!--            <a class="btn btn-primary" href="#" data-toast="" data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-circle-check" data-toast-title="Your cart" data-toast-message="is updated successfully!">Update Cart</a>-->
        </div> 





    </div><!--/end container-->
</div>
<?php echo $__env->make('frontend.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;