@extends('layout.auth')
@section('title', ' - Login')

@section('content')
    <div class="bg-white w-1/2 max-w-lg p-10 m-auto shadow-lg rounded-2xl">
        <h1 class="text-black text-xl font-bold mb-5">Masuk Ke <span class="text-orange-400">Hepi</span>Korea</h1>
        <!-- start of form -->
        @error('message')
            <div id="alert-1" class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                role="alert">
                {{ $message }}
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-1" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @enderror

        <form action="{{ route('auth.login') }}" method="POST">
            @csrf
            @method('POST')
            <div class="relative w-full">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                    <img src="{{ asset('img/assets/icon/icon_user.svg') }}" alt="User Icon" class="h-6 w-6">
                </span>
                <input type="email" placeholder="Email" name="email" value="{{ old('email') }}" required
                    class="pl-12 w-full rounded-xl bg-[#EFEFEF] shadow-md border-none h-14 focus:outline-none focus:ring-0">
            </div>

            <div class="relative w-full mt-5">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                    <img src="{{ asset('img/assets/icon/icon_lock.svg') }}" alt="lock Icon" class="h-6 w-6">
                </span>
                <input id="password" type="password" name="password" placeholder="Password" required
                    class="pl-12 w-full rounded-xl bg-[#EFEFEF] shadow-md border-none h-14 focus:outline-none focus:ring-0">
                <!-- show/hide password -->
                <span class="absolute inset-y-0 right-0 pr-6 flex items-center">
                    <img id="togglePassword" src="{{ asset('img/assets/icon/icon_hide_eye.svg') }}" alt="eye hide Icon"
                        class="h-6 w-6 cursor-pointer">
                </span>
            </div>

            <div class="text-right my-3">
                <a href="{{ route('auth.forgot_password') }}" class="text-sm text-blue-600 ">Forgot Password</a>
            </div>
            <!-- login button -->
            <button type="submit"
                class="w-full text-center bg-orange-400 h-12 rounded-xl mb-5 text-2xl font-bold text-white">Login</button>
        </form>
        <p class="text-sm font-semibold text-center text-black">Don't have an account? <a
                href="{{ route('auth.register') }}" class="text-blue-600">Register</a></p>
        <div class="w-full relative">
            <hr class="border-t-2 border-slate-400 mt-8 relative">
            <div class="absolute -top-5 left-[30%] bg-[#FFFCFC] py-2 px-10">or login with</div>
        </div>
        <!-- button login google -->
        <a href="{{ route('auth.google') }}" id="btn-google"
            class="w-full flex items-center justify-center bg-[#EFEFEF] h-12 rounded-xl mb-5 text-2xl font-bold text-black mt-10">
            <img src="{{ asset('img/assets/icon/icon_google.png') }}" alt="Google Icon" class="h-6 w-6 mr-3">
            Login With Google
        </a>


    </div>

    <script>
        // show and hide password text input field (for 'password')
        const passwordField = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');

        togglePassword.addEventListener('click', function() {
            // Toggle the password field type between 'password' and 'text'
            const type = passwordField.type === 'password' ? 'text' : 'password';
            passwordField.type = type;

            // Optionally, change the icon based on password visibility
            const eyeIcon = type === 'password' ? 'icon_hide_eye.svg' : 'icon_show_eye.svg';
            togglePassword.src = `{{ asset('img/assets/icon/${eyeIcon}') }}`;
        });

        document.getElementById('btn-google').addEventListener('click', function(e) {
            e.preventDefault();
            const googleSignin = window.open("{{ route('auth.google') }}", "google-signin",
                "width=500,height=600");
        });
    </script>
@endsection
