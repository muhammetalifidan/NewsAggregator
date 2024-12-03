<?php

namespace App\Http\Controllers\Web;

use App\Contracts\AdminUserRepositoryInterface;
use App\Enum\AdminUserStatusesEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\ManageAdminUserStatusRequest;
use App\Http\Requests\UpdateAdminUserRequest;
use App\Http\Resources\AdminUserResource;
use App\Models\AdminUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
        $perPage = $request->get('per_page');
        $search = $request->get('search');

        if (empty($perPage) || $perPage <= 0) {
            $perPage = 10;
        }

        $adminUsers = $this->adminUserRepository->all($perPage, $search);
        $statuses = AdminUserStatusesEnum::labels();

        if ($request->ajax()) {
            return view('pages.admin_users.table', compact('adminUsers'));
        }
        return view('pages.admin_users.index', compact('adminUsers', 'perPage', 'search', 'statuses'));
    }

    /**
     * Display the specified resource.
     * @param \App\Models\AdminUser $adminUser
     * @return \Illuminate\View\View
     */
    public function show(AdminUser $adminUser): View
    {
        $adminUser = $this->adminUserRepository->show($adminUser);
        return view('pages.admin_users.show', compact('adminUser'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param \App\Models\AdminUser $adminUser
     * @return \Illuminate\View\View
     */
    public function edit(AdminUser $adminUser): View
    {
        $rawData = $this->adminUserRepository->show($adminUser);
        $adminUser = new AdminUserResource($rawData);

        return view('pages.admin_users.edit', compact('adminUser'));
    }

    /**
     * Update the specified resource in storage.
     * @param \App\Http\Requests\UpdateAdminUserRequest $request
     * @param \App\Models\AdminUser $adminUser
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateAdminUserRequest $request, AdminUser $adminUser): RedirectResponse
    {
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

        return back()->with('success', 'Admin user updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param \App\Models\AdminUser $adminUser
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(AdminUser $adminUser)
    {
        $result = $this->adminUserRepository->destroy($adminUser);

        if (!$result) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete admin user.'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Admin user deleted successfully.'
        ]);
    }

    public function manageStatus(ManageAdminUserStatusRequest $request, AdminUser $adminUser): JsonResponse
    {
        $validatedData = $request->validated();
        $result = $this->adminUserRepository->manageStatus($adminUser, $validatedData['status']);

        if (!$result) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to change admin user status.'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Admin user status changed successfully.'
        ]);
    }
}
