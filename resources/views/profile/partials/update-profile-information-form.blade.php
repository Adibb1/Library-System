<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <div class="flex flex-col sm:flex-row ">
        <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6 w-full md:w-1/2">
            @csrf
            @method('patch')

            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 text-gray-400 hover:text-gray-900 hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium text-sm text-green-600 text-green-400">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                    @endif
                </div>
                @endif
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button class="bg-blue-600 hover:bg-blue-700">{{ __('Save Profile Data') }}</x-primary-button>

                @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600 text-gray-400">{{ __('Saved.') }}</p>
                @endif
            </div>
        </form>
        <div class="flex flex-col justify-start items-start mt-4 sm:mt-0 sm:items-center w-full md:w-1/2">
            <img id="profile-picture" class="h-[150px] w-[150px] mb-4 rounded-xl object-cover cursor-pointer" src="{{$user->profile_picture}}" alt="Profile Picture">
            <form id="update-pfp-form" action="{{ route('profile.update_pfp') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <input name="picture" type="file" class="hidden" id="picture" />
                <x-primary-button class="bg-blue-600 hover:bg-blue-700">{{ __('Save Profile Picture') }}</x-primary-button>
            </form>
        </div>
    </div>
    <script>
        document.getElementById('profile-picture').addEventListener('click', function() {
            document.getElementById('picture').click();
        });

        document.getElementById('picture').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profile-picture').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</section>