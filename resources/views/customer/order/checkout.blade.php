@extends('layout.customer')
@section('title', 'Checkout')

{{-- remove footer --}}
@section('footer', '')

@section('content')
    <div class="w-full w-max[100%] h-full rounded-3xl bg-[#EFEFEF] py-8 px-10">
        {{-- shipping address container --}}
        <div class="w-full h-full max-h-44 overflow-hidden rounded-3xl bg-white flex flex-col pt-3 pb-8 px-10"
            id="listAddressContainer">
            <h1 class="text-[#3E6E7A] font-semibold text-2xl">Shipping Address</h1>
            <div class="w-full h-full flex flex-row mt-5 mb-auto">
                <div class="w-1/6 h-full">
                    <div class="flex flex-row">
                        {{-- nama --}}
                        <p class="text-[#3E6E7A] font-semibold text-lg">Aisyah</p>
                        <p class="text-orange-400 font-semibold text-lg inline ml-5">(+62)</p>
                    </div>
                    <p class="text-[#898383] font-semibold text-lg">813-9230-8107</p>
                </div>
                <div class="w-4/6 max-w-4/6 h-full pr-36 mb-auto">
                    <p class="text-black text-opacity-50 font-semibold text-lg">
                        Bulaksumur, Caturtunggal, Kapanewon Depok, Kabupaten Sleman,
                        Daerah Istimewa Yogyakarta 55281
                    </p>
                </div>
                <div class="w-1/6 h-full flex mb-auto">
                    {{-- change address button --}}
                    <a href="{{ route('auth.address') }}" class="my-auto ml-auto cursor-pointer"><img
                            src="{{ asset('img/assets/icon/icon_checkout_arrow_down.svg') }}" alt=""
                            class="w-6 h-6 rotate-[270deg]" id="toggle-dropdown-address"></a>
                </div>
            </div>
        </div>
        {{-- end of shipping address container --}}

        {{-- list of product ordered container --}}
        <div class="w-full h-full rounded-3xl bg-white flex flex-col py-3 px-10 mt-6">
            <h1 class="text-black font-semibold text-2xl">Product Ordered</h1>

            <div class="w-full h-full flex flex-col gap-y-5">

                @for ($i = 0; $i < 1; $i++)
                    <div class="w-full h-full flex flex-col">
                        <div class="w-full h-fit flex flex-row">
                            <div class="w-[20%]">
                                {{-- product image --}}
                                <img src="{{ asset('img/example/admin_order_img_phone.png') }}" alt="img_product"
                                    class="w-36 object-contain">
                            </div>
                            <div class="w-[20%] mt-2">
                                {{-- product name --}}
                                <p class="mb-auto text-[#3E6E7A] text-base font-semibold">Samsung Ultra 24</p>
                            </div>
                            <div class="w-[20%] mt-2">
                                {{-- product price --}}
                                <p class="mb-auto text-[#898383] font-semibold text-xl">Rp 24.000.000,-</p>
                            </div>
                            <div class="w-[20%] flex flex-row">
                                {{-- product quantity --}}
                                <div class="w-full h-fit flex flex-row justify-center items-centers">
                                    <div
                                        class="border border-black rounded-full py-1 px-3.5 text-2xl cursor-pointer hover:bg-slate-100">
                                        -
                                    </div>
                                    {{--  --}}
                                    <p class="my-auto text-2xl mx-6">1</p>
                                    <div
                                        class="border border-black rounded-full py-1 px-3 text-2xl cursor-pointer hover:bg-slate-100">
                                        +
                                    </div>
                                </div>
                            </div>
                            <div class="w-[20%] flex justify-end mt-2">
                                <p class="mb-auto text-orange-400 font-semibold text-xl">Rp 24.000.000,-</p>
                            </div>
                        </div>
                        <div class="w-full h-fit flex flex-col mt-6">
                            <h1 class="text-black font-semibold text-xl">Note</h1>
                            <form action="" class="w-full h-fit mt-2">
                                <textarea name="" id="" rows="3"
                                    class="w-full bg-[#D9D9D9] border-none focus:border-none focus:ring-0 rounded-2xl resize-none text-sm text-[#898383] font-semibold placeholder:font-semibold placeholder:text-sm"
                                    placeholder="Write Your Note Here..."></textarea>
                            </form>
                        </div>
                    </div>
                @endfor

            </div>
        </div>
        {{-- list of product ordered container --}}

        {{-- checkout container --}}
        <div class="w-full h-full rounded-3xl bg-white flex flex-col py-5 px-10 mt-6">
            <h1 class="text-black font-semibold text-2xl">Checkout</h1>
            <div class="w-full h-full flex flex-row mt-4">
                <div class="w-[40%] flex flex-row">
                    <p class="text-black text-opacity-50 text-base font-semibold">Note:</p>
                    {{-- Order Note --}}
                    <textarea name="" id="" cols="60"
                        class="bg-white hover:bg-slate-50 focus:bg-slate-50 h-2/3 border-2 border-[#3E6E7A] rounded-2xl resize-none ml-3 text-[#3E6E7A] text-sm focus:border-2 focus:border-[#3E6E7A] focus:ring-0 placeholder:text-[#3E6E7A] placeholder:text-sm"
                        placeholder="Order Note..."></textarea>
                </div>
                <div class="w-[40%] flex flex-col items-center px-[98px]">
                    {{-- text total product --}}
                    <p class="text-black text-opacity-50 font-semibold">Total (1) Product</p>
                    {{-- text information --}}
                    <p class="text-sm text-[#B7B7B7] font-medium mt-3">This price is not Including delivery cost.
                        The cost for delivery will be invoiced after the product arrived at our warehouse</p>
                </div>
                <div class="w-[20%] flex flex-col items-end">
                    {{-- total price --}}
                    <h1 class="text-orange-400 font-semibold text-2xl">Rp 25.800.000,-</h1>
                    {{-- checkout button --}}
                    <button
                        class="w-fit bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white text-2xl font-semibold rounded-2xl py-2 px-9 mt-2"
                        data-modal-target="choose-payment-modal" data-modal-toggle="choose-payment-modal">Checkout</button>
                </div>
            </div>
        </div>
        {{-- end of checkout container --}}
    </div>

    {{--  --}}
    {{--  --}}
    {{--  --}}

    {{-- MODALS for checkout --}}

    {{-- change address modal --}}
    <div id="change-address-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-fit max-w-5xl max-h-full mt-20">
            <!-- Modal content -->
            <div class="bg-white w-[55vw] h-auto rounded-[30px] shadow">
                <div class="relative w-full h-full flex flex-row">
                    <!-- x button (exit modal) -->
                    {{-- <button type="button"
                        class="absolute bg-black w-5 h-5 flex flex-col align-middle text-center items-center rounded-full pb-3 -top-2 -right-2"
                        data-modal-hide="change-address-modal">
                        <p class="m-auto text-white text-sm">X</p>
                    </button> --}}
                    {{-- modal content --}}
                    <div class="w-full h-full flex flex-col pl-20 pr-20 py-10">
                        <h1 class="text-black font-bold text-2xl">Receiver Detail</h1>
                        <form action="" class="w-full h-full flex flex-col gap-y-8 mt-6">
                            {{-- Full name input --}}
                            <div class="w-full h-full flex flex-row">
                                <input type="text" name="" id=""
                                    class="w-full h-10 border-2 border-[#3E6E7A] text-orange-400 focus:border-2 focus:border-[#3E6E7A] focus:ring-0 rounded-lg placeholder:text-orange-400 "
                                    placeholder="Full Name">
                                <img src="{{ asset('img/assets/icon/icon_admin_product_edit.svg') }}" alt=""
                                    class="w-5 h-5 my-auto ml-2">
                            </div>
                            {{-- Phone number input --}}
                            <div class="w-full h-full flex flex-row">
                                <input type="text" name="" id=""
                                    class="w-full h-10 border-2 border-[#3E6E7A] text-orange-400 focus:border-2 focus:border-[#3E6E7A] focus:ring-0 rounded-lg placeholder:text-orange-400 "
                                    placeholder="Phone Number">
                                <img src="{{ asset('img/assets/icon/icon_admin_product_edit.svg') }}" alt=""
                                    class="w-5 h-5 my-auto ml-2">
                            </div>
                            {{-- Province input --}}
                            <div class="w-full h-full flex flex-row">
                                <input type="text" name="" id=""
                                    class="w-full h-10 border-2 border-[#3E6E7A] text-orange-400 focus:border-2 focus:border-[#3E6E7A] focus:ring-0 rounded-lg placeholder:text-orange-400 "
                                    placeholder="Province">
                                <img src="{{ asset('img/assets/icon/icon_admin_product_edit.svg') }}" alt=""
                                    class="w-5 h-5 my-auto ml-2">
                            </div>
                            {{-- City input --}}
                            <div class="w-full h-full flex flex-row">
                                <input type="text" name="" id=""
                                    class="w-full h-10 border-2 border-[#3E6E7A] text-orange-400 focus:border-2 focus:border-[#3E6E7A] focus:ring-0 rounded-lg placeholder:text-orange-400 "
                                    placeholder="City">
                                <img src="{{ asset('img/assets/icon/icon_admin_product_edit.svg') }}" alt=""
                                    class="w-5 h-5 my-auto ml-2">
                            </div>
                            {{-- Address input --}}
                            <div class="w-full h-full flex flex-row">
                                <input type="text" name="" id=""
                                    class="w-full h-10 border-2 border-[#3E6E7A] text-orange-400 focus:border-2 focus:border-[#3E6E7A] focus:ring-0 rounded-lg placeholder:text-orange-400 "
                                    placeholder="Address">
                                <img src="{{ asset('img/assets/icon/icon_admin_product_edit.svg') }}" alt=""
                                    class="w-5 h-5 my-auto ml-2">
                            </div>
                            {{-- Postal Code input --}}
                            <div class="w-full h-full flex flex-row">
                                <input type="number" name="" id=""
                                    class="w-full h-10 border-2 border-[#3E6E7A] text-orange-400 focus:border-2 focus:border-[#3E6E7A] focus:ring-0 rounded-lg placeholder:text-orange-400 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                                    placeholder="Postal Code">
                                <img src="{{ asset('img/assets/icon/icon_admin_product_edit.svg') }}" alt=""
                                    class="w-5 h-5 my-auto ml-2">
                            </div>
                            <button type="submit"
                                class="w-fit bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white text-2xl font-semibold rounded-2xl py-2 px-7 mx-auto"
                                data-modal-hide="change-address-modal">Save</button>
                        </form>
                    </div>
                    {{-- end of modal content --}}
                </div>
            </div>
            <!-- end of modal content -->
        </div>
    </div>
    {{-- end of change address modal --}}

    {{--  --}}

    {{-- choose payment modal --}}

    <div id="choose-payment-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-fit max-w-5xl max-h-full mt-20">
            <!-- Modal content -->
            <div class="bg-white w-[25vw] h-auto rounded-[30px] shadow">
                <div class="relative w-full h-full flex flex-row">
                    <!-- x button (exit modal) -->
                    {{-- <button type="button"
                        class="absolute bg-black w-5 h-5 flex flex-col align-middle text-center items-center rounded-full pb-3 -top-2 -right-2"
                        data-modal-hide="change-address-modal">
                        <p class="m-auto text-white text-sm">X</p>
                    </button> --}}

                    {{-- modal content --}}
                    <div class="w-full h-full flex flex-col px-10 py-10">
                        <form action="" class="w-full h-full flex flex-col">
                            {{-- Bank --}}
                            <h1 class="text-[#898383] text-opacity-60 font-bold text-xl">Bank</h1>
                            {{-- Option Bank BRI --}}
                            <div class="w-full h-fit flex flex-row mt-2">
                                <img src="{{ asset('img/assets/icon/icon_checkout_bri.svg') }}" alt=""
                                    class="w-24 h-10 object-contain">
                                <label for="BRI" class="my-auto text-black font-bold text-base ml-8">Bank BRI</label>
                                <input type="radio" name="choose-payment" id="BRI"
                                    class="ml-auto my-auto w-7 h-7 border-4 border-[#3E6E7A] checked:bg-[#3E6E7A] checked:ring-[#3E6E7A]">
                            </div>
                            {{-- Option Bank BRI --}}
                            <div class="w-full h-fit flex flex-row mt-4">
                                <img src="{{ asset('img/assets/icon/logo_checkout_mandiri.png') }}" alt=""
                                    class="w-28 h-12 object-contain">
                                <label for="BRI" class="my-auto text-black font-bold text-base ml-4">Mandiri</label>
                                <input type="radio" name="choose-payment" id="Mandiri"
                                    class="ml-auto my-auto w-7 h-7 border-4 border-[#3E6E7A] checked:bg-[#3E6E7A] checked:ring-[#3E6E7A]">
                            </div>
                            {{-- Option Bank BRI --}}
                            <div class="w-full h-fit flex flex-row mt-4">
                                <img src="{{ asset('img/assets/icon/icon_checkout_bca.svg') }}" alt=""
                                    class="w-28 h-12 object-contain">
                                <label for="BRI" class="my-auto text-black font-bold text-base ml-4">BCA</label>
                                <input type="radio" name="choose-payment" id="BCA"
                                    class="ml-auto my-auto w-7 h-7 border-4 border-[#3E6E7A] checked:bg-[#3E6E7A] checked:ring-[#3E6E7A]">
                            </div>

                            {{-- E-wallet --}}
                            <h1 class="text-[#898383] text-opacity-60 font-bold text-xl mt-6">E-wallet</h1>
                            {{-- Option Bank BRI --}}
                            <div class="w-full h-fit flex flex-row mt-2">
                                <img src="{{ asset('img/assets/icon/icon_checkout_dana.svg') }}" alt=""
                                    class="w-28 h-12 object-contain">
                                <label for="BRI" class="my-auto text-black font-bold text-base ml-4">DANA</label>
                                <input type="radio" name="choose-payment" id="DANA"
                                    class="ml-auto my-auto w-7 h-7 border-4 border-[#3E6E7A] checked:bg-[#3E6E7A] checked:ring-[#3E6E7A]">
                            </div>
                            {{-- Option Bank BRI --}}
                            <div class="w-full h-fit flex flex-row mt-4">
                                <img src="{{ asset('img/assets/icon/icon_checkout_ovo.svg') }}" alt=""
                                    class="w-28 h-12 object-contain">
                                <label for="BRI" class="my-auto text-black font-bold text-base ml-4">OVO</label>
                                <input type="radio" name="choose-payment" id="OVO"
                                    class="ml-auto my-auto w-7 h-7 border-4 border-[#3E6E7A] checked:bg-[#3E6E7A] checked:ring-[#3E6E7A]">
                            </div>
                            {{-- Option Bank BRI --}}
                            <div class="w-full h-fit flex flex-row mt-4">
                                <img src="{{ asset('img/assets/icon/icon_checkout_gopay.png') }}" alt=""
                                    class="w-28 h-12 object-contain">
                                <label for="BRI" class="my-auto text-black font-bold text-base ml-4">Go Pay</label>
                                <input type="radio" name="choose-payment" id="gopay"
                                    class="ml-auto my-auto w-7 h-7 border-4 border-[#3E6E7A] checked:bg-[#3E6E7A] checked:ring-[#3E6E7A]">
                            </div>


                            <button
                                class="w-fit bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white text-2xl font-semibold rounded-2xl py-2 px-16 mx-auto mt-10"
                                data-modal-target="payment-modal" data-modal-toggle="payment-modal">Pay</button>
                        </form>
                    </div>
                    {{-- end of modal content --}}
                </div>
            </div>
            <!-- end of modal content -->
        </div>
    </div>

    {{-- end of choose payment modal --}}

    {{--  --}}

    {{-- payment modal --}}
    <div id="payment-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto no-scrollbar overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-fit max-w-6xl max-h-full mt-20">
            <!-- Modal content -->
            <div class="bg-white w-[50vw] h-auto rounded-[30px] shadow">
                <div class="relative w-full h-full flex flex-row">
                    <!-- x button (exit modal) -->
                    <button type="button"
                        class="absolute bg-black w-6 h-6 flex flex-col align-middle text-center items-center rounded-full pb-3 -top-1 -right-1"
                        data-modal-hide="payment-modal">
                        <p class="m-auto text-white text-base">X</p>
                    </button>

                    {{-- modal content --}}
                    <div class="w-full h-full flex flex-col px-14 pt-10 pb-2">
                        <h1 class="text-black font-bold text-2xl">Payment</h1>
                        <div class="w-full h-fit flex flex-row mt-3">
                            <div class="w-[70%]">
                                <p class="text-[#898383] text-sm font-bold mr-auto mb-auto">Total Payment</p>
                            </div>
                            <div class="w-[30%]">
                                {{-- total payment price --}}
                                <p class="text-[#3E6E7A] text-sm font-bold mr-auto">Rp 25.800.000,-</p>
                            </div>
                        </div>
                        <div class="w-full h-fit flex flex-row mt-4">
                            <div class="w-[70%]">
                                <p class="text-[#898383] text-sm font-bold mr-auto mb-auto">Pay In</p>
                            </div>
                            {{-- pay in (time duration to pay) --}}
                            <div class="w-[30%] h-fit flex flex-col">
                                <p class="text-[#3E6E7A] text-sm font-bold">24 Hours</p>
                                {{-- pay time deadline --}}
                                <p class="text-[#B7B7B7] text-sm font-medium">Pay Before: <br>
                                    14 September 2024 00:00</p>
                            </div>
                        </div>
                        <div class="w-full h-fit flex flex-row">
                            {{-- bank logo container --}}
                            <div class="w-[10%] flex">
                                <img src="{{ asset('img/assets/icon/logo_bri_small.svg') }}" alt=""
                                    class="w-3/5 object-contain mb-auto">
                            </div>
                            {{-- no rekening and else container --}}
                            <div class="w-[90%] flex flex-col">
                                <p class="text-[#898383] font-bold text-sm">Bank BRI</p>
                                <p class="text-[#898383] font-bold text-sm mt-6">No. Rekening:</p>
                                <div class="w-full h-fit flex flex-row items-center mt-1">
                                    <div class="w-[67%]">
                                        {{-- NO REKENING --}}
                                        <h1 class="text-[#3E6E7A] font-bold text-2xl">128 0812 1555 9315</h1>
                                    </div>
                                    <div class="w-[33%]">
                                        {{-- copy text --}}
                                        <p class="text-orange-400 font-bold text-sm cursor-pointer">COPY</p>
                                    </div>
                                </div>
                                <p class="text-[#898383] font-bold text-sm mt-6">
                                    Proses verifikasi kurang dari 10 menit setelah pembayaran berhasil <br>
                                    Bayar pesanan ke Virtual Account di atas sebelum membuat pesanan <br>
                                    kembali dengan Virtual Account agar nomor tetap sama.
                                </p>
                                <p class="text-[#898383] font-bold text-sm mt-6">
                                    Hanya menerima dari Bank BRI
                                </p>
                            </div>
                        </div>

                        {{-- title instructions --}}
                        <h2 class="text-black font-bold text-base mt-6">mBanking Transfer Instructions</h2>
                        {{-- instructions --}}
                        <p class="text-[#898383] font-bold text-sm mt-6">
                            1. Masuk ke menu Mobile Banking BRI. Kemudian, pilih Pembayaran > BRIVA. <br>
                            2. Masukkan Nomor BRIVA 128 081215559315. <br>
                            3. Masukkan PIN Anda kemudian pilih Send. Apabila pesan konfirmasi untuk <br>
                            4. transaksi menggunakan SMS muncul, pilih OK. Status transaksi akan <br>
                            5. dikirimkan melalui SMS dan dapat digunakan sebagai bukti pembayaran.
                        </p>

                        {{-- title atm instructions --}}
                        <h2 class="text-black font-bold text-base mt-4">ATM Transfer Instructions</h2>
                        <p class="text-[#898383] font-bold text-sm mt-6">
                            1. Pilih Transaksi Lain > Pembayaran > Lainnya > BRIVA. <br>
                            2. Masukkan Nomor BRIVA 128 081215559315 kemudian pilih Benar. <br>
                            3. Periksa informasi yang tertera di layar. Pastikan Merchant adalah *nama*, <br>
                            4. Total tagihan sudah benar dan username kamu azkialbab. Jika benar, pilih Ya.
                        </p>
                        <button
                            class="w-fit bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white text-sm font-semibold rounded-2xl py-1 px-10 mx-auto mt-4"
                            data-modal-hide="payment-modal" data-modal-target="choose-payment-modal"
                            data-modal-toggle="choose-payment-modal">Change</button>
                    </div>
                    {{-- end of modal content --}}
                </div>
            </div>
            <!-- end of modal content -->
        </div>
    </div>
    {{-- end of payment modal --}}


    {{-- QR payment modal --}}
    <div id="qr-payment-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto no-scrollbar overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-fit max-w-6xl max-h-full mt-20">
            <!-- Modal content -->
            <div class="bg-white w-[50vw] h-auto rounded-[30px] shadow">
                <div class="relative w-full h-full flex flex-row">
                    <!-- x button (exit modal) -->
                    <button type="button"
                        class="absolute bg-black w-6 h-6 flex flex-col align-middle text-center items-center rounded-full pb-3 -top-1 -right-1"
                        data-modal-hide="qr-payment-modal">
                        <p class="m-auto text-white text-base">X</p>
                    </button>

                    {{-- modal content --}}
                    <div class="w-full h-full flex flex-col px-14 pt-10 pb-2">
                        <h1 class="text-black font-bold text-2xl">Payment</h1>
                        <div class="w-full h-fit flex flex-row mt-3">
                            <div class="w-[70%]">
                                <p class="text-[#898383] text-sm font-bold mr-auto mb-auto">Total Payment</p>
                            </div>
                            <div class="w-[30%]">
                                {{-- total payment price --}}
                                <p class="text-[#3E6E7A] text-sm font-bold mr-auto">Rp 25.800.000,-</p>
                            </div>
                        </div>
                        <div class="w-full h-fit flex flex-row mt-4">
                            <div class="w-[70%]">
                                <p class="text-[#898383] text-sm font-bold mr-auto mb-auto">Pay In</p>
                            </div>
                            {{-- pay in (time duration to pay) --}}
                            <div class="w-[30%] h-fit flex flex-col">
                                <p class="text-[#3E6E7A] text-sm font-bold">24 Hours</p>
                                {{-- pay time deadline --}}
                                <p class="text-[#B7B7B7] text-sm font-medium">Pay Before: <br>
                                    14 September 2024 00:00</p>
                            </div>
                        </div>

                        <img src="{{ asset('img/example/example_qrscan.svg') }}" alt=""
                            class="mx-auto w-52 object-contain">

                        {{-- title instructions --}}
                        <h2 class="text-black font-bold text-base mt-6">mBanking Transfer Instructions</h2>
                        {{-- instructions --}}
                        <p class="text-[#898383] font-bold text-sm mt-6">
                            1. Masuk ke menu Mobile Banking BRI. Kemudian, pilih Pembayaran > BRIVA. <br>
                            2. Masukkan Nomor BRIVA 128 081215559315. <br>
                            3. Masukkan PIN Anda kemudian pilih Send. Apabila pesan konfirmasi untuk <br>
                            4. transaksi menggunakan SMS muncul, pilih OK. Status transaksi akan <br>
                            5. dikirimkan melalui SMS dan dapat digunakan sebagai bukti pembayaran.
                        </p>

                        {{-- title atm instructions --}}
                        <h2 class="text-black font-bold text-base mt-4">ATM Transfer Instructions</h2>
                        <p class="text-[#898383] font-bold text-sm mt-6">
                            1. Pilih Transaksi Lain > Pembayaran > Lainnya > BRIVA. <br>
                            2. Masukkan Nomor BRIVA 128 081215559315 kemudian pilih Benar. <br>
                            3. Periksa informasi yang tertera di layar. Pastikan Merchant adalah *nama*, <br>
                            4. Total tagihan sudah benar dan username kamu azkialbab. Jika benar, pilih Ya.
                        </p>
                        <button
                            class="w-fit bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white text-sm font-semibold rounded-2xl py-1 px-10 mx-auto mt-4"
                            data-modal-hide="qr-payment-modal" data-modal-target="choose-payment-modal"
                            data-modal-toggle="choose-payment-modal">Change</button>
                    </div>
                    {{-- end of modal content --}}
                </div>
            </div>
            <!-- end of modal content -->
        </div>
    </div>
    {{-- end of QR payment modal --}}



    {{-- success payment modal --}}
    <div id="payment-success-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-fit max-w-5xl max-h-full mt-20">
            <!-- Modal content -->
            <div class="bg-white w-[28vw] h-auto rounded-[30px] shadow">
                <div class="relative w-full h-full flex flex-row">
                    <div class="w-full h-full flex flex-col p-14">
                        <h1 class="text-black text-xl font-bold mx-auto">Payment Successful!</h1>
                        <img src="{{ asset('img/assets/icon/icon_green_check.svg') }}" alt="green_check"
                            class="w-24 h-24 mx-auto mt-6">
                    </div>
                    {{-- end of modal content --}}
                </div>
            </div>
            <!-- end of modal content -->
        </div>
    </div>
    {{-- end of success payment modal --}}




    {{-- end of MODALS for checkout --}}

    <script>
        document.getElementById("toggle-dropdown-address").addEventListener("click", function() {
            const addresses = document.querySelectorAll("#hidden-address-list");
            const toggle = document.querySelectorAll("#toggle-dropdown-address");
            const container = document.querySelectorAll("#listAddressContainer");

            setTimeout(() => {
                container.forEach(clicks => {
                    clicks.classList.toggle("max-h-44");
                    clicks.classList.toggle("max-h-full");
                });
            }, 50);


            addresses.forEach(address => {
                address.classList.toggle("hidden");
            });



            toggle.forEach(clicks => {
                clicks.classList.toggle("rotate-180");
            });

        });
    </script>

@endsection