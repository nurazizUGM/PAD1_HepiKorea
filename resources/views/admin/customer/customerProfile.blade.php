<div class="p-4 border-2 bg-[#EFEFEF] border-gray-200 rounded-lg dark:border-gray-700 h-[88vh]">
    <div class="grid grid-cols-[2fr_4fr] gap-4 bg-white h-full">
        <!-- Profile Section -->
        <div class="items-start justify-start bg-white rounded-xl p-4">
            <div class="w-5/6 h-3/6 rounded-xl bg-slate-300">
                <img src="{{ !empty(Auth::user()->photo) ? asset('/storage/profile/' . Auth::user()->photo) : asset('path/to/default/image.jpg') }}" alt="User Photo" class="rounded-xl">
            </div>
            <button class="w-5/6 h-14 mt-4 rounded-xl bg-orange-400 p-2">
                <h1 class="text-xl text-white font-semibold">Choose Photo</h1>
            </button>
        </div>

        <!-- User Details Section -->
        <div class="items-start justify-start bg-white rounded-xl p-4">
            <div class="relative overflow-x-auto w-full">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <tbody>
                        <!-- Name Row -->
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <label for="name" class="text-lg font-medium text-gray-900 dark:text-white">Name</label>
                            </th>
                            <td class="px-6 py-4">
                                <input type="text" id="name" class="h-14 w-full bg-gray-50 border border-gray-300 rounded-lg focus:ring-orange-400 focus:border-orange-400 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Your Name" required disabled>
                            </td>
                            <td class="px-6 py-4">
                                <button class="flex items-center justify-center px-5 py-2.5 bg-orange-400 hover:bg-orange-500 text-white rounded-lg dark:bg-orange-600 dark:hover:bg-orange-700" type="button" onclick="toggleEdit('name')">
                                    Edit
                                </button>
                            </td>
                        </tr>
                        <!-- Other Rows (Birth Date, Gender, etc.) -->
                        <!-- Repeat similar structure as the Name Row for each input field -->

                        <!-- Address Row -->
                        <tr class="bg-white dark:bg-gray-800">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <label for="address" class="text-lg font-medium text-gray-900 dark:text-white">Address</label>
                            </th>
                            <td class="px-6 py-4" colspan="2">
                                <div class="flex space-x-2">
                                    <input type="text" class="h-14 w-72 bg-gray-50 border rounded-lg focus:ring-orange-400 focus:border-orange-400 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Your Province" disabled>
                                    <input type="text" class="h-14 w-72 bg-gray-50 border rounded-lg focus:ring-orange-400 focus:border-orange-400 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Your City" disabled>
                                </div>
                                <input type="text" class="h-14 w-full bg-gray-50 border rounded-lg focus:ring-orange-400 focus:border-orange-400 mt-4 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Your Postal Code" disabled>
                                <textarea id="address" class="h-56 w-full bg-gray-50 border rounded-lg focus:ring-orange-400 focus:border-orange-400 mt-4 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Your Address" required disabled></textarea>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal for Adding Carousel -->
        <div id="carousel-add-modal" class="hidden fixed inset-0 z-50 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="bg-white w-[50vw] h-[50vh] rounded-lg shadow-lg">
                    <div class="relative p-6 grid grid-cols-[4fr_2fr] h-full">
                        <!-- Close Button -->
                        <button class="absolute top-2 right-2 text-black bg-gray-200 hover:bg-gray-300 rounded-full w-8 h-8 flex items-center justify-center" onclick="toggleModal('carousel-add-modal')">
                            X
                        </button>
                        <!-- Image Preview -->
                        <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('img/example/test_shirt.jpg') }}');"></div>
                        <!-- Form Section -->
                        <div class="w-full h-full px-8 flex flex-col">
                            <form class="flex flex-col h-full">
                                <label for="file-upload" class="flex items-center justify-between w-full h-14 rounded-3xl bg-gray-200 hover:bg-gray-300 mt-5 cursor-pointer">
                                    <span>Choose File</span>
                                    <img src="{{ asset('img/assets/icon/icon_admin_category_upload.svg') }}" alt="Upload Icon" class="h-8 w-8">
                                </label>
                                <input id="file-upload" type="file" class="hidden">
                                <input type="text" placeholder="Name" class="h-14 mt-5 bg-gray-200 rounded-3xl px-4 w-full">
                                <button type="submit" class="mt-auto bg-orange-400 hover:bg-orange-500 text-white font-semibold rounded-3xl w-1/2 mx-auto h-14">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
