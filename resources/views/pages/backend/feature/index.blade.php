@extends('layouts.backend.master')

@push('additionalCSS')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/dataTables.bs4.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/dataTables.bs4-custom.css') }}" />
@endpush

@push('additionalJS')
    <script src="{{ asset('assets/vendor/datatables/dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap.min.js') }}"></script>

    <!-- Custom Data tables -->
    <script src="{{ asset('assets/vendor/datatables/custom/custom-datatables.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/custom/fixedHeader.js') }}"></script>
    <script>
        $(function(e) {
            $('#table-features').DataTable();
        } );
    </script>
@endpush

@section('content')

<div class="page-title">
    <div class="row gutters">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <h5 class="title">Features</h5>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="daterange-container pr-5">
                <a class="btn btn-secondary btn-rounded" href="{{ route('features.create') }}"><span class="icon-add"></span>New Feature</a>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="icon-area-graph"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Features</li>
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
                        <table id="table-features" class="table m-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($features as $feature)
                                <tr>
                                    <td>{{ $feature->id }}</td>
                                    <td>{{ $feature->name }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown">
                                                <i class="fa fa-cogs mr-2"></i>Actions
                                            </button>
                                            <div class="dropdown-menu">
                                                {{-- <a class="dropdown-item" href="{{ route('features.show', $feature->slug) }}">View</a> --}}
                                                <a class="dropdown-item" href="{{ route('features.edit', $feature->id) }}">Edit</a>
                                                <form action="{{ route('features.destroy', $feature->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure about this?');">Delete</button>
                                                </form>
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


