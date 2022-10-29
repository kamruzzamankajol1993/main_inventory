@extends('backend.master.master')

@section('title')
Vendor information | {{ $ins_name }}
@endsection


@section('css')

@endsection

@section('body')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Vendor Information</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    {{-- <li class="breadcrumb-item"><a href="javascript: void(0);"> </a></li> --}}
                    <li class="breadcrumb-item active">All Vendor</li>
                </ol>
            </div>

        </div>
    </div>
    <div class="col-12">
        <h4 class="card-title">Vendor Listing</h4>
        <p class="card-title-desc">You can <code>Show, Hide & Edit</code> all Vendor</p>
    </div>
</div>
<!-- search bar --->
<div class="row">
    <div class="col-sm-9"></div>
    <div class="col-sm-3">
        <div class="text-sm-end">
            <div class="form-group">
                <input type="text" name="search_on_cat_name" class="form-control" id="search_on_cat_name"
                       placeholder="Search">
            </div>
        </div>
    </div>
</div>
<!-- end search bar --->

<div class="row mt-2">
    <div class="col-sm-6 col-xl-6">
        <div class="d-flex flex-wrap gap-2">
            <p class="horizontal-center" >Selected:<span id="numberOfChecked"> 0</span></p>

            </button>
            <button type="" id="delete_button" class="btn btn-sm btn-outline-danger waves-effect ml-4" disabled>
                Delete All
            </button>

        </div>
    </div>

    <div class="col-sm-6">
        <div class="text-sm-end">
            <button type="button"
                    class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"
                    data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">
                <i class="mdi mdi-plus me-1"></i> Add New Vendor Info
            </button>
        </div>
            <!-- Modal -->
     <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Add Vendor Information</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
    </button>
    </div>
    <div class="modal-body">
        <form class="mt-3" method="Post" action="{{ route('vendor_store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">


                            <div class="row">
        <div class="form-group col-md-4 col-sm-4">
            <label for="name1">Name</label>
            <input type="text" class="form-control form-control-sm" id="name1" name="name" placeholder="Enter Name">
        </div>

<div class="form-group col-md-4 col-sm-4">
                            <label>Mobile Number:</label>
                            <input type="number" class="form-control form-control-sm" name="phone_number" required/>
                        </div>

                        <div class="form-group col-md-4 col-sm-4">
                            <label>Email:</label>
                            <input type="email" class="form-control form-control-sm" name="email" />
                        </div>
</div>
<div class="row mt-3">

                        <div class="form-group col-md-4 col-sm-4">
                            <label>City:</label>
                            <input type="text" class="form-control form-control-sm" name="city" />
                        </div>

                        <div class="form-group col-md-4 col-sm-4">
                            <label>Company Address:</label>
                            <input type="text" class="form-control form-control-sm" name="address" />
                        </div>

                        <div class="form-group col-md-4 col-sm-4">
                            <label>Country</label>
                            <input type="text" class="form-control form-control-sm" name="country" >
                        </div>

    </div>
