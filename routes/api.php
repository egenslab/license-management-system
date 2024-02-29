<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\API\LicenseController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('install',[LicenseController::class, 'installPlugin']);
Route::post('setup_license',[LicenseController::class, 'setupLicense']);
Route::post('removed_license_key',[LicenseController::class, 'removedLicenseKey']);
Route::post('admin/verify-envato-purchase',[LicenseController::class, 'envatoPurchase']);
Route::post('admin/license-update',[LicenseController::class, 'updateLicense']);
Route::post('admin/license-remove',[LicenseController::class, 'removeLicense']);
Route::post('admin/license-generate-key',[LicenseController::class, 'licenseGenerateKey']);

