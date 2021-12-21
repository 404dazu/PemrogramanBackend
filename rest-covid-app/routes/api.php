<?php

use App\Http\Controllers\PatientsController;
use App\Models\Patients;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('patients',PatientsController::class);
Route::get('/patients/search/{name}',[PatientsController::class,'search']);
Route::get('/patients/status/statuses/{status}',[PatientsController::class,'statuses']);
