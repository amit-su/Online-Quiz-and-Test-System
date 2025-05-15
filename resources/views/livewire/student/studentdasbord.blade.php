<div style="text-align: center">
    <div class="p-6 m-6 space-y-6 bg-gray-100 rounded-lg">
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
            <!-- Total Quiz Attempted -->
            <div
                class="p-6 text-white transition-transform shadow-lg bg-gradient-to-r from-blue-500 to-blue-700 rounded-2xl hover:scale-105">
                <div class="flex items-center space-x-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M9 5l7 7-7 7"></path>
                    </svg>
                    <div>
                        <h2 class="text-sm font-medium">Total Quiz Attempted</h2>
                        <p class="text-3xl font-bold">{{ $totalQuiz }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Test Attempted -->
            <div
                class="p-6 text-white transition-transform shadow-lg bg-gradient-to-r from-green-500 to-emerald-600 rounded-2xl hover:scale-105">
                <div class="flex items-center space-x-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M3 12h18M3 6h18M3 18h18"></path>
                    </svg>
                    <div>
                        <h2 class="text-sm font-medium">Total Test Attempted</h2>
                        <p class="text-3xl font-bold">{{ $testAttempts }}</p>
                    </div>
                </div>
            </div>

            <!-- Today’s Quizzes -->
            <div
                class="p-6 text-white transition-transform shadow-lg bg-gradient-to-r from-pink-500 to-fuchsia-600 rounded-2xl hover:scale-105">
                <div class="flex items-center space-x-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M5 13l4 4L19 7"></path>
                    </svg>
                    <div>
                        <h2 class="text-sm font-medium">Today’s Quizzes</h2>
                        <p class="text-3xl font-bold">{{ $todayQuizzes }}</p>
                    </div>
                </div>
            </div>

            <!-- Today’s Tests -->
            <div
                class="p-6 text-white transition-transform shadow-lg bg-gradient-to-r from-yellow-500 to-orange-600 rounded-2xl hover:scale-105">
                <div class="flex items-center space-x-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M12 6v6l4 2"></path>
                    </svg>
                    <div>
                        <h2 class="text-sm font-medium">Today’s Tests</h2>
                        <p class="text-3xl font-bold">{{ $todayTests }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
