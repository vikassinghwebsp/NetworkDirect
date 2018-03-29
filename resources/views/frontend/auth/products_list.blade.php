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
                                Brands
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
                                               <?php //var_dump($productDetails[0]);exit; ?>
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
                                                                <li><a href="#" class="color_dark d_block">{{ (!empty($subCate->subcategory_name))?$subCate->subcategory_name:'' }}</a></li>
                                                                
                                                            
                                                           <?php } } 
                                                            }?>
                                                                </ul>
                                                        </li>
                                                     
                                                        @endforeach
                                                        @else
                <li>No Record Found</li>
               
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

        <div class="col-md-9">
            <div class="row margin-bottom-5">
                <div class="col-sm-4 result-category">
                    <h4>{{ (!empty($searchKey))?$searchKey:'' }}</h4>
                    <small class="shop-bg-red badge-results" style="top:-2px;">{{ (!empty($count))?$count:'No' }} Results Found</small>
                </div>
                <div class="col-sm-8">
                    <ul class="list-inline clear-both">
<!--                        <li class="grid-list-icons">
                            <a  href="#" id="list"><i class="fa fa-th-list"></i></a>
                            <a  href="#" id="grid"><i class="fa fa-th"></i></a>
                        </li>-->
                        <li class="sort-list-btn">
                            <h3>Sort By :</h3>
                            <div class="btn-group">
                                <div class="sort-listing">
                                  <ul class="list-inline ">
                                      <li><a href="{{ url('/productprice/'.'ASC') }}">Price -- Low to High</a></li>
                                 <li><a href="{{ url('/productPrice/'.'DESC') }}">Price -- High to Low</a></li>
                                        
                                 </ul>
                                 </div>
                            </div>
                        </li>
                        
                    </ul>
                </div>
            </div><!--/end result category-->

            <div class="filter-results">
                <?php //var_dump($productDetails);exit; ?>
                @if(!empty($productDetails))
                @foreach($productDetails as $productData)
                <div class="list-product-description product-description-brd margin-bottom-30">
                    <div class="row">
                        <div class="col-sm-4">
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
                            <a href="{{ url('/product-details/'.$productData->product_slug) }}"><img class="img-responsive sm-margin-bottom-20" src="{{ URL::asset('public/assets/images/products/thumb/' . $image)}}" alt=""></a>
                        </div>
                        <div class="col-sm-8 product-description">
                            <div class="overflow-h margin-bottom-5">
                                <ul class="list-inline overflow-h">
                                    <li><h2 class="title-price"><a href="{{ url('/product-details/'.$productData->product_slug) }}" style="font-size: 24px !important;">{{ (!empty($productData->product_name))?$productData->product_name:'' }}</a></h2></li>
                                    <li><span class="gender text-uppercase">{{ (!empty($productData->brand_name))?$productData->brand_name:'' }}</span></li>
                                    
                                </ul>
                                <div class="margin-bottom-10">
                                    <span class="title-price margin-right-10">$ {{ (!empty($productDetails[0]->product_cost))?sprintf('%0.2f', $productDetails[0]->product_cost):''  }}</span>
                                    <span class="title-price line-through">$ {{ (!empty($productDetails[0]->product_price))?sprintf('%0.2f', $productDetails[0]->product_price):''  }}</span>
                                </div>
                                <p class="margin-bottom-20">{!!html_entity_decode($productData->product_description)!!}</p>
                               
                                
                                <button type="button" class="btn-u btn-u-sea-shop btn-u-lg"><a href="{{ url('/addCart/'.$productDetails[0]->product_slug) }}">Add to Cart</a> <i class="fa fa-shopping-cart"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <h3>No Record Found</h3>
               
                @endif

            </div><!--/end filter resilts-->

            <div class="text-center">
                <ul class="pagination pagination-v2">
                    {{ $productDetails->links() }}
                </ul>
            </div><!--/end pagination-->
        </div>
    </div><!--/end row-->
</div>
@include('frontend.footer')