
@if($sale_details->count() > 0 )
        <h4>المنتجات المطلوبة</h4>
    <table class="table table-bordered">
        <thead>
        <tr class="fw-bolder text-muted bg-light">
            <th class="min-w-25px">#</th>
            <th class="min-w-125px">اسم المنتج</th>
            <th class="min-w-125px">الكمية المطلوبة </th>
        </tr>
        </thead>
        <tbody>
        @foreach($sale_details as $key => $item )
            <tr>
                <th class="min-w-25px">{{$key+1}}</th>
                <th class="min-w-125px">
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-50px me-5">
        <span class="symbol-label bg-light">
            <img class="h-100" onclick="window.open(this.src)" style="cursor: pointer"
                 src='{{url('')}}/{{$item->Product->photo ?? $item->product_photo}}' alt="">
        </span>
                        </div>
                        <div class="d-flex flex-column">
                            <a href="{{route('products.details', $item->Product->id ?? $item->product_id)}}" class="text-gray-800 text-hover-primary mb-1">{{$item->Product->name ?? $item->product_name}}</a>
                        </div>
                    </div>
                </th>
                <th class="min-w-125px">{{$item->qty}}</th>
            </tr>
        @endforeach
        </tbody>
    </table>

@else
    @include('Front.layout._NotFound')
@endif




