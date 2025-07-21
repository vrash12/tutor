<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Parent\ParentController;
use App\Http\Controllers\Student\StudentController;


Route::get('/', fn() => view('welcome'))->name('welcome');

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.post');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function() {
  
    Route::get('/home', fn() => view('home'))->name('home');

 
    Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function() {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('parents',   [AdminController::class, 'manageParents'])->name('parents');
        Route::get('students',  [AdminController::class, 'manageStudents'])->name('students');
        Route::get('classes',   [AdminController::class, 'manageClasses'])->name('classes');
        Route::get('schedules', [AdminController::class, 'manageSchedules'])->name('schedules');
        Route::get('reports',   [AdminController::class, 'showReports'])->name('reports');
        Route::get('announcements/create', [AdminController::class, 'showAnnouncementForm'])->name('announcement.form');
        Route::post('announcements',         [AdminController::class, 'postAnnouncement'])->name('announcement.post');
    });

 
    Route::prefix('parent')->name('parent.')->middleware('role:parent')->group(function() {
        Route::get('dashboard',   [ParentController::class, 'dashboard'])->name('dashboard');
        Route::get('profile',     [ParentController::class, 'showProfile'])->name('profile');
        Route::put('profile',     [ParentController::class, 'updateProfile'])->name('profile.update');
        Route::get('schedules',   [ParentController::class, 'listSchedules'])->name('schedules');
        Route::post('enroll',     [ParentController::class, 'enroll'])->name('enroll');
        Route::get('enrollments', [ParentController::class, 'myEnrollments'])->name('enrollments');
    });


    Route::prefix('student')->name('student.')->group(function() {
        Route::get('/',            [StudentController::class, 'index'])->name('index');
        Route::get('create',       [StudentController::class, 'create'])->name('create');
        Route::post('/',           [StudentController::class, 'store'])->name('store');
        Route::get('{id}/edit',    [StudentController::class, 'edit'])->name('edit');
        Route::put('{id}',         [StudentController::class, 'update'])->name('update');
        Route::delete('{id}',      [StudentController::class, 'destroy'])->name('destroy');
    });
});
