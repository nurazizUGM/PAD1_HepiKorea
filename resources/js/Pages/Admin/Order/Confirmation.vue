<template>
    <div class="flex flex-row">
        <!-- Year and Month Filter -->
        <div
            class="w-[35%] md:w-[30%] lg:w-[20%] min-h-[70vh] lg:h-[78vh] bg-white rounded-lg overflow-y-scroll no-scrollbar">
            <div>
                <button
                    class="flex items-center w-full px-2 md:px-3 lg:px-5 pt-5 font-medium text-gray-500 border-b-0 rounded-xl focus:ring-0 focus:bg-white hover:opacity-70"
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
                        class="flex items-center w-full px-2 md:px-3 lg:px-5 pt-5 font-medium text-gray-500 border-b-0 rounded-xl focus:ring-0 focus:bg-white hover:opacity-70"
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
                                class="my-0.5 md:my-1.5 lg:my-3 text-[10px] md:text-sm lg:text-base text-black text-opacity-50 font-semibold cursor-pointer hover:invert-[30%]"
                                @click="filterOrders(year, month)">
                                {{ getMonthName(month) }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Confirmation Cards -->
        <div
            class="w-[65%] md:w-[70%] lg:w-[80%] h-fit ml-3 md:ml-6 lg:ml-6 grid grid-cols-1 lg:grid-cols-2 gap-4 justify-start items-start align-content-start">
                        <!-- if isLoading -->
            <div v-if="isLoading" role="status"
                class="h-32 min-h-[70vh] lg:h-[78vh] flex items-center justify-center col-span-2 bg-white rounded-lg">
                <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin fill-blue-600" viewBox="0 0 100 101"
                    fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                        fill="currentColor" />
                    <path
                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                        fill="currentFill" />
                </svg>
                <span class="sr-only">Loading...</span>
            </div>

            <!-- if orders.length == 0 -->
            <div v-else-if="orders.length === 0"
                class="bg-white col-span-2 h-32 min-h-[70vh] lg:h-[78vh] rounded-lg flex items-center justify-center">
                <p class="text-gray-500 text-lg font-semibold">No orders found</p>
            </div>

            <div v-else v-for="order in filteredOrders" :key="order.id"
                class="bg-white w-[194px] md:w-full lg:w-[26rem] h-32 md:h-[150px] lg:h-52 rounded-xl p-1 md:p-2 lg:p-2 flex flex-row hover:scale-[101%] transition-all">
                <!-- Image -->
                <div class="w-5/12 h-[90%] md:h-full bg-cover bg-center bg-no-repeat rounded-xl my-auto lg:my-0"
                    :style="{ backgroundImage: `url(${getImageUrl(order.custom_order_items[0].image)})` }"></div>
                <!-- Details -->
                <div class="w-7/12 h-full flex flex-col px-2 md:px-5 lg:px-4 pt-1">
                    <h3 class="text-black ml-3 font-semibold text-[10px] md:text-sm lg:text-base">{{
                        order.custom_order_items[0].name }}</h3>
                    <p class="text-[#376F7E] ml-2.5 lg:ml-3 font-semibold text-[10px] md:text-sm lg:text-lg">Rp {{
                        formatPrice(order.total_items_price) }}</p>
                    <button
                        class="w-14 lg:w-28 h-6 lg:h-8 bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white text-xs md:text-sm lg:text-base font-semibold rounded-md mt-auto ml-auto"
                        @click="navigateToConfirmation(order.id)">
                        Check
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { router } from '@inertiajs/vue3';
import axios from 'axios';
import moment from 'moment';
import { computed, onMounted, ref } from 'vue';
import { route } from 'ziggy-js';

export default {
    setup() {
        const isLoading = ref(true);
        const orders = ref([]);

        const years = ref([moment().year()]);
        const months = ref({});

        // Filters
        const selectedYear = ref(null);
        const selectedMonth = ref(null);
        const expandedYears = ref([moment().year()]);

        const filteredOrders = computed(() => {
            if (!selectedYear.value && !selectedMonth.value) return orders.value;
            return orders.value.filter(order => {
                const date = new Date(order.created_at);
                const yearMatch = !selectedYear.value || date.getFullYear() === selectedYear.value;
                const monthMatch = !selectedMonth.value || months.value[selectedYear.value][date.getMonth()] === selectedMonth.value;
                return yearMatch && monthMatch;
            });
        });

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
        };

        const selectAllOrders = () => {
            selectedYear.value = null;
            selectedMonth.value = null;
        };

        // Navigation
        const navigateToConfirmation = (orderId) => {
            router.get(route('admin.order.confirmation', { id: orderId }), {}, {
                preserveState: true,
                preserveScroll: true,
            });
        };

        // Formatting
        const formatPrice = (price) => {
            return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        };

        // API Fetching
        const fetchOrders = async () => {
            try {
                isLoading.value = true;
                const response = await axios.get('/api/admin/request-order', {
                    params: { year: selectedYear.value, month: selectedMonth.value },
                });
                orders.value = response.data.orders;
                generateMonthSelection(response.data.firstOrder);
            } catch (error) {
                console.error('Error fetching confirmation orders:', error);
            } finally {
                isLoading.value = false;
            }
        };

        const getMonthName = (month) => {
            return moment().month(month - 1).format('MMMM');
        };

        const generateMonthSelection = ({ year: firstYear, month: firstMonth }) => {
            years.value = [];
            months.value = {};

            const currentYear = moment().year();
            for (let year = currentYear; year >= firstYear; year--) {
                years.value.push(year);
                months.value[year] = [];
                const startMonth = year == firstYear ? firstMonth : 1;
                const endMonth = year == currentYear ? moment().month() + 1 : 12;
                for (let month = startMonth; month <= endMonth; month++) {
                    months.value[year].push(month);
                }
            }
        }

        const getImageUrl = (image) => {
            if (!image) return "/img/assets/icon/icon_admin_order_product.svg";
            if (/^http/.test(image)) return image;
            return `/api/file?path=${image.replace(/\/?storage\//g, "")}`;
        };

        onMounted(() => {
            // Fetch orders from API
            fetchOrders();
        });

        return {
            orders,
            years,
            months,
            selectedYear,
            selectedMonth,
            expandedYears,
            filteredOrders,
            toggleYear,
            filterOrders,
            selectAllOrders,
            navigateToConfirmation,
            formatPrice,
            getMonthName,
            getImageUrl,
            isLoading
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