
<div id="Footer">
    <footer class="footer">
        <div class="container">
            <div class="logo">
               PHP - TASK
            </div>
            <div class="links">
                <ul>
                    <li><a href="{{route('Front.Home')}}">Home</a></li>
                    <li><a href="{{route('Front.products')}}">Products</a></li>
                    <li><a href="{{route('Front.categories')}}">Categories</a></li>
            </div>
            <div class="row align-items-center">
                <div class="col-md-6 p-2">
                </div>
            </div>
        </div>
    </footer>
</div>
<!-- JS
============================================ -->
<!--jquery min js-->
<script src="{{url('')}}/front/js/jquery-3.4.1.min.js"></script>
<!--popper min js-->
<script src="{{url('')}}/front/js/popper.js"></script>
<!--bootstrap min js-->
<script src="{{url('')}}/front/js/bootstrap.min.js"></script>
<!-- Plugins JS -->
<script src="{{url('')}}/front/js/plugins.js"></script>
<!-- swiper JS -->
<script src="{{url('')}}/front/js/swiper.js"></script>
<!-- tippy JS -->
<script src="{{url('')}}/front/js/tippy-bundle.umd.js"></script>
<!-- odometer JS -->
<script src="{{url('')}}/front/js/odometer.min.js"></script>


<script src="{{url('')}}/front/js/dropify.min.js"></script>

<script src="{{url('public/front/js/multistep-form.js')}}"></script>


<!-- custom JS -->
<script src="{{url('')}}/front/js/custom.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.js"></script>


<script src="{{url('/')}}/admin/assets/plugins/notify/js/notifIt.js"></script>
<script src="{{url('/')}}/admin/assets/plugins/notify/js/notifit-custom.js"></script>



@if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: '@foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach',
            text: 'Try again!',
            confirmButtonText: 'Ok',
        })
    </script>
@endif
@toastr_js
@toastr_render

<script>
    // Add Using Ajax
    $(document).on('click', '.a_T_C', function (event) {
        var user_id = $('#user_id').val();
        var Product_id = $(this).attr('data-Product_id')
        var qty = 1;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        console.log()
        $.ajax({
            type: 'POST',
            url: "{{route('addToCart')}}",
            dataType: "json",
            data: "user_id=" + user_id + "&Product_id=" + Product_id + "&qty=" + qty,
            beforeSend: function () {
                $('.loader-ajax').show()
            },
            success: function (data) {
                if (data.success === true) {
                    $('#countItems').html(data.count)
                    $('#loadNewCart').load("{{route('loadNewCart')}}")
                    setTimeout(function () {
                        $('<script> toastr.success("The product has been added to cart")</' + 'script>').appendTo(document.body);
                    }, 1200);
                }
                if (data.error === true) {

                        $('<script> toastr.info("Please login first")</' + 'script>').appendTo(document.body);

                    setTimeout(function () {
                        window.location.href = '{{route('user.login')}}'
                    }, 2000);
                }
            }
        });
    });
</script>

<script>
    function deleteItem(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "{{route('deleteToCart')}}",
            dataType: "json",
            data: "id=" + id,
            beforeSend: function () {
                $('.loader-ajax').show()
            },
            success: function (data) {

                $('#countItems').html(data.count)

                $('#loadNewCart').load("{{route('loadNewCart')}}")

                setTimeout(function () {
                    $('#ProductCart'+id).remove()
                    calculateTotal()
                }, 1200);

                setTimeout(function () {
                    if (data.success === true) {
                        $('<script> toastr.success("The product has been removed to cart")</' + 'script>').appendTo(document.body);
                    }
                }, 1200);
            }
        });
    }
</script>

