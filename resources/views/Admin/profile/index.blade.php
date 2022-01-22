@extends('layouts.admin.app')
@section('content')
    <div class="m-content">
        <div class="row">
            <div class="col-xl-12 col-lg-8">
                <div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-tools">
                            <ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link active" data-toggle="tab" role="tab">
                                        <i class="flaticon-share m--hide"></i>
                                        البروفايل
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="m_user_profile_tab_1">
                            <form class=""  action="{{route('store-profile')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="m-portlet__body">
                                    <div class="form-group m-form__group m--margin-top-10 m--hide">
                                        <div class="alert m-alert m-alert--default" role="alert">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <div class="col-10 ml-auto">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">الإسم</label>
                                        <div class="col-7">
                                            <input class="form-control m-input" required name="name" type="text" value="{{admin()->user()->name}}" >
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input"  class="col-2 col-form-label">البريد الإلكترونى</label>
                                        <div class="col-7">
                                            <input class="form-control m-input" required name="email" type="text" value="{{admin()->user()->email}}">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">كلمة السر</label>
                                        <div class="col-7">
                                            <input class="form-control m-input"  name="password" type="password" placeholder="*******">
                                        </div>
                                    </div>
                                </div>
                                <div class="m-portlet__foot m-portlet__foot--fit">
                                    <div class="m-form__actions">
                                        <div class="row">
                                            <div class="col-2">
                                            </div>
                                            <div class="col-7 text-center">
                                                <button type="submit" class="btn btn-accent m-btn m-btn--air m-btn--custom col-5">حفظ</button>&nbsp;&nbsp;
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane " id="m_user_profile_tab_2">
                        </div>
                        <div class="tab-pane " id="m_user_profile_tab_3">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
