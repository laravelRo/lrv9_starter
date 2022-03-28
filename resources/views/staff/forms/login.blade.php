@extends('staff.forms.layout')

@section('content')
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header header-form">
            <h3 class="text-center font-weight-light my-4">Staff authentication</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('staf.auth') }}" method="POST" autocomplete="off">
                @csrf
                <div class="form-floating mb-3">
                    <input name="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail"
                        type="email" placeholder="name@example.com" value="{{ old('email') }}" />
                    <label for="inputEmail">Email address</label>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input name="password" class="form-control @error('password') is-invalid @enderror" id="inputPassword"
                        type="password" placeholder="Password" />
                    <label for="inputPassword">Password</label>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-check mb-3">
                    {{-- <input name="remember" class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                    <label class="form-check-label" for="inputRememberPassword">Remember Password</label> --}}
                </div>
                <div class="d-grid gap-2 col-6 mx-auto mt-3">
                    {{-- <a class="small" href="{{ route('password.request') }}">Forgot Password?</a> --}}
                    <button type="submit" class="btn btn-form">Login</button>
                </div>
            </form>
        </div>
        {{-- <div class="card-footer footer-form text-center py-3">
            <div class="small"><a href="{{ route('register') }}">Need an account? Sign up!</a></div>
        </div> --}}
    </div>
@endsection
