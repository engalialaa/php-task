<?php
$Categories = App\Models\Category::where('is_shown','yes')->latest()->get();
?>

<?php
if (auth()->user()){
    $Carts = \App\Models\Cart::where('user_id', auth()->user()->id)->latest()->get();
}else{
    $Carts   = [];
}
?>
        <!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->

    <!-- CSS
    ========================= -->
    <!--bootstrap min css-->
        <link rel="stylesheet" href="{{url('')}}/front/css/bootstrap.min.css">
<!--font awesome css-->
    <link rel="stylesheet" href="{{url('')}}/front/css/font.awesome.css">
    <!--animate css-->
    <link rel="stylesheet" href="{{url('')}}/front/css/animate.css">
    <!--swiper css-->
    <link rel="stylesheet" href="{{url('')}}/front/css/swiper.css"/>
    <!--nice-select css-->
    <link rel="stylesheet" href="{{url('')}}/front/css/nice-select.css">
    <!--odometer css-->
    <link rel="stylesheet" href="{{url('')}}/front/css/odometer.css">
    <!--dropify css-->
    <link rel="stylesheet" href="{{url('')}}/front/css/dropify.min.css">

    <link rel="shortcut icon" type="image/x-icon" href="{{url('')}}/front/img/favicon.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css"
          id="theme-styles">
    @toastr_css
    <!-- Main Style CSS -->
        <link rel="stylesheet" href="{{url('')}}/front/css/styleEN.css?{{time()}}">


    <link href="{{url('/')}}/admin/assets/plugins/notify/css/notifIt.css" rel="stylesheet"/>
    @include('Front.load.loaderCss')
</head>

<body>

<!--mobile menu -->
<div class="off_canvars_overlay"></div>
<div class="offcanvas_menu">
    <div class="container">
        <input name="user_id" hidden id="user_id" value="1">
        <div class="row">
            <div class="col-12">
                <div class="canvas_open">
                    <a href="#!"><i class="fal fa-bars"></i></a>
                </div>
                <div class="offcanvas_menu_wrapper">
                    <div class="canvas_close">
                        <a href="#!"><i class="fal fa-times"></i></a>
                    </div>
                    <div class="language_currency">
                        <ul>
                            <li>
                                @if(auth()->user())
                                <a href="{{route('user.logout')}}">{{trans('front.logout')}}</a>
                                @else
                                <a href="{{route('user.login')}}">{{trans('front.login')}}</a>
                                @endif
                            </li>
                        </ul>
                    </div>

                    <div id="menu" class="text-left">
                        <ul class="offcanvas_main_menu">

                            @if(auth()->user())
                                <li>
                                    <a href="{{route('user.logout')}}">logout</a>
                                </li>
                            @else
                                <li>
                                    <a href="{{route('user.login')}}">login</a>
                                </li>
                            @endif
                            <li><a href="{{route('Front.Home')}}">Home</a></li>
                                <li><a href="{{route('Front.products')}}">Products</a></li>
                                <li><a href="{{route('Front.categories')}}">Categories</a></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--<!-- / mobile menu -->--}}
<header>
    <div class="main_header">
        <div class="header_top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6">
                    </div>
                    <div class="col-lg-6">
                        <div class="header_social text-right">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header_middle">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-md-3 col-sm-3 col-3">
                        <div class="logo">
                            <a href="{{route('Front.Home')}}">PHP TASK</a>
                        </div>
                    </div>
                    <div class="col-lg-10 col-md-6 col-sm-7 col-8">
                        <div class="header_right_info">
                            <div class="search_container mobail_s_none">
                                <form action="{{route('Front.search')}}" method="GET">
                                    <div class="hover_category">
                                        <select class="select_option" name="Category_id" id="categori2">
                                            <option selected value="0">categories</option>
                                            @foreach($Categories as $Category)
                                                <option value="{{ $Category->id }}" {{ $Category->id == request()->Category_id ? 'selected' : '' }}>{{ $Category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="search_box">
                                        <input placeholder="search" value="{{request()->search}}"
                                               name="search" type="text">
                                        <button type="submit"><span class="fal fa-search"></span></button>
                                    </div>
                                </form>
                            </div>

                            <div class="header_account_area">
                                <div class="header_account_list register">
                                    <ul>
                                        @if(auth()->user())
                                            <li>
                                                <a href="{{route('user.logout')}}">logout</a>
                                            </li>
                                        @else
                                            <li><a href="{{route('user.login')}}">Login</a></li>
                                        @endif
                                    </ul>
                                </div>

                                <div class="header_account_list  mini_cart_wrapper">
                                    <a href="#!">
                                        <span class="fal fa-shopping-cart"></span>

                                        <span class="item_count" id="countItems">
                                            @if(auth()->user())
                                            {{$Carts->count()}}
                                            @else
                                                0
                                            @endif
                                        </span>
                                    </a>
                                    <!--mini cart-->
                                    <div class="mini_cart" id="loadNewCart">
                                        @include('Front.load.cart')
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--mini cart end-->

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header_bottom sticky-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md-6 mobail_s_block">
                    <div class="search_container">
                        <form action="{{route('Front.search')}}" method="GET">
                            <div class="hover_category">
                                <select class="select_option" name="Category_id" id="categori3">
                                    <option selected value="0">categories</option>
                                    @foreach($Categories as $Category)
                                            <option value="{{ $Category->id }}" {{ $Category->id == request()->Category_id ? 'selected' : '' }}>{{ $Category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="search_box">
                                <input placeholder="Search" value="{{request()->search}}"
                                       name="search" type="text">
                                <button type="submit"><span class="fal fa-search"></span></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="categories_menu">
                        <div class="categories_title">
                            <h2 class="categori_toggle">Categories</h2>
                        </div>
                        <div class="categories_menu_toggle">
                            <ul>
                                @foreach($Categories as $Category)
                                    <li class="menu_item_children">
                                        <a href="{{route('categories.products',$Category->id)}}">{{$Category->name}}</a>
                                    </li>
                                @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <!--main menu start-->
                    <div class="main_menu menu_position ">
                        <nav>
                            <ul>
                                <li><a href="{{route('Front.Home')}}">Home</a></li>
                                <li><a href="{{route('Front.products')}}">Products</a></li>
                                <li><a href="{{route('Front.categories')}}">Categories</a></li>
                            </ul>
                        </nav>
                    </div>
                    <!--main menu end-->
                </div>
            </div>
        </div>
    </div>
    </div>
</header>
<!-- / header -->
