@extends('layouts.admin.app')
@section('page_name')قائمة المتجات@endsection
@section('content')
    <div class="card mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">اضافة منتج جديد</span>
            </h3>
            <div class="card-toolbar">
                <a href="{{route('products')}}" class="btn btn-light-primary er fs-6 px-7 py-3 ml-2">
                    <span><i class="bi bi-arrow-counterclockwise"></i></span>عودة</a>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body py-3">
            <div class="modal-body">
                <form method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    <div class="row">
                        <div class="col-lg-6 form-group">
                            <label> إسم المنتج </label>
                            <input class="form-control fs-3"   type="text" placeholder="إسم المنتج "   required name="name">
                        </div>

                        <div class="col-lg-6 form-group">
                            <label> القسم </label>
                            <select class="form-control" required name="category_id">
                                <option selected disabled>اختر القسم</option>
                            @foreach($Categories as $category)
                                    <option value="{{ $category->id }}"> {{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label> السعر </label>
                            <input class="form-control fs-3" required type="number"  name="price">
                        </div>

                        <div class="col-lg-6 form-group">
                            <label> الخصم </label>
                            <input class="form-control fs-3" required  type="number" name="descount"  min="0"/>
                        </div>

                        <div class="col-lg-6 form-group">
                            <label> صورة المنتج </label>
                            <input  type="file" name="photo" data-allowed-file-extensions="png jpg jpeg"  required class="dropify" />
                        </div>

                        <div class="col-lg-6 form-group">
                            <label> صور اخرى للمنتج </label>
                            <input  type="file" name="otherPhoto[]" data-allowed-file-extensions="png jpg jpeg"  required class="dropify" multiple>
                        </div>

                        <div class="contact_textarea col-lg-12 form-group">
                            <label>تفاصيل المنتج</label>
                            <textarea class="form-control fs-3"    name="details" placeholder="تفاصيل المنتج" class="form-control2"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">تاكيد</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection






