<div class="hidden px-10 rounded-lg h-[80vh]" id="carousel" role="tabpanel" aria-labelledby="carousel-tab">
    <div class="w-full flex items-center">
        <!-- plus button -->
        <a href="#" class="ml-5" data-modal-target="carousel-add-modal" data-modal-toggle="carousel-add-modal">
            <img src="{{ asset('img/assets/icon/icon_admin_product_plus.svg') }}" alt="plus icon"
                class="w-10 h-10 fill-orange-400">
        </a>

        <!-- text Add Carousel -->
        <h2 class="text-black text-md ml-3 font-semibold">Add Carousel</h2>
    </div>

    <!-- start of Carousel card container -->
    <div class="container w-full h-[85%] mt-5 overflow-y-scroll flex flex-wrap flex-row gap-12">
        <!-- card Carousel -->
        <!-- ini for loop hanya untuk coba -->
        @for ($i = 0; $i < 20; $i++)
            <div class="bg-white w-60 h-72 rounded-lg overflow-hidden flex flex-col">
                <!-- image Carousel card -->
                <div class="w-full h-2/3 bg-cover bg-top"
                    style="background-image: url('{{ asset('img/example/test_shirt.jpg') }}');">
                </div>
                <!-- header & detail Carousel card -->
                <div class="p-2">
                    <p class="text-sm text-black text-center font-bold truncate">Fashion</p>
                </div>
                <!-- edit & delete Carousel card -->
                <div class="flex mt-auto mx-4 mb-4">
                    <!-- edit icon -->
                    <a href="#" class="mr-auto" data-modal-target="carousel-edit-modal"
                        data-modal-toggle="carousel-edit-modal">
                        <img src="{{ asset('img/assets/icon/icon_admin_product_edit.svg') }}" alt=""
                            class="w-7 h-7">
                    </a>
                    <!-- delete icon -->
                    <a href="#" class="ml-auto">
                        <img src="{{ asset('img/assets/icon/icon_admin_product_trash.svg') }}" alt=""
                            class="w-7 h-7">
                    </a>
                </div>
            </div>
        @endfor
        <!-- end of for looping -->

        <!-- Carousel-edit-modal -->
        <div id="carousel-edit-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-fit max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="bg-white w-[30vw] h-[75vh] rounded-lg shadow">
                    <div class="relative w-full h-full flex flex-row">
                        <!-- x button (exit modal) -->
                        <button type="button"
                            class="absolute bg-black w-5 h-5 flex flex-col align-middle text-center items-center rounded-full pb-3 -top-2 -right-2"
                            data-modal-hide="carousel-edit-modal">
                            <p class="m-auto text-white text-sm">X</p>
                        </button>
                        <div class="w-full h-full flex flex-col">
                            <!-- start of form -->
                            <form action="" method="" class="flex flex-col h-full text-center py-5 px-5">
                                <!-- input file -->
                                <div class="relative w-full h-64 bg-gray-200 rounded-2xl">
                                    <!-- Hidden file input -->
                                    <input id="file-upload" type="file" class="hidden">
                                    <label for="file-upload"
                                        class="absolute inset-0 flex justify-center items-center cursor-pointer">
                                        <div class="text-gray-500">Upload Image</div>
                                    </label>
                                    <!-- Upload icon in the bottom-right corner -->
                                    <label for="file-upload"
                                        class="absolute bottom-3 right-3 bg-white p-2 rounded-lg cursor-pointer">
                                        <img src="{{ asset('img/assets/icon/icon_admin_category_upload.svg') }}"
                                            alt="Upload Icon" class="h-6 w-6">
                                    </label>
                                </div>
                                <!-- end of input file -->
                                <!-- Input name -->
                                <input type="text" placeholder="Name" name="" id=""
                                    class="rounded-2xl w-full bg-gray-200 hover:bg-gray-300 h-14 pl-5 pr-4 cursor-pointer mt-5 placeholder:text-black placeholder:font-semibold border-0 focus:outline-none focus:ring-0">
                                <!-- input Info -->
                                <textarea placeholder="Add info" name="" id="edit-info-carousel" rows="3"
                                    class="rounded-2xl w-full bg-gray-200 hover:bg-gray-300 pl-5 pr-4 cursor-pointer mt-5 placeholder:text-black placeholder:font-semi border-0 focus:outline-none focus:ring-0"></textarea>
                                <!-- Button "add" -->
                                <button type="submit" data-modal-hide="carousel-edit-modal"
                                    class="bg-orange-400 hover:bg-orange-500 text-white font-semibold mt-auto mx-auto inline-block w-1/2 h-14 rounded-3xl">Save</button>
                            </form>
                            <!-- end of form -->
                        </div>
                    </div>
                </div>
                <!-- end of modal content -->
            </div>
        </div>
        <!-- end of Carousel-edit-modal -->

        <!-- Carousel-add-modal -->
        <div id="carousel-add-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-fit max-w-2xl max-h-full mt-20">
                <!-- Modal content -->
                <div class="bg-white w-[30vw] h-auto rounded-lg shadow">
                    <div class="relative w-full h-full flex flex-row">
                        <!-- x button (exit modal) -->
                        <button type="button"
                            class="absolute bg-black w-5 h-5 flex flex-col align-middle text-center items-center rounded-full pb-3 -top-2 -right-2"
                            data-modal-hide="carousel-add-modal">
                            <p class="m-auto text-white text-sm">X</p>
                        </button>
                        <div class="w-full h-full flex flex-col">
                            <!-- start of form -->
                            <form action="" method="" class="flex flex-col h-full text-center py-4 px-5">
                                <!-- input file image with a larger area -->
                                <div class="relative w-full h-56 bg-gray-200 rounded-2xl">
                                    <!-- Hidden file input -->
                                    <input id="file-upload" type="file" class="hidden">
                                    <!-- Label that acts as the clickable area -->
                                    <label for="file-upload"
                                        class="absolute inset-0 flex justify-center items-center cursor-pointer">
                                        <div class="text-gray-500">Upload file</div>
                                    </label>
                                    <!-- Upload icon in the bottom-right corner -->
                                    <label for="file-upload"
                                        class="absolute bottom-3 right-3 bg-white p-2 rounded-lg cursor-pointer">
                                        <img src="{{ asset('img/assets/icon/icon_admin_category_upload.svg') }}"
                                            alt="Upload Icon" class="h-6 w-6">
                                    </label>
                                </div>
                                <!-- end of input file image -->
                                <!-- Input name -->
                                <input type="text" placeholder="Name" name="" id=""
                                    class="rounded-2xl w-full bg-gray-200 hover:bg-gray-300 h-12 pl-5 pr-4 cursor-pointer mt-5 placeholder:text-black placeholder:font-semibold border-0 focus:outline-none focus:ring-0">
                                {{-- dropdown pilih video/image --}}
                                <select id="type-carousel" onchange="toggleVideoInput()"
                                    class="rounded-2xl w-full bg-gray-200 hover:bg-gray-300 h-12 pl-5 pr-4 cursor-pointer mt-5 placeholder:text-black placeholder:font-semibold border-0 focus:outline-none focus:ring-0">
                                    <option value="" disabled selected>Select Category Carousel</option>
                                    <option value="video">Video</option>
                                    <option value="image">Image</option>
                                </select>
                                {{-- input link video --}}
                                <input type="text" placeholder="Link Video" name="" id="video-link-input"
                                    class="rounded-2xl w-full bg-gray-200 hover:bg-gray-300 h-12 pl-5 pr-4 cursor-pointer mt-5 placeholder:text-black border-0 focus:outline-none focus:ring-0 hidden">
                                <!-- input Info -->
                                <textarea placeholder="Add info" name="" id="edit-info-carousel" rows="3"
                                    class="rounded-2xl w-full bg-gray-200 hover:bg-gray-300 pl-5 pr-4 cursor-pointer mt-5 placeholder:text-black placeholder:font-semi border-0 focus:outline-none focus:ring-0"></textarea>
                                <!-- Button "add" -->
                                <button type="submit" data-modal-hide="carousel-add-modal"
                                    class="bg-orange-400 hover:bg-orange-500 text-white font-semibold mt-5 mx-auto inline-block w-1/2 h-14 rounded-3xl">Add</button>
                            </form>
                            <!-- end of form -->
                        </div>
                    </div>
                </div>
                <!-- end of modal content -->
            </div>
        </div>
        <!-- end of Carousel-edit-modal -->
        <!-- end of catefory-edit-modal -->
    </div>
    <!-- end of product card container -->

</div>

<script>
    function toggleVideoInput() {
        // get element by id
        const selectElement = document.getElementById("type-carousel");
        const videoLinkInput = document.getElementById("video-link-input");

        // conditional for check type of carousel
        if (selectElement.value === "video") {
            videoLinkInput.classList.remove("hidden"); // show
        } else {
            videoLinkInput.classList.add("hidden"); //hide
        }
    }
</script>
