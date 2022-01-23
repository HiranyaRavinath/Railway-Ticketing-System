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
                                            <h1 class="h4 text-gray-900 mb-4">Register</h1>
                                        </div>
                                        <form class="user" method="POST" action="{{ route('register') }}">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-user" name="name"
                                                    value="{{ old('name') }}" required autocomplete="email" autofocus
                                                    placeholder="Your name">
                                            </div>
                                            @error('name')
                                                <p class="text-danger"><small>{{ $message }}</small></p>
                                            @enderror
                                            <div class="form-group">
                                                <input type="email" class="form-control form-control-user" name="email"
                                                    value="{{ old('email') }}" required autocomplete="email" autofocus
                                                    placeholder="{{ __('E-Mail Address') }}">
                                            </div>
                                            @error('email')
                                                <p class="text-danger"><small>{{ $message }}</small></p>
                                            @enderror
                                            <div class="form-group">
                                                <input type="password"
                                                    class="form-control form-control-user @error('password') is-invalid @enderror"
                                                    name="password" placeholder="Password" required
                                                    autocomplete="current-password">
                                            </div>
                                            @error('password')
                                                <p class="text-danger"><small>{{ $message }}</small></p>
                                            @enderror
                                            <div class="form-group">
                                                <input type="password"
                                                    class="form-control form-control-user @error('password_confirmation') is-invalid @enderror"
                                                    name="password_confirmation" placeholder="Retype Password" required>
                                            </div>
                                            @error('password_confirmation')
                                                <p class="text-danger"><small>{{ $message }}</small></p>
                                            @enderror
                                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                                Register
                                            </button>
                                        </form>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="/login">Already have an account, Back to login</a>
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
