@extends('layout.customer')
@section('title', 'Request Order')

<a href=""
    class="fixed flex flex-row bottom-8 right-8 px-2 py-2 text-base md:text-2xl font-bold text-[#3E6E7A] bg-white rounded-3xl align-middle items-center shadow-md hover:shadow-lg z-30">
    <img src="{{ asset('img/assets/icon/icon_customer_chat.svg') }}" alt="icon_Chat" class="w-5 h-5 md:w-10 md:h-10 mr-1">
    <p>Chat</p>
</a>

@section('content')
    <div class="w-full w-max[100%] h-full rounded-3xl bg-[#EFEFEF] shadow-md overflow-hidden py-3 md:py-6 px-3 md:px-6">
        {{-- start of welcome container --}}
        <div class="bg-white w-full h-full flex flex-col rounded-xl pt-2 md:pt-4 pb-4 md:pb-8 px-4 md:px-8">
            <h1 class="text-lg md:text-2xl font-bold">Welcome !</h1>
            <p class="font-semibold text-xs md:text-lg">
                Once you've selected your items from your preferred Korean store, complete this form to place your custom
                order and <br> let us handle the rest.
            </p>
            <p class="font-semibold text-xs md:text-lg mt-2 md:mt-8">
                Not sure where to look beyond HepiKorea? Feel free to use our search engine to explore other Korean stores.
                Say <br> goodbye to hopping between websites!
            </p>
        </div>
        {{-- end of welcome container --}}

        {{-- start of step pemesanan & form customer details --}}
        <div class="w-full h-full bg-white flex-col rounded-xl mt-6 py-2 md:py-6 px-2 md:px-8">
            <h1 class="text-center text-xl md:text-4xl text-black font-bold mb-1 md:mb-5">Step of Request Order</h1>

            {{-- container card step pemesanan --}}
            <div class="w-full h-full flex flex-col">
                <div class="flex flex-row h-1/2">
                    <div class="w-1/2 h-full flex p-2">
                        {{-- step number 1 --}}
                        <div
                            class="w-fit h-fit bg-white rounded-xl mr-auto shadow-lg hover:shadow-xl my-auto flex py-2 md:py-10 pl-2.5 md:pl-5 pr-2.5 md:pr-16">
                            <div class="text-[#3E6E7A] text-[8px] md:text-lg font-semibold m-auto flex flex-row">
                                <h1 class="text-[38px] md:text-[96px] font-bold">1</h1>
                                <h1 class="ml-2 my-auto">Complete Customer Detail</h1>
                            </div>
                        </div>
                        {{-- end of step number 1 --}}
                    </div>
                    <div class="w-1/2 h-full flex p-2">
                        {{-- step number 3 --}}
                        <div
                            class="w-fit h-fit bg-[#3E6E7A] rounded-xl mr-auto shadow-lg hover:shadow-xl my-auto flex py-2 md:py-10 pl-2.5 md:pl-5 pr-2.5 md:pr-20">
                            <div class="text-white text-[8px] md:text-lg font-semibold m-auto flex flex-row">
                                <h1 class="text-[38px] md:text-[96px] font-bold">3</h1>
                                <h1 class="ml-2 my-auto">Confirm the product</h1>
                            </div>
                        </div>
                        {{-- end of step number 3 --}}
                    </div>
                </div>
                <div class="flex flex-row h-1/2 pt-4">
                    <div class="w-1/2 h-full flex p-2">
                        {{-- step number 2 --}}
                        <div
                            class="w-fit h-fit bg-[#3E6E7A] rounded-xl ml-auto shadow-lg hover:shadow-xl my-auto flex py-2 md:py-10 pl-2.5 md:pl-5 pr-2.5 md:pr-10">
                            <div class="text-white text-[8px] md:text-lg font-semibold m-auto flex flex-row">
                                <h1 class="text-[38px] md:text-[96px] font-bold">2</h1>
                                <h1 class="ml-2 my-auto">Write the detail of product request</h1>
                            </div>
                        </div>
                        {{-- end of step number 2 --}}
                    </div>
                    <div class="w-1/2 h-full flex p-2">
                        {{-- step number 4 --}}
                        <div
                            class="w-fit h-fit bg-white rounded-xl ml-auto shadow-lg hover:shadow-xl my-auto flex py-2 md:py-10 pl-2.5 md:pl-5 pr-2.5 md:pr-6">
                            <div class="text-[#3E6E7A] text-[8px] md:text-lg font-semibold m-auto flex flex-row">
                                <h1 class="text-[38px] md:text-[96px] font-bold">4</h1>
                                <h1 class="ml-2 my-auto">Wait the product confirmed</h1>
                            </div>
                        </div>
                        {{-- end of step number 4 --}}
                    </div>
                </div>
            </div>

            {{-- form Customer details --}}
            <form id="form-request" action="{{ route('request-order') }}" method="POST" enctype="multipart/form-data"
                class="w-full h-full flex flex-col mt-2 md:mt-10 {{ Auth::check() ? 'hidden' : '' }}">
                @csrf
                <label for="name" class="text-base md:text-xl text-black font-medium my-0.5 md:my-2">Name</label>
                <input type="text" name="fullname" value="{{ Auth::check() ? Auth::user()->fullname : '' }}"
                    class="w-full md:w-[55%] h-8 md:h-12 pl-5 bg-white outline outline-1 border-black rounded-lg md:rounded-xl my-0.5 md:my-2 border-0 focus:border-1 focus:border-black focus:ring-black"
                    placeholder="Enter your name">
                <label for="email" class="text-base md:text-xl text-black font-medium my-0.5 md:my-2">Email</label>
                <div class="my-2 flex flex-row">
                    <input type="email" name="email" value="{{ Auth::check() ? Auth::user()->email : '' }}"
                        class="w-full md:w-[55%] h-8 md:h-12 pl-5 bg-white outline outline-1 border-black rounded-lg md:rounded-xl py-2 border-0 focus:border-1 focus:border-black focus:ring-black"
                        placeholder="Email address">
                </div>
            </form>
            {{-- end of customer detail --}}
        </div>
        {{-- end of container card step pemesanan --}}

        {{-- container list request order --}}
        <div class="w-full h-fit pt-6 flex flex-col" id="request-items">
            <a href="#" class="ml-auto w-1/4 md:w-1/12"><button type="submit" form="form-request"
                    class="bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] rounded-lg text-white text-sm md:text-lg py-1.5 md:py-2 px-2 md:px-5 ">Confirm</button></a>
        </div>
        {{-- end container list request order --}}

        {{-- start of request order form --}}
        <div class="w-full h-full bg-white flex-col rounded-xl mt-6 py-3 md:py-6 px-4 md:px-8">
            <form action="" class="w-full h-fit flex flex-col text-orange-400 font-semibold text-base md:text-xl">
                <label for="">Product Name</label>
                {{-- input product name --}}
                <input type="text" id="product-name" name="product-name"
                    class="rounded-xl bg-white border text-[#898383] font-normal border-black pl-6 focus:border-black focus:ring-0 my-2">
                <label for="">Product Photo</label>
                <!-- input file image -->
                <div class="relative w-full my-2" onclick="$(this).find('input[type=file]').click()">
                    <!-- Hidden file input -->
                    <input id="product-image" name="icon" type="file" class="hidden">
                    <!-- Custom file input label -->
                    <label for="product-image"
                        class="flex items-center justify-between w-full rounded-xl bg-white border border-black  h-10 pl-6 pr-4 cursor-pointer">
                        <span class="text-[#898383] font-normal">Upload your photo</span>
                        <img src="{{ asset('img/assets/icon/icon_admin_category_upload.svg') }}" alt="Upload Icon"
                            class="h-8 w-8">
                    </label>
                </div>

                {{-- input product link --}}
                <label for="product-link">Product Link</label>
                <input type="text" id="product-link" name="product-link"
                    class="rounded-xl bg-white border text-[#898383] font-normal border-black pl-6 focus:border-black focus:ring-0 my-2">

                {{-- input price --}}
                <label for="product-price">Price</label>
                <input type="number" id="product-price"
                    class="rounded-xl bg-white border text-[#898383] font-normal border-black pl-6 focus:border-black focus:ring-0 my-2">

                {{-- input quantity --}}
                <label for="product-quantity">Quantity</label>
                <input type="number" id="product-quantity"
                    class="rounded-xl bg-white border text-[#898383] font-normal border-black pl-6 focus:border-black focus:ring-0 my-2">

                {{-- input note --}}
                <label for="product-note">Note</label>
                <textarea id="product-description" cols="30" rows="10"
                    class="rounded-xl bg-white border text-[#898383] font-normal border-black px-6 focus:border-black focus:ring-0 resize-none my-2"></textarea>

                <button type="button" onclick="addOrderItem()"
                    class="text-white bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] w-1/5 md:w-1/12 py-1 md:py-2 rounded-lg font-normal mt-0.5 mr-auto">Add</button>
            </form>
        </div>
        {{-- end of request order form --}}
    </div>

    {{-- end of step pemesanan & form customer details --}}


    {{-- MODALS FOR REQUEST ORDER --}}

    {{-- delete confirmation modal --}}
    <div id="confirmation-delete-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-fit md:inset-0 max-h-full">
        <div class="relative p-4 w-fit max-w-5xl max-h-full my-56">
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
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-fit max-h-full">
        <div class="relative p-4 w-fit max-w-5xl max-h-full mt-56">
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

    {{-- end of MODALS FOR REQUEST ORDER --}}

