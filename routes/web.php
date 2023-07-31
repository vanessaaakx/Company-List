<?php

use Illuminate\Foundation\Application;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\AdminController;
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
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::middleware('auth')->group(function () {

    Route::get('/companies', [CompanyController::class, 'index'])->name('companies');
    Route::get('/companies/edit/{company}',[CompanyController::class,'edit']);
    Route::patch('/companies/{company}',[CompanyController::class,'update']);
    Route::get('/companies/create', [CompanyController::class, 'create']);
    Route::post('/companies', [CompanyController::class, 'store']);
    Route::get('/companies/{company}', [CompanyController::class, 'show']);
    Route::get('/companies/search/{searchKey}', [CompanyController::class, 'search']);
    Route::post('/companies/toggle/{company}', [CompanyController::class, 'toggle']);
    Route::delete('/companies/{company}',[CompanyController::class, 'destroy']);
    Route::get('/companies/pdf/{company}',[CompanyController::class,'pdf']);
    Route::get('/companies/email/{company}', [CompanyController::class, 'email']);
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index')->middleware('role:admin');
    Route::post('/admin/email', [AdminController::class, 'sendEmailToAllCompanies']);
});
