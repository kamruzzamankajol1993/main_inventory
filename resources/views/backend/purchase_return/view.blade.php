@extends('backend.master.master')

@section('title')
Purchase Detail | {{ $ins_name }}
@endsection


@section('css')

@endsection

@section('body')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Purchase Generate</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    {{-- <li class="breadcrumb-item"><a href="javascript: void(0);">{{ $ins_name }} </a></li> --}}
                    <li class="breadcrumb-item active">Purchase Page</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="button-items justify-content-center">


                        <button type="button" class="btn btn-primary waves-effect waves-light"
                                onclick='window.location="{{route('purchase_return_edit',$invoice->id)}}"'>
                            <i
                                class="fas fa-pen"></i> Edit Invoice
                        </button>



                            <a type="button" href="{{route('purchase_print_return',$invoice->id)}}" class="btn btn-info waves-effect waves-light"><i
                                class="fas fa-print"
                                ></i>
                            Print
                            </a>

                    <button type="button" class="btn btn-warning waves-effect waves-light"><i
                            class="fas fa-envelope"></i> Email
                    </button>
                    <button type="button" class="btn btn-dark waves-effect waves-light"><i
                            class="fas fa-envelope"></i> SMS
                    </button>

                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 my-auto">
                        <div class="card-body ">
                            <img src="{{ asset('/') }}{{ $logo }}" alt="" width="200px" height="50px">

                        </div>
                    </div>


                        <div class="col-lg-6" style="text-align:right;">
                            <div class="card-body">
                                <h3>INVOICE</h3>
                                <h5>SRN #{{$invoice->request_number}}</h5>
                                <h5>Gross Amount</h5>
                                <h4>{{$invoice->total_buy_price}} Taka</h4>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card-body">
                                <h5>Request To</h5>
                                <h3>

                                    <?php

                                    $request_product_list = DB::table('vendors')->where('name',$invoice->vendor_id)->first();


                                    ?>

                                    {{$request_product_list->name}}

                                </h3>
                                <p>COMPANY: {{$request_product_list->company_name}} <br>
                                    {{$request_product_list->address}}<br>
                                    Phone: {{$request_product_list->phone_number}}
                                </p>
                            </div>
                        </div>

                        <div class="col-lg-6 my-auto">

                            <?php

                            $request_by = DB::table('admins')->where('id',Auth::guard('admin')->user()->id)->first();
                            $information_system = DB::table('system_information')->first();

                            ?>
                            <div class="card-body">
                                <p>Invoice Date: {{$invoice->purchase_date}}</p>
                                <p>Due Date: {{$invoice->purchase_date}}</p>
                                <p>Terms: {{$invoice->term}}</p>
                            </div>
                        </div>



                    <div class="col-lg-12">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">

                                    <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($invoice_detail as $key => $pro_details)


                                    <?php



                                    $product_name = DB::table('main_products')
                                    ->where('id', $pro_details->product_id )->value('product_name');


                                                            ?>

                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td>{{$product_name}}</td>
                                            <td>{{$pro_details->quantity}}</td>
                                            <td>{{$pro_details->buy_price}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                        <div class="col-lg-7">
                            <div class="card-body">
                                <h4>Request Status: {{$invoice->urgent}}</h4>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="card-body">
                                <h4 class="card-title">Summary</h4>

                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <tbody>
                                        <tr>
                                            <td>Total Product</td>
                                            <td>{{$invoice->total_product}}</td>
                                        </tr>

                                        <tr>
                                            <td>Total quantity</td>
                                            <td>{{$invoice->total_quantity}}</td>
                                        </tr>

                                        <tr>
                                            <td>Total Price</td>
                                            <td>{{$invoice->total_buy_price}}</td>
                                        </tr>


                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-center mt-4">
                                    <p>Authorized person</p>
                                    <p>Signeture <br>
                                      .............
                                    </p>
                                    <p>Buisness Owner</p>
                                </div>

                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
@endsection
