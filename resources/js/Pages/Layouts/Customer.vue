<script setup>
import { ref, computed, onMounted } from 'vue';
import { Head } from '@inertiajs/vue3';
import Footer from './Footer.vue';
// import { useRoute, useRouter } from 'vue-router';

// const route = useRoute();
// const router = useRouter();
const search = ref('');
const isAuthenticated = ref(false); // Replace with actual authentication check
const isAdmin = ref(false); // Replace with actual role check
const notifications = ref([]); // Fetch notifications from API
const notificationCount = ref(0); // Fetch notification count from API
const showNotifications = ref(false);
const showUserProfile = ref(false);
const userPhoto = ref(''); // Fetch user photo from API

// const category = computed(() => route.query.category || '');
// const sortBy = computed(() => route.query.sort_by || '');

const toggleNavbar = () => {
    // Logic to toggle navbar visibility
};

const submitSearch = () => {
    router.push({ path: '/products', query: { search: search.value, category: category.value, sort_by: sortBy.value } });
};

const toggleNotifications = () => {
    showNotifications.value = !showNotifications.value;
};

const toggleUserProfile = () => {
    showUserProfile.value = !showUserProfile.value;
};

const props = defineProps({
    title: String,
});

onMounted(() => {
    // Fetch user authentication status, notifications, and user photo here
});
</script>

