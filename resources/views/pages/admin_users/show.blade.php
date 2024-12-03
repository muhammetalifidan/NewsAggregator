@extends('layout.app')
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light shadow">
        <div class="page-header-content d-lg-flex">
            <div class="d-flex">
                <h4 class="page-title mb-0">
                    Admin User Details
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
                <h5 class="mb-0 me-auto">Details Form</h5>

                <a href="{{ route('admin-user.index') }}" class="btn btn-outline-primary btn-icon rounded-start">
                    <i class="ph-arrow-u-up-left"></i>
                </a>
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
                        <input type="text" class="form-control" value="••••••••••••••••••••••••••••••••••••••••••••••••••••••••••" disabled>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-lg-3 col-form-label">Status:</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control text-capitalize" value="{{ $adminUser->status }}" disabled>
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
