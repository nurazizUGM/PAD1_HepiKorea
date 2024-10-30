<!-- start of product content -->
<div class="hidden px-10 rounded-lg h-[80vh]" id="review" role="tabpanel" aria-labelledby="review-tab">
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
                    <a href="" class="ml-auto" data-modal-target="review-modal"
                    data-modal-toggle="review-modal">
                        <img src="{{ asset('img/assets/icon/icon_admin_product_edit.svg') }}" alt="">
                    </a>
                </div>
            </div>
        @endfor
    </div>
    <!-- end of product card container -->
</div>

<!-- review-modal -->
<div id="review-modal" tabindex="-2" aria-hidden="true"
class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
<div class="relative p-4 w-full max-w-2xl max-h-full">
    <!-- Modal content -->
    <div class="bg-white w-[50vw] h-[50vh] rounded-lg shadow">
        <div class="relative w-full h-full p-6 flex flex-row grid-cols-[1fr_4fr]">
            <!-- x button (exit modal) -->
            <button type="button"
                class="absolute bg-black w-5 h-5 flex flex-col align-middle text-center items-center rounded-full pb-3 -top-2 -right-2"
                data-modal-hide="review-modal">
                <p class="m-auto text-white text-sm">X</p>
            </button>
            <!-- image category -->
            <div class="w-2/5 h-full bg-cover bg-no-repeat bg-top rounded-lg"
                style="background-image: url('{{ asset('img/example/test_shirt.jpg') }}');">
            </div>
            <div class="w-3/5 h-full px-6 flex flex-col">
                <form action="" method="" class="flex flex-col h-full text-center py-4 px-5">
                    <!-- input file image -->
                    <div class="flex items-center mt-5">
                        <!-- Ikon Bintang -->
                        <img src="{{ asset('img/assets/icon/icon_review_star.svg') }}" alt="Star Icon" class="h-16 w-16 mr-2">
                        <!-- Teks Rating -->
                        <span class="text-black text-2xl font-bold">4.9</span>
                    </div>

                    <!-- end of input file image -->
                    <!-- Input name -->
                    <textarea name="address" id="address" cols="30" rows="10"
                        class="h-56 bg-gray-50 border-2 border-black  text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full mt-8 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                        placeholder="Product Review" required disabled>
                    </textarea>
                </form>
            </div>
        </div>
    </div>
    <!-- end of modal content -->
</div>
<!-- end of review-modal -->
<!-- End of Product Content -->
