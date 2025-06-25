<template>
    <Layout>
        <div class="bg-[#EFEFEF] border-gray-200 rounded-lg">
            <!-- Tab Navigation -->
            <div class="mb-1">
                <ul class="flex flex-wrap -mb-px text-xs lg:text-lg font-bold text-center text-black gap-x-14 lg:gap-x-16"
                    role="tablist">
                    <li class="ml-auto mr-auto" role="presentation">
                        <Link :href="route('admin.order.index', { tab: 'order' })" :class="[
                            'inline-block px-4 pt-4 pb-1 border-b-2 rounded-t-lg',
                            activeTab === 'order'
                                ? 'text-black border-orange-400'
                                : 'text-black hover:text-orange-400 border-transparent hover:border-transparent'
                        ]">
                        Order
                        </Link>
                    </li>
                    <li class="ml-auto mr-auto" role="presentation">
                        <Link :href="route('admin.order.index', { tab: 'confirmation' })" :class="[
                            'inline-block px-4 pt-4 pb-1 border-b-2 rounded-t-lg',
                            activeTab === 'confirmation'
                                ? 'text-black border-orange-400'
                                : 'text-black hover:text-orange-400 border-transparent hover:border-transparent'
                        ]">
                        Confirmation
                        </Link>
                    </li>
                </ul>
            </div>

            <!-- Tab Content -->
            <div class="px-5 pt-2 rounded-lg h-[80vh] overflow-y-scroll no-scrollbar">
                <div class="flex flex-col h-full w-full pb-3">
                    <!-- User Name -->
                    <div class="w-1/4 lg:w-1/5 h-[7%] bg-[#3E6E7A] px-3 py-1 rounded-xl flex">
                        <h1 class="md:text-base lg:text-2xl text-white font-semibold my-auto">
                            {{ confirmation?.order_detail?.customer_name || confirmation?.user?.fullname }}
                        </h1>
                    </div>

                    <!-- Product List -->
                    <div
                        class="mt-3 w-full max-h-[83%] bg-white rounded-xl px-3 py-2 flex flex-col gap-y-5 overflow-y-scroll no-scrollbar">
                        <h1 class="text-black font-semibold text-sm lg:text-xl">Products</h1>
                        <div v-for="(product) in confirmation.custom_order_items" :key="product.id"
                            class="w-full lg:max-h-[16rem] flex flex-col lg:flex-row flex-auto">
                            <!-- two divider -->
                            <div class="w-full lg:w-[40%] flex flex-row">
                                <!-- iamge container -->
                                <div class="w-[40%] md:w-[35%] lg:w-[35%] h-full flex flex-col">
                                    <div class="mb-auto flex flex-col">
                                        <img :src="getImageUrl(product.image)" alt="product"
                                            class="w-[85%] h-[85%] object-fill" />
                                        <h1 class="text-sm lg:text-lg h-[15%] text-orange-400 font-bold">Rp {{
                                            formatPrice(product.total_price) }},-</h1>
                                    </div>
                                </div>
                                <!-- name container -->
                                <div class="w-[60%] md:w-[65%] lg:w-[65%] h-full flex flex-col">
                                    <h1 class="font-semibold text-[#3E6E7A] text-xs md:text-base lg:text-xl">{{
                                        product.name }}</h1>
                                    <h2 class="font-semibold text-[10px] md:text-sm lg:text-base mt-1">Rp {{
                                        formatPrice(product.product_price || product.estimated_price) }},-</h2>
                                    <div v-if="product.max_quantity"
                                        class="flex flex-row mt-1 md:mt-2 lg:mt-5 text-[10px] md:text-xs lg:text-base">
                                        <h2 class="font-semibold">Max Order :</h2>
                                        <span class="ml-2">{{ product.max_quantity }}</span>
                                    </div>
                                    <div v-else
                                        class="flex flex-row mt-1 md:mt-2 lg:mt-3 text-[10px] md:text-xs lg:text-base">
                                        <h2 class="font-semibold">Order :</h2>
                                        <span class="ml-2">{{ product.quantity }}</span>
                                    </div>
                                    <!-- product link (nanti ilang pas desktop) -->
                                    <p
                                        class="flex lg:hidden text-black font-semibold text-[10px] md:text-xs lg:text-sm mt-1 md:mt-2">
                                        Product link:
                                        <a :href="product.url || '#'" class="text-orange-400 hover:underline ml-1"
                                            target="_blank" rel="noopener noreferrer">
                                            {{ product.url ?? '...' }}
                                        </a>
                                    </p>
                                    <!-- note container (nanti ilang pas desktop ama hape) -->
                                    <div
                                        class="max-w-full h-[45%] border border-[#3E6E7A] bg-white rounded-lg p-0.5 lg:p-1 my-1 text-[8px] md:text-xs lg:text-sm hidden md:flex lg:hidden flex-wrap overflow-x-clip overflow-y-auto">
                                        customer note: {{ product.customer_note || '...' }}
                                    </div>
                                    <div v-if="product.admin_note"
                                        class="w-full h-[45%] border border-[#3E6E7A] bg-white rounded-lg p-1 my-1 text-[8px] md:text-xs lg:text-sm hidden md:flex lg:hidden flex-wrap">
                                        admin note: {{ product.admin_note }}
                                    </div>
                                </div>
                            </div>
                            <!-- two divider -->
                            <div class="w-full lg:w-[60%] flex flex-row">
                                <!-- note container -->
                                <div
                                    class="w-[50%] lg:w-[40%] flex md:hidden lg:flex h-full flex-col items-center pr-10">
                                    <div
                                        class="w-full h-[45%] border border-[#3E6E7A] bg-white rounded-lg p-1 my-1 text-xs lg:text-sm flex-wrap overflow-x-auto overflow-y-auto no-scrollbar">
                                        customer note: {{ product.customer_note || '...' }}
                                    </div>
                                    <div v-if="product.admin_note"
                                        class="w-full h-[45%] border border-[#3E6E7A] bg-white rounded-lg p-1 my-1 text-xs lg:text-sm flex-wrap overflow-y-auto overflow-x-auto no-scrollbar">
                                        admin note: {{ product.admin_note }}
                                    </div>
                                </div>
                                <!-- two button container -->
                                <div class="w-[50%] lg:w-[60%] h-full flex flex-col ml-0 md:ml-auto lg:ml-0">
                                    <div class="w-fit h-fit ml-auto text-xs lg:text-base order-2 lg:order-1">
                                        <button :class="[
                                            'w-[18vw] h-[4vh] md:w-[15vw] lg:w-[9vw] lg:h-[5vh] rounded-lg text-white font-semibold mr-1 lg:mr-3 hover:bg-[#365f6a] active:bg-[#30545e]',
                                            product.is_available ? 'bg-[#3E6E7A]' : 'bg-[#3E6E7A] opacity-50'
                                        ]" @click="openAvailabilityModal(product, true)">
                                            Available
                                        </button>
                                        <button :class="[
                                            'w-[18vw] h-[4vh] md:w-[15vw] lg:w-[9vw] lg:h-[5vh] rounded-lg text-white font-semibold hover:bg-[#365f6a] active:bg-[#30545e]',
                                            product.is_available ? 'bg-[#3E6E7A] opacity-50' : 'bg-[#3E6E7A]'
                                        ]" @click="openAvailabilityModal(product, false)">
                                            Unavailable
                                        </button>
                                    </div>
                                    <div class="w-full h-full flex flex-col order-1 lg:order-2 mb-4">
                                        <div class="w-full h-fit mt-auto flex flex-col">
                                            <p
                                                class="hidden lg:flex text-black font-semibold text-[10px] md:text-xs lg:text-sm ml-auto mb-8">
                                                Product link:
                                                <a :href="product.url || '#'" target="_blank" rel="noopener noreferrer"
                                                    class="text-orange-400 hover:underline ml-1">
                                                    {{ product.url ?? '...' }}
                                                </a>
                                            </p>
                                            <div :class="[
                                                'w-[99%] lg:w-[90%] h-fit rounded-lg shadow-md text-center font-semibold ml-auto py-2 lg:mb-2 text-[9px] lg:text-sm',
                                                product.is_available ? 'text-black' : 'text-[#FF0000]'
                                            ]">
                                                {{ product.is_available ? `Available until
                                                ${product.available_until}` : 'Product Not Available' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Price and Submit -->
                    <div class="mt-3 w-full h-[10%] bg-white rounded-xl flex flex-row p-0.5 md:p-1 lg:p-0">
                        <div class="w-1/6 h-full flex lg:p-4">
                            <p
                                class="my-auto text-[10px] md:text-xs lg:text-sm text-black text-opacity-50 font-semibold">
                                Total Price:</p>
                        </div>
                        <div class="w-4/6 h-full flex p-1 lg:p-4">
                            <p
                                class="ml-4 md:ml-0 my-auto text-xs md:text-base lg:text-lg font-semibold text-orange-400">
                                Rp {{ formatPrice(totalPrice) }},-
                            </p>
                        </div>
                        <div class="w-1/6 h-full flex">
                            <button
                                class="m-auto bg-[#3E6E7A] hover:bg-[#335a64] text-white text-sm md:text-base lg:text-lg rounded-xl px-1 md:px-6 lg:px-12 md:py-1 lg:py-2"
                                @click="submitConfirmation">
                                Submit
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Available Confirmation Modal -->
            <Modal :show="showAvailabilityModal" @close="closeAvailabilityModal">
                <div class="bg-white w-[90vw] md:w-[60vw] lg:w-[42vw] lg:h-[64vh] rounded-xl shadow relative">
                    <button
                        class="absolute bg-black w-5 h-5 flex items-center justify-center rounded-full text-white text-sm -top-2 -right-2 hover:invert-[20%] active:invert-[25%]"
                        @click="closeAvailabilityModal">
                        X
                    </button>
                    <div class="w-full h-full p-5 flex flex-row">
                        <form class="w-full flex flex-col lg:flex-row" @submit.prevent="saveAvailability">
                            <!-- Date and Time Picker -->
                            <div class="w-full lg:w-[50%] h-full flex flex-col">
                                <h1 class="text-black text-sm md:text-base font-semibold">Availability</h1>
                                <h1 class="text-black text-sm md:text-base font-semibold">Date</h1>
                                <div class="relative max-w-sm">
                                    <div
                                        class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                        </svg>
                                    </div>
                                    <input datepicker id="datepicker-available-until" type="text"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Select date">
                                </div>
                            </div>
                            <!-- Form Fields -->
                            <div class="w-full lg:w-[50%] h-full flex flex-col lg:pl-5 lg:pr-2.5">
                                <h1>Product Price</h1>
                                <div class="flex items-center lg:mx-auto">
                                    <input v-model="modalForm.product_price" type="number"
                                        class="block w-full lg:w-[18vw] py-2 text-gray-900 bg-white shadow-md border border-white rounded-lg focus:ring-0 focus:border-none"
                                        :placeholder="`${formatPrice(modalForm.price || 0)}`" />
                                    <button type="button" @click="switchCurrency()"
                                        class="inline-flex items-center px-4 py-2 font-semibold text-white bg-gray-500 rounded-lg -ml-14 z-10">
                                        {{ modalForm.currency }}
                                    </button>
                                </div>
                                <h1>EMS Price</h1>
                                <input v-model="modalForm.service_price" type="number"
                                    class="w-full h-10 bg-white shadow-md border border-white rounded-lg focus:ring-0 focus:border-none"
                                    placeholder="Rp EMS Price" />
                                <h1>Max Order</h1>
                                <input v-model="modalForm.max_quantity" type="number"
                                    class="w-full h-10 bg-white shadow-md border border-white rounded-lg focus:ring-0 focus:border-none"
                                    placeholder="Max Order" />
                                <h1>Note</h1>
                                <textarea v-model="modalForm.admin_note" rows="7"
                                    class="bg-white shadow-md border border-white rounded-lg focus:ring-0 focus:border-none"
                                    placeholder="Admin Note"></textarea>
                                <button type="submit"
                                    class="rounded-lg bg-orange-400 hover:bg-orange-500 text-white block ml-auto mt-4 w-1/4 lg:w-1/2 py-2">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </Modal>
        </div>
    </Layout>
</template>

<script>
import { Link, router } from '@inertiajs/vue3';
import axios from 'axios';
import { Datepicker } from 'flowbite';
import moment from 'moment';
import { computed, onMounted, ref } from 'vue';
import { route } from 'ziggy-js';
import Admin from '../../Layouts/Admin.vue';
import Modal from '../Modal.vue';

export default {
    components: { Modal, Layout: Admin, Link },
    props: {
        orderId: {
            type: String,
            required: false,
        },
    },
    setup(props) {
        // Dummy data
        const confirmation = ref({
            user: {},
            order_detail: {},
            custom_order_items: []
        });

        // Tab state
        const activeTab = ref('confirmation');

        const setActiveTab = (tab) => {
            activeTab.value = tab;
        };

        let datePicker;
        const initDatePicker = (date = null) => {
            if (datePicker) {
                datePicker.destroy();
            }

            const datePickerElement = document.getElementById('datepicker-available-until');
            datePicker = new Datepicker(datePickerElement, {
                format: 'yyyy-mm-dd',
                autohide: true,
                minDate: new Date(),
            });
            datePicker.setDate(date || moment().format('YYYY-MM-DD'));
        };

        // Modal state
        const showAvailabilityModal = ref(false);
        const modalForm = ref({
            id: null,
            product_price: 0,
            service_price: 0,
            currency: 'IDR',
            max_quantity: 0,
            admin_note: '',
            is_available: true,
            available_until: '',
        });

        const openAvailabilityModal = (product, isAvailable) => {
            if (!isAvailable) {
                Object.assign(product, {
                    is_available: false,
                    available_until: '',
                    max_quantity: 0,
                    admin_note: '',
                });
                return;
            }

            modalForm.value = {
                ...product,
                product_price: product.product_price || product.estimated_price || 0,
                service_price: product.service_price || 0,
                currency: product.currency || 'IDR',
                max_quantity: product.max_quantity || product.quantity || 0,
                admin_note: product.admin_note || '',
                is_available: true,
                available_until: product.available_until || '',
            };
            showAvailabilityModal.value = true;
            setTimeout(() => {
                initDatePicker(product.available_until);
            }, 1000);
        };

        const closeAvailabilityModal = () => {
            showAvailabilityModal.value = false;
        };

        const saveAvailability = async () => {
            const item = confirmation.value.custom_order_items.find(p => p.id === modalForm.value.id);

            if (modalForm.value.currency == 'KRW') {
                modalForm.value.product_price = await krwToIdr(modalForm.value.product_price);
                modalForm.value.currency = 'IDR';
            }

            modalForm.value.total_price = modalForm.value.product_price + modalForm.value.service_price;
            modalForm.value.available_until = datePicker ? moment(datePicker.getDate()).format('YYYY-MM-DD') : modalForm.value.available_until;
            Object.assign(item, modalForm.value);
            closeAvailabilityModal();
        };

        const submitConfirmation = () => {
            // Simulate API call
            axios.post(`/api/admin/request-order/${confirmation.value.id}/confirm`, { items: confirmation.value.custom_order_items })
                .then(response => {
                    router.visit(route('admin.order.index', { tab: 'confirmation' }));
                })
                .catch(error => {
                    console.error('Error submitting confirmation:', error);
                });
        };

        // Formatting
        const formatPrice = (price) => {
            return price?.toString()?.replace(/\B(?=(\d{3})+(?!\d))/g, '.') || 0;
        };

        // Currency conversion (placeholder)
        const krwToIdrRate = ref(null);
        const krwToIdr = async (value) => {
            try {
                if (krwToIdrRate.value === null) {
                    const response = await axios.get('https://open.er-api.com/v6/latest/KRW');
                    krwToIdrRate.value = response.data.rates.IDR;
                }
                return Math.ceil(value * krwToIdrRate.value);
            } catch (error) {
                console.error('Error fetching KRW to IDR rate:', error);
            }
        };

        const idrToKrwRate = ref(null);
        const idrToKrw = async (value) => {
            try {
                if (idrToKrwRate.value === null) {
                    const response = await axios.get('https://open.er-api.com/v6/latest/IDR');
                    idrToKrwRate.value = response.data.rates.KRW;
                }
                return value * idrToKrwRate.value;
            } catch (error) {
                console.error('Error fetching IDR to KRW rate:', error);
            }
        };

        const switchCurrency = async () => {
            if (modalForm.value.currency === 'IDR') {
                modalForm.value.product_price = await idrToKrw(modalForm.value.product_price);
                modalForm.value.currency = 'KRW';
            } else {
                modalForm.value.product_price = await krwToIdr(modalForm.value.product_price);
                modalForm.value.currency = 'IDR';
            }
        }

        const totalPrice = computed(() => {
            return confirmation.value.custom_order_items.reduce((total, item) => {
                const res = total + (item.total_price || item.product_price || 0);
                return res;
            }, 0);
        })

        // API Fetching
        const fetchConfirmation = async () => {
            try {
                const response = await axios.get(`/api/admin/request-order/${props.orderId}`);
                confirmation.value = response.data;
            } catch (error) {
                console.error('Error fetching confirmation:', error);
            }
        };

        const getImageUrl = (image) => {
            if (!image) return "/img/assets/icon/icon_admin_order_product.svg";
            if (/^http/.test(image)) return image;
            return `/api/file?path=${image.replace(/\/?storage\//g, "")}`;
        };


        onMounted(() => {
            fetchConfirmation()
        })

        return {
            confirmation,
            activeTab,
            setActiveTab,
            showAvailabilityModal,
            modalForm,
            openAvailabilityModal,
            closeAvailabilityModal,
            saveAvailability,
            submitConfirmation,
            formatPrice,
            getImageUrl,
            switchCurrency,
            totalPrice,
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