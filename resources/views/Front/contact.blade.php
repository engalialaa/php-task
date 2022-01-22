@extends('Front.layout.app')
@section('title')
    {{trans('front.contact')}}
@endsection
@section('image')
    {{url('')}}/public/front/img/logo.png
@endsection
<link href="{{url('')}}/public/front/notify/css/notifIt.css" rel="stylesheet"/>
@section('content')
    <content>
        <!--Banner -->
        <div class="Banner">
            <ul>
                <li><a href="{{url('/')}}"> {{trans('front.home')}} </a></li>
                <li> {{trans('front.contact')}} </li>
            </ul>
        </div>
        <!-- map -->
        <div class="map-area ">
            <div class="container">
                <div id="googleMap">
                <iframe width="100%" height="400px" src="https://maps.google.com/maps?q=30.512110,31.044568&hl=es;z=14&amp;output=embed"></iframe>
                </div>
            </div>
        </div>
        <!--contact -->
        <div class="contact_area">
            <div class="container">
                <div class="row">
                    <div class=" col-md-6">
                        <div class="contact_message content">
                            <h3> {{trans('front.contact')}} </h3>
                            <p>{{trans('front.contact_text')}}</p>
                            <ul>
                                @if (app() -> getlocale() == 'ar')
                                <li><i class="fa fa-fax"></i>{{$setting->address_ar}}</li>
                                @else
                                <li><i class="fa fa-fax"></i>{{$setting->address_en}}</li>
                                @endif
                                <li><i class="fa fa-envelope"></i> <a href="mailto:{{$setting->gmail}}">{{$setting->gmail}}</a></li>
                                <li><i class="fa fa-phone"></i><a href="tel:">{{$setting->phone}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class=" col-md-6">
                        <div class="contact_message form">
                            <h3> {{trans('front.send_a_message')}} </h3>
                            <form id="contact_form">
                                {{ csrf_field() }}
                                <div class="mb-3">
                                    <label> {{trans('front.name')}} * </label>
                                    <input name="name" placeholder="{{trans('front.name')}} *" type="text">
                                </div>
                                <div class="mb-3">
                                    <label> {{trans('front.email_address')}} * </label>
                                    <input name="email" placeholder=" {{trans('front.email')}} *" type="email">
                                </div>
                                <div class="mb-3">
                                    <label> {{trans('front.title')}} </label>
                                    <input name="title" placeholder="{{trans('front.title')}}  " type="text">
                                </div>
                                <div class="contact_textarea">
                                    <label> {{trans('front.message')}}  </label>
                                    <textarea placeholder=" {{trans('front.write_your_message')}}  " name="message"
                                        class="form-control2"></textarea>
                                </div>
                                <button type="button" id="send_btn"> {{trans('front.send')}}  </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </content>
    <script src="{{url('/')}}/public/front/notify/js/notifIt.js"></script>
    <script src="{{url('/')}}/public/front/notify/js/notifit-custom.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{url('/')}}/public/admin/assets/js/sweet.js"></script>
    <script>
        // Store Using Ajax
        $(document).on('click', '#send_btn', function (event) {
            var form_data = new FormData(document.getElementById("contact_form"));
            $.ajax({
                type: 'POST',
                url: "{{route('store_contact')}}",
                data: form_data,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data.success === true) {
                        $('#contact_form')[0].reset();
                        $('<script> notif({msg: "{{trans('front.send_message_successfully')}}",type: "success"})</' + 'script>').appendTo(document.body);
                    }
                }, error: function (data) {
                    var error = Object.values(data.responseJSON.errors);
                    Swal.fire({
                        icon: 'error',
                        title: error,
                        confirmButtonText: 'حسنا',
                    })
                }
            });
        });
    </script>
@endsection
