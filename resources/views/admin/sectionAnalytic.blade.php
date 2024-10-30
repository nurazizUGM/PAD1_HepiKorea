@extends('layout.admin')

@section('title', 'Analytic')

@section('content')
    <div class="bg-[#EFEFEF] border-gray-200 rounded-lg">
        <div class="mb-1">
            <ul class="flex flex-wrap -mb-px text-lg font-bold text-center text-black gap-x-16" id="default-tab"
                data-tabs-toggle="#default-tab-content"
                data-tabs-active-classes="text-black hover:text-black dark:text-purple-500 dark:hover:text-purple-500 border-b-4 border-orange-400 hover:border-orange-400 dark:border-purple-500"
                data-tabs-inactive-classes="dark:border-transparent text-black hover:text-orange-400 dark:text-gray-400 border-transparent hover:border-transparent dark:border-gray-700 dark:hover:text-gray-300"
                role="tablist">
                <!-- Tab product -->
                <li class="ml-auto mr-auto" role="presentation">
                    <button class="inline-block px-4 pt-4 pb-1 border-b-2 rounded-t-lg" id="chart-tab"
                        data-tabs-target="#chart" type="button" role="tab" aria-controls="chart"
                        aria-selected="false">Chart</button>
                </li>
                <!-- Tab  Category-->
                <li class="ml-auto mr-auto" role="presentation">
                    <button
                        class="inline-block px-4 pt-4 pb-1 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="table-tab" data-tabs-target="#table" type="button" role="tab" aria-controls="table"
                        aria-selected="false">Table</button>
                </li>
            </ul>
        </div>

        <!-- Tab Content (showing the content) -->
        <div id="default-tab-content">
            <!-- Chart Content -->
            <div class="hidden px-16 rounded-lg h-[80vh]" id="chart" role="tabpanel" aria-labelledby="chart-tab">
                <!-- analytic title -->
                <h1 class="text-black font-semibold text-xl mb-2 ml-1">Recap</h1>
                <div class="grid grid-cols-3 gap-x-14">
                    <!-- product ordered -->
                    <div class="flex flex-col h-56 bg-gray-50 dark:bg-gray-800 rounded-xl">
                        <div class="w-full h-[15%] text-center mb-auto mt-3">
                            <h1 class="text-black font-bold text-md">
                                Product Ordered
                            </h1>
                        </div>
                        <div class="w-full h-[85%] relative flex items-center justify-center pb-3">
                            <canvas id="chartProductOrdered"></canvas>
                            <div class="absolute flex flex-col items-center justify-center text-center z-10">
                                {{-- text Product Ordered Percent --}}
                                <h2 class="text-3xl font-bold text-black text-opacity-50">55%</h2>
                                <h3 class="text-xs font-semibold text-black text-opacity-50">Complete</h3>
                            </div>
                        </div>
                    </div>
                    <!-- Profile view -->
                    <div class="flex flex-col h-56 bg-gray-50 dark:bg-gray-800 rounded-xl py-4 px-5">
                        <div class="flex w-full  justify-center overflow-hidden">
                            <h2 class="font-semibold text-md">Profile View</h2>
                        </div>
                        <h1 class="text-center my-auto text-5xl font-semibold text-black text-opacity-50">550</h1>
                        <div class="flex flex-row">
                            <div class="flex flex-col mr-auto text-center">
                                <p class="text-orange-400 text-md font-semibold">By User</p>
                                <p class="text-3xl font-semibold text-black text-opacity-50">320</p>
                            </div>
                            <div class="flex flex-col ml-auto text-center">
                                <p class="text-orange-400 text-md font-semibold">By Guest</p>
                                <p class="text-3xl font-semibold text-black text-opacity-50">230</p>
                            </div>
                        </div>
                    </div>

                    <!-- Most Ordered -->
                    <div class="flex flex-col h-56 bg-gray-50 dark:bg-gray-800 rounded-xl">
                        <div class="w-full h-[15%] text-center mb-auto mt-3">
                            <h1 class="text-black font-bold text-md">
                                Most Ordered
                            </h1>
                        </div>
                        <div class="w-full h-[85%] relative flex items-center justify-center pb-3">
                            <canvas id="chartMostOrdered"></canvas>
                        </div>
                        </p>
                    </div>
                </div>
                <!-- line chart -->
                <div class="mt-5">
                    <div class="flex items-center justify-center bg-gray-50 h-[40vh] dark:bg-gray-800 rounded-xl p-5">
                        <canvas id="sementara" class="w-full h-full" style="width: 100%; height: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of chart Content -->





        <!-- Table Content -->
        <div class="hidden px-5 pt-2 rounded-lg h-[80vh]" id="table" role="tabpanel" aria-labelledby="table-tab">
            <div class="w-full h-[98%] rounded-xl bg-white px-3 py-3 overflow-y-scroll no-scrollbar">
                {{-- start of table --}}
                <table class="w-full rtl:text-right rounded-xl overflow-hidden">
                    {{-- table head --}}
                    <thead class="bg-orange-400 rounded-lg text-white font-extralight">
                        <tr>
                            <th class="px-6 py-3 border-white border">No</th>
                            <th class="px-6 py-3 border-white border">Date</th>
                            <th class="px-6 py-3 border-white border">Order ID</th>
                            <th class="px-6 py-3 border-white border">Product Name</th>
                            <th class="px-6 py-3 border-white border">Selling Price</th>
                            <th class="px-6 py-3 border-white border">ID Customer</th>
                        </tr>
                    </thead>
                    {{-- table body --}}
                    <tbody>
                        {{-- temporart dummy (for example) --}}
                        @for ($i = 0; $i < 20; $i++)
                            <tr class="odd:bg-[#D9D9D9] even:bg-[#EFEFEF]">
                                <td class="px-6 py-3 border-white border"> {{ $i + 1 }}</td>
                                <td class="px-6 py-3 border-white border">14/04/45</td>
                                <td class="px-6 py-3 border-white border">28398</td>
                                <td class="px-6 py-3 border-white border">Korean Shirt</td>
                                <td class="px-6 py-3 border-white border">$90909</td>
                                <td class="px-6 py-3 border-white border">123131</td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
                {{-- end of table --}}
            </div>
        </div>
        {{-- end of table content --}}

    </div>
    <!-- end of tab content -->
    </div>

    </div>

    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productOrderedChart = document.getElementById('chartProductOrdered').getContext('2d');

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

        // 
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
                            'rgb(255, 243, 131)',
                            'rgb(255, 208, 87)',
                            'rgb(248, 224, 45)',
                            'rgb(249, 180, 2)',
                            'rgb(253, 91, 0)',
                            'rgb(249, 119, 45)',
                            'rgb(252, 140, 35)',
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

        // line chart
        document.addEventListener('DOMContentLoaded', function() {
            const LineChart = document.getElementById('sementara').getContext('2d');
            new Chart(LineChart, {
                type: 'line',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July','August','September','October','November','December'],
                    datasets: [{
                        label: 'My First Dataset',
                        data: [65, 59, 80, 81, 56, 55, 40, 30, 40, 60, 80, 40],
                        fill: false,
                        borderColor: 'rgb(255, 157, 102)',
                        tension: 0.1
                    }]
                },
                options : {
                    responsive : true,
                    maintainAspectRatio: false
                }
            });
        });
    </script>
@endsection
