@extends('layout.app')
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light shadow">
        <div class="page-header-content d-lg-flex">
            <div class="d-flex">
                <h4 class="page-title mb-0">
                    Edit Admin User
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

        @if (session('success'))
            <div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Basic layout -->
        <div class="card">
            <div class="card-header d-flex">
                <h5 class="mb-0 me-auto">Edit Form</h5>

                <a href="{{ route('admin-user.index') }}" class="btn btn-outline-primary btn-icon rounded-start">
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

                <form action="{{ route('admin-user.update', ['admin_user' => $adminUser]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <label class="col-lg-3 col-form-label">Name:</label>
                        <div class="col-lg-9">
                            <input type="name" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ $adminUser->name }}" placeholder="John Due">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-3 col-form-label">Email:</label>
                        <div class="col-lg-9">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ $adminUser->email }}" placeholder="john@example.com">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-3 col-form-label">Password:</label>
                        <div class="col-lg-9">
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" placeholder="•••••••••••••••••••••••••••••••••••••••••••••••••••••••••">
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

@push('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const alertElement = document.getElementById("successAlert");
            if (alertElement) {
                setTimeout(() => {
                    alertElement.classList.remove("show");
                    alertElement.classList.add("fade");
                    setTimeout(() => alertElement.remove(), 150);
                }, 3000);
            }
        });
    </script>
@endpush
