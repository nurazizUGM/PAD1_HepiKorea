<script setup>
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import { computed, onMounted, ref } from 'vue';
import { route } from 'ziggy-js';
import Footer from './Footer.vue';

const params = new URLSearchParams(window.location.search);
const search = ref(params.get('search') || '');

const showMobileNav = ref(false);
const showNotifications = ref(false);
const showUserProfile = ref(false);

// Ambil data dari usePage (Inertia.js)
const page = usePage();

const isAuthenticated = computed(() => !!page.props.auth?.user);
const isAdmin = computed(() => page.props?.user?.role === 'ADMIN');

const userPhoto = computed(() =>
    page.props.auth.user?.photo
        ? `/storage/${page.props.auth.user.photo}`
        : '/img/example/admin_order_img_user.png'
);
const notifications = computed(() =>
    page.props.auth.user?.notifications
        ?.filter((n) => !n.is_read)
        ?.sort((a, b) => new Date(b.created_at) - new Date(a.created_at))
        ?.slice(0, 5) || []
);
const notificationCount = computed(() => notifications.value.length);
const errors = computed(() => page.props.errors || {});
const message = computed(() => page.props.message || page.props.success);

// Props
const props = defineProps({
    title: String,
});

// Fungsi
const toggleMobileNav = () => {
    showMobileNav.value = !showMobileNav.value;
};

const submitSearch = () => {
    // Menggunakan Inertia untuk navigasi
    router.visit(route('product.index'), { method: 'get', data: { search: search.value } });
};

const toggleNotifications = () => {
    showNotifications.value = !showNotifications.value;
};

const toggleUserProfile = () => {
    showUserProfile.value = !showUserProfile.value;
};

// Tutup alert
const closeAlert = (id) => {
    // Untuk menutup alert secara visual (karena Inertia tidak menyimpan state alert)
    document.getElementById(id)?.remove();
};

// Fetch data tambahan jika diperlukan (contoh: notifikasi dari API)
const fetchNotifications = async () => {
    // Placeholder untuk API call
    // try {
    //   const response = await fetch('/api/notifications');
    //   notifications.value = (await response.json()).slice(0, 5);
    // } catch (error) {
    //   console.error('Error fetching notifications:', error);
    // }
};

onMounted(() => {
    // Fetch data tambahan jika diperlukan
    // fetchNotifications();
});
</script>

