<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PublicApi\OrderController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Routes defined here will be grouped under the "api" middleware.
|
*/

// Authenticated user route
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