<template>

    <Head>
        <title>HepiKorea{{ props.title ? ` - ${props.title}` : '' }}</title>
        <meta name="description" content="This is the Customer page." />
    </Head>

    <div>
        <nav class="fixed top-0 z-40 w-full h-fit bg-white border-b border-gray-200 shadow-lg">
            <div class="px-5 py-3 md:px-1 md:py-1 lg:px-5 lg:pl-3 lg:py-3">
                <div class="flex flex-col md:flex-row gap-y-5 items-center justify-between align-middle">
                    <div class="w-full md:w-fit flex justify-between md:justify-start">
                        <router-link to="/" class="flex ms-6 me-24 md:me-2">
                            <span class="self-center text-xl md:text-sm lg:text-2xl text-orange-400 font-semibold">
                                <span class="text-[#3E6E7A]">Hepi</span>Korea
                            </span>
                        </router-link>
                        <button @click="toggleNavbar"
                            class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                            <span class="sr-only">Open sidebar</span>
                            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                                </path>
                            </svg>
                        </button>
                    </div>
                    <div class="mx-auto md:mr-1 lg:mr-auto hidden md:flex" id="searchbar-container">
                        <form @submit.prevent="submitSearch" class="flex items-center my-auto">
                            <input type="hidden" name="category" :value="category">
                            <input type="hidden" name="sort_by" :value="sortBy">
                            <div class="relative flex items-center w-full">
                                <img src="/img/assets/icon/icon_admin_search_searchbar.svg" alt="search icon"
                                    class="absolute left-3 md:h-4 md:w-4 lg:w-5 lg:h-5 text-gray-500">
                                <input type="text" v-model="search"
                                    class="block w-[60vw] md:w-[140px] md: lg:w-[30vw] pl-0 md:pl-8 lg:pl-10 py-2 md:py-1 lg:py-2 text-gray-900 bg-[#EFEFEF] border border-[#EFEFEF] rounded-full focus:ring-0 focus:border-none placeholder:text-sm placeholder:text-start placeholder:text-[#898383] md:placeholder:text-xs lg:placeholder:text-base"
                                    placeholder="Search...">
                            </div>
                        </form>
                    </div>
                    <div class="hidden md:flex flex-col md:flex-row items-center gap-y-6 md:gap-y-0 md:gap-x-8 gap-x-14 justify-around mx-auto"
                        id="navlink-container">
                        <router-link to="/products"
                            class="font-semibold text-[#3E6E7A] hover:text-orange-400 text-lg md:text-xs lg:text-lg">Product</router-link>
                        <router-link to="/request-order"
                            class="font-semibold text-[#3E6E7A] hover:text-orange-400 text-lg md:text-xs lg:text-lg">Request
                            Order</router-link>
                        <router-link to="/confirmed"
                            class="font-semibold text-[#3E6E7A] hover:text-orange-400 text-lg md:text-xs lg:text-lg">Confirmed</router-link>
                        <router-link to="/faq"
                            class="font-semibold text-[#3E6E7A] hover:text-orange-400 text-lg md:text-xs lg:text-lg">FAQ</router-link>
                    </div>
                    <div class="hidden md:flex gap-x-5 items-center justify justify-around mx-auto md:ml-auto md:mr-5 align-middle"
                        id="notif-cart-container">
                        <router-link to="/cart">
                            <img src="/img/assets/icon/icon_dashboard_order.svg" alt="" class="w-5 h-5">
                        </router-link>
                        <div v-if="isAuthenticated">
                            <router-link to="#" class="relative" @click="toggleNotifications">
                                <img src="/img/assets/icon/icon_customer_notification_green.svg" alt="" class="w-4 h-5">
                                <span v-if="notificationCount > 0"
                                    class="absolute top-[-2px] right-[-2px] w-3 h-3 text-xs text-center font-bold leading-none text-white bg-[#FF2E00] rounded-full">{{
                                        notificationCount }}</span>
                            </router-link>
                            <div v-if="showNotifications"
                                class="w-[30rem] z-50 my-4 text-base list-none bg-white divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600 rounded-xl px-3">
                                <div class="px-4 py-3">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">Notifications</p>
                                </div>
                                <ul class="py-1">
                                    <li v-for="notification in notifications" :key="notification.id">
                                        <router-link :to="notification.link"
                                            class="block px-4 py-2 text-sm text-[#B7B7B7] hover:text-orange-400 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white">{{
                                                notification.title }}</router-link>
                                    </li>
                                    <router-link to="/notifications"
                                        class="block text-center px-4 py-2 text-sm text-orange-400 hover:text-orange-500 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white">View
                                        all</router-link>
                                </ul>
                            </div>
                        </div>
                        <div v-if="isAuthenticated" class="hidden md:flex items-center" id="user-profile-container">
                            <div class="flex items-center ms-3">
                                <button type="button"
                                    class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                                    @click="toggleUserProfile">
                                    <span class="sr-only">Profile</span>
                                    <img class="w-8 h-8 rounded-full" :src="userPhoto" alt="user photo">
                                </button>
                                <div v-if="showUserProfile"
                                    class="z-50 my-4 text-base list-none bg-white divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600 rounded-xl">
                                    <ul class="py-1">
                                        <li>
                                            <router-link v-if="isAdmin" to="/admin/dashboard"
                                                class="flex flex-row items-center px-4 py-2 text-lg font-semibold text-[#B7B7B7] hover:bg-gray-100 group">
                                                <img src="/img/assets/icon/icon_dashboard_admin.svg" alt=""
                                                    class="w-5 h-5 grayscale group-hover:grayscale-0">
                                                <p class="ml-2 group-hover:text-orange-400">Admin Dashboard</p>
                                            </router-link>
                                            <router-link v-else to="/profile"
                                                class="flex flex-row items-center px-4 py-2 text-lg font-semibold text-[#B7B7B7] hover:bg-gray-100 group">
                                                <img src="/img/assets/icon/icon_dashboard_customer.svg" alt=""
                                                    class="w-5 h-5 grayscale group-hover:grayscale-0">
                                                <p class="ml-2 group-hover:text-orange-400">Profile</p>
                                            </router-link>
                                            <router-link v-else to="/address"
                                                class="flex flex-row items-center px-4 py-2 text-lg font-semibold text-[#B7B7B7] hover:bg-gray-100 group">
                                                <img src="/img/assets/icon/icon_address.svg" alt=""
                                                    class="w-5 h-5 grayscale group-hover:grayscale-0">
                                                <p class="ml-2 group-hover:text-orange-400">Address</p>
                                            </router-link>
                                            <router-link v-else to="/order/history"
                                                class="flex flex-row items-center px-4 py-2 text-lg font-semibold text-[#B7B7B7] hover:bg-gray-100 group">
                                                <img src="/img/assets/icon/icon_history.svg" alt=""
                                                    class="w-5 h-5 grayscale group-hover:grayscale-0">
                                                <p class="ml-2 group-hover:text-orange-400">History</p>
                                            </router-link>
                                            <router-link to="/logout"
                                                class="flex flex-row items-center px-5 py-2 text-lg font-semibold text-[#B7B7B7] hover:bg-gray-100 group">
                                                <img src="/img/assets/icon/icon_dashboard_logout.svg" alt=""
                                                    class="w-5 h-5 grayscale group-hover:grayscale-0">
                                                <p class="ml-2 group-hover:text-[#FF0000]">Logout</p>
                                            </router-link>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <router-link v-else to="/login"
                            class="hidden md:flex cursor-pointer text-white bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] focus:outline-none focus:ring-0 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2"
                            id="login-container">Login</router-link>
                    </div>
                </div>
            </div>
        </nav>

        <div class="w-[92%] w-max[92%] h-fit mx-auto mt-20 md:mt-20 lg:mt-28 mb-5 md: lg:mb-20 overflow-hidden no-scrollbar">
            <slot></slot>
        </div>

        <Footer></Footer>
    </div>
</template>
