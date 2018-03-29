<?php

/*
  | Define all controller login here related to backend part
  | Authour : Sunny Saini <sunnysaini466@gmail.com>
  |
 */

namespace App\Http\Controllers\Backend;

use Flash;
use Mail;
use \Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

Class BackendController extends Controller {

    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function login(Request $request) {
        if (!Auth::check()) {
            $arrContent = array();
            $arrContent['title'] = "Backend Login";
            if (!empty($request->method()) && $request->method() == "POST") {
                $input = $request->input();

                $email = $input['email'];
                $password = $input['password'];
                $arrUser = $this->getUserDetail($input['email']);
                if (!empty($arrUser) && count($arrUser) > 0) {
                    $password = \App\library\Customlibrary::encryptPass($input['password'], $arrUser[0]->salt);
                    $credentials = array('email' => $email, 'password' => $password);
                    $pass = $input['password'];
                    if ($arrUser[0]->status == 1) {
                        //var_dump($password);exit;
                        if ($arrUser[0]->password == $password) {
                            if (!empty($input['remember'])) {
                                $remember = TRUE;
                            } else {
                                $remember = FALSE;
                            }
                            if (Auth::attempt(['email' => $email, 'password' => $pass], $remember)) {
                                return Redirect::to(url('backend/home'));
                            }
                        } else {
                            Session::flash('error', "Invalid password you have entered");
                            return Redirect::to(url('backend/auth'));
                        }
                    } else {
                        Session::flash('error', "Account is not activated please contact to super admin");
                        return Redirect::to(url('backend/auth'));
                    }
                } else {
                    Session::flash('error', "Email does not exists");
                    return Redirect::to(url('backend/auth'));
                }


                exit;
            }
            echo view('backend.auth.login')->with('content', $arrContent)->render();
        } else {
            return Redirect::to(url('backend/'));
        }
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

    public function logout() {
        Session::flush();
        return Redirect::to(url('backend/auth'));
    }

    public function index(Request $request) {
        $arrContent = array();
        $arrContent['title'] = "Backend Home | Login";
        $arrContent['description'] = "Backend Home | Login";
        $arrContent['products'] = self::dashBoardCount('products');
        $arrContent['orders'] = self::dashBoardCount('orders');
        $arrContent['total_sale'] = self::lifeTimeSale();
        echo view('backend.index')
                ->with('arrContent', $arrContent)->render();
    }

    public static function dashBoardCount($type = '') {
        if (!empty($type) && $type == 'products') {
            $table = config('variables.tbl_products');
            return $query = DB::table($table)->select(DB::raw("count(*) as count"))->first();
        } else if (!empty($type) && $type == 'orders') {
            $table = config('variables.tbl_orders');
            $query = DB::table($table)->select("$table.*");
            $query->limit(5);
            $query->orderBy($table . '.id', 'DESC');
            return $result = $query->get();
        }
    }
    public function lifeTimeSale(){
        $tableOrders = config('variables.tbl_orders');
       return $query = DB::table($tableOrders)->sum('total_price');
        
    }

    public function userprofile(Request $request) {
        $data = $request->session()->all();
        //var_dump($data);exit;

        $arrContent = array();
        $arrContent['title'] = "ATS User Profile";
        $arrContent['email'] = Auth::User()->email;
        $arrContent['mobile'] = Auth::User()->mobile_no;
        $arrContent['full_name'] = Auth::User()->full_name;
        $arrContent['city'] = Auth::User()->city;
        $arrContent['address'] = Auth::User()->address1;
        //$arrContent['dobstart'] = Auth::User()->date_of_birthstart;
        //$arrContent['dobend'] = Auth::User()->date_of_birthend;
        echo view('backend.auth.profile')->with('content', $arrContent);
    }

    public function userprofilesub(Request $request) {
        if (!empty($request->method()) && $request->method() == "POST") {
            $input = $request->input();
            $user_name = $input['admin_name'];
            //$user_email = $input['admin_email'];
            $user_phoneno = $input['admin_phoneno'];
            $user_address = $input['admin_address'];
            $user_city = $input['admin_city'];
            //$dob = $input['admin_dob'];
            $id = Auth::User()->id;

            $param = array('Name' => $user_name,
                'mobile_no' => $user_phoneno,
                'address' => $user_address,
                'city' => $user_city,
            );

            if ($request->hasFile('admin_image')) {
                $path = config('variables.admin_avatar');
                $imagename = \App\library\Customlibrary::uploadImage('admin_image', $path);
                $param['profile'] = $imagename;
            }
            $arrUserdetail = $this->updateAdmindetails($param, $id);
            Session::flash('EditSuccess', "Admin Profile Updated Successfully");
            return Redirect::to(url("backend/profile"));
        }
    }

    public function updateAdmindetails($param, $id) {
        $tablename = config('variables.tbl_admin');
        $query = DB::table($tablename)->where('id', $id)->update($param);
        return $query;
    }

    public function banner() {
        $arrContent = array();
        $arrContent['title'] = "Banner Management | Coupont Code Banckend";
        $arrContent['description'] = "Banner Management | Coupont Code Banckend";
        $arrContent['banner'] = app('App\Http\Controllers\backend\BackendController')->getAllBannerImage();
        //var_dump($arrContent['banner']);exit;
        echo view('backend.banners.index')->with('arrContent', $arrContent)->render();
    }

    public function addBanners(Request $request) {
        $arrContent = array();
        $arrContent['title'] = "Add Banners";
        $arrContent['description'] = "Add Banners Backend Home";
        if ($request->method() == "POST") {
            $input = \Illuminate\Support\Facades\Input::get();
            if (!empty($input)) {
                if (!empty($input['banner']) && !empty($input['banner_url']) && $request->hasFile('banner_file')) {

                    $table = config('variables.tbl_banner');
                    $path = config('variables.banner_img');
                    $files = $request->banner_file;
                    //foreach ($request->banner_file as $files) {
                    $type = 'banner';
                    //$file = $request->aboutus_image;

                    $file_name = \App\library\Customlibrary::uploadImageMultiple($files, $path, $type);

                    $arrInsert = array(
                        'banner_id' => $input['banner'],
                        'banner_image_name' => $file_name,
                        'banner_url' => (!empty($input['banner_url'])) ? $input['banner_url'] : '',
                    );
                    $data = DB::table($table)->insert($arrInsert);
                    //}

                    if ($data) {
                        Session::flash('success', "Banner Added Successfully!");
                        return Redirect::to(url('backend/banner/add'));
                    } else {
                        Session::flash('error', "There is some technical issue please try again later");
                        return Redirect::to(url('backend/banner/add'));
                    }
                } else {
                    Session::flash('error', "All field are compalsory please fill all fields");
                    return Redirect::to(url('backend/banner/add'));
                }
            } else {
                Session::flash('error', "Invalid request");
                return Redirect::to(url('backend/banner/add'));
            }
        }
        $arrContent['banner'] = app('App\Http\Controllers\Backend\BackendController')->getAllBanner();
        echo view('backend.banners.add')->with('arrContent', $arrContent)->render();
    }

    public static function getAllBanner($type = '') {

        $tableBannerName = config('variables.tbl_banner_name');
        $query = DB::table($tableBannerName)->select("$tableBannerName.*");

        return $query->paginate(15);
    }

    public static function getAllBannerImage($type = '') {

        $tableBannerName = config('variables.tbl_banner_name');
        $tableBanner = config('variables.tbl_banner');
        $query = DB::table($tableBanner)->select("$tableBanner.*", "$tableBannerName.banner_name");
        $query->join($tableBannerName, "$tableBannerName.id", '=', "$tableBanner.banner_id", 'inner');

        return $query->paginate(15);
    }

    public function bannerremove(Request $request, $id = '') {
        if (!empty($id)) {
            $table = config('variables.tbl_banner');
            DB::table($table)->where('id', '=', $id)->delete();
            Session::flash('success', "Banner removed successfully!");
            return Redirect::to(url('backend/banner'));
        } else {
            Session::flash('error', "Invalid parameter");

            return Redirect::to(url('backend/banner'));
        }
    }

    public function banneractive(Request $request) {
        if ($request->ajax() && $request->method() == "POST") {
            $input = $request->input();
            $status = '';
            $message = '';
            $arrUpdate = array();
            $getCategoryData = '';
            if (!empty($input['data'])) {
                $input = json_decode($input['data']);
                $actval = $input->val;
                $actid = $input->actid;
                $arrUpdate = array('status' => $actval);
                //var_dump($actval);exit;
                $table = config('variables.tbl_banner');
                $updatebannerData = DB::table($table)->where('id', $actid)->update($arrUpdate);
                $getBannerData = self::getBannerDatabyStatus($actval, $actid);
                //var_dump($getCouponData);exit;
                if (!empty($getSubCategoryData[0])) {
                    $status = 'success';
                    $message = 'Coupon code Allready Exist';
                } else {
                    $status = 'success';
                    $message = 'sucess';
                }

                //var_dump($input);exit;
            }
            echo json_encode(array('status' => $status, 'msg' => $message));
        }
    }

    public static function getBannerDatabyStatus($actData, $id) {
        $table = config('variables.tbl_banner');
        $query = DB::table($table)->select("$table.*");
        if (!empty($id)) {
            $query->where($table . '.id', $id);
            $query->where($table . '.status', $actData);
        }

        return $query->get();
    }

    public function products() {
        $arrContent = array();
        $arrContent['title'] = "Banner Management | Coupont Code Banckend";
        $arrContent['description'] = "Banner Management | Coupont Code Banckend";
        $arrContent['banner'] = app('App\Http\Controllers\backend\BackendController')->getAllBanner();
        echo view('backend.products.products_list')->render();
    }

    public function menu(Request $request) {
        $arrContent = array();
        if ($request->method() == "POST") {
            $input = \Illuminate\Support\Facades\Input::get();
            if (!empty($input)) {
                //var_dump($input);exit;
                if (!empty($input['menu_name']) && !empty($input['menu_url'])) {
                    $table = config('variables.tbl_menu');
                    $arrInsert = array(
                        'menu_name' => $input['menu_name'],
                        'menu_url' => $input['menu_url'],
                    );
                    $data = DB::table($table)->insert($arrInsert);
                    if ($data) {
                        Session::flash('success', "Category Added Successfully!");
                        return Redirect::to(url('backend/menu/add'));
                    } else {
                        Session::flash('error', "There is some technical issue please try again later");
                        return Redirect::to(url('backend/menu/add'));
                    }
                } else {
                    Session::flash('error', "All field are compalsory please fill all fields");
                    return Redirect::to(url('backend/menu/add'));
                }
            }
        }
        echo view('backend.menu.addMenu')->render();
    }

    public function menu_list() {
        $arrContent = array();
        $arrContent['title'] = "Menu List | " . config('variables.admin_title');
        $arrContent['menus'] = self::getAllMenu();
        echo view('backend.menu.index')->with('arrContent', $arrContent)->render();
    }

    public function menuremove($id) {
        if (!empty($id)) {
            $table = config('variables.tbl_menu');
            DB::table($table)->where('id', '=', $id)->delete();
            Session::flash('success', "Menu removed successfully!");
            return Redirect::to(url('backend/menu'));
        } else {
            Session::flash('error', "Invalid parameter");
            return Redirect::to(url('backend/menu'));
        }
    }

    public static function getAllMenu() {
        $table = config('variables.tbl_menu');
        $query = DB::table($table)->select('*');
        $query->orderBy('id', 'DESC');
        return $query->paginate(15);
    }

    public static function getAllSubMenu() {
        $table = config('variables.tbl_submenu');
        $tableCat = config('variables.tbl_menu');
        $query = DB::table($table)->select("$table.*", "$tableCat.menu_name as menu_name");
        $query->join($tableCat, "$tableCat.id", '=', "$table.menu_id", 'inner');
        if (!empty($type) && $type == 'slug') {
            if (!empty($id)) {
                $query->where('slug', $id);
            }
        } else if (!empty($type) && $type == 'subslug') {
            if (!empty($id) && !empty($subslug)) {
                $query->where($tableCat . '.slug', $id);
                $query->where($table . '.slug', $subslug);
            }
        } else {
            if (!empty($id)) {
                $query->where($table . '.menu_id', $id);
            }
        }
        $query->orderBy($table . '.id', 'DESC');
        return $query->paginate(15);
    }

    public function submenu(Request $request) {
        $arrContent = array();
        $arrContent['menus'] = app('App\Http\Controllers\backend\BackendController')->getAllMenu();
        if ($request->method() == "POST") {
            $input = \Illuminate\Support\Facades\Input::get();
            if (!empty($input)) {
                if (!empty($input['submenu_name']) && !empty($input['submenu_url']) && !empty($input['menu_id'])) {
                    $table = config('variables.tbl_submenu');
                    $arrInsert = array(
                        'submenu_name' => $input['submenu_name'],
                        'submenu_url' => $input['submenu_url'],
                        'menu_id' => $input['menu_id']
                    );
                    $data = DB::table($table)->insert($arrInsert);
                    if ($data) {
                        Session::flash('success', "Sub Menu Added Successfully!");
                        return Redirect::to(url('backend/submenu/add'));
                    } else {
                        Session::flash('error', "There is some technical issue please try again later");
                        return Redirect::to(url('backend/submenu/add'));
                    }
                } else {
                    Session::flash('error', "All field are compalsory please fill all fields");
                    return Redirect::to(url('backend/submenu/add'));
                }
            }
        }
        echo view('backend.submenu.addSubmenu')->with('arrContent', $arrContent)->render();
    }

    public function submenu_list() {
        $arrContent = array();
        $arrContent['title'] = "Menu List | " . config('variables.admin_title');
        $arrContent['submenus'] = self::getAllSubMenu();
        echo view('backend.submenu.index')->with('arrContent', $arrContent)->render();
    }

    public function menuactive(Request $request) {
        if ($request->ajax() && $request->method() == "POST") {
            $input = $request->input();
            $status = '';
            $message = '';
            $arrUpdate = array();
            $getCategoryData = '';
            if (!empty($input['data'])) {
                $input = json_decode($input['data']);
                $actval = $input->val;
                $actid = $input->actid;
                $arrUpdate = array('status' => $actval);
                //var_dump($actval);exit;
                $table = config('variables.tbl_menu');
                $updatecategoryData = DB::table($table)->where('id', $actid)->update($arrUpdate);
                $getCategoryData = self::getMenuDatabyStatus($actval, $actid);
                //var_dump($getCouponData);exit;
                if (!empty($getCategoryData[0])) {
                    $status = 'success';
                    $message = 'Coupon code Allready Exist';
                } else {
                    $status = 'success';
                    $message = 'sucess';
                }

                //var_dump($input);exit;
            }
            echo json_encode(array('status' => $status, 'msg' => $message));
        }
    }

    public static function getMenuDatabyStatus($actData, $id) {
        $table = config('variables.tbl_menu');
        $query = DB::table($table)->select("$table.*");
        if (!empty($id)) {
            $query->where($table . '.id', $id);
            $query->where($table . '.status', $actData);
        }

        return $query->get();
    }

    public function add_aboutUs(Request $request) {
        $arrContent = array();
        if ($request->method() == "POST") {
            $input = \Illuminate\Support\Facades\Input::get();
            if (!empty($input['about_id'])) {

                $tbl_about = config('variables.tbl_aboutus');
                $id = $input['about_id'];
                $file = $request->aboutus_image;
                $imgpath = config('variables.aboutus_img');
                $type = 'aboutus_image';
                $file_name = \App\library\Customlibrary::uploadImage($file, $imgpath, $type);
                //var_dump($id);exit;
                $arrInsert = array(
                    'aboutus_title' => $input['title'],
                    'aboutus_desc' => $input['description'],
                    'aboutus_image' => $file_name);
                $insertTerms = DB::table($tbl_about)->where('id', $id)->update($arrInsert);
                Session::flash('success', "Page Updated Successfully!");
                return Redirect::to(url('backend/aboutus'));
            }
            if (!empty($input) && $request->hasFile('aboutus_image')) {
                $file = $request->aboutus_image;
                $tbl_about = config('variables.tbl_aboutus');
                $imgpath = config('variables.aboutus_img');
                $type = 'aboutus_image';
                $file_name = \App\library\Customlibrary::uploadImage($file, $imgpath, $type);
                $arrInsert = array(
                    'aboutus_title' => $input['title'],
                    'aboutus_desc' => $input['description'],
                    'aboutus_image' => $file_name);
                $insertAboutus = DB::table($tbl_about)->insert($arrInsert);
            } else {
                Session::flash('error', "All field are compalsory please fill all fields");
                return Redirect::to(url('backend/aboutus'));
            } if ($insertAboutus) {
                Session::flash('success', "Page Added Successfully!");
                return Redirect::to(url('backend/aboutus'));
            } else {
                Session::flash('error', "There is some technical issue please try again later");
                return Redirect::to(url('backend/aboutus'));
            }
        }
        $arrContent['aboutData'] = self::getAboutData();
        //var_dump($arrContent['aboutData']);exit;
        echo view('backend.custom_pages.about')->with('arrContent', $arrContent)->render();
    }

    public function terms(Request $request) {
        $arrContent = array();
        if ($request->method() == "POST") {
            $input = \Illuminate\Support\Facades\Input::get();

            if (!empty($input['terms_id'])) {

                $tbl_terms = config('variables.tbl_terms');
                $id = $input['terms_id'];
                //var_dump($id);exit;
                $arrInsert = array(
                    'title' => $input['title'],
                    'description' => $input['description']);
                $insertTerms = DB::table($tbl_terms)->where('id', $id)->update($arrInsert);
                Session::flash('success', "Page Updated Successfully!");
                return Redirect::to(url('backend/terms'));
            }
            if (!empty($input)) {
                $file = $request->aboutus_image;
                $tbl_terms = config('variables.tbl_terms');
                $arrInsert = array(
                    'title' => $input['title'],
                    'description' => $input['description']);
                $insertTerms = DB::table($tbl_terms)->insert($arrInsert);
            } else {
                Session::flash('error', "All field are compalsory please fill all fields");
                return Redirect::to(url('backend/terms'));
            } if ($insertTerms) {
                Session::flash('success', "Page Added Successfully!");
                return Redirect::to(url('backend/terms'));
            } else {
                Session::flash('error', "There is some technical issue please try again later");
                return Redirect::to(url('backend/terms'));
            }
        }
        $arrContent['termsData'] = self::getTermsData();
        echo view('backend.custom_pages.terms')->with('arrContent', $arrContent)->render();
    }

    public function getAboutData($id = '') {
        $tbl_about = config('variables.tbl_aboutus');
        $query = DB::table($tbl_about)->select("$tbl_about.*");
        if (!empty($id)) {
            $query->where($table . '.sub_category', $id);
        }
        return $query->paginate(15);
    }

    public function getTermsData($id = '') {
        $tbl_terms = config('variables.tbl_terms');
        $query = DB::table($tbl_terms)->select("$tbl_terms.*");
        if (!empty($id)) {
            $query->where($table . '.sub_category', $id);
        }
        return $query->paginate(15);
    }

    public function allUsers() {
        $arrContent = array();
        $arrContent['users'] = self::getAllUsers();
        echo view('backend.allUsers')->with('arrContent', $arrContent)->render();
    }

    public function getAllUsers() {
        $table = config('variables.tbl_admin');
        $query = DB::table($table)->select("$table.*");
        $query->where($table . '.type', '2');

        return $query->paginate(15);
    }

    public function addBrand(Request $request) {

        $arrContent = array();
        $arrContent['title'] = "Backend Login";
        if (!empty($request->method()) && $request->method() == "POST") {
            $input = $request->input();

            if (!empty($input['brand_url']) && $request->hasFile('brand_image')) {

                $table = config('variables.tbl_brands');
                $path = config('variables.brand_img');
                $files = $request->brand_image;
                //foreach ($request->banner_file as $files) {
                $type = 'brand';
                //$file = $request->aboutus_image;

                $file_name = \App\library\Customlibrary::uploadImageMultiple($files, $path, $type);

                $arrInsert = array(
                    'brand_image' => $file_name,
                    'brand_url' => (!empty($input['brand_url'])) ? $input['brand_url'] : '',
                );
                $data = DB::table($table)->insert($arrInsert);
                //}

                if ($data) {
                    Session::flash('success', "Brand Added Successfully!");
                    return Redirect::to(url('backend/addBrand'));
                } else {
                    Session::flash('error', "There is some technical issue please try again later");
                    return Redirect::to(url('backend/addBrand'));
                }
            } else {
                Session::flash('error', "All field are compalsory please fill all fields");
                return Redirect::to(url('backend/addBrand'));
            }
        }
        echo view('backend.addBrand')->with('arrContent', $arrContent)->render();
    }

    public function ordersList(Request $request) {
        $arrContent['orders'] = self::fetchAllOrders();
        if (!empty($request->method()) && $request->method() == "POST") {
            $input = $request->input();
            $status = $input['status'];
            $arrData = array('status' => $status);
            $order_id = $input['order_id'];
            $email_id = $input['email_id'];

            $tableOrders = config('variables.tbl_orders');
            $insertTerms = DB::table($tableOrders)->where('order_id', $order_id)->update($arrData);

            if ($insertTerms) {

                $from = config('variables.mail_from');

                $mail_id = str_replace(' ', '', $email_id);
                $arrMail = array('to' => $mail_id,
                    'subject' => 'Your have successfully dispathed from Networks Direct.',
                    'from' => $from);

                $mailResponse = \App\library\Customlibrary::mail_send($arrMail);

                //mail send to admin
                //$userName = $userData[0]->full_name;
                $arrMailAdmin = array('to' => $from,
                    'subject' => " '$order_id' order have successfully dispath from Networks Direct.",
                    'from' => $from);
                $mailResponse = \App\library\Customlibrary::mail_admin($arrMailAdmin);
            }
            Session::flash('success', "Status Updated Successfully!");
            //return Redirect::to(url('ordersList'));
        }
        $tableOrders = config('variables.tbl_orders');
        $arrInsert = array(
                    'notification' => 0);
         $insertTerms = DB::table($tableOrders)->where('notification', '1')->update($arrInsert);
        echo view('backend.orders.allOrders')->with('arrContent', $arrContent)->render();
    }
     public function getNotification() {
        $tablename = config('variables.tbl_orders');
        $query = DB::table($tablename)->select("$tablename.*");
        $query->where($tablename . '.notification', 1);
        return $result = $query->get()->count();
    }

    public function fetchAllOrders() {
        $tableOrders = config('variables.tbl_orders');
        $tableAdmin = config('variables.tbl_admin');
        $query = DB::table($tableOrders)->select("$tableOrders.*", "$tableAdmin.full_name", "$tableAdmin.email");
        $query->join($tableAdmin, "$tableAdmin.id", '=', "$tableOrders.user_id", 'inner');
        $query->orderBy($tableOrders . '.id', 'DESC');
        return $query->paginate(15);
    }

    public function frontCategory(Request $request) {
        $arrContent = array();
        $arrContent['category'] = Self::fetchCategory();
        if (!empty($request->method()) && $request->method() == "POST") {
            $input = $request->input();
            $frontCat = $input['frontCat'];
            $title = $input['title'];
            $arrInsert = array('category_id' => $frontCat,
                'title' => $title);
            $table = config('variables.tbl_frontcat');

            $data = DB::table($table)->insert($arrInsert);
            Session::flash('success', "Cat Updated Successfully!");
        }
        // $arrContent['fetchCategory'] = Self::fetchFrontCategory();
        //var_dump($arrContent['category']);exit;
        echo view('backend.frontCategory.add')->with('arrContent', $arrContent)->render();
    }

    public function fetchCategory() {
        $tablename = config('variables.tbl_products');
        $query = DB::table($tablename)->distinct()->get(['category_name', 'category_id']);
        return $query;
    }
    
    public function selectCategory(Request $request) {
        $tablename = config('variables.tbl_products');
        $html = '';
            $htmlstore = '';
            $status = '';
            $message = '';
            $arrContent = array();
        if (!empty($request->method()) && $request->method() == "POST") {
            $input = $request->input();
            $input = json_decode($input['data']);
            $data = self::fetchMainCategory($input->menu_id);
            $data = (array) $data;
        if (!empty($data)) {
                       
                        foreach ($data as $sub) {
                            foreach($sub as $sub){
                            $html .= "<option value='$sub->category_id'>" . $sub->category_name . "<option>";
                            $message = 'success';
                            $status = 'success';
                            }
                        }
                    }
                    echo json_encode(array('status' => 'success', 'msg' => $message, 'data' => $html));
        }
    }
    public function selectCategories(Request $request) {
        $tablename = config('variables.tbl_products');
        $html = '';
            $htmlstore = '';
            $status = '';
            $message = '';
            $arrContent = array();
        if (!empty($request->method()) && $request->method() == "POST") {
            $input = $request->input();
            $input = json_decode($input['data']);
            $data = self::fetchMainCategory($input->menu_id);
            $data = (array) $data;
        if (!empty($data)) {
                       
                        foreach ($data as $sub) {
                            foreach($sub as $sub){
                                
                            $html .= "<td>" . $sub->category_name . "</td>";
                            $message = 'success';
                            $status = 'success';
                            }
                        }
                    }
                    echo json_encode(array('status' => 'success', 'msg' => $message, 'data' => $html));
        }
    }

    public function fetchFrontCategory() {
        $table = config('variables.tbl_frontcat');
        $query = DB::table($table)->select("$table.*");
        return $query;
    }
    public function fetchMainCategory($id = '') {
        $tablename = config('variables.tbl_products');
        $query = DB::table($tablename)->distinct();
        $query->where('menu_id', 'like', $id . '%');

        return $result = $query->get(['category_name', 'category_id', 'category_slug']);
    }

    public function lastOrders() {
        $arrContent = array();
        $arrContent['title'] = "Orders List | " . config('variables.admin_title');
        $arrContent['orders'] = self::fetchLastOrders();
        echo view('backend.orders.lastorders')->with('arrContent', $arrContent)->render();
    }

    public function fetchLastOrders() {
        $tableOrders = config('variables.tbl_orders');
        $tableAdmin = config('variables.tbl_admin');
        $query = DB::table($tableOrders)->select("$tableOrders.*", "$tableAdmin.full_name", "$tableAdmin.email");
        $query->join($tableAdmin, "$tableAdmin.id", '=', "$tableOrders.user_id", 'inner');
        $query->orderBy($tableOrders . '.id', 'DESC');
        $query->limit(5);
        return $result = $query->get();
    }

}
