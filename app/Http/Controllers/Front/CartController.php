<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\User;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        if (auth()->user()) {
            $Carts = \App\Models\Cart::where('user_id',auth()->user()->id)->latest()->get();
            return view('Front.cart', compact('Carts'));
        }
        $Carts   = \App\Models\Cart::where('user_id',1)->latest()->get();
        return view('Front.cart', compact('Carts'));
    }//end fun
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addToCart(Request $request)
    {
        if (auth()->user()){
            $count = Cart::where('user_id',auth()->user()->id)->where('Product_id',$request->Product_id)->count();

            if ($count == 0) {
                $cart = new Cart();
                $cart->user_id = auth()->user()->id;
                $cart->Product_id = $request->Product_id;
                $cart->qty = $request->qty;
                $cart->save();

                $countCart = Cart::where('user_id',auth()->user()->id)->count();

                return response()->json(
                    [
                        'count' => $countCart,
                        'success' => true,
                        'message' => 'Data added successfully'
                    ]);

            }else{
               $cart = Cart::where('user_id',auth()->user()->id)
                    ->where('Product_id',$request->Product_id)->first();
                $cart->update([
                        'qty' => $cart->qty+1
                    ]);

                $countCart = Cart::where('user_id',auth()->user()->id)->count();
                return response()->json(
                    [
                        'count' => $countCart,
                        'success' => true,
                        'message' => 'Data added successfully'
                    ]);
            }

        }
        return response()->json(['error' => true]);

    }//end fun
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $cart = Cart::find($request->id);
        $cart->delete();
        $countCart = Cart::where('user_id',auth()->user()->id)->count();

        return response()->json(
            [
                'count' => $countCart,
                'success' => true,
                'message' => 'Data deleted successfully'
            ]);
    }//end fun
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateQty(Request $request)
    {
        $data = $request->except('id');

        $cart = Cart::find($request->id);

        $cart->update($data);
        if ($cart) {
            return response()->json([
                'status'     => 'success',
            ]);
        } else {
            return response()->json([
                'status' => 'error']);
        }

    }//end fun
    public function loadNewCart(){
        return view('Front/load/cart');
    }//end fun


}//end class
