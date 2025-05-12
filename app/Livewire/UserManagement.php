<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;  // ✅ Import User model

class UserManagement extends Component
{
    public function render()
    {
        // ✅ Fetch all users
        $users = User::all();

        // ✅ Pass users to the view
        return view('livewire.user-management', [
            'users' => $users,
        ]);
    }
}
