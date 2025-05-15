<div class="max-w-4xl p-6 mx-auto bg-white rounded shadow">

    <h1 class="mb-6 text-2xl font-bold">Manage Notifications</h1>

    @if (session()->has('success'))
        <div class="p-3 mb-4 text-green-700 bg-green-100 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Form --}}
    <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'store' }}" class="mb-8 space-y-4">

        <div>
            <label class="block mb-1 font-semibold">Title</label>
            <input type="text" wire:model.defer="title" class="w-full px-3 py-2 border rounded" />
            @error('title')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="block mb-1 font-semibold">Message</label>
            <textarea wire:model.defer="message" rows="4" class="w-full px-3 py-2 border rounded"></textarea>
            @error('message')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="block mb-1 font-semibold">Schedule Date & Time</label>
            <input type="datetime-local" wire:model.defer="schedule_date" class="w-full px-3 py-2 border rounded" />
            @error('schedule_date')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="block mb-1 font-semibold">Expire Date & Time</label>
            <input type="datetime-local" wire:model.defer="expire_date" class="w-full px-3 py-2 border rounded" />
            @error('expire_date')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex items-center gap-2">
            <input type="checkbox" wire:model="status" id="status" />
            <label for="status" class="font-semibold select-none">Active</label>
            @error('status')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                {{ $isEditMode ? 'Update Notification' : 'Create Notification' }}
            </button>

            @if ($isEditMode)
                <button type="button" wire:click="resetInputFields"
                    class="px-4 py-2 ml-4 text-white bg-gray-400 rounded hover:bg-gray-500">
                    Cancel
                </button>
            @endif
        </div>
    </form>

    {{-- Notifications List --}}
    <table class="w-full border border-collapse border-gray-300 table-auto">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 text-left border border-gray-300">Title</th>
                <th class="p-2 text-left border border-gray-300">Message</th>
                <th class="p-2 text-left border border-gray-300">Schedule Date</th>
                <th class="p-2 text-left border border-gray-300">Expire Date</th>
                <th class="p-2 text-center border border-gray-300">Status</th>
                <th class="p-2 text-center border border-gray-300">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($notifications as $notification)
                <tr class="border-t border-gray-300">
                    <td class="p-2 border border-gray-300">{{ $notification->title }}</td>
                    <td class="p-2 border border-gray-300">
                        {{ \Illuminate\Support\Str::limit($notification->message, 50) }}</td>
                    <td class="p-2 border border-gray-300">{{ $notification->schedule_date->format('Y-m-d H:i') }}</td>
                    <td class="p-2 border border-gray-300">{{ $notification->expire_date->format('Y-m-d H:i') }}</td>
                    <td class="p-2 text-center border border-gray-300">
                        @if ($notification->status)
                            <span class="font-semibold text-green-600">Active</span>
                        @else
                            <span class="font-semibold text-red-600">Inactive</span>
                        @endif
                    </td>
                    <td class="p-2 space-x-2 text-center border border-gray-300">
                        <button wire:click="edit({{ $notification->id }})"
                            class="text-blue-600 hover:underline">Edit</button>

                        <button wire:click="delete({{ $notification->id }})"
                            onclick="confirm('Delete this notification?') || event.stopImmediatePropagation()"
                            class="text-red-600 hover:underline">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $notifications->links() }}
    </div>
</div>
