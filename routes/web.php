<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::get('/', function () {
    return view('welcome');
});

/*
  |
  | Get Request will define below for Frontend prefix
  | Authour : Sunny Saini <sunnysaini466@gmail.com>
  |
 */
Route::get('lang/{lang}', ['as'=>'lang.switch', 'uses'=>'LanguageController@switchLang']);

Route::get('/', 'FrontendController@index');
Route::get('/signIn', 'FrontendController@signIn');
Route::get('/login', 'FrontendController@login');
Route::get('/register', 'FrontendController@register');
Route::get('/logout', 'FrontendController@logout');

//My Account
Route::get('/myaccount/order-history', 'FrontendController@order_history');
Route::get('/myaccount/my-details', 'FrontendController@my_details');
Route::get('/myaccount/shipping-address', 'FrontendController@my_shipping_address');
Route::get('/myaccount/change-password', 'FrontendController@change_password');
Route::get('/myaccount/payment-methods', 'FrontendController@payments_method');
//

Route::get('/singleproduct', 'FrontendController@singleproduct');
Route::get('/products', 'FrontendController@allproducts');
Route::get('/cart', 'FrontendController@cart');
Route::get('/shipping', 'FrontendController@shipping');
Route::get('/payment', 'FrontendController@payment');
Route::get('/addCart/{id}', 'FrontendController@addCart');
Route::get('/cart/remove/{id}', 'FrontendController@removeCart');
Route::get('/product/search', 'FrontendController@searchProduct');
Route::get('/product-details/{id}', 'FrontendController@product_details');
Route::get('/products/{id}', 'FrontendController@productsByCategory');

Route::get('/productprice/{catid}/{id}', 'FrontendController@productByPrice');
Route::get('/productPrice/{catid}/{id}', 'FrontendController@productPrice');

Route::get('/menuproducts/{id}', 'FrontendController@productsByMenu');
Route::get('/subcatproducts/{id}', 'FrontendController@productsBySubcat');
Route::get('/pricebyasc/{id}', 'FrontendController@productsByPriceASC');
Route::get('/editProfile/{id}', 'FrontendController@editProfile');
Route::get('/terms', 'FrontendController@termsCondition');
Route::get('/about', 'FrontendController@aboutUs');



//Payment with Stripe

Route::post('addmoney/stripe', array('as' => 'addmoney.stripe','uses' => 'AddMoneyController@postPaymentWithStripe'));







/*
  |
  | Post Request will define below for Frontend prefix
  | Authour : Sunny Saini <sunnysaini466@gmail.com>
  |
 */
Route::post('/signIn', 'FrontendController@signIn');
Route::post('/register', 'FrontendController@register');
Route::post('/payment', 'FrontendController@payment');
Route::post('/myaccount/change-password', 'FrontendController@change_password');
Route::post('/lang', 'FrontendController@postChangeLanguage');
Route::post('curr', 'FrontendController@index');
Route::post('updateProfile', 'FrontendController@updateProfile');
Route::post('subscribe', 'FrontendController@subscribe');










