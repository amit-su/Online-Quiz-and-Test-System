<div class="font-sans antialiased bg-gradient-to-br from-blue-50 to-cyan-50">

    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        <div class="flex">


            <aside x-show="sidebarOpen" x-transition class="w-64 shadow-lg bg-slate-800">
                <div class="p-4 text-xl font-bold text-white border-b border-blue-100">
                    <span class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        Dashboard
                    </span>
                </div>
                <nav class="mt-4 space-y-1">
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center px-4 py-3 text-blue-100 transition-all duration-200 rounded-r-lg hover:bg-blue-500 hover:text-white {{ request()->routeIs('dashboard') ? 'bg-blue-500 text-white font-semibold border-l-4 border-yellow-300' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>

                    {{-- Admin Menu --}}
                    @if (Auth::user()->role === 'admin')
                        <div class="px-4 pt-4 pb-2 text-xs font-semibold tracking-wider text-blue-300 uppercase">Admin
                        </div>
                        <a href="{{ route('users.index') }}"
                            class="flex items-center px-4 py-3 text-white transition-all duration-200 rounded-r-lg hover:text-green-200 {{ request()->routeIs('users.*') ? 'bg-blue-500 text-white font-semibold border-l-4 border-yellow-300' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            Manage Users
                        </a>
                        <a href="{{ route('exam.index') }}"
                            class="flex items-center px-4 py-3 text-white transition-all duration-200 rounded-r-lg hover:text-green-200 {{ request()->routeIs('exam.*') ? 'bg-blue-500 text-white font-semibold border-l-4 border-yellow-300' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            Quiz Sudule
                        </a>
                        <a href="{{ route('test.index') }}"
                            class="flex items-center px-4 py-3 text-white transition-all duration-200 rounded-r-lg hover:text-green-200 {{ request()->routeIs('test.*') ? 'bg-blue-500 text-white font-semibold border-l-4 border-yellow-300' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            Test Sudule
                        </a>


                        {{-- <a href="{{ route('questions.index') }}"
                        class="flex items-center px-4 py-3 text-white transition-all duration-200 rounded-r-lg hover:text-green-200 {{ request()->routeIs('questions.*') ? ' text-white font-semibold border-l-4 border-yellow-300' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Manage Qusction
                    </a> --}}
                    @endif

                    {{-- Instructor Menu --}}
                    @if (Auth::user()->role === 'instructor')
                        <div class="px-4 pt-4 pb-2 text-xs font-semibold tracking-wider text-blue-300 uppercase">
                            Instructor
                        </div>
                        <a href="{{ route('quizzes.create') }}"
                            class="flex items-center px-4 py-3 text-blue-100 transition-all duration-200 rounded-r-lg hover:bg-blue-500 hover:text-white {{ request()->routeIs('quizzes.create') ? 'bg-blue-500 text-white font-semibold border-l-4 border-yellow-300' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Create Quiz
                        </a>
                    @endif
                </nav>
            </aside>
        </div>

        {{-- Main content --}}
        <div class="flex flex-col flex-1 overflow-hidden">

            {{-- Top nav --}}
            <header class="bg-white shadow-lg bg-gradient-to-r">
                <div class="flex items-center justify-between px-6 py-4 text-black">

                    {{-- Toggle button --}}
                    <button @click="sidebarOpen = !sidebarOpen"
                        class="p-2 text-white transition-all duration-200 bg-blue-700 rounded-lg hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 overflow-hidden rounded-full bg-cyan-300">
                            <img class="object-cover w-full h-full"
                                src="{{ Auth::user()->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=random' }}"
                                alt="">
                        </div>
                        <div class="text-lg font-semibold">Welcome, {{ Auth::user()->name }}</div>
                    </div>

                    <div class="flex items-center space-x-6">
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
                            <button type="submit"
                                class="flex items-center space-x-1 transition hover:text-yellow-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            {{-- Livewire content --}}
            <main class="flex-1 p-6 overflow-auto ">
                {{ $slot }}
            </main>

        </div>
    </div>
</div>
