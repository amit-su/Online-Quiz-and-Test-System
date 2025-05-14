<div
    class="max-w-4xl p-6 mx-auto mt-6 border border-blue-100 shadow-xl bg-gradient-to-br from-white via-blue-50 to-white rounded-2xl">
    @if ($attempted)
        <div class="p-6 text-yellow-800 bg-yellow-100 border-l-4 border-yellow-400 rounded-lg shadow">
            <p class="text-lg font-semibold">You have already submitted this test.</p>
        </div>
    @else
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-extrabold text-blue-800">📝 Live Exam</h2>
            <div class="px-3 py-1 text-lg font-bold text-red-600 bg-red-100 rounded shadow">
                ⏳ Time Left: <span id="countdown" class="font-mono"></span>
            </div>
        </div>

        <!-- Question Navigation -->
        <div class="flex flex-wrap gap-2 mb-6">
            @foreach ($questions as $index => $question)
                <button wire:click="goToQuestion({{ $index }})"
                    class="w-10 h-10 flex items-center justify-center font-semibold border rounded-full transition-all
                        {{ $currentIndex === $index
                            ? 'bg-blue-600 text-white shadow-lg hover:bg-blue-700'
                            : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                    {{ $index + 1 }}
                </button>
            @endforeach
        </div>

        <!-- Current Question -->
        @if (isset($questions[$currentIndex]))
            @php $q = $questions[$currentIndex]; @endphp
            <div class="p-6 space-y-4 transition-all duration-300 bg-white border border-blue-100 shadow-md rounded-xl"
                wire:key="question-{{ $q->id }}">
                <h3 class="text-lg font-semibold text-gray-800">
                    Q{{ $currentIndex + 1 }}. {{ $q->question_text }}
                </h3>
                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                    @foreach (['A', 'B', 'C', 'D'] as $letter)
                        @php $optionText = $q->{'option_' . strtolower($letter)}; @endphp
                        <label
                            class="flex items-center p-3 transition border rounded-lg cursor-pointer hover:bg-blue-50">
                            <input type="radio" wire:model="answers.{{ $q->id }}" value="{{ $letter }}"
                                name="question_option_{{ $q->id }}"
                                class="mr-3 text-blue-600 focus:ring focus:ring-blue-300">
                            <span class="text-gray-700">{{ $letter }}. {{ $optionText }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Navigation Buttons -->
        <div class="flex items-center justify-between mt-8">
            @if ($currentIndex > 0)
                <button wire:click="previous"
                    class="px-5 py-2 text-white transition-all bg-gray-600 rounded-lg shadow hover:bg-gray-700">
                    ⬅ Previous
                </button>
            @else
                <div></div>
            @endif

            @if ($currentIndex < count($questions) - 1)
                <button wire:click="nextQuestion"
                    class="px-5 py-2 text-white transition-all bg-blue-600 rounded-lg shadow hover:bg-blue-700">
                    Next ➡
                </button>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="mt-8 text-center">
            <button wire:click="submitExam"
                class="px-6 py-3 text-lg font-semibold text-white transition-all bg-green-600 shadow-md rounded-xl hover:bg-green-700">
                ✅ Submit Exam
            </button>
        </div>
    @endif


</div>

<!-- Countdown Timer Script -->
{{-- <script>
    document.addEventListener('DOMContentLoaded', () => {
        let endTime = new Date("{{ $examEnd }}").getTime();
        let countdownEl = document.getElementById('countdown');

        let interval = setInterval(() => {
            let now = new Date().getTime();
            let remaining = endTime - now;

            if (remaining <= 0) {
                clearInterval(interval);
                Livewire.emit('timeExpired');
                countdownEl.innerText = "00:00";
                return;
            }

            let minutes = Math.floor((remaining % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((remaining % (1000 * 60)) / 1000);
            countdownEl.innerText =
                `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
        }, 1000);
    });
</script> --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        let endTime = new Date("{{ $examEnd }}").getTime();
        let countdownEl = document.getElementById('countdown');

        let interval = setInterval(() => {
            let now = new Date().getTime();
            let remaining = endTime - now;

            if (remaining <= 0) {
                clearInterval(interval);
                countdownEl.innerText = "00:00";


                Livewire.emit('timeExpired');
                return;
            }

            let minutes = Math.floor((remaining % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((remaining % (1000 * 60)) / 1000);

            countdownEl.innerText =
                `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
        }, 1000);
    });
</script>
