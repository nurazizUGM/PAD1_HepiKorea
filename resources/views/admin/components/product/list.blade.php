<!-- start of product content -->
<div class="hidden px-10 rounded-lg h-[80vh]" id="product" role="tabpanel" aria-labelledby="product-tab">
    <div class="w-full flex items-center">
        <!-- Category Dropdown -->
        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
            class="text-black bg-white hover:bg-slate-100 focus:outline-none focus:ring-0 font-semibold rounded-lg text-sm px-5 py-2.5 justify-between flex items-center w-1/6"
            type="button">
            <span class="flex-1 text-left">Category</span>
            <svg class="w-2.5 h-2.5 ml-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 4 4 4-4" />
            </svg>
        </button>
        <!-- Dropdown menu -->
        <div id="dropdown"
            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
            <ul class="py-2 text-sm text-[#B7B7B7] dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                <li>
                    <a href="#"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Fashion</a>
                </li>
                <li>
                    <a href="#"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Merchandise</a>
                </li>
                <li>
                    <a href="#"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Beauty</a>
                </li>
                <li>
                    <a href="#"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Electronic</a>
                </li>
                <li>
                    <a href="#"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Food</a>
                </li>
                <li>
                    <a href="#"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Health</a>
                </li>
                <li>
                    <a href="#"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Music</a>
                </li>
            </ul>
        </div>
        <!-- plus button -->
        <a href="#" class="ml-5">
            <img src="{{ asset('img/assets/icon/icon_admin_product_plus.svg') }}" alt="plus icon"
                class="w-10 h-10 fill-orange-400">
        </a>

        <!-- text Add Product -->
        <h2 class="text-black text-md ml-3 font-semibold">Add Product</h2>

        <!-- search bar -->
        <div class="flex items-center ml-auto">
            <!-- Search input -->
            <div class="relative flex items-center w-full">
                <img src="{{ asset('img/assets/icon/icon_admin_search_searchbar.svg') }}" alt="search icon"
                    class="absolute left-3 w-5 h-5 text-gray-500">
                <input type="text" id="search"
                    class="block w-[25vw] pl-10 py-2 text-gray-900 bg-white border border-white rounded-full focus:ring-0 focus:border-none placeholder:text-sm placeholder:text-start"
                    placeholder="Search...">
            </div>

            <!-- Filter button -->
            <button type="button"
                class="inline-flex items-center px-4 py-2 font-semibold text-white bg-orange-400 hover:bg-orange-500 rounded-full -ml-20 z-10">
                <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 4h18M9 8h6M6 12h12m-9 4h6" />
                </svg>
                Filter
            </button>
        </div>
        <!-- end of search bar -->


    </div>
    <!-- start of product card container -->
    <div class="container w-full h-[85%] mt-5 overflow-y-scroll flex flex-wrap flex-row gap-8">
        <!-- card product -->
        <!-- ini for loop hanya untuk coba -->
        @for ($i = 0; $i < 20; $i++)
            <div class="bg-white w-40 h-52 rounded-lg overflow-hidden flex flex-col">
                <!-- image product card -->
                <div class="w-full h-2/3 bg-cover bg-top"
                    style="background-image: url('{{ asset('img/example/test_shirt.jpg') }}');">
                </div>
                <!-- header & detail product card -->
                <div class="p-2">
                    <p class="text-sm font-bold truncate">Korean Fashion Set</p>
                    <p class="text-sm font-semi">Blouse</p>
                </div>
                <!-- edit & delete product card -->
                <div class="flex mt-auto mx-3 mb-3">
                    <!-- edit icon -->
                    <a href="#" class="mr-auto">
                        <img src="{{ asset('img/assets/icon/icon_admin_product_edit.svg') }}" alt="">
                    </a>
                    <!-- delete icon -->
                    <a href="#" class="ml-auto">
                        <img src="{{ asset('img/assets/icon/icon_admin_product_trash.svg') }}" alt="">
                    </a>
                </div>
            </div>
        @endfor
    </div>
    <!-- end of product card container -->

</div>
<!-- End of Product Content -->