<div class="flex flex-row">
    {{-- year and month section (filter) --}}
    <div class="w-[20%] h-[78vh] bg-white rounded-lg overflow-y-scroll no-scrollbar">
        <div id="accordion-collapse-confirmation" data-accordion="collapse-confirmation">
            <button type="button"
                onclick="window.location.href='{{ route('admin.order.index', ['tab' => 'confirmation']) }}'"
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
                                    onclick="window.location.href='{{ route('admin.order.index', ['tab' => 'confirmation', 'year' => $y, 'month' => $month]) }}'">
                                    {{ $month }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{-- end of year and month selection (filter) --}}


    <div
        class="w-[80%] h-fit ml-6 flex flex-wrap gap-y-4 gap-x-4 flex-row justify-start items-start align-content-start overflow-y-scroll no-scrollbar">
        @foreach ($orders as $order)
            {{-- card confirmation --}}
            <div class="bg-white w-[26rem] h-52 rounded-xl p-2 flex flex-row">
                {{-- image confirmation container --}}
                <div class="w-[35%] h-full bg-contain bg-center bg-no-repeat rounded-xl"
                    style="background-image: url('{{ asset('img/example/admin_order_img_phone.png') }}')">
                </div>
                {{-- detail confirmation container --}}
                <div class="w-[65%] h-full flex flex-col px-4 pt-1">
                    {{-- product name --}}
                    <h3 class="text-black font-bold text-md">{{ $order->customOrderItems->first()->name }}</h3>
                    {{-- product price --}}
                    <p class="text-[#376F7E] font-semibold text-lg mt-3">Rp
                        {{ number_format($order->total_items_price, 0, ',', '.') }}</p>
                    <button
                        class="w-28 h-8 bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white font-semibold rounded-md mt-auto ml-auto inline">Check</button>
                </div>
                {{-- end of detail confirmation container --}}
            </div>
            {{-- end of card confirmation --}}
        @endforeach
    </div>
</div>