<template>

    <Head>
        <title>HepiKorea{{ props.title ? ` - ${props.title}` : '' }}</title>
        <meta name="description" content="This is the Customer page." />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
            rel="stylesheet" />
    </Head>

    <div class="font-poppins w-screen h-screen overflow-y-auto overflow-x-hidden no-scrollbar">
        <!-- Navbar -->
        <nav class="fixed top-0 z-40 w-full h-fit bg-white border-b border-gray-200 shadow-lg">
            <div class="px-2 py-3 md:px-1 md:py-1 lg:px-5 lg:pl-3 lg:py-3">
                <div class="flex flex-col md:flex-row gap-y-5 items-center justify-between align-middle">
                    <!-- Logo dan Burger Menu -->
                    <div class="w-full md:w-fit flex justify-start">
                        <button @click="toggleMobileNav"
                            class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                            <span class="sr-only">Open sidebar</span>
                            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                                </path>
                            </svg>
                        </button>
                        <Link :href="route('home')"
                            class="flex md:ms-6 me-2 md:me-2 hover:opacity-80 active:opacity-60">
                        <span class="self-center text-xs md:text-sm lg:text-2xl text-orange-400 font-semibold">
                            <span class="text-[#3E6E7A]">Hepi</span>Korea
                        </span>
                        </Link>

                        <!-- tampil di mobile -->
                        <div class="mx-auto md:mr-1 lg:mr-auto flex md:hidden" id="searchbar-container">
                            <form @submit.prevent="submitSearch" class="flex items-center my-auto">
                                <div class="relative flex items-center w-full">
                                    <img src="/img/assets/icon/icon_admin_search_searchbar.svg" alt="search icon"
                                        class="absolute left-3 w-2 h-2 md:h-4 md:w-4 lg:w-5 lg:h-5 text-gray-500" />
                                    <input type="text" v-model="search"
                                        class="block w-[40vw] md:w-[140px] md: lg:w-[30vw] px-2 md:pl-8 lg:pl-10 py-2 md:py-1 lg:py-2 text-gray-900 text-xs bg-[#EFEFEF] border border-[#EFEFEF] rounded-full focus:ring-0 focus:border-none placeholder:text-xs placeholder:text-start placeholder:text-[#898383] md:placeholder:text-xs lg:placeholder:text-base"
                                        placeholder="Search..." />
                                </div>
                            </form>
                        </div>

                        <!-- Cart, Notification, and User Profile -->
                        <div class="gap-x-1 items-center justify-around mx-auto align-middle flex md:hidden flex-row"
                            id="notif-cart-container">
                            <Link :href="route('cart.index')">
                            <img src="/img/assets/icon/icon_dashboard_order.svg" alt="" class="w-5 h-5" />
                            </Link>
                            <div v-if="isAuthenticated">
                                <div class="relative">
                                    <button @click="toggleNotifications" class="relative ml-1 md:ml-0">
                                        <img src="/img/assets/icon/icon_customer_notification_green.svg" alt=""
                                            class="w-4 h-5 mt-1.5" />
                                        <span v-if="notificationCount > 0"
                                            class="absolute top-[-2px] right-[-2px] w-3 h-3 text-xs text-center font-bold leading-none text-white bg-[#FF2E00] rounded-full">{{
                                                notificationCount }}</span>
                                    </button>
                                    <div v-if="showNotifications"
                                        class="w-[13rem] md:w-[30rem] z-50 my-4 text-base list-none bg-white divide-y divide-gray-100 shadow rounded-xl absolute -right-8 md:right-0">
                                        <div class="px-4 py-3">
                                            <p class="text-[11px] md:text-sm font-medium text-gray-900">Notifications
                                            </p>
                                        </div>
                                        <ul class="py-1">
                                            <li v-for="notification in notifications" :key="notification.id">
                                                <Link :href="notification.link || '#'"
                                                    class="block px-4 py-2 text-sm text-[#B7B7B7] hover:text-orange-400 hover:bg-gray-100">
                                                {{
                                                    notification.title }}</Link>
                                            </li>
                                            <Link :href="route('auth.notification')"
                                                class="block text-center px-4 py-2 text-[11px] md:text-sm text-orange-400 hover:text-orange-500 hover:bg-gray-100">
                                            View all</Link>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div v-if="isAuthenticated" class="items-center" id="user-profile-container">
                                <div class="flex items-center ms-3 relative">
                                    <button type="button"
                                        class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300"
                                        @click="toggleUserProfile">
                                        <span class="sr-only">Profile</span>
                                        <img class="w-8 h-8 rounded-full" :src="userPhoto" alt="user photo" />
                                    </button>
                                    <div v-if="showUserProfile"
                                        class="hidden md:flex z-50 my-4 text-base list-none bg-white divide-y divide-gray-100 shadow rounded-xl absolute right-0 top-10">
                                        <ul class="py-1">
                                            <li v-if="isAdmin">
                                                <Link :href="route('admin.dashboard')"
                                                    class="flex flex-row items-center px-4 py-2 text-lg font-semibold text-[#B7B7B7] hover:bg-gray-100 group">
                                                <img src="/img/assets/icon/icon_dashboard_admin.svg" alt=""
                                                    class="w-5 h-5 grayscale group-hover:grayscale-0" />
                                                <p class="ml-2 group-hover:text-orange-400">Admin Dashboard</p>
                                                </Link>
                                            </li>
                                            <li v-else>
                                                <Link :href="route('auth.profile')"
                                                    class="flex flex-row items-center px-4 py-2 text-lg font-semibold text-[#B7B7B7] hover:bg-gray-100 group">
                                                <img src="/img/assets/icon/icon_dashboard_customer.svg" alt=""
                                                    class="w-5 h-5 grayscale group-hover:grayscale-0" />
                                                <p class="ml-2 group-hover:text-orange-400">Profile</p>
                                                </Link>
                                                <Link :href="route('auth.address')"
                                                    class="flex flex-row items-center px-4 py-2 text-lg font-semibold text-[#B7B7B7] hover:bg-gray-100 group">
                                                <img src="/img/assets/icon/icon_address.svg" alt=""
                                                    class="w-5 h-5 grayscale group-hover:grayscale-0" />
                                                <p class="ml-2 group-hover:text-orange-400">Address</p>
                                                </Link>
                                                <Link :href="route('order.index')"
                                                    class="flex flex-row items-center px-4 py-2 text-lg font-semibold text-[#B7B7B7] hover:bg-gray-100 group">
                                                <img src="/img/assets/icon/icon_history.svg" alt=""
                                                    class="w-5 h-5 grayscale group-hover:grayscale-0" />
                                                <p class="ml-2 group-hover:text-orange-400">History</p>
                                                </Link>
                                            </li>
                                            <li>
                                                <Link :href="route('auth.logout')"
                                                    class="flex flex-row items-center px-5 py-2 text-lg font-semibold text-[#B7B7B7] hover:bg-gray-100 group">
                                                <img src="/img/assets/icon/icon_dashboard_logout.svg" alt=""
                                                    class="w-5 h-5 grayscale group-hover:grayscale-0" />
                                                <p class="ml-2 group-hover:text-[#FF0000]">Logout</p>
                                                </Link>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <Link v-else :href="route('auth.login')"
                                class="flex md:hidden cursor-pointer text-white bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] focus:outline-none focus:ring-0 font-medium rounded-full text-[10px] md:text-xs px-2 py-1.5 text-center md:me-2"
                                id="login-container">
                            Login
                            </Link>
                        </div>


                    </div>

                    <!-- Search Bar (tablet n desktop) -->
                    <div class="mx-auto md:mr-1 lg:mr-auto hidden md:flex" id="searchbar-container">
                        <form @submit.prevent="submitSearch" class="flex items-center my-auto">
                            <div class="relative flex items-center w-full">
                                <img src="/img/assets/icon/icon_admin_search_searchbar.svg" alt="search icon"
                                    class="absolute left-3 md:h-4 md:w-4 lg:w-5 lg:h-5 text-gray-500" />
                                <input type="text" v-model="search"
                                    class="block w-[60vw] md:w-[140px] md: lg:w-[30vw] pl-0 md:pl-8 lg:pl-10 py-2 md:py-1 lg:py-2 text-gray-900 bg-[#EFEFEF] border border-[#EFEFEF] rounded-full focus:ring-0 focus:border-none placeholder:text-sm placeholder:text-start placeholder:text-[#898383] md:placeholder:text-xs lg:placeholder:text-base"
                                    placeholder="Search..." />
                            </div>
                        </form>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden md:flex flex-col md:flex-row items-center gap-y-6 md:gap-y-0 md:gap-x-5 lg:gap-x-14 justify-around mx-auto"
                        id="navlink-container">
                        <Link :href="route('product.index')"
                            class="font-semibold text-[#3E6E7A] hover:text-orange-400 text-lg md:text-xs lg:text-lg">
                        Product
                        </Link>
                        <Link :href="route('request-order')"
                            class="font-semibold text-[#3E6E7A] hover:text-orange-400 text-lg md:text-xs lg:text-lg">
                        Request Order
                        </Link>
                        <Link :href="route('confirmed')"
                            class="font-semibold text-[#3E6E7A] hover:text-orange-400 text-lg md:text-xs lg:text-lg">
                        Confirmed
                        </Link>
                        <Link :href="route('tutorial')"
                            class="font-semibold text-[#3E6E7A] hover:text-orange-400 text-lg md:text-xs lg:text-lg">
                        Tutorial
                        </Link>
                        <Link :href="route('faq')"
                            class="font-semibold text-[#3E6E7A] hover:text-orange-400 text-lg md:text-xs lg:text-lg">
                        FAQ </Link>
                    </div>

                    <!-- navlink container mobile -->
                    <!-- Navigation Links mobile -->
                    <div class="z-30 md:hidden flex-col w-[120px] h-fit items-start gap-y-4 absolute bg-white left-0.5 top-[100%] py-3 pl-2 transition-all shadow-md"
                        :class="{ 'flex -translate-x-44': !showMobileNav, 'flex translate-x-0': showMobileNav }"
                        id="navlink-container">
                        <Link :href="route('product.index')"
                            class="font-semibold text-[#3E6E7A] hover:text-orange-400 text-xs">
                        Product
                        </Link>
                        <Link :href="route('request-order')"
                            class="font-semibold text-[#3E6E7A] hover:text-orange-400 text-xs">
                        Request Order
                        </Link>
                        <Link :href="route('confirmed')"
                            class="font-semibold text-[#3E6E7A] hover:text-orange-400 text-xs">
                        Confirmed
                        </Link>
                        <Link :href="route('tutorial')"
                            class="font-semibold text-[#3E6E7A] hover:text-orange-400 text-xs">
                        Tutorial
                        </Link>
                        <Link :href="route('faq')" class="font-semibold text-[#3E6E7A] hover:text-orange-400 text-xs">
                        FAQ </Link>
                        <div v-if="isAdmin && isAuthenticated">
                            <Link :href="route('admin.dashboard')"
                                class="flex flex-row items-center text-xs font-semibold text-[#B7B7B7] hover:bg-gray-100 group">
                            <img src="/img/assets/icon/icon_dashboard_admin.svg" alt=""
                                class="w-4 h-4 grayscale group-hover:grayscale-0" />
                            <p class="ml-2 mr-6 whitespace-nowrap group-hover:text-orange-400">
                                Admin <br> Dashboard
                            </p>
                            </Link>
                        </div>
                        <div v-else-if="isAuthenticated" class="text-xs justify-around gap-y-4 flex flex-col">
                            <Link :href="route('auth.profile')"
                                class="flex flex-row w-fit font-semibold text-[#B7B7B7] group">
                            <img src="/img/assets/icon/icon_dashboard_customer.svg" alt=""
                                class="w-4 h-4 grayscale group-hover:grayscale-0" />
                            <p class="ml-1.5 group-hover:text-orange-400">Profile</p>
                            </Link>
                            <Link :href="route('auth.address')"
                                class="flex flex-row font-semibold text-[#B7B7B7] group">
                            <img src="/img/assets/icon/icon_address.svg" alt=""
                                class="w-4 h-4 grayscale group-hover:grayscale-0" />
                            <p class="ml-1.5 mr-4 group-hover:text-orange-400">Address</p>
                            </Link>
                            <Link :href="route('order.index')" class="flex flex-row font-semibold text-[#B7B7B7] group">
                            <img src="/img/assets/icon/icon_history.svg" alt=""
                                class="w-4 h-4 grayscale group-hover:grayscale-0" />
                            <p class="ml-1.5 group-hover:text-orange-400">History</p>
                            </Link>
                        </div>
                        <Link v-if="isAuthenticated" :href="route('auth.logout')"
                            class="flex flex-row items-center text-lg font-semibold text-red-800 group">
                        <img src="/img/assets/icon/icon_dashboard_logout.svg" alt=""
                            class="w-4 h-4 grayscale group-hover:grayscale-0" />
                        <p class="ml-1.5 text-xs group-hover:text-[#FF0000]">Logout</p>
                        </Link>
                    </div>

                    <!-- Cart, Notification, and User Profile -->
                    <div class="hidden md:flex gap-x-5 items-center justify-around mx-auto md:ml-auto md:mr-5 align-middle"
                        id="notif-cart-container">
                        <Link :href="route('cart.index')">
                        <img src="/img/assets/icon/icon_dashboard_order.svg" alt=""
                            class="w-5 h-5 hover:opacity-80 active:opacity-60" />
                        </Link>
                        <div v-if="isAuthenticated">
                            <div class="relative">
                                <button @click="toggleNotifications" class="relative">
                                    <img src="/img/assets/icon/icon_customer_notification_green.svg" alt=""
                                        class="w-4 h-5 mt-1.5 hover:opacity-80 active:opacity-60" />
                                    <span v-if="notificationCount > 0"
                                        class="absolute top-[-2px] right-[-2px] w-3 h-3 text-xs text-center font-bold leading-none text-white bg-[#FF2E00] rounded-full">{{
                                            notificationCount }}</span>
                                </button>
                                <div v-if="showNotifications"
                                    class="w-[30rem] z-50 my-4 text-base list-none bg-white divide-y divide-gray-100 shadow rounded-xl px-3 absolute right-0">
                                    <div class="px-4 py-3">
                                        <p class="text-sm font-medium text-gray-900">Notifications</p>
                                    </div>
                                    <ul class="py-1">
                                        <li v-for="notification in notifications" :key="notification.id">
                                            <Link :href="notification.link || '#'"
                                                class="block px-4 py-2 text-sm text-[#B7B7B7] hover:text-orange-400 hover:bg-gray-100">
                                            {{
                                                notification.title }}</Link>
                                        </li>
                                        <Link :href="route('auth.notification')"
                                            class="block text-center px-4 py-2 text-sm text-orange-400 hover:text-orange-500 hover:bg-gray-100">
                                        View all</Link>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- muncul di desktop ama tablet -->
                    <!-- User Profile / Login-->
                    <div v-if="isAuthenticated" class="items-center hidden md:flex" id="user-profile-container">
                        <div class="items-center ms-3 relative">
                            <button type="button"
                                class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300"
                                @click="toggleUserProfile">
                                <span class="sr-only">Profile</span>
                                <img class="w-8 h-8 rounded-full" :src="userPhoto" alt="user photo" />
                            </button>
                            <div v-if="showUserProfile"
                                class="z-50 my-4 text-base list-none bg-white divide-y divide-gray-100 shadow rounded-xl absolute right-0 top-10">
                                <ul class="py-1">
                                    <li v-if="isAdmin">
                                        <Link :href="route('admin.dashboard')"
                                            class="flex flex-row items-center px-4 py-2 text-lg font-semibold text-[#B7B7B7] hover:bg-gray-100 group">
                                        <img src="/img/assets/icon/icon_dashboard_admin.svg" alt=""
                                            class="w-5 h-5 grayscale group-hover:grayscale-0" />
                                        <p class="ml-2 mr-6 whitespace-nowrap group-hover:text-orange-400">
                                            Admin Dashboard
                                        </p>
                                        </Link>
                                    </li>
                                    <li v-else>
                                        <Link :href="route('auth.profile')"
                                            class="flex flex-row items-center px-4 py-2 w-fit text-lg font-semibold text-[#B7B7B7] hover:bg-gray-100 group">
                                        <img src="/img/assets/icon/icon_dashboard_customer.svg" alt=""
                                            class="w-5 h-5 grayscale group-hover:grayscale-0" />
                                        <p class="ml-2 group-hover:text-orange-400">Profile</p>
                                        </Link>
                                        <Link :href="route('auth.address')"
                                            class="flex flex-row items-center px-4 py-2 text-lg font-semibold text-[#B7B7B7] hover:bg-gray-100 group">
                                        <img src="/img/assets/icon/icon_address.svg" alt=""
                                            class="w-5 h-5 grayscale group-hover:grayscale-0" />
                                        <p class="ml-2 mr-4 group-hover:text-orange-400">Address</p>
                                        </Link>
                                        <Link :href="route('order.index')"
                                            class="flex flex-row items-center px-4 py-2 text-lg font-semibold text-[#B7B7B7] hover:bg-gray-100 group">
                                        <img src="/img/assets/icon/icon_history.svg" alt=""
                                            class="w-5 h-5 grayscale group-hover:grayscale-0" />
                                        <p class="ml-2 group-hover:text-orange-400">History</p>
                                        </Link>
                                    </li>
                                    <li>
                                        <Link :href="route('auth.logout')"
                                            class="flex flex-row items-center px-5 py-2 text-lg font-semibold text-[#B7B7B7] hover:bg-gray-100 group">
                                        <img src="/img/assets/icon/icon_dashboard_logout.svg" alt=""
                                            class="w-5 h-5 grayscale group-hover:grayscale-0" />
                                        <p class="ml-2 group-hover:text-[#FF0000]">Logout</p>
                                        </Link>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <Link v-else :href="route('auth.login')"
                        class="hidden md:flex cursor-pointer text-white bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] focus:outline-none focus:ring-0 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2"
                        id="login-container">
                    Login
                    </Link>
                </div>
            </div>
        </nav>

        <!-- Container -->
        <div
            class="w-[92%] w-max[92%] h-fit mx-auto mt-20 md:mt-20 lg:mt-28 mb-5 md: lg:mb-20 overflow-hidden no-scrollbar">
            <slot></slot>
        </div>

        <!-- Alerts (Errors and Messages) -->
        <div v-if="page.props.appDebug" class="absolute top-24 right-8 z-60">
            <!-- Error Alerts -->
            <div v-for="(error, index) in Object.values(errors)" :key="`error-${index}`" :id="`alert-error-${index}`"
                class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50" role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">{{ error }}</div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8"
                    @click="closeAlert(`alert-error-${index}`)" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>

            <!-- Success/Message Alerts -->
            <div v-if="message" id="alert-message"
                class="flex items-center p-4 mb-4 text-blue-800 rounded-lg bg-blue-50" role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">{{ message }}</div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8"
                    @click="closeAlert('alert-message')" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Footer -->
        <Footer></Footer>
    </div>
</template>

<style scoped>
.no-scrollbar::-webkit-scrollbar {
    display: none;
}

.no-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>