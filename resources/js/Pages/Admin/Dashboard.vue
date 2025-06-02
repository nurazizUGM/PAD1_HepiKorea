<!-- <script lang="ts" setup>
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Layout>

        <Head title="Dashboard" />
    </Layout>
</template> -->

<template>
    <AdminLayout title="Dashboard">
        <div class="p-4 border-2 bg-[#EFEFEF] border-gray-200 rounded-lg h-[1250px] md:h-[880px] lg:h-[88vh]">
            <!-- Dashboard Title -->
            <h1 class="text-black font-bold text-xl mb-2 -mt-2">Dashboard</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-4">
                <!-- Product Card -->
                <Link :href="route('admin.product.index')"
                    class="flex flex-col h-40 md:h-40 lg:h-48 bg-gray-50 rounded-xl cursor-pointer hover:shadow-md transition-shadow">
                <div class="mb-auto flex w-full px-4 py-3 justify-between overflow-hidden">
                    <p class="text-5xl md:text-5xl lg:text-6xl font-bold">
                        {{ dashboardData.products }}
                    </p>
                    <img src="/img/assets/icon/icon_dashboard_product.svg" alt="Product Icon" class="h-12 w-12" />
                </div>
                <div class="bg-[#376F7E] w-full mt-auto text-center text-white font-semibold text-lg py-2 rounded-b-xl">
                    Products
                </div>
                </Link>

                <!-- Order Card -->
                <Link :href="route('admin.order.index')"
                    class="flex flex-col h-40 md:h-40 lg:h-48 bg-gray-50 rounded-xl cursor-pointer hover:shadow-md transition-shadow">
                <div class="mb-auto flex w-full px-4 py-3 justify-between overflow-hidden">
                    <p class="text-5xl md:text-5xl lg:text-6xl font-bold">
                        {{ dashboardData.totalOrder }}
                    </p>
                    <img src="/img/assets/icon/icon_dashboard_order.svg" alt="Order Icon" class="h-12 w-12" />
                </div>
                <div class="bg-[#376F7E] w-full mt-auto text-center text-white font-semibold text-lg py-2 rounded-b-xl">
                    Order
                </div>
                </Link>

                <!-- Customer Card -->
                <Link :href="route('admin.customer.index')"
                    class="flex flex-col h-40 md:h-40 lg:h-48 bg-gray-50 rounded-xl cursor-pointer hover:shadow-md transition-shadow">
                <div class="mb-auto flex w-full px-4 py-3 justify-between overflow-hidden">
                    <p class="text-5xl md:text-5xl lg:text-6xl font-bold">
                        {{ dashboardData.customers }}
                    </p>
                    <img src="/img/assets/icon/icon_dashboard_customer.svg" alt="Customer Icon" class="h-12 w-12" />
                </div>
                <div class="bg-[#376F7E] w-full mt-auto text-center text-white font-semibold text-lg py-2 rounded-b-xl">
                    Customer
                </div>
                </Link>
            </div>

            <!-- Product Ordered and Most Ordered -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                <!-- Product Ordered -->
                <Link :href="route('admin.order.index')"
                    class="flex flex-col items-center justify-center bg-gray-50 h-[298px] md:h-[298px] lg:h-[420px] rounded-xl cursor-pointer hover:shadow-md transition-shadow">
                <div class="w-full h-[15%] text-center mb-auto pt-3">
                    <h1 class="text-black font-bold text-xl lg:text-2xl">
                        Product Ordered
                    </h1>
                </div>
                <div class="w-full h-[85%] relative flex items-center justify-center pb-3">
                    <canvas ref="productOrderedChart"></canvas>
                    <div class="absolute flex flex-col items-center justify-center text-center z-10">
                        <h2 class="text-3xl lg:text-7xl font-bold text-black text-opacity-50">
                            {{ dashboardData.completionRate }}%
                        </h2>
                        <h3 class="md:text-xl lg:text-2xl font-semibold text-black text-opacity-50">
                            Complete
                        </h3>
                    </div>
                </div>
                </Link>

                <!-- Most Ordered -->
                <Link :href="route('admin.category.index')"
                    class="flex flex-col items-center justify-center bg-gray-50 h-[298px] md:h-[298px] lg:h-[420px] rounded-xl cursor-pointer hover:shadow-md transition-shadow">
                <div class="w-full h-[15%] text-center mb-auto pt-3">
                    <h1 class="text-black font-bold text-xl lg:text-2xl">
                        Most Ordered
                    </h1>
                </div>
                <div class="w-full h-[85%] relative flex items-center justify-center pb-3">
                    <canvas ref="mostOrderedChart"></canvas>
                </div>
                </Link>
            </div>
        </div>
    </AdminLayout>
