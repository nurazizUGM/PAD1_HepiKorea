<script>
import { router } from '@inertiajs/vue3';
import { computed, onMounted, onUnmounted, ref } from 'vue';
import Layout from '../../Layouts/Customer.vue';

export default {
    components: {
        Layout,
    },
    setup() {
        // query params
        const products = ref([])
        const requestOrder = ref(false);

        const items = ref([]);
        const addresses = ref([])
        const address = ref({});

        const orderNote = ref('');
        const showAddressList = ref(false);
        const showChoosePaymentModal = ref(false);
        const showVaPaymentModal = ref(false);
        const showQrPaymentModal = ref(false);
        const showPaymentSuccessModal = ref(false);
        const paymentMethod = ref('bri');
        const paymentDetails = ref({
            amount: 'Rp 0,-',
            timeRemaining: '0 Minutes',
            expiration: '00:00',
            paymentMethod: '',
            paymentCode: '',
            bankLogo: ''
        });

        // Fungsi untuk mengambil data dari API (placeholder)
        const fetchData = async () => {
            try {
                if (requestOrder.value && products.value.length > 0) {
                    items.value = await Promise.all(products.value.map(async (item) => {
                        const response = await fetch(`/api/request-order/${item.id}`);
                        const data = await response.json();
                        return {
                            ...data,
                            product: { price: data.total_price, image: data.image },
                            quantity: item.quantity || data.quantity,
                            total: data.total_price * (item.quantity || data.quantity),
                            note: item.admin_note || '',
                        };
                    }));
                } else if (products.value.length > 0) {
                    items.value = await Promise.all(products.value.map(async (product) => {
                        const response = await fetch(`/api/product/${product.product_id}`);
                        const data = await response.json();
                        return {
                            product: { ...data, image: firstImage(data.images) },
                            quantity: product.quantity,
                            total: data.price * product.quantity,
                            note: '',
                        };
                    }));
                }
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        };

        const fetchAddresses = async () => {
            try {
                const response = await fetch('/api/address');
                addresses.value = await response.json();
                if (addresses.value.length > 0) {
                    address.value = addresses.value[0];
                }
            } catch (error) {
                console.error('Error fetching addresses:', error);
            }
        };

        function getFullAddress(address) {
            return !address ? '-' : `${address.address}, ${address.city}, ${address.province}, ${address.postal_code}`;
        }

        function updateUrl() {
            const url = new URL(window.location.href);
            const p = items.value.map(item => ({
                ...(requestOrder ? { id: item.id } : { product_id: item.product.id }),
                quantity: item.quantity,
            }));
            url.searchParams.set('products', JSON.stringify(p));
            window.history.replaceState({}, '', url);
        }

        function firstImage(images) {
            if (images && images.length > 0) {
                return images[0].path;
            }
            return null;
        }

        // Handler untuk gambar
        const getImageUrl = (image) => {
            if (image && /^http/.test(image)) return image;
            if (image) return `/storage/${image}`;
            return '/img/example/admin_order_img_phone.png';
        };

        // Format harga
        const formatPrice = (price) => {
            return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        };

        // Hitung total
        const total = computed(() => {
            return items.value.reduce((sum, item) => sum + item.total, 0);
        });

        // Tambah kuantitas
        const addQty = (item) => {
            console.log('Adding quantity for item:', item);
            item.quantity += 1;
            item.total = item.product.price * item.quantity;
            updateUrl();
        };

        // Kurangi kuantitas
        const reduceQty = (item) => {
            if (item.quantity > 1) {
                item.quantity -= 1;
                item.total = item.product.price * item.quantity;
                updateUrl();
            }
        };

        // Toggle daftar alamat
        const toggleAddressList = () => {
            router.get('/auth/address')
            showAddressList.value = !showAddressList.value;
        };

        // Copy kode pembayaran
        const copyPaymentCode = () => {
            navigator.clipboard.writeText(paymentDetails.value.paymentCode);
        };

        // Handler pembayaran
        const handlePayment = () => {
            const orderData = {
                payment_method: paymentMethod.value,
                addressId: address.value.id,
                items: items.value.map(item => ({
                    productId: item.product.id || item.id,
                    quantity: item.quantity,
                })),
            };

            fetch(requestOrder.value ? '/api/request-order/checkout' : '/api/order', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(orderData),
            })
                .then(response => response.json())
                .then(response => {
                    if (response.status === 'success') {
                        onOrderSuccess(response.payment);
                    } else {
                        console.error('Error:', response.message);
                    }
                });
        };

        // Fungsi saat order sukses
        const onOrderSuccess = (payment) => {
            const expiration = new Date(payment.expired_at).toLocaleString('en-US', { day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' });
            const diff = new Date(payment.expired_at) - new Date();
            const hoursRemaining = Math.floor(diff / (1000 * 60 * 60));
            const minutesRemaining = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const timeRemaining = `${hoursRemaining} Hours ${minutesRemaining} Minutes`;
            const amount = `Rp ${formatPrice(payment.amount)},-`;

            paymentDetails.value = {
                paymentId: payment.id,
                amount,
                timeRemaining,
                expiration,
                paymentMethod: payment.payment_method.toUpperCase(),
                paymentCode: payment.payment_code,
                bankLogo: getBankLogo(payment.payment_method),
            };

            showChoosePaymentModal.value = false;
            if (payment.payment_method === 'qris') {
                showQrPaymentModal.value = true;
            } else {
                showVaPaymentModal.value = true;
            }

            checkPaymentStatus(payment.id);
        };

        const closePaymentModal = () => {
            showQrPaymentModal.value = false;
            showVaPaymentModal.value = false;
            showChoosePaymentModal.value = false;
            router.get('/order/unpaid');
        };

        // Fungsi saat pembayaran sukses
        const onPaymentSuccess = () => {
            showQrPaymentModal.value = false;
            showVaPaymentModal.value = false;
            showPaymentSuccessModal.value = true;
            setTimeout(() => {
                router.get('/order/processed')
            }, 1000);
        };

        // Check status pembayaran (placeholder untuk API)
        const cpInterval = ref(null);
        const checkPaymentStatus = (paymentId) => {
            if (cpInterval.value) {
                clearInterval(cpInterval.value);
            }
            cpInterval.value = setInterval(() => {
                fetch(`/api/order/payment/${paymentId}`)
                    .then(res => res.json())
                    .then(res => {
                        if (res.status == 'success') {
                            clearInterval(cpInterval.value);
                            onPaymentSuccess()
                        }
                    })
            }, 2000);
        };

        const getBankLogo = (paymentMethod) => {
            switch (paymentMethod) {
                case 'bri':
                    return '/img/assets/icon/icon_checkout_bri.svg';
                case 'bni':
                    return '/img/assets/icon/icon_checkout_bni.svg';
                case 'mandiri':
                    return '/img/assets/icon/icon_checkout_mandiri.svg';
                case 'bca':
                    return '/img/assets/icon/icon_checkout_bca.svg';
                default:
                    return '/img/assets/icon/icon_checkout_gopay.svg';
            }
        }

        // Inisialisasi data (gunakan fetchData saat API siap)
        onMounted(async () => {
            const params = new URLSearchParams(window.location.search);
            products.value = JSON.parse(params.get('products')) || [];
            requestOrder.value = params.get('request_order') == 'true';
            fetchData();
            fetchAddresses();
        });

        onUnmounted(() => {
            console.log('Unmounted Checkout');
            if (cpInterval.value) {
                clearInterval(cpInterval.value);
            }
        });

        return {
            address,
            items,
            orderNote,
            showAddressList,
            showChoosePaymentModal,
            showVaPaymentModal,
            showQrPaymentModal,
            showPaymentSuccessModal,
            paymentMethod,
            paymentDetails,
            getImageUrl,
            formatPrice,
            total,
            addQty,
            reduceQty,
            toggleAddressList,
            copyPaymentCode,
            handlePayment,
            getFullAddress,
            closePaymentModal,
            getBankLogo
        };
    },
};
</script>

<template>
    <Layout title="Checkout">
        <div class="w-full max-w-full h-full rounded-3xl bg-[#EFEFEF] py-2 px-2 lg:py-8 lg:px-10">
            <!-- Shipping Address Container -->
            <div class="w-full h-full max-h-44 overflow-hidden rounded-2xl lg:rounded-3xl bg-white flex flex-col pt-3 pb-2.5 lg:pb-8 px-2.5 lg:px-10 transition-all duration-300"
                :class="{ 'max-h-full': showAddressList }">
                <h1 class="text-[#3E6E7A] font-semibold text-xs lg:text-2xl">Shipping Address</h1>
                <div class="w-full h-full flex flex-col md:flex-row mt-1 lg:mt-5 mb-auto">
                    <div class="w-full md:w-1/6 h-full">
                        <div class="flex flex-row">
                            <p class="text-[#3E6E7A] font-semibold text-xs lg:text-lg">{{ address.name }}</p>
                        </div>
                        <p class="text-[#898383] font-semibold text-xs lg:text-lg">
                            <span class="text-orange-400 font-semibold text-xs lg:text-lg inline">(+62)</span>
                            {{ address.phone?.replace(/^(0|62)/g, '') }}
                        </p>
                    </div>
                    <div class="w-full md:w-4/6 md:max-w-4/6 h-full lg:pr-36 mb-auto relative">
                        <p class="text-black text-opacity-50 font-semibold text-[10px] lg:text-lg">
                            {{ getFullAddress(address) }}
                        </p>
                        <a href="#" @click.prevent="toggleAddressList"
                            class="md:hidden flex my-auto ml-auto cursor-pointer absolute -right-3 -top-3 scale-50 md:scale-100">
                            <img src="/img/assets/icon/icon_checkout_arrow_down.svg" alt=""
                                class="w-6 h-6 transition-transform duration-300"
                                :class="{ 'rotate-180': showAddressList }">
                        </a>
                    </div>
                    <div class="w-full md:w-1/6 h-full flex mb-auto">
                        <a href="#" @click.prevent="toggleAddressList"
                            class="hidden md:flex my-auto ml-auto cursor-pointer md:scale-75 lg:scale-100">
                            <img src="/img/assets/icon/icon_checkout_arrow_down.svg" alt=""
                                class="w-6 h-6 transition-transform duration-300"
                                :class="{ 'rotate-180': showAddressList }">
                        </a>
                    </div>
                </div>
            </div>

            <!-- List of Product Ordered Container -->
            <div
                class="w-full h-full rounded-xl lg:rounded-3xl bg-white flex flex-col py-2.5 lg:py-3 px-2.5 lg:px-10 mt-2 lg:mt-6">
                <h1 class="text-black font-semibold text-xs lg:text-2xl">Product Ordered</h1>
                <div class="w-full h-full flex flex-col gap-y-5">
                    <div v-for="item in items" :key="item.product.id" class="w-full h-full flex flex-col">
                        <div class="w-full h-fit flex flex-row">
                            <div class="w-[20%]">
                                <img :src="getImageUrl(item.product.image)" alt="img_product"
                                    class="w-36 md:w-20 lg:w-36 object-contain">
                            </div>
                            <div class="w-[80%] md:w-[20%] mt-1 md:mt-2 pl-1 lg:pl-0">
                                <p class="mb-auto text-[#3E6E7A] text-[10px] md:text-sm lg:text-base font-semibold">{{
                                    item.product.name }}</p>
                                <p class="mb-auto md:hidden flex text-[#898383] font-semibold text-[8px] lg:text-xl">Rp
                                    {{
                                        formatPrice(item.product.price) }},-</p>
                                <div class="flex flex-row items-center mt-2.5">
                                    <div
                                        class="w-fit h-fit md:hidden flex flex-row lg:justify-center justify-start md:justify-center items-center lg:items-center md:mt-0 md:mb-auto lg:my-0">
                                        <div @click="reduceQty(item)"
                                            class="select-none border border-black rounded-full py-[0.9px] lg:py-1 px-[7px] md:px-[8px] lg:px-3.5 text-[10px] md:text-sm lg:text-2xl cursor-pointer hover:bg-slate-100">
                                            -</div>
                                        <p
                                            class="select-none item-quantity my-auto text-[10px] md:text-sm lg:text-2xl mx-2 md:mx-4 lg:mx-6">
                                            {{ item.quantity }}</p>
                                        <div @click="addQty(item)"
                                            class="select-none border border-black rounded-full py-0.5 md:py-[5px] lg:py-1 px-1.5 md:px-[8.5px] lg:px-3 text-[8px] lg:text-2xl cursor-pointer hover:bg-slate-100">
                                            +</div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-[0%] md:w-[20%] mt-2">
                                <p
                                    class="mb-auto hidden md:flex text-[#898383] font-semibold text-[10px] md:text-sm lg:text-xl">
                                    Rp {{
                                        formatPrice(item.product.price) }},-</p>
                            </div>
                            <div class="hidden md:flex md:w-[20%] flex-row pt-1">
                                <div
                                    class="select-none w-full h-fit flex flex-row lg:justify-center justify-start md:justify-center items-center lg:items-center my-auto md:mt-0 md:mb-auto lg:my-0">
                                    <div @click="reduceQty(item)"
                                        class="border border-black rounded-full py-[0.9px] lg:py-1 px-[7px] md:px-[8px] lg:px-3.5 text-[10px] md:text-sm lg:text-2xl cursor-pointer hover:bg-slate-100">
                                        -</div>
                                    <p
                                        class="item-quantity my-auto text-[10px] md:text-sm lg:text-2xl mx-2 md:mx-4 lg:mx-6">
                                        {{ item.quantity }}</p>
                                    <div @click="addQty(item)"
                                        class="border border-black rounded-full py-0.5 md:py-[5px] lg:py-1 px-1.5 md:px-[8.5px] lg:px-3 text-[8px] lg:text-2xl cursor-pointer hover:bg-slate-100">
                                        +</div>
                                </div>
                            </div>
                            <div class="w-[25%] hidden md:w-[20%] md:flex justify-end mt-2">
                                <p class="mb-auto text-orange-400 font-semibold text-[8px] md:text-sm lg:text-xl">Rp {{
                                    formatPrice(item.total)
                                    }},-</p>
                            </div>
                        </div>
                        <div class="w-full h-fit flex flex-col mt-0.5 lg:mt-6">
                            <h1 class="text-black font-semibold text-[10px] lg:text-xl">Note</h1>
                            <textarea v-model="item.note"
                                class="w-full bg-[#D9D9D9] h-[40px] md:h-[56px] lg:h-[79px] border-none focus:border-none focus:ring-0 rounded-lg lg:rounded-2xl resize-none text-[10px] lg:text-sm text-[#898383] font-semibold placeholder:font-semibold placeholder:text-[10px] lg:placeholder:text-sm"
                                placeholder="Write Your Note Here..."></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Checkout Container -->
            <div
                class="w-full h-full rounded-xl lg:rounded-3xl bg-white flex flex-col py-1.5 lg:py-5 px-2.5 lg:px-10 mt-2 lg:mt-6">
                <h1 class="text-black font-semibold text-xs md:text-base lg:text-2xl">Checkout</h1>
                <div class="w-full h-full flex flex-col md:flex-row mt-1.5 lg:mt-4">
                    <div class="w-full md:w-[40%] flex flex-row">
                        <p class="text-black text-opacity-50 text-[10px] md:text-sm lg:text-base font-semibold">Note:
                        </p>
                        <textarea v-model="orderNote"
                            class="bg-white hover:bg-slate-50 focus:bg-slate-50 w-full h-[50px] md:h-[61px] lg:h-[79px] border-2 border-[#3E6E7A] rounded-xl lg:rounded-2xl resize-none ml-1.5 lg:ml-3 text-[#3E6E7A] text-[8px] md:text-xs lg:text-sm focus:border-2 focus:border-[#3E6E7A] focus:ring-0 placeholder:text-[#3E6E7A] placeholder:text-[8px] md:placeholder:text-xs lg:placeholder:text-sm p-2 py-0.5 md:py-1"
                            placeholder="Order Note..."></textarea>
                    </div>
                    <div
                        class="w-full md:w-[40%] flex flex-row md:flex-col items-center md:pl-[44px] lg:px-[98px] justify-between  mt-1 md:mt-0">
                        <p class="text-black text-opacity-50 text-[8px] md:text-xs lg:text-base font-semibold">Total ({{
                            items.length }}) Product</p>
                        <h1 class="text-orange-400 md:hidden flex font-semibold text-[10px] md:text-xs lg:text-2xl">Rp
                            {{
                                formatPrice(total) }},-</h1>
                        <p
                            class="hidden md:flex text-[8px] md:text-[10px] text-red-500 lg:text-sm font-medium md:mt-1.5 lg:mt-3 text-center">
                            This price is not Including delivery cost.
                            The cost for delivery will be invoiced after the product arrived at our warehouse</p>
                    </div>
                    <div class="w-full md:w-[20%] md:h-auto flex flex-col items-end relative mt-1 md:mt-0">
                        <h1 class="text-orange-400 hidden md:flex font-semibold text-[7px] md:text-xs lg:text-2xl">Rp {{
                            formatPrice(total) }},-</h1>
                        <button @click="showChoosePaymentModal = true"
                            class="w-fit bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white text-[8px] md:text-xs lg:text-2xl font-semibold rounded-xl lg:rounded-2xl py-1 md:py-1.5 lg:py-2 px-3 md:px-6 lg:px-9 md:mt-3 lg:mt-2 ml-auto">
                            Checkout
                        </button>
                        <p
                            class="md:hidden flex text-[8px] md:text-[10px] text-red-500 lg:text-sm font-medium md:mt-1.5 lg:mt-3 text-right pl-28 mt-1 ">
                            This price is not Including delivery cost.
                            The cost for delivery will be invoiced after the product arrived at our warehouse</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Choose Payment Modal -->
        <div v-if="showChoosePaymentModal"
            class="fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-50">
            <div class="relative bg-white w-[60vw] md:w-[40vw] lg:w-[25vw] h-auto rounded-[30px] shadow p-4">
                <button @click="showChoosePaymentModal = false"
                    class="absolute bg-black w-6 h-6 flex flex-col align-middle text-center items-center scale-90 rounded-full pb-3 -top-2 -right-2">
                    <p class="m-auto text-white text-base">X</p>
                </button>
                <div class="w-full h-full flex flex-col py-1 px-2 md:p-2 lg:px-10 lg:py-10">
                    <form @submit.prevent="handlePayment" class="w-full h-full flex flex-col">
                        <h1 class="text-[#898383] text-opacity-60 font-bold text-[10px] md:text-sm lg:text-xl">Bank</h1>
                        <!-- <div class="w-full h-fit flex flex-row mt-2">
                            <img src="/img/assets/icon/icon_checkout_bri.svg" alt=""
                                class="w-[40px] h-[12px] md:-24 md:h-10 object-contain">
                            <label for="bri"
                                class="my-auto text-black font-bold text-[8px] md:text-xs lg:text-base ml-8">Bank
                                BRI</label>
                            <input type="radio" v-model="paymentMethod" value="bri" id="bri"
                                class="ml-auto my-auto w-[12px] h-[12px] md:w-7 md:h-7 border-4 border-[#3E6E7A] checked:bg-[#3E6E7A] checked:ring-[#3E6E7A]">
                        </div> -->
                        <div class="w-full h-fit flex flex-row mt-4">
                            <img src="/img/assets/icon/logo_checkout_mandiri.png" alt=""
                                class="w-[40px] h-[22px] md:w-28 md:h-12 object-contain">
                            <label for="mandiri"
                                class="my-auto text-black font-bold text-[8px] md:text-xs lg:text-base ml-8 md:ml-4">Mandiri</label>
                            <input type="radio" v-model="paymentMethod" value="mandiri" id="mandiri"
                                class="ml-auto my-auto w-[12px] h-[12px] md:w-7 md:h-7 border-4 border-[#3E6E7A] checked:bg-[#3E6E7A] checked:ring-[#3E6E7A]">
                        </div>
                        <div class="w-full h-fit flex flex-row mt-4">
                            <img src="/img/assets/icon/icon_checkout_bca.svg" alt=""
                                class="w-[40px] h-[14px] md:w-28 md:h-12 object-contain">
                            <label for="bca"
                                class="my-auto text-black font-bold text-[8px] md:text-xs lg:text-base ml-8 md:ml-4">BCA</label>
                            <input type="radio" v-model="paymentMethod" value="bca" id="bca"
                                class="ml-auto my-auto w-[12px] h-[12px] md:w-7 md:h-7 border-4 border-[#3E6E7A] checked:bg-[#3E6E7A] checked:ring-[#3E6E7A]">
                        </div>
                        <h1 class="text-[#898383] text-opacity-60 font-bold text-[10px] md:text-sm lg:text-xl mt-6">
                            E-wallet</h1>
                        <div class="w-full h-fit flex flex-row mt-2">
                            <img src="/img/assets/icon/icon_checkout_gopay.svg" alt=""
                                class="w-[42px] h-[11px] md:w-28 md:h-12 object-contain">
                            <label for="qris"
                                class="my-auto text-black font-bold text-[8px] md:text-xs lg:text-base ml-8 md:ml-4">QRIS</label>
                            <input type="radio" v-model="paymentMethod" value="qris" id="qris"
                                class="ml-auto my-auto w-[12px] h-[12px] md:w-7 md:h-7 border-4 border-[#3E6E7A] checked:bg-[#3E6E7A] checked:ring-[#3E6E7A]">
                        </div>
                        <button type="submit"
                            class="w-fit bg-[#4b6166] hover:bg-[#37626d] active:bg-[#325862] text-white text-[10px] md:text-xs lg:text-2xl font-semibold rounded-2xl py-0.5 md:py-2 px-5 md:px-10 lg:px-16 mx-auto mt-2 md:mt-4 lg:mt-10">
                            Pay
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Payment Modal (VA) -->
        <div v-if="showVaPaymentModal"
            class="fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-50">
            <div class="bg-white w-[70vw] md:w-[60vw] lg:w-[50vw] h-auto rounded-[30px] shadow p-4">
                <div class="relative w-full h-full flex flex-row">
                    <button @click="closePaymentModal"
                        class="absolute bg-black w-6 h-6 flex flex-col align-middle text-center items-center scale-90 rounded-full pb-3 -top-5 -right-4 lg:-top-5 lg:-right-5">
                        <p class="m-auto text-white text-base">X</p>
                    </button>
                    <div class="w-full h-full flex flex-col md:px-10 md:pt-5 md:pb-5 lg:px-14 lg:pt-10 lg:pb-2">
                        <h1 class="text-black font-bold text-xs lg:text-2xl">Payment</h1>
                        <div class="w-full h-fit flex flex-row mt-3">
                            <div class="w-[70%]">
                                <p
                                    class="text-[#898383] text-[8px] md:text-[10px] lg:text-sm font-bold mr-auto mb-auto">
                                    Total Payment</p>
                            </div>
                            <div class="w-[30%]">
                                <p class="text-[#3E6E7A] text-[8px] md:text-[10px] lg:text-sm font-bold mr-auto">{{
                                    paymentDetails.amount }}</p>
                            </div>
                        </div>
                        <div class="w-full h-fit flex flex-row mt-4">
                            <div class="w-[70%]">
                                <p
                                    class="text-[#898383] text-[8px] md:text-[10px] lg:text-sm font-bold mr-auto mb-auto">
                                    Pay In</p>
                            </div>
                            <div class="w-[30%] h-fit flex flex-col">
                                <p class="text-[#3E6E7A] text-[8px] md:text-[10px] lg:text-sm font-bold">{{
                                    paymentDetails.timeRemaining }}</p>
                                <p class="text-[#B7B7B7] text-[8px] md:text-[10px] lg:text-sm font-medium">Pay Before:
                                    <br>{{
                                        paymentDetails.expiration }}
                                </p>
                            </div>
                        </div>
                        <div class="w-full h-fit flex flex-row">
                            <div class="w-[10%] flex">
                                <img :src="paymentDetails.bankLogo" alt="" class="w-3/5 object-contain mb-auto">
                            </div>
                            <div class="w-[90%] flex flex-col">
                                <p class="text-[#898383] font-bold text-[8px] md:text-[10px] lg:text-sm">{{
                                    paymentDetails.paymentMethod }}</p>
                                <p
                                    class="text-[#898383] font-bold text-[8px] md:text-[10px] lg:text-sm mt-2 md:mt-3 lg:mt-6">
                                    No. Virtual Account:</p>
                                <div class="w-full h-fit flex flex-row items-center mt-1">
                                    <div class="w-[67%]">
                                        <h1 class="text-[#3E6E7A] font-bold text-xs md:text-sm lg:text-2xl">{{
                                            paymentDetails.paymentCode }}
                                        </h1>
                                    </div>
                                    <div class="w-[33%]">
                                        <p @click="copyPaymentCode"
                                            class="text-orange-400 font-bold text-[8px] md:text-[10px] lg:text-sm cursor-pointer">
                                            COPY</p>
                                    </div>
                                </div>
                                <p
                                    class="text-[#898383] font-bold text-[8px] md:text-[10px] lg:text-sm mt-2 md:mt-3 lg:mt-6">
                                    Proses verifikasi kurang dari 10 menit setelah pembayaran berhasil <br>
                                    Bayar pesanan ke Virtual Account di atas sebelum membuat pesanan <br>
                                    kembali dengan Virtual Account agar nomor tetap sama.
                                </p>
                                <p
                                    class="text-[#898383] font-bold text-[8px] md:text-[10px] lg:text-sm mt-2 md:mt-3 lg:mt-6">
                                    Hanya menerima dari {{
                                        paymentDetails.paymentMethod }}</p>
                            </div>
                        </div>
                        <h2 class="text-black font-bold text-[8px] md:-[10px] lg:text-base mt-2 md:mt-3 lg:mt-6">
                            mBanking Transfer Instructions</h2>
                        <p class="text-[#898383] font-bold text-[8px] md:text-[10px] lg:text-sm mt-1 md:mt-3 lg:mt-6">
                            1. Masuk ke menu Mobile Banking BRI. Kemudian, pilih Pembayaran > BRIVA. <br>
                            2. Masukkan Nomor BRIVA {{ paymentDetails.paymentCode }}. <br>
                            3. Masukkan PIN Anda kemudian pilih Send. Apabila pesan konfirmasi untuk <br>
                            4. transaksi menggunakan SMS muncul, pilih OK. Status transaksi akan <br>
                            5. dikirimkan melalui SMS dan dapat digunakan sebagai bukti pembayaran.
                        </p>
                        <h2 class="text-black font-bold text-[8px] md:text-[10px] lg:text-base mt-2 md:mt-3 lg:mt-4">ATM
                            Transfer Instructions</h2>
                        <p class="text-[#898383] font-bold text-[8px] md:text-[10px] lg:text-sm mt-1 md:mt-3 lg:mt-6">
                            1. Pilih Transaksi Lain > Pembayaran > Lainnya > BRIVA. <br>
                            2. Masukkan Nomor BRIVA {{ paymentDetails.paymentCode }} kemudian pilih Benar. <br>
                            3. Periksa informasi yang tertera di layar. Pastikan Merchant adalah *nama*, <br>
                            4. Total tagihan sudah benar dan username kamu azkialbab. Jika benar, pilih Ya.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- QR Payment Modal -->
        <div v-if="showQrPaymentModal"
            class="fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-50">
            <div class="bg-white w-[70vw] md:w-[60vw] lg:w-[50vw] h-auto rounded-[30px] shadow p-4">
                <div class="relative w-full h-full flex flex-row">
                    <button @click="closePaymentModal"
                        class="absolute bg-black w-6 h-6 flex flex-col align-middle text-center items-center scale-90 rounded-full pb-3 -top-5 -right-4 lg:-top-5 lg:-right-5">
                        <p class="m-auto text-white text-base">X</p>
                    </button>
                    <div class="w-full h-full flex flex-col md:px-10 md:pt-5 md:pb-5 lg:px-14 lg:pt-10 lg:pb-2">
                        <h1 class="text-black font-bold text-xs md:text-sm lg:text-2xl">Payment</h1>
                        <div class="w-full h-fit flex flex-row mt-3">
                            <div class="w-[70%]">
                                <p
                                    class="text-[#898383] text-[8px] md:text-[10px] lg:text-sm font-bold mr-auto mb-auto">
                                    Total Payment</p>
                            </div>
                            <div class="w-[30%]">
                                <p class="text-[#3E6E7A] text-[8px] md:text-[10px] lg:text-sm font-bold mr-auto">{{
                                    paymentDetails.amount }}</p>
                            </div>
                        </div>
                        <div class="w-full h-fit flex flex-row mt-4">
                            <div class="w-[70%]">
                                <p
                                    class="text-[#898383] text-[8px] md:text-[10px] lg:text-sm font-bold mr-auto mb-auto">
                                    Pay In</p>
                            </div>
                            <div class="w-[30%] h-fit flex flex-col">
                                <p class="text-[#3E6E7A] text-[8px] md:text-[10px] lg:text-sm font-bold">{{
                                    paymentDetails.timeRemaining }}</p>
                                <p class="text-[#B7B7B7] text-[8px] md:text-[10px] lg:text-sm font-medium">Pay Before:
                                    <br>{{
                                        paymentDetails.expiration }}
                                </p>
                            </div>
                        </div>
                        <!-- !!! QR CODE NYA MASI STATIS !!!! -->
                        <!-- <img src="/img/example/example_qrscan.svg" alt="" loading="lazy"
                            class="mx-auto w-[156px] lg:w-52 object-contain"> -->
                        <img :src="paymentDetails.paymentCode" alt="" loading="lazy"
                            class="mx-auto w-[156px] lg:w-52 object-contain">
                        <!-- !!! QR CODE NYA MASI STATIS !!!! -->

                        <h2 class="text-black font-bold text-[8px] md:text-xs lg:text-base mt-2 md:mt-3 lg:mt-6">
                            mBanking Transfer Instructions</h2>
                        <p class="text-[#898383] font-bold text-[8px] md:text-[10px] lg:text-sm mt-1 md:mt-3 lg:mt-6">
                            1. Masuk ke menu Mobile Banking BRI. Kemudian, pilih Pembayaran > BRIVA. <br>
                            2. Masukkan Nomor BRIVA 128 081215559315. <br>
                            3. Masukkan PIN Anda kemudian pilih Send. Apabila pesan konfirmasi untuk <br>
                            4. transaksi menggunakan SMS muncul, pilih OK. Status transaksi akan <br>
                            5. dikirimkan melalui SMS dan dapat digunakan sebagai bukti pembayaran.
                        </p>
                        <h2 class="text-black font-bold text-[8px] md:text-xs lg:text-base mt-2 md:mt-3 lg:mt-4">ATM
                            Transfer Instructions</h2>
                        <p class="text-[#898383] font-bold text-[8px] md:text-[10px] lg:text-sm mt-1 md:mt-3 lg:mt-6">
                            1. Pilih Transaksi Lain > Pembayaran > Lainnya > BRIVA. <br>
                            2. Masukkan Nomor BRIVA 128 081215559315 kemudian pilih Benar. <br>
                            3. Periksa informasi yang tertera di layar. Pastikan Merchant adalah *nama*, <br>
                            4. Total tagihan sudah benar dan username kamu azkialbab. Jika benar, pilih Ya.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Payment Modal -->
        <div v-if="showPaymentSuccessModal"
            class="fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-50">
            <div
                class="bg-white w-[65vw] md:w-[40vw] lg:w-[25vw] h-auto rounded-[30px] shadow px-3 py-7 md:p-14 flex flex-col">
                <h1 class="text-black text-[10px] md:text-xl font-medium mx-auto">Payment Successful!</h1>
                <img src="/img/assets/icon/icon_green_check.svg" alt="green_check"
                    class="w-11 h-11 md:w-24 md:h-24 mx-auto mt-4 md:mt-6">
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