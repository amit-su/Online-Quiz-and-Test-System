<?php

namespace App\Livewire\Student;

use Livewire\Component;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Models\exam_sedule;

class QuizPage extends Component
{
    public $examId;
    public $questions = [];
    public $currentIndex = 0;
    public $selectedAnswer;
    public $attempted = false;

    public $examStart = '';
    public $examEnd = '';
    public $now;
    public $startTime;

    public function mount()
    {
        $this->examId = Session::get('exam_id');
        $this->now = Carbon::now();
        if (! $this->examId) {
            abort(404, 'No exam selected.');
        }

        // Fetch exam schedule
        $exam = exam_sedule::find($this->examId);
        if (! $exam) {
            abort(404, 'Exam not found.');
        }

        $startTime = Carbon::parse($exam->exam_schedule);
        $endTime = $startTime->copy()->addMinutes($exam->duration);
        $now = Carbon::now();

        $this->examStart = $startTime;
        $this->examEnd = $endTime;


        $this->attempted = Answer::where('user_id', Auth::id())
            ->where('exam_id', $this->examId)
            ->exists();


        if (! $this->attempted) {
            $this->questions = Question::where('exam_id', $this->examId)
                ->get()
                ->toArray();
        }
    }

    public function saveAnswer()
    {
        // Prevent re-attempts
        if ($this->attempted) {
            session()->flash('error', 'You have already attempted this quiz.');
            return;
        }

        $question = $this->questions[$this->currentIndex];
        $letter = $this->selectedAnswer;
        $optKey = 'option_' . strtolower($letter);
        $answerText = $question[$optKey] ?? $letter;

        // Fetch correct answer from DB
        $dbQuestion = Question::find($question['id']);
        $isCorrect = strtolower(trim($answerText)) === strtolower(trim($dbQuestion->correct_answer)) ? 1 : 0;

        Answer::create([
            'user_id'        => Auth::id(),
            'question_id'    => $question['id'],
            'exam_id'        => $this->examId,
            'answer'         => $answerText,
            'correct_answer' => $isCorrect,
        ]);

        $this->selectedAnswer = null;
        $this->currentIndex++;

        if ($this->currentIndex >= count($this->questions)) {
            session()->flash('success', 'Quiz completed!');
            $this->attempted = true;
        }
    }


    public function render()
    {
        return view('livewire.student.quiz-page');
    }
}
