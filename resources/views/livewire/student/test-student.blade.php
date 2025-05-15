<div class="min-h-screen p-4 md:p-8">
    <div class="mx-auto max-w-7xl">
        <!-- Header -->
        <header class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Today's Test</h1>
            <p class="mt-2 text-gray-600">Select a Test to begin your assessment</p>
        </header>

        <!-- Today's Exams -->
        <div class="space-y-10">
            @php
                use Carbon\Carbon;

                $today = Carbon::today();
                $todayExams = [];

                foreach ($exams as $exam) {
                    $startTime = Carbon::parse($exam->exam_schedule);
                    if ($startTime->isSameDay($today)) {
                        $todayExams[] = $exam;
                    }
                }
            @endphp

            @if (count($todayExams))
                <section class="space-y-4">
                    <h2 class="flex items-center text-xl font-semibold text-gray-700">
                        <span class="mr-2">📅 Today</span>
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ count($todayExams) }}
                        </span>
                    </h2>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($todayExams as $exam)
                            @php
                                $startTime = Carbon::parse($exam->exam_schedule);
                                $endTime = $startTime->copy()->addMinutes($exam->duration);
                                $isActive = $now->lt($endTime);
                                $timeRemaining = $now->diffForHumans($endTime, [
                                    'syntax' => Carbon::DIFF_RELATIVE_TO_NOW,
                                ]);
                            @endphp

                            <div
                                class="overflow-hidden transition-shadow duration-200 bg-white border border-gray-200 rounded-lg shadow-xl hover:shadow-md">
                                <div class="p-5">
                                    <div class="flex items-start justify-between">
                                        <h3 class="mb-1 text-lg font-semibold text-gray-800">
                                            {{ $exam->title ?? 'Untitled Exam' }}</h3>
                                        @if ($isActive)
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                                Active
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                                                Expire
                                            </span>
                                        @endif
                                    </div>

                                    <div class="mt-3 space-y-2 text-sm text-gray-600">
                                        <div class="flex items-center">
                                            <svg class="flex-shrink-0 mr-1.5 h-4 w-4 text-gray-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>{{ $startTime->format('M j, Y g:i A') }}</span>
                                        </div>

                                        <div class="flex items-center">
                                            <svg class="flex-shrink-0 mr-1.5 h-4 w-4 text-gray-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Duration: {{ $exam->duration }} minutes</span>
                                        </div>

                                        @if ($isActive)
                                            <div class="flex items-center text-blue-600">
                                                <svg class="flex-shrink-0 mr-1.5 h-4 w-4" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span>Ends {{ $timeRemaining }}</span>
                                            </div>
                                        @else
                                            <div class="flex items-center text-gray-500">
                                                <svg class="flex-shrink-0 mr-1.5 h-4 w-4" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span>Starts {{ $now->diffForHumans($startTime) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="px-5 py-3 border-t border-gray-200 bg-gray-50">
                                    @if ($isActive)
                                        <button wire:click="quizPage({{ $exam->id }})"
                                            class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            <svg class="-ml-0.5 mr-2 h-4 w-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                                            </svg>
                                            Start Test
                                        </button>
                                    @else
                                        <button disabled
                                            class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-transparent rounded-md shadow-sm cursor-not-allowed">
                                            <svg class="-ml-0.5 mr-2 h-4 w-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Expire {{ $startTime->diffForHumans() }}
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

            @if (count($exams) === 0)
                <div
                    class="flex flex-col items-center justify-center py-16 shadow-xl bg-gradient-to-r from-indigo-100 via-purple-100 to-pink-100 rounded-xl">
                    <div class="p-6 bg-white rounded-full shadow-md">
                        <svg class="w-16 h-16 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
                        </svg>
                    </div>
                    <h3 class="mt-6 text-2xl font-semibold text-gray-800">No Test Available</h3>
                    <p class="max-w-md mt-2 text-sm text-center text-gray-600">
                        Oops! There are no scheduled Test at the moment. We're working on updating the schedule. Please
                        check back soon.
                    </p>

                </div>
            @endif

        </div>
    </div>
</div>
