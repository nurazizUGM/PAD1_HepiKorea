@extends('layout.customer')
@section('title', 'Request Order')

<a href=""
    class="fixed flex flex-row bottom-8 right-8 px-2 py-2 text-2xl font-bold text-orange-400 bg-white rounded-3xl align-middle items-center shadow-md hover:shadow-lg z-30">
    <img src="{{ asset('img/assets/icon/icon_customer_chat.svg') }}" alt="icon_Chat" class="w-10 h-10 mr-1">
    <p>Chat</p>
</a>

@section('content')
    <div class="w-full w-max[100%] h-full rounded-3xl bg-[#EFEFEF] shadow-md overflow-hidden py-6 px-6">
        {{-- start of welcome container --}}
        <div class="bg-white w-full h-full flex flex-col rounded-xl pt-4 pb-8 px-8">
            <h1 class="text-xl font-bold">Welcome !</h1>
            <p class="font-semibold text-lg">
                Once you've selected your items from your preferred Korean store, complete this form to place your custom
                order and <br> let us handle the rest.
            </p>
            <p class="font-semibold text-lg">
                Not sure where to look beyond HepiKorea? Feel free to use our search engine to explore other Korean stores.
                Say <br> goodbye to hopping between websites!
            </p>
        </div>
        {{-- end of welcome container --}}

        {{-- start of step pemesanan & form customer details --}}
        <div class="w-full h-full bg-white flex-col rounded-xl mt-6 py-6 px-8">
            <h1 class="text-center text-4xl text-black font-bold mb-5">Step of Request Order</h1>

            {{-- container card step pemesanan --}}
            <div class="w-full h-full flex flex-col">
                <div class="flex flex-row h-1/2">
                    <div class="w-1/2 h-fit flex p-2">
                        {{-- step number 1 --}}
                        <div
                            class="w-fit h-fit bg-white rounded-xl mr-auto shadow-lg hover:shadow-xl my-auto flex py-10 pl-5 pr-16">
                            <div class="text-orange-400 text-lg font-semibold m-auto flex flex-row">
                                <h1 class="text-[96px] font-bold">1</h1>
                                <h1 class="ml-2">Complete Customer Detail</h1>
                            </div>
                        </div>
                        {{-- end of step number 1 --}}
                    </div>
                    <div class="w-1/2 h-full flex p-2">
                        {{-- step number 2 --}}
                        <div
                            class="w-fit h-fit bg-orange-400 rounded-xl mr-auto shadow-lg hover:shadow-xl my-auto flex py-10 pl-5 pr-20">
                            <div class="text-white text-lg font-semibold m-auto flex flex-row">
                                <h1 class="text-[96px] font-bold">3</h1>
                                <h1 class="ml-2">Confirm the product</h1>
                            </div>
                        </div>
                        {{-- end of step number 2 --}}
                    </div>
                </div>
                <div class="flex flex-row h-1/2 pt-4">
                    <div class="w-1/2 h-full flex p-2">
                        {{-- step number 3 --}}
                        <div
                            class="w-fit h-fit bg-orange-400 rounded-xl ml-auto shadow-lg hover:shadow-xl my-auto flex py-10 pl-5 pr-10">
                            <div class="text-white text-lg font-semibold m-auto flex flex-row">
                                <h1 class="text-[96px] font-bold">2</h1>
                                <h1 class="ml-2">Write the detail of product request</h1>
                            </div>
                        </div>
                        {{-- end of step number 3 --}}
                    </div>
                    <div class="w-1/2 h-full flex p-2">
                        {{-- step number 4 --}}
                        <div
                            class="w-fit h-fit bg-white rounded-xl ml-auto shadow-lg hover:shadow-xl my-auto flex py-10 pl-5 pr-6">
                            <div class="text-orange-400 text-lg font-semibold m-auto flex flex-row">
                                <h1 class="text-[96px] font-bold">4</h1>
                                <h1 class="ml-2">Wait the product confirmed</h1>
                            </div>
                        </div>
                        {{-- end of step number 4 --}}
                    </div>
                </div>
            </div>

            {{-- form Customer details --}}
            <form action="" class="w-full h-full flex flex-col mt-10">
                <label for="name" class="text-xl text-black font-medium my-2">Name</label>
                <input type="text"
                    class="w-[55%] h-12 pl-5 bg-white outline outline-1 border-black rounded-xl my-2 border-0 focus:border-1 focus:border-black focus:ring-black"
                    placeholder="Enter your name">
                <label for="email" class="text-xl text-black font-medium my-2">Email</label>
                <div class="my-2 flex flex-row">
                    <input type="email"
                        class="w-[55%] h-12 pl-5 bg-white outline outline-1 border-black rounded-xl py-2 border-0 focus:border-1 focus:border-black focus:ring-black"
                        placeholder="user@gmail.com">
                    <button type="submit"
                        class="inline-flex h-10 bg-orange-400 hover:bg-orange-500 focus:bg-orange-600 px-8 rounded-lg ml-10 my-auto">
                        <p class="m-auto text-white text-sm font-normal">Save</p>
                    </button>
                </div>
            </form>
            {{-- end of customer detail --}}
        </div>
        {{-- end of container card step pemesanan --}}

        {{-- container list request order --}}
        <div class="w-full h-fit pt-6 flex flex-col">
            @for ($i = 0; $i < 2; $i++)
                {{-- request order product card --}}
                <div class="w-full h-fit bg-white rounded-xl flex flex-row px-4 py-4 mb-4">
                    {{-- image product --}}
                    {{-- admin_order_img_phone.png --}}
                    <div class="w-[15%] h-[10rem] bg-contain bg-no-repeat bg-center"
                        style="background-image: url('{{ asset('img/example/admin_order_img_phone.png') }}')"></div>
                    {{-- <img src="{{ asset('img/example/test_blouse.png') }}" alt="" class="w-fit h-fit"> --}}
                    <div class="w-[42%] pl-5 flex flex-col">
                        <div class="flex flex-row mb-auto align-middle">
                            {{-- product name --}}
                            <h1 class="text-xl font-medium text-black mr-auto">Samsung Ultra 24</h1>
                            {{-- product price --}}
                            <h1 class="text-xl font-semibold text-[#B7B7B7] mx-auto">Rp 24.000.000</h1>
                        </div>
                        <div class="w-full h-full flex flex-col mt-auto">
                            {{-- text link --}}
                            <p class="font-medium text-lg text-black mt-auto">Link:</p>
                            {{-- http link container --}}
                            <textarea name="" id="" cols="" rows="2" placeholder="https:://" disabled
                                class="rounded-2xl resize-none"></textarea>
                        </div>
                    </div>
                    <div class="w-[43%] pl-5 flex flex-col">
                        <div class="flex flex-row mb-auto align-middle">
                            {{-- product quantity --}}
                            <h1 class="text-xl font-medium text-[#B7B7B7] mr-auto">3x</h1>
                            {{-- product price total --}}
                            <h1 class="text-xl font-semibold text-orange-400 mx-auto">Rp 72.000.000,-</h1>
                            <a href=""
                                class="bg-orange-400 hover:bg-orange-500 focus:bg-orange-600 p-1 rounded-md"><img
                                    src="{{ asset('img/assets/icon/icon_requestOrder_trashcan.svg') }}" alt=""
                                    class="w-6 h-6"></a>
                        </div>
                        <div class="w-full h-full flex flex-col mt-auto">
                            {{-- text Note --}}
                            <p class="font-medium text-lg text-black mt-auto">Note:</p>
                            {{-- Note container --}}
                            <textarea name="" id="" cols="" rows="2" placeholder="" disabled
                                class="rounded-2xl resize-none text-[#898383]">Bungkus dengan rapi dan lapisi dengan kardus yang tebal</textarea>
                        </div>
                    </div>
                </div>
                {{-- end of request order product card --}}
            @endfor
            <a href="" class="ml-auto w-1/12"><button
                    class="bg-orange-400 hover:bg-orange-500 focus:bg-orange-600 rounded-lg text-white text-lg py-2 px-5 ">Confirm</button></a>
        </div>
        {{-- end container list request order --}}

        {{-- start of request order form --}}
        <div class="w-full h-full bg-white flex-col rounded-xl mt-6 py-6 px-8">
            <form action="" class="w-full h-fit flex flex-col text-orange-400 font-semibold text-xl">
                <label for="">Product Name</label>
                {{-- input product name --}}
                <input type="text" name="" id="" class="rounded-xl bg-white border text-[#898383] font-normal border-black pl-6 focus:border-black focus:ring-0 my-2">
                <label for="">Product Photo</label>
                <!-- input file image -->
                <div class="relative w-full my-2" onclick="$(this).find('input[type=file]').click()">
                    <!-- Hidden file input -->
                    <input id="add-category-icon" name="icon" type="file" class="hidden"
                        onchange="updatePreview(this, $('#add-category-image'))">
                    <!-- Custom file input label -->
                    <label for="add-category-icon"
                        class="flex items-center justify-between w-full rounded-xl bg-white border border-black  h-10 pl-6 pr-4 cursor-pointer">
                        <span class="text-[#898383] font-normal">Upload your photo</span>
                        <img src="{{ asset('img/assets/icon/icon_admin_category_upload.svg') }}" alt="Upload Icon"
                            class="h-8 w-8">
                    </label>
                </div>
                <label for="">Product Link</label>
                {{-- input product link --}}
                <input type="text" name="" id="" class="rounded-xl bg-white border text-[#898383] font-normal border-black pl-6 focus:border-black focus:ring-0 my-2">
                <label for="">Price</label>
                {{-- input price --}}
                <input type="number" name="" id="" class="rounded-xl bg-white border text-[#898383] font-normal border-black pl-6 focus:border-black focus:ring-0 my-2">
                <label for="">Quantity</label>
                {{-- input quantity --}}
                <input type="number" name="" id="" class="rounded-xl bg-white border text-[#898383] font-normal border-black pl-6 focus:border-black focus:ring-0 my-2">
                <label for="">Note</label>
                {{-- input note --}}
                <textarea name="" id="" cols="30" rows="10" class="rounded-xl bg-white border text-[#898383] font-normal border-black px-6 focus:border-black focus:ring-0 resize-none my-2"></textarea>
                <button type="submit" class="text-white bg-orange-400 hover:bg-orange-500 focus:bg-orange-600 w-1/12 py-2 rounded-lg font-normal mt-0.5 mr-auto">Add</button>
            </form>
        </div>
        {{-- end of request order form --}}
    </div>

    {{-- end of step pemesanan & form customer details --}}

@endsection
