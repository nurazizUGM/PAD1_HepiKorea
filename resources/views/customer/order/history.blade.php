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
                        aria-selected="{{ $tab == 'finish' ? 'true' : 'false' }}">Finish</button>
                </li>
            </ul>
        </div>

        {{-- TAB CONTENT --}}
        <div id="default-styled-tab-content">
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
                                $image = $item->product->images->first()->path;
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
                                $image = $item->product->images->first()->path;
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
                                                @if ($order->status == 'processing')
                                                    The order is on its way to Indonesia
                                                @elseif($order->status == 'paid')
                                                    The order is currently awaiting administrator confirmation
                                                @endif
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
                    @foreach ($sent as $order)
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
                                $image = $item->product->images->first()->path;
                                $count = $order->orderItems->count();
                            }

                            $totalPrice = number_format($totalPrice, 0, ',', '.');
                            $shipmentPayment = $order->orderPayment
                                ->where('payment_type', 'shipment')
                                ->where('expired_at', '>', now());
                        @endphp
                        {{-- sent product --}}
                        <div class="w-full h-full bg-white rounded-2xl flex flex-row py-8 px-8">
                            <div class="w-[20%]">
                                {{-- sent product image --}}
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
                                        {{-- sent product name --}}
                                        <h1 class="text-black font-semibold text-xl">{{ $productName }}</h1>
                                        {{-- sent product variant --}}
                                        @if ($count > 1)
                                            <p class="text-black text-opacity-50 font-semibold text-xl">
                                                and {{ $count - 1 }} other items
                                            </p>
                                        @endif
                                    </div>
                                    <div class="w-[22%] ms-auto h-full flex">
                                        <p class="text-[#3E6E7A] text-xl font-semibold ml-auto">
                                            Rp {{ $totalPrice }},-
                                        </p>
                                    </div>
                                </div>
                                <div class="w-full h-1/2 flex flex-row">
                                    <div class="w-[52%]">
                                        <div
                                            class="w-full h-full flex bg-[#3E6E7A] text-white font-semibold text-base rounded-2xl shadow-md py-4 px-6">
                                            {{-- text payment reminder --}}
                                            <p class="my-auto">
                                                @if ($order->status == 'shipment_unpaid')
                                                    Waiting for payment of the shipment
                                                @elseif($order->status == 'shipment_paid')
                                                    Waiting for the shipment to be sent
                                                @elseif ($order->status == 'sent')
                                                    The order is on its way to Destination Address
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    @if ($order->status == 'shipment_unpaid' && $shipmentPayment->count() == 0)
                                        @php
                                            $shipmentService = $order->orderShipment->shipment_service;
                                            $shipmentPrice = $order->orderShipment->price;
                                            $shipmentCode = $order->orderShipment->shipment_code;
                                            $shipmentArrivalEstimation = $order->orderShipment->arrival_estimation;
                                        @endphp
                                        <div class="w-[48%] ms-auto flex flex-row justify-end items-center">
                                            <button
                                                class="w-1/2 h-fit rounded-2xl bg-white border-2 border-[#3E6E7A] text-xl text-[#3E6E7A] py-3"
                                                data-order-id="{{ $order->id }}"
                                                data-shipment-service="{{ $shipmentService }}"
                                                data-shipment-price="{{ $shipmentPrice }}"
                                                data-shipment-arrival-estimation="{{ $shipmentArrivalEstimation }}"
                                                onclick="shipmentDetail(this)">
                                                Shipment Detail
                                            </button>
                                        </div>
                                    @elseif($order->status == 'shipment_unpaid' && $shipmentPayment->count() > 0)
                                        <div class="w-[48%] ms-auto flex flex-row justify-end items-center">
                                            <button
                                                class="w-1/2 h-fit rounded-2xl bg-white border-2 border-[#3E6E7A] text-xl text-[#3E6E7A] py-3"
                                                data-payment='@json($shipmentPayment->first())'
                                                onclick="pay(event, $(this).data('payment'))">
                                                Pay Shipment
                                            </button>
                                        </div>
                                    @elseif ($order->status == 'sent')
                                        <div class="w-[48%] ms-auto flex flex-row justify-end items-center">
                                            <button
                                                class="w-1/2 h-fit rounded-2xl bg-white border-2 border-[#3E6E7A] text-xl text-[#3E6E7A] py-3"
                                                onclick="window.location.href='{{ route('order.arrived', $order->id) }}'">
                                                Confirm Arrival
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        {{-- end of sent product --}}
                    @endforeach
                </div>
            </div>
            {{-- end of SENT CONTENT --}}

            {{--  --}}

            {{-- FINISH CONTENT --}}
            <div class="hidden p-4 rounded-lg" id="finish-content" role="tabpanel" aria-labelledby="finish-tab">
                {{-- list of finish order container --}}
                <div class="w-full h-full flex flex-col gap-y-6">

                    @foreach ($finished as $order)
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
                                $image = $item->product->images->first()->path;
                                $count = $order->orderItems->count();
                            }

                            $totalPrice = number_format($totalPrice, 0, ',', '.');
                        @endphp
                        {{-- finish product --}}
                        <div class="w-full h-full bg-white rounded-2xl flex flex-row py-8 px-8">
                            <div class="w-[20%]">
                                {{-- finish product image --}}
                                @if ($image && Storage::exists($image))
                                    <img src="{{ Storage::url($image) }}" alt="finish_image_product"
                                        class="h-48 object-contain mx-auto">
                                @else
                                    <img src="{{ asset('img/example/example_phone.png') }}" alt="finish_image_product"
                                        class="h-48 object-contain mx-auto">
                                @endif
                            </div>
                            <div class="w-[80%] flex flex-col">
                                <div class="w-full h-1/2 flex flex-row">
                                    <div class="w-[33%] h-full flex flex-col">
                                        {{-- sent product name --}}
                                        <h1 class="text-black font-semibold text-xl">{{ $productName }}</h1>
                                        {{-- sent product variant --}}
                                        @if ($count > 1)
                                            <p class="text-black text-opacity-50 font-semibold text-xl">
                                                and {{ $count - 1 }} other items
                                            </p>
                                        @endif
                                    </div>
                                    <div class="w-[22%] ms-auto h-full flex">
                                        <p class="text-[#3E6E7A] text-xl font-semibold ml-auto">
                                            Rp {{ $totalPrice }},-
                                        </p>
                                    </div>
                                </div>
                                @if ($order->reviews->count() == 0)
                                    <div class="w-full h-1/2 flex flex-row">
                                        <div class="w-full flex flex-row justify-end items-center">
                                            <button
                                                class="w-[20%] h-fit rounded-2xl bg-white border-2 border-[#3E6E7A] text-xl text-[#3E6E7A] py-3"
                                                onclick="review({{ $order->id }})">
                                                Review
                                            </button>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        {{-- end of finish product --}}
                    @endforeach

                </div>
            </div>
            {{-- FINISH CONTENT --}}
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
                                {{-- expedition name --}}
                                <div class="w-full h-fit flex flex-row">
                                    <div class="w-[67%] text-sm text-[#898383] font-bold">Expedition Name</div>
                                    <div class="w-[33%] text-sm text-[#3E6E7A] font-bold" id="shipment-service"></div>
                                </div>
                                {{-- total expedition payment --}}
                                <div class="w-full h-fit flex flex-row">
                                    <div class="w-[67%] text-sm text-[#898383] font-bold">Total Expedition Payment</div>
                                    <div class="w-[33%] text-sm text-[#3E6E7A] font-bold" id="shipment-price">Rp 0,-</div>
                                </div>
                                {{-- estimated arrival time --}}
                                <div class="w-full h-fit flex flex-row">
                                    <div class="w-[67%] text-sm text-[#898383] font-bold">Estimated Arrival Time</div>
                                    <div class="w-[33%] text-sm text-[#3E6E7A] font-bold"
                                        id="shipment-arrival-estimation"></div>
                                </div>
                            </div>
                            {{-- Button Pay --}}
                            <button
                                class="w-fit bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white text-lg font-semibold rounded-2xl py-2 px-16 ml-auto mt-6"
                                onclick="payShipment(orderId)">Pay</button>
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
                            onclick="reviewModal.hide()">
                            <p class="m-auto text-white text-md">X</p>
                        </button>

                        {{-- modal content --}}
                        <div class="w-full h-full flex flex-col px-10 pt-10 pb-5">
                            <h1 class="text-black font-bold text-sm">Rating</h1>
                            <form action="{{ route('order.review') }}" method="POST" enctype="multipart/form-data"
                                class="w-full h-full flex flex-col">
                                @csrf

                                <input type="hidden" name="orderId">
                                <input type="hidden" name="rating" value="0">

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

                                <textarea name="content" id="review-content" cols="30" rows="5"
                                    class="rounded-2xl bg-gray-200 resize-none border-none text-sm font-semibold focus:border-0 focus:ring-0 placeholder:text-black placeholder:font-semibold placeholder:text-sm"
                                    placeholder="Add Comment..."></textarea>

                                <div class="relative w-full h-56 bg-gray-200 rounded-2xl mt-6 bg-cover bg-center"
                                    id="review-photo">
                                    <!-- Hidden file input -->
                                    <input id="add-review-media" name="photo" type="file" accept="image/*"
                                        onchange="changeReviewPhoto(this)" class="hidden">
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
                                <button type="submit"
                                    class="w-fit bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white text-lg font-semibold rounded-2xl py-2 px-16 ml-auto mt-6">Save</button>
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
                        <button type="button"
                            class="absolute bg-black w-5 h-5 flex flex-col align-middle text-center items-center rounded-full pb-3 -top-2 -right-2"
                            onclick="choosePaymentModal.hide()">
                            <p class="m-auto text-white text-sm">X</p>
                        </button>

                        {{-- modal content --}}
                        <div class="w-full h-full flex flex-col px-10 py-10">
                            {{-- Bank --}}
                            <h1 class="text-[#898383] text-opacity-60 font-bold text-xl">Bank</h1>
                            {{-- Option Bank BRI --}}
                            <div class="w-full h-fit flex flex-row mt-2">
                                <img src="{{ asset('img/assets/icon/icon_checkout_bri.svg') }}" alt=""
                                    class="w-24 h-10 object-contain">
                                <label for="bri" class="my-auto text-black font-bold text-base ml-8">Bank
                                    BRI</label>
                                <input type="radio" name="choose-payment" id="bri" value="bri"
                                    class="ml-auto my-auto w-7 h-7 border-4 border-[#3E6E7A] checked:bg-[#3E6E7A] checked:ring-[#3E6E7A]">
                            </div>
                            {{-- Option Bank BRI --}}
                            <div class="w-full h-fit flex flex-row mt-4">
                                <img src="{{ asset('img/assets/icon/logo_checkout_mandiri.png') }}" alt=""
                                    class="w-28 h-12 object-contain">
                                <label for="mandiri" class="my-auto text-black font-bold text-base ml-4">Mandiri</label>
                                <input type="radio" name="choose-payment" id="mandiri" value="mandiri"
                                    class="ml-auto my-auto w-7 h-7 border-4 border-[#3E6E7A] checked:bg-[#3E6E7A] checked:ring-[#3E6E7A]">
                            </div>
                            {{-- Option Bank BRI --}}
                            <div class="w-full h-fit flex flex-row mt-4">
                                <img src="{{ asset('img/assets/icon/icon_checkout_bca.svg') }}" alt=""
                                    class="w-28 h-12 object-contain">
                                <label for="bca" class="my-auto text-black font-bold text-base ml-4">BCA</label>
                                <input type="radio" name="choose-payment" id="bca" value="bca"
                                    class="ml-auto my-auto w-7 h-7 border-4 border-[#3E6E7A] checked:bg-[#3E6E7A] checked:ring-[#3E6E7A]">
                            </div>

                            {{-- E-wallet --}}
                            <h1 class="text-[#898383] text-opacity-60 font-bold text-xl mt-6">E-wallet</h1>
                            {{-- Option Bank BRI --}}
                            <div class="w-full h-fit flex flex-row mt-4">
                                <img src="{{ asset('img/assets/icon/icon_checkout_gopay.png') }}" alt=""
                                    class="w-28 h-12 object-contain">
                                <label for="qris" class="my-auto text-black font-bold text-base ml-4">QRIS</label>
                                <input type="radio" name="choose-payment" id="qris" value="qris"
                                    class="ml-auto my-auto w-7 h-7 border-4 border-[#3E6E7A] checked:bg-[#3E6E7A] checked:ring-[#3E6E7A]">
                            </div>


                            <button
                                class="w-fit bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white text-2xl font-semibold rounded-2xl py-2 px-16 mx-auto mt-10"
                                onclick="payShipment(orderId, true)">Pay</button>
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
                            onclick="vaPaymentModal.hide()">
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
                                    <p class="text-[#3E6E7A] text-sm font-bold mr-auto" id="va-payment-amout">
                                        Rp 0,-
                                    </p>
                                </div>
                            </div>
                            <div class="w-full h-fit flex flex-row mt-4">
                                <div class="w-[70%]">
                                    <p class="text-[#898383] text-sm font-bold mr-auto mb-auto">Pay In</p>
                                </div>
                                {{-- pay in (time duration to pay) --}}
                                <div class="w-[30%] h-fit flex flex-col">
                                    <p class="text-[#3E6E7A] text-sm font-bold" id="va-expiration-time-remaining"></p>
                                    {{-- pay time deadline --}}
                                    <p class="text-[#B7B7B7] text-sm font-medium">Pay Before: <br>
                                        <span id="va-payment-expiration">00:00</span>
                                    </p>
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
                                    <p class="text-[#898383] font-bold text-sm" id="va-payment-method">Bank BRI</p>
                                    <p class="text-[#898383] font-bold text-sm mt-6">No. Virtual Account:</p>
                                    <div class="w-full h-fit flex flex-row items-center mt-1">
                                        <div class="w-[67%]">
                                            {{-- NO REKENING --}}
                                            <h1 class="text-[#3E6E7A] font-bold text-2xl" id="va-payment-code"> - </h1>
                                        </div>
                                        <div class="w-[33%]">
                                            {{-- copy text --}}
                                            <p class="text-orange-400 font-bold text-sm cursor-pointer"
                                                onclick="navigator.clipboard.writeText($('#va-payment-code').text().trim())">
                                                COPY
                                            </p>
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
                            {{-- <button
                                class="w-fit bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white text-sm font-semibold rounded-2xl py-1 px-10 mx-auto mt-4"
                                data-modal-hide="payment-modal" data-modal-target="choose-payment-modal"
                                data-modal-toggle="choose-payment-modal">Change</button> --}}
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
                            data-modal-hide="qr-payment-modal">
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
                                    <p id="qr-payment-amount" class="text-[#3E6E7A] text-sm font-bold mr-auto">Rp 0,-
                                    </p>
                                </div>
                            </div>
                            <div class="w-full h-fit flex flex-row mt-4">
                                <div class="w-[70%]">
                                    <p class="text-[#898383] text-sm font-bold mr-auto mb-auto">Pay In</p>
                                </div>
                                {{-- pay in (time duration to pay) --}}
                                <div class="w-[30%] h-fit flex flex-col">
                                    <p id="expiration-time-remaining" class="text-[#3E6E7A] text-sm font-bold">15 Minutes
                                    </p>
                                    {{-- pay time deadline --}}
                                    <p class="text-[#B7B7B7] text-sm font-medium">Pay Before: <br>
                                        <span id="expiration-time">00:00</span>
                                    </p>
                                </div>
                            </div>

                            <img id="payment-qr" src="" alt="" loading="lazy"
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
                            onclick="qrPaymentModal.hide()">Change</button> --}}
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
@endsection

