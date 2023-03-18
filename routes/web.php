<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DoctypeController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ItemController;
use App\Models\doctype;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Report\PHP;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/login',[AdminController::class, 'login']);
Route::post('admin/auth',[AdminController::class, 'auth'])->name('admin.auth');

Route::group(['middleware'=>'admin_auth'],function(){

    Route::get('admin/dashboard',[AdminController::class, 'index']);
    Route::get('admin',[AdminController::class, 'index']);

    Route::get('admin/logout', function () {
        session()->forget('ADMIN_LOGIN');
        session()->put('ADMIN_ID');
        return redirect('admin/login');
    });
    Route::get('admin/license',[AdminController::class, 'license']);
    Route::get('admin/users',[AdminController::class, 'users']);
    Route::get('admin/license/view/{licenseId}',[AdminController::class, 'licenseView']);
    Route::get('admin/envato_authorized',[AdminController::class, 'envato_license_authorizations']);

    Route::get('admin/authorizations',[AdminController::class, 'authorizations']);
});
