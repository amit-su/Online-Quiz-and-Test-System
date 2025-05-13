<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Question;
use App\Models\ExamSedule;
use App\Models\exam_sedule;
use phpDocumentor\Reflection\Types\This;

class QuestionManager extends Component
{
    public $questions;
    public $exams;
    public $examId;
    public $question_id;
    public $exam_id;
    public $question_text;
    public $question_type = 'mcq';
    public $option_a;
    public $option_b;
    public $option_c;
    public $option_d;
    public $correct_answer;
    public $attempt_time = 60;
    public $showModel = false;
    public $editMode = false;

    public function mount()
    {
        $this->examId = session('exam_id'); // get from session

        // use $this->examId here, not $examId
        $this->exams = exam_sedule::all();
        $this->loadQuestions();
    }

    public function onQuestionTypeChange($value)
    {
        $this->question_type = $value;


        if ($value === 'true_false') {
            $this->option_a = 'True';
            $this->option_b = 'False';
            $this->option_c = null;
            $this->option_d = null;
        } elseif ($value === 'mcq') {
            $this->option_a = '';
            $this->option_b = '';
            $this->option_c = '';
            $this->option_d = '';
        } else {
            // For SAQ or other types
            $this->option_a = null;
            $this->option_b = null;
            $this->option_c = null;
            $this->option_d = null;
        }
    }


    public function showQuesctionForm()
    {
        $this->showModel = true;
    }

    public function loadQuestions()
    {
        $this->questions = Question::where('exam_id', $this->examId)->get();
    }


    public function save()
    {
        $this->validate([
            'question_text' => 'required|string',
            'question_type' => 'required|in:mcq,true_false,saq',
            'correct_answer' => 'required|string',
            'attempt_time' => 'required|integer|min:10',
        ]);

        if ($this->editMode) {
            $question = Question::find($this->question_id);
        } else {
            $question = new Question();
        }
        $question->exam_id = $this->examId;
        $question->question_text = $this->question_text;
        $question->question_type = $this->question_type;

        if ($this->question_type === 'true_false') {
            $question->option_a = 'True';
            $question->option_b = 'False';
            $question->option_c = null;
            $question->option_d = null;
        } else {
            $question->option_a = $this->option_a;
            $question->option_b = $this->option_b;
            $question->option_c = $this->option_c;
            $question->option_d = $this->option_d;
        }

        $question->correct_answer = $this->correct_answer;
        $question->attempt_time = $this->attempt_time;
        $question->save();
        session()->flash('success', $this->editMode ? 'Question updated.' : 'Question created.');

        $this->resetForm();
        $this->loadQuestions();
    }

    public function edit($id)
    {

        $q = Question::findOrFail($id);
        $this->editMode = true;
        $this->question_id = $q->id;
        $this->exam_id = $q->exam_id;
        $this->question_text = $q->question_text;
        $this->question_type = $q->question_type ?? 'mcq';
        $this->option_a = $q->option_a;
        $this->option_b = $q->option_b;
        $this->option_c = $q->option_c;
        $this->option_d = $q->option_d;
        $this->correct_answer = $q->correct_answer;
        $this->attempt_time = $q->attempt_time;
        $this->showModel = true;
    }

    public function delete($id)
    {
        Question::destroy($id);
        session()->flash('success', 'Question deleted.');
        $this->loadQuestions();
    }

    public function resetForm()
    {
        $this->reset([
            'question_id',
            'exam_id',
            'question_text',
            'question_type',
            'option_a',
            'option_b',
            'option_c',
            'option_d',
            'correct_answer',
            'attempt_time',
            'editMode',
        ]);

        // Optionally reset question_type to default
        $this->question_type = 'mcq';
    }


    // private function fromReset()
    // {
    //     $this->question_type = "mcq";
    //     $this->question_text = "";
    //     $this->option_a = "";
    //     $this->option_b = "";
    //     $this->option_c = "";
    //     $this->option_d = "";
    //     $this->correct_answer = "";
    //     $this->attempt_time = "60";
    // }


    public function render()
    {

        return view('livewire.question-manager');
    }
}
