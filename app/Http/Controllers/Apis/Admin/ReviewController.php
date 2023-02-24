<?php

namespace App\Http\Controllers\Apis\Admin;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Apis\Admin\Reviews\StoreReviewRequest;
use App\Http\Requests\Apis\Admin\Reviews\UpdateReviewRequest;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews  = Review::all();
        foreach ($reviews as $review) {
            $review->images = [
                'path' => asset($review->getFirstMediaUrl('reviews')),
                'media_id' => $review->getFirstMedia('reviews')->id
            ];
            unset($review->media);
        }
        return $this->responseData(['reviews' => $reviews]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReviewRequest $request)
    {
        DB::beginTransaction();
        try {
            $review = Review::create($request->validated());
            $review->addMediaFromRequest('image')->toMediaCollection('reviews');
            DB::commit();
            return $this->responseData(['review' => $review], "Created successfully");
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
    public function update(UpdateReviewRequest $request, $id)
    {

        DB::beginTransaction();
        try {
            $review = Review::where('id', $id)->first();
            if (!is_null($review)) {
                $review->update($request->validated());
                if (isset($request->safe()->image)) {
                    if (isset($review->getMedia('reviews')[0])) {
                        $review->getMedia('reviews')[0]->delete();
                    }
                    $review->addMediaFromRequest('image')->toMediaCollection('reviews');
                }
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
            $review = Review::where('id', $id)->first();
            if (!is_null($review)) {
                $review->delete();
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
