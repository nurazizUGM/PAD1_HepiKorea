@extends('layout.auth')
@section('title', ' test')

@section('content')
    <div class="bg-white h-auto w-1/2 max-w-md p-10 m-auto shadow-lg rounded-2xl">
        <!-- !!! kurang tambahin icon mail -->
        <img src="{{ asset('img/assets/icon/icon_email_green.svg') }}" alt="email icon" class="mx-auto scale-150 mb-6 mt-20 rounded-lg">
        <h1 class="text-[#3E6E7A] text-3xl font-extrabold mt-20 mb-1 text-center">Verification</h1>
        <p class="text-[#B7B7B7] text-md text-center font-medium">You will get a OTP at {{ $email }}</p>
        <h2 class="text-[#898383] text-lg text-left font-medium mt-10">OTP Code</h2>
        <!-- start of form -->
        <form action="{{ route('auth.verify_code') }}" method="POST">
            @csrf

            <!-- input OTP -->
            <input type="text" name="code" minlength="6" maxlength="6" required placeholder="Enter Your Code"
                class="w-full rounded-xl border border-[#3E6E7A] h-14 mt-4 focus:outline-none focus:ring-0 focus:border-[#3E6E7A]">

            <!-- verify button -->
            <button type="submit"
                class="w-full flex items-center justify-center bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] h-12 rounded-xl mb-5 text-2xl font-bold text-white mt-10">
                Verify
                <img src="{{ asset('img/assets/icon/icon_email_white.svg') }}" alt="mail Icon" class="h-6 w-6 ml-3">
            </button>
            <p class="text-sm font-medium text-center text-[#B7B7B7]">Didn't receive the verification OTP?<a
                    href="{{ route('auth.verify', ['resend' => true]) }}"class="text-blue-600 ml-2" onclick="return false"
                    id="resend_btn"></a>
            </p>
        </form>
    </div>
    <script>
        let timeout = {{ $timeout }};
        let resend_btn = document.getElementById('resend_btn');
        let timer = setInterval(() => {
            if (timeout > 0) {
                const minutes = Math.floor(timeout / 60);
                const seconds = timeout % 60;
                resend_btn.innerHTML = `wait ${minutes}m ${seconds}s`;
                timeout--;
            } else {
                resend_btn.innerHTML = `Resend`;
                clearInterval(timer);
                resend_btn.onclick = null;
            }
        }, 1000);
    </script>
@endsection
