@extends('backend.master.master')

@section('title')
Media Center
@endsection


@section('css')

@endsection

@section('body')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Media Center Information</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    {{-- <li class="breadcrumb-item"><a href="javascript: void(0);"> </a></li> --}}
                    <li class="breadcrumb-item active">Product All Image</li>
                </ol>
            </div>

        </div>
    </div>

</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">



                <div class="popup-gallery d-flex flex-wrap">

                    @foreach($feature_image_list as $all_feature_image)
                    <a href="{{ asset('/') }}{{ $all_feature_image->filename }}" title="Image">
                        <div class="img-fluid">
                            <img src="{{ asset('/') }}{{ $all_feature_image->filename }}" alt="" width="120">
                        </div>
                    </a>
@endforeach
@foreach($main_image_list as $all_feature_image)
<a href="{{ asset('/') }}{{ $all_feature_image->filename }}" title="Image">
    <div class="img-fluid">
        <img src="{{ asset('/') }}{{ $all_feature_image->filename }}" alt="" width="120">
    </div>
</a>
@endforeach

                </div>

            </div>
        </div>
    </div> <!-- end col -->
</div>
@endsection

@section('script')

@endsection
