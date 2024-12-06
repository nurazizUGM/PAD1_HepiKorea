@extends('layout.customer')
@section('title', 'Cart')

@section('content')
    <div class="w-full w-max[100%] h-[80vh] rounded-3xl bg-[#EFEFEF] pt-2 md:pt-6 pb-8 px-2 md:px-10 flex flex-col">
        <h1 class="text-black font-semibold text-lg md:text-2xl text-left">Cart</h1>

        {{-- product card container --}}
        <div
            class="relative w-full h-full grid grid-cols-2 md:grid-cols-3 gap-x-auto gap-y-2 md:gap-y-5 mt-2 mb-4 overflow-y-scroll no-scrollbar">
            @foreach ($carts as $cart)
                {{-- product card --}}
                <div class="w-[180px] md:w-[420px] h-[130px] md:h-[279px] bg-white rounded-2xl flex flex-col p-2 md:p-5">
                    {{-- photo, name, price of product --}}
                    <div class="w-full h-[65%] flex flex-row">
                        {{-- image container --}}
                        <div class="w-[40%] md:w-[35%] h-full">
                            @if (strpos($cart->product->image, 'http') === 0)
                                <img src="{{ $cart->product->image }}" alt="" class="w-full h-full object-contain">
                            @elseif (Storage::exists($cart->product->image))
                                <img src="{{ Storage::url($cart->product->image) }}" alt=""
                                    class="w-full h-full bg-contain">
                            @else
                                <img src="{{ asset('img/example/admin_order_img_phone.png') }}" alt=""
                                    class="w-full h-full bg-contain">
                            @endif
                        </div>
                        {{-- name,variant,price --}}
                        <div class="w-[60%] md:w-[65%] h-full flex flex-col pl-2 md:pl-5">
                            <h1 class="text-[#3E6E7A] font-semibold text-xs md:text-base truncate">
                                {{ $cart->product->name }}</h1>
                            <h2 class="text-orange-400 font-semibold text-[10px] md:text-xl mt-auto">Rp
                                {{ number_format($cart->product->price, 0, ',', '.') }}</h2>

                            <input type="hidden" form="form-checkout" name="quantity[]" value="{{ $cart->quantity }}">
                            <h3 class="text-gray-600 font-semibold text-[8px] md:text-lg">x{{ $cart->quantity }}</h3>
                        </div>
                    </div>
                    {{-- end of photo, name, price of product --}}

                    {{-- checkbox --}}
                    <div class="w-full h-[45%] flex">
                        <div class="w-fit h-fit flex flex-row align-middle my-auto ml-7">
                            <input type="checkbox" name="products[]" value="{{ $cart->product->id }}"
                                data-product-price="{{ $cart->product->price }}"
                                data-product-quantity="{{ $cart->quantity }}" form="form-checkout"
                                class="w-3 md:w-6 h-3 md:h-6 rounded-sm outline outline-[#3E6E7A] bg-transparent hover:bg-slate-100  checked:bg-[#3E6E7A] hover:checked:bg-[#37626d] focus:outline-[#3E6E7A] active:ring-[#3E6E7A] focus:border-[#3E6E7A]">
                            <p class="text-[#3E6E7A] text-xs md:text-base font-semibold ml-6">Add Product</p>
                        </div>
                    </div>
                    {{-- checkbox --}}
                </div>
                {{-- end of product card --}}
            @endforeach
        </div>
        {{-- end of product card container --}}


        {{-- checkout container --}}
        <div class="mx-0 h-[16rem] bg-white rounded-2xl flex flex-col py-2 md:py-5 px-4 md:px-10">
            <h1 class="text-black font-semibold text-lg md:text-2xl">Checkout</h1>
            <div class="w-full h-fit flex flex-row my-auto">
                {{-- select all and checkbox container --}}
                <div class="w-fit h-full flex flex-row">

                    {{-- checkbox fot select all --}}
                    <input type="checkbox" onchange="checkAll(this)"
                        class="w-3 md:w-6 h-3 md:h-6 hover:bg-slate-100  rounded-sm outline outline-[#3E6E7A] bg-transparent checked:bg-[#3E6E7A] hover:checked:bg-[#37626d] focus:outline-[#3E6E7A] active:ring-[#3E6E7A] focus:border-[#3E6E7A] my-auto">

                    {{-- select All text --}}
                    <p class="text-black text-opacity-50 font-semibold text-[8px] md:text-base ml-3 md:ml-6 my-auto">Select
                        All
                        ({{ $carts->count() }})</p>

                    {{-- button delete --}}
                    <button
                        class="bg-white hover:bg-slate-100 outline outline-2 outline-[#3E6E7A] rounded-2xl inline-flex my-auto ml-5 md:ml-10 py-1 md:py-2 px-4 md:px-12"
                        data-modal-target="confirmation-delete-modal" data-modal-toggle="confirmation-delete-modal">
                        <img src="{{ asset('img/assets/icon/icon_customer_trashcan.svg') }}" alt=""
                            class="w-3 md:w-6 h-3.5 md:h-7 mr-1 md:mr-2 my-auto">
                        <p class="text-[#3E6E7A] font-semibold text-sm md:text-xl">Delete</p>
                    </button>
                    {{-- end of button delete --}}
                </div>
                {{-- end of select all and checkbox container --}}

                {{-- text count total product --}}
                <p class="text-black text-opacity-50 font-semibold text-center md:text-end text-xs md:text-base mx-auto md:mr-0 md:ml-auto my-auto"
                    id="total-product">
                    Total (0) Product</p>
                {{-- total price --}}
                <h1 class="text-orange-400 font-semibold text-sm md:text-2xl ml-8 md:ml-16 my-auto" id="total-price">Rp 0,-
                </h1>
            </div>
            <form action="{{ route('checkout') }}" method="post" id="form-checkout" class="ml-auto">
                @csrf
                <button type="submit" onclick="$('input[name=products[]]')"
                    class="w-fit bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white text-lg md:text-2xl font-semibold rounded-2xl py-1 md:py-2 px-5 md:px-10">Checkout</button>
            </form>
        </div>
        {{-- end of checkout container --}}
    </div>




    {{-- MODALS FOR CART --}}
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
    {{-- end of MODALS FOR CART --}}
@endsection

@push('script')
    <script>
        function checkAll(el) {
            $('input[name="products[]"]').prop('checked', el.checked).change();
        }

        $(document).ready(function() {
            $('input[name="products[]"]').change(function() {
                let total = 0;
                $('input[name="products[]"]:checked').each(function() {
                    const price = parseInt($(this).data('product-price'))
                    const quantity = parseInt($(this).data('product-quantity'))
                    total += price * quantity;
                });
                $('#total-price').text('Rp ' + total.toLocaleString() + ',-');
                $('#total-product').text('Total (' + $('input[name="products[]"]:checked').length +
                    ') Product');
            });
        })
    </script>
@endpush
