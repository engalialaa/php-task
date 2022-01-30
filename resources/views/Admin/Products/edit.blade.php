@extends('layouts.admin.app')
@section('page_name')قائمة المتجات@endsection
@section('content')
    <div class="card mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">تعديل منتج -> {{$Product->name??'المنتج'}}</span>
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
                <form method="post" action="{{route('update.product')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id"  value="{{$Product->id}}">
                    <div class="row">
                        <div class="col-lg-6 form-group">
                            <label> إسم المنتج </label>
                            <input class="form-control fs-3" value="{{$Product->name??'المنتج'}}"   type="text" placeholder="إسم المنتج "   required name="name">
                        </div>

                        <div class="col-lg-6 form-group">
                            <label> القسم </label>
                            <select class="form-control" required name="category_id">
                                <option selected disabled>اختر القسم</option>
                                @foreach($Categories as $category)
                                    <option value="{{ $category->id }}" {{$Product->category_id == $category->id ? 'selected' : ''}}> {{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label> السعر </label>
                            <input class="form-control fs-3" required type="number" value="{{$Product->price??'0'}}" name="price">
                        </div>

                        <div class="col-lg-6 form-group">
                            <label> الخصم </label>
                            <input class="form-control fs-3" required  type="number"  value="{{$Product->descount??'0'}}" name="descount"  min="0"/>
                        </div>

                        <div class="col-lg-3 form-group">
                            <label> صورة المنتج </label>
                            <input  type="file" name="photo" data-allowed-file-extensions="png jpg jpeg" data-default-file="{{url('')}}/{{$Product->photo??''}}"   class="dropify" />
                        </div>

                        <div class="col-lg-3 form-group">
                            <label> صور اخرى للمنتج </label>
                            <input  type="file" name="otherPhoto[]" data-allowed-file-extensions="png jpg jpeg" class="dropify" multiple>
                        </div>

                        @foreach($Product_Photo as $key => $Product)
                        <div class="col-lg-2 form-group">
                            <label>{{$key+1}}</label>
                            <input  type="file"  data-allowed-file-extensions="png jpg jpeg" data-default-file="{{url('')}}/{{$Product->photo ?? ''}}" class="dropify" multiple>
                        </div>
                        @endforeach

                        <div class="col-lg-12 form-group">
                            <label>تفاصيل المنتج</label>
                            <textarea class="form-control fs-3"   name="details" placeholder="تفاصيل المنتج">{{$Product->details}}</textarea>
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






