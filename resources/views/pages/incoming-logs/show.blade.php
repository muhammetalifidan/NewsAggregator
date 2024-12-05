@extends('layouts.app')
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light shadow">
        <div class="page-header-content d-lg-flex align-items-center">
            <div class="d-flex">
                <h4 class="page-title mb-0">
                    Incoming Log Details
                </h4>
            </div>
            <div class="d-flex ms-auto">
                <a href="{{ route('incoming-logs.index') }}" class="btn btn-outline-dark rounded">
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
                        <input type="text" class="form-control" value="{{ $incomingLog->id }}" disabled>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-lg-3 col-form-label">Incoming Log Data ID:</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" value="{{ $incomingLog->incoming_log_data_id }}"
                            disabled>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-lg-3 col-form-label">Source:</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" value="{{ $incomingLog->source }}" disabled>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-lg-3 col-form-label">Title:</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" value="{{ $incomingLog->title }}" disabled>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-lg-3 col-form-label">Word Count:</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" value="{{ $incomingLog->word_count }}" disabled>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-lg-3 col-form-label">Created At:</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" value="{{ $incomingLog->created_at }}" disabled>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-lg-3 col-form-label">Update At:</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" value="{{ $incomingLog->created_at }}" disabled>
                    </div>
                </div>
            </div>
        </div>
        <!-- /basic layout -->

    </div>
    <!-- /content area -->
@endsection
