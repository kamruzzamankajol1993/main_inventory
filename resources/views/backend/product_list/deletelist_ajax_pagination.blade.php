<ul class="pagination pagination-rounded justify-content-end mb-2">
    {{-- <li class="page-item active" aria-current="page">
      <span class="page-link">1</span>
    </li> --}}

    <!--check total number greater than 10  -->
    @if($total_serial_number_delete > 10)

    <!--previous button work -->
    @if($id_for_pass_delete == 1)

    <li class="page-item disabled">
      <button  class="page-link" id="papage_link_delete"> <i class="mdi mdi-chevron-left"></i></button>
  </li>

    @else
    <li class="page-item ">
      <button  class="page-link" id="papage_link_delete{{ $id_for_pass_delete }}"> <i class="mdi mdi-chevron-left"></i></button>
  </li>
  @endif
<!--end previous button work-->

    @for($i = 1; $i <= $total_serial_number_delete; $i++)

    <!-- 1 to 5 code --->
    <!-- end 1 to 5 code --->

    @if($i == 1)
    @if($i == $id_for_pass_delete)
    <li class="page-item active">
      <button  class="page-link" id="apage_link_delete{{ $i }}">{{ $i }}</button>
  </li>
  @else
  <li class="page-item ">
      <button  class="page-link" id="apage_link_delete{{ $i }}">{{ $i }}</button>
  </li>
  @endif
    @elseif($i == 2)
    @if($i == $id_for_pass_delete)
    <li class="page-item active">
      <button  class="page-link" id="apage_link_delete{{ $i }}">{{ $i }}</button>
  </li>
  @else
  <li class="page-item ">
      <button  class="page-link" id="apage_link_delete{{ $i }}">{{ $i }}</button>
  </li>
  @endif
  @elseif($i == 3)
  @if($i == $id_for_pass_delete)
    <li class="page-item active">
      <button  class="page-link" id="apage_link_delete{{ $i }}">{{ $i }}</button>
  </li>
  @else
  <li class="page-item ">
      <button  class="page-link" id="apage_link_delete{{ $i }}">{{ $i }}</button>
  </li>
  @endif
  @elseif($i == 4)
  @if($i == $id_for_pass_delete)
    <li class="page-item active">
      <button  class="page-link" id="apage_link_delete{{ $i }}">{{ $i }}</button>
  </li>
  @else
  <li class="page-item ">
      <button  class="page-link" id="apage_link_delete{{ $i }}">{{ $i }}</button>
  </li>
  @endif

  @elseif($i == 5)
  @if($i == $id_for_pass_delete)
    <li class="page-item active">
      <button  class="page-link" id="apage_link_delete{{ $i }}">{{ $i }}</button>
  </li>
  <li class="page-item ">
      <button  class="page-link" id="apage_link_delete{{ $i+1 }}">{{ $i+1 }}</button>
  </li>
  <li class="page-item ">
      <button  class="page-link" >.</button>
  </li>
  <li class="page-item ">
      <button  class="page-link" >.</button>
  </li>
  @else
  <li class="page-item ">
      <button  class="page-link" id="apage_link_delete{{ $i }}">{{ $i }}</button>
  </li>
  @if($id_for_pass_delete == 6 || $id_for_pass_delete == 7 )

   @else

  <li class="page-item ">
      <button  class="page-link" >.</button>
  </li>
  <li class="page-item ">
      <button  class="page-link" >.</button>
  </li>
  @endif
  @endif

  @elseif($i == $id_for_pass_delete)
  @if($i == $id_for_pass_delete)
  @if($id_for_pass_delete == $total_serial_number_delete || $id_for_pass_delete == ($total_serial_number_delete - 1))

  @else

  @if($id_for_pass_delete == 6)

   @else
  <li class="page-item">
      <button  class="page-link" id="apage_link_delete{{ $i-1 }}">{{ $i-1 }}</button>
  </li>
  @endif
@endif
<!-- main -->
    <li class="page-item active">
      <button  class="page-link" id="apage_link_delete{{ $i }}">{{ $i }}</button>
  </li>
<!--main-->
  @if($id_for_pass_delete == $total_serial_number_delete || $id_for_pass_delete == ($total_serial_number_delete - 1) || $id_for_pass_delete == ($total_serial_number_delete - 2) || $id_for_pass_delete == ($total_serial_number_delete - 3)  )

  @else
  <li class="page-item">
      <button  class="page-link" id="apage_link_delete{{ $i+1 }}">{{ $i+1 }}</button>
  </li>