Route::group(['prefix' => 'backend'], function () {

    /*
      |
      | Get Request will define below for Backend prefix
      | Authour : Sunny Saini <sunnysaini466@gmail.com>
      |
     */
    Route::get('/', 'backend\BackendController@index')->middleware('auth');
    Route::get('/login', 'backend\BackendController@login');
    Route::get('/home', 'backend\BackendController@login')->middleware('auth');
    Route::get('/auth', 'backend\BackendController@login');
    Route::get('/auth/logout', 'backend\BackendController@logout');
    Route::get('/logout', 'backend\BackendController@logout');
    Route::get('/profile', 'backend\BackendController@userprofile')->middleware('auth');

// Category
    Route::get('/category/add', 'backend\CategoryController@add')->middleware('auth');
    Route::get('/category', 'backend\CategoryController@index')->middleware('auth');
    Route::get('/category/edit/{id}', 'backend\CategoryController@edit')->middleware('auth');
    Route::get('/category/rm/{id}', 'Backend\CategoryController@remove')->middleware('auth');
//Sub Category
    Route::get('/subcategory', 'backend\CategoryController@subcategory')->middleware('auth');
    Route::get('/subcategory/add', 'backend\CategoryController@addSubCat')->middleware('auth');
    Route::get('/subcategory/edit/{id}', 'Backend\CategoryController@editsubcategory')->middleware('auth');
    Route::get('/subcategory/rm/{id}', 'Backend\CategoryController@subremove')->middleware('auth');

//Sub Sub Category
    Route::get('/addSubSubCat/add', 'backend\CategoryController@addSubSubCat')->middleware('auth');
    Route::get('/subsubcategory', 'backend\CategoryController@subsubcategory')->middleware('auth');
    Route::get('/subSubCat/edit/{id}', 'Backend\CategoryController@editsubsubcat')->middleware('auth');



//Banner Management

    Route::get('/banner/add', 'backend\BackendController@addBanners')->middleware('auth');
    Route::get('/banner', 'backend\BackendController@banner')->middleware('auth');
    Route::get('/banner/rm/{id}', 'backend\BackendController@bannerremove')->middleware('auth');

    //Products Management
    Route::get('/product/add', 'backend\ProductController@addProduct')->middleware('auth');

    Route::get('/product', 'backend\ProductController@index')->middleware('auth');
    Route::get('/product/rm/{id}', 'backend\ProductController@productremove')->middleware('auth');
    Route::get('/product/edit/{id}', 'backend\ProductController@productedit')->middleware('auth');
    Route::get('/addProductCSV', 'backend\ProductController@addProductCSV')->middleware('auth');


//Menu Management

    Route::get('/menu/add', 'backend\BackendController@menu')->middleware('auth');
    Route::get('/menu', 'backend\BackendController@menu_list')->middleware('auth');
    Route::get('/menu/rm/{id}', 'backend\ProductController@menuremove')->middleware('auth');
    Route::get('/submenu/add', 'backend\BackendController@submenu')->middleware('auth');
    Route::get('/submenu', 'backend\BackendController@submenu_list')->middleware('auth');

//Custom Pages

    Route::get('/aboutus', 'backend\BackendController@add_aboutUs')->middleware('auth');
    Route::get('/terms', 'backend\BackendController@terms')->middleware('auth');
    Route::get('/add_address', 'backend\BackendController@add_address')->middleware('auth');
    Route::get('/add_socialMedia', 'backend\BackendController@add_socialMedia')->middleware('auth');

//All Users
    Route::get('/allUsers', 'backend\BackendController@allUsers')->middleware('auth');
    Route::get('/allSubscribedUsers', 'backend\BackendController@allSubscribedUsers')->middleware('auth');


//Brands

    Route::get('/addBrand', 'backend\BackendController@addBrand')->middleware('auth');
    
    
    //All Order


Route::get('/ordersList', 'backend\BackendController@ordersList')->middleware('auth');
//Route::get('/ordersList/{id}', 'backend\BackendController@ordersList')->middleware('auth');

Route::get('/lastOrders', 'backend\BackendController@lastOrders')->middleware('auth');

Route::get('/frontCategory', 'backend\BackendController@frontCategory')->middleware('auth');
Route::get('/deleteAllProduct/{id}', 'backend\BackendController@deleteAllProduct')->middleware('auth');











    /*
      |
      | Post Request will define below for Backend prefix
      | Authour : Sunny Saini <sunnysaini466@gmail.com>
      |
     */

    Route::post('login', ['as' => 'login', 'uses' => 'backend\BackendController@login']);
    Route::post('/auth', 'backend\BackendController@login');
    Route::post('/profile/submit', 'backend\BackendController@userprofilesub')->middleware('auth');

Route::post('/frontCategory', 'backend\BackendController@frontCategory')->middleware('auth');


//Category
    Route::post('/category/add', 'backend\CategoryController@add')->middleware('auth');
    Route::post('/category/edit_submit', 'backend\CategoryController@edit_submit')->middleware('auth');
    Route::post('/category/activecategory', 'backend\CategoryController@categoryactive')->middleware('auth');
    Route::post('/addSubSubCat/add', 'backend\CategoryController@addSubSubCat')->middleware('auth');
    Route::post('/subsubcatactive', 'backend\CategoryController@subsubcatactive')->middleware('auth');
    Route::post('/subcategory/edit_submit', 'Backend\CategoryController@editSubCat_submit')->middleware('auth');
    Route::post('/subsubcat/edit_submit', 'Backend\CategoryController@editSubSubCat_submit')->middleware('auth');






//Banner
    Route::post('/banner/add', 'backend\BackendController@addBanners')->middleware('auth');
    Route::post('/banner/activebanner', 'backend\BackendController@banneractive')->middleware('auth');


//products post    
    Route::post('/product/add', 'backend\ProductController@addProduct')->middleware('auth');
    Route::post('/product/action', 'backend\ProductController@action')->middleware('auth');
    Route::post('/product/subaction', 'backend\ProductController@actionSubCat')->middleware('auth');
    Route::post('/product/activeaction', 'Backend\ProductController@actionactive')->middleware('auth');
    Route::post('/product/editsubmit', 'Backend\ProductController@editproductubmit')->middleware('auth');
    Route::post('/addProductCSV', 'backend\ProductController@addProductCSV')->middleware('auth');




//Menu Posts

    Route::post('/menu/add', 'backend\BackendController@menu')->middleware('auth');
    Route::post('/submenu/add', 'backend\BackendController@submenu')->middleware('auth');
    Route::post('/menu/active', 'backend\BackendController@menuactive')->middleware('auth');

//custom pages

    Route::post('/aboutus', 'backend\BackendController@add_aboutUs')->middleware('auth');
    Route::post('/terms', 'backend\BackendController@terms')->middleware('auth');
    Route::post('/add_address', 'backend\BackendController@add_address')->middleware('auth');
    Route::post('/add_socialMedia', 'backend\BackendController@add_socialMedia')->middleware('auth');

//Brands

    Route::post('/addBrand', 'backend\BackendController@addBrand')->middleware('auth');
    
    
    //all orders
    //Route::post('/ordersList', 'backend\BackendController@ordersList')->middleware('auth');
    Route::post('/orderStatusChanged', 'backend\BackendController@orderStatusChanged')->middleware('auth');
    
    Route::post('/selectCategory', 'backend\BackendController@selectCategory')->middleware('auth');
    Route::post('/selectSubCategory', 'backend\BackendController@selectSubCategory')->middleware('auth');
    Route::post('/subcategory/add', 'backend\CategoryController@addSubCat')->middleware('auth');
});
Route::get('phpinfo', function () {
    return phpinfo();
});

