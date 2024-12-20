@extends('layouts.app')
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light shadow">
        <div class="page-header-content d-lg-flex">
            <div class="d-flex">
                <h4 class="page-title mb-0">
                    Create Admin User
                </h4>

                <a href="#page_header"
                    class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto"
                    data-bs-toggle="collapse">
                    <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <!-- Content area -->
    <div class="content">

        <!-- Basic layout -->
        <div class="card">
            <div class="card-header d-flex">
                <h5 class="mb-0 me-auto">Create Form</h5>

                <a href="{{ route('admin.admin-users.index') }}" class="btn btn-outline-primary btn-icon rounded-start">
                    <i class="ph-arrow-u-up-left"></i>
                </a>
            </div>

            <div class="card-body border-top">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('admin.admin-users.store') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-lg-3 col-form-label">Email:</label>
                        <div class="col-lg-9">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" placeholder="john@example.com" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-3 col-form-label">Password:</label>
                        <div class="col-lg-9">
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" placeholder="•••••••••••"
                                required>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Submit <i
                                class="ph-paper-plane-tilt ms-2"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /basic layout -->

    </div>
    <!-- /content area -->
@endsection
