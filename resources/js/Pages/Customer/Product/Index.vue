<script setup>
import { Link } from '@inertiajs/vue3';
import { computed, onMounted, reactive, ref, watch } from 'vue';
import Layout from '../../Layouts/Customer.vue';

const categories = ref([]);
const products = ref([]);
const dropdowns = ref({ category: false, sortBy: false });

// get query params
const urlParams = new URLSearchParams(window.location.search);
const params = reactive({
    category: urlParams.get('category') || '',
    min_price: urlParams.get('min_price') || '',
    max_price: urlParams.get('max_price') || '',
    sort_by: urlParams.get('sort_by') || '',
    page: urlParams.get('page') || 1,
    per_page: urlParams.get('per_page') || 12,
});

// Ambil daftar kategori
const fetchCategories = async () => {
    try {
        const res = await fetch('/api/category');
        categories.value = await res.json();
    } catch (error) {
        console.error('Failed to fetch categories', error);
    }
};

// Ambil daftar produk dengan parameter
const fetchProducts = async () => {
    try {
        const url = new URL(window.location.href);
        for (const k in params) { url.searchParams.set(k, params[k]); }
        window.history.pushState({}, '', url);

        const res = await fetch(`/api/product?${url.searchParams.toString()}`);
        const data = await res.json();
        products.value = data.data.map(product => ({
            ...product,
            category: product.category.name,
            image: product.images.length > 0 ? `/storage/${product.images[0].path}` : '/img/default_product.jpg',
        }));
    } catch (error) {
        console.error('Failed to fetch products', error);
    }
};

// Menampilkan nama kategori yang dipilih
const selectedCategoryName = computed(() => {
    const category = categories.value.find(cat => cat.id === params.category);
    return category ? category.name : 'Category';
});

// Menampilkan teks untuk dropdown sort
const sortByDisplay = computed(() => {
    switch (params.sort_by) {
        case 'lowest_price':
            return 'Lowest Price';
        case 'highest_price':
            return 'Highest Price';
        case 'most_ordered':
            return 'Most Ordered';
        default:
            return 'Sort By';
    }
});

// Mengubah status dropdown
const toggleDropdown = (dropdown) => {
    dropdowns.value[dropdown] = !dropdowns.value[dropdown];
};

// Memilih kategori
const selectCategory = (categoryId) => {
    params.category = categoryId;
    dropdowns.value.category = false; // Menutup dropdown setelah memilih
};

// Memilih sorting
const selectSortBy = (sortOption) => {
    params.sort_by = sortOption;
    dropdowns.value.sortBy = false; // Menutup dropdown setelah memilih
};

// Format harga ke IDR
const formatPrice = (price) => new Intl.NumberFormat('id-ID').format(price);

onMounted(() => {
    // Memanggil fungsi untuk mengambil kategori saat komponen dimuat
    fetchCategories();
    // Memanggil fungsi untuk mengambil produk saat komponen dimuat
    fetchProducts();
});

watch(params, () => {
    fetchProducts(); // Memanggil fungsi untuk mengambil produk saat parameter berubah
});
</script>

