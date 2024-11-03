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
                    <button class="inline-block px-4 pt-4 pb-1 border-b-2 rounded-t-lg" id="order-tab"
                        data-tabs-target="#order" type="button" role="tab" aria-controls="order"
                        aria-selected="false">Order</button>
                </li>
                <!-- Tab  Category-->
                <li class="ml-auto mr-auto" role="presentation">
                    <button
                        class="inline-block px-4 pt-4 pb-1 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="confirmation-tab" data-tabs-target="#confirmation" type="button" role="tab"
                        aria-controls="confirmation" aria-selected="false">Confirmation</button>
                </li>
            </ul>
        </div>

        <!-- Tab Content (showing the content) -->
        <div id="default-tab-content">
            @include('admin.components.order.orderContent')


            {{--  --}}
            {{--  --}}
            {{--  --}}


            <!-- confirmation Content -->
            <div class="hidden px-5 pt-2 rounded-lg h-[80vh] overflow-y-scroll no-scrollbar" id="confirmation"
                role="tabpanel" aria-labelledby="confirmation-tab">
                {{-- User Name container --}}
                <div class="w-1/4 bg-white px-3 py-1">
                    <h1 class="text-2xl text-black font-semibold">Aisyah</h1>
                </div>
                {{-- list of order confirmation container--}}
                <div>
                    
                </div>
            </div>
            {{-- end of confirmation content --}}

        </div>
        <!-- end of tab content -->

        
    </div>
@endsection
