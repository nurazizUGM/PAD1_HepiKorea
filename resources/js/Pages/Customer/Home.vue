<!-- <script setup>
import Layout from '../Layouts/Customer.vue';
import { ref, onMounted } from 'vue';
import axios from 'axios';

const lineUrl = ref('');
const carousels = ref([]);
const categories = ref([]);
const newProducts = ref([]);
const popularProducts = ref([]);

const getMediaComponent = (carousel) => {
    // Return the appropriate media component based on the media type
    if (carousel.media_type === 'image') {
        return 'ImageComponent'; // Replace with your image component
    } else if (carousel.media_type === 'video') {
        return 'VideoComponent'; // Replace with your video component
    } else if (carousel.media_type === 'youtube') {
        return 'YouTubeComponent'; // Replace with your YouTube component
    }
    return null;
};

const getCategoryIcon = (category) => {
    // Logic to get category icon
    return category.icon || require('@/assets/icon/icon_homepage_category_fashion.png');
};

const getProductImage = (product) => {
    // Logic to get product image
    return product.image || 'https://placehold.co/200';
};

const formatPrice = (price) => {
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(price);
};

const goToCategory = (categoryId) => {
    // Logic to navigate to category
    window.location.href = `/product?category=${categoryId}`;
};

const goToProduct = (productId) => {
    // Logic to navigate to product
    window.location.href = `/product/${productId}`;
};

const scroll = (type, direction) => {
    const container = document.getElementById(`${type}-container`);
    const scrollAmount = direction === 'right' ? 400 : -400;
    container.scrollBy({ top: 0, left: scrollAmount, behavior: 'smooth' });
};

onMounted(async () => {
    // Fetch data from your API or endpoint
    // const settingsResponse = await axios.get('/api/settings');
    // lineUrl.value = settingsResponse.data.line;

    const carouselsResponse = await axios.get('https://hepikorea.pad19.me/api/carousel');
    carousels.value = carouselsResponse.data;
    console.log("mantap")

    const categoriesResponse = await axios.get('https://hepikorea.pad19.me/api/category');
    categories.value = categoriesResponse.data;

    const newProductsResponse = await axios.get('https://hepikorea.pad19.me/api/product/latest');
    newProducts.value = newProductsResponse.data;

    const popularProductsResponse = await axios.get('https://hepikorea.pad19.me/api/product/popular');
    popularProducts.value = popularProductsResponse.data;

    console.log('Home component mounted');
});
</script>

