<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

//Auth paths

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/category', [AdminController::class, 'category'])->name('admin.category');
    Route::get('/project/{id?}', [AdminController::class, 'addproject'])->name('admin.project');
    Route::get('/project/all/view', [AdminController::class, 'existingprojects'])->name('admin.list');
    Route::get('/jobs', [AdminController::class, 'job'])->name('admin.career');
});
// Home page
Route::get('/', [HomeController::class, 'index'])->name('home');


// About Us page
Route::get('/about', [HomeController::class, 'about'])->name('about');

// Projects page
Route::get('/projects', [HomeController::class, 'projects'])->name('projects');
Route::get('/projects/cat/{cat}', [HomeController::class, 'listprojects'])->name('listprojects');
Route::get('/projects/detail/{id}', [HomeController::class, 'detailprojects'])->name('detailprojects');

// Sister Companies page
Route::get('/sister-companies', [HomeController::class, 'sisterCompanies'])->name('sister-companies');

// Careers page
Route::get('/careers', [HomeController::class, 'careers'])->name('careers');

// Our Clients page
Route::get('/clients', [HomeController::class, 'clients'])->name('clients');

// Contact page
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
