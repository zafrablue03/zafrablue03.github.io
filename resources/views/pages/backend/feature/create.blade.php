@extends('layouts.backend.master')

@push('additionalCSS')
    <link rel="stylesheet" href="{{ asset('assets/vendor/bs-select/bs-select.css') }}" />
@endpush

@push('additionalJS')

    <script src="{{ asset('assets/vendor/bs-select/bs-select.min.js') }}"></script>
@endpush

@section('content')

<div class="page-title">
    <div class="row gutters">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <h5 class="title">New Feature</h5>
        </div>
        {{-- <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="daterange-container pr-5">
                <a class="btn btn-secondary btn-rounded" href="{{ route('types.create') }}"><span class="icon-add"></span> New Type</a>
            </div>
        </div> --}}
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="icon-area-graph"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('features.index') }}">Features</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
    
<div class="content-wrapper">
    <!-- Row start -->
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('features.store') }}" method="POST">
                        @csrf
                        <div class="row gutters">
                            <div class="col-xl-5 col-lg-6 col-md-4 col-sm-4 col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Type Name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="pt-3">
                                    <button type="submit" name="action" value="save" class="btn btn-secondary btn-rounded">Save</button>
                                    <button type="submit" name="action" value="continue" class="btn btn-secondary btn-rounded">Save & Continue</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection


