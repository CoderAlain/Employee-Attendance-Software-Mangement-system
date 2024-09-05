<?php

// use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    
    // Employee dashboard

    Route::get('/employee', [EmployeeController::class, 'index'])->name('employees.dashboard');
});

Route::middleware(['auth'])->group(function () {
    // Admin Routes
    Route::middleware(['can:admin-only'])->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/admin/employees', [AdminController::class, 'manageEmployees'])->name('admin.employees.index');
        Route::get('/admin/attendances', [AdminController::class, 'manageAttendance'])->name('admin.attendances.index');
        Route::get('/admin/employees/{employeeId}/attendance', [AdminController::class, 'viewEmployeeAttendance'])->name('admin.attendance.view');
        Route::get('/admin/reports', [AdminController::class, 'generateMonthlyReport'])->name('admin.reports.attendance');
        
    });

    // Employee Routes (Non-admins can access)
   Route::middleware(['can:admin-only'])->group(function () {
    // Employee management routes
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/admin/employees', [EmployeeController::class, 'index'])->name('admin.employees.index');
    Route::get('/admin/employees/create', [EmployeeController::class, 'create'])->name('admin.employees.create');
    Route::post('/admin/employees', [EmployeeController::class, 'store'])->name('admin.employees.store');
    Route::get('/admin/employees/{id}/edit', [EmployeeController::class, 'edit'])->name('admin.employees.edit');
    Route::put('/admin/employees/{id}', [EmployeeController::class, 'update'])->name('admin.employees.update');
    Route::delete('/admin/employees/{id}', [EmployeeController::class, 'destroy'])->name('admin.employees.destroy');
});

    // Attendance Routes
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::post('/attendance/checkin', [AttendanceController::class, 'checkIn'])->name('attendance.checkin');
    Route::post('/attendance/checkout', [AttendanceController::class, 'checkOut'])->name('attendance.checkout');
    Route::get('/attendance/report', [AttendanceController::class, 'generateMonthlyReport'])->name('attendance.report');
});

require __DIR__.'/auth.php';