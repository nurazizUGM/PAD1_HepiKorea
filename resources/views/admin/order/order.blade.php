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
                <span class="text-orange-400 text-lg inline-block ml-3">All</span>
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
                        <span class="text-orange-400 text-lg inline-block ml-3">{{ $y }}</span>
                    </button>
                </h2>
                <div id="accordion-year-{{ $y }}" class="hidden"
                    aria-labelledby="accordion-collapse-heading-1-order">
                    <div class="px-5">
                        <ul class="ml-5 text-lg">
                            @foreach ($months[$y] as $month)
                                <li class="my-3 text-md cursor-pointer"
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
                        <p class="text-black ml-3 font-bold text-md">{{ $order->user->fullname }}</p>
                    </div>
                    {{-- Tanggal Order --}}
                    <div class="flex flex-row mt-2 align-bottom">
                        <img src="{{ asset('img/assets/icon/icon_admin_order_date.svg') }}" alt="user icon"
                            class="h-6 w-6">
                        <p class="text-orange-400 ml-3 font-bold text-md">{{ $order->created_at->format('d/m/Y') }}</p>
                    </div>
                    {{-- Price Order --}}
                    <div class="flex flex-row mt-2 -ml-0.5 align-bottom">
                        <img src="{{ asset('img/assets/icon/icon_admin_order_coins.svg') }}" alt="user icon"
                            class="h-7 w-7">
                        {{-- text price --}}
                        <p class="text-orange-400 ml-2.5 font-bold text-md">Rp
                            {{ number_format($order->total_items_price, 0, ',', '.') }}</p>
                    </div>
                    {{-- status --}}
                    <div class="flex flex-row mt-5 -ml-1.5">
                        <p class="text-black text-opacity-50 ml-2.5 font-bold text-md">Status :</p>
                        <p class="text-black text-opacity-50 ml-2.5 font-bold text-md">{{ ucfirst($order->status) }}
                        </p>
                    </div>
                    {{-- two button container --}}
                    <div class="flex flex-row mt-auto">
                        <button class="w-1/3 h-9 border border-orange-400 rounded-md flex "
                            data-modal-target="check-order-detail-modal" data-modal-toggle="check-order-detail-modal">
                            <img src="{{ asset('img/assets/icon/icon_admin_order_see_detail.svg') }}"
                                alt="see_detail_icon" class="m-auto border-orange-400">
                            {{-- icon_admin_order_see_detail.svg --}}
                        </button>
                        @if ($order->status == 'paid')
                            <button
                                class="w-2/3 h-9 bg-orange-400 hover:bg-orange-500 text-white font-semibold rounded-md ml-1"
                                data-modal-target="process-order-detail-modal"
                                data-modal-toggle="process-order-detail-modal">Process</button>
                        @elseif($order->status == 'processing')
                            <button
                                class="w-2/3 h-9 bg-orange-400 hover:bg-orange-500 text-white font-semibold rounded-md ml-1"
                                data-modal-target="sent-order-detail-modal"
                                data-modal-toggle="sent-order-detail-modal">Sent</button>
                        @endif
                    </div>
                </div>
                {{-- end of detail order container --}}
            </div>
        @endforeach
        {{-- end of card order --}}
    </div>
    {{-- end of continer card order --}}
</div>


