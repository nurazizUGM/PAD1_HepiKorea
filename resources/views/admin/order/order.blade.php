<!-- order Content -->
<div class="flex flex-row">
    {{-- year and month section (filter) --}}
    <div class="w-[20%] h-[78vh] bg-white rounded-lg overflow-y-scroll no-scrollbar">
        <div id="accordion-collapse-order" data-accordion="collapse-order">
            <button type="button" onclick="window.location.href='{{ route('admin.order.index', ['tab' => 'order']) }}'"
                class="flex items-center w-full px-5 pt-5 font-medium rtl:text-right text-gray-500 border-b-0 rounded-xl focus:ring-0 focus:bg-white"
                aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" data-accordion-icon class="w-4 h-4 rotate-180 shrink-0"
                    aria-hidden="true" viewBox="0 0 16 16">
                    <path fill="#000" fill-rule="evenodd"
                        d="M2.5 5a1.25 1.25 0 1 0 0-2.5a1.25 1.25 0 0 0 0 2.5m3.25-2a.75.75 0 0 0 0 1.5h8.5a.75.75 0 0 0 0-1.5zm0 8.5a.75.75 0 0 0 0 1.5h8.5a.75.75 0 0 0 0-1.5zM5 8a.75.75 0 0 1 .75-.75h8.5a.75.75 0 0 1 0 1.5h-8.5A.75.75 0 0 1 5 8M3.75 8a1.25 1.25 0 1 1-2.5 0a1.25 1.25 0 0 1 2.5 0M2.5 13.5a1.25 1.25 0 1 0 0-2.5a1.25 1.25 0 0 0 0 2.5"
                        clip-rule="evenodd" />
                </svg>
                <span class="text-[#376F7E] font-semibold text-xl inline-block ml-3">All</span>
            </button>
            @foreach ($years as $y)
                <h2 id="accordion-collapse-heading-1-order">
                    <button type="button"
                        class="flex items-center w-full px-5 pt-5 font-medium rtl:text-right text-gray-500 border-b-0 rounded-xl focus:ring-0 focus:bg-white"
                        data-accordion-target="#accordion-year-{{ $y }}"
                        aria-expanded="{{ $y == $year ? 'true' : 'false' }}"
                        aria-controls="accordion-year-{{ $y }}">
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5 5 1 1 5" />
                        </svg>
                        <span class="text-[#376F7E] font-semibold text-xl inline-block ml-3">{{ $y }}</span>
                    </button>
                </h2>
                <div id="accordion-year-{{ $y }}" class="hidden"
                    aria-labelledby="accordion-collapse-heading-1-order">
                    <div class="px-5">
                        <ul class="ml-5 text-lg">
                            @foreach ($months[$y] as $month)
                                <li class="my-3 text-base text-black text-opacity-50 font-semibold cursor-pointer"
                                    onclick="window.location.href='{{ route('admin.order.index', ['tab' => 'order', 'year' => $y, 'month' => $month]) }}'">
                                    {{ $month }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{-- end of year and month selection (filter) --}}



    {{-- container of card order --}}
    <div class="w-[80%] h-fit ml-6 flex flex-wrap flex-row gap-4 justify-start items-start align-content-start">
        {{-- for loop hanya untuk coba --}}
        @foreach ($orders as $order)
            {{-- card order --}}
            <div class="bg-white w-[26rem] h-52 rounded-xl p-2 flex flex-row">
                {{-- image order container --}}
                <div class="w-5/12 h-full bg-cover bg-center bg-no-repeat rounded-xl"
                    style="background-image: url('{{ asset('img/example/admin_order_img_user.png') }}')">
                </div>
                {{-- detail order container --}}
                <div class="w-7/12 h-full flex flex-col px-4 pt-1">
                    {{-- Nama Customer --}}
                    <div class="flex flex-row">
                        {{-- icon customer --}}
                        <img src="{{ asset('img/assets/icon/icon_admin_order_customer.svg') }}" alt="user icon"
                            class="h-6 w-6 fill-black">
                        {{-- Customer --}}
                        <p class="text-black ml-3 font-semibold text-base">{{ $order->user->fullname }}</p>
                    </div>
                    {{-- Tanggal Order --}}
                    <div class="flex flex-row mt-2 align-bottom">
                        <img src="{{ asset('img/assets/icon/icon_admin_order_date.svg') }}" alt="user icon"
                            class="h-6 w-6">
                        <p class="text-[#376F7E] font-semibold ml-3 text-base">
                            {{ $order->created_at->format('d/m/Y') }}</p>
                    </div>
                    {{-- Price Order --}}
                    <div class="flex flex-row mt-2 ml-0.5 align-bottom">
                        <img src="{{ asset('img/assets/icon/icon_admin_order_coin.svg') }}" alt="user icon"
                            class="h-5 w-5 my-auto">
                        {{-- text price --}}
                        <p class="text-[#656565] ml-3.5 font-semibold text-md">Rp
                            {{ number_format($order->total_items_price, 0, ',', '.') }}</p>
                    </div>
                    {{-- status --}}
                    <div class="flex flex-row mt-3 -ml-1.5">
                        <p class="text-[#656565] text-opacity-50 ml-2.5 font-semibold text-sm">Status :</p>
                        <p class="text-[#656565] text-opacity-50 ml-2.5 font-semibold text-sm">
                            {{ str_replace('_', ' ', ucfirst($order->status)) }}
                        </p>
                    </div>
                    {{-- two button container --}}
                    <div class="flex flex-row mt-auto">
                        {{-- <button class="w-1/3 h-9 hover:bg-slate-50 border-2 border-[#376F7E] rounded-md flex ml-auto"
                            data-modal-target="order-detail-{{ $order->id }}"
                            data-modal-toggle="order-detail-{{ $order->id }}">
                            <img src="{{ asset('img/assets/icon/icon_admin_order_see_detail.svg') }}"
                                alt="see_detail_icon" class="m-auto border-orange-400">
                        </button> --}}
                        <button class="w-1/3 h-9 hover:bg-slate-50 border-2 border-[#376F7E] rounded-md flex ml-auto"
                            onclick="window.location.href='{{ route('admin.order.show', $order->id) }}'">
                            <img src="{{ asset('img/assets/icon/icon_admin_order_see_detail.svg') }}"
                                alt="see_detail_icon" class="m-auto border-orange-400">
                        </button>
                        @if ($order->status == 'paid')
                            <button
                                class="w-2/3 h-9 bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white font-semibold rounded-md ml-1"
                                data-modal-target="process-order-{{ $order->id }}"
                                data-modal-toggle="process-order-{{ $order->id }}">Process</button>
                            <x-admin.order.process :id="$order->id" :order="$order" />
                        @elseif($order->status == 'processing')
                            <button
                                class="w-2/3 h-9 bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white font-semibold rounded-md ml-1"
                                data-modal-target="sent-order-{{ $order->id }}"
                                data-modal-toggle="sent-order-{{ $order->id }}">Sent</button>
                            <x-admin.order.sent :id="$order->id" />
                        @elseif($order->status == 'shipment_paid')
                            <button
                                class="w-2/3 h-9 bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white font-semibold rounded-md ml-1"
                                data-modal-target="send-order-{{ $order->id }}"
                                data-modal-toggle="send-order-{{ $order->id }}">Sent</button>
                            <x-admin.order.send :id="$order->id" />
                        @endif
                    </div>
                </div>
                {{-- end of detail order container --}}
            </div>
            {{-- <x-admin.order.detail :id="$order->id" :order="$order" /> --}}
        @endforeach
        {{-- end of card order --}}
    </div>
    {{-- end of continer card order --}}
</div>

{{-- MODALS for order page --}}


{{-- success added modal --}}
<div id="success-save-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-fit max-w-5xl max-h-full mt-20">
        <!-- Modal content -->
        <div class="bg-white w-[25vw] h-auto rounded-[30px] shadow">
            <div class="relative w-full h-full flex flex-row">
                <div class="w-full h-full flex flex-col p-14">
                    <h1 class="text-black text-xl font-medium mx-auto">Successfully Saved!</h1>
                    <img src="{{ asset('img/assets/icon/icon_green_check.svg') }}" alt="green_check"
                        class="w-24 h-24 mx-auto mt-6">
                </div>
                {{-- end of modal content --}}
            </div>
        </div>
        <!-- end of modal content -->
    </div>
</div>
{{-- end of success added modal --}}


{{-- end ofMODALS for order page --}}

<style>
    .toggle:checked+label .toggle-circle {
        transform: translateX(52px);
        /* Adjust this value based on the size of the switch */
    }
</style>
<script>
    const orders = {!! $orders->toJson() !!};
</script>
