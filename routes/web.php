<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

use App\Http\Controllers\TaskController;
use App\Http\Controllers\MemberController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();


Route::group(['middleware' => ['auth']], function(){
    Route::get('/projects', [ProjectController::class, 'index'])->name('project.index');
    Route::get('/projects/{id}/show', [ProjectController::class, 'show'])->name('project.show');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('project.create');
    Route::post('/projects/store', [ProjectController::class, 'store'])->name('project.store');
    Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('project.edit');
    Route::put('/projects/{id}/update', [ProjectController::class, 'update'])->name('project.update');
    Route::delete('/projects/{id}/delete', [ProjectController::class, 'destroy'])->name('project.destroy');
    Route::post('/projects/import', [ProjectController::class, 'import'])->name('project.import');
    Route::get('/projects/export', [ProjectController::class, 'export'])->name('project.export');


    Route::get('/projects/{id}/tasks', [TaskController::class, 'index'])->name('task.index');
    Route::get('/projects/{id}/tasks/show', [TaskController::class, 'show'])->name('task.show');
    Route::get('/projects/{id}/tasks/create', [TaskController::class, 'create'])->name('task.create');
    Route::post('/projects/{id}/tasks/store', [TaskController::class, 'store'])->name('task.store');
    Route::get('/projects/{id}/tasks/{task_id}/edit', [TaskController::class, 'edit'])->name('task.edit');
    Route::put('/projects/{id}/tasks/{task_id}/update', [TaskController::class, 'update'])->name('task.update');
    Route::delete('/projects/{id}/tasks/{task_id}/delete', [TaskController::class, 'destroy'])->name('task.destroy');
    Route::post('/projects/tasks/import', [TaskController::class, 'import'])->name('task.import');
    Route::get('/projects/tasks/export', [TaskController::class, 'export'])->name('task.export');



    Route::get('/members', [MemberController::class, 'index'])->name('member.index');
    Route::get('/projects', [ProjectController::class, 'index'])->name('project.index');

    Route::get('/member/{id}/show', [MemberController::class, 'show'])->name('member.show');
    Route::get('/member/create', [MemberController::class, 'create'])->name('member.create');
    Route::post('/member/store', [MemberController::class, 'store'])->name('member.store');
    Route::get('/member/{id}/edit', [MemberController::class, 'edit'])->name('member.edit');
    Route::put('/member/{id}/update', [MemberController::class, 'update'])->name('member.update');
    Route::delete('/member/{id}/delete', [MemberController::class, 'destroy'])->name('member.destroy');
 

});