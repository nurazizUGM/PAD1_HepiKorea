@extends('layout.customer_nofooter_scrollable')

@section('title', 'address')

@section('content')

    <div class="flex flex-col flex-wrap p-6 border-2 bg-[#EFEFEF] border-gray-200 rounded-3xl w-full mh-fit">

        <div class="w-full h-full min-h-[640px] flex flex-col p-8 bg-white rounded-3xl">

            <div class="flex flex-row items-center w-full mb-4">
                {{-- Text Address --}}
                <h1 class="text-[#3E6E7A] font-semibold text-2xl  w-fit mr-6">Customer Address</h1>
                {{-- Button Add Address --}}
                <h2 class="text-black font-bold text-xl">New Address</h2>
                <button data-modal-target="address-add-modal" data-modal-toggle="address-add-modal"
                    class="rounded-full bg-[#3E6E7A] w-8 hover:bg-[#37626d] active:bg-[#325862] my-auto ml-4" type="button">
                    <img src="{{ asset('img/assets/icon/icon_faq_plus.svg') }}" alt="plus Icon"
                        class="h-8 w-8 focus: fill-[#3E6E7A]">
                </button>
            </div>

            <!-- Added overflow-y-auto and max-h-screen for scrolling -->
            <div class="h-auto w-full mb-6">
                @for ($i = 0; $i < 3; $i++)
                    <div class="w-full h-full flex flex-row mt-5 mb-auto">
                        <div class="w-2/12 flex h-full">
                            <input type="radio" name="choose-address" id=""
                                class="w-8 h-8 border-4 border-[#3E6E7A] checked:bg-[#3E6E7A] checked:ring-[#3E6E7A] ml-1 my-auto">
                            <div class="flex flex-col ml-4">
                                <div class="flex flex-row">
                                    {{-- nama --}}
                                    <p class="text-[#3E6E7A] font-semibold text-lg">Aisyah</p>
                                    <p class="text-orange-400 font-semibold text-lg inline ml-5">(+62)</p>
                                </div>
                                <p class="text-[#898383] font-semibold text-lg">813-9230-8107</p>
                            </div>
                        </div>
                        <div class="w-8/12 max-w-4/6 h-full pr-14 mb-auto">
                            <p class="text-black text-opacity-50 font-semibold text-lg">
                                Bulaksumur, Caturtunggal, Kapanewon Depok, Kabupaten Sleman,
                                Daerah Istimewa Yogyakarta 55281
                            </p>
                        </div>
                        <div class="w-1/12 h-full flex mb-auto">
                            {{-- change address button --}}
                            <button
                                class="w-fit bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white text-lg font-semibold rounded-2xl py-2 px-7 ml-auto"
                                data-modal-target="address-edit-modal" data-modal-toggle="address-edit-modal">Edit</button>
                            <button
                                class="w-fit bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white text-lg font-semibold rounded-2xl py-2 px-7 ml-2"
                                data-modal-target="change-address-modal"
                                data-modal-toggle="change-address-modal">Delete</button>
                        </div>
                    </div>
                @endfor

            </div>
            <button
                class="w-fit flex flex-row bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white text-lg font-semibold rounded-2xl justify-center items-center py-2 pl-10 pr-12 mr-auto mt-auto"
                data-modal-target="address-edit-modal" data-modal-toggle="address-edit-modal">
                <img src="{{ asset('img/assets/icon/icon_arrow_back.svg') }}" alt="" class="w-10 h-8">
                <p class="my-auto">Back</p>
            </button>

            {{-- Address --}}


            <!-- Pop Up Add Address-->
            <div id="address-add-modal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-[0.1rem] w-fit max-w-4xl max-h-full">
                    <!-- Modal content -->
                    <div class="bg-white w-[55vw] rounded-lg shadow overflow-y-auto px-10 py-5">
                        <div class="w-full h-full flex flex-col">
                            <h1 class="text-black font-bold text-2xl p-5 pb-2">New Address</h1>
                            <button type="button"
                                class="absolute bg-black w-5 h-5 flex flex-col align-middle text-center items-center rounded-full pb-3 -top-2 -right-2"
                                data-modal-hide="address-add-modal">
                                <p class="m-auto text-white text-sm">X</p>
                            </button>
                            <div class="w-full h-full flex flex-col">
                                <form action="" method="" class="flex flex-col h-full text-center py-2 px-5">
                                    <table class="w-full text-sm text-left rtl:text-right">
                                        <tbody>
                                            <tr class="bg-white border-none dark:bg-gray-800 dark:border-gray-700">
                                                <td class="px-6 py-3">
                                                    <input type="text" id="fullname" name="fullname"
                                                        class="text-orange-400 rounded-2xl w-full border border-[#3E6E7A] bg-white hover:bg-slate-50 h-12 pl-5 pr-4 cursor-pointer placeholder:text-orange-400 focus:border focus:border-[#3E6E7A] focus:outline-none focus:ring-0"
                                                        placeholder="Full Name" required />
                                                </td>
                                            </tr>

                                            <tr class="border-none bg-white dark:bg-gray-800">
                                                <td class="px-6 py-3">
                                                    <input type="text" id="phone" name="phone"
                                                        class="text-orange-400 rounded-2xl w-full border border-[#3E6E7A] bg-white hover:bg-slate-50 h-12 pl-5 pr-4 cursor-pointer placeholder:text-orange-400 focus:border focus:border-[#3E6E7A] focus:outline-none focus:ring-0"
                                                        placeholder="Phone Number" required />
                                                </td>
                                            </tr>

                                            <tr class="bg-white dark:bg-gray-800">
                                                <td class="px-6 py-3"> <!-- Change here to span two columns -->
                                                    <div class="flex">
                                                        <!-- Flex container to arrange textareas side by side -->
                                                        <input type="text" id="province" name="province"
                                                            class="text-orange-400 rounded-2xl w-full border border-[#3E6E7A] bg-white hover:bg-slate-50 h-12 pl-5 pr-4 cursor-pointer placeholder:text-orange-400 focus:border focus:border-[#3E6E7A] focus:outline-none focus:ring-0"
                                                            placeholder="Province" />
                                                        {{-- <input type="text" id="city" name="city"
                                                            class="text-orange-400 rounded-2xl w-full border border-[#3E6E7A] bg-white hover:bg-slate-50 h-12 pl-5 pr-4 cursor-pointer placeholder:text-orange-400 focus:border focus:border-[#3E6E7A] focus:outline-none focus:ring-0"
                                                            placeholder="Your City" required /> --}}
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="bg-white dark:bg-gray-800">
                                                <td class="px-6 py-3"> <!-- Change here to span two columns -->
                                                    <div class="flex">
                                                        <!-- Flex container to arrange textareas side by side -->
                                                        {{-- <input type="text" id="province" name="province"
                                                            class="text-orange-400 rounded-2xl w-full border border-[#3E6E7A] bg-white hover:bg-slate-50 h-12 pl-5 pr-4 cursor-pointer placeholder:text-orange-400 focus:border focus:border-[#3E6E7A] focus:outline-none focus:ring-0"
                                                            placeholder="Your Province" /> --}}
                                                        <input type="text" id="city" name="city"
                                                            class="text-orange-400 rounded-2xl w-full border border-[#3E6E7A] bg-white hover:bg-slate-50 h-12 pl-5 pr-4 cursor-pointer placeholder:text-orange-400 focus:border focus:border-[#3E6E7A] focus:outline-none focus:ring-0"
                                                            placeholder="City" required />
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr class="bg-white dark:bg-gray-800">
                                                <td class="px-6 py-3"> <!-- Change here to span two columns -->
                                                    <textarea name="address" id="address" cols="20" rows="8"
                                                        class="text-orange-400 rounded-2xl w-full bg-white hover:bg-slate-50 border border-[#3E6E7A] pl-5 pr-4 cursor-pointer placeholder:text-orange-400 focus:border focus:border-[#3E6E7A] focus:outline-none focus:ring-0"
                                                        placeholder="Your Address" required></textarea>
                                                </td>
                                            </tr>

                                            <tr class="bg-white dark:bg-gray-800">
                                                <td class="px-6 py-3"> <!-- Change here to span two columns -->
                                                    <input type="text" id="postal_code" name="postal_code"
                                                        class="text-orange-400 rounded-2xl w-full border border-[#3E6E7A] bg-white hover:bg-slate-50 h-12 pl-5 pr-4 cursor-pointer placeholder:text-orange-400 focus:border focus:border-[#3E6E7A] focus:outline-none focus:ring-0"
                                                        placeholder="Postal Code" required />
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button type="submit" data-modal-hide="address-add-modal"
                                        class="bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white text-base font-semibold mx-auto mt-3 mb-3 inline-block w-1/4 h-10 rounded-xl">
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
                <div class="relative p-[0.1rem] w-fit max-w-4xl max-h-full">
                    <!-- Modal content -->
                    <div class="bg-white w-[55vw] rounded-lg shadow overflow-y-auto px-10 py-5">
                        <div class="w-full h-full flex flex-col">
                            <h1 class="text-black font-bold text-2xl p-5 pb-2">Edit Address</h1>
                            <button type="button"
                                class="absolute bg-black w-5 h-5 flex flex-col align-middle text-center items-center rounded-full pb-3 -top-1 -right-6"
                                data-modal-hide="address-edit-modal">
                                <p class="m-auto text-white text-sm">X</p>
                            </button>
                            <div class="w-full h-full flex flex-col">
                                <form action="" method="" class="flex flex-col h-full text-center py-2 px-5">
                                    <table class="w-full text-sm text-left rtl:text-right">
                                        <tbody>
                                            <tr class="bg-white border-none dark:bg-gray-800 dark:border-gray-700">
                                                <td class="px-6 py-3">
                                                    <input type="text" id="fullname" name="fullname"
                                                        class="text-orange-400 rounded-2xl w-full border border-[#3E6E7A] bg-white hover:bg-slate-50 h-12 pl-5 pr-4 cursor-pointer placeholder:text-orange-400 focus:border focus:border-[#3E6E7A] focus:outline-none focus:ring-0"
                                                        placeholder="Full Name" required />
                                                </td>
                                            </tr>

                                            <tr class="border-none bg-white dark:bg-gray-800">
                                                <td class="px-6 py-3">
                                                    <input type="text" id="phone" name="phone"
                                                        class="text-orange-400 rounded-2xl w-full border border-[#3E6E7A] bg-white hover:bg-slate-50 h-12 pl-5 pr-4 cursor-pointer placeholder:text-orange-400 focus:border focus:border-[#3E6E7A] focus:outline-none focus:ring-0"
                                                        placeholder="Phone Number" required />
                                                </td>
                                            </tr>

                                            <tr class="bg-white dark:bg-gray-800">
                                                <td class="px-6 py-3"> <!-- Change here to span two columns -->
                                                    <div class="flex">
                                                        <!-- Flex container to arrange textareas side by side -->
                                                        <input type="text" id="province" name="province"
                                                            class="text-orange-400 rounded-2xl w-full border border-[#3E6E7A] bg-white hover:bg-slate-50 h-12 pl-5 pr-4 cursor-pointer placeholder:text-orange-400 focus:border focus:border-[#3E6E7A] focus:outline-none focus:ring-0"
                                                            placeholder="Province" />
                                                        {{-- <input type="text" id="city" name="city"
                                                            class="text-orange-400 rounded-2xl w-full border border-[#3E6E7A] bg-white hover:bg-slate-50 h-12 pl-5 pr-4 cursor-pointer placeholder:text-orange-400 focus:border focus:border-[#3E6E7A] focus:outline-none focus:ring-0"
                                                            placeholder="Your City" required /> --}}
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="bg-white dark:bg-gray-800">
                                                <td class="px-6 py-3"> <!-- Change here to span two columns -->
                                                    <div class="flex">
                                                        <!-- Flex container to arrange textareas side by side -->
                                                        {{-- <input type="text" id="province" name="province"
                                                            class="text-orange-400 rounded-2xl w-full border border-[#3E6E7A] bg-white hover:bg-slate-50 h-12 pl-5 pr-4 cursor-pointer placeholder:text-orange-400 focus:border focus:border-[#3E6E7A] focus:outline-none focus:ring-0"
                                                            placeholder="Your Province" /> --}}
                                                        <input type="text" id="city" name="city"
                                                            class="text-orange-400 rounded-2xl w-full border border-[#3E6E7A] bg-white hover:bg-slate-50 h-12 pl-5 pr-4 cursor-pointer placeholder:text-orange-400 focus:border focus:border-[#3E6E7A] focus:outline-none focus:ring-0"
                                                            placeholder="City" required />
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr class="bg-white dark:bg-gray-800">
                                                <td class="px-6 py-3"> <!-- Change here to span two columns -->
                                                    <textarea name="address" id="address" cols="20" rows="8"
                                                        class="text-orange-400 rounded-2xl w-full bg-white hover:bg-slate-50 border border-[#3E6E7A] pl-5 pr-4 cursor-pointer placeholder:text-orange-400 focus:border focus:border-[#3E6E7A] focus:outline-none focus:ring-0"
                                                        placeholder="Your Address" required></textarea>
                                                </td>
                                            </tr>

                                            <tr class="bg-white dark:bg-gray-800">
                                                <td class="px-6 py-3"> <!-- Change here to span two columns -->
                                                    <input type="text" id="postal_code" name="postal_code"
                                                        class="text-orange-400 rounded-2xl w-full border border-[#3E6E7A] bg-white hover:bg-slate-50 h-12 pl-5 pr-4 cursor-pointer placeholder:text-orange-400 focus:border focus:border-[#3E6E7A] focus:outline-none focus:ring-0"
                                                        placeholder="Postal Code" required />
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button type="submit" data-modal-hide="address-edit-modal"
                                        class="bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white text-base font-semibold mx-auto mt-3 mb-3 inline-block w-1/4 h-10 rounded-xl">
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
    </div>

@endsection
