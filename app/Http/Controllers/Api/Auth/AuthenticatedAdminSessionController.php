<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginAdminUserRequest;
use Illuminate\Support\Facades\Auth;

class AuthenticatedAdminSessionController extends Controller
{
    public function store(LoginAdminUserRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        $adminUser = Auth::guard('admin')->user();

        $token = $adminUser->createToken('admin-token')->plainTextToken;

        return response()->json(['token' => $token, 'message' => 'login successful!']);
    }
}
