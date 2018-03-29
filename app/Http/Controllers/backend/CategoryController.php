<?php

/*
  | Define all login related categopry and sub category
  | Authour Sunny Saini <sunnysaini466@gmail.com>
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

Class CategoryController extends Controller {

    public function add(Request $request) {
        $arrContent = array();
        $arrContent['title'] = "Create Category | " . config('variables.admin_title');

        if ($request->method() == "POST") {
            $input = \Illuminate\Support\Facades\Input::get();
            if (!empty($input)) {
                if (!empty($input['category_name']) && !empty($input['menu_id'])) {
                    $table = config('variables.tbl_cat');
                    
                    $table = config('variables.tbl_products');
                    $query = DB::table($table)->select("$table.category_id");
                    $query->where("$table.menu_id",$input['menu_id']);
                    $query->limit(1);
                    $query->orderBy($table . '.category_id', 'DESC');
                    $result = $query->get();
                    $ab = $result[0]->category_id + 1;
                    //var_dump($ab);exit;
                    
                    
                    $arrInsert = array(
                        'category_name' => $input['category_name'],
                        'category_id' => $ab,
                        'menu_id' => $input['menu_id'],
                        'menu_name' => 'Cisco Switches',
                        'category_slug' => \App\library\Customlibrary::renRateSlug($input['category_name'])
                    );
                    //var_dump($arrInsert);exit;
                    $data = DB::table($table)->insert($arrInsert);
                    if ($data) {
                        Session::flash('success', "Category Added Successfully!");
                        return Redirect::to(url('backend/category/add'));
                    } else {
                        Session::flash('error', "There is some technical issue please try again later");
                        return Redirect::to(url('backend/category/add'));
                    }
                } else {
                    Session::flash('error', "All field are compalsory please fill all fields");
                    return Redirect::to(url('backend/category/add'));
                }
            } else {
                Session::flash('error', "Invalid request");
                return Redirect::to(url('backend/category/add'));
            }
        }

        echo view('backend.category.add')->with('arrContent', $arrContent)->render();
    }

    public function index(Request $request) {
        $arrContent = array();
        $arrContent['title'] = "Category List | " . config('variables.admin_title');
        $arrContent['categories'] = self::fetchMainCategory();
        echo view('backend.category.index')->with('arrContent', $arrContent)->render();
    }
    public function fetchMainCategory($id = '') {
        $tablename = config('variables.tbl_products');
        $query = DB::table($tablename)->distinct();
        //$query->orderBy('category_name', 'ASC');
return $query->paginate(15, ["$tablename.category_name","$tablename.category_id","$tablename.menu_name"]);
        
    }

    public static function getAllCategory($id = '', $type = '') {
        $table = config('variables.tbl_products');
        $query = DB::table($table)->select("$table.*");
       
            if (!empty($id)) {
                $query->where('category_id', $id);
            }
       
       
        //$query->orderBy('created_date', 'DESC');
        return $query->paginate(15);
    }

    public function remove(Request $request, $id = '') {
        if (!empty($id)) {
            $table = config('variables.tbl_cat');
            DB::table($table)->where('id', '=', $id)->delete();
            Session::flash('success', "Category removed successfully!");
            return Redirect::to(url('backend/category'));
        } else {
            Session::flash('error', "Invalid parameter");
            return Redirect::to(url('backend/category'));
        }
    }

    public function edit($id = '') {
        if (!empty($id)) {
            $arrContent = array();
            $arrContent['title'] = "Edit Category | " . config('variables.admin_title');
            $arrContent['category'] = $this->getAllCategory($id);
        }

        echo view('backend.category.edit')->with('arrContent', $arrContent)->render();
    }

    public function edit_submit(Request $request) {

        if ($request->method() == "POST") {
            $input = \Illuminate\Support\Facades\Input::get();
            //var_dump($input);exit;
            if (!empty($input)) {
                if (!empty($input['category_name'])) {
                    $table = config('variables.tbl_products');
                    $id = $input['hidcategory_id'];
                    $arrUpdate = array(
                        'category_name' => $input['category_name']
                        
                    );
                    //var_dump($arrUpdate);exit;

                    $data = DB::table($table)->where('category_id', $id)->update($arrUpdate);
                    Session::flash('success', "Category Updated Successfully!");
                    return Redirect::to(url('backend/category'));
                } else {
                    Session::flash('error', "All field are compalsory please fill all fields");
                    return Redirect::to(url('backend/category/edit'. $id));
                }
            } else {
                Session::flash('error', "Invalid request");
                return Redirect::to(url('backend/category/edit' . $id));
            }
        } else {
            Session::flash('error', "Invalid parameter");
            return Redirect::to(url('backend/category'));
        }
    }

    /*
      | Subcategory related login for backend will be define here
      |
     */

    public function addSubCat(Request $request) {
        $arrContent = array();
        $arrContent['title'] = "Create Sub Category | " . config('variables.admin_title');
        $arrContent['categories'] = app('App\Http\Controllers\Backend\BackendController')->fetchCategory();
        if ($request->method() == "POST") {
            $input = \Illuminate\Support\Facades\Input::get();
            if (!empty($input)) {
                if (!empty($input['subcategory_name']) && !empty($input['subcategory_link']) && !empty($input['menu_id'])  && !empty($input['category_id'])) {
                  
                    $table = config('variables.tbl_products');
//                    $query = DB::table($table)->select("$table.subcategory_id");
//                    $query->where("$table.menu_id",$input['menu_id']);
//                    $query->limit(1);
//                    $query->orderBy($table . '.subcategory_id', 'DESC');
//                    $result = $query->get();
//                    var_dump($result[0]->subcategory_id);exit;
//                    $ab = $result[0]->subcategory_id + 1;
                    
                    
                    $query = DB::table($table)->select("$table.menu_name");
                    $query->where("$table.menu_id",$input['menu_id']);
                    $query->limit(1);
                    $results = $query->get();
                    
                    
                    $query = DB::table($table)->select("$table.category_name","$table.category_slug");
                    $query->where("$table.category_id",$input['category_id']);
                    $query->limit(1);
                    $result = $query->get();
                   // var_dump($result[0]->category_name);exit;
                    
                    
                    
                    $arrInsert = array(
                        'subcategory_name' => $input['subcategory_name'],
                        //'subcategory_id' => $ab,
                        'subcategory_link' => $input['subcategory_link'],
                        'menu_id' => $input['menu_id'],
                        'menu_name'=> $results[0]->menu_name,
                        'category_id' => $input['category_id'],
                        'category_name'=>$result[0]->category_name,
                        'category_slug'=>$result[0]->category_slug,
                        'subcategory_slug' => \App\library\Customlibrary::renRateSlug($input['subcategory_name'])
                    );
                    //$data = DB::table($table)->insert($arrInsert);
                    $data = DB::table($table)->insert($arrInsert);
//                    $data = DB::table($table)->where('menu_id', $input['menu_id'])->where('category_id', $input['category_id'])->update($arrInsert);
                    if ($data) {
                        Session::flash('success', "Sub Category Added Successfully!");
                        return Redirect::to(url('backend/subcategory/add'));
                    } else {
                        Session::flash('error', "There is some technical issue please try again later");
                        return Redirect::to(url('backend/subcategory/add'));
                    }
                } else {
                    Session::flash('error', "All field are compalsory please fill all fields");
                    return Redirect::to(url('backend/subcategory/add'));
                }
            } else {
                Session::flash('error', "Invalid request");
                return Redirect::to(url('backend/subcategory/add'));
            }
        }

        echo view('backend.subcategory.add')->with('arrContent', $arrContent)->render();
    }

    public static function getSubCategory($id = '', $type = '', $subslug = '') {
        $table = config('variables.tbl_subcat');
        $tableCat = config('variables.tbl_cat');
        $query = DB::table($table)->select("$table.*", "$tableCat.category_name as cat", "$tableCat.slug as cat_slug");
        $query->join($tableCat, "$tableCat.id", '=', "$table.parent_category", 'inner');
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
                $query->where($table . '.parent_category', $id);
            }
        }
        $query->orderBy($table . '.created_date', 'DESC');
        return $query->paginate(15);
    }

    public function subcategory(Request $request, $id = '') {
        $arrContent = array();
        $arrContent['title'] = "Sub Category List | " . config('variables.admin_title');
        $arrContent['subcategories'] = self::getAllSubCategory();
        //dd($arrContent['subcategories']);
        echo view('backend.subcategory.index')->with('arrContent', $arrContent)->render();
    }
    public function getAllSubCategory(){
        $table = config('variables.tbl_products');
        $query = DB::table($table)->distinct();
        return $query->paginate(15, ["$table.category_name","$table.category_id","$table.subcategory_name","$table.subcategory_id","$table.subcategory_slug"]);
           
    }
    
