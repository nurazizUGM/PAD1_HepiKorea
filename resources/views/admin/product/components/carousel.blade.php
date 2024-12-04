<div class="w-full flex items-center">
    <!-- text Add Carousel -->
    <h2 class="text-black text-md ml-3 font-semibold">Add Carousel</h2>

    <!-- plus button -->
    <a href="#" class="ml-5" data-modal-target="carousel-add-modal" data-modal-toggle="carousel-add-modal">
        <img src="{{ asset('img/assets/icon/icon_admin_product_plus.svg') }}" alt="plus icon"
            class="w-10 h-10 fill-orange-400 ml-6">
    </a>

</div>

<!-- start of Carousel card container -->
<div
    class="w-full h-[85%] mt-5 overflow-y-scroll flex flex-wrap flex-row gap-x-12 gap-y-8 justify-start items-start content-start">
    <!-- card Carousel -->
    <!-- ini for loop hanya untuk coba -->
    @foreach ($carousels as $carousel)
        <div class="bg-white w-60 h-72 rounded-lg overflow-hidden flex flex-col">
            <!-- image Carousel card -->
            <div class="w-full h-2/3 bg-cover">
                @if ($carousel->media_type == 'image')
                    <img src="{{ Storage::exists($carousel->media) ? Storage::url($carousel->media) : $carousel->media }}"
                        alt="" class="w-full h-full object-cover">
                @elseif ($carousel->media_type == 'video')
                    <video
                        src="{{ Storage::exists($carousel->media) ? Storage::url($carousel->media) : $carousel->media }}"
                        class="w-full h-full object-cover" controls muted></video>
                @elseif ($carousel->media_type == 'youtube')
                    <iframe width="560" height="315" src="{{ $carousel->media }}" title="YouTube video player"
                        frameborder="0" class="w-full h-full object-cover"
                        allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                @endif
            </div>
            <!-- header & detail Carousel card -->
            <div class="p-2">
                <p class="text-sm text-black text-center font-bold truncate">{{ $carousel->title }}</p>
            </div>
            <!-- edit & delete Carousel card -->
            <div class="flex mt-auto mx-4 mb-4">
                <!-- edit icon -->
                <a href="#" class="mr-auto" data-modal-target="carousel-edit-{{ $carousel->id }}"
                    data-modal-toggle="carousel-edit-{{ $carousel->id }}">
                    <img src="{{ asset('img/assets/icon/icon_admin_category_edit.svg') }}" alt=""
                        class="w-7 h-7">
                </a>
                <!-- delete icon -->
                <form action="{{ route('admin.carousel.delete', $carousel->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" href="#" class="ml-auto">
                        <img src="{{ asset('img/assets/icon/icon_admin_category_trash.svg') }}" alt=""
                            class="w-7 h-7">
                    </button>
                </form>


                <!-- Carousel-edit-modal -->
                <div id="carousel-edit-{{ $carousel->id }}" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-fit max-w-2xl max-h-full">
                        <!-- Modal content -->
                        <div class="bg-white w-[30vw] h-[75vh] rounded-lg shadow">
                            <div class="relative w-full h-full flex flex-row">
                                <!-- x button (exit modal) -->
                                <button type="button"
                                    class="absolute bg-black w-5 h-5 flex flex-col align-middle text-center items-center rounded-full pb-3 -top-2 -right-2"
                                    data-modal-hide="carousel-edit-{{ $carousel->id }}">
                                    <p class="m-auto text-white text-sm">X</p>
                                </button>
                                <div class="w-full h-full flex flex-col">
                                    <!-- start of form -->
                                    <form action="{{ route('admin.carousel.update', $carousel->id) }}" method="POST"
                                        class="flex flex-col h-full text-center py-10 px-5">
                                        @csrf
                                        @method('PATCH')
                                        <!-- input file -->
                                        {{-- <div class="relative w-full h-64 bg-gray-200 rounded-2xl">
                                            <!-- Hidden file input -->
                                            <input id="file-upload" type="file" class="hidden">
                                            <label for="file-upload"
                                                class="absolute inset-0 flex justify-center items-center cursor-pointer">
                                                <div class="text-gray-500">Upload Image</div>
                                            </label>
                                            <!-- Upload icon in the bottom-right corner -->
                                            <label for="file-upload"
                                                class="absolute bottom-3 right-3 bg-white p-2 rounded-lg cursor-pointer">
                                                <img src="{{ asset('img/assets/icon/icon_admin_category_edit.svg') }}"
                                                    alt="Upload Icon" class="h-6 w-6 grayscale">
                                            </label>
                                        </div> --}}
                                        <!-- end of input file -->
                                        <!-- Input name -->
                                        <input type="text" placeholder="Name" name="title" id=""
                                            value="{{ $carousel->title }}"
                                            class="rounded-2xl w-full bg-gray-200 hover:bg-gray-300 h-14 pl-5 pr-4 cursor-pointer mt-5 placeholder:text-black placeholder:font-semibold border-0 focus:outline-none focus:ring-0">
                                        <!-- input Info -->
                                        <textarea placeholder="Add info" name="description" id="edit-info-carousel" rows="3"
                                            class="rounded-2xl w-full bg-gray-200 hover:bg-gray-300 pl-5 pr-4 cursor-pointer mt-5 placeholder:text-black placeholder:font-semi border-0 focus:outline-none focus:ring-0">{{ $carousel->description }}</textarea>
                                        <!-- Button "add" -->
                                        <button type="submit"
                                            class="bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white font-semibold mt-auto mx-auto inline-block w-full h-8 rounded-3xl">Save</button>
                                    </form>
                                    <!-- end of form -->
                                </div>
                            </div>
                        </div>
                        <!-- end of modal content -->
                    </div>
                </div>
                <!-- end of Carousel-edit-modal -->
            </div>
        </div>
    @endforeach
    <!-- end of for looping -->

