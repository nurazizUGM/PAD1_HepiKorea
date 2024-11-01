<div class="w-full flex items-center">
    <!-- plus button -->
    <a href="#" class="ml-5" data-modal-target="category-add-modal" data-modal-toggle="category-add-modal">
        <img src="{{ asset('img/assets/icon/icon_admin_product_plus.svg') }}" alt="plus icon"
            class="w-10 h-10 fill-orange-400">
    </a>

    <!-- text Add Product -->
    <h2 class="text-black text-md ml-3 font-semibold">Category</h2>
</div>

<!-- start of product card container -->
<div class="container w-full h-[85%] mt-5 overflow-y-scroll flex flex-wrap flex-row gap-12">
    <!-- card product -->
    <!-- ini for loop hanya untuk coba -->
    @foreach ($categories as $category)
        <div class="bg-white w-60 h-72 rounded-lg overflow-hidden flex flex-col">
            <!-- image product card -->
            <div class="w-full h-2/3 bg-cover bg-top"
                style="background-image: url('{{ str_starts_with($category->icon, 'http') ? $category->icon : asset('storage/category/' . $category->icon) }}');">
            </div>
            <!-- header & detail product card -->
            <div class="p-2">
                <p class="text-sm text-black text-center font-bold truncate">{{ $category->name }}</p>
            </div>
            <!-- edit & delete product card -->
            <div class="flex mt-auto mx-4 mb-4">
                <!-- edit icon -->
                <a href="#" class="mr-auto" data-modal-target="category-edit-modal"
                    onclick="editCategory({{ $category->id }}, '{{ $category->name }}', '{{ $category->icon }}')"
                    data-modal-toggle="category-edit-modal">
                    <img src="{{ asset('img/assets/icon/icon_admin_product_edit.svg') }}" alt=""
                        class="w-7 h-7">
                </a>
                <!-- delete icon -->
                <form action="{{ route('admin.category.delete', $category->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" href="#" class="ml-auto">
                        <img src="{{ asset('img/assets/icon/icon_admin_product_trash.svg') }}" alt=""
                            class="w-7 h-7">
                    </button>
                </form>
            </div>
        </div>
    @endforeach
    <!-- end of for looping -->

    <!-- catefory-edit-modal -->
    <div id="category-edit-modal" tabindex="-1" aria-hidden="true"
        class="{{ isset($edit) ? 'flex bg-[#EFEFEF]' : 'hidden' }} overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="bg-white w-[50vw] h-[50vh] rounded-lg shadow">
                <div class="relative w-full h-full p-6 flex flex-row grid-cols-[4fr_2fr]">
                    <!-- x button (exit modal) -->
                    <button type="button"
                        class="absolute bg-black w-5 h-5 flex flex-col align-middle text-center items-center rounded-full pb-3 -top-2 -right-2"
                        data-modal-hide="category-edit-modal">
                        <p class="m-auto text-white text-sm">X</p>
                    </button>
                    <!-- image category -->
                    <div class="w-full h-full bg-cover bg-no-repeat bg-top rounded-lg" id="edit-category-image"
                        style="background-image: url('{{ asset('img/example/test_shirt.jpg') }}');">
                    </div>
                    <div class="w-full h-full px-14 flex flex-col">
                        <form action="" method="POST" enctype="multipart/form-data"
                            class="flex flex-col h-full text-center py-4 px-5">
                            @csrf
                            @method('PATCH')
                            <!-- input file image -->
                            <div class="relative w-full mt-5" onclick="$(this)->find('input[type=file]').click()">
                                <!-- Hidden file input -->
                                <input id="edit-category-icon" type="file" class="hidden" name="icon"
                                    onchange="updatePreview(this, $('#edit-category-image'))">
                                <!-- Custom file input label -->
                                <label for="edit-category-icon"
                                    class="flex items-center justify-between w-full rounded-3xl bg-gray-200 hover:bg-gray-300 h-14 pl-10 pr-4 cursor-pointer">
                                    <span class="text-black font-semi">Icon</span>
                                    <img src="{{ asset('img/assets/icon/icon_admin_category_upload.svg') }}"
                                        alt="Upload Icon" class="h-8 w-8">
                                </label>
                            </div>
                            <!-- end of input file image -->
                            <!-- Input name -->
                            <input type="text" placeholder="Name" name="name" id="name"
                                class="rounded-3xl w-full bg-gray-200 hover:bg-gray-300 h-14 pl-10 pr-4 cursor-pointer mt-5 placeholder:text-black placeholder:font-semi border-0 focus:outline-none focus:ring-0">
                            <!-- flex grow untuk dorong button ke bawah -->
                            <div class="flex-grow"></div>
                            <!-- Button "add" -->
                            <button type="submit" data-modal-hide="category-edit-modal"
                                class="bg-orange-400 hover:bg-orange-500 text-white font-semibold mt-auto mx-auto inline-block w-1/2 h-14 rounded-3xl">Save</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end of modal content -->
        </div>
    </div>
    <!-- end of catefory-edit-modal -->

    <!-- category-add-modal -->
    <div id="category-add-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="bg-white w-[50vw] h-[50vh] rounded-lg shadow">
                <div class="relative w-full h-full p-6 flex flex-row grid-cols-[4fr_2fr]">
                    <!-- x button (exit modal) -->
                    <button type="button"
                        class="absolute bg-black w-5 h-5 flex flex-col align-middle text-center items-center rounded-full pb-3 -top-2 -right-2"
                        data-modal-hide="category-add-modal">
                        <p class="m-auto text-white text-sm">X</p>
                    </button>
                    <!-- image category -->
                    <div class="w-full h-full bg-cover bg-no-repeat bg-top rounded-lg" id="add-category-image"
                        style="background-image: url('{{ asset('img/example/test_shirt.jpg') }}');">
                    </div>
                    <div class="w-full h-full px-14 flex flex-col">
                        <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data"
                            class="flex flex-col h-full text-center py-4 px-5">
                            @csrf
                            <!-- input file image -->
                            <div class="relative w-full mt-5" onclick="$(this).find('input[type=file]').click()">
                                <!-- Hidden file input -->
                                <input id="add-category-icon" name="icon" type="file" class="hidden"
                                    onchange="updatePreview(this, $('#add-category-image'))">
                                <!-- Custom file input label -->
                                <label for="add-category-icon"
                                    class="flex items-center justify-between w-full rounded-3xl bg-gray-200 hover:bg-gray-300 h-14 pl-10 pr-4 cursor-pointer">
                                    <span class="text-black font-semi">Icon</span>
                                    <img src="{{ asset('img/assets/icon/icon_admin_category_upload.svg') }}"
                                        alt="Upload Icon" class="h-8 w-8">
                                </label>
                            </div>
                            <!-- end of input file image -->
                            <!-- Input name -->
                            <input type="text" placeholder="Name" name="name" id="add-category-name"
                                class="rounded-3xl w-full bg-gray-200 hover:bg-gray-300 h-14 pl-10 pr-4 cursor-pointer mt-5 placeholder:text-black placeholder:font-semi border-0 focus:outline-none focus:ring-0">
                            <!-- flex grow untuk dorong button ke bawah -->
                            <div class="flex-grow"></div>
                            <!-- Button "add" -->
                            <button type="submit" data-modal-hide="category-add-modal"
                                class="bg-orange-400 hover:bg-orange-500 text-white font-semibold mt-auto mx-auto inline-block w-1/2 h-14 rounded-3xl">Add</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end of modal content -->
        </div>
    </div>
    <!-- end of catefory-edit-modal -->
</div>
<!-- end of product card container -->

<script>
    function updatePreview(input, target) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                console.log(e.target.result)
                $(target).css('background-image', 'url(' + e.target.result + ')');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function editCategory(id, name, icon) {
        $('#category-edit-modal').find('form').attr('action', '{{ route('admin.category.update', '') }}' + '/' + id);
        $('#category-edit-modal').find('input[name="name"]').val(name);
        $('#category-edit-modal').find('#edit-category-image').css('background-image', 'url(' + icon + ')');
    }
</script>
