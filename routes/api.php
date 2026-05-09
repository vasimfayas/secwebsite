<?php

use App\Http\Controllers\API\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/products', [ProjectController::class, 'index']);
Route::get('/categories', [ProjectController::class, 'categories']);
Route::get('/project/{id}', [ProjectController::class, 'project']);
Route::get('/projects', [ProjectController::class, 'projects']);