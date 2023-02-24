<?php

namespace App\Http\Controllers\Apis\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Apis\Admin\Cvs\StoreCvRequest;
use App\Models\Cv;
use App\services\Cvs\CVService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CvsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->responseData(['cvs'=>Cv::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCvRequest $request)
    {
        DB::beginTransaction();
        try {
            $service = new CVService;
            $cv =  Cv::create($service->getFileData($request));
            if ($service->uploadCv($cv['id'])) {
                DB::commit();
                return $this->responseData(['cv' => $cv]);
            }
            return $this->errorMessage(['error' => "Something went wrong"]);
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
            $cv = CV::where('id', $id)->first();
            if (!is_null($cv)) {
                if (CVService::removeCv($cv)) {
                    $cv->delete();
                    DB::commit();
                    return $this->successMessage("Deleted successfully");
                }
            }
            return $this->errorMessage(['error' => "Id Number dosent exists in DataBase"]);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->errorMessage(['error' => $e->getMessage()]);
        }
    }
}
