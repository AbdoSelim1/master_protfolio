<?php
namespace App\Http\Controllers\Apis\Admin;


use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Apis\Admin\Admins\StoreAdminRequest;
use App\Http\Requests\Apis\Admin\Admins\UpdateAdminRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::all();
        return $this->responseData(compact('admins'), "all admins");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminRequest $request)
    {
        DB::beginTransaction();
        try {
            $data  = (array)$request->safe()->except('password', 'email_verified_at', 'password_confirmation');
            $data['password'] = Hash::make($request->safe()->password);
            $data['email_verified_at'] = $request->safe()->email_verified_at ? date("Y-m-d H:m:i") : null;
            $admin = Admin::create($data);
            DB::commit();
            return $this->responseData(compact('admin'), 'Admin Created Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->errorMessage(['error' => $e->getMessage()]);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $admin = Admin::where('id', $id)->first();
            if (!is_null($admin)) {
                $data  = (array)$request->safe()->except('password', 'email_verified_at');
                $data['email_verified_at'] = $request->safe()->email_verified_at ? date("Y-m-d H:m:i") : null;
                if (isset($request->safe()->password)) {
                    $data['password'] = Hash::make($request->safe()->password);
                }
                $admin->update($data);
                DB::commit();
                return $this->successMessage("Admin Updated Successfully");
            }
            return $this->errorMessage(['error' => "Id Number {$id} dosent exisit in database"]);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->errorMessage(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $admin = Admin::where('id', $id)->first();
            if (!is_null($admin)) {
                $admin->delete();
                DB::commit();
                return $this->successMessage("Admin Deleted Successfully");
            }
            return $this->errorMessage(['error' => "Id Number {$id} dosent Exists in Database"]);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->errorMessage(['error' => $e->getMessage()]);
        }
    }
}
