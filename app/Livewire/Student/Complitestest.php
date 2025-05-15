<?php

namespace App\Livewire\Student;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Answer;
use App\Models\Question;

class Complitestest extends Component
{
    public $completedQuizzes = [];

    public function mount()
    {
        $userId = Auth::id();

        $this->completedQuizzes = Answer::with(['exam' => function ($query) {
            $query->where('exam_type', 'test');
        }])
            ->where('user_id', $userId)
            ->selectRaw('exam_id, COUNT(*) as answered_questions, SUM(correct_answer) as correct_answers')
            ->groupBy('exam_id')
            ->get()
            ->filter(function ($quiz) {
                return $quiz->exam !== null;
            })
            ->map(function ($quiz) {
                $quiz->exam_date = optional($quiz->exam)->exam_schedule;
                $quiz->exam_type = optional($quiz->exam)->exam_type;
                $quiz->exam_title = optional($quiz->exam)->title;
                $quiz->total_questions = Question::where('exam_id', $quiz->exam_id)->count();
                return $quiz;
            });
    }

    public function render()
    {
        return view('livewire.student.complitestest');
    }
}
