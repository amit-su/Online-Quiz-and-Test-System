<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen bg-blue-400">
        <div class="flex w-full max-w-3xl overflow-hidden bg-white shadow-lg rounded-2xl">
            <!-- Left side (Form) -->
            <div class="w-full p-8 lg:p-16">
                <div class="mb-8">

                    <h2 class="mb-2 text-3xl font-extrabold text-gray-900">Welcome Back</h2>
                    <p class="text-sm text-gray-500">Login to your account</p>
                </div>

                <div class="flex items-center my-4">
                    <hr class="flex-grow border-t border-gray-300">
                    <span class="mx-3 text-sm text-gray-400">OR LOGIN WITH EMAIL</span>
                    <hr class="flex-grow border-t border-gray-300">
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                        <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus
                            class="w-full mt-1" />
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <x-text-input id="password" type="password" name="password" required class="w-full mt-1" />
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    <div class="flex items-center justify-between mb-6">
                        <label class="flex items-center text-sm text-gray-600">
                            <input type="checkbox" name="remember"
                                class="mr-2 text-indigo-600 border-gray-300 rounded shadow-sm focus:ring-indigo-500">
                            Keep me logged in
                        </label>
                        <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:underline">Forgot
                            your password?</a>
                    </div>

                    <x-primary-button
                        class="w-full py-2 text-white transition bg-indigo-600 rounded-lg hover:bg-indigo-700">
                        Log In
                    </x-primary-button>
                </form>

                <p class="mt-6 text-sm text-center text-gray-600">
                    Don’t have an account?
                    <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:underline">Sign up</a>
                </p>
            </div>

        </div>
    </div>
</x-guest-layout>
