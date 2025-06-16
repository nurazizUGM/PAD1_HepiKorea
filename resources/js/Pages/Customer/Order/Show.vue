<script setup>
import { ref, onMounted } from 'vue';
// import { useRoute } from 'vue-router';
import Layout from '../../Layouts/Customer.vue';
import axios from 'axios';

// Dummy data for order details
const order = ref({
    id: 'ORD12345',
    created_at: new Date('2023-12-10T14:30:00'),
    status: 'Processed',
    total: 750000,
    address: {
        name: 'Aisyah',
        phone: '813-9230-8107',
        address: 'Bulaksumur, Caturtunggal, Kapanewon Depok',
        suburb: 'Sleman',
        city: 'Sleman',
        province: 'Daerah Istimewa Yogyakarta',
        postal_code: '55281',
    },
    addressId: 1,
    items: [
        {
            product: {
                id: '1',
                title: 'Smartphone XYZ',
                price: 500000,
                image: '/img/example/admin.jpg',
            },
            id: '1',
            productId: '1',
            quantity: 1,
            total: 500000,
            notes: 'Please ensure the color is black.',
        },
        {
            product: {
                id: '2',
                title: 'Phone Case',
                price: 250000,
                image: null,
            },
            id: '2',
            productId: '2',
            quantity: 2,
            total: 250000,
            notes: '',
        },
    ],
});

// Format full address
const getFullAddress = (address) => {
    return address
        ? `${address.address}, ${address.suburb}, ${address.city}, ${address.province}, ${address.postalCode}`
        : '';
};

// Format price
const priceFormatter = (price) => {
    return price.toLocaleString('en-US').replace(/\B(?=(\d{3})+(?!\d))/g, '.');
};

// Get image URL
const getImageUrl = (imageId) => {
    if (imageId && /^http/.test(imageId)) return imageId;
    if (imageId) return `/images/${imageId}`;
    return '/images/default/admin.jpg';
};

// Fetch order details (placeholder)
const fetchOrderDetails = (orderId) => {
    try {
        // const response = await axios.get(`/orders/${orderId}`);
        // order = {...response.data, createdAt: new Date(response.data.createdAt), items: response.data.items.map(item => ({
        //   ...item,
        //   total: item.quantity * (item.price),
        // }))};
    } catch (err) {
        console.error('Error retrieving order details:', error);
    }
};

// Initialize
// const route = useRoute();
onMounted(() => {
    const orderId = route.params.orderId;
    if (orderId) {
        fetchOrderDetails(orderId);
    }
});

// Cleanup
// onUnmounted(() => {
//   console.log('Order Details component unmounted');
// });

// Computed properties
</script>

<template>
    <Layout title="Order Detail">
        <div class="w-full h-full max-w-full bg-[#EFEFEF] rounded-3xl py-3 px-3 lg:px-10 lg:py-8">
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
                            Date: <span>{{ order.created_at.toLocaleString('en-GB', {
                                day: '2-digit', month: 'short',
                                year: 'numeric', hour: '2-digit', minute: '2-digit' }) }}</span>
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
                                {{ order.address.name }}
                            </p>
                        </div>
                        <p class="text-[#898383] font-semibold text-xs lg:text-lg   ">
                            <span class="text-orange-400 font-semibold text-xs lg:text-lg inline">
                                (+62)
                            </span>
                            {{ order.address.phone?.replace(/^(0|62)/g, '') }}
                        </p>
                    </div>
                    <div class="w-full md:w-4/6 md:max-w-4/6 h-full lg:pr-36 mb-auto relative">
                        <p class="text-black text-opacity-50 font-semibold text-[10px] lg:text-lg">
                            {{ getFullAddress(order.address) }}
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
                    <div v-for="item in order.items" :key="item.id" class="w-full h-full flex flex-col">
                        <div class="w-full h-fit flex flex-row">
                            <div class="w-[20%]">
                                <img :src="getImageUrl(item.product.image)" alt="Product image"
                                    class="w-36 md:w-20 lg:w-36 object-contain" />
                            </div>
                            <div class="w-[30%] md:w-[20%] mt-1 md:mt-2 pl-1 lg:pl-0">
                                <p
                                    class="mb-auto text-[#3E6E7A] text-[10px] md:text-sm lg:text-xl font-semibold">
                                    {{ item.product.title }}
                                </p>
                                <p
                                    class="mt-2 font-semibold text-[#898383] text-[8px] md:text-sm lg:text-xl">
                                    Quantity: {{ item.quantity }}
                                </p>
                            </div>
                            <div class="w-[25%] mt-2">
                                <p
                                    class="md:flex text-[#898383] mb-auto font-semibold text-[8px] md:text-sm lg:text-xl">
                                    Rp {{ priceFormatter(item.product.price) }},-
                                </p>
                            </div>
                            <div class="w-[25%] md:w-[20%] md:flex justify-end mt-2">
                                <p
                                    class="mb-auto text-orange-400 font-semibold text-[8px] md:text-sm lg:text-xl">
                                    Rp {{ priceFormatter(item.total) }},-
                                </p>
                            </div>
                        </div>
                        <div v-if="item.notes" class="w-full h-fit flex flex-col mt-0.5 lg:mt-6">
                            <h1 class="text-black font-semibold text-[10px] lg:text-xl">
                                Notes
                            </h1>
                            <p
                                class="w-full bg-[#D9D9D9] h-[40px] md:h-[56px] lg:h-[79px] border-none focus:border-none focus:ring-0 rounded-lg lg:rounded-2xl resize-none text-[10px] lg:text-sm text-[#898383] font-semibold placeholder:font-semibold placeholder:text-[10px] lg:placeholder:text-sm p-1 md:p-2">
                                {{ item?.notes ? item.notes : "-" }}
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
                        Rp {{ priceFormatter(order.total) }},-
                    </p>
                </div>
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