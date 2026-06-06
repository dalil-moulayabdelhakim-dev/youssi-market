<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\OwnerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('api/product/edit/{id}', [OwnerController::class, 'editProduct']);

Route::get('/communes/{wilaya}', [MainController::class, 'getCommunes']);

