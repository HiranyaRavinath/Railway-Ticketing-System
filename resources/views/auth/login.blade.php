@extends('layouts.app')

@section('content')

    <body class="bg-gradient-warning">
        <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="col-xl-10 col-lg-12 col-md-9 pt-5">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Welcome</h1>
                                        </div>
                                        <form class="user" method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <div class="form-group">
                                                <input type="email" class="form-control form-control-user" name="email"
                                                    value="{{ old('email') }}" required autocomplete="email" autofocus
                                                    placeholder="{{ __('E-Mail Address') }}">
                                            </div>
                                            @error('email')
                                                <p class="text-danger"><small>{{ $message }}</small></p>
                                            @enderror
                                            <div class="form-group">
                                                <input type="password" placeholder="Password"
                                                    class="form-control form-control-user @error('password') is-invalid @enderror"
                                                    name="password" required autocomplete="current-password">
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox small">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck">
                                                    <label class="custom-control-label" for="customCheck">Remember
                                                        Me</label>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                                Login
                                            </button>
                                            <hr>
                                            <a href="/auth/google" class="btn btn-google btn-user btn-block">
                                                <i class="fab fa-google fa-fw"></i> Login with Google
                                            </a>
                                        </form>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="/password/reset">Forgot Password?</a>
                                        </div>
                                        <div class="text-center">
                                            <a class="small" href="/register">Create an Account !</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

        @include('layouts.scripts')
    </body>
@endsection
