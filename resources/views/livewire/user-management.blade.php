<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @livewireStyles
</head>

<body>


    <div class="p-6 bg-white shadow-xl rounded-2xl">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold text-blue-900">User Management</h2>
            <button wire:click="showAddUserModal"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Add New User
            </button>
        </div>

        @if (session()->has('message'))
            <div class="p-3 mb-4 text-sm text-green-800 bg-green-100 border border-green-200 rounded">
                {{ session('message') }}
            </div>
        @endif

        <div class="overflow-x-auto shadow rounded-xl">
            <table class="min-w-full bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl">
                <thead class="text-white bg-blue-900">
                    <tr>
                        <th class="px-6 py-4 text-sm font-semibold tracking-wider text-left uppercase">Id</th>
                        <th class="px-6 py-4 text-sm font-semibold tracking-wider text-left uppercase rounded-tl-xl">
                            Name
                        </th>
                        <th class="px-6 py-4 text-sm font-semibold tracking-wider text-left uppercase">Email</th>
                        <th class="px-6 py-4 text-sm font-semibold tracking-wider text-left uppercase">Role</th>
                        <th class="px-6 py-4 text-sm font-semibold tracking-wider text-left uppercase">Status</th>
                        <th class="px-6 py-4 text-sm font-semibold tracking-wider text-left uppercase rounded-tr-xl">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-blue-100">
                    @foreach ($users as $user)
                        <tr class="transition duration-150 ease-in-out hover:bg-white hover:shadow-sm">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-indigo-900">{{ $user->id }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10">
                                        <img class="w-10 h-10 border-2 border-blue-200 rounded-full"
                                            src="{{ $user->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=random' }}"
                                            alt="">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-blue-900">{{ $user->name }}</div>
                                        <div class="text-xs text-blue-500">{{ $user->username }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-indigo-900">{{ $user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-3 py-1 text-xs font-semibold rounded-full
                                @if ($user->role === 'Admin') bg-purple-100 text-purple-800
                                @elseif($user->role === 'Manager') bg-blue-100 text-blue-800
                                @else bg-teal-100 text-teal-800 @endif">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex px-3 py-1 text-xs font-semibold leading-5 rounded-full
                                @if ($user->status === 'Active') bg-green-100 text-green-800
                                @elseif($user->status === 'Pending') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800 @endif">
                                    {{ $user->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex space-x-3">
                                    <button wire:click="deleteUser"
                                        class="px-3 py-1 text-sm font-semibold text-red-600 transition duration-200 border border-red-600 rounded hover:bg-red-600 hover:text-white">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Add User Modal --}}
        @if ($showModal)
            <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                <div class="w-full max-w-lg p-6 bg-white rounded-lg shadow-xl">
                    <h3 class="mb-4 text-lg font-semibold text-blue-900">Add New User</h3>

                    <div class="space-y-4">
                        <input wire:model="name" type="text" placeholder="Name"
                            class="w-full px-4 py-2 border rounded focus:ring-blue-400 focus:border-blue-400">

                        <input wire:model="username" type="text" placeholder="Username"
                            class="w-full px-4 py-2 border rounded focus:ring-blue-400 focus:border-blue-400">

                        <input wire:model="email" type="email" placeholder="Email"
                            class="w-full px-4 py-2 border rounded focus:ring-blue-400 focus:border-blue-400">

                        <select wire:model="role"
                            class="w-full px-4 py-2 border rounded focus:ring-blue-400 focus:border-blue-400">
                            <option value="">Select Role</option>
                            <option value="Admin">Admin</option>
                            <option value="Manager">Manager</option>
                            <option value="User">User</option>
                        </select>

                        <select wire:model="status"
                            class="w-full px-4 py-2 border rounded focus:ring-blue-400 focus:border-blue-400">
                            <option value="">Select Status</option>
                            <option value="Active">Active</option>
                            <option value="Pending">Pending</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>

                    <div class="flex justify-end mt-6 space-x-3">
                        <button wire:click="$set('showModal', false)"
                            class="px-4 py-2 text-sm font-semibold text-gray-600 border border-gray-400 rounded hover:bg-gray-100">
                            Cancel
                        </button>
                        <button wire:click="addUser"
                            class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded hover:bg-blue-700">
                            Save User
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>


    @livewireScripts

</body>

</html>
