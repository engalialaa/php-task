@extends('layouts.admin.app')
@section('page_name')قائمة المنتجات@endsection
@section('content')
    <div class="card mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">قائمة المنتجات</span>
            </h3>
            <a href="{{route('create.product')}}" class="btn btn-light-primary er fs-6 px-7 py-3 ml-2">
                <span><i class="bi bi-plus-circle"></i></span>
                اضافة جديد</a>
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
                        <th class="min-w-25px">م</th>
                        <th class="min-w-125px">صورة المنتج</th>
                        <th class="min-w-125px">اسم المنتج</th>
                        <th class="min-w-125px">القسم</th>
                        <th class="min-w-125px">السعر</th>
                        <th class="min-w-125px">حالة المنتج</th>
                        <th class="min-w-125px">تفاصيل المنتج</th>
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
                    <h2>حذف كتاب</h2>
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
                            <h4 class="pb-3">هل انت متاكد من حذف الكتاب التالي ؟</h4>
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
    <div class="modal fade" id="ProductDetails_model" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>تفاصيل المنتج</h3>
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
                ajax: '{!! route('productsData') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'photo', name: 'photo'},
                    {data: 'name', name: 'name'},
                    {data: 'category_id', name: 'category_id'},
                    {data: 'price', name: 'price'},
                    {data: 'is_shown', name: 'is_shown'},
                    {data: 'ProductDetails', name: 'ProductDetails'},
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

                dom: 'Bfrtip',
                buttons: [
                    'print','excel'
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
                var title = button.data('title_ar')
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
                url: "{{route('delete_book')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                    'id': id,
                },
                success: function (data) {
                    if (data.success === true) {
                        $("#dismiss_delete_modal")[0].click();
                        $('#users-table').DataTable().ajax.reload();
                        $('<script> notif({msg: "تم حذف الكتاب بنجاح",type: "success"})</' + 'script>').appendTo(document.body);
                    }
                }
            });
        });
    </script>

    <script>
        $(document).on('click', '#ProductDitails', function (event) {
            var id = $(this).attr("data-id")
            var url = "/"
            url = url.concat("php-task/public/admin/ProductDetails/").concat(id);
            $.get(url, function(data) {
                $('#item').html(data.html);
            });

            setTimeout(function() {
                $('#ProductDetails_model').modal('show');
            }, 500);
        });
    </script>
    <script>
        // Make Better Using Ajax
        $(document).on('click', '#is_shown_btn', function (event) {
            var id = $(this).data("id")
            $.ajax({
                type: 'POST',
                url: "{{route('is_shown_product')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                    'id': id,
                },
                success: function (data) {
                    if (data.success === true) {
                        $('#users-table').DataTable().ajax.reload();
                        $('<script> toastr.warning("تم تعديل  حالة المنتج ")</' + 'script>').appendTo(document.body);
                    }
                }
            });
        });
    </script>

@endsection





