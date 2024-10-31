@extends('layout.admin')
@section('title', 'Product')

@section('content')
    <div class="bg-[#EFEFEF] border-gray-200 rounded-lg">
        <!-- Tabs (product, category, carousel) -->
        <div class="mb-3">
            <ul class="flex flex-wrap -mb-px text-lg font-bold text-center text-black gap-x-16" id="default-tab"
                data-tabs-toggle="#default-tab-content"
                data-tabs-active-classes="text-black hover:text-black dark:text-purple-500 dark:hover:text-purple-500 border-b-4 border-orange-400 hover:border-orange-400 dark:border-purple-500"
                data-tabs-inactive-classes="dark:border-transparent text-black hover:text-orange-400 dark:text-gray-400 border-transparent hover:border-transparent dark:border-gray-700 dark:hover:text-gray-300"
                role="tablist">
                <!-- Tab product -->
                <li class="ml-auto" role="presentation">
                    <button class="inline-block px-4 pt-4 pb-1 border-b-2 rounded-t-lg" id="product-tab"
                        data-tabs-target="#product" type="button" role="tab" aria-controls="product"
                        aria-selected="false">Product</button>
                </li>
                <!-- Tab  Category-->
                <li class="md:mx-52 lg:mx-64" role="presentation">
                    <button
                        class="inline-block px-4 pt-4 pb-1 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="category-tab" data-tabs-target="#category" type="button" role="tab"
                        aria-controls="category" aria-selected="false">Category</button>
                </li>
                <!-- Tab Carousel -->
                <li class="mr-auto" role="presentation">
                    <button
                        class="inline-block px-4 pt-4 pb-1 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="carousel-tab" data-tabs-target="#carousel" type="button" role="tab"
                        aria-controls="carousel" aria-selected="false">Carousel</button>
                </li>
            </ul>
        </div>

        <!-- Tab Content (showing the content) -->
        <div id="default-tab-content">
            <!-- Product Content -->
            <div class="hidden px-10 pt-2 rounded-lg h-[80vh]" id="product" role="tabpanel" aria-labelledby="product-tab">
                <h1 class="text-black font-semibold text-xl mb-2">Edit Product Detail</h1>
                <div class="w-full h-full flex flex-row">
                    <!-- Kolom 2/5 (image)-->
                    <div class="w-3/12 h-[90%]">
                        <div class="w-full h-full">
                            <div class="flex flex-col space-y-4">
                                <div class="w-full h-72 mr-auto">
                                    <img id="mainImage" src="{{ asset('img/example/test_shirt.jpg') }}"
                                        class="w-full h-full object-cover rounded-lg" alt="Main Image">
                                </div>
                                <div class="flex space-x-2 mx-auto overflow-x-auto">
                                    <img onclick="changeImage('{{ asset('img/example/test_shirt.jpg') }}')"
                                        src="{{ asset('img/example/test_shirt.jpg') }}"
                                        class="w-14 h-14 object-cover rounded-lg cursor-pointer border border-gray-100">
                                    <img onclick="changeImage('{{ asset('img/example/test_shirt2.png') }}')"
                                        src="{{ asset('img/example/test_shirt2.png') }}"
                                        class="w-14 h-14 object-cover rounded-lg cursor-pointer border border-gray-100">
                                    <img onclick="changeImage('{{ asset('img/example/test_tshirt3.jpg') }}')"
                                        src="{{ asset('img/example/test_tshirt3.jpg') }}"
                                        class="w-14 h-14 object-cover rounded-lg cursor-pointer border border-gray-100">
                                    <img onclick="changeImage('{{ asset('img/example/test_tshirt4.jpg') }}')"
                                        src="{{ asset('img/example/test_tshirt4.jpg') }}"
                                        class="w-14 h-14 object-cover rounded-lg cursor-pointer border border-gray-200">
                                </div>
                                <div>
                                    <button href="#" id="btn-edit"
                                        class="w-3/5 flex items-center justify-center bg-orange-400 h-10 rounded-xl mb-5 text-lg font-bold text-white mt-5S mx-auto"
                                        data-modal-toggle="image-edit-modal" data-modal-target="image-edit-modal">
                                        <img src="{{ asset('img/assets/icon/icon_faq_edit.svg') }}" alt="Edit Icon"
                                            class="h-6 w-6 mr-3">
                                        Edit Image
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- <div class="w-1/12 h-[90%]"></div> --}}

                    <!-- Kolom 3/5 (form create product) -->
                    <div class="w-9/12 h-[90%]">
                        <div class="w-full h-full bg-[#FFFCFC] rounded-xl ml-5 p-5">
                            <!-- header create product -->
                            <h1 class="text-lg font-semibold">Create Product</h1>
                            <!-- start of form -->
                            <form action="" class="w-full mt-3">
                                <!-- Nama Produk -->
                                <div class="flex items-center mb-4">
                                    <!-- Label -->
                                    <div class="w-3/12">
                                        <label for="nama-produk" class="text-black font-semibold">Nama Produk</label>
                                    </div>
                                    <!-- Input Field -->
                                    <div class="w-8/12">
                                        <input type="text" id="nama-produk"
                                            class="w-full h-8 rounded-lg px-4 border-black focus:border-black focus:outline-none focus:ring-0">
                                    </div>
                                    <!-- Icon -->
                                    <div class="w-1/12 flex justify-end">
                                        <img src="{{ asset('img/assets/icon/icon_admin_product_edit.svg') }}"
                                            alt="edit icon" class="w-6 h-6">
                                    </div>
                                </div>

                                <!-- Harga Produk -->
                                <div class="flex items-center mb-4">
                                    <!-- label -->
                                    <div class="w-3/12">
                                        <label for="harga-produk" class="text-black font-semibold">Harga Produk</label>
                                    </div>
                                    <!-- input field -->
                                    <div class="w-8/12">
                                        <input type="number" id="harga-produk"
                                            class="w-full h-8 rounded-lg px-4 border-black focus:border-black focus:outline-none focus:ring-0">
                                    </div>
                                    <!-- icon -->
                                    <div class="w-1/12 flex justify-end">
                                        <img src="{{ asset('img/assets/icon/icon_admin_product_edit.svg') }}"
                                            alt="edit icon" class="w-6 h-6">
                                    </div>
                                </div>

                                <!-- Category -->
                                <div class="flex items-center mb-4">
                                    <!-- label -->
                                    <div class="w-3/12">
                                        <label for="category" class="text-black font-semibold">Category</label>
                                    </div>
                                    <!-- input filed -->
                                    <div class="w-8/12">
                                        <select id="dropdown_add_category"
                                            class="w-full h-8 rounded-lg px-4 text-xs border-black focus:border-black focus:outline-none focus:ring-0">
                                            <option value="select category">Select Category</option>
                                            <option value="fashion">Fashion</option>
                                            <!-- !!! tambahin -->
                                        </select>
                                    </div>
                                    <!-- icon (kosong) -->
                                    <div class="w-1/12">
                                        <!-- Kosong untuk category -->
                                    </div>
                                </div>

                                <!-- Product Specification -->
                                <div class="flex items-center mb-4">
                                    <!-- label -->
                                    <div class="w-3/12">
                                        <label for="product-specification" class="text-black font-semibold">Product
                                            Specification</label>
                                    </div>
                                    <!-- input field -->
                                    <div class="w-8/12">
                                        <textarea id="product-specification" rows="4"
                                            class="w-full rounded-lg px-4 border-black focus:border-black focus:outline-none focus:ring-0"></textarea>
                                    </div>
                                    <!-- icon -->
                                    <div class="w-1/12 flex justify-end">
                                        <img src="{{ asset('img/assets/icon/icon_admin_product_edit.svg') }}"
                                            alt="edit icon" class="w-6 h-6">
                                    </div>
                                </div>

                                <!-- Product Description -->
                                <div class="flex items-center">
                                    <div class="w-3/12">
                                        <label for="product-description" class="text-black font-semibold">Product
                                            Description</label>
                                    </div>
                                    <div class="w-8/12">
                                        <textarea id="product-description" rows="4"
                                            class="w-full rounded-lg px-4 border-black focus:border-black focus:outline-none focus:ring-0 text-md"></textarea>
                                    </div>
                                    <div class="w-1/12 flex justify-end">
                                        <img src="{{ asset('img/assets/icon/icon_admin_product_edit.svg') }}"
                                            alt="edit icon" class="w-6 h-6">
                                    </div>
                                </div>

                                <!-- Button Save -->
                                <div class="flex mt-2 w-full">
                                    <button type="submit"
                                        class="bg-orange-400 hover:bg-orange-500 text-white font-semibold w-1/3 h-10 rounded-lg ml-auto mr-14">
                                        Save
                                    </button>
                                </div>
                            </form>
                            <!-- end of form -->
                        </div>
                    </div>
                    <!-- end of kolom 2/3 (form product) -->
                </div>
            </div>
            <!-- end of product Content -->
        </div>
        <!-- end of tab content -->
    </div>
@endsection
