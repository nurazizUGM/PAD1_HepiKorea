<template>
    <Layout title="Request Order">
        <!-- Chat Button -->
        <a href=""
            class="fixed flex flex-row bottom-8 right-8 px-2 py-2 text-base md:text-2xl font-bold text-[#3E6E7A] bg-white rounded-3xl items-center shadow-md hover:shadow-lg z-30">
            <img src="/img/assets/icon/icon_customer_chat.svg" alt="icon_Chat" class="w-5 h-5 md:w-10 md:h-10 mr-1">
            <p>Chat</p>
        </a>

        <!-- Main Content -->
        <div class="w-full max-w-full rounded-3xl bg-[#EFEFEF] shadow-md overflow-hidden py-3 md:py-6 px-3 md:px-6">
            <!-- Welcome Container -->
            <div class="bg-white w-full flex flex-col rounded-xl pt-2 md:pt-4 pb-4 md:pb-8 px-4 md:px-8">
                <h1 class="text-lg md:text-xl lg:text-2xl font-bold">Welcome!</h1>
                <p class="font-semibold text-xs md:text-xs lg:text-lg">
                    Once you've selected your items from your preferred Korean store, complete this form to place your
                    custom order and let us handle the rest.
                </p>
                <p class="font-semibold text-xs md:text-xs lg:text-lg mt-2 lg:mt-8">
                    Not sure where to look beyond HepiKorea? Feel free to use our search engine to explore other Korean
                    stores. Say goodbye to hopping between websites!
                </p>
            </div>

            <!-- Step of Request Order & Customer Details -->
            <div class="w-full bg-white flex-col rounded-xl mt-6 py-2 md:py-6 px-2 md:px-8">
                <h1 class="text-center text-xs md:text-base lg:text-4xl text-black font-bold mb-1 md:mb-5">Step of
                    Request Order</h1>

                <!-- Steps Container -->
                <div class="w-full flex flex-col">
                    <div class="flex flex-col md:flex-row h-1/2">
                        <div class="w-full md:w-1/2 h-full flex p-2">
                            <div
                                class="w-full md:w-fit h-fit bg-white rounded-xl mr-auto shadow-lg hover:shadow-xl my-auto flex py-2 md:py-10 pl-2.5 md:pl-5 pr-2.5 md:pr-16">
                                <div
                                    class="text-[#3E6E7A] text-[10px] md:text-xs lg:text-lg font-semibold mr-auto md:m-auto flex flex-row">
                                    <h1 class="text-[30px] md:text-[64px] lg:text-[96px] font-bold">1</h1>
                                    <h1 class="ml-2 my-auto">Complete Customer Detail</h1>
                                </div>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 h-full flex p-2">
                            <div
                                class="hidden w-full md:w-fit h-fit bg-[#3E6E7A] rounded-xl mr-auto shadow-lg hover:shadow-xl my-auto md:flex py-2 md:py-10 pl-2.5 md:pl-5 pr-2.5 md:pr-20">
                                <div
                                    class="text-white text-[10px] md:text-xs lg:text-lg font-semibold m-auto flex flex-row">
                                    <h1 class="text-[30px] md:text-[64px] lg:text-[96px] font-bold">3</h1>
                                    <h1 class="ml-2 my-auto">Confirm the product</h1>
                                </div>
                            </div>
                            <!-- ini kalau mobile -->
                            <div
                                class="md:hidden w-full md:w-fit h-fit bg-[#3E6E7A] rounded-xl ml-auto shadow-lg hover:shadow-xl my-auto flex py-2 md:py-10 pl-2.5 md:pl-5 pr-2.5 md:pr-10">
                                <div
                                    class="text-white text-[10px]  md:text-xs lg:text-lg font-semibold mr-auto flex flex-row">
                                    <h1 class="text-[30px] md:text-[64px] lg:text-[96px] font-bold">2</h1>
                                    <h1 class="ml-2 my-auto">Write the detail of product request</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row h-1/2 pt-4">
                        <div class="w-full md:w-1/2 h-full flex p-2">
                            <div
                                class="hidden w-full md:w-fit h-fit bg-[#3E6E7A] rounded-xl ml-auto shadow-lg hover:shadow-xl my-auto md:flex py-2 md:py-10 pl-2.5 md:pl-5 pr-2.5 md:pr-10">
                                <div
                                    class="text-white text-[10px]  md:text-xs lg:text-lg font-semibold md:m-auto flex flex-row">
                                    <h1 class="text-[30px] md:text-[64px] lg:text-[96px] font-bold">2</h1>
                                    <h1 class="ml-2 my-auto">Write the detail of product request</h1>
                                </div>
                            </div>
                            <!-- ini kalau mobile -->
                            <div
                                class="md:hidden w-full md:w-fit h-fit bg-[#fffff] rounded-xl mr-auto shadow-lg hover:shadow-xl my-auto flex py-2 md:py-10 pl-2.5 md:pl-5 pr-2.5 md:pr-20">
                                <div
                                    class="text-[#3E6E7A] text-[10px] md:text-xs lg:text-lg font-semibold mr-auto flex flex-row">
                                    <h1 class="text-[30px] md:text-[64px] lg:text-[96px] font-bold">3</h1>
                                    <h1 class="ml-2 my-auto">Confirm the product</h1>
                                </div>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 h-full flex p-2">
                            <div
                                class="w-full md:w-fit h-fit bg-[#3E6E7A] md:bg-white rounded-xl ml-auto shadow-lg hover:shadow-xl my-auto flex py-2 md:py-10 pl-2.5 md:pl-5 pr-2.5 md:pr-6">
                                <div
                                    class="text-white md:text-[#3E6E7A] text-[10px] md:text-xs lg:text-lg font-semibold mr-auto md:m-auto flex flex-row">
                                    <h1 class="text-[30px] md:text-[64px] lg:text-[96px] font-bold">4</h1>
                                    <h1 class="ml-2 my-auto">Wait the product confirmed</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Customer Details Form -->
                <form @submit.prevent="submitCustomerDetails" class="w-full flex flex-col mt-2 md:mt-10"
                    :class="{ 'hidden': isAuthenticated }">
                    <label for="name" class="text-base md:text-xl text-black font-medium my-0.5 md:my-2">Name</label>
                    <input v-model="customerDetails.fullname" type="text" name="fullname"
                        class="w-full md:w-[55%] h-8 md:h-12 pl-5 bg-white outline outline-1 border-black rounded-lg md:rounded-xl my-0.5 md:my-2 border-0 focus:border-1 focus:border-black focus:ring-black"
                        placeholder="Enter your name">

                    <label for="email" class="text-base md:text-xl text-black font-medium my-0.5 md:my-2">Email</label>
                    <div class="my-2 flex flex-row">
                        <input v-model="customerDetails.email" type="email" name="email"
                            class="w-full md:w-[55%] h-8 md:h-12 pl-5 bg-white outline outline-1 border-black rounded-lg md:rounded-xl py-2 border-0 focus:border-1 focus:border-black focus:ring-black"
                            placeholder="Email address">
                    </div>
                </form>
            </div>

            <!-- Request Items List -->
            <div class="w-full h-fit pt-6 flex flex-col" id="request-items">
                <div v-for="(item, index) in requestItems" :key="index"
                    class="w-full h-fit bg-white rounded-xl flex flex-row px-1 md:px-4 py-2 md:py-4 mb-4">
                    <div class="w-[15%] h-[6rem] md:h-[10rem] bg-contain bg-no-repeat bg-center"
                        :style="{ backgroundImage: `url(${item.imagePreview})` }"></div>
                    <div class="w-[42%] pl-5 flex flex-col">
                        <div class="flex flex-row mb-auto align-middle">
                            <h1
                                class="w-fit md:max-w-[55%] h-fit text-xs md:text-sm lg:text-xl font-medium text-black mr-auto">
                                {{ item.name }}</h1>
                            <h1 class="text-xs md:text-sm lg:text-xl font-semibold text-[#B7B7B7] mx-auto">Rp {{
                                item.price }}</h1>
                        </div>
                        <div class="w-full h-full flex flex-col mt-4">
                            <p class="font-medium text-xs lg:text-lg text-black mt-auto mb-1 lg:mb-0.5">Link:</p>
                            <textarea v-model="item.url" readonly
                                class="rounded-2xl text-[10px] lg:text-base resize-none" rows="2"
                                disabled>{{ item.url }}</textarea>
                        </div>
                    </div>
                    <div class="w-[43%] pl-5 flex flex-col">
                        <div class="flex flex-row mb-auto align-middle">
                            <h1 class="text-xs md:text-sm lg:text-xl font-medium text-[#B7B7B7] mr-auto">{{
                                item.quantity }}x</h1>
                            <h1 class="text-xs md:text-sm lg:text-xl font-semibold text-[#3E6E7A] mx-auto">Rp {{
                                item.price * item.quantity }}</h1>
                            <button @click="showDeleteModal(index)"
                                class="bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] p-1 rounded-md">
                                <img src="/img/assets/icon/icon_requestOrder_trashcan.svg" alt=""
                                    class="w-3 md:w-6 h-3 md:h-6">
                            </button>
                        </div>
                        <div class="w-full h-full flex flex-col mt-4">
                            <p class="font-medium text-xs lg:text-lg text-black mt-auto mb-1 lg:mb-0.5">Note:</p>
                            <textarea v-model="item.description" class="rounded-2xl resize-none text-[#898383]" rows="2"
                                disabled>{{ item.description }}</textarea>
                        </div>
                    </div>
                </div>
                <a href="#" class="ml-auto w-1/4 md:w-1/12 mr-0 md:mr-10 lg:mr-0"
                    :class="{ 'hidden': requestItems.length === 0 }">
                    <button @click="submitRequestOrder"
                        class="bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] rounded-lg text-white text-sm md:text-lg py-1.5 md:py-2 px-2 md:px-5">
                        Confirm
                    </button>
                </a>
            </div>

            <!-- Request Order Form -->
            <div class="w-full bg-white flex-col rounded-xl mt-6 py-3 md:py-6 px-4 md:px-8">
                <form @submit.prevent="addOrderItem"
                    class="w-full h-fit flex flex-col text-orange-400 font-semibold text-sm md:text-sm lg:text-xl">
                    <label>Product Name</label>
                    <input v-model="newItem.name" type="text" required
                        class="rounded-xl bg-white border text-[#898383] font-normal border-black pl-2.5 lg:pl-6 focus:border-black focus:ring-0 my-2">

                    <label>Product Photo</label>
                    <div class="relative w-full my-2">
                        <input ref="fileInput" type="file" class="hidden" @change="handleFileUpload">
                        <label @click="$refs.fileInput.click()"
                            class="flex items-center justify-between w-full rounded-xl bg-white border border-black h-10 pl-2.5 lg:pl-6 pr-4 cursor-pointer">
                            <span class="text-[#898383] font-normal">
                                {{ newItem.image ? 'File selected' : 'Upload your photo' }}
                            </span>
                            <img src="/img/assets/icon/icon_admin_category_upload.svg" alt="Upload Icon"
                                class="h-8 w-8">
                        </label>
                    </div>

                    <label for="product-link">Product Link</label>
                    <input v-model="newItem.url" type="text" required
                        class="rounded-xl bg-white border text-[#898383] font-normal border-black pl-2.5 lg:pl-6 focus:border-black focus:ring-0 my-2">

                    <label for="product-price">Price</label>
                    <input v-model="newItem.price" type="number" required
                        class="rounded-xl bg-white border text-[#898383] font-normal border-black pl-2.5 lg:pl-6 focus:border-black focus:ring-0 my-2">

                    <label for="product-quantity">Quantity</label>
                    <input v-model="newItem.quantity" type="number" required
                        class="rounded-xl bg-white border text-[#898383] font-normal border-black pl-2.5 lg:pl-6 focus:border-black focus:ring-0 my-2">

                    <label for="product-note">Note</label>
                    <textarea v-model="newItem.description" required
                        class="rounded-xl bg-white border text-[#898383] font-normal border-black px-2 lg:px-6 focus:border-black focus:ring-0 resize-none my-2"
                        rows="10"></textarea>

                    <button type="submit"
                        class="text-white bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] w-1/5 md:w-1/12 py-1 md:py-2 rounded-lg font-normal mt-0.5 mr-auto">Add</button>
                </form>
            </div>

            <!-- Delete Confirmation Modal -->
            <div v-if="showDeleteConfirmation"
                class="fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-50">
                <div class="bg-white md:w-[50vw] lg:w-[33vw] h-auto rounded-[30px] shadow p-4">
                    <div class="flex flex-col px-10 py-10">
                        <img src="/img/assets/icon/icon_warning.svg" alt="icon_warning" class="w-16 h-16 mx-auto">
                        <p class="text-[#376F7E] font-medium text-xl mx-auto mt-2">Are you sure?</p>
                        <p class="text-[#B7B7B7] font-medium text-xs mx-auto mt-6">You won’t be able to revert this!</p>
                        <div class="w-full mt-6 flex flex-row justify-center">
                            <button @click="confirmDelete"
                                class="w-44 h-11 bg-[#376F7E] rounded-[20px] shadow-lg text-white text-lg font-semibold">Yes,
                                Delete it!</button>
                            <button @click="showDeleteConfirmation = false"
                                class="w-44 h-11 bg-[#FF9D66] rounded-[20px] shadow-lg text-white text-lg font-semibold ml-2">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Success Delete Modal -->
            <div v-if="showSuccessModal"
                class="fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-50">
                <div class="bg-white md:w-[30vw] lg:w-[25vw] h-auto rounded-[30px] shadow p-14">
                    <h1 class="text-black text-xl font-medium mx-auto">Successfully Deleted!</h1>
                    <img src="/img/assets/icon/icon_green_check.svg" alt="green_check" class="w-24 h-24 mx-auto mt-6">
                </div>
            </div>

            <!-- Success Submit Modal -->
            <div v-if="showSuccessSubmit"
                class="fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-50">
                <div class="bg-white md:w-[30vw] h-auto rounded-[30px] shadow p-14">
                    <h1 class="text-black text-xl font-medium mx-auto">Request order created successfully!</h1>
                    <img src="/img/assets/icon/icon_green_check.svg" alt="green_check" class="w-24 h-24 mx-auto mt-6">
                </div>
            </div>
        </div>
    </Layout>
