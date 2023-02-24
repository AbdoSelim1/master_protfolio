<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Apis\Admin\CvsController;
use App\Http\Controllers\Apis\Admin\WorkController;
use App\Http\Controllers\Apis\Admin\AdminController;
use App\Http\Controllers\Apis\Admin\ReviewController;
use App\Http\Controllers\Apis\Admin\SkillsController;
use App\Http\Controllers\Apis\Admin\ContactController;
use App\Http\Controllers\Apis\Admin\ProjectController;
use App\Http\Controllers\Apis\Admin\EducationController;
use App\Http\Controllers\Apis\Admin\SocialLinkController;
use App\Http\Controllers\Apis\Admin\Auth\LoginControlller;
use App\Http\Controllers\Apis\Admin\Auth\LogoutController;
use App\Http\Controllers\Apis\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Apis\Admin\AuthorizationReviewController;
use App\Http\Controllers\Apis\Admin\PersonalInformationController;
use App\Http\Controllers\Apis\Web\WebDataController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('admin')->middleware('auth:sanctum')->group(function () {
    Route::apiResource('admins', AdminController::class)->except('show');
    Route::apiResource('skills', SkillsController::class)->except('show');
    Route::apiResource('social-links', SocialLinkController::class)->except('show');
    Route::apiResource('projects', ProjectController::class);
    Route::delete('project/remove-img', [ProjectController::class, 'removeImg']);
    Route::apiResource('reviews', ReviewController::class)->except('show');
    Route::apiResource('educations', EducationController::class)->except('show');
    Route::apiResource('works', WorkController::class)->except('show');
    Route::apiResource('personal_information', PersonalInformationController::class)->except('show');
    Route::apiResource('cvs', CvsController::class)->except('show', 'update');
    Route::apiResource('contacts', ContactController::class)->except('show', 'update','store');
    Route::apiResource('authorization_reviews', AuthorizationReviewController::class)->except('show');
    Route::post('logout', LogoutController::class);
});

Route::prefix('admin')->middleware('guest:sanctum')->group(function () {
    Route::post('login', [LoginControlller::class, 'login']);
    Route::post('send-code', [ResetPasswordController::class, 'sendCode']);
    Route::post('check-code', [ResetPasswordController::class,  'checkCode']);
    Route::post('reset-password', [ResetPasswordController::class, 'reset']);
});


Route::group(['prefix' => "get/"], function () {
    Route::get('cvs', [WebDataController::class, 'cv']);
    Route::get('educations', [WebDataController::class, 'educations']);
    Route::get('personal-information' , [WebDataController::class , 'perspnalInformation']);
    Route::get('projects' , [WebDataController::class , 'projects']);
    Route::get('projects/{slug}' , [WebDataController::class , 'firstProject']);
    Route::get('reviews' , [WebDataController::class , 'reviews']);
    Route::get('skills' , [WebDataController::class , 'skills']);
    Route::get('social-links' , [WebDataController::class, 'socialLinks']);
    Route::get('works' , [WebDataController::class , 'works']);

});

Route::post('conacts/store' , [WebDataController::class , 'storeContact']);