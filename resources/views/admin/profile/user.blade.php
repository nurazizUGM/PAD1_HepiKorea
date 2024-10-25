@extends('layout.admin')
@section('title', 'test profil')

@section('content')
    <div class="p-4 border-2 bg-[#EFEFEF] border-gray-200 rounded-lg dark:border-gray-700 h-[88vh]">
        <div class="grid grid-cols-[2fr_4fr] gap-4 bg-white h-full">
            <div class="items-start justify-start bg-white h-auto rounded-xl p-4">
                <div class="w-5/6 h-3/6 rounded-xl bg-slate-300">

                    <img src="@if (!empty(Auth::user()->photo)) {{ asset('/storage/profile/' . Auth::user()->photo) }} @endif"
                        alt="">
                </div>
                <button class="w-5/6 h-14 mt-4 rounded-xl bg-orange-400 p-2">
                    <h1 class="text-xl text-white font-semibold">Choose Photo</h1>
                </button>
            </div>
            <div class="items-start justify-start bg-white h-auto rounded-xl p-4">
                <div class="relative overflow-x-auto w-full">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <tbody>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <label for="name"
                                        class="flex items-center mb-2 text-lg font-medium text-gray-900 dark:text-white">Name</label>
                                </th>
                                <td class="px-6 py-4">
                                    <input type="text" id="name"
                                        class="h-14 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                        placeholder="Your Name" required disabled />
                                </td>
                                <td class="px-6 py-4">
                                    <button data-modal-target="edit-faq" data-modal-toggle="edit-faq"
                                        class="flex items-center justify-center w-auto h-auto p-2 rounded-lg bg-orange-400 hover:bg-orange-500 focus:ring-4 focus:outline-none focus:ring-orange-300 text-xl mr-4 px-5 py-2.5 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800 text-white"
                                        type="button">
                                        Edit
                                        <img src="{{ asset('img/assets/icon/icon_faq_edit.svg') }}" alt="Edit Icon"
                                            class="h-6 w-6 ml-2">
                                    </button>
                                    <button data-modal-target="edit-faq" data-modal-toggle="edit-faq"
                                        class="flex items-center justify-center w-auto h-auto p-2 rounded-lg bg-orange-400 hover:bg-orange-500 focus:ring-4 focus:outline-none focus:ring-orange-300 text-xl mr-4 px-5 py-2.5 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800 text-white hidden"
                                        type="button">
                                        Save
                                        <img src="{{ asset('img/assets/icon/icon_faq_edit.svg') }}" alt="Edit Icon"
                                            class="h-6 w-6 ml-2">
                                    </button>
                                </td>
                                <td>
                                    <button data-modal-target="edit-faq" data-modal-toggle="edit-faq"
                                        class="flex items-center justify-center w-auto h-auto p-2 rounded-lg bg-orange-400 hover:bg-orange-500 focus:ring-4 focus:outline-none focus:ring-orange-300 text-xl mr-4 px-5 py-2.5 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800 text-white hidden"
                                        type="button">
                                        Cancel
                                        <img src="{{ asset('img/assets/icon/icon_faq_edit.svg') }}" alt="Edit Icon"
                                            class="h-6 w-6 ml-2">
                                    </button>
                                </td>
                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <label for="date_birth"
                                        class="flex items-center mb-2 text-lg font-medium text-gray-900 dark:text-white">Date
                                        Birth</label>
                                </th>
                                <td class="px-6 py-4">
                                    <input type="text" id="date_birth"
                                        class="h-14 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                        placeholder="Your Birth Date" required disabled />
                                </td>

                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <label for="gender"
                                        class="flex items-center mb-2 text-lg font-medium text-gray-900 dark:text-white">Gender</label>
                                </th>
                                <td class="px-6 py-4" colspan="2">
                                    <div class="flex items-center mb-10">
                                        <input id="laki-laki" type="radio" name="gender" value="laki-laki"
                                            class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-orange-400 dark:focus:ring-orange-500 dark:focus:bg-orange-500 dark:bg-gray-700 dark:border-gray-600 "
                                            style="color:#FF9D66" checked disabled>
                                        <label for="laki-laki"
                                            class="block ms-2  text-base font-medium text-gray-900 dark:text-gray-300">
                                            Laki-Laki
                                        </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="perempuan" type="radio" name="gender" value="perempuan"
                                            class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-orange-400 dark:focus:ring-orange-500 dark:focus:bg-orange-500 dark:bg-gray-700 dark:border-gray-600 "
                                            style="color:#FF9D66" checked disabled>
                                        <label for="perempuan"
                                            class="block ms-2 text-base font-medium text-gray-900 dark:text-gray-300">
                                            Perempuan
                                        </label>
                                    </div>
                                </td>

                                <td class="px-6 py-4" colspan="2"></td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <label for="email"
                                        class="flex items-center mb-2 text-lg font-medium text-gray-900 dark:text-white">Email</label>
                                </th>
                                <td class="px-6 py-4">
                                    <input type="text" id="email"
                                        class="h-14 bg-gray-50 border- border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                        placeholder="Your Email" required disabled />
                                </td>

                            </tr>
                            <tr class="bg-white dark:bg-gray-800">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <label for="password"
                                        class="flex items-center mb-2 text-lg font-medium text-gray-900 dark:text-white">Password</label>
                                </th>
                                <td class="px-6 py-4">
                                    <input type="password" id="password"
                                        class="h-14 bg-gray-50 border- border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                        placeholder="Your Password" required disabled />
                                </td>

                            </tr>
                            <tr class="bg-white dark:bg-gray-800">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <label for="phone_number"
                                        class="flex items-center mb-2 text-lg font-medium text-gray-900 dark:text-white">Phone
                                        Number</label>
                                </th>
                                <td class="px-6 py-4">
                                    <input type="text" id="phone_number"
                                        class="h-14 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                        placeholder="Your Phone Number" required disabled />
                                </td>

                            </tr>
                            <tr class="bg-white dark:bg-gray-800">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <label for="address"
                                        class="flex items-center mb-2 text-lg font-medium text-gray-900 dark:text-white">Address</label>
                                </th>
                                <td class="px-6 py-4"> <!-- Change here to span two columns -->
                                    <div class="flex space-x-2"> <!-- Flex container to arrange textareas side by side -->
                                        <input type="text" id="phone_number"
                                            class="h-14 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-72 mr-8 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                            placeholder="Your Province" required disabled />
                                        <input type="text" id="phone_number"
                                            class="h-14 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-72 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                            placeholder="Your City" required disabled />
                                    </div>
                                    <input type="text" id="phone_number"
                                        class="h-14 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full mt-8 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                        placeholder="Your Postal Code" required disabled />
                                    <textarea name="address" id="address" cols="30" rows="10"
                                        class="h-56 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full mt-8 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                        placeholder="Your Address" required disabled></textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
