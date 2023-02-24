<?php

namespace App\Http\Controllers\Apis\Admin;

use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Apis\Admin\Works\WorkRequest;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->responseData(['works' => Work::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WorkRequest $request)
    {
        DB::beginTransaction();
        try {
            $work = Work::create($request->validated());
            DB::commit();
            return $this->responseData(['work' => $work], "Created successfully");
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
    public function update(WorkRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $work = Work::where('id', $id)->first();
            if (!is_null($work)) {
                $work->update($request->validated());
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
            $work = Work::where('id', $id)->first();
            if (!is_null($work)) {
                $work->delete();
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
