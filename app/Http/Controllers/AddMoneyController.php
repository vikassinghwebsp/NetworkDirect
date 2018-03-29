<?php

/*
  | Define all Payment controller login here related to Front part
  | Authour : Sunny Saini <sunnysaini466@gmail.com>
  |
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use URL;
use Session;
use Redirect;
use Input;
use App\User;
use Stripe\Error\Card;
use Cartalyst\Stripe\Stripe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Gloudemans\Shoppingcart\Facades\Cart;

class AddMoneyController extends Controller {

    public function postPaymentWithStripe(Request $request) {
        $validator = Validator::make($request->all(), [
                    'card_no' => 'required',
                    'ccExpiryMonth' => 'required',
                    'ccExpiryYear' => 'required',
                    'cvvNumber' => 'required',
                        //'amount' => 'required',
                        //'name' => 'required',
        ]);
        $input = $request->all();

        if ($validator->passes()) {

            $input = array_except($input, array('_token'));
            $stripe = Stripe::make('sk_test_C7VbZG5LPMRhNf0zJv3GDyFR');

            try {
                $token = $stripe->tokens()->create([
                    'card' => [
                        'number' => $request->get('card_no'),
                        'exp_month' => $request->get('ccExpiryMonth'),
                        'exp_year' => $request->get('ccExpiryYear'),
                        'cvc' => $request->get('cvvNumber'),
                        'name' => $request->get('name'),
                    ],
                ]);
               
                if (!isset($token['id'])) {
                    return redirect('payment');
                }

                $charge = $stripe->charges()->create([
                    'card' => $token['id'],
                    'currency' => $request->get('currency'),
                    'amount' => $request->get('amount'),
                    'description' => 'Add in wallet',
                ]);

                if ($charge['status'] == 'succeeded') {
                    /**
                     * Write Here Your Database insert logic.
                     */
                    $order = new AddMoneyController();
                    $cart = Cart::content();
                    $userData = Session::get('user');

                    foreach ($cart as $product) {
                        $id = Self::getOrderId();
                        $image = Self::getProductImage($product->id);
                        //var_dump($image);exit;
                        if (empty($id[0]->order_id)) {
                            $order_id = 'ND' . '-' . '1001';
                        } else {
                            $sd = explode('-', $id[0]->order_id);
                            $codeData = (int) $sd[1] + 1;

                            $order_id = 'ND' . '-' . $codeData;
                            // var_dump($order_id);
                            //exit;
                        }
                        $order->payment_id = $charge['id'];

                        
                        $arrOrder = array('user_id' => $userData[0]->id,
                            'product_id' => $product->id,
                            'product_name' => $product->name,
                            'price' => $product->subtotal,
                            'qty' => $product->qty,
                            'vat' => $request->get('vat'),
                            'total_price' => $product->total,
                            'order_id' => $order_id,
                            'payment' => '1',
                            'payment_id' => $order->payment_id,
                            'product_image' => (!empty($image)?$image:'')
                        );
                        if (!empty($arrOrder)) {
                            $tablename = config('variables.tbl_orders');
                            $query = DB::table($tablename)->insert($arrOrder);
                        }
                        if (!empty($query)) {
                            Cart::destroy();
                            //mail send to customer
                            $from = config('variables.mail_from');
                            $userData = Session::get('user');
                            $mail_id = str_replace(' ', '', $userData[0]->email);
                            $arrMail = array('to' => $mail_id,
                                'subject' => 'You have successfully Ordered from Networks Direct.',
                                'from' => $from,
                                'name'=>$userData[0]->full_name);

                            $mailResponse = \App\library\Customlibrary::order_mail_send($arrMail);
                            
                           
                            //mail send to send
                            $userName = $userData[0]->full_name;
                            $arrMail = array('to' => $from,
                                'subject' => " '$userName' have successfully Ordered '$product->name' from Networks Direct.",
                                'from' => $from);
                            
                            $mailResponse = \App\library\Customlibrary::order_mail_send_admin($arrMail);
                          
                            Session::flash('success', "You have successfully ordered '$product->name' and your order is under process");
                            
                            return Redirect::to(url('myaccount/order-history'));
                        } else {
                            Session::flash('error', "Some Problrem While Registering. Try Again");
                            return Redirect::to(url('payment'));
                        }
                    }


                    return redirect('myaccount/order-history');
                } else {
                    Session::put('error', 'Money not add in wallet!!');
                    return redirect('payment');
                }
            } catch (Exception $e) {
                Session::put('error ', $e->getMessage());
                return redirect('payment');
            } catch (Cartalyst\Stripe\Exception\CardErrorException $e) {
                Session::put('error ', $e->getMessage());
                return redirect('payment');
            } catch (Cartalyst\Stripe\Exception\MissingParameterException $e) {
                echo Session::put('error ', $e->getMessage());
                //return redirect('payment');
            }
        }
    }

    public function getUserInvoiceAddress($username, $type = '') {
        $tablename = config('variables.tbl_invoice_address');
        $query = DB::table($tablename)->select('*')
                ->where('id', $username);
        if (!empty($type)) {
            $query->where('type', $type);
        }
        $query = $query->get();
        return $query;
    }

    public function getOrderId() {
        $tablename = config('variables.tbl_orders');
        $query = DB::table($tablename)->select('order_id');
        $query->latest('order_id');
        $query->take(1);

        return $order_id = $query->get();
    }

    public function getProductImage($id = '') {
        $tablename = config('variables.tbl_product_img');
        $query = DB::table($tablename)->select('product_image');
        $query->where('product_id', $id);
        $query->take(1);

        return $order_id = $query->get();
    }

}
