@extends('layouts.app')

@section('content')

    <body class="bg-gradient-warning">
        <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="col-md-5 pt-5">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">{{ __('Reset Password') }}</h1>
                                </div>
                                <form class="user" method="POST" action="{{ route('password.email') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus
                                            placeholder="{{ __('E-Mail Address') }}">
                                    </div>
                                    @error('email')
                                        <p class="text-danger"><small>{{ $message }}</small></p>
                                    @enderror
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Recover
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="/login">Back to login</a>
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
