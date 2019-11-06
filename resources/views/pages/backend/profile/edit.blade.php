@extends('layouts.backend.master')

@push('additionalCSS')
<style>
    .card-profile-img {
        max-width: 6rem;
        margin-bottom: 1rem;
        border: 3px solid #fff;
        border-radius: 100%;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush

@section('content')
<div class="my-3 my-md-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">My Profile</h3>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-auto">
                                <img class="card-profile-img" src="{{ $user->profile->image }}">
                            </div>
                            <div class="col">
                                <h3 class="mb-1 ">{{ $user->name }}</h3>
                                <p class="mb-4 ">{{ $user->profile->title }}</p>
                            </div>
                        </div>
                        <form action="{{ route('profile.update', $user->id) }}" method="POST">
                            @csrf
                            {{ method_field('PUT') }}
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <div class="form-group">
                                <label class="form-label">Fullname </label>
                                <input class="form-control" type="text" name="name" value="{{ $user->name }}"/>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email-Address </label>
                                <input class="form-control" type="text" name="email" value="{{ $user->email }}"/>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="featured" 
                                    class="custom-control-input" {{ $user->is_featured_to_team ? 'checked' : '' }} id="customSwitch3">
                                    <label class="custom-control-label" for="customSwitch3">Display Profile in Team</label>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary" name="action" value="user">Save Profile</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <form class="card" action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="card-header">
                        <h3 class="card-title">Edit Profile</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            {{-- @if(auth()->user()->isOwner()) --}}
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group flex">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control" name="title"  value="{{ old('title') ?? $user->profile->title }}">
                                </div>
                            </div>
                            {{-- @endif --}}

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">About Me</label>
                                    <textarea rows="5" class="form-control" name="about" value="Enter About your description">{{ strip_tags($user->profile->about) }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                        </div>
                                        <div class="custom-file pb-4">
                                            <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="inputBannerImage" name="image" aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label" for="inputBannerImage">Update Profile</label>
                                        </div>
                                    </div>
                                    <div class="pt-2 pb-2">
                                        <small class="text-muted">
                                            Must be a valid image.
                                        </small>
                                    </div>
                                    @error('image')
                                    <p><code>{{ $message }}</code></p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group flex">
                                    <label class="form-label">Facebook</label>
                                    <input type="text" class="form-control" name="facebook" placeholder="www.facebook.com/user"  value="{{ old('facebook') ?? $user->profile->facebook }}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Twitter</label>
                                    <input type="text" class="form-control" name="twitter" placeholder="www.twitter.com/user"   value="{{ old('twitter') ?? $user->profile->twitter }}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Instagram</label>
                                    <input type="text" class="form-control" name="instagram" placeholder="www.instagram.com/user"   value="{{ old('instagram') ?? $user->profile->instagram }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary" name="action" value="profile">Update Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection