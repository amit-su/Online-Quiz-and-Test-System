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
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show" x-transition.opacity.duration.500ms
            class="p-3 mb-4 text-sm text-green-800 bg-green-100 border border-green-200 rounded">
            {{ session('message') }}
        </div>
    @endif


    <div class="overflow-x-auto shadow rounded-xl max-h-[70vh] overflow-y-auto">

        <table class="min-w-full bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl">
            <thead class="sticky top-0 text-white bg-blue-900">
                <tr>
                    <th class="px-6 py-4 text-sm font-semibold tracking-wider text-left uppercase rounded-tl-xl">
                        Name
                    </th>
                    <th class="px-6 py-4 text-sm font-semibold tracking-wider text-left uppercase">Email</th>
                    <th class="px-6 py-4 text-sm font-semibold tracking-wider text-left uppercase">Role</th>
                    <th class="px-6 py-4 text-sm font-semibold tracking-wider text-left uppercase rounded-tr-xl">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-blue-100">
                @foreach ($users as $user)
                    <tr class="transition duration-150 ease-in-out hover:bg-white hover:shadow-sm">
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
                        {{-- <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="inline-flex px-3 py-1 text-xs font-semibold leading-5 rounded-full
                                @if ($user->status === 'Active') bg-green-100 text-green-800
                                @elseif($user->status === 'Pending') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ $user->status }}
                            </span>
                        </td> --}}

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex space-x-3">

                                <button wire:click="editUser({{ $user->id }})"
                                    class="px-3 py-1 text-sm font-semibold text-blue-600 transition duration-200 border border-blue-600 rounded hover:bg-blue-600 hover:text-white">
                                    Edit
                                </button>

                                <button wire:click="deleteUser({{ $user->id }})"
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
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm">
            <div class="w-[90%] max-w-lg p-6 bg-white rounded-2xl shadow-xl sm:p-8">

                <h2 class="mb-6 text-2xl font-semibold text-center text-gray-800">
                    {{ $isEdit ? 'Edit User' : 'Add User' }}
                </h2>

                <div class="space-y-4">

                    <!-- Name -->
                    <input type="text" wire:model.defer="name" placeholder="Name"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                    @error('name')
                        <span class="pl-1 text-sm text-red-600">{{ $message }}</span>
                    @enderror

                    <!-- Email -->
                    <input type="email" wire:model.defer="email" placeholder="Email"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                    @error('email')
                        <span class="pl-1 text-sm text-red-600">{{ $message }}</span>
                    @enderror

                    <!-- Role -->
                    <select wire:model.defer="role"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="">Select Role</option>
                        <option value="admin">Admin</option>
                        <option value="instructor">Instructor</option>
                        <option value="student">Student</option>
                    </select>
                    @error('role')
                        <span class="pl-1 text-sm text-red-600">{{ $message }}</span>
                    @enderror

                    <!-- Password -->
                    <input type="password" wire:model.defer="password" placeholder="Password (leave empty to keep same)"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                    @error('password')
                        <span class="pl-1 text-sm text-red-600">{{ $message }}</span>
                    @enderror

                </div>

                <div class="flex justify-end mt-6 space-x-3">
                    <button wire:click="closeModal"
                        class="px-4 py-2 text-gray-700 transition duration-150 bg-gray-100 rounded-lg hover:bg-gray-200">Cancel</button>

                    @if ($isEdit)
                        <button wire:click="updateUser"
                            class="px-4 py-2 text-white transition duration-150 bg-blue-600 rounded-lg hover:bg-blue-700">Update</button>
                    @else
                        <button wire:click="addUser"
                            class="px-4 py-2 text-white transition duration-150 bg-green-600 rounded-lg hover:bg-green-700">Save</button>
                    @endif
                </div>

            </div>
        </div>
    @endif
    <p>{{ $userId }}</p>

    <div>
        <!-- Your component HTML here -->

        <script>
            Livewire.on('userAdded', () => {
                location.reload();
            });
        </script>
    </div>
</div>
