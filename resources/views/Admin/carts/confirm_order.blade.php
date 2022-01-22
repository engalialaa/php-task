@extends('layouts.admin.app')
@section('page_name')
    قائمة الطلبات السابقة
@endsection
@section('content')
    <div class="card mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">الطلبات السابقة</span>
            </h3>
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
                        <th class="min-w-125px">تاريخ الطلب</th>
                        <th class="min-w-25px">رقم الطلب</th>
                        <th class="min-w-100px">اسم العميل</th>
                        <th class="min-w-100px">البريد الالكترونى</th>
                        <th class="min-w-100px">رقم الهاتف</th>
                        <th class="min-w-150px">العنوان</th>
                        <th class="min-w-100px">تفاصيل اضافية</th>
                        <th class="min-w-50px">المجموع</th>
                        <th class="min-w-50px">الدفع</th>
                        <th class="min-w-50px">تفاصيل الطلب</th>
                        <th class="min-w-100px">حالة الطلب</th>
                        <th class="min-w-50px">حذف الطلب</th>
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
                    <h2>حذف طلب</h2>
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
                            <h4 class="pb-3">هل انت متاكد من حذف طلب المشتري التالي ؟</h4>
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


    <!-------------------------Start EDIT Form --------------------------------------------------------------->
    <div class="modal fade" id="edit_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>تفاصيل الطلب</h3>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x fs-2"></i>
					</span>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12" id="items">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" id="dismiss_edit_modal" class="btn btn-white me-3" data-bs-dismiss="modal">الغاء
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
                ajax: '{!! route('Confirm_cartsData') !!}',
                columns: [
                    {data: 'created_at', name: 'created_at'},
                    {data: 'id', name: 'id'},
                    {data: 'user_id', name: 'user_id'},
                    {data: 'email', name: 'email'},
                    {data: 'phone', name: 'phone'},
                    {data: 'street', name: 'street'},
                    {data: 'other_details', name: 'other_details'},
                    {data: 'total', name: 'total'},
                    {data: 'pay_type', name: 'pay_type'},
                    {data: 'action', name: 'action'},
                    {data: 'status', name: 'status'},
                    {data: 'delete', name: 'delete'},

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

                dom: 'Bfrtip',
                buttons: [
                    'print'
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
                var title = button.data('name')
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
                url: "{{route('delete_cart')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                    'id': id,
                },
                success: function (data) {
                    if (data.success === true) {
                        $("#dismiss_delete_modal")[0].click();
                        $('#users-table').DataTable().ajax.reload();
                        $('<script> notif({msg: "تم حذف الطلب بنجاح",type: "success"})</' + 'script>').appendTo(document.body);
                    }
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            //Show data in the edit form
            $('#edit_modal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var id = button.data('id');
                var url = "/"
                url = url.concat("php-task/public/admin/details/").concat(id);
                $.get(url, function(data) {
                    $('#items').html(data.html);
                });
            });
        });
    </script>
@endsection





