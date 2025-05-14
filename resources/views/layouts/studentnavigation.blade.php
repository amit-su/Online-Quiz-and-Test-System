<div class="bg-[#f2f8fc] font-sans antialiased ">

    <div class="flex h-screen ">
        <!-- Sidebar -->
        <aside class="flex flex-col justify-between w-64 bg-white shadow-lg">
            <div>
                <div class="flex items-center p-8 mb-6 text-2xl font-bold text-blue-800 border-b-2">
                    <span class="mr-2">🎧</span>
                    JustListen
                </div>
                <div class="flex items-center gap-3 mb-6">
                    <img src="https://i.pravatar.cc/40" class="w-10 h-10 rounded-full" alt="Avatar" />
                    <div>
                        <h4 class="font-semibold text-gray-800">Haleema Sultan</h4>
                        <p class="text-xs text-gray-500">Student</p>
                    </div>
                </div>
                <div class="h-[45rem] bg-sky-600 [border-top-right-radius:4rem]">
                    <nav class="space-y-2 text-sm text-gray-600">


                        @if (Auth::user()->role === 'student')
                            <a href="#" class="flex items-center gap-3 p-2 text-blue-600 rounded">Dashboard</a>
                            <a href="{{ route('Quiz.index') }}"
                                class="flex items-center px-4 py-3 text-blue-100 transition-all duration-200 rounded-r-lg hover:bg-blue-500 hover:text-white {{ request()->routeIs('QuizPage.index') ? 'bg-blue-500 text-white font-semibold border-l-4 border-yellow-300' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                Quiz
                            </a>
                        @endif

                    </nav>
                </div>
            </div>

        </aside>



        <!-- Main Content -->
        <!-- Main Content -->
        <main class="flex flex-col flex-1 overflow-hidden">
            <!-- Top Bar -->
            <div class="flex items-center justify-between px-6 py-4 bg-white shadow-md">
                <!-- Left: Title or Search -->
                <h2 class="text-2xl font-bold text-gray-800">Dashboard</h2>

                <!-- Right: Icons and Avatar -->
                <div class="flex items-center space-x-4">
                    <!-- Search (Optional) -->
                    <div class="relative hidden md:block">
                        <input type="text" placeholder="Search..."
                            class="px-4 py-2 pl-10 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />
                        <svg class="absolute w-4 h-4 text-gray-500 left-3 top-2.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" />
                        </svg>
                    </div>

                    <!-- Notifications Icon -->
                    <button class="relative">
                        <svg class="w-6 h-6 text-gray-600 hover:text-blue-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-5-5.917V4a1 1 0 10-2 0v1.083A6.002 6.002 0 006 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span
                            class="absolute top-0 right-0 w-2 h-2 bg-red-500 border-2 border-white rounded-full"></span>
                    </button>

                    <!-- User Avatar -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center space-x-1 transition hover:text-yellow-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
            <!-- Dynamic Slot Content -->
            <div class="flex-1 space-y-6 overflow-y-auto">
                {{ $slot }}
            </div>
        </main>

    </div>

</div>
