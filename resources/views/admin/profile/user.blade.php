@extends('layout.admin')

@section('title', 'Profile')

@section('content')
    <!-- Kontainer utama untuk halaman profil -->
    <div class="p-4 border-2 bg-[#EFEFEF] border-gray-200 rounded-lg dark:border-gray-700 h-full overflow-y-auto">
        <div class="grid grid-cols-[1fr_5fr] rounded-lg gap-4 bg-white">

            <!-- Bagian Foto Profil -->
            <div class="bg-white h-auto rounded-xl p-4 mt-4">
                <!-- Menampilkan foto profil pengguna -->
                <div class="rounded-xl bg-slate-300">
                    <img class="w-full min-h-[10rem] m-0 p-2" id="profile_picture"
                        src="@if (!empty($user->photo)) {{ asset('/storage/profile/' . $user->photo) }} @endif"
                        alt="Profile Picture">
                </div>
                <!-- Tombol untuk memilih foto baru -->
                <button class="w-full h-14 mt-4 rounded-xl bg-orange-400 p-2" onclick="$('input[name=photo]').click()">
                    <h1 class="text-xl text-white font-semibold">Choose Photo</h1>
                </button>
            </div>

            <!-- Formulir untuk mengedit profil -->
            <div class="items-start justify-start bg-white h-auto rounded-xl p-4">
                <div class="relative overflow-x-auto w-full">
                    <form id="profile_form" action="{{ route('admin.profile.user') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <input type="file" name="photo" id="photo" class="hidden">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <tbody>
                                <!-- Baris untuk Nama -->
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <label for="fullname"
                                            class="flex items-center mb-2 text-lg font-medium text-gray-900 dark:text-white">Name</label>
                                    </th>
                                    <td class="px-6 py-4">
                                        <input type="text" id="fullname" name="fullname" value="{{ $user->fullname }}"
                                            class="h-14 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                            placeholder="Your Name" required />
                                    </td>
                                    <td class="">
                                        <!-- Tombol Edit -->
                                        <button id="btn-edit"
                                            class="flex items-center justify-center w-auto h-auto rounded-lg bg-orange-400 hover:bg-orange-500 focus:ring-4 focus:outline-none focus:ring-orange-300 text-xl mr-1 px-5 py-2.5 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800 text-white"
                                            type="button">
                                            Edit
                                            <img src="{{ asset('img/assets/icon/icon_faq_edit.svg') }}" alt="Edit Icon"
                                                class="h-6 w-6 ml-2">
                                        </button>
                                        <!-- Tombol Simpan -->
                                        <button id="btn-save"
                                            class="flex items-center justify-center w-auto h-auto rounded-lg bg-orange-400 hover:bg-orange-500 focus:ring-4 focus:outline-none focus:ring-orange-300 text-xl mr-1 px-5 py-2.5 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800 text-white hidden"
                                            type="submit">
                                            Save
                                            <img src="{{ asset('img/assets/icon/icon_faq_edit.svg') }}" alt="Edit Icon"
                                                class="h-6 w-6 ml-2">
                                        </button>
                                    </td>
                                    <td>
                                        <!-- Tombol Cancel -->
                                        <button id="btn-cancel"
                                            class="flex items-center justify-center w-auto h-auto rounded-lg bg-orange-400 hover:bg-orange-500 focus:ring-4 focus:outline-none focus:ring-orange-300 text-xl mr-1 px-5 py-2.5 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800 text-white hidden"
                                            type="button">
                                            Cancel
                                            <img src="{{ asset('img/assets/icon/icon_faq_edit.svg') }}" alt="Edit Icon"
                                                class="h-6 w-6 ml-2">
                                        </button>
                                    </td>
                                </tr>

                                <!-- Baris untuk Tanggal Lahir -->
                                <tr class="bg-white border-b dark :bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <label for="date_of_birth"
                                            class="flex items-center mb-2 text-lg font-medium text-gray-900 dark:text-white">Date
                                            of Birth</label>
                                    </th>
                                    <td class="px-6 py-4">
                                        <input type="text" id="date_of_birth" name="date_of_birth"
                                            value="{{ $user->date_of_birth }}"
                                            class="h-14 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                            placeholder="Your Birth Date" required />
                                    </td>
                                </tr>

                                <!-- Baris untuk Jenis Kelamin -->
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
                                                style="color:#FF9D66" @if ($user->gender == 'male') checked @endif
                                                disabled>
                                            <label for="genderMale"
                                                class="block ms-2 text-base font-medium text-gray-900 dark:text-gray-300">
                                                Laki-Laki
                                            </label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="genderFemale" type="radio" name="gender" value="female"
                                                class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-orange-400 dark:focus:ring-orange-500 dark:focus:bg-orange-500 dark:bg-gray-700 dark:border-gray-600 "
                                                style="color:#FF9D66" @if ($user->gender == 'female') checked @endif
                                                disabled>
                                            <label for="genderFemale"
                                                class="block ms-2 text-base font-medium text-gray-900 dark:text-gray-300">
                                                Perempuan
                                            </label>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4" colspan="2"></td>
                                </tr>

                                <!-- Baris untuk Email -->
                                <tr class="border-b bg-white dark:bg-gray-800">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <label for="email"
                                            class="flex items-center mb-2 text-lg font-medium text-gray-900 dark:text-white">Email</label>
                                    </th>
                                    <td class="px-6 py-4">
                                        <input type="email" id="email" value="{{ $user->email }}"
                                            class="h-14 bg-gray-50 border- border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                            placeholder="Your Email" disabled />
                                    </td>
                                </tr>

                                <!-- Baris untuk Password -->
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
                                        <span class="absolute inset-y-0 right-4 pr-3">
                                            <!-- Tombol untuk menampilkan password -->
                                            <button type="button"
                                                class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                            </button>
                                        </span>
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

@section('script')
    <script>
        //Fungsi untuk mengaktifkan mode edit
        function edit() {
            $('#btn-edit').addClass('hidden'); // Sembunyikan tombol Edit
            $('#btn-save').removeClass('hidden'); // Tampilkan tombol Simpan
            $('#btn-cancel').removeClass('hidden'); // Tampilkan tombol Cancel
            $('input[id!=email]').removeAttr('disabled'); // Aktifkan semua input kecuali email
            $('textarea').removeAttr('disabled'); // Aktifkan textarea
        }

        //Fungsi untuk membatalkan perubahan dan kembali ke mode tampilan
        function cancel(reset = true) {
            $('#btn-edit').removeClass('hidden'); // Tampilkan tombol Edit
            $('#btn-save').addClass('hidden'); // Sembunyikan tombol Simpan
            $('#btn-cancel').addClass('hidden'); // Sembunyikan tombol Cancel
            $('input[id!=email]').attr('disabled', true); // Nonaktifkan semua input kecuali email
            $('textarea').attr('disabled', true); // Nonaktifkan textarea
            if (!reset) return;

            // Mengembalikan nilai input ke nilai asli
            $('input[name="fullname"]').val('{{ $user->fullname }}'); // Mengatur kembali nama lengkap
            $('input[name="date_of_birth"]').val('{{ $user->date_of_birth }}'); // Mengatur kembali tanggal lahir
            $('input[name="gender"][value="{{ $user->gender }}"]').attr('checked', true); // Mengatur kembali jenis kelamin
            $('input[name="gender"][value!="{{ $user->gender }}"]').attr('checked',
                false); // Menghapus centang pada jenis kelamin yang lain
            $('input[name="phone"]').val('{{ $user->phone }}'); // Mengatur kembali nomor telepon
            $('input[name="province"]').val('{{ $address->province }}'); // Mengatur kembali provinsi
            $('input[name="city"]').val('{{ $address->city }}'); // Mengatur kembali kota
            $('input[name="postal_code"]').val('{{ $address->postal_code }}'); // Mengatur kembali kode pos
            $('textarea[name="address"]').val('{{ $address->address }}'); // Mengatur kembali alamat
        }

        cancel(false); // Memanggil fungsi cancel saat halaman dimuat untuk mengatur tampilan awal
        $('#btn-edit').click(edit); // Menetapkan fungsi edit saat tombol Edit diklik
        $('#btn-cancel').click(cancel); // Menetapkan fungsi cancel saat tombol Cancel diklik

        // Mengatur validasi untuk password baru
        $('#new_password').on('input', function() {
            if ($('#new_password').val() != '') { // Jika password baru diisi
                $('#old_password').attr('required', 'required'); // Jadikan password lama wajib diisi
                $('#new_password_confirmation').attr('required',
                    'required'); // Jadikan konfirmasi password baru wajib diisi
            } else {
                $('#old_password').removeAttr('required'); // Hapus keharusan untuk password lama
                $('#new_password_confirmation').removeAttr(
                    'required'); // Hapus keharusan untuk konfirmasi password baru
            }
        });

        // Menangani tampilan password saat tombol untuk menampilkan/menyembunyikan password diklik
        $('.btn-show-password').click(function() {
            const input = $(this).prev(); // Ambil input password yang berada di sebelah kiri tombol
            const type = input.attr('type') === 'password' ? 'text' :
                'password'; // Ubah tipe input antara 'password' dan 'text'
            input.attr('type', type); // Setel tipe input
            // Mengubah ikon mata sesuai dengan tipe input
            $(this).find('img').attr('src', type === 'password' ?
                '{{ asset('img/assets/icon/icon_hide_eye.svg') }}' :
                // Ganti dengan ikon sembunyikan jika tipe adalah password
                '{{ asset('img/assets/icon/icon_show_eye.svg') }}'
            ); // Ganti dengan ikon tampilkan jika tipe adalah text
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
