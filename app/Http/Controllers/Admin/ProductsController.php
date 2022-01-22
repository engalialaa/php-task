<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Product_Photo;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\addProduct;
use Yajra\DataTables\DataTables;
use App\Http\Traits\PhotoTrait;

class ProductsController extends Controller
{
    use PhotoTrait;

    public function index()
    {
        return view('Admin/Products/index');
    }

    public function create_product()
    {
        $Categories  = Category::where('is_shown','yes')->latest()->get();
        return view('Admin/Products/create',compact('Categories'));
    }

    public function store_product(addProduct $request)
    {

        $data = $request->except('photo','otherPhoto');

        //uploadImage
        if ($request->file('photo')) {
            $photo_name = $this->saveImage($request->photo, 'public/uploads/Product');
            $data['photo'] = 'public/uploads/Product/' . $photo_name;
        }

        $Category  = Category::where('is_shown','yes')->where('id',$request->category_id)->first();
        $data['category_name'] = $Category->name;

        $Product = Product::create($data);

//        //upload Image
        if (count($request->otherPhoto) != 0) {
            $count = count($request->otherPhoto);
            for ($i = 0; $i < $count; $i++) {
                $data_photos = [];
                $photo_name = $this->saveImage($request->otherPhoto[$i], 'public/uploads/Product');
                $data_photos['photo'] = 'public/uploads/Product/' . $photo_name;
                $data_photos['product_id'] = $Product->id;
                Product_Photo::create($data_photos);
            }
        }
        toastr()->success('تم اضافة المنتج');
        return redirect()->route("products");
    }

    public function edit_product($id)
    {
        $Product =  Product::findOrFail($id);
        $Product_Photo = Product_Photo::where('product_id',$id)->latest()->get();
        $Categories  = Category::where('is_shown','yes')->latest()->get();
        return view('Admin/Products/edit',compact('Product','Categories','Product_Photo'));
    }

    public function update_product(addProduct $request)
    {
        $Product =  Product::where('id',$request->id)->firstOrFail();

        $data = $request->except('photo','otherPhoto');

        //uploadImage
        if ($request->file('photo')) {
            $photo_name = $this->saveImage($request->photo, 'public/uploads/Product');
            $data['photo'] = 'public/uploads/Product/' . $photo_name;
        }

        $Category  = Category::where('is_shown','yes')->where('id',$request->category_id)->first();
        $data['category_name'] = $Category->name;

        $Product->update($data);


      //upload Image
        if ($request->file('otherPhoto')) {
            $Product_Photo =  Product_Photo::where('product_id',$request->id)->get();
            foreach($Product_Photo as $Product){
                $Product->delete();
            }
            if (count($request->otherPhoto) != 0) {
                $count = count($request->otherPhoto);
                for ($i = 0; $i < $count; $i++) {
                    $data_photos = [];
                    $photo_name = $this->saveImage($request->otherPhoto[$i], 'public/uploads/Product');
                    $data_photos['photo'] = 'public/uploads/Product/' . $photo_name;
                    $data_photos['product_id'] = $request->id;
                    Product_Photo::create($data_photos);
                }
            }
        }


        toastr()->info('تم تعديل المنتج');
        return redirect()->route("products");


    }

