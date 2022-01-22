@extends('layouts.admin.app')
@section('page_name')الأقسام@endsection
<style src="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css"></style>
<link src="//code.jquery.com/jquery-1.10.2.min.js">
<link src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js">
<link href="{{url('/')}}/admin/assets/plugins/notify/css/notifIt.css" rel="stylesheet"/>
@section('content')
    <div class="card mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1"> الأقسام</span>
            </h3>
            <div class="card-toolbar">
                <a href="" class="btn btn-light-primary er fs-6 px-7 py-3 ml-2" data-bs-toggle="modal"
                   data-bs-target="#add_modal">
                    <span><i class="bi bi-plus-circle"></i></span>
                    اضافة جديد</a>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body py-3">
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table table-bordered" id="users-table">
                    <thead>
                    <tr class="fw-bolder text-muted bg-light">
                        <th class="min-w-25px">#</th>
                        <th class="min-w-125px">الصورة</th>
                        <th class="min-w-125px">اسم القسم</th>
                        <th class="min-w-125px">منتجات القسم</th>
                        <th class="min-w-125px">الحالة</th>
                        <th class="min-w-150px rounded-end">العمليات</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <!--end::Table container-->
        </div>
    </div>
    <!-------------------------Start DELETE modal ------------------------------------------------------------>
    <div class="modal fade" id="delete_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>حذف قسم</h2>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x fs-2"></i>
					</span>
                    </div>
                </div>
                <div class="modal-body scroll-y mx-3 mx-xl-15 my-3">
                    <form class="form" method="post">
                        {{csrf_field()}}
                        <div class="d-flex flex-column mb-7 fv-row fv-plugins-icon-container">
                            <h4 class="pb-3">هل انت متاكد من حذف القسم ؟</h4>
                            <input type="hidden" class="form-control form-control-solid pt" name="id" id="delete_id">
                            <input type="text" disabled class="form-control form-control-solid fs-2" placeholder=""
                                   name="title" id="title" value="">
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>

                        <div class="text-center">
                            <button type="reset" id="dismiss_delete_modal" class="btn btn-white me-3"
                                    data-bs-dismiss="modal">الغاء
                            </button>
                            <button type="button" id="delete_btn" class="btn btn-danger">
                                <span class="indicator-label">تأكيد</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-------------------------End DELETE modal -------------------------------------------------------------->


    <!-------------------------Start ADD Form --------------------------------------------------------------->
    <div class="modal fade" id="add_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>اضافة قسم جديد</h3>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x fs-2"></i>
					</span>
                    </div>
                </div>
                <div class="modal-body">
                    <form id="add_form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">

                            <div class="col-lg-12 form-group">
                                <label> صورةالقسم </label>
                                <input  type="file" name="photo"  id="photo"  data-allowed-file-extensions="png jpg jpeg"  required class="dropify" />
                            </div>

                            <div class="col-12">
                                <label for="name" class="col-form-label required">اسم القسم</label>
                                <input class="form-control fs-3" name="name" id="name" type="text"
                                       autocomplete="off" placeholder="اسم القسم">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" id="add_btn" class="btn btn-success">تاكيد</button>
                            <button type="reset" id="dismiss_add_modal" class="btn btn-white me-3"
                                    data-bs-dismiss="modal">الغاء
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-------------------------End ADD Form ----------------------------------------------------------------->

    <!-------------------------Start EDIT Form --------------------------------------------------------------->
    <div class="modal fade" id="edit_modal_model" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>تعديل القسم</h3>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x fs-2"></i>
					</span>
                    </div>
                </div>
                <div class="modal-body">
                    <form id="update_form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row" id="item">

                        </div>
                        <div class="modal-footer">
                            <button type="button" id="update_btn" class="btn btn-primary">حفظ البيانات</button>
                            <button type="reset" id="dismiss_edit_modal" class="btn btn-white me-3"
                                    data-bs-dismiss="modal">الغاء
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-------------------------End EDIT Form ----------------------------------------------------------------->

@endsection
<script src="{{url('/')}}/admin/assets/js/jquery.js"></script>
<script src="{{url('/')}}/admin/assets/plugins/notify/js/notifIt.js"></script>
<script src="{{url('/')}}/admin/assets/plugins/notify/js/notifit-custom.js"></script>
@section('js')
<script>
    $(function () {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('categoryData') !!}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'photo', name: 'photo'},
                {data: 'name', name: 'name'},
                {data: 'products', name: 'products'},
                {data: 'is_shown', name: 'is_shown'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            order: [
                [0, "desc"]
            ],
            "language": {
                "sProcessing": "جاري التحميل ..",
                "sLengthMenu": "اظهار _MENU_ سجل",
                "sZeroRecords": "لا يوجد نتائج",
                "sInfo": "اظهار _START_ الى  _END_ من _TOTAL_ سجل",
                "sInfoEmpty": "لا نتائج",
                "sInfoFiltered": "للبحث",
                "sSearch": "بحث :    ",
                "oPaginate": {
                    "sPrevious": "السابق",
                    "sNext": "التالي",
                }
            },

            dom: 'frtip',
            buttons: [
                'copy', 'excel', 'pdf'
            ]
        });
    });
</script>
<script>
    $(document).ready(function () {
        //Show data in the delete form
        $('#delete_modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var title = button.data('title')
            var modal = $(this)
            modal.find('.modal-body #delete_id').val(id);
            modal.find('.modal-body #title').val(title);
        });
    });
</script>
<script>
    // Delete Using Ajax
    $(document).on('click', '#delete_btn', function (event) {
        var id = $("#delete_id").val();
        $.ajax({
            type: 'POST',
            url: "{{route('deleteCategory')}}",
            data: {
                '_token': "{{csrf_token()}}",
                'id': id,
            },
            success: function (data) {
                if (data.success === true) {
                    $("#dismiss_delete_modal")[0].click();
                    $('#users-table').DataTable().ajax.reload();
                    $('<script> toastr.error("تم حذف قسم ")</' + 'script>').appendTo(document.body);

                }
            }
        });
    });
</script>
<script>
    // Add Using Ajax
    $(document).on('click', '#add_btn', function (event) {
        var form_data = new FormData(document.getElementById("add_form"));
        $.ajax({
            type: 'POST',
            url: "{{route('addCategory')}}",
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.success === true) {
                    $("#dismiss_add_modal")[0].click();
                    $('#users-table').DataTable().ajax.reload();
                    $('<script> toastr.success("تم اضافة قسم جديد")</' + 'script>').appendTo(document.body);
                }
            }, error: function (data) {
                $("#dismiss_add_modal")[0].click();
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
<script>
    $(document).on('click', '#edit_modal', function (event) {
        var id = $(this).attr("data-id")
        var url = "/"
        url = url.concat("php-task/public/admin/editCategory/").concat(id);
        $.get(url, function(data) {
            $('#item').html(data.html);
        });

        setTimeout(function() {
            $('#edit_modal_model').modal('show');
        }, 500);
    });
</script>
<script>
    // EDit Using Ajax
    $(document).on('click', '#update_btn', function (event) {
        var form_data = new FormData(document.getElementById("update_form"));
        $.ajax({
            type: 'POST',
            url: "{{route('updateCategory')}}",
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.success === true) {
                    $("#dismiss_edit_modal")[0].click();
                    $('#users-table').DataTable().ajax.reload();
                    $('<script> toastr.info("تم تعديل بيانات القسم بنجاح")</' + 'script>').appendTo(document.body);

                }
            }, error: function (data) {
                $("#dismiss_edit_modal")[0].click();
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
<script>
    // Make Better Using Ajax
    $(document).on('click', '#category_status', function (event) {
        var id = $(this).data("id")
        $.ajax({
            type: 'POST',
            url: "{{route('category_status')}}",
            data: {
                '_token': "{{csrf_token()}}",
                'id': id,
            },
            success: function (data) {
                if (data.success === true) {
                    $('#users-table').DataTable().ajax.reload();
                    $('<script> toastr.warning("تم تعديل  حالة القسم ")</' + 'script>').appendTo(document.body);

                }
            }
        });
    });
</script>
@endsection





