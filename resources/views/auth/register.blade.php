@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 auth-modal mt-5">
            <div class="d-flex flex-column g-5 mt-5">
                <h2 class="text-center fw-bold mb-5">{{ __('Register your account here!') }}</h2>
                <div class="card border-0">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between">
                            <div class="w-50 user-signup"></div>
                            <div class="w-50 p-5">
                                <h2 class="text-left fw-bold mt-3 mb-5">{{ __("Enter your information") }}</h2>
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="row mb-4">
                                        <label for="name" class="col-12 col-form-label fw-bold text-md-right">{{ __('NAME') }}</label>
        
                                        <div class="col-12">
                                            <input id="name" type="text" class="form-control p-3 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
        
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <div class="row mb-4">
                                        <label for="email" class="col-12 col-form-label fw-bold text-md-right">{{ __('EMAIL ADDRESS') }}</label>
        
                                        <div class="col-12">
                                            <input id="email" type="email" class="form-control p-3 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
        
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <div class="row mb-4">
                                        <label for="password" class="col-12 col-form-label fw-bold text-md-right">{{ __('PASSWORD') }}</label>
        
                                        <div class="col-12">
                                            <input id="password" type="password" class="form-control p-3 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
        
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <div class="row mb-4">
                                        <label for="password-confirm" class="col-12 col-form-label fw-bold text-md-right">{{ __('CONFIRM PASSWORD') }}</label>
        
                                        <div class="col-12">
                                            <input id="password-confirm" type="password" class="form-control p-3" name="password_confirmation" required autocomplete="new-password">
                                        </div>
        
                                        <div class="form-group row">
                                            <label class="col-12 col-form-label fw-bold text-md-right">Laravel Google Recaptcha</label>
                                            <div class="col-12"> {!! htmlFormSnippet() !!} </div>
                                        </div>
                                    </div>

                                    <div class="row mb-5">
                                        <div class="col-12 d-grid">
                                            <button type="submit" class="btn btn-warning p-3 text-light fw-bolder fs-4">
                                                {{ __('Register') }}
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="d-flex justify-content-center">
                                            <p>Already a member? <a class="text-warning text-decoration-none fw-bold" href="{{ route('login') }}">Sign In</a></p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
