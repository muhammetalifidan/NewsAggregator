<?php

namespace App\Repositories;

use App\Contracts\AdminUserRepositoryInterface;
use App\Http\Resources\AdminUserListResource;
use App\Http\Resources\AdminUserResource;
use App\Models\AdminUser;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Log;

class AdminUserRepository implements AdminUserRepositoryInterface
{
    /**
     * Retrieve all admin users with optional pagination and search.
     * @param int $perPage
     * @param mixed $search
     * @return \Illuminate\Http\Resources\Json\ResourceCollection
     */
    public function all(int $perPage = 10, ?string $search = null): ResourceCollection
    {
        $query = AdminUser::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('created_at', 'like', "%{$search}%")
                    ->orWhere('id', 'like', "%{$search}%");
            });
        }

        $results = $query->paginate($perPage);

        return AdminUserListResource::collection($results);
    }

    public function show(AdminUser $adminUser): AdminUserResource
    {
        return new AdminUserResource($adminUser);
    }

    public function update(AdminUser $adminUser): bool
    {
        return $adminUser->update();
    }

    public function destroy(AdminUser $adminUser): bool
    {
        return $adminUser->delete();
    }

    public function manageRole(AdminUser $adminUser, string $role): bool
    {
        Log::info(
            message: "{date} - tarihinde {id} ID'li kullanıcının durumu, {authId} ID'li kullanıcı tarafından {role} yetkisi verildi.",
            context: [
                'date' => now()->toDateTimeString(),
                'id' => $adminUser->id,
                'authId' => auth('admin')->user()->id,
                'role' => $role,
            ],
        );

        $adminUser->syncRoles($role);

        return true;
    }
}