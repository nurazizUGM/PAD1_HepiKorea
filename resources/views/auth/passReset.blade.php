@extends('layout.master')

@section('title', 'password reset test')

@section('content')

<div class="bg-white h-auto max-w-lg p-10 m-auto shadow-lg mt-12 rounded-2xl">
    <h1 class="text-black text-xl font-bold mb-5">Password Reset</h1>
    <!-- start of form -->
    <form action="">
        <!-- input text email -->
        <div class="relative w-full mt-5">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                <!-- ganti asset nya jadi email -->
                <img src="{{ asset('img/assets/icon/icon_email.png') }}" alt="User Icon" class="h-6 w-6">
            </span>
            <input type="text" placeholder="Email"
                class="pl-12 w-full rounded-xl bg-[#EFEFEF] shadow-md border-none h-14">
        </div>

        <!-- login button -->
        <button type="submit"
            class="w-full text-center bg-orange-400 h-12 rounded-xl mb-5 text-2xl font-bold text-white shadow-md mt-5">Send</button>
    </form>
</div>

@endsection