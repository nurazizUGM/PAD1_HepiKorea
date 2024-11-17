<div id="list_product" class="h-full flex flex-col">
    <div class="w-full flex items-center">
        <!-- Category Dropdown -->
        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
            class="text-black bg-white hover:bg-slate-100 focus:outline-none focus:ring-0 font-semibold rounded-lg text-sm px-5 py-2.5 justify-between flex items-center w-1/6"
            type="button">
            <span class="flex-1 text-left">
                @isset($category)
                    {{ $category->name }}
                @else
                    Category
                @endisset
            </span>
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
                    <a href="#" onclick="changeCategory('')"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">All</a>
                </li>
                @foreach ($categories as $category)
                    <li>
                        <a href="#" onclick="changeCategory('{{ $category->id }}')"
                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ $category->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- plus button -->
        <div class="flex gap-1 ms-3 cursor-pointer"
            onclick="window.location.href='{{ route('admin.product.create') }}'">
            <img src="{{ asset('img/assets/icon/icon_admin_product_plus.svg') }}" alt="plus icon"
                class="w-10 h-10 fill-orange-400">

            <!-- text Add Product -->
            <h2 class="text-black text-md my-auto font-semibold">Add Product</h2>
        </div>

        <!-- search bar -->
        <div class="ml-auto">
            <!-- Search input -->
            <form id="form-filter" action="{{ route('admin.product.index') }}" method="get" class="flex items-center">
                <input type="hidden" name="category" value="{{ request()->query('category') }}">
                <div class="relative flex items-center w-full">
                    <img src="{{ asset('img/assets/icon/icon_admin_search_searchbar.svg') }}" alt="search icon"
                        class="absolute left-3 w-5 h-5 text-gray-500">
                    <input type="text" id="search" name="search" value="{{ request()->query('search') }}"
                        class="block w-[25vw] pl-10 py-2 text-gray-900 bg-white border border-white rounded-full focus:ring-0 focus:border-none placeholder:text-sm placeholder:text-start"
                        placeholder="Search...">
                </div>

                <!-- Filter button -->
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 font-semibold text-white bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] rounded-full -ml-20 z-10">
                    <img class="w-4 h-4 mr-2"
                        style="filter: brightness(0) saturate(100%) invert(100%) sepia(100%) saturate(1%) hue-rotate(266deg) brightness(107%) contrast(101%);"
                        src="{{ asset('img/assets/icon/icon_admin_search_searchbar.svg') }}" alt="">
                    Search
                </button>
            </form>
        </div>
        <!-- end of search bar -->


    </div>
    <!-- start of product card container -->
    <div class="container w-full h-full mt-5 mb-8 overflow-y-auto flex flex-row flex-wrap gap-8">
        <!-- card product -->
        @foreach ($products as $product)
            <div class="bg-white w-40 h-52 rounded-lg overflow-hidden flex flex-col overflow-y-auto">
                <!-- image product card -->
                @if ($image = $product->images->first()?->path)
                    <div class="w-full h-2/3 bg-cover bg-top"
                        style="background-image: url('{{ Storage::exists('public/products/' . $image) ? asset('storage/products/' . $image) : $image }}');">
                    </div>
                @else
                    <div class="w-full h-2/3 bg-cover bg-top"
                        style="background-image: url('https://placehold.co/200');">
                    </div>
                @endif
                <!-- header & detail product card -->
                <div class="p-2">
                    <p class="text-sm font-bold truncate">{{ $product->name }}</p>
                    <p class="text-sm font-semi">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>
                <!-- edit & delete product card -->
                <div class="flex mt-auto mx-3 mb-3">
                    <!-- edit icon -->
                    <a href="{{ route('admin.product.edit', $product->id) }}" class="mr-auto">
                        <img src="{{ asset('img/assets/icon/icon_admin_product_edit.svg') }}" alt="">
                    </a>
                    <!-- delete icon -->
                    <form action="{{ route('admin.product.delete', $product->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="ml-auto">
                            <img src="{{ asset('img/assets/icon/icon_admin_product_trash.svg') }}" alt="">
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
    <!-- end of product card container -->
</div>


{{-- MODALS --}}

{{-- delete confirmation modal --}}
<div id="confirmation-delete-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-fit max-w-5xl max-h-full mt-20">
        <!-- Modal content -->
        <div class="bg-white w-[33vw] h-auto rounded-[30px] shadow">
            <div class="relative w-full h-full flex flex-row">
                <div class="w-full h-full flex flex-col px-10 py-10">
                    <img src="{{ asset('img/assets/icon/icon_warning.svg') }}" alt="icon_warning"
                        class="w-16 h-16 mx-auto">
                    <p class="text-[#376F7E] font-medium text-xl mx-auto mt-2">Are you sure?</p>
                    <p class="text-[#B7B7B7] font-medium text-xs mx-auto mt-6">You won’t be able to revert
                        this!</p>
                    <div class="w-full h-full mt-6 flex flex-row justify-center">
                        <button class="w-44 h-11 bg-[#376F7E] rounded-[20px] shadow-lg text-white text-lg font-semibold"
                            data-modal-hide="confirmation-delete-modal" data-modal-target="success-delete-modal"
                            data-modal-toggle="success-delete-modal">Yes, Delete it!</button>
                        {{-- success-delete-modal --}}
                        <button
                            class="w-44 h-11 bg-[#FF9D66] rounded-[20px] shadow-lg text-white text-lg font-semibold ml-2"
                            data-modal-hide="confirmation-delete-modal">Cancel</button>
                    </div>
                </div>
                {{-- end of modal content --}}
            </div>
        </div>
        <!-- end of modal content -->
    </div>
</div>
{{-- end of delete confirmation modal --}}

{{-- success delete modal --}}
<div id="success-delete-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-fit max-w-5xl max-h-full mt-20">
        <!-- Modal content -->
        <div class="bg-white w-[25vw] h-auto rounded-[30px] shadow">
            <div class="relative w-full h-full flex flex-row">
                <div class="w-full h-full flex flex-col p-14">
                    <h1 class="text-black text-xl font-medium mx-auto">Successfully Deleted!</h1>
                    <img src="{{ asset('img/assets/icon/icon_green_check.svg') }}" alt="green_check"
                        class="w-24 h-24 mx-auto mt-6">
                </div>
                {{-- end of modal content --}}
            </div>
        </div>
        <!-- end of modal content -->
    </div>
</div>
{{-- end of success delete modal --}}

{{-- end of MODALS --}}

<script>
    function changeCategory(category) {
        $('#form-filter input[name="category"]').val(category);
        $('#form-filter').submit();
    }
</script>
