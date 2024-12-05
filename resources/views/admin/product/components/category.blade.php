<div class="w-full flex items-center cursor-pointer" data-modal-target="category-add-modal"
    data-modal-toggle="category-add-modal">
    <!-- text Add Product -->
    <h2 class="text-black text-md ml-3 font-semibold">Add Category</h2>

    <!-- plus button -->
    <a href="#" class="ml-10">
        <img src="{{ asset('img/assets/icon/icon_admin_product_plus.svg') }}" alt="plus icon" class="w-10 h-10">
    </a>
</div>

<!-- start of product card container -->
<div
    class="w-full h-[85%] mt-5 overflow-y-scroll flex flex-wrap flex-row gap-x-12 gap-y-8 justify-start items-start content-start">
    <!-- card product -->
    <!-- ini for loop hanya untuk coba -->
    @foreach ($categories as $category)
        <div class="bg-white w-60 h-72 rounded-lg overflow-hidden flex flex-col">
            <!-- image product card -->
            @if (Storage::exists($category->icon))
                <div class="w-full h-2/3 bg-cover bg-top"
                    style="background-image: url('{{ Storage::url($category->icon) }}');">
                </div>
            @elseif (filter_var($category->icon, FILTER_VALIDATE_URL))
                <div class="w-full h-2/3 bg-cover bg-top" style="background-image: url('{{ $category->icon }}');">
                </div>
            @else
                <div class="w-full h-2/3 bg-cover bg-top" style="background-image: url('https://placehold.co/200');">
                </div>
            @endif
            <!-- header & detail product card -->
            <div class="p-2">
                <p class="text-lg text-[#3E6E7A] text-center font-bold truncate">{{ $category->name }}</p>
            </div>
            <!-- edit & delete product card -->
            <div class="flex mt-auto mx-4 mb-4">
                <!-- edit icon -->
                <a href="#" class="mr-auto" data-modal-target="category-edit-modal"
                    onclick="editCategory({{ $category->id }}, '{{ $category->name }}', '{{ $category->icon }}')"
                    data-modal-toggle="category-edit-modal">
                    <img src="{{ asset('img/assets/icon/icon_admin_category_edit.svg') }}" alt=""
                        class="w-7 h-7">
                </a>
                <!-- delete icon -->
                <form action="{{ route('admin.category.delete', $category->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" href="#" class="ml-auto">
                        <img src="{{ asset('img/assets/icon/icon_admin_category_trash.svg') }}" alt=""
                            class="w-7 h-7">
                    </button>
                </form>
            </div>
        </div>
    @endforeach
    <!-- end of for looping -->


</div>
<!-- end of product card container -->



{{-- MODALS FOR CATEGORy --}}

