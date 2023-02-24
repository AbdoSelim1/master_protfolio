<?php

namespace App\Http\Controllers\Apis\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Apis\Admin\Skills\StoreSkillRequest;
use App\Http\Requests\Apis\Admin\Skills\UpdateSkillRequest;
use App\Models\Skill;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SkillsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->responseData(['skills' => Skill::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSkillRequest $request)
    {
        DB::beginTransaction();
        try {
            $skill =  Skill::create($request->validated());
            DB::commit();
            return $this->responseData(['skill' => $skill], 'Created Successfully');
        } catch (Exception $e) {
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
    public function update(UpdateSkillRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $skill  = Skill::where('id', $id)->first();
            if (!is_null($skill)) {
                $skill->update($request->validated());
                DB::commit();
                return $this->responseData(['skill' => $skill], 'Updated Successfully');
            }
            return $this->errorMessage(['error' => 'Id number dosent Exists in DataBase']);
        } catch (Exception $e) {
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
            $skill  = Skill::where('id', $id)->first();
            if (!is_null($skill)) {
                $skill->delete();
                DB::commit();
                return $this->successMessage('Skill Deleted Successfully');
            }
            return $this->errorMessage(['error' => 'Id number dosent Exists in DataBase']);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->errorMessage(['error' => $e->getMessage()]);
        }
    }
}
