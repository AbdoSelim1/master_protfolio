<?php

namespace App\Http\Controllers\Apis\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Apis\Admin\Sociallinks\SocialLinkRequest;
use App\Models\SocialLink;
use App\services\SocialLinkService\FormatLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SocialLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->responseData(['socail_links' => FormatLink::make()], 'all social links');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SocialLinkRequest $request)
    {
        DB::beginTransaction();
        try {
            $link = SocialLink::create($request->validated());
            DB::commit();
            return $this->responseData(['link' => $link], "Created Successfully");
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
    public function update(SocialLinkRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $link = SocialLink::where('id', $id)->first();
            if (!is_null($link)) {
                $link->update($request->validated());
                DB::commit();
                return $this->responseData(['link' => $link], "Updated Successfully");
            }
            return $this->errorMessage(['error' => "Id Number dosent exists in Database"]);
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
            $link = SocialLink::where('id', $id)->first();
            if (!is_null($link)) {
                $link->delete();
                DB::commit();
                return $this->successMessage("Deleted Successfully");
            }
            return $this->errorMessage(['error' => "Id Number dosent exists in Database"]);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->errorMessage(['error' => $e->getMessage()]);
        }
    }
}
