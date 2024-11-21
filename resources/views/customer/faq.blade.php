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

            <div id="accordion-open" data-accordion="collapse" class="my-10 shadow-md bg-none">
                @foreach ($faqs as $faq)
                    <h2 id="accordion-open-heading-{{ $loop->iteration }}">
                        <button type="button"
                            class="flex items-center justify-between w-full px-5 py-12 font-medium rtl:text-right bg-[#F1EDED] rounded-t-xl focus:ring-0 gap-3"
                            data-accordion-target="#accordion-open-body-{{ $loop->iteration }}"
                            aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                            aria-controls="accordion-open-body-{{ $loop->iteration }}">
                            <span class="flex items-center text-[#3E6E7A] font-medium text-2xl">
                                {{-- Accordion title --}}
                                {{ $faq->question }}
                            </span>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0 transition" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="#3E6E7A" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5 5 1 1 5" />
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-open-body-{{ $loop->iteration }}" class="hidden"
                        aria-labelledby="accordion-open-heading-{{ $loop->iteration }}">
                        <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                            <p class="mb-2 text-[#3E6E7A] font-medium text-2xl">{{ $faq->answer }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        {{-- end of content container --}}
    </div>
@endsection
