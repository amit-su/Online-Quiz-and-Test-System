<div style="text-align: center">
    <div class="p-6 space-y-6 bg-gray-100 rounded-lg">
        <!-- Header Cards -->
        <div class="grid grid-cols-1 gap-4 px-4 py-6 sm:grid-cols-2 lg:grid-cols-4">
            <!-- Total Users -->
            <div
                class="p-5 text-white transition-transform duration-300 transform shadow-md bg-gradient-to-r from-cyan-500 to-blue-500 rounded-2xl hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-sm font-medium uppercase text-white/80">Total Users</h4>
                        <p class="mt-2 text-3xl font-bold">{{ $users }}</p>
                    </div>
                    <div class="text-4xl">👥</div>
                </div>
            </div>

            <!-- Total Instructors -->
            <div
                class="p-5 text-white transition-transform duration-300 transform shadow-md bg-gradient-to-r from-green-500 to-emerald-500 rounded-2xl hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-sm font-medium uppercase text-white/80">Instructors</h4>
                        <p class="mt-2 text-3xl font-bold">{{ $instructors }}</p>
                    </div>
                    <div class="text-4xl">🎓</div>
                </div>
            </div>

            <!-- Total Students -->
            <div
                class="p-5 text-white transition-transform duration-300 transform shadow-md bg-gradient-to-r from-pink-500 to-rose-500 rounded-2xl hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-sm font-medium uppercase text-white/80">Students</h4>
                        <p class="mt-2 text-3xl font-bold">{{ $students }}</p>
                    </div>
                    <div class="text-4xl">🧑‍🎓</div>
                </div>
            </div>

            <!-- Today's Schedule -->
            <div
                class="p-5 text-white transition-transform duration-300 transform shadow-md bg-gradient-to-r from-orange-500 to-yellow-400 rounded-2xl hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-sm font-medium uppercase text-white/80">Today’s Schedule</h4>
                        <p class="mt-2 text-xl">📝 <span class="font-bold">{{ $totalExamToday }}</span> Tests</p>
                        <p class="text-xl">📋 <span class="font-bold">{{ $totalQuizToday }}</span> Quizzes</p>
                    </div>
                    <div class="text-5xl">📅</div>
                </div>
            </div>
        </div>



        <!-- Bonus Section -->
        {{-- <div class="flex items-center justify-between p-6 text-white bg-purple-600 shadow-lg rounded-xl">
            <div>
                <h2 class="text-xl font-bold">You have Bonus $100</h2>
                <p class="text-lg">10 Free Spins</p>
                <button class="px-4 py-2 mt-2 font-semibold text-purple-700 bg-white rounded-lg">Claim Bonus 🎁</button>
            </div>
            <img src="/images/bonus-coins.png" alt="Bonus" class="w-28">
        </div>

        <!-- IP Conflict & Protection -->
        <div class="grid grid-cols-3 gap-6">
            <!-- Protection Gauge -->
            <div class="col-span-1 p-4 bg-white rounded-lg shadow">
                <h3 class="mb-2 font-bold">🛡️ Protection Status</h3>
                <div id="protection-chart"></div>
                <p class="mt-2 text-gray-600">Average Protection: 80%</p>
            </div>

            <!-- File Stats Chart -->
            <div class="col-span-2 p-4 bg-white rounded-lg shadow">
                <h3 class="mb-2 font-bold">📊 File Activity (Nov 2023)</h3>
                <canvas id="filesChart"></canvas>
            </div>
        </div> --}}

        <!-- Issue Summary -->
        {{-- <div class="p-4 bg-white rounded-lg shadow">
            <h3 class="mb-3 font-bold">📂 262 Issues Total</h3>
            <div class="space-y-2">
                <x-dashboard.issue label="Simple" percent="50" color="bg-red-400" />
                <x-dashboard.issue label="Medium" percent="25" color="bg-orange-400" />
                <x-dashboard.issue label="Complex" percent="10" color="bg-pink-400" />
            </div>
        </div> --}}
    </div>

</div>
