<?php

use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('posts', [PostController::class, 'index']);
Route::get('posts/{postId}', [PostController::class, 'show']);

Route::get('languages', function (){
    return new JsonResponse(\App\Models\Language::all());
});

Route::post('/login', [ApiAuthController::class, 'login']);

//Route::group(['middleware'=> ['cors','auth:api']], function (){
    Route::post('posts', [PostController::class, 'store']);
    Route::put('posts/{id}', [PostController::class, 'update']);
    Route::delete('posts/{id}', [PostController::class, 'destroy']);
    Route::post('logout', [ApiAuthController::class, 'logout']);
//});


//Route::get('tags', [TagController::class, 'index']);
//Route::get('tags/{id}', [TagController::class, 'show']);
Route::post('tags', [TagController::class, 'store']);
Route::put('tags/{id}', [TagController::class, 'update']);
Route::delete('tags/{id}', [TagController::class, 'delete']);
