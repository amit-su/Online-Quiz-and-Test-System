<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Livewire\UserManagement;
use App\Livewire\Dashboard;
use App\Livewire\Exam;
use App\Livewire\QuestionManager;
use App\Livewire\Student\Quiz;
use App\Livewire\Student\TestStudent;

use App\Livewire\Student\QuizPage;
use App\Livewire\Student\ComplitesQuiz;
use App\Livewire\Student\Complitestest;
use App\Livewire\Test;
use App\Livewire\Student\TestStudentpage;

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
    Route::get('/testsedule', Test::class)->name('test.index');
    // // Question Bank
    Route::get('/questions-set', QuestionManager::class)->name('questions.index');

    // // Reports
    // Route::get('/reports', ReportViewer::class)->name('reports.index');
});


//student

Route::get('/quiz-page', QuizPage::class)->name('QuizPage.index');
Route::get('/complitesQuizes', ComplitesQuiz::class)->name('complitesQuizes.index');
Route::get('/quiz', Quiz::class)->name('Quiz.index');

Route::get('/student-test', TestStudentpage::class)->name('TestStudentpage.index');
Route::get('/test', TestStudent::class)->name('TestStudent.index');
Route::get('/complitesTest', Complitestest::class)->name('complitesTest.index');

require __DIR__ . '/auth.php';
