<?php

namespace App\Http\Controllers\Apis\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PersonalInformation;
use App\Http\Controllers\Controller;
use App\Http\Requests\Apis\Admin\PersonalInformation\PersonalInformationRequest;

class PersonalInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->responseData(['personal_information' => PersonalInformation::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonalInformationRequest $request)
    {
        DB::beginTransaction();
        try {
            $personalInformation = PersonalInformation::create($request->validated());
            DB::commit();
            return $this->responseData(['personalInformation' => $personalInformation], "Created successfully");
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
    public function update(PersonalInformationRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $personalInformation = PersonalInformation::where('id', $id)->first();
            if (!is_null($personalInformation)) {
                $personalInformation->update($request->validated());
                DB::commit();
                return $this->successMessage("Updated successfully");
            }
            return $this->errorMessage(['error' => "Id Number dosent exists in DataBase"]);
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
            $personalInformation = PersonalInformation::where('id', $id)->first();
            if (!is_null($personalInformation)) {
                $personalInformation->delete();
                DB::commit();
                return $this->successMessage("Deleted successfully");
            }
            return $this->errorMessage(['error' => "Id Number dosent exists in DataBase"]);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->errorMessage(['error' => $e->getMessage()]);
        }
    }
}
