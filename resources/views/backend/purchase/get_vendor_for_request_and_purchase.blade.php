@if($main_value == 'Add New Vendor')
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

@else

<tbody>
    <tr>
        <td>Name:</td>
        <td><input class="form-control col-lg-12 name" value="{{ $vendor_detail->name }}" name="name" id="name"
                   type="text" ></td>
    </tr>
    <tr>
        <td>Phone No:</td>
        <td><input class="form-control col-lg-12 mobile_number"
                   name="mobile_number" value="{{ $vendor_detail->phone_number }}"  id="mobile_number" type="text"

            ></td>
    </tr>
    <tr>
        <td>Address:</td>
        <td><input class="form-control col-lg-12 address" name="address" value="{{ $vendor_detail->address }}"
                   id="address" type="text" ></td>
    </tr>
    </tbody>

@endif
