<?php

use App\Http\Controllers\DataController;
use App\Http\Controllers\JobsController;
use Illuminate\Support\Facades\Route;

Route::put("/data", [DataController::class, "put"]);
Route::get("/jobs", [JobsController::class, "get"]);
Route::get("/data", [DataController::class, "get"]);
Route::delete("/data", [DataController::class, "purge"]);
