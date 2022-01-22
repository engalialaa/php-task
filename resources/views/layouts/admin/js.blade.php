<script src="{{url('/')}}/admin/assets/plugins/global/plugins.bundle.js"></script>
<script src="{{url('/')}}/admin/assets/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{url('/')}}/admin/assets/js/custom/widgets.js"></script>
<script src="{{url('/')}}/admin/assets/js/custom/apps/chat/chat.js"></script>
<script src="{{url('/')}}/admin/assets/js/custom/modals/create-app.js"></script>
<script src="{{url('/')}}/admin/assets/js/custom/modals/upgrade-plan.js"></script>
<script src="{{url('/')}}/admin/assets/js/custom/modals/new-target.js"></script>



{{--=================  dropfy  ================--}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    // $(document).ready(function () {
    $('.dropify').dropify();
    // });//end jquery
</script>


{{--===================  toster ==============================--}}
<script src="{{url('admin/js')}}/tostar.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.js"></script>


<script src="{{url('/')}}/public/admin/assets/plugins/notify/js/notifIt.js"></script>
<script src="{{url('/')}}/public/admin/assets/plugins/notify/js/notifit-custom.js"></script>



@if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: '@foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach',
            text: 'حاول مرة اخري!',
            confirmButtonText: 'حسنا',
        })
    </script>
@endif
@toastr_js
@toastr_render

<script>

    @if (Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}"
    switch(type){
        case 'info':

            toastr.options.timeOut = 10000;
            toastr.info("{{Session::get('message')}}");
            break;
        case 'success':

            toastr.options.timeOut = 10000;
            toastr.success("{{Session::get('message')}}");
            break;
        case 'warning':

            toastr.options.timeOut = 10000;
            toastr.warning("{{Session::get('message')}}");
            break;
        case 'error':

            toastr.options.timeOut = 10000;
            toastr.error("{{Session::get('message')}}");
            break;
    }
    @endif
</script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.js"></script>
@stack('admin_js')

{{--//===========================    data table  =========================--}}

<script src="{{url('admin')}}/assets/plugins/custom/datatables/datatables.bundle.js"></script>
<script src="{{url('admin')}}/assets/plugins/custom/prismjs/prismjs.bundle.js"></script>

<script>
    $("#kt_datatable_example_5").DataTable({
        "language": {
            "lengthMenu": "اظهار _MENU_",
        },
        "dom":
            "<'row'" +
            "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
            "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
            ">" +

            "<'table-responsive'tr>" +

            "<'row'" +
            "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
            "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
            ">"
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

@if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: '@foreach ($errors->all() as $error){{ $error }}<br>@endforeach',
            text: 'حاول مرة اخري!',
            confirmButtonText: 'حسنا',
        })
    </script>
@endif

