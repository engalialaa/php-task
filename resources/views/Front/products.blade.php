@extends('Front.layout.app')
@section('title')
    products
@endsection
@section('content')
    <content>
        <!--Banner -->
        <div class="Banner">
            <ul>
                <li><a href="{{route('Front.Home')}}"> Home </a></li>
                <li> Products </li>
            </ul>
        </div>
        <!--books -->
        <div class="books">
            @if(session()->has('sucsses'))
                <script>
                    window.onload = function (){
                        notif({
                            msg:"تم إضافه الكتاب إلى المفضلة",
                            type:"success"
                        })
                    }
                </script>
            @endif
            @if(session()->has('danger'))
                <script>
                    window.onload = function (){
                        notif({
                            msg:"تم إزالة الكتاب من المفضلة",
                            type:"error"
                        })
                    }
                </script>
            @endif
            <div class="container">
                <div class="row">
                    @if($Products->count() > 0)
                    <div class="col-md-9 p-1 order-md-last">
                        <div class="row">
                            @foreach($Products as $Product)
                            <div class="col-lg-4 col-md-6 col-sm-4 col-6 p-1">
                                <div class="book">
                                    <div class="bookPic">
                                        <a href="{{route('products.details',$Product->id)}}" class="bookAnimate">
                                            <div class="bookImg">
                                                <div class="frontCover"><img src="{{url('')}}/{{$Product->photo??''}}"></div>
                                            </div>
                                        </a>
                                        <div class="action_links">
                                            <ul>
                                                <li class="add_to_cart"><a href="#!" class="a_T_C" data-Product_id="{{$Product->id}}" data-tippy="Add To Cart"> <span
                                                            class=" fa fa-shopping-basket"></span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="bookData">
                                        <a href="{{route('products.details',$Product->id)}}" class="bookName">{{$Product->name}}</a>


                                        @if(isset($Product->descount))
                                            <div class="bookPrice">
                                                <span class="me-2">EGP {{$Product->price - (($Product->price * $Product->descount) / 100)}}</span>
                                                <del>EGP {{$Product->price}}</del>
                                            </div>
                                        @else
                                            <div class="bookPrice">
                                                <span class="me-2"> EGP {{$Product->price}}</span>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <nav class="paginationNav">
                            <ul class="pagination">
                                <li class="page-item active"> {{$Products->appends(request()->query())->links()}}</li>
                            </ul>
                        </nav>
                    </div>
                    @else
                        <div class=" col-md-9 p-1">
                            <div class="row">
                                @include('Front.layout._NotFound');
                            </div>
                        </div>
                    @endif
                    <div class="col-md-3 p-1 order-md-first">
                        <aside class="booksAside">
                            <div class="widget categories_widget">
                                <h3>Choose Categories</h3>
                                <ul>
                                    <li class="widget_sub_categories">
                                        <a href="#!">Categories</a>
                                        <ul class="widget_dropdown_categories ">
                                                @foreach($Categories as $Category)
                                                    <li><a href="{{route('categories.products',$Category->id)}}">{{$Category->name}}</a></li>
                                                @endforeach
                                        </ul>
                                    </li>

                                </ul>
                            </div>
                            <div class="widget tags_widget">
                                <h3> Keywords </h3>
                                <div class="tag_cloud">
                                        @foreach($Categories as $Category)
                                            <a href={{route('categories.products',$Category->id)}}">{{$Category->name}} </a>
                                        @endforeach
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </content>
@endsection

