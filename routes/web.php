<?php

use App\Http\Controllers\Admin\UsersController as AdminUsers;
use App\Http\Controllers\Admin\SettingController as AdminSetting;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('landing');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/home', function () {
        return Inertia::render('Home');
    })->name('home');

    // Admin Area
    Route::middleware(['role:Admin'])->prefix('admin')->group(function () {

        Route::get('dashboard', function () {
            return Inertia::render('Admin/Dashboard');
        })->name('admin.dashboard');

        Route::resource('users', AdminUsers::class, ['as' => 'admin']);

        Route::get('settings/remove/{id}', [AdminSetting::class, 'remove'])->name('admin.settings.update');
        Route::get('settings', [AdminSetting::class, 'index'])->name('admin.settings');
        Route::post('settings', [AdminSetting::class, 'update'])->name('admin.settings.update');
    });
});
