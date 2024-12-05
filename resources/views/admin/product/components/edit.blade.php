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
                    <a href="{{ route('admin.category.index') }}"
                        class="inline-block px-4 pt-4 pb-1 rounded-t-lg text-black hover:text-orange-400 " id="category-tab"
                        data-tabs-target="#category" type="button">Category</a>
                </li>
                <!-- Tab Carousel -->
                <li class="mr-auto" role="presentation">
                    <a href="{{ route('admin.product.index') }}"
                        class="inline-block px-4 pt-4 pb-1 rounded-t-lg text-black hover:text-orange-400 " id="carousel-tab"
                        data-tabs-target="#carousel" type="button">Carousel</a>
                </li>
            </ul>
        </div>

        <!-- Tab Content (showing the content) -->
        <div id="default-tab-content">
            <!-- Product Content -->
            <div class="hidden px-10 pt-2 rounded-lg h-[80vh]" id="product" role="tabpanel" aria-labelledby="product-tab">
                <div class="w-full h-full flex flex-row">
                    <!-- Kolom 2/5 (image)-->
                    <div class="w-3/12 h-[97%]">
                        <div class="w-full h-full">
                            <div class="h-full flex flex-col space-y-4">
                                <div class="w-full h-[20rem] mr-auto bg-white rounded-2xl p-3">
                                    <img id="mainImage" src="{{ Storage::url($product->images->first()->path) }}"
                                        class="w-full h-full object-contain rounded-lg" alt="Main Image">
                                </div>
                                <div class="flex space-x-2 mx-auto overflow-x-auto" id="product-image-preview"> </div>
                                <div class="flex space-x-2 mx-auto overflow-x-auto" id="product-images">
                                    @foreach ($product->images as $image)
                                        <div class="relative w-14 h-14">
                                            <button type="button" onclick="deleteImage(this, {{ $image->id }})"
                                                class="absolute bg-black bg-opacity-50 w-5 h-5 flex flex-col align-middle text-center items-center rounded-full pb-3 top-0 right-0">
                                                <p class="m-auto text-white text-sm">x</p>
                                            </button>
                                            <img src="{{ Storage::url($image->path) }}"
                                                class="w-full h-full object-cover rounded-lg cursor-pointer border border-gray-100">
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mt-52">
                                    <button id="btn-add-image"
                                        class="w-[99%] flex items-center justify-center bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] h-10 rounded-2xl mb-5 text-lg font-bold text-white mt-5S mx-auto">
                                        <img src="{{ asset('img/assets/icon/icon_admin_product_upload.svg') }}"
                                            alt="Upload Icon" class="h-6 w-6 mr-3">
                                        Upload Photo
                                    </button>
                                </div>

                                <div class="flex-grow"></div>
                                <!-- Button Cancel -->
                                <button type="button" onclick="window.location.href='{{ route('admin.product.index') }}'"
                                    class="flex flex-row bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white font-semibold justify-center items-center w-2/5 h-10 rounded-2xl mb-6 mr-auto">
                                    <img src="{{ asset('img/assets/icon/icon_arrow_back.svg') }}" alt=""
                                        class="w-10 h-8">
                                    <p class="my-auto">Back</p>
                                </button>
                                <div class="w-full h-[18px] text-transparent">.</div>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom 3/5 (form create product) -->
                    <div class="w-9/12 h-[95%] pl-[115px] pr-10 justify-end">
                        <div class="w-full h-full bg-[#FFFCFC] rounded-2xl ml-5 p-5">
                            <!-- header create product -->
                            <h1 class="text-2xl font-semibold">Edit Product</h1>
                            <!-- start of form -->
                            <form action="{{ route('admin.product.update', $product->id) }}" method="POST"
                                class="w-full h-full flex flex-col mt-8 pb-12" method="POST" enctype="multipart/form-data"
                                id="form-edit-product" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <!-- Nama Produk -->
                                <div class="flex items-center mb-7">
                                    <!-- Label -->
                                    <div class="w-4/12">
                                        <label for="nama-produk" class="text-[#898383] text-lg font-normal">Product
                                            Name</label>
                                    </div>
                                    <!-- Input Field -->
                                    <div class="w-7/12">
                                        <input type="text" id="nama-produk" name="name"value="{{ $product->name }}"
                                            required placeholder="Write the product name"
                                            class="w-full h-12 rounded-lg px-4 border border-[#376F7E] focus:border-[#376F7E] focus:outline-none focus:ring-0">
                                    </div>
                                    <!-- Icon -->
                                    <div class="w-1/12 flex justify-end">
                                        {{-- <img src="{{ asset('img/assets/icon/icon_admin_product_edit_green.svg') }}"
                                            alt="edit icon" class="w-6 h-6"> --}}
                                    </div>
                                </div>

                                <!-- Harga Produk -->
                                <div class="flex items-center mb-7">
                                    <!-- label -->
                                    <div class="w-4/12">
                                        <label for="harga-produk" class="text-[#898383] text-lg font-normal">Price</label>
                                    </div>
                                    <!-- input field -->
                                    <div class="w-7/12">
                                        <input type="number" id="harga-produk" name="price"
                                            value="{{ $product->price }}" required
                                            class="w-full h-12 rounded-lg px-4 border border-[#376F7E] focus:border-[#376F7E] focus:outline-none focus:ring-0">
                                    </div>
                                    <!-- icon -->
                                    <div class="w-1/12 flex justify-end">
                                        {{-- <img src="{{ asset('img/assets/icon/icon_admin_product_edit_green.svg') }}"
                                            alt="edit icon" class="w-6 h-6"> --}}
                                    </div>
                                </div>

                                <!-- Category -->
                                <div class="flex items-center mb-7">
                                    <!-- label -->
                                    <div class="w-4/12">
                                        <label for="category" class="text-[#898383] text-lg font-normal">Product
                                            Category</label>
                                    </div>
                                    <!-- input filed -->
                                    <div class="w-7/12">
                                        <select id="dropdown_add_category" name="category"
                                            class="w-full h-12 rounded-lg px-4 text-xs border border-[#376F7E] focus:border-[#376F7E] focus:outline-none focus:ring-0">
                                            @foreach (\App\Models\Category::all() as $category)
                                                <option value="{{ $category->id }}"
                                                    @if ($category->id == $product->category_id) selected @endif>{{ $category->name }}
                                                </option>
                                            @endforeach
                                            <!-- !!! tambahin -->
                                        </select>
                                    </div>
                                    <!-- icon (kosong) -->
                                    <div class="w-1/12 flex justify-end">
                                        {{-- <img src="{{ asset('img/assets/icon/icon_admin_product_edit_green.svg') }}"
                                            alt="edit icon" class="w-6 h-6"> --}}
                                    </div>
                                </div>

                                <!-- Product Description -->
                                <div class="flex items-center">
                                    <div class="w-4/12 my-auto">
                                        <label for="product-description"
                                            class="text-[#898383] text-lg font-normal">Product
                                            Description</label>
                                    </div>
                                    <div class="w-7/12">
                                        <textarea id="product-description" rows="5" name="description" form="form-edit-product" required
                                            placeholder="Product Description"
                                            class="w-full rounded-lg px-4 border border-[#376F7E] focus:border-[#376F7E] focus:outline-none focus:ring-0 text-md resize-none">{{ $product->description }}</textarea>
                                    </div>
                                    <div class="w-1/12 flex justify-end">
                                        {{-- <img src="{{ asset('img/assets/icon/icon_admin_product_edit_green.svg') }}"
                                            alt="edit icon" class="w-6 h-6"> --}}
                                    </div>
                                </div>

                                {{-- <div class="flex-grow"></div> --}}

                                <div class="flex w-full mt-auto">
                                    <!-- Button Save -->
                                    <button type="submit"
                                        class="bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white font-semibold w-1/5 h-10 rounded-2xl ml-auto mb-4 mr-16"
                                        data-modal-target="success-updated-modal"
                                        data-modal-toggle="success-updated-modal">
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

    {{-- MODALS FOR EDIT PRODUCT --}}
    {{-- success edited modal --}}
    <div id="success-updated-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-fit max-w-5xl max-h-full mt-20">
            <!-- Modal content -->
            <div class="bg-white w-[25vw] h-auto rounded-[30px] shadow">
                <div class="relative w-full h-full flex flex-row">
                    <div class="w-full h-full flex flex-col p-14">
                        <h1 class="text-black text-xl font-medium mx-auto">Successfully Updated!</h1>
                        <img src="{{ asset('img/assets/icon/icon_green_check.svg') }}" alt="green_check"
                            class="w-24 h-24 mx-auto mt-6">
                    </div>
                    {{-- end of modal content --}}
                </div>
            </div>
            <!-- end of modal content -->
        </div>
    </div>
    {{-- end of success edited modal --}}
    {{-- end of MODALS FOR EDIT PRODUCT --}}

