<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
    Route::get('/penjualan', [PenjualanController::class, 'index']);
    Route::post('/penjualan', [PenjualanController::class, 'store']);
    Route::get('/penjualan/{id}', [PenjualanController::class, 'show']);
    Route::put('/penjualan/{id}', [PenjualanController::class, 'update']);
    Route::delete('/penjualan/{id}', [PenjualanController::class, 'destroy']);
});
