<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\User;

class HomeController extends Controller
{
    public function Home()
    {
        $Products = Product::where('is_shown','yes')->latest()->limit(50)->get();
        $Categories = Category::where('is_shown','yes')->latest()->limit(50)->get();

        return view('Front.index', compact('Products','Categories'));
    }

    public function products()
    {
        $Categories = Category::where('is_shown','yes')->latest()->get();
        $Products = Product::where('is_shown','yes')->latest()->paginate(6);

        return view('Front.products', compact('Categories', 'Products'));
    }

    public function products_category($id)
    {
        $Categories = Category::where('is_shown','yes')->latest()->get();
        $Products = Product::where('is_shown','yes')->where('category_id',$id)->latest()->paginate(6);
        return view('Front.products', compact( 'Products', 'Categories'));
    }

    public function products_details($id)
    {
        $Product = Product::where('is_shown','yes')->where('id',$id)->firstOrFail();
        $Products = Product::where('is_shown','yes')->where('category_id',$Product->category_id)->latest()->limit(50)->get();
        return view('Front.products-details', compact( 'Product','Products'));
    }

    public function search(Request $request)
    {
        $value = $request->search;

        if ($request->Category_id == 0) {

            $Categories = Category::where('is_shown','yes')->latest()->get();

            $Products = Product::where('is_shown','yes')
                ->where('name', 'like', '%'.$value.'%')
                ->orwhere('category_name','like', '%'.$value.'%')
                ->latest()->paginate(6);

        }else{
            $Categories = Category::where('is_shown','yes')->latest()->get();

            $Products = Product::where('is_shown','yes')
                ->where('name','like', '%'.$value.'%')
                ->orwhere('category_name','like', '%'.$value.'%')
                ->where('category_id',$request->Category_id)
                ->latest()->paginate(6);
        }
        return view('Front.products', compact('Categories', 'Products'));

    }

    public function categories()
    {
        $Categories = Category::where('is_shown','yes')->latest()->get();
        return view('Front.categories',compact('Categories'));
    }

}
