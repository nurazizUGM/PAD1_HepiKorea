<template>
    <div class="w-full max-w-full h-full rounded-3xl bg-[#EFEFEF] py-2 px-2 lg:py-8 lg:px-10">
        <!-- Shipping Address -->
        <div
            class="w-full h-full max-h-44 overflow-hidden rounded-2xl lg:rounded-3xl bg-white flex flex-col pt-3 pb-2.5 lg:pb-8 px-2.5 lg:px-10 transition-all duration-300">
            <h1 class="text-[#3E6E7A] font-semibold text-xs lg:text-2xl">Shipping Address</h1>
            <div class="w-full h-full flex flex-row mt-5 mb-auto">
                <div class="w-full md:w-1/6 h-full">
                    <div class="flex flex-row">
                        <p class="text-[#3E6E7A] font-semibold text-xs lg:text-lg">{{ address.fullname }}</p>
                        <p class="text-orange-400 font-semibold text-xs lg:text-lg inline ml-2 lg:ml-5">(+62)</p>
                    </div>
                    <p class="text-[#898383] font-semibold text-xs lg:text-lg">{{ address.phone }}</p>
                </div>
                <div class="w-full md:w-4/6 md:max-w-4/6 h-full lg:pr-36 mb-auto relative">
                    <p class="text-black text-opacity-50 font-semibold text-[10px] lg:text-lg">{{ address.full_address
                    }}</p>
                </div>
            </div>
        </div>

        <!-- Product Ordered -->
        <div
            class="w-full h-full rounded-xl lg:rounded-3xl bg-white flex flex-col py-2.5 lg:py-3 px-2.5 lg:px-10 mt-2 lg:mt-6">
            <h1 class="text-black font-semibold text-xs lg:text-2xl">Product Ordered</h1>
            <div class="w-full h-full flex flex-col gap-y-5">
                <div v-for="item in order.items" :key="item.id" class="w-full h-full flex flex-col">
                    <div class="w-full h-fit flex flex-row">
                        <div class="w-[20%]">
                            <img :src="item.image" alt="img_product" class="w-36 md:w-20 lg:w-36 object-contain" />
                        </div>
                        <div class="w-[65%] lg:w-[60%] md:w-[20%] mt-1 md:mt-2 pl-1 lg:pl-1">
                            <p class="mb-auto text-[#3E6E7A] text-[8px] md:text-sm lg:text-lg font-semibold">{{
                                item.name }}</p>
                        </div>
                        <div class="w-[35%] lg:w-[30%]">
                            <p class="mb-auto flex text-[#898383] font-semibold text-[8px] md:text-sm lg:text-xl">Rp {{
                                formatPrice(item.price) }},-</p>
                        </div>
                        <div class="w-[30%] flex flex-row">
                        <div class="h-fit flex flex-row justify-center items-center">
                                <p
                                    class="item-quantity mt-auto md:mt-0 text-[10px] md:text-sm lg:text-2xl mx-2 md:mx-4 lg:mr-14">
                                    {{ item.quantity }}</p>
                            </div>
                            <div class="flex flex-row">
                                <p class="text-orange-400 font-semibold text-[10px] md:text-sm lg:text-xl">Rp {{
                                    formatPrice(item.price *
                                    item.quantity) }},-</p>
                            </div>
                        </div>
                    </div>
                    <div class="w-full h-fit flex flex-col mt-0.5 lg:mt-6">
                        <h1 class="text-black font-semibold text-[10px] lg:text-xl">Note</h1>
                        <textarea
                            class="w-full bg-[#D9D9D9] h-[40px] md:h-[56px] lg:h-[79px] border-none focus:border-none focus:ring-0 rounded-lg lg:rounded-2xl resize-none text-[10px] lg:text-sm text-[#898383] font-semibold placeholder:font-semibold placeholder:text-[10px] lg:placeholder:text-sm"
                            placeholder="Write Your Note Here..." disabled :value="item.note"></textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Checkout -->
        <div
            class="w-full h-full rounded-xl lg:rounded-3xl bg-white flex flex-col py-1.5 lg:py-5 px-2.5 lg:px-10 mt-2 lg:mt-6">
            <div class="w-full h-full flex flex-col md:flex-row mt-1.5 lg:mt-4">
                <div class="w-full md:w-[40%] flex flex-row">
                    <p class="text-black text-opacity-50 text-[10px] md:text-sm lg:text-base font-semibold">Note:</p>
                    <textarea
                        class="bg-white hover:bg-slate-50 focus:bg-slate-50 w-full h-[50px] md:h-[61px] lg:h-[79px] border-2 border-[#3E6E7A] rounded-xl lg:rounded-2xl resize-none ml-1.5 lg:ml-3 text-[#3E6E7A] text-[8px] md:text-xs lg:text-sm focus:border-2 focus:border-[#3E6E7A] focus:ring-0 placeholder:text-[#3E6E7A] placeholder:text-[8px] md:placeholder:text-xs lg:placeholder:text-sm p-2 py-0.5 md:py-1"
                        placeholder="Order Note..." disabled :value="order.note"></textarea>
                </div>
                <div
                    class="w-full md:w-[40%] flex flex-row md:flex-col items-center md:pl-[44px] lg:px-[98px] justify-between  mt-1 md:mt-0">
                    <p class="text-black text-opacity-50 text-[8px] md:text-xs lg:text-base font-semibold">Total ({{
                        order.items.length }}) Product</p>
                </div>
                <div class="w-full md:w-[20%] flex flex-col items-end">
                    <h1 class="text-orange-400 md:hidden flex font-semibold text-[10px] md:text-xs lg:text-2xl">Rp {{
                        formatPrice(order.total_price) }},-</h1>
                    <button
                        class="w-fit flex flex-row bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white text-[8px] md:text-xs lg:text-2xl font-semibold rounded-xl lg:rounded-2xl py-1 md:py-1.5 lg:py-2 px-3 md:px-6 lg:px-9 mt-3 md:mt-3 lg:mt-2 ml-auto"
                        @click="goBack">
                        <img src="/img/assets/icon/icon_arrow_back.svg" alt="" class="w-5 h-4 md:w-10 md:h-8" />
                        <p class="my-auto">Back</p>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref } from 'vue';
