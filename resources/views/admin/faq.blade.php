@extends('layout.admin')
@section('title', 'test faq')

@section('content')
    <div class="flex flex-col flex-wrap p-4 border-2 bg-[#EFEFEF] border-gray-200 rounded-xl w-full max-w-[99%] h-full">
        <div class="bg-white rounded-xl w-full max-w-full h-full px-4 overflow-hidden">

            <div class="flex rounded-lg items-center w-full mb-2 mx-6 mt-8">
                {{-- Text FAQ --}}
                <h1 class="text-black font-bold text-5xl mb-8 w-16 mr-6">FAQ</h1>
                {{-- Button Add FAQ --}}
                <button data-modal-target="faq-add-modal" data-modal-toggle="faq-add-modal"
                    class="rounded-full mb-8 ml-10 bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862]" type="button">
                    <img src="{{ asset('img/assets/icon/icon_faq_plus.svg') }}" alt="plus Icon"
                        class="h-8 w-8 focus: fill-orange-400">
                </button>
            </div>

            <div class="h-auto w-full max-w-[100%] overflow-y-auto max-h-[99%]">
                @foreach ($faqs as $faq)
                    <div class="flex flex-col bg-slate-100 h-auto rounded-xl shadow-md p-4 mb-5 ">
                        <div class="flex items-center justify-between mb-4">
                            {{-- Title FAQ --}}
                            <h2 class="text-black font-bold text-2xl">
                                {{ $faq->question }}
                            </h2>
                            {{-- Button Edit FAQ --}}
                            <div class="w-fit h-fit flex flex-row">
                                <button data-modal-target="faq-edit-modal" data-modal-toggle="faq-edit-modal"
                                    onclick="editFaq({{ $faq->id }}, '{{ $faq->question }}', '{{ $faq->answer }}')"
                                    class="flex items-center justify-center w-auto h-auto p-2 rounded-2xl bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] focus:ring-0 focus:outline-none text-xl mr-4 px-5 py-2.5 text-center text-white"
                                    type="button">
                                    Edit
                                    <img src="{{ asset('img/assets/icon/icon_faq_edit.svg') }}" alt="Edit Icon"
                                        class="h-6 w-6 ml-2">
                                </button>
                                <button data-modal-target="confirmation-delete-modal"
                                    data-modal-toggle="confirmation-delete-modal" {{-- onclick="editFaq({{ $faq->id }}, '{{ $faq->question }}', '{{ $faq->answer }}')" --}}
                                    class="flex items-center justify-center w-auto h-auto p-2 rounded-2xl bg-orange-400 hover:bg-orange-500 active:bg-orange-600 focus:ring-0 focus:outline-none text-xl mr-4 px-5 py-2.5 text-center text-white"
                                    type="button">
                                    Delete
                                    <img src="{{ asset('img/assets/icon/icon_admin_faq_trash.svg') }}" alt="Edit Icon"
                                        class="h-6 w-6 ml-2">
                                </button>
                            </div>
                        </div>
                        <div class="flex flex-wrap max-w-[100%] w-full">
                            {{-- FAQ Content --}}
                            <h5 class="text-justify text-[#376F7E] font-medium text-2xl break-words w-full">
                                {{ $faq->answer }}
                            </h5>
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- FAQ --}}


            <!-- Pop Up Add FAQ -->
            <div id="faq-add-modal" tabindex="-1"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-[0.1rem] w-fit max-w-2xl max-h-full">
                    <!-- Modal content -->
                    <div class="bg-white w-[40vw] rounded-lg shadow overflow-y-auto max-w-full">
                        <div class="w-full h-full flex flex-col">
                            <h1 class="text-black font-bold text-2xl p-5 pb-2">Add FAQ</h1>
                            <button type="button"
                                class="absolute bg-black w-5 h-5 flex flex-col align-middle text-center items-center rounded-full pb-3 -top-2 -right-2"
                                data-modal-hide="faq-add-modal">
                                <p class="m-auto text-white text-sm">X</p>
                            </button>
                            <div class="w-full h-full flex flex-col">
                                <form action="{{ route('admin.faq.store') }}" method="POST"
                                    class="flex flex-col h-full text-center py-2 px-5">
                                    @csrf
                                    <input type="text" placeholder="FAQ" name="new_question" id="add-faq-name"
                                        value="{{ old('new_question') }}"
                                        class="rounded-2xl w-full bg-gray-200 h-14 pl-5 pr-4 mt-5 placeholder:text-black border-0 focus:outline-none focus:ring-0">
                                    @error('new_question')
                                        <p class="mt-1 text-sm text-start text-red-600 dark:text-red-500">{{ $message }}
                                        </p>
                                    @enderror

                                    <textarea placeholder="FAQ answer ..." name="new_answer" id="add-faq-answer" rows="12"
                                        class="rounded-2xl w-full bg-gray-200 pl-5 pr-4 mt-5 placeholder:text-black placeholder:font-semi border-0 focus:outline-none focus:ring-0">{{ old('new_answer') }}</textarea>
                                    @error('new_answer')
                                        <p class="mt-1 text-sm text-start text-red-600 dark:text-red-500">{{ $message }}
                                        </p>
                                    @enderror

                                    <button type="submit"
                                        class="bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white font-semibold mx-auto mt-5 mb-3 inline-block w-1/2 h-14 rounded-3xl">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- end of modal content -->
                </div>
            </div>
            <!-- end of FAQ-add-modal -->

            <!-- Pop Up Edit FAQ -->
            <div id="faq-edit-modal" tabindex="-1"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-[0.1rem] w-fit max-w-2xl max-h-full">
                    <!-- Modal content -->
                    <div class="bg-white w-[40vw] rounded-lg shadow overflow-y-auto max-w-full">
                        <div class="w-full h-full flex flex-col">
                            <h1 class="text-black font-bold text-2xl p-5 pb-2">Edit FAQ</h1>
                            <button type="button"
                                class="absolute bg-black w-5 h-5 flex flex-col align-middle text-center items-center rounded-full pb-3 -top-2 -right-2"
                                data-modal-hide="faq-edit-modal">
                                <p class="m-auto text-white text-sm">X</p>
                            </button>
                            <div class="w-full h-full flex flex-col">
                                <form action="" method="POST" class="flex flex-col h-full text-center py-2 px-5"
                                    id="edit-faq-form">
                                    @csrf
                                    @method('patch')
                                    <input type="text" placeholder="FAQ" name="question" id="edit-question"
                                        value="{{ old('question') }}"
                                        class="rounded-2xl w-full bg-gray-200 h-14 pl-5 pr-4 mt-5 placeholder:text-black border-0 focus:outline-none focus:ring-0">
                                    @error('question')
                                        <p class="mt-1 text-sm text-start text-red-600 dark:text-red-500">{{ $message }}
                                        </p>
                                    @enderror

                                    <textarea placeholder="FAQ answer..." name="answer" id="edit-answer" rows="12"
                                        class="rounded-2xl w-full bg-gray-200 pl-5 pr-4 mt-5 placeholder:text-black placeholder:font-semi border-0 focus:outline-none focus:ring-0">{{ old('answer') }}</textarea>
                                    @error('answer')
                                        <p class="mt-1 text-sm text-start text-red-600 dark:text-red-500">{{ $message }}
                                        </p>
                                    @enderror

                                    <button type="submit"
                                        class="bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white font-semibold mx-auto mt-5 mb-3 inline-block w-1/2 h-14 rounded-3xl">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- end of modal content -->
                </div>
            </div>
            <!-- end of FAQ-edit-modal -->


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
                                    <button
                                        class="w-44 h-11 bg-[#376F7E] rounded-[20px] shadow-lg text-white text-lg font-semibold"
                                        data-modal-hide="confirmation-delete-modal"
                                        data-modal-target="success-delete-modal"
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

            {{-- success added modal --}}
            <div id="success-added-modal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-fit max-w-5xl max-h-full mt-20">
                    <!-- Modal content -->
                    <div class="bg-white w-[25vw] h-auto rounded-[30px] shadow">
                        <div class="relative w-full h-full flex flex-row">
                            <div class="w-full h-full flex flex-col p-14">
                                <h1 class="text-black text-xl font-medium mx-auto">Successfully Added!</h1>
                                <img src="{{ asset('img/assets/icon/icon_green_check.svg') }}" alt="green_check"
                                    class="w-24 h-24 mx-auto mt-6">
                            </div>
                            {{-- end of modal content --}}
                        </div>
                    </div>
                    <!-- end of modal content -->
                </div>
            </div>
            {{-- end of success added modal --}}


            {{-- success edited modal --}}
            <div id="success-updated-modal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-fit max-w-5xl max-h-full mt-20">
                    <!-- Modal content -->
                    <div class="bg-white w-[25vw] h-auto rounded-[30px] shadow">
                        <div class="relative w-full h-full flex flex-row">
                            <div class="w-full h-full flex flex-col p-14">
                                <h1 class="text-black text-xl font-medium mx-auto">Successfully Updated!</h1>
                                <img src="{{ asset('img/assets/icon/icon_green_check.svg') }}" alt="green_check"
                                    class="w-24 h-24 mx-auto mt-6">
                            </div>
                            {{-- end of modal content --}}
                        </div>
                    </div>
                    <!-- end of modal content -->
                </div>
            </div>
            {{-- end of success edited modal --}}
        </div>

    </div>

    <script>
        function editFaq(id, question, answer) {
            $('#edit-question').val(question);
            $('#edit-answer').val(answer);
            $('#edit-faq-form').attr('action', "{{ route('admin.faq.update', '') }}" + '/' + id);
        }

        @if ($errors->has('new_question') || $errors->has('new_answer'))
            $(document).ready(function() {
                setTimeout(function() {
                    new Modal($('#faq-add-modal')[0]).show();
                }, 100);
            });
        @elseif ($errors->has('question') || $errors->has('answer'))
            $(document).ready(function() {
                setTimeout(function() {
                    new Modal($('#faq-edit-modal')[0]).show();
                }, 100);
            });
        @endif
    </script>
@endsection
