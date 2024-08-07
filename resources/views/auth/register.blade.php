<x-guest-layout>
    <div class="flex flex-col overflow-y-auto md:flex-row">
        <div class="h-32 md:h-auto md:w-1/2">
            <img aria-hidden="true" class="object-cover w-full h-full" src="{{ asset('images/create-account-office.jpeg') }}" alt="Office" />
        </div>

        <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
            <div class="w-full">
                <h1 class="mb-4 text-xl font-semibold text-gray-700">
                    Create account
                </h1>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mt-4 relative">
                        <div class="relative">
                            <x-text-input placeholder=" " type="text" id="name" name="name" class="block w-full" value="{{ old('name') }}" required autofocus />
                            <x-input-label for="name" :value="__('Name')" />
                        </div>
                        <div class="relative">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                    </div>

                    <div class="mt-4 relative">
                        <div class="relative">
                            <x-text-input placeholder=" " type="text" id="username" name="username" class="block w-full" value="{{ old('username') }}" required autofocus />
                            <x-input-label for="username" :value="__('Username')" />
                        </div>
                        <div class="relative">
                            <x-input-error :messages="$errors->get('username')" class="mt-2" />
                        </div>
                    </div>

                    <div class="mt-4 relative">
                        <div class="relative">
                            <x-text-input placeholder=" " name="email" type="email" class="block w-full" value="{{ old('email') }}" />
                            <x-input-label for="email" :value="__('Email')" />
                        </div>
                        <div class="relative">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                    </div>

                    <div class="mt-4 relative">
                        <div class="relative">
                            <x-text-input placeholder=" " type="password" name="password" class="block w-full" required />
                            <x-input-label for="password" :value="__('Password')" />
                        </div>
                        <div class="relative">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                    </div>

                    <div class="mt-4 relative">
                        <div class="relative">
                            <x-text-input placeholder=" " type="password" name="password_confirmation" class="block w-full" required />
                            <x-input-label id="password_confirmation" :value="__('Confirm Password')" />
                        </div>
                        <div class="relative">
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                    </div>

                    <div class="mt-4 relative">
                        <x-primary-button class="block w-full">
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                </form>

                <hr class="my-8" />

                <p class="mt-4">
                    <a class="text-sm font-medium text-primary-600 hover:underline" href="{{ route('login') }}">{{ __('Already registered?') }}</a>
                </p>
            </div>
        </div>
</x-guest-layout>
