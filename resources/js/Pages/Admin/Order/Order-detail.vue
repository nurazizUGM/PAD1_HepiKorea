<template>
    <Layout>
        <div class="w-full max-w-full h-full rounded-3xl bg-[#EFEFEF] py-2 px-2 lg:py-8 lg:px-10">
            <!-- Shipping Address -->
            <div
                class="w-full h-full max-h-44 overflow-hidden rounded-2xl lg:rounded-3xl bg-white flex flex-col pt-3 pb-2.5 lg:pb-8 px-2.5 lg:px-10 transition-all duration-300">
                <h1 class="text-[#3E6E7A] font-semibold text-xs lg:text-2xl">Shipping Address</h1>
                <div class="w-full h-full flex flex-row mt-5 mb-auto">
                    <div class="w-full md:w-1/6 h-full">
                        <p class="text-[#3E6E7A] font-semibold text-xs lg:text-lg">{{ address.customer_name }}</p>
                        <div class="flex flex-row">
                            <p class="text-orange-400 font-semibold text-xs lg:text-lg inline">(+62)</p>
                            <p class="text-[#898383] font-semibold text-xs lg:text-lg ml-2">{{ address.customer_phone }}
                            </p>
                        </div>
                    </div>
                    <div class="w-full md:w-4/6 md:max-w-4/6 h-full lg:pr-36 mb-auto relative">
                        <p class="text-black text-opacity-50 font-semibold text-[10px] lg:text-lg">
                            {{ getFullAddress(address) }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Product Ordered -->
            <div
                class="w-full h-full rounded-xl lg:rounded-3xl bg-white flex flex-col py-2.5 lg:py-3 px-2.5 lg:px-10 mt-2 lg:mt-6">
                <h1 class="text-black font-semibold text-xs lg:text-2xl">Product Ordered</h1>
                <div class="w-full h-full flex flex-col gap-y-5">
                    <div v-for="item in order.order_items" :key="item.id" class="w-full h-full flex flex-col">
                        <div class="w-full h-fit flex flex-row">
                            <div class="w-[20%]">
                                <img :src="getFirstProductImage(item)" alt="img_product"
                                    class="w-36 md:w-20 lg:w-36 object-contain" />
                            </div>
                            <div class="w-[65%] lg:w-[60%] md:w-[20%] mt-1 md:mt-2 pl-1 lg:pl-1">
                                <p class="mb-auto text-[#3E6E7A] text-[8px] md:text-sm lg:text-lg font-semibold">{{
                                    item.name }}</p>
                            </div>
                            <div class="w-[35%] lg:w-[30%]">
                                <p class="mb-auto flex text-[#898383] font-semibold text-[8px] md:text-sm lg:text-xl">Rp
                                    {{
                                        formatPrice(item.price) }},-</p>
                            </div>
                            <div class="w-[30%] flex flex-row">
                                <div class="h-fit flex flex-row justify-center items-center">
                                    <p
                                        class="item-quantity mt-auto md:mt-0 text-[10px] md:text-sm lg:text-2xl mx-2 md:mx-4 lg:mr-14">
                                        {{ item.quantity }}</p>
                                </div>
                                <div class="flex flex-row">
                                    <p class="text-orange-400 font-semibold text-[10px] md:text-sm lg:text-xl">Rp {{
                                        formatPrice(item.price *
                                            item.quantity) }},-</p>
                                </div>
                            </div>
                        </div>
                        <div class="w-full h-fit flex flex-col mt-0.5 lg:mt-6">
                            <h1 class="text-black font-semibold text-[10px] lg:text-xl">Note</h1>
                            <textarea
                                class="w-full bg-[#D9D9D9] h-[40px] md:h-[56px] lg:h-[79px] border-none focus:border-none focus:ring-0 rounded-lg lg:rounded-2xl resize-none text-[10px] lg:text-sm text-[#898383] font-semibold placeholder:font-semibold placeholder:text-[10px] lg:placeholder:text-sm"
                                disabled :value="item.note"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Checkout -->
            <div
                class="w-full h-full rounded-xl lg:rounded-3xl bg-white flex flex-col py-1.5 lg:py-5 px-2.5 lg:px-10 mt-2 lg:mt-6">
                <div class="w-full h-full flex flex-col md:flex-row mt-1.5 lg:mt-4">
                    <div class="w-full md:w-[40%] flex flex-row">
                        <p class="text-black text-opacity-50 text-[10px] md:text-sm lg:text-base font-semibold">Note:
                        </p>
                        <textarea
                            class="bg-white hover:bg-slate-50 focus:bg-slate-50 w-full h-[50px] md:h-[61px] lg:h-[79px] border-2 border-[#3E6E7A] rounded-xl lg:rounded-2xl resize-none ml-1.5 lg:ml-3 text-[#3E6E7A] text-[8px] md:text-xs lg:text-sm focus:border-2 focus:border-[#3E6E7A] focus:ring-0 placeholder:text-[#3E6E7A] placeholder:text-[8px] md:placeholder:text-xs lg:placeholder:text-sm p-2 py-0.5 md:py-1"
                            disabled :value="order.note"></textarea>
                    </div>
                    <div
                        class="w-full md:w-[40%] flex flex-row md:flex-col items-center md:pl-[44px] lg:px-[98px] justify-between  mt-1 md:mt-0">
                        <p class="text-black text-opacity-50 text-[8px] md:text-xs lg:text-base font-semibold">Total ({{
                            order.order_items?.length || 0 }}) Product</p>
                    </div>
                    <div class="w-full md:w-[20%] flex flex-col items-end">
                        <h1 class="text-orange-400 flex font-semibold text-[10px] md:text-xs lg:text-2xl">
                            Rp {{ formatPrice(order.total_items_price + order.service_price) }},-
                        </h1>
                        <button
                            class="w-fit flex flex-row bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white text-[8px] md:text-xs lg:text-2xl font-semibold rounded-xl lg:rounded-2xl py-1 md:py-1.5 lg:py-2 px-3 md:px-6 lg:px-9 mt-3 md:mt-3 lg:mt-2 ml-auto"
                            @click="goBack">
                            <img src="/img/assets/icon/icon_arrow_back.svg" alt="" class="w-5 h-4 md:w-10 md:h-8" />
                            <p class="my-auto">Back</p>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script>
import { onMounted, ref } from 'vue';
// import { useRouter } from 'vue-router';
import { router } from '@inertiajs/vue3';
import axios from 'axios';
import { route } from 'ziggy-js';
import Admin from '../../Layouts/Admin.vue';
import Modal from '../Modal.vue';

export default {
    props: {
        id: {
            type: String,
            required: true,
        },
    },
    components: { Modal, Layout: Admin },
    setup(props) {
        const order = ref({});
        const address = ref({});

        const goBack = () => {
            router.get(route('admin.order.index'));
        };

        const formatPrice = (price) => {
            return price?.toString()?.replace(/\B(?=(\d{3})+(?!\d))/g, '.') || '0';
        };

        // API Fetching
        const fetchOrder = async (orderId) => {
            try {
                const response = await axios.get(`/api/order/${orderId}`);
                order.value = response.data;
                address.value = response.data.order_detail;
            } catch (error) {
                console.error('Error fetching order:', error);
            }
        };

        const getImageUrl = (image) => {
            if (!image) return "/img/assets/icon/icon_admin_order_product.svg";
            if (/^http/.test(image)) return image;
            return `/api/file?path=${image.replace(/\/?storage\//g, "")}`;
        };

        const getFirstProductImage = (item) => {
            if (!item || !item.product || !item.product.images || item.product.images.length === 0) {
                return getImageUrl(null);
            }
            return getImageUrl(item.product.images[0].path);
        };

        const getFullAddress = (address) => {
            return `${address.customer_address}, ${address.city}, ${address.province}, ${address.postal_code}`;
        };

        onMounted(() => {
            fetchOrder(props.id);
        })

        return {
            order,
            address,
            goBack,
            formatPrice,
            getImageUrl,
            getFirstProductImage,
            getFullAddress,
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