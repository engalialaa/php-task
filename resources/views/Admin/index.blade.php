@extends('layouts.admin.app')
<style>
    @import url(https://fonts.googleapis.com/css?family=Noto+Sans);

    .chart {
        max-width: 600px;
        max-height: 400px;
    }

    canvas {
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }

    body,
    .container {
        background: #eee;
        padding: .3em 0 2em
    }

    h1 {
        font-family: "Noto Sans", "Helvetica Neue", Helvetica, arial, sans-serif;
        font-size: 3em;
        text-align: center;
        text-transform: uppercase;
        color: #999;
        font-weight: 100;
        text-shadow: -1px 1px 0px #fff
    }

    /* #Canvas Element Circular charts
    ================================================== */
    canvas, video {
        display: inline-block;
    }


    .stats-container {
        margin: 0;
        padding: 0;
        list-style: none;
        text-align: center;
        padding-bottom: 50px;
    }

    .stats-container li {
        display: inline-block;
        margin: 0 4% 5px;
        position: relative;
    }

    .circular-stat {
        position: relative;
    }

    .circular-stat .digit-label {
        color: #F4516C;
        font-family: "Noto Sans", "Helvetica Neue", Helvetica, arial, sans-serif;
        font-size: 2em;
        text-align: center;
        display: inline-block;
        position: absolute;
        top: 18.5%;
        width: 75%;
        left: 12.5%;
        padding: 30px 0 0 30px;
        text-shadow: -1px 1px 0px #fff
        white-space: nowrap;
        overflow: hidden;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        -o-box-sizing: border-box;
        -ms-box-sizing: border-box;
        box-sizing: border-box;
    }

    .circular-stat .text-label {
        font-family: "cairo", "Helvetica Neue", Helvetica, arial, sans-serif;
        color: #333;
        font-size: 1.5em;
        top: 50%;
        left: 21.875%;
        width: 56.25%;
        padding-top: 6px;
        display: inline-block;
        position: absolute;
        text-align: center;
        border-top: 1px solid #999;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        -o-box-sizing: border-box;
        -ms-box-sizing: border-box;
        box-sizing: border-box;
    }

    span.text-title {
        color: #444;
        font-family: "cairo", "Helvetica Neue", Helvetica, arial, sans-serif;
        text-align: center;
        letter-spacing: -1px;
        font-size: 1.3em;
        font-weight: 400;
        text-shadow: -1px 1px 0px #FFF;
        padding: 30px 10px 0 0px;
        margin-top: 240px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        z-index: 99999;
        display: block;
        text-shadow: -1px 1px 0px #fff;
    }

    span.text-dates {
        font-size: 1em;
        font-family: "cairo", "Helvetica Neue", Helvetica, arial, sans-serif;
        color: #999;
        text-shadow: -1px 1px 0px #fff;
    }

    @media only screen and (min-width: 1010px) {
        .stats-container li {
            margin: 0 2% 5px;
        }
    }

    @media only screen and (max-width: 1009px) {
        .stats-container li {
            margin: 0 -.2em 5px;
        }
    }
</style>
<style>
    @import url(https://fonts.googleapis.com/css?family=Noto+Sans);

    .chart {
        max-width: 600px;
        max-height: 400px;
    }

    canvas {
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }

    body,
    .container {
        background: #eee;
        padding: .3em 0 2em
    }

    h1 {
        font-family: "Noto Sans", "Helvetica Neue", Helvetica, arial, sans-serif;
        font-size: 3em;
        text-align: center;
        text-transform: uppercase;
        color: #999;
        font-weight: 100;
        text-shadow: -1px 1px 0px #fff
    }

    /* #Canvas Element Circular charts
    ================================================== */
    canvas, video {
        display: inline-block;
    }


    .stats-container {
        margin: 0;
        padding: 0;
        list-style: none;
        text-align: center;
        padding-bottom: 70px;
    }

    .stats-container li {
        display: inline-block;
        margin: 0 4% 5px;
        position: relative;
    }

    .circular-stat {
        position: relative;
    }

    .circular-stat .digit-label {
        color: #5E3970;
        font-family: "Noto Sans", "Helvetica Neue", Helvetica, arial, sans-serif;
        font-size: 2em;
        text-align: center;
        display: inline-block;
        position: absolute;
        top: 18.5%;
        width: 75%;
        left: 12.5%;
        padding: 30px 0 0 30px;
        text-shadow: -1px 1px 0px #fff
        white-space: nowrap;
        overflow: hidden;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        -o-box-sizing: border-box;
        -ms-box-sizing: border-box;
        box-sizing: border-box;
    }

    .circular-stat .text-label {
        font-family: "cairo", "Helvetica Neue", Helvetica, arial, sans-serif;
        color: #333;
        font-size: 1.5em;
        top: 50%;
        left: 21.875%;
        width: 56.25%;
        padding-top: 6px;
        display: inline-block;
        position: absolute;
        text-align: center;
        border-top: 1px solid #999;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        -o-box-sizing: border-box;
        -ms-box-sizing: border-box;
        box-sizing: border-box;
    }

    span.text-title {
        color: #444;
        font-family: "cairo", "Helvetica Neue", Helvetica, arial, sans-serif;
        text-align: center;
        letter-spacing: -1px;
        font-size: 1.3em;
        font-weight: 400;
        text-shadow: -1px 1px 0px #FFF;
        padding: 30px 10px 0 0px;
        margin-top: 240px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        z-index: 99999;
        display: block;
        text-shadow: -1px 1px 0px #fff;
    }

    span.text-dates {
        font-size: 1em;
        font-family: "cairo", "Helvetica Neue", Helvetica, arial, sans-serif;
        color: #999;
        text-shadow: -1px 1px 0px #fff;
    }

    @media only screen and (min-width: 1010px) {
        .stats-container li {
            margin: 0 2% 5px;
        }
    }

    @media only screen and (max-width: 1009px) {
        .stats-container li {
            margin: 0 -.2em 5px;
        }
    }
</style>
@section('page_name') الرئيسية @endsection
@section('content')
    <div class="card-p position-relative" style="padding-top:0px!important;">
        <!--begin::Row-->
{{--        <div class="row">--}}
{{--            <!--begin::Col-->--}}
{{--            <div class="col bg-light-warning px-6 py-8  me-7 mb-7">--}}
{{--                <!--begin::Svg Icon | path: icons/duotone/Media/Equalizer.svg-->--}}
{{--                <span class="svg-icon svg-icon-3x svg-icon-warning d-block my-2">--}}
{{--																														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">--}}
{{--  <g>--}}
{{--    <style lang="en" type="text/css" id="dark-mode-custom-style"/>--}}
{{--    <style lang="en" type="text/css" id="dark-mode-native-style"/>--}}
{{--    <path xmlns="http://www.w3.org/2000/svg" d="m346 90c0-49.625-40.375-90-90-90s-90 40.375-90 90c0 49.914062 40.421875 91 90 91 49.550781 0 90-41.050781 90-91zm-90 61c-33.085938 0-60-27.363281-60-61 0-33.085938 26.914062-60 60-60s60 26.914062 60 60c0 33.636719-26.914062 61-60 61zm0 0" fill="#000000" data-original="#000000" class=""/>--}}
{{--    <path xmlns="http://www.w3.org/2000/svg" d="m151 135c0-33.085938-26.914062-60-60-60s-60 26.914062-60 60c0 32.894531 26.585938 61 60 61 33.425781 0 60-28.113281 60-61zm-60 31c-16.261719 0-30-14.195312-30-31 0-16.542969 13.457031-30 30-30s30 13.457031 30 30c0 16.804688-13.738281 31-30 31zm0 0" fill="#000000" data-original="#000000" class=""/>--}}
{{--    <path xmlns="http://www.w3.org/2000/svg" d="m481 135c0-33.085938-26.914062-60-60-60s-60 26.914062-60 60c0 32.894531 26.585938 61 60 61 33.425781 0 60-28.113281 60-61zm-60 31c-16.261719 0-30-14.195312-30-31 0-16.542969 13.457031-30 30-30s30 13.457031 30 30c0 16.804688-13.738281 31-30 31zm0 0" fill="#000000" data-original="#000000" class=""/>--}}
{{--    <path xmlns="http://www.w3.org/2000/svg" d="m421 196c-25.171875 0-48.910156 10.589844-65.734375 28.546875-24.828125-26.886719-60.34375-43.546875-99.265625-43.546875s-74.4375 16.660156-99.265625 43.546875c-16.824219-17.957031-40.566406-28.546875-65.734375-28.546875-49.921875 0-91 40.429688-91 90v30h512v-30c0-49.550781-41.066406-90-91-90zm-165 15c47.023438 0 87.65625 31.242188 100.65625 75h-201.3125c13-43.757812 53.632812-75 100.65625-75zm-165 15c18.726562 0 36.269531 8.796875 47.546875 23.40625-6.402344 11.253906-11.234375 23.546875-14.195313 36.59375h-94.351562c0-33.085938 27.363281-60 61-60zm296.648438 60c-2.960938-13.046875-7.792969-25.339844-14.195313-36.59375 11.277344-14.609375 28.820313-23.40625 47.546875-23.40625 33.636719 0 61 26.914062 61 60zm0 0" fill="#000000" data-original="#000000" class=""/>--}}
{{--  </g>--}}
{{--</svg>--}}
{{--															</span>--}}
{{--                <!--end::Svg Icon-->--}}
{{--                <a href="{{route('admin.index')}}" class="text-warning fw-bolder fs-5">المشرفين</a>--}}
{{--                <h3 class="text-warning">{{$admins}}</h3>--}}
{{--            </div>--}}
{{--            <!--end::Col-->--}}
{{--            <!--begin::Col-->--}}
{{--            <div class="col bg-light-primary px-6 py-8 me-7 mb-7">--}}
{{--                <!--begin::Svg Icon | path: icons/duotone/Communication/Add-user.svg-->--}}
{{--                <span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">--}}
{{--<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 32 32" style="enable-background:new 0 0 512 512" xml:space="preserve"><g><link type="text/css" rel="stylesheet" id="dark-mode-custom-link"></link><link type="text/css" rel="stylesheet" id="dark-mode-general-link"></link><style lang="en" type="text/css" id="dark-mode-custom-style"></style><style lang="en" type="text/css" id="dark-mode-native-style"></style><path xmlns="http://www.w3.org/2000/svg" d="m23.5 31h-17.5a3.009 3.009 0 0 1 -3-3 12.993 12.993 0 0 1 6.61-11.31 9.961 9.961 0 0 0 6.39 2.31 9.86 9.86 0 0 0 4.77-1.22 2.793 2.793 0 0 0 -.27 1.22v1.5h-1.5a3 3 0 0 0 0 6h1.5v1.5a3.009 3.009 0 0 0 3 3z" fill="#000000" data-original="#000000"></path><circle xmlns="http://www.w3.org/2000/svg" cx="16" cy="9" r="8" fill="#000000" data-original="#000000"></circle><path xmlns="http://www.w3.org/2000/svg" d="m28 22.5h-3.5v-3.5a1 1 0 0 0 -2 0v3.5h-3.5a1 1 0 0 0 0 2h3.5v3.5a1 1 0 0 0 2 0v-3.5h3.5a1 1 0 0 0 0-2z" fill="#000000" data-original="#000000"></path></g></svg>--}}
{{--															</span>--}}
{{--                <!--end::Svg Icon-->--}}
{{--                <a href="{{route('users.provider')}}" class="text-primary fw-bolder fs-5"> مقدمى الخدمة الجدد </a><br>--}}
{{--                <h3 class="text-primary">{{$UserNew}}</h3>--}}
{{--            </div>--}}
{{--            <!--end::Col-->--}}
{{--            <!--begin::Col-->--}}
{{--            <div class="col bg-light-success px-6 py-8 me-7 rounded-2 mb-7">--}}
{{--                <!--begin::Svg Icon | path: icons/duotone/Communication/Add-user.svg-->--}}
{{--                <span class="svg-icon svg-icon-3x svg-icon-success d-block my-2">--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><defs><linearGradient xmlns="http://www.w3.org/2000/svg" id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="256" x2="256" y1=".907" y2="511.093"><stop offset="0" stop-color="#2af598"></stop><stop offset="1" stop-color="#009efd"></stop></linearGradient></defs><g><link type="text/css" rel="stylesheet" id="dark-mode-custom-link"></link><link type="text/css" rel="stylesheet" id="dark-mode-general-link"></link><style lang="en" type="text/css" id="dark-mode-custom-style"></style><style lang="en" type="text/css" id="dark-mode-native-style"></style><linearGradient xmlns="http://www.w3.org/2000/svg" id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="256" x2="256" y1=".907" y2="511.093"><stop offset="0" stop-color="#2af598"></stop><stop offset="1" stop-color="#009efd"></stop></linearGradient><path xmlns="http://www.w3.org/2000/svg" d="m373 234c-76.645 0-139 62.355-139 139 6.988 184.149 271.039 184.099 278-.002 0-76.642-62.355-138.998-139-138.998zm0 238c-16.529 0-32.124-4.071-45.836-11.265 14.187-44.713 77.502-44.684 91.672 0-13.712 7.194-29.307 11.265-45.836 11.265zm-20-105c0-11.028 8.972-20 20-20 26.496 1.005 26.489 38.999 0 40-11.028 0-20-8.971-20-20zm97.881 67.055c-6.864-13.005-16.888-24.089-29.047-32.229 28.341-38.682-.502-95.283-48.835-94.825-48.327-.459-77.179 56.152-48.833 94.825-12.159 8.141-22.183 19.225-29.047 32.229-50.867-63.207-3.972-160.794 77.882-160.054 81.845-.742 128.755 96.863 77.88 160.054zm61.119-288.055v114.354c-11.405-14.046-24.906-26.315-40-36.373v-77.981c0-11.028-8.972-20-20-20h-62.642l29.802 29.875-28.32 28.249-78.124-78.319 78.159-77.965 28.25 28.319-29.915 29.841h62.79c33.084 0 60 26.916 60 60zm-390.84 181.875 78.124 78.319-78.159 77.966-28.25-28.32 29.915-29.84h-62.79c-33.084 0-60-26.916-60-60v-114.354c11.406 14.047 24.904 26.323 40 36.383v77.971c0 11.028 8.972 20 20 20h62.642l-29.802-29.875zm17.84-49.875c76.645 0 139-62.355 139-139-6.988-184.149-271.04-184.099-278 .002 0 76.643 62.356 138.998 139 138.998zm0-40c-16.529 0-32.124-4.071-45.836-11.264 14.187-44.713 77.502-44.685 91.672 0-13.712 7.193-29.307 11.264-45.836 11.264zm-20-105c0-11.028 8.972-20 20-20 26.496 1.005 26.489 38.999 0 40-11.028 0-20-8.972-20-20zm20-93c81.869-.734 128.743 96.865 77.881 160.055-6.864-13.005-16.888-24.089-29.047-32.23 28.341-38.681-.502-95.282-48.835-94.824-48.326-.46-77.18 56.153-48.833 94.824-12.159 8.141-22.183 19.225-29.047 32.23-50.879-63.21-3.955-160.797 77.881-160.055z" fill="url(&quot;#SVGID_1_&quot;)" data-original="url(#SVGID_1_)"></path></g></svg>--}}
{{--															</span>--}}
{{--                <!--end::Svg Icon-->--}}
{{--                <a  href="{{route('users.provider.accepted')}}" class="text-success fw-bolder fs-5"> مقدمى الخدمة المقبولين </a><br>--}}
{{--                <h3 class="text-success">{{$UserAccepted}}</h3>--}}
{{--            </div>--}}
{{--            <!--end::Col-->--}}
{{--            <!--begin::Col-->--}}
{{--            <div class="col bg-light-primary px-6 py-8 me-7 rounded-2 mb-7">--}}
{{--                <!--begin::Svg Icon | path: icons/duotone/Communication/Add-user.svg-->--}}
{{--                <span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">--}}
{{--<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve"><g><link type="text/css" rel="stylesheet" id="dark-mode-custom-link"></link><link type="text/css" rel="stylesheet" id="dark-mode-general-link"></link><style lang="en" type="text/css" id="dark-mode-custom-style"></style><style lang="en" type="text/css" id="dark-mode-native-style"></style><g xmlns="http://www.w3.org/2000/svg"><path d="m421 332c-49.626 0-90 40.374-90 90s40.374 90 90 90 90-40.374 90-90-40.374-90-90-90zm30 105h-15v15c0 8.284-6.716 15-15 15s-15-6.716-15-15v-15h-15c-8.284 0-15-6.716-15-15s6.716-15 15-15h15v-15c0-8.284 6.716-15 15-15s15 6.716 15 15v15h15c8.284 0 15 6.716 15 15s-6.716 15-15 15z" fill="#000000" data-original="#000000"></path><g><path d="m129.81 109.147c-14.22 12.948-33.109 20.853-53.81 20.853s-39.59-7.905-53.81-20.853c-12.814 9.053-21.19 23.97-21.19 40.853v55c0 8.284 6.716 15 15 15h120c8.284 0 15-6.716 15-15v-55c0-16.883-8.376-31.8-21.19-40.853z" fill="#000000" data-original="#000000"></path><circle cx="76" cy="50" r="50" fill="#000000" data-original="#000000"></circle><path d="m489.81 109.147c-14.22 12.948-33.109 20.853-53.81 20.853s-39.59-7.905-53.81-20.853c-12.814 9.053-21.19 23.97-21.19 40.853v55c0 8.284 6.716 15 15 15h120c8.284 0 15-6.716 15-15v-55c0-16.883-8.376-31.8-21.19-40.853z" fill="#000000" data-original="#000000"></path><circle cx="436" cy="50" r="50" fill="#000000" data-original="#000000"></circle><path d="m309.81 109.147c-14.22 12.948-33.109 20.853-53.81 20.853s-39.59-7.905-53.81-20.853c-12.814 9.053-21.19 23.97-21.19 40.853v55c0 8.284 6.716 15 15 15h120c8.284 0 15-6.716 15-15v-55c0-16.883-8.376-31.8-21.19-40.853z" fill="#000000" data-original="#000000"></path><circle cx="256" cy="50" r="50" fill="#000000" data-original="#000000"></circle></g><g><path d="m129.81 359.147c-14.22 12.948-33.109 20.853-53.81 20.853s-39.59-7.905-53.81-20.853c-12.814 9.053-21.19 23.97-21.19 40.853v55c0 8.284 6.716 15 15 15h120c8.284 0 15-6.716 15-15v-55c0-16.883-8.376-31.8-21.19-40.853z" fill="#000000" data-original="#000000"></path><circle cx="76" cy="300" r="50" fill="#000000" data-original="#000000"></circle><g><path d="m315.865 364.205c-1.885-1.835-3.9-3.536-6.055-5.058-14.22 12.948-33.109 20.853-53.81 20.853s-39.59-7.905-53.81-20.853c-12.814 9.053-21.19 23.97-21.19 40.853v55c0 8.284 6.716 15 15 15h115.03c-6.445-14.708-10.03-30.942-10.03-48 0-20.94 5.397-40.641 14.865-57.795z" fill="#000000" data-original="#000000"></path></g><circle cx="256" cy="300" r="50" fill="#000000" data-original="#000000"></circle></g></g></g></svg>															</span>--}}

{{--                <!--end::Svg Icon-->--}}
{{--                <a  href="{{route('users.client')}}" class="text-primary fw-bolder fs-5"> العملاء </a><br>--}}
{{--                <h3 class="text-primary">{{$client}}</h3>--}}
{{--            </div>--}}
{{--            <!--end::Col-->--}}
{{--        </div>--}}
{{--        <!--end::Row-->--}}
{{--        <!--begin::Row-->--}}
{{--        <div class="row">--}}
{{--            <!--begin::Col-->--}}
{{--            <div class="col bg-light-success px-6 py-8  me-7 mb-7">--}}
{{--                <!--begin::Svg Icon | path: icons/duotone/Media/Equalizer.svg-->--}}
{{--                <span class="svg-icon svg-icon-3x svg-icon-success d-block my-2">--}}
{{--														<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 480 480" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><link type="text/css" rel="stylesheet" id="dark-mode-custom-link"></link><link type="text/css" rel="stylesheet" id="dark-mode-general-link"></link><style lang="en" type="text/css" id="dark-mode-custom-style"></style><style lang="en" type="text/css" id="dark-mode-native-style"></style><path xmlns="http://www.w3.org/2000/svg" d="m40 0v464h120v-432zm0 0" fill="#004FAC" data-original="#004fac" class=""></path><path xmlns="http://www.w3.org/2000/svg" d="m280 64-120-32v432h120zm0 0" fill="#175FB4" data-original="#175fb4" class=""></path><path xmlns="http://www.w3.org/2000/svg" d="m280 112v352h80v-332zm0 0" fill="#D1E7F8" data-original="#d1e7f8"></path><path xmlns="http://www.w3.org/2000/svg" d="m440 152-80-20v332h80zm0 0" fill="#D9EBF9" data-original="#d9ebf9"></path><path xmlns="http://www.w3.org/2000/svg" d="m96 368h64v96h-64zm0 0" fill="#6D6E71" data-original="#6d6e71"></path><path xmlns="http://www.w3.org/2000/svg" d="m160 368h64v96h-64zm0 0" fill="#939598" data-original="#939598"></path><path xmlns="http://www.w3.org/2000/svg" d="m104 288h32v32h-32zm0 0" fill="#F1F2F2" data-original="#f1f2f2"></path><path xmlns="http://www.w3.org/2000/svg" d="m184 288h32v32h-32zm0 0" fill="#F1F2F2" data-original="#f1f2f2"></path><path xmlns="http://www.w3.org/2000/svg" d="m312 304h32v32h-32zm0 0" fill="#2488FF" data-original="#2488ff"></path><path xmlns="http://www.w3.org/2000/svg" d="m376 304h32v32h-32zm0 0" fill="#2488FF" data-original="#2488ff"></path><path xmlns="http://www.w3.org/2000/svg" d="m312 240h32v32h-32zm0 0" fill="#2488FF" data-original="#2488ff"></path><path xmlns="http://www.w3.org/2000/svg" d="m376 240h32v32h-32zm0 0" fill="#2488FF" data-original="#2488ff"></path><path xmlns="http://www.w3.org/2000/svg" d="m312 176h32v32h-32zm0 0" fill="#2488FF" data-original="#2488ff"></path><path xmlns="http://www.w3.org/2000/svg" d="m376 176h32v32h-32zm0 0" fill="#2488FF" data-original="#2488ff"></path><g xmlns="http://www.w3.org/2000/svg" fill="#F1F2F2"><path d="m104 224h32v32h-32zm0 0" fill="#F1F2F2" data-original="#f1f2f2"></path><path d="m184 224h32v32h-32zm0 0" fill="#F1F2F2" data-original="#f1f2f2"></path><path d="m104 160h32v32h-32zm0 0" fill="#F1F2F2" data-original="#f1f2f2"></path><path d="m184 160h32v32h-32zm0 0" fill="#F1F2F2" data-original="#f1f2f2"></path><path d="m104 96h32v32h-32zm0 0" fill="#F1F2F2" data-original="#f1f2f2"></path><path d="m184 96h32v32h-32zm0 0" fill="#F1F2F2" data-original="#f1f2f2"></path></g><path xmlns="http://www.w3.org/2000/svg" d="m360 384h32v80h-32zm0 0" fill="#A7A8AB" data-original="#a7a8ab"></path><path xmlns="http://www.w3.org/2000/svg" d="m328 384h32v80h-32zm0 0" fill="#939598" data-original="#939598"></path><path xmlns="http://www.w3.org/2000/svg" d="m0 456h480v16h-480zm0 0" fill="#21409A" data-original="#21409a"></path></g></svg>--}}
{{--															</span>--}}
{{--                <!--end::Svg Icon-->--}}
{{--                <a  href="{{route('category.index')}}"  class="text-success fw-bolder fs-5">الأقسام المفعلة</a>--}}
{{--                <h3 class="text-success">{{$departments_yes}}</h3>--}}
{{--            </div>--}}
{{--            <!--end::Col-->--}}
{{--            <!--begin::Col-->--}}
{{--            <div class="col bg-light-danger px-6 py-8 me-7 mb-7">--}}
{{--                <!--begin::Svg Icon | path: icons/duotone/Communication/Add-user.svg-->--}}
{{--                <span class="svg-icon svg-icon-3x svg-icon-danger d-block my-2">--}}
{{--														<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 480 480" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><link type="text/css" rel="stylesheet" id="dark-mode-custom-link"></link><link type="text/css" rel="stylesheet" id="dark-mode-general-link"></link><style lang="en" type="text/css" id="dark-mode-custom-style"></style><style lang="en" type="text/css" id="dark-mode-native-style"></style><path xmlns="http://www.w3.org/2000/svg" d="m40 0v464h120v-432zm0 0" fill="#004FAC" data-original="#004fac" class=""></path><path xmlns="http://www.w3.org/2000/svg" d="m280 64-120-32v432h120zm0 0" fill="#175FB4" data-original="#175fb4" class=""></path><path xmlns="http://www.w3.org/2000/svg" d="m280 112v352h80v-332zm0 0" fill="#D1E7F8" data-original="#d1e7f8"></path><path xmlns="http://www.w3.org/2000/svg" d="m440 152-80-20v332h80zm0 0" fill="#D9EBF9" data-original="#d9ebf9"></path><path xmlns="http://www.w3.org/2000/svg" d="m96 368h64v96h-64zm0 0" fill="#6D6E71" data-original="#6d6e71"></path><path xmlns="http://www.w3.org/2000/svg" d="m160 368h64v96h-64zm0 0" fill="#939598" data-original="#939598"></path><path xmlns="http://www.w3.org/2000/svg" d="m104 288h32v32h-32zm0 0" fill="#F1F2F2" data-original="#f1f2f2"></path><path xmlns="http://www.w3.org/2000/svg" d="m184 288h32v32h-32zm0 0" fill="#F1F2F2" data-original="#f1f2f2"></path><path xmlns="http://www.w3.org/2000/svg" d="m312 304h32v32h-32zm0 0" fill="#2488FF" data-original="#2488ff"></path><path xmlns="http://www.w3.org/2000/svg" d="m376 304h32v32h-32zm0 0" fill="#2488FF" data-original="#2488ff"></path><path xmlns="http://www.w3.org/2000/svg" d="m312 240h32v32h-32zm0 0" fill="#2488FF" data-original="#2488ff"></path><path xmlns="http://www.w3.org/2000/svg" d="m376 240h32v32h-32zm0 0" fill="#2488FF" data-original="#2488ff"></path><path xmlns="http://www.w3.org/2000/svg" d="m312 176h32v32h-32zm0 0" fill="#2488FF" data-original="#2488ff"></path><path xmlns="http://www.w3.org/2000/svg" d="m376 176h32v32h-32zm0 0" fill="#2488FF" data-original="#2488ff"></path><g xmlns="http://www.w3.org/2000/svg" fill="#F1F2F2"><path d="m104 224h32v32h-32zm0 0" fill="#F1F2F2" data-original="#f1f2f2"></path><path d="m184 224h32v32h-32zm0 0" fill="#F1F2F2" data-original="#f1f2f2"></path><path d="m104 160h32v32h-32zm0 0" fill="#F1F2F2" data-original="#f1f2f2"></path><path d="m184 160h32v32h-32zm0 0" fill="#F1F2F2" data-original="#f1f2f2"></path><path d="m104 96h32v32h-32zm0 0" fill="#F1F2F2" data-original="#f1f2f2"></path><path d="m184 96h32v32h-32zm0 0" fill="#F1F2F2" data-original="#f1f2f2"></path></g><path xmlns="http://www.w3.org/2000/svg" d="m360 384h32v80h-32zm0 0" fill="#A7A8AB" data-original="#a7a8ab"></path><path xmlns="http://www.w3.org/2000/svg" d="m328 384h32v80h-32zm0 0" fill="#939598" data-original="#939598"></path><path xmlns="http://www.w3.org/2000/svg" d="m0 456h480v16h-480zm0 0" fill="#21409A" data-original="#21409a"></path></g></svg>--}}
{{--															</span>--}}
{{--                <!--end::Svg Icon-->--}}
{{--                <a  href="{{route('category.index')}}" class="text-danger fw-bolder fs-5"> الأقسام الغير مفعلة </a><br>--}}
{{--                <h3 class="text-danger">{{$departments_no}}</h3>--}}
{{--            </div>--}}
{{--            <!--end::Col-->--}}
{{--            <!--begin::Col-->--}}
{{--            <div class="col bg-light-warning px-6 py-8 me-7 rounded-2 mb-7">--}}
{{--                <!--begin::Svg Icon | path: icons/duotone/Communication/Add-user.svg-->--}}
{{--                <span class="svg-icon svg-icon-3x svg-icon-warning d-block my-2">--}}
{{--<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 128 128" style="enable-background:new 0 0 512 512" xml:space="preserve"><g><link type="text/css" rel="stylesheet" id="dark-mode-custom-link"></link><link type="text/css" rel="stylesheet" id="dark-mode-general-link"></link><style lang="en" type="text/css" id="dark-mode-custom-style"></style><style lang="en" type="text/css" id="dark-mode-native-style"></style><g xmlns="http://www.w3.org/2000/svg"><path d="m99.47 25.874v-2.214a6.427 6.427 0 0 0 -6.41-6.41 6.417 6.417 0 0 0 -6.41 6.41v2.11h-6.56v-2.11a6.41 6.41 0 0 0 -6.4-6.41 6.418 6.418 0 0 0 -6.41 6.41v2.11h-6.56v-2.11a6.405 6.405 0 1 0 -12.81 0v2.11h-6.56v-2.11a6.427 6.427 0 0 0 -6.41-6.41 6.418 6.418 0 0 0 -6.41 6.41v2.214a12.853 12.853 0 0 0 -11.28 12.736v59.3a12.855 12.855 0 0 0 12.84 12.84h67.82a12.855 12.855 0 0 0 12.84-12.84v-59.3a12.853 12.853 0 0 0 -11.28-12.736zm-9.32-2.214a2.914 2.914 0 0 1 2.91-2.91 2.928 2.928 0 0 1 2.91 2.91v7.72a2.91 2.91 0 0 1 -5.82 0zm-19.37 0a2.913 2.913 0 0 1 2.91-2.91 2.909 2.909 0 0 1 2.9 2.91v7.72a2.905 2.905 0 1 1 -5.81 0zm-19.37 0a2.905 2.905 0 1 1 5.81 0v7.72a2.905 2.905 0 1 1 -5.81 0zm-19.38 0a2.913 2.913 0 0 1 2.91-2.91 2.928 2.928 0 0 1 2.91 2.91v7.72a2.91 2.91 0 0 1 -5.82 0zm-3.5 5.751v1.969a6.41 6.41 0 0 0 12.82 0v-2.11h6.56v2.11a6.405 6.405 0 1 0 12.81 0v-2.11h6.56v2.11a6.405 6.405 0 1 0 12.81 0v-2.11h6.56v2.11a6.41 6.41 0 0 0 12.82 0v-1.969a9.348 9.348 0 0 1 7.78 9.2v5.267h-86.5v-5.268a9.348 9.348 0 0 1 7.78-9.199zm69.38 77.839h-67.82a9.351 9.351 0 0 1 -9.34-9.34v-50.53h86.5v50.53a9.351 9.351 0 0 1 -9.34 9.34z" fill="#000000" data-original="#000000"></path><path d="m41.684 56.135h-7.066a4.646 4.646 0 0 0 -4.64 4.64v7.066a4.646 4.646 0 0 0 4.64 4.64h7.066a4.646 4.646 0 0 0 4.64-4.64v-7.066a4.646 4.646 0 0 0 -4.64-4.64zm1.14 11.706a1.141 1.141 0 0 1 -1.14 1.14h-7.066a1.141 1.141 0 0 1 -1.14-1.14v-7.066a1.141 1.141 0 0 1 1.14-1.14h7.066a1.141 1.141 0 0 1 1.14 1.14z" fill="#000000" data-original="#000000"></path><path d="m67.533 56.135h-7.066a4.646 4.646 0 0 0 -4.64 4.64v7.066a4.646 4.646 0 0 0 4.64 4.64h7.066a4.646 4.646 0 0 0 4.64-4.64v-7.066a4.646 4.646 0 0 0 -4.64-4.64zm1.14 11.706a1.141 1.141 0 0 1 -1.14 1.14h-7.066a1.141 1.141 0 0 1 -1.14-1.14v-7.066a1.141 1.141 0 0 1 1.14-1.14h7.066a1.141 1.141 0 0 1 1.14 1.14z" fill="#000000" data-original="#000000"></path><path d="m95.65 58.529-7.85 7.846-3.756-3.756a1.75 1.75 0 0 0 -2.474 2.475l4.993 4.993a1.749 1.749 0 0 0 2.475 0l9.087-9.087a1.75 1.75 0 0 0 -2.475-2.475z" fill="#000000" data-original="#000000"></path><path d="m41.684 80.241h-7.066a4.646 4.646 0 0 0 -4.64 4.64v7.066a4.646 4.646 0 0 0 4.64 4.64h7.066a4.646 4.646 0 0 0 4.64-4.64v-7.066a4.646 4.646 0 0 0 -4.64-4.64zm1.14 11.706a1.141 1.141 0 0 1 -1.14 1.14h-7.066a1.141 1.141 0 0 1 -1.14-1.14v-7.066a1.141 1.141 0 0 1 1.14-1.14h7.066a1.141 1.141 0 0 1 1.14 1.14z" fill="#000000" data-original="#000000"></path><path d="m67.533 80.241h-7.066a4.646 4.646 0 0 0 -4.64 4.64v7.066a4.646 4.646 0 0 0 4.64 4.64h7.066a4.646 4.646 0 0 0 4.64-4.64v-7.066a4.646 4.646 0 0 0 -4.64-4.64zm1.14 11.706a1.141 1.141 0 0 1 -1.14 1.14h-7.066a1.141 1.141 0 0 1 -1.14-1.14v-7.066a1.141 1.141 0 0 1 1.14-1.14h7.066a1.141 1.141 0 0 1 1.14 1.14z" fill="#000000" data-original="#000000"></path><path d="m93.382 80.241h-7.066a4.646 4.646 0 0 0 -4.64 4.64v7.066a4.646 4.646 0 0 0 4.64 4.64h7.066a4.646 4.646 0 0 0 4.64-4.64v-7.066a4.646 4.646 0 0 0 -4.64-4.64zm1.14 11.706a1.141 1.141 0 0 1 -1.14 1.14h-7.066a1.141 1.141 0 0 1 -1.14-1.14v-7.066a1.141 1.141 0 0 1 1.14-1.14h7.066a1.141 1.141 0 0 1 1.14 1.14z" fill="#000000" data-original="#000000"></path></g></g></svg>															</span>--}}
{{--                <!--end::Svg Icon-->--}}
{{--                <a  href="{{route('reservations.new')}}" class="text-warning fw-bolder fs-5"> الحجوزات الجديدة </a><br>--}}
{{--                <h3 class="text-warning">{{$Reservations_new}}</h3>--}}
{{--            </div>--}}
{{--            <!--end::Col-->--}}
{{--            <!--begin::Col-->--}}
{{--            <div class="col bg-light-success px-6 py-8 me-7 rounded-2 mb-7">--}}
{{--                <!--begin::Svg Icon | path: icons/duotone/Communication/Add-user.svg-->--}}
{{--                <span class="svg-icon svg-icon-3x svg-icon-success d-block my-2">--}}
{{--															<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 682 682.66669" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><link type="text/css" rel="stylesheet" id="dark-mode-custom-link"></link><link type="text/css" rel="stylesheet" id="dark-mode-general-link"></link><style lang="en" type="text/css" id="dark-mode-custom-style"></style><style lang="en" type="text/css" id="dark-mode-native-style"></style><path xmlns="http://www.w3.org/2000/svg" d="m313.585938 137.730469h-18.75v-18.75h18.75zm-31.25 0h-18.75v-18.75h18.75zm0 0" fill="#000000" data-original="#000000"></path><path xmlns="http://www.w3.org/2000/svg" d="m560.097656 621.25h-543.015625v-408.40625h-18.75v427.15625h580.515625v-427.15625h-18.75zm0 0" fill="#000000" data-original="#000000"></path><path xmlns="http://www.w3.org/2000/svg" d="m164.054688 137.730469 15.25-15.253907v-107.226562l-15.25-15.25h-41.648438l-15.253906 15.25v107.226562l15.253906 15.253907zm-38.152344-114.714844 4.265625-4.265625h26.121093l4.265626 4.265625v91.695313l-4.265626 4.269531h-26.121093l-4.265625-4.269531zm0 0" fill="#000000" data-original="#000000"></path><path xmlns="http://www.w3.org/2000/svg" d="m454.773438 137.730469 15.253906-15.253907v-107.226562l-15.253906-15.25h-41.648438l-15.25 15.25v107.226562l15.25 15.253907zm-38.148438-114.714844 4.265625-4.265625h26.121094l4.265625 4.265625v91.695313l-4.265625 4.269531h-26.121094l-4.265625-4.269531zm0 0" fill="#000000" data-original="#000000"></path><path xmlns="http://www.w3.org/2000/svg" d="m485.652344 59.488281v18.75h74.445312v100.230469h-543.015625v-100.230469h74.445313v-18.75h-93.195313v137.730469h580.515625v-137.730469zm0 0" fill="#000000" data-original="#000000"></path><path xmlns="http://www.w3.org/2000/svg" d="m194.929688 59.488281h187.320312v18.75h-187.320312zm0 0" fill="#000000" data-original="#000000"></path><path xmlns="http://www.w3.org/2000/svg" d="m398.945312 247.609375-155.714843 155.710937-64.996094-64.996093-75.355469 75.355469 140.347656 140.347656 231.070313-231.0625zm-269.546874 166.070313 48.835937-48.835938 64.996094 64.996094 155.714843-155.714844 48.835938 48.839844-204.550781 204.550781zm0 0" fill="#000000" data-original="#000000"></path></g></svg>--}}
{{--															</span>--}}
{{--                <!--end::Svg Icon-->--}}
{{--                <a  href="{{route('reservations.confirmed')}}" class="text-success fw-bolder fs-5"> الحجوزات المؤكدة </a><br>--}}
{{--                <h3 class="text-success">{{$Reservations_confirmed}}</h3>--}}
{{--            </div>--}}
{{--            <!--end::Col-->--}}
{{--        </div>--}}
{{--        <!--end::Row-->--}}
{{--        <!--begin::Row-->--}}
{{--        <div class="row">--}}
{{--            <!--begin::Col-->--}}
{{--            <div class="col bg-light-success px-6 py-8 me-7 mb-7">--}}
{{--                <!--begin::Svg Icon | path: icons/duotone/Communication/Add-user.svg-->--}}
{{--                <span class="svg-icon svg-icon-3x svg-icon-success d-block my-2">--}}
{{--															<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 64 64" style="enable-background:new 0 0 512 512" xml:space="preserve"><g><link type="text/css" rel="stylesheet" id="dark-mode-custom-link"></link><link type="text/css" rel="stylesheet" id="dark-mode-general-link"></link><style lang="en" type="text/css" id="dark-mode-custom-style"></style><style lang="en" type="text/css" id="dark-mode-native-style"></style><g xmlns="http://www.w3.org/2000/svg" id="support-setting-call-headphone-help"><path d="M61.15,44.9a4.007,4.007,0,0,0-5.46-1.47l-9.75,5.63a3.982,3.982,0,0,0-2.26-1.63L28.76,43.44a6.957,6.957,0,0,0-3.51-.03L20,44.72V43a1,1,0,0,0-1-1H11a1,1,0,0,0-1,1v1H3a1,1,0,0,0-1,1V59a1,1,0,0,0,1,1h7v1a1,1,0,0,0,1,1h8a1,1,0,0,0,1-1V59.62l1.29.64a7.063,7.063,0,0,0,3.13.74H39.39a6.93,6.93,0,0,0,3.5-.94l16.8-9.7A4.009,4.009,0,0,0,61.15,44.9ZM10,58H4V46h6Zm8,2H12V44h6ZM58.69,48.63l-16.8,9.7a4.982,4.982,0,0,1-2.5.67H24.42a4.956,4.956,0,0,1-2.24-.53L20,57.38V46.78l5.73-1.43a4.964,4.964,0,0,1,2.51.02l14.92,4a1.991,1.991,0,0,1,.48,3.66,1.95,1.95,0,0,1-1.51.2L30.2,50.03a1,1,0,0,0-.52,1.94l11.93,3.19a4.072,4.072,0,0,0,1.04.14,3.916,3.916,0,0,0,1.99-.54,3.975,3.975,0,0,0,1.87-2.43,4.118,4.118,0,0,0,.11-1.35l10.07-5.81a2.025,2.025,0,0,1,2.72.73A2,2,0,0,1,58.69,48.63Z" fill="#000000" data-original="#000000"></path><path d="M15,59a1,1,0,0,0,1-1V57a1,1,0,0,0-2,0v1A1,1,0,0,0,15,59Z" fill="#000000" data-original="#000000"></path><path d="M46,17H42.25l-.18-.42,2.66-2.65a1.008,1.008,0,0,0,0-1.42L40.49,8.27a1.008,1.008,0,0,0-1.42,0l-2.65,2.66L36,10.75V7a1,1,0,0,0-1-1H29a1,1,0,0,0-1,1v3.75l-.42.18L24.93,8.27a1.008,1.008,0,0,0-1.42,0l-4.24,4.24a1.008,1.008,0,0,0,0,1.42l2.66,2.65-.18.42H18a1,1,0,0,0-1,1v6a1,1,0,0,0,1,1h3.75l.18.42-2.66,2.65a1.033,1.033,0,0,0-.29.71,1.052,1.052,0,0,0,.29.71l4.24,4.24a1.033,1.033,0,0,0,.71.29,1.052,1.052,0,0,0,.71-.29l2.65-2.66.42.18V35a1,1,0,0,0,1,1h6a1,1,0,0,0,1-1V31.25l.42-.18,2.65,2.66a1.047,1.047,0,0,0,1.42,0l4.24-4.24a1.052,1.052,0,0,0,.29-.71,1.033,1.033,0,0,0-.29-.71l-2.66-2.65.18-.42H46a1,1,0,0,0,1-1V18A1,1,0,0,0,46,17Zm-1,6H41.54a1,1,0,0,0-.95.69,7.906,7.906,0,0,1-.61,1.45,1.016,1.016,0,0,0,.17,1.19l2.46,2.45-2.83,2.83-2.45-2.46a1.016,1.016,0,0,0-1.19-.17,7.906,7.906,0,0,1-1.45.61,1,1,0,0,0-.69.95V34H30V30.54a1,1,0,0,0-.69-.95,7.906,7.906,0,0,1-1.45-.61,1.016,1.016,0,0,0-1.19.17l-2.45,2.46-2.83-2.83,2.46-2.45a1.016,1.016,0,0,0,.17-1.19,7.906,7.906,0,0,1-.61-1.45,1,1,0,0,0-.95-.69H19V19h3.46a1,1,0,0,0,.95-.69,7.906,7.906,0,0,1,.61-1.45,1.016,1.016,0,0,0-.17-1.19l-2.46-2.45,2.83-2.83,2.45,2.46a1.016,1.016,0,0,0,1.19.17,7.906,7.906,0,0,1,1.45-.61,1,1,0,0,0,.69-.95V8h4v3.46a1,1,0,0,0,.69.95,7.906,7.906,0,0,1,1.45.61,1.016,1.016,0,0,0,1.19-.17l2.45-2.46,2.83,2.83-2.46,2.45a1.016,1.016,0,0,0-.17,1.19,7.906,7.906,0,0,1,.61,1.45,1,1,0,0,0,.95.69H45Z" fill="#000000" data-original="#000000"></path><path d="M38,21a6,6,0,1,0-6,6A6.006,6.006,0,0,0,38,21ZM28,21a4,4,0,1,1,4,4A4,4,0,0,1,28,21Z" fill="#000000" data-original="#000000"></path><path d="M55,23H53a21,21,0,0,0-42,0H9A6,6,0,0,0,9,35h5a1,1,0,0,0,1-1V24a1,1,0,0,0-1-1H13a19,19,0,0,1,38,0H50a1,1,0,0,0-1,1V34a1,1,0,0,0,1,1h1v3a1,1,0,0,1-1,1H42.82A3.01,3.01,0,0,0,40,37H38a3,3,0,0,0,0,6h2a3.01,3.01,0,0,0,2.82-2H50a3.009,3.009,0,0,0,3-3V35h2a6,6,0,0,0,0-12ZM9,33a4,4,0,0,1,0-8Zm4,0H11V25h2Zm27,8H38a1,1,0,0,1,0-2h2a1,1,0,0,1,0,2Zm13-8H51V25h2Zm2,0V25a4,4,0,0,1,0,8Z" fill="#000000" data-original="#000000"></path></g></g></svg>--}}
{{--															</span>--}}
{{--                <!--end::Svg Icon-->--}}
{{--                <a  href="{{route('services')}}" class="text-success fw-bolder fs-5"> الخدمات المعروضة </a><br>--}}
{{--                <h3 class="text-success">{{$services_yes}}</h3>--}}
{{--            </div>--}}
{{--            <!--end::Col-->--}}
{{--            <!--begin::Col-->--}}
{{--            <div class="col bg-light-danger px-6 py-8 me-7 mb-7">--}}
{{--                <!--begin::Svg Icon | path: icons/duotone/Communication/Add-user.svg-->--}}
{{--                <span class="svg-icon svg-icon-3x svg-icon-danger d-block my-2">--}}
{{--                    															<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 64 64" style="enable-background:new 0 0 512 512" xml:space="preserve"><g><link type="text/css" rel="stylesheet" id="dark-mode-custom-link"></link><link type="text/css" rel="stylesheet" id="dark-mode-general-link"></link><style lang="en" type="text/css" id="dark-mode-custom-style"></style><style lang="en" type="text/css" id="dark-mode-native-style"></style><g xmlns="http://www.w3.org/2000/svg" id="support-setting-call-headphone-help"><path d="M61.15,44.9a4.007,4.007,0,0,0-5.46-1.47l-9.75,5.63a3.982,3.982,0,0,0-2.26-1.63L28.76,43.44a6.957,6.957,0,0,0-3.51-.03L20,44.72V43a1,1,0,0,0-1-1H11a1,1,0,0,0-1,1v1H3a1,1,0,0,0-1,1V59a1,1,0,0,0,1,1h7v1a1,1,0,0,0,1,1h8a1,1,0,0,0,1-1V59.62l1.29.64a7.063,7.063,0,0,0,3.13.74H39.39a6.93,6.93,0,0,0,3.5-.94l16.8-9.7A4.009,4.009,0,0,0,61.15,44.9ZM10,58H4V46h6Zm8,2H12V44h6ZM58.69,48.63l-16.8,9.7a4.982,4.982,0,0,1-2.5.67H24.42a4.956,4.956,0,0,1-2.24-.53L20,57.38V46.78l5.73-1.43a4.964,4.964,0,0,1,2.51.02l14.92,4a1.991,1.991,0,0,1,.48,3.66,1.95,1.95,0,0,1-1.51.2L30.2,50.03a1,1,0,0,0-.52,1.94l11.93,3.19a4.072,4.072,0,0,0,1.04.14,3.916,3.916,0,0,0,1.99-.54,3.975,3.975,0,0,0,1.87-2.43,4.118,4.118,0,0,0,.11-1.35l10.07-5.81a2.025,2.025,0,0,1,2.72.73A2,2,0,0,1,58.69,48.63Z" fill="#000000" data-original="#000000"></path><path d="M15,59a1,1,0,0,0,1-1V57a1,1,0,0,0-2,0v1A1,1,0,0,0,15,59Z" fill="#000000" data-original="#000000"></path><path d="M46,17H42.25l-.18-.42,2.66-2.65a1.008,1.008,0,0,0,0-1.42L40.49,8.27a1.008,1.008,0,0,0-1.42,0l-2.65,2.66L36,10.75V7a1,1,0,0,0-1-1H29a1,1,0,0,0-1,1v3.75l-.42.18L24.93,8.27a1.008,1.008,0,0,0-1.42,0l-4.24,4.24a1.008,1.008,0,0,0,0,1.42l2.66,2.65-.18.42H18a1,1,0,0,0-1,1v6a1,1,0,0,0,1,1h3.75l.18.42-2.66,2.65a1.033,1.033,0,0,0-.29.71,1.052,1.052,0,0,0,.29.71l4.24,4.24a1.033,1.033,0,0,0,.71.29,1.052,1.052,0,0,0,.71-.29l2.65-2.66.42.18V35a1,1,0,0,0,1,1h6a1,1,0,0,0,1-1V31.25l.42-.18,2.65,2.66a1.047,1.047,0,0,0,1.42,0l4.24-4.24a1.052,1.052,0,0,0,.29-.71,1.033,1.033,0,0,0-.29-.71l-2.66-2.65.18-.42H46a1,1,0,0,0,1-1V18A1,1,0,0,0,46,17Zm-1,6H41.54a1,1,0,0,0-.95.69,7.906,7.906,0,0,1-.61,1.45,1.016,1.016,0,0,0,.17,1.19l2.46,2.45-2.83,2.83-2.45-2.46a1.016,1.016,0,0,0-1.19-.17,7.906,7.906,0,0,1-1.45.61,1,1,0,0,0-.69.95V34H30V30.54a1,1,0,0,0-.69-.95,7.906,7.906,0,0,1-1.45-.61,1.016,1.016,0,0,0-1.19.17l-2.45,2.46-2.83-2.83,2.46-2.45a1.016,1.016,0,0,0,.17-1.19,7.906,7.906,0,0,1-.61-1.45,1,1,0,0,0-.95-.69H19V19h3.46a1,1,0,0,0,.95-.69,7.906,7.906,0,0,1,.61-1.45,1.016,1.016,0,0,0-.17-1.19l-2.46-2.45,2.83-2.83,2.45,2.46a1.016,1.016,0,0,0,1.19.17,7.906,7.906,0,0,1,1.45-.61,1,1,0,0,0,.69-.95V8h4v3.46a1,1,0,0,0,.69.95,7.906,7.906,0,0,1,1.45.61,1.016,1.016,0,0,0,1.19-.17l2.45-2.46,2.83,2.83-2.46,2.45a1.016,1.016,0,0,0-.17,1.19,7.906,7.906,0,0,1,.61,1.45,1,1,0,0,0,.95.69H45Z" fill="#000000" data-original="#000000"></path><path d="M38,21a6,6,0,1,0-6,6A6.006,6.006,0,0,0,38,21ZM28,21a4,4,0,1,1,4,4A4,4,0,0,1,28,21Z" fill="#000000" data-original="#000000"></path><path d="M55,23H53a21,21,0,0,0-42,0H9A6,6,0,0,0,9,35h5a1,1,0,0,0,1-1V24a1,1,0,0,0-1-1H13a19,19,0,0,1,38,0H50a1,1,0,0,0-1,1V34a1,1,0,0,0,1,1h1v3a1,1,0,0,1-1,1H42.82A3.01,3.01,0,0,0,40,37H38a3,3,0,0,0,0,6h2a3.01,3.01,0,0,0,2.82-2H50a3.009,3.009,0,0,0,3-3V35h2a6,6,0,0,0,0-12ZM9,33a4,4,0,0,1,0-8Zm4,0H11V25h2Zm27,8H38a1,1,0,0,1,0-2h2a1,1,0,0,1,0,2Zm13-8H51V25h2Zm2,0V25a4,4,0,0,1,0,8Z" fill="#000000" data-original="#000000"></path></g></g></svg>--}}

{{--															</span>--}}
{{--                <!--end::Svg Icon-->--}}
{{--                <a  href="{{route('services')}}" class="text-danger fw-bolder fs-5"> الخدمات الغير معروضة </a><br>--}}
{{--                <h3 class="text-danger">{{$services_no}}</h3>--}}
{{--            </div>--}}
{{--            <!--end::Col-->--}}
{{--            <!--begin::Col-->--}}
{{--            <div class="col bg-light-success px-6 py-8  me-7 mb-7">--}}
{{--                <!--begin::Svg Icon | path: icons/duotone/Media/Equalizer.svg-->--}}
{{--                <span class="svg-icon svg-icon-3x svg-icon-success d-block my-2">--}}
{{--													<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve"><g><link type="text/css" rel="stylesheet" id="dark-mode-custom-link"></link><link type="text/css" rel="stylesheet" id="dark-mode-general-link"></link><style lang="en" type="text/css" id="dark-mode-custom-style"></style><style lang="en" type="text/css" id="dark-mode-native-style"></style>--}}
{{--<g xmlns="http://www.w3.org/2000/svg">--}}
{{--	<g>--}}
{{--		<path d="M465.455,69.818H46.545C20.839,69.818,0,90.657,0,116.364v279.273c0,25.706,20.839,46.545,46.545,46.545h418.909    c25.706,0,46.545-20.839,46.545-46.545V116.364C512,90.657,491.161,69.818,465.455,69.818z M46.545,93.091h418.909    c2.659,0.017,5.296,0.489,7.796,1.396L271.825,295.913c-8.651,8.708-22.723,8.754-31.431,0.103    c-0.034-0.034-0.069-0.069-0.103-0.103L38.749,94.487C41.249,93.58,43.886,93.107,46.545,93.091z M23.273,395.636V116.364    c-0.119-1.355-0.119-2.718,0-4.073L167.331,256L23.273,399.709C23.154,398.354,23.154,396.991,23.273,395.636z M465.455,418.909    H46.545c-2.659-0.017-5.296-0.489-7.796-1.396l145.105-145.105l39.913,39.913c17.735,17.802,46.542,17.856,64.344,0.121    c0.041-0.04,0.081-0.081,0.121-0.121l39.913-39.913l145.105,145.105C470.751,418.42,468.114,418.893,465.455,418.909z     M488.727,399.709L344.669,256l144.058-143.709c0.119,1.355,0.119,2.718,0,4.073v279.273    C488.846,396.991,488.846,398.354,488.727,399.709z" fill="#000000" data-original="#000000"></path>--}}
{{--	</g>--}}
{{--															</span>--}}
{{--                <!--end::Svg Icon-->--}}
{{--                <a  href="{{route('countactUs')}}"  class="text-success fw-bolder fs-5">الرسائل المقروءه</a>--}}
{{--                <h3 class="text-success">{{$contacts_read}}</h3>--}}
{{--            </div>--}}
{{--            <!--end::Col-->--}}
{{--            <!--begin::Col-->--}}
{{--            <div class="col bg-light-danger px-6 py-8  me-7 mb-7">--}}
{{--                <!--begin::Svg Icon | path: icons/duotone/Media/Equalizer.svg-->--}}
{{--                <span class="svg-icon svg-icon-3x svg-icon-danger d-block my-2">--}}
{{--																											<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve"><g><link type="text/css" rel="stylesheet" id="dark-mode-custom-link"></link><link type="text/css" rel="stylesheet" id="dark-mode-general-link"></link><style lang="en" type="text/css" id="dark-mode-custom-style"></style><style lang="en" type="text/css" id="dark-mode-native-style"></style>--}}
{{--<g xmlns="http://www.w3.org/2000/svg">--}}
{{--	<g>--}}
{{--		<path d="M465.455,69.818H46.545C20.839,69.818,0,90.657,0,116.364v279.273c0,25.706,20.839,46.545,46.545,46.545h418.909    c25.706,0,46.545-20.839,46.545-46.545V116.364C512,90.657,491.161,69.818,465.455,69.818z M46.545,93.091h418.909    c2.659,0.017,5.296,0.489,7.796,1.396L271.825,295.913c-8.651,8.708-22.723,8.754-31.431,0.103    c-0.034-0.034-0.069-0.069-0.103-0.103L38.749,94.487C41.249,93.58,43.886,93.107,46.545,93.091z M23.273,395.636V116.364    c-0.119-1.355-0.119-2.718,0-4.073L167.331,256L23.273,399.709C23.154,398.354,23.154,396.991,23.273,395.636z M465.455,418.909    H46.545c-2.659-0.017-5.296-0.489-7.796-1.396l145.105-145.105l39.913,39.913c17.735,17.802,46.542,17.856,64.344,0.121    c0.041-0.04,0.081-0.081,0.121-0.121l39.913-39.913l145.105,145.105C470.751,418.42,468.114,418.893,465.455,418.909z     M488.727,399.709L344.669,256l144.058-143.709c0.119,1.355,0.119,2.718,0,4.073v279.273    C488.846,396.991,488.846,398.354,488.727,399.709z" fill="#000000" data-original="#000000"></path>--}}
{{--	</g>--}}
{{--															</span>--}}
{{--                <!--end::Svg Icon-->--}}
{{--                <a  href="{{route('countactUs')}}"  class="text-danger fw-bolder fs-5">الرسائل الغير المقروءه</a>--}}
{{--                <h3 class="text-danger">{{$contacts_unread}}</h3>--}}
{{--            </div>--}}
{{--            <!--end::Col-->--}}
{{--            <!--begin::Col-->--}}
{{--        </div>--}}
{{--        <!--end::Row-->--}}

{{--    </div>--}}


{{--    <div class="row gy-5 g-xl-8">--}}

{{--        <div class="col-xl-4">--}}
{{--                    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0-beta/dist/chart.min.js"></script>--}}
{{--                <ul class="graphs stats-container centered biggie" style="background-color: white;">--}}
{{--                    <li class="animated mt-10" data-provide="circular" data-fill-color="#F4516C" data-percent="false"--}}
{{--                        data-initial-value="{{$Reservations_confirmed_day}}"--}}
{{--                        data-max-value="{{$Reservations_confirmed}}" data-label="{{date('F j')}}" data-title="الحجوزات المؤكدة - خلال اليوم"--}}
{{--                        data-dates="{{$Reservations_confirmed_day}}" style="width: 272px; height: 272px;">--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--        </div>--}}

{{--        <div class="col-xl-4">--}}
{{--            <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0-beta/dist/chart.min.js"></script>--}}
{{--            <ul class="graphs stats-container centered biggie" style="background-color: white;">--}}
{{--                <li class="animated mt-10" data-provide="circular" data-fill-color="#F4516C" data-percent="false"--}}
{{--                    data-initial-value="{{$Reservations_confirmed_month}}"--}}
{{--                    data-max-value="{{$Reservations_confirmed}}" data-label="{{date('F Y')}}" data-title="الحجوزات المؤكدة - خلال الشهر"--}}
{{--                    data-dates="{{$Reservations_confirmed_month}}" style="width: 272px; height: 272px;">--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </div>--}}

{{--        <div class="col-xl-4">--}}
{{--            <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0-beta/dist/chart.min.js"></script>--}}
{{--            <ul class="graphs stats-container centered biggie" style="background-color: white;">--}}
{{--                <li class="animated mt-10" data-provide="circular" data-fill-color="#F4516C" data-percent="false"--}}
{{--                    data-initial-value="{{$Reservations_confirmed_year}}"--}}
{{--                    data-max-value="{{$Reservations_confirmed}}" data-label="{{date('Y')}}" data-title="الحجوزات المؤكدة - خلال السنة"--}}
{{--                    data-dates="{{$Reservations_confirmed_year}}" style="width: 272px; height: 272px;">--}}
{{--                </li>--}}

{{--            </ul>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="row mt-7" style="background-color: white;">--}}
{{--        <div class="col-xl-6">--}}
{{--            <div class="chart">--}}
{{--                <h3 class="card-title fw-bolder text-dark fs-3 mt-3">الحجوزات الشهورية</h3>--}}
{{--                <canvas id="chart"></canvas>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-xl-6">--}}
{{--            <div class="chart">--}}
{{--                <h3 class="card-title fw-bolder text-dark fs-3 mt-3">بيانات الحجوزات</h3>--}}
{{--                <canvas id="barChart"></canvas>--}}
{{--            </div>--}}
{{--        </div>--}}



@endsection
@push('admin_js')
    <script src="{{url('/')}}/admin/assets/js/jquery.js"></script>
@endpush
