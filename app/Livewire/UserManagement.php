<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserManagement extends Component
{
    public $showModal = false;
    public $isEdit = false;  // Add this to differentiate between Add/Edit
    public $userId;          // For editing existing user
    public $users;
    public $name, $email, $role, $password;

    public function render()
    {
        $this->gateAlluser();
        return view('livewire.user-management');
    }

    public function returnRedirect()
    {
        return redirect()->route('users.index');
    }

    public function gateAlluser()
    {
        $this->users = User::latest()->get();
    }
    public function showAddUserModal()
    {
        $this->resetForm();
        $this->isEdit = false;
        $this->showModal = true;
    }

    public function addUser()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|string',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'password' => Hash::make($this->password)
        ]);

        session()->flash('message', 'User added successfully.');
        $this->render();
        $this->resetForm();
        $this->showModal = false;
        $this->returnRedirect();
    }


    public function editUser($id)
    {
        $user = '';
        $user = User::findOrFail($id);

        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->password = '';   // Optional

        $this->isEdit = true;
        $this->showModal = true;
    }

    public function updateUser()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->userId,
            'role' => 'required|string',
        ]);

        $user = User::findOrFail($this->userId);
        $user->name = $this->name;
        $user->email = $this->email;
        $user->role = $this->role;

        if (!empty($this->password)) {
            $this->validate(['password' => 'min:6']);
            $user->password = Hash::make($this->password);
        }

        $user->save();

        session()->flash('message', 'User updated successfully.');

        $this->resetForm();
        $this->showModal = false;
    }

    public function deleteUser($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            session()->flash('message', 'User deleted successfully.');
            $this->returnRedirect();
        } else {
            session()->flash('error', 'User not found.');
        }
    }
    public function closeModal()
    {
        $this->resetErrorBag();
        session()->forget('message');
        $this->showModal = false;
    }

    private function resetForm()
    {
        $this->name = '';
        $this->email = '';
        $this->role = '';
        $this->password = '';
        $this->userId = null;
        $this->isEdit = false;
    }
}