    public function productsData()
    {
        $Product = Product::latest()->get();
        return Datatables::of($Product)
            ->addColumn('action', function ($Product) {
                return '
                    <a href="' .route('edit.product',$Product->id). '"class="btn btn-icon btn-bg-light btn-info btn-sm me-1" style="border-radius: 50% !important">
                            <span class="svg-icon svg-icon-3">
                                <span class="svg-icon svg-icon-3">
                                    <i class="fa fa-edit"></i>
                                </span>
                            </span>
                  </a>
                  <button data-bs-toggle="modal" data-bs-target="#delete_modal" class="btn btn-icon btn-bg-light btn-danger btn-sm me-1" data-toggle="modal" style="border-radius: 50% !important"
                                    data-id="' . $Product->id . '" data-title_ar="' . $Product->name . '">
                            <span class="svg-icon svg-icon-3">
                                <span class="svg-icon svg-icon-3">
                                    <i class="fa fa-trash"></i>
                                </span>
                            </span>
                  </button>
                       ';
            })
            ->addColumn('ProductDetails', function ($Product) {
                return '
                    <button id="ProductDitails" data-id="'.$Product->id.'" class="btn btn-icon btn-bg-light btn-success btn-sm me-1" style="border-radius: 50% !important">
                            <span class="svg-icon svg-icon-3">
                                <span class="svg-icon svg-icon-3">
                                    <i class="fa fa-info"></i>
                                </span>
                            </span>
                  </button>
                       ';
            })
            ->editColumn('photo', function ($Product) {
                $image = ($Product->photo) ?? null;
                return '
                    <div class="d-flex align-items-center">
                                <div class="symbol symbol-50px me-5">
								<span class="symbol-label bg-light">
									<img class="h-100" onclick="window.open(this.src)" style="cursor: pointer"
                                         src=' . asset($image) . ' alt="">
								</span>
                                </div>

                    </div>
                    ';
            })
            ->editColumn('category_id', function ($Product) {
                return $Product->category->name;
            })
            ->editColumn('price', function ($Product) {
                return $Product->price .' ج.م ';
            })
            ->editColumn('is_shown', function ($Product) {
                if ($Product->is_shown == 'no')
                    return '<button title="تفعيل" style="background: none;border: 0px;" id="is_shown_btn" data-id="' . $Product->id . '"><i class="fas fa-toggle-off text-danger fs-1"></i></button>';
                else
                    return '<button title="الغاء تفعيل" style="background: none;border: 0px;" id="is_shown_btn" data-id="' . $Product->id . '"><i class="fas fa-toggle-on fs-1 text-success"></i></button>';
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function ProductDetails($id)
    {
        $Product_Photo = Product_Photo::where('product_id',$id)->latest()->get();

        $other_details = Product::where('id',$id)->firstOrFail();

        $returnHTML = view('Admin/Products/ProductDetails',['Product_Photo'=> $Product_Photo],['other_details'=> $other_details])->render();

        return response()->json( array('success' => true, 'html'=>$returnHTML) );
    }

    public function delete(Request $request)
    {
        $book = Book::where('id', $request->id)->first();
        $book->delete();
        return response()->json(
            [
                'success' => true,
                'message' => 'Data deleted successfully'
            ]);
    }

    public function is_shown_product(Request $request)
    {
        $Product = Product::where('id', $request->id)->first();
        ($Product->is_shown == 'yes') ? $Product->is_shown = 'no' : $Product->is_shown = 'yes';
        $Product->save();
        return response()->json(
            [
                'success' => true,
                'message' => 'Data changed successfully'
            ]);
    }


    //productsCategoryData
    public function productsCategory($id)
    {
        return view('Admin.Products.productsCategory',compact('id'));
    }

    public function productsCategoryData($id)
    {
        $Product = Product::where('category_id',$id)->latest()->get();
        return Datatables::of($Product)
            ->addColumn('action', function ($Product) {
                return '
                    <a href="' .route('edit.product',$Product->id). '"class="btn btn-icon btn-bg-light btn-info btn-sm me-1" style="border-radius: 50% !important">
                            <span class="svg-icon svg-icon-3">
                                <span class="svg-icon svg-icon-3">
                                    <i class="fa fa-edit"></i>
                                </span>
                            </span>
                  </a>
                  <button data-bs-toggle="modal" data-bs-target="#delete_modal" class="btn btn-icon btn-bg-light btn-danger btn-sm me-1" data-toggle="modal" style="border-radius: 50% !important"
                                    data-id="' . $Product->id . '" data-title_ar="' . $Product->name . '">
                            <span class="svg-icon svg-icon-3">
                                <span class="svg-icon svg-icon-3">
                                    <i class="fa fa-trash"></i>
                                </span>
                            </span>
                  </button>
                       ';
            })
            ->addColumn('ProductDetails', function ($Product) {
                return '
                    <button id="ProductDitails" data-id="'.$Product->id.'" class="btn btn-icon btn-bg-light btn-success btn-sm me-1" style="border-radius: 50% !important">
                            <span class="svg-icon svg-icon-3">
                                <span class="svg-icon svg-icon-3">
                                    <i class="fa fa-info"></i>
                                </span>
                            </span>
                  </button>
                       ';
            })
            ->editColumn('photo', function ($Product) {
                $image = ($Product->photo) ?? null;
                return '
                    <div class="d-flex align-items-center">
                                <div class="symbol symbol-50px me-5">
								<span class="symbol-label bg-light">
									<img class="h-100" onclick="window.open(this.src)" style="cursor: pointer"
                                         src=' . asset($image) . ' alt="">
								</span>
                                </div>

                    </div>
                    ';
            })
            ->editColumn('category_id', function ($Product) {
                return $Product->category->name;
            })
            ->editColumn('price', function ($Product) {
                return $Product->price .' ج.م ';
            })
            ->editColumn('is_shown', function ($Product) {
                if ($Product->is_shown == 'no')
                    return '<button title="تفعيل" style="background: none;border: 0px;" id="is_shown_btn" data-id="' . $Product->id . '"><i class="fas fa-toggle-off text-danger fs-1"></i></button>';
                else
                    return '<button title="الغاء تفعيل" style="background: none;border: 0px;" id="is_shown_btn" data-id="' . $Product->id . '"><i class="fas fa-toggle-on fs-1 text-success"></i></button>';
            })
            ->escapeColumns([])
            ->make(true);
    }

}//end class
