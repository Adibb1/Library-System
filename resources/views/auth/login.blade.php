<x-guest-layout>
    <div class="flex justify-center align-items-center">
        <!-- Left Section -->
        @if (Route::has('login'))
        <nav class="flex flex-col justify-center items-end">
            <a href="{{ route('login') }}" class="rounded-l-xl px-5 py-4 text-black transition text-black hover:text-black/60 focus-visible:ring-white bg-[#FFE8D6]">
                Log in
            </a>
            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="rounded-md px-3 py-2 text-black transition hover:text-black/70">
                Register
            </a>
            @endif
        </nav>
        @endif


        <!-- Right Section -->
        <div class="w-1/2 bg-[#FFE8D6] rounded-lg flex flex-col justify-center items-center">
            <a href="/">
                <img class="w-[100px]" src="{{ asset('images/book-icon.png') }}" alt="Book Icon">
                <p class="text-center text-lg mt-2">Adib Library</p>
            </a>
            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" class="w-1/2 m-4">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded bg-[#CB997E] text-black shadow-sm" name="remember">
                        <span class="ml-2 text-sm text-gray-600 text-gray-400">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-center mt-4">
                    @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 text-gray-400 hover:text-gray-900 hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                    @endif

                    <x-primary-button class="ml-3">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>