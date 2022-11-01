@extends('backend.master.master')

@section('title')
Purchase Return Product information | {{ $ins_name }}
@endsection


@section('css')

@endsection

@section('body')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Purchase Return Product  Invoice Generate</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">

                        <li class="breadcrumb-item active">Purchase Return</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
</div> <!-- container-fluid -->

<!--Invoice Generate section start-->
<form method="POST" action="{{ route('purchase_return_update') }}">

    <input type="hidden"  value="{{ $invoice->id }}" name="id" />
    @csrf
<div class="row">
    @include('flash_message')
    <div class="col-xl-6">
        <div class="card">
            <h5 class="card-header">Vendor Information</h5>

            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="" class="form-label">Select Vendor</label>
                            <select class="select2 form-control show_all_addresss" name="vendor_name"
                                    data-placeholder="Choose ..." id="select_vendor_name_from_list" required>
                                <option value="Add New Vendor" selected>Add New Vendor</option>
                                @foreach($vendors as $all_client_print)
                                <option value="{{ $all_client_print->name }}" {{ $all_client_print->name == $invoice->vendor_id? 'selected':'' }}>{{ $all_client_print->name }}</option>
                                @endforeach

                            </select>
                        </div>
<?php


$request_product_list = DB::table('vendors')->where('name',$invoice->vendor_id)->first();


?>


                        <div class="mb-3">
                            <div class="card border border-primary">
                                <div class="card-header bg-transparent border-primary">
                                    <h5 class="my-0 text-primary"><i class="mdi mdi-home me-1"></i>
                                        Vendor Address</h5>
                                </div>
                                <div class="card-body" >

                                    <div class="table-responsive">
                                        <table class="table table-borderless mb-0" id="main_address_view_from_client">
                                            <tbody>
                                            <tr>
                                                <td>Name:</td>
                                                <td><input class="form-control col-lg-12 name" name="name" value="{{ $request_product_list->name }}" id="name"
                                                           type="text" ></td>
                                            </tr>
                                            <tr>
                                                <td>Phone No:</td>
                                                <td><input class="form-control col-lg-12 mobile_number"
                                                           name="mobile_number" value="{{ $request_product_list->phone_number }}" id="mobile_number" type="text"

                                                    ></td>
                                            </tr>
                                            <tr>
                                                <td>Address:</td>
                                                <td><input class="form-control col-lg-12 address" value="{{ $request_product_list->address }}" name="address"
                                                           id="address" type="text" ></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card">
            <h5 class="card-header">Invoice</h5>
            <div class="card-body">
                <div class="mb-3 row">
                    <label for="example-text-input" class="col-md-3 col-form-label">Invoice #</label>
                    <div class="col-md-9">
                        <input class="form-control" type="text" name="order_id" value="{{ $invoice->request_number }}" id="">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-text-input" class="col-md-3 col-form-label">Payment Term</label>
                    <div class="col-md-9">
                        <select class="form-select" name="term">
                            <option>Select</option>
                            <option value="Instant Payment" {{ $invoice->term == 'Instant Payment'? 'selected':'' }}>Instant Payment</option>
                            <option value="After Delivery" {{ $invoice->term == 'After Delivery'? 'selected':'' }}>After Delivery</option>
                            <option value="Due end of Month" {{ $invoice->term == 'Due end of Month'? 'selected':'' }}>Due end of Month</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-text-input" class="col-md-3 col-form-label">Request Date</label>
                    <div class="col-md-9">
                        <div class="input-group" id="datepicker2">
                            <input type="text" name="pay_date" value="{{ $invoice->request_date }}" class="form-control" placeholder="dd M, yyyy"
                                   data-date-format="dd M, yyyy" data-date-container='#datepicker2'
                                   data-provide="datepicker" data-date-autoclose="true">

                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                        </div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="example-text-input" class="col-md-3 col-form-label">Purchase Lot Number</label>
                    <div class="col-md-9">
                        <input class="form-control" type="text" name="purchase_lot_number" value="{{ $invoice->purchase_lot_number }}" id="">
                    </div>
                </div>



                <div class="mb-3 row">
                    <label for="example-text-input" class="col-md-3 col-form-label">Purchase Lote Date</label>
                    <div class="col-md-9">
                        <div class="input-group" id="datepicker2">
                            <input type="text" value="{{ $invoice->purchase_date }}" name="purchase_date" class="form-control" placeholder="dd M, yyyy"
                                   data-date-format="dd M, yyyy" data-date-container='#datepicker2'
                                   data-provide="datepicker" data-date-autoclose="true">

                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                        </div>
                    </div>
                </div>


                <div class="mb-3 row">
                    <label for="example-text-input" class="col-md-3 col-form-label">Warehouse</label>
                    <div class="col-md-9">
                        <select class="form-control"  name="warehouse">
                            <option value="0">--Please Select ---</option>


                        @foreach($ware_house_list as $all_ware_house_list)