<!-- check order detail modal -->
<div id="check-order-detail-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-hidden overflow-x-hidden fixed inset-0 top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-2 w-full max-w-6xl max-h-full">
        <!-- Modal content -->
        <div class="bg-white w-[75vw] h-[40vh] rounded-xl shadow">
            <div class="relative w-full h-full p-2 flex flex-row">
                <!-- x button (exit modal) -->
                <button type="button"
                    class="absolute bg-black w-5 h-5 flex flex-col align-middle text-center items-center rounded-full pb-3 -top-2 -right-2"
                    data-modal-hide="check-order-detail-modal">
                    <p class="m-auto text-white text-sm">X</p>
                </button>
                <!-- image User Order detail -->
                <div class="w-[15%] h-[100%] bg-cover bg-no-repeat bg-top rounded-lg"
                    style="background-image: url('{{ asset('img/example/admin_order_img_user.png') }}');">
                </div>
                {{-- end of image User Order detail --}}
                {{-- container of row of order details  --}}
                <div class="w-[85%] h-full px-4 flex flex-col flex-wrap overflow-y-scroll no-scrollbar">
                    <table class="w-full">
                        @for ($i = 0; $i < 5; $i++)
                            <tr class="flex flex-row my-1">
                                {{-- name detail order --}}
                                <td class="w-[20%] max-w-[18%] flex flex-row items-center overflow-hidden align-top">
                                    <div class="w-[100%] max-w-[100%] align-middle flex flex-row mb-auto">
                                        <img src="{{ asset('img/assets/icon/icon_admin_order_customer.svg') }}"
                                            alt="user icon" class="h-5 w-5 fill-black mr-2 my-auto">
                                        <p id="nameTooltip{{ $i }}"
                                            class="text-black text-sm font-semibold truncate my-auto"
                                            data-tooltip-target="nameTooltipText{{ $i }}">Lorem ipsum
                                            dolor
                                            sit
                                            amet, consectetur
                                            adipisicing elit.</p>
                                    </div>
                                </td>
                                {{-- Tooltip for Name --}}
                                <div id="nameTooltipText{{ $i }}" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    Lorem ipsum dolor sit amet
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                                {{-- end of tooltip name --}}
                                {{-- Product detail order --}}
                                <td class="w-[20%] max-w-[20%] flex flex-row items-center align-top">
                                    <img src="{{ asset('img/assets/icon/icon_admin_order_see_detail.svg') }}"
                                        alt="user icon" class="h-5 w-5 fill-black ml-4 mr-3 mb-auto">
                                    <div class="w-full h-fit mb-auto">
                                        <p class="text-orange-400 font-semibold text-sm">
                                            teh hijau warna hijau yang warnanya hijau banget tapi tidak sehijau
                                            matcha
                                        </p>
                                    </div>
                                </td>
                                {{-- Quantity detail order --}}
                                <td class="w-[10%] max-w-[10%] flex flex-row items-center align-top">
                                    <div class="w-[100%] max-w-[100%] align-middle flex flex-row mb-auto">
                                        <img src="{{ asset('img/assets/icon/icon_admin_order_quantity.svg') }}"
                                            alt="user icon" class="h-5 w-5 fill-black ml-2 mr-2 mb-auto">
                                        <p class="text-orange-400 text-sm font-semibold truncate">3x</p>
                                    </div>
                                </td>
                                {{-- Price detail order --}}
                                <td class="w-[20%] max-w-[20%] flex flex-row items-center align-top">
                                    <div class="w-[100%] max-w-[100%] align-middle flex flex-row mb-auto">
                                        <img src="{{ asset('img/assets/icon/icon_admin_order_price.svg') }}"
                                            alt="user icon" class="h-5 w-5 fill-black mr-2 mb-auto">
                                        <p class="text-orange-400 text-sm font-semibold truncate">Rp 24.000.000,-
                                        </p>
                                    </div>
                                </td>
                                {{-- NOtes (catatan) detail order --}}
                                <td class="w-[30%] max-w-[30%] flex flex-row items-center align-top">
                                    <div class="w-[100%] max-w-[100%] align-middle flex flex-row mb-auto">
                                        {{-- <input type="text" class="w-full h-5 rounded-lg border border-orange-400 focus:border-orange-400 focus:ring-0 focus:border" placeholder="Catatan..." value="warna hitam"> --}}
                                        <div class="w-[99%] h-fit border border-orange-400 rounded-lg py-1 px-2">
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus
                                            ullam commodi minus id voluptate quasi aliquid ea ut eaque, deserunt
                                            tempore ab molestias tempora exercitationem consequatur laudantium illo
                                            sint nostrum.
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endfor
                    </table>
                </div>
                {{-- End of container of row of order details  --}}
            </div>
        </div>
        <!-- end of  content -->
    </div>
</div>
<!-- end of check order detail modal -->

{{--  --}}

