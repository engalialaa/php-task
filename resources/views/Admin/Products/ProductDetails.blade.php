
@if($Product_Photo->count() > 0 )
    <div class="row">
    <h5>صور المنتج</h5>
@foreach($Product_Photo as $Product)
    <div class="col-lg-4 form-group">
        <input  type="file" name="photo" disabled  id="photo" data-default-file="{{url('')}}/{{$Product->photo}}"   data-allowed-file-extensions="png jpg jpeg"  required class="dropify" />
    </div>
@endforeach
    </div>
    <div class="row">
        <h5>تفاصيل اخرى</h5>
    <div class="col-lg-12 form-group">
        <table  class="table table-bordered">
            <tr>
                <td>سعر المنتج</td>
                <td>{{$other_details->price?? '0'}} ج.م </td>
            </tr>
            @if(isset($other_details->descount))
            <tr>
                <td>الخصم</td>
                <td>{{$other_details->descount?? '0'}} % </td>
            </tr>

            <tr>
                <td>سعر المنتج بعد الخصم</td>
                <td> {{$other_details->price - (($other_details->price * $other_details->descount) / 100)}} ج.م </td>
            </tr>
                @endif
        </table>
        <p>{{$other_details->details?? 'لايوجد'}}</p>
    </div>
        </div>

    <script>
        // $(document).ready(function () {
        $('.dropify').dropify();
        // });//end jquery
    </script>
@else
    @include('Front.layout._NotFound')
@endif
