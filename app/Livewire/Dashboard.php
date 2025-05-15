<?php

namespace App\Livewire;

use Livewire\Component;
use PhpParser\Node\Expr\FuncCall;
use App\Models\User;
use App\Models\exam_sedule;
use Carbon\Carbon;

class Dashboard extends Component
{
    public $students;
    public $instructors;
    public $users;
    public $totalExamToday;
    public $totalQuizToday;
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

    public function render()
    {
        return view('livewire.dashboard');
    }
}
