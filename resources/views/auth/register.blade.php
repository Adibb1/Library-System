<x-guest-layout>
    <div class="flex justify-center align-items-center">
        <!-- Left Section -->
        @if (Route::has('login'))
        <nav class="flex flex-col justify-center items-end">
            <a href="{{ route('login') }}" class="rounded-md px-3 py-2 text-black transition hover:text-black/70">
                Log in
            </a>
            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="rounded-l-xl px-5 py-4 text-black transition hover:text-black/60 focus-visible:ring-white bg-[#FFE8D6]">
                Register
            </a>
            @endif
        </nav>
        @endif


        <!-- Right Section -->
        <div class="w-1/4 bg-[#FFE8D6] rounded-lg">
            <!-- Login Form -->
            <form method="POST" action="{{ route('register') }}" class="m-4">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="('Confirm Password')" />

                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ms-4">
                        {{ ('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>