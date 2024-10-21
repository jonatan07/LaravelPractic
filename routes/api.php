<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\studentController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\TeacherController;

// Estudiantes
Route::get('/students',[studentController::class, 'getAll']);

Route::get("/student/{id}",[studentController::class, 'get']);

Route::delete("/student/{id}",[studentController::class, 'delete']);

Route::post("/student",[studentController::class, 'create']);

Route::put("/student/{id}",[studentController::class, 'update']);
// Escuela
Route::get('/school',[SchoolController::class, 'getAll']);

Route::get("/school/{id}",[SchoolController::class, 'get']);

Route::delete("/school/{id}",[SchoolController::class, 'delete']);

Route::post("/school",[SchoolController::class, 'create']);

Route::put("/school/{id}",[SchoolController::class, 'update']);
// Profesor
Route::get('/teacher',[TeacherController::class, 'getAll']);

Route::get("/teacher/{id}",[TeacherController::class, 'get']);

Route::delete("/teacher/{id}",[TeacherController::class, 'delete']);

Route::post("/teacher",[TeacherController::class, 'create']);

Route::put("/teacher/{id}",[TeacherController::class, 'update']);
?>