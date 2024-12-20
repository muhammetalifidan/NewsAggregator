<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Source</th>
                <th>Title</th>
                <th>Word Count</th>
                <th>Created At</th>
                <th>Operations</th>
            </tr>
        </thead>
        <tbody>
            @if (count($incomingLogs) <= 0 || $incomingLogs === null)
                <tr class="text-center">
                    <td colspan="7">No matching records found</td>
                </tr>
            @endif
            @foreach ($incomingLogs as $log)
                <tr>
                    <td>{{ $log->id }}</td>
                    <td>{{ $log->source }}</td>
                    <td>{{ $log->title }}</td>
                    <td>{{ $log->word_count }}</td>
                    <td>{{ $log->created_at }}</td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('incoming-logs.show', ['incoming_log' => $log->id]) }}"
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

{{ $incomingLogs->appends(['search' => request('search'), 'per_page' => request('per_page')])->links('vendor.pagination') }}
