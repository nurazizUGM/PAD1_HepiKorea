@extends('layout.customer')
@section('title', 'home')

<a href=""
    class="fixed flex flex-row bottom-8 right-8 px-2 py-2 text-2xl font-bold text-orange-400 bg-white rounded-3xl align-middle items-center shadow-md hover:shadow-lg z-30">
    <img src="{{ asset('img/assets/icon/icon_customer_chat.svg') }}" alt="icon_Chat" class="w-10 h-10 mr-1">
    <p>Chat</p>
</a>

@section('content')
    {{-- homapege content container --}}
    <div class="w-full w-max[100%] h-full rounded-3xl bg-[#EFEFEF] shadow-lg overflow-hidden">

        {{-- start of carousel --}}
        <div id="default-carousel" class="relative w-full rounded-t-3xl" data-carousel="slide">
            <!-- Carousel wrapper -->
            <div class="relative h-[500px] overflow-hidden rounded-lg">
                <!-- Item 1 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    {{-- <img src="{{ asset('img/assets/bg/background_auth.svg') }}"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="..."> --}}
                    <div class="w-full h-full flex flex-row absolute -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                        <div class="w-1/2 h-full bg-red-200">ini apalah</div>
                        <div class="w-1/2 h-full bg-cover bg-no-repeat bg-center"
                            style="background-image: url('{{ asset('img/assets/bg/background_auth.svg') }}')"></div>
                    </div>
                </div>
                <!-- Item 2 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    {{-- <img src="/docs/images/carousel/carousel-2.svg"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="..."> --}}
                    <div class="w-full h-full flex flex-row absolute -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                        <div class="w-1/2 h-full bg-blue-200">ini apalah</div>
                        <div class="w-1/2 h-full bg-cover bg-no-repeat bg-center"
                            style="background-image: url('{{ asset('img/assets/bg/background_auth.svg') }}')"></div>
                    </div>
                </div>
                <!-- Item 3 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    {{-- <img src="/docs/images/carousel/carousel-3.svg"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="..."> --}}
                    <div class="w-full h-full flex flex-row absolute -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                        <div class="w-1/2 h-full bg-green-200">ini apalah</div>
                        <div class="w-1/2 h-full bg-cover bg-no-repeat bg-center"
                            style="background-image: url('{{ asset('img/assets/bg/background_auth.svg') }}')"></div>
                    </div>
                </div>
                <!-- Item 4 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    {{-- <img src="/docs/images/carousel/carousel-4.svg"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="..."> --}}
                    <div class="w-full h-full flex flex-row absolute -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                        <div class="w-1/2 h-full bg-orange-200">ini apalah</div>
                        <div class="w-1/2 h-full bg-cover bg-no-repeat bg-center"
                            style="background-image: url('{{ asset('img/assets/bg/background_auth.svg') }}')"></div>
                    </div>
                </div>
                <!-- Item 5 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    {{-- <img src="/docs/images/carousel/carousel-5.svg"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="..."> --}}
                    <div class="w-full h-full flex flex-row absolute -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                        <div class="w-1/2 h-full bg-purple-200">ini apalah</div>
                        <div class="w-1/2 h-full bg-cover bg-no-repeat bg-center"
                            style="background-image: url('{{ asset('img/assets/bg/background_auth.svg') }}')"></div>
                    </div>
                </div>
            </div>
            <!-- Slider indicators -->
            <div class="absolute z-30 flex -translate-x-1/2 bottom-4 left-1/2 space-x-3 rtl:space-x-reverse">
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
                class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                data-carousel-prev>
                <span
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 1 1 5l4 4" />
                    </svg>
                    <span class="sr-only">Previous</span>
                </span>
            </button>
            <button type="button"
                class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                data-carousel-next>
                <span
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
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
        <div class="w-full h-full flex flex-col py-10 px-12">
            {{-- category text --}}
            <div class="w-1/5 bg-white rounded-xl text-center py-2 shadow-md">
                <h1 class="text-orange-400 text-lg font-semibold">Category</h1>
            </div>
            {{-- end of category text --}}

            {{-- category container --}}
            <div class="grid grid-cols-4 grid-rows-2 gap-x-32 gap-y-20 mt-14">
                <div class="bg-[#FFFCFC] h-52 flex flex-col text-center align-middle justify-center rounded-xl">
                    <img src="{{ asset('img/assets/icon/icon_homepage_category_fashion.png') }}" alt="fashion_Category"
                        class="w-40 h-40 mx-auto">
                    <h2 class="text-black font-semibold">Fashion</h2>
                </div>
                <div class="bg-[#FFFCFC] h-52 flex flex-col text-center align-middle justify-center rounded-xl">
                    <img src="{{ asset('img/assets/icon/icon_homepage_category_fashion.png') }}" alt="fashion_Category"
                        class="w-40 h-40 mx-auto">
                    <h2 class="text-black font-semibold">Fashion</h2>
                </div>
                <div class="bg-[#FFFCFC] h-52 flex flex-col text-center align-middle justify-center rounded-xl">
                    <img src="{{ asset('img/assets/icon/icon_homepage_category_fashion.png') }}" alt="fashion_Category"
                        class="w-40 h-40 mx-auto">
                    <h2 class="text-black font-semibold">Fashion</h2>
                </div>
                <div class="bg-[#FFFCFC] h-52 flex flex-col text-center align-middle justify-center rounded-xl">
                    <img src="{{ asset('img/assets/icon/icon_homepage_category_fashion.png') }}" alt="fashion_Category"
                        class="w-40 h-40 mx-auto">
                    <h2 class="text-black font-semibold">Fashion</h2>
                </div>

                <div class="bg-[#FFFCFC] h-52 flex flex-col text-center align-middle justify-center rounded-xl">
                    <img src="{{ asset('img/assets/icon/icon_homepage_category_fashion.png') }}" alt="fashion_Category"
                        class="w-40 h-40 mx-auto">
                    <h2 class="text-black font-semibold">Fashion</h2>
                </div>
                <div class="bg-[#FFFCFC] h-52 flex flex-col text-center align-middle justify-center rounded-xl">
                    <img src="{{ asset('img/assets/icon/icon_homepage_category_fashion.png') }}" alt="fashion_Category"
                        class="w-40 h-40 mx-auto">
                    <h2 class="text-black font-semibold">Fashion</h2>
                </div>
                <div class="bg-[#FFFCFC] h-52 flex flex-col text-center align-middle justify-center rounded-xl">
                    <img src="{{ asset('img/assets/icon/icon_homepage_category_fashion.png') }}" alt="fashion_Category"
                        class="w-40 h-40 mx-auto">
                    <h2 class="text-black font-semibold">Fashion</h2>
                </div>
                <div class="bg-[#FFFCFC] h-52 flex flex-col text-center align-middle justify-center rounded-xl">
                    <img src="{{ asset('img/assets/icon/icon_homepage_category_fashion.png') }}" alt="fashion_Category"
                        class="w-40 h-40 mx-auto">
                    <h2 class="text-black font-semibold">Fashion</h2>
                </div>
            </div>
            {{-- end of category container --}}

            {{--  --}}

            {{-- Recenltly update text --}}
            <div class="w-1/5 bg-white rounded-xl text-center py-2 shadow-md mt-14">
                <h1 class="text-orange-400 text-lg font-semibold">Category</h1>
            </div>
            {{-- end of Recenltly update text --}}

            {{-- gray line --}}
            {{-- <hr class="border-b border-black border-opacity-50 mt-5"> --}}

            {{-- recently update container --}}
            <div class="relative mt-10">
                <div class="overflow-x-auto no-scrollbar" id="recently-update-container">
                    <!-- Scroll Right Button -->
                    <button onclick="scrollRight()"
                        class="absolute top-1/2 right-0 transform -translate-y-1/2 z-10 bg-orange-400 bg-opacity-50 hover:bg-opacity-80 text-white rounded-full p-2 shadow-lg">
                        <!-- Icon (optional) -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    <div class="grid grid-flow-col auto-cols-[175px] gap-x-14">
                        @for ($i = 0; $i < 12; $i++)
                            {{-- card product --}}
                            <div class="bg-white h-[240px] flex flex-col rounded-xl overflow-hidden">
                                {{-- image product --}}
                                <div class="w-full h-4/6 bg-cover bg-no-repeat bg-center"
                                    style="background-image: url('{{ asset('img/example/test_blouse.png') }}')"></div>
                                {{-- text product --}}
                                <div class="w-full h-2/6 py-0.5 px-1.5 flex flex-col">
                                    {{-- product title --}}
                                    <h1 class="text-sm font-semibold">Korean Fashion Set</h1>
                                    {{-- product type --}}
                                    <h2 class="text-xs font-semibold text-black text-opacity-50">Blouse</h2>
                                    {{-- product price --}}
                                    <h3 class="text-xs ml-auto text-orange-400 font-semibold">Rp 300.000,-</h3>
                                    {{-- Buy product button --}}
                                    <a href="#" class="ml-auto"><button
                                            class="bg-orange-400 rounded-xl text-white px-4 py-0.5 text-xs">Buy</button></a>
                                </div>
                            </div>
                            {{-- end of card product --}}
                        @endfor
                    </div>
                </div>
            </div>
            {{-- end of recently update container --}}

            {{--  --}}

            {{-- Recenltly update text --}}
            <div class="w-1/5 bg-white rounded-xl text-center py-2 shadow-md mt-14">
                <h1 class="text-[#B7B7B7] text-lg font-semibold">Best Seller</h1>
            </div>
            {{-- end of Recenltly update text --}}

            {{-- gray line --}}
            {{-- <hr class="border-b border-black border-opacity-50 mt-5"> --}}

            {{-- recently update container --}}
            <div class="relative mt-10">
                <div class="overflow-x-auto no-scrollbar" id="best-seller-container">
                    <!-- Scroll Right Button -->
                    <button onclick="scrollRight2()"
                        class="absolute top-1/2 right-0 transform -translate-y-1/2 z-10 bg-orange-400 bg-opacity-50 hover:bg-opacity-80 text-white rounded-full p-2 shadow-lg">
                        <!-- Icon (optional) -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    <div class="grid grid-flow-col auto-cols-[175px] gap-x-14">
                        @for ($i = 0; $i < 12; $i++)
                            {{-- card product --}}
                            <div class="bg-white h-[240px] flex flex-col rounded-xl overflow-hidden">
                                {{-- image product --}}
                                <div class="w-full h-4/6 bg-cover bg-no-repeat bg-center"
                                    style="background-image: url('{{ asset('img/example/test_blouse.png') }}')"></div>
                                {{-- text product --}}
                                <div class="w-full h-2/6 py-0.5 px-1.5 flex flex-col">
                                    {{-- product title --}}
                                    <h1 class="text-sm font-semibold">Korean Fashion Set</h1>
                                    {{-- product type --}}
                                    <h2 class="text-xs font-semibold text-black text-opacity-50">Blouse</h2>
                                    {{-- product price --}}
                                    <h3 class="text-xs ml-auto text-orange-400 font-semibold">Rp 300.000,-</h3>
                                    {{-- Buy product button --}}
                                    <a href="#" class="ml-auto"><button
                                            class="bg-orange-400 rounded-xl text-white px-4 py-0.5 text-xs">Buy</button></a>
                                </div>
                            </div>
                            {{-- end of card product --}}
                        @endfor
                    </div>
                </div>
            </div>
            {{-- end of recently update container --}}
        </div>
        {{-- end of category,recent,best seller container --}}
    </div>
    {{-- end of homapege content container --}}

    

    <script>
        const recentUpdateContainer = document.getElementById('recently-update-container');
        const bestSellerContainer = document.getElementById('best-seller-container');

        // Drag to scroll
        let isDown = false;
        let startX;
        let scrollLeft;

        recentUpdateContainer.addEventListener('mousedown', (e) => {
            isDown = true;
            startX = e.pageX - recentUpdateContainer.offsetLeft;
            scrollLeft = recentUpdateContainer.scrollLeft;
        });

        bestSellerContainer.addEventListener('mousedown', (e) => {
            isDown = true;
            startX = e.pageX - bestSellerContainer.offsetLeft;
            scrollLeft = bestSellerContainer.scrollLeft;
        });

        recentUpdateContainer.addEventListener('mouseleave', () => isDown = false);
        recentUpdateContainer.addEventListener('mouseup', () => isDown = false);

        bestSellerContainer.addEventListener('mouseleave', () => isDown = false);
        bestSellerContainer.addEventListener('mouseup', () => isDown = false);

        recentUpdateContainer.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - recentUpdateContainer.offsetLeft;
            const walk = (x - startX) * 3; // scroll-fast
            recentUpdateContainer.scrollLeft = scrollLeft - walk;
        });

        bestSellerContainer.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - bestSellerContainer.offsetLeft;
            const walk = (x - startX) * 3; // scroll-fast
            bestSellerContainer.scrollLeft = scrollLeft - walk;
        });

        // Button to scroll right
        function scrollRight() {
            recentUpdateContainer.scrollBy({
                top: 0,
                left: 200, // Adjust as needed
                behavior: 'smooth'
            });
        }

        function scrollRight2() {
            bestSellerContainer.scrollBy({
                top: 0,
                left: 200, // Adjust as needed
                behavior: 'smooth'
            });
        }
    </script>

@endsection
