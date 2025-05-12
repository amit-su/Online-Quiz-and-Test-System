<x-guest-layout>
    <div
        class="flex items-center justify-center min-h-screen px-4 py-12 bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500">
        <div class="flex w-full max-w-5xl overflow-hidden bg-white shadow-2xl rounded-3xl dark:bg-gray-900">

            <!-- Left: Form Section -->
            <div class="w-full p-10 md:w-1/2">
                <div class="mb-8">
                    <h2 class="mb-2 text-4xl font-bold text-center text-gray-800 dark:text-white">
                        {{ __('Create an account') }}
                    </h2>
                    <p class="text-center text-gray-500 dark:text-gray-400">
                        {{ __('Sign up now and unlock exclusive access!') }}
                    </p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Your name')" />
                        <x-text-input id="name"
                            class="block w-full mt-1 border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500"
                            type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                            placeholder="First Last" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email"
                            class="block w-full mt-1 border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500"
                            type="email" name="email" :value="old('email')" required autocomplete="username"
                            placeholder="you@email.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password"
                            class="block w-full mt-1 border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500"
                            type="password" name="password" required autocomplete="new-password"
                            placeholder="********" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                        <x-text-input id="password_confirmation"
                            class="block w-full mt-1 border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500"
                            type="password" name="password_confirmation" required autocomplete="new-password"
                            placeholder="********" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="pt-4">
                        <x-primary-button
                            class="justify-center w-full py-3 text-lg text-white transition duration-200 bg-indigo-600 hover:bg-indigo-700 rounded-xl">
                            {{ __('Create Account') }}
                        </x-primary-button>
                    </div>

                    <p class="mt-4 text-sm text-center text-gray-600 dark:text-gray-400">
                        {{ __('Already registered?') }}
                        <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">{{ __('Sign in') }}</a>
                    </p>
                </form>

                <p class="mt-6 text-xs text-center text-gray-400">
                    Help@Aura.com
                </p>
            </div>

            <!-- Right: Illustration Section -->
            <div class="items-center justify-center hidden w-1/2 p-6 md:flex bg-gray-50 dark:bg-gray-800">
                <img src="{{ asset('images/registration-illustration.png') }}" alt="Registration Illustration"
                    class="w-full max-w-sm">
            </div>
        </div>
    </div>
</x-guest-layout>
