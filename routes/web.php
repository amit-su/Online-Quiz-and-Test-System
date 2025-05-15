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
use App\Livewire\Student\Studentdasbord;
use App\Livewire\Notifications;
use App\Livewire\UnauthorizedAccess;

Route::aliasMiddleware('role', \App\Http\Middleware\RoleMiddleware::class);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

Route::get('/unauthorized', UnauthorizedAccess::class)->name('unauthorized.index');

Route::middleware('role:admin,instructor')->group(function () {
    Route::get('/admin/notifications', Notifications::class)->name('admin.notifications.index');
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/userManagement', UserManagement::class)->name('users.index');
    Route::get('/users', \App\Livewire\UserManagement::class)->name('users');
    Route::get('/examSedule', Exam::class)->name('exam.index');
    Route::get('/testsedule', Test::class)->name('test.index');
    Route::get('/questions-set', QuestionManager::class)->name('questions.index');
});


//student
Route::middleware('role:student')->group(function () {
    Route::get('/student-dasbord', Studentdasbord::class)->name('Studentdasbord.index');
    Route::get('/quiz-page', QuizPage::class)->name('QuizPage.index');
    Route::get('/complitesQuizes', ComplitesQuiz::class)->name('complitesQuizes.index');
    Route::get('/quiz', Quiz::class)->name('Quiz.index');
    Route::get('/student-test', TestStudentpage::class)->name('TestStudentpage.index');
    Route::get('/test', TestStudent::class)->name('TestStudent.index');
    Route::get('/complitesTest', Complitestest::class)->name('complitesTest.index');
});

require __DIR__ . '/auth.php';
