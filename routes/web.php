<?php

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

// Home page
Route::get('/', [HomeController::class, 'index'])->name('home');

// About Us page
Route::get('/about', [HomeController::class, 'about'])->name('about');

// Projects page
Route::get('/projects', [HomeController::class, 'projects'])->name('projects');

// Sister Companies page
Route::get('/sister-companies', [HomeController::class, 'sisterCompanies'])->name('sister-companies');

// Careers page
Route::get('/careers', [HomeController::class, 'careers'])->name('careers');

// Our Clients page
Route::get('/clients', [HomeController::class, 'clients'])->name('clients');

// Contact page
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

