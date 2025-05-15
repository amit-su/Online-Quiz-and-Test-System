<?php

namespace App\Livewire\Student;

use Livewire\Component;
use App\Models\Answer;
use App\Models\exam_sedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class Studentdasbord extends Component
{
    public $quizAttempts = 0;
    public $testAttempts = 0;
    public $todayQuizzes = [];
    public $todayTests = [];

    public function mount()
    {
        $userId = Auth::id();

        // Total Quiz Attempted
        $this->quizAttempts = Answer::where('user_id', $userId)
            ->whereHas('exam', function ($query) {
                $query->where('exam_type', 'quiz');
            })
            ->select('exam_id')
            ->distinct()
            ->count();

        // Total Test Attempted
        $this->testAttempts = Answer::where('user_id', $userId)
            ->whereHas('exam', function ($query) {
                $query->where('exam_type', 'test');
            })
            ->select('exam_id')
            ->distinct()
            ->count();

        // Today’s Exams
        $today = Carbon::today();

        $this->todayQuizzes = exam_sedule::whereDate('exam_schedule', $today)
            ->where('exam_type', 'quiz')
            ->get();

        $this->todayTests = exam_sedule::whereDate('exam_schedule', $today)
            ->where('exam_type', 'test')
            ->get();
    }

    public function render()
    {
        return view('livewire.student.studentdasbord');
    }
}
