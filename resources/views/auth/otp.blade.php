@extends('layout.master')

@section('title', ' test')

@section('content')

<div class="bg-white h-auto max-w-md p-10 m-auto shadow-lg mt-12 rounded-2xl">
    <!-- !!! kurang tambahin icon mail -->
         <img src="{{ asset('img/assets/icon/iconmonstr-email-4-96.png') }}" alt="email icon" class="mx-auto scale-75 mb-6 mt-4">
    <h1 class="text-orange-400 text-2xl font-bold mb-1 text-center">Verification</h1>
    <p class="text-[#B7B7B7] text-md text-center font-medium">You will get a OTP via email</p>
    <h2 class="text-[#898383] text-lg text-left font-medium mt-10">OTP Code</h2>
    <!-- start of form -->
    <form action="">
        <!-- input OTP -->
        <input type="text" class="w-full rounded-xl border border-orange-400 h-14 mt-4 focus:outline-none focus:ring-0 focus:border-orange-400">

        <!-- verify button -->
        <button type="submit" class="w-full flex items-center justify-center bg-orange-400 h-12 rounded-xl mb-5 text-2xl font-bold text-white mt-10">
            Verify
            <img src="{{ asset('img/assets/icon/icon_email_white.png') }}" alt="mail Icon" class="h-6 w-6 ml-3">
        </button>
        <p class="text-sm font-medium text-center text-[#B7B7B7]">Didn't receive the verification OTP?<a href="#"class="text-blue-600 ml-2">Resend</a></p>
    </form>
</div>


@endsection