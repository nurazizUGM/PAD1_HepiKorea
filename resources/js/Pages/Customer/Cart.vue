<script>
import { router } from '@inertiajs/vue3';
import axios from 'axios';
import Layout from '../Layouts/Customer.vue';

export default {
    components: {
        Layout,
    },
    data() {
        return {
            carts: [],
            showDeleteModal: false,
            showSuccessModal: false,
            selectAll: false,
            errorMessage: '', // Added error message state
        }
    },
    computed: {
        totalPrice() {
            return this.carts.reduce((sum, cart) => sum + (cart.selected ? cart.product.price * cart.quantity : 0), 0)
        },
        selectedCount() {
            return this.carts.filter(cart => cart.selected).length;
        }
    },
    methods: {
        async fetchData() {
            try {
                const response = await fetch('/api/cart'); // Ganti dengan endpoint API Anda
                this.carts = await response.json();
                this.errorMessage = ''; // Clear error message on fetch
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        },
        getImageUrl(image) {
            if (image && /^http/.test(image)) return image;
            if (image) return `/storage/${image}`;
            return '/img/example/admin_order_img_phone.png';
        },
        formatPrice(price) {
            return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        },
        toggleSelectAll() {
            this.carts.forEach(cart => (cart.selected = this.selectAll));
            this.errorMessage = ''; // Clear error message when selecting all
        },
        async confirmDelete() {
            await axios.delete('/api/cart', {
                headers: {
                    'Content-Type': 'application/json',
                },
                data: {
                    id: this.carts.filter(cart => cart.selected).map(cart => cart.id),
                },
            })
            await this.fetchData();
            this.showDeleteModal = false;
            this.showSuccessModal = true;
            setTimeout(() => (this.showSuccessModal = false), 2000); // Tutup otomatis setelah 2 detik
        },
        checkout() {
            if (this.selectedCount === 0) {
                this.errorMessage = 'Please select at least one product to proceed to checkout.';
                return;
            }
            this.errorMessage = ''; // Clear error message if proceeding
            const selectedProducts = this.carts.filter(cart => cart.selected).map(cart => ({
                product_id: cart.product.id,
                quantity: cart.quantity,
            }));
            console.log('Checkout data:', selectedProducts);

            router.get('/checkout', {
                products: JSON.stringify(selectedProducts),
            });
        },
    },
    mounted() {
        this.fetchData();
    },
};
</script>

<template>
    <Layout title="Cart">
        <div class="w-full max-w-full h-full rounded-3xl bg-[#EFEFEF] py-2 px-2 md:px-4 lg:px-[50px] relative">
            <h1 class="text-black font-semibold text-lg md:text-2xl text-left">Cart</h1>

            <div
                class="overflow-y-scroll no-scrollbar h-[60vh] md:h-[53vh] lg:h-[50vh] mt-1 md:mt-2 mb-12 md:mb-44 lg:mb-52">
                <!-- Product Card Container -->
                <div
                    class="w-full h-fit grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 md:gap-x-5 gap-y-2 md:gap-y-5 mt-1 md:mt-2 mb-12 relative">
                    <div v-for="cart in carts" :key="cart.id"
                        class="w-full lg:w-[420px] h-full lg:h-[279px] bg-white rounded-2xl flex flex-col p-5 relative mx-auto">
                        <!-- Photo, Name, Price of Product -->
                        <div class="w-full h-[65%] flex flex-row">
                            <!-- Image Container -->
                            <div class="w-[20%] md:w-[35%] h-full">
                                <img :src="getImageUrl(cart.product.image)" alt=""
                                    class="w-14 md:w-full md:h-full object-contain">
                            </div>
                            <!-- Name, Variant, Price -->
                            <div class="w-[60%] md:w-[65%] h-full flex flex-col pl-5">
                                <h1 class="text-[#3E6E7A] font-semibold text-[11px] md:text-base">{{
                                    cart.product.name
                                }}</h1>
                                <h2 class="text-orange-400 font-semibold text-xs md:text-xl lg:text-xl mt-auto">Rp {{
                                    formatPrice(cart.product.price) }}</h2>
                                <h3 class="text-gray-600 text-opacity-50 font-semibold text-[10px] md:text-xs mt-1">x{{
                                    cart.quantity }}</h3>
                                <div class="w-fit h-fit  md:hidden flex flex-row items-center absolute top-1/2 right-2">
                                    <input type="checkbox" v-model="cart.selected"
                                        class="w-3 h-3 rounded-sm outline outline-[#3E6E7A] bg-transparent hover:bg-slate-100 checked:bg-[#3E6E7A] hover:checked:bg-[#37626d] focus:outline-[#3E6E7A] active:ring-[#3E6E7A] focus:border-[#3E6E7A]">
                                    <p class="text-[#3E6E7A] text-[8px] font-semibold ml-2">Add Product</p>
                                </div>
                            </div>
                        </div>

                        <!-- Checkbox -->
                        <div class="w-full h-[45%] hidden md:flex">
                            <div class="w-fit h-fit flex flex-row items-center my-auto ml-7">
                                <input type="checkbox" v-model="cart.selected"
                                    class="w-6 h-6 rounded-sm outline outline-[#3E6E7A] bg-transparent hover:bg-slate-100 checked:bg-[#3E6E7A] hover:checked:bg-[#37626d] focus:outline-[#3E6E7A] active:ring-[#3E6E7A] focus:border-[#3E6E7A]">
                                <p class="text-[#3E6E7A] md:text-sm lg:text-base font-semibold ml-6">Add Product</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Checkout Container -->
                <div
                    class="absolute w-[95%] md:w-[87vw] lg:w-[84.5vw] h-[90px] md:h-[20vh] lg:h-[25vh] bg-white rounded-2xl bottom-4 md:bottom-5 lg:bottom-5 z-10 flex flex-col md:py-5 md:px-10 py-2 px-2">
                    <h1 class="text-black font-semibold text-[8px] md:text-sm lg:text-2xl">Checkout</h1>
                    <div class="w-full h-fit flex flex-row my-auto relative">
                        <!-- Select All and Checkbox Container -->
                        <div class="w-fit h-full flex flex-row">
                            <input type="checkbox" v-model="selectAll" @change="toggleSelectAll"
                                class="w-3 h-3 md:w-6 md:h-6 hover:bg-slate-100 rounded-sm outline outline-[#3E6E7A] bg-transparent checked:bg-[#3E6E7A] hover:checked:bg-[#37626d] focus:outline-[#3E6E7A] active:ring-[#3E6E7A] focus:border-[#3E6E7A] my-auto">
                            <p
                                class="text-black text-opacity-50 font-semibold text-[8px] md:text-xs lg:text-base ml-2 md:ml-6 my-auto">
                                Select All ({{ selectedCount }})
                            </p>
                            <!-- jumlah item yang dipilih tapi cuma muncul di mobile -->
                            <p
                                class="text-black text-opacity-50 font-semibold text-[8px] md:hidden flex absolute top-4 left-5">
                                Total ({{ selectedCount }}) Product
                            </p>
                            <button @click="showDeleteModal = true"
                                class="bg-white hover:bg-slate-100 outline outline-2 outline-[#3E6E7A] rounded-md md:rounded-2xl inline-flex my-auto ml-10 px-2 py-0.5 md:py-1.5 lg:py-2 md:px-8 lg:px-12">
                                <img src="/img/assets/icon/icon_customer_trashcan.svg" alt=""
                                    class="w-[7px] h-[8px] md:w-[14px] md:h-[16px] lg:w-6 lg:h-7 mr-0.5 md:mr-2 my-auto">
                                <p class="text-[#3E6E7A] font-semibold text-[8px] md:text-xs lg:text-xl">Delete</p>
                            </button>
                        </div>
                        <!-- Text Count Total Product -->
                        <p
                            class="text-black text-opacity-50 font-semibold text-[8px] md:text-xs lg:text-base mx-auto lg:ml-auto lg:mr-2 my-auto hidden md:flex">
                            Total ({{ selectedCount }}) Product
                        </p>
                        <!-- Total Price -->
                        <h1
                            class="text-orange-400 font-semibold text-[10px] md:text-sm lg:text-2xl ml-12 md:ml-16 my-auto">
                            Rp {{ formatPrice(totalPrice) }},-
                        </h1>
                    </div>
                    <!-- Error Message -->
                    <p v-if="errorMessage" id="errorMessageCheckoutZeroProductSelected" class="text-red-500 text-[8px] md:text-xs lg:text-sm font-semibold mt-2.5 lg:mt-2">
                        {{ errorMessage }}
                    </p>
                    <form @submit.prevent="checkout" class="ml-auto">
                        <button type="submit"
                            class="w-fit bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white text-[8px] md:text-xs lg:text-2xl font-semibold rounded-md md:rounded-2xl py-0.5 md:py-2 md:px-7 lg:px-10 ml-auto">
                            Checkout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div v-if="showDeleteModal" class="fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-50">
            <div class="bg-white w-[33vw] h-auto rounded-[30px] shadow p-4">
                <div class="flex flex-col px-10 py-10">
                    <img src="/img/assets/icon/icon_warning.svg" alt="icon_warning" class="w-16 h-16 mx-auto">
                    <p class="text-[#376F7E] font-medium text-xl mx-auto mt-2">Are you sure?</p>
                    <p class="text-[#B7B7B7] font-medium text-xs mx-auto mt-6">You won’t be able to revert this!</p>
                    <div class="w-full h-full mt-6 flex flex-row justify-center">
                        <button @click="confirmDelete"
                            class="w-44 h-11 bg-[#376F7E] rounded-[20px] shadow-lg text-white text-lg font-semibold">
                            Yes, Delete it!
                        </button>
                        <button @click="showDeleteModal = false"
                            class="w-44 h-11 bg-[#FF9D66] rounded-[20px] shadow-lg text-white text-lg font-semibold ml-2">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Delete Modal -->
        <div v-if="showSuccessModal" class="fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-50">
            <div class="bg-white w-[25vw] h-auto rounded-[30px] shadow p-14">
                <h1 class="text-black text-xl font-medium mx-auto">Successfully Deleted!</h1>
                <img src="/img/assets/icon/icon_green_check.svg" alt="green_check" class="w-24 h-24 mx-auto mt-6">
            </div>
        </div>
    </Layout>
</template>

<style scoped>
.no-scrollbar::-webkit-scrollbar {
    display: none;
}

.no-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>
