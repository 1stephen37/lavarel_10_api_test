<?php

use App\Http\Controllers\ReviewsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/user', [UserController::class, 'index']);

Route::get('/reviews', [ReviewsController::class, 'index']);
Route::post('/reviews/create', [ReviewsController::class, 'create_review']);
Route::delete('/reviews/delete/{id}', [ReviewsController::class, 'delete_review']);
Route::patch('/reviews/update/{id}', [ReviewsController::class, 'update_review']);
