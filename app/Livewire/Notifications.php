<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Notification;
use Livewire\WithPagination;

class Notifications extends Component
{
    use WithPagination;

    public $title, $message, $schedule_date, $expire_date, $status = false;
    public $notificationId; // for edit
    public $isEditMode = false;

    protected $rules = [
        'title' => 'required|max:255',
        'message' => 'required',
        'schedule_date' => 'required|date|before_or_equal:expire_date',
        'expire_date' => 'required|date|after_or_equal:schedule_date',
        'status' => 'boolean',
    ];

    protected $paginationTheme = 'tailwind';

    public function resetInputFields()
    {
        $this->title = '';
        $this->message = '';
        $this->schedule_date = '';
        $this->expire_date = '';
        $this->status = false;
        $this->notificationId = null;
        $this->isEditMode = false;
    }



    public function store()
    {
        $this->validate();

        Notification::create([
            'title' => $this->title,
            'message' => $this->message,
            'schedule_date' => $this->schedule_date,
            'expire_date' => $this->expire_date,
            'status' => $this->status,
        ]);

        session()->flash('success', 'Notification created successfully.');

        $this->resetInputFields();
    }

    public function edit($id)
    {
        $notification = Notification::findOrFail($id);
        $this->notificationId = $notification->id;
        $this->title = $notification->title;
        $this->message = $notification->message;
        $this->schedule_date = $notification->schedule_date->format('Y-m-d\TH:i'); // for datetime-local input
        $this->expire_date = $notification->expire_date->format('Y-m-d\TH:i');
        $this->status = $notification->status;
        $this->isEditMode = true;
    }

    public function update()
    {
        $this->validate();

        if ($this->notificationId) {
            $notification = Notification::find($this->notificationId);
            $notification->update([
                'title' => $this->title,
                'message' => $this->message,
                'schedule_date' => $this->schedule_date,
                'expire_date' => $this->expire_date,
                'status' => $this->status,
            ]);

            session()->flash('success', 'Notification updated successfully.');

            $this->resetInputFields();
        }
    }

    public function delete($id)
    {
        Notification::findOrFail($id)->delete();
        session()->flash('success', 'Notification deleted successfully.');
    }
    public function render()
    {
        $notifications = Notification::latest()->paginate(10);

        return view('livewire.notifications', compact('notifications'));
    }
}
