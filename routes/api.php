<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\studentController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ClassroomController;
use App\Http\Middleware\StudentMiddleware;
use Illuminate\Routing\Router;

// Estudiantes
Route::controller(studentController::class)->middleware(StudentMiddleware::class)->group(function()
{

    Route::get('/students','getAll');

    Route::get("/student/{id}", 'get');
    
    Route::delete("/student/{id}", 'delete');
    
    Route::post("/student", 'create');
    
    Route::put("/student/{id}",'update');

});
// Escuela
Route::controller(SchoolController::class)->group(function()
{
    Route::get('/school','getAll');

    Route::get('/school/classroom/{id}','getAllClassroom');

    Route::get("/school/{id}",'get');

    Route::delete("/school/{id}",'delete');

    Route::post("/school",'create');

    Route::put("/school/{id}",'update');
});
// Profesor
Route::controller(TeacherController::class)->group(function()
{
    Route::get('/teacher','getAll');

    Route::get("/teacher/{id}",'get');

    Route::delete("/teacher/{id}",'delete');

    Route::post("/teacher",'create');

    Route::put("/teacher/{id}",'update');
});
//Aula
Route::controller(ClassroomController::class)->group(function()
{
    Route::get("/classroom/{idSchool}", 'get');

    Route::delete("/classroom/{id}", 'delete');

    Route::post("/classroom", 'create');

    Route::put("/classroom/{id}", 'update');
});
?>