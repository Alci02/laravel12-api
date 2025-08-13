<?php
use App\Http\Controllers\API\TestApiController;
use App\Http\Controllers\API\StudentApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
// Our first API ROUTE for testing
Route::get(uri:'/test', action: [TestApiController::class, 'test'])->name(name:'test-api');

Route::apiResource('/students', controller: StudentApiController::class);