<template>
    <Layout title="Home">
        <div>
            <a :href="lineUrl" target="_blank"
                class="fixed flex flex-row bottom-8 right-8 px-2 py-2 text-base md:text-2xl font-bold text-[#3E6E7A] bg-white rounded-3xl align-middle items-center shadow-md hover:shadow-lg z-30">
                <img src="/img/assets/icon/icon_customer_chat.svg" alt="icon_Chat" class="w-5 h-5 md:w-10 md:h-10 mr-1">
                <p>Chat</p>
            </a>

            <div class="w-full w-max[100%] rounded-3xl bg-[#EFEFEF] shadow-lg overflow-hidden">
                <div id="default-carousel" class="relative w-full rounded-t-2xl md:rounded-t-3xl">
                    <div class="relative h-[150px] md:h-[500px] overflow-hidden rounded-t-lg">
                        <div v-for="(carousel, index) in carousels" :key="index" class="hidden duration-700 ease-in-out"
                            data-carousel-item>
                            <div
                                class="w-full h-full flex flex-row absolute -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                <div class="w-1/2 h-full flex flex-col bg-[#3E6E7A] p-2 md:p-20 text-white">
                                    <h1 class="text-md md:text-5xl font-semibold">{{ carousel.title }}</h1>
                                    <h2 class="text-xs md:text-2xl font-medium mt-1 md:mt-8">{{ carousel.description }}
                                    </h2>
                                </div>
                                <div class="w-1/2 h-full flex bg-white">
                                    <component :is="getMediaComponent(carousel)" :media="carousel.media" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="absolute z-30 flex -translate-x-1/2 bottom-4 left-1/2 space-x-3 rtl:space-x-reverse scale-50 md:scale-100">
                        <button v-for="(carousel, index) in carousels" :key="index" type="button"
                            class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide {{ index + 1 }}"
                            data-carousel-slide-to="{{ index }}"></button>
                    </div>
                    <button type="button"
                        class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none scale-50 md:scale-100"
                        data-carousel-prev>
                        <span
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 shadow-xl group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white">
                            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M5 1 1 5l4 4" />
                            </svg>
                            <span class="sr-only">Previous</span>
                        </span>
                    </button>
                    <button type="button"
                        class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none scale-50 md:scale-100"
                        data-carousel-next>
                        <span
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 shadow-xl group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white">
                            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="sr-only">Next</span>
                        </span>
                    </button>
                </div>

                <div class="w-full flex flex-col py-5 md:py-10 px-4 md:px-12">
                    <div class="w-fit md:w-1/5 bg-white rounded-xl text-center py-2 px-4 md:px-0">
                        <h1 class="text-[#3E6E7A] text-sm md:text-lg font-semibold">Category</h1>
                    </div>
                    <div class="grid grid-cols-4 gap-x-3 gap-y-3 md:gap-x-32 md:gap-y-20 mt-4 md:mt-14">
                        <div v-for="(category, index) in categories" :key="index"
                            class="bg-[#FFFCFC] h-24 md:h-52 flex flex-col text-center align-middle justify-center rounded-xl cursor-pointer"
                            @click="goToCategory(category.id)">
                            <img :src="getCategoryIcon(category)" alt="fashion_Category"
                                class="w-12 h-12 md:w-40 md:h-40 mx-auto">
                            <h2 class="text-black text-[10px] md:text-lg font-semibold text-ellipsis overflow-hidden">{{
                                category.name }}</h2>
                        </div>
                    </div>

                    <div class="w-fit md:w-1/5 bg-white rounded-xl text-center py-2 px-4 md:px-0 mt-4 md:mt-14">
                        <h1 class="text-[#3E6E7A] text-sm md:text-lg font-semibold">New Arrival</h1>
                    </div>

                    <div class="relative mt-5 md:mt-10">
                        <div class="overflow-x-auto no-scrollbar" id="new-arrival-container">
                            <button @click="scroll('newArrival', 'right')"
                                class="absolute top-1/2 right-0 transform -translate-y-1/2 z-10 bg-orange-400 bg-opacity-50 hover:bg-opacity-80 text-white rounded-full p-2 shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                            <button @click="scroll('newArrival', 'left')"
                                class="absolute top-1/2 left-0 transform -translate-y-1/2 z-10 bg-orange-400 bg-opacity-50 hover:bg-opacity-80 text-white rounded-full p-2 shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 rotate-180" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>

                            <div class="grid grid-flow-col auto-cols-[125px] md:auto-cols-[175px] gap-x-5 md:gap-x-14">
                                <div v-for="(product, index) in newProducts" :key="index"
                                    class="bg-white h-[200px] md:h-[250px] flex flex-col rounded-xl overflow-hidden cursor-pointer"
                                    @click="goToProduct(product.id)">
                                    <div :style="{ backgroundImage: `url(${getProductImage(product)})` }"
                                        class="w-full h-4/6 bg-cover bg-no-repeat bg-center"></div>
                                    <div class="w-full h-2/6 py-0.5 px-1.5 flex flex-col">
                                        <h1
                                            class="text-xs md:text-sm text-[#3E6E7A] font-semibold text-nowrap text-ellipsis truncate overflow-hidden">
                                            {{ product.name }}</h1>
                                        <h2
                                            class="text-[10px] md:text-xs font-semibold text-black text-opacity-50 text-ellipsis overflow-hidden">
                                            {{ product.category }}</h2>
                                        <h3
                                            class="text-[10px] md:text-xs ml-auto text-orange-400 font-semibold text-ellipsis overflow-hidden">
                                            Rp {{ formatPrice(product.price) }}</h3>
                                        <button
                                            class="ml-auto my-auto bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] rounded-xl text-white px-2 md:px-4 md:py-0.5 text-[10px] md:text-xs">Buy</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w-fit md:w-1/5 bg-white rounded-xl text-center py-2 px-4 md:px-0 mt-4 md:mt-14">
                        <h1 class="text-[#3E6E7A] text-sm md:text-lg font-semibold">Best Seller</h1>
                    </div>

                    <div class="relative mt-5 md:mt-10">
                        <div class="overflow-x-auto no-scrollbar" id="best-seller-container">
                            <button @click="scroll('bestSeller', 'right')"
                                class="absolute top-1/2 right-0 transform -translate-y-1/2 z-10 bg-orange-400 bg-opacity-50 hover:bg-opacity-80 text-white rounded-full p-2 shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                            <button @click="scroll('bestSeller', 'left')"
                                class="absolute top-1/2 left-0 transform -translate-y-1/2 z-10 bg-orange-400 bg-opacity-50 hover:bg-opacity-80 text-white rounded-full p-2 shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 rotate-180" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>

                            <div class="grid grid-flow-col auto-cols-[125px] md:auto-cols-[175px] gap-x-5 md:gap-x-14">
                                <div v-for="(product, index) in popularProducts" :key="index"
                                    class="bg-white h-[200px] md:h-[250px] flex flex-col rounded-xl overflow-hidden cursor-pointer"
                                    @click="goToProduct(product.id)">
                                    <div :style="{ backgroundImage: `url(${getProductImage(product)})` }"
                                        class="w-full h-4/6 bg-cover bg-no-repeat bg-center"></div>
                                    <div class="w-full h-2/6 py-0.5 px-1.5 flex flex-col">
                                        <h1
                                            class="text-xs md:text-sm text-[#3E6E7A] font-semibold text-nowrap text-ellipsis truncate overflow-hidden">
                                            {{ product.name }}</h1>
                                        <h2
                                            class="text-[10px] md:text-xs font-semibold text-black text-opacity-50 text-ellipsis overflow-hidden">
                                            {{ product.category }}</h2>
                                        <h3
                                            class="text-[10px] md:text-xs ml-auto text-orange-400 font-semibold text-ellipsis overflow-hidden">
                                            Rp {{ formatPrice(product.price) }}</h3>
                                        <button
                                            class="ml-auto my-auto bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] rounded-xl text-white px-2 md:px-4 md:py-0.5 text-[10px] md:text-xs">Buy</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template> -->

<template>
    <Layout title="Home">
        <div>
            <!-- Chat Button -->
            <a :href="lineUrl" target="_blank"
                class="fixed flex flex-row bottom-8 right-8 px-2 py-2 text-base md:text-2xl font-bold text-[#3E6E7A] bg-white rounded-3xl items-center shadow-md hover:shadow-lg z-30">
                <img src="/img/assets/icon/icon_customer_chat.svg" alt="icon_Chat" class="w-5 h-5 md:w-10 md:h-10 mr-1">
                <p>Chat</p>
            </a>

            <!-- Homepage Content Container -->
            <div class="w-full max-w-full rounded-3xl bg-[#EFEFEF] shadow-lg overflow-hidden">
                <!-- Carousel -->
                <div id="default-carousel" class="relative w-full rounded-t-2xl md:rounded-t-3xl" data-carousel="slide">
                    <div class="relative h-[150px] md:h-[500px] overflow-hidden rounded-t-lg">
                        <div v-for="(carousel, index) in carousels" :key="index" class="hidden duration-700 ease-in-out"
                            data-carousel-item>
                            <div
                                class="w-full h-full flex flex-row absolute -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                <div class="w-1/2 h-full flex flex-col bg-[#3E6E7A] p-2 md:p-20 text-white">
                                    <h1 class="text-md md:text-5xl font-semibold">{{ carousel.title }}</h1>
                                    <h2 class="text-xs md:text-2xl font-medium mt-1 md:mt-8">{{ carousel.description }}
                                    </h2>
                                </div>
                                <div class="w-1/2 h-full flex bg-white">
                                    <template v-if="carousel.media_type === 'image'">
                                        <img :src="getMediaUrl(carousel.media)" alt=""
                                            class="w-full h-full object-contain">
                                    </template>
                                    <template v-else-if="carousel.media_type === 'video'">
                                        <video class="w-full h-full object-contain" controls autoplay muted loop>
                                            <source :src="getMediaUrl(carousel.media)" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </template>
                                    <template v-else-if="carousel.media_type === 'youtube'">
                                        <iframe class="w-full h-full" :src="carousel.media" title="YouTube video player"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Slider Indicators -->
                    <div class="absolute z-30 flex -translate-x-1/2 bottom-4 left-1/2 space-x-3 scale-50 md:scale-100">
                        <button v-for="(_, index) in carousels" :key="index" type="button" class="w-3 h-3 rounded-full"
                            :aria-current="true" :data-carousel-slide-to="index"></button>
                    </div>
                    <!-- Slider controls -->
                    <button type="button"
                        class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none scale-50 md:scale-100"
                        data-carousel-prev>
                        <span
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 shadow-xl group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white">
                            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M5 1 1 5l4 4" />
                            </svg>
                            <span class="sr-only">Previous</span>
                        </span>
                    </button>
                    <button type="button"
                        class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none scale-50 md:scale-100"
                        data-carousel-next>
                        <span
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 shadow-xl group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white">
                            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="sr-only">Next</span>
                        </span>
                    </button>
                </div>

                <!-- Categories, Recent, Best Seller Container -->
                <div class="w-full flex flex-col py-5 md:py-10 px-4 md:px-12">
                    <!-- Categories -->
                    <div class="w-fit md:w-1/5 bg-white rounded-xl text-center py-2 px-4 md:px-0">
                        <h1 class="text-[#3E6E7A] text-sm md:text-lg font-semibold">Category</h1>
                    </div>
                    <div class="grid grid-cols-4 gap-x-3 gap-y-3 md:gap-x-32 md:gap-y-20 mt-4 md:mt-14">
                        <div v-for="category in categories" :key="category.id"
                            class="bg-[#FFFCFC] h-24 md:h-52 flex flex-col text-center justify-center rounded-xl cursor-pointer"
                            @click="$inertia.get(route('product.index', { category: category.id }))">
                            <img :src="getCategoryIcon(category.icon)" alt="category"
                                class="w-12 h-12 md:w-40 md:h-40 mx-auto">
                            <h2 class="text-black text-[10px] md:text-lg font-semibold text-ellipsis overflow-hidden">{{
                                category.name
                                }}</h2>
                        </div>
                    </div>

                    <!-- New Arrival -->
                    <div class="w-fit md:w-1/5 bg-white rounded-xl text-center py-2 px-4 md:px-0 mt-4 md:mt-14">
                        <h1 class="text-[#3E6E7A] text-sm md:text-lg font-semibold">New Arrival</h1>
                    </div>
                    <div class="relative mt-5 md:mt-10">
                        <div class="overflow-x-auto no-scrollbar" ref="newArrivalContainer">
                            <button @click="scrollLeft('newArrivalContainer')"
                                class="absolute top-1/2 left-0 transform -translate-y-1/2 z-10 bg-orange-400 bg-opacity-50 hover:bg-opacity-80 text-white rounded-full p-2 shadow-lg">
                                <svg class="h-6 w-6 rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                            <button @click="scrollRight('newArrivalContainer')"
                                class="absolute top-1/2 right-0 transform -translate-y-1/2 z-10 bg-orange-400 bg-opacity-50 hover:bg-opacity-80 text-white rounded-full p-2 shadow-lg">
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                            <div class="grid grid-flow-col auto-cols-[125px] md:auto-cols-[175px] gap-x-5 md:gap-x-14">
                                <div v-for="product in newProducts" :key="product.id"
                                    class="bg-white h-[200px] md:h-[250px] flex flex-col rounded-xl overflow-hidden cursor-pointer"
                                    @click="$inertia.get(route('product.show', product.id))">
                                    <div class="w-full h-4/6 bg-cover bg-no-repeat bg-center"
                                        :style="{ backgroundImage: `url(${getProductImage(product)})` }"></div>
                                    <div class="w-full h-2/6 py-0.5 px-1.5 flex flex-col">
                                        <h1
                                            class="text-xs md:text-sm text-[#3E6E7A] font-semibold text-nowrap text-ellipsis truncate overflow-hidden">
                                            {{ product.name }}
                                        </h1>
                                        <h2
                                            class="text-[10px] md:text-xs font-semibold text-black text-opacity-50 text-ellipsis overflow-hidden">
                                            {{ product.category }}
                                        </h2>
                                        <h3
                                            class="text-[10px] md:text-xs ml-auto text-orange-400 font-semibold text-ellipsis overflow-hidden">
                                            Rp {{ formatPrice(product.price) }}
                                        </h3>
                                        <a href="#" class="ml-auto my-auto">
                                            <button
                                                class="bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] rounded-xl text-white px-2 md:px-4 md:py-0.5 text-[10px] md:text-xs">
                                                Buy
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Best Seller -->
                    <div class="w-fit md:w-1/5 bg-white rounded-xl text-center py-2 px-4 md:px-0 mt-4 md:mt-14">
                        <h1 class="text-[#3E6E7A] text-sm md:text-lg font-semibold">Best Seller</h1>
                    </div>
                    <div class="relative mt-5 md:mt-10">
                        <div class="overflow-x-auto no-scrollbar" ref="bestSellerContainer">
                            <button @click="scrollLeft('bestSellerContainer')"
                                class="absolute top-1/2 left-0 transform -translate-y-1/2 z-10 bg-orange-400 bg-opacity-50 hover:bg-opacity-80 text-white rounded-full p-2 shadow-lg">
                                <svg class="h-6 w-6 rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                            <button @click="scrollRight('bestSellerContainer')"
                                class="absolute top-1/2 right-0 transform -translate-y-1/2 z-10 bg-orange-400 bg-opacity-50 hover:bg-opacity-80 text-white rounded-full p-2 shadow-lg">
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                            <div class="grid grid-flow-col auto-cols-[125px] md:auto-cols-[175px] gap-x-5 md:gap-x-14">
                                <div v-for="product in popularProducts" :key="product.id"
                                    class="bg-white h-[200px] md:h-[250px] flex flex-col rounded-xl overflow-hidden cursor-pointer"
                                    @click="$inertia.get(route('product.show', product.id))">
                                    <div class="w-full h-4/6 bg-cover bg-no-repeat bg-center"
                                        :style="{ backgroundImage: `url(${getProductImage(product)})` }"></div>
                                    <div class="w-full h-2/6 py-0.5 px-1.5 flex flex-col">
                                        <h1
                                            class="text-xs md:text-sm text-[#3E6E7A] font-semibold text-nowrap text-ellipsis truncate overflow-hidden">
                                            {{ product.name }}
                                        </h1>
                                        <h2
                                            class="text-[10px] md:text-xs font-semibold text-black text-opacity-50 text-ellipsis overflow-hidden">
                                            {{ product.category }}
                                        </h2>
                                        <h3
                                            class="text-[10px] md:text-xs ml-auto text-orange-400 font-semibold text-ellipsis overflow-hidden">
                                            Rp {{ formatPrice(product.price) }}
                                        </h3>
                                        <a href="#" class="ml-auto my-auto">
                                            <button
                                                class="bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] rounded-xl text-white px-2 md:px-4 md:py-0.5 text-[10px] md:text-xs">
                                                Buy
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script>
import { ref, onMounted } from 'vue';
import Layout from '../Layouts/Customer.vue';
import { Carousel, initFlowbite } from 'flowbite'; // Impor Flowbite

export default {
    components: {
        Layout,
    },
    props: {
        lineUrl: String,
    },
    setup() {
        const carousels = ref([]);
        const categories = ref([]);
        const newProducts = ref([]);
        const popularProducts = ref([]);
        const newArrivalContainer = ref(null);
        const bestSellerContainer = ref(null);

        // Fetch data from API
        const fetchData = async () => {
            try {
                const [carouselRes, categoryRes, newProductsRes, popularProductsRes] = await Promise.all([
                    fetch('https://hepikorea.pad19.me/api/carousel'),
                    fetch('https://hepikorea.pad19.me/api/category'),
                    fetch('https://hepikorea.pad19.me/api/product/latest'),
                    fetch('https://hepikorea.pad19.me/api/product/popular'),
                ]);

                carousels.value = await carouselRes.json();
                categories.value = await categoryRes.json();
                newProducts.value = await newProductsRes.json();
                popularProducts.value = await popularProductsRes.json();

                // Inisialisasi carousel setelah data tersedia
                initCarousel();
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        };

        // Media URL handler
        const getMediaUrl = (media) => {
            if (/^http/.test(media)) return media;
            return `/storage/${media}` || '/img/assets/bg/background_auth.svg';
        };

        // Category icon handler
        const getCategoryIcon = (icon) => {
            if (/^http/.test(icon)) return icon;
            return `/storage/${icon}` || '/img/assets/icon/icon_homepage_category_fashion.png';
        };

        // Product image handler
        const getProductImage = (product) => {
            const image = product.images?.[0]?.path;
            if (/^http/.test(image)) return image;
            return `/storage/${image}` || 'https://placehold.co/200';
        };

        // Price formatting
        const formatPrice = (price) => {
            return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        };

        // Scroll functions
        const scrollRight = (containerRef) => {
            const container = containerRef === 'newArrivalContainer' ? newArrivalContainer.value : bestSellerContainer.value;
            container.scrollBy({ left: 400, behavior: 'smooth' });
        };

        const scrollLeft = (containerRef) => {
            const container = containerRef === 'newArrivalContainer' ? newArrivalContainer.value : bestSellerContainer.value;
            container.scrollBy({ left: -400, behavior: 'smooth' });
        };

        // Inisialisasi carousel
        const initCarousel = () => {
            const carouselElement = document.getElementById('default-carousel');
            if (carouselElement && carousels.value.length > 0) {
                new Carousel(carouselElement, {
                    interval: 5000, // Otomatis berganti setiap 5 detik (opsional)
                });
            }
        };

        onMounted(() => {
            fetchData();
            // Inisialisasi Flowbite (opsional, tergantung konfigurasi Anda)
            initFlowbite();
        });

        return {
            carousels,
            categories,
            newProducts,
            popularProducts,
            newArrivalContainer,
            bestSellerContainer,
            getMediaUrl,
            getCategoryIcon,
            getProductImage,
            formatPrice,
            scrollRight,
            scrollLeft,
        };
    },
};
</script>

<style>
.no-scrollbar::-webkit-scrollbar {
    display: none;
}

.no-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>