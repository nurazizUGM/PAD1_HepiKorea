<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-poppins w-screen h-screen overflow-y-auto overflow-x-hidden no-scrollbar">
    {{-- start of navbar --}}
    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 shadow-lg">
        <div class="px-5 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                {{--  --}}
                <div class="flex items-center justify-start rtl:justify-end">
                    <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar"
                        aria-controls="default-sidebar" type="button"
                        class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                            </path>
                        </svg>
                    </button>
                    <!-- title navbar -->
                    <a href="#" class="flex ms-6 md:me-24">
                        <span
                            class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white"><span
                                class="text-orange-400">Hepi</span>Korea</span>
                    </a>
                </div>
                {{-- search bar --}}
                <div class="mr-auto">
                    <!-- Search input -->
                    <form id="form-filter" action="{{ route('admin.product.index') }}" method="get"
                        class="flex items-center">
                        <input type="hidden" name="category" value="{{ request()->query('category') }}">
                        <div class="relative flex items-center w-full">
                            <img src="{{ asset('img/assets/icon/icon_admin_search_searchbar.svg') }}" alt="search icon"
                                class="absolute left-3 w-5 h-5 text-gray-500">
                            <input type="text" id="search" name="search" value="{{ request()->query('search') }}"
                                class="block w-[30vw] pl-10 py-2 text-gray-900 bg-[#EFEFEF] border border-[#EFEFEF] rounded-full focus:ring-0 focus:border-none placeholder:text-sm placeholder:text-start placeholder:text-[#898383]"
                                placeholder="Search...">
                        </div>

                        <!-- Filter button -->
                        {{-- <button type="submit"
                            class="inline-flex items-center px-4 py-2 font-semibold text-white bg-orange-400 hover:bg-orange-500 rounded-full -ml-20 z-10">
                            <img class="w-4 h-4 mr-2"
                                style="filter: brightness(0) saturate(100%) invert(100%) sepia(100%) saturate(1%) hue-rotate(266deg) brightness(107%) contrast(101%);"
                                src="{{ asset('img/assets/icon/icon_admin_search_searchbar.svg') }}" alt="">
                            Search
                        </button> --}}
                    </form>
                </div>
                {{-- end of search bar --}}
                {{-- navigation link content --}}
                <div class="flex items-center gap-x-14 justify-around mx-auto">
                    {{-- product nav link --}}
                    <a href=""><span
                            class="font-semibold text-[#B7B7B7] hover:text-orange-400 text-lg">Product</span></a>
                    {{-- request order nav link --}}
                    <a href=""><span class="font-semibold text-[#B7B7B7] hover:text-orange-400 text-lg">Request
                            Order</span></a>
                    {{-- confirmed nav link --}}
                    <a href=""><span
                            class="font-semibold text-[#B7B7B7] hover:text-orange-400 text-lg">Confirmed</span></a>
                    {{-- FAQ nav link --}}
                    <a href=""><span
                            class="font-semibold text-[#B7B7B7] hover:text-orange-400 text-lg">FAQ</span></a>
                </div>
                {{-- end of navigation link content --}}
                {{--  --}}

                {{-- cart and notification container --}}
                <div class="flex gap-x-5 items-center justify justify-around ml-auto mr-5 align-middle">
                    <a href="">
                        {{-- cart icon --}}
                        <img src="{{ asset('img/assets/icon/icon_dashboard_order.svg') }}" alt=""
                            class="w-5 h-5">
                    </a>
                    <a href="" class="relative">
                        {{-- notification icon --}}
                        <img src="{{ asset('img/assets/icon/icon_customer_notification.svg') }}" alt=""
                            class="w-4 h-5">
                        {{-- notification dot --}}
                        <div class="absolute bg-[#FF2E00] text-transparent rounded-full w-1.5 h-1.5 top-0 right-0">.</div>
                    </a>
                </div>
                {{-- end of cart and notification container --}}

                {{--  --}}
                <div class="flex items-center">
                    <div class="flex items-center ms-3">
                        <div>
                            <button type="button"
                                class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                                aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                <span class="sr-only">Open user menu</span>
                                <img class="w-8 h-8 rounded-full"
                                    src="{{ asset('img/example/admin_order_img_user.png') }}" alt="user photo">
                            </button>
                        </div>
                        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600 rounded-xl"
                            id="dropdown-user">
                            <div class="px-4 py-3" role="none">
                                <p class="text-sm text-gray-900 dark:text-white" role="none">
                                    namenamename
                                </p>
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                    emailemail@gmail.com
                                </p>
                            </div>
                            <ul class="py-1" role="none">
                                <li>
                                    <a href="{{ route('admin.profile.user') }}"
                                        class="block px-4 py-2 text-sm text-[#B7B7B7] hover:text-orange-400 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Profile</a>
                                    <a href="{{ route('admin.profile.setting') }}"
                                        class="block px-4 py-2 text-sm text-[#B7B7B7] hover:text-orange-400 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Business Preference</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                {{--  --}}
            </div>
        </div>
    </nav>
    {{-- end of navbar --}}

    {{-- container --}}
    <div class="w-[92%] w-max[92%] h-fit mx-auto mt-32 mb-20 overflow-hidden">
        @yield('content')
    </div>
    {{-- end of container --}}

    {{-- footer --}}
    <div
        class="w-[92%] w-max[92%] h-fit mx-auto mt-14 mb-14 rounded-3xl overflow-hidden bg-black text-white pt-10 pb-14 px-12 flex flex-row">
        <div class="w-[25%] h-full flex flex-col">
            {{-- HepiKorea title --}}
            <h1 class="text-4xl font-bold">HepiKorea</h1>
            <p class="text-base font-medium mt-1">Get us more on</p>
            {{-- icons container --}}
            <div class="flex flex-row mt-8 align-middle gap-x-4">
                <a href=""><img src="{{ asset('img/assets/icon/icon_footer_insta.svg') }}" alt=""
                        class="w-11 h-11"></a>
                <a href=""><img src="{{ asset('img/assets/icon/icon_footer_gmail.svg') }}" alt=""
                        class="w-11 h-11"></a>
                <a href=""><img src="{{ asset('img/assets/icon/icon_footer_wa.svg') }}" alt=""
                        class="w-11 h-11"></a>
                <a href=""><img src="{{ asset('img/assets/icon/icon_footer_line.svg') }}" alt=""
                        class="w-9 h-11"></a>
            </div>
        </div>
        <div class="w-[50%] h-full flex flex-col pr-4 align-top">
            <h1 class="text-lg font-medium mb-4">ABOUT</h1>
            <p class="text-justify font-medium text-base">Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                Facilis, necessitatibus nisi. Possimus incidunt aut
                suscipit saepe accusantium, voluptas aperiam distinctio ratione nisi deleniti quis, dolorem, necessitatibus
                officiis. Totam, obcaecati praesentium.</p>
        </div>
        <div class="w-[25%] w-max-[25%] h-full flex flex-col flex-wrap pl-8">
            <h1 class="text-lg font-medium mb-4">CONTACT</h1>
            <p class="text-justify font-medium text-base">Phone : +63 883-8282-9929</p>
            <p class="text-justify font-medium text-base">Email : emaileamilan@mail.com</p>
            <p class="text-justify font-medium text-base">Address : dpajwohawipgagbyfidbiw</p>
        </div>
    </div>
    {{-- end of footer --}}

    <p class="text-center">&copy; 2024 HepiKorea. All rights reserved</p>

</body>

</html>
