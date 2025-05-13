<div class="p-6 bg-white shadow-xl rounded-2xl">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold text-blue-900">Exam Sudule</h2>
        <button wire:click="showExamScheduleModal"
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Create New Exam Sudule
        </button>
    </div>


    @if (session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show" x-transition
            class="p-4 mb-4 text-green-700 bg-green-100 rounded">
            {{ session('success') }}
        </div>
    @endif



    <div class="overflow-x-auto shadow rounded-xl">
        <table class="min-w-full bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl">
            <thead class="text-white bg-blue-900">
                <tr>
                    <th class="px-6 py-4 text-sm font-semibold tracking-wider text-left uppercase rounded-tl-xl">
                        El No
                    </th>
                    <th class="px-6 py-4 text-sm font-semibold tracking-wider text-left uppercase rounded-tl-xl">
                        Exam Date Time
                    </th>
                    <th class="px-6 py-4 text-sm font-semibold tracking-wider text-left uppercase">Duration</th>
                    <th class="px-6 py-4 text-sm font-semibold tracking-wider text-left uppercase">title</th>
                    <th class="px-6 py-4 text-sm font-semibold tracking-wider text-left uppercase">Create Date</th>
                    <th class="px-6 py-4 text-sm font-semibold tracking-wider text-left uppercase rounded-tr-xl">
                        Actions
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-blue-100">
                @foreach ($examSchedule as $exam)
                    <tr class="transition duration-150 ease-in-out hover:bg-white hover:shadow-sm">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-indigo-900">{{ $loop->iteration }}</div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">

                            <div class="text-sm font-medium text-blue-900">{{ $exam->exam_schedule }}
                            </div>

                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-indigo-900">{{ $exam->duration }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-indigo-900">{{ $exam->title }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-indigo-900">{{ $exam->created_at }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex space-x-3">

                                <button wire:click="editSchedule({{ $exam->id }})"
                                    class="px-3 py-1 text-sm font-semibold text-blue-600 transition duration-200 border border-blue-600 rounded hover:bg-blue-600 hover:text-white">
                                    Edit
                                </button>

                                <button wire:click="delete({{ $exam->id }})"
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





    @if ($showModal)
        <div x-data="{ show: true }" x-init="$nextTick(() => show = true)" x-show="show"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm">

            <div class="w-[90%] max-w-[900px] p-6 bg-white rounded-2xl shadow-xl sm:p-8">
                <h2 class="mb-6 text-2xl font-semibold">Create New Exam</h2>



                <div class="space-y-5">

                    <!-- Exam Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Exam Title</label>
                        <input type="text" wire:model.defer="title" required
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Exam
                            Description</label>
                        <textarea wire:model.defer="description" rows="3"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Exam Schedule -->
                    <div>
                        <label for="exam_schedule" class="block text-sm font-medium text-gray-700">Exam Schedule</label>
                        <input type="datetime-local" wire:model.defer="exam_schedule" required
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('exam_schedule')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Duration -->
                    <div>
                        <label for="duration" class="block text-sm font-medium text-gray-700">Duration (in
                            minutes)</label>
                        <input type="number" wire:model.defer="duration" required min="1"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('duration')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end mt-6 space-x-3">
                        <button wire:click="$set('showModal', false)"
                            class="px-4 py-2 text-gray-700 transition duration-150 bg-gray-100 rounded-lg hover:bg-gray-200">Cancel</button>
                        @if ($showEdit)
                            <button type="submit" wire:click='update'
                                class="px-4 py-2 text-white transition bg-blue-600 rounded-md hover:bg-blue-700">
                                Update Exam
                            </button>
                        @else
                            <button type="submit" wire:click='create'
                                class="px-4 py-2 text-white transition bg-blue-600 rounded-md hover:bg-blue-700">
                                Create Exam
                            </button>
                        @endif
                    </div>
                </div>
            </div>

    @endif
</div>
