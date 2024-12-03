@props(['id'])
{{-- process-order-detail-modal --}}
<div id="process-order-{{ $id }}" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-hidden overflow-x-hidden fixed inset-0 top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-2 max-w-md max-h-full">
        <!-- Modal content -->
        <div class="bg-white rounded-xl shadow">
            <div class="relative p-5 flex flex-row">
                <!-- x button (exit modal) -->
                <button type="button"
                    class="absolute bg-black w-5 h-5 flex flex-col align-middle text-center items-center rounded-full pb-3 -top-2 -right-2"
                    data-modal-hide="process-order-{{ $id }}">
                    <p class="m-auto text-white text-sm">X</p>
                </button>
                {{-- process order content container --}}
                <div class="flex flex-col">
                    <h1 class="text-black text-base font-semibold">Estimation Arrival</h1>

                    {{-- datepicker --}}
                    <div id="datepicker-{{ $id }}" inline-datepicker data-date="{{ date('Y-m-d') }}"
                        datepicker-format="yyyy-mm-dd" class="mt-1 w-full h-full mx-auto"></div>
                    {{-- end of datepicker --}}

                    <form id="form-process-order-{{ $id }}" action="{{ route('admin.order.process', $id) }}"
                        method="POST" class="hidden">
                        @csrf
                        <input type="hidden" name="estimated_arrival" value="{{ date('Y-m-d') }}">
                    </form>
                    <button form="form-process-order-{{ $id }}" type="submit"
                        class="rounded-lg bg-orange-400 hover:bg-orange-500 text-white block ml-auto mt-2 h-9 w-1/4">Save</button>
                </div>
            </div>
            {{-- end of process order content container --}}
        </div>
    </div>
    <!-- end of  content -->
</div>
