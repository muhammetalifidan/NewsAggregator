@extends('layouts.app')
@section('content')
    <!-- Content area -->
    <div class="content d-flex justify-content-center align-items-center">

        <!-- Register form -->
        <form class="login-form" action="{{ route('admin.register') }}" method="POST">
            @csrf
            <div class="card mb-0">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif

                    <div class="text-center mb-3">
                        <div class="d-inline-flex align-items-center justify-content-center mb-4 mt-2">
                            <img src="{{ asset('assets/images/favicon.png') }}" style="height: 100px; width:auto"
                                class="h-88px" alt="">
                        </div>
                        <h5 class="mb-0">Create account</h5>
                        <span class="d-block text-muted">All fields are required</span>
                    </div>

                    <div class="text-center text-muted content-divider mb-3">
                        <span class="px-2">Your credentials</span>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <div class="form-control-feedback form-control-feedback-start">
                            <input type="name" id="name" name="name"
                                class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                placeholder="John Due" required>
                            <div class="form-control-feedback-icon">
                                <i class="ph-user-circle text-muted"></i>
                            </div>
                        </div>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="form-control-feedback form-control-feedback-start">
                            <input type="email" id="email" name="email"
                                class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                placeholder="john@example.com" required>
                            <div class="form-control-feedback-icon">
                                <i class="ph-user-circle text-muted"></i>
                            </div>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="form-control-feedback form-control-feedback-start">
                            <input type="password" id="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" placeholder="•••••••••••"
                                required>
                            <div class="form-control-feedback-icon">
                                <i class="ph-lock text-muted"></i>
                            </div>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="text-center text-muted content-divider mb-3">
                        <span class="px-2">Additions</span>
                    </div>

                    <div class="mb-3">
                        <label class="form-check">
                            <input type="checkbox" name="remember" class="form-check-input" required>
                            <span class="form-check-label">Accept <a href="#">&nbsp;terms of service</a></span>
                        </label>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-teal w-100">Register</button>
                    </div>

                    <div class="text-center">
                        <a href="{{ route('admin.login') }}">Do have an account? Sign in</a>
                    </div>
                </div>
            </div>
        </form>
        <!-- /register form -->

    </div>
    <!-- /content area -->
@endsection
