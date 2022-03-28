@extends('admin.forms.layout')
@section('meta_title', 'Register form')

@section('content')
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header header-form">
            <h3 class="text-center font-weight-light my-4">Register</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="form-floating mb-3">
                    <input name="name" class="form-control @error('name') is-invalid @enderror" id="name" type="text"
                        placeholder="Your user name on site" />
                    <label for="name">Name</label>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" type="text"
                        placeholder="Your user name on site" />
                    <label for="phone">Phone</label>
                    @error('phone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input name="email" class="form-control  @error('email') is-invalid @enderror" id="email" type="email"
                        placeholder="name@example.com" />
                    <label for="email">Email address</label>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="d-flex justify-content-between">
                    <div class="form-floating mb-3">
                        <input name="password" class="form-control  @error('password') is-invalid @enderror" id="password"
                            type="password" placeholder="Password" />
                        <label for="password">Password</label>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input name="password_confirmation"
                            class="form-control @error('password_confirmation') is-invalid @enderror"
                            id="password_confirmation" type="password" placeholder="Password_confirmation" />
                        <label for="password_confirmation">Password confirmation</label>
                        @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>


                <div class="d-grid gap-2 col-6 mx-auto mt-3">
                    <button type="submit" class="btn btn-form">Register</button>
                </div>
            </form>
        </div>
        <div class="card-footer footer-form text-center py-3">
            <div class="small"><a href="{{ route('login') }}">Have an account? Go to login</a></div>
        </div>
    </div>
@endsection
