<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\BookDetails;
use App\Models\Book;
use App\Models\ModelsPublishingBooks;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymobController extends Controller
{
    public $apiKey = "ZXlKMGVYQWlPaUpLVjFRaUxDSmhiR2NpT2lKSVV6VXhNaUo5LmV5SmpiR0Z6Y3lJNklrMWxjbU5vWVc1MElpd2ljSEp2Wm1sc1pWOXdheUk2TVRRNU5EZzNMQ0p1WVcxbElqb2lhVzVwZEdsaGJDSjkuMFFqX3dsWnpWTU5hWVRWT0tFcGpQS2lsWFVPMjUyQ0gtWDgybm9yQWZyLWx0OThxWTNuenpjeVFEN3hPLTkySXFJcHV4WlRyRkxIRUVWT2tFWVJDeHc=";
    public $paymentMode = "test"; //"live"

    public function index()
    {

        $sale = Sale::where('user_id',auth()->guard('user')->user()->id)->latest()->first();

        //user data
        $userEmail = auth()->guard('user')->user()->email;
        $userFirstName = auth()->guard('user')->user()->first_name;
        $userLastName = auth()->guard('user')->user()->last_name;
        $userPhoneNumber = auth()->guard('user')->user()->phone;


        //order data
        $items = [];
        $total_price = $sale->total * 100;
        foreach ($sale->SaleDetails as $item){
            $book = Book::where('id',$item->book_id)->first();
            $items[] =
                [
                    'name'=>$book->name,
                    'quantity'=>$item->qty,
                    'amount_cents'=>$book->amount * 100,
                    'description'=>$sale->id,
                ];
        }

        //basic data
        $integration_id = $this->paymentMode =="test"?1719614:1734779;
        $billing_data = $this->get_billing_data($userEmail,$userFirstName,$userLastName,$userPhoneNumber);

        //first step
        $auth_token = $this->first_step_for_auth($this->apiKey);
        if ($auth_token == "error") {
            return response()->json(['data'=>null,'message'=>"auth_token error",'status'=>404],200);
        }

        //second step
        $order_id =  $this->second_step_for_register_order($auth_token,$total_price,$items);
        if ($order_id == "error") {
            return response()->json(['data'=>null,'message'=>"order_id error",'status'=>404],200);
        }

        //third step
        $payment_key = $this->third_step_for_payment_key($auth_token,$order_id,$total_price,$billing_data,$integration_id);
        if ($payment_key == "error") {
            return response()->json(['data'=>null,'message'=>"payment_key error",'status'=>404],200);
        }

        //final step
        $link =  $this->fourth_step_for_iframe_link($payment_key);
//        return view('welcome',compact('link'));

          return redirect("$link");

          //return response()->json(['data'=>['link'=>$link,'order_id'=>$order_id,'auth_token'=>$auth_token],'message'=>"success link",'status'=>200],200);

    }//end fun


    private function first_step_for_auth($api_key)
    {
        $response = Http::post('https://accept.paymob.com/api/auth/tokens', [
            'api_key' => $api_key,
        ]);

        if ($response->successful()) {
            return $response['token'];
        }

        return "error";
    }//end fun


    private function second_step_for_register_order($authToken,$amount,$items)
    {

        $response = Http::post('https://accept.paymob.com/api/ecommerce/orders', [
            'auth_token' => $authToken,
            'delivery_needed'=>false,
            'amount_cents'=>$amount,
            'currency'=>"EGP",
            "items"=>$items,
        ]);

        if ($response->successful()) {
            return $response['id'];
        }
        return "error";
    }//end fun


    private function third_step_for_payment_key($authToken,$orderId,$amount,$billing_data,$integration_id)
    {
        $response = Http::post('https://accept.paymob.com/api/acceptance/payment_keys', [
            'auth_token' => $authToken,
            'amount_cents'=>$amount,
            'expiration'=>3600,
            'order_id'=>$orderId,
            'billing_data'=>$billing_data,
            'currency'=>"EGP",
            'integration_id'=>$integration_id,
            'lock_order_when_paid'=>"true"
        ]);

        if ($response->successful()) {
            return $response['token'];

        }
        return "error";

        return redirect('','','','');

    }//end fun


    private function fourth_step_for_iframe_link($payment_key)
    {
        return "https://accept.paymob.com/api/acceptance/iframes/333533?payment_token={$payment_key}";
    }//end fun


    private function get_billing_data($email,$userFirstName,$userLastName,$userPhoneNumber)
    {
        return [
            "apartment"=>"NA",
            "email"=> $email?$email:"test@exa.com",
            "floor"=> "NA",
            "first_name"=>$userFirstName?$userFirstName:"user default",
            "last_name"=>$userLastName?$userLastName:"user default",
            "street"=> "NA",
            "building"=> "NA",
            "phone_number"=> $userPhoneNumber?(string)$userPhoneNumber:"+86(8)9135210487",
            "shipping_method"=>"NA",
            "postal_code"=> "NA",
            "city"=> "NA",
            "country"=>"NA",
            "state"=> "NA"
        ];

    }//end fun


    public function callBack(Request $request){
        $data = $request->all();

        ksort($data);
        $hmac = $data['hmac'];
        $array = [
            'amount_cents',
            'created_at',
            'currency',
            'error_occured',
            'has_parent_transaction',
            'id',
            'integration_id',
            'is_3d_secure',
            'is_auth',
            'is_capture',
            'is_refunded',
            'is_standalone_payment',
            'is_voided',
            'order',
            'owner',
            'pending',
            'source_data_pan',
            'source_data_sub_type',
            'source_data_type',
            'success',
        ];
        $String = '';
        foreach ($data as $key => $element) {
            if(in_array($key, $array)) {
                $String .= $element;
            }
        }
        $secretKey = env('PAYMOB_HMAC');
        $hasedString = hash_hmac('sha512', $String, $secretKey);
        $errorSecure = "";
        if ( $hasedString != $hmac) {
            $errorSecure = ' not secure ';
        }

        $payOrder = $this->getOrder($request->order);

        if ($payOrder && $request->success == "true"){
            $item = $payOrder['items'][0];
            if ($item['description'] == "publishing"){
                $publishing = ModelsPublishingBooks::findOrFail($item['name']);
                $publishing->is_paied = 'yes';
                $publishing->save();
                toastr()->success(trans('front.successPay').$errorSecure);

                return redirect('authors/publishing/works');

            }elseif($item['description'] == "confirmBook"){
                $confirm = BookDetails::findOrFail($item['name']);
                $confirm->is_paied = 'yes';
                $confirm->save();

                $book = Book::findOrFail($confirm->book_id);

                $book->status = 'finshed';
                $book->save();


                toastr()->success(trans('front.successPay').$errorSecure);

                return redirect('authors/publishing/works');
            }

            else{
                $order =  Sale::findOrFail($payOrder['items'][0]['description']);
                $order->is_paid = 'paid';
                $order->save();
                toastr()->success(trans('front.successPay').$errorSecure);

                return redirect('/');
            }


        }else{
            toastr()->error(trans('front.failedPay').$errorSecure);
        }

        return redirect('/');
    }//end fun
    public function getOrder($orderID){
        try {
            $order = Http::get("https://accept.paymobsolutions.com/api/ecommerce/orders/{$orderID}", [
                'token' => $this->authPaymob()['token'],
            ]);
            return $order;
        }catch (\Exception $exception){
            return false;
        }

    }//end fun

    public function authPaymob()
    {
        // Request body
        $json = [
            'username' => env('paymobUsername'),
            'password' => env('paymobPassword')
        ];

        // Send curl

        $auth = Http::POST('https://accept.paymobsolutions.com/api/auth/tokens',$json);

        return $auth;
    }//end fun
    /**
     * @param Request $request
     * @return void
     */
    public function endPay(Request $request){
        session()->flash($request->status=='success'?'success':'error');
        if ($request->status=='success')
        toastr()->success(trans('front.successPay'));
        else
            toastr()->error(trans('front.failedPay'));
        return redirect('/');
    }//end fun


}//end class
