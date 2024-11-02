<div class="w-full flex items-center">
    <!-- plus button -->
    <a href="#" class="ml-5" data-modal-target="carousel-add-modal" data-modal-toggle="carousel-add-modal">
        <img src="{{ asset('img/assets/icon/icon_admin_product_plus.svg') }}" alt="plus icon"
            class="w-10 h-10 fill-orange-400">
    </a>

    <!-- text Add Carousel -->
    <h2 class="text-black text-md ml-3 font-semibold">Add Carousel</h2>
</div>

<!-- start of Carousel card container -->
<div class="container w-full h-[85%] mt-5 overflow-y-scroll flex flex-wrap flex-row gap-12">
    <!-- card Carousel -->
    <!-- ini for loop hanya untuk coba -->
    @foreach ($carousels as $carousel)
        <div class="bg-white w-60 h-72 rounded-lg overflow-hidden flex flex-col">
            <!-- image Carousel card -->
            <div class="w-full h-2/3 bg-cover">
                @if ($carousel->media_type == 'image')
                    <img src="{{ Storage::exists('public/' . $carousel->media) ? asset('storage/' . $carousel->media) : $carousel->media }}"
                        alt="" class="w-full h-full object-cover">
                @elseif ($carousel->media_type == 'video')
                    <video
                        src="{{ Storage::exists('public/' . $carousel->media) ? asset('storage/' . $carousel->media) : $carousel->media }}"
                        class="w-full h-full object-cover" controls></video>
                @elseif ($carousel->media_type == 'youtube')
                    <iframe width="560" height="315"
                        src="https://www.youtube.com/embed/nnntnYo9wHM?si=U0uesVfEZca5Am7B" title="YouTube video player"
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
                <a href="#" class="mr-auto" data-modal-target="carousel-edit-modal"
                    data-modal-toggle="carousel-edit-modal">
                    <img src="{{ asset('img/assets/icon/icon_admin_product_edit.svg') }}" alt=""
                        class="w-7 h-7">
                </a>
                <!-- delete icon -->
                <form action="{{ route('admin.carousel.delete', $carousel->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" href="#" class="ml-auto">
                        <img src="{{ asset('img/assets/icon/icon_admin_product_trash.svg') }}" alt=""
                            class="w-7 h-7">
                    </button>
                </form>
            </div>
        </div>
    @endforeach
    <!-- end of for looping -->

    <!-- Carousel-edit-modal -->
    <div id="carousel-edit-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-fit max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="bg-white w-[30vw] h-[75vh] rounded-lg shadow">
                <div class="relative w-full h-full flex flex-row">
                    <!-- x button (exit modal) -->
                    <button type="button"
                        class="absolute bg-black w-5 h-5 flex flex-col align-middle text-center items-center rounded-full pb-3 -top-2 -right-2"
                        data-modal-hide="carousel-edit-modal">
                        <p class="m-auto text-white text-sm">X</p>
                    </button>
                    <div class="w-full h-full flex flex-col">
                        <!-- start of form -->
                        <form action="" method="" class="flex flex-col h-full text-center py-5 px-5">
                            <!-- input file -->
                            <div class="relative w-full h-64 bg-gray-200 rounded-2xl">
                                <!-- Hidden file input -->
                                <input id="file-upload" type="file" class="hidden">
                                <label for="file-upload"
                                    class="absolute inset-0 flex justify-center items-center cursor-pointer">
                                    <div class="text-gray-500">Upload Image</div>
                                </label>
                                <!-- Upload icon in the bottom-right corner -->
                                <label for="file-upload"
                                    class="absolute bottom-3 right-3 bg-white p-2 rounded-lg cursor-pointer">
                                    <img src="{{ asset('img/assets/icon/icon_admin_category_upload.svg') }}"
                                        alt="Upload Icon" class="h-6 w-6">
                                </label>
                            </div>
                            <!-- end of input file -->
                            <!-- Input name -->
                            <input type="text" placeholder="Name" name="" id=""
                                class="rounded-2xl w-full bg-gray-200 hover:bg-gray-300 h-14 pl-5 pr-4 cursor-pointer mt-5 placeholder:text-black placeholder:font-semibold border-0 focus:outline-none focus:ring-0">
                            <!-- input Info -->
                            <textarea placeholder="Add info" name="" id="edit-info-carousel" rows="3"
                                class="rounded-2xl w-full bg-gray-200 hover:bg-gray-300 pl-5 pr-4 cursor-pointer mt-5 placeholder:text-black placeholder:font-semi border-0 focus:outline-none focus:ring-0"></textarea>
                            <!-- Button "add" -->
                            <button type="submit" data-modal-hide="carousel-edit-modal"
                                class="bg-orange-400 hover:bg-orange-500 text-white font-semibold mt-auto mx-auto inline-block w-1/2 h-14 rounded-3xl">Save</button>
                        </form>
                        <!-- end of form -->
                    </div>
                </div>
            </div>
            <!-- end of modal content -->
        </div>
    </div>
    <!-- end of Carousel-edit-modal -->

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
                            id="add-carousel-form" class="flex flex-col h-full text-center py-4 px-5">
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
                                class="bg-orange-400 hover:bg-orange-500 text-white font-semibold mt-5 mx-auto inline-block w-1/2 h-14 rounded-3xl">Add</button>
                        </form>
                        <!-- end of form -->
                    </div>
                </div>
            </div>
            <!-- end of modal content -->
        </div>
    </div>
    <!-- end of Carousel-edit-modal -->
    <!-- end of catefory-edit-modal -->
</div>
<!-- end of product card container -->


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
