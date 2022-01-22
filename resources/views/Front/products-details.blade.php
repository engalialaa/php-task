@extends('Front.layout.app')
@section('title')
        {{$Product->name}}
@endsection
@section('content')
    <content>

        <!--Banner -->
        <div class="Banner">
            <ul>
                <li><a href="{{url('/')}}">Home</a></li>
                <li>Product Details</li>
            </ul>
        </div>
        <!--single Book-->
        <div class="singleBook ">
            <div class="container">
                <div class="bookDetails">
                    <div class="row">
                        <div class="col-sm-4 p-2">
                            <img src="{{url('')}}/{{$Product->photo??''}}">
                        </div>
                        <div class="col-sm-8 p-2">
                            <h4 class="bookName"> {{$Product->name ?? 'Product Name'}} </h4>

                            @if(isset($Product->descount))
                                <div class="bookPrice">
                                    <span class="me-2">EGP {{$Product->price - (($Product->price * $Product->descount) / 100)}}</span>
                                    <del>EGP {{$Product->price}}</del>
                                </div>
                            @else
                                <div class="bookPrice">
                                    <span class="me-2">EGP {{$Product->price}}</span>
                                </div>
                            @endif
                            <br>
                            <p>{{$Product->details??''}}</p>


                            <div>
                                    <a href="#!"  data-Product_id="{{$Product->id}}" class="addToCart a_T_C"> <span class="fa fa-shopping-basket me-2"></span>Add To Cart</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- mostRead -->
        <section class="mostRead">
            <div class="container">
                <div class="sectionTitle">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4>Others Products</h4>
                        <a href="{{route('categories.products',$Product->category_id)}}" class="addToCart">More</a>
                    </div>
                </div>
                <div class="swiper booksSlider">
                    <div class="swiper-wrapper">

                        @foreach($Products as $Product)
                        <div class="swiper-slide p-1">
                            <div class="book">
                                <div class="bookPic">
                                    <a href="{{route('products.details',$Product->id)}}" class="bookAnimate">
                                        <div class="bookImg">
                                            <div class="frontCover"><img src="{{url('')}}/{{$Product->photo}}"></div>
                                        </div>
                                    </a>
                                    <div class="action_links">
                                        <ul>
                                            <li class="add_to_cart"><a href="#!" class="a_T_C" data-Product_id="{{$Product->id}}" data-tippy="{{trans('front.add_to_cart')}}"> <span
                                                        class=" fa fa-shopping-basket"></span></a></li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="bookData">
                                    <a href="{{route('products.details',$Product->id)}}" class="bookName">{{$Product->name??''}}</a>


                                    @if(isset($Product->descount))
                                        <div class="bookPrice">
                                            <span class="me-2">EGP {{$Product->price - (($Product->price * $Product->descount) / 100)}}</span>
                                            <del>EGP {{$Product->price}}</del>
                                        </div>
                                    @else
                                        <div class="bookPrice">
                                            <span class="me-2">EGP {{$Product->price}}</span>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                    <!-- Add Arrows -->
{{--                    <div class="swiper-pagination"></div>--}}
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </section>
    </content>
@endsection

