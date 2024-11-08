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
                <li class="ml-auto mr-auto" role="presentation">
                    <button onclick="window.location.href='{{ route('admin.order.index', ['tab' => 'order']) }}'"
                        class="inline-block px-4 pt-4 pb-1 border-b-2 rounded-t-lg" id="order-tab" data-tabs-target="#order"
                        type="button" role="tab" aria-controls="order"
                        aria-selected="{{ $tab == 'order' ? 'true' : 'false' }}">Order</button>
                </li>
                <li class="ml-auto mr-auto" role="presentation">
                    <button onclick="window.location.href='{{ route('admin.order.index', ['tab' => 'confirmation']) }}'"
                        class="inline-block px-4 pt-4 pb-1 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="confirmation-tab" data-tabs-target="#confirmation" type="button" role="tab"
                        aria-controls="confirmation"
                        aria-selected="{{ $tab == 'confirmation' ? 'true' : 'false' }}">Confirmation</button>
                </li>
            </ul>
        </div>

        <!-- Tab Content (showing the content) -->
        <div id="default-tab-content">
            <div class="hidden px-5 rounded-lg h-[80vh] mt-3  overflow-y-scroll no-scrollbar" id="order" role="tabpanel"
                aria-labelledby="order-tab">
                @if ($tab == 'order')
                    @include('admin.order.order')
                @endif
            </div>

            <!-- confirmation Content -->
            <div class="hidden px-5 pt-2 rounded-lg h-[80vh] overflow-y-scroll no-scrollbar" id="confirmation"
                role="tabpanel" aria-labelledby="confirmation-tab">
                @if ($tab == 'confirmation')
                    @include('admin.order.confirmation')
                @endif
            </div>
            {{-- end of confirmation content --}}

        </div>
        <!-- end of tab content -->


    </div>
@endsection