</template>

<script>
import { Link } from "@inertiajs/vue3";
import Chart from "chart.js/auto";
import { onMounted, ref } from "vue";
import AdminLayout from "../Layouts/Admin.vue";

export default {
    components: {
        AdminLayout,
        Link,
    },
    setup() {
        // Dummy data (to be replaced with API data)
        const dashboardData = ref({
            products: 0,
            totalOrder: 0,
            customers: 0,
            completionRate: 0,
            uncompletedOrder: 0,
            completedOrder: 0,
            categories: [
            ],
        });

        // Chart references
        const productOrderedChart = ref(null);
        const mostOrderedChart = ref(null);

        // Function to fetch dashboard data from API (placeholder)
        const fetchDashboardData = async () => {
            try {
                // Uncomment to enable API fetching

                const response = await fetch("/api/admin/statistics", {
                    method: "GET",
                    headers: {
                        Accept: "application/json",
                    },
                });
                if (!response.ok)
                    throw new Error("Failed to fetch dashboard data");
                const data = await response.json();
                dashboardData.value = {
                    products: data.products,
                    customers: data.customers,
                    totalOrder: data.total_order,
                    uncompletedOrder: data.uncompleted_order,
                    completedOrder: data.completed_order,
                    completionRate: data.completion_rate,
                    categories: data.categories,
                };

                initProductOrderedChart();
                initMostOrderedChart();
            } catch (error) {
                console.error("Error fetching dashboard data:", error);
            }
        };

        // Initialize Product Ordered Chart
        const initProductOrderedChart = () => {
            if (productOrderedChart.value) {
                new Chart(productOrderedChart.value.getContext("2d"), {
                    type: "doughnut",
                    data: {
                        labels: ["Uncompleted", "Completed"],
                        datasets: [
                            {
                                data: [
                                    dashboardData.value.uncompletedOrder,
                                    dashboardData.value.completedOrder,
                                ],
                                backgroundColor: [
                                    "rgb(217, 217, 217)",
                                    "rgb(55, 111, 126)",
                                ],
                                hoverOffset: 4,
                            },
                        ],
                    },
                    options: {
                        cutout: "80%",
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false,
                            },
                        },
                    },
                });
            }
        };

        // Initialize Most Ordered Chart
        const initMostOrderedChart = () => {
            if (mostOrderedChart.value) {
                new Chart(mostOrderedChart.value.getContext("2d"), {
                    type: "pie",
                    data: {
                        labels: dashboardData.value.categories.map(
                            (category) => category.name
                        ),
                        datasets: [
                            {
                                label: "percent",
                                data: dashboardData.value.categories.map(
                                    (category) => category.total_order
                                ),
                                backgroundColor: [
                                    "rgb(246, 223, 170)",
                                    "rgb(255, 255, 255)",
                                    "rgb(49, 89, 100)",
                                    "rgb(55, 111, 126)",
                                    "rgb(61, 122, 138)",
                                    "rgb(69, 143, 162)",
                                    "rgb(79, 162, 184)",
                                ],
                                hoverOffset: 4,
                            },
                        ],
                    },
                    options: {
                        cutout: "0%",
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false,
                            },
                            datalabels: {
                                color: "#fff",
                                anchor: "end",
                                align: "end",
                                formatter: (value, context) => {
                                    const label =
                                        context.chart.data.labels[
                                        context.dataIndex
                                        ];
                                    const total =
                                        context.chart.data.datasets[0].data.reduce(
                                            (a, b) => a + b,
                                            0
                                        );
                                    const percentage =
                                        ((value / total) * 100).toFixed(0) +
                                        "%";
                                    return `${label}\n${percentage}`;
                                },
                            },
                        },
                    },
                });
            }
        };

        // Initialize charts on mount
        onMounted(() => {
            // Uncomment to fetch data from API
            fetchDashboardData();
        });

        return {
            dashboardData,
            productOrderedChart,
            mostOrderedChart,
            route,
        };
    },
};
</script>

<style scoped>
/* Add any additional scoped styles if needed */
</style>
