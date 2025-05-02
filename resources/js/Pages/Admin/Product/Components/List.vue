<template>
    <div id="list_product" class="h-full flex flex-col">
        <div class="w-full flex flex-col lg:flex-row items-center">
            <!-- Category Dropdown -->
            <div class="flex flex-row  order-2 lg:order-1 w-full">
                <div class="relative lg:w-2/6">
                    <button @click="toggleDropdown"
                        class="text-black bg-white hover:bg-slate-100 focus:outline-none focus:ring-0 font-semibold rounded-lg text-sm px-5 py-2.5 flex items-center justify-between w-full">
                        <span class="flex-1 text-left">
                            {{ selectedCategory ? selectedCategory.name : 'Category' }}
                        </span>
                        <svg class="w-2.5 h-2.5 ml-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <div v-if="isDropdownOpen"
                        class="z-10 absolute mt-2 bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-[#B7B7B7] dark:text-gray-200">
                            <li>
                                <a href="#" @click.prevent="selectCategory(null)"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">All</a>
                            </li>
                            <li v-for="category in categories" :key="category.id">
                                <a href="#" @click.prevent="selectCategory(category)"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{
                                        category.name }}</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Add Product Button -->
                <Link :href="route('admin.product.create')" class="flex gap-1 ms-3 cursor-pointer order-2 lg:order-1">
                <img src="/img/assets/icon/icon_admin_product_plus.svg" alt="plus icon" class="w-10 h-10" />
                <h2 class="text-black text-md my-auto font-semibold hidden lg:flex">Add Product</h2>
                </Link>
            </div>

            <!-- Search Bar -->
            <div class="mr-auto lg:mr-0 lg:ml-auto order-1 lg:order-2 mb-3 lg:mb-0">
                <form @submit.prevent="filterProducts" class="flex items-center">
                    <input type="hidden" name="category" :value="selectedCategory?.id || ''">
                    <div class="relative flex items-center w-full">
                        <img src="/img/assets/icon/icon_admin_search_searchbar.svg" alt="search icon"
                            class="absolute left-3 w-5 h-5 text-gray-500">
                        <input v-model="searchQuery" type="text" name="search"
                            class="block lg:w-[25vw] pl-10 py-2 text-gray-900 bg-white border border-white rounded-full focus:ring-0 focus:border-none placeholder:text-sm placeholder:text-start"
                            placeholder="Search..." />
                    </div>
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 font-semibold text-white bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] rounded-full -ml-20 z-10">
                        <img class="w-4 h-4 mr-2" style="filter: brightness(0) invert(1)"
                            src="/img/assets/icon/icon_admin_search_searchbar.svg" alt="" />
                        Search
                    </button>
                </form>
            </div>
        </div>

        <!-- Product Cards -->
        <div
            class="w-full h-full mx-auto content-center mt-5 mb-8 grid grid-cols-2 gap-x-1 gap-y-3 md:grid-cols-4 md:gap-x-0 lg:grid-rows-[auto_1fr_auto] lg:grid-cols-7 lg:gap-x-2 lg:gap-y-3">
            <div v-for="product in products" :key="product.id"
                class="bg-white w-[135px] h-[175px] lg:w-40 lg:h-52 rounded-lg overflow-hidden flex flex-col overflow-y-auto">
                <div class="w-full h-[75%] lg:h-2/3 bg-cover bg-top mx-auto"
                    :style="{ backgroundImage: `url(${product.image || 'https://placehold.co/200'})` }" />
                <div class="p-2">
                    <p class="text-sm font-bold truncate">{{ product.name }}</p>
                    <p class="text-sm font-semi">Rp. {{ formatPrice(product.price) }}</p>
                </div>
                <div class="flex mt-auto mx-3 mb-3">
                    <Link :href="route('admin.product.edit', product.id)" class="mr-auto">
                    <img src="/img/assets/icon/icon_admin_product_edit.svg" alt="edit" />
                    </Link>
                    <button @click="openDeleteModal(product.id)" class="ml-auto">
                        <img src="/img/assets/icon/icon_admin_product_trash.svg" alt="delete" />
                    </button>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <Modal :show="showDeleteModal" @close="showDeleteModal = false">
            <div class="bg-white w-[225px] md:w-[325px] lg:w-[33vw] h-auto rounded-[30px] shadow p-4">
                <div class="flex flex-col md:py-2 lg:p-10">
                    <img src="/img/assets/icon/icon_warning.svg" alt="warning" class="w-10 h-10 md:w-[51px] md:h-[51px] lg:w-16 lg:h-16 mx-auto" />
                    <p class="text-[#376F7E] font-medium text-sm lg:text-xl mx-auto mt-2">Are you sure?</p>
                    <p class="text-[#B7B7B7] font-medium text-[10px] lg:text-xs mx-auto mt-2 lg:mt-6">You won’t be able to revert this!</p>
                    <div class="w-full mt-3 lg:mt-6 flex flex-row justify-center">
                        <button @click="confirmDelete"
                            class="w-[86px] md:w-[132px] lg:w-44 h-[22px] md:h-[41px] lg:h-11 bg-[#376F7E] rounded-[20px] shadow-lg text-white text-[10px] md:text-sm lg:text-lg font-semibold">
                            Yes, Delete it!
                        </button>
                        <button @click="showDeleteModal = false"
                            class="w-[86px] md:w-[132px] lg:w-44 h-[22px] md:h-[41px] lg:h-11 bg-[#FF9D66] rounded-[20px] shadow-lg text-white text-[10px] md:text-sm lg:text-lg font-semibold ml-2">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </Modal>

        <!-- Success Delete Modal -->
        <Modal :show="showSuccessModal" @close="showSuccessModal = false">
            <div class="bg-white w-[172px] md:w-[400px] lg:w-[25vw] h-auto rounded-[30px] shadow py-7 md:py-14 lg:p-4">
                <div class="flex flex-col lg:p-14">
                    <h1 class="text-black text-[10px] md:text-xl lg:text-xl font-medium mx-auto">Successfully Deleted!</h1>
                    <img src="/img/assets/icon/icon_green_check.svg" alt="success" class="w-11 h-11 md:h-24 md:w-24 lg:w-24 lg:h-24 mx-auto mt-3 lg:mt-6" />
                </div>
            </div>
        </Modal>
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';
import Modal from './Modal.vue';
import axios from 'axios';