//    public function getAllSubCategory() {
//
//        $table = config('variables.tbl_products');
//        
//        $query = DB::table($table)->select("$table.*");
//
//        return $result = $query->paginate(12);
//    }

    public function subremove(Request $request, $id = '') {
        if (!empty($id)) {
            $table = config('variables.tbl_products');
            $arrData = array('subcategory_name'=>'',
                'subcategory_link'=>'');
            
            DB::table($table)->where('subcategory_slug', '=', $id)->update($arrData);
            Session::flash('success', "Sub Category removed successfully!");
            return Redirect::to(url('backend/subcategory'));
        } else {
            Session::flash('error', "Invalid parameter");
            return Redirect::to(url('backend/subcategory'));
        }
    }

    public function editsubcategory($id) {
        if (!empty($id)) {
            $arrContent = array();
            $arrContent['title'] = "Edit Sub Category | " . config('variables.admin_title');
            $arrContent['categories'] = app('App\Http\Controllers\Backend\CategoryController')->getAllCategory();
            $arrContent['subcategory'] = self::getSubCategoryId($id);
            //var_dump($arrContent['subcategory']);exit;
        }

        echo view('backend.subcategory.edit')->with('arrContent', $arrContent)->render();
    }
    public function editsubsubcat($id) {
        //var_dump($id);exit;
        if (!empty($id)) {
            $arrContent = array();
            $arrContent['title'] = "Edit Sub Category | " . config('variables.admin_title');
            $arrContent['categories'] = app('App\Http\Controllers\Backend\CategoryController')->getAllCategory();
            $arrContent['subcategory'] = self::getSubSubCatId($id);
            //var_dump($arrContent['subcategory']);exit;
        }

        echo view('backend.subcat.edit')->with('arrContent', $arrContent)->render();
    }

    public function editSubCat_submit(Request $request) {
        if ($request->method() == "POST") {
            $input = \Illuminate\Support\Facades\Input::get();
            if (!empty($input)) {
                if (!empty($input['name']) && !empty($input['description']) && !empty($input['cat_id'])) {
                    $table = config('variables.tbl_subcat');
                    $id = $input['hidsubcategory_id'];
                    $arrUpdate = array(
                        'subcategory_name' => $input['name'],
                        'subcategory_description' => $input['description'],
                        'parent_category' => $input['cat_id']
                    );
                    $data = DB::table($table)->where('id', $id)->update($arrUpdate);
                    Session::flash('success', "Sub Category Updated Successfully!");
                    return Redirect::to(url('backend/subcategory'));
                } else {
                    Session::flash('error', "All field are compalsory please fill all fields");
                    return Redirect::to(url('backend/subcategory/edit') . '/' . $id);
                }
            } else {
                Session::flash('error', "Invalid request");
                return Redirect::to(url('backend/subcategory/edit') . '/' . $id);
            }
        }
    }
    public function editSubSubCat_submit(Request $request) {
        if ($request->method() == "POST") {
            $input = \Illuminate\Support\Facades\Input::get();
            if (!empty($input)) {
                if (!empty($input['name']) && !empty($input['description']) && !empty($input['subcat_id'])) {
                    $table = config('variables.tbl_subsubcat');
                    $id = $input['hidsubcategory_id'];
                    //var_dump($input);exit;
                    $arrUpdate = array(
                        'subsubcat_name' => $input['name'],
                        'subsubcat_description' => $input['description'],
                        'sub_category' => $input['subcat_id']
                    );
                    $data = DB::table($table)->where('sub_category', $id)->update($arrUpdate);
                    Session::flash('success', "Sub Category Updated Successfully!");
                    return Redirect::to(url('backend/subsubcategory'));
                } else {
                    Session::flash('error', "All field are compalsory please fill all fields");
                    return Redirect::to(url('backend/subSubCat/edit') . '/' . $id);
                }
            } else {
                Session::flash('error', "Invalid request");
                return Redirect::to(url('backend/subSubCat/edit') . '/' . $id);
            }
        }
    }

    /*
      | Stores related login for backend will be define here
      |
     */

    public function addStore(Request $request) {
        $arrContent = array();
        $arrContent['title'] = "Create Stores | " . config('variables.admin_title');
        $arrContent['categories'] = app('App\Http\Controllers\Backend\CategoryController')->getAllCategory();
        if ($request->method() == "POST") {
            $input = \Illuminate\Support\Facades\Input::get();
            //var_dump($input);exit;

            if (!empty($input)) {
                if (!empty($input['name']) && !empty($input['description'])) {
                    //echo count($input['multi_subcategory']);exit;
                    $table = config('variables.tbl_store');
                    $tablestorecategory = config('variables.tbl_storecategory');
                    $arrInsert = array(
                        'store_name' => $input['name'],
                        'store_description' => $input['description'],
                        'cat_id' => $input['store_category'],
                        'slug' => \App\library\Customlibrary::renRateSlug($input['name']),
                        'store_url' => (!empty($input['store_url'])) ? $input['store_url'] : '',
                    );
                    if ($request->hasFile('thumb')) {
                        $path = config('variables.store_thum_img');
                        $imagename = \App\library\Customlibrary::uploadImage('thumb', $path);
                        $arrInsert['thumb'] = $imagename;
                    }
                    if ($request->hasFile('store_file')) {
                        $path = config('variables.store_img');
                        $imagename = \App\library\Customlibrary::uploadImage('store_file', $path);
                        $arrInsert['store_file'] = $imagename;
                    }
                    $data = DB::table($table)->insertGetId($arrInsert);
                    if (!empty($input['multi_subcategory'])) {
                        $multi_subcategory = $input['multi_subcategory'];
                        //var_dump($multi_subcategory);exit;
                        for ($i = 0; $i < count($multi_subcategory); $i++) {
                            $arrData = array('category_id' => $input['store_category'],
                                'subcategory_id' => $multi_subcategory[$i],
                                'store_id' => $data);
                            $insertstorecategory = DB::table($tablestorecategory)->insertGetId($arrData);
                        }
                    }
                    if ($data) {
                        Session::flash('success', "Store Added Successfully!");
                        return Redirect::to(url('backend/store'));
                    } else {
                        Session::flash('error', "There is some technical issue please try again later");
                        return Redirect::to(url('backend/store/add'));
                    }
                } else {
                    Session::flash('error', "All field are compalsory please fill all fields");
                    return Redirect::to(url('backend/store/add'));
                }
            } else {
                Session::flash('error', "Invalid request");
                return Redirect::to(url('backend/store/add'));
            }
        }

        echo view('backend.store.add')->with('arrContent', $arrContent)->render();
    }

    public function store(Request $request, $id = '') {
        $arrContent = array();
        $arrContent['title'] = "Store List | " . config('variables.admin_title');
        $arrContent['store'] = self::getAllStore();
        echo view('backend.store.index')->with('arrContent', $arrContent)->render();
    }

    public static function getAllStore($id = '', $type = '') {
        $table = config('variables.tbl_store');
        $query = DB::table($table)->select('*');
        if (!empty($type) && $type == 'slug') {
            if (!empty($id)) {
                $query->where('slug', $id);
            }
        } else {
            if (!empty($id)) {
                $query->where('id', $id);
            }
        }
        $query->orderBy('created_date', 'DESC');
        return $query->paginate(15);
    }

    public function storeremove(Request $request, $id = '') {
        if (!empty($id)) {
            $table = config('variables.tbl_store');
            DB::table($table)->where('id', '=', $id)->delete();
            Session::flash('success', "Store removed successfully!");
            return Redirect::to(url('backend/store'));
        } else {
            Session::flash('error', "Invalid parameter");

            return Redirect::to(url('backend/store'));
        }
    }

    public function storeedit($id) {
        if (!empty($id)) {
            $arrContent = array();
            $arrContent = array();
            $arrContent['title'] = "Edit Stores | " . config('variables.admin_title');
            $arrContent['categories'] = app('App\Http\Controllers\Backend\CategoryController')->getAllCategory();
            $arrContent['subcategories'] = app('App\Http\Controllers\Backend\CategoryController')->getAllSubCategorybyStore();
            //var_dump($arrContent['subcategories']);exit;
            $arrContent['stores'] = self::getAllStore($id);
            //var_dump($arrContent['subcategory']);exit;
        }

        echo view('backend.store.edit')->with('arrContent', $arrContent)->render();
    }

    public function editStore_submit(Request $request) {
        if ($request->method() == "POST") {
            $input = \Illuminate\Support\Facades\Input::get();
            //var_dump($input);exit;
            if (!empty($input)) {
                if (!empty($input['name']) && !empty($input['description'])) {
                    $table = config('variables.tbl_store');
                    $tablestorecategory = config('variables.tbl_storecategory');
                    $id = $input['hid_store_id'];
                    //echo count($input['multi_subcategory']);exit;
                    $arrUpdate = array(
                        'store_name' => $input['name'],
                        'store_description' => $input['description'],
                        'cat_id' => $input['store_category'],
                        'store_url' => (!empty($input['store_url'])) ? $input['store_url'] : '',
                    );
                    if ($request->hasFile('thumb')) {
                        $path = config('variables.store_thum_img');
                        $imagename = \App\library\Customlibrary::uploadImage('thumb', $path);
                        $arrUpdate['thumb'] = $imagename;
                    }
                    if ($request->hasFile('store_file')) {
                        $path = config('variables.store_img');
                        $imagename = \App\library\Customlibrary::uploadImage('store_file', $path);
                        $arrUpdate['store_file'] = $imagename;
                    }
                    //$data = DB::table($table)->insert($arrInsert);
                    $data = DB::table($table)->where('id', $id)->update($arrUpdate);
                    $deletestoreCategory = DB::table($tablestorecategory)->where('store_id', '=', $id)->delete();
                    $multi_subcategory = $input['multi_subcategory'];
                    for ($i = 0; $i < count($multi_subcategory); $i++) {
                        $arrData = array('category_id' => $input['store_category'],
                            'subcategory_id' => $multi_subcategory[$i],
                            'store_id' => $id);
                        //var_dump($arrData);exit;
                        $insertstorecategory = DB::table($tablestorecategory)->insertGetId($arrData);
                    }
                    Session::flash('success', "Store Updated Successfully!");
                    return Redirect::to(url('backend/store'));
                } else {
                    Session::flash('error', "All field are compalsory please fill all fields");
                    return Redirect::to(url('backend/store/edit') . '/' . $id);
                }
            } else {
                Session::flash('error', "Invalid request");
                return Redirect::to(url('backend/store/edit') . '/' . $id);
            }
        }
    }

    public static function getSubCategoryId($id = '') {
        $table = config('variables.tbl_products');
        $query = DB::table($table)->select('*');

        if (!empty($id)) {
            $query->where('subcategory_slug', $id);
        }
        $query->orderBy('created_at', 'DESC');
        return $query->get();
    }
    public static function getSubSubCatId($id = '') {
        $table = config('variables.tbl_subcat');
        $query = DB::table($table)->select('*');

        if (!empty($id)) {
            $query->where('parent_category', $id);
        }
        $query->orderBy('created_date', 'DESC');
        return $query->get();
    }

    public static function getStoreCategoryByStoreId($id = '') {
        $table = config('variables.tbl_storecategory');
        $query = DB::table($table)->select('*');

        if (!empty($id)) {
            $query->where('store_id', $id);
        }
        return $query->get();
    }

    public function categoryactive(Request $request) {
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
                $table = config('variables.tbl_cat');
                $updatecategoryData = DB::table($table)->where('id', $actid)->update($arrUpdate);
                $getCategoryData = self::getCategoryDatabyStatus($actval, $actid);
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

    public static function getCategoryDatabyStatus($actData, $id) {
        $table = config('variables.tbl_cat');
        $query = DB::table($table)->select("$table.*");
        if (!empty($id)) {
            $query->where($table . '.id', $id);
            $query->where($table . '.status', $actData);
        }

        return $query->get();
    }

    public function subcategoryactive(Request $request) {
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
                $table = config('variables.tbl_subcat');
                $updatesubcategoryData = DB::table($table)->where('id', $actid)->update($arrUpdate);
                $getSubCategoryData = self::getSubCategoryDatabyStatus($actval, $actid);
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

    public static function getSubCategoryDatabyStatus($actData, $id) {
        $table = config('variables.tbl_subcat');
        $query = DB::table($table)->select("$table.*");
        if (!empty($id)) {
            $query->where($table . '.id', $id);
            $query->where($table . '.status', $actData);
        }

        return $query->get();
    }

    public function storeactive(Request $request) {
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
                $table = config('variables.tbl_store');
                $updatestoreData = DB::table($table)->where('id', $actid)->update($arrUpdate);
                $getStoreData = self::getStoreDatabyStatus($actval, $actid);
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

    public static function getStoreDatabyStatus($actData, $id) {
        $table = config('variables.tbl_store');
        $query = DB::table($table)->select("$table.*");
        if (!empty($id)) {
            $query->where($table . '.id', $id);
            $query->where($table . '.status', $actData);
        }

        return $query->get();
    }

    public function actionsubcategory(Request $request) {
        if ($request->ajax() && $request->method() == "POST") {
            $input = $request->input();
            $html = '';
            $status = '';
            $message = '';
            if (!empty($input['data'])) {
                $input = json_decode($input['data']);
                if (!empty($input->type) && $input->type == 'subcat') {
                    $cat_id = $input->cat_id;
                    $subCat = app('App\Http\Controllers\Backend\CategoryController')->getSubCategory($cat_id);
                    //var_dump($subCat);exit;
                    if (!empty($subCat)) {
                        foreach ($subCat as $sub) {
                            $html .= "<option value='$sub->id'>" . $sub->subcategory_name . "<option>";
                            $message = 'success';
                            $status = 'success';
                        }
                    } else {
                        
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

    public static function getAllSubCategorybyStore($id = '') {
        $table = config('variables.tbl_storecategory');
        $tableSubCat = config('variables.tbl_subcat');
        $query = DB::table($table)->select("$table.*", "$tableSubCat.subcategory_name");
        $query->join($tableSubCat, "$tableSubCat.id", '=', "$table.subcategory_id", 'inner');
        if (!empty($id)) {
            $query->where('store_id', $id);
        }
        return $query->get();
    }

    public function subscibeemaillist(Request $request) {
        $arrContent = array();
        $arrContent['title'] = "SubscibeEmail List | " . config('variables.admin_title');
        $arrContent['subscibeemaillist'] = self::getAllSubscibeEmailList();
        echo view('backend.subscibeemail.index')->with('arrContent', $arrContent)->render();
    }

    public static function getAllSubscibeEmailList() {
        $table = config('variables.tbl_subscribe');
        $query = DB::table($table)->select('*');
        $query->orderBy('subs_date', 'DESC');
        return $query->paginate(15);
    }

    public function removesubsemail(Request $request, $id = '') {
        if (!empty($id)) {
            $table = config('variables.tbl_subscribe');
            DB::table($table)->where('id', '=', $id)->delete();
            Session::flash('success', "Email id removed successfully!");
            return Redirect::to(url('backend/subscibeemail'));
        } else {
            Session::flash('error', "Invalid parameter");
            return Redirect::to(url('backend/subscibeemail'));
        }
    }

    public function addSubSubCat(Request $request) {
        $arrContent = array();
        $arrContent['title'] = "Create Sub Category | " . config('variables.admin_title');
        $arrContent['categories'] = app('App\Http\Controllers\Backend\CategoryController')->getAllCategory();
        if ($request->method() == "POST") {
            $input = \Illuminate\Support\Facades\Input::get();
            //var_dump($input);exit;
            if (!empty($input)) {
                if (!empty($input['name']) && !empty($input['description']) && !empty($input['cat_id']) && !empty($input['subcat_id'])) {
                    $table = config('variables.tbl_subsubcat');
                    $arrInsert = array(
                        'subsubcat_name' => $input['name'],
                        'subsubcat_description' => $input['description'],
                        'parent_category' => $input['cat_id'],
                        'sub_category' => $input['subcat_id'],
                        'slug' => \App\library\Customlibrary::renRateSlug($input['name'])
                    );
                    $data = DB::table($table)->insert($arrInsert);
                    if ($data) {
                        Session::flash('success', "Sub Category Added Successfully!");
                        return Redirect::to(url('backend/addSubSubCat/add'));
                    } else {
                        Session::flash('error', "There is some technical issue please try again later");
                        return Redirect::to(url('backend/addSubSubCat/add'));
                    }
                } else {
                    Session::flash('error', "All field are compalsory please fill all fields");
                    return Redirect::to(url('backend/addSubSubCat/add'));
                }
            } else {
                Session::flash('error', "Invalid request");
                return Redirect::to(url('backend/addSubSubCat/add'));
            }
        }

        echo view('backend.subcat.add')->with('arrContent', $arrContent)->render();
    }

    public function actionsubsubcat(Request $request) {
        if ($request->ajax() && $request->method() == "POST") {
            $input = $request->input();
            $html = '';
            $status = '';
            $message = '';
            if (!empty($input['data'])) {
                $input = json_decode($input['data']);
                if (!empty($input->type) && $input->type == 'subcat') {
                    $cat_id = $input->cat_id;
                    $subCat = app('App\Http\Controllers\Backend\CategoryController')->getSubSubCategory($cat_id);
                    //var_dump($subCat);exit;
                    if (!empty($subCat)) {
                        foreach ($subCat as $sub) {
                            $html .= "<option value='$sub->id'>" . $sub->subcategory_name . "<option>";
                            $message = 'success';
                            $status = 'success';
                        }
                    } else {
                        
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

    public static function getSubSubCategory($id = '', $type = '', $subslug = '') {
        $tableCat = config('variables.tbl_subcat');
        $table = config('variables.tbl_cat');
        $tablesubcat = config('variables.tbl_subsubcat');
        $query = DB::table($table)->select("$tablesubcat.*", "$table.category_name as cat", "$tableCat.subcategory_name as subcat");
        $query->join($tableCat, "$tableCat.parent_category", '=', "$table.id", 'inner');
        $query->join($tablesubcat, "$tablesubcat.sub_category", '=', "$tableCat.id", 'inner');
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
                $query->where($table . '.parent_category', $id);
            }
        }
        $query->orderBy($table . '.created_date', 'DESC');
        return $query->paginate(15);
    }

    public function subsubcategory(Request $request, $id = '') {
        $arrContent = array();
        $arrContent['title'] = "Sub Category List | " . config('variables.admin_title');
        $arrContent['subcategories'] = self::getSubSubCategory();
        //var_dump($arrContent['subcategories']);exit;
        echo view('backend.subcat.index')->with('arrContent', $arrContent)->render();
    }

    public function subsubcatactive(Request $request) {
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
                $table = config('variables.tbl_subsubcat');
                $updatecategoryData = DB::table($table)->where('id', $actid)->update($arrUpdate);
                $getCategoryData = self::getSubCatDatabyStatus($actval, $actid);
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

    public static function getSubCatDatabyStatus($actData, $id) {
        $table = config('variables.tbl_subsubcat');
        $query = DB::table($table)->select("$table.*");
        if (!empty($id)) {
            $query->where($table . '.id', $id);
            $query->where($table . '.status', $actData);
        }

        return $query->get();
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
                            $html .= "<td value='$sub->category_id'>" . $sub->category_name . "<td>";
                            $message = 'success';
                            $status = 'success';
                            }
                        }
                    }
                    echo json_encode(array('status' => 'success', 'msg' => $message, 'data' => $html));
        }
    }

}
