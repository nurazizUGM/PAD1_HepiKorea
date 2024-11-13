@extends('layout.customer')

@section('title', 'faq')

@section('content')
    <div class="w-full w-max[100%] h-full rounded-3xl bg-[#EFEFEF] py-8 px-10">
        {{-- content container --}}
        <div class="w-full h-fit min-h-[680px] overflow-hidden rounded-3xl bg-white flex flex-col py-8 px-14">
            <div class="flex f8ex-ro2">
                <h1 class="text-[#3E6E7A] font-bold text-3xl">FAQ</h1>
                <h1 class="text-orange-400 font-bold text-3xl ml-8">(Frequently Asked Questions)</h1>
            </div>

            <div id="accordion-open" data-accordion="open" class="my-10 shadow-md bg-none">
                <h2 id="accordion-open-heading-1">
                    <button type="button"
                        class="flex items-center justify-between w-full px-5 py-12 font-medium rtl:text-right bg-[#F1EDED] rounded-t-xl focus:ring-0 gap-3"
                        data-accordion-target="#accordion-open-body-1" aria-expanded="true"
                        aria-controls="accordion-open-body-1">
                        <span class="flex items-center text-[#3E6E7A] font-medium text-2xl">
                            {{-- Accordion title --}}
                            FAQ eCommerce Tip #1: Create Uncomplicated FAQ page
                        </span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0 transition" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="#3E6E7A" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </h2>
                <div id="accordion-open-body-1" class="hidden" aria-labelledby="accordion-open-heading-1">
                    <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                        <p class="mb-2 text-[#3E6E7A] font-medium text-2xl">
                            Keep things simple. This doesn’t mean you should
                            give one-worded answers for your FAQ. Rather you should try to keep your FAQ page from seeming
                            cluttered. A seamless and easy to navigate FAQ page assures customers that they can find what
                            they need without going straight to chat. Keep your FAQ layout or design with easy to use tabs,
                            colors, text, or navigation. Don’t go overboard with the design, remember it’s all about
                            informing customers not keeping them entertained.
                        </p>
                    </div>
                </div>
                <h2 id="accordion-open-heading-2">
                    <button type="button"
                        class="flex items-center justify-between w-full px-5 py-12 font-medium rtl:text-right bg-[#F1EDED] rounded-t-xl focus:ring-0 gap-3"
                        data-accordion-target="#accordion-open-body-2" aria-expanded="false"
                        aria-controls="accordion-open-body-2">
                        <span class="flex items-center text-[#3E6E7A] font-medium text-2xl">
                            {{-- Accordion title --}}
                            FAQ eCommerce Tip #2: Create Uncomplicated FAQ page
                        </span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="#3E6E7A" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </h2>
                <div id="accordion-open-body-2" class="hidden shadow-lg" aria-labelledby="accordion-open-heading-2">
                    <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700">
                        <p class="mb-2 text-[#3E6E7A] font-medium text-2xl">
                            Keep things simple. This doesn’t mean you should
                            give one-worded answers for your FAQ. Rather you should try to keep your FAQ page from seeming
                            cluttered. A seamless and easy to navigate FAQ page assures customers that they can find what
                            they need without going straight to chat. Keep your FAQ layout or design with easy to use tabs,
                            colors, text, or navigation. Don’t go overboard with the design, remember it’s all about
                            informing customers not keeping them entertained.
                        </p>
                    </div>
                </div>
                <h2 id="accordion-open-heading-3">
                    <button type="button"
                        class="flex items-center justify-between w-full px-5 py-12 font-medium rtl:text-right bg-[#F1EDED] rounded-xl focus:ring-0 gap-3"
                        data-accordion-target="#accordion-open-body-3" aria-expanded="false"
                        aria-controls="accordion-open-body-3">
                        <span class="flex items-center text-[#3E6E7A] font-medium text-2xl">
                            {{-- Accordion title --}}
                            FAQ eCommerce Tip #3: Create Uncomplicated FAQ page
                        </span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="#3E6E7A" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </h2>
                <div id="accordion-open-body-3" class="hidden" aria-labelledby="accordion-open-heading-3">
                    <div class="p-5 border border-t-0 border-gray-200 dark:border-gray-700">
                        <p class="mb-2 text-[#3E6E7A] font-medium text-2xl">
                            Keep things simple. This doesn’t mean you should
                            give one-worded answers for your FAQ. Rather you should try to keep your FAQ page from seeming
                            cluttered. A seamless and easy to navigate FAQ page assures customers that they can find what
                            they need without going straight to chat. Keep your FAQ layout or design with easy to use tabs,
                            colors, text, or navigation. Don’t go overboard with the design, remember it’s all about
                            informing customers not keeping them entertained.
                        </p>
                    </div>
                </div>
            </div>


        </div>
        {{-- end of content container --}}
    </div>
@endsection
