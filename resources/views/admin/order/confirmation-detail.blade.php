@extends('layout.admin')
@section('title', 'Order Confirmation Detail')

@section('content')
    <div class="bg-[#EFEFEF] border-gray-200 rounded-lg">
        <div class="mb-1">
            <ul class="flex flex-wrap -mb-px text-lg font-bold text-center text-black gap-x-16" id="default-tab"
                data-tabs-toggle="#default-tab-content"
                data-tabs-active-classes="text-black hover:text-black dark:text-purple-500 dark:hover:text-purple-500 border-b-4 border-orange-400 hover:border-orange-400 dark:border-purple-500"
                data-tabs-inactive-classes="dark:border-transparent text-black hover:text-orange-400 dark:text-gray-400 border-transparent hover:border-transparent dark:border-gray-700 dark:hover:text-gray-300"
                role="tablist">
                <!-- Tab product -->
                <li class="ml-auto mr-auto" role="presentation">
                    <button class="inline-block px-4 pt-4 pb-1 border-b-2 rounded-t-lg" id="order-tab"
                        onclick="window.location.href='{{ route('admin.order.index', ['tab' => 'order']) }}'"
                        data-tabs-target="#order" type="button" role="tab" aria-controls="order"
                        aria-selected="false">Order</button>
                </li>
                <!-- Tab  Category-->
                <li class="ml-auto mr-auto" role="presentation">
                    <button
                        class="inline-block px-4 pt-4 pb-1 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="confirmation-tab" data-tabs-target="#confirmation" type="button" role="tab"
                        aria-controls="confirmation" aria-selected="true">Confirmation</button>
                </li>
            </ul>
        </div>

        <!-- Tab Content (showing the content) -->
        <div id="default-tab-content">
            <div class="hidden px-5 pt-2 rounded-lg h-[80vh] h-max-[80vh] overflow-y-scroll no-scrollbar" id="order"
                role="tabpanel" aria-labelledby="order-tab">
                <div
                    class="flex items-center justify-center w-full h-[98%] rounded-lg bg-white dark:bg-gray-800 dark:border-gray-700">
                    <div role="status">
                        <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                fill="currentColor" />
                            <path
                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                fill="currentFill" />
                        </svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>

            <!-- confirmation Content -->
            <div class="hidden px-5 pt-2 rounded-lg h-[80vh] h-max-[80vh] overflow-y-scroll no-scrollbar" id="confirmation"
                role="tabpanel" aria-labelledby="confirmation-tab">
                <div class="flex flex-col h-full w-full pb-3">
                    {{-- User Name container --}}
                    <div class="w-1/4 h-[7%]  bg-white px-3 py-1 rounded-xl flex">
                        <h1 class="text-2xl text-black font-semibold align-middle">Aisyah</h1>
                    </div>
                    {{-- list of order confirmation container --}}
                    <div
                        class="mt-3 w-full h-[83%] h-max-[73%] bg-white rounded-xl px-3 py-2 flex flex-col overflow-y-scroll no-scrollbar">
                        {{-- ini buat test aja --}}
                        {{-- <div class="w-full h-full bg-red-400"></div> --}}
                        <h1 class="text-black font-semibold text-xl">Products</h1>
                        {{-- confirmation detail (AVAILABLE) --}}
                        <div class="w-full w-max-[100%] h-1/2 h-max-1/2 flex flex-row flex-auto">
                            <div class="w-[15%] h-full flex flex-col">
                                <div class="mb-auto flex flex-col">
                                    {{-- <div class="w-full h-full bg-center bg-no-repeat bg-cover" style="background-image: url('{{ asset('img/example/admin_order_img_phone.png') }}')"></div> --}}
                                    <img src="{{ asset('img/example/admin_order_img_phone.png') }}" alt=""
                                        class="w-[85%] h-[85%]">
                                    <h1 class="text-lg text-orange-400 font-bold">Rp 72.000.000,-</h1>
                                </div>
                            </div>
                            <div class="w-[20%] w-max-[23%] h-full flex flex-col">
                                {{-- product title --}}
                                <h1 class="font-semibold text-xl">samsung Ultra 24</h1>
                                {{-- price --}}
                                <h2 class="font-semibold mt-1">Rp 24.000.000,-</h2>
                                <div class="flex flex-row mt-3">
                                    {{-- order quantity --}}
                                    <h2 class="font-semibold">Order : </h2><span class="ml-2">3</span>
                                </div>
                                <div class="flex flex-row mt-5">
                                    {{-- max order --}}
                                    <h2 class="font-semibold">max Order : </h2><span class="ml-2">3</span>
                                </div>

                            </div>
                            <div class="w-[25%] w-max[22%] h-full flex flex-col items-center pr-10">
                                {{-- customer note --}}
                                <div class="w-full h-[45%] border border-orange-400 bg-white rounded-lg p-1 my-1 text-sm">
                                    customer note:
                                    ...
                                </div>
                                {{-- admin note --}}
                                <div class="w-full h-[45%] border border-orange-400 bg-white rounded-lg p-1 my-1 text-sm">
                                    admin note:
                                    ...
                                </div>
                            </div>
                            <div class="w-[40%] h-ful flex flex-col">
                                <div class="w-full h-fit">
                                    {{-- two button container --}}
                                    <div class="w-fit h-fit ml-auto">
                                        {{-- available button --}}
                                        <button
                                            class="w-[9vw] h-[5vh] rounded-lg bg-orange-400 text-white font-semibold mr-3"
                                            data-modal-target="available-confirmation-modal"
                                            data-modal-toggle="available-confirmation-modal">Available</button>
                                        {{-- unavaiable button --}}
                                        <button
                                            class="w-[9vw] h-[5vh] rounded-lg bg-orange-300 text-white font-semibold">Unavailable</button>
                                    </div>
                                </div>
                                <div class="w-full h-full flex flex-col">
                                    <div class="w-full h-fit mt-auto flex flex-col">
                                        {{-- link --}}
                                        <p class="text-black font-semibold text-sm ml-auto mb-8">Product link :
                                            .............................................</p>
                                        <div
                                            class="w-[90%] h-fit bg-white rounded-lg shadow-md text-center text-black font-semibold ml-auto py-2 mb-2 text-sm">
                                            Tersedia Hingga 15 September 2025 Jam 23 : 59
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        {{-- hr ini hanya untuk pembatas  --}}
                        <hr class="border-gray-400 border-b-2 my-4">
                        {{-- confirmation detail (UNAVAILABLE) --}}
                        <div class="w-full w-max-[100%] h-1/2 h-max-1/2 flex flex-row flex-auto">
                            <div class="w-[15%] h-full flex flex-col">
                                <div class="mb-auto flex flex-col">
                                    {{-- <div class="w-full h-full bg-center bg-no-repeat bg-cover" style="background-image: url('{{ asset('img/example/admin_order_img_phone.png') }}')"></div> --}}
                                    <img src="{{ asset('img/example/admin_order_img_phone.png') }}" alt=""
                                        class="w-[85%] h-[85%]">
                                    <h1 class="text-lg text-orange-400 font-bold">Rp 72.000.000,-</h1>
                                </div>
                            </div>
                            <div class="w-[20%] w-max-[23%] h-full flex flex-col">
                                {{-- product title --}}
                                <h1 class="font-semibold text-xl">samsung Ultra 24</h1>
                                {{-- price --}}
                                <h2 class="font-semibold mt-1">Rp 24.000.000,-</h2>
                                <div class="flex flex-row mt-3">
                                    {{-- order quantity --}}
                                    <h2 class="font-semibold">Order : </h2><span class="ml-2">3</span>
                                </div>
                            </div>
                            <div class="w-[25%] w-max[22%] h-full flex flex-col items-center pr-10">
                                {{-- customer note --}}
                                <div class="w-full h-[45%] border border-orange-400 bg-white rounded-lg p-1 my-1 text-sm">
                                    customer note:
                                    ...
                                </div>
                            </div>
                            <div class="w-[40%] h-ful flex flex-col">
                                <div class="w-full h-fit">
                                    {{-- two button container --}}
                                    <div class="w-fit h-fit ml-auto">
                                        {{-- available button --}}
                                        <button
                                            class="w-[9vw] h-[5vh] rounded-lg bg-orange-300 text-white font-semibold mr-3">Available</button>
                                        {{-- unavaiable button --}}
                                        <button
                                            class="w-[9vw] h-[5vh] rounded-lg bg-orange-400 text-white font-semibold">Unavailable</button>
                                    </div>
                                </div>
                                <div class="w-full h-full flex flex-col">
                                    <div class="w-full h-fit mt-auto flex flex-col">
                                        {{-- link --}}
                                        <p class="text-black font-semibold text-sm ml-auto mb-8">Product link :
                                            .............................................</p>
                                        <div
                                            class="w-[90%] h-fit bg-white rounded-lg shadow-md text-center text-[#FF0000] font-semibold ml-auto py-1.5 mb-2 text-base">
                                            Product Not Available
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="mt-3 w-full h-[10%] bg-white rounded-xl flex flex-row">
                        <div class="w-1/6 h-full flex p-4">
                            <p class="my-auto text-sm text-black text-opacity-50 font-semibold">Total Price:</p>
                        </div>
                        <div class="w-4/6 h-full flex p-4">
                            <p class="my-auto text-lg font-semibold text-orange-400">Rp 25.800.000,-</p>
                        </div>
                        <div class="w-1/6 h-full flex">
                            <a href="" class="block m-auto rounded-xl w-fit h-fit"><button
                                    class="w-full h-full bg-orange-400 hover:bg-orange-500 text-white text-lg rounded-xl px-12 py-2">Submit</button></a>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end of confirmation content --}}

        </div>
        <!-- end of tab content -->

        {{-- available-confirmation-modal --}}
        <!-- process order detail modal -->
        <div id="available-confirmation-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-hidden overflow-x-hidden fixed inset-0 top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-2 w-full max-w-lg max-h-full">
                <!-- Modal content -->
                <div class="bg-white w-[42vw] h-[64vh] rounded-xl shadow">
                    <div class="relative w-full h-full p-5 flex flex-row">
                        <!-- x button (exit modal) -->
                        <button type="button"
                            class="absolute bg-black w-5 h-5 flex flex-col align-middle text-center items-center rounded-full pb-3 -top-2 -right-2"
                            data-modal-hide="available-confirmation-modal">
                            <p class="m-auto text-white text-sm">X</p>
                        </button>
                        {{-- process order content container --}}
                        <div class="w-[100%] h-[100%] flex flex-row">
                            <form action="" class="">
                                {{-- date and time picker container --}}
                                <div class="w-[50%] h-full flex flex-col">
                                    <h1 class="text-black text-base font-semibold">Avalability</h1>
                                    <h1 class="text-black text-base font-semibold">Time</h1>


                                    {{-- datepicker --}}
                                    <div id="datepicker-inline-confirmation" inline-datepicker data-date="02/25/2024"
                                        class="mt-1 w-full h-full mx-auto"></div>
                                    {{-- end of datepicker --}}

                                    <div class="flex flex-row ml-auto mt-2">
                                        {{-- timepicker --}}
                                        <form class="max-w-[8.5rem]">
                                            <div class="flex">
                                                <input type="time" id="time"
                                                    class="rounded-lg bg-gray-50 border text-gray-900 leading-none focus:ring-0 focus:border-0 block flex-1 w-full text-sm border-gray-300 p-2.5"
                                                    min="09:00" max="18:00" value="00:00" required>
                                            </div>
                                        </form>
                                        {{-- end of timepicker --}}

                                        {{-- Am Pm picker --}}
                                        <div class="flex flex-col justify-center items-center ml-2">
                                            <input type="checkbox" id="toggle" class="hidden">
                                            <label for="toggle">
                                                <div
                                                    class="w-28 h-9 bg-gray-200 rounded-md p-0.5 flex items-center cursor-pointer relative z-10">
                                                    <!-- Circle inside toggle -->
                                                    <div
                                                        class="w-14 h-8 bg-white rounded-md transform transition-transform duration-300 ease-in-out toggle-circle">
                                                    </div>
                                                    <span class="text-sm text-slate-500 absolute left-5">PM</span>
                                                    <span class="text-sm text-slate-500 absolute right-5">AM</span>
                                                </div>
                                            </label>
                                        </div>
                                        {{-- end of Am Pm picker --}}
                                    </div>
                                </div>
                                {{-- form container --}}
                                <div class="w-[50%] h-full flex flex-col pl-5 pr-2.5">
                                    <h1>Product Price</h1>
                                    <div class="flex items-center mx-auto">
                                        <!-- Product price -->
                                        <div class="relative flex items-center w-full">
                                            <input type="text" id="idr"
                                                class="block w-[18vw] py-2 text-gray-900 bg-white shadow-md border border-white rounded-lg focus:ring-0 focus:border-none">
                                        </div>
                                        <!-- IDR  -->
                                        <button type="button"
                                            class="inline-flex items-center px-4 py-2 font-semibold text-white bg-gray-500 hover:bg-gray-600 rounded-lg -ml-14 z-10">
                                            IDR
                                        </button>
                                    </div>

                                    <h1>EMS Price</h1>
                                    <input type="text"
                                        class="w-full h-10 bg-white shadow-md border border-white rounded-lg focus:ring-0 focus:border-none">
                                    <h1>Max Order</h1>
                                    <input type="text"
                                        class="w-full h-10 bg-white shadow-md border border-white rounded-lg focus:ring-0 focus:border-none">
                                    <h1>Note</h1>
                                    <textarea name="" id="" cols="3" rows="7"
                                        class="bg-white shadow-md border border-white rounded-lg focus:ring-0 focus:border-none"></textarea>

                                    <button type="submit"
                                        class="rounded-lg bg-orange-400 hover:bg-orange-500 text-white block ml-auto mt-4 w-1/2 py-2"
                                        data-modal-hide="available-confirmation-modal">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{-- end of process order content container --}}
                </div>
            </div>
            <!-- end of  content -->
        </div>
    </div>
    <!-- end of process order detail -->

    </div>

    <style>
        #toggle:checked+label .toggle-circle {
            transform: translateX(52px);
            /* Adjust this value based on the size of the switch */
        }
    </style>
@endsection
