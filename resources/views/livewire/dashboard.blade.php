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
                    <div class="w-10 h-10">
                        <img src="https://cdn-icons-png.flaticon.com/512/747/747376.png" alt="Quiz Icon"
                            class="object-contain w-full h-full" />
                    </div>
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
                    <div class="w-10 h-10">
                        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Graduation Cap"
                            class="object-contain w-full h-full" />
                    </div>
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
                class="flex items-center justify-between p-6 text-white shadow-lg bg-gradient-to-r from-orange-500 to-yellow-400 rounded-2xl hover:scale-105">
                <div>
                    <h4 class="text-sm font-medium uppercase text-white/80">Today’s Schedule</h4>

                    <div class="flex items-center gap-2 mt-2 text-xl">
                        <img src="https://cdn-icons-png.flaticon.com/512/1828/1828919.png" alt="Test Icon"
                            class="w-6 h-6" />
                        <span class="font-bold">{{ $totalExamToday }}</span> Tests
                    </div>

                    <div class="flex items-center gap-2 text-xl">
                        <img src="https://cdn-icons-png.flaticon.com/512/2948/2948037.png" alt="Quiz Icon"
                            class="w-6 h-6" />
                        <span class="font-bold">{{ $totalQuizToday }}</span> Quizzes
                    </div>
                </div>

                <div class="w-12 h-12">
                    <img src="https://cdn-icons-png.flaticon.com/512/747/747310.png" alt="Calendar Icon"
                        class="object-contain w-full h-full" />
                </div>
            </div>

            {{-- </div> --}}
        </div>
    </div>

</div>
