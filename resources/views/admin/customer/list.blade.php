<!-- start of customer content -->
<div class="hidden flex px-10 rounded-lg h-[80vh]" id="customer" role="tabpanel" aria-labelledby="customer-tab">
    <div id="customer-list" class="h-full {{ $tab != 'customer' ? 'hidden' : '' }}">
        @if ($tab == 'customer')
            <div class="w-full flex items-center">
                <!-- search bar -->
                <div class="flex items-center mr-auto">
                    <!-- Search input -->
                    <div class="relative flex items-center w-full">
                        <img src="{{ asset('img/assets/icon/icon_admin_search_searchbar.svg') }}" alt="search icon"
                            class="absolute left-3 w-5 h-5 text-gray-500">
                        <form action="{{ route('admin.customer.index') }}" method="GET">
                            <input type="text" id="search" name="search"
                                value="{{ request()->query('search') ?? '' }}"
                                class="block w-[25vw] pl-10 py-2 text-gray-900 bg-white border border-white rounded-full focus:ring-0 focus:border-none placeholder:text-sm placeholder:text-start"
                                placeholder="Search...">
                        </form>
                    </div>
                </div>
                <!-- end of search bar -->
            </div>
            <!-- start of customer card container -->
            <div class="w-full h-[85%] mt-5 flex flex-wrap flex-row gap-8 overflow-y-auto no-scrollbar justify-start items-start content-start">
                <!-- card customer -->
                @foreach ($customers as $customer)
                    <div class="bg-white w-40 h-52 rounded-lg overflow-hidden flex flex-col"
                        onclick="window.location.href='{{ route('admin.customer.show', $customer->id) }}'">
                        <!-- image customer card -->
                        <div class="w-full h-4/6">
                            <img src="{{ $customer->photo && Storage::exists('public/profile/' . $customer->photo) ? asset('storage/profile/' . $customer->photo) : asset('img/assets/icon/icon_user.svg') }}"
                                alt="customer photo" class="w-full h-full object-cover object-top">
                        </div>
                        <!-- header & detail customer card -->
                        <div class="p-2 h-1/6">
                            <p class="text-[#376F7E] text-sm font-bold truncate">{{ $customer->fullname }}</p>
                        </div>
                        <!-- edit & delete customer card -->
                        <div class="flex mx-3 mb-2 h-1/6">
                            <!-- edit icon -->
                            <a href="{{ route('admin.customer.show', $customer->id) }}" class="ml-auto">
                                <img src="{{ asset('img/assets/icon/icon_user_profile.svg') }}" alt="Customer Profile"
                                    class="h-full">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- end of product card container -->
    <div id="customer-profile" class="{{ $tab != 'customer.profile' ? 'hidden' : '' }} w-full">
        @if ($tab == 'customer.profile')
            @include('admin.customer.profile')
        @endif
    </div>
</div>
<!-- End of Product Content -->
