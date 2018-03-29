<?php echo $__env->make('frontend.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!-- mt main start here -->
<div id="pre-loader" class="loader-container">
    <div class="loader">
        <img src="<?php echo e(URL::asset('public/assets/images/rings.svg')); ?>" alt="loader">
    </div>
</div>
 <?php //var_dump($arrContent);exit; ?>
<main id="mt-main">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <!-- banner frame start here -->
                <div class="banner-frame toppadding-zero">
                    <!-- banner 5 white start here -->
                    <div class="banner-5 white wow fadeInLeft" data-wow-delay="0.1s">
                       <?php //var_dump($arrContent['topleft1']['url']);exit; ?>
                        <div class="sb1">
                            <div class="sb3"><a href="<?php echo e((!empty($arrContent['topleft1']['url']))? $arrContent['topleft1']['url']:''); ?>"><img src="<?php echo e((!empty($arrContent['topleft1']['image']))? $arrContent['topleft1']['image']:''); ?>" alt="image description"></a> </div>
                            <div class="sb4"><a href="<?php echo e((!empty($arrContent['topleft2']['url']))? $arrContent['topleft2']['url']:''); ?>"><img src="<?php echo e((!empty($arrContent['topleft2']))? $arrContent['topleft2']['image']:''); ?>" alt="image description"> </a></div>
                        </div>
                        <div class="sb2">
                            <a href="<?php echo e((!empty($arrContent['topleft3']['url']))? $arrContent['topleft2']['url']:''); ?>"> <img src="<?php echo e((!empty($arrContent['topleft3']))? $arrContent['topleft3']['image']:''); ?>" alt="image description"></a>

                        </div>


                    </div><!-- banner 5 white end here -->


                    <!-- banner 6 white start here
                    -->
                    <div class="banner-6 white wow fadeInRight" data-wow-delay="0.1s">
                        <div ><a href="<?php echo e((!empty($arrContent['topmiddle']['url']))? $arrContent['topmiddle']['url']:''); ?>"> <img src="<?php echo e((!empty($arrContent['topmiddle']))? $arrContent['topmiddle']['image']:''); ?>" alt="image description"></a></div>

                    </div><!-- banner 5 white end here -->
                    <!-- banner box two start here -->
                    <div class="banner-box two">
                        <!-- banner 7 right start here -->
                        <div class="banner-7 right wow fadeInUp" data-wow-delay="0.1s">
                            <div ><a href="<?php echo e((!empty($arrContent['topright1']['url']))? $arrContent['topright1']['url']:''); ?>"> <img src="<?php echo e((!empty($arrContent['topright1']))? $arrContent['topright1']['image']:''); ?>" alt="image description"></a></div>
                            
                        </div><!-- banner 7 right end here -->
                        <!-- banner 8 start here -->
                        <div class="banner-8 wow fadeInDown" data-wow-delay="0.1s">
                            <div ><a href="<?php echo e((!empty($arrContent['topright2']['url']))? $arrContent['topright2']['url']:''); ?>"> <img src="<?php echo e((!empty($arrContent['topright2']))? $arrContent['topright2']['image']:''); ?>" alt="image description"></a></div>
                            
                        </div><!-- banner 8 start here -->
                    </div>
                </div><!-- banner frame end here -->


                <!-- banner frame start here -->
                <div class="banner-frame mt-paddingsmzero">
                    <!-- banner box third start here -->
                    <div class="banner-box third wow fadeInLeft" data-wow-delay="0.1s">
                        <!-- banner 12 right white start here -->
                        <div class="banner-12 right white wow fadeInUp" data-wow-delay="0.1s">
                            <img src="<?php echo e((!empty($arrContent['middleleft1']))? $arrContent['middleleft1']['image']:''); ?>" alt="image description">
                            
                        </div><!-- banner 12 right white end here -->
                        <!-- banner 13 right start here -->
                        <div class="banner-13 right wow fadeInDown" data-wow-delay="0.2s">
                            <img src="<?php echo e((!empty($arrContent['middleleft2']))? $arrContent['middleleft2']['image']:''); ?>" alt="image description">
                            
                        </div><!-- banner 13 right end here -->
                    </div><!-- banner box third end here -->
                    <!-- slider 7 start here -->
                    <div class="slider-7 wow fadeInRight" data-wow-delay="0.1s">
                        <!-- slider start here -->
                        <div class="slider banner-slider">
                            <!-- holder start here -->
                            <div class="s-holder">
                                <img src="<?php echo e((!empty($arrContent['slider1']))? $arrContent['slider1']['image']:''); ?>" alt="image description">
                                
                            </div><!-- holder end here -->
                            <!-- holder start here -->
                            <div class="s-holder">
                                <img src="<?php echo e((!empty($arrContent['slider2']))? $arrContent['slider2']['image']:''); ?>" alt="image description">
                                <div class="s-box">
                                    <strong class="s-title">FURNITURE DESIGNS IDEAS</strong>
                                    <span class="heading">Upholstered fabric</span>
                                    <span class="heading add">Counter stool</span>
                                    <div class="s-txt">
                                        <p>Consectetur adipisicing elit. Beatae accusamus, optio, repellendus inventore</p>
                                    </div>
                                </div>
                            </div><!-- holder end here -->
                            
                            <!-- holder star here -->
                            <div class="s-holder">
                                <img src="<?php echo e((!empty($arrContent['slider3']))? $arrContent['slider3']['image']:''); ?>" alt="image description">
                                <div class="s-box">
                                    <strong class="s-title">FURNITURE DESIGNS IDEAS</strong>
                                    <span class="heading add">NEW</span>
                                    <span class="heading add">COLLECTION</span>
                                    <div class="s-txt">
                                        <p>Consectetur adipisicing elit. Beatae accusamus, optio, repellendus inventore</p>
                                    </div>
                                    <a href="product-detail.html" class="s-shop">SHOP NOW</a>
                                </div>
                            </div><!-- holder end here -->
                        </div>
                    </div><!-- slider 7 end here -->
                </div><!-- banner frame end here --> 
                <!-- mt producttabs style2 start here -->
                <div class="mt-producttabs style2 wow fadeInUp" data-wow-delay="0.1s">
                    <!-- producttabs start here -->
                    <ul class="producttabs">
                        <!--                        <li><a href="#tab1" class="active">FEATURED</a></li>-->
                        <li><a href="#tab2" class="active">LATEST</a></li>
                        <!--                        <li><a href="#tab3">BEST SELLER</a></li>-->
                    </ul>
                    <!-- producttabs end here -->
                    <div class="tab-content">
                       
                        <div id="tab2">
                            <!-- tabs slider start here -->
                            <div class="tabs-sliderlg">
                                <!-- slide start here -->
                                <?php $__currentLoopData = $arrContent['latest_products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                
                                <?php //var_dump($productData->id);exit; ?>
                                <div class="slide">
                                    <!-- mt product1 large start here -->
                                    <div class="mt-product1 large">
                                        <div class="box">
                                            <div class="b1">
                                                <span class="caption">
                                                    <span class="new">new</span>
                                                </span>
                                                <?php  
                                                $url = URL::asset('public/assets/images/products/thumb');
                                                  $images =  app('App\Http\Controllers\FrontendController')->getLatestProductImage($productData->id);
                                                  if(!empty($images)){
                                                      
                                                  if( is_object( $images ) && count( $images ) == 1 ){
                                                      
                                                      $image = $images[0]->product_image;
                                                  }else{
                                                      $image = 'noimage.jpg';
                                                  }
                                                
                                                }
                                                ?>
                                                
                                                
                                                
                                                <div class="b2">
                                                    <a href="<?php echo e(url('/product-details/'.$productData->product_slug)); ?>"><img src="<?php echo e(URL::asset('public/assets/images/products/thumb/' . $image)); ?>"  alt="image description"></a>
                                                    <ul class="links">
                                                        <li><a href="<?php echo e(url('/addCart/'.$productData->product_slug)); ?>"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
<!--                                                        <li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>-->
                                                        <li><a href="<?php echo e(URL::asset('public/assets/images/products/' . $image)); ?>" class="lightbox"><i class="icomoon icon-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="txt">
                                            <strong class="title"><a href="<?php echo e(url('/product-details/'.$productData->product_slug)); ?>"><?php echo e((!empty($productData->product_name))? substr($productData->product_name,0,30):''); ?></a></strong>
                                            <span class="price">  <?php
                                                if (Session::get('money')) {
                                                    $userData = Session::get('money');
                                                    $curr = $userData[0]['currency'];
                                                    $currency = strtolower($curr);
                                                    echo "<i class='fa fa-$currency'></i>";
                                                } else {
                                                    echo '<i class="fa fa-usd"></i>';
                                                }
                                                ?> <span><?php
                                                    if (Session::get('money')) {
                                                        $userData = Session::get('money');
                                                        $curr = $userData[0]['rate'];
                                                        $original_price = $curr * $productData->product_cost;
                                                        echo (!empty($original_price)) ? sprintf('%0.2f', $original_price) : '';
                                                    } else {

                                                        echo (!empty($productData->product_cost)) ? sprintf('%0.2f', $productData->product_cost) : '';
                                                    }
                                                    ?></span></span>
                                        </div>
                                    </div><!-- mt product1 center end here -->
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                               
                    </div>
                </div><!-- mt producttabs end here -->
                <!-- banner frame start here -->
                <div class="banner-frame nospace wow fadeInUp" data-wow-delay="0.1s">
                    <!-- banner 9 start here -->
                    <div class="banner-9">
                        <img src="<?php echo e((!empty($arrContent['bottomleft']))? $arrContent['bottomleft']['image']:''); ?>" alt="image description">
                        <!-- <div class="holder">
                             <h2><span>Wall Decor</span><strong>CLOCKs</strong></h2>
                             <a class="btn-shop" href="product-detail.html">
                                 <span>VIEW</span>
                                 <i class="fa fa-angle-right"></i>
                             </a>
                         </div> -->
                    </div><!-- banner 9 end here -->
                    <!-- banner 10 start here -->
                    <div class="banner-10">
                        <img src="<?php echo e((!empty($arrContent['bottommiddle']))? $arrContent['bottommiddle']['image']:''); ?>" alt="image description">
                        <!--<div class="holder">
                            <h2><span>Coffee Tables</span><strong>S.O.S. BLOCKS</strong></h2>
                            <a class="btn-shop" href="product-detail.html">
                                <span>VIEW</span>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>-->
                    </div><!-- banner 10 end here -->
                    <!-- banner 11 start here -->
                    <div class="banner-11">
                        <img src="<?php echo e((!empty($arrContent['bottomright']))? $arrContent['bottomright']['image']:''); ?>" alt="image description">
                        <!--<div class="holder">
                            <h2><span>Floor Lamps</span><strong>ROCKING LAMP</strong></h2>
                            <a class="btn-shop" href="product-detail.html">
                                <span>VIEW</span>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>-->
                    </div><!-- banner 11 end here -->
                </div><!-- banner frame end here -->
                <!-- mt producttabs style3 start here -->
                <div class="mt-producttabs style3 wow fadeInUp" data-wow-delay="0.1s">
                    <h2 class="heading"><?php echo e($arrContent['title']); ?></h2>
                    <!-- tabs slider start here -->

                    
                    <div class="tabs-slider">
                        <!-- slide start here -->
                        <?php if(!empty($arrContent['frontCat'])): ?>
                    <?php $__currentLoopData = $arrContent['frontCat']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $frontCat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="slide">
                            <!-- mt product1  start here -->
                             <?php  
                                                $url = URL::asset('public/assets/images/products/');
                                                  $images =  app('App\Http\Controllers\FrontendController')->getLatestProductImage($frontCat->id);
                                                  if(!empty($images)){
                                                      
                                                  if( is_object( $images ) && count( $images ) == 1 ){
                                                      
                                                      $image = $images[0]->product_image;
                                                  }else{
                                                      $image = 'noimage.jpg';
                                                  }
                                                
                                                }
                                                ?>
                            <div class="mt-product1">
                                <div class="box">
                                    <div class="b1">
                                        <div class="b2">
                                            <a href="<?php echo e(url('/product-details/'.$frontCat->product_slug)); ?>"><img src="<?php echo e(URL::asset('public/assets/images/products/213x215/' . $image)); ?>"  alt="image description"></a>
                                            <span class="caption">
                                                <span class="new">new</span>
                                            </span>

                                            <ul class="links">
                                                <li><a href="<?php echo e(url('/addCart/'.$frontCat->product_slug)); ?>"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>

                                                <li><a href="<?php echo e(URL::asset('public/assets/images/products/thumb/' . $image)); ?>" class="lightbox"><i class="icomoon icon-eye"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="txt">
                                    <strong class="title"><a href="<?php echo e(url('/product-details/'.$frontCat->product_slug)); ?>"><?php echo e((!empty($frontCat->product_name))? substr($frontCat->product_name,0,30):''); ?></a></strong>
                                    <span class="price"><?php
                                                if (Session::get('money')) {
                                                    $userData = Session::get('money');
                                                    $curr = $userData[0]['currency'];
                                                    $currency = strtolower($curr);
                                                    echo "<i class='fa fa-$currency'></i>";
                                                } else {
                                                    echo '<i class="fa fa-usd"></i>';
                                                }
                                                ?> <span><?php 
                                                   if (Session::get('money')) {
                                                    $userData = Session::get('money');
                                                    $curr = $userData[0]['rate']; 
                                                    $original_price = $curr * $frontCat->product_cost;
                                                   echo (!empty($original_price))?sprintf('%0.2f', $original_price):''; }else{
                                                       
                                                     echo  (!empty($frontCat->product_cost))?sprintf('%0.2f', $frontCat->product_cost):''; 
                                                   } ?></span></span>
                                </div>
                            </div><!-- mt product1  end here -->
                        </div>
                        <!-- slide end here -->

                        <!-- slide end here -->
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    </div>
                    
                    <!-- tabs slider end here -->
                </div><!-- mt producttabs style3 end here -->
                <!-- mt patners start here -->
                <div class="mt-patners wow fadeInUp" data-wow-delay="0.1s">
                    <h2 class="heading">BRANDS <span></span></h2>
                    <!-- patner slider start here -->
                    <div class="patner-slider">
                        <!-- slide start here -->
                        <?php //var_dump($arrContent['allBrands']);exit;    ?>


                        <?php $__currentLoopData = $arrContent['allBrands']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <?php //var_dump($brand);exit;   ?>

                        <div class="slide">
                            <div class="box1">
                                <div class="box2"><a href="<?php echo e((!empty($brand->brand_url))? $brand->brand_url :''); ?>"><img src="<?php echo e(\App\library\Customlibrary::getBrandImage($brand->brand_image,'thumb')); ?>" width="110" height="22" alt="img"></a></div>
                            </div>
                        </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        
                    </div><!-- patner slider end here -->
                </div><!-- mt patners end here -->
            </div>
        </div>
    </div>
</main>
<!-- footer of the Page -->

<!-- F Promo Box of the Page end -->




<?php echo $__env->make('frontend.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>