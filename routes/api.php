<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\AssignSubjectController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SchoolClassController; // এখানে কন্ট্রোলারটি সঠিকভাবে ইমপোর্ট করা হয়েছে

// Authentication Routes
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    // Admin-only routes
    Route::middleware('admin')->group(function () {
        Route::apiResource('classes', SchoolClassController::class); // সঠিক কন্ট্রোলার ব্যবহার করা হয়েছে
        Route::apiResource('sections', SectionController::class);
        Route::apiResource('subjects', SubjectController::class);
        Route::apiResource('assign-subjects', AssignSubjectController::class);
    });
});