@push('script')
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

        // switch tab url
        $(document).ready(function() {
            $('#default-styled-tab > li').click(function() {
                const tab = $(this).find('button').attr('aria-controls');
                window.history.pushState(null, null, `?tab=${tab}`);
            });
        })

        let choosePaymentModal, qrPaymentModal, vaPaymentModal, paymentSuccessModal, checkPaymentInterval,
            orderId, shipmentDetailModal, reviewModal;

        const paymentModalOptions = {
            onHide: () => {
                clearInterval(checkPaymentInterval);
            },
        }

        $(document).ready(function() {
            qrPaymentModal = new Modal(document.getElementById('qr-payment-modal'), paymentModalOptions)
            vaPaymentModal = new Modal(document.getElementById('payment-modal'), paymentModalOptions)
            paymentSuccessModal = new Modal(document.getElementById('payment-success-modal'))
            choosePaymentModal = new Modal(document.getElementById('choose-payment-modal'))
            shipmentDetailModal = new Modal(document.getElementById('detail-shipment-modal'))
            reviewModal = new Modal(document.getElementById('review-modal'))

            $('#starContainer > img').click(function() {
                // remove grayscale from before element
                $(this).prevAll().removeClass('grayscale');
                // add grayscale to next element
                $(this).nextAll().addClass('grayscale');
                // set data-rating value
                $('#review-modal input[name=rating]').val($(this).index() + 1);
            })
        })

        function onPaymentSuccess(orderId) {
            qrPaymentModal.hide();
            vaPaymentModal.hide();
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

        function pay(ev, payment) {
            const expirationTime = moment(payment.expired_at).format('DD MMMM YYYY HH:mm');
            const diff = moment.duration(moment(payment.expired_at).diff(moment()));
            const hoursRemaining = Math.floor(diff.asHours());
            const minutesRemaining = Math.floor(diff.asMinutes()) - (hoursRemaining * 60);
            const timeRemaining = `${hoursRemaining} Hours ${minutesRemaining} Minutes`;
            const amount = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(payment.amount);

            ev?.preventDefault()
            if (payment.payment_method == 'qris') {
                $('#payment-qr').attr('src', payment.payment_code);
                $('#qr-payment-amount').text(`${amount},-`);
                $('#expiration-time').text(expirationTime);
                $('#expiration-time-remaining').text(timeRemaining);
                qrPaymentModal.show()
            } else {
                $('#va-payment-amout').text(`${amount},-`);
                $('#va-payment-expiration').text(expirationTime);
                $('#va-expiration-time-remaining').text(timeRemaining);
                $('#va-payment-method').text(payment.payment_method.toUpperCase());
                $('#va-payment-code').text(payment.payment_code);
                vaPaymentModal.show()
            }
            checkPaymentStatus(payment.id)
        }

        function payShipment(id, paymentSelected = false, payment = null) {
            shipmentDetailModal.hide();
            if (!paymentSelected) {
                orderId = id;
                return choosePaymentModal.show();
            }
            choosePaymentModal.hide();
            $.ajax({
                url: `{{ route('order.pay-shipment') }}`,
                method: 'POST',
                data: {
                    orderId: orderId,
                    paymentMethod: $('input[name="choose-payment"]:checked').val(),
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    if (response.status == 'success') {
                        pay(null, response.payment);
                    }
                }
            });
        }

        function shipmentDetail(el) {
            orderId = $(el).data('order-id');
            $('#shipment-service').text($(el).data('shipment-service'));
            $('#shipment-price').text(new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format($(el).data('shipment-price')));
            const arrivalTime = moment($(el).data('shipment-arrival')).format('DD MMMM YYYY');
            $('#shipment-arrival-estimation').text(arrivalTime);
            shipmentDetailModal.show();
        }

        function review(id) {
            $('#review-modal input[name="orderId"]').val(id);
            return reviewModal.show();
        }

        function changeReviewPhoto(el) {
            const previewUrl = URL.createObjectURL(el.files[0]);
            $('#review-photo').css('background-image', `url(${previewUrl})`);
        }
    </script>
@endpush
