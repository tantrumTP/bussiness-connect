<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BusinessController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


/** Authentication routes*/
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
/** END:Authentication routes*/

/** Business routes*/
Route::middleware('auth:sanctum')->group( function () {
    Route::resource('businesess', BusinessController::class)->only([
        'index', 'store', 'show', 'update', 'destroy'
    ]);
});
/**END: Business routes*/