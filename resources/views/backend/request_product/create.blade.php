@extends('backend.master.master')

@section('title')
Request Product information | {{ $ins_name }}
@endsection


@section('css')

@endsection

@section('body')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">New Request Product  Invoice Generate</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">

                        <li class="breadcrumb-item active">Invoice</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
</div> <!-- container-fluid -->

<!--Invoice Generate section start-->
<form method="POST" action="{{ route('request_product_store') }}">
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
                                <option value="{{ $all_client_print->name }}">{{ $all_client_print->name }}</option>
                                @endforeach

                            </select>
                        </div>

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
                                                <td><input class="form-control col-lg-12 name" name="name" id="name"
                                                           type="text" ></td>
                                            </tr>
                                            <tr>
                                                <td>Phone No:</td>
                                                <td><input class="form-control col-lg-12 mobile_number"
                                                           name="mobile_number" id="mobile_number" type="text"

                                                    ></td>
                                            </tr>
                                            <tr>
                                                <td>Address:</td>
                                                <td><input class="form-control col-lg-12 address" name="address"
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
                        <input class="form-control" type="text" name="order_id" value="<?php echo substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,10);?>" id="">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-text-input" class="col-md-3 col-form-label">Payment Term</label>
                    <div class="col-md-9">
                        <select class="form-select" name="payment_term">
                            <option>Select</option>
                            <option>Instant Payment</option>
                            <option>After Delivery</option>
                            <option>Due end of Month</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-text-input" class="col-md-3 col-form-label">Request Date</label>
                    <div class="col-md-9">
                        <div class="input-group" id="datepicker2">
                            <input type="text" name="pay_date" class="form-control" placeholder="dd M, yyyy"
                                   data-date-format="dd M, yyyy" data-date-container='#datepicker2'
                                   data-provide="datepicker" data-date-autoclose="true">

                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                        </div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="example-text-input" class="col-md-3 col-form-label">Request Note</label>
                    <div class="col-md-9">
                        <textarea class="form-control" rows="4"
                        placeholder="Describe about the product if have any"
                        name="request_note" required=""></textarea>
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

                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>

                            <td style="width:400px">
                                <select class=" form-control main_product_id select2" name="nmain_product_id[]" id="main_product_id0" >
                                    <option value="0">Please Select</option>
                                    @foreach($product_names as $main_product_list_all_print)
                                    <option value="{{ $main_product_list_all_print->id }}">{{ $main_product_list_all_print->product_name }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <td><input type="number" min="1" class="form-control p_quantity" value="0" name="p_quantity[]" id="p_quantity0" placeholder="Quantity"></td>

                            <td>
                                {{-- <div class="d-flex gap-3">
                                    <a href="javascript:void(0);" class="text-danger"><i
                                                class="mdi mdi-delete-forever font-size-22"></i></a>
                                </div> --}}
                            </td>
                        </tr>
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
                                <input class="form-control" type="text" name="total_product" value="" id="total_product" readonly>
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label for="example-text-input" class="col-md-3 col-form-label">Total Quantity</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="total_quantity" value="" id="total_quantity" readonly>
                            </div>
                        </div>

                        <div class="mb-2 row">
                            <label for="example-text-input" class="col-md-3 col-form-label">Urgent</label>
                            <div class="col-md-9">
                                <select class="form-control"  name="urgent_type" >
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-2 row">
                            <label for="example-text-input" class="col-md-3 col-form-label">Request Delivery Date</label>
                            <div class="col-md-9">
                                <div class="input-group" id="datepicker2">
                                    <input type="text" name="request_delivery_date" class="form-control" placeholder="dd M, yyyy"
                                           data-date-format="dd M, yyyy" data-date-container='#datepicker2'
                                           data-provide="datepicker" data-date-autoclose="true">

                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
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
        $("#dynamicAddRemove").append('<tr><td style="width:400px"><select class="select form-control main_product_id select2" name="nmain_product_id[]" id="main_product_id'+i+'" data-placeholder="Choose ..."><option value="0">Please Select</option> @foreach($product_names as $main_product_list_all_print)<option value="{{ $main_product_list_all_print->id }}">{{ $main_product_list_all_print->product_name }}</option>@endforeach</select></td><td><input type="number" class="form-control p_quantity" min="1" name="p_quantity[]" value="0" id="p_quantity'+i+'" placeholder="Quantity"></td><td><button type="button" class="btn btn-sm btn-outline-danger remove-input-field"><i class="mdi mdi-delete-forever font-size-22"></i></button></td></tr>');
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
});
</script>

@include('backend.request_product.script')


@endsection