</template>

<script lang="ts">
//   import { Inertia } from '@inertiajs/inertia';
import { router } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import Layout from '../../Layouts/Customer.vue';

export default {
    components: {
        Layout,
    },
    props: {
        user: Object
    },
    data() {
        return {
            customerDetails: {
                fullname: '',
                email: '',
            },
            isAuthenticated: true, // Simulasi status login
            requestItems: [],
            newItem: {
                name: '',
                image: null,
                imagePreview: '',
                url: '',
                price: '',
                quantity: '',
                description: '',
            },
            showDeleteConfirmation: false,
            showSuccessModal: false,
            showSuccessSubmit: false,
            itemToDelete: null,
        };
    },
    mounted() {
        if (this.user) {
            this.isAuthenticated = true;
            this.customerDetails.fullname = this.user.name;
            this.customerDetails.email = this.user.email;
        } else {
            this.isAuthenticated = false;
        }
    },
    methods: {
        handleFileUpload(event) {
            const file = event.target.files[0];
            if (file) {
                this.newItem.image = file;
                this.newItem.imagePreview = URL.createObjectURL(file);
            }
        },
        addOrderItem() {
            this.requestItems.push({
                name: this.newItem.name,
                image: this.newItem.image,
                imagePreview: this.newItem.imagePreview || '/img/assets/icon/icon_admin_order_product.svg',
                url: this.newItem.url,
                price: Number(this.newItem.price),
                quantity: Number(this.newItem.quantity),
                description: this.newItem.description,
            });
            // Reset form
            this.newItem = {
                name: '',
                image: null,
                imagePreview: '',
                url: '',
                price: '',
                quantity: '',
                description: '',
            };
        },
        showDeleteModal(index) {
            this.itemToDelete = index;
            this.showDeleteConfirmation = true;
        },
        confirmDelete() {
            this.requestItems.splice(this.itemToDelete, 1);
            this.showDeleteConfirmation = false;
            this.showSuccessModal = true;
            setTimeout(() => (this.showSuccessModal = false), 2000); // Auto-close after 2 seconds
        },
        submitCustomerDetails() {
            // Placeholder untuk submit customer details ke API
            console.log('Customer Details:', this.customerDetails);
        },
        submitRequestOrder() {
            if (this.requestItems.length === 0) {
                alert('Please add at least one product');
                return;
            }
            const formData = new FormData();
            formData.append('fullname', this.customerDetails.fullname);
            formData.append('email', this.customerDetails.email);
            this.requestItems.forEach((item, index) => {
                formData.append(`items[${index}][name]`, item.name);
                formData.append(`items[${index}][url]`, item.url);
                formData.append(`items[${index}][price]`, item.price);
                formData.append(`items[${index}][quantity]`, item.quantity);
                formData.append(`items[${index}][description]`, item.description);
                if (item.image) formData.append(`items[${index}][image]`, item.image);
            });

            // Contoh fetch ke API (uncomment dan sesuaikan endpoint)
            fetch('/api/request-order', {
                method: 'POST',
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        this.showSuccessSubmit = true;
                        router.get(route('confirmed', { orderId: data.order.id }))
                    } else {
                        alert('Failed to submit request order');
                    }
                })
                .catch(error => console.error('Error:', error));
        },
    },
};
</script>

<style scoped>
/* Tambahkan gaya khusus jika diperlukan */
</style>