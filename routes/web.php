<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
});

use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\AttendanceController;

Route::get('/registerform', [StudentController::class, 'registerForm'])->name('registerform');
Route::post('/register', [StudentController::class, 'register'])->name('register');


Route::get('/login', [StudentController::class, 'showLoginForm'])->name('login');
Route::post('/login', [StudentController::class, 'login']);
Route::post('/logout', [StudentController::class, 'logout'])->name('logout');

Route::middleware(['auth:student', 'role:2'])->group(function () {
    Route::get('/attendances', [AttendanceController::class, 'index'])->name('attendances.index');
    Route::get('/attendances/create/{id}', [AttendanceController::class, 'create'])->name('attendances.create');
    Route::post('/attendances', [AttendanceController::class, 'store'])->name('attendances.store');
});

Route::middleware(['auth:student', 'role:2'])->group(function () {
    Route::get('/admindashboard', function () {
        return view('admin.admindashboard');
    })->name('admin.admindashboard');
});
Route::middleware(['auth:student', 'role:1'])->group(function () {
    Route::get('/studentdashboard', function () {
        return view('user.studentdashboard');
    })->name('user.studentdashboard');
});
Route::middleware(['auth:student', 'role:2'])->group(function () {
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('/create',[StudentController::class, 'create'])->name('students.create');
    Route::post('/students',[StudentController::class, 'store'])->name('students.store');
    Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
});

Route::middleware(['auth:student', 'role:2'])->group(function () {
   Route::get("/subjects",[SubjectController::class, 'index'])->name('subjects.index');
   Route::get('/subjects/create', [SubjectController::class, 'create'])->name('subjects.create');
   Route::post('/subjects', [SubjectController::class, 'store'])->name('subjects.store');
   Route::get('/subjects/{subject}', [SubjectController::class, 'edit'])->name('subjects.edit');
   Route::put('/subjects/{id}', [SubjectController::class, 'update'])->name('subjects.update');
   Route::delete('/subjects/{subject}', [SubjectController::class, 'destroy'])->name('subjects.destroy');
});



