@include('frontend.header')

<div class="shop-product single-product">
    <!-- Breadcrumbs v5 -->
    <div class="container">
        <ul class="breadcrumb-v5">
            <li><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
            <li><a href="{{ url('/products/'.$productDetails[0]->category_id) }}">{{ (!empty($productDetails[0]->category_name))?$productDetails[0]->category_name:'' }}</a></li>
            <li class="active">{{ (!empty($productDetails[0]->product_name))?$productDetails[0]->product_name:'' }}</li>
        </ul>
    </div>
    <!-- End Breadcrumbs v5 -->

    <div class="container">
        <div class="row">
            


<!--            <div class="col-md-3 filter-by-block md-margin-bottom-60">
                <h1>Filter By</h1>
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                    Categories
                                    <i class="fa fa-angle-down"></i>
                                </a>
                            </h2>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <div class="sidebar nobottommargin">
                                    Categories


                                    <figure class="widget shadowonly r_corners wrapper m_bottom_30">

                                        <div class="widget_content">
                                            Categories list
                                            <ul class="categories_list">
                                                <li class="active">                         class active 
                                                    <a href="#" class="f_size_large scheme_color d_block relative">
                                                     <b>Top Level Category</b>
                                                     <span class="bg_light_color_1 r_corners f_right color_dark talign_c"></span>
                                                   </a>
                                                    second level
                                                    <ul class="list-unstyled">
                                                        <li>
                                                            <a href="{{ url('/products/'.$productDetails[0]->category_id) }}" class="d_block f_size_large color_dark relative">
                                                                {{ (!empty($productDetails[0]->category_name))?$productDetails[0]->category_name:'' }}<span class="bg_light_color_1 r_corners f_right color_dark talign_c"></span>
                                                            </a>
                                                            third level
                                                            <ul>           display none 
                                                                <li><a href="{{ url('/products/'.$productDetails[0]->subcategory_id) }}" class="color_dark d_block">{{ (!empty($productDetails[0]->subcategory_name))?$productDetails[0]->subcategory_name:'' }}</a></li>
                                                                
                                                            </ul>
                                                        </li>
                                                        
                                                        @foreach($categories as $productData)
                                                        
                                                        <li>
                                                            <a href="{{ url('/products/'.$productData->category_id) }}" class="d_block f_size_large color_dark relative">
                                                                {{ (!empty($productData->category_name))?$productData->category_name:'' }}<span class="bg_light_color_1 r_corners f_right color_dark talign_c"></span>
                                                            </a>
                                                            third level
                                                            <ul style="display:none;">
                                                            <?php
                                                              $subCat = app('App\Http\Controllers\FrontendController')->getSubCategory($productData->category_id);
                                                              foreach ($subCat as $subCate) {
                                                                  //var_dump($subCate);exit; 
                                                              
                                                            ?>
                                                                    
                                                            
                                                            <?php } ?>
                                                                </ul>
                                                        </li>
                                                     
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            </ul>

                                        </div>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>/end panel group



            </div>-->