<option value="{{ $all_ware_house_list->name }}" {{ $invoice->warehouse == $all_ware_house_list->name  ?  'selected':'' }}>{{ $all_ware_house_list->name }}</option>

                        @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="example-text-input" class="col-md-3 col-form-label">Request Note</label>
                    <div class="col-md-9">
                        <textarea class="form-control" rows="4"
                        placeholder="Describe about the product if have any"
                        name="request_note" required="">{{ $invoice->request_note }}</textarea>
                    </div>
                </div>





            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <h5 class="card-header">Product Information</h5>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle table-nowrap table-check" id="dynamicAddRemove">
                        <thead class="table-light">
                        <tr>
                            <th style="width:200px"> Product Name</th>

                            <th>Qty</th>
                            <th>Buying Price</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($invoice_detail as $key=>$all_invoice_detail)
                            @if(($key+1) == 1)

                            <tr>

                                <td style="width:400px">
                                    <select class=" form-control main_product_id select2" name="nmain_product_id[]" id="main_product_id{{ $key+5000 }}" >
                                        <option value="0">Please Select</option>
                                        @foreach($product_names as $main_product_list_all_print)
                                        <option value="{{ $main_product_list_all_print->id }}"
                                            {{ $all_invoice_detail->product_id == $main_product_list_all_print->id ? 'selected':''}}>{{ $main_product_list_all_print->product_name }}</option>
                                        @endforeach
                                    </select>
                                </td>

                                <td><input type="number" min="1" class="form-control p_quantity" value="{{ $all_invoice_detail->quantity }}" name="p_quantity[]" id="p_quantity{{ $key+5000 }}" placeholder="Quantity"></td>
                                <td>
                                    <input type="number" min="1" class="form-control buying_price"  name="buying_price[]" value="{{ $all_invoice_detail->buy_price }}" id="buying_price{{ $key+5000 }}" placeholder="Buying Price">
                                    <input type="hidden" min="1" class="form-control main_buying_price" value="{{ $all_invoice_detail->main_buy_price }}" name=" main_buying_price[]" id="main_buying_price{{ $key+5000 }}" placeholder="Main Buying Price">
                                </td>
                                <td>
                                    {{-- <div class="d-flex gap-3">
                                        <a href="javascript:void(0);" class="text-danger"><i
                                                    class="mdi mdi-delete-forever font-size-22"></i></a>
                                    </div> --}}
                                </td>
                            </tr>

                            @else
                        <tr>

                            <td style="width:400px">
                                <select class=" form-control main_product_id select2" name="nmain_product_id[]" id="main_product_id{{ $key+5000 }}" >
                                    <option value="0">Please Select</option>
                                    @foreach($product_names as $main_product_list_all_print)
                                    <option value="{{ $main_product_list_all_print->id }}" {{ $all_invoice_detail->product_id == $main_product_list_all_print->id ? 'selected':''}}>{{ $main_product_list_all_print->product_name }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <td><input type="number" min="1" class="form-control p_quantity" value="{{ $all_invoice_detail->quantity }}" name="p_quantity[]" id="p_quantity{{ $key+5000 }}" placeholder="Quantity"></td>
                            <td>
                                <input type="number" min="1" class="form-control buying_price" value="{{ $all_invoice_detail->buy_price }}" name="buying_price[]" id="buying_price{{ $key+5000 }}" placeholder="Buying Price">
                                <input type="hidden" min="1" class="form-control main_buying_price" value="{{ $all_invoice_detail->main_buy_price }}" name=" main_buying_price[]" id="main_buying_price{{ $key+5000 }}" placeholder="Main Buying Price">
                            </td>
                            <td>

                                <button type="button" class="btn btn-sm btn-outline-danger remove-input-field"><i class="mdi mdi-delete-forever font-size-22"></i></button>
                                {{-- <div class="d-flex gap-3">
                                    <a href="javascript:void(0);" class="text-danger"><i
                                                class="mdi mdi-delete-forever font-size-22"></i></a>
                                </div> --}}
                            </td>
                        </tr>
                        @endif
                        @endforeach
                        </tbody>
                    </table>

                    <button id="main_add_new_product" type="button" class="btn btn-light waves-effect btn-label waves-light"><i
                                class="bx bx-plus-medical label-icon "></i> Add New Product
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-7"></div>
                    <div class="col-xl-5">


                        <div class="mb-2 row">
                            <label for="example-text-input" class="col-md-3 col-form-label">Total Product</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="total_product" value="{{ $invoice->total_product }}" id="total_product" readonly>
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label for="example-text-input" class="col-md-3 col-form-label">Total Quantity</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="total_quantity" value="{{ $invoice->total_quantity }}" id="total_quantity" readonly>
                            </div>
                        </div>

                        <div class="mb-2 row">
                            <label for="example-text-input" class="col-md-3 col-form-label">Total Buying Price</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="total_buy_price" value="{{ $invoice->total_buy_price }}"  id="total_buying_price" readonly>
                            </div>
                        </div>


                        <div class="card mt-3">
                            <div class="card-body" style="background-color: #1f7556 !important; border-radius: 15px;">
                                <div class="d-flex">

                                    <div class="ms-3">
                                        <button type="submit" class="btn btn-success">
                                            <i class="mdi mdi-cart-arrow-right me-1"></i> Checkout </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection


@section('script')


<script type="text/javascript">
    var i = 0;
    var j= 0;
    $("#main_add_new_product").click(function () {
        ++i;
        var total_pp_quantity = $('#total_product').val();
        $("#dynamicAddRemove").append('<tr><td style="width:400px"><select class="select form-control main_product_id select2" name="nmain_product_id[]" id="main_product_id'+i+'" data-placeholder="Choose ..."><option value="0">Please Select</option> @foreach($product_names as $main_product_list_all_print)<option value="{{ $main_product_list_all_print->id }}">{{ $main_product_list_all_print->product_name }}</option>@endforeach</select></td><td><input type="number" class="form-control p_quantity" min="1" name="p_quantity[]" value="1" id="p_quantity'+i+'" placeholder="Quantity"></td><td><input type="number" min="1" class="form-control buying_price" value="0" name="buying_price[]" id="buying_price'+i+'" placeholder="Buying Price"> <input type="hidden" min="1" class="form-control main_buying_price" value="0" name="main_buying_price[]" id="main_buying_price'+i+'" placeholder="Main Buying Price"></td><td><button type="button" class="btn btn-sm btn-outline-danger remove-input-field"><i class="mdi mdi-delete-forever font-size-22"></i></button></td></tr>');
            $('.select2').select2();


            if(total_pp_quantity.trim().length == 0){
                total_pp_quantity = 2;
            }else{
                total_pp_quantity = parseInt(total_pp_quantity) + parseInt(1);
            }

            $('#total_product').val(total_pp_quantity);
    });
    // $(document).on('click', '.remove-input-field', function () {
    //     $(this).parents('tr').remove();
    // });
</script>

<script type="text/javascript">

$(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();

        var total_product_quantity = $('#total_product').val();
        var p_result = total_product_quantity -1;

        $('#total_product').val(p_result);


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

@include('backend.purchase_return.script')


@endsection
