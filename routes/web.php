<?php

use App\Http\Controllers\Backsite\DashboardController;
use App\Http\Controllers\Backsite\PermissionsController;
use App\Http\Controllers\Backsite\RolesController;
use App\Http\Controllers\Backsite\UsersController;

use App\Http\Controllers\Backsite\Profile\ProfilesController;

use App\Http\Controllers\Backsite\MasterData\GroupRateController;
use App\Http\Controllers\Backsite\MasterData\RateController;

use App\Http\Controllers\Backsite\Operational\CustomerController;
use App\Http\Controllers\Backsite\Operational\CustomerUsageController;

use App\Http\Controllers\Backsite\Transaction\BillController;
use App\Http\Controllers\Backsite\Transaction\TransactionController;

use Illuminate\Support\Facades\Route;

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

Route::view('/', 'pages.frontsite.home');

Route::group(['prefix' => 'backsite', 'as' => 'backsite.', 'middleware' => ['auth:sanctum', 'verified']], function () {

    // redirect after log in
    Route::redirect('/', '/backsite/dashboard');


    // dashboard ------------------------------- //
    Route::resource('dashboard', DashboardController::class);
    // dashboard ------------------------------- //


    // management access ------------------------------- //
    // Permissions
    Route::resource('permissions', PermissionsController::class);


    // roles
    Route::resource('roles', RolesController::class);
    // end management access ------------------------------- //


    // users ------------------------------- //
    Route::get('reset_password/users/{id}', [UsersController::class, 'reset_password'])->name('reset.password.users');
    Route::get('filter/users', [UsersController::class, 'filter'])->name('filter.users');
    Route::resource('users', UsersController::class);
    // end users ------------------------------- //


    // profile ------------------------------- //
    Route::put('update/account/{id}', [ProfilesController::class, 'update_account'])->name('update.account.profiles');
    Route::put('update/security/{id}', [ProfilesController::class, 'update_security'])->name('update.security.profiles');
    Route::put('upload/photo/{id}', [ProfilesController::class, 'upload'])->name('upload.photo.profiles');
    Route::get('reset/photo/{id}', [ProfilesController::class, 'reset'])->name('reset.photo.profiles');
    Route::resource('profiles', ProfilesController::class);
    // end profile ------------------------------- //
    
    // Group Rate ------------------------------- //
    Route::resource('group_rate', GroupRateController::class);
    // End Group Rate ------------------------------- //

    // Rate ------------------------------- //
    Route::resource('rate', RateController::class);
    // End Rate ------------------------------- //


    // Customer ------------------------------- //
    Route::resource('customer', CustomerController::class);
    // End Customer ------------------------------- //


    // Customer Usage ------------------------------- //
    Route::resource('customer_usage', CustomerUsageController::class);
    // End Customer USage ------------------------------- //


    // Bill ------------------------------- //
    Route::get('pay/bill/{id}', [BillController::class, 'pay_bill'])->name('pay.bill');
    Route::put('upload/pay/bill/{id}', [BillController::class, 'upload_pay_bill'])->name('upload.pay.bill');
    Route::put('confirm/pay/bill/{id}', [BillController::class, 'confirm_pay_bill'])->name('confirm.pay.bill');
    Route::resource('bill', BillController::class);
    // End Bill ------------------------------- //


    // transaction ------------------------------- //
    Route::resource('transaction', TransactionController::class);
    // End transaction ------------------------------- //

});
