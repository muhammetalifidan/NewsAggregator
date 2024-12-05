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

        $perPage = $request->get('per_page');
        $search = $request->get('search');

        if (empty($perPage) || $perPage <= 0) {
            $perPage = 10;
        }

        $adminUsers = $this->adminUserRepository->all($perPage, $search);

        if ($request->ajax()) {
            return view('pages.admin-users.table', compact('adminUsers'));
        }
        return view('pages.admin-users.index', compact('adminUsers', 'perPage', 'search'));
    }

    /**
     * Display the specified resource.
     * @param \App\Models\AdminUser $adminUser
     * @return \Illuminate\View\View
     */
    public function show(AdminUser $adminUser): View
    {
        Gate::authorize('view', [AdminUser::class, $adminUser->id]);

        $adminUser = $this->adminUserRepository->find($adminUser);
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

        $rawData = $this->adminUserRepository->find($adminUser);
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

        return back()->with('success', 'Admin user role changed successfully.');
    }
}
