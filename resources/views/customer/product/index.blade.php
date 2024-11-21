@extends('layout.customer')
@section('title', '- Products')

@php
    $lineId = \App\Models\Setting::where('key', 'line')->first()->value;
@endphp
<a href="https://line.me/ti/p/~{{ $lineId }}" target="_blank"
    class="fixed flex flex-row bottom-8 right-8 px-2 py-2 text-2xl font-bold text-orange-400 bg-white rounded-3xl align-middle items-center shadow-md hover:shadow-lg z-30">
    <img src="{{ asset('img/assets/icon/icon_customer_chat.svg') }}" alt="icon_Chat" class="w-10 h-10 mr-1">
    <p>Chat</p>
</a>

@section('content')
    <div class="w-full w-max[100%] h-full flex flex-col rounded-3xl bg-[#EFEFEF] shadow-lg overflow-hidden py-10 px-1 md:px-14">
        {{-- sorting and filter container --}}
        <div class="w-full flex flex-col md:flex-row mb-5">
            @php
                $category = request()->category;
                if ($category) {
                    $category = \App\Models\Category::find($category);
                }
            @endphp
            {{-- dropdown category --}}
            <button id="dropdownCategoryButton" data-dropdown-toggle="dropdownCategory"
                class="text-orange-400 bg-white focus:ring-0 focus:outline-none flex justify-between rounded-xl text-base px-10 py-2.5 text-center font-semibold items-center mx-auto md:mx-0 md:my-auto"
                type="button">
                <span class="text-left">{{ $category ? $category->name : 'Category' }}</span>
                <svg class="w-2.5 h-2.5 ml-10 text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </button>

            <!-- Dropdown menu -->
            <div id="dropdownCategory"
                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownCategoryButton">
                    <li data-category="">
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">All</a>
                    </li>
                    @foreach (\App\Models\Category::all() as $category)
                        <li data-category="{{ $category->id }}">
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100">{{ $category->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            {{-- end of dropdown category --}}

            {{-- min and max price filter container --}}
            <form action="" class="flex flex-col md:flex-row md:ml-10 w-fit h-full mt-4 md:my-auto mx-auto md:mx-0 gap-y-4 md:gap-6 ">
                {{-- Minimum price filter --}}
                <input type="number" placeholder="Minimum price" name="min_price" form="form-filter"
                    value="{{ request()->min_price }}"
                    class="rounded-2xl bg-gray-300 border-none focus:border-0 focus:ring-0 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                {{-- end of Minimum price filter --}}
                <input type="number" placeholder="Maximum Price" name="max_price" form="form-filter"
                    value="{{ request()->max_price }}"
                    class="rounded-2xl bg-gray-300 border-none focus:border-0 focus:ring-0 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
            </form>
            {{-- end of min and max price filter container --}}


            @php
                switch (request()->sort_by) {
                    case 'lowest_price':
                        $sortBy = 'Lowest Price';
                        break;
                    case 'highest_price':
                        $sortBy = 'Highest Price';
                        break;
                    case 'most_ordered':
                        $sortBy = 'Most Ordered';
                        break;
                    default:
                        $sortBy = 'Sort By';
                        break;
                }
            @endphp
            {{-- sort by dropdown --}}
            <button id="dropdownSortByButton" data-dropdown-toggle="dropdownSortBy"
                class="text-orange-400 bg-white focus:ring-0 focus:outline-none flex justify-between rounded-xl text-base pr-6 px-10 py-2.5 text-center font-semibold items-center mx-auto md:mx-0 md:my-auto md:ml-auto"
                type="button">
                <span class="text-left">{{ $sortBy }}</span>
                <svg class="w-2.5 h-2.5 ml-14 text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </button>

            <!-- Dropdown menu -->
            <div id="dropdownSortBy"
                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownSortByButton">
                    <li data-sort="">
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Sort By</a>
                    </li>
                    <li data-sort="lowest_price">
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Highest Price</a>
                    </li>
                    <li data-sort="highest_price">
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Lowest Price</a>
                    </li>
                    <li data-sort="most_ordered">
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Most Ordered</a>
                    </li>
                </ul>
            </div>
            {{-- end of sort by dropdown --}}

        </div>
        {{-- end of sorting and filter container --}}

        {{-- products card container --}}
        <div class="w-full h-full grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-x-1 md:gap-x-6 gap-y-0.5 md:gap-y-12 mx-auto md:mx-0">
            @foreach ($products as $product)
                {{-- card product --}}
                <div class="bg-white scale-95 md:scale-100 w-[155px] h-[245px] flex flex-col rounded-xl overflow-hidden items-center cursor-pointer mx-auto md:mx-0"
                    onclick="window.location.href = '{{ route('product.show', $product->id) }}'">
                    {{-- image product --}}
                    <div class="w-full h-4/6 bg-cover bg-no-repeat bg-center"
                        style="background-image: url('{{ asset('img/example/test_blouse.png') }}')"></div>
                    {{-- text product --}}
                    <div class="w-full h-2/6 py-0.5 px-1.5 flex flex-col">
                        {{-- product title --}}
                        <h1 class="text-[#3E6E7A] text-sm font-semibold text-nowrap text-ellipsis overflow-hidden">
                            {{ $product->name }}
                        </h1>
                        {{-- product type --}}
                        <h2 class="text-xs font-semibold text-black text-opacity-50">{{ $product->category->name }}</h2>
                        {{-- product price --}}
                        <h3 class="text-xs ml-auto text-orange-400 font-semibold">Rp
                            {{ number_format($product->price, 0, ',', '.') }}</h3>
                        {{-- Buy product button --}}
                        <a href="#" class="ml-auto my-auto"><button
                                class="bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] rounded-xl text-white px-4 py-0.5 text-xs">Buy</button></a>
                    </div>
                </div>
                {{-- end of card product --}}
            @endforeach

        </div>
        {{-- end of products card container --}}

        {{-- pagination --}}
        <div class="w-1/6 h-fit flex flex-row mx-auto mt-12 rounded-2xl overflow-hidden bg-[#3E6E7A] text-white text-center">
            {{-- Arrow left --}}
            <div class="w-1/6 flex hover:bg-[#37626d] active:bg-[#325862] pl-2">
                <img src="{{ asset('img/assets/icon/icon_arrow_back.svg') }}" alt="" class="my-auto mr-auto">
            </div>
            <div class="w-1/6 hover:bg-[#37626d] active:bg-[#325862]">1</div>
            <div class="w-1/6 hover:bg-[#37626d] active:bg-[#325862]">2</div>
            <div class="w-1/6 hover:bg-[#37626d] active:bg-[#325862]">3</div>
            <div class="w-1/6 hover:bg-[#37626d] active:bg-[#325862]">...</div>
            {{-- arrow right --}}
            <div class="w-1/6 flex hover:bg-[#37626d] active:bg-[#325862] pr-2">
                <img src="{{ asset('img/assets/icon/icon_arrow_back.svg') }}" alt=""
                    class="rotate-180 ml-auto my-auto">
            </div>
        </div>
        {{-- end of pagination --}}
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#dropdownCategory > ul > li').click(function(ev) {
                const categoryId = $(this).attr('data-category')
                $('input[name=category]').val(categoryId)
                $('#form-filter').submit()
                ev.preventDefault()
            })

            $('#dropdownSortBy > ul > li').click(function(ev) {
                const sort = $(this).attr('data-sort')
                $('input[name=sort_by]').val(sort)
                $('#form-filter').submit()
                ev.preventDefault()
            })

            let filterChanged = 0
            $('input[name=min_price], input[name=max_price], input[name=search]').on('input', function() {
                filterChanged = Date.now()
            })

            $('input[name=min_price], input[name=max_price]').on('keypress', function(e) {
                if (e.key === 'Enter') {
                    $('#form-filter').submit()
                }
            })
            setInterval(() => {
                if (filterChanged && Date.now() - filterChanged > 2000) {
                    $('#form-filter').submit()
                }
            }, 2000);
        })
    </script>
@endsection
