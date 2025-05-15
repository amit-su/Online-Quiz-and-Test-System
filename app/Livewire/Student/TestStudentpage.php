<?php

namespace App\Livewire\Student;

use Livewire\Component;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Models\exam_sedule;

class TestStudentpage extends Component
{
    public $examId;
    public $questions = [];
    public $answers = []; // [question_id => selected_option]
    public $currentIndex = 0;
    public $examEnd;
    public $examStart;
    public $remainingSeconds = 0;
    public $attempted = false;
    public $now;
    protected $listeners = ['timeExpired' => 'autoSubmit'];

    public function mount()
    {
        $this->examId = Session::get('exam_id');
        if (!$this->examId) abort(404, 'No exam selected.');

        $exam = exam_sedule::find($this->examId);
        if (!$exam) abort(404, 'Exam not found.');

        $this->examStart = Carbon::parse($exam->exam_schedule);
        $this->examEnd = $this->examStart->copy()->addMinutes($exam->duration);
        $now = Carbon::now();
        $this->now = Carbon::now();
        $this->remainingSeconds = $this->examEnd->diffInSeconds($now, false);

        $this->attempted = Answer::where('user_id', Auth::id())
            ->where('exam_id', $this->examId)
            ->exists();

        if (!$this->attempted) {
            $this->questions = Question::where('exam_id', $this->examId)->get();
        }
    }

    public function nextQuestion()
    {
        if (isset($this->questions[$this->currentIndex + 1])) {
            $this->currentIndex++;
        }
    }

    public function previous()
    {
        $this->currentIndex--;
    }

    public function goToQuestion($index)
    {
        $this->currentIndex = $index;
    }

    public function autoSubmit()
    {
        $this->submitExam();
    }

    public function submitExam()
    {
        if ($this->attempted) return;

        foreach ($this->answers as $questionId => $letter) {
            $question = Question::find($questionId);
            $optKey = 'option_' . strtolower($letter);
            $answerText = $question->$optKey ?? $letter;

            $isCorrect = strtolower(trim($answerText)) === strtolower(trim($question->correct_answer)) ? 1 : 0;

            Answer::create([
                'user_id'        => Auth::id(),
                'question_id'    => $questionId,
                'exam_id'        => $this->examId,
                'answer'         => $answerText,
                'correct_answer' => $isCorrect,
            ]);
        }

        $this->attempted = true;
        session()->flash('success', 'Exam submitted successfully!');
        return redirect()->route('TestStudent.index');
    }

    public function render()
    {
        return view('livewire.student.test-studentpage');
    }
}
