@extends('layout.auth')
@section('title', ' - Register')

@section('content')
    <div class="bg-white h-auto w-1/2 max-w-md p-10 m-auto shadow-lg rounded-2xl">
        <h1 class="text-black text-xl font-extrabold mb-5">Masuk Ke <span class="text-[#3E6E7A]">Hepi</span><span class="text-orange-400">Korea</span></h1>
        <!-- start of form -->
        <form action="{{ route('auth.register') }}" method="POST">
            @csrf
            @method('POST')
            <div class="relative w-full">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                    <img src="{{ asset('img/assets/icon/icon_user.svg') }}" alt="User Icon" class="h-6 w-6">
                </span>
                <input type="text" placeholder="Fullname" name="fullname" value="{{ old('fullname') }}" required
                    class="pl-12 w-full rounded-xl bg-[#EFEFEF] shadow-md @error('fullname') text-red-500 border-red-500 @else border-none @enderror h-14 focus:outline-none focus:ring-0 placeholder:text-[#B7B7B7]">
            </div>
            @error('fullname')
                <p class="mt-2 text-sm text-red-500 dark:text-red-500">{{ $message }}</p>
            @enderror

            <div class="relative w-full mt-5">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                    <!-- ganti asset nya jadi email -->
                    <img src="{{ asset('img/assets/icon/icon_email_input.svg') }}" alt="User Icon" class="h-6 w-6">
                </span>
                <input type="text" placeholder="Email" name="email" value="{{ old('email') }}" required
                    class="pl-12 w-full rounded-xl bg-[#EFEFEF] shadow-md @error('email') text-red-500 border-red-500 @else border-none @enderror  h-14 focus:outline-none focus:ring-0 placeholder:text-[#B7B7B7]">
            </div>
            @error('email')
                <p class="mt-2 text-sm text-red-500 dark:text-red-500">{{ $message }}</p>
            @enderror

            <div class="relative w-full mt-5">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                    <img src="{{ asset('img/assets/icon/icon_lock.svg') }}" alt="lock Icon" class="h-6 w-6">
                </span>
                <input id="password" type="password" placeholder="Password" name="password" required
                    class="pl-12 w-full rounded-xl bg-[#EFEFEF] shadow-md @error('password') text-red-500 border-red-500 @else border-none @enderror h-14 focus:outline-none focus:ring-0 placeholder:text-[#B7B7B7]">
                <!-- show/hide password -->
                <span class="absolute inset-y-0 right-0 pr-6 flex items-center">
                    <img id="togglePassword" src="{{ asset('img/assets/icon/icon_hide_eye.svg') }}" alt="eye hide Icon"
                        class="h-6 w-6 cursor-pointer">
                </span>
            </div>
            @error('password')
                <p class="mt-2 text-sm text-red-500 dark:text-red-500">{{ $message }}</p>
            @enderror

            <div class="relative w-full mt-5">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                    <img src="{{ asset('img/assets/icon/icon_lock.svg') }}" alt="User Icon" class="h-6 w-6">
                </span>
                <input id="confirmPassword" type="password" name="password_confirmation" placeholder="Confirm Password"
                    required
                    class="pl-12 w-full rounded-xl bg-[#EFEFEF] shadow-md border-none h-14 focus:outline-none focus:ring-0 placeholder:text-[#B7B7B7]">
                <!-- show/hide password -->
                <span class="absolute inset-y-0 right-0 pr-6 flex items-center">
                    <img id="toggleConfirmPassword" src="{{ asset('img/assets/icon/icon_hide_eye.svg') }}"
                        alt="eye hide Icon" class="h-6 w-6 cursor-pointer">
                </span>
            </div>

            <button type="submit"
                class="w-full text-center bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] h-12 rounded-xl mb-5 text-2xl font-bold text-white shadow-md mt-5">Register</button>
        </form>
        <p class="text-sm font-semibold text-start text-black">Have an account? <a
                href="{{ route('auth.login') }}"class="text-blue-600">Login</a></p>
        <div class="w-full relative">
            <hr class="border-t-2 border-slate-400 mt-8 relative">
            <div class="absolute -top-5 left-[25%] bg-[#FFFCFC] text-[#B7B7B7] py-2 px-10">or login with</div>
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

        document.getElementById('btn-google').addEventListener('click', function(e) {
            e.preventDefault();
            const googleSignin = window.open("{{ route('auth.google') }}", "google-signin",
                "width=500,height=600");
        });
    </script>

@endsection
