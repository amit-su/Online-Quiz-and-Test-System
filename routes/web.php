<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Livewire\UserManagement;
use App\Livewire\Dashboard;
use App\Livewire\Exam;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/userManagement', UserManagement::class)->name('users.index');
    // User Management (you already have this)
    Route::get('/users', \App\Livewire\UserManagement::class)->name('users');

    // Quiz Management
    Route::get('/examSedule', Exam::class)->name('exam.index');

    // // Question Bank
    // Route::get('/questions', QuestionBank::class)->name('questions.index');

    // // Reports
    // Route::get('/reports', ReportViewer::class)->name('reports.index');
});

require __DIR__ . '/auth.php';
