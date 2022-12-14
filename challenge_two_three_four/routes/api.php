<?php

use App\Http\Controllers\ChallengeFourController;
use App\Http\Controllers\ChallengeTwoController;
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

Route::post('/get_redundant_data', [ChallengeTwoController::class, "getRedundantNumbers"]);
Route::post('/get_group_by_company_name', [ChallengeFourController::class, "groupByCompanyName"]);
