@extends('layout.customer_nofooter')
@section('title', 'Product Confirmed')

@section('content')
    <div class="w-full w-max[100%] h-full rounded-3xl bg-[#EFEFEF] py-2 px-14">
        <h1 class="text-black font-semibold text-2xl text-left">Product Confirmed</h1>

        <div class="overflow-y-scroll no-scrollbar h-[50vh] mt-2 mb-52">
            {{-- product card container --}}
            <div class="relative w-full h-fit grid grid-cols-3 gap-x-5 gap-y-5 mt-2 mb-12">
                @for ($i = 0; $i < 5; $i++)
                    {{-- product card --}}
                    <div class="w-[420px] h-[279px] bg-white rounded-2xl flex flex-col p-5 relative">
                        {{-- photo, name, price of product --}}
                        <div class="w-full h-[65%] flex flex-row">
                            {{-- image container --}}
                            <div class="w-[35%] h-full">
                                <img src="{{ asset('img/example/admin_order_img_phone.png') }}" alt=""
                                    class="w-full h-full bg-contain">
                            </div>
                            {{-- name,variant,price --}}
                            <div class="w-[65%] h-full flex flex-col pl-5">
                                <h1 class="text-[#3E6E7A] font-semibold text-base">Samsung S24 Ultra</h1>
                                <h2 class="text-black text-opacity-50 font-semibold text-xs mt-1">Black</h2>
                                <h2 class="text-orange-400 font-semibold text-xl mt-auto">Rp 24.000.000,-</h2>
                            </div>
                        </div>
                        {{-- end of photo, name, price of product --}}

                        {{-- checkbox --}}
                        <div class="w-full h-[45%] flex">
                            <div class="w-fit h-fit flex flex-row align-middle my-auto ml-7">
                                <input type="checkbox" name="" id=""
                                    class="w-6 h-6 rounded-sm outline outline-[#3E6E7A] bg-transparent hover:bg-slate-100  checked:bg-[#3E6E7A] hover:checked:bg-[#37626d] focus:outline-[#3E6E7A] active:ring-[#3E6E7A] focus:border-[#3E6E7A]">
                                <p class="text-[#3E6E7A] font-semibold ml-6">Add Product</p>
                            </div>
                        </div>
                        {{-- checkbox --}}
                    </div>
                    {{-- end of product card --}}
                @endfor

                {{-- product card NOT AVAILABLE --}}
                <div class="w-[420px] h-[279px] bg-white rounded-2xl flex flex-col p-5 relative">
                    {{-- overlay disabled --}}
                    <div
                        class="absolute inset-0 bg-[#898383] bg-opacity-60 rounded-2xl flex items-center justify-center text-black text-2xl font-semibold z-10">
                        Not Available!
                    </div>
                    {{-- end of overlay disabled --}}

                    {{-- photo, name, price of product --}}
                    <div class="w-full h-[65%] flex flex-row">
                        {{-- image container --}}
                        <div class="w-[35%] h-full">
                            <img src="{{ asset('img/example/admin_order_img_phone.png') }}" alt=""
                                class="w-full h-full bg-contain">
                        </div>
                        {{-- name,variant,price --}}
                        <div class="w-[65%] h-full flex flex-col pl-5">
                            <h1 class="text-[#3E6E7A] font-semibold text-base">Samsung S24 Ultra</h1>
                            <h2 class="text-black text-opacity-50 font-semibold text-xs mt-1">Black</h2>
                            <h2 class="text-orange-400 font-semibold text-xl mt-auto">Rp 24.000.000,-</h2>
                        </div>
                    </div>
                    {{-- end of photo, name, price of product --}}

                    {{-- checkbox --}}
                    <div class="w-full h-[45%] flex">
                        <div class="w-fit h-fit flex flex-row align-middle my-auto ml-7">
                            <input type="checkbox" name="" id=""
                                class="w-6 h-6 rounded-sm outline outline-[#3E6E7A] bg-transparent hover:bg-slate-100  checked:bg-[#3E6E7A] hover:checked:bg-[#37626d] focus:outline-[#3E6E7A] active:ring-[#3E6E7A] focus:border-[#3E6E7A]">
                            <p class="text-[#3E6E7A] font-semibold ml-6">Add Product</p>
                        </div>
                    </div>
                    {{-- checkbox --}}
                </div>
                {{-- end of product card NOT AVAILABLE --}}

            </div>
            {{-- end of product card container --}}


            {{-- checkout container --}}
            <div class="fixed w-[156vh] h-[25vh] bg-white rounded-2xl bottom-11 left-28 z-10 flex flex-col py-5 px-10">
                <h1 class="text-black font-semibold text-2xl">Checkout</h1>
                <div class="w-full h-fit flex flex-row my-auto">
                    {{-- select all and checkbox container --}}
                    <div class="w-fit h-full flex flex-row">

                        {{-- checkbox fot select all --}}
                        <input type="checkbox"
                            class="w-6 h-6 hover:bg-slate-100  rounded-sm outline outline-[#3E6E7A] bg-transparent checked:bg-[#3E6E7A] hover:checked:bg-[#37626d] focus:outline-[#3E6E7A] active:ring-[#3E6E7A] focus:border-[#3E6E7A] my-auto">

                        {{-- select All text --}}
                        <p class="text-black text-opacity-50 font-semibold text-base ml-6 my-auto">Select All (6)</p>

                        {{-- button delete --}}
                        <button
                            class="bg-white hover:bg-slate-100 outline outline-2 outline-[#3E6E7A] rounded-2xl inline-flex my-auto ml-10 py-2 px-12"
                            data-modal-target="confirmation-delete-modal" data-modal-toggle="confirmation-delete-modal">
                            <img src="{{ asset('img/assets/icon/icon_customer_trashcan.svg') }}" alt=""
                                class="w-6 h-7 mr-2">
                            <p class="text-[#3E6E7A] font-semibold text-xl">Delete</p>
                        </button>
                        {{-- end of button delete --}}
                    </div>
                    {{-- end of select all and checkbox container --}}

                    {{-- text count total product --}}
                    <p class="text-black text-opacity-50 font-semibold text-base ml-auto my-auto">Total (6) Product</p>
                    {{-- total price --}}
                    <h1 class="text-orange-400 font-semibold text-2xl ml-16 my-auto">Rp 225.000,-</h1>
                </div>
                <button
                    class="w-fit bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white text-2xl font-semibold rounded-2xl py-2 px-10 ml-auto">Checkout</button>
            </div>
            {{-- end of checkout container --}}
        </div>
    </div>



    {{-- MODALS FOR CONFIRMED PRODUCT --}}


    {{-- delete confirmation modal --}}
    <div id="confirmation-delete-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-fit max-w-5xl max-h-full mt-20">
            <!-- Modal content -->
            <div class="bg-white w-[33vw] h-auto rounded-[30px] shadow">
                <div class="relative w-full h-full flex flex-row">
                    <div class="w-full h-full flex flex-col px-10 py-10">
                        <img src="{{ asset('img/assets/icon/icon_warning.svg') }}" alt="icon_warning"
                            class="w-16 h-16 mx-auto">
                        <p class="text-[#376F7E] font-medium text-xl mx-auto mt-2">Are you sure?</p>
                        <p class="text-[#B7B7B7] font-medium text-xs mx-auto mt-6">You won’t be able to revert
                            this!</p>
                        <div class="w-full h-full mt-6 flex flex-row justify-center">
                            <button class="w-44 h-11 bg-[#376F7E] rounded-[20px] shadow-lg text-white text-lg font-semibold"
                                data-modal-hide="confirmation-delete-modal" data-modal-target="success-delete-modal"
                                data-modal-toggle="success-delete-modal">Yes, Delete it!</button>
                            {{-- success-delete-modal --}}
                            <button
                                class="w-44 h-11 bg-[#FF9D66] rounded-[20px] shadow-lg text-white text-lg font-semibold ml-2"
                                data-modal-hide="confirmation-delete-modal">Cancel</button>
                        </div>
                    </div>
                    {{-- end of modal content --}}
                </div>
            </div>
            <!-- end of modal content -->
        </div>
    </div>
    {{-- end of delete confirmation modal --}}


    {{-- success delete modal --}}
    <div id="success-delete-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-fit max-w-5xl max-h-full mt-20">
            <!-- Modal content -->
            <div class="bg-white w-[25vw] h-auto rounded-[30px] shadow">
                <div class="relative w-full h-full flex flex-row">
                    <div class="w-full h-full flex flex-col p-14">
                        <h1 class="text-black text-xl font-medium mx-auto">Successfully Deleted!</h1>
                        <img src="{{ asset('img/assets/icon/icon_green_check.svg') }}" alt="green_check"
                            class="w-24 h-24 mx-auto mt-6">
                    </div>
                    {{-- end of modal content --}}
                </div>
            </div>
            <!-- end of modal content -->
        </div>
    </div>
    {{-- end of success delete modal --}}


    {{-- end of MODALS FOR CONFIRMED PRODUCT --}}
@endsection
