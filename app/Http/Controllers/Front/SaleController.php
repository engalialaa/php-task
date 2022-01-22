<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleDetails;
use App\Models\Product;
use App\Models\Cart;
use App\Http\Requests\confirmSale;
use App\User;
use function PHPUnit\Framework\returnValue;
use Illuminate\Validation\Rule;

class SaleController extends Controller
{
    public function index()
    {
        $Sale = Sale::where('user_id',auth()->user()->id)->where('is_end',0)->where('pay_type','!=','cash')->latest()->first();
        $User = User::where('id',auth()->user()->id)->first();
        return view('Front.checkout',compact('Sale','User'));
    }

    public function addSale(Request $request)
    {
        if (auth()->user()){

                $Sale = new Sale();
                $Sale->user_id = auth()->user()->id;
                $Sale->total = $request->total;
                $Sale->save();

                foreach ($request->book_id as $i => $detail){
                    $Product_name = Product::where('id',$request->book_id[$i])->first();
                    $array = [];
                    $array['product_id'] = $request->book_id[$i];
                    $array['product_name'] = $Product_name->name;
                    $array['product_photo'] = $Product_name->photo;
                    $array['qty']    = $request->qty[$i];
                    $array['sale_id'] = $Sale->id;
                    SaleDetails::create($array);
                }


            return response()->json(
                [
                    'success' => true,
                    'message' => 'Sale Data added successfully'
                ]);

        }

        session()->flash('not');
        return redirect()->back();
    }

    public function confirmSale(confirmSale $request , $id)
    {

        $data = $request->all();

        $sale = Sale::where('user_id',$id)->latest()->first();

        $sale->update($data);

        $UserCart = Cart::where('user_id',auth()->user()->id);
        $UserCart->delete();

        if ($request->pay_type == 'online')
       return redirect("credit");
        else{
            toastr()->success(trans('front.success cash pay'));
            return redirect('/');
        }
    }

}
