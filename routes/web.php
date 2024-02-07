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
    Route::get('admin/license/delete/{licenseId}',[AdminController::class, 'licenseDelete'])->name('license.delete');
    Route::get('admin/envato_authorized',[AdminController::class, 'envato_license_authorizations']);
    Route::get('admin/authorizations',[AdminController::class, 'authorizations']);
    Route::get('admin/verify',[AdminController::class, 'verify']);
    Route::post('admin/verify-envato-purchase',[AdminController::class, 'envatoPurchase']);


    Route::get('admin/purchase-code-list',[AdminController::class, 'purchaseCodeList'])->name('purchase.code.list');

    Route::get('admin/generate-purchase-code',[AdminController::class, 'purchaseCodeGenerate'])->name('generate.purchase.code');
    Route::post('admin/store-purchase-code',[AdminController::class, 'purchaseCodeStore'])->name('store.purchase.code');
    Route::get('admin/purchase-code/{id}',[AdminController::class, 'purchaseCodeDelete'])->name('delete.purchase.code');


});
