<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Result</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Operations</th>
            </tr>
        </thead>
        <tbody>
            @if (count($callbackLogs) <= 0 || $callbackLogs === null)
                <tr class="text-center">
                    <td colspan="7">No matching records found</td>
                </tr>
            @endif
            @foreach ($callbackLogs as $log)
                <tr>
                    <td>{{ $log->id }}</td>
                    <td>{{ $log->result }}</td>
                    <td>{{ $log->status }}</td>
                    <td>{{ $log->created_at }}</td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('callback-log.show', ['callback_log' => $log->id]) }}"
                                class="text-body" data-bs-popup="tooltip" aria-label="Details"
                                data-bs-original-title="Details">
                                <i class="ph-eye"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{ $callbackLogs->appends(['search' => request('search'), 'per_page' => request('per_page')])->links('vendor.pagination') }}
