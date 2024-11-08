<div class="flex flex-row">
    {{-- year and month section (filter) --}}
    <div class="w-[20%] h-[78vh] bg-white rounded-lg overflow-y-scroll no-scrollbar">
        <div id="accordion-collapse-confirmation" data-accordion="collapse-confirmation">
            <h2 id="accordion-collapse-heading-1-confirmation">
                <button type="button"
                    class="flex items-center w-full px-5 pt-5 font-medium rtl:text-right text-gray-500 border-b-0 rounded-xl focus:ring-0 focus:bg-white"
                    data-accordion-target="#accordion-collapse-body-1-confirmation" aria-expanded="true"
                    aria-controls="accordion-collapse-body-1-confirmation">
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5 5 1 1 5" />
                    </svg>
                    <span class="text-orange-400 text-lg inline-block ml-3">2024</span>
                </button>
            </h2>
            <div id="accordion-collapse-body-1-confirmation" class="hidden"
                aria-labelledby="accordion-collapse-heading-1-confirmation">
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
            <h2 id="accordion-collapse-heading-2-confirmation">
                <button type="button"
                    class="flex items-center w-full px-5 pt-5 font-medium rtl:text-right text-gray-500 rounded-xl focus:ring-0 focus:bg-white"
                    data-accordion-target="#accordion-collapse-body-2-confirmation" aria-expanded="false"
                    aria-controls="accordion-collapse-body-2-confirmation">
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5 5 1 1 5" />
                    </svg>
                    <span class="text-orange-400 text-lg inline-block ml-3">2023</span>
                </button>
            </h2>
            <div id="accordion-collapse-body-2-confirmation" class="hidden"
                aria-labelledby="accordion-collapse-heading-2-confirmation">
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
            <h2 id="accordion-collapse-heading-3-confirmation">
                <button type="button"
                    class="flex items-center w-full px-5 pt-5 font-medium rtl:text-right text-gray-500 rounded-xl focus:ring-0 focus:bg-white"
                    data-accordion-target="#accordion-collapse-body-3-confirmation" aria-expanded="false"
                    aria-controls="accordion-collapse-body-3-confirmation">
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5 5 1 1 5" />
                    </svg>
                    <span class="text-orange-400 text-lg inline-block ml-3">2022</span>
                </button>
            </h2>
            <div id="accordion-collapse-body-3-confirmation" class="hidden"
                aria-labelledby="accordion-collapse-heading-3-confirmation">
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


    <div
        class="w-[80%] h-fit ml-6 flex flex-wrap gap-y-4 gap-x-4 flex-row justify-start items-start align-content-start overflow-y-scroll no-scrollbar">
        @for ($i = 0; $i < 10; $i++)
            {{-- For loop hanya untuk test --}}

            {{-- card confirmation --}}
            <div class="bg-white w-[26rem] h-52 rounded-xl p-2 flex flex-row">
                {{-- image confirmation container --}}
                <div class="w-[35%] h-full bg-contain bg-center bg-no-repeat rounded-xl"
                    style="background-image: url('{{ asset('img/example/admin_order_img_phone.png') }}')">
                </div>
                {{-- detail confirmation container --}}
                <div class="w-[65%] h-full flex flex-col px-4 pt-1">
                    {{-- product name --}}
                    <h3 class="text-black font-bold text-md">Samsung Ultra S24</h3>
                    {{-- product variant --}}
                    <p class="text-orange-400 font-semibold text-md mt-3">Black</p>
                    {{-- product price --}}
                    <p class="text-orange-400 font-semibold text-md mt-3">Rp 24.000.000,-</p>
                    <button
                        class="w-24 h-10 bg-orange-400 hover:bg-orange-500 text-white font-semibold rounded-md mt-auto ml-auto inline">Check</button>
                </div>
                {{-- end of detail confirmation container --}}
            </div>
            {{-- end of card confirmation --}}
        @endfor
    </div>
</div>
