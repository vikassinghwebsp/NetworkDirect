@include('frontend.header')
<div class="content container">
    <div class="row">
        <div class="col-md-3 filter-by-block md-margin-bottom-60">
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
                        <div class="panel-body catScroll">


                            <div class="sidebar nobottommargin">
                                <!--Categories-->


                                <figure class="widget shadowonly r_corners wrapper m_bottom_30">

                                    <div class="widget_content">
                                        <!--Categories list-->
                                        <ul class="categories_list">
                                            <li class="active">                        <!-- class active -->
                                                <!--<a href="#" class="f_size_large scheme_color d_block relative">
                                                  <b>Top Level Category</b>
                                                  <span class="bg_light_color_1 r_corners f_right color_dark talign_c"></span>
                                                </a>-->
                                                <!--second level-->
                                                <ul class="list-unstyled">
                                                    @if(!empty($categories))
                                                    @foreach($categories as $productData)
                                                    <li>
                                                        <a href="{{ url('/products/'.$productData->category_id) }}" class="d_block f_size_large color_dark relative">
                                                            {{ (!empty($productData->category_name))?$productData->category_name:'' }}<span class="bg_light_color_1 r_corners f_right color_dark talign_c"></span>
                                                        </a>
                                                        <!--third level-->
                                                        <ul style="display:none;">
                                                            <?php
                                                            $subCat = app('App\Http\Controllers\FrontendController')->getSubcategoryData($productData->category_id);
                                                            if(!empty($subCat)){
                                                            foreach ($subCat as $subCate) {
                                                                //var_dump($subCate);exit; 
                                                                
                                                                if(!empty($subCate->subcategory_name)){
                                                                ?>
                                                                <!-- display none -->
                                                                
                                                                
                                                                <li><a href="{{ url('/subcatproducts/'.$subCate->subcategory_name) }}" class="color_dark d_block">{{ (!empty($subCate->subcategory_name))?$subCate->subcategory_name:'' }}</a></li>


                                                                <?php } } 
                                                            }?>
                                                        </ul>
                                                    </li>
                                                    @endforeach
                                                    @endif
                                                </ul>
                                            </li>
                                        </ul>

                                    </div>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>

        <div class="col-md-9 tab-content">
            <?php //var_dump($arrContent['products'][0]->category_name);exit;  ?>
            <div class="row margin-bottom-5">
                <div class="col-sm-4 result-category">
                    <h5>{{ (!empty($arrContent['products'][0]->category_name))?$arrContent['products'][0]->category_name:'' }}</h5>
                    <small class="shop-bg-red badge-results" style="top:-2px;">{{ (!empty($count))?$count:'' }} Results Found</small>
                </div>
                <div class="col-sm-8">


                    <ul class="list-inline clear-both">
                        <li class="grid-list-icons">
                            <a  href="#" id="list"><i class="fa fa-th-list"></i></a>
                            <a  href="#" id="grid"><i class="fa fa-th"></i></a>
                        </li>

                        <li class="sort-list-btn">
                            <h3>Sort By :</h3>
                            <div class="btn-group">
                                <div class="sort-listing">
                                  <ul class="list-inline ">
                                      <?php  $cat_id = $arrContent['products'][0]->category_id; ?>
                                      <li><a href="{{ url('productprice',['cat_id'=>$cat_id,'sort'=>'ASC']) }}">Price -- Low to High</a></li>
                                      
                                 <li><a href="{{ url('productPrice',['cat_id'=>$cat_id,'sort'=>'DESC']) }}">Price -- High to Low</a></li>
                                        
                                 </ul>
                                 </div>



                            </div>
                        </li>

                    </ul>
                </div>
            </div>



            <div id="products" class="row list-group results">
                @foreach($arrContent['products'] as $productData)
                
                
                
                 <?php  
                                                  $url = URL::asset('public/assets/images/products/');
                                                  $images =  app('App\Http\Controllers\FrontendController')->getLatestProductImage($productData->id);
                                                  if(!empty($images)){
                                                      
                                                  if( is_object( $images ) && count( $images ) == 1 ){
                                                      
                                                      $image = $images[0]->product_image;
                                                  }else{
                                                      $image = 'noimage.jpg';
                                                  }
                                                
                                                }
                                                ?>
                <div class="item  col-xs-4 col-lg-4 results-row">
                    <div class="thumbnail">
                        <a href="{{ url('/product-details/'.$productData->product_slug) }}">
                <?php
//                if (!empty($productData->product_image)) {
//                    $image = $productData->product_image;
                    ?>
                                <img class="group list-group-image img-responsive" src="{{ URL::asset('public/assets/images/products/276x205/' . $image)}}" alt="" />
                               
                               
                            
                        </a>
                        <div class="caption">
                            <h4 class="group inner list-group-item-heading">
                                <div class="product-description  ">
                                    <div class="overflow-h margin-bottom-10">
                                        <h4 class="title-price"><a href="{{ url('/product-details/'.$productData->product_slug) }}">{{ (!empty($productData->product_name))? substr($productData->product_name,0,30):''  }}</a></h4>
                                        <div class="pull-left">

                                            <span class="gender text-uppercase">Retail Price</span>

                                            <span class="gender text-uppercase">New Price</span>

                                        </div>
                                        <div class="product-price">
                                            <p class="title-price line-through price"><?php
                            if (Session::get('money')) {
                                $userData = Session::get('money');
                                $curr = $userData[0]['currency'];
                                $currency = strtolower($curr);
                                $rate = $userData[0]['rate'];
                                
                                echo "<span class='fa fa-$currency'></span>";
                                
                                $productData->product_price = $rate * $productData->product_price;
                                $productData->product_cost1 = $rate * $productData->product_cost;
                                
                            } else {
                                echo '<span class="fa fa-usd"> ';
                            }
                            ?>{{ (!empty($productData->product_price))?sprintf('%0.2f', $productData->product_price):''  }}</span></p>

                                            <p class="title-price price"><?php
                            if (Session::get('money')) {
                                $userData = Session::get('money');
                                $curr = $userData[0]['currency'];
                                $currency = strtolower($curr);
                                $rate = $userData[0]['rate'];
                                
                                echo "<span class='fa fa-$currency'></span>";
                                
                                $productData->product_cost = $rate * $productData->product_cost;
                                $productData->product_cost1 = $rate * $productData->product_cost;
                                
                            } else {
                                echo '<span class="fa fa-usd"> ';
                            }
                            ?>{{ (!empty($productData->product_cost))?sprintf('%0.2f', $productData->product_cost):''  }}</span></p>
                                        </div>
                                    </div>
                                    <!--                                    <ul class="list-inline product-ratings">
                                                                            <li><i class="rating-selected fa fa-star"></i></li>
                                                                            <li><i class="rating-selected fa fa-star"></i></li>
                                                                            <li><i class="rating-selected fa fa-star"></i></li>
                                                                            <li><i class="rating fa fa-star"></i></li>
                                                                            <li><i class="rating fa fa-star"></i></li>
                                    
                                                                        </ul>-->
                                    <a class="btn btn-success" href="{{ url('/addCart/'.$productData->product_slug) }}">Add to Cart</a>
                                </div>


                            </h4>


                        </div>
                    </div>
                </div>
                
                @endforeach
            </div>

            <div class="text-center">
                <ul class="pagination pagination-v2">
                    {{ $arrContent['products']->links() }}
                </ul>
            </div><!--/end pagination-->
        </div>
    </div><!--/end row-->
</div><!--/end container-->
<!--=== End Content Part ===-->
@include('frontend.footer')