@extends('layout.user')
@section('title', 'Profile')

@section('content')
    <div class="p-4 border-2 bg-[#EFEFEF] border-gray-200 rounded-lg dark:border-gray-700 h-full overflow-y-auto">
        <div class="grid grid-cols-[1fr_5fr] rounded-lg gap-4 bg-white">
            <div class="bg-white h-auto rounded-xl p-4 mt-4">
                <div class="rounded-xl bg-slate-300">
                    <img class="w-full min-h-[10rem] m-0 p-2" id="profile_picture"
                        {{-- src="@if (!empty($user->photo)) {{ asset('/storage/profile/' . $user->photo) }} @endif" --}}
                        alt="Profile Picture">
                </div>
                <button class="w-full h-14 mt-4 rounded-xl bg-orange-400 p-2" onclick="$('input[name=photo]').click()">
                    <h1 class="text-xl text-white font-semibold">Choose Photo</h1>
                </button>
            </div>
            <div class="items-start justify-start bg-white h-auto rounded-xl p-4">
                <div class="relative overflow-x-auto w-full">
                    <form id="profile_form" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <input type="file" name="photo" id="photo" class="hidden">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <tbody>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <label for="fullname"
                                            class="flex items-center mb-2 text-lg font-medium text-gray-900 dark:text-white">Name</label>
                                    </th>
                                    <td class="px-6 py-4">
                                        <input type="text" id="fullname" name="fullname"
                                            class="h-14 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                            placeholder="Your Name" required />
                                    </td>
                                    <td class="">
                                        <button id="btn-edit"
                                            class="flex items-center justify-center w-auto h-auto rounded-lg bg-orange-400 hover:bg-orange-500 focus:ring-4 focus:outline-none focus:ring-orange-300 text-xl mr-1 px-5 py-2.5 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800 text-white"
                                            type="button">
                                            Edit
                                            <img src="{{ asset('img/assets/icon/icon_faq_edit.svg') }}" alt="Edit Icon"
                                                class="h-6 w-6 ml-2">
                                        </button>
                                        <button id="btn-save"
                                            class="flex items-center justify-center w-auto h-auto rounded-lg bg-orange-400 hover:bg-orange-500 focus:ring-4 focus:outline-none focus:ring-orange-300 text-xl mr-1 px-5 py-2.5 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800 text-white hidden"
                                            type="submit">
                                            Save
                                            <img src="{{ asset('img/assets/icon/icon_faq_edit.svg') }}" alt="Edit Icon"
                                                class="h-6 w-6 ml-2">
                                        </button>
                                    </td>
                                    <td>
                                        <button id="btn-cancel"
                                            class="flex items-center justify-center w-auto h-auto rounded-lg bg-orange-400 hover:bg-orange-500 focus:ring-4 focus:outline-none focus:ring-orange-300 text-xl mr-1 px-5 py-2.5 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800 text-white hidden"
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
                                        <label for="date_of_birth"
                                            class="flex items-center mb-2 text-lg font-medium text-gray-900 dark:text-white">Date
                                            of
                                            Birth</label>
                                    </th>
                                    <td class="px-6 py-4">
                                        <input type="text" id="date_of_birth" name="date_of_birth"
                                            {{-- value="{{ $user->date_of_birth }}" --}}
                                            class="h-14 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                            placeholder="Your Birth Date" required />
                                    </td>
                                </tr>

                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <label for="gender"
                                            class="flex items-center mb-2 text-lg font-medium text-gray-900 dark:text-white">Gender</label>
                                    </th>
                                    <td class="px-6 py-4 flex" colspan="2">
                                        <div class="flex items-center mr-5">
                                            <input id="genderMale" type="radio" name="gender" value="male"
                                                form=""
                                                class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-orange-400 dark:focus:ring-orange-500 dark:focus:bg-orange-500 dark:bg-gray-700 dark:border-gray-600 "
                                                style="color:#FF9D66"
                                                disabled>
                                            <label for="genderMale"
                                                class="block ms-2  text-base font-medium text-gray-900 dark:text-gray-300">
                                                Laki-Laki
                                            </label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="genderFemale" type="radio" name="gender" value="female"
                                                class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-orange-400 dark:focus:ring-orange-500 dark:focus:bg-orange-500 dark:bg-gray-700 dark:border-gray-600 "
                                                style="color:#FF9D66"
                                                disabled>
                                            <label for="genderFemale"
                                                class="block ms-2 text-base font-medium text-gray-900 dark:text-gray-300">
                                                Perempuan
                                            </label>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4" colspan="2"></td>
                                </tr>

                                <tr class="border-b bg-white dark:bg-gray-800">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <label for="email"
                                            class="flex items-center mb-2 text-lg font-medium text-gray-900 dark:text-white">Email</label>
                                    </th>
                                    <td class="px-6 py-4">
                                        <input type="email" id="email"
                                            class="h-14 bg-gray-50 border- border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                            placeholder="Your Email" disabled />
                                    </td>
                                </tr>

                                <tr class="bg-white dark:bg-gray-800">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <label for="old_password"
                                            class="flex items-center mb-2 text-lg font-medium text-gray-900 dark:text-white">Password</label>
                                    </th>
                                    <td class="px-6 py-4 relative">
                                        <input type="password" id="old_password" name="old_password"
                                            class="h-14 bg-gray-50 border- border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                            placeholder="Old Password" />
                                        <span class="absolute inset-y-0 right-4 pr-6 flex items-center btn-show-password">
                                            <img src="{{ asset('img/assets/icon/icon_hide_eye.svg') }}"
                                                alt="eye hide Icon" class="h-6 w-6 cursor-pointer">
                                        </span>
                                    </td>
                                </tr>
                                <tr class="bg-white dark:bg-gray-800">
                                    <th scope="row">
                                    </th>
                                    <td class="px-6 py-4 relative">
                                        <input type="password" id="new_password" name="new_password"
                                            class="h-14 bg-gray-50 border- border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                            placeholder="New Password" />
                                        <span class="absolute inset-y-0 right-4 pr-6 flex items-center btn-show-password">
                                            <img src="{{ asset('img/assets/icon/icon_hide_eye.svg') }}"
                                                alt="eye hide Icon" class="h-6 w-6 cursor-pointer">
                                        </span>

                                    </td>
                                </tr>
                                <tr class="border-b bg-white dark:bg-gray-800">
                                    <th scope="row">
                                    </th>
                                    <td class="px-6 py-4 relative">
                                        <input type="password" id="new_password_confirmation"
                                            name="new_password_confirmation"
                                            class="h-14 bg-gray-50 border- border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                            placeholder="Confirm Password" />
                                        <span class="absolute inset-y-0 right-4 pr-6 flex items-center btn-show-password">
                                            <img src="{{ asset('img/assets/icon/icon_hide_eye.svg') }}"
                                                alt="eye hide Icon" class="h-6 w-6 cursor-pointer">
                                        </span>

                                    </td>
                                </tr>

                                <tr class="border-b bg-white dark:bg-gray-800">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <label for="phone"
                                            class="flex items-center mb-2 text-lg font-medium text-gray-900 dark:text-white">Phone
                                            Number</label>
                                    </th>
                                    <td class="px-6 py-4">
                                        <input type="text" id="phone" name="phone"
                                            class="h-14 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                            placeholder="Your Phone Number" />
                                    </td>
                                </tr>

                                <tr class="bg-white dark:bg-gray-800">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <label for="address"
                                            class="flex items-center mb-2 text-lg font-medium text-gray-900 dark:text-white">Address</label>
                                    </th>
                                    <td class="px-6 py-4"> <!-- Change here to span two columns -->
                                        <div class="flex"> <!-- Flex container to arrange textareas side by side -->
                                            <input type="text" id="province" name="province"
                                                {{-- value="{{ $address->province ?? '' }}" --}}
                                                class="w-full h-14 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block mr-8 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                                placeholder="Your Province" />
                                            <input type="text" id="city" name="city"
                                                {{-- value="{{ $address->city ?? '' }}" --}}
                                                class="w-full h-14 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                                placeholder="Your City" />
                                        </div>
                                    </td>
                                </tr>

                                <tr class="bg-white dark:bg-gray-800">
                                    <th scope="row"></th>
                                    <td class="px-6 py-4"> <!-- Change here to span two columns -->
                                        <input type="text" id="postal_code" name="postal_code"
                                            value="{{ $address->postal_code ?? '' }}"
                                            class="h-14 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                            placeholder="Your Postal Code" />
                                    </td>
                                </tr>

                                <tr class="bg-white dark:bg-gray-800">
                                    <th scope="row"></th>
                                    <td class="px-6 py-4"> <!-- Change here to span two columns -->
                                        <textarea name="address" id="address" cols="30" rows="10"
                                            class="h-56 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                            placeholder="Your Address">{{ $address->address ?? '' }}</textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @section('script')
    <script>
        function edit() {
            $('#btn-edit').addClass('hidden');
            $('#btn-save').removeClass('hidden');
            $('#btn-cancel').removeClass('hidden');
            $('input[id!=email]').removeAttr('disabled');
            $('textarea').removeAttr('disabled');
        }

        function cancel(firstLoad = false) {
            $('#btn-edit').removeClass('hidden');
            $('#btn-save').addClass('hidden');
            $('#btn-cancel').addClass('hidden');
            $('input[id!=email]').attr('disabled', true);
            $('textarea').attr('disabled', true);

            if (firstLoad) return;
            $('input[name="fullname"]').val('{{ $user->fullname }}');
            $('input[name="date_of_birth"]').val('{{ $user->date_of_birth }}');
            $('input[name="gender"][value="{{ $user->gender }}"]').attr('checked', true);
            $('input[name="gender"][value!="{{ $user->gender }}"]').attr('checked', false);
            $('input[name="phone"]').val('{{ $user->phone }}');
            $('input[name="province"]').val('{{ $address->province ?? '' }}');
            $('input[name="city"]').val('{{ $address->city ?? '' }}');
            $('input[name="postal_code"]').val('{{ $address->postal_code ?? '' }}');
            $('textarea[name="address"]').val('{{ $address->address ?? '' }}');
            $('#profile_picture').attr('src', e.target.result);
        }

        cancel(true);
        $('#btn-edit').click(edit);
        $('#btn-cancel').click(cancel);

        $('#new_password').on('input', function() {
            if ($('#new_password').val() != '') {
                $('#old_password').attr('required', 'required');
                $('#new_password_confirmation').attr('required', 'required');
            } else {
                $('#old_password').removeAttr('required');
                $('#new_password_confirmation').removeAttr('required');
            }
        })

        $('.btn-show-password').click(function() {
            const input = $(this).prev();
            const type = input.attr('type') === 'password' ? 'text' : 'password';
            input.attr('type', type);
            $(this).find('img').attr('src', type === 'password' ?
                '{{ asset('img/assets/icon/icon_hide_eye.svg') }}' :
                '{{ asset('img/assets/icon/icon_show_eye.svg') }}');
        });

        $('input[name=photo]').change(function(ev) {
            ev.preventDefault();
            const file = ev.target.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#profile_picture').attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        });
    </script>
@endsection --}}
