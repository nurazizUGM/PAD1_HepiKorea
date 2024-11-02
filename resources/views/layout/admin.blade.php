@php
    $user = Auth::user();
    if (request()->routeIs('admin.dashboard')) {
        $route = 'dashboard';
    } elseif (
        request()->routeIs('admin.product.*') ||
        request()->routeIs('admin.category.*') ||
        request()->routeIs('admin.carousel.*')
    ) {
        $route = 'product';
    } elseif (request()->routeIs('admin.order.*')) {
        $route = 'order';
    } elseif (request()->routeIs('admin.analytics.*')) {
        $route = 'analytics';
    } elseif (request()->routeIs('admin.customer.*')) {
        $route = 'customer';
    } elseif (request()->routeIs('admin.faq.*')) {
        $route = 'faq';
    }

    if (!isset($route)) {
        $route = '';
    }
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <title>{{ config()->get('app.name') }} - Admin @yield('title')</title>
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex font-poppins w-screen h-screen overflow-hidden">
    <!-- nav antara pakai shadow atau engga -->
    <nav
        class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 shadow-sm">
        <div class="px-5 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
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
                <div class="flex items-center">
                    <div class="flex items-center ms-3">
                        <div>
                            <button type="button"
                                class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                                aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                <span class="sr-only">Open user menu</span>
                                <img class="w-8 h-8 rounded-full"
                                    src="{{ $user->photo ? asset('storage/profile/' . $user->photo) : asset('img/assets/icon/icon_user2.png') }}"
                                    alt="user photo">
                            </button>
                        </div>
                        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600 rounded-xl"
                            id="dropdown-user">
                            <div class="px-4 py-3" role="none">
                                <p class="text-sm text-gray-900 dark:text-white" role="none">
                                    {{ $user->fullname }}
                                </p>
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                    {{ $user->email }}
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
            </div>
        </div>
    </nav>

    <!-- start of sidebar -->
    <aside id="default-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
        aria-label="Sidebar">
        <div class="h-full flex flex-col pl-7 pr-2 py-4 overflow-y-auto bg-white dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <!-- Dashboard -->
                <li class="mt-12">
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center p-2 rounded-lg dark:text-white @if ($route == 'dashboard') bg-gray-100 @endif hover:bg-gray-100 active:bg-white dark:hover:bg-gray-700 group">
                        <img src="{{ asset('img/assets/icon/icon_dashboard_admin.svg') }}" alt="dashboard Icon"
                            class="h-7 w-7 @if ($route != 'dashboard') grayscale @endif group-hover:grayscale-0">
                        <span
                            class="ms-3 @if ($route == 'dashboard') text-orange-400 @else text-[#B7B7B7] @endif  group-hover:text-orange-400">Dashboard</span>
                    </a>
                </li>
                <!-- Product -->
                <li>
                    <a href="{{ route('admin.product.index') }}"
                        class="flex items-center ms-0.5 p-2 rounded-lg dark:text-white @if ($route == 'product') bg-gray-100 @endif hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <img src="{{ asset('img/assets/icon/icon_dashboard_product.svg') }}" alt="product Icon"
                            class="h-6 w-6 @if ($route != 'product') grayscale @endif group-hover:grayscale-0">
                        <span
                            class="flex-1 ms-4 whitespace-nowrap @if ($route == 'product') text-orange-400 @else text-[#B7B7B7] @endif group-hover:text-orange-400">Product</span>
                    </a>
                </li>
                <!-- Order -->
                <li>
                    <a href="#"
                        class="flex items-center p-2 rounded-lg dark:text-white @if ($route == 'order') bg-gray-100 @endif hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <img src="{{ asset('img/assets/icon/icon_dashboard_order.svg') }}" alt="product Icon"
                            class="h-7 w-7 @if ($route != 'order') grayscale @endif group-hover:grayscale-0">
                        <span
                            class="flex-1 ms-3 whitespace-nowrap @if ($route == 'order') text-orange-400 @else text-[#B7B7B7] @endif group-hover:text-orange-400">Order</span>
                    </a>
                </li>
                <!-- Analytic -->
                <li>
                    <a href="#"
                        class="flex items-center p-2 rounded-lg dark:text-white @if ($route == 'analytic') bg-gray-100 @endif hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <img src="{{ asset('img/assets/icon/icon_dashboard_analytic.svg') }}" alt="product Icon"
                            class="h-7 w-7 @if ($route != 'analytic') grayscale @endif group-hover:grayscale-0">
                        <span
                            class="flex-1 ms-2.5 whitespace-nowrap @if ($route == 'analytic') text-orange-400 @else text-[#B7B7B7] @endif group-hover:text-orange-400">Analytic</span>
                    </a>
                </li>
                <!-- Customer -->
                <li>
                    <a href="#"
                        class="flex items-center p-2 rounded-lg dark:text-white @if ($route == 'customer') bg-gray-100 @endif hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <img src="{{ asset('img/assets/icon/icon_dashboard_customer.svg') }}" alt="product Icon"
                            class="h-7 w-7 scale-90 @if ($route != 'customer') grayscale @endif group-hover:grayscale-0">
                        <span
                            class="flex-1 ms-3 whitespace-nowrap @if ($route == 'customer') text-orange-400 @else text-[#B7B7B7] @endif group-hover:text-orange-400">Customer</span>
                    </a>
                </li>
                <!-- FAQ -->
                <li>
                    <a href="#"
                        class="flex items-center p-2 rounded-lg dark:text-white @if ($route == 'faq') bg-gray-100 @endif hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <img src="{{ asset('img/assets/icon/icon_dashboard_faq.svg') }}" alt="product Icon"
                            class="h-7 w-7 scale-90 @if ($route != 'faq') grayscale @endif group-hover:grayscale-0">
                        <span
                            class="flex-1 ms-3 whitespace-nowrap @if ($route == 'faq') text-orange-400 @else text-[#B7B7B7] @endif group-hover:text-orange-400">FAQ</span>
                    </a>
                </li>
            </ul>
            <!-- Logout -->
            <ul class="space-y-2 font-medium mt-auto">
                <li>
                    <a href="{{ route('auth.logout') }}"
                        class="flex items-center p-2 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <img src="{{ asset('img/assets/icon/icon_dashboard_logout.svg') }}" alt="Logout Icon"
                            class="h-7 w-7 scale-90 grayscale group-hover:grayscale-0">
                        <span class="flex-1 ms-3 whitespace-nowrap text-black group-hover:text-[#FF0000]">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
    <!-- end of sidebar -->


    <!-- container (di sebelah aside dan dibawah navbar) -->
    <div class="p-4 ml-0 sm:ml-64 mt-14 mr-0 mb-0 w-full">
        @yield('content')
    </div>

    @yield('script')
    @if (config()->get('app.env') == 'local')
        <script>
            @if ($errors->any())
                $(document).ready(function() {
                    @foreach ($errors->all() as $error)
                        alert('{{ $error }}');
                    @endforeach
                });
            @endif
            @if ($message = Session::get('message'))
                $(document).ready(function() {
                    alert('{{ $message }}');
                });
            @endif
            @if ($message = Session::get('success'))
                $(document).ready(function() {
                    alert('{{ $message }}');
                });
            @endif
        </script>
    @endif
</body>

</html>
