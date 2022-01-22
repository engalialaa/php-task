<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\addCategory;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use App\Http\Traits\PhotoTrait;

class CategoryController extends Controller
{
    use PhotoTrait;
    public function index()
    {
        return view('Admin.Category.index');
    }

    public function categoryData()
    {
        $Category = Category::latest()->get();
        return Datatables::of($Category)
            ->addColumn('action', function ($Category) {
                return '
                            <button  id="edit_modal" class="btn btn-icon btn-bg-light btn-primary btn-sm me-1" data-toggle="modal" style="border-radius: 50% !important"
                                    data-id="' . $Category->id . '">
                            <span class="svg-icon svg-icon-3">
                                <span class="svg-icon svg-icon-3">
                                    <i class="fa fa-edit"></i>
                                </span>
                            </span>
                            </button>
                            <button data-bs-toggle="modal" data-bs-target="#delete_modal" class="btn btn-icon btn-bg-light btn-danger btn-sm me-1" data-toggle="modal" style="border-radius: 50% !important"
                                    data-id="' . $Category->id . '" data-title="' . $Category->name .'" data-is_shown="' . $Category->is_shown .'">
                            <span class="svg-icon svg-icon-3">
                                <span class="svg-icon svg-icon-3">
                                    <i class="fa fa-trash"></i>
                                </span>
                            </span>
                            </button>
                       ';
            })
            ->addColumn('products', function ($Category) {
                return '<a href="'.route('productsCategory',$Category->id).'" title="عرض المنتجات" style="background: none;border: 0px;"><i class="fas fa-info-circle text-success fs-1"></i></a>';
            })
            ->editColumn('photo', function ($Category) {
                $image = $Category->photo;
                return '
                    <div class="d-flex align-items-center">
                                <div class="symbol symbol-50px me-5">
								<span class="symbol-label bg-light">
									<img class="h-100" onclick="window.open(this.src)" style="cursor: pointer"
                                         src=' .asset($image) . ' alt="">
								</span>
                                </div>
                    </div>
                    ';
            })
            ->editColumn('is_shown', function ($Category) {
                if ($Category->is_shown == 'no')
                    return '<button title="تفعيل" style="background: none;border: 0px;" id="category_status" data-id="' . $Category->id . '"><i class="fas fa-toggle-off text-danger fs-1"></i></button>';
                else
                    return '<button title="الغاء التفعيل" style="background: none;border: 0px;" id="category_status" data-id="' . $Category->id . '"><i class="fas fa-toggle-on fs-1 text-success"></i></button>';
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function addCategory(addCategory $request)
    {
        $Category = new Category();
        $Category->name = $request->name;
        $photo_name = $this->saveImage($request->photo, 'public/uploads/admin/Category');
        $Category->photo = 'public/uploads/admin/Category/' . $photo_name;
        $Category->save();
        return response()->json(
            [
                'success' => true,
                'message' => 'Department added successfully'
            ]);
    }

    public function editCategory($id)
    {
        $Category = Category::where('id',$id)->firstOrFail();

        $returnHTML = view('Admin/Category/editCategory',['Category'=> $Category])->render();

        return response()->json( array('success' => true, 'html'=>$returnHTML) );
    }


    public function updateCategory(addCategory $request)
    {
        $Category = Category::where('id', $request->id)->first();
        if($request->has('photo')){
            $photo_name = $this->saveImage($request->photo, 'public/uploads/admin/Category');
            $Category->photo = 'public/uploads/admin/Category/' . $photo_name;
        }
        $Category->name = $request->name;
        $Category->save();
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Data updated successfully'
                ]);
    }

    public function deleteCategory(Request $request)
    {
        $Category = Category::where('id', $request->id)->first();
        if (file_exists($Category->photo)) {
            unlink($Category->photo);
        }
        $Category->delete();
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Data deleted successfully'
                ]);
    }

    public function category_status(Request $request)
    {
        $Category = Category::where('id', $request->id)->first();
        ($Category->is_shown == 'yes') ? $Category->is_shown = 'no' : $Category->is_shown = 'yes';
        $Category->save();
        return response()->json(
            [
                'success' => true,
                'message' => 'Data changed successfully'
            ]);
    }



}
