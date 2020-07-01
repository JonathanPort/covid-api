<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ContactFormController;
use App\Http\Controllers\Api\AuthController;

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

Route::get('/test', [AuthController::class, 'test']);

Route::post('/login-via-email', [AuthController::class, 'loginViaEmail']);
Route::post('/register-via-email', [AuthController::class, 'registerViaEmail']);
Route::post('/login-via-sso', [AuthController::class, 'loginViaSso']);
Route::post('/run-action-token', [ActionTokenController::class, 'runActionToken']);

Route::group(['prefix' => '/user'], function () {

    Route::get('/', [UserController::class, 'userResource']);

    Route::get('/check-gdpr-consent', [UserController::class, 'checkGdprConsent']);

    Route::put('/consent-to-gdpr', [UserController::class, 'consentToGdpr']);

    Route::post('/new-covid-status-report', [UserController::class, 'newCovidStatusReport']);

    Route::get('/covid-status-reports', [UserController::class, 'covidStatusReportsResource']);

    Route::get('/latest-covid-status-report', [UserController::class, 'latestCovidStatusReportResource']);

    Route::put('/update-settings', [UserController::class, 'updateUserSettings']);

    Route::get('/get-alert-status', [UserController::class, 'getAlertStatus']);

    Route::post('/logout', [AuthController::class, 'logout']);


});


Route::group(['prefix' => '/user-contact'], function () {

    Route::post('/update-settings', [UserController::class, 'updateUserSettings']);

});


Route::post('/new-contact-form-submission', [ContactFormController::class, 'newFormSubmission']);
