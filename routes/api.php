<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserContactController;
use App\Http\Controllers\Api\ContactFormController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ActionTokenController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/login-via-email', [AuthController::class, 'loginViaEmail']);
Route::post('/register-via-email', [AuthController::class, 'registerViaEmail']);
Route::post('/login-via-sso', [AuthController::class, 'loginViaSso']);


Route::group(['middleware' => 'auth:api'], function () {

    Route::post('/generate-action-token', [ActionTokenController::class, 'generateActionToken']);
    Route::post('/run-action-token', [ActionTokenController::class, 'runActionToken']);
    Route::post('/new-contact-form-submission', [ContactFormController::class, 'newFormSubmission']);

    Route::group(['prefix' => '/user'], function () {

        Route::get('/', [UserController::class, 'userResource']);

        Route::get('/check-gdpr-consent', [UserController::class, 'checkGdprConsent']);

        Route::put('/consent-to-gdpr', [UserController::class, 'consentToGdpr']);

        Route::post('/new-covid-status-report', [UserController::class, 'newCovidStatusReport']);

        Route::get('/covid-status-reports', [UserController::class, 'covidStatusReportsResource']);

        Route::get('/latest-covid-status-report', [UserController::class, 'latestCovidStatusReportResource']);

        Route::put('/update-settings', [UserController::class, 'updateUserSettings']);

        Route::get('/get-alert-status', [UserController::class, 'getAlertStatus']);

        Route::get('/get-contacts', [UserContactController::class, 'getContacts']);

        Route::post('/logout', [AuthController::class, 'logout']);


    });

});
