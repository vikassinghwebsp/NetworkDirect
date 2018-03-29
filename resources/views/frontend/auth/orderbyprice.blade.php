@include('frontend.header');
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
                        <div class="panel-body">


                            <div class="sidebar nobottommargin">
                                <!--Categories-->


                                <figure class="widget shadowonly r_corners wrapper m_bottom_30">

                                    <div class="widget_content">
                                        <!--Categories list-->
                                        <ul class="categories_list">
                                            <li class="active"> 
                                                <ul class="list-unstyled">
                                                    @foreach($categories as $productData)
                                                    <li>
                                                        <a href="{{ url('/products/'.$productData->category_id) }}" class="d_block f_size_large color_dark relative">
                                                            {{ (!empty($productData->category_name))?$productData->category_name:'' }}<span class="bg_light_color_1 r_corners f_right color_dark talign_c"></span>
                                                        </a>
                                                        <!--third level-->
                                                        <ul style="display:none;">
                                                            <?php
                                                            $subCat = app('App\Http\Controllers\FrontendController')->getSubcategoryData($productData->category_id);
                                                            foreach ($subCat as $subCate) {
                                                                //var_dump($subCate);exit; 
                                                                ?>
                                                                <!-- display none -->
                                                                <li class="active"><a href="#" class="color_dark d_block">{{ (!empty($subCate->subcategory_name))?$subCate->subcategory_name:'' }}</a></li>


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
            </div>



        </div>

        <div class="col-md-9">
            <?php //var_dump($arrContent['products'][0]->category_name);exit;  ?>
            <div class="row margin-bottom-5">
                <div class="col-sm-4 result-category">
                    <h5>{{ $arrContent['products'][0]->subcategory_name }}</h5>
                    <small class="shop-bg-red badge-results" style="top:-2px;">{{ count($arrContent['products']) }} Results Found</small>
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
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                    Popularity <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">All</a></li>
                                    <li><a href="#">Best Sales</a></li>
                                    <li><a href="#">Top Last Week Sales</a></li>
                                    <li><a href="#">New Arrived</a></li>
                                </ul>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>



            <div id="products" class="row list-group">
                @foreach($arrContent['products'] as $productData)
                <?php
                if (!empty($productData->product_image)) {
                    $image = $productData->product_image;
                } else {
                    $image = 'noimage.jpg';
                }
                ?>
                <div class="item  col-xs-4 col-lg-4">
                    <div class="thumbnail">
                        <a href="{{ url('/product-details/'.$productData->product_slug) }}">
                <?php
                if (!empty($productData->product_image)) {
                    $image = $productData->product_image;
                    ?>
                                <img class="group list-group-image img-responsive" src="{{ URL::asset('public/assets/images/products/thumb/' . $image)}}" alt="" width="276" height="205"/>
                                <?php } else {
                                ?>
                                <img class="group list-group-image img-responsive" src="{{ URL::asset('public/assets/images/products/thumb/noimage.jpg')}}" alt="" width="276" height="205"/>
                            <?php }
                            ?>
                        </a>
                        <div class="caption">
                            <h4 class="group inner list-group-item-heading">
                                <div class="product-description  ">
                                    <div class="overflow-h margin-bottom-5">
                                        <h4 class="title-price"><a href="{{ url('/product-details/'.$productData->product_slug) }}">{{ (!empty($productData->product_name))? substr($productData->product_name,0,30):''  }}</a></h4>
                                        <div class="pull-left">

                                            <span class="gender text-uppercase">Retail Price</span>

                                            <span class="gender text-uppercase">New Price</span>

                                        </div>
                                        <div class="product-price">
                                            <p class="title-price line-through"><?php
                            if (Session::get('money')) {
                                $userData = Session::get('money');
                                $curr = $userData[0]['currency'];
                                $currency = strtolower($curr);
                                $rate = $userData[0]['rate'];
                                echo "<spna class='fa fa-$currency'></span>";
                                $productData->product_price = $rate * $productData->product_price;
                            } else {
                                echo '<span class="fa fa-usd"> ';
                            }
                            ?>{{ (!empty($productData->product_price))?sprintf('%0.2f', $productData->product_price):''  }}</span></p>

                                            <p class="title-price"><?php
                                                if (Session::get('money')) {
                                                    $userData = Session::get('money');
                                                    $curr = $userData[0]['currency'];
                                                    $currency = strtolower($curr);
                                                    echo "<spna class='fa fa-$currency'></span>";
                                                    $rate = $userData[0]['rate'];
                                                    $productData->product_cost = $rate * $productData->product_cost;
                                                } else {
                                                    echo '<span class="fa fa-usd"> ';
                                                }
                                                ?> {{ (!empty($productData->product_cost))?sprintf('%0.2f', $productData->product_cost):''  }} excl. VAT</span></p>
                                        </div>
                                    </div>

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
@include('frontend.footer');