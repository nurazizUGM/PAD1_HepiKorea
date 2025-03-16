<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import { route } from 'ziggy-js';

const props = defineProps({
    title: String,
    user: Object,
});

const profilePicture = computed(() => props?.user?.photo?.startsWith('http') ? props.user.photo : `/${props?.user?.photo}`);
</script>

<template>

    <Head>
        <title>Admin{{ props.title ? ` - ${props.title}` : '' }}</title>
        <meta name="description" content="This is the authentication page." />
    </Head>
    <nav
        class="fixed top-0 z-[39] w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 shadow-sm">
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
                    <Link href="/" class="flex ms-6 md:me-24">
                    <span
                        class="self-center text-[#376F7E] text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white"><span
                            class="text-orange-400">Hepi</span>Korea</span>
                    </Link>
                </div>
                <div class="flex items-center">
                    <div class="flex items-center ms-3">
                        <div>
                            <button type="button"
                                class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                                aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                <span class="sr-only">Open user menu</span>
                                <img class="w-8 h-8 rounded-full" :src="profilePicture" alt="user photo">
                            </button>
                        </div>
                        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600 rounded-xl"
                            id="dropdown-user">
                            <div class="px-4 py-3" role="none">
                                <p class="text-sm text-gray-900 dark:text-white" role="none">
                                    {{ props.user.fullname }}
                                </p>
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                    {{ props.user.email }}
                                </p>
                            </div>
                            <ul class="py-1" role="none">
                                <li>
                                    <Link href="/admin/profile"
                                        class="block px-4 py-2 text-sm text-[#B7B7B7] hover:text-orange-400 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Profile</Link>
                                    <Link href="/admin/settings"
                                        class="block px-4 py-2 text-sm text-[#B7B7B7] hover:text-orange-400 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Business Preference</Link>
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
        class="fixed top-0 left-0 z-[38] w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
        aria-label="Sidebar">
        <div class="h-full flex flex-col pl-7 pr-2 py-4 overflow-y-auto bg-white dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <!-- Dashboard -->
                <li class="mt-12">
                    <Link href="/admin"
                        :class="`flex items-center p-2 rounded-lg font-semibold dark:text-white hover:bg-gray-100 active:bg-white dark:hover:bg-gray-700 group ${route().current('dashboard') && 'bg-gray-100'}`">
                    <img src="/img/assets/icon/icon_dashboard_admin.svg" alt="Dashboard Icon"
                        :class="`h-7 w-7 ${!route().current('dashboard') && 'grayscale'} group-hover:grayscale-0`">
                    <span
                        :class="`ms-3 group-hover:text-[#376F7E] ${route().current('dashboard') ? 'text-[#376F7E]' : 'text-[#B7B7B7]'}`">Dashboard</span>
                    </Link>
                </li>
                <!-- Product -->
                <li class="mt-12">
                    <Link href="/admin/product"
                        :class="`flex items-center p-2 rounded-lg font-semibold dark:text-white hover:bg-gray-100 active:bg-white dark:hover:bg-gray-700 group ${route().current('product.*') && 'bg-gray-100'}`">
                    <img src="/img/assets/icon/icon_dashboard_product.svg" alt="Product Icon"
                        :class="`h-7 w-7 ${!route().current('product.*') && 'grayscale'} group-hover:grayscale-0`">
                    <span
                        :class="`ms-3 group-hover:text-[#376F7E] ${route().current('product.*') ? 'text-[#376F7E]' : 'text-[#B7B7B7]'}`">Product</span>
                    </Link>
                </li>
                <!-- order -->
                <li class="mt-12">
                    <Link href="/admin/order"
                        :class="`flex items-center p-2 rounded-lg font-semibold dark:text-white hover:bg-gray-100 active:bg-white dark:hover:bg-gray-700 group ${route().current('order.*') && 'bg-gray-100'}`">
                    <img src="/img/assets/icon/icon_dashboard_order.svg" alt="Order Icon"
                        :class="`h-7 w-7 ${!route().current('order.*') && 'grayscale'} group-hover:grayscale-0`">
                    <span
                        :class="`ms-3 group-hover:text-[#376F7E] ${route().current('order.*') ? 'text-[#376F7E]' : 'text-[#B7B7B7]'}`">Order</span>
                    </Link>
                </li>
                <!-- Analytic -->
                <li class="mt-12">
                    <Link href="/admin/analytic"
                        :class="`flex items-center p-2 rounded-lg font-semibold dark:text-white hover:bg-gray-100 active:bg-white dark:hover:bg-gray-700 group ${route().current('analytic.*') && 'bg-gray-100'}`">
                    <img src="/img/assets/icon/icon_dashboard_analytic.svg" alt="Analytic Icon"
                        :class="`h-7 w-7 ${!route().current('analytic.*') && 'grayscale'} group-hover:grayscale-0`">
                    <span
                        :class="`ms-3 group-hover:text-[#376F7E] ${route().current('analytic.*') ? 'text-[#376F7E]' : 'text-[#B7B7B7]'}`">Analytic</span>
                    </Link>
                </li>
                <!-- Customer -->
                <li class="mt-12">
                    <Link href="/admin/customer"
                        :class="`flex items-center p-2 rounded-lg font-semibold dark:text-white hover:bg-gray-100 active:bg-white dark:hover:bg-gray-700 group ${route().current('customer.*') && 'bg-gray-100'}`">
                    <img src="/img/assets/icon/icon_dashboard_customer.svg" alt="Customer Icon"
                        :class="`h-7 w-7 ${!route().current('customer.*') && 'grayscale'} group-hover:grayscale-0`">
                    <span
                        :class="`ms-3 group-hover:text-[#376F7E] ${route().current('customer.*') ? 'text-[#376F7E]' : 'text-[#B7B7B7]'}`">Customer</span>
                    </Link>
                </li>
                <!-- FAQ -->
                <li class="mt-12">
                    <Link href="/admin/faq"
                        :class="`flex items-center p-2 rounded-lg font-semibold dark:text-white hover:bg-gray-100 active:bg-white dark:hover:bg-gray-700 group ${route().current('faq.*') && 'bg-gray-100'}`">
                    <img src="/img/assets/icon/icon_dashboard_faq.svg" alt="FAQ Icon"
                        :class="`h-7 w-7 ${!route().current('faq.*') && 'grayscale'} group-hover:grayscale-0`">
                    <span
                        :class="`ms-3 group-hover:text-[#376F7E] ${route().current('faq.*') ? 'text-[#376F7E]' : 'text-[#B7B7B7]'}`">FAQ</span>
                    </Link>
                </li>
            </ul>
            <!-- Logout -->
            <ul class="space-y-2 font-medium mt-auto">
                <li>
                    <a href="/auth/logout"
                        class="flex items-center p-2 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <img src="/img/assets/icon/icon_dashboard_logout.svg" alt="Logout Icon"
                            class="h-7 w-7 scale-90 grayscale group-hover:grayscale-0">
                        <span class="flex-1 ms-3 whitespace-nowrap text-black group-hover:text-[#FF0000]">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
    <!-- end of sidebar -->


    <!-- container (di sebelah aside dan dibawah navbar) -->
    <div class="p-4 ml-0 sm:ml-64 mt-14 mr-0 mb-0 w-full relative">
        <slot />

        <!-- <div id="alert-2"
                class="absolute top-8 right-8 z-[51] flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
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
            </div> -->
        <!-- <div id="alert-1"
            class="absolute top-8 right-8 z-[51] flex items-center p-4 mb-4 text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
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
        </div -->
    </div>
</template>