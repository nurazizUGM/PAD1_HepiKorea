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
                    <th scope="col" class="px-6 py-3">Business Data</th> <!-- Kolom untuk Data Bisnis -->
                    <th scope="col" class="px-6 py-3">Name</th> <!-- Kolom untuk Nama -->
                    <th scope="col" class="px-6 py-3">Address</th> <!-- Kolom untuk Alamat -->
                    <th scope="col" class="px-6 py-3">Action</th> <!-- Kolom untuk Tindakan -->
                </tr>
            </thead>
            <tbody>
                <!-- Baris untuk data bisnis -->
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-normal dark:text-white">Alamat</th>
                    <td class="px-6 py-4 whitespace-normal">Hepikoreaaa</td>
                    <td class="px-6 py-4 whitespace-normal">Jl Suprapto No 23, RtT5/RW19, Kec Udang, Kel Burangan, Sleman, Yogyakarta, Indonesia</td>
                    <td class="px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" data-modal-toggle="edit-faq">Edit</a> <!-- Tautan untuk mengedit -->
                    </td>
                </tr>
                <!-- Baris lainnya untuk data bisnis -->
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-normal dark:text-white">Instagram</th>
                    <td class="px-6 py-4 whitespace-normal">@hepikorea</td>
                    <td class="px-6 py-4 whitespace-normal">https://www.instagram.com/hepikorea</td>
                    <td class="px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" data-modal-toggle="edit-faq">Edit</a>
                    </td>
                </tr>
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-normal dark:text-white">Line</th>
                    <td class="px-6 py-4 whitespace-normal">Hepi Korea</td>
                    <td class="px-6 py-4 whitespace-normal overflow-hidden flex-wrap">
                        <a href="https://line.me/ti/p/v4ZoqbIEQ1?fbclid=PAZXh0bgNhZW0CMTEAAaYYJxYcJsZFMRTWLzvN2HmtDzvQSeC3cAZQypjEcVDnjovCrTfsfv397yg_aem_7hZKQ14ZhWj2QO3IVo5ePQ" target="_blank">Line Profile</a>
                    </td>
                    <td class="px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" data-modal-toggle="edit-faq">Edit</a>
                    </td>
                </tr>
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark :bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-normal dark:text-white">WhatsApp</th>
                    <td class="px-6 py-4 whitespace-normal">HepiKorea </td>
                    <td class="px-6 py-4 whitespace-normal">aaaaaa</td>
                    <td class="px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" data-modal-toggle="edit-faq">Edit</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

@endsection
