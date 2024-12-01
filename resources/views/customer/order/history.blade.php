@extends('layout.customer')
@section('title', 'Transaction History')
@section('footer', '')

@php
    if (!isset($tab)) {
        $tab = request()->query('tab', 'unpaid');
    }
@endphp

@section('content')
    <div class="w-full w-max[100%] h-fit min-h-[650px] rounded-3xl bg-[#EFEFEF] pb-8 pt-2 px-10">

        <div class="mb-4 border-b border-gray-200">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-styled-tab"
                data-tabs-toggle="#default-styled-tab-content" data-tabs-active-classes="text-black border-orange-400"
                data-tabs-inactive-classes="text-black border-none" role="tablist">
                <li class="mx-auto" role="presentation">
                    <button class="inline-block p-4 border-b-4 rounded-t-lg text-xl font-semibold" id="confirmation-tab"
                        data-tabs-target="#confirmation-content" type="button" role="tab" aria-controls="confirmation"
                        aria-selected="{{ $tab == 'confirmation' ? 'true' : 'false' }}">Confirmation</button>
                </li>
                <li class="mx-auto" role="presentation">
                    <button class="inline-block p-4 border-b-4 rounded-t-lg text-xl font-semibold" id="unpaid-tab"
                        data-tabs-target="#unpaid-content" type="button" role="tab" aria-controls="unpaid"
                        aria-selected="{{ $tab == 'unpaid' ? 'true' : 'false' }}">Unpaid</button>
                </li>
                <li class="mx-auto" role="presentation">
                    <button class="inline-block p-4 border-b-4 rounded-t-lg text-xl font-semibold" id="processed-tab"
                        data-tabs-target="#processed-content" type="button" role="tab" aria-controls="processed"
                        aria-selected="{{ $tab == 'processed' ? 'true' : 'false' }}">Processed</button>
                </li>
                <li class="mx-auto" role="presentation">
                    <button class="inline-block p-4 border-b-4 rounded-t-lg text-xl font-semibold" id="sent-tab"
                        data-tabs-target="#sent-content" type="button" role="tab" aria-controls="sent"
                        aria-selected="{{ $tab == 'sent' ? 'true' : 'false' }}">Sent</button>
                </li>
                <li class="mx-auto" role="presentation">
                    <button class="inline-block p-4 border-b-4 rounded-t-lg text-xl font-semibold" id="finish-tab"
                        data-tabs-target="#finish-content" type="button" role="tab" aria-controls="finish"
                        aria-selected="{{ $tab == 'finished' ? 'true' : 'false' }}">Finish</button>
                </li>
                <li class="mx-auto" role="presentation">
                    <button class="inline-block p-4 border-b-4 rounded-t-lg text-xl font-semibold" id="cancelled-tab"
                        data-tabs-target="#cancelled-content" type="button" role="tab" aria-controls="cancelled"
                        aria-selected="{{ $tab == 'cancelled' ? 'true' : 'false' }}">Cancelled</button>
                </li>
            </ul>
        </div>

        {{-- TAB CONTENT --}}
        <div id="default-styled-tab-content">
            {{-- CONFIRMATION CONTENT --}}
            <div class="hidden p-4 rounded-lg" id="confirmation-content" role="tabpanel" aria-labelledby="confirmation-tab">
                {{-- list of unpaid order container --}}
                <div class="w-full h-full flex flex-col gap-y-6">

                    @foreach ($confirmation as $order)
                        @php
                            $item = $order->customOrderItems->first();
                            $items = $order->customOrderItems->count();
                        @endphp
                        {{-- unpaid product --}}
                        <div class="w-full h-full bg-white rounded-2xl flex flex-row py-8 px-8">
                            <div class="w-[20%]">
                                {{-- unpaid product image --}}
                                @if ($item->image && Storage::exists($item->image))
                                    <img src="{{ Storage::url($item->image) }}" alt="unpaid_image_product"
                                        class="h-48 object-contain mx-auto">
                                @else
                                    <img src="{{ asset('img/example/example_phone.png') }}" alt="unpaid_image_product"
                                        class="h-48 object-contain mx-auto">
                                @endif
                            </div>
                            <div class="w-[80%] flex flex-col">
                                <div class="w-full h-1/2 flex flex-row">
                                    <div class="w-[33%] h-full flex flex-col">
                                        {{-- unpaid product name --}}
                                        <h1 class="text-black font-semibold text-xl">{{ $item->name }}</h1>
                                        {{-- unpaid product variant --}}
                                        @if ($items > 1)
                                            <p class="text-black text-opacity-50 font-semibold text-xl">
                                                and {{ $items - 1 }} other items
                                            </p>
                                        @endif
                                    </div>
                                    <div class="ms-auto h-full flex">
                                        <p class="text-[#3E6E7A] text-xl font-semibold ml-auto">
                                            Rp
                                            {{ number_format($order->total_items_price + $order->service_price, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="w-full h-1/2 flex flex-row">
                                    {{-- status --}}
                                    <div class="w-1/2">
                                        <div
                                            class="h-fit w-fit px-4 py-2 bg-[#3E6E7A] text-white font-semibold text-base rounded-2xl shadow-md">
                                            <p>status: {{ $order->status }}</p>
                                        </div>
                                    </div>
                                    {{-- two button container --}}
                                    <div class="w-1/2 ms-auto flex flex-row justify-end items-center">
                                        <button onclick="window.location.href = '{{ route('order.show', $order->id) }}'"
                                            class="w-5/12 h-fit rounded-2xl bg-white hover:bg-slate-50 border-2 border-[#3E6E7A] text-xl text-[#3E6E7A] py-3">Detail</button>
                                        <button onclick="window.location.href = '{{ route('order.cancel', $order->id) }}'"
                                            class="w-5/12 h-fit rounded-2xl bg-white hover:bg-slate-50 border-2 border-[#3E6E7A] text-xl text-[#3E6E7A] py-3 ml-4">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- end of unpaid product --}}
                    @endforeach
                </div>
                {{-- list of unpaid order container --}}
            </div>
            {{-- end of CONFIRMATION CONTENT --}}

            {{-- UNPAID CONTENT --}}
            <div class="hidden p-4 rounded-lg" id="unpaid-content" role="tabpanel" aria-labelledby="unpaid-tab">
                {{-- list of unpaid order container --}}
                <div class="w-full h-full flex flex-col gap-y-6">

                    @foreach ($unpaid as $order)
                        @php
                            if ($order->type == 'custom') {
                                $item = $order->customOrderItems->first();
                                $productName = $item->name;
                                $totalPrice = $order->total_items_price + $order->service_price;
                                $image = $item->image;
                                $count = $order->customOrderItems->count();
                            } else {
                                $item = $order->orderItems->first();
                                $productName = $item->product->name;
                                $totalPrice = $order->total_items_price;
                                $image = 'products/' . $item->product->images->first()->path;
                                $count = $order->orderItems->count();
                            }

                            $totalPrice = number_format($totalPrice, 0, ',', '.');
                            $lastPayment = $order->orderPayment->first();
                            if ($lastPayment && $lastPayment->status == 'pending' && $lastPayment->expired_at > now()) {
                                $expiredTime = $lastPayment->expired_at->format('d-M-Y H:i');
                                $paymentMethod = ucwords(str_replace('_', ' ', $lastPayment->payment_method));
                            } else {
                                $lastPayment = null;
                            }
                        @endphp
                        {{-- unpaid product --}}
                        <div class="w-full h-full bg-white rounded-2xl flex flex-row py-8 px-8">
                            <div class="w-[20%]">
                                {{-- unpaid product image --}}
                                @if ($image && Storage::exists($image))
                                    <img src="{{ Storage::url($image) }}" alt="unpaid_image_product"
                                        class="h-48 object-contain mx-auto">
                                @else
                                    <img src="{{ asset('img/example/example_phone.png') }}" alt="unpaid_image_product"
                                        class="h-48 object-contain mx-auto">
                                @endif
                            </div>
                            <div class="w-[80%] flex flex-col">
                                <div class="w-full h-1/2 flex flex-row">
                                    <div class="w-[33%] h-full flex flex-col">
                                        {{-- unpaid product name --}}
                                        <h1 class="text-black font-semibold text-xl cursor-pointer"
                                            onclick="window.location.href='{{ route('order.show', $order->id) }}'">
                                            {{ $productName }}</h1>
                                        {{-- unpaid product variant --}}
                                        @if ($count > 1)
                                            <p class="text-black text-opacity-50 font-semibold text-xl">and
                                                {{ $count - 1 }} other items</p>
                                        @endif
                                    </div>
                                    <div class="w-[22%] ms-auto h-full flex">
                                        <p class="text-[#3E6E7A] text-xl font-semibold ml-auto">Rp {{ $totalPrice }}</p>
                                    </div>
                                </div>
                                <div class="w-full h-1/2 flex flex-row">
                                    @if ($lastPayment)
                                        <div class="w-1/2">
                                            <div
                                                class="w-full h-full bg-[#3E6E7A] text-white font-semibold text-base rounded-2xl shadow-md p-4">
                                                {{-- text payment reminder --}}
                                                <p>
                                                    Bayar sebelum {{ $expiredTime }} dengan
                                                    {{ $paymentMethod }}
                                                </p>
                                            </div>
                                        </div>
                                    @endif

                                    {{-- two button container --}}
                                    <div class="w-1/2 ml-auto flex flex-row justify-end items-center">
                                        @if ($lastPayment)
                                            <button
                                                class="w-5/12 h-fit rounded-2xl bg-white hover:bg-slate-50 border-2 border-[#3E6E7A] text-xl text-[#3E6E7A] py-3"
                                                onclick="pay(event, {{ $lastPayment }})">
                                                Pay Product
                                            </button>
                                        @endif
                                        <button onclick="window.location.href='{{ route('order.cancel', $order->id) }}'"
                                            class="w-5/12 h-fit rounded-2xl bg-white hover:bg-slate-50 border-2 border-[#3E6E7A] text-xl text-[#3E6E7A] py-3 ml-4">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- end of unpaid product --}}
                    @endforeach

                </div>
                {{-- list of unpaid order container --}}
            </div>
            {{-- end of UNPAID CONTENT --}}

            {{--  --}}

            {{-- PROCESSED CONTENT --}}
            <div class="hidden p-4 rounded-lg" id="processed-content" role="tabpanel" aria-labelledby="dashboard-tab">
                {{-- list of processed order container --}}
                <div class="w-full h-full flex flex-col gap-y-6">

                    @foreach ($processed as $order)
                        @php
                            if ($order->type == 'custom') {
                                $item = $order->customOrderItems->first();
                                $productName = $item->name;
                                $totalPrice = $order->total_items_price + $order->service_price;
                                $image = $item->image;
                                $count = $order->customOrderItems->count();
                            } else {
                                $item = $order->orderItems->first();
                                $productName = $item->product->name;
                                $totalPrice = $order->total_items_price;
                                $image = 'products/' . $item->product->images->first()->path;
                                $count = $order->orderItems->count();
                            }

                            $totalPrice = number_format($totalPrice, 0, ',', '.');
                            $arrivalTime = $order->arrival_time;
                        @endphp
                        {{-- processed product --}}
                        <div class="w-full h-full bg-white rounded-2xl flex flex-row py-8 px-8">
                            <div class="w-[20%]">
                                {{-- processed product image --}}
                                @if ($image && Storage::exists($image))
                                    <img src="{{ Storage::url($image) }}" alt="processed_image_product"
                                        class="h-48 object-contain mx-auto">
                                @else
                                    <img src="{{ asset('img/example/example_phone.png') }}" alt="processed_image_product"
                                        class="h-48 object-contain mx-auto">
                                @endif
                            </div>
                            <div class="w-[80%] flex flex-col">
                                <div class="w-full h-1/2 flex flex-row">
                                    <div class="w-[33%] h-full flex flex-col">
                                        {{-- processed product name --}}
                                        <h1 class="text-black font-semibold text-xl cursor-pointer"
                                            onclick="window.location.href='{{ route('order.show', $order->id) }}'">
                                            {{ $productName }}</h1>
                                        {{-- processed product variant --}}
                                        @if ($count > 1)
                                            <p class="text-black text-opacity-50 font-semibold text-xl">
                                                and {{ $count - 1 }} other items
                                            </p>
                                        @endif
                                    </div>
                                    <div class="w-[22%] ms-auto h-full flex">
                                        <p class="text-[#3E6E7A] text-xl font-semibold ml-auto">
                                            Rp {{ $totalPrice }}
                                        </p>
                                    </div>
                                </div>
                                <div class="w-full h-1/2 flex flex-row">
                                    <div class="w-1/2 mx-auto">
                                        <div
                                            class="w-full h-full flex bg-[#3E6E7A] text-white font-semibold text-base rounded-2xl shadow-md p-4">
                                            {{-- text payment reminder --}}
                                            <p class="my-auto">
                                                @if ($arrivalTime)
                                                    Estimated Arrival in Indonesia:
                                                    {{ $arrivalTime->format('d M Y') }}
                                                    <br>
                                                @endif
                                                The order is on its way to Indonesia
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- end of processed product --}}
                    @endforeach

                </div>
            </div>
            {{-- end of PROCESSED CONTENT --}}

            {{--  --}}

            {{-- SENT CONTENT --}}
            <div class="hidden p-4 rounded-lg" id="sent-content" role="tabpanel" aria-labelledby="sent-tab">
                {{-- list of sent order container --}}
                <div class="w-full h-full flex flex-col gap-y-6">

                    @for ($i = 0; $i < 1; $i++)
                        {{-- sent product --}}
                        <div class="w-full h-full bg-white rounded-2xl flex flex-row py-8 px-8">
                            <div class="w-[20%]">
                                {{-- sent product image --}}
                                <img src="{{ asset('img/example/example_phone.png') }}" alt="sent_image_product"
                                    class="h-48 object-contain mx-auto">
                            </div>
                            <div class="w-[80%] flex flex-col">
                                <div class="w-full h-1/2 flex flex-row">
                                    <div class="w-[33%] h-full flex flex-col">
                                        {{-- sent product name --}}
                                        <h1 class="text-black font-semibold text-xl">Samsung S24 Ultra</h1>
                                        {{-- sent product variant --}}
                                        <p class="text-black text-opacity-50 font-semibold text-xl">Black</p>
                                    </div>
                                    <div class="w-[21%] h-full">
                                        {{-- sent product weight --}}
                                        <p class="text-black text-opacity-60 font-semibold text-xl">300g</p>
                                    </div>
                                    <div class="w-[20%] h-full">
                                        <p class="text-black text-opacity-60 font-semibold text-xl">1x</p>
                                    </div>
                                    <div class="w-[22%] h-full flex">
                                        <p class="text-[#3E6E7A] text-xl font-semibold ml-auto">Rp 24.000.000</p>
                                    </div>
                                </div>
                                <div class="w-full h-1/2 flex flex-row">
                                    <div class="w-[52%]">
                                        <div
                                            class="w-full h-full flex bg-[#3E6E7A] text-white font-semibold text-base rounded-2xl shadow-md py-4 px-6">
                                            {{-- text payment reminder --}}
                                            <p class="my-auto">
                                                Estimated Arrival in Destination: 11 Sep - 20 Sep <br>
                                                The order is on its way to Destination Address
                                            </p>
                                        </div>
                                    </div>
                                    <div class="w-[48%] flex flex-row justify-end items-center">
                                        <button
                                            class="w-1/2 h-fit rounded-2xl bg-white border-2 border-[#3E6E7A] text-xl text-[#3E6E7A] py-3"
                                            data-modal-target="detail-shipment-modal"
                                            data-modal-toggle="detail-shipment-modal">
                                            Pay Shipment
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        {{-- end of sent product --}}
                    @endfor
                    <button data-modal-target="payment-modal" data-modal-toggle="payment-modal">test
                        payment</button>
                    <button data-modal-target="qr-payment-modal" data-modal-toggle="qr-payment-modal">test qr
                        payment</button>
                    <button data-modal-target="payment-success-modal" data-modal-toggle="payment-success-modal">test
                        payment success</button>
                </div>
            </div>
            {{-- end of SENT CONTENT --}}

            {{--  --}}

            {{-- FINISH CONTENT --}}
            <div class="hidden p-4 rounded-lg" id="finish-content" role="tabpanel" aria-labelledby="finish-tab">
                {{-- list of finish order container --}}
                <div class="w-full h-full flex flex-col gap-y-6">

                    @for ($i = 0; $i < 2; $i++)
                        {{-- finish product --}}
                        <div class="w-full h-full bg-white rounded-2xl flex flex-row py-8 px-8">
                            <div class="w-[20%]">
                                {{-- finish product image --}}
                                <img src="{{ asset('img/example/example_phone.png') }}" alt="finish_image_product"
                                    class="h-48 object-contain mx-auto">
                            </div>
                            <div class="w-[80%] flex flex-col">
                                <div class="w-full h-1/2 flex flex-row">
                                    <div class="w-[33%] h-full flex flex-col">
                                        {{-- finish product name --}}
                                        <h1 class="text-black font-semibold text-xl">Samsung S24 Ultra</h1>
                                        {{-- finish product variant --}}
                                        <p class="text-black text-opacity-50 font-semibold text-xl">Black</p>
                                    </div>
                                    <div class="w-[21%] h-full">
                                        {{-- finish product weight --}}
                                        <p class="text-black text-opacity-60 font-semibold text-xl">300g</p>
                                    </div>
                                    <div class="w-[20%] h-full">
                                        <p class="text-black text-opacity-60 font-semibold text-xl">1x</p>
                                    </div>
                                    <div class="w-[22%] h-full flex">
                                        <p class="text-[#3E6E7A] text-xl font-semibold ml-auto">Rp 24.000.000</p>
                                    </div>
                                </div>
                                <div class="w-full h-1/2 flex flex-row">
                                    <div class="w-full flex flex-row justify-end items-center">
                                        <button
                                            class="w-[20%] h-fit rounded-2xl bg-white border-2 border-[#3E6E7A] text-xl text-[#3E6E7A] py-3"
                                            data-modal-target="review-modal" data-modal-toggle="review-modal">
                                            Review
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        {{-- end of finish product --}}
                    @endfor

                </div>
            </div>
            {{-- FINISH CONTENT --}}

            {{-- CANCELLED CONTENT --}}
            <div class="hidden p-4 rounded-lg" id="cancelled-content" role="tabpanel" aria-labelledby="cancelled-tab">
                {{-- list of finish order container --}}
                <div class="w-full h-full flex flex-col gap-y-6">

                    @for ($i = 0; $i < 2; $i++)
                        {{-- finish product --}}
                        <div class="w-full h-full bg-white rounded-2xl flex flex-row py-8 px-8">
                            <div class="w-[20%]">
                                {{-- finish product image --}}
                                <img src="{{ asset('img/example/example_phone.png') }}" alt="finish_image_product"
                                    class="h-48 object-contain mx-auto">
                            </div>
                            <div class="w-[80%] flex flex-col">
                                <div class="w-full h-1/2 flex flex-row">
                                    <div class="w-[33%] h-full flex flex-col">
                                        {{-- finish product name --}}
                                        <h1 class="text-black font-semibold text-xl">Samsung S24 Ultra</h1>
                                        {{-- finish product variant --}}
                                        <p class="text-black text-opacity-50 font-semibold text-xl">Black</p>
                                    </div>
                                    <div class="w-[21%] h-full">
                                        {{-- finish product weight --}}
                                        <p class="text-black text-opacity-60 font-semibold text-xl">300g</p>
                                    </div>
                                    <div class="w-[20%] h-full">
                                        <p class="text-black text-opacity-60 font-semibold text-xl">1x</p>
                                    </div>
                                    <div class="w-[22%] h-full flex">
                                        <p class="text-[#3E6E7A] text-xl font-semibold ml-auto">Rp 24.000.000</p>
                                    </div>
                                </div>
                                <div class="w-full h-1/2 flex flex-row">
                                    <div class="w-full flex flex-row justify-end items-center">
                                        <button
                                            class="w-[20%] h-fit rounded-2xl bg-white border-2 border-[#3E6E7A] text-xl text-[#3E6E7A] py-3"
                                            data-modal-target="review-modal" data-modal-toggle="review-modal">
                                            Review
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        {{-- end of finish product --}}
                    @endfor

                </div>
            </div>
            {{-- CANCELLED CONTENT --}}


        </div>
        {{-- end of TAB CONTENT --}}


        {{-- MODALS FOR TRANSACTION HISTORY --}}

        {{-- detail shipment modal --}}
        <div id="detail-shipment-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-fit max-w-5xl max-h-full mt-20">
                <!-- Modal content -->
                <div class="bg-white w-[41vw] h-auto rounded-[30px] shadow">
                    <div class="relative w-full h-full flex flex-row">
                        <!-- x button (exit modal) -->
                        <button type="button"
                            class="absolute bg-black w-6 h-6 flex flex-col align-middle text-center items-center rounded-full pb-3 -top-1 -right-1"
                            data-modal-hide="detail-shipment-modal">
                            <p class="m-auto text-white text-md">X</p>
                        </button>

                        {{-- modal content --}}
                        <div class="w-full h-full flex flex-col px-10 pt-10 pb-5">
                            <h1 class="text-black font-bold text-2xl">Detail Shipment</h1>
                            <div class="w-full h-full flex flex-col gap-y-6 mt-6">
                                {{-- Product name --}}
                                <div class="w-full h-fit flex flex-row">
                                    <div class="w-[67%] text-sm text-[#898383] font-bold">Product Name</div>
                                    <div class="w-[33%] text-sm text-[#3E6E7A] font-bold">samsung Ultra S24</div>
                                </div>
                                {{-- expedition name --}}
                                <div class="w-full h-fit flex flex-row">
                                    <div class="w-[67%] text-sm text-[#898383] font-bold">Expedition Name</div>
                                    <div class="w-[33%] text-sm text-[#3E6E7A] font-bold">Korean Expedition</div>
                                </div>
                                {{-- total expedition payment --}}
                                <div class="w-full h-fit flex flex-row">
                                    <div class="w-[67%] text-sm text-[#898383] font-bold">Total Expedition Payment</div>
                                    <div class="w-[33%] text-sm text-[#3E6E7A] font-bold">Rp 80.000,-</div>
                                </div>
                                {{-- shipment code --}}
                                <div class="w-full h-fit flex flex-row">
                                    <div class="w-[67%] text-sm text-[#898383] font-bold">Shipment Code</div>
                                    <div class="w-[33%] text-sm text-[#3E6E7A] font-bold">KAJSHDEF876</div>
                                </div>
                                {{-- estimated arrival time --}}
                                <div class="w-full h-fit flex flex-row">
                                    <div class="w-[67%] text-sm text-[#898383] font-bold">Estimated Arrival Time</div>
                                    <div class="w-[33%] text-sm text-[#3E6E7A] font-bold">11 - 20 September 2024</div>
                                </div>
                            </div>
                            {{-- Button Pay --}}
                            <button
                                class="w-fit bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white text-lg font-semibold rounded-2xl py-2 px-16 ml-auto mt-6"
                                data-modal-hide="detail-shipment-modal" data-modal-target="choose-payment-modal"
                                data-modal-toggle="choose-payment-modal">Pay</button>
                        </div>
                        {{-- end of modal content --}}
                    </div>
                </div>
                <!-- end of modal content -->
            </div>
        </div>
        {{-- detail shipment modal --}}

        {{-- review_modal --}}
        <div id="review-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-fit max-w-5xl max-h-full mt-20">
                <!-- Modal content -->
                <div class="bg-white w-[30vw] h-auto rounded-[30px] shadow">
                    <div class="relative w-full h-full flex flex-row">
                        <!-- x button (exit modal) -->
                        <button type="button"
                            class="absolute bg-black w-6 h-6 flex flex-col align-middle text-center items-center rounded-full pb-3 -top-1 -right-1"
                            data-modal-hide="review-modal">
                            <p class="m-auto text-white text-md">X</p>
                        </button>

                        {{-- modal content --}}
                        <div class="w-full h-full flex flex-col px-10 pt-10 pb-5">
                            <h1 class="text-black font-bold text-sm">Rating</h1>
                            <form action="" class="w-full h-full flex flex-col">

                                <div class="flex flex-row gap-x-4 my-6" id="starContainer">
                                    <img src="{{ asset('img/assets/icon/icon_review_star.svg') }}" alt=""
                                        class="w-[29px] h-7 reviewStar grayscale">
                                    <img src="{{ asset('img/assets/icon/icon_review_star.svg') }}" alt=""
                                        class="w-[29px] h-7 reviewStar grayscale">
                                    <img src="{{ asset('img/assets/icon/icon_review_star.svg') }}" alt=""
                                        class="w-[29px] h-7 reviewStar grayscale">
                                    <img src="{{ asset('img/assets/icon/icon_review_star.svg') }}" alt=""
                                        class="w-[29px] h-7 reviewStar grayscale">
                                    <img src="{{ asset('img/assets/icon/icon_review_star.svg') }}" alt=""
                                        class="w-[29px] h-7 reviewStar grayscale">
                                </div>

                                <textarea name="" id="" cols="30" rows="5"
                                    class="rounded-2xl bg-gray-200 resize-none border-none text-sm font-semibold focus:border-0 focus:ring-0 placeholder:text-black placeholder:font-semibold placeholder:text-sm"
                                    placeholder="Add Comment..."></textarea>

                                <div class="relative w-full h-56 bg-gray-200 rounded-2xl mt-6" id="add-carousel-upload">
                                    <!-- Hidden file input -->
                                    <input id="add-review-media" name="media" type="file" accept="image/*"
                                        class="hidden">
                                    <!-- Label that acts as the clickable area -->
                                    <label for="add-review-media"
                                        class="absolute inset-0 flex justify-center items-center cursor-pointer">
                                        <div class="text-gray-500">Upload file</div>
                                    </label>
                                    <!-- Upload icon in the bottom-right corner -->
                                    <label for="add-review-media"
                                        class="absolute bottom-3 right-3 bg-white p-2 rounded-lg cursor-pointer">
                                        <img src="{{ asset('img/assets/icon/icon_admin_category_upload.svg') }}"
                                            alt="Upload Icon" class="h-6 w-6">
                                    </label>
                                </div>
                                {{-- Button Pay --}}
                                <button
                                    class="w-fit bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white text-lg font-semibold rounded-2xl py-2 px-16 ml-auto mt-6"
                                    data-modal-target="success-review-modal" data-modal-toggle="success-review-modal"
                                    data-modal-hide="review-modal">Save</button>
                            </form>
                        </div>
                        {{-- end of modal content --}}
                    </div>
                </div>
                <!-- end of modal content -->
            </div>
        </div>
        {{-- end of  review_modal --}}

        {{-- success review modal --}}
        <div id="success-review-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-fit max-w-5xl max-h-full mt-20">
                <!-- Modal content -->
                <div class="bg-white w-[28vw] h-auto rounded-[30px] shadow">
                    <div class="relative w-full h-full flex flex-row">
                        <div class="w-full h-full flex flex-col p-14">
                            <h1 class="text-black text-xl font-medium mx-auto">Your Review Has Been Added!</h1>
                            <img src="{{ asset('img/assets/icon/icon_green_check.svg') }}" alt="green_check"
                                class="w-24 h-24 mx-auto mt-6">
                        </div>
                        {{-- end of modal content --}}
                    </div>
                </div>
                <!-- end of modal content -->
            </div>
        </div>
        {{-- end of success review modal --}}

        {{-- choose payment modal --}}
        <div id="choose-payment-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-fit max-w-5xl max-h-full mt-20">
                <!-- Modal content -->
                <div class="bg-white w-[25vw] h-auto rounded-[30px] shadow">
                    <div class="relative w-full h-full flex flex-row">
                        <!-- x button (exit modal) -->
                        {{-- <button type="button"
                        class="absolute bg-black w-5 h-5 flex flex-col align-middle text-center items-center rounded-full pb-3 -top-2 -right-2"
                        data-modal-hide="change-address-modal">
                        <p class="m-auto text-white text-sm">X</p>
                    </button> --}}

                        {{-- modal content --}}
                        <div class="w-full h-full flex flex-col px-10 py-10">
                            <form action="" class="w-full h-full flex flex-col">
                                {{-- Bank --}}
                                <h1 class="text-[#898383] text-opacity-60 font-bold text-xl">Bank</h1>
                                {{-- Option Bank BRI --}}
                                <div class="w-full h-fit flex flex-row mt-2">
                                    <img src="{{ asset('img/assets/icon/icon_checkout_bri.svg') }}" alt=""
                                        class="w-24 h-10 object-contain">
                                    <label for="BRI" class="my-auto text-black font-bold text-base ml-8">Bank
                                        BRI</label>
                                    <input type="radio" name="choose-payment" id="BRI"
                                        class="ml-auto my-auto w-7 h-7 border-4 border-[#3E6E7A] checked:bg-[#3E6E7A] checked:ring-[#3E6E7A]">
                                </div>
                                {{-- Option Bank BRI --}}
                                <div class="w-full h-fit flex flex-row mt-4">
                                    <img src="{{ asset('img/assets/icon/logo_checkout_mandiri.png') }}" alt=""
                                        class="w-28 h-12 object-contain">
                                    <label for="BRI"
                                        class="my-auto text-black font-bold text-base ml-4">Mandiri</label>
                                    <input type="radio" name="choose-payment" id="Mandiri"
                                        class="ml-auto my-auto w-7 h-7 border-4 border-[#3E6E7A] checked:bg-[#3E6E7A] checked:ring-[#3E6E7A]">
                                </div>
                                {{-- Option Bank BRI --}}
                                <div class="w-full h-fit flex flex-row mt-4">
                                    <img src="{{ asset('img/assets/icon/icon_checkout_bca.svg') }}" alt=""
                                        class="w-28 h-12 object-contain">
                                    <label for="BRI" class="my-auto text-black font-bold text-base ml-4">BCA</label>
                                    <input type="radio" name="choose-payment" id="BCA"
                                        class="ml-auto my-auto w-7 h-7 border-4 border-[#3E6E7A] checked:bg-[#3E6E7A] checked:ring-[#3E6E7A]">
                                </div>

                                {{-- E-wallet --}}
                                <h1 class="text-[#898383] text-opacity-60 font-bold text-xl mt-6">E-wallet</h1>
                                {{-- Option Bank BRI --}}
                                <div class="w-full h-fit flex flex-row mt-2">
                                    <img src="{{ asset('img/assets/icon/icon_checkout_dana.svg') }}" alt=""
                                        class="w-28 h-12 object-contain">
                                    <label for="BRI" class="my-auto text-black font-bold text-base ml-4">DANA</label>
                                    <input type="radio" name="choose-payment" id="DANA"
                                        class="ml-auto my-auto w-7 h-7 border-4 border-[#3E6E7A] checked:bg-[#3E6E7A] checked:ring-[#3E6E7A]">
                                </div>
                                {{-- Option Bank BRI --}}
                                <div class="w-full h-fit flex flex-row mt-4">
                                    <img src="{{ asset('img/assets/icon/icon_checkout_ovo.svg') }}" alt=""
                                        class="w-28 h-12 object-contain">
                                    <label for="BRI" class="my-auto text-black font-bold text-base ml-4">OVO</label>
                                    <input type="radio" name="choose-payment" id="OVO"
                                        class="ml-auto my-auto w-7 h-7 border-4 border-[#3E6E7A] checked:bg-[#3E6E7A] checked:ring-[#3E6E7A]">
                                </div>
                                {{-- Option Bank BRI --}}
                                <div class="w-full h-fit flex flex-row mt-4">
                                    <img src="{{ asset('img/assets/icon/icon_checkout_gopay.png') }}" alt=""
                                        class="w-28 h-12 object-contain">
                                    <label for="BRI" class="my-auto text-black font-bold text-base ml-4">Go
                                        Pay</label>
                                    <input type="radio" name="choose-payment" id="gopay"
                                        class="ml-auto my-auto w-7 h-7 border-4 border-[#3E6E7A] checked:bg-[#3E6E7A] checked:ring-[#3E6E7A]">
                                </div>


                                <button
                                    class="w-fit bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white text-2xl font-semibold rounded-2xl py-2 px-16 mx-auto mt-10"
                                    data-modal-target="payment-modal" data-modal-toggle="payment-modal">Pay</button>
                            </form>
                        </div>
                        {{-- end of modal content --}}
                    </div>
                </div>
                <!-- end of modal content -->
            </div>
        </div>
        {{-- end of choose payment modal --}}


        {{-- payment modal --}}
        <div id="payment-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto no-scrollbar overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-fit max-w-6xl max-h-full mt-20">
                <!-- Modal content -->
                <div class="bg-white w-[50vw] h-auto rounded-[30px] shadow">
                    <div class="relative w-full h-full flex flex-row">
                        <!-- x button (exit modal) -->
                        <button type="button"
                            class="absolute bg-black w-6 h-6 flex flex-col align-middle text-center items-center rounded-full pb-3 -top-1 -right-1"
                            data-modal-hide="payment-modal">
                            <p class="m-auto text-white text-base">X</p>
                        </button>

                        {{-- modal content --}}
                        <div class="w-full h-full flex flex-col px-14 pt-10 pb-2">
                            <h1 class="text-black font-bold text-2xl">Payment</h1>
                            <div class="w-full h-fit flex flex-row mt-3">
                                <div class="w-[70%]">
                                    <p class="text-[#898383] text-sm font-bold mr-auto mb-auto">Total Payment</p>
                                </div>
                                <div class="w-[30%]">
                                    {{-- total payment price --}}
                                    <p class="text-[#3E6E7A] text-sm font-bold mr-auto">Rp 25.800.000,-</p>
                                </div>
                            </div>
                            <div class="w-full h-fit flex flex-row mt-4">
                                <div class="w-[70%]">
                                    <p class="text-[#898383] text-sm font-bold mr-auto mb-auto">Pay In</p>
                                </div>
                                {{-- pay in (time duration to pay) --}}
                                <div class="w-[30%] h-fit flex flex-col">
                                    <p class="text-[#3E6E7A] text-sm font-bold">24 Hours</p>
                                    {{-- pay time deadline --}}
                                    <p class="text-[#B7B7B7] text-sm font-medium">Pay Before: <br>
                                        14 September 2024 00:00</p>
                                </div>
                            </div>
                            <div class="w-full h-fit flex flex-row">
                                {{-- bank logo container --}}
                                <div class="w-[10%] flex">
                                    <img src="{{ asset('img/assets/icon/logo_bri_small.svg') }}" alt=""
                                        class="w-3/5 object-contain mb-auto">
                                </div>
                                {{-- no rekening and else container --}}
                                <div class="w-[90%] flex flex-col">
                                    <p class="text-[#898383] font-bold text-sm">Bank BRI</p>
                                    <p class="text-[#898383] font-bold text-sm mt-6">No. Rekening:</p>
                                    <div class="w-full h-fit flex flex-row items-center mt-1">
                                        <div class="w-[67%]">
                                            {{-- NO REKENING --}}
                                            <h1 class="text-[#3E6E7A] font-bold text-2xl">128 0812 1555 9315</h1>
                                        </div>
                                        <div class="w-[33%]">
                                            {{-- copy text --}}
                                            <p class="text-orange-400 font-bold text-sm cursor-pointer">COPY</p>
                                        </div>
                                    </div>
                                    <p class="text-[#898383] font-bold text-sm mt-6">
                                        Proses verifikasi kurang dari 10 menit setelah pembayaran berhasil <br>
                                        Bayar pesanan ke Virtual Account di atas sebelum membuat pesanan <br>
                                        kembali dengan Virtual Account agar nomor tetap sama.
                                    </p>
                                    <p class="text-[#898383] font-bold text-sm mt-6">
                                        Hanya menerima dari Bank BRI
                                    </p>
                                </div>
                            </div>

                            {{-- title instructions --}}
                            <h2 class="text-black font-bold text-base mt-6">mBanking Transfer Instructions</h2>
                            {{-- instructions --}}
                            <p class="text-[#898383] font-bold text-sm mt-6">
                                1. Masuk ke menu Mobile Banking BRI. Kemudian, pilih Pembayaran > BRIVA. <br>
                                2. Masukkan Nomor BRIVA 128 081215559315. <br>
                                3. Masukkan PIN Anda kemudian pilih Send. Apabila pesan konfirmasi untuk <br>
                                4. transaksi menggunakan SMS muncul, pilih OK. Status transaksi akan <br>
                                5. dikirimkan melalui SMS dan dapat digunakan sebagai bukti pembayaran.
                            </p>

                            {{-- title atm instructions --}}
                            <h2 class="text-black font-bold text-base mt-4">ATM Transfer Instructions</h2>
                            <p class="text-[#898383] font-bold text-sm mt-6">
                                1. Pilih Transaksi Lain > Pembayaran > Lainnya > BRIVA. <br>
                                2. Masukkan Nomor BRIVA 128 081215559315 kemudian pilih Benar. <br>
                                3. Periksa informasi yang tertera di layar. Pastikan Merchant adalah *nama*, <br>
                                4. Total tagihan sudah benar dan username kamu azkialbab. Jika benar, pilih Ya.
                            </p>
                            <button
                                class="w-fit bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white text-sm font-semibold rounded-2xl py-1 px-10 mx-auto mt-4"
                                data-modal-hide="payment-modal" data-modal-target="choose-payment-modal"
                                data-modal-toggle="choose-payment-modal">Change</button>
                        </div>
                        {{-- end of modal content --}}
                    </div>
                </div>
                <!-- end of modal content -->
            </div>
        </div>
        {{-- end of payment modal --}}

        {{-- QR payment modal --}}
        <div id="qr-payment-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto no-scrollbar overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-fit max-w-6xl max-h-full mt-20">
                <!-- Modal content -->
                <div class="bg-white w-[50vw] h-auto rounded-[30px] shadow">
                    <div class="relative w-full h-full flex flex-row">
                        <!-- x button (exit modal) -->
                        <button type="button"
                            class="absolute bg-black w-6 h-6 flex flex-col align-middle text-center items-center rounded-full pb-3 -top-1 -right-1"
                            onclick="qrPaymentModal.hide()">
                            <p class="m-auto text-white text-base">X</p>
                        </button>

                        {{-- modal content --}}
                        <div class="w-full h-full flex flex-col px-14 pt-10 pb-2">
                            <h1 class="text-black font-bold text-2xl">Payment</h1>
                            <div class="w-full h-fit flex flex-row mt-3">
                                <div class="w-[70%]">
                                    <p class="text-[#898383] text-sm font-bold mr-auto mb-auto">Total Payment</p>
                                </div>
                                <div class="w-[30%]">
                                    {{-- total payment price --}}
                                    <p class="text-[#3E6E7A] text-sm font-bold mr-auto">Rp 25.800.000,-</p>
                                </div>
                            </div>
                            <div class="w-full h-fit flex flex-row mt-4">
                                <div class="w-[70%]">
                                    <p class="text-[#898383] text-sm font-bold mr-auto mb-auto">Pay In</p>
                                </div>
                                {{-- pay in (time duration to pay) --}}
                                <div class="w-[30%] h-fit flex flex-col">
                                    <p class="text-[#3E6E7A] text-sm font-bold">24 Hours</p>
                                    {{-- pay time deadline --}}
                                    <p class="text-[#B7B7B7] text-sm font-medium">Pay Before: <br>
                                        14 September 2024 00:00</p>
                                </div>
                            </div>

                            <img src="{{ asset('img/example/example_qrscan.svg') }}" alt="" id="qris-image"
                                class="mx-auto w-52 object-contain">

                            {{-- title instructions --}}
                            <h2 class="text-black font-bold text-base mt-6">mBanking Transfer Instructions</h2>
                            {{-- instructions --}}
                            <p class="text-[#898383] font-bold text-sm mt-6">
                                1. Masuk ke menu Mobile Banking BRI. Kemudian, pilih Pembayaran > BRIVA. <br>
                                2. Masukkan Nomor BRIVA 128 081215559315. <br>
                                3. Masukkan PIN Anda kemudian pilih Send. Apabila pesan konfirmasi untuk <br>
                                4. transaksi menggunakan SMS muncul, pilih OK. Status transaksi akan <br>
                                5. dikirimkan melalui SMS dan dapat digunakan sebagai bukti pembayaran.
                            </p>

                            {{-- title atm instructions --}}
                            <h2 class="text-black font-bold text-base mt-4">ATM Transfer Instructions</h2>
                            <p class="text-[#898383] font-bold text-sm mt-6">
                                1. Pilih Transaksi Lain > Pembayaran > Lainnya > BRIVA. <br>
                                2. Masukkan Nomor BRIVA 128 081215559315 kemudian pilih Benar. <br>
                                3. Periksa informasi yang tertera di layar. Pastikan Merchant adalah *nama*, <br>
                                4. Total tagihan sudah benar dan username kamu azkialbab. Jika benar, pilih Ya.
                            </p>
                            {{-- <button
                                class="w-fit bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white text-sm font-semibold rounded-2xl py-1 px-10 mx-auto mt-4"
                                data-modal-hide="qr-payment-modal" data-modal-target="choose-payment-modal"
                                data-modal-toggle="choose-payment-modal">Change</button> --}}
                        </div>
                        {{-- end of modal content --}}
                    </div>
                </div>
                <!-- end of modal content -->
            </div>
        </div>
        {{-- end of QR payment modal --}}


        {{-- success payment modal --}}
        <div id="payment-success-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-fit max-w-5xl max-h-full mt-20">
                <!-- Modal content -->
                <div class="bg-white w-[28vw] h-auto rounded-[30px] shadow">
                    <div class="relative w-full h-full flex flex-row">
                        <div class="w-full h-full flex flex-col p-14">
                            <h1 class="text-black text-xl font-bold mx-auto">Payment Successful!</h1>
                            <img src="{{ asset('img/assets/icon/icon_green_check.svg') }}" alt="green_check"
                                class="w-24 h-24 mx-auto mt-6">
                        </div>
                        {{-- end of modal content --}}
                    </div>
                </div>
                <!-- end of modal content -->
            </div>
        </div>
        {{-- end of success payment modal --}}

        {{-- end of MODALS FOR TRANSACTION HISTORY --}}

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const stars = document.querySelectorAll("#starContainer .reviewStar");

            stars.forEach((star, index) => {
                star.addEventListener("click", function() {
                    stars.forEach(s => s.classList.add("grayscale"));

                    for (let i = 0; i <= index; i++) {
                        stars[i].classList.remove("grayscale");
                    }
                })
            })
        })

        $(document).ready(function() {
            $('#default-styled-tab > li').click(function() {
                const tab = $(this).find('button').attr('aria-controls');
                window.history.pushState(null, null, `?tab=${tab}`);
            });
        })
    </script>