<!-- catefory-edit-modal -->
<div id="category-edit-modal" tabindex="-1" aria-hidden="true"
    class="{{ isset($edit) ? 'flex bg-[#EFEFEF]' : 'hidden' }} overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-5xl max-h-full">
        <!-- Modal content -->
        <div class="bg-white w-[60vw] h-[50svh] rounded-lg shadow">
            <div class="relative w-full h-full p-6 flex flex-col">
                <!-- x button (exit modal) -->
                <button type="button"
                    class="absolute bg-black w-5 h-5 flex flex-col align-middle text-center items-center rounded-full pb-3 -top-2 -right-2"
                    data-modal-hide="category-edit-modal">
                    <p class="m-auto text-white text-sm">X</p>
                </button>
                <h1 class="text-[#376F7E] font-semibold text-3xl mb-2 ml-2">Edit Category</h1>
                <div class="w-full h-full flex flex-row">
                    <!-- image category -->
                    <div class="w-[40%] h-full bg-contain bg-no-repeat bg-top rounded-lg" id="edit-category-image">
                        {{-- image appears here --}}
                    </div>
                    <div class="w-[60%] h-full px-4 flex flex-col">
                        <form action="" method="POST" enctype="multipart/form-data"
                            class="flex flex-col h-full text-center py-4 px-5">
                            @csrf
                            @method('PATCH')
                            <h1 class="text-orange-400 text-xl font-semibold text-left">Icon Category</h1>
                            <!-- input file image -->
                            <div class="relative w-full mt-5" onclick="$(this)->find('input[type=file]').click()">
                                <!-- Hidden file input -->
                                <input id="edit-category-icon" type="file" class="hidden" name="icon"
                                    onchange="updatePreview(this, $('#edit-category-image'))">
                                <!-- Custom file input label -->
                                <label for="edit-category-icon"
                                    class="flex items-center justify-between w-full rounded-3xl bg-gray-200 hover:bg-gray-300 h-14 pl-10 pr-4 cursor-pointer">
                                    <span class="text-black font-semi">Upload Your File...</span>
                                    <img src="{{ asset('img/assets/icon/icon_admin_category_upload.svg') }}"
                                        alt="Upload Icon" class="h-8 w-8">
                                </label>
                            </div>
                            <!-- end of input file image -->
                            <h1 class="text-orange-400 text-xl font-semibold text-left mt-5">Category Name</h1>
                            <!-- Input name -->
                            <input type="text" placeholder="Name" name="name" id="name"
                                class="rounded-3xl w-full bg-gray-200 hover:bg-gray-300 h-14 pl-10 pr-4 cursor-pointer mt-5 placeholder:text-black placeholder:font-semi border-0 focus:outline-none focus:ring-0">
                            <!-- flex grow untuk dorong button ke bawah -->
                            <div class="flex-grow"></div>
                            <!-- Button "add" -->
                            <button type="submit" data-modal-hide="category-edit-modal"
                                class="bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white font-semibold mt-auto ml-auto inline-block w-1/4 h-10 rounded-2xl">Change</button>
                        </form>
                    </div>
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
    <div class="relative p-4 w-full max-w-5xl max-h-full">
        <!-- Modal content -->
        <div class="bg-white w-[60vw] h-[50svh] rounded-lg shadow">
            <div class="relative w-full h-full p-6 flex flex-col">
                <!-- x button (exit modal) -->
                <button type="button"
                    class="absolute bg-black w-5 h-5 flex flex-col align-middle text-center items-center rounded-full pb-3 -top-2 -right-2"
                    data-modal-hide="category-add-modal">
                    <p class="m-auto text-white text-sm">X</p>
                </button>
                <h1 class="text-[#376F7E] font-semibold text-3xl mb-2 ml-2">Add Category</h1>
                <div class="w-full h-full flex flex-row">
                    <!-- image category -->
                    <div class="w-[40%] h-full bg-contain bg-no-repeat bg-top rounded-lg" id="add-category-image">
                        {{-- image will appear here --}}
                    </div>
                    <div class="w-[60%] h-full px-4 flex flex-col">
                        <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data"
                            class="flex flex-col h-full text-center py-4 px-5">
                            @csrf
                            <h1 class="text-orange-400 text-xl font-semibold text-left">Icon Category</h1>
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
                            <h1 class="text-orange-400 text-xl font-semibold text-left mt-5">Category Name</h1>
                            <!-- Input name -->
                            <input type="text" placeholder="Write The Category Name..." name="name"
                                id="add-category-name"
                                class="rounded-3xl w-full bg-gray-200 hover:bg-gray-300 h-14 pl-10 pr-4 cursor-pointer mt-5 placeholder:text-black placeholder:font-semi border-0 focus:outline-none focus:ring-0">
                            <!-- flex grow untuk dorong button ke bawah -->
                            <div class="flex-grow"></div>
                            <!-- Button "add" -->
                            <button type="submit" data-modal-hide="category-add-modal"
                                class="bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white font-semibold mt-auto ml-auto inline-block w-1/4 h-10 rounded-2xl">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of modal content -->
    </div>
</div>
<!-- end of catefory-edit-modal -->

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
                        <button
                            class="w-44 h-11 bg-[#376F7E] rounded-[20px] shadow-lg text-white text-lg font-semibold"
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


{{-- success added modal --}}
<div id="success-added-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-fit max-w-5xl max-h-full mt-20">
        <!-- Modal content -->
        <div class="bg-white w-[25vw] h-auto rounded-[30px] shadow">
            <div class="relative w-full h-full flex flex-row">
                <div class="w-full h-full flex flex-col p-14">
                    <h1 class="text-black text-xl font-medium mx-auto">Successfully Added!</h1>
                    <img src="{{ asset('img/assets/icon/icon_green_check.svg') }}" alt="green_check"
                        class="w-24 h-24 mx-auto mt-6">
                </div>
                {{-- end of modal content --}}
            </div>
        </div>
        <!-- end of modal content -->
    </div>
</div>
{{-- end of success added modal --}}


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

{{-- end of MODALS FOR CATEGORy --}}

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
