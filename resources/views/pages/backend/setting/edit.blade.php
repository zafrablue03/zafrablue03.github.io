@extends('layouts.backend.master')

@push('additionalCSS')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/select2.min.css') }}" />
@endpush

@push('additionalJS')
    <script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#type').select2({
                    minimumResultsForSearch: Infinity
                });
        });
    </script>
@endpush

@section('content')

<div class="page-title">
    <div class="row gutters">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <h5 class="title">Edit {{ ucfirst($setting->name) }}</h5>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="icon-area-graph"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('settings.index') }}">Setting</a></li>
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
                    <form action="{{ route('settings.update', $setting->slug) }}" method="POST">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="row gutters">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                <div class="col-lg-10">
                                        <div class="form-group">
                                            <label for="inputName">Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Setting Name" value="{{ old('name') ?? $setting->name }}">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="inputName">Description</label>
                                            <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Setting Description" value="{{ old('description') ?? $setting->description }}">
                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                                <label for="inputName">Price</label>
                                                <span>&#8369; </span>
                                                <input type="number" class="form-control @error('price') is-invalid @enderror" min="0.00" max="10000.00" step="0.01" name="price" value="{{ old('description') ?? number_format($setting->price, 2) }}"/>
                                                @error('price')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        <div class="form-group">
                                            <label class="form-label">Types</label>
                                            <p><code>Select Course' Type/Types</code></p>
                                            <select name="type[]" id="type" class="form-control" multiple>
                                                @foreach($types as $key => $value)
                                                    <option value="{{ $key }}"
                                                    @foreach($setting->types as $type)
                                                        @if($key === $type->id)
                                                            selected="selected"
                                                        @endif
                                                    @endforeach
                                                    >{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
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

