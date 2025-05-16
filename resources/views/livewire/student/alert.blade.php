<div class="max-w-4xl mx-auto mt-8 overflow-hidden shadow-lg rounded-xl">
    <div class="divide-y divide-blue-100">
        @forelse ($notifications as $notification)
            <div class="flex items-start px-5 py-4 transition duration-200 hover:bg-white group">
                <!-- Icons -->
                <div class="flex items-center mt-1 space-x-2">
                    <!-- Star Icon -->
                    <svg class="w-5 h-5 text-yellow-400 group-hover:text-yellow-500" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.162 3.584a1 1 0 00.95.69h3.774c.969 0 1.371 1.24.588 1.81l-3.054 2.22a1 1 0 00-.364 1.118l1.162 3.584c.3.921-.755 1.688-1.54 1.118l-3.054-2.22a1 1 0 00-1.175 0l-3.054 2.22c-.784.57-1.838-.197-1.54-1.118l1.162-3.584a1 1 0 00-.364-1.118L2.525 8.01c-.783-.57-.38-1.81.588-1.81h3.774a1 1 0 00.95-.69l1.162-3.584z" />
                    </svg>

                    <!-- Pin Icon -->
                    <svg class="w-5 h-5 text-pink-400 group-hover:text-pink-500" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <path d="M16 7v6a2 2 0 01-2 2H8l-4 4V5a2 2 0 012-2h8a2 2 0 012 2z" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>

                <!-- Content -->
                <div class="flex-1 ml-4">
                    <p class="text-sm font-semibold text-indigo-900 truncate">
                        {{ $notification->title }}
                    </p>
                    <p class="mt-1 text-sm text-gray-700 line-clamp-2">
                        {{ $notification->message }}
                    </p>
                </div>

                <!-- Timestamp -->
                <div class="flex-shrink-0 mt-1 ml-4 text-xs text-gray-500 whitespace-nowrap">
                    {{ $notification->created_at->diffForHumans() }}
                </div>
            </div>
        @empty
            <div class="px-6 py-8 text-center text-gray-500">
                🎉 No notifications at this time.
            </div>
        @endforelse
    </div>
</div>
