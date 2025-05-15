<div class="p-6 bg-white shadow-xl rounded-2xl">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold text-blue-900">Quiz Sudule</h2>
        <button wire:click="showExamScheduleModal"
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Create New Quiz Sudule
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
                    <th class="px-6 py-4 text-sm font-semibold tracking-wider text-left uppercase">
                        Quiz Date Time
                    </th>
                    <th class="px-6 py-4 text-sm font-semibold tracking-wider text-left uppercase">Duration</th>
                    <th class="px-6 py-4 text-sm font-semibold tracking-wider text-left uppercase">title</th>
                    <th class="px-6 py-4 text-sm font-semibold tracking-wider text-left uppercase">Create Date</th>
                    <th class="px-6 py-4 text-sm font-semibold tracking-wider text-left uppercase rounded-tr-xl">
                        Actions
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @foreach ($examSchedule as $exam)
                    <tr
                        class="p-4 transition duration-300 ease-in-out border border-white rounded-lg hover:bg-indigo-50 hover:shadow-md">
                        <td class="px-6 py-4 border-white whitespace-nowrap">
                            <div class="text-lg font-semibold text-indigo-900">{{ $loop->iteration }}</div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-lg font-medium text-orange-700">{{ $exam->exam_schedule }}</div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div
                                class="inline-block px-3 py-1 text-lg font-semibold text-indigo-700 bg-indigo-100 rounded-full">
                                {{ $exam->duration }} Minutes
                            </div>
                        </td>


                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-lg font-medium text-indigo-900">{{ $exam->title }}</div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-lg text-gray-500">{{ $exam->created_at->format('M d, Y') }}</div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex space-x-2">
                                <!-- Start/Stop Button -->
                                <button wire:click="toggleStatus({{ $exam->id }})"
                                    class="px-3 py-1 text-sm font-semibold rounded-lg border transition duration-200
                        {{ $exam->status
                            ? 'bg-red-600 text-white border-red-600 hover:bg-red-700'
                            : 'bg-green-600 text-white border-green-600 hover:bg-green-700' }}">
                                    {{ $exam->status ? 'Stop' : 'Start' }}
                                </button>

                                <!-- Edit Button -->
                                <button wire:click="editSchedule({{ $exam->id }})"
                                    class="px-3 py-1 text-sm font-semibold text-white transition duration-200 bg-blue-600 border border-blue-600 rounded-lg hover:bg-blue-700">
                                    Edit
                                </button>

                                <!-- Set Question Button -->
                                <button wire:click="navigateToQuestions({{ $exam->id }})"
                                    class="px-3 py-1 text-sm font-semibold text-white transition duration-200 border rounded-lg bg-emerald-600 border-emerald-600 hover:bg-emerald-700">
                                    Set Question
                                </button>

                                <!-- Delete Button -->
                                <button wire:click="delete({{ $exam->id }})"
                                    class="px-3 py-1 text-sm font-semibold text-white transition duration-200 bg-red-600 border border-red-600 rounded-lg hover:bg-red-700">
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
                <h2 class="mb-6 text-2xl font-semibold">Create New Quiz</h2>



                <div class="space-y-5">

                    <!-- Exam Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Quiz Title</label>
                        <input type="text" wire:model.defer="title" required
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Quiz
                            Description</label>
                        <textarea wire:model.defer="description" rows="3"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Exam Schedule -->
                    <div>
                        <label for="exam_schedule" class="block text-sm font-medium text-gray-700">Quiz Schedule</label>
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
                        <button wire:click="closeModal"
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
