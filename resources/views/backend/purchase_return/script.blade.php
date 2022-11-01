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


var main_id = $(this).attr('id');
var get_id_from_main = main_id.slice(10);
var buying_price = $('#main_buying_price'+get_id_from_main).val();
var p_quantity = $('#p_quantity'+get_id_from_main).val();

var final_buying_price = (buying_price*p_quantity);


$('#buying_price'+get_id_from_main).val(final_buying_price);

// alert(buying_price*p_quantity);




            var final_total_net_discountprice = 0;

            var total_net_price = $('input[name="p_quantity[]"]').map(function (idx, ele) {
       return $(ele).val();
    }).get();


    for (var i = 0; i < total_net_price.length; i++) {
        final_total_net_discountprice += total_net_price[i] << 0;
    }

    $('#total_quantity').val(final_total_net_discountprice);



    ///

    var tfinal_total_net_discountprice = 0;

var ttotal_net_price = $('input[name="buying_price[]"]').map(function (idx, ele) {
   return $(ele).val();
}).get();


for (var i = 0; i < ttotal_net_price.length; i++) {
    tfinal_total_net_discountprice += ttotal_net_price[i] << 0;
}


$('#total_buying_price').val(tfinal_total_net_discountprice);

    ///

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


<script type="text/javascript">
$(document).on('change', 'select.main_product_id', function () {

    var main_id = $(this).attr('id');
var get_id_from_main = main_id.slice(15);
var main_product_id = $('#main_product_id'+get_id_from_main).val();

//alert(main_product_id);


//product size
$.ajax({
    url: "{{ route('get_buying_price_from_data') }}",
    method: 'GET',
    data: {main_product_id:main_product_id},
    success: function(data) {
     // $("#unit_price"+get_id_from_main).val('');

     var p_quantity = $('#p_quantity'+get_id_from_main).val();





      $("#buying_price"+get_id_from_main).val('');
      $("#buying_price"+get_id_from_main).val(data*p_quantity);
      $("#main_buying_price"+get_id_from_main).val('');
      $("#main_buying_price"+get_id_from_main).val(data);

      ///new
      var tfinal_total_net_discountprice = 0;

var ttotal_net_price = $('input[name="buying_price[]"]').map(function (idx, ele) {
   return $(ele).val();
}).get();


for (var i = 0; i < ttotal_net_price.length; i++) {
    tfinal_total_net_discountprice += ttotal_net_price[i] << 0;
}


$('#total_buying_price').val(tfinal_total_net_discountprice);
      ///new
    }
    });
    //end product size


});

</script>
