<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@if (session('status') === 'password-updated')
    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
        class="text-base text-center text-white font-semibold px-6 py-3 bg-green-500">
        {{ __('Mot de passe modifié!') }}</p>
@endif
<x-guest-layout>
    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <!-- Mot de passe actuel -->
        <div class="relative mt-4">
            <x-input-label for="update_password_current_password" :value="__('Mot de passe actuel')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password"
                class="mt-1 block w-full" autocomplete="current-password" />
            <span class="absolute inset-y-0 right-0 top-8 pr-3 flex items-center cursor-pointer"
                onclick="togglePassword('update_password_current_password', 'current_password_toggle')">
                <i id="current_password_toggle" class="fas fa-eye"></i>
            </span>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <!-- Nouveau mot de passe -->
        <div class="relative mt-4">
            <x-input-label for="update_password_password" :value="__('Nouveau mot de passe')" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full"
                autocomplete="new-password" />
            <span class="absolute inset-y-0 right-0 top-8 pr-3 flex items-center cursor-pointer"
                onclick="togglePassword('update_password_password', 'password_toggle')">
                <i id="password_toggle" class="fas fa-eye"></i>
            </span>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <!-- Confirmation Nouveau mot de passe -->
        <div class="relative mt-4 mb-3">
            <x-input-label for="update_password_password_confirmation" :value="__('Confirmation')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password"
                class="mt-1 block w-full" autocomplete="new-password" />
            <span class="absolute inset-y-0 right-0 top-8 pr-3 flex items-center cursor-pointer"
                onclick="togglePassword('update_password_password_confirmation', 'password_confirmation_toggle')">
                <i id="password_confirmation_toggle" class="fas fa-eye"></i>
            </span>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            {{-- si tu es authentifié tu n'as pas oublié ton mot de passe --}}
            {{-- @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 mr-auto hover:text-indigo-500 rounded-md focus:outline-none"
                    href="{{ route('password.request') }}">
                    {{ __('Mot de passe oublié?') }}
                </a>
            @endif --}}
            <a class="underline text-sm text-gray-600 mr-auto hover:text-indigo-400 rounded-md focus:outline-none "
                href="{{ route('get_dash') }}">
                {{ __('Tableau de bord') }}
            </a>
            <x-primary-button>
                {{ __('Changer le mot de passe') }}
            </x-primary-button>

        </div>
    </form>

    <script>
        function togglePassword(inputId, toggleIconId) {
            var input = document.getElementById(inputId);
            var icon = document.getElementById(toggleIconId);
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
                icon.classList.add('text-indigo-500');
            } else {
                input.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.remove('text-indigo-500');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</x-guest-layout>
