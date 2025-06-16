<template>
    <Layout title="Analytic">
        <div class="bg-[#EFEFEF] border-gray-200 rounded-lg">
            <!-- Tabs -->
            <div class="mb-1">
                <ul class="flex flex-wrap -mb-px text-xs lg:text-lg font-bold text-center text-black gap-x-16"
                    role="tablist">
                    <!-- Chart Tab -->
                    <li class="ml-auto mr-auto" role="presentation">
                        <button @click="setActiveTab('chart')" :class="[
                            'inline-block px-4 pt-4 pb-1 border-b-2 rounded-t-lg',
                            activeTab === 'chart'
                                ? 'text-black border-orange-400'
                                : 'text-black hover:text-orange-400 border-transparent hover:border-transparent'
                        ]">
                            Chart
                        </button>
                    </li>
                    <!-- Table Tab -->
                    <li class="ml-auto mr-auto" role="presentation">
                        <button @click="setActiveTab('table')" :class="[
                            'inline-block px-4 pt-4 pb-1 border-b-2 rounded-t-lg',
                            activeTab === 'table'
                                ? 'text-black border-orange-400'
                                : 'text-black hover:text-orange-400 border-transparent hover:border-transparent'
                        ]">
                            Table
                        </button>
                    </li>
                </ul>
            </div>

            <!-- Tab Content -->
            <div id="default-tab-content">
                <!-- Chart Content -->
                <div v-if="activeTab === 'chart'" class="px-2 md:px-4 lg:px-16 rounded-lg md:h-[945px] lg:h-[80vh]">
                    <h1 class="hidden lg:flex text-black font-semibold text-xl mb-2 ml-1">Recap</h1>
                    <div
                        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 md:gap-x-2 lg:gap-x-14 gap-y-4 md:mt-4 lg:mt-0">
                        <!-- Completed Orders -->
                        <div class="flex flex-col h-[298px] lg:h-56 bg-gray-50 dark:bg-gray-800 rounded-xl">
                            <div class="w-full h-[15%] text-center mb-auto mt-3">
                                <h1 class="text-black font-semibold lg:font-bold text-xl lg:text-base">Completed Orders
                                </h1>
                            </div>
                            <div class="w-full h-[85%] relative flex items-center justify-center pb-3">
                                <canvas ref="chartProductOrdered"></canvas>
                                <div class="absolute flex flex-col items-center justify-center text-center z-10">
                                    <h2 class="text-3xl font-bold text-black text-opacity-50">
                                        {{ Math.round((completedOrder / totalOrder) * 100) }}%
                                    </h2>
                                    <h3 class="md:text-xl lg:text-xs font-semibold text-black text-opacity-50">Complete
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <!-- Profile View -->
                        <div
                            class="flex md:hidden lg:flex flex-col h-[298px] lg:h-56 bg-gray-50 dark:bg-gray-800 rounded-xl py-4 px-5">
                            <div class="flex w-full justify-center overflow-hidden">
                                <h2 class="font-semibold text-md">Profile View</h2>
                            </div>
                            <h1 class="text-center my-auto text-5xl font-semibold text-black text-opacity-50">{{
                                profileView.total }}</h1>
                            <div class="flex flex-row">
                                <div class="flex flex-col mr-auto text-center">
                                    <p class="text-[#376F7E] text-md font-semibold">By User</p>
                                    <p class="text-3xl font-semibold text-black text-opacity-50">{{ profileView.users }}
                                    </p>
                                </div>
                                <div class="flex flex-col ml-auto text-center">
                                    <p class="text-[#376F7E] text-md font-semibold">By Guest</p>
                                    <p class="text-3xl font-semibold text-black text-opacity-50">{{ profileView.guests
                                        }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Most Ordered -->
                        <div class="flex flex-col h-[298px] lg:h-56 bg-gray-50 dark:bg-gray-800 rounded-xl">
                            <div class="w-full h-[15%] text-center mb-auto mt-3">
                                <h1 class="md:font-semibold lg:font-bold md:text-xl lg:text-base">Most Ordered</h1>
                            </div>
                            <div class="w-full h-[85%] relative flex items-center justify-center pb-3">
                                <canvas ref="chartMostOrdered"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- profile view tapi muncul pas tablet doang -->
                    <div class="mt-2">
                        <div
                            class="hidden lg:hidden md:flex flex-col h-[298px] bg-gray-50 dark:bg-gray-800 rounded-xl py-4 px-5">
                            <div class="flex w-full justify-center overflow-hidden">
                                <h2 class="md:font-semibold md:text-xl lg:text-base">Profile View</h2>
                            </div>
                            <h1 class="text-center my-auto text-5xl font-semibold text-black text-opacity-50">{{
                                profileView.total }}</h1>
                            <div class="flex flex-row justify-around">
                                <div class="flex flex-col text-center">
                                    <p class="text-[#376F7E] text-md font-semibold">By User</p>
                                    <p class="text-3xl font-semibold text-black text-opacity-50">{{ profileView.users }}
                                    </p>
                                </div>
                                <div class="flex flex-col text-center">
                                    <p class="text-[#376F7E] text-md font-semibold">By Guest</p>
                                    <p class="text-3xl font-semibold text-black text-opacity-50">{{ profileView.guests
                                        }}
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Line Chart -->
                    <div class="md:mt-2 lg:mt-5">
                        <div
                            class="flex items-center justify-center bg-gray-50 h-[40vh] dark:bg-gray-800 rounded-xl p-5">
                            <canvas ref="lineChart" class="w-full h-full"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Table Content -->
                <div v-if="activeTab === 'table'"
                    class="px-1 md:px-5 pt-2 rounded-lg h-[78vh] lg:h-[85vh] flex flex-col">
                    <div class="flex justify-end lg:justify-between items-center mb-2">
                        <h1 class="text-black hidden lg:flex font-semibold text-xl ml-1">Orders</h1>
                        <div class="flex">
                            <form @submit.prevent="fetchData" class="flex">
                                <div class="relative flex items-center w-full">
                                    <img src="/img/assets/icon/icon_admin_search_searchbar.svg" alt="search icon"
                                        class="absolute left-3 w-5 h-5 text-gray-500" />
                                    <input v-model="searchQuery" type="text"
                                        class="block w-[50vw] lg:w-[25vw] pl-10 py-2 text-gray-900 bg-white border border-white rounded-full focus:ring-0 focus:border-none placeholder:text-sm placeholder:text-start"
                                        placeholder="Search..." />
                                </div>
                                <button type="submit"
                                    class="inline-flex items-center pl-4 pr-6 py-2 font-semibold text-white bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] rounded-full -ml-20 z-10">
                                    <img class="w-4 h-4 mr-2"
                                        style="filter: brightness(0) saturate(100%) invert(100%) sepia(100%) saturate(1%) hue-rotate(266deg) brightness(107%) contrast(101%);"
                                        src="/img/assets/icon/icon_admin_search_searchbar.svg" alt="" />
                                    Search
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="w-full h-auto mb-3 rounded-xl bg-white overflow-y-scroll no-scrollbar">
                        <table class="w-full rtl:text-right rounded-xl overflow-hidden">
                            <thead
                                class="bg-[#3E6E7A] rounded-lg text-[10px] md:text-xs lg:text-base text-white font-extralight">
                                <tr>
                                    <th class="md:px-6 py-0.5 md:py-1.5 lg:py-3 border-white border">No</th>
                                    <th class="md:px-6 py-0.5 md:py-1.5 lg:py-3 border-white border">Date</th>
                                    <th class="md:px-6 py-0.5 md:py-1.5 lg:py-3 border-white border">Type</th>
                                    <th class="md:px-6 py-0.5 md:py-1.5 lg:py-3 border-white border">Product Name</th>
                                    <th class="md:px-6 py-0.5 md:py-1.5 lg:py-3 border-white border">Selling Price</th>
                                    <th class="md:px-6 py-0.5 md:py-1.5 lg:py-3 border-white border">Customer Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="(order, index) in orders" :key="order.id">
                                    <tr :class="{ 'bg-[#D9D9D9]': index % 2 === 0, 'bg-[#EFEFEF]': index % 2 !== 0 }">
                                        <td :rowspan="order.order_items.length" class="px-6 py-3 border-white border">{{
                                            index
                                            + 1 }}</td>
                                        <td :rowspan="order.order_items.length" class="px-6 py-3 border-white border">
                                            {{ formatDate(order.created_at) }}
                                        </td>
                                        <td :rowspan="order.order_items.length"
                                            class="px-6 py-3 border-white border text-center">
                                            {{ order.type === 'order' ? 'Regular Order' : 'Custom Request' }}
                                        </td>
                                        <td class="px-6 py-3 border-white border">
                                            {{ order.order_items[0]?.product?.name || order.order_items[0]?.name }}
                                        </td>
                                        <td class="px-6 py-3 border-white border text-right">
                                            Rp {{ formatPrice(order.order_items[0]?.price || order.order_items[0]?.total_price) }}
                                        </td>
                                        <td :rowspan="order.order_items.length" class="px-6 py-3 border-white border">
                                            {{ order.user.fullname }}
                                        </td>
                                    </tr>
                                    <tr v-for="(item, itemIndex) in order.order_items.slice(1)"
                                        :key="`${order.id}-${itemIndex}`"
                                        :class="{ 'bg-[#D9D9D9]': index % 2 === 0, 'bg-[#EFEFEF]': index % 2 !== 0 }">
                                        <td class="px-6 py-3 border-white border">{{ item?.product?.name || item?.name
                                        }}</td>
                                        <td class="px-6 py-3 border-white border text-right">
                                            Rp {{ formatPrice(item.price) }}
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                    <button @click="exportOrders"
                        class="font-semibold text-[#3E6E7A] bg-[#fff] hover:invert-[3%] active:invert-[2%] px-4 py-2 ml-2 rounded-full inline-flex align-middle fixed bottom-8 right-10">
                        Export
                        <svg xmlns="http://www.w3.org/2000/svg" class="mt-1 ml-3" width="1.13em" height="1em"
                            viewBox="0 0 576 512">
                            <path fill="currentColor"
                                d="M0 64C0 28.7 28.7 0 64 0h160v128c0 17.7 14.3 32 32 32h128v128H216c-13.3 0-24 10.7-24 24s10.7 24 24 24h168v112c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64zm384 272v-48h110.1l-39-39c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l80 80c9.4 9.4 9.4 24.6 0 33.9l-80 80c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l39-39zm0-208H256V0z" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Success Export Modal -->
            <Modal :show="showSuccessExportModal" @close="showSuccessExportModal = false">
                <div class="bg-white w-[25vw] h-auto rounded-[30px] shadow p-4">
                    <div class="flex flex-col p-14">
                        <h1 class="text-black text-xl font-medium mx-auto">Your File Has Been Exported</h1>
                        <img src="/img/assets/icon/icon_green_check.svg" alt="success" class="w-24 h-24 mx-auto mt-6" />
                    </div>
                </div>
            </Modal>
        </div>
    </Layout>
</template>

<script>
import axios from 'axios';
import { Chart, registerables } from 'chart.js';
import { nextTick, onMounted, ref, watch } from 'vue';
import AdminLayout from '../Layouts/Admin.vue';
import Modal from './Modal.vue';
Chart.register(...registerables);


export default {
    components: { Layout: AdminLayout, Modal },
    setup() {
        // Tab management
        const activeTab = ref('chart');
        const setActiveTab = (tab) => {
            activeTab.value = tab;
        };

        // Chart refs
        const chartProductOrdered = ref(null);
        const chartMostOrdered = ref(null);
        const lineChart = ref(null);

        // Dummy data for charts
        const totalOrder = ref(0);
        const completedOrder = ref(0);
        const categories = ref([]);
        const month = ref([]);
        const monthlyOrders = ref([]);
        const profileView = ref({
            users: 0,
            guests: 0,
            total: 0,
        });

        // Dummy data for orders
        const orders = ref([]);

        // Search and filter
        const searchQuery = ref('');

        // Modal
        const showSuccessExportModal = ref(false);

        // Chart instances
        let productOrderedChartInstance = null;
        let mostOrderedChartInstance = null;
        let lineChartInstance = null;

        // Initialize charts
        const initCharts = async () => {
            try {
                // Wait for DOM to update
                await nextTick();

                // Destroy existing chart instances
                if (productOrderedChartInstance) {
                    productOrderedChartInstance.destroy();
                    productOrderedChartInstance = null;
                }
                if (mostOrderedChartInstance) {
                    mostOrderedChartInstance.destroy();
                    mostOrderedChartInstance = null;
                }
                if (lineChartInstance) {
                    lineChartInstance.destroy();
                    lineChartInstance = null;
                }

                // Initialize Product Ordered Chart
                if (chartProductOrdered.value) {
                    productOrderedChartInstance = new Chart(chartProductOrdered.value, {
                        type: 'doughnut',
                        data: {
                            labels: ['Uncompleted', 'Completed'],
                            datasets: [{
                                data: [totalOrder.value - completedOrder.value, completedOrder.value],
                                backgroundColor: ['rgb(217, 217, 217)', 'rgb(55, 111, 126)'],
                                hoverOffset: 4,
                            }],
                        },
                        options: {
                            cutout: '80%',
                            responsive: true,
                            plugins: { legend: { display: false } },
                        },
                    });
                } else {
                    console.warn('Product Ordered canvas not found');
                }

                // Initialize Most Ordered Chart
                if (chartMostOrdered.value) {
                    mostOrderedChartInstance = new Chart(chartMostOrdered.value, {
                        type: 'pie',
                        data: {
                            labels: categories.value.map(c => c.name),
                            datasets: [{
                                label: 'Orders',
                                data: categories.value.map(c => c.total_order),
                                backgroundColor: [
                                    'rgb(246, 223, 170)',
                                    'rgb(255, 255, 255)',
                                    'rgb(49, 89, 100)',
                                    'rgb(55, 111, 126)',
                                    'rgb(61, 122, 138)',
                                    'rgb(69, 143, 162)',
                                    'rgb(79, 162, 184)',
                                ],
                                hoverOffset: 4,
                            }],
                        },
                        options: {
                            cutout: '0%',
                            responsive: true,
                            plugins: {
                                legend: { display: false },
                                datalabels: {
                                    color: '#fff',
                                    anchor: 'end',
                                    align: 'end',
                                    formatter: (value, context) => {
                                        const label = context.chart.data.labels[context.dataIndex];
                                        const total = context.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                                        const percentage = ((value / total) * 100).toFixed(0) + '%';
                                        return `${label}\n${percentage}`;
                                    },
                                },
                            },
                        },
                    });
                } else {
                    console.warn('Most Ordered canvas not found');
                }

                // Initialize Line Chart
                if (lineChart.value) {
                    lineChartInstance = new Chart(lineChart.value, {
                        type: 'line',
                        data: {
                            labels: month.value,
                            datasets: [{
                                label: 'Monthly Orders',
                                data: monthlyOrders.value,
                                fill: false,
                                borderColor: 'rgb(55, 111, 126)',
                                tension: 0.1,
                            }],
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                        },
                    });
                } else {
                    console.warn('Line Chart canvas not found');
                }
            } catch (error) {
                console.error('Error initializing charts:', error);
            }
        };

        // Fetch data
        const fetchData = async () => {
            try {
                const response = await axios.get('/api/admin/analytics', {
                    params: { search: searchQuery.value },
                });
                orders.value = response.data.orders.map(order => ({
                    ...order,
                    order_items: order.order_items.length > 0 ? order.order_items : order.custom_order_items,
                }));
                totalOrder.value = response.data.totalOrder;
                completedOrder.value = response.data.completedOrder;
                categories.value = response.data.categories;
                month.value = response.data.month;
                monthlyOrders.value = response.data.monthlyOrders;
                profileView.value = response.data.user;
            } catch (error) {
                console.error('Error fetching analytics:', error);
            }
        };

        // Export orders
        const exportOrders = async () => {
            // redirect to export endpoint in new tab
            const url = '/api/admin/analytics/export';
            window.open(url, '_blank');
        };

        // Format price
        const formatPrice = (price) => {
            return price ? price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') : 'n/a';
        };

        // Format date
        const formatDate = (date) => {
            const d = new Date(date);
            return `${d.getDate().toString().padStart(2, '0')}/${(d.getMonth() + 1).toString().padStart(2, '0')}/${d.getFullYear() % 100}`;
        };

        // Watch tab changes
        watch(activeTab, async (newTab) => {
            if (newTab === 'chart') {
                // Wait for DOM to update before initializing charts
                await nextTick();
                initCharts();
            }
        });

        onMounted(async () => {
            await fetchData();
            if (activeTab.value === 'chart') {
                await nextTick();
                initCharts();
            }
        });

        return {
            activeTab,
            setActiveTab,
            chartProductOrdered,
            chartMostOrdered,
            lineChart,
            totalOrder,
            completedOrder,
            categories,
            month,
            monthlyOrders,
            orders,
            searchQuery,
            showSuccessExportModal,
            exportOrders,
            formatPrice,
            formatDate,
            fetchData,
            profileView
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