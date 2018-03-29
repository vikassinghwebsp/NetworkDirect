<?php

/*
  | Define all Front controller login here related to Front part
  | Authour : Sunny Saini <sunnysaini466@gmail.com>
  |
 */

namespace App\Http\Controllers;

use Flash;
use Mail;
use Validator;
use App;
use \Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use VatCalculator;

class FrontendController extends Controller {

    use AuthenticatesUsers;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $arrContent = array();
        $arrContent['topleft1'] = app('App\Http\Controllers\FrontendController')->getAllBannerImage('Top Left 1');
        $arrContent['topleft2'] = app('App\Http\Controllers\FrontendController')->getAllBannerImage('Top Left 2');
        $arrContent['topleft3'] = app('App\Http\Controllers\FrontendController')->getAllBannerImage('Top Left 3');
        $arrContent['topmiddle'] = app('App\Http\Controllers\FrontendController')->getAllBannerImage('Top Middle');
        $arrContent['topright1'] = app('App\Http\Controllers\FrontendController')->getAllBannerImage('Top Right 1');
        $arrContent['topright2'] = app('App\Http\Controllers\FrontendController')->getAllBannerImage('Top Right 2');
        $arrContent['topright3'] = app('App\Http\Controllers\FrontendController')->getAllBannerImage('Top Right 3');
        $arrContent['middleleft1'] = app('App\Http\Controllers\FrontendController')->getAllBannerImage('Middle Left 1');
        $arrContent['middleleft2'] = app('App\Http\Controllers\FrontendController')->getAllBannerImage('Middle Left 2');
        $arrContent['slider1'] = app('App\Http\Controllers\FrontendController')->getAllBannerImage('Slider 1');
        $arrContent['slider2'] = app('App\Http\Controllers\FrontendController')->getAllBannerImage('Slider 2');
        $arrContent['slider3'] = app('App\Http\Controllers\FrontendController')->getAllBannerImage('Slider 3');
        $arrContent['bottomleft'] = app('App\Http\Controllers\FrontendController')->getAllBannerImage('Bottom Left');
        $arrContent['bottommiddle'] = app('App\Http\Controllers\FrontendController')->getAllBannerImage('Bottom Middle');
        $arrContent['bottomright'] = app('App\Http\Controllers\FrontendController')->getAllBannerImage('Bottom Right');
        $arrContent['latest_products'] = app('App\Http\Controllers\FrontendController')->getLatestProducts();
        $arrContent['allBrands'] = app('App\Http\Controllers\FrontendController')->getAllBrands();

        $data = Self::getFrontTitle();
        $arrContent['title'] = $data[0]->title;
        $arrContent['frontCat'] = Self::getFrontCat($data[0]->category_id);
        // var_dump($arrContent['latest_products']);exit;
        if (!empty($request->method()) && $request->method() == "POST") {
            //die("Helloo Vikas");
            $input = $request->input();
            $rate = $input['rate'];
            $currency = $input['currency'];

            //return $currency;
            //var_dump(json_decode($currency));exit;

            $arrData = array('currency' => $currency,
                'rate' => $rate);

            //$request->session()->put('money',$arrData);
            // $request->session()->save();
            Session::forget('money');
            Session::flush('money');

            return $arrContent['sessionData'] = Session::push('money', $arrData);
        }

