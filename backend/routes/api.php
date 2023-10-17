<?php

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

Route::get("/login", function(){
    throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException("404 not found");
})->name("login");

Route::post("/login", [\App\Http\Controllers\API\AuthenticationController::class, "login"])
     ->name("api.login");

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout',
        [\App\Http\Controllers\API\AuthenticationController::class, 'logout']
    )->name('api.logout');

    Route::apiResource('ip-address', \App\Http\Controllers\API\IpAddressController::class)->except([
        "destroy"
    ]);

});
