<?php

namespace App\Http\Controllers\Web\Auth;

use App\Enum\RolesEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterAdminUserRequest;
use App\Models\AdminUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredAdminController extends Controller
{
    public function create()
    {
        return view('pages.auth.admin_register');
    }

    public function store(RegisterAdminUserRequest $request)
    {
        $validatedData = $request->validated();

        $adminUser = AdminUser::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password'])
        ]);

        $adminUser->assignRole(RolesEnum::User);

        event(new Registered($adminUser));

        Auth::login($adminUser);

        return redirect()->intended(route('admin.dashboard.index', absolute: false));
    }
}