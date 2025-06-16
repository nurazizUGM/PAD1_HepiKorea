<template>
    <div class="flex px-2 pb-2 md:px-4 lg:px-10 rounded-lg lg:min-h-[80vh]">
        <div class="h-full w-full">
            <div class="w-full flex items-center">
                <!-- Search Bar -->
                <div class="flex items-center mr-auto md:ml-5 lg:ml-0">
                    <div class="relative flex items-center w-full">
                        <img src="/img/assets/icon/icon_admin_search_searchbar.svg" alt="search icon"
                            class="absolute left-3 w-5 h-5 text-gray-500" />
                        <form @submit.prevent="fetchCustomers">
                            <input v-model="searchQuery" type="text"
                                class="block w-12/12 lg:w-[25vw] pl-10 py-2 text-gray-900 bg-white border border-white rounded-full focus:ring-0 focus:border-none placeholder:text-sm placeholder:text-start"
                                placeholder="Search..." />
                        </form>
                    </div>
                </div>
            </div>
            <!-- Customer Cards -->
            <div
                class="w-full lg:min-h-[49vh] h-fit mt-5 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-x-2 gap-y-3 md:gap-y-6 lg:gap-8 overflow-y-auto no-scrollbar justify-start items-start content-start py-1">
                <div v-for="customer in customers" :key="customer.id"
                    class="bg-white w-full h-[190px] md:w-[150px] md:h-[194px] lg:w-40 lg:h-52 rounded-lg overflow-hidden flex flex-col cursor-pointer mx-auto hover:scale-[102%] transition">
                    <!-- @click="$router.push(`/customer/${customer.id}`)"> -->
                    <!-- Customer Image -->
                    <div class="w-full h-4/6">
                        <img :src="getImageUrl(customer.photo)" alt="customer photo"
                            class="w-full h-full object-cover object-top" />
                    </div>
                    <!-- Customer Details -->
                    <div class="p-2 h-1/6">
                        <p class="text-[#376F7E] text-xs lg:text-sm font-bold truncate">{{ customer.fullname }}</p>
                    </div>
                    <!-- visit profile Icon -->
                    <div class="flex mx-3 mb-2 h-1/6">
                        <Link :href="route('admin.customer.show', customer.id)" class="ml-auto">
                        <img src="/img/assets/icon/icon_user_profile.svg" alt="Customer Profile" class="h-full hover:opacity-70 active:opacity-85" />
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import axios from 'axios';
import { onMounted, ref, watch } from 'vue';
import { route } from 'ziggy-js';

export default {
    components: {
        Link,
    },
    setup() {
        const customers = ref([]);
        const searchQuery = ref('');

        let timeout = null;
        watch(searchQuery, (newQuery) => {
            if (timeout) clearTimeout(timeout);
            timeout = setTimeout(() => {
                fetchCustomers();
            }, 500);
        });

        // Fetch customers
        const fetchCustomers = async () => {
            try {
                const response = await axios.get('/api/customer', {
                    params: { search: searchQuery.value },
                });
                customers.value = response.data;
            } catch (error) {
                console.error('Error fetching customers:', error);
            }
        };

        const getImageUrl = (image) => {
            if (!image) return "/img/assets/icon/icon_user.svg";
            if (/^http/.test(image)) return image;
            return `/api/file?path=${image.replace(/\/?storage\//g, "")}`;
        };

        onMounted(() => {
            fetchCustomers();
        });

        return {
            customers,
            searchQuery,
            fetchCustomers,
            getImageUrl,
        };
    },
};
</script>

<style>
.no-scrollbar::-webkit-scrollbar {
    display: none;
}

.no-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>