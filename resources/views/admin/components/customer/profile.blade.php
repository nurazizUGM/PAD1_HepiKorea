{{-- Halaman Profil Pengguna --}}
<div class="p-4 border-2 bg-[#EFEFEF] border-gray-200 rounded-lg dark:border-gray-700 h-full overflow-y-auto">
    <div class="grid grid-cols-[1fr_5fr] rounded-lg gap-4 bg-white">

        {{-- Bagian Foto Profil --}}
        <div class="bg-white h-auto rounded-xl p-4 mt-4">
            <div class="rounded-xl bg-slate-300">
                <img class="w-full m-0 p-2"
                    src="{{asset('img/example/test_tshirt4')}}"
                    alt="Profile Picture">
            </div>
            <button class="w-full h-14 mt-4 rounded-xl bg-orange-400 p-2">
                <h1 class="text-xl text-white font-semibold">Choose Photo</h1>
            </button>
        </div>

        {{-- Bagian Informasi Pengguna --}}
        <div class="items-start justify-start bg-white h-auto rounded-xl p-4">
            <div class="relative overflow-x-auto w-full">
                <form id="profile_form" method="post">
                    @csrf
                    @method('PATCH')
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <tbody>
                            {{-- Baris untuk Nama --}}
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <label for="fullname" class="flex items-center mb-2 text-lg font-medium text-gray-900 dark:text-white">Name</label>
                                </th>
                                <td class="px-6 py-4">
                                    <input type="text" id="fullname" name="fullname"
                                        class="h-14 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                        placeholder="Your Name" required />
                                </td>
                            </tr>

                            {{-- Baris untuk Tanggal Lahir --}}
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <label for="date_of_birth" class="flex items-center mb-2 text-lg font-medium text-gray-900 dark:text-white">Date of Birth</label>
                                </th>
                                <td class="px-6 py-4">
                                    <input type="text" id="date_of_birth" name="date_of_birth"

                                        class="h-14 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                        placeholder="Your Birth Date" required />
                                </td>
                            </tr>

                            {{-- Baris untuk Jenis Kelamin --}}
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <label for="gender" class="flex items-center mb-2 text-lg font-medium text-gray-900 dark:text-white">Gender</label>
                                </th>
                                <td class="px-6 py-4 flex" colspan="2">
                                    <div class="flex items-center mr-5">
                                        <input id="genderMale" type="radio" name="gender" value="male"
                                            class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-orange-400 dark:focus:ring-orange-500 dark:focus:bg-orange-500 dark:bg-gray-700 dark:border-gray-600 "
                                            style="color:#FF9D66" disabled>
                                        <label for="genderMale" class="block ms-2 text-base font-medium text-gray-900 dark:text-gray-300">
                                            Laki-Laki
                                        </label>
                                    </div>
                                    <div class="flex items-center">
                                        <input id="genderFemale" type="radio" name="gender" value="female"
                                            class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-orange-400 dark:focus:ring-orange-500 dark:focus:bg-orange-500 dark:bg-gray-700 dark:border-gray-600 "
                                            style="color:#FF9D66" disabled>
                                        <label for="genderFemale" class="block ms-2 text-base font-medium text-gray-900 dark:text-gray-300">
                                            Perempuan
                                        </label>
                                    </div>
                                </td>
                            </tr>

                            {{-- Baris untuk Email --}}
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <label for="email" class="flex items-center mb-2 text-lg font-medium text-gray-900 dark:text-white">Email</label>
                                </th>
                                <td class="px-6 py-4">
                                    <input type="email" id="email"
                                        class="h-14 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                        placeholder="Your Email" disabled />
                                </td>
                            </tr>

                            {{-- Baris untuk Password --}}
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <label for="old_password" class="flex items-center mb-2 text-lg font-medium text-gray-900 dark:text-white">Password</label>
                                </th>
                                <td class="px-6 py-4">
                                    <input type="password" id="old_password" name="old_password"
                                        class="h-14 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                        placeholder="Old Password" />
                                </td>
                            </tr>

                            {{-- Baris untuk Password Baru --}}
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <label for="new_password" class="flex items-center mb-2 text-lg font-medium text-gray-900 dark:text-white">New Password</label>
                                </th>
                                <td class="px-6 py-4">
                                    <input type="password" id="new_password" name="new_password"
                                        class="h-14 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                        placeholder="New Password" />
                                </td>
                            </tr>

                            {{-- Baris untuk Konfirmasi Password Baru --}}
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <label for="new_password_confirmation" class="flex items-center mb-2 text-lg font-medium text-gray-900 dark:text-white">Confirm Password</label>
                                </th>
                                <td class="px-6 py-4">
                                    <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                                        class="h-14 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                        placeholder="Confirm Password" />
                                </td>
                            </tr>

                            {{-- Baris untuk Nom or Telepon --}}
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <label for="phone" class="flex items-center mb-2 text-lg font-medium text-gray-900 dark:text-white">Phone Number</label>
                                </th>
                                <td class="px-6 py-4">
                                    <input type="text" id="phone" name="phone"

                                        class="h-14 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                        placeholder="Your Phone Number" />
                                </td>
                            </tr>

                            {{-- Baris untuk Alamat --}}
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <label for="address" class="flex items-center mb-2 text-lg font-medium text-gray-900 dark:text-white">Address</label>
                                </th>
                                <td class="px-6 py-4">
                                    <input type="text" id="province" name="province"
                                        class="h-14 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                        placeholder="Your Province" />
                                    <input type="text" id="city" name="city"
                                        class="h-14 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                        placeholder="Your City" />
                                    <input type="text" id="postal_code" name="postal_code"
                                        class="h-14 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                        placeholder="Your Postal Code" />
                                    <textarea name="address" id="address" cols="30" rows="10"
                                        class="h-14 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"></textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="submit" class="w-full h-14 mt-4 rounded-xl bg-orange-400 p-2">
                        <h1 class="text-xl text-white font-semibold">Save Changes</h1>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