<?php //var_dump($productDetails[0]);exit; ?>
            <div class="col-md-12">
                <div class="shop-product-heading">
                    <h2>{{ (!empty($productDetails[0]->product_name))?$productDetails[0]->product_name:'' }}</h2>

                </div><!--/end shop product social-->
                <div class="row">
                    <div class="col-md-8">

                     <div class="single-prd-list">


                        <ul class="list-unstyled shop-product-prices margin-bottom-10">
                            <li> <div class="width-300"> <strong>In Stock : </strong> </div>   <div class="label label-success">{{ (!empty($productDetails[0]->stock != '0'))?'Available':'Out Of Stock' }} </div></li>
                           


                        </ul>

                        <ul class="list-unstyled shop-product-prices margin-bottom-10">
                            <li> <div class="width-300"> <strong>Availability : </strong></div> <div class="label label-success"> {{ (!empty($productDetails[0]->stock))?$productDetails[0]->stock:'' }} </div></li>


                        </ul>

                        <ul class="list-unstyled shop-product-prices margin-bottom-10">
                            <li> <div class="width-300"><strong> Retail manufacturer price: (excl. VAT) </strong></div>  <div class="line-through price"><?php if(Session::get('money')){ 
                            $userData = Session::get('money');
                            $curr = $userData[0]['currency'];
                            $currency = strtolower($curr);
                            $rate = $userData[0]['rate'];
                            echo "<spna class='fa fa-$currency'></span>" ;   
                            $productDetails[0]->product_price = $rate * $productDetails[0]->product_price;
                            }else{
                            echo '<span class="fa fa-usd"></span>';
                        }              
                        ?>{{ (!empty($productDetails[0]->product_price))?sprintf('%0.2f', $productDetails[0]->product_price):''  }} </div></li>

                            <li> <div class="width-300"><strong>Our price (exclu. VAT):</strong> </div> <div class="red price"><?php if(Session::get('money')){ 
                            $userData = Session::get('money');
                            $curr = $userData[0]['currency'];
                            $currency = strtolower($curr);
                            echo "<spna class='fa fa-$currency'></span>" ;   
                            $rate = $userData[0]['rate'];
                            $productDetails[0]->product_cost = $rate * $productDetails[0]->product_cost;
                            }else{
                            echo '<span class="fa fa-usd"></span>';
                        }              
                        ?> {{ (!empty($productDetails[0]->product_cost))?sprintf('%0.2f', $productDetails[0]->product_cost):''  }} </div></li>

                        </ul>

                        <ul class="list-unstyled shop-product-prices margin-bottom-20">
                            <li><strong>Delivery </strong></li>
                            <li><div class="width-300"><strong> Standard delivery: </strong></div> <div>Usually delivered in 7-8 working days</div></li>
                            


                        </ul>


                        <div class="margin-bottom-20">

                            <button type="button" class="btn-u btn-u-sea-shop btn-u-lg"><a href="{{ url('/addCart/'.$productDetails[0]->product_slug) }}">Buy now - add to order </a> <i class="fa fa-shopping-cart"></i></button>
                        </div>
                         <h2 class="shop-product-title">Description</h2>          
                {!!html_entity_decode($productDetails[0]->product_description)!!}
                    </div>
  

</div>




                    <div class="col-md-4 md-margin-bottom-50">

<?php   
                                                
                                                if(!empty($productDetails[0]->product_image)){
                                                  $image = $productDetails[0]->product_image;
                                                }else{
                                                    $image = 'noimage.jpg';
                                                }
                                                
                                                
                                                ?>
<?php //var_dump($productDetails[0]->product_image);exit; ?>

                        <img src="{{ URL::asset('public/assets/images/products/380x200/' . $image)}}" class="img-responsive"  alt="lorem ipsum dolor sit">




                        <div class="row">
                            <div class='list-group gallery' style="margin-top:20px;">
                                <?php //var_dump($productDetails);exit; ?>
                                 @if(!empty($productDetails))
                    @foreach($productDetails as $productData)
                    <?php   
                                                
                                                if(!empty($productData->product_image)){
                                                  $image = $productData->product_image;
                                                }else{
                                                    $image = 'noimage.jpg';
                                                }
                                                
                                                
                                                ?>
                                <div class='col-sm-4 col-xs-6 col-md-4 col-lg-4'>
                                    <a class="thumbnail fancybox" rel="ligthbox" href="{{ URL::asset('public/assets/images/products/380x200/' . $image)}}">
                                        <img class="img-responsive" alt="" src="{{ URL::asset('public/assets/images/products/thumb/' . $image)}}" width="320" height="320"/>

                                    </a>
                                </div> 
                                

@endforeach
                        @endif
                            </div> 
                        </div>
                        




                    </div>
                </div>



               
                
            </div>





        </div>
    </div><!--/end row-->
</div>
@include('frontend.footer')