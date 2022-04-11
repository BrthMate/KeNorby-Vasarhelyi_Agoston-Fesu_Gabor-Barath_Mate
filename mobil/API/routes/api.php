<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KenorbyController;
use App\Http\Controllers\AuthController;

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

Route::group(["middleware"=>[ "auth:sanctum" ]],function(){});

Route::post("/login",[AuthController::class,"signin"]);
Route::post("/desktop-login",[KenorbyController::class,"login"]);

Route::group(["middleware"=>[ "MobilTokenCheck" ]],function(){
    Route::post("/counter",[KenorbyController::class,"selectMyCounter"]);
    Route::post("/sum",[KenorbyController::class,"sum"]);
    Route::post("/kenorby",[KenorbyController::class,"update"]);
    Route::post("/logout",[AuthController::class,"logout"]); 
});

Route::group(["middleware"=>[ "DesktopTokenCheck" ]],function(){
    Route::post("/desktop-update-user-data", [KenorbyController::class,"update_user"]);
    Route::post("/desktop-update-status-active", [KenorbyController::class,"active"]);
    Route::post("/desktop-update-status-block", [KenorbyController::class,"blocked"]);
    Route::post("/desktop-create-user", [KenorbyController::class,"create_admin"]);

    Route::post("/desktop-all-user", [KenorbyController::class,"all_user"]);
    Route::post("/desktop-search", [KenorbyController::class,"search"]);
    Route::post("/desktop-select-id", [KenorbyController::class,"search_id"]);
});