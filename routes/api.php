<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LabCategoryController;
use App\Http\Controllers\LaboratoriumController;
use App\Http\Controllers\AuthenticationController;


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout', [AuthenticationController::class, 'logout']); 
    Route::post('/category', [LabCategoryController::class, 'store']);
    Route::patch('/category/{id}', [LabCategoryController::class, 'update'])->middleware('pemilik-labkat');
    Route::delete('/category/{id}', [LabCategoryController::class, 'destroy'])->middleware('pemilik-labkat');;
    Route::post('/lab', [LaboratoriumController::class, 'store']);
    Route::patch('/lab/{id}', [LaboratoriumController::class, 'update'])->middleware('pemilik-lab');;
    Route::delete('/lab/{id}', [LaboratoriumController::class, 'destroy'])->middleware('pemilik-lab');;
    
});

Route::get('/category', [LabCategoryController::class, 'index']);
Route::get('/lab', [LaboratoriumController::class, 'index']);

Route::post('/login', [AuthenticationController::class, 'login']);