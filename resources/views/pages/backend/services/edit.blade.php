@extends('layouts.backend.master')

@section('content')

<div class="page-title">
    <div class="row gutters">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <h5 class="title">Edit {{ ucfirst($service->name) }}</h5>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="daterange-container pr-5">
                {{-- <a class="btn btn-secondary btn-rounded" href="{{ route('types.create') }}"><span class="icon-add"></span> New Type</a> --}}
            </div>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="icon-area-graph"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('services.index') }}">Service/Occassion</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
                    <form action="{{ route('services.update', $service->slug) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 @error('name') is-invalid @enderror" name="name" placeholder="Type Name" value="{{ old('name') ?? $service->name }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    {{-- <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Type Description" value="{{ old('description') ?? $service->description }}"> --}}
                                    <textarea name="description" id="" cols="30" rows="10" class="form-control @error('description') is-invalid @enderror"
                                    placeholder="Type Description">{{ old('description') ?? $service->description }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <span><code>Recommended maxmimun size is 500x500</code></span>
                                </div>
                                <div class="custom-file pb-4 col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">                                    
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


