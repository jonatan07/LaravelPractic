<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\studentController;

Route::get('/students',[studentController::class, 'getAll']);

Route::get("/student/{id}",[studentController::class, 'get']);

Route::delete("/student/{id}",[studentController::class, 'delete']);

Route::post("/student",[studentController::class, 'create']);

Route::put("/student/{id}",[studentController::class, 'update']);
?>