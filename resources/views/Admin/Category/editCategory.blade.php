
@if($Category->count() > 0 )

    <div class="col-lg-12 form-group">
        <label> صورة القسم </label>
        <input  type="file" name="photo"  id="photo" data-default-file="{{url('')}}/{{$Category->photo}}"   data-allowed-file-extensions="png jpg jpeg"  required class="dropify" />
    </div>

    <div class="col-12">
        <input type="hidden" class="id" value="{{$Category->id}}" name="id">
        <label for="name" class="col-form-label required">اسم القسم</label>
        <input class="form-control name fs-3" name="name" value="{{$Category->name ?? 'اسم القسم'}}" id="name" type="text"
               autocomplete="off">
    </div>
    <script>
        // $(document).ready(function () {
        $('.dropify').dropify();
        // });//end jquery
    </script>
@else
    @include('Front.layout._NotFound')
@endif




