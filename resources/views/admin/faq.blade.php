@extends('layout.admin')

@section('title', 'test faq')

@section('content')

    <div class="flex flex-col flex-wrap p-4 border-2 bg-[#EFEFEF] border-gray-200 rounded-lg dark:border-gray-700 w-full ">
        <div class="flex items-center w-full mb-4">
            {{-- Text FAQ --}}
            <h1 class="text-black font-bold text-3xl mb-8 w-16 mr-6">FAQ</h1>
            {{-- Button Add FAQ --}}
            <button data-modal-target="faq-add-modal" data-modal-toggle="faq-add-modal"
                class="rounded-full mb-8 bg-orange-400 w-8 hover:bg-orange-500 focus:bg-orange-700" type="button">
                <img src="{{ asset('img/assets/icon/icon_faq_plus.svg') }}" alt="plus Icon"
                    class="h-8 w-8 focus: fill-orange-400">
            </button>
        </div>

        <div class="h-auto w-full">
            @for ($i = 0; $i < 8; $i++)
                <div class="flex flex-col bg-gray-50 h-auto dark:bg-gray-800 rounded-xl p-4 mb-5 ">
                    <div class="flex items-center justify-between mb-4">
                        {{-- Title FAQ --}}
                        <h2 class="text-black font-bold text-lg">
                            FAQ eCommerce Tip #{{ $i + 1 }}: Create Uncomplicated FAQ page
                        </h2>
                        {{-- Button Edit FAQ --}}
                        <button data-modal-target="faq-edit-modal" data-modal-toggle="faq-edit-modal"
                            class="flex items-center justify-center w-auto h-auto p-2 rounded-lg bg-orange-400 hover:bg-orange-500 focus:ring-4 focus:outline-none focus:ring-orange-300 text-xl mr-4 px-5 py-2.5 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800 text-white"
                            type="button">
                            Edit
                            <img src="{{ asset('img/assets/icon/icon_faq_edit.svg') }}" alt="Edit Icon"
                                class="h-6 w-6 ml-2">
                        </button>
                    </div>
                    <div>
                        {{-- FAQ Content --}}
                        <h5 class="text-justify">
                            Keep things simple. This doesn’t mean you should give one-worded answers for your FAQ.
                            Rather you should try to keep your FAQ page from seeming cluttered. A seamless and easy to
                            navigate FAQ page assures
                            customers that they can find what they need without going straight to chat. Keep your FAQ layout
                            or design with
                            easy to use tabs, colors, text, or navigation. Don’t go overboard with the design, remember it’s
                            all about informing
                            customers not keeping them entertained.
                        </h5>
                    </div>
                </div>
            @endfor
        </div>
        {{-- FAQ --}}


        <!-- Pop Up Add FAQ -->
        <div id="faq-add-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-[0.1rem] w-fit max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="bg-white w-[40vw] rounded-lg shadow overflow-y-auto">
                    <div class="w-full h-full flex flex-col">
                        <h1 class="text-black font-bold text-2xl p-5 pb-2">Add FAQ</h1>
                        <button type="button"
                            class="absolute bg-black w-5 h-5 flex flex-col align-middle text-center items-center rounded-full pb-3 -top-2 -right-2"
                            data-modal-hide="faq-add-modal">
                            <p class="m-auto text-white text-sm">X</p>
                        </button>
                        <div class="w-full h-full flex flex-col">
                            <form action="" method="" class="flex flex-col h-full text-center py-2 px-5">
                                <input type="text" placeholder="FAQ Title" name="" id=""
                                    class="rounded-2xl w-full bg-gray-200 hover:bg-gray-300 h-14 pl-5 pr-4 cursor-pointer mt-5 placeholder:text-black border-0 focus:outline-none focus:ring-0">
                                <textarea placeholder="FAQ content ..." name="" id="" rows="12"
                                    class="rounded-2xl w-full bg-gray-200 hover:bg-gray-300 pl-5 pr-4 cursor-pointer mt-5 placeholder:text-black placeholder:font-semi border-0 focus:outline-none focus:ring-0"></textarea>
                                <button type="submit" data-modal-hide="carousel-edit-modal"
                                    class="bg-orange-400 hover:bg-orange-500 text-white font-semibold mx-auto mt-5 mb-3 inline-block w-1/2 h-14 rounded-3xl">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- end of modal content -->
            </div>
        </div>
        <!-- end of FAQ-add-modal -->

        <!-- Pop Up Edit FAQ -->
        <div id="faq-edit-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-[0.1rem] w-fit max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="bg-white w-[40vw] rounded-lg shadow overflow-y-auto">
                    <div class="w-full h-full flex flex-col">
                        <h1 class="text-black font-bold text-2xl p-5 pb-2">Edit FAQ</h1>
                        <button type="button"
                            class="absolute bg-black w-5 h-5 flex flex-col align-middle text-center items-center rounded-full pb-3 -top-2 -right-2"
                            data-modal-hide="faq-add-modal">
                            <p class="m-auto text-white text-sm">X</p>
                        </button>
                        <div class="w-full h-full flex flex-col">
                            <form action="" method="" class="flex flex-col h-full text-center py-2 px-5">
                                <input type="text" placeholder="FAQ Title" name="" id=""
                                    class="rounded-2xl w-full bg-gray-200 hover:bg-gray-300 h-14 pl-5 pr-4 cursor-pointer mt-5 placeholder:text-black border-0 focus:outline-none focus:ring-0">
                                <textarea placeholder="FAQ content ..." name="" id="" rows="12"
                                    class="rounded-2xl w-full bg-gray-200 hover:bg-gray-300 pl-5 pr-4 cursor-pointer mt-5 placeholder:text-black placeholder:font-semi border-0 focus:outline-none focus:ring-0"></textarea>
                                <button type="submit" data-modal-hide="carousel-edit-modal"
                                    class="bg-orange-400 hover:bg-orange-500 text-white font-semibold mx-auto mt-5 mb-3 inline-block w-1/2 h-14 rounded-3xl">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- end of modal content -->
            </div>
        </div>
        <!-- end of FAQ-edit-modal -->

    </div>

@endsection
