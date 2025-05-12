<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class UserManagement extends Component
{
    public $showModal = false;  // To show/hide Add User modal

    public $name, $email, $role, $status, $username;

    public function render()
    {
        $users = User::all();

        return view('livewire.user-management', [
            'users' => $users,
        ]);
    }

    public function showAddUserModal()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function addUser()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|string',
            'status' => 'required|string',
        ]);

        User::create([
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'role' => $this->role,
            'status' => $this->status,
        ]);

        session()->flash('message', 'User added successfully.');

        $this->resetForm();
        $this->showModal = false;
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            session()->flash('message', 'User deleted successfully.');
        } else {
            session()->flash('error', 'User not found.');
        }
    }

    private function resetForm()
    {
        $this->name = '';
        $this->username = '';
        $this->email = '';
        $this->role = '';
        $this->status = '';
    }
}
