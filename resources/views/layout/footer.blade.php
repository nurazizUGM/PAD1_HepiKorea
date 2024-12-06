{{-- footer --}}
<div
    class="w-[92%] w-max[92%] h-fit mx-auto mt-7 md:mt-14 mb-7 md:mb-14 rounded-3xl overflow-hidden bg-[#3E6E7A] text-white pt-5 md:pt-10 pb-7 md:pb-14 px-6 md:px-12 flex flex-col md:flex-row">
    <div class="w-full md:w-[25%] h-full flex flex-col mb-2 md:mb-0">
        {{-- HepiKorea title --}}
        <h1 class="text-3xl md:text-4xl font-bold">HepiKorea</h1>
        <p class="text-sm md:text-base font-medium mt-1">Get us more on</p>
        {{-- icons container --}}
        <div class="flex flex-row mt-2 md:mt-8 md:align-middle gap-x-4">
            @if ($setting = \App\Models\Setting::where('key', 'instagram')->first())
                <a href="https://instagram.com/{{ $setting->value }}" target="_blank"><img
                        src="{{ asset('img/assets/icon/icon_footer_insta.svg') }}" alt=""
                        class="w-7 h-7 md:w-11 md:h-11"></a>
            @endif
            @if ($setting = \App\Models\Setting::where('key', 'email')->first())
                <a href="mailto:{{ $setting->value }}" target="_blank"><img
                        src="{{ asset('img/assets/icon/icon_footer_gmail.svg') }}" alt=""
                        class="w-7 h-7 md:w-11 md:h-11"></a>
            @endif
            @if ($setting = \App\Models\Setting::where('key', 'whatsapp')->first())
                <a href="https://wa.me/{{ $setting->value }}" target="_blank"><img
                        src="{{ asset('img/assets/icon/icon_footer_wa.svg') }}" alt=""
                        class="w-7 h-7 md:w-11 md:h-11"></a>
            @endif
            @if ($setting = \App\Models\Setting::where('key', 'line')->first())
                <a href="{{ $setting->value }}" target="_blank"><img
                        src="{{ asset('img/assets/icon/icon_footer_line.svg') }}" alt=""
                        class="w-6 h-7 md:w-9 md:h-11"></a>
            @endif
        </div>
    </div>
    <div class="w-full md:w-[50%] h-full flex flex-col md:pr-4 align-top mb-2 md:mb-0">
        <h1 class="text-sm md:text-lg font-medium mb-1 md:mb-4">ABOUT</h1>
        @php
            $setting = \App\Models\Setting::where('key', 'about')->first();
            $about = $setting ? $setting->value : '';
        @endphp
        <p class="text-justify font-medium text-xs md:text-base">{{ $about }}</p>
    </div>
    <div class="w-full md:w-[25%] md:w-max-[25%] h-full flex flex-col flex-wrap md:pl-8">
        @php
            $phone = \App\Models\Setting::where('key', 'phone')->first();
            $email = \App\Models\Setting::where('key', 'email')->first();
            $address = \App\Models\Setting::where('key', 'address')->first();
        @endphp
        <h1 class="text-sm md:text-lg font-medium mb-1 md:mb-4">CONTACT</h1>
        <p class="text-justify font-medium text-xs md:text-base">Phone : +{{ $phone ? $phone->value : '' }}</p>
        <p class="text-justify font-medium text-xs md:text-base">Email : {{ $email ? $email->value : '' }}</p>
        <p class="text-justify font-medium text-xs md:text-base">Address : {{ $address ? $address->value : '' }}</p>
    </div>
</div>
{{-- end of footer --}}

<p class="text-center text-xs md:text-base">&copy; 2024 HepiKorea. All rights reserved</p>
