@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 auth-modal mt-5">
                <div class="d-flex flex-column g-5 mt-5">
                    <h2 class="text-center fw-bold mb-5">{{ __('Welcome Back!') }}</h2>
                    <div class="card border-0">
                        <div class="card-body p-0">
                            <div class="d-flex justify-content-between">
                                <div class="w-50 user-login"></div>
                                <div class="w-50 p-5">
                                    <h2 class="text-left fw-bold mt-3 mb-5">{{ __("Sign In") }}</h2>
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="row mb-4">
                                            <label for="email"
                                                class="col-12 col-form-label text-md-right fw-bold">{{ __('EMAIL ADDRESS') }}</label>
            
                                            <div class="col-12">
                                                <input id="email" type="email" class="form-control p-3 @error('email') is-invalid @enderror"
                                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
            
                                        <div class="row mb-4">
                                            <label for="password"
                                                class="col-12 col-form-label fw-bold">{{ __('PASSWORD') }}</label>
            
                                            <div class="col-12">
                                                <input id="password" type="password"
                                                    class="form-control p-3 @error('password') is-invalid @enderror" name="password"
                                                    required autocomplete="current-password">
            
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
            
                                        <div class="row mb-4">
                                            <div class="col-12 d-grid">
                                                <button type="submit" class="btn btn-warning p-3 text-light fw-bolder fs-4">
                                                    {{ __('Sign In') }}
                                                </button>
                                            </div>
                                        </div>

                                        <div class="row mb-5">
                                            <div class="col-12 col-lg-6">
                                                <div class="form-check p-0 auth-checkbox">
                                                    <input type="checkbox" value="remember" name="remember"
                                                        id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    <label for="remember" class="pseudo-label"></label>
                                                    <label class="form-check-label text-warning px-2" for="remember">
                                                        {{ __('Remember Me') }}
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                @if (Route::has('password.request'))
                                                    <a class="float-end p-0 text-decoration-none text-dark" href="{{ route('password.request') }}">
                                                        {{ __('Forgot Password?') }}
                                                    </a>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="d-flex justify-content-center">
                                                <p>Not a member? <a class="text-warning text-decoration-none fw-bold" href="{{ route('register') }}">Sign Up</a></p>
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
