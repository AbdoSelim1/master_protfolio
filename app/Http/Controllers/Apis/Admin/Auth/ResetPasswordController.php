<?php

namespace App\Http\Controllers\Apis\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Apis\Admin\Auth\CheckCodeRequest;
use App\Http\Requests\Apis\Admin\Auth\PasswordResetRequest;
use App\Http\Requests\Apis\Admin\Auth\SendCodeRequest;
use App\Mail\SendCodeMail;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends Controller
{
    public function sendCode(SendCodeRequest $request)
    {
        DB::beginTransaction();
        try {
            $admin  = Admin::where('email', $request->safe()->email)->first();
            $code = rand(1, 999999);
            $admin->code = $code;
            $admin->save();
            Mail::to($admin->email)->send(new SendCodeMail($admin));
            DB::commit();
            return $this->responseData(compact('admin'),'code sent Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->errorMessage(['error' => $e->getMessage()]);
        }
    }


    public function checkCode(CheckCodeRequest $request)
    {
        try {
            $admin = Admin::where('email', $request->safe()->email)->first();
            if ($admin->code == $request->safe()->code) {
                return $this->responseData(compact('admin'));
            }
            return $this->errorMessage(['error' => '']);
        } catch (\Exception $e) {
            return $this->errorMessage(['error' => $e->getMessage()]);
        }
    }


    public function reset(PasswordResetRequest $request)
    {
        DB::beginTransaction();
        try {
            $admin = Admin::where('email', $request->safe()->email)->first();
            $admin->password = Hash::make($request->safe()->password);
            $admin->save();
            $admin->token = "Bearer " . $admin->createToken($request->email)->plainTextToken;
            DB::commit();
            return $this->responseData(compact('admin'));
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->errorMessage(['error' => $e->getMessage()]);
        }
    }
}
