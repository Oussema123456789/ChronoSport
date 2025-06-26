@extends('layouts.app')

@section('content')
<section class="text-center text-lg-start">
  <div class="container py-5">
    <div class="row justify-content-center align-items-center">
      <div class="col-lg-8">
        <div class="card cascading-right shadow-lg border-0 rounded-5">
          <div class="row g-0">
<div class="col-md-5 d-none d-md-block">
  <img src="img/platforme4.png"
       alt="Platform image"
       style="object-fit: cover;height: 400px;width: 50%; "
       class="img-fluid rounded w-100 wow zoomIn"
       data-wow-delay="0.1s" />
</div>


            <div class="col-md-7 p-4">
              <h3 class="fw-bold mb-4 text-center">{{ __('Login') }}</h3>

              <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-outline mb-3">
                  <label class="form-label" for="email">{{ __('Email Address') }}</label>
                  <input id="email" type="email" name="email"
                         class="form-control form-control-sm @error('email') is-invalid @enderror"
                         value="{{ old('email') }}" required autocomplete="email" autofocus />
                  @error('email')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-outline mb-3">
                  <label class="form-label" for="password">{{ __('Password') }}</label>
                  <input id="password" type="password" name="password"
                         class="form-control form-control-sm @error('password') is-invalid @enderror"
                         required autocomplete="current-password" />
                  @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-3 form-check">
                  <input class="form-check-input" type="checkbox" name="remember" id="remember"
                         {{ old('remember') ? 'checked' : '' }}>
                  <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                  </label>
                </div>

                <div class="d-grid">
                  <button type="submit" class="btn btn-primary btn-sm">{{ __('Login') }}</button>
                </div>

                @if (Route::has('password.request'))
                  <div class="text-end mt-2">
                    <a class="text-muted small" href="{{ route('password.request') }}">
                      {{ __('Forgot Your Password?') }}
                    </a>
                  </div>
                @endif
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
