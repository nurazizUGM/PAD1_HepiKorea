@props(['id' => 0, 'order' => new \App\Models\Order()])
<div id="order-detail-{{ $id }}" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-hidden overflow-x-hidden fixed inset-0 top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-2 w-full max-w-6xl max-h-full">
        <!-- Modal content -->
        <div class="bg-white w-[75vw] min-h-[10rem] max-h-[20rem] rounded-xl shadow flex">
            <div class="relative w-full h-auto p-2 flex flex-row">
                <!-- x button (exit modal) -->
                <button type="button"
                    class="absolute bg-black w-5 h-5 flex flex-col align-middle text-center items-center rounded-full pb-3 -top-2 -right-2"
                    data-modal-hide="order-detail-{{ $id }}">
                    <p class="m-auto text-white text-sm">X</p>
                </button>
                <!-- image User Order detail -->
                <div class="w-[15%] h-auto my-0 bg-cover bg-no-repeat bg-top rounded-lg"
                    style="background-image: url('{{ asset('img/example/admin_order_img_user.png') }}');">
                </div>
                {{-- container of row of order details  --}}
                <div class="w-[85%] h-full px-4 flex flex-col flex-wrap overflow-y-scroll no-scrollbar">
                    <table class="w-full">
                        @foreach ($order->orderItems as $orderItem)
                            <tr class="flex flex-row my-1">
                                {{-- Product detail order --}}
                                <td class="w-[20%] max-w-[20%] flex flex-row items-center align-top">
                                    <img src="{{ asset('img/assets/icon/icon_admin_order_see_detail.svg') }}"
                                        alt="user icon" class="h-5 w-5 fill-black ml-4 mr-3 mb-auto">
                                    <div class="w-full h-fit mb-auto">
                                        <p class="text-orange-400 font-semibold text-sm">
                                            {{ $orderItem->product->name }}
                                        </p>
                                    </div>
                                </td>
                                {{-- Quantity detail order --}}
                                <td class="w-[10%] max-w-[10%] flex flex-row items-center align-top">
                                    <div class="w-[100%] max-w-[100%] align-middle flex flex-row mb-auto">
                                        <img src="{{ asset('img/assets/icon/icon_admin_order_quantity.svg') }}"
                                            alt="user icon" class="h-5 w-5 fill-black ml-2 mr-2 mb-auto">
                                        <p class="text-orange-400 text-sm font-semibold truncate">
                                            {{ $orderItem->quantity }}x</p>
                                    </div>
                                </td>
                                {{-- Price detail order --}}
                                <td class="w-[20%] max-w-[20%] flex flex-row items-center align-top">
                                    <div class="w-[100%] max-w-[100%] align-middle flex flex-row mb-auto">
                                        <img src="{{ asset('img/assets/icon/icon_admin_order_price.svg') }}"
                                            alt="user icon" class="h-5 w-5 fill-black mr-2 mb-auto">
                                        <p class="text-orange-400 text-sm font-semibold truncate">Rp
                                            {{ number_format($orderItem->price, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </td>
                                {{-- NOtes (catatan) detail order --}}
                                <td class="w-[50%] max-w-[50%] flex flex-row items-center align-top">
                                    <div class="w-[100%] max-w-[100%] align-middle flex flex-row mb-auto">
                                        {{-- <input type="text" class="w-full h-5 rounded-lg border border-orange-400 focus:border-orange-400 focus:ring-0 focus:border" placeholder="Catatan..." value="warna hitam"> --}}
                                        <div
                                            class="w-[99%] h-fit min-h-10 border border-orange-400 rounded-lg py-1 px-2">
                                            {{ $orderItem->note }}
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                {{-- End of container of row of order details  --}}
            </div>
        </div>
        <!-- end of  content -->
    </div>
</div>
