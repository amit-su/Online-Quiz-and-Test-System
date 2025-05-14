<?php

namespace App\Livewire\Student;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Answer;
use App\Models\Question;

class ComplitesQuiz extends Component
{
    public $completedQuizzes = [];

    public function mount()
    {
        $userId = Auth::id();

        $this->completedQuizzes = Answer::with('exam')
            ->where('user_id', $userId)
            ->selectRaw('exam_id, COUNT(*) as answered_questions, SUM(correct_answer) as correct_answers')
            ->groupBy('exam_id')
            ->get()
            ->map(function ($quiz) {
                $quiz->exam_date = optional($quiz->exam)->exam_schedule; // Adjust field name if needed
                $quiz->exam_title = optional($quiz->exam)->title; // Optional
                $quiz->total_questions = Question::where('exam_id', $quiz->exam_id)->count();
                return $quiz;
            });
    }

    public function render()
    {
        return view('livewire.student.complites-quiz');
    }
}
