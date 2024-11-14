@extends('layout.admin') <!-- Menggunakan layout admin sebagai template dasar -->

@section('title', 'Test Bisnis') <!-- Menetapkan judul halaman -->

@section('content') <!-- Mulai bagian konten halaman -->

    <div class="p-4 border-2 bg-[#EFEFEF] border-gray-200 rounded-lg dark:border-gray-700 h-[88vh] overflow-auto">
        <!-- Kontainer utama untuk konten dengan gaya -->
        <div class="flex flex-col items-start justify-start bg-gray-50 h-auto dark:bg-gray-800 rounded-xl shadow-lg p-4">
            <!-- Tabel untuk menampilkan data bisnis -->
            <table class="w-full table-auto text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Name</th> <!-- Kolom untuk Nama -->
                        <th scope="col" class="px-6 py-3">Value</th> <!-- Kolom untuk Alamat -->
                        <th scope="col" class="px-6 py-3">Action</th> <!-- Kolom untuk Tindakan -->
                    </tr>
                </thead>
                <tbody>
                    <!-- Baris untuk data bisnis -->
                    @foreach ($settings as $setting)
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-normal dark:text-white">
                                {{ $setting->name }}</th>
                            <td class="px-6 py-4 whitespace-normal">{{ $setting->value }}</td>
                            <td class="px-6 py-4">
                                <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                    data-modal-toggle="edit-faq">Edit</a> <!-- Tautan untuk mengedit -->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    @endsection
