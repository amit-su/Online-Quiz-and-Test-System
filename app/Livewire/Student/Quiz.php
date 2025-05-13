<?php

namespace App\Livewire\Student;

use Livewire\Component;
use App\Models\exam_sedule;

class Quiz extends Component
{
    public function quizPage($id)
    {
        session(['exam_id' => $id]);
        return redirect()->route('QuizPage.index');
    }

    public function render()
    {

        $exam = exam_sedule::latest()->get();
        return view('livewire..student.quiz', ['exam' => $exam]);
    }
}
