<?php
if (auth()->user()){
    $Carts = \App\Models\Cart::where('user_id', auth()->user()->id)->latest()->get();
}else{
    $Carts   = [];
}
?>

<div class="cart_close">
    <div class="cart_text">
        <h3>Cart</h3>
    </div>
    <div class="mini_cart_close">
        <a href="#!"><i class="fal fa-times"></i></a>
    </div>
</div>

<div class="cart_gallery">

    @if(count($Carts) > 0 )
        <?php
        $end_total = 0;
        ?>
        @foreach($Carts as $Cart)
            <?php
            $Product = App\Models\Product::find($Cart->product_id);
            if (isset($Product->descount)){
                $end_total += (($Product->price * $Cart->qty) - ((($Product->price * $Product->descount) / 100))* $Cart->qty);
            }
            else{
                $end_total += ($Product->price * $Cart->qty);
            }

            ?>
            <div class="cart_item">
                <div class="cart_img">
                    <a href="{{route('products.details',$Product->id)}}">
                        <img style="max-width: 100%;"
                             src="{{url('')}}/{{$Product->photo??''}}"
                             alt="">
                    </a>
                </div>
                <input hidden value="{{$Product->id}}" class="book_id-form"
                       name="book_id">
                <input hidden value="{{$Product->qty}}" class="qty-form"
                       name="quantity">
                <div class="cart_info">
                    <a href="{{route('products.details',$Product->id)}}"> {{$Product->name}} </a>

                    @if(isset($Product->descount))
                        <p><span> EGP {{$Product->price - (($Product->price * $Product->descount) / 100)}} * {{$Cart->qty}}</span>
                        </p>
                    @else
                        <p><span> EGP {{$Product->price}} * {{$Cart->qty}}</span>
                        </p>
                    @endif
                </div>
                <div class="cart_remove">
                    <button type="button" onclick="deleteItem({{$Cart->id}})"
                            class="btn btn-danger"><i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>
        @endforeach

</div>
<div class="mini_cart_table">
    <div class="cart_table_border">
        <div class="cart_total">
            <span>Total:</span>
            <span class="price"
                  id="end_tot">{{$end_total}} EGP</span>
        </div>
    </div>
</div>
<div class="mini_cart_footer">
    <div class="cart_button">
        <a href="{{route('Carts')}}"><i
                    class="fa fa-shopping-cart"></i>Cart</a>
    </div>
            <div class="cart_button">
                <a href="#!" id="addSale"><i
                            class="fa fa-sign-in"></i> payment </a>
            </div>
    </div>
@else
    @include('Front.layout._NotFound')
@endif
