<?php

namespace App\Http\Controllers\Apis\Admin\Auth;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Apis\Admin\Auth\AdminLoginRequest;

class LoginControlller extends Controller
{
    public function login(AdminLoginRequest $request)
    {
        try {
            $admin = Admin::where('email', $request->safe()->email)->first();
            if (!$admin || !Hash::check($request->safe()->password, $admin->password ?? "")) {
                return $this->errorMessage(['error' => 'The provided credentials are incorrect.']);
            }
            $admin->token = "Bearer " . $admin->createToken($request->email)->plainTextToken;
            return $this->responseData(compact('admin'));
        } catch (\Exception $e) {
            return $this->errorMessage(['error' => $e->getMessage()]);
        }
    }
}
