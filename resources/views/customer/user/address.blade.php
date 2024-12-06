@extends('layout.customer')
@section('title', 'address')

{{-- disable footer --}}
@section('footer', '')

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
                                data-modal-target="confirmation-delete-modal"
                                data-modal-toggle="confirmation-delete-modal">Delete</button>
                        </div>
                    </div>
                @endfor

            </div>
            <button
                class="w-fit flex flex-row bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white text-lg font-semibold rounded-2xl justify-center items-center py-2 pl-10 pr-12 mr-auto mt-auto">
                <img src="{{ asset('img/assets/icon/icon_arrow_back.svg') }}" alt="" class="w-10 h-8">
                <p class="my-auto">Back</p>
            </button>

            {{-- Address --}}

            {{-- MODALS FOR ADDRES --}}

            <!-- Pop Up Add Address-->
            <div id="address-add-modal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[999999] justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-[0.1rem] w-fit max-w-4xl max-h-full">
                    <!-- Modal content -->
                    <div class="bg-white w-[55vw] rounded-[30px] shadow overflow-y-auto px-10 py-5">
                        <div class="w-full h-full flex flex-col">
                            <h1 class="text-black font-bold text-2xl p-5 pb-2 ml-6">New Address</h1>
                            <button type="button"
                                class="absolute bg-black w-6 h-6 flex flex-col align-middle text-center items-center rounded-full pb-3 top-0 right-0"
                                data-modal-hide="address-add-modal">
                                <p class="m-auto text-white text-md">X</p>
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
                                        class="bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white text-base font-semibold mx-auto mt-3 mb-3 inline-block w-1/4 h-10 rounded-xl"
                                        data-modal-target="success-added-modal" data-modal-toggle="success-added-modal">
                                        Save
                                    </button>
                                    {{-- success-added-modal --}}
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
                    <div class="bg-white w-[55vw] rounded-[30px] shadow overflow-y-auto px-10 py-5">
                        <div class="w-full h-full flex flex-col">
                            <h1 class="text-black font-bold text-2xl p-5 pb-2 ml-6">Edit Address</h1>
                            <button type="button"
                                class="absolute bg-black w-6 h-6 flex flex-col align-middle text-center items-center rounded-full pb-3 top-0 right-0"
                                data-modal-hide="address-edit-modal">
                                <p class="m-auto text-white text-md">X</p>
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
                                        class="bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white text-base font-semibold mx-auto mt-3 mb-3 inline-block w-1/4 h-10 rounded-xl"
                                        data-modal-target="success-updated-modal"
                                        data-modal-toggle="success-updated-modal">
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
                                        data-modal-hide="confirmation-delete-modal"
                                        data-modal-target="success-delete-modal"
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

            {{-- end of MODALS FOR ADDRESS --}}
        </div>
    </div>

@endsection
