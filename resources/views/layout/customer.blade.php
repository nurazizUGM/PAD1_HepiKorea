<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> {{ config('app.name') }} @yield('title')</title>
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
    <nav class="fixed top-0 z-40 w-full h-fit bg-white border-b border-gray-200 shadow-lg">
        <div class="px-5 py-3 lg:px-5 lg:pl-3">
            <div class="flex flex-col md:flex-row gap-y-5 items-center justify-between align-middle">
                {{--  --}}
                <div class="w-full md:w-fit flex justify-between rtl:justify-end">
                    <!-- title navbar -->
                    <a href="{{ route('home') }}" class="flex ms-6 md:me-24">
                        <span
                            class="self-center text-xl text-orange-400 font-semibold sm:text-2xl whitespace-nowrap"><span
                                class="text-[#3E6E7A]">Hepi</span>Korea</span>
                    </a>
                    {{-- burger toggle navbar (mobile) --}}
                    <button id="burger" type="button"
                        class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 ">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                            </path>
                        </svg>
                    </button>
                </div>
                {{-- search bar --}}
                <div class="mx-auto md:mr-auto hidden md:flex" id="searchbar-container">
                    <!-- Search input -->
                    <form id="form-filter" action="{{ route('product.index') }}" method="get"
                        class="flex items-center my-auto">
                        <input type="hidden" name="category" value="{{ request()->query('category') }}">
                        <input type="hidden" name="sort_by" value="{{ request()->query('sort_by') }}">
                        <div class="relative flex items-center w-full">
                            <img src="{{ asset('img/assets/icon/icon_admin_search_searchbar.svg') }}" alt="search icon"
                                class="absolute left-3 w-5 h-5 text-gray-500">
                            <input type="text" id="search" name="search" value="{{ request()->query('search') }}"
                                class="block w-[60vw] md:w-[30vw] pl-10 py-2 text-gray-900 bg-[#EFEFEF] border border-[#EFEFEF] rounded-full focus:ring-0 focus:border-none placeholder:text-sm placeholder:text-start placeholder:text-[#898383]"
                                placeholder="Search...">
                        </div>

                    </form>
                </div>
                {{-- end of search bar --}}
                {{-- navigation link content --}}
                <div class="hidden md:flex flex-col md:flex-row items-center gap-y-6 md:gap-y-0 gap-x-14 justify-around mx-auto"
                    id="navlink-container">
                    {{-- product nav link --}}
                    <a href="{{ route('product.index') }}"><span
                            class="font-semibold text-[#3E6E7A] hover:text-orange-400 text-lg">Product</span></a>
                    {{-- request order nav link --}}
                    <a href="{{ route('request-order') }}"><span
                            class="font-semibold text-[#3E6E7A] hover:text-orange-400 text-lg">Request
                            Order</span></a>
                    {{-- confirmed nav link --}}
                    <a href="#"><span
                            class="font-semibold text-[#3E6E7A] hover:text-orange-400 text-lg">Confirmed</span></a>
                    {{-- FAQ nav link --}}
                    <a href="{{ route('faq') }}"><span
                            class="font-semibold text-[#3E6E7A] hover:text-orange-400 text-lg">FAQ</span></a>
                </div>
                {{-- end of navigation link content --}}
                {{--  --}}

                {{-- cart and notification container --}}
                <div class="hidden md:flex gap-x-5 items-center justify justify-around mx-auto md:ml-auto md:mr-5 align-middle"
                    id="notif-cart-container">
                    <a href="{{ route('cart.index') }}">
                        {{-- cart icon --}}
                        <img src="{{ asset('img/assets/icon/icon_dashboard_order.svg') }}" alt=""
                            class="w-5 h-5">
                    </a>
                    @if (auth()->check())
                        @php
                            $notifications = auth()->user()->notifications->where('is_read', false);
                            $notificationCount = $notifications->count();
                            $notifications = $notifications->sortByDesc('created_at')->take(5);
                        @endphp
                        <a href="#" class="relative" aria-expanded="false"
                            data-dropdown-toggle="dropdown-notification">
                            {{-- notification icon --}}
                            <img src="{{ asset('img/assets/icon/icon_customer_notification_green.svg') }}"
                                alt="" class="w-4 h-5">

                            {{-- notification dot --}}
                            @if ($notificationCount > 0)
                                <span
                                    class="absolute top-[-2px] right-[-2px] w-3 h-3 text-xs text-center font-bold leading-none text-white bg-[#FF2E00] rounded-full">{{ $notificationCount }}</span>
                                {{-- <div class="absolute bg-[#FF2E00] text-transparent rounded-full w-1.5 h-1.5 top-0 right-0">.
                                    </div> --}}
                            @endif
                        </a>
                        @if ($notificationCount > 0)
                            <div class="w-[30rem] z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600 rounded-xl px-3"
                                id="dropdown-notification">
                                <div class="px-4 py-3" role="none">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white" role="none">
                                        Notifications
                                    </p>
                                </div>
                                <ul class="py-1" role="none">
                                    <li>
                                        @foreach ($notifications as $notification)
                                            <a href=""
                                                class="block px-4 py-2 text-sm text-[#B7B7B7] hover:text-orange-400 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                                role="menuitem">{{ $notification->title }}</a>
                                        @endforeach
                                        <a href="{{ route('auth.notification') }}"
                                            class="block text-center px-4 py-2 text-sm text-orange-400 hover:text-orange-500 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                            role="menuitem">View all</a>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    @endif
                </div>
                {{-- end of cart and notification container --}}

                @if (auth()->check() && auth()->user()->role != \App\Enums\Role::GUEST)
                    <div class="hidden md:flex items-center" id="user-profile-container">
                        <div class="flex items-center ms-3">
                            <div>
                                @php
                                    $photo = auth()->user()->photo;
                                    $photo = $photo ? Storage::url($photo) : 'img/example/admin_order_img_user.png';
                                @endphp
                                <button type="button"
                                    class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                                    aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                    <span class="sr-only">Profile</span>
                                    <img class="w-8 h-8 rounded-full" src="{{ $photo }}" alt="user photo">
                                </button>
                            </div>
                            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600 rounded-xl"
                                id="dropdown-user">
                                <ul class="py-1" role="none">
                                    <li>
                                        @if (auth()->user()->role == \App\Enums\Role::ADMIN)
                                            <a href="{{ route('admin.dashboard') }}"
                                                class="flex flex-row items-center px-4 py-2 text-lg font-semibold text-[#B7B7B7] hover:bg-gray-100 group"
                                                role="menuitem">
                                                <img src="{{ asset('img/assets/icon/icon_dashboard_admin.svg') }}"
                                                    alt="" class="w-5 h-5 grayscale group-hover:grayscale-0">
                                                <p class="ml-2 group-hover:text-orange-400">Admin Dashboard</p>
                                            </a>
                                        @else
                                            <a href="{{ route('auth.profile') }}"
                                                class="flex flex-row items-center px-4 py-2 text-lg font-semibold text-[#B7B7B7] hover:bg-gray-100 group"
                                                role="menuitem">
                                                <img src="{{ asset('img/assets/icon/icon_dashboard_customer.svg') }}"
                                                    alt="" class="w-5 h-5 grayscale group-hover:grayscale-0">
                                                <p class="ml-2 group-hover:text-orange-400">Profile</p>
                                            </a>
                                            <a href="{{ route('auth.address') }}"
                                                class="flex flex-row items-center px-4 py-2 text-lg font-semibold text-[#B7B7B7] hover:bg-gray-100 group"
                                                role="menuitem">
                                                <img src="{{ asset('img/assets/icon/icon_address.svg') }}"
                                                    alt="" class="w-5 h-5 grayscale group-hover:grayscale-0">
                                                <p class="ml-2 group-hover:text-orange-400">Address</p>
                                            </a>
                                            <a href="{{ route('order.history') }}"
                                                class="flex flex-row items-center px-4 py-2 text-lg font-semibold text-[#B7B7B7] hover:bg-gray-100 group"
                                                role="menuitem">
                                                <img src="{{ asset('img/assets/icon/icon_history.svg') }}"
                                                    alt="" class="w-5 h-5 grayscale group-hover:grayscale-0">
                                                <p class="ml-2 group-hover:text-orange-400">History</p>
                                            </a>
                                        @endif
                                        <a href="{{ route('auth.logout') }}"
                                            class="flex flex-row items-center px-5 py-2 text-lg font-semibold text-[#B7B7B7] hover:bg-gray-100 group"
                                            role="menuitem">
                                            <img src="{{ asset('img/assets/icon/icon_dashboard_logout.svg') }}"
                                                alt="" class="w-5 h-5 grayscale group-hover:grayscale-0">
                                            <p class="ml-2 group-hover:text-[#FF0000]">Logout</p>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @else
                    <a type="button" href="{{ route('auth.login') }}"
                        class="hidden flex md:flex cursor-pointer text-white bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] focus:outline-none focus:ring-0 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2"
                        id="login-container">Login</a>
                @endif
            </div>
        </div>
    </nav>
    {{-- end of navbar --}}

    {{-- container --}}
    <div class="w-[92%] w-max[92%] h-fit mx-auto mt-20 md:mt-32 mb-20 overflow-hidden no-scrollbar">
        @yield('content')
    </div>
    {{-- end of container --}}

    @yield('footer', View::make('layout.footer'))

    @if (config('app.debug'))
        <div class="absolute top-24 right-8 z-60">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div id="alert-2"
                        class="z-[51] flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                        role="alert">
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="ms-3 text-sm font-medium">
                            {{ $error }}
                        </div>
                        <button type="button"
                            class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                            data-dismiss-target="#alert-2" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                @endforeach
            @endif
            @if ($message = Session::get('message') ?? Session::get('success'))
                <div id="alert-1"
                    class="z-[51] flex items-center p-4 mb-4 text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                    role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div class="ms-3 text-sm font-medium">
                        {{ $message }}
                    </div>
                    <button type="button"
                        class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700"
                        data-dismiss-target="#alert-1" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            @endif
        </div>
    @endif
    @yield('script')
    @stack('script')
    <script>
        // NAVBAR hide and show when in small screen
        const burger = document.getElementById('burger');
        const navlinkContainer = document.getElementById('navlink-container');
        const searchBar = document.getElementById('searchbar-container');
        const notifCart = document.getElementById('notif-cart-container');
        const userProfile = document.getElementById("user-profile-container");
        const login = document.getElementById("login-container");


        burger.addEventListener('click', () => {
            navlinkContainer.classList.toggle('hidden')
            navlinkContainer.classList.toggle('flex')

            searchBar.classList.toggle('hidden')
            searchBar.classList.toggle('flex')

            notifCart.classList.toggle('hidden')
            notifCart.classList.toggle('flex')

            userProfile.classList.toggle('hidden')
            userProfile.classList.toggle('flex')

            login.classList.toggle('hidden')
            login.classList.toggle('flex')
        })
    </script>
</body>

</html>
