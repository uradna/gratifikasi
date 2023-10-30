<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            {{-- <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                    :value="old('email', $request->email)" required autofocus />
            </div> --}}
            <div class="mb-4">
                <label for="email" class="form-label">Email</label>
                <div class="input-group">
                    <input type="email" id="email" name="email" class="form-control"
                        value="{{ old('email', $request->email) }}" required autofocus>
                </div>
            </div>

            <!-- Password -->
            {{-- <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            </div> --}}
            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <div class="input-group input-group-merge">
                    <input type="password" id="password" name="password" class="form-control"
                        placeholder="Enter your password" required>
                    <div class="input-group-text" data-password="false" onclick="myFunction1()" id="eye1">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                </div>
            </div>


            <div class="mb-4">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <div class="input-group input-group-merge">
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                        placeholder="Enter your password" required>
                    <div class="input-group-text" data-password="false" onclick="myFunction2()" id="eye2">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                </div>
            </div>

            <script>
                function myFunction1() {
                    var x = document.getElementById("password");
                    var y = document.getElementById("eye1");
                    if (x.type === "password") {
                        x.type = "text";
                        y.innerHTML = "<i class='fa-solid fa-eye-slash'></i>";
                    } else {
                        x.type = "password";
                        y.innerHTML = "<i class='fa-solid fa-eye'></i>";
                    }
                }

                function myFunction2() {
                    var x = document.getElementById("password_confirmation");
                    var y = document.getElementById("eye2");
                    if (x.type === "password") {
                        x.type = "text";
                        y.innerHTML = "<i class='fa-solid fa-eye-slash'></i>";
                    } else {
                        x.type = "password";
                        y.innerHTML = "<i class='fa-solid fa-eye'></i>";
                    }
                }

            </script>

            <!-- Confirm Password -->
            {{-- <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required />
            </div> --}}

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Reset Password') }}
                </x-button>
            </div>
            {{-- <div class="mb-3">
                <label for="password" class="form-label">Show/Hide Password</label>
                <div class="input-group input-group-merge">
                    <input type="password" id="password" class="form-control" placeholder="Enter your password">
                    <div class="input-group-text" data-password="false">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                </div>
            </div> --}}
        </form>
    </x-auth-card>
</x-guest-layout>
