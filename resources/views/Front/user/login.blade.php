@extends('Front.layout.app')
@section('title')
    user/login
@endsection
@section('content')
    <!--Banner -->
        <div class="Banner">
            <ul>
                <li><a href="{{route('Front.Home')}}"> Home </a></li>
                <li>login</li>
            </ul>
        </div>
        <!-- login page -->
        <div class="loginPage ">
            <div class="container">
                <div class="row  justify-content-center">
                    <!--login-->
                    <div class="col-lg-6 col-md-6">
                        <div class="loginForm">
                            <h2> login </h2>
                            <form action="{{route('UserLogin')}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label>Email </label>
                                    <input type="email" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label> Password </label>
                                    <input type="password" required name="password">
                                </div>
                                <div class="login_submit mb-3">
                                    <label for="remember">
                                        <input id="remember" name="rememberme" type="checkbox"> remember</label>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="MainBtn">Enter</button>
                                </div>

                                <div class="socialLogin">
                                    <h6 class="line"><span> OR </span></h6>
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
                                <p class="my-3 text-center">Don't have an account? <a href="{{route('user.register')}}"> Create an account </a></p>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </content>
@endsection
