@extends('layout.auth')
@section('title', ' - Login')

@section('content')
    <div class="bg-white w-1/2 max-w-lg p-10 m-auto shadow-lg rounded-2xl">
        <h1 class="text-black text-xl font-bold mb-5">Masuk Ke <span class="text-orange-400">Hepi</span>Korea</h1>
        <!-- start of form -->
        <form action="{{ route('auth.login') }}" method="POST">
            @csrf
            @method('POST')
            <!-- input text username -->
            <!-- <input type="text" placeholder="Username" class="w-full rounded-xl bg-[#EFEFEF] shadow-md border-none h-14 bg-[url('{{ asset('img/assets/icon/icon_user.png') }}')]"> -->
            <div class="relative w-full">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                    <img src="{{ asset('img/assets/icon/icon_user.svg') }}" alt="User Icon" class="h-6 w-6">
                </span>
                <input type="email" placeholder="Email" name="email"
                    class="pl-12 w-full rounded-xl bg-[#EFEFEF] shadow-md border-none h-14 focus:outline-none focus:ring-0">
            </div>

            <!-- input text password -->
            <!-- <input type="text" placeholder="Password" class="w-full rounded-xl bg-[#EFEFEF] shadow-md border-none h-14 mt-5"> -->
            <div class="relative w-full mt-5">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                    <img src="{{ asset('img/assets/icon/icon_lock.svg') }}" alt="lock Icon" class="h-6 w-6">
                </span>
                <input id="password" type="password" name="password" placeholder="Password"
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
        <a href="{{ route('auth.google') }}"
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

        // show and hide password text input field (for 'confrim password')
        const confirmPasswordField = document.getElementById('confirmPassword');
        const confirmTogglePassword = document.getElementById('toggleConfirmPassword');

        confirmTogglePassword.addEventListener('click', function() {
            // Toggle the password field type between 'password' and 'text'
            const type = confirmPasswordField.type === 'password' ? 'text' : 'password';
            confirmPasswordField.type = type;

            // Optionally, change the icon based on password visibility
            const eyeIcon = type === 'password' ? 'icon_hide_eye.svg' : 'icon_show_eye.svg';
            confirmTogglePassword.src = `{{ asset('img/assets/icon/${eyeIcon}') }}`;
        });
    </script>
@endsection
