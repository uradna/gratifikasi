<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img src="{{ asset('img/insp.png') }}">
            </a>
        </x-slot>
        <!-- Session Status -->

        <div class="text-center">
            <span class="text-lg ">APLIKASI SUPER GRATIFIKASI<br>Surat Pernyataan Gratifikasi<br><br></span>
        </div>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="" :errors="$errors" />
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="nip" :value="__('NIP')" />

                <x-input id="nip" class="block mt-1 w-full" type="text" name="nip" :value="old('nip')" required
                    autofocus placeholder="Nomor Induk Pegawai" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label class="block font-medium text-sm text-gray-700" for="password">
                    Password
                    {{-- <span style="font-size: 0.8em;font-weight:bold">(Gunakan password simpeg/simashebat)</span> --}}
                </label>

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" placeholder="Gunakan password simpeg / simashebat" />
                {{-- <small style="color: rgb(150, 150, 150);font-size: 0.7em;font-weight:bold">Gunakan password
                    simpeg/simashebat</small> --}}
            </div>

            <!-- Remember Me -->
            {{-- <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div> --}}

            <div class="flex items-center justify-end mt-4">

                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                    {{ __('Lupa password?') }}
                </a>


                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <!-- Flexbox container for aligning the toasts -->



    </x-auth-card>

</x-guest-layout>
