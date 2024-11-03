<!-- start of customer content -->
<div class="hidden flex px-10 rounded-lg h-[80vh]" id="customer" role="tabpanel" aria-labelledby="customer-tab">
    <div id="customer-list" class="h-full">
        <div class="w-full flex items-center">
            <!-- search bar -->
            <div class="flex items-center mr-auto">
                <!-- Search input -->
                <div class="relative flex items-center w-full">
                    <img src="{{ asset('img/assets/icon/icon_admin_search_searchbar.svg') }}" alt="search icon"
                        class="absolute left-3 w-5 h-5 text-gray-500">
                    <input type="text" id="search"
                        class="block w-[25vw] pl-10 py-2 text-gray-900 bg-white border border-white rounded-full focus:ring-0 focus:border-none placeholder:text-sm placeholder:text-start"
                        placeholder="Search...">
                </div>
            </div>
            <!-- end of search bar -->
        </div>
        <!-- start of customer card container -->
        <div class="w-full h-[85%] mt-5 flex flex-wrap flex-row gap-8 overflow-y-auto no-scrollbar">
            <!-- card customer -->
            @foreach ($customers as $customer)
                <div class="bg-white w-40 h-52 rounded-lg overflow-hidden flex flex-col">
                    <!-- image customer card -->
                    <div class="w-full h-2/3">
                        @if ($customer->photo && Storage::exists('storage/' . $customer->photo))
                            <img src="{{ asset('storage/' . $customer->photo) }}" alt="customer photo"
                                class="w-full h-full object-cover">
                        @endif
                    </div>
                    <!-- header & detail customer card -->
                    <div class="p-2">
                        <p class="text-sm font-bold truncate">{{ $customer->fullname }}</p>
                    </div>
                    <!-- edit & delete customer card -->
                    <div class="flex mt-auto mx-3 mb-3">
                        <!-- edit icon -->
                        <a href="{{ route('admin.customer.edit', $customer->id) }}" class="ml-auto">
                            <img src="{{ asset('img/assets/icon/icon_admin_product_edit.svg') }}" alt="">
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- end of product card container -->
    <div id="customer-profile" class="hidden overflow-y-auto">
        @include('admin.customer.profile')
    </div>
</div>

@section('script')
    <script>
        function showCreate(event) {
            event.preventDefault();
            document.getElementById('customer-list').classList.add('hidden');
            document.getElementById('customer-profile').classList.remove('hidden');
        }
    </script>
@endsection
<!-- End of Product Content -->
