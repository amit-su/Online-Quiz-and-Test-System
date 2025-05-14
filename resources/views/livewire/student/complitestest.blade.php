<div class="p-6 m-10 bg-white shadow-xl md:p-8 rounded-xl">
    <h2 class="mb-4 text-xl font-semibold text-gray-800">Your Test result</h2>

    <div class="flex items-center justify-between mb-4">
        <input type="text" placeholder="Search Course"
            class="w-full px-4 py-2 text-sm border rounded-md sm:w-64 focus:outline-none focus:ring-2 focus:ring-blue-400" />
        <button class="ml-2 text-gray-500 hover:text-gray-700">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 17h5l-1.405-1.405M17 17V10M4 6h16" />
            </svg>
        </button>
    </div>

    <div class="space-y-4">
        @foreach ($completedQuizzes as $quiz)
            @php
                $score = ($quiz->correct_answers / $quiz->total_questions) * 100;
                $scoreTextColor = $score >= 80 ? 'text-green-600' : ($score >= 50 ? 'text-yellow-600' : 'text-red-600');
                $scoreFont = $score >= 80 ? 'font-bold' : 'font-semibold';
            @endphp

            <div class="flex items-center justify-between px-4 py-3 rounded-lg shadow-sm bg-gray-50">
                <div class="flex items-center gap-4">
                    <div
                        class="flex items-center justify-center w-10 h-10 font-semibold text-blue-700 bg-blue-100 rounded-lg">
                        {{ strtoupper(substr($quiz->exam->title, 0, 1)) }}
                    </div>
                    <div class="flex flex-col">
                        <span class="font-medium text-gray-800">{{ $quiz->exam->title }}</span>
                        <span class="text-sm text-gray-500">{{ $quiz->exam_date }}</span>
                    </div>
                </div>

                <div class="text-sm font-semibold text-gray-700">
                    {{ $quiz->total_questions }} Qs
                </div>

                <div class="text-sm font-semibold text-gray-700">
                    {{ $quiz->correct_answers }}/{{ $quiz->total_questions }} Qs
                </div>

                <div class="text-sm {{ $scoreTextColor }} {{ $scoreFont }}">
                    {{ number_format($score, 0) }}%
                </div>
            </div>
        @endforeach
    </div>
</div>
