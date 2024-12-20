<?php

namespace App\Http\Controllers\Web;

use App\Contracts\AdminUserRepositoryInterface;
use App\Enum\RoleType;
use App\Http\Controllers\Controller;
use App\Http\Requests\ManageAdminUserRoleRequest;
use App\Http\Requests\UpdateAdminUserRequest;
use App\Http\Resources\AdminUserResource;
use App\Models\AdminUser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AdminUserController extends Controller
{
    private AdminUserRepositoryInterface $adminUserRepository;

    public function __construct(AdminUserRepositoryInterface $adminUserRepository)
    {
        $this->adminUserRepository = $adminUserRepository;
    }

    /**
     * Display a listing of the resource.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request): View
    {
        Gate::authorize('viewAny', AdminUser::class);

        $perPage = $request->get('per_page', 10);
        $search = $request->get('search');
        $page = $request->get('page', 1);

        if (empty($perPage) || $perPage <= 0) {
            $perPage = 10;
        }

        $adminUsers = Cache::tags(['admin_users'])->remember(
            key: "admin_users:per_page={$perPage}:page={$page}:search={$search}",
            ttl: now()->addHour(),
            callback: fn() => $this->adminUserRepository->all($perPage, $search)
        );

        if ($request->ajax()) {
            return view('pages.admin-users.table', compact('adminUsers'));
        }
        return view('pages.admin-users.index', compact('adminUsers', 'perPage', 'search'));
    }

    /**
     * Display the details of a specific AdminUser.
     *
     * Authorizes the user to view the AdminUser resource,
     * caches the data to improve performance, and
     * returns the admin user details to the corresponding view.
     *
     * @param \App\Models\AdminUser $adminUser The AdminUser instance to display.
     * @return \Illuminate\View\View The rendered view for the AdminUser details page.
     */
    public function show(AdminUser $adminUser): View
    {
        Gate::authorize('view', [AdminUser::class, $adminUser->id]);

        $adminUser = Cache::remember(
            key: "admin_user:{$adminUser->id}",
            ttl: now()->addHour(),
            callback: fn() => $this->adminUserRepository->find($adminUser)
        );

        return view('pages.admin-users.show', compact('adminUser'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param \App\Models\AdminUser $adminUser
     * @return \Illuminate\View\View
     */
    public function edit(AdminUser $adminUser): View
    {
        Gate::authorize('update', [AdminUser::class, $adminUser->id]);

        $rawData = Cache::remember(
            key: "admin_user_edit:{$adminUser->id}",
            ttl: now()->addHour(),
            callback: fn() => $this->adminUserRepository->find($adminUser)
        );

        $adminUser = new AdminUserResource($rawData);
        $roles = RoleType::labels();
        $adminUserRole = $adminUser->getRoleNames()->first();

        return view('pages.admin-users.edit', compact(['adminUser', 'roles', 'adminUserRole']));
    }

    /**
     * Update the specified resource in storage.
     * @param \App\Http\Requests\UpdateAdminUserRequest $request
     * @param \App\Models\AdminUser $adminUser
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateAdminUserRequest $request, AdminUser $adminUser): RedirectResponse
    {
        Gate::authorize('update', [AdminUser::class, $adminUser->id]);

        $validatedData = $request->validated();
        $adminUser->name = $validatedData['name'];
        $adminUser->email = $validatedData['email'];

        if (!empty($validatedData['password'])) {
            $adminUser->password = Hash::make($validatedData['password']);
        }

        $result = $this->adminUserRepository->update($adminUser);

        if (!$result) {
            return back()->withErrors(['errors' => 'Failed to update admin user.']);
        }

        Cache::forget("admin_user:{$adminUser->id}");
        Cache::forget("admin_user_edit:{$adminUser->id}");
        Cache::tags(['admin_users'])->flush();

        return back()->with('success', 'Admin user updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * @param \App\Models\AdminUser $adminUser
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(AdminUser $adminUser): RedirectResponse
    {
        Gate::authorize('destroy', [AdminUser::class, $adminUser->id]);

        if (auth('admin')->user()->hasRole(RoleType::SuperAdmin->value, 'admin') && $adminUser->id === auth('admin')->user()->id) {
            return back()->withErrors(['errors' => 'Super Admin accounts cannot be deleted.']);
        }

        $result = $this->adminUserRepository->destroy($adminUser);

        if (!$result) {
            return back()->withErrors(['errors' => 'Failed to delete admin user.']);
        }

        Cache::forget("admin_user:{$adminUser->id}");
        Cache::forget("admin_user_edit:{$adminUser->id}");
        Cache::tags(['admin_users'])->flush();

        if ($result && $adminUser->id === auth('admin')->user()->id) {
            return redirect('/');
        }

        return redirect(route('admin-users.index'));
    }

    public function manageRole(ManageAdminUserRoleRequest $request, AdminUser $adminUser): RedirectResponse
    {
        Gate::authorize('manageRole', [AdminUser::class]);

        if (auth('admin')->user()->hasRole(RoleType::SuperAdmin->value, 'admin') && $adminUser->id === auth('admin')->user()->id) {
            return back()->withErrors(['errors' => 'Super Admin role cannot be changed.']);
        }

        $validatedData = $request->validated();
        $result = $this->adminUserRepository->manageRole($adminUser, $validatedData['role']);

        if (!$result) {
            return back()->withErrors(['errors' => 'Failed to change admin user role.']);
        }

        Cache::forget("admin_user:{$adminUser->id}");
        Cache::forget("admin_user_edit:{$adminUser->id}");
        Cache::tags(['admin_users'])->flush();

        return back()->with('success', 'Admin user role changed successfully.');
    }
}
