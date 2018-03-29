<?php echo $__env->make('frontend.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;
<section class="mt-contact-banner style4">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <h1><?php echo e($aboutUs[0]->aboutus_title); ?></h1>

                <nav class="breadcrumbs">
                    <ul class="list-unstyled">
                        <li><a href="<?php echo e(url('/')); ?>">Home <i class="fa fa-angle-right"></i></a></li>

                        <li>About Us</li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>


<div class="content container">
    <div class="row">

        <div class="col-md-8 text-justify">

            <?php echo $aboutUs[0]->aboutus_desc; ?>


        </div>

        <div class="col-md-4">

            <img src="<?php echo e(URL::asset('public/assets/images/aboutus') .'/' .$aboutUs[0]->aboutus_image); ?>" class="img-responsive">

        </div>

    </div>
</div>
<?php echo $__env->make('frontend.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;