export default {
    components: { Link, Modal },
    setup() {
        // Dummy data
        const categories = ref([
            { id: 1, name: 'Electronics' },
            { id: 2, name: 'Clothing' },
            { id: 3, name: 'Books' },
        ]);
        const products = ref([
            { id: 1, name: 'Smartphone', price: 5000000, image: 'https://placehold.co/200' },
            { id: 2, name: 'T-Shirt', price: 150000, image: 'https://placehold.co/200' },
            { id: 3, name: 'Novel', price: 100000, image: 'https://placehold.co/200' },
            { id: 3, name: 'Novel', price: 100000, image: 'https://placehold.co/200' },
            { id: 3, name: 'Novel', price: 100000, image: 'https://placehold.co/200' },
            { id: 3, name: 'Novel', price: 100000, image: 'https://placehold.co/200' },
            { id: 3, name: 'Novel', price: 100000, image: 'https://placehold.co/200' },
            { id: 3, name: 'Novel', price: 100000, image: 'https://placehold.co/200' },
            { id: 3, name: 'Novel', price: 100000, image: 'https://placehold.co/200' },
            { id: 3, name: 'Novel', price: 100000, image: 'https://placehold.co/200' },
            { id: 3, name: 'Novel', price: 100000, image: 'https://placehold.co/200' },
            { id: 3, name: 'Novel', price: 100000, image: 'https://placehold.co/200' },
            { id: 3, name: 'Novel', price: 100000, image: 'https://placehold.co/200' },
            { id: 3, name: 'Novel', price: 100000, image: 'https://placehold.co/200' },
            { id: 3, name: 'Novel', price: 100000, image: 'https://placehold.co/200' },
            { id: 3, name: 'Novel', price: 100000, image: 'https://placehold.co/200' },
        ]);

        const selectedCategory = ref(null);
        const searchQuery = ref('');
        const isDropdownOpen = ref(false);
        const showDeleteModal = ref(false);
        const showSuccessModal = ref(false);
        const productToDelete = ref(null);

        // Fetch data (placeholder)
        const fetchData = async () => {
            try {
                /*
                const response = await axios.get('/api/admin/products', {
                  params: { category: selectedCategory.value?.id, search: searchQuery.value },
                });
                products.value = response.data.products;
                categories.value = response.data.categories;
                */
            } catch (error) {
                console.error('Error fetching products:', error);
            }
        };

        // Filter products
        const filterProducts = () => {
            // Update URL or fetch filtered data
            fetchData();
        };

        // Dropdown toggle
        const toggleDropdown = () => {
            isDropdownOpen.value = !isDropdownOpen.value;
        };

        // Select category
        const selectCategory = (category) => {
            selectedCategory.value = category;
            isDropdownOpen.value = false;
            filterProducts();
        };

        // Format price
        const formatPrice = (price) => {
            return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        };

        // Delete modal
        const openDeleteModal = (id) => {
            productToDelete.value = id;
            showDeleteModal.value = true;
        };

        const confirmDelete = async () => {
            try {
                /*
                await axios.delete(`/api/admin/products/${productToDelete.value}`);
                products.value = products.value.filter(p => p.id !== productToDelete.value);
                */
                showDeleteModal.value = false;
                showSuccessModal.value = true;
                setTimeout(() => (showSuccessModal.value = false), 2000);
            } catch (error) {
                console.error('Error deleting product:', error);
            }
        };

        onMounted(() => {
            // fetchData();
        });

        return {
            categories,
            products,
            selectedCategory,
            searchQuery,
            isDropdownOpen,
            showDeleteModal,
            showSuccessModal,
            toggleDropdown,
            selectCategory,
            filterProducts,
            formatPrice,
            openDeleteModal,
            confirmDelete,
        };
    },
};
</script>