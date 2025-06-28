<script setup>
import { onMounted, ref } from 'vue';
// import { useRoute } from 'vue-router';
import { router, usePage } from '@inertiajs/vue3';
import axios from 'axios';
import moment from 'moment';
import Layout from '../../Layouts/Customer.vue';
import { route } from 'ziggy-js';

const order = ref({});
const isLoading = ref(true);
const error = ref(null);

// Format full address
const getFullAddress = (address) => {
    return address
        ? `${address.customer_address}, ${address.city}, ${address.province}, ${address.postal_code}`
        : '';
};

// Format price
const priceFormatter = (price) => {
    if (typeof price !== 'number' || isNaN(price)) {
        return '0';
    }
    return price.toLocaleString('en-US').replace(/\B(?=(\d{3})+(?!\d))/g, '.');
};

// Get image URL
const getImageUrl = (image) => {
    if (!image) return 'https://placehold.co/250';
    if (image && /^http/.test(image)) return image;
    return `/api/file?path=${image}`;
};

const getProductImage = (product) => {
    if (!product || !product.images || product.images.length === 0) {
        return 'https://placehold.co/250';
    }
    return getImageUrl(product.images[0].path);
};

// Fetch order details (placeholder)
const fetchOrderDetails = (orderId) => {
    try {
        isLoading.value = true;
        axios.get(`/api/order/${orderId}`).then(({ data }) => {
            order.value = data;
        }).catch((err) => {
            console.error('Error fetching order details:', err);
            if (err.response && err.response.status === 404) {
                error.value = 'Order not found.';
            } else {
                error.value = 'Failed to retrieve order details. Please try again later.';
            }
        }).finally(() => {
            readNotification()
            isLoading.value = false;
        });
    } catch (err) {
        console.error('Error retrieving order details:', err);
        error.value = 'Failed to retrieve order details. Please try again later.';
    }
};

const props = defineProps({
    orderId: {
        type: String,
        required: true,
    }
});

const readNotification = async () => {
    const notificationId = new URLSearchParams(window.location.search).get('notificationId');
    console.log('notificationId', notificationId)
    if (notificationId) {
        return axios.post(`/api/notifications/${notificationId}/read`)
    }
}

const handleBack = () => {
    router.back()
}

onMounted(() => {
    const orderId = props.orderId || usePage().props.orderId;
    if (!orderId) {
        router.get('/order');
        return;
    }
    fetchOrderDetails(orderId);
});
</script>