@endif
@if($id_for_pass_delete == $total_serial_number_delete || $id_for_pass_delete == ($total_serial_number_delete - 1) || $id_for_pass_delete == ($total_serial_number_delete - 2) || $id_for_pass_delete == ($total_serial_number_delete - 3) || $id_for_pass_delete == ($total_serial_number_delete - 4) )



@else
  <li class="page-item ">
      <button  class="page-link" >.</button>
  </li>
  <li class="page-item ">
      <button  class="page-link" >.</button>
  </li>
  @endif


  @else
  <li class="page-item ">
      <button  class="page-link" id="apage_link_delete{{ $i }}">{{ $i }}</button>
  </li>
  {{-- <li class="page-item ">
      <button  class="page-link" >.</button>
  </li>
  <li class="page-item ">
      <button  class="page-link" >.</button>
  </li> --}}
  @endif

  @elseif($i == ($total_serial_number_delete-2) )

  @if($i == $id_for_pass_delete)

    <li class="page-item active">
      <button  class="page-link" id="apage_link_delete{{ $i }}">{{ $i }}</button>
  </li>

  @else
  <li class="page-item ">
      <button  class="page-link" id="apage_link_delete{{ $i }}">{{ $i }}</button>
  </li>
  @endif
  @elseif($i == ($total_serial_number_delete-1) )
  @if($i == $id_for_pass_delete)
    <li class="page-item active">
      <button  class="page-link" id="apage_link_delete{{ $i }}">{{ $i }}</button>
  </li>
  @else
  <li class="page-item ">
      <button  class="page-link" id="apage_link_delete{{ $i }}">{{ $i }}</button>
  </li>
  @endif
  @elseif($i == $total_serial_number_delete )
  @if($i == $id_for_pass_delete)
    <li class="page-item active">
      <button  class="page-link" id="apage_link_delete{{ $i }}">{{ $i }}</button>
  </li>
  @else
  <li class="page-item ">
      <button  class="page-link" id="apage_link_delete{{ $i }}">{{ $i }}</button>
  </li>
  @endif

  @endif
  @endfor
<!--next button work -->
@if($id_for_pass_delete == $total_serial_number_delete)
<li class="page-item disabled">
<button  class="page-link disabled" id="napage_link_delete"> <i class="mdi mdi-chevron-right"></i></button>
</li>
@else
<li class="page-item ">
<button  class="page-link" id="napage_link_delete{{ $id_for_pass_delete }}"> <i class="mdi mdi-chevron-right"></i></button>
</li>
@endif
<!--end next button work-->

    @else
    <!--end check total number greatee than 10 -->
        <!--check total number smaller than 10  -->
        <!--previous button work -->
        @if($id_for_pass_delete == 1)

    <li class="page-item disabled">
      <button  class="page-link" id="papage_link_delete"> <i class="mdi mdi-chevron-left"></i></button>
  </li>

    @else
    <li class="page-item ">
      <button  class="page-link" id="papage_link_delete{{ $id_for_pass_delete }}"> <i class="mdi mdi-chevron-left"></i></button>
  </li>
  @endif
<!--end previous button work-->
    @for($i = 1; $i <= $total_serial_number_delete; $i++)



    @if($i == 1)
    @if($id_for_pass_delete == 1)
    <li class="page-item active">
      <button  class="page-link" id="apage_link_delete{{ $i }}">{{ $i }}</button>
  </li>
  @else

  <li class="page-item ">
      <button  class="page-link" id="apage_link_delete{{ $i }}">{{ $i }}</button>
  </li>
  @endif
  @else

  @if($i == $id_for_pass_delete)

  <li class="page-item active">
      <button  class="page-link" id="apage_link_delete{{ $i }}" >{{ $i }}</button>
  </li>

  @else
  <li class="page-item">
      <button  class="page-link" id="apage_link_delete{{ $i }}" >{{ $i }}</button>
  </li>
@endif

@endif


  @endfor
     <!--end check total number smaller than 10  -->
<!--next button work -->

@if($id_for_pass_delete == $total_serial_number_delete)
<li class="page-item disabled">
<button  class="page-link disabled" id="napage_link_delete"> <i class="mdi mdi-chevron-right"></i></button>
</li>
@else
<li class="page-item ">
<button  class="page-link" id="napage_link_delete{{ $id_for_pass_delete }}"> <i class="mdi mdi-chevron-right"></i></button>
</li>
@endif
<!--end next button work-->
  @endif
  </ul>
