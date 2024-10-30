@extends('layout.admin')
@section('title', ' Dashboard')

@section('content')
    <!-- ilangin scroll -->
    <div class="p-4 border-2 bg-[#EFEFEF] border-gray-200 rounded-lg dark:border-gray-700 h-[88vh] ">
        <!-- dashboard title -->
        <h1 class="text-black font-bold text-xl mb-2 -mt-2">Dashboard</h1>
        <div class="grid grid-cols-3 gap-8 mb-4">
            <!-- product -->
            <div class="flex flex-col h-48 bg-gray-50 dark:bg-gray-800 rounded-xl">
                <div class="mb-auto flex w-full px-4 py-3 justify-between overflow-hidden">
                    <!-- product count -->
                    <p class="text-6xl font-bold">{{ $products }}</p>
                    <!-- product icon -->
                    <img src="{{ asset('img/assets/icon/icon_dashboard_product.svg') }}" alt="product Icon"
                        class="h-12 w-12 grayscale">
                </div>
                <div class="bg-orange-400 w-full mt-auto text-center text-white font-semibold text-lg py-2 rounded-b-xl">
                    Products
                </div>
            </div>
            <!-- Order -->
            <div class="flex flex-col h-48 bg-gray-50 dark:bg-gray-800 rounded-xl">
                <div class="mb-auto flex w-full px-4 py-3 justify-between overflow-hidden">
                    <!-- Order count -->
                    <p class="text-6xl font-bold">{{ $orders }}</p>
                    <!-- Order icon -->
                    <img src="{{ asset('img/assets/icon/icon_dashboard_order.svg') }}" alt="Order Icon"
                        class="h-12 w-12 grayscale">
                </div>
                <div class="bg-orange-400 w-full mt-auto text-center text-white font-semibold text-lg py-2 rounded-b-xl">
                    Order
                </div>
            </div>
            <!-- customer -->
            <div class="flex flex-col h-48 bg-gray-50 dark:bg-gray-800 rounded-xl">
                <div class="mb-auto flex w-full px-4 py-3 justify-between overflow-hidden">
                    <!-- Customer count -->
                    <p class="text-6xl font-bold">{{ $customers }}</p>
                    <!-- Customer icon -->
                    <img src="{{ asset('img/assets/icon/icon_dashboard_customer.svg') }}" alt="Customer Icon"
                        class="h-12 w-12 grayscale">
                </div>
                <div class="bg-orange-400 w-full mt-auto text-center text-white font-semibold text-lg py-2 rounded-b-xl">
                    Customer
                </div>
            </div>
        </div>
        <!-- product ordered n most ordered -->
        <div class="grid grid-cols-2 gap-4 mt-2">
            {{--  Product Ordered --}}
            <div class="flex flex-col items-center justify-center bg-gray-50 h-[51vh] dark:bg-gray-800 rounded-xl">
                <div class="w-full h-[15%] text-center mb-auto pt-3">
                    <h1 class="text-black font-bold text-2xl">
                        Product Ordered
                    </h1>
                </div>
                <div class="w-full h-[85%] relative flex items-center justify-center pb-3">
                    <canvas id="chartProductOrdered"></canvas>
                    <div class="absolute flex flex-col items-center justify-center text-center z-10">
                        {{-- text Product Ordered Percent --}}
                        <h2 class="text-7xl font-bold text-black text-opacity-50">55%</h2>
                        <h3 class="text-2xl font-semibold text-black text-opacity-50">Complete</h3>
                    </div>
                </div>
            </div>
            {{-- Most Ordered --}}
            <div class="flex flex-col items-center justify-center bg-gray-50 h-[51vh] dark:bg-gray-800 rounded-xl">
                <div class="w-full h-[15%] text-center mb-auto pt-3">
                    <h1 class="text-black font-bold text-2xl">
                        Most Ordered
                    </h1>
                </div>
                <div class="w-full h-[85%] relative flex items-center justify-center pb-3">
                    <canvas id="chartMostOrdered"></canvas>
                </div>
                </p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('myChart').getContext('2d');

            new Chart(productOrderedChart, {
                type: 'doughnut',
                data: {
                    labels: [
                        'Uncompleted',
                        'Completed'
                    ],
                    datasets: [{
                        data: [45, 55],
                        backgroundColor: [
                            'rgb(217, 217, 217)',
                            'rgb(255, 157, 102)'
                        ],
                        hoverOffset: 4
                    }]
                },
                options: {
                    cutout: '80%', // Adjust this percentage for thickness
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false, // Set to true if you want to show the legend
                        }
                    }
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const productMostChart = document.getElementById('chartMostOrdered').getContext('2d');

            new Chart(productMostChart, {
                type: 'pie',
                data: {
                    labels: [
                        'Music',
                        'Beauty',
                        'Electronic',
                        'Healthy',
                        'Fashion',
                        'Merchandise',
                        'Food'
                    ],
                    datasets: [{
                        label: 'percent',
                        data: [5, 5, 10, 10, 40, 10, 20],
                        backgroundColor: [
                            'rgb(252, 132, 132)',
                            'rgb(246, 223, 170)',
                            'rgb(256, 256, 256)',
                            'rgb(217, 217, 217)',
                            'rgb(255, 157, 102)',
                            'rgb(248, 191, 45)',
                            'rgb(255, 240, 107)',
                        ],
                        hoverOffset: 4
                    }]
                },
                options: {
                    cutout: '0%', // Adjust this percentage for thickness
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false, // Set to true if you want to show the legend
                        },
                        datalabels: {
                            color: '#fff', // Text color
                            anchor: 'end', // Where to place the label
                            align: 'end', // Align the label
                            formatter: (value, context) => {
                                let label = context.chart.data.labels[context.dataIndex];
                                let percentage = ((value / context.chart.data.datasets[0].data.reduce((
                                    a, b) => a + b, 0)) * 100).toFixed(0) + '%';
                                return label + '\n' + percentage; // Label to show
                            }
                        }
                    }
                }
            });
        });
    </script>

@endsection
