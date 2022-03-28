@extends('admin.forms.layout')

@section('content')
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header header-form">
            <h3 class="text-center font-weight-light my-4">Reset password request</h3>
        </div>
        <div class="card-body">
            <form>
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

                <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                    <a class="small" href="password.html"></a>
                    <a class="btn btn-form" href="index.html">Send email</a>
                </div>
            </form>
        </div>
        <div class="card-footer footer-form text-center py-3">
            <div class="small"><a href="{{ route('register') }}">Need an account? Sign up!</a></div>
        </div>
    </div>
@endsection
