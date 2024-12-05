<?php

namespace App\Contracts;

use App\Http\Resources\AdminUserResource;
use App\Models\AdminUser;
use Illuminate\Http\Resources\Json\ResourceCollection;

interface AdminUserRepositoryInterface
{
    public function all(int $perPage = 10, ?string $search = null): ResourceCollection;
    public function find(AdminUser $adminUser): AdminUserResource;
    public function update(AdminUser $adminUser): bool;
    public function destroy(AdminUser $adminUser): bool;
    public function manageRole(AdminUser $adminUser, string $role): bool;
}