<?php

namespace App\Livewire\Student;

use Livewire\Component;
use App\Models\exam_sedule;
use Carbon\Carbon;

class TestStudent extends Component
{
    public function quizPage($id)
    {
        session(['exam_id' => $id]);
        return redirect()->route('TestStudentpage.index');
    }

    public function render()
    {
        $exams = exam_sedule::where('status', true)
            ->where('exam_type', 'test')->whereDate('exam_schedule', Carbon::today())
            ->latest()
            ->get();
        $now = now();

        return view('livewire.student.test-student', [
            'exams' => $exams,
            'now' => $now,
        ]);
    }
}
