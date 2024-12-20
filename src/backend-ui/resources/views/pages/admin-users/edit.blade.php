@extends('layouts.app')
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light shadow">
        <div class="page-header-content d-lg-flex align-items-center">
            <div class="d-flex">
                <h4 class="page-title mb-0">
                    Edit Admin User
                </h4>
            </div>
            <div class="d-flex ms-auto">
                <a href="{{ route('admin-users.index') }}" class="btn btn-outline-dark rounded">
                    Back <i class="ph-arrow-u-up-left ms-2"></i>
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

        @if ($errors->any())
            <div id="errorAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Basic layout -->
        <div class="card">
            <div class="card-header d-flex">
                <h5 class="mb-0 me-auto">Edit Form</h5>
            </div>

            <div class="card-body border-top">
                <form action="{{ route('admin-users.update', ['admin_user' => $adminUser]) }}" method="POST">
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
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="•••••••••••••••••••••••••••••••••••••••••••••••••••••••••">
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

        @role('super-admin')
            <div class="card">
                <div class="card-header d-flex">
                    <h5 class="mb-0 me-auto">Authorization Form</h5>
                </div>

                <div class="card-body border-top">
                    <form action="{{ route('admin-users.role', ['admin_user' => $adminUser]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">Role:</label>
                            <div class="col-lg-9">
                                <select class="form-select" name="role">
                                    @foreach ($roles as $key => $role)
                                        <option value="{{ $key }}" {{ $adminUserRole === $key ? 'selected' : '' }}>
                                            {{ $role }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Submit <i
                                    class="ph-paper-plane-tilt ms-2"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        @endrole

        <div class="card">
            <div class="card-header d-flex">
                <h5 class="mb-0 me-auto">Delete Form</h5>
            </div>

            <div class="card-body border-top">
                <details>
                    <summary class="w-100 btn btn-outline-danger">Delete Account
                        <i class="ph-trash ms-2"></i>
                    </summary>
                    <form action="{{ route('admin-users.destroy', ['admin_user' => $adminUser]) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <p class="mt-5"><strong>Are you sure? Your account will be permanently closed.</strong></p>
                        <button type="submit" class=" btn btn-danger mt-1">I confirm the deletion of this account.
                            <i class="ph-trash ms-2"></i>
                        </button>
                    </form>
                </details>
            </div>
        </div>
    </div>
    <!-- /content area -->
@endsection

@push('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const alertElement = document.getElementById("successAlert");
            const errorAlertElement = document.getElementById("errorAlert");

            if (alertElement) {
                setTimeout(() => {
                    alertElement.classList.remove("show");
                    alertElement.classList.add("fade");
                    setTimeout(() => alertElement.remove(), 150);
                }, 3000);
            }

            if (errorAlertElement) {
                setTimeout(() => {
                    errorAlertElement.classList.remove("show");
                    errorAlertElement.classList.add("fade");
                    setTimeout(() => errorAlertElement.remove(), 150);
                }, 3000);
            }
        });
    </script>
@endpush
