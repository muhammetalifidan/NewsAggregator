<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Operations</th>
            </tr>
        </thead>
        <tbody>
            @if (count($adminUsers) <= 0 || $adminUsers === null)
                <tr class="text-center">
                    <td colspan="7">No matching records found</td>
                </tr>
            @endif
            @foreach ($adminUsers as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                        <div class="d-inline-flex">
                            <a href="{{ route('admin-users.edit', ['admin_user' => $user->id]) }}" class="text-body"
                                data-bs-popup="tooltip" aria-label="Options" data-bs-original-title="Options">
                                <i class="ph-gear"></i>
                            </a>
                            <a href="{{ route('admin-users.show', ['admin_user' => $user->id]) }}" class="text-body mx-3"
                                data-bs-popup="tooltip" aria-label="Details" data-bs-original-title="Details">
                                <i class="ph-eye"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{ $adminUsers->appends(['search' => request('search'), 'per_page' => request('per_page')])->links('vendor.pagination') }}
