<?php

namespace App\Http\Controllers\Apis\Web;

use App\Models\Cv;
use App\Models\Work;
use App\Models\Skill;
use App\Models\Review;
use App\Models\Contact;
use App\Models\Project;
use App\Models\Education;
use App\Models\SocialLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PersonalInformation;
use App\Http\Controllers\Controller;
use App\services\ManegMedia\ProjectWithMedia;
use App\services\SocialLinkService\FormatLink;
use App\Http\Requests\Apis\Admin\Contacts\StoreContactRequest;
use App\Http\Requests\Apis\Admin\Reviews\StoreReviewRequest;
use App\Mail\ContactMessage;
use Illuminate\Support\Facades\Mail;

class WebDataController extends Controller
{
    public function cv()
    {
        $cv = Cv::where('status', '1')->orderBy('created_at', 'DESC')->first();
        return $this->responseData(compact('cv'));
    }


    public function educations()
    {
        $educations = Education::where('status', '1')->get();
        return $this->responseData(compact('educations'));
    }

    public function perspnalInformation()
    {
        $personalInfromation = PersonalInformation::where('status', '1')->orderBy('created_at', 'DESC')->first();
        return $this->responseData(compact('personalInfromation'));
    }

    public function projects()
    {
        $projects = ProjectWithMedia::all(['1']);
        return $this->responseData(compact('projects'));
    }

    public function firstProject(string $slug)
    {
        try {
            $projectmodel = Project::where('slug', $slug)->where('status', '1')->first();
            $project = ProjectWithMedia::first($projectmodel);
            if (!$project) {
                return $this->errorMessage(['error' => "this project dosent exists in Database"]);
            }
            return $this->responseData($project);
        } catch (\Exception $e) {
            return $this->errorMessage(['error' => $e->getMessage()]);
        }
    }

    public function reviews()
    {
        $reviews  = Review::where('status', '1')->orderBy('created_at', 'DESC')->get();
        foreach ($reviews as $review) {
            $review->images = [
                'path' => asset($review->getFirstMediaUrl('reviews')),
                'media_id' => $review->getFirstMedia('reviews')->id
            ];
            unset($review->media);
        }
        return $this->responseData(compact('reviews'));
    }

    public function skills()
    {
        $skills = Skill::where('status', '1')->get();
        return $this->responseData(compact('skills'));
    }

    public function socialLinks()
    {
        $social_links = FormatLink::make(['1']);
        return $this->responseData(compact('social_links'));
    }

    public function works()
    {
        $works = Work::where('status', '1')->get();
        return $this->responseData(compact('works'));
    }

    public function storeContact(StoreContactRequest $request)
    {
        DB::beginTransaction();
        try {
            $contact = Contact::create($request->validated());
            //send mail to me
            Mail::to(env('MAIL_CONTACT_TO'))->send(new ContactMessage($contact));
            DB::commit();
            return $this->responseData(['contact' => $contact], "Created successfully");
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->errorMessage(['error' => $e->getMessage()]);
        }
    }

    public function storeReview(StoreReviewRequest $request)
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
}
