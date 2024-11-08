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
        <div class="w-full h-full bg-white flex-col rounded-xl mt-4 py-6 px-8">
            <h1 class="text-center text-4xl text-black font-bold">Step Pemesanan</h1>

            {{-- container card step pemesanan --}}
            <div class="w-full h-full flex flex-col bg-green-200">
                <div class="flex flex-row h-1/2 bg-purple-200">    
                    <div class="w-1/2 h-full flex bg-blue-200">
                        lorem
                    </div>
                    <div class="w-1/2 h-full flex bg-gray-200">
                        lorem
                    </div>
                </div>
                <div class="flex flex-row h-1/2 bg-red-200">    
                    <div class="w-1/2 h-full flex bg-gray-200">
                        lorem
                    </div>
                    <div class="w-1/2 h-full flex bg-blue-200">
                        lorem
                    </div>
                </div>
            </div>
            {{-- end of container card step pemesanan --}}

            <h1 class="text-left text-2xl text-black font-bold">Customer Details</h1>
            {{-- form Customer details --}}
            <form action="" class="w-full h-full flex flex-col">
                <label for="name" class="text-xl text-black font-medium my-2">Name</label>
                <input type="text" class="w-[55%] h-12 pl-5 bg-[#D9D9D9] rounded-xl my-2 border-0 focus:ring-0 focus:border-0" placeholder="Enter your name">
                <label for="email" class="text-xl text-black font-medium my-2">Email</label>
                <div class="my-2 flex flex-row">
                    <input type="email" class="w-[55%] h-12 pl-5 bg-[#D9D9D9] rounded-xl py-2 border-0 focus:ring-0 focus:border-0" placeholder="user@gmail.com">
                    <button type="submit" class="inline-flex h-10 bg-orange-400 hover: px-8 rounded-lg ml-10 my-auto">
                        <p class="m-auto text-white text-sm font-normal">Save</p>
                    </button>
                </div>
            </form>
        </div>
        {{-- end of step pemesanan & form customer details --}}
    </div>

@endsection
