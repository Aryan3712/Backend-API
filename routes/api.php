<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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

// Route::post('/login',[AuthController::class,'login']);


// // Route::get('/login',function(){
// //     return 'login successful';
// // });

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


    Route::namespace('Controllers')->group(function(){
        Route::prefix('auth')->group(function(){
            Route::post('/login',[AuthController::class,'login']);
            Route::post('/signup',[AuthController::class,'signup']);
        });


        Route::group(['middleware'=>'auth:api'],
            function(){
            Route::get('/index',[AuthController::class,'index']);
            Route::post('/logout',[AuthController::class,'logout']);
        });
    });
    
    

     