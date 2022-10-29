<input type="hidden" value="{{ $search_value }}" id="search_value" />
@include('backend.vendor.normal_pagination')

<script type="text/javascript" src="{{ asset('/') }}public/custom_js/vendor_page_search.js"></script>
<script type="text/javascript" src="{{ asset('/') }}public/custom_js/delete_code.js"></script>
