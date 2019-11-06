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
            <h5 class="title">Create Course</h5>
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
                    <li class="breadcrumb-item"><a href="{{ route('courses.index') }}">Courses</a></li>
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
                    <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row gutters">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                <div class="form-group">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Course Name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Course Description" value="{{ old('description') }}">
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <select class="form-control selectpicker @error('type_id') is-invalid @enderror" data-style="btn-info" name="type_id" required>
                                        <option selected disabled>Select Type</option>
                                        @foreach($types as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>

                                    @error('type_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>Type field is required</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <span><code>Recommended maxmimun size is 500x500</code></span>
                                </div>

                                <div class="custom-file pb-4">
                                    <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="inputGroupFile01" name="image" aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    @error('image')
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


