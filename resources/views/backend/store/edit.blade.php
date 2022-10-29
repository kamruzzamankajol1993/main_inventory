<div class="modal fade bs-example-modal-lg{{ $all_attribute->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Update Store Information</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
</button>
</div>
<div class="modal-body">
<form class="custom-validation" action="{{ route('store_update') }}" method="post" enctype="multipart/form-data">
@csrf

<div class="row">


    <input type="hidden" name="id" value="{{ $all_attribute->id  }}" class="form-control">

    <div class="col-md-12">
        <div class="mb-3">
            <label for="" class="form-label">Name</label>
            <input type="text" name="name" value="{{ $all_attribute->name  }}" class="form-control"
                   >
        </div>
    </div>
    <div class="col-md-12">
        <div class="mb-3">
            <label for="" class="form-label">Address</label>
            <textarea name="address"  class="form-control">{{ $all_attribute->address  }}</textarea>
        </div>
    </div>

    <div class="col-md-12">
        <div class="mb-3">
            <label for="" class="form-label">Incharge</label>
            <select name="incharge"  class="form-control" id="image">
                <option>--please select--</option>
                @foreach($admin_list as $all_admin_list)
                <option value="{{ $all_admin_list->name }}" {{ $all_attribute->incharge == $all_admin_list->name  ? 'selected':''  }}>{{ $all_admin_list->name }}</option>
                @endforeach
            </select>
        </div>
    </div>



    <div class="col-md-12">
        <button class="btn btn-primary" type="submit">update form</button>
    </div>
</div>


</form>
</div>

</div>
</div>
</div>
