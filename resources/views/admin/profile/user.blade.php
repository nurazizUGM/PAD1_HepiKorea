@extends('layout.admin')
@section('title', 'Profile')

@section('content')
    <div class="p-4 border-2 bg-[#EFEFEF] border-gray-200 rounded-lg dark:border-gray-700 h-full overflow-y-auto">

        <div class="rounded-lg flex flex-col bg-white p-8">
            {{-- profile detail title --}}
            <h1 class="text-black text-2xl font-semibold">Profile Detail</h1>
            <div class="grid gap-x-20 grid-cols-[2fr_4fr] mt-6">
                <div class="bg-white h-auto flex flex-col rounded-xl mt-4">
                    <div class="rounded-xl bg-slate-300">
                        @php
                            $photo = auth()->user()->photo;
                            $photo = $photo ? asset('storage/' . $photo) : asset('img/assets/icon/icon_user2.png');

                        @endphp
                        {{-- admin profile photo --}}
                        <img class="w-full min-h-[10rem] m-0 p-2" id="profile_picture" src="{{ $photo }}"
                            alt="Profile Picture">
                    </div>
                    {{-- choose photo button --}}
                    <button class="w-[98%] h-12 mt-4 rounded-3xl bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] mx-auto p-2"
                        onclick="$('input[name=photo]').click()">
                        <h1 class="text-lg text-white font-semibold">Choose Photo</h1>
                    </button>
                    <button type="button" onclick="window.location.href='{{ route('admin.dashboard') }}'"
                        class="flex flex-row bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white font-semibold justify-center items-center w-2/5 h-10 rounded-2xl mb-6 mt-auto mr-auto">
                        <img src="{{ asset('img/assets/icon/icon_arrow_back.svg') }}" alt="" class="w-10 h-8">
                        <p class="my-auto">Back</p>
                    </button>
                </div>
                <div class="items-start justify-start bg-white h-auto rounded-xl">
                    <div class="relative overflow-x-auto w-full">
                        <form id="profile-form" action="{{ route('admin.profile.user') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <input type="file" name="photo" id="photo" class="hidden">
                            <table class="w-full text-sm text-left rtl:text-right">
                                <tbody>
                                    {{-- Name --}}
                                    <tr class="bg-white">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <label for="fullname"
                                                class="flex items-center mb-2 text-lg font-medium text-[#898383] dark:text-white">Name</label>
                                        </th>
                                        <td class="px-6 py-4">
                                            <input type="text" id="fullname" name="fullname"
                                                value="{{ $user->fullname }}"
                                                class="h-12 bg-gray-50 border border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                                placeholder="Your Name" required />
                                        </td>
                                    </tr>
                                    {{-- Date Of Birth --}}
                                    <tr class="bg-white">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-[#898383] whitespace-nowrap dark:text-white">
                                            <label for="date_of_birth"
                                                class="flex items-center mb-2 text-lg font-medium text-[#898383] dark:text-white">Date
                                                of Birth</label>
                                        </th>
                                        <td class="px-6 py-4 relative">
                                            <input type="text" id="date_of_birth" name="date_of_birth" datepicker
                                                datepicker-format="yyyy-mm-dd" value="{{ $user->date_of_birth }}"
                                                class="h-12 bg-gray-50 border border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                                placeholder="Your Birth Date" required />
                                            <div
                                                class="absolute inset-y-0 right-6 pe-6 flex items-center ps-3.5 pointer-events-none">
                                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                                </svg>
                                            </div>
                                        </td>
                                    </tr>

                                    {{-- Gender --}}
                                    <tr class="bg-white">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-[#898383] whitespace-nowrap dark:text-white">
                                            <label for="gender"
                                                class="flex items-center mb-2 text-lg font-medium text-[#898383] dark:text-white">Gender</label>
                                        </th>
                                        <td class="px-6 py-4 flex" colspan="2">
                                            <div class="flex items-center mr-5">
                                                <input id="genderMale" type="radio" name="gender" value="male"
                                                    class="w-4 h-4 border-[#376F7E] focus:ring-2 focus:ring-[#376F7E]"
                                                    style="color:#376F7E" @checked($user->gender == 'male')>
                                                <label for="genderMale"
                                                    class="block ms-2  text-base font-medium text-[#898383] dark:text-gray-300">
                                                    Male
                                                </label>
                                            </div>
                                            <div class="flex items-center">
                                                <input id="genderFemale" type="radio" name="gender" value="female"
                                                    class="w-4 h-4 border-[#376F7E] focus:ring-2 focus:ring-[#376F7E]"
                                                    style="color:#376F7E" @checked($user->gender == 'female')>
                                                <label for="genderFemale"
                                                    class="block ms-2 text-base font-medium text-[#898383] dark:text-gray-300">
                                                    Female
                                                </label>
                                            </div>
                                        </td>
                                    </tr>

                                    {{-- Email --}}
                                    <tr class="bg-white">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-[#898383] whitespace-nowrap dark:text-white">
                                            <label for="email"
                                                class="flex items-center mb-2 text-lg font-medium text-[#898383] dark:text-white">Email</label>
                                        </th>
                                        <td class="px-6 py-4">
                                            <input type="email" id="email" value="{{ $user->email }}"
                                                class="h-12 bg-gray-50 border- border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                                placeholder="Your Email" disabled />
                                        </td>
                                    </tr>

                                    {{-- Password --}}
                                    <tr class="bg-white">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-[#898383] whitespace-nowrap dark:text-white">
                                            <label for="old_password"
                                                class="flex items-center mb-2 text-lg font-medium text-[#898383] dark:text-white">Password</label>
                                        </th>
                                        <td class="px-6 py-4 relative">
                                            <input type="password" id="old_password" name="old_password"
                                                class="h-12 bg-gray-50 border- border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                                placeholder="Old Password" />
                                            <span
                                                class="absolute inset-y-0 right-4 pr-6 flex items-center btn-show-password">
                                                <img src="{{ asset('img/assets/icon/icon_hide_eye.svg') }}"
                                                    alt="eye hide Icon" class="h-6 w-6 cursor-pointer">
                                            </span>
                                        </td>
                                    </tr>

                                    {{-- new password --}}
                                    <tr class="bg-white">
                                        <th scope="row">
                                        </th>
                                        <td class="px-6 py-4 relative">
                                            <input type="password" id="new_password" name="new_password"
                                                class="h-12 bg-gray-50 border- border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                                placeholder="New Password" />
                                            <span
                                                class="absolute inset-y-0 right-4 pr-6 flex items-center btn-show-password">
                                                <img src="{{ asset('img/assets/icon/icon_hide_eye.svg') }}"
                                                    alt="eye hide Icon" class="h-6 w-6 cursor-pointer">
                                            </span>

                                        </td>
                                    </tr>
                                    
                                    {{-- new password confirmation --}}
                                    <tr class="bg-white">
                                        <th scope="row">
                                        </th>
                                        <td class="px-6 py-4 relative">
                                            <input type="password" id="new_password_confirmation"
                                                name="new_password_confirmation"
                                                class="h-12 bg-gray-50 border- border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                                placeholder="Confirm Password" />
                                            <span
                                                class="absolute inset-y-0 right-4 pr-6 flex items-center btn-show-password">
                                                <img src="{{ asset('img/assets/icon/icon_hide_eye.svg') }}"
                                                    alt="eye hide Icon" class="h-6 w-6 cursor-pointer">
                                            </span>

                                        </td>
                                    </tr>

                                    {{-- phone number --}}
                                    <tr class="bg-white">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-[#898383] whitespace-nowrap dark:text-white">
                                            <label for="phone"
                                                class="flex items-center mb-2 text-lg font-medium text-[#898383] dark:text-white">Phone
                                                Number</label>
                                        </th>
                                        <td class="px-6 py-4">
                                            <input type="text" id="phone" name="phone"
                                                value="{{ $user->phone }}"
                                                class="h-12 bg-gray-50 border border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                                placeholder="Your Phone Number" />
                                        </td>
                                    </tr>

                                    {{-- address --}}
                                    <tr class="bg-white">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-[#898383] whitespace-nowrap dark:text-white">
                                            <label for="address"
                                                class="flex items-center mb-2 text-lg font-medium text-[#898383] dark:text-white">Address</label>
                                        </th>
                                        <td class="px-6 py-4"> <!-- Change here to span two columns -->
                                            <div class="flex"> <!-- Flex container to arrange textareas side by side -->
                                                <input type="text" id="province" name="province"
                                                    value="{{ $address->province ?? '' }}"
                                                    class="w-full h-12 bg-gray-50 border border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block mr-8 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                                    placeholder="Your Province" />
                                                <input type="text" id="city" name="city"
                                                    value="{{ $address->city ?? '' }}"
                                                    class="w-full h-12 bg-gray-50 border border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                                    placeholder="Your City" />
                                            </div>
                                        </td>
                                    </tr>

                                    {{-- Postal Code --}}
                                    <tr class="bg-white">
                                        <th scope="row"></th>
                                        <td class="px-6 py-4"> <!-- Change here to span two columns -->
                                            <input type="text" id="postal_code" name="postal_code"
                                                value="{{ $address->postal_code ?? '' }}"
                                                class="h-12 bg-gray-50 border border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                                placeholder="Your Postal Code" />
                                        </td>
                                    </tr>

                                    {{-- address --}}
                                    <tr class="bg-white">
                                        <th scope="row"></th>
                                        <td class="px-6 py-4"> <!-- Change here to span two columns -->
                                            <textarea name="address" id="address" cols="5" rows="5"
                                                class="h-24 bg-gray-50 border border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                                placeholder="Your Address">{{ $address->address ?? '' }}</textarea>
                                        </td>
                                    </tr>
                                    {{-- save change di remove dlu --}}

                                    {{-- <tr class="bg-white">
                                        <th scope="row"></th>
                                        <td class="px-6 py-4"> <!-- Change here to span two columns -->
                                            <button type="submit"
                                                class="w-full h-12 rounded-xl bg-orange-400 p-2 text-white font-semibold">Save
                                                Changes</button>
                                        </td>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
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
@endsection