<template>
    <Layout title="Products">
        <div
            class="fixed bottom-8 right-8 flex flex-row px-2 py-2 text-base md:text-2xl font-bold text-[#3E6E7A] bg-white rounded-3xl items-center shadow-md hover:shadow-lg z-30">
            <img src="/img/assets/icon/icon_customer_chat.svg" alt="icon_Chat" class="w-5 h-5 md:w-10 md:h-10 mr-1" />
            <p>Chat</p>
        </div>

        <div
            class="w-full md:w-max[100%] min-h-[600px] h-full flex flex-col rounded-3xl bg-[#EFEFEF] shadow-lg overflow-hidden py-5 lg:py-10 px-1 lg:px-14">
            <div class="w-auto md:w-full flex flex-row mb-5 mx-auto md:mx-0 gap-2 justify-around relative">
                <button id="dropdownCategoryButton" @click="toggleDropdown('category')"
                    class="text-[#3E6E7A] bg-white focus:ring-0 focus:outline-none flex justify-between rounded-xl text-xs md:text-base px-2 lg:px-5 lg:py-2.5 text-center font-semibold items-center ml-0 md:mx-0 md:my-auto w-16 md:w-40 lg:w-44 lg:h-10 md:h-8 group"
                    type="button">
                    <span class="text-left text-[10px] md:text-xs lg:text-lg">{{ selectedCategoryName }}</span>
                    <svg class="w-2.5 h-2.5 md:ml-10 text-black group-focus:rotate-180 transition duration-200"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>

                <!-- Dropdown menu -->
                <div v-if="dropdowns.category"
                    class="absolute z-10 bg-white divide-y divide-gray-100 rounded-lg shadow w-16 md:w-28 lg:w-48 left-0 top-12 mt-1">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                        <li @click="selectCategory('')">
                            <a href="#"
                                class="block px-4 py-2 text-[10px] md:text-xs lg:text-lg hover:bg-gray-100">All</a>
                        </li>
                        <li v-for="category in categories" :key="category.id" @click="selectCategory(category.id)">
                            <a href="#" class="block px-4 py-2 text-[10px] md:text-xs lg:text-lg hover:bg-gray-100">{{
                                category.name
                                }}</a>
                        </li>
                    </ul>
                </div>


                <input type="number" v-model="params.min_price" placeholder="Minimum Price"
                    class="rounded-2xl bg-gray-300 border-none text-xs md:text-base placeholder:text-[8px] md:placeholder:text-base focus:border-0 focus:ring-0 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none w-16 md:w-40 lg:w-60 lg:h-10 md:h-7 my-auto ml-auto lg:ml-10" />
                <input type="number" v-model="params.max_price" placeholder="Maximum Price"
                    class="rounded-2xl bg-gray-300 border-none text-xs md:text-base placeholder:text-[8px] md:placeholder:text-base focus:border-0 focus:ring-0 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none w-16 md:w-40 lg:w-60 lg:h-10 md:h-7 my-auto ml-0 lg:ml-6" />

                <button id="dropdownSortByButton" @click="toggleDropdown('sortBy')"
                    class="text-[#3E6E7A] bg-white focus:ring-0 focus:outline-none flex justify-between rounded-xl text-xs md:text-base px-2 lg:px-5 lg:py-2.5 text-center font-semibold items-center md:mx-0 md:my-auto md:ml-auto w-16 md:w-28 lg:w-48 md:h-8 lg:h-10"
                    type="button">
                    <span class="text-left text-[10px] md:text-xs lg:text-lg">{{ sortByDisplay }}</span>
                    <svg class="w-2.5 h-2.5 ml-auto text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>

                <!-- Dropdown menu -->
                <div v-if="dropdowns.sortBy"
                    class="absolute z-10 bg-white divide-y divide-gray-100 rounded-lg shadow w-16 md:w-28 lg:w-48 right-0 top-12 mt-1">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                        <li @click="selectSortBy('')">
                            <a href="#" class="block px-4 py-2 text-[10px] md:text-xs lg:text-lg hover:bg-gray-100">Sort
                                By</a>
                        </li>
                        <li @click="selectSortBy('highest_price')">
                            <a href="#"
                                class="block px-4 py-2 text-[10px] md:text-xs lg:text-lg hover:bg-gray-100">Highest
                                Price</a>
                        </li>
                        <li @click="selectSortBy('lowest_price')">
                            <a href="#"
                                class="block px-4 py-2 text-[10px] md:text-xs lg:text-lg hover:bg-gray-100">Lowest
                                Price</a>
                        </li>
                        <li @click="selectSortBy('most_ordered')">
                            <a href="#" class="block px-4 py-2 text-[10px] md:text-xs lg:text-lg hover:bg-gray-100">Most
                                Ordered</a>
                        </li>
                    </ul>
                </div>
            </div>


            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-2">
                <div v-for="product in products" :key="product.id"
                    class="bg-white rounded-xl px-2 pb-1 cursor-pointer flex flex-col">
                    <Link :href="'/Customer/Product/Show/' + product.id">
                    <div class="w-full h-40 bg-cover bg-top" :style="{ backgroundImage: `url(${product.image})` }">
                    </div>
                    <h1 class="text-[#3E6E7A] text-sm font-semibold">{{ product.name }}</h1>
                    <h2 class="text-xs font-semibold text-black text-opacity-50">{{ product.category }}</h2>
                    <h3 class="text-xs text-orange-400 font-semibold ml-auto">Rp {{ formatPrice(product.price) }}</h3>
                    <button class="bg-[#3E6E7A] text-white rounded-xl px-4 py-1 text-xs ml-auto">Buy</button>
                    </Link>
                </div>
            </div>
        </div>
    </Layout>
</template>
