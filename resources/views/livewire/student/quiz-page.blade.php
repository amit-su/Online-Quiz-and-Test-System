<div class="max-w-2xl p-6 mx-auto bg-white shadow-lg rounded-2xl">
    {{-- Countdown Timer --}}
    <div class="p-4 mb-4 text-center bg-gray-100 rounded-lg" x-data="countdownTimer('{{ $examEnd->format('Y-m-d H:i:s') }}')">
        <div class="text-lg font-semibold text-gray-800">
            Time Remaining:
            <span x-text="timeLeft" :class="'text-red-600': timeLeft.includes('00:') || timeLeft === 'Time\\'s up!'"
                class="font-mono"></span>
        </div>
        <p class="text-sm text-gray-600">
            Exam ends at {{ $examEnd->format('h:i A') }}
        </p>
    </div>

    {{-- Check if current time is within exam window --}}
    @if ($now->lt($examStart) || $now->gt($examEnd))
        <div class="p-6 text-center text-yellow-800 bg-yellow-100 rounded-lg">
            <p class="font-semibold">Exam not available at this time.</p>
            <p>It can only be taken between <strong>{{ $examStart->format('Y-m-d H:i') }}</strong> and
                <strong>{{ $examEnd->format('Y-m-d H:i') }}</strong>.
            </p>
        </div>
    @endif

    {{-- If already attempted, show message and stop --}}
    @if ($attempted)
        <div class="font-semibold text-center text-red-600">
            You have already attempted this quiz and cannot retry.
        </div>
    @endif

    @php
        $total = count($questions);
        $progress = $total > 0 ? round((($currentIndex + 1) / $total) * 100) : 0;
    @endphp

    {{-- Progress Bar --}}
    <div class="mb-6">
        <div class="w-full bg-gray-200 rounded-full h-2.5">
            <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $progress }}%"></div>
        </div>
        <p class="mt-2 text-sm text-gray-600">
            @if ($total > 0)
                Question {{ $currentIndex + 1 }} of {{ $total }}
            @else
                No questions available.
            @endif
        </p>
    </div>

    {{-- Only show question if available --}}
    @if ($total > 0 && isset($questions[$currentIndex]))
        <h2 class="mb-4 text-2xl font-semibold text-gray-800">
            {{ $questions[$currentIndex]['question_text'] }}
        </h2>

        <div class="grid grid-cols-1 gap-4 mb-6 md:grid-cols-2">
            @foreach (['A', 'B', 'C', 'D'] as $opt)
                @php
                    $key = 'option_' . strtolower($opt);
                    $text = $questions[$currentIndex][$key] ?? null;
                @endphp
                @if ($text)
                    <button type="button" wire:click="$set('selectedAnswer','{{ $opt }}')"
                        class="flex items-center p-4 border rounded-lg transition-shadow
                               {{ $selectedAnswer === $opt ? 'border-blue-600 bg-blue-50' : 'border-gray-200 bg-white' }}">
                        <span
                            class="inline-block w-8 h-8 flex items-center justify-center rounded-full
                                     {{ $selectedAnswer === $opt ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }}">
                            {{ $opt }}
                        </span>
                        <span class="ml-4">{{ $text }}</span>
                    </button>
                @endif
            @endforeach
        </div>

        {{-- Next/Submit Button --}}
        <button wire:click="saveAnswer"
            class="w-full py-3 font-medium rounded-xl text-white
                   {{ $selectedAnswer ? 'bg-blue-600 hover:bg-blue-700' : 'bg-blue-300 cursor-not-allowed' }}"
            {{ $selectedAnswer ? '' : 'disabled' }}>
            {{ $currentIndex + 1 === $total ? 'Submit Quiz' : 'Next Question' }}
        </button>
    @endif

    @if (session()->has('success'))
        <div class="p-4 mt-4 text-green-800 bg-green-100 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <script>
        function countdownTimer(endTimeStr) {
            return {
                timeLeft: 'Calculating...',
                interval: null,
                init() {
                    const endTime = new Date(endTimeStr);
                    this.updateTime(endTime);
                    this.interval = setInterval(() => this.updateTime(endTime), 1000);
                },
                updateTime(endTime) {
                    const now = new Date();
                    const diff = endTime - now;

                    if (diff <= 0) {
                        this.timeLeft = "Time's up!";
                        clearInterval(this.interval);
                        // Trigger Livewire auto-submit
                        Livewire.dispatch('timerExpired');
                        return;
                    }

                    const hours = Math.floor(diff / (1000 * 60 * 60));
                    const mins = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                    const secs = Math.floor((diff % (1000 * 60)) / 1000);

                    if (hours > 0) {
                        this.timeLeft =
                            `${String(hours).padStart(2, '0')}:${String(mins).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
                    } else {
                        this.timeLeft = `${String(mins).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
                    }
                },
                destroy() {
                    clearInterval(this.interval);
                }
            }
        }
    </script>
</div>
