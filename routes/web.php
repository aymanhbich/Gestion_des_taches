<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\TacheController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test', function () {
    return view('test');
});
Route::middleware('auth')->group(function(){
    Route::get('/tasks', [TacheController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/create', [TacheController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [TacheController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{id}/edit', [TacheController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{id}', [TacheController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{id}', [TacheController::class, 'destroy'])->name('tasks.destroy');
    Route::get("/logout", [LoginController::class, "logout"])->name("login.logout");

});

Route::get("/login", [LoginController::class, "index"])->name("login")->middleware("guest");
Route::post("/login", [LoginController::class, "login"])->name("login.login")->middleware("guest");