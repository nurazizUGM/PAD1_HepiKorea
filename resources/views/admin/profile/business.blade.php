@extends('layout.admin')

@section('title', 'test bisnis')

@section('content')

<div class="p-4 border-2 bg-[#EFEFEF] border-gray-200 rounded-lg dark:border-gray-700 h-[88vh]">
    <div class="flex flex-col items-start justify-start bg-gray-50 h-auto dark:bg-gray-800 rounded-xl shadow-lg p-4">
        <table class="max-w-full table-auto text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Bussiness Data
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3 w-20"> <!-- Ubah di sini -->
                        Address
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-normal dark:text-white">
                        Alamat
                    </th>
                    <td class="px-6 py-4 whitespace-normal">
                        Hepikoreaaa
                    </td>
                    <td class="px-6 py-4 whitespace-normal w-20"> <!-- Ubah di sini -->
                        Jl Suprapto No 23, RtT5/RW19, Kec Udang, Kel Burangan, Sleman, Yogyakarta, Indonesia
                    </td>
                    <td class="px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    </td>
                </tr>
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-normal dark:text-white">
                        Instagram
                    </th>
                    <td class="px-6 py-4 whitespace-normal">
                        @hepikorea
                    </td>
                    <td class="px-6 py-4 whitespace-normal w-20"> <!-- Ubah di sini -->
                        https://www.instagram.com/hepikorea
                    </td>
                    <td class="px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    </td>
                </tr>
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-normal dark:text-white">
                        Line
                    </th>
                    <td class="px-6 py-4 whitespace-normal">
                        Hepi Korea
                    </td>
                    <td class="px-6 py-4 whitespace-normal w-20 overflow-hidden flex-wrap">
                        https://line.me/ti/p/v4ZoqbIEQ1?fbclid=PAZXh0bgNhZW0CMTEAAaYYJxYcJsZFMRTWLzvN2HmtDzvQSeC3cAZQypjEcVDnjovCrTfsfv397yg_aem_7hZKQ14ZhWj2QO3IVo5ePQ
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Velit cum adipisci fugiat facilis, doloribus molestias. Quisquam quia rem facilis deleniti adipisci odio vero. Hic est ipsa veritatis distinctio ut consectetur?
                    </td>
                    <td class="px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    </td>
                </tr>
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-normal dark:text-white">
                        Whatsaap
                    </th>
                    <td class="px-6 py-4 whitespace-normal">
                        HepiKorea
                    </td>
                    <td class="px-6 py-4 whitespace-normal w-20">
                        aaaaaa
                    </td>
                    <td class="px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div id="edit-faq" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Edit The FAQ
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="edit-faq">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only"></span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5">
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 min-w-max text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:focus:ring-primary-500 dark:focus:border-primary-500  focus:ring-orange-400 focus:border-orange-400 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400" placeholder="Type FAQ title" required="">
                        </div>

                        
                    </div>
                    <button type="submit" class="justify-end text-white inline-flex items-center bg-orange-400 hover:bg-orange-500 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                        Save
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