@endsection

@section('script')
    <script>
        const btn =
            `<button type="button" class="absolute bg-black bg-opacity-50 w-5 h-5 flex flex-col align-middle text-center items-center rounded-full pb-3 top-0 right-0"><p class="m-auto text-white text-sm">x</p></button>`

        $(document).ready(function() {
            $('#product-images img').click(function() {
                $('#mainImage').attr('src', $(this).attr('src'));
            });

            $('#btn-add-image').click(function() {
                const input = document.createElement('input');
                input.type = 'file';
                input.className = 'hidden';
                input.accept = 'image/*';
                input.name = 'images[]';
                input.click();

                input.onchange = function() {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const imgContainer = $(`<div class="w-14 h-14 relative"></div>`);
                        const deleteBtn = $(btn)
                        deleteBtn.click(function() {
                            input.remove()
                            imgContainer.remove()
                        })

                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className =
                            'w-full h-full object-cover rounded-lg cursor-pointer border border-gray-100';
                        img.onclick = function() {
                            $('#mainImage').attr('src', img.src);
                        };

                        imgContainer.append(deleteBtn);
                        imgContainer.append(img)
                        $('#product-images').append(imgContainer);
                        $('#mainImage').attr('src', img.src);
                        $('#form-edit-product').append(input);
                    };
                    reader.readAsDataURL(input.files[0]);
                };
            });
        });

        function deleteImage(element, id) {
            $(element).parent().remove();
            const input = $('<input>').attr('type', 'hidden').attr('name', 'deleted_images[]').val(id);
            $('#form-edit-product').append(input);
        }
    </script>
@endsection