{{-- process-order-detail-modal --}}
<div id="process-order-detail-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-hidden overflow-x-hidden fixed inset-0 top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-2 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="bg-white w-[23vw] h-[65vh] rounded-xl shadow">
            <div class="relative w-full h-full p-5 flex flex-row">
                <!-- x button (exit modal) -->
                <button type="button"
                    class="absolute bg-black w-5 h-5 flex flex-col align-middle text-center items-center rounded-full pb-3 -top-2 -right-2"
                    data-modal-hide="process-order-detail-modal">
                    <p class="m-auto text-white text-sm">X</p>
                </button>
                {{-- process order content container --}}
                <div class="w-[100%] h-[100%] flex flex-col">
                    <h1 class="text-black text-base font-semibold">Estimation Arrival</h1>

                    {{-- datepicker --}}
                    <div id="datepicker-inline-order" inline-datepicker data-date="02/25/2024"
                        class="mt-1 w-full h-full mx-auto"></div>
                    {{-- end of datepicker --}}

                    <div class="flex flex-row ml-auto mt-2">
                        {{-- timepicker --}}
                        <form class="max-w-[8.5rem]">
                            <div class="flex">
                                <input type="time" id="time"
                                    class="rounded-lg bg-gray-50 border text-gray-900 leading-none focus:ring-0 focus:border-0 block flex-1 w-full text-sm border-gray-300 p-2.5"
                                    min="09:00" max="18:00" value="00:00" required>
                            </div>
                        </form>
                        {{-- end of timepicker --}}

                        {{-- Am Pm picker --}}
                        <div class="flex flex-col justify-center items-center ml-2">
                            <input type="checkbox" id="toggle" class="hidden">
                            <label for="toggle">
                                <div
                                    class="w-28 h-9 bg-gray-200 rounded-md p-0.5 flex items-center cursor-pointer relative z-10">
                                    <!-- Circle inside toggle -->
                                    <div
                                        class="w-14 h-8 bg-white rounded-md transform transition-transform duration-300 ease-in-out toggle-circle">
                                    </div>
                                    <span class="text-sm text-slate-500 absolute left-5">PM</span>
                                    <span class="text-sm text-slate-500 absolute right-5">AM</span>
                                </div>
                            </label>
                        </div>
                        {{-- end of Am Pm picker --}}
                    </div>
                    <button class="rounded-lg bg-orange-400 hover:bg-orange-500 text-white block ml-auto mt-2 w-1/4"
                        data-modal-hide="process-order-detail-modal">Save</button>

                </div>
            </div>
            {{-- end of process order content container --}}
        </div>
    </div>
    <!-- end of  content -->
</div>
</div>

{{-- sent order detail --}}
<!-- sent order detail modal -->
<div id="sent-order-detail-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-hidden overflow-x-hidden fixed inset-0 top-0 right-0 left-0 z-[60] justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-2 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="bg-white w-[45vw] h-[85vh] rounded-xl shadow">
            <div class="relative w-full h-full px-12 py-10 flex flex-row">
                <!-- x button (exit modal) -->
                <button type="button"
                    class="absolute bg-black w-5 h-5 flex flex-col align-middle text-center items-center rounded-full pb-3 -top-2 -right-2"
                    data-modal-hide="sent-order-detail-modal">
                    <p class="m-auto text-white text-sm">X</p>
                </button>
                <!-- image User Order detail -->
                <div class="w-[100%] h-[100%] rounded-lg">
                    <h1 class="text-3xl text-orange-400 font-semibold">Form Shipment</h1>
                    <form action="" class="w-full h-full max-h-[95%]">
                        <table class="w-full h-full mt-1">
                            <tr>
                                <td>
                                    <label for="" class="text-base text-black text-opacity-50">Product
                                        Name</label>
                                    <input type="text"
                                        class="w-full rounded-lg bg-white shadow-md border-none focus:border-none focus:ring-0">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="" class="text-base text-black text-opacity-50">Expedition
                                        Name</label>
                                    <input type="text"
                                        class="w-full rounded-lg bg-white shadow-md border-none focus:border-none focus:ring-0">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="" class="text-base text-black text-opacity-50">Expedition
                                        Price</label>
                                    <input type="text"
                                        class="w-full rounded-lg bg-white shadow-md border-none focus:border-none focus:ring-0">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="" class="text-base text-black text-opacity-50">Shipment
                                        Code</label>
                                    <input type="text"
                                        class="w-full rounded-lg bg-white shadow-md border-none focus:border-none focus:ring-0">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="" class="text-base text-black text-opacity-50">Estimated
                                        Arrival Time</label>
                                    <input type="text"
                                        class="w-full rounded-lg bg-white shadow-md border-none focus:border-none focus:ring-0">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" value="Save"
                                        class="w-1/4 h-3/4 bg-orange-400 hover:bg-orange-500 rounded-md text-white py-0.5 px-1 mt-4"
                                        data-modal-hide="sent-order-detail-modal">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                {{-- end of image User Order detail --}}
            </div>
        </div>
        <!-- end of  content -->
    </div>
</div>
<!-- end of sent order detail modal -->

{{-- END OF MODALS FOR SECTION ORDER --}}

<style>
    #toggle:checked+label .toggle-circle {
        transform: translateX(52px);
        /* Adjust this value based on the size of the switch */
    }
</style>
