{{-- Halaman Profil Pengguna --}}
<div class="p-4 border-2 bg-[#EFEFEF] w-full border-gray-200 rounded-lg dark:border-gray-700 h-[80vh]">
    <div class="grid grid-cols-[1fr_5fr] h-full rounded-lg gap-4 bg-white">

        {{-- Bagian Foto Profil --}}
        <div class="bg-white h-full rounded-xl p-4">
            <img class="w-full min-h-20 mt-4 p-2 rounded-3xl object-contain"
                src="{{ asset('img/assets/icon/icon_user.svg') }}" alt="Profile Picture">
        </div>

        {{-- Bagian Informasi Pengguna --}}
        <div class="items-start justify-start bg-white overflow-y-auto rounded-xl p-4 h-full">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <tbody>
                    {{-- Baris untuk Nama --}}
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <label for="fullname"
                                class="flex items-center mb-2 text-lg font-medium text-gray-900 dark:text-white">Name</label>
                        </th>
                        <td class="px-6 py-4">
                            <input type="text" id="fullname" name="fullname" value="{{ $customer->fullname }}"
                                class="h-14 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                placeholder="Customer Name" disabled />
                        </td>
                    </tr>

                    {{-- Baris untuk Tanggal Lahir --}}
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <label for="date_of_birth"
                                class="flex items-center mb-2 text-lg font-medium text-gray-900 dark:text-white">Date
                                of Birth</label>
                        </th>
                        <td class="px-6 py-4">
                            <input type="text" id="date_of_birth" name="date_of_birth"
                                value="{{ $customer->date_of_birth }}"
                                class="h-14 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                placeholder="Customer Birth Date" disabled />
                        </td>
                    </tr>

                    {{-- Baris untuk Jenis Kelamin --}}
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <label for="gender"
                                class="flex items-center mb-2 text-lg font-medium text-gray-900 dark:text-white">Gender</label>
                        </th>
                        <td class="px-6 py-4 flex" colspan="2">
                            <div class="flex items-center mr-5">
                                <input id="genderMale" type="radio" name="gender" value="male"
                                    {{ $customer->gender == 'male' ? 'checked' : '' }} disabled
                                    class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-orange-400 dark:focus:ring-orange-500 dark:focus:bg-orange-500 dark:bg-gray-700 dark:border-gray-600 "
                                    style="color:#FF9D66">
                                <label for="genderMale"
                                    class="block ms-2 text-base font-medium text-gray-900 dark:text-gray-300">
                                    Laki-Laki
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input id="genderFemale" type="radio" name="gender" value="female"
                                    {{ $customer->gender == 'female' ? 'checked' : '' }} disabled
                                    class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-orange-400 dark:focus:ring-orange-500 dark:focus:bg-orange-500 dark:bg-gray-700 dark:border-gray-600 "
                                    style="color:#FF9D66">
                                <label for="genderFemale"
                                    class="block ms-2 text-base font-medium text-gray-900 dark:text-gray-300">
                                    Perempuan
                                </label>
                            </div>
                        </td>
                    </tr>

                    {{-- Baris untuk Email --}}
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <label for="email"
                                class="flex items-center mb-2 text-lg font-medium text-gray-900 dark:text-white">Email</label>
                        </th>
                        <td class="px-6 py-4 relative">
                            <input type="email" id="email" name="email" value="{{ $customer->email }}"
                                class="h-14 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                placeholder="Customer Email" disabled />

                            @if ($customer->is_verified)
                                <label for="email"
                                    class="absolute top-0 right-10 h-full py-8 flex justify-center flex-col">
                                    <img src="{{ asset('img/assets/icon/icon_check.svg') }}" alt=""
                                        class="h-3/5 mt-1">
                                    <span class="text-orange-500 text-[10px] mt-auto">Verified</span>
                                </label>
                            @endif
                        </td>
                    </tr>
                    {{-- Baris untuk Alamat --}}
                    <tr class="bg-white dark:bg-gray-800">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <label for="address"
                                class="flex items-center mb-2 text-lg font-medium text-gray-900 dark:text-white">Address</label>
                        </th>
                        <td class="px-6 py-4"> <!-- Change here to span two columns -->
                            <div class="flex"> <!-- Flex container to arrange textareas side by side -->
                                <input type="text" id="province" name="province"
                                    class="w-full h-14 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block mr-8 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                    placeholder="Customer Province" disabled />
                                <input type="text" id="city" name="city"
                                    class="w-full h-14 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                    placeholder="Customer City" disabled />
                            </div>
                        </td>
                    </tr>

                    <tr class="bg-white dark:bg-gray-800">
                        <th scope="row"></th>
                        <td class="px-6 py-4"> <!-- Change here to span two columns -->
                            <input type="text" id="postal_code" name="postal_code"
                                class="h-14 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                placeholder="Customer Postal Code" disabled />
                        </td>
                    </tr>

                    <tr class="bg-white dark:bg-gray-800">
                        <th scope="row"></th>
                        <td class="px-6 py-4"> <!-- Change here to span two columns -->
                            <textarea name="address" id="address" cols="30" rows="10"
                                class="h-56 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                placeholder="Customer Address" disabled></textarea>
                        </td>
                    </tr>
                    <tr class="bg-white dark:bg-gray-800">
                        <th scope="row"></th>
                        <td class="px-6 py-4"> <!-- Change here to span two columns -->
                            <button class="w-full h-12 mt-4 rounded-xl bg-orange-400 p-2 text-xl text-white"
                                onclick="history.back()">
                                Back
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
