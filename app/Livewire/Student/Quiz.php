<?php

namespace App\Livewire\Student;

use Livewire\Component;
use App\Models\exam_sedule;
use Carbon\Carbon;

class Quiz extends Component
{
    public function quizPage($id)
    {
        session(['exam_id' => $id]);
        // return redirect()->route('QuizPage.index');

        return redirect()->route('QuizPage.index');
    }

    public function render()
    {
        $exams = exam_sedule::where('status', true)
            ->where('exam_type', 'quiz')
            ->latest()
            ->get();
        $now = now();

        return view('livewire.student.quiz', [
            'exams' => $exams,
            'now' => $now,
        ]);
    }
}
