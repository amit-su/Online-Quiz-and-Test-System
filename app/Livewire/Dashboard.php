<?php

namespace App\Livewire;

use Livewire\Component;
use PhpParser\Node\Expr\FuncCall;
use App\Models\User;
use App\Models\exam_sedule;
use Carbon\Carbon;
use App\Models\Answer;
use App\Models\Question;

class Dashboard extends Component
{
    public $students;
    public $instructors;
    public $users;
    public $totalExamToday;
    public $totalQuizToday;
    public $studenAexam;
    public $attemptedStudents;
    public $averageMarks;

    public function mount()
    {
        $this->allUser();
    }

    public function allUser()
    {
        // Assuming 'role' is a column in the users table
        $this->users = User::count();
        $this->students = User::where('role', 'student')->count();
        $this->instructors = User::where('role', 'instructor')->count();
        $this->totalExamToday = exam_sedule::whereDate('exam_schedule', Carbon::today())->where('exam_type', 'test')->count();
        $this->totalQuizToday = exam_sedule::whereDate('exam_schedule', Carbon::today())->where('exam_type', 'quiz')->count();
    }


    public function getDataByID($examId)
    {
        if ($examId) {

            $this->attemptedStudents = Answer::where('exam_id', $examId)
                ->distinct('user_id')
                ->count('user_id');

            $totalQuestions = Question::where('exam_id', $examId)->count();

            $correctAnswers = Answer::where('exam_id', $examId)->where('correct_answer', 1)->count();


            $averageCorrectRate = 0;
            $averageMarks = 0;


            if ($totalQuestions > 0) {
                $averageCorrectRate = ($correctAnswers / $totalQuestions) * 100;
            }
        }
    }

    public function reportByid($usersId, $examId)
    {

        $result = Answer::where('user_id', $usersId)->where('exam_id', $examId)->get();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
