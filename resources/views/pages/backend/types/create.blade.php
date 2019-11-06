@extends('layouts.backend.master')

@section('content')
<div class="content-wrapper">
    <div class="page-title">
        <div class="row gutters">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <h5 class="title">Courses' Types</h5>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="daterange-container pr-5">
                    <a class="btn btn-secondary btn-rounded" href="{{ route('types.create') }}"><span class="icon-add"></span> New Type</a>
                </div>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="icon-area-graph"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('types.index') }}">Types</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Row start -->
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('types.store') }}" method="POST">
                        @csrf
                        <div class="row gutters">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                <div class="form-group">
                                    <label for="inputName">Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Type Name" value="{{ old('name') }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Description</label>
                                    <textarea name="description"placeholder="Type Description" 
                                    class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-secondary btn-rounded">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection