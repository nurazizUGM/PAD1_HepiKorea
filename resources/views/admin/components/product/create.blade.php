<h1 class="text-black font-semibold text-xl mb-2">Add Product Detail</h1>
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
                        data-modal-toggle="image-add-modal" data-modal-target="image-add-modal">
                        <img src="{{ asset('img/assets/icon/icon_faq_edit.svg') }}" alt="Edit Icon"
                            class="h-6 w-6 mr-3">
                        Add Image
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
                        <img src="{{ asset('img/assets/icon/icon_admin_product_edit.svg') }}" alt="edit icon"
                            class="w-6 h-6">
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
                        <img src="{{ asset('img/assets/icon/icon_admin_product_edit.svg') }}" alt="edit icon"
                            class="w-6 h-6">
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
                            <option value="merchandise">Merchandise</option>
                            <option value="beauty">Beauty</option>
                            <option value="electronic">Electronic</option>
                            <option value="food">Food</option>
                            <option value="healthy">Healthy</option>
                            <option value="music">Music</option>
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
                        <img src="{{ asset('img/assets/icon/icon_admin_product_edit.svg') }}" alt="edit icon"
                            class="w-6 h-6">
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
                        <img src="{{ asset('img/assets/icon/icon_admin_product_edit.svg') }}" alt="edit icon"
                            class="w-6 h-6">
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

{{-- start of Add Image Modal --}}
<div id="image-add-modal" tabindex="-2" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="bg-white w-[50vw] h-[50vh] rounded-lg shadow">
            <div class="relative w-full h-full p-6 flex flex-row grid-cols-[4fr_2fr]">
                <!-- x button (exit modal) -->
                <button type="button"
                    class="absolute bg-black w-5 h-5 flex flex-col align-middle text-center items-center rounded-full pb-3 -top-2 -right-2"
                    data-modal-hide="image-add-modal">
                    <p class="m-auto text-white text-sm">X</p>
                </button>
                <!-- image category -->
                <div class="w-full h-full bg-cover bg-no-repeat bg-top rounded-lg"
                    style="background-image: url('{{ asset('img/example/test_shirt.jpg') }}');">
                </div>
                <div class="w-full h-full px-14 flex flex-col">
                    <form action="" method="" class="flex flex-col h-full text-center py-4 px-5">
                        <!-- input file image -->
                        <div class="relative w-full mt-5">
                            <!-- Hidden file input -->
                            <input id="file-upload" type="file" class="hidden">
                            <!-- Custom file input label -->
                            <label for="file-upload"
                                class="flex items-center justify-between w-full rounded-3xl bg-gray-200 hover:bg-gray-300 h-14 pl-10 pr-4 cursor-pointer">
                                <span class="text-black font-semi">Icon</span>
                                <img src="{{ asset('img/assets/icon/icon_admin_category_upload.svg') }}"
                                    alt="Upload Icon" class="h-8 w-8">
                            </label>
                        </div>
                        <!-- end of input file image -->
                        <!-- Input name -->
                        <input type="text" placeholder="Name" name="" id=""
                            class="rounded-3xl w-full bg-gray-200 hover:bg-gray-300 h-14 pl-10 pr-4 cursor-pointer mt-5 placeholder:text-black placeholder:font-semi border-0 focus:outline-none focus:ring-0">
                        <!-- flex grow untuk dorong button ke bawah -->
                        <div class="flex-grow"></div>
                        <!-- Button "add" -->
                        <button type="submit" data-modal-hide="image-add-modal"
                            class="bg-orange-400 hover:bg-orange-500 text-white font-semibold mt-auto mx-auto inline-block w-1/2 h-14 rounded-3xl">Edit</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- end of modal content -->
    </div>
</div>

<script>
    function changeImage(imageSrc) {
        document.getElementById('mainImage').src = imageSrc;
    }
</script>
