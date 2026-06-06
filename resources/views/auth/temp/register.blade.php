<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                    autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autocomplete="username" />
            </div>

            <div>
                <x-label for="phone" value="{{ __('Phone') }}" />
                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')"
                    required autofocus autocomplete="phone" />
            </div>

            <div class="mt-4">
                <x-label for="role" value="{{ __('Reason for Joining') }}" />
                <select id="role" name="role" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" onchange="toggleAddressFields()">
                    <option value="3">Personal Use</option>
                    <option value="1">Store Owner</option>
                </select>
            </div>

            <div id="personal-address" class="mt-4">
                <x-label for="address" value="{{ __('Address') }}" />
                <x-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" autofocus autocomplete="address" />
            </div>

            <div id="store-address" class="mt-4 hidden">
                <x-label for="store_address" value="{{ __('Store Address') }}" />
                <x-input id="store_address" class="block mt-1 w-full" type="text" name="store_address" :value="old('store_address')" autofocus autocomplete="store_address" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
            </div>
            <x-input id="user_type" class="block mt-1 w-full" type="hidden" name="user_type" required value='0' />


            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' =>
                                        '<a target="_blank" href="' .
                                        route('terms.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                        __('Terms of Service') .
                                        '</a>',
                                    'privacy_policy' =>
                                        '<a target="_blank" href="' .
                                        route('policy.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                        __('Privacy Policy') .
                                        '</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
        <script>
            function toggleAddressFields() {
                const role = document.getElementById('role').value;
                const personal = document.getElementById('personal-address');
                const store = document.getElementById('store-address');

                if (role == '3') {
                    personal.classList.remove('hidden');
                    store.classList.add('hidden');
                } else if (role == '1') {
                    personal.classList.add('hidden');
                    store.classList.remove('hidden');
                }
            }

            // Call once on page load to apply the correct visibility
            document.addEventListener("DOMContentLoaded", toggleAddressFields);
        </script>
    </x-authentication-card>
</x-guest-layout>
