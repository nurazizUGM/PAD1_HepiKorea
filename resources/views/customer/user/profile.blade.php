@extends('layout.customer')
@section('title', 'Profile')

@section('content')
    <div class="p-8 border-2 bg-[#EFEFEF] border-gray-200 rounded-2xl dark:border-gray-700 h-full overflow-y-auto">
        <div class="rounded-2xl flex flex-col bg-white p-10">
            <h1 class="text-black text-2xl font-semibold">Profile Detail</h1>
            <div class="grid gap-x-16 grid-cols-[2fr_4fr] mt-6">
                <div class="bg-white h-auto flex flex-col rounded-xl mt-4">
                    <div class="rounded-xl bg-slate-300">
                        @php
                            $photo = auth()->user()->photo;
                            $photo = $photo ? asset('storage/' . $photo) : null;
                        @endphp
                        <img class="w-full min-h-[10rem] m-0 p-2 object-contain object-center" id="profile_picture"
                            src="{{ $photo }}" alt="Profile Picture">
                    </div>
                    <button class="w-[98%] h-12 mt-4 rounded-3xl bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] mx-auto p-2" onclick="$('input[name=photo]').click()">
                        <h1 class="text-lg text-white font-semibold">Choose Photo</h1>
                    </button>
                </div>
                <div class="items-start justify-start bg-white h-auto rounded-xl">
                    <div class="relative overflow-x-auto w-full">
                        <form id="profile_form" action="{{ route('auth.profile') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <input type="file" name="photo" id="photo" class="hidden">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <tbody>
                                    <tr class="bg-white border-b ">
                                        <th scope="row"
                                            class="py-4 font-medium text-[#898383] whitespace-nowrap ">
                                            <label for="fullname"
                                                class="flex items-center mb-2 text-lg font-medium text-[#898383] ">Name</label>
                                        </th>
                                        <td class="py-4 ">
                                            <input type="text" id="fullname" name="fullname"
                                                value="{{ old('fullname') ?? $user->fullname }}"
                                                class="h-12 bg-gray-50 border border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full p-2.5 "
                                                placeholder="Your Name" required />
                                        </td>
                                        {{-- <td class="">
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
                                        </td> --}}
                                        {{-- <td>
                                            <button id="btn-cancel"
                                                class="flex items-center justify-center w-auto h-auto rounded-lg bg-orange-400 hover:bg-orange-500 focus:ring-4 focus:outline-none focus:ring-orange-300 text-xl mr-1 px-5 py-2.5 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800 text-white hidden"
                                                type="button">
                                                Cancel
                                                <img src="{{ asset('img/assets/icon/icon_faq_edit.svg') }}" alt="Edit Icon"
                                                    class="h-6 w-6 ml-2">
                                            </button>
                                        </td> --}}
                                    </tr>
                                    <tr class="bg-white border-b ">
                                        <th scope="row"
                                            class=" py-4 font-medium text-[#898383] whitespace-nowrap ">
                                            <label for="date_of_birth"
                                                class="flex items-center mb-2 text-lg font-medium text-[#898383] ">Date
                                                of
                                                Birth</label>
                                        </th>
                                        <td class=" py-4 relative">
                                            <input type="text" id="date_of_birth" name="date_of_birth" datepicker
                                                datepicker-format="yyyy-mm-dd"
                                                value="{{ old('date_of_birth') ?? $user->date_of_birth }}"
                                                class="h-12 bg-gray-50 border border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full p-2.5 "
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

                                    <tr class="bg-white border-b ">
                                        <th scope="row"
                                            class=" py-4 font-medium text-[#898383] whitespace-nowrap ">
                                            <label for="gender"
                                                class="flex items-center mb-2 text-lg font-medium text-[#898383] ">Gender</label>
                                        </th>
                                        <td class=" py-4 flex" colspan="2">
                                            <div class="flex items-center mr-5">
                                                <input id="genderMale" type="radio" name="gender" value="male"
                                                    class="w-4 h-4 border-[#376F7E] focus:ring-0  "
                                                    style="color:#FF9D66" disabled @checked((old('gender') ?? $user->gender) == 'male')>
                                                <label for="genderMale"
                                                    class="block ms-2  text-base font-medium text-[#898383] dark:text-gray-300">
                                                    Male
                                                </label>
                                            </div>
                                            <div class="flex items-center">
                                                <input id="genderFemale" type="radio" name="gender" value="female"
                                                    class="w-4 h-4 border-[#376F7E] focus:ring-0  "
                                                    style="color:#FF9D66" disabled @checked((old('gender') ?? $user->gender) == 'female')>
                                                <label for="genderFemale"
                                                    class="block ms-2 text-base font-medium text-[#898383] dark:text-gray-300">
                                                    Female
                                                </label>
                                            </div>
                                        </td>
                                        <td class=" py-4" colspan="2"></td>
                                    </tr>

                                    <tr class="border-b bg-white dark:bg-gray-800">
                                        <th scope="row"
                                            class=" py-4 font-medium text-[#898383] whitespace-nowrap ">
                                            <label for="email"
                                                class="flex items-center mb-2 text-lg font-medium text-[#898383] ">Email</label>
                                        </th>
                                        <td class=" py-4">
                                            <input type="email" id="email" value="{{ $user->email }}"
                                                class="h-12 bg-gray-50 border- border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full p-2.5 "
                                                placeholder="Your Email" disabled />
                                        </td>
                                    </tr>

                                    <tr class="bg-white dark:bg-gray-800">
                                        <th scope="row"
                                            class=" py-4 font-medium text-[#898383] whitespace-nowrap ">
                                            <label for="old_password"
                                                class="flex items-center mb-2 text-lg font-medium text-[#898383] ">Password</label>
                                        </th>
                                        <td class=" py-4 relative">
                                            <input type="password" id="old_password" name="old_password"
                                                class="h-12 bg-gray-50 border- border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full p-2.5 "
                                                placeholder="Old Password" />
                                            <span
                                                class="absolute inset-y-0 right-4 pr-6 flex items-center btn-show-password">
                                                <img src="{{ asset('img/assets/icon/icon_hide_eye.svg') }}"
                                                    alt="eye hide Icon" class="h-6 w-6 cursor-pointer">
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="bg-white dark:bg-gray-800">
                                        <th scope="row">
                                        </th>
                                        <td class=" py-4 relative">
                                            <input type="password" id="new_password" name="new_password"
                                                class="h-12 bg-gray-50 border- border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full p-2.5 "
                                                placeholder="New Password" />
                                            <span
                                                class="absolute inset-y-0 right-4 pr-6 flex items-center btn-show-password">
                                                <img src="{{ asset('img/assets/icon/icon_hide_eye.svg') }}"
                                                    alt="eye hide Icon" class="h-6 w-6 cursor-pointer">
                                            </span>

                                        </td>
                                    </tr>
                                    <tr class="border-b bg-white dark:bg-gray-800">
                                        <th scope="row">
                                        </th>
                                        <td class=" py-4 relative">
                                            <input type="password" id="new_password_confirmation"
                                                name="new_password_confirmation"
                                                class="h-12 bg-gray-50 border- border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full p-2.5 "
                                                placeholder="Confirm Password" />
                                            <span
                                                class="absolute inset-y-0 right-4 pr-6 flex items-center btn-show-password">
                                                <img src="{{ asset('img/assets/icon/icon_hide_eye.svg') }}"
                                                    alt="eye hide Icon" class="h-6 w-6 cursor-pointer">
                                            </span>

                                        </td>
                                    </tr>

                                    <tr class="border-b bg-white dark:bg-gray-800">
                                        <th scope="row"
                                            class=" py-4 font-medium text-[#898383] whitespace-nowrap ">
                                            <label for="phone"
                                                class="flex items-center mb-2 text-lg font-medium text-[#898383] ">Phone
                                                Number</label>
                                        </th>
                                        <td class=" py-4">
                                            <input type="text" id="phone" name="phone"
                                                value="{{ old('phone') ?? $user->phone }}"
                                                class="h-12 bg-gray-50 border border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full p-2.5 "
                                                placeholder="Your Phone Number" />
                                        </td>
                                    </tr>
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
@endsection
