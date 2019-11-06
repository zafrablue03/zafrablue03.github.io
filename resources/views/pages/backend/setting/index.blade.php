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
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <h5 class="title">Setting</h5>
        </div>
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">
            <div class="daterange-container pr-5">
                <a class="btn btn-secondary btn-rounded" href="{{ route('settings.create') }}"><span class="icon-add"></span> New Setting</a>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="icon-area-graph"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Setting</li>
                </ol>
            </nav>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
            <div class="daterange-container pr-5">
                <a href="" class="btn btn-secondary btn-rounded mb-4" data-toggle="modal" data-target="#datetime">
                    New Date time
                </a>
                @include('pages.backend.partials.modals')
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Date time</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
    
<div class="content-wrapper">
    <!-- Row start -->
    <div class="row gutters">
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">
            
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="datatables" class="table m-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Description</th>
                                    <th>Menus</th>
                                    <th>Price per Pax</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($settings as $setting)
                                <tr>
                                    <td>{{ $setting->id }}</td>
                                    <td>{{ $setting->name }}</td>
                                    <td>{{ $setting->slug }}</td>
                                    <td>{{ $setting->description }}</td>
                                    <td>
                                        @foreach($setting->types as $type)
                                        {{ $loop->first ? '' : ',' }}
                                        {{ $type->name }}
                                        @endforeach
                                        ...
                                    </td>
                                    <td>&#8369; {{ number_format($setting->price,2) }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown">
                                                <i class="fa fa-cogs mr-2"></i>Actions
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('settings.show', $setting->slug) }}">View</a>
                                                <a class="dropdown-item" href="{{ route('settings.edit', $setting->slug) }}">Edit</a>
                                                <a slug="{{ $setting->slug }}" href="javascript:;" class="dropdown-item button-delete">Delete</a>
                                                {{-- <form action="{{ route('settings.destroy', $setting->slug) }}" method="POST">
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
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
            <div class="list-group justify-content-between">
                @foreach($datetimes->take(4) as $datetime)
                    <div class="d-flex">
                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            {{ $datetime->name }}
                            <span class="badge badge-secondary badge-pill">{{ $datetime->time }}</span>
                        </a>
                        <form action="{{ route('datetime.delete', $datetime->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-rounded" onclick="return confirm('Are you sure you want to delete this?');"><span class="icon-trash"></span></button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>


@endsection

@push('additionalJS')
    @if (count($errors) > 0)
    <script>
        $(function() {
            $( "#datetime" ).modal('show');
        });
    </script>
    @endif
@endpush


