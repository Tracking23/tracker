<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\VisitController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/track', [VisitController::class, 'track']);
Route::get('/website-analytics', [VisitController::class, 'getAnalytics']);
