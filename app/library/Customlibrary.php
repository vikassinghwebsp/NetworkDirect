<?php

/*
 * Name : Customlibrary
 * Description : Define all custom things here.
 * Authour : Sunny Saini <sunnysaini466@gmail.com.com>
 */

namespace App\library;

use \DB;
use Auth;
use \Session;
use Mail;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image as Image;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Request;

//use Illuminate\Support\Facades\Redirect;

Class Customlibrary {

    public static function genrateSalt($charcter) {
        return str_random($charcter);
    }

    public static function encryptPass($pass, $salt) {
        return crypt($pass, $salt);
    }

    public static function getUserAdmin($adminId) {
        if (!empty($adminId)) {
            $table = config('variables.tbl_admin');
            $user = DB::table($table)->select('*')->where('id', $adminId)->get();
            return (!empty($user[0])) ? $user[0] : '';
        }
    }

    public static function getUserImage($imageName = '') {
        if (!empty($imageName)) {
            return url('public/backend/images/avatar' . '/' . $imageName);
        } else {
            return url('public/backend/images/avatar/defualt_avatar.png');
        }
    }

    public static function currentRoute($urlPath = '', $type = '') {
        $url = \Illuminate\Support\Facades\Route::getFacadeRoot()->current()->uri();
        //var_dump($paths);exit;
        $urlPath = explode(',', $urlPath);
        foreach ($urlPath as $currentPath) {
            if ($currentPath == $url) {
                if (!empty($type)) {
                    return 'open active';
                } else {
                    return 'active';
                }
            }
        }
    }

    public static function getUserRole($rolId = '') {
        $arrRole = array('1' => 'Admin', '2' => 'Recruiter', '3' => 'Account Manager', '4' => 'User');
        if (!empty($rolId)) {
            return $arrRole[$rolId];
        }
        return $arrRole;
    }

    public static function uploadImage($name, $path, $request = '') {
        //if($request->hasFile($name)) {
        //$file = \Illuminate\Support\Facades\Input::file($name);
        //var_dump($file);exit;
        //getting timestamp
        $timestamp = str_replace([' ', ':'], '-', \Carbon\Carbon::now()->toDateTimeString());
        $name = $timestamp . '-' . $name->getClientOriginalName();

        $file->move(public_path() . $path, $name);
        return $name;
        // }
    }

    public static function uploadImageMultiple($file, $path, $imgType = '', $request = '') {
        
        $timestamp = str_replace([' ', ':'], '-', \Carbon\Carbon::now()->toDateTimeString());
        
        $name = $timestamp . '-' . $file->getClientOriginalName();
        $destinationPath = public_path(config('variables.products_img_thumb'));
        $destinationPath2 = public_path(config('variables.products_img_thumb213x215'));
        $destinationPath3 = public_path(config('variables.products_img_thumb276x205'));
        $destinationPath4 = public_path(config('variables.products_img_thumb380x200'));
         
       

        $file->move(public_path() . $path, $name);
        
        $abc =  public_path() . $path . $name;
        
        //var_dump($abc);exit;
        
         if (!empty($imgType) && $imgType == 'product_image') {
            //
            //$imagePath = public_path() . 'assets/images/products/thumb' . $file;
            
            Image::make($abc)->resize(276, 289)->save($destinationPath . '/' . $name);
            Image::make($abc)->resize(213, 215)->save($destinationPath2 . '/' . $name);
            Image::make($abc)->resize(276, 205)->save($destinationPath3 . '/' . $name);
            Image::make($abc)->resize(380, 200)->save($destinationPath4 . '/' . $name);
            
        } else {
            Image::make($abc)->resize(870, 350)->save($destinationPath . '/' . $name);
        }
        
        
        return $name;
        // }
    }

    public static function reGenrateTitle($text = '') {
        if (!empty($text)) {
            $journalName = preg_replace('/-/', ' ', $text);
            return strtolower($journalName);
        } else {
            return '';
        }
    }

    public static function renRateSlug($text = '') {
        if (!empty($text)) {
            $journalName = preg_replace('/\s+/', '-', $text);
            return strtolower($journalName);
        } else {
            return '';
        }
    }

//
//    public static function getStoreImage($image = '', $type = '') {
//        if (!empty($image)) {
//            $url = 'public/' . config('variables.store_img');
//            if (!empty($type)) {
//                $url = 'public/' . config('variables.store_thum_img');
//            }
//            return url($url . $image);
//        }
//    }

    public static function getBannerImage($image = '', $type = '') {
        if (!empty($image)) {
            $url = 'public/' . config('variables.banner_img');
            //var_dump($url);exit;
            if (!empty($type)) {
                $url = 'public/' . config('variables.banner_img_thumb');
            }
            return url($url . $image);
        }
    }

    public static function getProductImage($image = '', $type = '') {
        if (!empty($image)) {
            $url = 'public/' . config('variables.products_img');
            if (!empty($type)) {
                $url = 'public/' . config('variables.products_img_thumb');
            }
            return url($url . '/' . $image);
        }
    }

    public static function getBrandImage($image = '', $type = '') {
        if (!empty($image)) {
            $url = 'public/' . config('variables.brand_img');
            if (!empty($type)) {
                $url = 'public/' . config('variables.brand_img');
            }
            return url($url . '/' . $image);
        }
    }

    public static function bannerType($id = '') {
        $arrType = array('1' => 'Home Banner', '2' => 'Home Side banner');
        if (!empty($id)) {
            return $arrType[$id];
        } else {
            return $arrType;
        }
    }

    public static function getCouponType($id = '') {
        $arrayType = array('1' => 'Coupon', '2' => 'Deal');
        if (!empty($id)) {
            return $arrayType[$id];
        }
        return $arrayType;
    }

    public static function getAllCities() {
        $table = config('variables.tbl_city');
        $query = DB::table($table)->select('*')
                ->get();
        return $query;
    }

    public static function getCouponTypes($id = '') {
        $arrayType = array('1' => 'Coupon', '2' => 'Deal', '3' => 'All');
        if (!empty($id)) {
            return $arrayType[$id];
        }
        return $arrayType;
    }

    public static function getCouponById($id = '') {
        if (!empty($id)) {
            $table = config('variables.tbl_coupon');
            $tableStore = config('variables.tbl_store');
            return $data = DB::table($table)->select("$table.*", "$tableStore.store_name", "$tableStore.thumb", "$tableStore.store_url")
                            ->join($tableStore, "$tableStore.id", '=', "$table.store_id")
                            ->where("$table.id", $id)->first();
        }
    }

    public static function getAllCoupon() {
        $table = config('variables.tbl_coupon');
        $data = DB::table($table)->select('*')
                ->get();
        return $data;
    }

    public static function mail_send($data = '') {
       return Mail::send('email.registration', $data, function($message) use ($data) {
            $message->to($data['to'], 'Networks Direct');
            $message->subject($data['subject']);
            $message->from($data['from'], 'Networks Direct');
        });
        
    }
    public static function order_mail_send($data = '') {
    
     return  Mail::send('email.order', $data, function($message) use ($data) {
            $message->to($data['to'], 'Networks Direct');
            $message->subject($data['subject']);
            $message->from($data['from'], 'Networks Direct');
        });
       
    }
    public static function order_mail_send_admin($data = '') {
         
      return Mail::send('email.order', $data, function($message) use ($data) {
            $message->to($data['from'], 'Networks Direct');
            $message->subject($data['subject']);
            $message->from($data['from'], 'Networks Direct');
        });
       
        
    }
    
    public static function mail_admin($data = '') {
       return Mail::send('email.registration', $data, function($message) use ($data) {
            $message->to($data['to'], 'Networks Direct');
            $message->subject($data['subject']);
            $message->from($data['from'], 'Networks Direct');
        });
        
    }

    public static function getUserInvoice($adminId) {
        $tableInvoice = config('variables.tbl_invoice_address');
        $table = config('variables.tbl_admin');
        $query = DB::table($tableInvoice)->select("$tableInvoice.*", "$table.*");
        $query->join($table, "$table.id", '=', "$tableInvoice.user_id", 'inner');
        if (!empty($adminId)) {
            $query->where($tableInvoice . '.user_id', $adminId);
        }

        $user = $query->get();
        return (!empty($user[0])) ? $user[0] : '';
    }
    public static function getAllCountry() {
        $table = config('variables.tbl_countries');
        $query = DB::table($table)->select('*')
                ->get();
        return $query;
    }

}
