@extends('layouts.app')
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light shadow">
        <div class="page-header-content d-lg-flex">
            <div class="d-flex">
                <h4 class="page-title mb-0">
                    Admin Users
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

        <!-- Hover rows -->
        <div class="card">
            <div class="card-header d-flex">
                <h5 class="mb-0 me-auto">Admins</h5>
            </div>

            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between gap-3">
                    <div class="d-flex align-items-center">
                        <label class="me-2">Filter:</label>
                        <input type="text" id="filter" class="form-control py-2 px-3" placeholder="Type to filter..."
                            value="{{ request('search') }}">
                    </div>

                    <div class="d-flex align-items-center">
                        <label class="me-2">Show:</label>
                        <select class="form-select" style="width: auto;" id="perPageSelect">
                            @foreach ([10, 50, 1000] as $pageSize)
                                <option value="{{ $pageSize }}" {{ $perPage == $pageSize ? 'selected' : '' }}>
                                    {{ $pageSize }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>


            <div id="table-container">
                @include('pages.admin-users.table')
            </div>

        </div>
        <!-- /hover rows -->

    </div>
    <!-- /content area -->
@endsection

@push('js')
    <script>
        let timeoutId;

        $('#filter').on('input', function() {
            clearTimeout(timeoutId);

            timeoutId = setTimeout(() => {
                const searchValue = $(this).val();
                const perPage = $('#perPageSelect').val();

                $.ajax({
                    url: '{{ route('admin-users.index') }}',
                    data: {
                        search: searchValue,
                        per_page: perPage
                    },
                    success: function(response) {
                        $('#table-container').html(response);
                    }
                });
            }, 300);
        });

        $('#perPageSelect').on('change', function() {
            const searchValue = $('#filter').val();
            const perPage = $(this).val();

            $.ajax({
                url: '{{ route('admin-users.index') }}',
                data: {
                    search: searchValue,
                    per_page: perPage
                },
                success: function(response) {
                    $('#table-container').html(response);
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            function refreshTable() {
                const searchValue = $('#filter').val();
                const perPage = $('#perPageSelect').val();

                $.ajax({
                    url: '{{ route('admin-users.index') }}',
                    data: {
                        search: searchValue,
                        per_page: perPage
                    },
                    success: function(response) {
                        $('#table-container').html(response);
                    }
                });
            }

            $('#filter').on('input', function() {
                refreshTable();
            });

            $('#perPageSelect').on('change', function() {
                refreshTable();
            });
        });
    </script>
@endpush