// import { useRouter } from 'vue-router';
import Modal from '../Modal.vue';
import axios from 'axios';

export default {
    components: { Modal },
    setup() {
        // const router = useRouter();

        // Dummy data
        const order = ref({
            id: 1,
            items: [
                {
                    id: 1,
                    name: 'Samsung Ultra 24',
                    price: 24000000,
                    quantity: 1,
                    image: '/img/example/admin_order_img_phone.png',
                    note: '',
                },
                {
                    id: 1,
                    name: 'Samsung Ultra 24',
                    price: 24000000,
                    quantity: 1,
                    image: '/img/example/admin_order_img_phone.png',
                    note: '',
                },
            ],
            note: '',
            total_price: 25800000,
        });

        const address = ref({
            fullname: 'Aisyah',
            phone: '813-9230-8107',
            full_address: 'Bulaksumur, Caturtunggal, Kapanewon Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281',
        });

        const addressForm = ref({
            fullname: '',
            phone: '',
            province: '',
            city: '',
            address: '',
            postal_code: '',
        });

        const paymentOptions = ref({
            banks: [
                { id: 'BRI', name: 'Bank BRI', icon: '/img/assets/icon/icon_checkout_bri.svg' },
                { id: 'Mandiri', name: 'Mandiri', icon: '/img/assets/icon/logo_checkout_mandiri.png' },
                { id: 'BCA', name: 'BCA', icon: '/img/assets/icon/icon_checkout_bca.svg' },
            ],
            ewallets: [
                { id: 'DANA', name: 'DANA', icon: '/img/assets/icon/icon_checkout_dana.svg' },
                { id: 'OVO', name: 'OVO', icon: '/img/assets/icon/icon_checkout_ovo.svg' },
                { id: 'Gopay', name: 'Go Pay', icon: '/img/assets/icon/icon_checkout_gopay.png' },
            ],
        });

        const selectedPayment = ref(null);

        // Modals
        const showChangeAddressModal = ref(false);
        const showChoosePaymentModal = ref(false);
        const showPaymentModal = ref(false);

        const saveAddress = () => {
            // Simulate API call
            address.value = { ...addressForm.value, full_address: `${addressForm.value.address}, ${addressForm.value.city}, ${addressForm.value.province} ${addressForm.value.postal_code}` };
            showChangeAddressModal.value = false;
            // Reset form
            addressForm.value = { fullname: '', phone: '', province: '', city: '', address: '', postal_code: '' };
        };

        const openPaymentModal = () => {
            if (selectedPayment.value) {
                showChoosePaymentModal.value = false;
                showPaymentModal.value = true;
            }
        };

        const goBack = () => {
            router.push({ name: 'admin.order.index' });
        };

        const formatPrice = (price) => {
            return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        };

        // API Fetching
        const fetchOrder = async (orderId) => {
            try {
                /*
                const response = await axios.get(`/api/admin/orders/${orderId}`);
                order.value = response.data.order;
                address.value = response.data.address;
                */
            } catch (error) {
                console.error('Error fetching order:', error);
            }
        };

        return {
            order,
            address,
            addressForm,
            paymentOptions,
            selectedPayment,
            showChangeAddressModal,
            showChoosePaymentModal,
            showPaymentModal,
            saveAddress,
            openPaymentModal,
            goBack,
            formatPrice,
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