</div>
<!-- end of product card container -->

{{-- MODALS FOR CAROUSEL --}}

<!-- Carousel-add-modal -->
<div id="carousel-add-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-fit max-w-2xl max-h-full mt-20">
        <!-- Modal content -->
        <div class="bg-white w-[30vw] h-auto rounded-lg shadow">
            <div class="relative w-full h-full flex flex-row">
                <!-- x button (exit modal) -->
                <button type="button"
                    class="absolute bg-black w-5 h-5 flex flex-col align-middle text-center items-center rounded-full pb-3 -top-2 -right-2"
                    data-modal-hide="carousel-add-modal">
                    <p class="m-auto text-white text-sm">X</p>
                </button>
                <div class="w-full h-full flex flex-col">
                    <!-- start of form -->
                    <form action="{{ route('admin.carousel.store') }}" method="POST" enctype="multipart/form-data"
                        id="add-carousel-form" class="flex flex-col h-full text-center py-8 px-5">
                        @csrf
                        <!-- input file image with a larger area -->
                        <div class="relative w-full h-56 bg-gray-200 rounded-2xl" id="add-carousel-upload">
                            <!-- Hidden file input -->
                            <input id="add-carousel-media" name="media" type="file" accept="image/*"
                                class="hidden">
                            <!-- Label that acts as the clickable area -->
                            <label for="add-carousel-media"
                                class="absolute inset-0 flex justify-center items-center cursor-pointer">
                                <div class="text-gray-500">Upload file</div>
                            </label>
                            <!-- Upload icon in the bottom-right corner -->
                            <label for="add-carousel-media"
                                class="absolute bottom-3 right-3 bg-white p-2 rounded-lg cursor-pointer">
                                <img src="{{ asset('img/assets/icon/icon_admin_category_upload.svg') }}"
                                    alt="Upload Icon" class="h-6 w-6">
                            </label>
                        </div>
                        <!-- end of input file image -->
                        <!-- Input name -->
                        <input type="text" placeholder="Title" name="title" id="add-carousel-title"
                            class="rounded-2xl w-full bg-gray-200 hover:bg-gray-300 h-12 pl-5 pr-4 mt-5 placeholder:text-black placeholder:font-semibold border-0 focus:outline-none focus:ring-0">
                        {{-- dropdown pilih video/image --}}
                        <select id="add-carousel-type" name="media_type"
                            class="rounded-2xl w-full bg-gray-200 hover:bg-gray-300 h-12 pl-5 pr-4 mt-5 placeholder:text-black placeholder:font-semibold border-0 focus:outline-none focus:ring-0">
                            <option value="image">Type: Image</option>
                            <option value="video">Type: Video</option>
                            <option value="youtube">Type: Youtube</option>
                        </select>
                        {{-- input link video --}}
                        <input type="text" placeholder="Link Youtube" name="youtube_url"
                            id="add-carousel-youtube"
                            class="rounded-2xl w-full bg-gray-200 hover:bg-gray-300 h-12 pl-5 pr-4 mt-5 placeholder:text-black border-0 focus:outline-none focus:ring-0 hidden">
                        <!-- input Info -->
                        <textarea placeholder="Add description" name="description" id="edit-info-carousel" rows="3"
                            form="add-carousel-form"
                            class="rounded-2xl w-full bg-gray-200 hover:bg-gray-300 pl-5 pr-4 mt-5 placeholder:text-black placeholder:font-semi border-0 focus:outline-none focus:ring-0"></textarea>
                        <!-- Button "add" -->
                        <button type="submit"
                            class="bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white font-semibold mt-5 mx-auto inline-block w-full h-8 rounded-3xl">Add</button>
                    </form>
                    <!-- end of form -->
                </div>
            </div>
        </div>
        <!-- end of modal content -->
    </div>
</div>
<!-- end of Carousel-edit-modal -->

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

{{-- end of MODALS FOR CAROUSEL --}}


<script>
    $(document).ready(function() {
        $('#add-carousel-type').change(function() {
            const type = $(this).val();
            if (type === 'youtube') {
                $('#add-carousel-youtube').removeClass('hidden');
                $('#add-carousel-upload').addClass('hidden');
            } else {
                $('#add-carousel-youtube').addClass('hidden');
                $('#add-carousel-upload').removeClass('hidden');

                $('#add-carousel-preview').remove();
                $('#add-carousel-upload label:first').text('Upload file');
                $('#add-carousel-media').attr('accept', type === 'image' ? 'image/*' : 'video/*');
            }
        });

        $('#add-carousel-media').change(function() {
            const file = $(this).prop('files')[$(this).prop('files').length - 1];
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#add-carousel-preview').remove();
                if ($('#add-carousel-type').val() === 'video') {
                    console.log('video');
                    const video = $('<video>').attr('src', e.target.result);
                    video.attr('controls', true);
                    video.attr('id', 'add-carousel-preview');
                    video.attr('autoplay', false);
                    video.attr('loop', true);
                    video.attr('muted', true);
                    video.addClass('w-full h-full object-contain');
                    $('#add-carousel-upload').append(video);
                } else {
                    const img = $('<img>').attr('src', e.target.result);
                    img.attr('id', 'add-carousel-preview');
                    img.addClass('w-full h-full object-contain');
                    $('#add-carousel-upload').append(img);
                    $('#add-carousel-upload label:first').text('');
                }
            }
            reader.readAsDataURL(file);
        });
    })
</script>
