@extends('layouts.backend.master')

@push('additionalCSS')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/dataTables.bs4.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/dataTables.bs4-custom.css') }}" />
@endpush

@push('additionalJS')
    @include('pages.backend.partials.datatables')
    @include('pages.backend.partials.ajax-for-delete')
@endpush

@section('content')

<div class="page-title">
    <div class="row gutters">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <h5 class="title">Inclusion</h5>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="daterange-container pr-5">
                <a class="btn btn-secondary btn-rounded" href="{{ route('inclusions.create') }}"><span class="icon-add"></span>Additional set of Inclusion</a>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="icon-area-graph"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Inclusion</li>
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

                    <div class="table-responsive">
                        <table id="datatables" class="table m-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Features</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($inclusions as $inclusion)
                                <tr>
                                    <td>{{ $inclusion->id }}</td>
                                    <td>{{ $inclusion->name }}</td>
                                    <td>{{ $inclusion->slug }}</td>
                                    <td>
                                        @foreach($inclusion->features->take(3) as $feature)
                                            {{ $loop->first ? '' : ',' }}
                                            {{ $feature->name }}
                                        @endforeach
                                        ...
                                    </td>
                                    <td>
                                        <form action="{{ route('inclusions.update',$inclusion->slug) }}" method="POST">
                                            @csrf
                                            {{ method_field('PUT') }}
                                            <button class="btn {{ $inclusion->is_active == true ? 'btn-outline-success' : 'btn-outline-dark' }} btn-rounded" 
                                                type="submit" name="status" value="{{ $inclusion->slug }}">
                                                    @if($inclusion->is_active == true)
                                                        <small>Active</small>
                                                    @else
                                                        <small>Inactive</small>
                                                    @endif
                                            </button>
                                                        
                                        </form>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown">
                                                <i class="fa fa-cogs mr-2"></i>Actions
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('inclusions.show', $inclusion->slug) }}">View</a>
                                                <a class="dropdown-item" href="{{ route('inclusions.edit', $inclusion->slug) }}">Edit</a>
                                                <a slug="{{ $inclusion->slug }}" href="javascript:;" class="dropdown-item button-delete">Delete</a>
                                                {{-- <form action="{{ route('inclusions.destroy', $inclusion->slug) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item">Delete</button>
                                                </form> --}}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach               
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>


@endsection


