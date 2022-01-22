@extends('Front.layout.app')
@section('title')
    إنشاء حساب
@endsection
@section('content')
    <content>
        <!--Banner -->
        <div class="Banner">
            <ul>
                <li><a href="{{route('Front.Home')}}"> Home </a></li>
                <li> Create account</li>
            </ul>
        </div>
        <!-- checkout -->
        <div class="loginPage ">
            <div class="container">
                <div class="row  justify-content-center">
                    <div class="col-lg-9 col-md-12">
                        <div class="loginForm">
                            <div class="billing-details">
                                <h2> Create account </h2>
                                <form action="{{route('addUser')}}" method="POST">
                                    @csrf
                                    <div class="row">

                                        <div class="col-md-6 p-2">
                                            <label class="form-label">First Name </label>
                                            <input type="text" required name="first_name" id="first_name">
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <label class="form-label"> Last Name </label>
                                            <input type="text" required name="last_name" id="last_name">
                                        </div>

                                        <div class="col-md-6 p-2">
                                            <label class="form-label"> Email </label>
                                            <input type="email" required name="email" id="email">
                                        </div>

                                        <div class="col-md-6 p-2">
                                            <label class="form-label">Phone </label>
                                            <input type="number" required name="phone" id="phone">
                                        </div>

                                        <div class="col-md-6 p-2">
                                            <label> Password </label>
                                            <input type="password" required name="password" id="password">
                                        </div>

                                        <div class="col-md-6 p-2">
                                            <label> Password Confirmation </label>
                                            <input type="password" required name="password_confirmation" id="password">
                                        </div>


                                    </div>


                                    <div class=" text-center">
                                        <button type="submit" class="MainBtn">Create</button>
                                    </div>

                                    <div class="socialLogin">
                                        <h6 class="line"><span> او </span></h6>
                                        <div class="social">
                                            <a class="loginIcon facebook" href="#!">
                                                <i class="me-2 fab fa-facebook-f"></i>
                                                facebook
                                            </a>
                                            <a class="loginIcon gmail" href="#!">
                                                <i class="me-2 fab fa-google"></i>
                                                gmail
                                            </a>
                                        </div>
                                    </div>
                                    <p class="my-3 text-center">  لديك حساب بالفعل ؟  <a href="{{route('user.login')}}"> تسجيل الدخول </a></p>

                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </content>
@endsection

