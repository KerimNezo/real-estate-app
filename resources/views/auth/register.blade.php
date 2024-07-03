<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone Number with Country Code -->
        <div class="mt-4">
            <x-input-label for="phone_number" :value="__('Phone Number')" />
            <div class="relative flex items-center mt-1" style="position: relative; display: flex; align-items: center; margin-top: 0.25rem;">
                <!-- Country Code Dropdown -->
                <select id="country_code" name="country_code" style="position: absolute; top: 0; bottom: 0; left: 0; padding-left: 0.75rem; padding-right: 2rem; border-width: 1px; border-color: rgb(55 65 81); background-color: rgb(11 14 21); color: #4b5563; border-top-left-radius: 0.375rem; border-bottom-left-radius: 0.375rem; font-size: 0.875rem; line-height: 1.25rem; focus:outline-none; focus:ring: 2px solid #6366f1; focus:border: 2px solid #6366f1;">
                    @foreach ($countries as $code => $country)
                        <option value="{{ $code }}">{{ $country }}</option>
                    @endforeach
                    <!-- Add more countries here -->
                </select>

                <!-- Phone Number Input -->
                <x-text-input id="phone_number" name="phone_number" type="text" style="width: 100%; padding-left: 6.5rem; border-width: 1px; border-color: rgb(55 65 81); border-top-right-radius: 0.375rem; border-bottom-right-radius: 0.375rem; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05); font-size: 0.875rem; line-height: 1.25rem; focus:ring: 2px solid #6366f1; focus:border: 2px solid #6366f1;" placeholder="123-456-7890" />
            </div>
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
