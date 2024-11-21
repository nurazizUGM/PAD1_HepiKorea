@extends('layout.customer')
@section('title', 'Notification')

@section('content')
    <div class="w-full w-max[100%] h-full rounded-3xl bg-[#EFEFEF] py-8 px-10">
        {{-- content container --}}
        <div class="w-full min-h-[680px] overflow-hidden rounded-3xl bg-white flex flex-col py-4 px-10">
            <h1 class="text-black font-semibold text-2xl">Notification</h1>
            {{-- list of notification container --}}
            <div class="w-full h-full flex flex-col gap-y-4 mt-4">

                @foreach ($notifications as $notification)
                    {{-- Notification --}}
                    <div class="w-full h-fit bg-white rounded-2xl shadow-lg p-4 cursor-pointer"
                        @if ($notification->action_url) onclick="window.location.href='{{ $notification->action_url }}'" @endif>
                        {{-- notification date --}}
                        <p class="text-[#B7B7B7] font-semibold text-sm cursor-text">
                            {{ $notification->created_at->format('d-M-Y H:i') }}
                        </p>
                        <div class="w-ful h-full flex flex-row mt-3 cursor-auto">
                            <img src="{{ asset('img/example/admin_order_img_phone.png') }}" alt="img_product"
                                class="h-20 object-contain">
                            <div class="flex flex-col ml-10">
                                <h1 class="text-[#3E6E7A] text-xl font-semibold">{{ $notification->title }}</h1>
                                <p class="text-[#3E6E7A] my-auto ml-auto">
                                    {{ $notification->message }}
                                </p>
                            </div>
                        </div>
                    </div>
                    {{-- end of Notification --}}
                @endforeach

            </div>
            {{-- end of list of notification container --}}
        </div>
        {{-- end of lis content container --}}
    </div>
    <div class="h-10 w-full"></div>
@endsection

{{-- disable footer --}}
@section('footer', '')