<script>

    function calculateTotal(){
        $('.qty').each(function () {
            var qty = $(this).val();

            var id = $(this).data('cart_id');
            var endTotJS = $('#endTotJS').val()

            $('#ProductCart'+id).find('#qty-form'+id).val(qty)


            var amount = $(this).data('amount');
            var tot = parseFloat(qty) * parseFloat(amount);
            $(this).closest('tr').find('.tot').html(parseFloat(tot) + 'EGP');


            $('#endTotals_'+ id).attr('data-value',tot)

            var sum = 0;
            $('.tot').each(function () {
                sum += parseFloat(parseFloat(this.getAttribute('data-value')));
            });

            $('.cartCheckout #end_tot').html(parseFloat(sum) + 'EGP')


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{route('updateQty')}}",
                dataType: "json",
                data: "qty=" + qty + "&id=" + id,
            });
        })
    }

    $(document).on('click change keyup keydown', '.qty', function () {

        $('#loadNewCart').load("{{route('loadNewCart')}}")

        console.log('ss')

        var qty = $(this).val();
        var id = $(this).data('cart_id');
        var endTotJS = $('#endTotJS').val()


        var amount = $(this).data('amount');
        var tot = parseFloat(qty) * parseFloat(amount);
        $(this).closest('tr').find('.tot').html(parseFloat(tot) + 'EGP');


        $('#endTotals_' + id).attr('data-value', tot)

        var sum = 0;
        $('.tot').each(function () {
            sum += parseFloat(parseFloat(this.getAttribute('data-value')));
        });

        $('.cartCheckout #end_tot').html(parseFloat(sum) + 'EGP')


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "{{route('updateQty')}}",
            dataType: "json",
            data: "qty=" + qty + "&id=" + id,
        });
    });
</script>

<script>
    $(document).on('click', '.not_approved', function (event) {
        $('<script> notif({msg: "{{trans('front.not_aprroved')}}",type: "info"})</' + 'script>').appendTo(document.body);
    });
</script>

<script>
    $(document).on('click', '.not_auth', function (event) {
        $('<script> notif({msg: "{{trans('front.not_auth')}}ا",type: "info"})</' + 'script>').appendTo(document.body);
        setTimeout(function () {
            window.location.href = '{{url('confirm/book/login')}}'
        }, 2000);
    });
</script>

{{--addSale From Site--}}
<script>
    // Add Using Ajax
    $(document).on('click', '#addSale', function (event) {
        var end_tot = $('#end_tot').html();
        var total = parseFloat(end_tot);

        var book_id = []
        var qty = []


        $(".book_id-form").each(function (index) {
            book_id.push(this.value)
        });


        $(".qty-form").each(function (index) {
            qty.push(this.value)
        });
        $.ajax({
            type: 'GET',
            url: "{{route('addSale')}}",
            dataType: "json",
            data: {
                total: total, book_id: book_id, qty: qty
            },
            success: function (data) {
                if (data.success === true) {
                    $('<script> toastr.success("The order has been executed. Please complete the payment")</' + 'script>').appendTo(document.body);

                }
                setTimeout(function () {
                    window.location.href = '{{route('checkout')}}'
                }, 3000);
            }
        });
    });
</script>

{{--addSale From Cart--}}
<script>
    // Add Using Ajax
    $(document).on('click', '#addSaleFromCart', function (event) {
        var end_tot = $('.cartCheckout #end_tot').html();
        var total = parseFloat(end_tot);

        var book_id = []
        var qty = []


        $(".product_remove .book_id").each(function (index) {
            book_id.push(this.value)
        });

        $(".product_remove .qty-form").each(function (index) {
            qty.push(this.value)
        });
        $.ajax({
            type: 'GET',
            url: "{{route('addSale')}}",
            dataType: "json",
            data: {
                total: total, book_id: book_id, qty: qty
            },
            success: function (data) {
                if (data.success === true) {
                    $('<script> toastr.success("The order has been executed. Please complete the payment")</' + 'script>').appendTo(document.body);
                }
                setTimeout(function () {
                    window.location.href = '{{route('checkout')}}'
                }, 2000);
            }
        });
    });
</script>

<script>
    $('#city').on('change', function () {
        // alert(this.value.split(",")[0]);
        var price = $(this).val().split(",")[0];
        $('#Shipping').html(price + '{{trans('front.EGP')}}');

        var sub_tot = $('#sub_tot').html();

        var end_tot = parseInt(sub_tot) + parseInt(price);

        $('#end_tot').html(parseFloat(end_tot) + '{{trans('front.EGP')}}');

        $('#end_total').val(parseFloat(end_tot));
    });
</script>

<script>
    ////////////////////////////////////////////
    // add and sub
    ////////////////////////////////////////////
    $('.add').click(function () {
        $(this).prev().val(+$(this).prev().val() + 1);
        calculateTotal()
    });
    $('.sub').click(function () {
        if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
        calculateTotal()
    });
</script>

<script>
    $(document).on('click', '.addToCart', function (event) {
        $('.a_T_C').removeAttr(' data-bs-target');
    });
</script>

</body>
</html>
