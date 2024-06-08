@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Profile</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">{{ __('Dashboard') }}</a></div>
                <div class="breadcrumb-item">{{ __('Profile') }}</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Hi, Ujang!</h2>
            <p class="section-lead">
                {{ __('Change information about yourself on this page.') }}
            </p>

            <div class="row mt-sm-4">

                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <form method="post" action="{{ route('admin.profile.update', $user->id) }}"
                            class="needs-validation" novalidate="" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-header">
                                <h4>{{ __('Edit Profile') }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group col-md-12 col-12">
                                    <div id="image-preview" class="image-preview">
                                        <label for="image-upload" id="image-label">{{ __('Choose File') }}</label>
                                        <input type="file" name="image" id="image-upload">

                                    </div>
                                    @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12 col-12">
                                    <label>{{ __('Name') }}</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}"
                                        name="name">
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12 col-12">
                                    <label>{{ __('Email') }}</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}" required=""
                                        name="email">
                                        
                                    
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror           
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">{{ __('Save Changes') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <form method="PUT" action="" class="needs-validation" novalidate="">
                            @csrf
                            <div class="card-header">
                                <h4>{{ __('Update Password') }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group col-md-12 col-12">
                                    <label>{{ __('Old Password') }}</label>
                                    <input type="password" class="form-control" value="" required=""
                                        name="name">
                                    <div class="invalid-feedback">
                                        {{ __('Your old password') }}
                                    </div>
                                </div>
                                <div class="form-group col-md-12 col-12">
                                    <label>{{ __('New Password') }}</label>
                                    <input type="password" class="form-control" value="" required=""
                                        name="new-password">
                                    <div class="invalid-feedback">
                                        {{ __('Your New password') }}
                                    </div>
                                </div>
                                <div class="form-group col-md-12 col-12">
                                    <label>{{ __('Confirm Password') }}</label>
                                    <input type="password" class="form-control" value="" required=""
                                        name="password-confirmation">
                                    <div class="invalid-feedback">
                                        {{ __('Confirm password') }}
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">{{ __('Save Changes') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            $('.image-preview').css({
                "background-image": "url({{ asset($user->image) }})",
                "background-size": "cover",
                "background-position": "center center",
            });
        })
    </script>
@endpush


