@extends('layouts.admin.app')
@section('page_name')قائمة المشرفين@endsection

@section('content')
    <div class="card mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">مشرفين الموقع</span>
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
                        <th class="min-w-125px">الاسم</th>
                        <th class="min-w-125px">الايميل</th>
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
                    <h2>حذف مشرف</h2>
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
                            <h4 class="pb-3">هل انت متاكد من حذف المشرف ؟</h4>
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
                    <h3>اضافة مشرف جديد</h3>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x fs-2"></i>
					</span>
                    </div>
                </div>
                <div class="modal-body">
                    <form>
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-12">
                                <label for="name" class="col-form-label required">اسم المشرف</label>
                                <input class="form-control" name="name" id="name" type="text"
                                       autocomplete="off">
                            </div>
                            <div class="col-12">
                                <label for="email" class="col-form-label required">البريد الالكتروني</label>
                                <input class="form-control" name="email" id=email type="email"
                                       autocomplete="off">
                            </div>
                            <div class="col-12">
                                <label for="password" class="col-form-label required">كلمة المرور</label>
                                <input class="form-control" name="password" id=password type="password"
                                       autocomplete="off">
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
    <div class="modal fade" id="edit_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>تعديل مشرف</h3>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x fs-2"></i>
					</span>
                    </div>
                </div>
                <div class="modal-body">
                    <form>
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-12">
                                <input type="hidden" class="id" name="id">
                                <label for="name" class="col-form-label required">اسم المشرف</label>
                                <input class="form-control name" name="name" type="text"
                                       autocomplete="off">
                            </div>
                            <div class="col-12">
                                <label for="email" class="col-form-label required">البريد الالكتروني</label>
                                <input class="form-control email" name="email" type="email"
                                       autocomplete="off">
                            </div>
                            <div class="col-12">
                                <label for="password" class="col-form-label">كلمة المرور</label>
                                <input class="form-control password" name="password" type="password"
                                       autocomplete="off" placeholder="******">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="edit_btn" class="btn btn-primary">حفظ البيانات</button>
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

@section('js')
<script>
    $(function () {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('adminData') !!}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
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
            url: "{{route('try_delete_admin')}}",
            data: {
                '_token': "{{csrf_token()}}",
                'id': id,
            },
            success: function (data) {
                if (data.success === true) {
                    $("#dismiss_delete_modal")[0].click();
                    $('#users-table').DataTable().ajax.reload();
                    $('<script> toastr.success("تم حذف المشرف")</' + 'script>').appendTo(document.body);

                }else{
                    $("#dismiss_delete_modal")[0].click();
                    Swal.fire({
                        icon: 'error',
                        title: 'لا يمكن حذف المشرف المسجل به !',
                        confirmButtonText: 'حسنا',
                    })
                }
            }
        });
    });
</script>
<script>
    // Add Using Ajax
    $(document).on('click', '#add_btn', function (event) {
        var name = $("#name").val(),
            email = $("#email").val(),
            password = $("#password").val();
        $.ajax({
            type: 'POST',
            url: "{{route('add_admin')}}",
            data: {
                '_token': "{{csrf_token()}}",
                'name': name,
                'email': email,
                'password': password,
            },
            success: function (data) {
                if (data.success === true) {
                    $("#dismiss_add_modal")[0].click();
                    $('#users-table').DataTable().ajax.reload();
                    $('<script> toastr.success("تم تعديل البيانات")</' + 'script>').appendTo(document.body);

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
    $(document).ready(function () {
        //Show data in the edit form
        $('#edit_modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var email = button.data('email')
            var modal = $(this)
            modal.find('.modal-body .id').val(id);
            modal.find('.modal-body .name').val(name);
            modal.find('.modal-body .email').val(email);
        });
    });
</script>
<script>
    // EDit Using Ajax
    $(document).on('click', '#edit_btn', function (event) {
        var name = $(".name").val(),
            id = $(".id").val(),
            email = $(".email").val(),
            password = $(".password").val();
        $.ajax({
            type: 'POST',
            url: "{{route('edit_admin')}}",
            data: {
                '_token': "{{csrf_token()}}",
                'id': id,
                'name': name,
                'email': email,
                'password': password,
            },
            success: function (data) {
                if (data.success === true) {
                    $("#dismiss_edit_modal")[0].click();
                    $('#users-table').DataTable().ajax.reload();
                    $('<script> toastr.info("تم تعديل البيانات بنجاح")</' + 'script>').appendTo(document.body);

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
@endsection