<template>
    <Layout title="Order Detail">
        <div v-if="isLoading"
            class="w-full h-[80vh] max-w-full bg-[#EFEFEF] rounded-3xl py-3 px-3 lg:px-10 lg:py-8 flex items-center justify-center">
            <div role="status">
                <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                    viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                        fill="currentColor" />
                    <path
                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                        fill="currentFill" />
                </svg>
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <div v-else-if="error" class="w-full h-[80vh] max-w-full bg-[#EFEFEF] rounded-3xl py-3 px-3 lg:px-10 lg:py-8">
            <div class="flex flex-col items-center justify-center h-full">
                <svg class="w-16 h-16 text-red-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" stroke-width="2" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01" />
                </svg>
                <h2 class="text-xl font-semibold text-red-600 mb-2">Oops! Something went wrong.</h2>
                <p class="text-gray-700 text-center mb-4">{{ error }}</p>
                <button v-if="error.includes('not found')" @click="router.get('/order')"
                    class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition">
                    Go Back to Orders
                </button>
                <button v-else @click="fetchOrderDetails(props.orderId)"
                    class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition">
                    Retry
                </button>
            </div>
        </div>
        <div v-else class="w-full h-full max-w-full bg-[#EFEFEF] rounded-3xl py-3 px-3 lg:px-10 lg:py-8">
            <!-- Order Info -->
            <div
                class="bg-white w-full max-h-[11rem] h-full flex-col overflow-hidden pt-3 pb-2.5 px-2.5 lg:pb-10 lg:px-10 rounded-2xl lg:rounded-3xl">
                <h1 class="text-[#3E6E7A] font-semibold text-xs lg:text-2xl">
                    Order Detail
                </h1>
                <div class="flex flex-col w-full h-full my-5 mt-1 lg:mt-0">
                    <div class="flex-row-gap flex">
                        <p class="text-[#3E6E7A] font-semibold text-xs md:text-base">
                            Order ID: <span>{{ order.id }}</span>
                        </p>
                        <p class="ml-4 font-semibold text-[#898383] text-xs md:text-base">
                            Status: <span>{{ order.status }}</span>
                        </p>
                        <p class="ml-4 font-semibold text-[#898383] text-xs md:text-base">
                            Date: <span>{{ moment(order.created_at).format('DD MMM YYYY, HH:mm') }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Shipping Address -->
            <div
                class="bg-white w-full max-h-[11rem] h-full flex-col overflow-hidden pt-3 pb-2.5 px-2.5 lg:pb-10 lg:px-10 mt-2 lg:mt-6 rounded-2xl lg:rounded-3xl">
                <h1 class="text-[#3E6E7A] font-semibold text-xs lg:text-2xl">
                    Shipping Address
                </h1>
                <div class="w-full h-full flex flex-col md:flex-row mt-1 lg:mt-5 mb-auto">
                    <div class="w-full md:w-1/6 h-full">
                        <div class="flex flex-row">
                            <p class="text-[#3E6E7A] font-semibold text-xs lg:text-lg">
                                {{ order.order_detail?.customer_name || 'Customer Name' }}
                            </p>
                        </div>
                        <p class="text-[#898383] font-semibold text-xs lg:text-lg   ">
                            <span class="text-orange-400 font-semibold text-xs lg:text-lg inline">
                                (+62)
                            </span>
                            {{ order.order_detail?.customer_phone || 'Customer Phone' }}
                        </p>
                    </div>
                    <div class="w-full md:w-4/6 md:max-w-4/6 h-full lg:pr-36 mb-auto relative">
                        <p class="text-black text-opacity-50 font-semibold text-[10px] lg:text-lg">
                            {{ getFullAddress(order.order_detail) }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Ordered Products -->
            <div
                class="bg-white w-full h-full flex-col py-2.5 px-2.5 lg:py-3 lg:px-10 mt-2 lg:mt-6 rounded-xl lg:rounded-3xl">
                <h1 class="text-black font-semibold text-xs lg:text-2xl">
                    Ordered Products
                </h1>
                <div class="w-full h-full flex flex-col gap-y-5">
                    <div v-for="item in order.order_items" :key="item.id" class="w-full h-full flex flex-col">
                        <div class="w-full h-fit flex flex-row">
                            <div class="w-[20%]">
                                <img :src="getProductImage(item.product)" alt="Product image"
                                    class="w-36 md:w-20 lg:w-36 object-contain" />
                            </div>
                            <div class="w-[30%] md:w-[20%] mt-1 md:mt-2 pl-1 lg:pl-0">
                                <p class="mb-auto text-[#3E6E7A] text-[10px] md:text-sm lg:text-xl font-semibold">
                                    {{ item.product?.name || 'Product Name' }}
                                </p>
                                <p class="mt-2 font-semibold text-[#898383] text-[8px] md:text-sm lg:text-xl">
                                    Quantity: {{ item.quantity }}
                                </p>
                            </div>
                            <div class="w-[25%] mt-2">
                                <p
                                    class="md:flex text-[#898383] mb-auto font-semibold text-[8px] md:text-sm lg:text-xl">
                                    Rp {{ priceFormatter(item.product?.price) }},-
                                </p>
                            </div>
                            <div class="w-[25%] md:w-[20%] md:flex justify-end mt-2">
                                <p class="mb-auto text-orange-400 font-semibold text-[8px] md:text-sm lg:text-xl">
                                    Rp {{ priceFormatter(item.price) }},-
                                </p>
                            </div>
                        </div>
                        <div v-if="item.notes" class="w-full h-fit flex flex-col mt-0.5 lg:mt-6">
                            <h1 class="text-black font-semibold text-[10px] lg:text-xl">
                                Notes
                            </h1>
                            <p
                                class="w-full bg-[#D9D9D9] h-[40px] md:h-[56px] lg:h-[79px] border-none focus:border-none focus:ring-0 rounded-lg lg:rounded-2xl resize-none text-[10px] lg:text-sm text-[#898383] font-semibold placeholder:font-semibold placeholder:text-[10px] lg:placeholder:text-sm p-1 md:p-2">
                                {{ item.note || 'No notes provided' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div
                class="bg-white w-full h-full flex-col py-2.5 px-2.5 lg:py-3 lg:px-10 mt-2 lg:mt-6 rounded-xl lg:rounded-3xl">
                <h1 class="text-black font-semibold text-xs md:text-base lg:text-2xl">
                    Order Summary
                </h1>
                <div class="flex w-full mt-2 justify-between">
                    <p class="font-semibold text-[#898383] text-[0.625rem] lg:text-[1.125rem]">
                        Total
                    </p>
                    <p class="text-orange-400 font-semibold text-xs md:text-base lg:text-2xl">
                        Rp {{ priceFormatter(order.total_items_price) }},-
                    </p>
                </div>
            </div>

            <!-- back button -->
            <div class="mt-2 md:mt-3 lg:mt-6 ml-1 bg-[#3E6E7A] w-2/12 md:w-[12%] lg:w-1/12 text-center p-1 md:p-2 lg:p-3 rounded-xl lg:rounded-2xl cursor-pointer hover:opacity-90 active:opacity-85"  @click="router.get('/order')">
                <p class="text-white font-semibold text-xs md:text-base lg:text-lg">Back</p>
            </div>
        </div>
    </Layout>
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