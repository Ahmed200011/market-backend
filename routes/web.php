<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        Route::get('/', function () {
            return view('welcome');
        })->name('welcome');

        Route::prefix('/dashboarda')
            ->as('dashboard.')
            ->middleware(['auth', 'verified', 'role:super_admin']) //
            ->group(function () {
                Route::get('/', function () {
                    return view('dashboard');
                })->name('main');
                Route::resource('user', UserController::class);
                Route::resource('Category', CategoryController::class);

            });

        Route::middleware('auth')->group(function () {
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });

        Route::prefix('/page')
        ->as('page.')
        ->group(function () {
            Route::get('/home',HomeController::class)->name('home');


        });

        require __DIR__ . '/auth.php';
    }
);
