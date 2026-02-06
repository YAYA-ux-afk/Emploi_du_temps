<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\TimetableLogController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PublicCourseController;

// Authentification
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// Pages publiques
Route::get('/', [TimetableLogController::class, 'index']);
Route::get('/historique', [TimetableLogController::class, 'index']);
Route::get('/courses-list', [PublicCourseController::class, 'index']);

// Gestion des cours - ADMIN SEUL
Route::middleware('admin')->group(function () {
    Route::get('/courses', [CourseController::class, 'index']);
    Route::get('/courses/create', [CourseController::class, 'create']);
    Route::post('/courses', [CourseController::class, 'store']);
    Route::get('/courses/{course}/edit', [CourseController::class, 'edit']);
    Route::put('/courses/{course}', [CourseController::class, 'update']);
    Route::delete('/courses/{course}', [CourseController::class, 'destroy']);
});