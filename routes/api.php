<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AmazonController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/*
--------------------------------------------------------------------------
 API Routes
--------------------------------------------------------------------------

This file defines API routes related to Amazon SP-API.
The methods in the AmazonController are responsible for handling requests to these routes.

*/

Route::prefix('amazon')->group(function () {
    Route::get('listings/{sellerId}/{sku}', [AmazonController::class, 'getListings']);
});
