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
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Excel;

Class ProductController extends Controller {

    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function index(Request $request) {
        $arrContent = array();
        $arrOptions = array();
        if (!empty($request['s'])) {
            $arrOptions['s'] = $request['s'];
        }
        if (!empty($request['c'])) {
            $arrOptions['c'] = $request['c'];
        }
        if (!empty($request['k'])) {
            $arrOptions['k'] = $request['k'];
        }
        //var_dump($searchString);exit;
        $arrContent['title'] = "Backend Product | Product Desc";
        $arrContent['description'] = "Backend Product | Product Desc";
        $arrContent['products'] = self::getAllProduct('', $arrOptions);
        //echo "<pre>";
        //var_dump($arrContent['products']);exit;
        echo view('backend.product.index')->with('arrContent', $arrContent)->render();
    }

    public function getAllProduct() {
        $table = config('variables.tbl_products');
        $query = DB::table($table)->select("$table.*");
       // $query->where($table . '.product', $id);
        $query->orderBy($table . '.id', 'DESC');
        return $query->paginate(15);
    }

    public function addProduct(Request $request) {
        $arrContent = array();
        $arrContent['title'] = "Add Product | Product Code Banckend";
        $arrContent['description'] = "Add Product | Product Code Banckend";
        if ($request->method() == "POST") {
            $input = \Illuminate\Support\Facades\Input::get();
            if (!empty($input)) {

                if ( !empty($input['subcategory_name'] && $input['category_id'])) {

                    //
                    $table = config('variables.tbl_products');
                    if($input['menu_id'] == 1){
                        $menu_name = 'CISCO SWITCHES';
                    }elseif($input['menu_id'] == 2){
                        $menu_name = 'CISCO ROUTERS';
                    }elseif($input['menu_id'] == 3){
                        $menu_name = 'CISCO SECURITY';
                    }elseif($input['menu_id'] == 4){
                        $menu_name = 'CISCO WIRELESS';
                    }elseif($input['menu_id'] == 5){
                        $menu_name = 'CISCO ACCESSORIES';
                    }elseif($input['menu_id'] == 6){
                        $menu_name = 'CISCO IP PHONES';
                    }elseif($input['menu_id'] == 7){
                        $menu_name = 'CISCO MERAKI';
                    }
                    
                    $table = config('variables.tbl_products');
                    $query = DB::table($table)->select("$table.category_name");
                    $query->where("$table.category_id",$input['category_id']);
                    $query->limit(1);
                    $query->orderBy($table . '.category_id', 'DESC');
                    $result = $query->get();
                    $ab = $result[0]->category_name;
                 // var_dump($input);exit;
                    $dataArray = array(
                        'menu_id' => (!empty($input['menu_id'])) ? $input['menu_id'] : '',
                        'menu_name' => (!empty($menu_name)) ? $menu_name : '',
                        'product_name' => (!empty($input['product_name'])) ? $input['product_name'] : '',
                        'product_slug' => \App\library\Customlibrary::renRateSlug($input['product_name']),
                        'product_description' => (!empty($input['product_description'])) ? $input['product_description'] : '',
                        'category_name' => (!empty($ab)) ? $ab : '',
                        'category_slug'=>\App\library\Customlibrary::renRateSlug($ab),
                        'category_id' => (!empty($input['category_id'])) ? $input['category_id'] : '',
                        'stock' => (!empty($input['stock'])) ? $input['stock'] : '',
                        'product_price' => (!empty($input['product_price'])) ? $input['product_price'] : '',
                        'product_cost' => (!empty($input['product_cost'])) ? $input['product_cost'] : '',
                        'subcategory_name' => (!empty($input['subcategory_name'])) ? $input['subcategory_name'] : '',
                        'subcategory_slug'=>\App\library\Customlibrary::renRateSlug($input['subcategory_name']),
                    );

                    $data = DB::table($table)->insertGetId($dataArray);

                    if ($request->hasFile('product_file')) {
                        $product_img = config('variables.tbl_product_img');
                        $imgpath = config('variables.products_img');
                        $type = 'product_image';
                        foreach ($request->product_file as $files) {

                            $file_name = \App\library\Customlibrary::uploadImageMultiple($files, $imgpath, $type);
                            $arrInsert = array(
                                'product_id' => $data,
                                'product_image' => $file_name,
                                    'product_slug' => \App\library\Customlibrary::renRateSlug($input['product_name']),
                            );
                            $insertSubcategory = DB::table($product_img)->insert($arrInsert);
                        }
                    }
                    if ($data) {
                        Session::flash('success', "Product Added Successfully!");
                        return Redirect::to(url('backend/product/add'));
                    } else {
                        Session::flash('error', "There is some technical issue please try again later");
                        return Redirect::to(url('backend/product/add'));
                    }
                } else {
                    Session::flash('error', "All field are compalsory please fill all fields");
                    return Redirect::to(url('backend/product/add'));
                }
            } else {
                Session::flash('error', "Invalid request");
                return Redirect::to(url('backend/product/add'));
            }
        }

        $arrContent['categories'] = app('App\Http\Controllers\Backend\CategoryController')->getAllCategory();
     
        echo view('backend.product.add')->with('arrContent', $arrContent)->render();
    }

    public function addProductCSV(Request $request) {

        if ($request->method() == "POST") {
            ini_set('max_execution_time', 600);
            if ($request->file('csv_file')) {

                $path = $request->file('csv_file')->getRealPath();
                Excel::filter('chunk')->selectSheetsByIndex(0)->load($path)->chunk(250, function($results) {

                    foreach ($results as $key => $input) {
                        //
                        //var_dump($input);EXIT;
                        $dataArray = array(
                            'menu_id' => (!empty($input->menu_id)) ? $input->menu_id : '',
                            'menu_name' => (!empty($input->menu)) ? $input->menu : '',
                            'category_id' => (!empty($input->category_id)) ? $input->category_id : '',
                            'category_slug' => \App\library\Customlibrary::renRateSlug($input->category),
                            'category_name' => (!empty($input->category)) ? $input->category : '',
                            'subcategory_id' => (!empty($input->subcategory_id)) ? $input->subcategory_id : '',
                            'subcategory_name' => (!empty($input->sub_category)) ? $input->sub_category : '',
                            'subcategory_slug' => \App\library\Customlibrary::renRateSlug($input->sub_category),
                            'product_name' => (!empty($input->products)) ? $input->products : '',
                            'product_slug' => \App\library\Customlibrary::renRateSlug($input->products),
                            'product_description' => (!empty($input->product_description)) ? $input->product_description : '',
                            'product_price' => (!empty($input->original_cost)) ? $input->original_cost : '',
                            'end_sale_date' => (!empty($input->end_of_sale_date)) ? $input->end_of_sale_date : '',
                            'discount_percentage' => (!empty($input->discount_percent)) ? $input->discount_percent : '',
                            'product_cost' => (!empty($input->cost_after_discount)) ? $input->cost_after_discount : '',
                            'stock' => (!empty($input->stock)) ? $input->stock : '',
                        );

                        $table = config('variables.tbl_products');
                        $data = DB::table($table)->insertGetId($dataArray);
                    }
                    if ($data) {

                        Session::flash('success', "Product CSV Added Successfully!");
                        return Redirect::to(url('backend/product/add'));
                    } else {
                        Session::flash('error', "There is some technical issue please try again later");
                        return Redirect::to(url('backend/product/add'));
                    }
                });
            } else {
                Session::flash('error', "All field are compalsory please fill all fields");
                return Redirect::to(url('backend/addProductCSV'));
            }
        }
        echo view('backend.product.addcsv')->render();
    }

    public function action(Request $request) {

        if ($request->ajax() && $request->method() == "POST") {
            $input = $request->input();
            //var_dump($input);
            $html = '';
            $htmlstore = '';
            $status = '';
            $message = '';
            if (!empty($input['data'])) {
                $input = json_decode($input['data']);
                if (!empty($input->type) && $input->type == 'subcat') {
                    $cat_id = $input->cat_id;
                    $subCat = app('App\Http\Controllers\Backend\CategoryController')->getSubCategory($cat_id);
                    //var_dump($subCat);exit;
                    //$sCat = app('App\Http\Controllers\Backend\ProductController')->getSubSubCategory($subcat_id);
                    if (!empty($subCat)) {
                        //$html.="<option value=''>Select Your Subcategory</option>";
                        foreach ($subCat as $sub) {
                            $html .= "<option value='$sub->id'>" . $sub->subcategory_name . "<option>";
                            $message = 'success';
                            $status = 'success';
                        }
                    }

                } else {
                    $status = 'error 102';
                    $message = 'There is something missing please try later';
                }
                //var_dump($input);exit;
            } else {
                $status = 'error 101';
                $message = 'Invalid Request';
            }
            echo json_encode(array('status' => 'success', 'msg' => $message, 'data' => $html));
        }
    }

    public static function getAllProducts($id = '', $arrOptions = array()) {
        //echo $searchString;exit;
        $tbl_product = config('variables.tbl_products');
        $tbl_cat = config('variables.tbl_cat');
        $tbl_subcat = config('variables.tbl_subcat');
        $tbl_product_img = config('variables.tbl_product_img');

        $query = DB::table($tbl_product)->select("$tbl_product.*", "$tbl_cat.category_name", "$tbl_subcat.subcategory_name", "$tbl_product_img.product_image");
        $query->join($tbl_cat, "$tbl_product.category_id", '=', "$tbl_cat.id", 'left');
        $query->join($tbl_subcat, "$tbl_product.subcategory_id", '=', "$tbl_subcat.id", 'left');

        $query->join($tbl_product_img, "$tbl_product.id", '=', "$tbl_product_img.product_id", 'left');

        if (!empty($id)) {
            $query->where('id', $id);
        }
        if (!empty($arrOptions['s'])) {
            $query->where('subcategory_id', $arrOptions['s']);
        }
        if (!empty($arrOptions['c'])) {
            $query->where('category_id', $arrOptions['c']);
        }
        if (!empty($arrOptions['k'])) {
            $query->where('subsubcat_id', $arrOptions['k']);
        }

        return $query->paginate(15);
    }

    public function productedit($id) {
        if (!empty($id)) {

            $arrContent = array();
            $arrContent['title'] = "Edit Product | " . config('variables.admin_title');

            $arrContent['product'] = app('App\Http\Controllers\Backend\ProductController')->getAllProductDetails($id);

            $arrContent['categories'] = app('App\Http\Controllers\Backend\CategoryController')->getAllCategory();
            $arrContent['subcategories'] = app('App\Http\Controllers\Backend\CategoryController')->getSubCategory();
            $arrContent['subsubcat'] = app('App\Http\Controllers\Backend\CategoryController')->getSubCatDatabyStatus($id = '', $status = '');
        }

        echo view('backend.product.edit')->with('arrContent', $arrContent)->render();
    }

    public function editproductubmit(Request $request) {
        if ($request->method() == "POST") {
            $input = \Illuminate\Support\Facades\Input::get();

            if (!empty($input)) {
                //var_dump($input['product_slug']);exit;
                if (!empty($input['product_price']) && !empty($input['product_cost']) && !empty($input['category_name']) && !empty($input['stock']) && !empty($input['product_name']) && !empty($input['product_description'])) {

                    $table = config('variables.tbl_products');

                    $dataArray = array(
                        'product_name' => (!empty($input['product_name'])) ? $input['product_name'] : '',
                        'product_description' => (!empty($input['product_description'])) ? $input['product_description'] : '',
                        'category_name' => (!empty($input['category_name'])) ? $input['category_name'] : '',
                        'stock' => (!empty($input['stock'])) ? $input['stock'] : '',
                        'product_price' => (!empty($input['product_price'])) ? $input['product_price'] : '',
                        'product_cost' => (!empty($input['product_cost'])) ? $input['product_cost'] : '',
                        'subcategory_name' => (!empty($input['subcategory_name'])) ? $input['subcategory_name'] : '',
                    );
                    //var_dump($dataArray);exit;
                    $data = DB::table($table)->where('product_slug', $input['product_slug'])->update($dataArray);

                    //var_dump($request->hasFile('product_file'));exit;
                    if ($request->hasFile('product_file')) {

                        $product_img = config('variables.tbl_product_img');
                        $imgpath = config('variables.products_img');
                        $type = 'product_image';

                        foreach ($request->product_file as $files) {

                            $file_name = \App\library\Customlibrary::uploadImageMultiple($files, $imgpath, $type);
                            $arrInsert = array(
                                'product_id' => $input['product_id'],
                                'product_slug' => $input['product_slug'],
                                'product_image' => $file_name
                            );
                            $insertSubcategory = DB::table($product_img)->insert($arrInsert);
                        }
                    }

                    Session::flash('success', "Product Updated Successfully!");
                    return Redirect::to(url('backend/product/edit') . '/' . $input['product_slug']);
                } else {
                    Session::flash('error', "All field are compalsory please fill all fields");
                    return Redirect::to(url('backend/product/edit') . '/' . $input['product_slug']);
                }
            } else {
                Session::flash('error', "Invalid request");
                return Redirect::to(url('backend/product/edit') . '/' . $input['product_slug']);
            }
        }
    }

    public function productremove($id) {
        if (!empty($id)) {
            $table = config('variables.tbl_products');
            DB::table($table)->where('id', '=', $id)->delete();
            Session::flash('success', "Product removed successfully!");
            return Redirect::to(url('backend/product'));
        } else {
            Session::flash('error', "Invalid parameter");
            return Redirect::to(url('backend/product'));
        }
    }

    public function actionactive(Request $request) {
        if ($request->ajax() && $request->method() == "POST") {
            $input = $request->input();
            $status = '';
            $message = '';
            $arrUpdate = array();
            $getcouponData = '';
            if (!empty($input['data'])) {
                $input = json_decode($input['data']);
                $actval = $input->val;
                $actid = $input->actid;
                $arrUpdate = array('status' => $actval);
                //var_dump($actval);exit;
                $updatecouponData = self::getCouponDataupdate($arrUpdate, $actid);
                $getCouponData = self::getCouponDatabyStatus($actval, $actid);
                //var_dump($getCouponData);exit;
                if (!empty($getCouponData[0])) {
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

    public static function getAllProductDetails($id = '') {
        $tbl_product = config('variables.tbl_products');
        $query = DB::table($tbl_product)->select('*');
        if (!empty($id)) {
            $query->where('product_slug', $id);
        }
        return $query->get();
    }

    public static function getSubSubCategory($id = '') {
        $table = config('variables.tbl_subsubcat');
        //$tableStore = config('variables.tbl_store');
        $query = DB::table($table)->select("$table.*");
        //$query->join($tableStore, "$tableStore.id", '=', "$table.store_id", 'inner');

        if (!empty($id)) {
            $query->where($table . '.sub_category', $id);
        }

        //var_dump($query);exit;
        return $query->paginate(15);
    }

    public function actionSubCat(Request $request) {

        if ($request->ajax() && $request->method() == "POST") {
            $input = $request->input();
            //var_dump($input);
            $html = '';
            $htmlsubcat = '';
            $status = '';
            $message = '';
            if (!empty($input['data'])) {
                $input = json_decode($input['data']);
                if (!empty($input->type) && $input->type == 'subcat') {
                    // $cat_id = $input->cat_id;
                    $subcat_id = $input->subcat_id;

                    $subsubCat = app('App\Http\Controllers\Backend\ProductController')->getSubSubCategory($subcat_id);

                    if (!empty($subsubCat)) {
                        $htmlsubcat .= "<option value=''>Select Your SubCategory</option>";
                        foreach ($subsubCat as $subsubCat) {
                            $htmlsubcat .= "<option value='$subsubCat->id'>" . $subsubCat->subsubcat_name . "<option>";
                            $message = 'success';
                            $status = 'success';
                        }
                    }
                } else {
                    $status = 'error 102';
                    $message = 'There is something missing please try later';
                }
                //var_dump($input);exit;
            } else {
                $status = 'error 101';
                $message = 'Invalid Request';
            }
            echo json_encode(array('status' => 'success', 'msg' => $message, 'data' => $html, 'subcat' => $htmlsubcat));
        }
    }

}
