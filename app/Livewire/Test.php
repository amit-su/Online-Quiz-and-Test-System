<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\exam_sedule;
use App\Models\Question;

class Test extends Component
{
    public $title, $description, $exam_schedule, $duration, $exam_schedule_id;
    public $showModal = false;
    public $showEdit = false;

    public function render()
    {
        $examSchedule = exam_sedule::latest()->get();
        return view('livewire.test', ['examSchedule' => $examSchedule]);
    }

    public function showExamScheduleModal()
    {
        $this->resetForm();
        $this->showModal = true;
        $this->showEdit = false;
    }

    public function create()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'exam_schedule' => 'required|date',
            'duration' => 'required|integer|min:1',
        ]);

        exam_sedule::create([
            'title' => $this->title,
            'description' => $this->description,
            'exam_schedule' => $this->exam_schedule,
            'duration' => $this->duration,
            'created_by' => Auth::id(),
        ]);

        session()->flash('success', 'Exam created successfully!');
        $this->resetForm();
        $this->showModal = false;
    }

    public function editSchedule($id)
    {
        $data = exam_sedule::findOrFail($id);
        $this->exam_schedule_id = $data->id;
        $this->title = $data->title;
        $this->description = $data->description;
        $this->exam_schedule = $data->exam_schedule;
        $this->duration = $data->duration;
        $this->showModal = true;
        $this->showEdit = true;
    }

    public function update()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'exam_schedule' => 'required|date',
            'duration' => 'required|integer|min:1',
        ]);

        $exam = exam_sedule::findOrFail($this->exam_schedule_id);
        $exam->update([
            'title' => $this->title,
            'description' => $this->description,
            'exam_schedule' => $this->exam_schedule,
            'duration' => $this->duration,
        ]);

        session()->flash('success', 'updated successfully!');
        $this->resetForm();
        $this->showModal = false;
        $this->showEdit = false;
    }

    public function delete($id)
    {
        $exam = exam_sedule::find($id);
        $qustion = Question::find($id);

        if ($exam) {
            $exam->delete();
            $qustion->delete();
            session()->flash('success', 'deleted successfully.');
            $this->render();
        } else {
            session()->flash('error', 'User not found.');
        }
    }


    public function navigateToQuestions($examId)
    {
        session(['exam_id' => $examId]);
        return redirect()->route('questions.index');
    }



    private function resetForm()
    {
        $this->title = '';
        $this->description = '';
        $this->exam_schedule = '';
        $this->duration = '';
        $this->exam_schedule_id = '';
    }
}
