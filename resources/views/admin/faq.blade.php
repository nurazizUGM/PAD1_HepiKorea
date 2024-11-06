@extends('layout.admin')
@section('title', 'test faq')

@section('content')
    <div class="flex flex-col flex-wrap p-4 border-2 bg-[#EFEFEF] border-gray-200 rounded-lg dark:border-gray-700 w-full ">
        <div class="flex items-center w-full mb-4">
            {{-- Text FAQ --}}
            <h1 class="text-black font-bold text-3xl mb-8 w-16 mr-6">FAQ</h1>
            {{-- Button Add FAQ --}}
            <button data-modal-target="faq-add-modal" data-modal-toggle="faq-add-modal"
                class="rounded-full mb-8 bg-orange-400 w-8 hover:bg-orange-500 focus:bg-orange-700" type="button">
                <img src="{{ asset('img/assets/icon/icon_faq_plus.svg') }}" alt="plus Icon"
                    class="h-8 w-8 focus: fill-orange-400">
            </button>
        </div>

        <div class="h-auto w-full">
            @foreach ($faqs as $faq)
                <div class="flex flex-col bg-gray-50 h-auto dark:bg-gray-800 rounded-xl p-4 mb-5 ">
                    <div class="flex items-center justify-between mb-4">
                        {{-- Title FAQ --}}
                        <h2 class="text-black font-bold text-lg">
                            {{ $faq->question }}
                        </h2>
                        {{-- Button Edit FAQ --}}
                        <button data-modal-target="faq-edit-modal" data-modal-toggle="faq-edit-modal"
                            onclick="editFaq({{ $faq->id }}, '{{ $faq->question }}', '{{ $faq->answer }}')"
                            class="flex items-center justify-center w-auto h-auto p-2 rounded-lg bg-orange-400 hover:bg-orange-500 focus:ring-4 focus:outline-none focus:ring-orange-300 text-xl mr-4 px-5 py-2.5 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800 text-white"
                            type="button">
                            Edit
                            <img src="{{ asset('img/assets/icon/icon_faq_edit.svg') }}" alt="Edit Icon"
                                class="h-6 w-6 ml-2">
                        </button>
                    </div>
                    <div>
                        {{-- FAQ Content --}}
                        <h5 class="text-justify">
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
                                    <p class="mt-1 text-sm text-start text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror

                                <textarea placeholder="FAQ answer ..." name="new_answer" id="add-faq-answer" rows="12"
                                    class="rounded-2xl w-full bg-gray-200 pl-5 pr-4 mt-5 placeholder:text-black placeholder:font-semi border-0 focus:outline-none focus:ring-0">{{ old('new_answer') }}</textarea>
                                @error('new_answer')
                                    <p class="mt-1 text-sm text-start text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror

                                <button type="submit"
                                    class="bg-orange-400 hover:bg-orange-500 text-white font-semibold mx-auto mt-5 mb-3 inline-block w-1/2 h-14 rounded-3xl">Save</button>
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
                                    <p class="mt-1 text-sm text-start text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror

                                <textarea placeholder="FAQ answer..." name="answer" id="edit-answer" rows="12"
                                    class="rounded-2xl w-full bg-gray-200 pl-5 pr-4 mt-5 placeholder:text-black placeholder:font-semi border-0 focus:outline-none focus:ring-0">{{ old('answer') }}</textarea>
                                @error('answer')
                                    <p class="mt-1 text-sm text-start text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror

                                <button type="submit"
                                    class="bg-orange-400 hover:bg-orange-500 text-white font-semibold mx-auto mt-5 mb-3 inline-block w-1/2 h-14 rounded-3xl">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- end of modal content -->
            </div>
        </div>
        <!-- end of FAQ-edit-modal -->

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
