@extends('Front.layout.app')
@section('title')
    PHP Task
@endsection
@section('content')
    <content>
    <!-- Top Slider -->

        <!-- parallax -->

        <!-- mostRead -->
        <section class="mostRead">
            <div class="container">
                <div class="sectionTitle">
                    <p>Buy now</p>
                    <div class="d-flex align-items-center justify-content-between">
                        <h4>Most Ordered</h4>
                        <a href="{{route('Front.products')}}" class="addToCart">view all</a>
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
                                                <div class="frontCover"><img src="{{url('')}}/{{$Product->photo}}">
                                                </div>
                                            </div>
                                        </a>
                                        <div class="action_links">
                                            <ul>
                                                <li class="add_to_cart">
                                                    <a href="#!" class="a_T_C" data-Product_id="{{$Product->id}}"
                                                       data-bs-toggle="modal" data-bs-target="#chooseModal"
                                                       data-tippy="add to cart">
                                                        <span class=" fa fa-shopping-basket"></span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="bookData">
                                            <a href="{{route('products.details',$Product->id)}}"
                                               class="bookName">{{$Product->name ?? ''}} </a>

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
        <!-- testimonials -->


            <!-- Modal -->
            <div class="modal fade" id="chooseModal" tabindex="-1" aria-labelledby="chooseModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body bookModal">
                            <img style="height: 150px" class="logo" src="{{url('')}}/front/img/cart.jpg"></a>
                            <h5> The product has been added to the cart  </h5>
                            <div class="">
                                <a href="{{route('Carts')}}" class="addToCart m-2"> <i class="fa fa-shopping-basket me-2"></i> Go To Cart  </a>
                                <button class="addToCart m-2" id="addSale"> <i class="fa fa-sign-in me-2"></i> Buy Product</button>
                                <button class="addToCart m-2" id="dismiss_add_modal"  data-bs-dismiss="modal"><i class="fas fa-books-medical me-2"></i> Complete Shopping</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

    </content>
@endsection

