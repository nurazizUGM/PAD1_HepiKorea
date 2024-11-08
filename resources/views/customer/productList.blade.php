@extends('layout.customer')
@section('title', 'home')

<a href=""
    class="fixed flex flex-row bottom-8 right-8 px-2 py-2 text-2xl font-bold text-orange-400 bg-white rounded-3xl align-middle items-center shadow-md hover:shadow-lg z-30">
    <img src="{{ asset('img/assets/icon/icon_customer_chat.svg') }}" alt="icon_Chat" class="w-10 h-10 mr-1">
    <p>Chat</p>
</a>

@section('content')
    <div class="w-full w-max[100%] h-full rounded-3xl bg-[#EFEFEF] shadow-lg overflow-hidden py-10 px-14">
        {{-- sorting and filter container --}}
        <div class="w-full flex flex-row mb-5">
            {{-- dropdown category --}}
            <button id="dropdownCategoryButton" data-dropdown-toggle="dropdownCategory"
                class="text-orange-400 bg-white focus:ring-0 focus:outline-none flex justify-between rounded-xl text-base px-6 py-2.5 text-center font-semibold items-center"
                type="button">
                <span class="text-left">Category</span>
                <svg class="w-2.5 h-2.5 ml-10 text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </button>

            <!-- Dropdown menu -->
            <div id="dropdownCategory"
                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownCategoryButton">
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Food</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Music</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Health</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">p</a>
                    </li>
                </ul>
            </div>
            {{-- end of dropdown category --}}

            {{-- min and max price sorting container --}}
            <form action="" class="flex flex-row ml-10 w-fit h-full my-auto gap-6">
                {{-- Minimum price sorting --}}
                <input type="text" placeholder="Rp min"
                    class="rounded-2xl bg-gray-300 border-none focus:border-0 focus:ring-0">
                {{-- end of Minimum price sorting --}}
                <input type="text" placeholder="Rp max"
                    class="rounded-2xl bg-gray-300 border-none focus:border-0 focus:ring-0">
            </form>
            {{-- end of min and max price sorting container --}}

            {{-- sort by dropdown --}}
            <button id="dropdownSortByButton" data-dropdown-toggle="dropdownSortBy"
                class="text-orange-400 bg-white focus:ring-0 focus:outline-none flex justify-between rounded-xl text-base pr-6 px-10 py-2.5 text-center font-semibold items-center ml-auto"
                type="button">
                <span class="text-left">Sort by</span>
                <svg class="w-2.5 h-2.5 ml-14 text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </button>

            <!-- Dropdown menu -->
            <div id="dropdownSortBy"
                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownSortByButton">
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Higghest Price</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Lowest Price</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Most Ordered</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">p</a>
                    </li>
                </ul>
            </div>
            {{-- end of sort by dropdown --}}

        </div>
        {{-- end of sorting and filter container --}}

        {{-- products card container --}}
        <div class="w-full h-full grid grid-cols-[repeat(auto-fit,_minmax(150px,_1fr))] gap-x-6 gap-y-12">
            @for ($i = 0; $i < 30; $i++)
                {{-- card product --}}
                <div class="bg-white h-[235px] flex flex-col rounded-xl overflow-hidden">
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
                                class="bg-orange-400 hover:bg-orange-500 active:bg-orange-600 rounded-xl text-white px-4 py-0.5 text-xs">Buy</button></a>
                    </div>
                </div>
                {{-- end of card product --}}
            @endfor
        </div>
        {{-- end of products card container --}}
    </div>
@endsection
