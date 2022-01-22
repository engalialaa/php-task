<meta charset="utf-8" />
<title>Wedding | لوحة التحكم</title>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="shortcut icon" href="{{url('admin')}}/logoe.png" />
<!--begin::Fonts-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
<!--end::Fonts-->
<!--begin::Global Stylesheets Bundle(used by all pages)-->
<link href="{{url('admin')}}/assets/plugins/global/plugins.bundle.rtl.css" rel="stylesheet" type="text/css" />
<link href="{{url('admin')}}/assets/css/style.bundle.rtl.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{url('admin')}}/assets/css/all.css"/>
<link rel="stylesheet" href="{{url('admin')}}/assets/css/fontawesome-stars.css"/>
<link href="{{url('/')}}/public/admin/assets/plugins/notify/css/notifIt.css" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css"
<!--end::Global Stylesheets Bundle-->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>

<link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">
<style>
    *{
        font-family: 'Cairo', sans-serif;
        font-size: 16px;
    }
    .toast-message{
        margin-right: 30px !important;
    }
    .form-control{
        font-family: 'Cairo',sans-serif !Important;
    }

    .btn{
        font-family: "Cairo" ,sans-serif !important;
        font-size: 1.2rem !important;
        border-radius: 7px!important;
    }
    input{
        font-family: "Cairo" ,sans-serif !important;
    }
    @toastr_css
</style>
<!--end::Web font -->

{{--===================================--}}
<!-- Bootstrap -->
<link rel="stylesheet" href="{{ url('/')}}/admin/css/bootstrap-rtl.css">
<link rel="stylesheet" href="{{ url('/')}}/admin/css/datatables2.min.css">
<style>
    .toast-top-right{
        margin-top: 37px !important;
    }
    .toast-message{
        margin-right: 30px !important;
    }
</style>
<style media="screen">
    .dz-image
    {
        border-radius:5px !important;
        margin-bottom: 10px;
    }
    .dz-remove
    {
        color: red;
    }
    .dz-image img
    {
        text-align: center;
        width:100%;
        height:100%;

    }
    .dropzone
    {
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
    }

</style>
<style>
    [class*="buttons-"] {
        background-color: #0162e8!important;
        color: white!important;
        margin-left: 3px!important;
        border-radius: 3px!important;
    }
    .alert {
        padding: 20px;
        background-color: #f44336;
        color: white;
    }

    .closebtn {
        margin-left: 15px;
        color: white;
        font-weight: bold;
        float: right;
        font-size: 22px;
        line-height: 20px;
        cursor: pointer;
        transition: 0.3s;
    }

    .closebtn:hover {
        color: black;
    }
    .aside-menu .menu-item .menu-link.active{
        background-color: #F4516C;
    }
</style>

{{--=========================  select to  ===============================--}}

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<style>
    span.select2-selection.select2-selection--multiple {
        height: 50px;
        overflow: auto;
        box-shadow: -2px 3px 10px #0000003d;
        border: 1px solid #cecece;
    }
</style>
{{--===================  adress  ========================--}}
<style>
    #example23_length{
        margin-right: 15%;
    }
    #map-canvas{
        height: 100%;
        margin: 0;
    }
    #map-canvas .centerMarker  {
        position: absolute;

        background: url(http://maps.gstatic.com/mapfiles/markers2/marker.png) no-repeat;

        top: 50%;
        left: 50%;
        z-index: 1;

        margin-left: -10px;
        margin-top: -34px;
        height: 34px;
        width: 20px;
        cursor: pointer;
    }
</style>

{{--=======================  tostar  ====================================--}}
{{--<link rel="stylesheet" href="{{url('admin/css')}}/tostar.css">--}}

{{--===================================--}}

<link href="{{url('admin')}}/assets/vendors/base/vendors.bundle.rtl.css" rel="stylesheet" type="text/css" />

<!--ltr version:<link href="{{url('admin')}}/assets/demo/demo6/base/style.bundle.css" rel="stylesheet" type="text/css" />-->

<link href="{{url('admin')}}/assets/demo/demo6/base/style.bundle.rtl.css" rel="stylesheet" type="text/css" />

<!--end::Global Theme Styles -->

<!--begin::Page Vendors Styles -->
<!--ltr version:<link href="{{url('admin')}}/assets/vendors/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />-->

<link href="{{url('admin')}}/assets/vendors/custom/fullcalendar/fullcalendar.bundle.rtl.css" rel="stylesheet" type="text/css" />

<!--end::Page Vendors Styles -->

<link rel="shortcut icon" href="{{url('admin')}}/logoe.png" />

<!-- ================== styles dropfy =================== -->

<link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" rel="stylesheet" type="text/css" />


<style type="text/css">


    /*--------- Main Content ---------*/

    .box
    {
        margin: 25px;
        padding: 25px;
        background: #fff
    }

    th
    {
        text-align: center;
    }

    tbody tr
    {
        text-align: center;
    }

    .dropify-wrapper
    {
        border-radius: 20px;
    }

    .imageuploadify-container button:before
    {
        content: "remove";
    }
    .imageuploadify .imageuploadify-images-list .imageuploadify-container button.btn-danger
    {
        width: 51px;
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.1/dropzone.css">

{{--=============== datatable ===================--}}

<style>
    #example_length{
        min-width: 33%;
        display: inline-flex;
        justify-content: center;
        padding:10px 20px;
    }
    #example_filter{
        min-width: 33%;
        display: inline-flex;
        justify-content: center;
        padding:10px 20px;
    }
    .dt-buttons.btn-group{
        min-width: 33%;
        display: inline-flex;
        justify-content: center;
        padding:10px 20px;
    }
</style>
