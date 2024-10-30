@extends('layout.admin')

@section('title', 'Analytic')

@section('content')
    <div class="bg-[#EFEFEF] border-gray-200 rounded-lg">
        <div class="mb-1">
            <ul class="flex flex-wrap -mb-px text-lg font-bold text-center text-black gap-x-16" id="default-tab"
                data-tabs-toggle="#default-tab-content"
                data-tabs-active-classes="text-black hover:text-black dark:text-purple-500 dark:hover:text-purple-500 border-b-4 border-orange-400 hover:border-orange-400 dark:border-purple-500"
                data-tabs-inactive-classes="dark:border-transparent text-black hover:text-orange-400 dark:text-gray-400 border-transparent hover:border-transparent dark:border-gray-700 dark:hover:text-gray-300"
                role="tablist">
                <!-- Tab product -->
                <li class="ml-auto mr-auto" role="presentation">
                    <button class="inline-block px-4 pt-4 pb-1 border-b-2 rounded-t-lg" id="order-tab"
                        data-tabs-target="#order" type="button" role="tab" aria-controls="order"
                        aria-selected="false">Order</button>
                </li>
                <!-- Tab  Category-->
                <li class="ml-auto mr-auto" role="presentation">
                    <button
                        class="inline-block px-4 pt-4 pb-1 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="confirmation-tab" data-tabs-target="#confirmation" type="button" role="tab"
                        aria-controls="confirmation" aria-selected="false">Confirmation</button>
                </li>
            </ul>
        </div>

        <!-- Tab Content (showing the content) -->
        <div id="default-tab-content">
            <!-- order Content -->
            <div class="hidden px-5 rounded-lg h-[80vh] mt-3" id="order" role="tabpanel" aria-labelledby="order-tab">
                <div class="flex flex-row">
                    {{-- year and month section (filter) --}}
                    <div class="w-[20%] h-[78vh] bg-white rounded-lg overflow-y-scroll no-scrollbar">
                        <div id="accordion-collapse" data-accordion="collapse">
                            <h2 id="accordion-collapse-heading-1">
                                <button type="button"
                                    class="flex items-center w-full px-5 pt-5 font-medium rtl:text-right text-gray-500 border-b-0 rounded-xl focus:ring-0 focus:bg-white"
                                    data-accordion-target="#accordion-collapse-body-1" aria-expanded="true"
                                    aria-controls="accordion-collapse-body-1">
                                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M9 5 5 1 1 5" />
                                    </svg>
                                    <span class="text-orange-400 text-lg inline-block ml-3">2024</span>
                                </button>
                            </h2>
                            <div id="accordion-collapse-body-1" class="hidden"
                                aria-labelledby="accordion-collapse-heading-1">
                                <div class="px-5">
                                    <ul class="ml-5 text-lg">
                                        <li class="my-3 text-md">January</li>
                                        <li class="my-3 text-md">February</li>
                                        <li class="my-3 text-md">March</li>
                                        <li class="my-3 text-md">April</li>
                                        <li class="my-3 text-md">May</li>
                                        <li class="my-3 text-md">June</li>
                                    </ul>
                                </div>
                            </div>
                            <h2 id="accordion-collapse-heading-2">
                                <button type="button"
                                    class="flex items-center w-full px-5 pt-5 font-medium rtl:text-right text-gray-500 rounded-xl focus:ring-0 focus:bg-white"
                                    data-accordion-target="#accordion-collapse-body-2" aria-expanded="false"
                                    aria-controls="accordion-collapse-body-2">
                                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M9 5 5 1 1 5" />
                                    </svg>
                                    <span class="text-orange-400 text-lg inline-block ml-3">2023</span>
                                </button>
                            </h2>
                            <div id="accordion-collapse-body-2" class="hidden"
                                aria-labelledby="accordion-collapse-heading-2">
                                <div class="px-5">
                                    <ul class="ml-5 text-lg">
                                        <li class="my-3 text-md">January</li>
                                        <li class="my-3 text-md">February</li>
                                        <li class="my-3 text-md">March</li>
                                        <li class="my-3 text-md">April</li>
                                        <li class="my-3 text-md">May</li>
                                        <li class="my-3 text-md">June</li>
                                        <li class="my-3 text-md">July</li>
                                        <li class="my-3 text-md">August</li>
                                        <li class="my-3 text-md">September</li>
                                        <li class="my-3 text-md">October</li>
                                        <li class="my-3 text-md">November</li>
                                        <li class="my-3 text-md">December</li>
                                    </ul>
                                </div>
                            </div>
                            <h2 id="accordion-collapse-heading-3">
                                <button type="button"
                                    class="flex items-center w-full px-5 pt-5 font-medium rtl:text-right text-gray-500 rounded-xl focus:ring-0 focus:bg-white"
                                    data-accordion-target="#accordion-collapse-body-3" aria-expanded="false"
                                    aria-controls="accordion-collapse-body-3">
                                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M9 5 5 1 1 5" />
                                    </svg>
                                    <span class="text-orange-400 text-lg inline-block ml-3">2022</span>
                                </button>
                            </h2>
                            <div id="accordion-collapse-body-3" class="hidden"
                                aria-labelledby="accordion-collapse-heading-3">
                                <div class="px-5">
                                    <ul class="ml-5 text-lg">
                                        <li class="my-3 text-md">January</li>
                                        <li class="my-3 text-md">February</li>
                                        <li class="my-3 text-md">March</li>
                                        <li class="my-3 text-md">April</li>
                                        <li class="my-3 text-md">May</li>
                                        <li class="my-3 text-md">June</li>
                                        <li class="my-3 text-md">July</li>
                                        <li class="my-3 text-md">August</li>
                                        <li class="my-3 text-md">September</li>
                                        <li class="my-3 text-md">October</li>
                                        <li class="my-3 text-md">November</li>
                                        <li class="my-3 text-md">December</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end of year and month selection (filter) --}}


                    <div class="w-[80%] h-[78vh] ml-4 flex flex-wrap flex-row gap-6 overflow-y-scroll no-scrollbar">
                        @for ($i = 1; $i < 10; $i++)
                            {{-- For loop hanya untuk test --}}
                            {{-- card order --}}
                            <div class="bg-white w-[23rem] h-52 rounded-xl p-2 flex flex-row">
                                {{-- image order container --}}
                                <div class="w-5/12 h-full bg-cover bg-center rounded-xl"
                                    style="background-image: url('{{ asset('img/example/admin_order_img_user.png') }}')">
                                </div>
                                {{-- detail order container --}}
                                <div class="w-7/12 h-full flex flex-col px-4 pt-1">
                                    {{-- Nama Customer --}}
                                    <div class="flex flex-row">
                                        {{-- icon customer --}}
                                        <img src="{{ asset('img/assets/icon/icon_admin_order_customer.svg') }}"
                                            alt="user icon" class="h-6 w-6 fill-black">
                                        {{-- Customer --}}
                                        <p class="text-black ml-3 font-bold text-md">Aisyah</p>
                                    </div>
                                    {{-- Tanggal Order --}}
                                    <div class="flex flex-row mt-2 align-bottom">
                                        <img src="{{ asset('img/assets/icon/icon_admin_order_date.svg') }}"
                                            alt="user icon" class="h-6 w-6">
                                        <p class="text-orange-400 ml-3 font-bold text-md">13-09-2024</p>
                                    </div>
                                    {{-- Price Order --}}
                                    <div class="flex flex-row mt-2 -ml-0.5 align-bottom">
                                        <img src="{{ asset('img/assets/icon/icon_admin_order_coins.svg') }}"
                                            alt="user icon" class="h-7 w-7">
                                        {{-- text price --}}
                                        <p class="text-orange-400 ml-2.5 font-bold text-md">Rp 300.000,-</p>
                                    </div>
                                    {{-- two button container --}}
                                    <div class="flex flex-row mt-auto">
                                        <button class="w-1/3 h-9 border border-orange-400 rounded-md flex">
                                            <img src="{{ asset('img/assets/icon/icon_admin_order_see_detail.svg') }}"
                                                alt="see_detail_icon" class="m-auto">
                                            {{-- icon_admin_order_see_detail.svg --}}
                                        </button>
                                        <button
                                            class="w-2/3 h-9 bg-orange-400 text-white font-semibold rounded-md ml-1">Unpaid</button>
                                    </div>
                                </div>
                                {{-- end of detail order container --}}
                            </div>
                            {{-- end of card order --}}
                        @endfor
                    </div>
                </div>

            </div>
            <!-- end of order Content -->





            <!-- confirmation Content -->
            <div class="hidden px-5 pt-2 rounded-lg h-[80vh]" id="confirmation" role="tabpanel"
                aria-labelledby="confirmation-tab">
                <div class="flex flex-row">
                    {{-- year and month section (filter) --}}
                    <div class="w-[20%] h-[78vh] bg-white rounded-lg overflow-y-scroll no-scrollbar">
                        <div id="accordion-collapse" data-accordion="collapse">
                            <h2 id="accordion-collapse-heading-1">
                                <button type="button"
                                    class="flex items-center w-full px-5 pt-5 font-medium rtl:text-right text-gray-500 border-b-0 rounded-xl focus:ring-0 focus:bg-white"
                                    data-accordion-target="#accordion-collapse-body-1" aria-expanded="true"
                                    aria-controls="accordion-collapse-body-1">
                                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M9 5 5 1 1 5" />
                                    </svg>
                                    <span class="text-orange-400 text-lg inline-block ml-3">2024</span>
                                </button>
                            </h2>
                            <div id="accordion-collapse-body-1" class="hidden"
                                aria-labelledby="accordion-collapse-heading-1">
                                <div class="px-5">
                                    <ul class="ml-5 text-lg">
                                        <li class="my-3 text-md">January</li>
                                        <li class="my-3 text-md">February</li>
                                        <li class="my-3 text-md">March</li>
                                        <li class="my-3 text-md">April</li>
                                        <li class="my-3 text-md">May</li>
                                        <li class="my-3 text-md">June</li>
                                    </ul>
                                </div>
                            </div>
                            <h2 id="accordion-collapse-heading-2">
                                <button type="button"
                                    class="flex items-center w-full px-5 pt-5 font-medium rtl:text-right text-gray-500 rounded-xl focus:ring-0 focus:bg-white"
                                    data-accordion-target="#accordion-collapse-body-2" aria-expanded="false"
                                    aria-controls="accordion-collapse-body-2">
                                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M9 5 5 1 1 5" />
                                    </svg>
                                    <span class="text-orange-400 text-lg inline-block ml-3">2023</span>
                                </button>
                            </h2>
                            <div id="accordion-collapse-body-2" class="hidden"
                                aria-labelledby="accordion-collapse-heading-2">
                                <div class="px-5">
                                    <ul class="ml-5 text-lg">
                                        <li class="my-3 text-md">January</li>
                                        <li class="my-3 text-md">February</li>
                                        <li class="my-3 text-md">March</li>
                                        <li class="my-3 text-md">April</li>
                                        <li class="my-3 text-md">May</li>
                                        <li class="my-3 text-md">June</li>
                                        <li class="my-3 text-md">July</li>
                                        <li class="my-3 text-md">August</li>
                                        <li class="my-3 text-md">September</li>
                                        <li class="my-3 text-md">October</li>
                                        <li class="my-3 text-md">November</li>
                                        <li class="my-3 text-md">December</li>
                                    </ul>
                                </div>
                            </div>
                            <h2 id="accordion-collapse-heading-3">
                                <button type="button"
                                    class="flex items-center w-full px-5 pt-5 font-medium rtl:text-right text-gray-500 rounded-xl focus:ring-0 focus:bg-white"
                                    data-accordion-target="#accordion-collapse-body-3" aria-expanded="false"
                                    aria-controls="accordion-collapse-body-3">
                                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M9 5 5 1 1 5" />
                                    </svg>
                                    <span class="text-orange-400 text-lg inline-block ml-3">2022</span>
                                </button>
                            </h2>
                            <div id="accordion-collapse-body-3" class="hidden"
                                aria-labelledby="accordion-collapse-heading-3">
                                <div class="px-5">
                                    <ul class="ml-5 text-lg">
                                        <li class="my-3 text-md">January</li>
                                        <li class="my-3 text-md">February</li>
                                        <li class="my-3 text-md">March</li>
                                        <li class="my-3 text-md">April</li>
                                        <li class="my-3 text-md">May</li>
                                        <li class="my-3 text-md">June</li>
                                        <li class="my-3 text-md">July</li>
                                        <li class="my-3 text-md">August</li>
                                        <li class="my-3 text-md">September</li>
                                        <li class="my-3 text-md">October</li>
                                        <li class="my-3 text-md">November</li>
                                        <li class="my-3 text-md">December</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end of year and month selection (filter) --}}


                    <div class="w-[80%] h-[78vh] ml-4 flex flex-wrap flex-row gap-6 overflow-y-scroll no-scrollbar">
                        {{-- @for ($i = 1; $i < 10; $i++) --}}
                        {{-- For loop hanya untuk test --}}
                        {{-- card order --}}
                        <div class="bg-white w-[27rem] h-52 rounded-xl p-2 flex flex-row">
                            {{-- image order container --}}
                            <div class="w-5/12 h-full bg-cover bg-center rounded-xl"
                                style="background-image: url('{{ asset('img/example/admin_order_img_user.png') }}')">
                            </div>
                            {{-- detail order container --}}
                            <div class="w-7/12 h-full flex flex-col px-4 pt-1">
                                {{-- product name --}}
                                <h3 class="text-black font-bold text-md">Samsung Ultra S24</h3>
                                {{-- product variant --}}
                                <p class="text-orange-400 font-semibold text-md mt-3">Black</p>
                                {{-- product price --}}
                                <p class="text-orange-400 font-semibold text-md mt-3">Rp 24.000.000,-</p>
                                <button class="w-1/3 h-9 bg-orange-400 text-white font-semibold rounded-md mt-auto ml-auto inline">Check</button>
                            </div>
                            {{-- end of detail order container --}}
                        </div>
                        {{-- end of card order --}}
                        {{-- @endfor --}}
                    </div>
                </div>

            </div>
            {{-- end of confirmation content --}}

        </div>
        <!-- end of tab content -->
    </div>

    </div>
@endsection
