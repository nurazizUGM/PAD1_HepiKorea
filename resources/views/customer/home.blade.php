@extends('layout.customer')
@php
    $lineId = \App\Models\Setting::where('key', 'line')->first()->value;
@endphp
<a href="https://line.me/ti/p/~{{ $lineId }}" target="_blank"
    class="fixed flex flex-row bottom-8 right-8 px-2 py-2 text-base md:text-2xl font-bold text-[#3E6E7A] bg-white rounded-3xl align-middle items-center shadow-md hover:shadow-lg z-30">
    <img src="{{ asset('img/assets/icon/icon_customer_chat.svg') }}" alt="icon_Chat" class="w-5 h-5 md:w-10 md:h-10 mr-1">
    <p>Chat</p>
</a>

@section('content')
    {{-- homapege content container --}}
    <div class="w-full w-max[100%] h-full rounded-3xl bg-[#EFEFEF] shadow-lg overflow-hidden">
        {{-- start of carousel --}}
        <div id="default-carousel" class="relative w-full rounded-t-2xl md:rounded-t-3xl" data-carousel="slide">
            <!-- Carousel wrapper -->
            <div class="relative h-[150px] md:h-[500px] overflow-hidden rounded-t-lg">
                @foreach (\App\Models\Carousel::all() as $carousel)
                    @switch($carousel->media_type)
                        @case('image')
                            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                {{-- <img src="/docs/images/carousel/carousel-2.svg"
                            class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="..."> --}}
                                <div
                                    class="w-full h-full flex flex-row absolute -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                    <div class="w-1/2 h-full flex flex-col bg-[#3E6E7A] p-2 md:p-20 text-white">
                                        <h1 class="text-md md:text-5xl font-semibold">Are you ready to lead the way</h1>
                                        <h2 class="text-xs md:text-2xl font-medium mt-1 md:mt-8">Luxury meets ultimate sitting
                                            comfort
                                        </h2>
                                    </div>
                                    <div class="w-1/2 h-full bg-white">
                                        {{-- test image --}}
                                        @if (Storage::disk('public')->exists($carousel->media))
                                            <img src="{{ Storage::url($carousel->media) }}" alt=""
                                                class="w-full h-full object-contain">
                                        @elseif (filter_var($carousel->media, FILTER_VALIDATE_URL))
                                            <img src="{{ $carousel->media }}" alt="" class="w-full h-full object-contain">
                                        @else
                                            <img src="img/assets/bg/background_auth.svg" alt=""
                                                class="w-full h-full object-contain">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @break

                        @case('video')
                            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                {{-- <img src="{{ asset('img/assets/bg/background_auth.svg') }}"
                                class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="..."> --}}
                                <div
                                    class="w-full h-full flex flex-row absolute -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                    <div class="w-1/2 h-full flex flex-col bg-[#3E6E7A] p-2 md:p-20 text-white">
                                        <h1 class="text-md md:text-md md:text-5xl font-semibold">Are you ready to lead the way</h1>
                                        <h2 class="text-xs md:text-2xl font-medium mt-1 md:mt-8">Luxury meets ultimate sitting
                                            comfort
                                        </h2>
                                    </div>
                                    <div class="w-1/2 h-full bg-white">
                                        {{-- <img src="img/example/example_phone.png" alt="" class="w-full h-full object-contain"> --}}

                                        {{-- test video --}}
                                        <video class="w-full h-full object-contain" controls autoplay muted loop>
                                            @if (Storage::disk('public')->exists($carousel->media))
                                                <source src="{{ Storage::url($carousel->media) }}" type="video/mp4">
                                            @elseif (filter_var($carousel->media, FILTER_VALIDATE_URL))
                                                <source src="{{ $carousel->media }}" type="video/mp4">
                                            @else
                                                <source src="{{ asset('vid/test_vid_p3r.mp4') }}" type="video/mp4">
                                            @endif
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                </div>
                            </div>
                        @break

                        @case('youtube')
                            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                {{-- <img src="/docs/images/carousel/carousel-5.svg"
                                class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="..."> --}}
                                <div
                                    class="w-full h-full flex flex-row absolute -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                    <div class="w-1/2 h-full flex flex-col bg-[#3E6E7A] p-2 md:p-20 text-white">
                                        <h1 class="text-md md:text-5xl font-semibold">Are you ready to lead the way</h1>
                                        <h2 class="text-xs md:text-2xl font-medium mt-1 md:mt-8">Luxury meets ultimate sitting
                                            comfort
                                        </h2>
                                    </div>
                                    <div class="w-1/2 h-full flex bg-white">
                                        {{-- <img src="img/example/logo_hepikorea_transparent.png" alt=""
                                        class="w-full h-full object-contain"> --}}
                                        {{-- <iframe class="w-full h-full"
                                        src="https://www.youtube.com/embed/VqJnmphV9R8?si=tm0uf-A89gyoBqF6"
                                        title="YouTube video player" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe> --}}
                                        <iframe class="w-full h-full" src="{{ $carousel->media }}" title="YouTube video player"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                                        </iframe>
                                    </div>
                                </div>
                            </div>
                        @break

                        @default
                    @endswitch
                @endforeach
                <!-- Item 1 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    {{-- <img src="{{ asset('img/assets/bg/background_auth.svg') }}"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="..."> --}}
                    <div class="w-full h-full flex flex-row absolute -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                        <div class="w-1/2 h-full flex flex-col bg-[#3E6E7A] p-2 md:p-20 text-white">
                            <h1 class="text-md md:text-md md:text-5xl font-semibold">Are you ready to lead the way</h1>
                            <h2 class="text-xs md:text-2xl font-medium mt-1 md:mt-8">Luxury meets ultimate sitting comfort
                            </h2>
                        </div>
                        <div class="w-1/2 h-full bg-white">
                            {{-- <img src="img/example/example_phone.png" alt="" class="w-full h-full object-contain"> --}}

                            {{-- test video --}}
                            <video class="w-full h-full object-contain" controls autoplay muted loop>
                                <source src="{{ asset('vid/test_vid_p3r.mp4') }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    </div>
                </div>
                <!-- Item 2 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    {{-- <img src="/docs/images/carousel/carousel-2.svg"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="..."> --}}
                    <div class="w-full h-full flex flex-row absolute -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                        <div class="w-1/2 h-full flex flex-col bg-[#3E6E7A] p-2 md:p-20 text-white">
                            <h1 class="text-md md:text-5xl font-semibold">Are you ready to lead the way</h1>
                            <h2 class="text-xs md:text-2xl font-medium mt-1 md:mt-8">Luxury meets ultimate sitting comfort
                            </h2>
                        </div>
                        <div class="w-1/2 h-full bg-white">
                            {{-- test image --}}
                            <img src="img/assets/bg/background_auth.svg" alt=""
                                class="w-full h-full object-contain">
                        </div>
                    </div>
                </div>
                <!-- Item 3 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    {{-- <img src="/docs/images/carousel/carousel-3.svg"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="..."> --}}
                    <div class="w-full h-full flex flex-row absolute -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                        <div class="w-1/2 h-full flex flex-col bg-[#3E6E7A] p-2 md:p-20 text-white">
                            <h1 class="text-md md:text-5xl font-semibold">Are you ready to lead the way</h1>
                            <h2 class="text-xs md:text-2xl font-medium mt-1 md:mt-8">Luxury meets ultimate sitting comfort
                            </h2>
                        </div>
                        <div class="w-1/2 h-full flex bg-white">
                            <img src="img/example/carousel_test.png" alt="" class="w-full h-full object-contain">
                        </div>
                    </div>
                </div>
                <!-- Item 4 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    {{-- <img src="/docs/images/carousel/carousel-4.svg"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="..."> --}}
                    <div class="w-full h-full flex flex-row absolute -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                        <div class="w-1/2 h-full flex flex-col bg-[#3E6E7A] p-2 md:p-20 text-white">
                            <h1 class="text-md md:text-5xl font-semibold">Are you ready to lead the way</h1>
                            <h2 class="text-xs md:text-2xl font-medium mt-1 md:mt-8">Luxury meets ultimate sitting comfort
                            </h2>
                        </div>
                        <div class="w-1/2 h-full flex bg-white">
                            <img src="img/example/logo_hepikorea.jpg" alt="" class="w-full h-full object-contain">
                        </div>
                    </div>
                </div>
                <!-- Item 5 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    {{-- <img src="/docs/images/carousel/carousel-5.svg"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="..."> --}}
                    <div class="w-full h-full flex flex-row absolute -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                        <div class="w-1/2 h-full flex flex-col bg-[#3E6E7A] p-2 md:p-20 text-white">
                            <h1 class="text-md md:text-5xl font-semibold">Are you ready to lead the way</h1>
                            <h2 class="text-xs md:text-2xl font-medium mt-1 md:mt-8">Luxury meets ultimate sitting comfort
                            </h2>
                        </div>
                        <div class="w-1/2 h-full flex bg-white">
                            {{-- <img src="img/example/logo_hepikorea_transparent.png" alt=""
                                class="w-full h-full object-contain"> --}}
                            {{-- <iframe class="w-full h-full"
                                src="https://www.youtube.com/embed/VqJnmphV9R8?si=tm0uf-A89gyoBqF6"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe> --}}
                            <iframe class="w-full h-full"
                                src="https://www.youtube.com/embed/VqJnmphV9R8?si=tm0uf-A89gyoBqF6&autoplay=1&mute=1"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                            </iframe>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Slider indicators -->
            <div
                class="absolute z-30 flex -translate-x-1/2 bottom-4 left-1/2 space-x-3 rtl:space-x-reverse scale-50 md:scale-100">
                <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1"
                    data-carousel-slide-to="0"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2"
                    data-carousel-slide-to="1"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3"
                    data-carousel-slide-to="2"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4"
                    data-carousel-slide-to="3"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5"
                    data-carousel-slide-to="4"></button>
            </div>
            <!-- Slider controls -->
            <button type="button"
                class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none scale-50 md:scale-100"
                data-carousel-prev>
                <span
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 shadow-xl group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 1 1 5l4 4" />
                    </svg>
                    <span class="sr-only">Previous</span>
                </span>
            </button>
            <button type="button"
                class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none scale-50 md:scale-100"
                data-carousel-next>
                <span
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 shadow-xl group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="sr-only">Next</span>
                </span>
            </button>
        </div>
        {{-- end of carousel --}}

        {{--  --}}

        {{-- start of category,recent,best seller container --}}
        <div class="w-full h-full flex flex-col py-5 md:py-10 px-4 md:px-12">
            {{-- category text --}}
            <div class="w-fit md:w-1/5 bg-white rounded-xl text-center py-2 px-4 md:px-0">
                <h1 class="text-[#3E6E7A] text-sm md:text-lg font-semibold">Category</h1>
            </div>
            {{-- end of category text --}}

            {{-- category container --}}
            <div class="grid grid-cols-4 gap-x-3 gap-y-3 md:gap-x-32 md:gap-y-20 mt-4 md:mt-14">
                @foreach ($categories as $category)
                    <div class="bg-[#FFFCFC] h-24 md:h-52 flex flex-col text-center align-middle justify-center rounded-xl cursor-pointer"
                        onclick="window.location.href='{{ route('product.index', ['category' => $category->id]) }}'">
                        <img src="{{ asset('img/assets/icon/icon_homepage_category_fashion.png') }}"
                            alt="fashion_Category" class="w-12 h-12 md:w-40 md:h-40 mx-auto">
                        <h2 class="text-black text-[10px] md:text-lg font-semibold text-ellipsis overflow-hidden">
                            {{ $category->name }}</h2>
                    </div>
                @endforeach
            </div>
            {{-- end of category container --}}

            {{--  --}}

            {{-- New arrival text --}}
            <div class="w-fit md:w-1/5 bg-white rounded-xl text-center py-2 px-4 md:px-0 mt-4 md:mt-14">
                <h1 class="text-[#3E6E7A] text-sm md:text-lg font-semibold">New Arrival</h1>
            </div>
            {{-- end of New arrival text --}}

            {{-- gray line --}}
            {{-- <hr class="border-b border-black border-opacity-50 mt-5"> --}}

            {{-- new arrival container --}}
            <div class="relative mt-5 md:mt-10">
                <div class="overflow-x-auto no-scrollbar" id="new-arrival-container">
                    <!-- Scroll Right Button -->
                    <button onclick="scrollRight()"
                        class="absolute top-1/2 right-0 transform -translate-y-1/2 z-10 bg-orange-400 bg-opacity-50 hover:bg-opacity-80 text-white rounded-full p-2 shadow-lg">
                        <!-- Icon (optional) -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                    <!-- Scroll Left Button -->
                    <button onclick="scrollLeft()"
                        class="absolute top-1/2 left-0 transform -translate-y-1/2 z-10 bg-orange-400 bg-opacity-50 hover:bg-opacity-80 text-white rounded-full p-2 shadow-lg">
                        <!-- Icon (optional) -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 rotate-180" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    <div class="grid grid-flow-col auto-cols-[125px] md:auto-cols-[175px] gap-x-5 md:gap-x-14">
                        @foreach ($newProducts as $product)
                            {{-- card product --}}
                            <div class="bg-white h-[200px] md:h-[250px] flex flex-col rounded-xl overflow-hidden cursor-pointer"
                                onclick="window.location.href='{{ route('product.show', $product->id) }}'">
                                {{-- image product --}}
                                <div class="w-full h-4/6 bg-cover bg-no-repeat bg-center"
                                    style="background-image: url('{{ asset('img/example/test_blouse.png') }}')"></div>
                                {{-- text product --}}
                                <div class="w-full h-2/6 py-0.5 px-1.5 flex flex-col">
                                    {{-- product title --}}
                                    <h1
                                        class="text-xs md:text-sm text-[#3E6E7A] font-semibold text-nowrap text-ellipsis truncate overflow-hidden">
                                        {{ $product->name }}
                                    </h1>
                                    {{-- product type --}}
                                    <h2
                                        class="text-[10px] md:text-xs font-semibold text-black text-opacity-50 text-ellipsis overflow-hidden">
                                        {{ $product->category }}
                                    </h2>
                                    {{-- product price --}}
                                    <h3
                                        class="text-[10px] md:text-xs ml-auto text-orange-400 font-semibold text-ellipsis overflow-hidden">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}</h3>
                                    {{-- Buy product button --}}
                                    <a href="#" class="ml-auto my-auto"><button
                                            class="bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] rounded-xl text-white px-2 md:px-4 md:py-0.5 text-[10px] md:text-xs">Buy</button></a>
                                </div>
                            </div>
                            {{-- end of card product --}}
                        @endforeach
                    </div>
                </div>
            </div>
            {{-- end of new arrival container --}}

            {{--  --}}

            {{-- best seller text --}}
            <div class="w-fit md:w-1/5 bg-white rounded-xl text-center py-2 px-4 md:px-0 mt-4 md:mt-14">
                <h1 class="text-[#3E6E7A] text-sm md:text-lg font-semibold">Best Seller</h1>
            </div>
            {{-- end of best seller text --}}

            {{-- gray line --}}
            {{-- <hr class="border-b border-black border-opacity-50 mt-5"> --}}

            {{-- best seller container --}}
            <div class="relative mt-5 md:mt-10">
                <div class="overflow-x-auto no-scrollbar " id="best-seller-container">
                    <!-- Scroll Right Button -->
                    <button onclick="scrollRight2()"
                        class="absolute top-1/2 right-0 transform -translate-y-1/2 z-10 bg-orange-400 bg-opacity-50 hover:bg-opacity-80 text-white rounded-full p-2 shadow-lg">
                        <!-- Icon (optional) -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                    <!-- Scroll Left Button -->
                    <button onclick="scrollLeft2()"
                        class="absolute top-1/2 left-0 transform -translate-y-1/2 z-10 bg-orange-400 bg-opacity-50 hover:bg-opacity-80 text-white rounded-full p-2 shadow-lg">
                        <!-- Icon (optional) -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 rotate-180" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    <div class="grid grid-flow-col auto-cols-[125px] md:auto-cols-[175px] gap-x-5 md:gap-x-14">
                        @foreach ($popularProducts as $product)
                            {{-- card product --}}
                            <div class="bg-white h-[200px] md:h-[250px] flex flex-col rounded-xl overflow-hidden cursor-pointer"
                                onclick="window.location.href='{{ route('product.show', $product->id) }}'">
                                {{-- image product --}}
                                <div class="w-full h-4/6 bg-cover bg-no-repeat bg-center"
                                    style="background-image: url('{{ asset('img/example/test_blouse.png') }}')"></div>
                                {{-- text product --}}
                                <div class="w-full h-2/6 py-0.5 px-1.5 flex flex-col">
                                    {{-- product title --}}
                                    <h1
                                        class="text-xs md:text-sm text-[#3E6E7A] font-semibold text-nowrap text-ellipsis truncate overflow-hidden">
                                        {{ $product->name }}
                                    </h1>
                                    {{-- product type --}}
                                    <h2
                                        class="text-[10px] md:text-xs font-semibold text-black text-opacity-50 text-ellipsis overflow-hidden">
                                        {{ $product->category }}
                                    </h2>
                                    {{-- product price --}}
                                    <h3
                                        class="text-[10px] md:text-xs ml-auto text-orange-400 font-semibold text-ellipsis overflow-hidden">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}</h3>
                                    {{-- Buy product button --}}
                                    <a href="#" class="ml-auto my-auto"><button
                                            class="bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] rounded-xl text-white px-2 md:px-4 md:py-0.5 text-[10px] md:text-xs">Buy</button></a>
                                </div>
                            </div>
                            {{-- end of card product --}}
                        @endforeach
                    </div>
                </div>
            </div>
            {{-- end of best seller container --}}
        </div>
        {{-- end of category,recent,best seller container --}}
    </div>
    {{-- end of homapege content container --}}



    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const newArrivalContainer = document.getElementById('new-arrival-container');
            const bestSellerContainer = document.getElementById('best-seller-container');

            let isDown = false;
            let startX;
            let scrollLeft;

            newArrivalContainer.addEventListener('mousedown', (e) => {
                isDown = true;
                startX = e.pageX - newArrivalContainer.offsetLeft;
                scrollLeft = newArrivalContainer.scrollLeft;
            });

            newArrivalContainer.addEventListener('mouseleave', () => {
                isDown = false;
            });

            newArrivalContainer.addEventListener('mouseup', () => {
                isDown = false;
            });

            newArrivalContainer.addEventListener('mousemove', (e) => {
                if (!isDown) return;
                e.preventDefault();
                const x = e.pageX - newArrivalContainer.offsetLeft;
                const walk = (x - startX) * 3;
                newArrivalContainer.scrollLeft = scrollLeft - walk;
            });

            bestSellerContainer.addEventListener('mousedown', (e) => {
                isDown = true;
                startX = e.pageX - bestSellerContainer.offsetLeft;
                scrollLeft = bestSellerContainer.scrollLeft;
            });

            bestSellerContainer.addEventListener('mouseleave', () => {
                isDown = false;
            });

            bestSellerContainer.addEventListener('mouseup', () => {
                isDown = false;
            });

            bestSellerContainer.addEventListener('mousemove', (e) => {
                if (!isDown) return;
                e.preventDefault();
                const x = e.pageX - bestSellerContainer.offsetLeft;
                const walk = (x - startX) * 3;
                bestSellerContainer.scrollLeft = scrollLeft - walk;
            });

            // Tombol scroll kanan untuk New Arrival
            window.scrollRight = function() {
                if (isDown) return;
                newArrivalContainer.scrollBy({
                    top: 0,
                    left: 400,
                    behavior: 'smooth'
                });
            }

            window.scrollLeft = function() {
                if (isDown) return;
                newArrivalContainer.scrollBy({
                    top: 0,
                    left: -400,
                    behavior: 'smooth'
                });
            }

            // Tombol scroll kanan untuk Best Seller
            window.scrollRight2 = function() {
                if (isDown) return;
                bestSellerContainer.scrollBy({
                    top: 0,
                    left: 400,
                    behavior: 'smooth'
                });
            }

            window.scrollLeft2 = function() {
                if (isDown) return;
                bestSellerContainer.scrollBy({
                    top: 0,
                    left: -400,
                    behavior: 'smooth'
                });
            }
        });
    </script>
@endsection
