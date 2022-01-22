@extends('Front.layout.app')
@section('title')
    Categories
@endsection
@section('content')
<content>
    <!--Banner -->
    <div class="Banner">
        <ul>
            <li><a href="{{url('/')}}"> Home </a></li>
            <li>Categories </li>
        </ul>
    </div>
    <!-- publishing houses -->
    <section class="publishingHouses">
        <div class="container">
            <div class="row align-items-center justify-content-center">

                @foreach($Categories as $Category)
                <div class=" col-6 col-md-4 col-lg-3 p-2">
                    <a href="{{route('categories.products',$Category->id)}}" class="house">
                        <img src="{{url('')}}/{{$Category->photo??''}}" alt="">
                        <h5 class="houseName">{{$Category->name ?? 'اسم القسم'}} </h5>
                        <p>  ( <span> {{$Category->Products->count('id') ?? '0'}} </span> ) Products </p>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>


</content>

@endsection
</html>
