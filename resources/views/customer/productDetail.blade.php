@extends('layout.customer')
@section('title', 'Product Detail - *name product')

@section('content')
    <div class="w-full w-max[100%] h-full rounded-3xl bg-[#EFEFEF] shadow-md overflow-hidden py-6 px-6">
        {{-- image and product detail container --}}
        <div class="w-full h-full bg-[#FFFCFC] rounded-2xl flex flex-row">
            <div class="w-[28%] h-full">
                <div class="flex flex-col space-y-4">
                    <div class="w-full h-96 mr-auto bg-white p-3 rounded-xl">
                        {{-- main image --}}
                        <img id="mainImage" src="{{ asset('img/example/example_phone.png') }}"
                            class="w-full h-full object-contain" alt="Main Image">
                    </div>
                    {{-- thumbnail image container --}}
                    <div class="flex space-x-4 mx-auto overflow-x-auto" id="product-images">
                        @for ($i = 0; $i < 4; $i++)
                            <div class="relative w-14 h-14">
                                <img src="{{ asset('img/example/example_phone.png') }}"
                                    class="w-full h-full object-cover rounded-lg cursor-pointer border border-gray-100">
                            </div>
                        @endfor
                    </div>
                    {{-- thumbnail image container --}}
                </div>
            </div>
            {{-- this div for extra space --}}
            <div class="w-[2%] h-full text-transparent">.</div>
            {{-- product detail texts container --}}
            <div class="w-[70%] h-full flex-col px-8 py-4 rounded-2xl">
                {{-- rating container --}}
                <div class="w-full flex flex-row">
                    {{-- star and number --}}
                    <div class="flex flex-row">
                        {{-- icon star --}}
                        <img src="{{ asset('img/assets/icon/icon_review_star.svg') }}" alt="" class="h-12 w-12">
                        {{-- number rating --}}
                        <p class="my-auto ml-3 text-black font-bold">4.9</p>
                    </div>
                    {{-- rating count --}}
                    <p class="text-black font-normal mr-auto ml-40 my-auto">105 Rating</p>
                </div>
                {{-- end of rating container --}}

                {{-- product title --}}
                <h1 class="text-black text-opacity-50 font-bold text-lg text-left mt-4">Samsung S24 Ultra</h1>

                {{-- product Price --}}
                <h1 class="text-orange-400 font-bold text-4xl text-left mt-1">Rp8.000.000 - Rp 9.000.000</h1>

                {{-- idk bagian yang kurang --}}
                <div class="w-full">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero itaque rerum unde velit nostrum
                    debitis, at architecto est autem quia deserunt alias laudantium quas sed ad quis vitae magni saepe.
                    Nostrum, cum eius minus doloremque quibusdam consequuntur saepe voluptate beatae fugit obcaecati
                    similique exercitationem nobis sint fuga repellat inventore dolores placeat tempore pariatur! Minus esse
                    nesciunt sunt excepturi nam veniam?
                    Dolore architecto tempore cupiditate sit nulla facere ratione nisi sapiente iste, rem autem mollitia,
                    recusandae ea nemo repudiandae dolorem voluptatum et. Eligendi quo debitis repellendus, nesciunt ex
                    culpa exercitationem velit!
                    Eligendi maiores omnis harum quis blanditiis enim distinctio eaque ipsam quidem dicta recusandae
                    voluptates ipsa iusto, dolorum ullam id quo iste nihil mollitia repudiandae error fugiat natus tenetur!
                    Itaque, porro.
                    Ea consectetur, neque totam, eligendi rerum molestias architecto ducimus magnam alias explicabo rem
                    natus repellendus consequatur minima repellat et, nesciunt quidem ex libero? Quam temporibus voluptatum
                    dicta dolores harum obcaecati!
                </div>
                {{--  --}}

                {{-- quantity --}}
                <div class="w-full h-fit flex flex-row mt-6">
                    <div class="w-[30%] h-full">
                        Qty
                    </div>
                    <div class="w-[70%] h-full flex flex-row">
                        <div
                            class="border border-black rounded-full py-1 px-3.5 text-2xl cursor-pointer hover:bg-slate-100">
                            -</div>
                        <p class="my-auto text-2xl mx-6">1</p>
                        <div class="border border-black rounded-full py-1 px-3 text-2xl cursor-pointer hover:bg-slate-100">+
                        </div>
                    </div>
                </div>
                {{-- end of quantity --}}

                {{-- two button --}}
                <div class="w-full h-fit flex flex-row mt-24">
                    <button
                        class="w-60 bg-[#FFFCFC] border border-orange-400 text-orange-400 text-2xl rounded-2xl py-2 hover:bg-slate-100 focus:bg-slate-200">Buy
                        now</button>
                    <button
                        class="w-60 bg-[#FFFCFC] border border-orange-400 text-orange-400 text-2xl rounded-2xl  py-2 ml-20 hover:bg-slate-100 focus:bg-slate-200">Add
                        to Cart</button>
                </div>
                {{-- end of two button --}}
            </div>
        </div>
        {{-- end of image and product detail container --}}

        {{-- start of product description --}}
        <div class="w-[100%] h-full flex-col px-8 py-8 bg-[#FFFCFC] rounded-2xl mt-6">
            <h1 class="text-black font-bold text-2xl">Product Description</h1>
            {{-- product description container --}}
            <p class="text-[#898383] font-semibold text-lg mt-6">
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Provident blanditiis consectetur corrupti. Alias
                totam voluptates corrupti ullam. Repudiandae ipsum deleniti dolores suscipit repellat nihil quae illo,
                perspiciatis reiciendis ipsam. Voluptates.
                Quae aliquid nemo maiores quam, dignissimos eum non, dolores illum accusamus sit iure eius impedit vel
                placeat natus facilis cumque libero, culpa eaque animi odit pariatur voluptate quibusdam. Quis, officia?
                Earum omnis fuga esse praesentium ad expedita, velit optio corporis. Voluptatum beatae, tempora quos
                possimus, hic provident culpa harum id sequi asperiores vero ducimus fugit iste dolorum eos est recusandae!
                Ea quam distinctio aliquam fugit sequi officiis rem fugiat libero placeat itaque! Sunt explicabo accusamus
                enim incidunt expedita illo atque animi, vero iusto, sed cum exercitationem culpa dolore perspiciatis error?
                Maxime rem nemo modi aut excepturi quae quo doloribus necessitatibus a obcaecati atque sunt, quisquam
                nostrum odit. Modi perspiciatis exercitationem delectus quisquam nostrum molestiae vel, commodi facere animi
                temporibus aut.
                Corrupti consectetur quos sequi autem eum iusto eveniet, expedita nihil, perspiciatis aliquid unde,
                veritatis quidem? Laborum blanditiis quasi quis repudiandae fuga ratione, nobis pariatur nesciunt aliquam.
                Itaque dolore minima iure!
                Sed rem earum, delectus assumenda cumque eos quos inventore et perspiciatis omnis quaerat corporis at
                perferendis labore aspernatur repellat quas culpa error id temporibus sit laboriosam officia neque. Eius,
                maiores.
                Alias laboriosam assumenda animi quaerat delectus officia, consequatur vero adipisci dicta aliquid? Quas
                accusamus exercitationem explicabo non temporibus ex illo iusto incidunt quos, velit quibusdam, dolorem
                veritatis sint facilis tempora!
                Magni eligendi, quam voluptate possimus maiores suscipit tempore consequatur sapiente voluptatem quis eaque
                deleniti at aliquam beatae fuga facilis ut similique natus numquam molestiae, aspernatur, vitae facere
                dolore cum. Rerum?
                Deleniti labore reprehenderit, assumenda consequuntur cupiditate reiciendis mollitia odit veritatis atque
                eligendi fugiat quas ut, eos veniam officiis quis. Ea similique ducimus voluptatem iste magnam nulla modi
                atque perspiciatis aliquam.
            </p>
        </div>
        {{-- end of product description --}}

        {{-- start of product rating container --}}
        <div class="w-[100%] h-full flex-col px-8 pt-6 pb-8 bg-[#FFFCFC] rounded-2xl mt-6">
            <h1 class="text-black font-bold text-2xl">Product Rating</h1>
            {{-- star and product name container --}}
            <div class="w-full h-full flex flex-row">
                <div class="w-[38%] h-full flex flex-row px-8 py-10">
                    {{-- icon star --}}
                    <img src="{{ asset('img/assets/icon/icon_review_star.svg') }}" alt=""
                        class="h-32 w-32 object-contain">
                    {{-- rating overall --}}
                    <h1 class="text-black text-6xl font-bold my-auto ml-5">4.9</h1>
                </div>
                <div class="w-[72%] h-full flex flex-col my-auto">
                    {{-- product name --}}
                    <h1 class="text-black text-3xl font-bold">Samsung Ultra S24</h1>
                    {{-- product variant --}}
                    <h2 class="text-[#898383] text-xl font-bold mt-6">Black</h2>
                </div>
            </div>
            {{-- end of star and product name container --}}

            {{-- list of reviews container --}}
            <div class="w-full h-full flex flex-col mt-10 pl-10">
                @for ($h = 0; $h < 2; $h++)
                    {{-- section reviewProduct --}}
                    <div class="w-full h-fit flex flex-row mb-10">
                        {{-- image user and text container --}}
                        <div class="w-[70%] flex flex-row mb-auto">
                            {{-- profile image --}}
                            <div class="w-[15%] h-full my-auto">
                                <img src="{{ asset('img/example/admin_order_img_user.png') }}" alt=""
                                    class="w-32 h-32 rounded-full">
                            </div>
                            {{-- name,product, and review --}}
                            <div class="w-[75%] flex flex-col h-full my-auto pl-4">
                                {{-- customer name --}}
                                <h1 class="text-black font-bold text-xl my-0.5">Aisyah</h1>
                                {{-- product name --}}
                                <h1 class="text-[#B7B7B7] font-bold text-sm my-0.5">Samsung Ultra S24</h1>
                                {{-- text review --}}
                                <h1 class="text-[#898383] font-bold text-sm my-0.5">“Produk aman sampai tujuan, packingnya
                                    rapi”
                                </h1>
                            </div>
                        </div>
                        {{-- end of image user and text container --}}
                        {{-- image review --}}
                        <div class="w-[30%] w-max-[30%] flex flex-wrap gap-x-2 gap-y-1 h-fit my-auto">
                            @for ($i = 0; $i < 3; $i++)
                                <img src="{{ asset('img/example/example_phone.png') }}" alt=""
                                    class="w-24 h-24 rounded-lg object-contain border border-black bg-white cursor-pointer"
                                    data-modal-target="image-review-view-modal" data-modal-toggle="image-review-view-modal">
                            @endfor
                        </div>
                    </div>
                    {{-- end of section reviewProduct --}}
                @endfor
            </div>
            {{-- end of list of reviews container --}}
        </div>
        {{-- end of product rating container --}}
    </div>



    {{-- modal image review when clicked --}}
    <!-- image-review-view-modal -->
    <div id="image-review-view-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-fit max-w-2xl max-h-full mt-20">
            <!-- Modal content -->
            <div class="bg-white w-[30vw] h-auto rounded-lg shadow">
                <div class="relative w-full h-full flex flex-row">
                    <!-- x button (exit modal) -->
                    <button type="button"
                        class="absolute bg-black w-5 h-5 flex flex-col align-middle text-center items-center rounded-full pb-3 -top-2 -right-2"
                        data-modal-hide="image-review-view-modal">
                        <p class="m-auto text-white text-sm">X</p>
                    </button>
                    {{-- modal content --}}
                    <div class="w-full h-full flex flex-col p-5">
                        {{-- image review --}}
                        <img id="mainImage" src="{{ asset('img/example/example_phone.png') }}"
                            class="w-full h-full object-contain" alt="Main Image">
                    </div>
                    {{-- end of modal content --}}
                </div>
            </div>
            <!-- end of modal content -->
        </div>
    </div>
    <!-- end of Carousel-edit-modal -->
    <!-- end of catefory-edit-modal -->
    {{-- end of modal image review when clicked --}}
@endsection
