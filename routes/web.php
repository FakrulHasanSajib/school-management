<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return response()->json([
        'message' => 'School Management API is running. Go to /api/login to start.',
    ]);
});
