
@extends('Front.layout.app')
@section('title')
    Cart
@endsection
@section('content')
  <content>
    <!--Banner -->
    <div class="Banner">
      <ul>
        <li><a href="{{route('Front.Home')}}"> Home </a></li>
        <li> Cart </li>
      </ul>
    </div>
    <!--shopping cart  -->
    <div class="shoppingCart">
      <div class="container">
          @if($Carts->count() > 0 )
              <form id="myform">
        <div class="cartTable">
          <table>
            <thead>
              <tr>
                <th class="product_remove">Delete</th>
                <th class="product_thumb">Photo</th>
                <th class="product_name">Product</th>
                <th class="product-price">Price</th>
                <th class="product_quantity">Qty</th>
                <th class="product_total">Total</th>
              </tr>
            </thead>
            <tbody>
            <?php
            $end_tot = 0;
            ?>
            @foreach($Carts as $Cart)

                <?php
                    $productTot = 0;
                $Product = App\Models\Product::find($Cart->product_id);
                if (isset($Product->descount)){
                    $end_tot += (($Product->price * $Cart->qty) - ((($Product->price * $Product->descount) / 100))* $Cart->qty);
                }
                else{
                    $end_tot += ($Product->price * $Cart->qty);
                }

                ?>
              <tr class="arrayDetails" id="ProductCart{{$Cart->id}}">
                <td class="product_remove">

                    <input hidden value="{{$Product->id}}" class="book_id" name="book_id">
                    <input hidden value="{{$Cart->qty}}" id="qty-form{{$Cart->id}}" class="qty-form"  name="quantity">

                    <button type="button" onclick="deleteItem({{$Cart->id}})" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                </td>
                <td class="product_thumb">
                    <a href="{{route('products.details',$Product->id)}}"><img src="{{url('')}}/{{$Product->photo??''}}"></a></td>
                <td class="product_name"><a href="{{route('products.details',$Product->id)}}">{{$Product->name}}</a></td>
                <td class="product-price price"> {{isset($Product->descount)?$Product->price-(($Product->price * $Product->descount) / 100):$Product->price}} EGP</td>
                  <td class="product_quantity">
                      <div class="countInput">
                          <button type="button"  onclick=""  class="sub">-</button>
                                <input class="qty"  onKeyDown="return false" data-cart_id="{{$Cart->id}}" data-amount="{{isset($Product->descount)?$Product->price-(($Product->price * $Product->descount) / 100):$Product->price}}" min="1" max="100" value="{{$Cart->qty}}" type="number">
                          <button type="button" onclick="" class="add">+</button>
                      </div>
{{--                      <input class="qty"  onKeyDown="return false" data-cart_id="{{$Cart->id}}" data-amount="{{isset($Book->offer->rate)?$Book->amount-(($Book->amount * $Book->offer->rate) / 100):$Book->amount}}" min="1" max="100" value="{{$Cart->qty}}" type="number">--}}
                  </td>
                <td class="product_total tot" data-value="{{$end_tot}}" id="endTotals_{{$Cart->id}}">{{$end_tot}} EGP</td>
              </tr>
            @endforeach
            </tbody>
          </table>
          <div class="cartCheckout">
            <h5> total : <span id="end_tot"> {{$end_tot}} EGP</span> </h5>
            <a href="#!" id="addSaleFromCart" class="btn"> payment</a>
          </div>
        </div>
              </form>
          @else
              @include('Front.layout._NotFound')
          @endif
      </div>
    </div>
  </content>
@endsection
