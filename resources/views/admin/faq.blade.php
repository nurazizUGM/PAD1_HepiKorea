@extends('layout.admin');

@section('title', 'test faq')

@section('content')

<!-- ilangin scroll -->
<div class="p-4 border-2 bg-[#EFEFEF] border-gray-200 rounded-lg dark:border-gray-700 h-auto ">
    <!-- dashboard title -->
        <!-- product -->
    <div class="flex flex-col items-start justify-start bg-gray-50 h-auto dark:bg-gray-800 rounded-xl shadow-lg p-4 ">
        <div class="flex items-center w-full mb-4">
            <div class="w-16 mr-6">
                <h1 class="text-black font-bold text-3xl mb-8">FAQ</h1>
            </div>
            <button data-modal-target="add-faq" data-modal-toggle="add-faq" class="rounded-full mb-8 bg-orange-400 w-8 hover:bg-orange-500  focus:bg-white" type="button">
                <img src="{{ asset('img/assets/icon/icon_faq_plus.svg') }}" alt="plus Icon" class="h-8 w-8 focus: fill-orange-400">
            </button>
        </div>


        @for ($i=0; $i < 8; $i++)
            <div class="flex flex-col bg-gray-50 h-auto dark:bg-gray-800 rounded-xl shadow-[0_0px_10px_rgba(0,0,0,0.3)] p-4 mb-5">
                <!-- Container untuk judul dan tombol Edit -->
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-black font-bold text-lg">
                        FAQ eCommerce Tip #1: Create Uncomplicated FAQ page
                    </h2>
                    <button data-modal-target="edit-faq" data-modal-toggle="edit-faq" class="flex items-center justify-center w-auto h-auto p-2 rounded-lg bg-orange-400 hover:bg-orange-500 focus:ring-4 focus:outline-none focus:ring-orange-300 text-xl mr-4 px-5 py-2.5 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800 text-white" type="button">
                        Edit
                        <img src="{{ asset('img/assets/icon/icon_faq_edit.svg') }}" alt="Edit Icon" class="h-6 w-6 ml-2">
                    </button>

                </div>
                <!-- Container untuk pertanyaan -->
                <div>
                    <h5 class="text-justify">
                        Keep things simple. This doesn’t mean you should give one-worded answers for your FAQ.
                        Rather you should try to keep your FAQ page from seeming cluttered. A seamless and easy to navigate FAQ page assures
                        customers that they can find what they need without going straight to chat. Keep your FAQ layout or design with
                        easy to use tabs, colors, text, or navigation. Don’t go overboard with the design, remember it’s all about informing
                        customers not keeping them entertained.
                    </h5>
                </div>
            </div>
        @endfor
        <!-- Pertanyaan dan jawabannya berada di dalam div utama FAQ -->


        <div id="add-faq" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 justify-center items-center w-full h-full overflow-y-auto overflow-x-hidden">
            <div class="relative p-4">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 w-[50vw] h-[50vh]">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Create New FAQ
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="add-faq">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only"></span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form class="p-4 md:p-5">
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-2">
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                <input type="text" name="name" id="name" class="h-16 bg-gray-50 border border-gray-300 min-w-max text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400" placeholder="Type FAQ title" required>
                            </div>

                            <div class="col-span-2">
                                <label for="description" class="block mb-2 mt-5 text-sm font-medium text-gray-900 dark:text-white">Product Description</label>
                                <textarea id="description" rows="4" class="block p-2.5 h-44 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-orange-400 focus:border-orange-400 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400" placeholder="Write the FAQ here"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="justify-end text-white inline-flex items-center bg-orange-400 hover:bg-orange-500 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">
                            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                            Save
                        </button>
                    </form>
                </div>
            </div>
        </div>


    <!-- Pop Up Edit FAQ -->
    <div id="edit-faq" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 justify-center items-center w-full h-full overflow-y-auto overflow-x-hidden">
        <div class="relative p-4">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 w-[50vw] h-[50vh]">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Edit The FAQ
                    </h3>
                    <button type="button" class="absolute bg-black w-5 h-5 flex flex-col align-middle text-center items-center rounded-full pb-3 -top-2 -right-2" data-modal-hide="default-modal">
                        <p class="m-auto text-white text-sm">X</p>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5 flex">
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                            <input type="text" name="name" id="name" class="h-16 bg-gray-50 border border-gray-300 min-w-max text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400" placeholder="Edit FAQ title" required>
                        </div>

                        <div class="col-span-2">
                            <label for="description" class="block mb-2 mt-5 text-sm font-medium text-gray-900 dark:text-white">Product Description</label>
                            <textarea id="description" rows="4" class="block p-2.5 h-44 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-orange-400 focus:border-orange-400 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400" placeholder="Edit the FAQ here"></textarea>
                        </div>
                    </div>
                    <button type="button" class="absolute bg-black w-8 h-8 flex flex-col align-middle text-center items-center rounded-full pb-3 -top-3 -right-3" data-modal-hide="edit-faq">
                        <p class="m-auto text-white text-sm">X</p>
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection
