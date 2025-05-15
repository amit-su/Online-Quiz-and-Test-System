<div class="p-6 m-6 bg-white shadow-xl md:p-8 rounded-2xl">
    <div class="flex flex-col gap-4 mb-6 md:flex-row md:items-center md:justify-between">
        <h2 class="text-2xl font-semibold text-gray-800">Your Courses</h2>

        <div class="flex items-center gap-2">
            <input type="text" placeholder="Search Course"
                class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg sm:w-64 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            <button class="text-gray-600 transition-colors hover:text-blue-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.405-1.405M17 17V10M4 6h16" />
                </svg>
            </button>
        </div>
    </div>

    <div class="space-y-4">
        @foreach ($completedQuizzes as $quiz)
            @php
                $score = ($quiz->correct_answers / $quiz->total_questions) * 100;
                $scoreTextColor = $score >= 80 ? 'text-green-600' : ($score >= 50 ? 'text-yellow-600' : 'text-red-600');
                $scoreBgColor = $score >= 80 ? 'bg-green-100' : ($score >= 50 ? 'bg-yellow-100' : 'bg-red-100');
                $scoreFont = $score >= 80 ? 'font-bold' : 'font-semibold';
            @endphp

            <div
                class="flex flex-col items-start justify-between p-4 transition border border-gray-200 shadow-sm md:flex-row md:items-center bg-gray-50 rounded-xl hover:shadow-md">
                <div class="flex items-center gap-4 mb-2 md:mb-0">
                    <div
                        class="flex items-center justify-center w-12 h-12 text-lg font-bold text-white bg-blue-600 rounded-lg shadow-inner">
                        {{ strtoupper(substr($quiz->exam->title, 0, 1)) }}
                    </div>
                    <div>
                        <div class="text-base font-medium text-gray-900">{{ $quiz->exam->title }}</div>
                        <div class="text-sm text-gray-500">{{ $quiz->exam_date }}</div>
                    </div>
                </div>

                <div class="flex items-center gap-6 text-sm text-gray-700">
                    <div class="text-gray-500">
                        <span class="font-medium">{{ $quiz->total_questions }}</span> Qs
                    </div>
                    <div class="text-gray-500">
                        <span class="font-medium">{{ $quiz->correct_answers }}</span>/{{ $quiz->total_questions }}
                    </div>
                    <div class="px-3 py-1 rounded-full {{ $scoreBgColor }} {{ $scoreTextColor }} {{ $scoreFont }}">
                        {{ number_format($score, 0) }}%
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
