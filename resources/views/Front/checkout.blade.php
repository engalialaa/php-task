
@extends('Front.layout.app')
@section('title')
  chechout
@endsection
@section('content')
  <content>
    <!--Banner -->
    <div class="Banner">
      <ul>
        <li><a href="{{route('Front.Home')}}">Home</a></li>
        <li><a href="{{route('Carts')}}">Cart</a></li>
        <li>payment</li>
      </ul>
    </div>
    <!-- checkout -->
    <section class="checkout">
      <div class="container">
        <form action="{{route('confirmSale',$Sale->user_id)}}" method="POST">
            @csrf
          <div class="row">
            <div class="col-lg-8 col-md-12">
              <div class="billing-details">
                <h3 class="title"> Payment and Shipping</h3>
                <div class="row">
                  <div class="col-md-6 p-1">
                    <label class="form-label">First Name</label>
                    <input type="text" placeholder="First Name" value="{{$User->first_name}}" name="first_name"  required>
                  </div>
                  <div class="col-md-6 p-1">
                    <label class="form-label">Last Name</label>
                    <input type="text" placeholder="Last Name" value="{{$User->last_name}}" name="last_name"  required>
                  </div>
                    <div class="col-md-6 p-1">
                        <label class="form-label">Email</label>
                        <input type="email" placeholder="Email" value="{{$User->email}}" name="email"  required>
                    </div>
                    <div class="col-md-6 p-1">
                        <label class="form-label"> Phone</label>
                        <input type="number" placeholder="Phone" value="{{$User->phone}}" name="phone"  required>
                    </div>

                    <div class="col-md-6 p-1">
                        <label class="form-label">Detailed address</label>
                        <textarea placeholder="Detailed address" name="street" rows="5"></textarea>
                    </div>
                  <div class="col-md-6 p-1">
                    <label class="form-label">OtherDetail</label>
                    <textarea placeholder="OtherDetail" name="other_details" rows="5"></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-12">
              <div class="order-details">
                <div class="cart-totals">
                  <h3>Order</h3>
                  <ul>
                    <li> sub total<span id="sub_tot">{{$Sale->total}} EGP</span></li>

                    <li> Shipping <span id="Shipping">مجانا</span></li>
                      <li> total  <span id="end_tot">{{$Sale->total}}  EGP </span></li>
                  </ul>
                    <input type="hidden" name="total" id="end_total" value="{{$Sale->total}}">
                    <input type="hidden" name="is_end" value="1">
                  <div class="text-center">
                    <div class="row">
                      <div class="col-sm-6">
                        <button type="submit" style="width: 130px" value="online" name="pay_type" class="MainBtn">Online</button>

                      </div>
                      <div class="col-sm-6">
                        <button type="submit" style="width: 130px" value="cash" name="pay_type" class="MainBtn">Cash</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </section>
  </content>
@endsection

