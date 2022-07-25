<?php

use App\Http\Controllers\Admin\Auth\AdminController;
use App\Http\Controllers\User\Auth\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

Route::resource('admin', AdminController::class);
Route::namespace('Admin')->middleware('backbutton')->group(function () {
    Route::namespace('Auth')->group(function () {
        Route::get('admin-login', [AdminController::class, 'getAdminLogin'])->name('login');
        Route::post('admin-login', [AdminController::class, 'adminLogin'])->name('admin.Login');
    });
    Route::get('admin-dashboard', [AdminController::class, 'getadminDashboard'])->name('admin.Dashboard');
});
Route::resource('user', UserController::class)->middleware(['userauth:user']);
Route::namespace('User')->group(function () {
    Route::namespace('Auth')->group(function () {
        Route::get('/', function () {
            return view('user.userLogin');
        })->name('user.Login');
        Route::get('user-register', [UserController::class, 'getSignup'])->name('user.Register');
        Route::post('register', [UserController::class, 'userSignup'])->name('user.Signup');
        Route::post('user-login', [UserController::class, 'userLogin'])->name('user.Logins');
        Route::get('logout', [UserController::class, 'logout'])->name('logout');
    });
    Route::middleware(['userauth:user', 'role:editor'])->group(function () {
        Route::get('user-feed', [UserController::class, 'userFeed'])->name('user.Feed');
        Route::get('role', function () {
            $user = Auth::user();
            if ($user->hasRole('editor')) {
                dd('editor');
            }
        });
    });
});