<div class="row mt-3">

                        <div class="form-group col-md-3 col-sm-3">
                            <label>Company Name:</label>
                            <input type="text" class="form-control form-control-sm" name="company_name" />
                        </div>

                        <div class="form-group col-md-3 col-sm-3">
                            <label>Postal Code:</label>
                            <input type="text" class="form-control form-control-sm" name="postal_code" />
                        </div>

                        <div class="form-group col-md-3 col-sm-3">
                            <label>Tax id</label>
                            <input type="text" class="form-control form-control-sm" name="taxid" >
                        </div>

                         <div class="form-group col-md-3 col-sm-3">
                            <label>Status</label>


                            <select class="form-control form-control-sm" name="status" >
                             <option>---Please Select ---</option>
                             <option value="Active">Active</option>

                      <option value="InActive">InActive</option>


                      </select>
                        </div>

    </div>





                        </div>

                    </div>
                </div>



                                                              <div class="col-lg-6">
                                <button type="submit" class="btn btn-primary btn-lg  waves-effect  btn-sm waves-light mr-1">
                                   Submit
                                </button>
                                </div>
            </div> <!-- end col -->
        </form>
    </div>

    </div>
    </div>
    </div>
    </div>
    <div class="col-xl-12">
        @include('flash_message')
        <div class="card">
            <div class="card-body" id="main_content_table">
                <div class="table-responsive">
                    <table class="table  table-striped">
                        <thead class="table-light">
                        <tr>
                            <th style="width: 20px;" >
                                <div class="form-check font-size-16">
                                    <input class="form-check-input" type="checkbox" id="master">
                                    <label class="form-check-label" for="checkAll"></label>
                                </div>
                            </th>
                            <th >Sl.</th>
                            <th>Vendor Name</th>
                            <th>Company Name</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>Phone No</th>
                            <th>Tax Id</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                            @foreach($vendor_infromation as $key=>$all_attribute)
                        <tr>
                            <td>
                                <div class="form-check font-size-16">
                                    <input class="form-check-input sub_chk" value="{{$all_attribute->id}}"  data-id="{{$all_attribute->id}}" type="checkbox" id="orderidcheck01">
                                    <label class="form-check-label" for="orderidcheck01"></label>
                                </div>
                            </td>
                            <td class="text-body fw-bold">{{ $key+1 }}</td>
                            <td>{{$all_attribute->name}}</td>
                            <td>{{$all_attribute->company_name}}</td>
                            <td>{{$all_attribute->address}}</td>
                            <td>{{$all_attribute->email}}</td>
                            <td>{{$all_attribute->phone_number}}</td>
                            <td>{{$all_attribute->taxid}}</td>
                            <td>{{$all_attribute->status}}</td>



                            <td>
                                <div class="d-flex gap-1">

                                    @if (Auth::guard('admin')->user()->can('vendor_view'))

                                    <a href="{{ route('vendor_view',$all_attribute->id) }}" class="btn btn-transparent btn-sm text-primary" >
                                        <i class="mdi mdi-eye font-size-14"></i>
                                    </a>


                                    @endif

                                    @if (Auth::guard('admin')->user()->can('vendor_update'))

<button class="btn btn-transparent btn-sm text-success" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg{{ $all_attribute->id }}">
                            <i class="mdi mdi-pencil font-size-14"></i>
                            </button>

    <!-- Modal -->
    @include('backend.vendor.edit')
@endif
    @if (Auth::guard('admin')->user()->can('vendor_delete'))


                                        <button class=" btn btn-transparent btn-sm text-danger"  onclick="deleteTag({{ $all_attribute->id}})"><i
                                                    class="mdi mdi-delete font-size-14"></i></button>

                                                    <form id="delete-form-{{ $all_attribute->id }}" action="{{ route('vendor_delete',$all_attribute->id) }}" method="POST" style="display: none;">

                                                                                      @csrf

                                                                                  </form>
                                                                                  @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
@endforeach
                        </tbody>
                    </table>
                </div>
                @include('backend.vendor.normal_pagination')
            </div>
        </div>
    </div>
</div>

<!-- Modal HTML -->
<div id="myModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Are You Sure ?</h1>
                {{-- <button type="button" class="btn btn-danger close" >&times;</button> --}}
            </div>
            <div class="modal-body">
{{-- <button>ddddqw</button> --}}
                    <button class="btn btn-success w-md waves-effect waves-light"  id="final_delete">Yes</button>
                    <button class="btn btn-danger w-md waves-effect waves-light closee" id="">Cancel</button>


            </div>

        </div>
    </div>
</div>
<!--end modal for delete -->
@endsection


@section('script')

<script type="text/javascript">
$(document).ready(function () {

    $(".closee").click(function(){
$("#myModal").modal('hide');
});
});
</script>
<script type="text/javascript" src="{{ asset('/') }}public/custom_js/vendor_page_search.js"></script>
<script type="text/javascript" src="{{ asset('/') }}public/custom_js/vendor_page.js"></script>
<script type="text/javascript" src="{{ asset('/') }}public/custom_js/delete_code.js"></script>
@endsection
