@extends('layout.admin')
@section('title', 'Customer')

@section('content')
    <div class="bg-[#EFEFEF] border-gray-200 rounded-lg">
        <!-- Tabs (customer, review) -->
        <div class="mb-3">
            <ul class="flex flex-wrap -mb-px text-lg font-bold text-center text-black gap-x-16" id="default-tab"
                data-tabs-toggle="#default-tab-content"
                data-tabs-active-classes="text-black hover:text-black dark:text-purple-500 dark:hover:text-purple-500 border-b-4 border-orange-400 hover:border-orange-400 dark:border-purple-500"
                data-tabs-inactive-classes="dark:border-transparent text-black hover:text-orange-400 dark:text-gray-400 border-transparent hover:border-transparent dark:border-gray-700 dark:hover:text-gray-300"
                role="tablist">
                <!-- Tab customer -->
                <li class="mr-auto ml-auto" role="presentation">
                    <button onclick="window.location.href='{{ route('admin.customer.index') }}'"
                        class="inline-block px-4 pt-4 pb-1 border-b-2 rounded-t-lg" id="customer-tab"
                        data-tabs-target="#customer" type="button" role="tab" aria-controls="customer"
                        aria-selected="{{ str_starts_with($tab, 'customer') ? 'true' : 'false' }}">Customer</button>
                </li>
                <!-- Tab  review-->
                <li class="mr-auto ml-auto" role="presentation">
                    <button onclick="window.location.href='{{ route('admin.customer.review') }}'"
                        class="inline-block px-4 pt-4 pb-1 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="review-tab" data-tabs-target="#review" type="button" role="tab" aria-controls="review"
                        aria-selected="{{ $tab == 'review' ? 'true' : 'false' }}">Review</button>
                </li>
            </ul>
        </div>

        <!-- Tab Content (showing the content) -->
        <div id="default-tab-content">
            <!-- customer Content -->
            @include('admin.customer.list')
            <!-- end of customer Content -->

            <!-- review Content -->
            @include('admin.customer.review')
            <!-- End of review Content -->
        </div>
    </div>
@endsection
