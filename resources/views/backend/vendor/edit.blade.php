<div class="modal fade bs-example-modal-lg{{ $all_attribute->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Update Vendor Information</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
</button>
</div>
<div class="modal-body">
<form class="custom-validation" action="{{ route('vendor_update') }}" method="post" enctype="multipart/form-data">
@csrf




    <input type="hidden" name="id" value="{{ $all_attribute->id  }}" class="form-control">

    <div class="row">
        <div class="form-group col-md-4 col-sm-4">
            <label for="name1">Name</label>
            <input type="text" class="form-control form-control-sm" id="name1" name="name" value="{{ $all_attribute->name}}" placeholder="Enter Name">
        </div>

<div class="form-group col-md-4 col-sm-4">
                            <label>Mobile Number:</label>
                            <input type="number" class="form-control form-control-sm" name="phone_number" value="{{ $all_attribute->phone_number}}" required/>
                        </div>

                        <div class="form-group col-md-4 col-sm-4">
                            <label>Email:</label>
                            <input type="email" class="form-control form-control-sm" name="email" value="{{ $all_attribute->email}}"/>
                        </div>
</div>
<div class="row mt-3">

                        <div class="form-group col-md-4 col-sm-4">
                            <label>City:</label>
                            <input type="text" class="form-control form-control-sm" name="city" value="{{ $all_attribute->city}}"/>
                        </div>

                        <div class="form-group col-md-4 col-sm-4">
                            <label>Company Address:</label>
                            <input type="text" class="form-control form-control-sm" name="address" value="{{ $all_attribute->address}}"/>
                        </div>

                        <div class="form-group col-md-4 col-sm-4">
                            <label>Country</label>
                            <input type="text" class="form-control form-control-sm" name="country" value="{{ $all_attribute->country}}">
                        </div>

    </div>
<div class="row mt-3">

                        <div class="form-group col-md-3 col-sm-3">
                            <label>Company Name:</label>
                            <input type="text" class="form-control form-control-sm" name="company_name" value="{{ $all_attribute->company_name}}" />
                        </div>

                        <div class="form-group col-md-3 col-sm-3">
                            <label>Postal Code:</label>
                            <input type="text" class="form-control form-control-sm" name="postal_code" value="{{ $all_attribute->postal_code}}" />
                        </div>

                        <div class="form-group col-md-3 col-sm-3">
                            <label>Tax id</label>
                            <input type="text" class="form-control form-control-sm" value="{{ $all_attribute->taxid}}" name="taxid" >
                        </div>

                         <div class="form-group col-md-3 col-sm-3">
                            <label>Status</label>


                            <select class="form-control form-control-sm" name="status" >
                             <option>---Please Select ---</option>
                             <option value="Active" {{$all_attribute->status == 'Active' ? 'selected':''}}>Active</option>

                      <option value="InActive" {{$all_attribute->status == 'InActive' ? 'selected':''}}>InActive</option>


                      </select>
                        </div>

    </div>







                                <button type="submit" class="btn btn-primary btn-lg  waves-effect  btn-sm waves-light mr-1 mt-5">
                                   Submit
                                </button>

            </div> <!-- end col -->


</form>
</div>

</div>
</div>
</div>
