<?php

namespace App\Livewire\Student;

use Livewire\Component;
use App\Models\Notification;

class Alert extends Component
{
    public $notifications;

    public function mount()
    {
        $this->notifications = Notification::active()
            ->latest()
            ->take(10)
            ->get();
    }
    public function render()
    {
        return view('livewire.student.alert');
    }
}
