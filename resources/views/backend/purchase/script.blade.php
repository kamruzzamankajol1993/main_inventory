<script type="text/javascript">

    $(document).ready(function () {
         $("#select_vendor_name_from_list").change(function(){

    var main_value = $(this).val();

    $.ajax({
    url: "{{ route('get_vendor_for_request_and_purchase') }}",
    method: 'GET',
    data: {main_value:main_value},
    success: function(data) {
    $("#main_address_view_from_client").html('');
    $("#main_address_view_from_client").html(data);
    }
    });

    });

    ///main product
    $(document).on('change', 'select.main_product_id', function () {

    var total_product_quantity = $('#total_product').val();

       if(total_product_quantity.trim().length == 0){

        $('#total_product').val(1);

       }else{


       }





    });

    //quantity


    });

    </script>
    <script type="text/javascript">
        $(document).on('change', 'input[name="p_quantity[]"]', function () {

            var final_total_net_discountprice = 0;

            var total_net_price = $('input[name="p_quantity[]"]').map(function (idx, ele) {
       return $(ele).val();
    }).get();


    for (var i = 0; i < total_net_price.length; i++) {
        final_total_net_discountprice += total_net_price[i] << 0;
    }

    $('#total_quantity').val(final_total_net_discountprice);

        });
        </script>

<script type="text/javascript">

$(document).on('change', 'input[name="buying_price[]"]', function () {

    var final_total_net_discountprice = 0;

    var total_net_price = $('input[name="buying_price[]"]').map(function (idx, ele) {
       return $(ele).val();
    }).get();


    for (var i = 0; i < total_net_price.length; i++) {
        final_total_net_discountprice += total_net_price[i] << 0;
    }


    $('#total_buying_price').val(final_total_net_discountprice);



});

</script>
