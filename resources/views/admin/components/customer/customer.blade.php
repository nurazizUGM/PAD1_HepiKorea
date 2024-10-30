<!-- start of customer content -->
<div class="hidden px-10 rounded-lg h-[80vh]" id="customer" role="tabpanel" aria-labelledby="customer-tab">
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
    <div class="container w-full h-[85%] mt-5 overflow-y-scroll flex flex-wrap flex-row gap-8">
        <!-- card customer -->
        <!-- ini for loop hanya untuk coba -->
        @for ($i = 0; $i < 20; $i++)
            <div class="bg-white w-40 h-52 rounded-lg overflow-hidden flex flex-col">
                <!-- image customer card -->
                <div class="w-full h-2/3 bg-cover bg-top"
                    style="background-image: url('{{ asset('img/example/test_shirt.jpg') }}');">
                </div>
                <!-- header & detail customer card -->
                <div class="p-2">
                    <p class="text-sm font-bold truncate">Korean Fashion Set</p>
                    <p class="text-sm font-semi">Blouse</p>
                </div>
                <!-- edit & delete customer card -->
                <div class="flex mt-auto mx-3 mb-3">
                    <!-- edit icon -->
                    <a href="#" class="ml-auto">
                        <img src="{{ asset('img/assets/icon/icon_admin_customer_edit.svg') }}" alt="">
                    </a>
                </div>
            </div>
        @endfor
    </div>
    <!-- end of product card container -->
</div>
<!-- End of Product Content -->
