<?php

use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    return view('auth.register');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['middleware' => ['auth']], function() {
    //Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    //Tasks 
    Route::resource('/tasks', TaskController::class);
    Route::get('/task/details/{taskID}', [TaskController::class, 'show_details'])->name('task.show_details');
    Route::put('/task/{task}/save_status', [TaskController::class, 'save_status'])->name('task.save_status');
    Route::any('/tasks/search', [TaskController::class, 'search'])->name('tasks.search');
    Route::get('complect',[TaskController::class,'complected'])->name('tasks.complect');
    
    //Comments
    Route::resource('/comments', CommentController::class);
    
    //Attachments
    Route::resource('/attachments', AttachmentController::class);

    Route::prefix('admin')->middleware(['role:admin'])->group(function() {
        Route::resource('/users', UserController::class);
        Route::resource('/roles', RolesController::class);
        Route::resource('/permissions', PermissionsController::class);
    });

});

require __DIR__.'/auth.php';