        echo view('frontend/index')->with('arrContent', $arrContent)->render();
    }

    public function getAllBannerImage($name) {
        $tableBannerName = config('variables.tbl_banner_name');
        $tableBanner = config('variables.tbl_banner');
        $query = DB::table($tableBanner)->select("$tableBanner.banner_image_name", "$tableBanner.banner_url")->where('banner_name', $name);
        $query->orderBy('created_date', 'DESC');
        $query->join($tableBannerName, "$tableBannerName.id", '=', "$tableBanner.banner_id", 'inner');
        $images = $query->get();

        foreach ($images as $image) {
            //var_dump($image->banner_image_name);exit;
            if (!empty($image->banner_image_name)) {
                $url = 'public/' . config('variables.banner_img');
                //var_dump($url);exit;
                if (!empty($type)) {
                    $url = 'public/' . config('variables.banner_img_thumb');
                }
                //var_dump($image);exit;
                return $arrData = array('image' => url($url . $image->banner_image_name),
                    'url' => $image->banner_url);
                // return url($url . $image->banner_image_name);
            }
        }
    }

    public function signIn(Request $request) {
        //var_dump($request);exit;
//        if (!Auth::check()) {
        $arrContent = array();
        $arrContent['title'] = "Frontend Login";

        if (!empty($request->method()) && $request->method() == "POST") {
            $input = $request->input();

            $email = $input['email'];
            $password = $input['password'];
            $arrUser = $this->getUserDetail($input['email']);

            if (!empty($arrUser) && count($arrUser) > 0) {
                $password = md5($input['password']);

                $credentials = array('email' => $email, 'password' => $password);
                $pass = $input['password'];
//                    if ($arrUser[0]->status == 1) {
                if ($arrUser[0]->password == $password) {
                    if (!empty($input['remember'])) {
                        $remember = TRUE;
                    } else {
                        $remember = FALSE;
                    }
                    $sessionData = $arrUser[0];
                    $sessionData = Session::push('user', $sessionData);


                    return Redirect::to(url('cart'));
                } else {
                    if ($request->ajax() && $request->method() == "POST") {
                        return $result = '2';
                    } else {
                        Session::flash('error', "Your Password does not matched. Try Another");
                        return Redirect::to(url('shipping'));
                    }
                }
            } else {
                if ($request->ajax() && $request->method() == "POST") {
                    return $result = '3';
                } else {
                    Session::flash('error', "You are registered with us. Register Now");
                    return Redirect::to(url('shipping'));
                }
            }
            exit;
        }
        echo view('frontend.auth.login')->with('content', $arrContent)->render();
    }

    public function logout() {
        Session::flush();
        return Redirect::to(url('/'));
    }

    public function getUserDetail($username, $type = '') {
        $tablename = config('variables.tbl_admin');
        $query = DB::table($tablename)->select('*')
                ->where('email', $username);
        if (!empty($type)) {
            $query->where('type', $type);
        }
        $query = $query->get();
        return $query;
    }

    public function register(Request $request) {
        if (!empty($request->input())) {
            $input = $request->input();

            if (!empty($input['email']) && !empty($input['password']) && !empty($input['fullname']) && !empty($input['mobile_no'])) {
                //$salt = \App\library\Customlibrary::genrateSalt($input['password']);
                //var_dump($salt);exit;

                if ($input['password'] == $input['cpassword']) {

                    $arrUserData = array('email' => $input['email'],
                        'password' => md5($input['password']),
                        'full_name' => $input['fullname'],
                        'mobile_no' => $input['mobile_no'],
                        'address1' => $input['address1'],
                        'address2' => $input['address2'],
                        'city' => $input['city'],
                        'profile' => ''
                    );
                } else {
                    Session::flash('error', "Password and Confirm Password are not same");
                    return Redirect::to(url('register'));
                }
                $tablename = config('variables.tbl_admin');
                $query = DB::table($tablename)->select('*')
                        ->where('email', $input['email']);
                $result = $query->get();
                // var_dump($result);exit;
                if ($result) {
                    $query = DB::table($tablename)->insertGetId($arrUserData);
                    //var_dump($query);exit;
                    if (!empty($input['invoice_address']) && $input['invoice_address'] == 'yes') {
                        $arrInvoiceData = array('user_id' => $query,
                            'company_name' => $input['company_name'],
                            'address1' => $input['address1'],
                            'address2' => $input['address2'],
                            'city' => $input['city'],
                            'country' => $input['country'],
                            'postal_code' => $input['postal_code'],
                            'tax_reg_no' => $input['tax_reg_no'],
                            'invoice_address' => '1'
                        );
                        $tablename = config('variables.tbl_invoice_address');
                        $query = DB::table($tablename)->insert($arrInvoiceData);
                    }
//                    $from = config('variables.from_email');
//                    $login = url('login');
//                    $mailData = array('from' => $from,
//                        'subject' => 'Thanks for Registering',
//                        'to' => $input['email'],
//                        'content' => 'You have successfuly Registered' . '</br>' . $login);
//                    $return_mail = \App\library\Customlibrary::mail_send($mailData);
                    //var_dump($return_mail);exit;
                    if (!empty($query)) {

                        $from = config('variables.mail_from');
                        $mail_id = str_replace(' ', '', $input['email']);
                        $arrMail = array('to' => $mail_id,
                            'subject' => 'You have successfully registered from Networks Direct.',
                            'from' => $from);

                        $mailResponse = \App\library\Customlibrary::mail_send($arrMail);
                        Session::flash('success', "You have successfully registered. Login Now");
                        return Redirect::to(url('shipping'));
                    } else {
                        Session::flash('error', "Some Problrem While Registering. Try Again");
                        return Redirect::to(url('register'));
                    }
                } else {
                    Session::flash('error', "This Email Id is already registered. Please Try Another Email Id to Register");
                    return Redirect::to(url('register'));
                }
            } else {
                Session::flash('error', "All field are compalsory please fill all fields");
                return Redirect::to(url('register'));
            }
        }
        $country = \App\library\Customlibrary::getAllCountry();
        echo view('frontend.auth.register')->with('country', $country)->render();
    }

    //My Profile Details for Frontend
    //Author - Sunny Saini
    //Email - sunnysaini466@gmail.com

    public function order_history() {
        if (!Auth::check()) {


            if (Session::get('user')) {
                $arrContent = array();
                $userData = Session::get('user');
                $orders = Self::getOrders($userData[0]->id);
            }

            echo view('frontend.auth.orderhistory')->with('orders', $orders)->render();
        } else {
            return Redirect::to(url('/'));
        }
    }

    public function my_details() {
        if (!Auth::check()) {
            if (Session::get('user')) {
                $arrContent = array();
                $arrContent['userData'] = Session::get('user');
            }
            echo view('frontend.auth.mydetails')->with('arrContent', $arrContent)->render();
        } else {
            return Redirect::to(url('/'));
        }
    }

    public function my_shipping_address() {
        if (Session::get('user')) {
            $arrContent = array();
            $userData = Session::get('user');
            $table = config('variables.tbl_invoice_address');
            $admin = config('variables.tbl_admin');
            $query = DB::table($table)->select("$table.*", "$admin.*");
            $query->join($admin, "$admin.id", '=', "$table.user_id", 'left');
            $query->where($table . '.user_id', $userData[0]->id);
            $arrContent['userData'] = $query->get();
            echo view('frontend.auth.myshippingaddress')->with('arrContent', $arrContent)->render();
        } else {
            return Redirect::to(url('login'));
        }
    }

    public function change_password(Request $request) {
        if (Session::get('user')) {
            $userData = Session::get('user');
            if (!empty($request->method()) && $request->method() == "POST") {
                $input = $request->input();


                $oldPassword = Self::getPassword($userData[0]->id);
                $pass = md5($input['c_password']);
                $newPass = md5($input['n_password']);
                $arrPass = array('password' => $newPass);
                //var_dump($oldPassword[0]->password);exit;
                if ($oldPassword[0]->password == $pass) {

                    $tablename = config('variables.tbl_admin');
                    $query = DB::table($tablename)->where('id', $userData[0]->id)->update($arrPass);
                    Session::flash('success', "Password Changed Successfully");
                    return Redirect::to(url('myaccount/change-password'));
                } else {
                    Session::flash('error', "Password does not matched with your old password");
                    return Redirect::to(url('myaccount/change-password'));
                }
                //var_dump($input);exit;
            }
        }
        echo view('frontend.auth.changepassword')->render();
    }

    public function getPassword($id = '') {
        $table = config('variables.tbl_admin');
        $query = DB::table($table)->select("$table.password");
        $query->where($table . '.id', $id);

        return $query->get();
    }

    public function payments_method() {
        echo view('frontend.auth.paymentmethods')->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function singleproduct() {
        echo view('frontend.auth.singleproduct')->render();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * Author : sunnysaini466@gmail.com
     */
    public function allproducts() {
        echo view('frontend.auth.allproducts')->render();
        //
    }

    public function cart(Request $request) {
        //var_dump($request->input('product_id'));exit;
        if ($request->input('product_id') && ($request->input('increment')) == 1 && ($request->input('rowId'))) {

            $rowId = $request->input('rowId');
            $item = Cart::get($rowId);

            Cart::update($rowId, $item->qty + 1);
        }
        if ($request->input('product_id') && ($request->input('decrease')) == 1 && ($request->input('rowId'))) {
            $rowId = $request->input('rowId');
            $item = Cart::get($rowId);
            Cart::update($item->rowId, $item->qty - 1);
        }

        $cart = Cart::content();
//        $countryCode = VatCalculator::getIPBasedCountry();
//        VatCalculator::calculate( 24.00, $countryCode );
//        var_dump($countryCode);exit;

        echo view('frontend.cart')->with('cart', $cart)->render();
        //
    }

    public function shipping() {
        echo view('frontend.shippingcheckout')->render();
    }

    public function addCart($id = '') {
        $cartData = Self::getCartProducts($id);
        $userData = Session::get('money');
        if (!empty($userData)) {
            //var_dump($userData[0]['rate']);exit;
            $price = $userData[0]['rate'] * $cartData[0]->product_cost;

            Cart::add(array('id' => $cartData[0]->product_slug, 'name' => $cartData[0]->product_name, 'qty' => 1, 'price' => $price));
        } else {
            Cart::add(array('id' => $cartData[0]->product_slug, 'name' => $cartData[0]->product_name, 'qty' => 1, 'price' => $cartData[0]->product_cost));
        }


        $cart = Cart::content();
        //
        echo view('frontend.cart')->with('cart', $cart)->render();
        //
    }

    public function removeCart($id = '') {
        // var_dump($id);exit;
        Cart::remove($id);
        Session::flash('success', "Item removed from Cart");
        return Redirect::to(url('cart'));
    }

    public function removeAllCart() {
        // var_dump($id);exit;
        Cart::destroy();
        Session::flash('success', "Items removed from Cart");
        return Redirect::to(url('cart'));
    }

    public function getCartProducts($id = '') {
        $tablename = config('variables.tbl_products');

        $products = config('variables.tbl_product_img');
        $query = DB::table($tablename)->select("$tablename.*", "$products.product_image");
        $query->join($products, "$tablename.id", '=', "$products.product_id", 'left');


        if (!empty($id)) {
            $query->where($tablename . '.product_slug', $id);
        }
        $query = $query->get();
        return $query;
    }

    public function getLatestProducts() {
        $tablename = config('variables.tbl_products');
        $products = config('variables.tbl_product_img');
        $query = DB::table($tablename)->select("$tablename.*");
        // $query->join($products, "$tablename.id", '=', "$products.product_id", 'left');
        $query->latest('created_at');
        $query->take(5);

        if (!empty($type)) {
            $query->where('type', $type);
        }
        $query = $query->get();
        return $query;
    }

    public function getLatestProductImage($id = '') {
        $products = config('variables.tbl_product_img');
        $query = DB::table($products)->select("$products.product_image");
        $query->take(1);
        if (!empty($id)) {
            $query->where('product_id', $id);
        }
        $query = $query->get();
        return $query;
    }

    public function getAllBrands() {
        $tablename = config('variables.tbl_brands');
        $query = DB::table($tablename)->select("$tablename.brand_image", "$tablename.brand_url");
        $query->latest('created_at');
        $query->take(5);

        return $images = $query->get();
        //var_dump($images);exit;
    }

    public function searchProduct(Request $request) {

        $search = $request->input('product');

        $tablename = config('variables.tbl_products');
        $products = config('variables.tbl_product_img');
        $query = DB::table($tablename)->select("$tablename.*");
        //$query->join($products, "$tablename.id", '=', "$products.product_id", 'left');
        $query->where('product_name', 'like', $search . '%');
        $query->orWhere('menu_name', 'like', $search . '%');
        $query->orWhere('category_name', 'like', $search . '%');
        $query->orWhere('subcategory_name', 'like', $search . '%');
        $categories = Self::getAllCategories();
        $count = $query->get()->count();
        $images = $query->paginate(12);

        //var_dump($images);exit;
        echo view('frontend.auth.products_list')->with('productDetails', $images)->with('searchKey', $search)->with('categories', $categories)->with('count', $count)->render();
    }

    public function product_details($id = '') {
        $productDetails = Self::getCartProducts($id);
        $categories = Self::getAllCategories();
        //var_dump($productDetails);exit;
        echo view('frontend.auth.singleproduct')->with('productDetails', $productDetails)->with('categories', $categories)->render();
    }

    public function getAllCategories() {
        $tablename = config('variables.tbl_products');
        $query = DB::table($tablename)->distinct()->get(['category_name', 'category_id', 'category_slug']);

        if (!empty($id)) {
            $query->where('product_slug', $id);
        }
        //$query = $query->get();
        return $query;
    }

    public function payment(Request $request) {
        $input = $request->input();
        $arrContent = array();
        if (!empty($input['shippingEmail']) && !empty($input['password']) && !empty($input['shippingName']) && !empty($input['shippingPhone']) && !empty($input['shippingAddress']) && !empty($input['shippingAddress2']) && !empty($input['shippingCity']) && !empty($input['shippingZip']) && !empty($input['shippingCountry'])) {
            $userData = Session::get('user');
            $arrInvoiceData = array(
                'address1' => $input['shippingAddress'],
                'address2' => $input['shippingAddress2'],
                'city' => $input['shippingCity'],
                'country' => $input['shippingCountry'],
                'postal_code' => $input['shippingZip'],
                'invoice_address' => '1'
            );
            $arrData = array('full_name' => $input['shippingName'],
                'email' => $input['shippingEmail'],
                'mobile_no' => $input['shippingPhone'],);




            $tablename = config('variables.tbl_invoice_address');
            $query = DB::table($tablename)->update($arrInvoiceData)
                    ->where('user_id', $userData[0]->id);
            $table = config('variables.tbl_admin');
            $query = DB::table($table)->update($arrData)
                    ->where('id', $userData[0]->id);
        }
        //$countryCode = VatCalculator::getIPBasedCountry();
        if ($input['shippingCountry'] = 'GB') {
            $arrContent['vat'] = (Cart::subtotal() * 20) / 100;
            $arrContent['amount'] = ($arrContent['vat'] + Cart::subtotal());
        } else {
            $arrContent['vat'] = 'No Vat For You';
            $arrContent['amount'] = Cart::subtotal();
        }


        echo view('frontend.auth.payment')->with('arrContent', $arrContent)->render();
    }

    public function getOrders($id = '') {
        $tablename = config('variables.tbl_orders');
        $addressTable = config('variables.tbl_invoice_address');
        $admin = config('variables.tbl_admin');
        $query = DB::table($tablename)->select("$tablename.*", "$addressTable.*", "$admin.*");
        $query->join($addressTable, "$addressTable.user_id", '=', "$tablename.user_id", 'left');
        $query->join($admin, "$admin.id", '=', "$tablename.user_id", 'left');
        $query->where($tablename . '.user_id', $id);

        $query->orderBy($tablename . '.id', 'DESC');
        return $order_id = $query->get();
    }

    public function getFrontTitle() {
        $table = config('variables.tbl_frontcat');
        $query = DB::table($table)->select("$table.*");
        $query->limit(1);
        $query->orderBy($table . '.id', 'DESC');
        return $result = $query->get();
    }

    public function getFrontCat($id = '') {
        // var_dump($id);exit;
        $tablename = config('variables.tbl_products');
        $products = config('variables.tbl_product_img');
        $query = DB::table($tablename)->select("$tablename.*");
        //$query->join($products, "$tablename.id", '=', "$products.product_id", 'left');
        $query->where($tablename . '.category_id', $id);

        return $result = $query->get();
    }

    public function getProductImage($id = '') {

        $tablename = config('variables.tbl_product_img');
        $query = DB::table($tablename)->select("$tablename.product_image");
        $query->where($tablename . '.product_id', $id);
        $query->limit(1);
        $query->orderBy($tablename . '.id', 'DESC');
        return $result = $query->get();
        // var_dump($result);exit;
    }

    public function productsByCategory($id = '') {

        $arrContent['products'] = Self::getSubCategory($id);
        $tablename = config('variables.tbl_products');

        $query = DB::table($tablename)->select("$tablename.*");

        $query->where($tablename . '.category_id', $id);
        $count = $query->get()->count();
        $categories = Self::getAllCategories();
        echo view('frontend.auth.allproducts')->with('arrContent', $arrContent)->with('categories', $categories)->with('count', $count)->render();
    }

    public function productsByMenu($id = '') {
        $arrContent['products'] = Self::getAllProduct($id);
        $tablename = config('variables.tbl_products');
        $products = config('variables.tbl_product_img');
        $query = DB::table($tablename)->select("$tablename.*");
        $query->where($tablename . '.menu_name', $id);
        $count = $query->get()->count();
        $categories = Self::getAllCategories();
        echo view('frontend.auth.menuproducts')->with('arrContent', $arrContent)->with('categories', $categories)->with('count', $count)->render();
    }

    public function getAllProduct($id = '') {
        $tablename = config('variables.tbl_products');
        $products = config('variables.tbl_product_img');
        $query = DB::table($tablename)->select("$tablename.*");
        $query->where($tablename . '.menu_name', $id);
        return $result = $query->paginate(12);
    }

    public function getSubCategory($id = '') {
        $tablename = config('variables.tbl_products');

        $query = DB::table($tablename)->select("$tablename.*");
        //$query->join($products, "$tablename.id", '=', "$products.product_id", 'left');
        $query->where($tablename . '.category_id', $id);
        return $result = $query->paginate(12);
    }

    public function productByPrice(Request $request, $id = '') {
        if ($id = 'ASC') {
            //$seg = Request::segment(1);
            $sort = $request->segment(3);
            $cat_id = $request->segment(2);
            $arrContent['products'] = Self::getPriceDesc($cat_id, $sort);
        }
        $categories = Self::getAllCategories();
        echo view('frontend.auth.productbyprice')->with('arrContent', $arrContent)->with('categories', $categories)->render();
    }

    public function productPrice(Request $request, $id = '') {
        if ($id = 'DESC') {
            $sort = $request->segment(3);

            $cat_id = $request->segment(2);
            $arrContent['products'] = Self::getPriceDesc($cat_id, $sort);
        }
        $categories = Self::getAllCategories();
        echo view('frontend.auth.productbyprice')->with('arrContent', $arrContent)->with('categories', $categories)->render();
    }

    public function getPriceDesc($cat_id = '', $price = '') {
        $tablename = config('variables.tbl_products');

        $query = DB::table($tablename)->select("$tablename.*");
        //$query->join($products, "$tablename.id", '=', "$products.product_id", 'left');
        $query->where($tablename . '.category_id', $cat_id);
        $query->orderBy($tablename . '.product_price', $price);
        //
        return $result = $query->paginate(12);
    }

    public function termsCondition() {
        $table = config('variables.tbl_terms');
        $query = DB::table($table)->select("$table.*");

        $result = $query->get();
        echo view('customPages.termsCondition')->with('terms', $result)->render();
    }

    public function aboutUs() {
        $table = config('variables.tbl_aboutus');
        $query = DB::table($table)->select("$table.*");

        $result = $query->get();
        echo view('customPages.aboutUs')->with('aboutUs', $result)->render();
    }

    public function getSwitches($id = '') {
        $tablename = config('variables.tbl_products');
        $query = DB::table($tablename)->distinct();
        $query->where('menu_name', 'like', $id . '%');
        $query->orderBy('category_name', 'ASC');
        return $result = $query->get(['category_name', 'category_id', 'category_slug']);
    }

    public function getSubcategoryData($id = '') {

        $tablename = config('variables.tbl_products');
        $query = DB::table($tablename)->distinct();
        $query->where($tablename . '.category_id', $id);

        return $result = $query->get(['subcategory_name', 'subcategory_id', 'subcategory_link']);
    }

    public function productsBySubcat($id = '') {
        $arrContent['products'] = Self::getAllProductSubcat($id);
        $tablename = config('variables.tbl_products');
        $products = config('variables.tbl_product_img');
        $query = DB::table($tablename)->select("$tablename.*");
        $query->where($tablename . '.subcategory_name', $id);
        $count = $query->get()->count();
        $categories = Self::getAllCategories();
        echo view('frontend.auth.subcatproducts')->with('arrContent', $arrContent)->with('categories', $categories)->with('count', $count)->render();
    }

    public function getAllProductSubcat($id = '') {
        $tablename = config('variables.tbl_products');
        $products = config('variables.tbl_product_img');
        $query = DB::table($tablename)->select("$tablename.*");
        $query->where($tablename . '.subcategory_name', $id);
        return $result = $query->paginate(12);
    }

    public function productsByPriceASC($id = '') {
        $arrContent['products'] = Self::getAllProductPriceASC($id);
        $categories = Self::getAllCategories();
        echo view('frontend.auth.subcatproducts')->with('arrContent', $arrContent)->with('categories', $categories)->render();
    }

    public function getAllProductPriceASC($id = '') {
        $tablename = config('variables.tbl_products');
        $products = config('variables.tbl_product_img');
        $query = DB::table($tablename)->select("$tablename.*", "$products.product_image");
        $query->join($products, "$tablename.id", '=', "$products.product_id", 'left');
        $query->where($tablename . '.subcategory_name', $id);
        $query->orderBy($tablename . '.product_price', 'DESC');
        return $result = $query->paginate(12);
    }

    public function editProfile($id = '') {
        $arrContent['userDetails'] = Self::getUserDetail($id);
        echo view('frontend.auth.editprofile')->with('arrContent', $arrContent)->render();
    }

    public function updateProfile(Request $request) {
        if (!empty($request->method()) && $request->method() == "POST") {
            $input = $request->input();
            if (!empty($input)) {
                //var_dump($input);exit;
                $userData = Session::get('user');
                $tablename = config('variables.tbl_admin');
                $query = DB::table($tablename)->where('id', $userData[0]->id)->update($input);
                Session::flash('success', "Profile Updated Successfully");
                return Redirect::to(url('myaccount/my-details'));
            }
        }
        echo view('frontend.auth.editprofile')->with('arrContent', $arrContent)->render();
    }

    public function subscribe(Request $request) {
        $arrContent = array();
        $arrContent['subcriber'] = Self::getSubscriberDetail();
        if (!empty($arrContent['subcriber'])) {
            if (!empty($request->method()) && $request->method() == "POST") {
                $input = $request->input();
                $subs_email = $input['subs_email'];

                $arrInsert = array('subs_emailid' => $subs_email,
                );
               
                $table = config('variables.tbl_subscribe');

                $data = DB::table($table)->insert($arrInsert);
                Session::flash('success', "You have subscribed Successfully!");
                return Redirect::to(url('/'));
            }
        } else {
             
            Session::flash('success', "You have already subscribed Successfully!");
            return Redirect::to(url('/'));
        }
    }

    public function getSubscriberDetail() {
        $tablename = config('variables.tbl_subscribe');
        $query = DB::table($tablename)->select('*');

        return $result = $query->paginate(12);
    }

}
