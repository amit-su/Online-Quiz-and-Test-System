<div class="p-6 space-y-6">
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
        <div class="p-4 bg-white rounded shadow">
            <h2 class="text-lg font-semibold text-gray-700">Total Quiz Attempted</h2>
            <p class="text-2xl text-blue-700">{{ $quizAttempts }}</p>
        </div>
        <div class="p-4 bg-white rounded shadow">
            <h2 class="text-lg font-semibold text-gray-700">Total Test Attempted</h2>
            <p class="text-2xl text-green-700">{{ $testAttempts }}</p>
        </div>
        <div class="p-4 bg-white rounded shadow">
            <h2 class="text-lg font-semibold text-gray-700">Today’s Quizzes</h2>
            {{-- @forelse($todayQuizzes as $quiz)
                <p class="text-sm">
                    {{ \Carbon\Carbon::parse($test->exam_schedule) }}</p>
            @empty --}}
            <p class="text-sm text-gray-500">No quizzes today</p>
            {{-- @endforelse --}}
        </div>
        <div class="p-4 bg-white rounded shadow">
            <h2 class="text-lg font-semibold text-gray-700">Today’s Tests</h2>
            @forelse($todayTests as $test)
                {{-- <p class="text-sm">{{ $test->title }} - {{ $test->exam_schedule->format('h:i A') }}</p> --}}
            @empty
                <p class="text-sm text-gray-500">No tests today</p>
            @endforelse
        </div>
    </div>
</div>
