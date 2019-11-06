@extends('layouts.backend.master')

@section('content')

<div class="page-title">
    <div class="row gutters">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <h5 class="title">{{ ucfirst($setting->name) }}</h5>
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
                    <li class="breadcrumb-item"><a href="{{ route('settings.index') }}">Setting</a></li>
                    <li class="breadcrumb-item active" aria-current="page">View</li>
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
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
							<div class="card">
								<div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"><h5>ID</h5></label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly class="form-control" id="inputReadOnly" value="{{ $setting->id }}">
                                        </div>
                                    </div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label"><h5>Name</h5></label>
										<div class="col-sm-10">
											<input type="text" readonly class="form-control" value="{{ $setting->name }}">
										</div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"><h5>Slug</h5></label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly class="form-control" value="{{ $setting->slug }}">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
										<label class="col-sm-2 col-form-label"><h5>Description</h5></label>
										<div class="col-sm-10">
											<input type="text" readonly class="form-control" value="{{ $setting->description }}">
										</div>
                                    </div>
                                    <div class="form-group row">
                                            <label class="col-sm-2 col-form-label"><h5>Price</h5></label>
                                            <div class="col-sm-10">
                                                <input type="text" readonly class="form-control" value="&#8369;  {{ number_format($setting->price, 2) }}">
                                            </div>
                                        </div>
                                    <div class="form-group row">
                                            <label for="type" class="col-sm-2 col-form-label"><h5>Package</h5></label>
                                            <div class="col-sm-10">
                                                @foreach($setting->types as $type)
                                                <span class="badge badge-pill badge-light" id="type"><a href="{{ route('types.show',$type->slug) }}">{{ $type->name }}</a></span>
                                                @endforeach
                                            </div>
                                        </div>
                                    <div class="pt-3">
                                        <a href="{{ route('settings.edit', $setting->slug) }}"class="btn btn-secondary btn-rounded" style="float:left"> Edit </a>
                                    </div>
								</div>
							</div>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection