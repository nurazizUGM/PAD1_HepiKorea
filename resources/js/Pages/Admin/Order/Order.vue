<template>
    <div class="flex flex-row">
        <!-- Year and Month Filter -->
        <div
            class="w-[35%] md:w-[30%] lg:w-[20%] min-h-[70vh] lg:h-[78vh] bg-white rounded-lg overflow-y-scroll no-scrollbar">
            <div>
                <button
                    class="flex items-center w-full px-2 md:px-3 lg:px-5 pt-5 font-medium text-gray-500 border-b-0 rounded-xl focus:ring-0 focus:bg-white"
                    @click="selectAllOrders">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 rotate-180 shrink-0" aria-hidden="true"
                        viewBox="0 0 16 16">
                        <path fill="#000" fill-rule="evenodd"
                            d="M2.5 5a1.25 1.25 0 1 0 0-2.5a1.25 1.25 0 0 0 0 2.5m3.25-2a.75.75 0 0 0 0 1.5h8.5a.75.75 0 0 0 0-1.5zm0 8.5a.75.75 0 0 0 0 1.5h8.5a.75.75 0 0 0 0-1.5zM5 8a.75.75 0 0 1 .75-.75h8.5a.75.75 0 0 1 0 1.5h-8.5A.75.75 0 0 1 5 8M3.75 8a1.25 1.25 0 1 1-2.5 0a1.25 1.25 0 0 1 2.5 0M2.5 13.5a1.25 1.25 0 1 0 0-2.5a1.25 1.25 0 0 0 0 2.5"
                            clip-rule="evenodd" />
                    </svg>
                    <span
                        class="text-[#376F7E] font-semibold text-[10px] md:text-base lg:text-xl inline-block ml-3">All</span>
                </button>
                <div v-for="year in years" :key="year">
                    <button
                        class="flex items-center w-full px-2 md:px-3 lg:px-5 pt-5 font-medium text-gray-500 border-b-0 rounded-xl focus:ring-0 focus:bg-white"
                        @click="toggleYear(year)">
                        <svg class="w-3 h-3 shrink-0" :class="{ 'rotate-180': expandedYears.includes(year) }"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5 5 1 1 5" />
                        </svg>
                        <span
                            class="text-[#376F7E] font-semibold text-[10px] md:text-base lg:text-xl inline-block ml-3">{{
                                year }}</span>
                    </button>
                    <div v-if="expandedYears.includes(year)" class="px-2 md:px-3 lg:px-5">
                        <ul class="ml-5 text-lg">
                            <li v-for="month in months[year]" :key="month"
                                class="my-0.5 md:my-1.5 lg:my-3 text-[10px] md:text-sm lg:text-base text-black text-opacity-50 font-semibold cursor-pointer"
                                @click="filterOrders(year, month)">
                                {{ getMonthName(month) }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Cards -->
        <div
            class="w-[65%] md:w-[70%] lg:w-[80%] h-fit ml-3 md:ml-6 lg:ml-6 grid grid-cols-1 lg:grid-cols-2 gap-4 justify-start items-start align-content-start">
            <!-- if orders.length == 0 -->
            <div v-if="orders.length === 0"
                class="bg-white col-span-2 h-32 md:h-[150px] lg:h-52 rounded-lg flex items-center justify-center">
                <p class="text-gray-500 text-lg font-semibold">No orders found</p>
            </div>
            <div v-for="order in orders" :key="order.id"
                class="bg-white w-[194px] md:w-full lg:w-[26rem] h-32 md:h-[150px] lg:h-52 rounded-xl p-1 md:p-2 lg:p-2 flex flex-row">
                <div class="w-5/12 h-[90%] md:h-full bg-cover bg-center bg-no-repeat rounded-xl my-auto lg:my-0"
                    :style="{ backgroundImage: `url(${getImageUrl(order.image)})` }"></div>
                <div class="w-7/12 h-full flex flex-col px-2 md:px-5 lg:px-4 pt-1">
                    <div class="flex flex-row items-center">
                        <img src="/img/assets/icon/icon_admin_order_customer.svg" alt="user icon"
                            class="w-3 h-3 md:w-4 md:h-4 lg:h-6 lg:w-6 fill-black" />
                        <p class="text-black ml-3 font-semibold text-[10px] md:text-sm lg:text-base">{{
                            order.user.fullname }}</p>
                    </div>
                    <div class="flex flex-row mt-1.5 lg:mt-2 items-center align-bottom">
                        <img src="/img/assets/icon/icon_admin_order_date.svg" alt="date icon"
                            class="w-3 h-3 md:w-4 md:h-4 lg:h-6 lg:w-6" />
                        <p class="text-[#376F7E] font-semibold ml-3 text-[10px] md:text-sm lg:text-base">{{
                            formatDate(order.created_at) }}</p>
                    </div>
                    <div class="flex flex-row mt-1.5 lg:mt-2 md:ml-0.5 align-bottom">
                        <img src="/img/assets/icon/icon_admin_order_coin.svg" alt="coin icon"
                            class="h-3.5 md:h-4.5 lg:h-5 w-3.5 md:w-4.5 lg:w-5 my-auto" />
                        <p class="text-[#656565] ml-2.5 lg:ml-3.5 font-semibold text-[10px] md:text-sm lg:text-base">
                            Rp {{ formatPrice(order.total_items_price) }}
                        </p>
                    </div>
                    <div class="flex flex-row mt-1 lg:mt-3 -ml-1.5">
                        <p
                            class="text-[#656565] text-opacity-50 ml-2 lg:ml-2.5 font-semibold text-[10px] md:text-sm lg:text-sm">
                            Status :</p>
                        <p
                            class="text-[#656565] text-opacity-50 ml-0.5 lg:ml-2.5 font-semibold text-[10px] md:text-sm lg:text-sm">
                            {{ formatStatus(order.status) }}
                        </p>
                    </div>
                    <div class="flex flex-row my-auto lg:mt-auto lg:mb-0">
                        <button
                            class="w-1/3 h-6 lg:h-9 hover:bg-slate-50 border-2 border-[#376F7E] rounded-md flex ml-auto"
                            @click="router.get(route('admin.order.show', { id: order.id }))">
                            <img src="/img/assets/icon/icon_admin_order_see_detail.svg" alt="see_detail_icon"
                                class="m-auto border-orange-400" />
                        </button>
                        <button v-if="order.status === 'paid'"
                            class="w-2/3 h-6 lg:h-9 bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-[10px] lg:text-base text-white font-semibold rounded-md ml-1"
                            @click="openProcessModal(order)">
                            Process
                        </button>
                        <button v-else-if="order.status === 'processing' || order.status === 'shipment_paid'"
                            class="w-2/3 h-6 lg:h-9 bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-[10px] lg:text-base text-white font-semibold rounded-md ml-1"
                            @click="openSentModal(order)">
                            Sent
                        </button>
                        <button v-else-if="order.status === 'shipment_paid'"
                            class="w-2/3 h-6 lg:h-9 bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-[10px] lg:text-base text-white font-semibold rounded-md ml-1"
                            @click="openSendModal(order)">
                            Sent
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Save Modal -->
        <Modal :show="showSuccessModal" @close="showSuccessModal = false">
            <div class="bg-white w-[25vw] h-auto rounded-[30px] shadow">
                <div class="w-full h-full flex flex-col p-14">
                    <h1 class="text-black text-xl font-medium mx-auto">Successfully Saved!</h1>
                    <img src="/img/assets/icon/icon_green_check.svg" alt="green_check" class="w-24 h-24 mx-auto mt-6" />
                </div>
            </div>
        </Modal>

        <!-- Process Order Modal -->
        <ProcessOrderModal :show="showProcessModal" :order-id="selectedOrderId" @close="showProcessModal = false"
            @save="handleSave" />

        <!-- Sent Order Modal (for processing) -->
        <SentOrderModal :show="showSentModal && selectedOrder?.status === 'processing'" :order-id="selectedOrderId"
            @close="showSentModal = false" @save="handleSave" />

        <!-- Send Order Modal (for shipment_paid) -->
        <SendOrderModal :show="showSentModal && selectedOrder?.status === 'shipment_paid'" :order-id="selectedOrderId"
            @close="showSentModal = false" @save="handleSave" />
    </div>
</template>

<script>
import { onMounted, ref } from 'vue';
// import { useRouter } from 'vue-router';
import { router } from '@inertiajs/vue3';
import axios from 'axios';
import Modal from '../Modal.vue';
import ProcessOrderModal from './ProcessOrderModal.vue';
import SendOrderModal from './SendOrderModal.vue';
import SentOrderModal from './SentOrderModal.vue';

export default {
    components: { Modal, ProcessOrderModal, SentOrderModal, SendOrderModal },
    setup() {
        // const router = useRouter();

        // Dummy data
        const orders = ref([]);

        const years = ref([]);
        const months = ref({});

        // Filters
        const selectedYear = ref(null);
        const selectedMonth = ref(null);
        const expandedYears = ref([new Date().getFullYear()]);

        const toggleYear = (year) => {
            if (expandedYears.value.includes(year)) {
                expandedYears.value = expandedYears.value.filter(y => y !== year);
            } else {
                expandedYears.value.push(year);
            }
        };

        const filterOrders = (year, month) => {
            selectedYear.value = year;
            selectedMonth.value = month;
            fetchOrders();
        };

        const selectAllOrders = () => {
            selectedYear.value = null;
            selectedMonth.value = null;
        };

        // Modals
        const showSuccessModal = ref(false);
        const showProcessModal = ref(false);
        const showSentModal = ref(false);
        const showSendModal = ref(false);
        const selectedOrder = ref(null);
        const selectedOrderId = ref(null);

        const openProcessModal = (order) => {
            selectedOrder.value = order;
            selectedOrderId.value = order.id;
            showProcessModal.value = true;
        };

        const openSentModal = (order) => {
            selectedOrder.value = order;
            selectedOrderId.value = order.id;
            showSentModal.value = true;
        };

        const openSendModal = (order) => {
            selectedOrder.value = order;
            selectedOrderId.value = order.id;
            showSendModal.value = true;
        };

        const handleSave = () => {
            showProcessModal.value = false;
            showSentModal.value = false;
            showSuccessModal.value = true;
            setTimeout(() => (showSuccessModal.value = false), 2000);
        };

        // Navigation
        // const navigateToOrder = (orderId) => {
        //   // router.push({ name: 'admin.order.show', params: { id: orderId } });
        // };

        // Formatting
        const formatDate = (date) => {
            return new Date(date).toLocaleDateString('id-ID', { day: '2-digit', month: '2-digit', year: 'numeric' });
        };

        const formatPrice = (price) => {
            return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        };

        const formatStatus = (status) => {
            return status.replace('_', ' ').replace(/\b\w/g, c => c.toUpperCase());
        };

        const getMonthName = (month) => {
            return new Date(0, month - 1).toLocaleString('default', { month: 'long' });
        };

        const generateMonthSelection = ({ year: firstYear, month: firstMonth }) => {
            years.value = [];
            months.value = {};

            const currentYear = new Date().getFullYear();
            for (let year = currentYear; year >= firstYear; year--) {
                years.value.push(year);
                months.value[year] = [];
                const startMonth = year == firstYear ? firstMonth : 1;
                const endMonth = year == currentYear ? new Date().getMonth() + 1 : 12;
                for (let month = startMonth; month <= endMonth; month++) {
                    months.value[year].push(month);
                }
            }
        }

        // API Fetching
        const fetchOrders = async () => {
            try {
                const response = await axios.get('/api/admin/order', {
                    params: { year: selectedYear.value, month: selectedMonth.value },
                });
                orders.value = response.data.orders;
                generateMonthSelection(response.data.firstOrder)
            } catch (error) {
                console.error('Error fetching orders:', error);
            }
        };

        const getImageUrl = (image) => {
            if (!image) return "/img/assets/icon/icon_admin_order_product.svg";
            if (/^http/.test(image)) return image;
            return `/api/file?path=${image.replace(/\/?storage\//g, "")}`;
        };

        onMounted(() => {
            fetchOrders();
        });

        return {
            orders,
            years,
            months,
            selectedYear,
            selectedMonth,
            expandedYears,
            toggleYear,
            filterOrders,
            selectAllOrders,
            showSuccessModal,
            showProcessModal,
            showSentModal,
            selectedOrder,
            selectedOrderId,
            openProcessModal,
            openSentModal,
            openSendModal,
            handleSave,
            // navigateToOrder,
            router,
            formatDate,
            formatPrice,
            formatStatus,
            getImageUrl,
            getMonthName
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