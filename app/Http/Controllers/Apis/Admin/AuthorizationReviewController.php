<?php

namespace App\Http\Controllers\Apis\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Apis\Admin\AuthorizationReviews\AuthorizationReviewRequest;
use App\Models\AuthorizationReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthorizationReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->responseData(['authorization_reviews' => AuthorizationReview::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AuthorizationReviewRequest $request)
    {
        DB::beginTransaction();
        try {
            $authorization_reviews = AuthorizationReview::all();
            if (count($authorization_reviews) == 0) {
                $authorization_review = AuthorizationReview::create($request->validated());
                DB::commit();
                return $this->responseData(['authorization_review' => $authorization_review]);
            }
            return $this->errorMessage(['error' => 'You cannot be allowed to create more than one record']);
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
    public function update(AuthorizationReviewRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $authorization_review = AuthorizationReview::where('id', $id)->first();
            if (!is_null($authorization_review)) {
                $authorization_review->update($request->validated());
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
            $authorization_review = AuthorizationReview::where('id', $id)->first();
            if (!is_null($authorization_review)) {
                $authorization_review->delete();
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
