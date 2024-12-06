@extends('layout.auth')
@section('title', ' - Password Reset')

@section('content')
    <div class="bg-white h-auto w-1/2 max-w-md p-10 m-auto shadow-lg rounded-2xl">
        <h1 class="text-black text-xl font-extrabold mb-5">Password Reset</h1>
        <!-- start of form -->
        <form action="{{ route('auth.forgot_password') }}" method="POST">
            @csrf
            <!-- input text email -->
            <div class="relative w-full mt-5">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                    <!-- ganti asset nya jadi email -->
                    <img src="{{ asset('img/assets/icon/icon_email.png') }}" alt="User Icon" class="h-6 w-6">
                </span>
                <input type="email" placeholder="Email" name="email"
                    class="pl-12 w-full rounded-xl bg-[#EFEFEF] shadow-md border-none h-14 focus:outline-none focus:ring-0 placeholder:text-[#B7B7B7]">
            </div>

            <!-- login button -->
            <button type="submit"
                class="w-full text-center bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] h-12 rounded-xl mb-5 text-2xl font-bold text-white shadow-md mt-5">Send</button>
        </form>
    </div>

@endsection