@endsection

@push('script')
    <script>
        let qrPaymentModal, vaPaymentModal, paymentSuccessModal, checkPaymentInterval;
        const paymentModalOptions = {
            onHide: () => {
                clearInterval(checkPaymentInterval);
            },
        }
        $(document).ready(function() {
            qrPaymentModal = new Modal(document.getElementById('qr-payment-modal'), paymentModalOptions)
            vaPaymentModal = new Modal(document.getElementById('payment-modal'), paymentModalOptions)
            paymentSuccessModal = new Modal(document.getElementById('payment-success-modal'))
        })

        function onPaymentSuccess(orderId) {
            qrPaymentModal.hide();
            paymentSuccessModal.show();
            setTimeout(() => {
                window.location.href = "{{ route('order.show', ':id') }}".replace(':id', orderId);
            }, 1000);
        }

        function checkPaymentStatus(paymentId) {
            checkPaymentInterval = setInterval(() => {
                const url =
                    `{{ route('order.payment-status') }}?paymentId=${paymentId}`;
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(response) {
                        if (response.status == 'success' &&
                            response.payment.status == 'success') {
                            clearInterval(checkPaymentInterval);
                            onPaymentSuccess(response.payment.order_id);
                        }
                    }
                });
            }, 5000);
        }

        function pay(ev, orderPayment) {
            ev.preventDefault()
            if (orderPayment.payment_method == 'qris') {
                $('#qris-image').attr('src', orderPayment.payment_code)
                qrPaymentModal.show()
                checkPaymentStatus(orderPayment.id)
            } else {
                vaPaymentModal.show()
            }
        }
    </script>
@endpush
