@extends('backend.master.master')

@section('title')
Vendor Profile | {{ $ins_name }}
@endsection


@section('css')

@endsection

@section('body')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Vendor Profile</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    {{-- <li class="breadcrumb-item"><a href="javascript: void(0);">{{ $ins_name }} </a></li> --}}
                    <li class="breadcrumb-item active">{{ $ins_name }} </li>
                </ol>
            </div>

        </div>
    </div>
</div>
<div class="row">
                        <div class="col-sm-6">
                            <div class="float-right d-md-block">
                                <div class="dropdown">

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row mt-2">
 @include('flash_message')

                   <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-borderless mb-0">
                                        <tbody>
                                        <tr>
                                            @foreach($vendors as $key => $client)
                                                {{--                                                <td><img src="{{asset('assets/images/users/user-1.jpg')}}" alt=""></td>--}}
{{--                                                <td><img src="/client_image/{{$client->image_location}}"--}}
{{--                                                         class="student-meta-img img-100" width="200" height="200"--}}
{{--                                                         alt="Image"/>--}}
{{--                                                </td>--}}
                                                <td></td>
                                        </tr>


                                        <tr>
                                            <td>Name</td>
                                            <td>{{$client->name}}</td>
                                        </tr>
                                        <tr>
                                            <td>Phone Number</td>
                                            <td>{{$client->phone_number}}</td>
                                        </tr>
                                        <tr>
                                            <td>Address</td>
                                            <td>{{$client->address}}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>{{$client->email}}</td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td>{{$client->status}}</td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="row">
                            <div class="col-12">
                                <h4 class="card-title">Summary</h4>
                            </div>
                            <div class="col-lg-4">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="{{asset('public/admin/assets/images/01.png')}}" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Total
                                                Transection</h5>
                                            <h4 class="font-weight-medium font-size-24">{{$total_amount}}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="{{asset('public/admin/assets/images/01.png')}}" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Paid Amount</h5>
                                            <h4 class="font-weight-medium font-size-24">{{$total_paid}}</h4>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="{{asset('public/admin/assets/images/01.png')}}" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Due</h5>
                                            <h4 class="font-weight-medium font-size-24">{{$total_due}}</h4>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                               style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>SL.</th>
                                                <th>Invoice Number</th>
                                                <th>Total Amount</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($buy_lists as $key => $invoice_detail)
                                                <tr>
                                                    <input type="hidden" class="serdelete_val_id"
                                                           value="{{ $invoice_detail->id }}">
                                                    <td>{{++$key}}</td>
                                                    <td>{{$invoice_detail->purchase_lot_number}}</td>
                                                    <td>{{$invoice_detail->total_buy_price}}</td>
                                                    @if($invoice_detail->status=='Paid')
                                                        <td>
                                                    <span
                                                        class="badge  badge-success"> {{$invoice_detail->status}}</span>
                                                        </td>
                                                    @elseif($invoice_detail->status=='due')
                                                        <td><span
                                                                class="badge badge-danger">{{$invoice_detail->status}}</span>
                                                        </td>
                                                    @else
                                                        <td><span
                                                                class="badge badge-warning">{{$invoice_detail->status}}</span>
                                                        </td>
                                                    @endif
                                                    <td>{{$invoice_detail->purchase_date}}</td>
                                                    <td>
                                                        <button type="button"
                                                                class="btn btn-success waves-light waves-effect"
                                                                data-toggle="modal" data-target=".bs-delete-modal-lg"
                                                                onclick='window.location="{{route('purchase_product_view_details',$invoice_detail->purchase_lot_number)}}"'>
                                                            <i
                                                                class="fas fa-eye"
                                                            ></i>
                                                        </button>
                                                        <button type="button"
                                                                class="btn btn-info waves-light waves-effect delete"
                                                                data-toggle="modal" data-target=".bs-delete-modal-lg"
                                                                onclick='window.location="{{route('print_product_purchase_pdf',$invoice_detail->purchase_lot_number)}}"'>
                                                            <i
                                                                class="fas fa-cloud-download-alt"
                                                            ></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->


                    </div> <!-- end row -->










@endsection

@section('script')


      <script type="text/javascript">
        function deleteTag(id) {
            swal({
                title: 'Are you sure?',
                text: "You will not be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>
@endsection







