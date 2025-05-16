<div class="p-6 bg-white shadow-xl rounded-2xl">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Manage Notifications</h1>
        <button wire:click="$set('showModal', true)" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
            + Create Notification
        </button>
    </div>

    {{-- Notification Popup --}}
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            window.addEventListener('notification:success', event => {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: event.detail.message,
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
            });
        </script>
    @endpush

    {{-- Modal Form --}}
    @if ($showModal)
        <div x-data="{ show: true }" x-init="$nextTick(() => show = true)" x-show="show"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm">
            <div class="w-full max-w-2xl p-6 bg-white rounded shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold">
                        {{ $isEditMode ? 'Edit Notification' : 'Create Notification' }}
                    </h2>
                    <button wire:click="$set('showModal', false)"
                        class="text-gray-500 hover:text-gray-800">&times;</button>
                </div>

                <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'store' }}" class="space-y-4">

                    <div>
                        <label class="block mb-1 font-semibold">Title</label>
                        <input type="text" wire:model.defer="title"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" />
                        @error('title')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-1 font-semibold">Message</label>
                        <textarea wire:model.defer="message" rows="4"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                        @error('message')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <label class="block mb-1 font-semibold">Schedule Date & Time</label>
                            <input type="datetime-local" wire:model.defer="schedule_date"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" />
                            @error('schedule_date')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-1 font-semibold">Expire Date & Time</label>
                            <input type="datetime-local" wire:model.defer="expire_date"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" />
                            @error('expire_date')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <input type="checkbox" wire:model="status" id="status" />
                        <label for="status" class="font-semibold select-none">Active</label>
                    </div>

                    <div class="flex justify-end gap-4 pt-4 border-t">
                        <button type="button" wire:click="$set('showModal', false)"
                            class="px-4 py-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-300">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                            {{ $isEditMode ? 'Update' : 'Create' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    {{-- Table --}}
    <div class="overflow-x-auto shadow rounded-xl">
        <table class="min-w-full text-sm bg-white border border-gray-200 rounded-xl">
            <thead class="text-white bg-blue-900">
                <tr>
                    <th class="px-4 py-3 text-left">Title</th>
                    <th class="px-4 py-3 text-left">Message</th>
                    <th class="px-4 py-3 text-left">Schedule Date</th>
                    <th class="px-4 py-3 text-left">Expire Date</th>
                    <th class="px-4 py-3 text-center">Status</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 divide-y divide-gray-200">
                @forelse ($notifications as $notification)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $notification->title }}</td>
                        <td class="px-4 py-3">{{ \Illuminate\Support\Str::limit($notification->message, 40) }}</td>
                        <td class="px-4 py-3">{{ $notification->schedule_date->format('Y-m-d H:i') }}</td>
                        <td class="px-4 py-3">{{ $notification->expire_date->format('Y-m-d H:i') }}</td>
                        <td class="px-4 py-3 text-center">
                            @if ($notification->status)
                                <span
                                    class="inline-flex px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">
                                    Active
                                </span>
                            @else
                                <span
                                    class="inline-flex px-2 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded-full">
                                    Inactive
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center">
                            <button wire:click="edit({{ $notification->id }})"
                                class="px-3 py-1 text-sm font-semibold text-white transition duration-200 bg-blue-600 border border-blue-600 rounded-lg hover:bg-blue-700">Edit</button>
                            <button wire:click="delete({{ $notification->id }})"
                                onclick="confirm('Are you sure to delete this notification?') || event.stopImmediatePropagation()"
                                class="px-3 py-1 text-sm font-semibold text-white transition duration-200 bg-red-600 border border-red-600 rounded-lg hover:bg-red-700">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-4 text-center text-gray-500">No notifications found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>


    <div class="mt-4">
        {{ $notifications->links() }}
    </div>
</div>
