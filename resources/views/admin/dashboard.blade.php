@extends('layout.admin')

@section('title', 'test dashboard')

@section('content')
<!-- ilangin scroll -->
<div class="p-4 border-2 bg-[#EFEFEF] border-gray-200 rounded-lg dark:border-gray-700 h-[88vh] ">
    <!-- dashboard title -->
    <h1 class="text-black font-bold text-xl">Dashboard</h1>
    <div class="grid grid-cols-3 gap-10 mb-4">
        <!-- product -->
        <div class="flex flex-col h-52 bg-gray-50 dark:bg-gray-800 rounded-xl">
                <div class="mb-auto flex w-full px-4 py-3 justify-between overflow-hidden">
                    <!-- product count -->
                    <p class="text-6xl font-bold">142</p>
                    <!-- product icon -->
                    <img src="{{ asset('img/assets/icon/icon_dashboard_product.svg') }}" alt="product Icon"
                            class="h-12 w-12 grayscale">
                </div>
                <div class="bg-orange-400 w-full mt-auto text-center text-white text-lg py-2 rounded-b-xl">Products</div>
        </div>
        <!-- Order -->
        <div class="flex flex-col h-52 bg-gray-50 dark:bg-gray-800 rounded-xl">
                <div class="mb-auto flex w-full px-4 py-3 justify-between overflow-hidden">
                    <!-- Order count -->
                    <p class="text-6xl font-bold">200</p>
                    <!-- Order icon -->
                    <img src="{{ asset('img/assets/icon/icon_dashboard_order.svg') }}" alt="product Icon"
                            class="h-12 w-12 grayscale">
                </div>
                <div class="bg-orange-400 w-full mt-auto text-center text-white text-lg py-2 rounded-b-xl">Order</div>
        </div>
        <!-- customer -->
        <div class="flex flex-col h-52 bg-gray-50 dark:bg-gray-800 rounded-xl">
                <div class="mb-auto flex w-full px-4 py-3 justify-between overflow-hidden">
                    <!-- Customer count -->
                    <p class="text-6xl font-bold">360</p>
                    <!-- Customer icon -->
                    <img src="{{ asset('img/assets/icon/icon_dashboard_customer.svg') }}" alt="product Icon"
                            class="h-12 w-12 grayscale">
                </div>
                <div class="bg-orange-400 w-full mt-auto text-center text-white text-lg py-2 rounded-b-xl">Customer</div>
        </div>
    </div>
    <!-- product ordered n most ordered -->
    <div class="grid grid-cols-2 gap-4 mb-4 mt-6">
        <div class="flex items-center justify-center bg-gray-50 h-[48vh] dark:bg-gray-800 rounded-xl">
            <p class="text-2xl text-gray-400 dark:text-gray-500">
                <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 1v16M1 9h16" />
                </svg>
            </p>
        </div>
        <div class="flex items-center justify-center bg-gray-50 h-[48vh] dark:bg-gray-800 rounded-xl">
            <p class="text-2xl text-gray-400 dark:text-gray-500">
                <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 1v16M1 9h16" />
                </svg>
            </p>
        </div>
    </div>
</div>
@endsection