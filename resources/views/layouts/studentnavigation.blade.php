<div class="font-sans antialiased ">

    <div class="flex h-screen ">
        <!-- Sidebar -->
        <aside class="flex flex-col justify-between h-screen bg-white w-[18rem] shadow-stone-300xl">
            <!-- full viewport height -->

            <div class="flex flex-col flex-grow"> <!-- make this div grow -->

                <div class="flex items-center p-8 text-2xl font-bold text-blue-800 border-b-2">
                    NIC
                </div>

                <div class="flex items-center p-8 space-x-2">
                    <div class="w-8 h-8 overflow-hidden rounded-full bg-cyan-300">
                        <img class="object-cover w-full h-full"
                            src="{{ Auth::user()->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=random' }}"
                            alt="">
                    </div>
                    <div class="text-lg font-semibold">{{ Auth::user()->name }}</div>
                </div>

                <div class="flex-grow bg-blue-900 rounded-tr-[4rem]">

                    <nav class="space-y-2 text-sm text-gray-600">


                        @if (Auth::user()->role === 'student')
                            <a href="#" class="flex items-center gap-3 p-2 text-blue-600 rounded">Dashboard</a>
                            <a href="{{ route('Quiz.index') }}"
                                class="flex items-center px-4 py-3 text-blue-100 transition-all duration-200 rounded-r-lg hover:bg-blue-500 hover:text-white {{ request()->routeIs('Quiz.index') ? 'bg-white text-blue-500 font-semibold border-l-4 border-yellow-300' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                Quiz
                            </a>

                            <a href="{{ route('complitesQuizes.index') }}"
                                class="flex items-center px-4 py-3 text-blue-100 transition-all duration-200 rounded-r-lg hover:bg-blue-500 hover:text-white {{ request()->routeIs('complitesQuizes.index') ? 'bg-white text-blue-500  font-semibold border-l-4 border-yellow-300' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                Complited Quiz
                            </a>

                            <a href="{{ route('TestStudent.index') }}"
                                class="flex items-center px-4 py-3 text-blue-100 transition-all duration-200 rounded-r-lg hover:bg-blue-500 hover:text-white {{ request()->routeIs('TestStudent.index') ? 'bg-white text-blue-500  font-semibold border-l-4 border-yellow-300' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                Test
                            </a>


                            <a href="{{ route('complitesTest.index') }}"
                                class="flex items-center px-4 py-3 text-blue-100 transition-all duration-200 rounded-r-lg hover:bg-blue-500 hover:text-white {{ request()->routeIs('complitesTest.index') ? 'bg-white text-blue-500  font-semibold border-l-4 border-yellow-300' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                Complited Test
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
            <div class="flex-1 space-y-6 overflow-y-auto bg-blue-50 ">
                {{ $slot }}
            </div>
        </main>

    </div>

</div>
