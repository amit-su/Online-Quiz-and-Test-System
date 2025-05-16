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

                    <nav class="py-8 space-y-2 text-sm text-gray-600">
                        @if (Auth::user()->role === 'student')
                            <!-- Dashboard -->
                            <a href="{{ route('Studentdasbord.index') }}"
                                class="flex items-center px-4 py-3 text-blue-100 transition-all duration-200 rounded-r-lg hover:bg-blue-500 hover:text-white {{ request()->routeIs('Studentdasbord.index') ? 'bg-white text-blue-500 font-semibold border-l-4 border-yellow-300' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6" />
                                </svg>
                                Dashboard
                            </a>

                            <!-- Quiz -->
                            <a href="{{ route('Quiz.index') }}"
                                class="flex items-center px-4 py-3 text-blue-100 transition-all duration-200 rounded-r-lg hover:bg-blue-500 hover:text-white {{ request()->routeIs('Quiz.index') ? 'bg-white text-blue-500 font-semibold border-l-4 border-yellow-300' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 16h.01M12 16h.01M16 16h.01M9 20h6a2 2 0 002-2V4H7v14a2 2 0 002 2z" />
                                </svg>
                                Quiz
                            </a>

                            <!-- Completed Quiz -->
                            <a href="{{ route('complitesQuizes.index') }}"
                                class="flex items-center px-4 py-3 text-blue-100 transition-all duration-200 rounded-r-lg hover:bg-blue-500 hover:text-white {{ request()->routeIs('complitesQuizes.index') ? 'bg-white text-blue-500 font-semibold border-l-4 border-yellow-300' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4M7 20h10a2 2 0 002-2V6a2 2 0 00-2-2H7a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Completed Quiz
                            </a>

                            <!-- Test -->
                            <a href="{{ route('TestStudent.index') }}"
                                class="flex items-center px-4 py-3 text-blue-100 transition-all duration-200 rounded-r-lg hover:bg-blue-500 hover:text-white {{ request()->routeIs('TestStudent.index') ? 'bg-white text-blue-500 font-semibold border-l-4 border-yellow-300' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6m-4 4h.01M12 3v4m0 0L8 7m4 0l4-1" />
                                </svg>
                                Test
                            </a>

                            <!-- Completed Test -->
                            <a href="{{ route('complitesTest.index') }}"
                                class="flex items-center px-4 py-3 text-blue-100 transition-all duration-200 rounded-r-lg hover:bg-blue-500 hover:text-white {{ request()->routeIs('complitesTest.index') ? 'bg-white text-blue-500 font-semibold border-l-4 border-yellow-300' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Completed Test
                            </a>

                            <!-- Notifications -->
                            <a href="{{ route('student.alert') }}"
                                class="flex items-center px-4 py-3 text-blue-100 transition-all duration-200 rounded-r-lg hover:bg-blue-500 hover:text-white {{ request()->routeIs('student.*') ? 'bg-white text-blue-500 font-semibold border-l-4 border-yellow-300' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V4a2 2 0 10-4 0v1.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                Notifications
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
                    <!-- User Avatar -->
                    <a href="{{ route('profile.edit') }}"
                        class="flex items-center space-x-1 transition hover:text-cyan-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span>Profile</span>
                    </a>

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
