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
                <div class="grid grid-cols-3 gap-x-14 mb-4">
                    <!-- product ordered -->
                    <div class="flex flex-col h-56 bg-gray-50 dark:bg-gray-800 rounded-xl">
                        <div class="mb-auto flex w-full px-4 py-3 justify-center overflow-hidden">
                            <h2 class="font-semibold text-md">Product Ordered</h2>
                        </div>
                        {{-- add chart here --}}
                    </div>
                    <!-- Profile view -->
                    <div class="flex flex-col h-56 bg-gray-50 dark:bg-gray-800 rounded-xl">
                        <div class="mb-auto flex w-full px-4 py-3 justify-center overflow-hidden">
                            <h2 class="font-semibold text-md">Profile View</h2>
                        </div>
                        {{-- add Stats here --}}
                    </div>
                    <!-- Most Ordered -->
                    <div class="flex flex-col h-56 bg-gray-50 dark:bg-gray-800 rounded-xl">
                        <div class="mb-auto flex w-full px-4 py-3 justify-center overflow-hidden">
                            <h2 class="font-semibold text-md">Most Ordered</h2>
                        </div>
                        {{-- add chart here --}}
                    </div>
                </div>
                <!-- line chart -->
                <div class="grid grid-cols-1 gap-4 mt-2">
                    <div class="flex items-center justify-center bg-gray-50 h-[40vh] dark:bg-gray-800 rounded-xl">
                        <p class="text-2xl text-gray-400 dark:text-gray-500">
                            {{-- add line chart here --}}
                        </p>
                    </div>
                </div>
            </div>
            <!-- end of chart Content -->


            


            <!-- Table Content -->
            <div class="hidden px-5 pt-2 rounded-lg h-[80vh]" id="table" role="tabpanel" aria-labelledby="table-tab">
                <div class="w-full h-[98%] bg-white px-3 pt-3 overflow-y-scroll">
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
@endsection
