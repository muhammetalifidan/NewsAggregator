<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
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
                    <td>
                        <div class="dropdown mt-2">
                            <button id="statusButton-{{ $user->id }}" type="button"
                                class="badge bg-primary d-inline-flex align-items-center dropdown-toggle text-capitalize"
                                data-bs-toggle="dropdown">
                                {{ $statuses[$user->status] }}
                            </button>
    
                            <div class="dropdown-menu dropdown-menu-end">
                                @foreach ($statuses as $key => $label)
                                    <label class="dropdown-item">
                                        <input type="radio" name="status-{{ $user->id }}" value="{{ $key }}" class="me-2"
                                            {{ $user->status === $key ? 'checked' : '' }}>
                                        {{ $label }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-inline-flex">
                            <a href="{{ route('admin-user.edit', ['admin_user' => $user->id]) }}" class="text-body"
                                data-bs-popup="tooltip" aria-label="Edit" data-bs-original-title="Edit">
                                <i class="ph-pen"></i>
                            </a>
                            <a class="text-body mx-2 delete-admin-user" data-bs-popup="tooltip"
                                data-id="{{ $user->id }}" data-email="{{ $user->email }}" aria-label="Delete"
                                title="Delete">
                                <i class="ph-trash"></i>
                            </a>
                            <a href="{{ route('admin-user.show', ['admin_user' => $user->id]) }}" class="text-body"
                                data-bs-popup="tooltip" aria-label="Details" data-bs-original-title="Details">
                                <i class="ph-arrows-out-simple"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{ $adminUsers->appends(['search' => request('search'), 'per_page' => request('per_page')])->links('vendor.pagination') }}
