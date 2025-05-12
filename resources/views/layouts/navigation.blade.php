<body class="font-sans antialiased bg-sky-50" x-data="{ sidebarOpen: true }">

    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        <aside x-show="sidebarOpen" x-transition class="w-64 shadow-md bg-sky-100">
            <div class="p-4 text-xl font-bold border-b text-sky-800 border-sky-200">
                Dashboard
            </div>
            <nav class="mt-4 space-y-2">
                <a href="{{ route('dashboard') }}"
                    class="block px-4 py-2 text-sky-700 rounded hover:bg-sky-200 {{ request()->routeIs('dashboard') ? 'bg-sky-300 text-sky-900 font-semibold' : '' }}">Dashboard</a>

                {{-- Admin Menu --}}
                @if (Auth::user()->role === 'admin')
                    <div class="px-4 mt-4 text-sm uppercase text-sky-600">Admin</div>
                    <a href="{{ route('users.index') }}"
                        class="block px-4 py-2 text-sky-700 rounded hover:bg-sky-200 {{ request()->routeIs('users.*') ? 'bg-sky-300 text-sky-900 font-semibold' : '' }}">Manage
                        Users</a>
                    {{-- <a href="{{ route('quizzes.index') }}"
                        class="block px-4 py-2 text-sky-700 rounded hover:bg-sky-200 {{ request()->routeIs('quizzes.index') ? 'bg-sky-300 text-sky-900 font-semibold' : '' }}">Setup
                        Quizzes</a>
                    <a href="{{ route('question-bank.index') }}"
                        class="block px-4 py-2 text-sky-700 rounded hover:bg-sky-200 {{ request()->routeIs('question-bank.*') ? 'bg-sky-300 text-sky-900 font-semibold' : '' }}">Question
                        Bank</a>
                    <a href="{{ route('reports.index') }}"
                        class="block px-4 py-2 text-sky-700 rounded hover:bg-sky-200 {{ request()->routeIs('reports.*') ? 'bg-sky-300 text-sky-900 font-semibold' : '' }}">View
                        Reports</a> --}}
                @endif

                {{-- Instructor Menu --}}
                @if (Auth::user()->role === 'instructor')
                    <div class="px-4 mt-4 text-sm uppercase text-sky-600">Instructor</div>
                    <a href="{{ route('quizzes.create') }}"
                        class="block px-4 py-2 text-sky-700 rounded hover:bg-sky-200 {{ request()->routeIs('quizzes.create') ? 'bg-sky-300 text-sky-900 font-semibold' : '' }}">Create
                        Quiz</a>
                    <a href="{{ route('assign-quizzes.index') }}"
                        class="block px-4 py-2 text-sky-700 rounded hover:bg-sky-200 {{ request()->routeIs('assign-quizzes.*') ? 'bg-sky-300 text-sky-900 font-semibold' : '' }}">Assign
                        Quiz</a>
                    <a href="{{ route('evaluate.index') }}"
                        class="block px-4 py-2 text-sky-700 rounded hover:bg-sky-200 {{ request()->routeIs('evaluate.*') ? 'bg-sky-300 text-sky-900 font-semibold' : '' }}">Evaluate
                        Results</a>
                @endif
            </nav>
        </aside>

        {{-- Main content --}}
        <div class="flex flex-col flex-1">

            {{-- Top nav --}}
            <header class="shadow bg-sky-600">
                <div class="flex items-center justify-between px-4 py-3 text-white">

                    {{-- Toggle button --}}
                    <button @click="sidebarOpen = !sidebarOpen"
                        class="p-2 text-white rounded bg-sky-500 hover:bg-sky-400 focus:outline-none focus:ring-2 focus:ring-sky-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <div class="text-lg font-semibold">Welcome, {{ Auth::user()->name }}</div>

                    <div class="flex items-center space-x-4">
                        <a href="{{ route('profile.edit') }}" class="hover:underline">Profile</a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="transition hover:text-emerald-300">Logout</button>
                        </form>
                    </div>
                </div>
            </header>

            {{-- Livewire content --}}
            <main class="p-6">
                {{ $slot }}
            </main>
        </div>
    </div>

    @livewireScripts

    {{-- Alpine.js CDN --}}
    <script src="//unpkg.com/alpinejs" defer></script>

</body>
