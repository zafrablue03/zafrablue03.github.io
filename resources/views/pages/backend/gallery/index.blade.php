@extends('layouts.backend.master')


@section('content')
<div class="page-title">
    <div class="row gutters">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <h5 class="title">Events Gallery</h5>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="daterange-container">
                {{-- <a href="#" data-toggle="tooltip" data-placement="top" title="Download CSV" class="download-reports">
                    <i class="icon-download1"></i>
                </a> --}}
                <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <select name="service" class="form-control">
                            @if(!empty($services))
                                @foreach($services->pluck('name', 'id') as $key => $value)
                                    <option value="{{ $key }}"> {{ $value }} </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror" id="inputGroupFile02">
                                <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <button type="submit" class="input-group-text" id="inputGroupFileAddon02">Upload</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- Page header end -->


<!-- Content wrapper start -->
<div class="content-wrapper">

    <!-- Gallery start -->
    <div class="baguetteBoxThree gallery">
        <!-- Row start -->
        @foreach($services as $service)
        <h4>{{ $service->name }}</h4>
            <div class="row gutters">
                @if(!empty($service->images))
                    @foreach($service->images as $image)
                        <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-6">
                            <a href="{{ $image->url }}" class="effects">
                                <img src="{{ $image->thumbnail }}" class="img-fluid" alt="Triple-E">
                                <div class="overlay">
                                    <span class="expand">+</span>
                                </div>
                            </a>
                            <form action="{{ route('gallery.destroy',$image->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn-danger" type="submit" style="float:right" onclick="return confirm('Are you sure you want to delete it?');"><span class="icon-trash"></span></button>
                            </form>
                        </div>
                    @endforeach
                @endif
            </div>
        @endforeach
        <!-- Row end -->
    </div>
    <!-- Gallery end -->


</div>
@endsection
@push('additionalCSS')
    <link rel="stylesheet" href="{{ asset('assets/vendor/gallery/gallery.css') }}" />
@endpush
@push('additionalJS')
    <script src="{{ asset('assets/vendor/gallery/baguetteBox.js') }}" async></script>
    <script src="{{ asset('assets/vendor/gallery/plugins.js') }}" async></script>
    <script src="{{ asset('assets/vendor/gallery/custom-gallery.js') }}" async></script>
@endpush

