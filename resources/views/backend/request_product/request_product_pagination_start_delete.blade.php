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
<th>Total Product</th>
<th>Total Quantity</th>
<th>Request date</th>
                            <th>Urgent</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>

            @foreach($product_list as $key=>$all_attribute)
        <tr>
            <td>
                <div class="form-check font-size-16">
                    <input class="form-check-input sub_chk" value="{{$all_attribute->id}}"  data-id="{{$all_attribute->id}}" type="checkbox" id="orderidcheck01">
                    <label class="form-check-label" for="orderidcheck01"></label>
                </div>
            </td>
            <td class="text-body fw-bold">{{ $key+1 }}</td>

            <td>{{ $all_attribute->vendor_id }} </td>
            <td>{{ $all_attribute->total_product }}</td>
            <td>{{ $all_attribute->total_quantity }}</td>
            <td>{{ date('d-m-Y', strtotime($all_attribute->request_date))}}</td>
            <td>{{ $all_attribute->urgent }}</td>
            <td>
                <div class="d-flex gap-1">


                    @if (Auth::guard('admin')->user()->can('request_product_view'))

<a class="btn btn-transparent btn-sm text-success" href="{{ route('request_product_view',$all_attribute->id) }}">
            <i class="mdi mdi-eye font-size-14"></i>
</a>

@endif

                    @if (Auth::guard('admin')->user()->can('request_product_update'))

<a class="btn btn-transparent btn-sm text-success" href="{{ route('request_product_edit',$all_attribute->id) }}">
            <i class="mdi mdi-pencil font-size-14"></i>
</a>

@endif
@if (Auth::guard('admin')->user()->can('request_product_delete'))


                        <button class=" btn btn-transparent btn-sm text-danger"  onclick="deleteTag({{ $all_attribute->id}})"><i
                                    class="mdi mdi-delete font-size-14"></i></button>

                                    <form id="delete-form-{{ $all_attribute->id }}" action="{{ route('request_product_delete',$all_attribute->id) }}" method="POST" style="display: none;">
                                        @method('DELETE')
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
@include('backend.request_product.normal_pagination')
<script type="text/javascript" src="{{ asset('/') }}public/custom_js/request_product_page.js"></script>
<script type="text/javascript" src="{{ asset('/') }}public/custom_js/delete_code.js"></script>
<script type="text/javascript" src="{{ asset('/') }}public/custom_js/request_product_page_search.js"></script>