@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#form-request').submit(function(e) {
                const productCount = $('#request-items').find('.request-order-items').length;
                if (productCount == 0) {
                    e.preventDefault();
                    alert('Please add at least add one product');
                }
            })
        })

        function addOrderItem() {
            let productImagePreview = "{{ asset('img/assets/icon/icon_admin_order_product.svg') }}";
            const productCount = $('#request-items').find('.request-order-items').length;

            const productName = $('#product-name').val();
            const productImage = $('#product-image').clone(true)[0];
            if (productImage.files.length > 0) {
                productImagePreview = URL.createObjectURL(productImage.files[0]);
                $(productImage)
                    .removeAttr('id')
                    .attr('name', `items[${productCount}][image]`)
                    .attr('form', 'form-request');
            }
            const productLink = $('#product-link').val();
            const productPrice = $('#product-price').val();
            const productQuantity = $('#product-quantity').val();
            const productDescription = $('#product-description').val();
            console.log({
                productName,
                productImage,
                productLink,
                productPrice,
                productQuantity,
                productDescription
            });

            const component = $(`
            <div class="w-full h-fit bg-white rounded-xl flex flex-row px-1 md:px-4 py-2 md:py-4 mb-4 request-order-items">
                <div class="w-[15%] h-[6rem] md:h-[10rem] bg-contain bg-no-repeat bg-center"
                    style="background-image: url('${productImagePreview}')"></div>
                <div class="w-[42%] pl-5 flex flex-col">
                    <div class="flex flex-row mb-auto align-middle">
                        <h1 class="w-fit md:max-w-[55%] h-fit text-xs md:text-xl font-medium text-black mr-auto">${productName}</h1>
                        <input type="hidden" form="form-request" name="items[${productCount}][name]" value="${productName}">
                        <h1 class="text-xs md:text-xl font-semibold text-[#B7B7B7] mx-auto">Rp ${productPrice}</h1>
                        <input type="hidden" form="form-request" name="items[${productCount}][price]" value="${productPrice}">
                    </div>
                    <div class="w-full h-full flex flex-col mt-4">
                        <p class="font-medium text-xs md:text-lg text-black mt-auto">Link:</p>
                        <textarea form="form-request" name="items[${productCount}][url]" cols="" rows="2" readonly
                            class="rounded-2xl resize-none">${productLink}</textarea>
                    </div>
                </div>
                <div class="w-[43%] pl-5 flex flex-col">
                    <div class="flex flex-row mb-auto align-middle">
                        <input type="hidden" form="form-request" name="items[${productCount}][quantity]" value="${productQuantity}">
                        <h1 class="text-xs md:text-xl font-medium text-[#B7B7B7] mr-auto">${productQuantity}x</h1>
                        <h1 class="text-xs md:text-xl font-semibold text-orange-400 mx-auto">Rp ${productPrice*productQuantity}</h1>
                        <button href=""
                            class="bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] p-1 rounded-md"><img
                                src="{{ asset('img/assets/icon/icon_requestOrder_trashcan.svg') }}" alt=""
                                class="w-3 md:w-6 h-3 md:h-6" data-modal-target="confirmation-delete-modal"
                                data-modal-toggle="confirmation-delete-modal"></button>
                    </div>
                    <div class="w-full h-full flex flex-col mt-4">
                        <p class="font-medium text-xs md:text-lg text-black mt-auto">Note:</p>
                        <textarea form="form-request" name="items[${productCount}][description]" cols="" rows="2" placeholder="" only
                            class="rounded-2xl resize-none text-[#898383]">${productDescription}</textarea>
                    </div>
                </div>
            </div>
            `)

            if (productImage.files.length > 0) {
                component.append(productImage);
            }
            $('#request-items').prepend(component);
        }
    </script>
@endpush
