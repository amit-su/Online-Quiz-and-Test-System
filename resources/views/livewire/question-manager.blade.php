<div class="p-6 bg-white shadow-xl rounded-2xl">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold text-blue-900">Create New Quesction</h2>
        <button wire:click="showQuesctionForm"
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Create New
        </button>
    </div>

    @if (session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show"
            class="p-3 mb-4 text-green-700 transition-opacity duration-500 bg-green-100 rounded">
            {{ session('success') }}
        </div>
    @endif


    @if ($showModel)
        <div x-data="{ show: true }" x-init="$nextTick(() => show = true)" x-show="show"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
            class="fixed inset-0 z-50 flex items-center justify-center px-4 py-6 overflow-y-auto bg-black bg-opacity-50 backdrop-blur-sm">
            <div class="w-full max-w-3xl p-6 space-y-6 bg-white shadow-2xl rounded-xl sm:p-8">
                {{-- Question Text --}}
                <div>
                    <label class="block mb-1 font-medium text-gray-700">Question Text</label>
                    <textarea wire:model.defer="question_text"
                        class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" rows="4"></textarea>
                    @error('question_text')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Question Type --}}
                <select wire:model="question_type" wire:change="onQuestionTypeChange($event.target.value)"
                    class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    <option value="mcq">MCQ</option>
                    <option value="true_false">True / False</option>
                </select>


                {{-- MCQ Options --}}
                @if ($question_type === 'mcq')
                    <div class="grid grid-cols-1 gap-4 mt-4 sm:grid-cols-2">
                        <div>
                            <label class="block mb-1 text-gray-700">Option A</label>
                            <input type="text" wire:model="option_a"
                                class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block mb-1 text-gray-700">Option B</label>
                            <input type="text" wire:model="option_b"
                                class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block mb-1 text-gray-700">Option C</label>
                            <input type="text" wire:model="option_c"
                                class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block mb-1 text-gray-700">Option D</label>
                            <input type="text" wire:model="option_d"
                                class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    {{-- Correct Answer --}}
                    <div>
                        <label class="block mb-1 font-medium text-gray-700">Correct Answer</label>
                        <input type="text" wire:model="correct_answer"
                            class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    </div>
                @endif

                {{-- True/False Radio Buttons --}}
                @if ($question_type === 'true_false')
                    <div class="mt-4">
                        <label class="block mb-1 text-gray-700">Choose the Correct Answer</label>
                        <div class="flex items-center gap-6">
                            <label class="flex items-center">
                                <input type="radio" name="correct_answer" wire:model="correct_answer" value="true"
                                    class="mr-2">
                                <span class="text-gray-700">True</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="correct_answer" wire:model="correct_answer" value="false"
                                    class="mr-2">
                                <span class="text-gray-700">False</span>
                            </label>
                        </div>
                    </div>
                @endif






                {{-- Attempt Time --}}
                <div>
                    <label class="block mb-1 font-medium text-gray-700">Attempt Time (in seconds)</label>
                    <input type="number" min="10" wire:model="attempt_time"
                        class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>

                {{-- Action Buttons --}}
                <div class="flex justify-end pt-4 space-x-3 border-t">
                    <button wire:click="$set('showModel', false)"
                        class="px-4 py-2 text-gray-700 transition bg-gray-100 rounded-md hover:bg-gray-200">
                        Cancel
                    </button>

                    <button type="submit" wire:click='save';
                        class="px-4 py-2 text-white transition bg-blue-600 rounded-md hover:bg-blue-700">
                        {{ $editMode ? 'Update' : 'Save' }} Question
                    </button>

                    <button type="button" wire:click="resetForm"
                        class="px-4 py-2 text-white transition bg-gray-600 rounded-md hover:bg-gray-700">
                        Reset
                    </button>
                </div>
            </div>
        </div>
    @endif


    <div class="overflow-x-auto shadow-md rounded-xl ring-1 ring-gray-200">
        <h3 class="px-4 py-3 text-lg font-semibold text-indigo-900 bg-indigo-50 rounded-t-xl">
            All Questions
        </h3>
        <table class="min-w-full text-sm text-left text-gray-700 bg-white">
            <thead class="text-white bg-blue-900">
                <tr>
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">Question</th>
                    <th class="px-4 py-2">Type</th>
                    <th class="px-4 py-2">Option A</th>

                    <th class="px-4 py-2">Option B</th>

                    <th class="px-4 py-2">Option C</th>

                    <th class="px-4 py-2">Option D</th>

                    <th class="px-4 py-2">Correct</th>
                    <th class="px-4 py-2">Time</th>
                    <th class="px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($questions as $index => $q)
                    <tr class="transition hover:bg-indigo-50">
                        <td class="px-4 py-2">{{ $index + 1 }}</td>
                        <td class="px-4 py-2">{{ Str::limit($q->question_text, 40) }}</td>
                        <td class="px-4 py-2 uppercase">{{ $q->question_type }}</td>
                        <td class="px-4 py-2 font-medium text-green-700">{{ $q->option_a }}</td>
                        <td class="px-4 py-2 font-medium text-green-700">{{ $q->option_b }}</td>
                        <td class="px-4 py-2 font-medium text-green-700">{{ $q->option_c }}</td>
                        <td class="px-4 py-2 font-medium text-green-700">{{ $q->option_d }}</td>

                        <td class="px-4 py-2 font-medium text-green-700">{{ $q->correct_answer }}</td>
                        <td class="px-4 py-2">{{ $q->attempt_time }}s</td>
                        <td class="px-4 py-2 space-x-2">
                            <button wire:click="edit({{ $q->id }})"
                                class="px-3 py-1 text-white transition bg-green-600 rounded hover:bg-green-700">
                                Edit
                            </button>
                            <button wire:click="delete({{ $q->id }})"
                                onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                                class="px-3 py-1 text-white transition bg-red-600 rounded hover:bg-red-700">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
