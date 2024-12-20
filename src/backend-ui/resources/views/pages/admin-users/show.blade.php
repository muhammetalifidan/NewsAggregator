@extends('layouts.app')
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light shadow">
        <div class="page-header-content d-lg-flex align-items-center">
            <div class="d-flex">
                <h4 class="page-title mb-0">
                    Admin User Details
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

        <!-- Basic layout -->
        <div class="card">
            <div class="card-header d-flex">
                <h5 class="mb-0 me-auto">Details Form</h5>
            </div>

            <div class="card-body border-top">
                <div class="row mb-3">
                    <label class="col-lg-3 col-form-label">ID:</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" value="{{ $adminUser->id }}" disabled>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-lg-3 col-form-label">Name:</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" value="{{ $adminUser->name }}" disabled>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-lg-3 col-form-label">Email:</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" value="{{ $adminUser->email }}" disabled>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-lg-3 col-form-label">Password:</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control"
                            value="••••••••••••••••••••••••••••••••••••••••••••••••••••••••••" disabled>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-lg-3 col-form-label">Created At:</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" value="{{ $adminUser->created_at }}" disabled>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-lg-3 col-form-label">Updated At:</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" value="{{ $adminUser->updated_at }}" disabled>
                    </div>
                </div>
            </div>
        </div>
        <!-- /basic layout -->

    </div>
    <!-- /content area -->
@endsection
