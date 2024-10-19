@extends('layout.auth')

@section('title', 'change password test')

@section('content')

<div class="bg-white h-auto max-w-lg p-10 m-auto shadow-lg mt-12 rounded-2xl">
    <h1 class="text-black text-xl font-bold mb-5">Password Reset</h1>
    <!-- start of form -->
    <form action="">
        <!-- input text password -->
        <!-- <input type="text" placeholder="Password" class="w-full rounded-xl bg-[#EFEFEF] shadow-md border-none h-14 mt-5"> -->
        <div class="relative w-full mt-5">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                <img src="{{ asset('img/assets/icon/icon_lock.svg') }}" alt="lock Icon" class="h-6 w-6">
            </span>
            <input id="password" type="password" placeholder="Password"
            class="pl-12 w-full rounded-xl bg-[#EFEFEF] shadow-md border-none h-14 focus:outline-none focus:ring-0">
            <!-- show/hide password -->
            <span class="absolute inset-y-0 right-0 pr-6 flex items-center">
                <img id="togglePassword" src="{{ asset('img/assets/icon/icon_hide_eye.svg') }}" alt="eye hide Icon" class="h-6 w-6 cursor-pointer">
            </span>
        </div>

        <!-- input text password confirm -->
        <div class="relative w-full mt-5">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                <img src="{{ asset('img/assets/icon/icon_lock.svg') }}" alt="User Icon" class="h-6 w-6">
            </span>
            <input id="confirmPassword" type="password" placeholder="Confirm Password"
                class="pl-12 w-full rounded-xl bg-[#EFEFEF] shadow-md border-none h-14 focus:outline-none focus:ring-0">
            <!-- show/hide password -->
            <span class="absolute inset-y-0 right-0 pr-6 flex items-center">
                <img id="toggleConfirmPassword" src="{{ asset('img/assets/icon/icon_hide_eye.svg') }}" alt="eye hide Icon" class="h-6 w-6 cursor-pointer ">
            </span>
        </div>

        <!-- login button -->
        <button type="submit"
            class="w-full text-center bg-orange-400 h-12 rounded-xl mb-5 text-2xl font-bold text-white shadow-md mt-5">Send</button>
    </form>
</div>


<script>
    // show and hide password text input field (for 'password')
     const passwordField = document.getElementById('password');
     const togglePassword = document.getElementById('togglePassword');

     togglePassword.addEventListener('click', function () {
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

     confirmTogglePassword.addEventListener('click', function () {
         // Toggle the password field type between 'password' and 'text'
         const type = confirmPasswordField.type === 'password' ? 'text' : 'password';
         confirmPasswordField.type = type;

        // Optionally, change the icon based on password visibility
        const eyeIcon = type === 'password' ? 'icon_hide_eye.svg' : 'icon_show_eye.svg';
        confirmTogglePassword.src = `{{ asset('img/assets/icon/${eyeIcon}') }}`;
    });
</script>
@endsection
