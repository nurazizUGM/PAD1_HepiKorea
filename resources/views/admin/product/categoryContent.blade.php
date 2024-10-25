<div class="hidden px-10 rounded-lg h-[80vh]" id="category" role="tabpanel" aria-labelledby="category-tab">
    <div class="w-full flex items-center">
        <!-- plus button -->
        <a href="#" class="ml-5" data-modal-target="category-add-modal" data-modal-toggle="category-add-modal">
            <img src="{{ asset('img/assets/icon/icon_admin_product_plus.svg') }}" alt="plus icon"
                class="w-10 h-10 fill-orange-400">
        </a>

        <!-- text Add Product -->
        <h2 class="text-black text-md ml-3 font-semibold">Add Category</h2>
    </div>

    <!-- start of product card container -->
    <div class="container w-full h-[85%] mt-5 overflow-y-scroll flex flex-wrap flex-row gap-12">
        <!-- card product -->
        <!-- ini for loop hanya untuk coba -->
        @for ($i = 0; $i < 20; $i++)
            <div class="bg-white w-60 h-72 rounded-lg overflow-hidden flex flex-col">
                <!-- image product card -->
                <div class="w-full h-2/3 bg-cover bg-top"
                    style="background-image: url('{{ asset('img/example/test_shirt.jpg') }}');">
                </div>
                <!-- header & detail product card -->
                <div class="p-2">
                    <p class="text-sm text-black text-center font-bold truncate">Fashion</p>
                </div>
                <!-- edit & delete product card -->
                <div class="flex mt-auto mx-4 mb-4">
                    <!-- edit icon -->
                    <a href="#" class="mr-auto" data-modal-target="category-edit-modal"
                        data-modal-toggle="category-edit-modal">
                        <img src="{{ asset('img/assets/icon/icon_admin_product_edit.svg') }}" alt="" class="w-7 h-7">
                    </a>
                    <!-- delete icon -->
                    <a href="#" class="ml-auto">
                        <img src="{{ asset('img/assets/icon/icon_admin_product_trash.svg') }}" alt="" class="w-7 h-7">
                    </a>
                </div>
            </div>
        @endfor
        <!-- end of for looping -->

        <!-- catefory-edit-modal -->
        <div id="category-edit-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
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

        <!-- catefory-add-modal -->
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

</div>
