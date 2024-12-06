@props(['id'])

{{-- sent order detail --}}
<div id="sent-order-{{ $id }}" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-hidden overflow-x-hidden fixed inset-0 top-0 right-0 left-0 z-[50] justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-2 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="bg-white w-[45vw] rounded-xl shadow">
            <div class="relative w-full px-12 py-10 flex flex-row">
                <!-- x button (exit modal) -->
                <button type="button"
                    class="absolute bg-black w-5 h-5 flex flex-col align-middle text-center items-center rounded-full pb-3 -top-2 -right-2"
                    data-modal-hide="sent-order-{{ $id }}">
                    <p class="m-auto text-white text-sm">X</p>
                </button>
                <!-- image User Order detail -->
                <div class="w-[100%] h-[100%] rounded-lg">
                    <h1 class="text-3xl text-orange-400 font-semibold">Form Shipment</h1>
                    <form action="{{ route('admin.order.sent', $id) }}" method="POST" class="w-full max-h-[95%]">
                        @csrf
                        <table class="w-full mt-1">
                            <tr>
                                <td>
                                    <label for="" class="text-base text-black text-opacity-50">Expedition
                                        Name</label>
                                    <input type="text" name="shipment_service"
                                        class="w-full rounded-lg bg-white shadow-md border-none focus:border-none focus:ring-0">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="" class="text-base text-black text-opacity-50">Expedition
                                        Price</label>
                                    <input type="text" name="price"
                                        class="w-full rounded-lg bg-white shadow-md border-none focus:border-none focus:ring-0">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="" class="text-base text-black text-opacity-50">Estimated
                                        Arrival Time</label>

                                    <div class="relative w-full">
                                        <div
                                            class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                            </svg>
                                        </div>
                                        <input datepicker id="sent-datepicker-{{ $id }}"
                                            name="arrival_estimation" type="text" datepicker-orientation="top"
                                            datepicker-autohide datepicker-format="yyyy-mm-dd"
                                            datepicker-min-date="{{ date('Y-m-d') }}"
                                            class="w-full rounded-lg bg-white shadow-md border-none focus:border-none focus:ring-0 ps-10">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" value="Save"
                                        class="w-20 h-10 bg-orange-400 hover:bg-orange-500 rounded-md text-white py-0.5 px-1 mt-4">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                {{-- end of image User Order detail --}}
            </div>
        </div>
        <!-- end of  content -->
    </div>
</div>
