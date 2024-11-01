@extends('layout.admin')
@section('title', 'Product')

@section('content')
    <div class="bg-[#EFEFEF] border-gray-200 rounded-lg overflow-y-auto">
        <!-- Tabs (product, category, carousel) -->
        <div class="mb-3">
            <ul class="flex flex-wrap -mb-px text-lg font-bold text-center text-black gap-x-16" id="default-tab"
                data-tabs-toggle="#default-tab-content"
                data-tabs-active-classes="text-black hover:text-black dark:text-purple-500 dark:hover:text-purple-500 border-b-4 border-orange-400 hover:border-orange-400 dark:border-purple-500"
                data-tabs-inactive-classes="dark:border-transparent text-black hover:text-orange-400 dark:text-gray-400 border-transparent hover:border-transparent dark:border-gray-700 dark:hover:text-gray-300"
                role="tablist">
                <!-- Tab product -->
                <li class="ml-auto" role="presentation">
                    <button onclick="window.location.href='{{ route('admin.product.index') }}'"
                        class="inline-block px-4 pt-4 pb-1 border-b-2 rounded-t-lg" id="product-tab"
                        data-tabs-target="#product" type="button" role="tab" aria-controls="product"
                        aria-selected="false">Product</button>
                </li>
                <!-- Tab  Category-->
                <li class="md:mx-52 lg:mx-64" role="presentation">
                    <button onclick="window.location.href='{{ route('admin.category.index') }}'"
                        class="inline-block px-4 pt-4 pb-1 border-b-2 rounded-t-lg" id="category-tab"
                        data-tabs-target="#category" type="button" role="tab" aria-controls="category"
                        aria-selected="false">Category</button>
                </li>
                <!-- Tab Carousel -->
                <li class="mr-auto" role="presentation">
                    <button href="#" class="inline-block px-4 pt-4 pb-1 border-b-2 rounded-t-lg" id="carousel-tab"
                        data-tabs-target="#carousel" type="button" role="tab" aria-controls="carousel"
                        aria-selected="false">Carousel</button>
                </li>
            </ul>
        </div>

        <!-- Tab Content (showing the content) -->
        <div id="default-tab-content">
            <!-- start of product content -->
            <div class="hidden px-10 rounded-lg h-[80vh] w-full" id="product" role="tabpanel"
                aria-labelledby="product-tab">
                @if ($tab == 'product')
                    @include('admin.product.components.list')
                @elseif ($tab == 'create')
                    @include('admin.product.components.create')
                @elseif ($tab == 'edit')
                    @include('admin.product.components.edit')
                @endif
            </div>
            <!-- End of Product Content -->

            <!-- start of Category content -->
            <div class="hidden px-10 rounded-lg h-[80vh] w-full" id="category" role="tabpanel"
                aria-labelledby="category-tab">
                @if ($tab == 'category')
                    @include('admin.product.category')
                @endif
            </div>
            <!-- End of Product Content -->

            <!-- start of Carousel content -->
            <div class="hidden px-10 rounded-lg h-[80vh] w-full" id="carousel" role="tabpanel"
                aria-labelledby="carousel-tab">
                @if ($tab == 'carousel')
                    @include('admin.product.carousel')
                @endif
            </div>
            <!-- End of Product Content -->
        </div>
    </div>
@endsection
