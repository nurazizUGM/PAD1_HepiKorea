@extends('layout.user')

@section('title', 'address')

@section('content')

    <div class="flex flex-col flex-wrap p-4 border-2 bg-[#EFEFEF] border-gray-200 rounded-lg dark:border-gray-700 w-full ">
        <div class="flex items-center w-full mb-4">
            {{-- Text Address--}}
            <h1 class="text-black font-bold text-3xl mb-5 w-fit mr-6">Customer Address</h1>
            {{-- Button Add Address--}}
            <button data-modal-target="address-add-modal" data-modal-toggle="address-add-modal"
                class="rounded-full mb-8 bg-orange-400 w-8 hover:bg-orange-500 focus:bg-orange-700" type="button">
                <img src="{{ asset('img/assets/icon/icon_faq_plus.svg') }}" alt="plus Icon"
                    class="h-8 w-8 focus: fill-orange-400">
            </button>
        </div>

        <!-- Added overflow-y-auto and max-h-screen for scrolling -->
        <div class="h-auto w-full overflow-y-auto max-h-[calc(100vh-200px)]">
            @for ($i = 0; $i < 8; $i++)
                <div class="flex flex-col bg-gray-50 h-auto dark:bg-gray-800 rounded-xl p-4 m-5">
                    <table class="w-full text-sm text-left rtl:text-right text-black dark:text-gray-400">
                        <tbody>
                            <!-- First Row: Name and Phone Number -->
                            <tr class="bg-gray-50 dark:bg-gray-800">
                                <td class="w-full">
                                    <div class="flex justify-between items-start">
                                        <!-- Left Section: Name and Phone Number -->
                                        <div class="flex space-x-4 items-center">
                                            <h2 class="font-bold text-gray-900 dark:text-white text-base">Nama</h2>
                                            <div class="border-l border-gray-400 h-6"></div>
                                            <h2 class="text-black dark:text-gray-400 text-base">Phone Number</h2>
                                        </div>
                                        <!-- Right Section: Edit Button -->
                                        <button data-modal-target="address-edit-modal" data-modal-toggle="address-edit-modal"
                                            class="flex items-center justify-center p-2 rounded-lg bg-orange-400 hover:bg-orange-500 focus:ring-4 focus:outline-none focus:ring-orange-300 text-base text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800 text-white"
                                            type="button">
                                            Edit
                                            <img src="{{ asset('img/assets/icon/icon_faq_edit.svg') }}" alt="Edit Icon"
                                                class="h-6 w-6 ml-2">
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Second Row: Address Content -->
                            <tr class="bg-gray-50  dark:bg-gray-800">
                                <td>
                                     <h2 class="text-black dark:text-gray-400 text-base w-5/6">
                                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Architecto dolor libero maiores quas aliquid doloremque cumque dolorem, debitis, omnis reiciendis officiis molestias necessitatibus dolore quisquam earum veniam placeat, numquam ipsa.
                                    </h2>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endfor
        </div>

        {{-- Address --}}


        <!-- Pop Up Add Address-->
        <div id="address-add-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-[0.1rem] w-fit max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="bg-white w-[40vw] rounded-lg shadow overflow-y-auto">
                    <div class="w-full h-full flex flex-col">
                        <h1 class="text-black font-bold text-2xl p-5 pb-2">Add Address</h1>
                        <button type="button"
                            class="absolute bg-black w-5 h-5 flex flex-col align-middle text-center items-center rounded-full pb-3 -top-2 -right-2"
                            data-modal-hide="address-add-modal">
                            <p class="m-auto text-white text-sm">X</p>
                        </button>
                        <div class="w-full h-full flex flex-col">
                            <form action="" method="" class="flex flex-col h-full text-center py-2 px-5">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <tbody>
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="px-6 py-3">
                                                <input type="text" id="fullname" name="fullname"
                                                class="rounded-2xl w-full bg-gray-200 hover:bg-gray-300 h-12 pl-5 pr-4 cursor-pointer placeholder:text-black border-0 focus:outline-none focus:ring-0"
                                                    placeholder="Your Name" style="color: black;" required />
                                            </td>
                                        </tr>

                                        <tr class="border-b bg-white dark:bg-gray-800">
                                            <td class="px-6 py-3">
                                                <input type="text" id="phone" name="phone"
                                                class="rounded-2xl w-full bg-gray-200 hover:bg-gray-300 h-12 pl-5 pr-4 cursor-pointer placeholder:text-black border-0 focus:outline-none focus:ring-0"
                                                    placeholder="Your Phone Number" style="color: black;" required/>
                                            </td>
                                        </tr>

                                        <tr class="bg-white dark:bg-gray-800">
                                            <td class="px-6 py-3"> <!-- Change here to span two columns -->
                                                <div class="flex"> <!-- Flex container to arrange textareas side by side -->
                                                    <input type="text" id="province" name="province"
                                                    class="rounded-2xl w-full bg-gray-200 hover:bg-gray-300 h-10 pl-5 pr-4 cursor-pointer placeholder:text-black border-0 focus:outline-none focus:ring-0"
                                                        placeholder="Your Province" />
                                                    <input type="text" id="city" name="city"
                                                    class="rounded-2xl w-full bg-gray-200 hover:bg-gray-300 pl-5 pr-4 ml-5 cursor-pointer placeholder:text-black placeholder:font-semi border-0 focus:outline-none focus:ring-0"
                                                        placeholder="Your City" style="color: black;" required/>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="bg-white dark:bg-gray-800">
                                            <td class="px-6 py-3"> <!-- Change here to span two columns -->
                                                <input type="text" id="postal_code" name="postal_code"
                                                class="rounded-2xl w-full bg-gray-200 hover:bg-gray-300 h-10 pl-5 pr-4 cursor-pointer placeholder:text-black border-0 focus:outline-none focus:ring-0"
                                                    placeholder="Your Postal Code" style="color: black;" required/>
                                            </td>
                                        </tr>

                                        <tr class="bg-white dark:bg-gray-800">
                                            <td class="px-6 py-3"> <!-- Change here to span two columns -->
                                                <textarea name="address" id="address" cols="20" rows="8"
                                                    class="rounded-2xl w-full bg-gray-200 hover:bg-gray-300 pl-5 pr-4 cursor-pointer placeholder:text-black placeholder:font-semi border-0 focus:outline-none focus:ring-0"
                                                        placeholder="Your Address" style="color: black;" required></textarea>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button type="submit" data-modal-hide="carousel-edit-modal"
                                    class="bg-orange-400 hover:bg-orange-500 text-white text-base font-semibold mx-auto mt-3 mb-3 inline-block w-1/2 h-10 rounded-xl">
                                    Save
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- end of modal content -->
            </div>
        </div>
        <!-- end of Address-add-modal -->

        <!-- Pop Up Edit Address-->
        <div id="address-edit-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-[0.1rem] w-fit max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="bg-white w-[40vw] rounded-lg shadow overflow-y-auto">
                    <div class="w-full h-full flex flex-col">
                        <h1 class="text-black font-bold text-2xl p-5 pb-2">Add Address</h1>
                        <button type="button"
                            class="absolute bg-black w-5 h-5 flex flex-col align-middle text-center items-center rounded-full pb-3 -top-2 -right-2"
                            data-modal-hide="address-edit-modal">
                            <p class="m-auto text-white text-sm">X</p>
                        </button>
                        <div class="w-full h-full flex flex-col">
                            <form action="" method="" class="flex flex-col h-full text-center py-2 px-5">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <tbody>
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="px-6 py-3">
                                                <input type="text" id="fullname" name="fullname"
                                                class="rounded-2xl w-full bg-gray-200 hover:bg-gray-300 h-12 pl-5 pr-4 cursor-pointer placeholder:text-black border-0 focus:outline-none focus:ring-0"
                                                    placeholder="Your Name" style="color: black;" required />
                                            </td>
                                        </tr>

                                        <tr class="border-b bg-white dark:bg-gray-800">
                                            <td class="px-6 py-3">
                                                <input type="text" id="phone" name="phone"
                                                class="rounded-2xl w-full bg-gray-200 hover:bg-gray-300 h-12 pl-5 pr-4 cursor-pointer placeholder:text-black border-0 focus:outline-none focus:ring-0"
                                                    placeholder="Your Phone Number" style="color: black;" required/>
                                            </td>
                                        </tr>

                                        <tr class="bg-white dark:bg-gray-800">
                                            <td class="px-6 py-3"> <!-- Change here to span two columns -->
                                                <div class="flex"> <!-- Flex container to arrange textareas side by side -->
                                                    <input type="text" id="province" name="province"
                                                    class="rounded-2xl w-full bg-gray-200 hover:bg-gray-300 h-10 pl-5 pr-4 cursor-pointer placeholder:text-black border-0 focus:outline-none focus:ring-0"
                                                        placeholder="Your Province" />
                                                    <input type="text" id="city" name="city"
                                                    class="rounded-2xl w-full bg-gray-200 hover:bg-gray-300 pl-5 pr-4 ml-5 cursor-pointer placeholder:text-black placeholder:font-semi border-0 focus:outline-none focus:ring-0"
                                                        placeholder="Your City" style="color: black;" required/>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="bg-white dark:bg-gray-800">
                                            <td class="px-6 py-3"> <!-- Change here to span two columns -->
                                                <input type="text" id="postal_code" name="postal_code"
                                                class="rounded-2xl w-full bg-gray-200 hover:bg-gray-300 h-10 pl-5 pr-4 cursor-pointer placeholder:text-black border-0 focus:outline-none focus:ring-0"
                                                    placeholder="Your Postal Code" style="color: black;" required/>
                                            </td>
                                        </tr>

                                        <tr class="bg-white dark:bg-gray-800">
                                            <td class="px-6 py-3"> <!-- Change here to span two columns -->
                                                <textarea name="address" id="address" cols="20" rows="8"
                                                    class="rounded-2xl w-full bg-gray-200 hover:bg-gray-300 pl-5 pr-4 cursor-pointer placeholder:text-black placeholder:font-semi border-0 focus:outline-none focus:ring-0"
                                                        placeholder="Your Address" style="color: black;" required></textarea>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button type="submit" data-modal-hide="carousel-edit-modal"
                                    class="bg-orange-400 hover:bg-orange-500 text-white text-base font-semibold mx-auto mt-3 mb-3 inline-block w-1/2 h-10 rounded-xl">
                                    Save
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- end of modal content -->
            </div>
        </div>
        <!-- end of Address-edit-modal -->

    </div>

@endsection
