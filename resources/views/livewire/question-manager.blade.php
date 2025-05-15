<div class="p-4 bg-white shadow-xl sm:p-6 rounded-2xl">
    <!-- Header -->
    <div class="flex flex-col items-start justify-between gap-3 mb-4 sm:flex-row sm:items-center">
        <h2 class="text-xl font-semibold text-blue-900">Create New Question</h2>
        <button wire:click="showQuesctionForm"
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Create New
        </button>
    </div>

    <!-- Flash Message -->
    @if (session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show"
            class="p-3 mb-4 text-green-800 bg-green-100 border border-green-300 rounded-md">
            {{ session('success') }}
        </div>
    @endif

    <!-- Questions Table -->
    <div class="overflow-x-auto shadow rounded-xl ring-1 ring-gray-200">
        <table class="min-w-full text-sm text-left bg-white divide-y divide-gray-200">
            <thead class="text-white bg-blue-900">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Question</th>
                    <th class="px-4 py-3">Type</th>
                    <th class="px-4 py-3">Option A</th>
                    <th class="px-4 py-3">Option B</th>
                    <th class="px-4 py-3">Option C</th>
                    <th class="px-4 py-3">Option D</th>
                    <th class="px-4 py-3">Correct</th>
                    <th class="px-4 py-3">Time</th>
                    <th class="sticky right-0 z-10 px-4 py-2 text-white bg-blue-800">Action</th>
                </tr>
            </thead>
            <tbody class="text-gray-800 divide-y divide-gray-100">
                @foreach ($questions as $index => $q)
                    <tr class="transition-all hover:bg-indigo-50">
                        <td class="px-4 py-3 font-medium text-gray-600">{{ $index + 1 }}</td>

                        <td class="px-4 py-3 max-w-[200px] truncate whitespace-nowrap" title="{{ $q->question_text }}">
                            {{ $q->question_text }}
                        </td>

                        <td class="px-4 py-3 font-semibold text-indigo-700 uppercase">
                            {{ $q->question_type }}
                        </td>

                        @foreach (['option_a', 'option_b', 'option_c', 'option_d'] as $opt)
                            <td class="px-4 py-3 max-w-[150px] truncate whitespace-nowrap font-medium text-green-800"
                                title="{{ $q->$opt }}">
                                {{ $q->$opt }}
                            </td>
                        @endforeach

                        <td class="px-4 py-3 max-w-[150px] truncate whitespace-nowrap font-medium text-purple-700">
                            {{ $q->correct_answer }}
                        </td>

                        <td class="px-4 py-3 text-gray-600">
                            {{ $q->attempt_time }}s
                        </td>

                        <td class="sticky right-0 z-10 px-4 py-3 bg-white">
                            <div class="flex flex-col gap-2 sm:flex-row">
                                <button wire:click="edit({{ $q->id }})"
                                    class="px-4 py-1 text-sm font-semibold text-white bg-green-600 rounded-md shadow hover:bg-green-700">
                                    Edit
                                </button>

                                <button wire:click="delete({{ $q->id }})"
                                    onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                                    class="px-4 py-1 text-sm font-semibold text-white bg-red-600 rounded-md shadow hover:bg-red-700">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if ($showModel)
        <div x-data="{ show: true }" x-init="$nextTick(() => show = true)" x-show="show"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
            class="fixed inset-0 z-50 flex items-center justify-center px-4 py-6 overflow-y-auto bg-black bg-opacity-50 backdrop-blur-sm">

            <div class="w-full max-w-3xl p-6 space-y-6 bg-white shadow-2xl rounded-xl sm:p-8">
                {{-- Question Text --}}
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-800">Question Text</label>
                    <textarea wire:model.defer="question_text" rows="4"
                        class="w-full p-3 text-sm border border-gray-300 rounded-lg resize-none focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Enter your question here..."></textarea>
                    @error('question_text')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Question Type --}}
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-800">Question Type</label>
                    <select wire:model="question_type" wire:change="onQuestionTypeChange($event.target.value)"
                        class="w-full p-3 text-sm border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <option value="mcq">MCQ</option>
                        <option value="true_false">True / False</option>
                    </select>
                </div>

                {{-- MCQ Options --}}
                @if ($question_type === 'mcq')
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        @foreach (['A', 'B', 'C', 'D'] as $opt)
                            <div>
                                <label class="block mb-2 text-sm text-gray-700">Option {{ $opt }}</label>
                                <input type="text" wire:model="option_{{ strtolower($opt) }}"
                                    class="w-full p-3 text-sm border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Enter Option {{ $opt }}">
                            </div>
                        @endforeach
                    </div>

                    {{-- Correct Answer --}}
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-800">Correct Answer</label>
                        <input type="text" wire:model="correct_answer"
                            class="w-full p-3 text-sm border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Enter the correct option value (e.g., Option A)">
                    </div>
                @endif

                {{-- True/False Selection --}}
                @if ($question_type === 'true_false')
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-800">Choose the Correct Answer</label>
                        <div class="flex items-center gap-6">
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="correct_answer" wire:model="correct_answer" value="true"
                                    class="text-blue-600 border-gray-300 focus:ring-blue-500">
                                <span class="text-sm text-gray-700">True</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="correct_answer" wire:model="correct_answer" value="false"
                                    class="text-blue-600 border-gray-300 focus:ring-blue-500">
                                <span class="text-sm text-gray-700">False</span>
                            </label>
                        </div>
                    </div>
                @endif

                {{-- Attempt Time --}}
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-800">Attempt Time (in seconds)</label>
                    <input type="number" min="10" wire:model="attempt_time"
                        class="w-full p-3 text-sm border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                        placeholder="e.g. 60">
                </div>

                {{-- Action Buttons --}}
                <div class="flex flex-col-reverse items-center justify-end gap-3 pt-6 border-t sm:flex-row">
                    <button wire:click="resetForm"
                        class="w-full px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded-md sm:w-auto hover:bg-gray-700">
                        Reset
                    </button>
                    <button wire:click="$set('showModel', false)"
                        class="w-full px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md sm:w-auto hover:bg-gray-200">
                        Cancel
                    </button>
                    <button wire:click="save"
                        class="w-full px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md sm:w-auto hover:bg-blue-700">
                        {{ $editMode ? 'Update' : 'Save' }} Question
                    </button>
                </div>
            </div>
        </div>
    @endif

</div>
