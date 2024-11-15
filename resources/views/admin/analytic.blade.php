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
                        onclick="window.history.pushState({}, '', '{{ route('admin.analytic.index', ['tab' => 'chart']) }}')"
                        data-tabs-target="#chart" type="button" role="tab" aria-controls="chart"
                        aria-selected="{{ $tab == 'chart' ? 'true' : 'false' }}">Chart</button>
                </li>
                <!-- Tab  Category-->
                <li class="ml-auto mr-auto" role="presentation">
                    <button
                        onclick="window.history.pushState({}, '', '{{ route('admin.analytic.index', ['tab' => 'table']) }}')"
                        class="inline-block px-4 pt-4 pb-1 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="table-tab" data-tabs-target="#table" type="button" role="tab" aria-controls="table"
                        aria-selected="{{ $tab == 'table' ? 'true' : 'false' }}">Table</button>
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
                                Completed Orders
                            </h1>
                        </div>
                        <div class="w-full h-[85%] relative flex items-center justify-center pb-3">
                            <canvas id="chartProductOrdered"></canvas>
                            <div class="absolute flex flex-col items-center justify-center text-center z-10">
                                {{-- text Product Ordered Percent --}}
                                <h2 class="text-3xl font-bold text-black text-opacity-50">
                                    {{ number_format(($completedOrder / $totalOrder) * 100, 0) }}%</h2>
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
                                <p class="text-[#376F7E] text-md font-semibold">By User</p>
                                <p class="text-3xl font-semibold text-black text-opacity-50">320</p>
                            </div>
                            <div class="flex flex-col ml-auto text-center">
                                <p class="text-[#376F7E] text-md font-semibold">By Guest</p>
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
        <div class="hidden px-5 pt-2 rounded-lg h-[85vh] flex flex-col" id="table" role="tabpanel"
            aria-labelledby="table-tab">
            <div class="flex justify-between items-center mb-2">
                <h1 class="text-black font-semibold text-xl ml-1">Orders</h1>
                <div class="flex">
                    <form id="form-filter" action="{{ route('admin.analytic.index') }}" method="get" class="flex">
                        <input type="hidden" name="category" value="{{ request()->query('category') }}">
                        <div class="relative flex items-center w-full">
                            <img src="{{ asset('img/assets/icon/icon_admin_search_searchbar.svg') }}" alt="search icon"
                                class="absolute left-3 w-5 h-5 text-gray-500">
                            <input type="hidden" name="tab" value="table">
                            <input type="text" id="search" name="search" value="{{ request()->query('search') }}"
                                class="block w-[25vw] pl-10 py-2 text-gray-900 bg-white border border-white rounded-full focus:ring-0 focus:border-none placeholder:text-sm placeholder:text-start"
                                placeholder="Search...">
                        </div>

                        <!-- Filter button -->
                        <button type="submit"
                            class="inline-flex items-center pl-4 pr-6 py-2 font-semibold text-white bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] rounded-full -ml-20 z-10">
                            <img class="w-4 h-4 mr-2"
                                style="filter: brightness(0) saturate(100%) invert(100%) sepia(100%) saturate(1%) hue-rotate(266deg) brightness(107%) contrast(101%);"
                                src="{{ asset('img/assets/icon/icon_admin_search_searchbar.svg') }}" alt="">
                            Search
                        </button>
                    </form>
                </div>
            </div>
            <div class="w-full h-auto mb-3 rounded-xl bg-white overflow-y-scroll no-scrollbar">
                {{-- start of table --}}
                <table class="w-full rtl:text-right rounded-xl overflow-hidden">
                    {{-- table head --}}
                    <thead class="bg-[#3E6E7A] rounded-lg text-white font-extralight">
                        <tr>
                            <th class="px-6 py-3 border-white border">No</th>
                            <th class="px-6 py-3 border-white border">Date</th>
                            <th class="px-6 py-3 border-white border">Type</th>
                            <th class="px-6 py-3 border-white border">Product Name</th>
                            <th class="px-6 py-3 border-white border">Selling Price</th>
                            <th class="px-6 py-3 border-white border">Customer Name</th>
                        </tr>
                    </thead>
                    {{-- table body --}}
                    <tbody>
                        {{-- temporart dummy (for example) --}}
                        @foreach ($orders as $order)
                            <tr class="odd:bg-[#D9D9D9] even:bg-[#EFEFEF]">
                                <td rowspan="{{ $order->type == 'order' ? $order->orderItems->count() : $order->customOrderItems->count() }}"
                                    class="px-6 py-3 border-white border"> {{ $loop->iteration }}</td>
                                <td rowspan="{{ $order->type == 'order' ? $order->orderItems->count() : $order->customOrderItems->count() }}"
                                    class="px-6 py-3 border-white border">{{ $order->created_at->format('d/m/o') }}</td>
                                <td rowspan="{{ $order->type == 'order' ? $order->orderItems->count() : $order->customOrderItems->count() }}"
                                    class="px-6 py-3 border-white border text-center">
                                    {{ $order->type == 'order' ? 'Regular Order' : 'Custom Request' }}</td>
                                @if ($order->type == 'order')
                                    <td class="px-6 py-3 border-white border">
                                        {{ $order->orderItems->first()->product->name }}
                                    </td>
                                    <td class="px-6 py-3 border-white border text-right">
                                        Rp {{ number_format($order->orderItems->first()->price, 0, ',', '.') }}
                                    </td>
                                @else
                                    <td class="px-6 py-3 border-white border">
                                        {{ $order->customOrderItems->first()->name }}
                                    </td>
                                    <td class="px-6 py-3 border-white border text-right">
                                        Rp {{ number_format($order->customOrderItems->first()->total_price, 0, ',', '.') }}
                                    </td>
                                @endif
                                <td rowspan="{{ $order->type == 'order' ? $order->orderItems->count() : $order->customOrderItems->count() }}"
                                    class="px-6 py-3 border-white border">
                                    {{ $order->user->fullname }}
                                </td>
                            </tr>
                            @if ($order->type == 'order' && $order->orderItems->count() > 1)
                                @foreach ($order->orderItems->skip(1) as $item)
                                    <tr class="odd:bg-[#D9D9D9] even:bg-[#EFEFEF]">
                                        <td class="px-6 py-3 border-white border">
                                            {{ $item->product->name }}
                                        </td>
                                        <td class="px-6 py-3 border-white border text-right">
                                            Rp {{ number_format($item->price, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            @elseif ($order->type == 'custom' && $order->customOrderItems->count() > 1)
                                @foreach ($order->customOrderItems->skip(1) as $item)
                                    <tr class="odd:bg-[#D9D9D9] even:bg-[#EFEFEF]">
                                        <td class="px-6 py-3 border-white border">
                                            {{ $item->name }}
                                        </td>
                                        <td class="px-6 py-3 border-white border text-right">
                                            Rp {{ number_format($item->total_price, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        @endforeach
                    </tbody>
                </table>
                {{-- end of table --}}
            </div>

            <button onclick="window.location.href='{{ route('admin.analytic.export') }}'"
                class="font-semibold text-white bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] px-4 py-2 ml-2 rounded-full inline-flex align-middle fixed bottom-8 right-10">
                <svg xmlns="http://www.w3.org/2000/svg" class="mt-1 mr-1" width="1.13em" height="1em"
                    viewBox="0 0 576 512">
                    <path fill="currentColor"
                        d="M0 64C0 28.7 28.7 0 64 0h160v128c0 17.7 14.3 32 32 32h128v128H216c-13.3 0-24 10.7-24 24s10.7 24 24 24h168v112c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64zm384 272v-48h110.1l-39-39c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l80 80c9.4 9.4 9.4 24.6 0 33.9l-80 80c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l39-39zm0-208H256V0z" />
                </svg>
                Export</button>
        </div>
        {{-- end of table content --}}
    </div>


    {{-- MODALS FOR ANALYTIC --}}

    {{-- success export modal --}}
    <div id="success-export-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-fit max-w-5xl max-h-full mt-20">
            <!-- Modal content -->
            <div class="bg-white w-[25vw] h-auto rounded-[30px] shadow">
                <div class="relative w-full h-full flex flex-row">
                    <div class="w-full h-full flex flex-col p-14">
                        <h1 class="text-black text-xl font-medium mx-auto">Your File Has Been Exported</h1>
                        <img src="{{ asset('img/assets/icon/icon_green_check.svg') }}" alt="green_check"
                            class="w-24 h-24 mx-auto mt-6">
                    </div>
                    {{-- end of modal content --}}
                </div>
            </div>
            <!-- end of modal content -->
        </div>
    </div>
    {{-- end of success export modal --}}

    {{-- END OF MODALS FOR ANALYTIC --}}


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productOrderedChart = document.getElementById('chartProductOrdered').getContext('2d');

            // 
            new Chart(productOrderedChart, {
                type: 'doughnut',
                data: {
                    labels: [
                        'Uncompleted',
                        'Completed'
                    ],
                    datasets: [{
                        data: [{{ $totalOrder - $completedOrder }}, {{ $completedOrder }}],
                        backgroundColor: [
                            'rgb(217, 217, 217)',
                            'rgb(55, 111, 126)'
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
                    labels: {!! $categories->pluck('name')->toJson() !!},
                    datasets: [{
                        label: 'Orders:',
                        data: {!! $categories->pluck('total_order')->toJson() !!},
                        backgroundColor: [
                            'rgb(246, 223, 170)',
                            'rgb(255, 255, 255)',
                            'rgb(49, 89, 100)',
                            'rgb(55, 111, 126)',
                            'rgb(61, 122, 138)',
                            'rgb(69, 143, 162)',
                            'rgb(79, 162, 184)',
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
                    labels: {!! json_encode($month) !!},
                    datasets: [{
                        label: 'Monthly Orders',
                        data: {!! json_encode($monthlyOrders) !!},
                        fill: false,
                        borderColor: 'rgb(55, 111, 126)',
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        });
    </script>
@endsection
