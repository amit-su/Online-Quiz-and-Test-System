<div class="overflow-x-auto shadow rounded-xl">
    {{-- @if ($exam->count())
        @foreach ($exam as $e)
            <div>
                <strong>{{ $e->title }}</strong><br>
                Start: {{ $e->exam_schedule }}<br>
                Duration: {{ $e->duration }} minutes
            </div>
        @endforeach
    @else
        <p>No active exams currently. </p>
    @endif --}}

    <table class="min-w-full bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl">
        <thead class="text-white bg-blue-900">
            <tr>
                <th class="px-6 py-4 text-sm font-semibold tracking-wider text-left uppercase rounded-tl-xl">
                    El No
                </th>
                <th class="px-6 py-4 text-sm font-semibold tracking-wider text-left uppercase">
                    Exam Date Time
                </th>
                <th class="px-6 py-4 text-sm font-semibold tracking-wider text-left uppercase">Duration</th>
                <th class="px-6 py-4 text-sm font-semibold tracking-wider text-left uppercase rounded-tr-xl">
                    Actions
                </th>
            </tr>
        </thead>

        <tbody class="divide-y divide-blue-100">
            @foreach ($exam as $exam)
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
                        <div class="flex space-x-3">

                            <button wire:click="quizPage({{ $exam->id }})"
                                class="px-3 py-1 text-sm font-semibold text-blue-600 transition duration-200 border border-blue-600 rounded hover:bg-blue-600 hover:text-white">
                                Start Quiz
                            </button>

                            {{-- <button wire:click="navigateToQuestions({{ $exam->id }})"
                                class="px-3 py-1 text-sm font-semibold text-blue-600 transition duration-200 border border-green-600 rounded hover:bg-green-600 hover:text-white">
                                Set Question
                            </button>


                            <button wire:click="delete({{ $exam->id }})"
                                class="px-3 py-1 text-sm font-semibold text-red-600 transition duration-200 border border-red-600 rounded hover:bg-red-600 hover:text-white">
                                Delete
                            </button> --}}

                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>


    </table>
</div>
