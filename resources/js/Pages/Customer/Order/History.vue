<script>
import { ref, onMounted } from 'vue';
import Layout from '../../Layouts/Customer.vue';

export default {
    components: { Layout },
    setup() {
        const activeTab = ref('unpaid');
        const tabs = [
            { id: 'unpaid', label: 'Unpaid' },
            { id: 'processed', label: 'Processed' },
            { id: 'sent', label: 'Sent' },
            { id: 'finish', label: 'Finish' },
        ];

        // Dummy Data
        const unpaidOrders = ref([
            {
                id: 1,
                type: 'custom',
                productName: 'Custom Item 1',
                totalPrice: 500000,
                image: 'https://placehold.co/400x400',
                count: 2,
                lastPayment: { status: 'pending', expiredTime: '25-Dec-2023 14:00', paymentMethod: 'Bank BRI', amount: 500000, payment_code: '123456789', id: 1 },
            },
            {
                id: 4,
                type: 'custom',
                productName: 'Custom Item 1',
                totalPrice: 500000,
                image: 'https://placehold.co/400x400',
                count: 2,
                lastPayment: { status: 'pending', expiredTime: '25-Dec-2023 14:00', paymentMethod: 'Bank Mandiri', amount: 500000, payment_code: '123456789', id: 1 },
            },
            {
                id: 2,
                type: 'product',
                productName: 'Product A',
                totalPrice: 300000,
                image: 'https://placehold.co/400x400',
                count: 1,
                lastPayment: null,
            },
            {
                id: 3,
                type: 'product',
                productName: 'Product AB',
                totalPrice: 500000,
                image: 'https://placehold.co/400x400',
                count: 3,
                lastPayment: null,
            },
        ]);

        const processedOrders = ref([
            {
                id: 3,
                type: 'custom',
                productName: 'Custom Item 2',
                totalPrice: 750000,
                image: 'https://placehold.co/400x400',
                count: 1,
                arrivalTime: '10-Jan-2024',
                status: 'processing',
            },
            {
                id: 4,
                type: 'custom',
                productName: 'Custom Item 3',
                totalPrice: 750000,
                image: 'https://placehold.co/400x400',
                count: 1,
                arrivalTime: '10-Jan-2024',
                status: 'processing',
            },
        ]);

        const sentOrders = ref([
            {
                id: 4,
                type: 'product',
                productName: 'Product B',
                totalPrice: 400000,
                image: 'https://placehold.co/400x400',
                count: 3,
                status: 'shipment_unpaid',
                shipmentService: 'JNE',
                shipmentPrice: 50000,
                shipmentArrivalEstimation: '15-Jan-2024',
                shipmentPayment: null,
            },
            {
                id: 9,
                type: 'product99',
                productName: 'Product B',
                totalPrice: 400000,
                image: 'https://placehold.co/400x400',
                count: 3,
                status: 'shipment_unpaid',
                shipmentService: 'JNE',
                shipmentPrice: 50000,
                shipmentArrivalEstimation: '15-Jan-2024',
                shipmentPayment: 1,
            },
        ]);

        const finishedOrders = ref([
            {
                id: 5,
                type: 'product',
                productName: 'Product C',
                totalPrice: 600000,
                image: 'https://placehold.co/400x400',
                count: 1,
                hasReview: false,
            },
        ]);

        // Modal States
        const shipmentModalVisible = ref(false);
        const reviewModalVisible = ref(false);
        const successReviewModalVisible = ref(false);
        const selectedOrder = ref(null);

        // Review Form
        const reviewForm = ref({
            orderId: null,
            rating: 0,
            content: '',
            photo: null,
            photoPreview: null,
        });

        // Methods
        const setActiveTab = (tab) => {
            activeTab.value = tab;
            window.history.pushState(null, null, `?tab=${tab}`);
        };

        const getImageUrl = (image) => {
            // return image ? `/storage/${image}` : '/img/example/example_phone.png';
            return image ? `${image}` : '/img/example/example_phone.png';
        };

        const formatPrice = (price) => {
            return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        };

        const pay = (payment) => {
            console.log('Pay:', payment); // Gantikan dengan logika pembayaran API
        };

        const showShipmentDetail = (order) => {
            selectedOrder.value = order;
            shipmentModalVisible.value = true;
        };

        const payShipment = (orderId) => {
            console.log('Pay Shipment for Order ID:', orderId); // Gantikan dengan logika API
            shipmentModalVisible.value = false;
        };

        const showReviewModal = (orderId) => {
            reviewForm.value.orderId = orderId;
            reviewModalVisible.value = true;
        };

        const setRating = (rating) => {
            reviewForm.value.rating = rating;
        };

        const changeReviewPhoto = (event) => {
            const file = event.target.files[0];
            if (file) {
                reviewForm.value.photo = file;
                reviewForm.value.photoPreview = URL.createObjectURL(file);
            }
        };

        const submitReview = () => {
            console.log('Review Submitted:', reviewForm.value); // Gantikan dengan logika API
            reviewModalVisible.value = false;
            successReviewModalVisible.value = true;
            setTimeout(() => {
                successReviewModalVisible.value = false;
            }, 2000);
        };

        // Fetch Data (Uncomment dan sesuaikan saat menggunakan API)
        /*
        const fetchData = async () => {
          try {
            const [unpaidRes, processedRes, sentRes, finishedRes] = await Promise.all([
              fetch('/api/orders?status=unpaid'),
              fetch('/api/orders?status=processed'),
              fetch('/api/orders?status=sent'),
              fetch('/api/orders?status=finished'),
            ]);
            unpaidOrders.value = await unpaidRes.json();
            processedOrders.value = await processedRes.json();
            sentOrders.value = await sentRes.json();
            finishedOrders.value = await finishedRes.json();
          } catch (error) {
            console.error('Error fetching data:', error);
          }
        };
    
        onMounted(() => {
          fetchData();
        });
        */

        return {
            activeTab,
            tabs,
            unpaidOrders,
            processedOrders,
            sentOrders,
            finishedOrders,
            setActiveTab,
            getImageUrl,
            formatPrice,
            pay,
            showShipmentDetail,
            payShipment,
            shipmentModalVisible,
            selectedOrder,
            reviewModalVisible,
            successReviewModalVisible,
            reviewForm,
            setRating,
            changeReviewPhoto,
            submitReview,
        };
    },
};
</script>

<template>
    <Layout title="Transaction History">
        <div class="w-full max-w-full h-fit min-h-[650px] rounded-3xl bg-[#EFEFEF] pb-8 pt-2 px-0.5 md:px-1.5 lg:px-10">
            <!-- Tabs -->
            <div class="mb-2 md:mb-3 lg:mb-4 border-b border-gray-200">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-styled-tab">
                    <li v-for="tab in tabs" :key="tab.id" class="mx-auto" role="presentation">
                        <button class="inline-block p-4 border-b-4 rounded-t-lg text-xs md:text-sm lg:text-xl font-semibold"
                            :class="{ 'text-black border-orange-400': activeTab === tab.id, 'text-black border-none': activeTab !== tab.id }"
                            @click="setActiveTab(tab.id)">
                            {{ tab.label }}
                        </button>
                    </li>
                </ul>
            </div>

            <!-- Tab Content -->
            <div id="default-styled-tab-content">
                <!-- Unpaid Tab -->
                <div v-if="activeTab === 'unpaid'" class="p-1 lg:p-4 rounded-lg">
                    <div class="w-full h-full flex flex-col gap-y-2 md:gap-y-4 lg:gap-y-6">
                        <div v-for="order in unpaidOrders" :key="order.id"
                            class="w-full h-fit min-h-[94px] md:min-h-[164px] lg:h-full bg-white rounded-2xl flex flex-row p-2 md:p-4 lg:py-8 lg:px-8">
                            <!-- ini nanti hidden pas mobile (soalnya ganti tempat e) -->
                            <div class="w-[20%] hidden md:flex mr-1 lg:mr-0">
                                <img :src="getImageUrl(order.image)" alt="unpaid_image_product"
                                    class="h-14 md:h-32 lg:h-48 object-contain mx-auto">
                            </div>
                            <div class="w-full md:w-[80%] flex flex-col">
                                <div class="w-full h-fit md:h-1/2 lg:h-1/2 flex flex-row justify-center mt-1">
                                    <!-- ini nanti muncul pas mobile -->
                                    <div class="md:w-[20%] md:hidden flex mr-1 lg:mr-0">
                                        <img :src="getImageUrl(order.image)" alt="unpaid_image_product"
                                                class="h-14 lg:h-48 object-contain mx-auto">
                                    </div>
                                    <div class="md:w-[34%] lg:w-[33%] h-full flex flex-col">
                                        <h1 class="text-black font-semibold text-[9px] md:text-xs lg:text-xl cursor-pointer"
                                            @click="$inertia.get(route('order.show', order.id))">
                                            {{ order.productName }}
                                        </h1>
                                        <p v-if="order.count > 1"
                                            class="text-black text-opacity-50 font-semibold text-[9px] md:text-xs lg:text-xl">
                                            and {{ order.count - 1 }} other items
                                        </p>
                                    </div>
                                    <div class="md:w-[22%] ms-auto h-full flex">
                                        <p class="text-[#3E6E7A] text-[9px] md:text-sm lg:text-xl font-semibold ml-auto">Rp {{
                                            formatPrice(order.totalPrice) }}</p>
                                    </div>
                                </div>
                                <div class="w-full h-fit md:h-1/2 lg:h-1/2 flex flex-row mt-1 lg:mt-0">
                                    <div v-if="order.lastPayment" class="w-1/2 mt-auto lg:my-0 mr-1 lg:mr-0">
                                        <div
                                            class="w-full h-fit lg:h-full bg-[#3E6E7A] text-white font-semibold text-[8px] md:text-[10px] lg:text-base rounded-lg lg:rounded-2xl shadow-md p-1 md:p-3 lg:p-4">
                                            <p>Bayar sebelum {{ order.lastPayment.expiredTime }} dengan {{
                                                order.lastPayment.paymentMethod }}</p>
                                        </div>
                                    </div>
                                    <div class="w-1/2 ml-auto flex flex-row justify-end items-center md:mt-auto md:mb-1.5 lg:my-0">
                                        <button v-if="order.lastPayment"
                                            class="w-1/2 lg:w-5/12 h-fit rounded-2xl bg-white hover:bg-slate-50 border-2 border-[#3E6E7A] text-[8px] md:text-xs lg:text-xl text-[#3E6E7A] md:py-1 lg:py-3"
                                            @click="pay(order.lastPayment)">
                                            Pay Product
                                        </button>
                                        <button
                                            class="w-1/2 lg:w-5/12 h-fit rounded-2xl bg-white hover:bg-slate-50 border-2 border-[#3E6E7A] text-[8px] md:text-xs lg:text-xl text-[#3E6E7A] md:py-1 lg:py-3 ml-1 lg:ml-4"
                                            @click="$inertia.get(route('order.cancel', order.id))">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Processed Tab -->
                <div v-if="activeTab === 'processed'" class="p-1 lg:p-4 rounded-lg">
                    <div class="w-full h-full flex flex-col gap-y-2 md:gap-y-4 lg:gap-y-6">
                        <div v-for="order in processedOrders" :key="order.id"
                            class="w-full h-fit min-h-[94px] md:min-h-[164px] lg:h-full bg-white rounded-2xl flex flex-row p-2 md:p-4 lg:py-8 lg:px-8">
                            <div class="w-[20%] hidden md:flex mr-1 lg:mr-0">
                                <img :src="getImageUrl(order.image)" alt="processed_image_product"
                                    class="h-14 md:h-32 lg:h-48 object-contain mx-auto">
                            </div>
                            <div class="w-full md:w-[80%] flex flex-col">
                                <div class="w-full h-fit md:h-1/2 lg:h-1/2 flex flex-row justify-center mt-1">
                                    <!-- ini nanti muncul pas mobile -->
                                    <div class="md:w-[20%] md:hidden flex mr-1 lg:mr-0">
                                        <img :src="getImageUrl(order.image)" alt="processed_image_product"
                                                class="h-14 lg:h-48 object-contain mx-auto">
                                    </div>
                                    <div class="md:w-[34%] lg:w-[33%] h-full flex flex-col">
                                        <h1 class="text-black font-semibold text-[9px] md:text-xs lg:text-xl cursor-pointer"
                                            @click="$inertia.get(route('order.show', order.id))">
                                            {{ order.productName }}
                                        </h1>
                                        <p v-if="order.count > 1"
                                            class="text-black text-opacity-50 font-semibold text-[9px] md:text-xs lg:text-xl">
                                            and {{ order.count - 1 }} other items
                                        </p>
                                    </div>
                                    <div class="w-[22%] ms-auto h-full flex">
                                        <p class="text-[#3E6E7A] text-[9px] md:text-sm lg:text-xl font-semibold ml-auto">Rp {{
                                            formatPrice(order.totalPrice) }}</p>
                                    </div>
                                </div>
                                <div class="w-full h-fit md:h-1/2 lg:h-1/2 flex flex-row mt-1 lg:mt-0">
                                    <div class="w-4/6 md:w-1/2 mx-auto">
                                        <div
                                            class="w-full h-full flex bg-[#3E6E7A] text-white font-semibold text-[7px] md:text-xs lg:text-base rounded-lg lg:rounded-2xl shadow-md p-1 md:p-2 lg:p-4">
                                            <p class="my-auto">
                                                <span v-if="order.arrivalTime">Estimated Arrival in Indonesia: {{
                                                    order.arrivalTime }}</span>
                                                <br>
                                                {{ order.status === 'processing' ? 'The order is on its way to Indonesia' : 'The order is currently awaiting administrator confirmation' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sent Tab -->
                <div v-if="activeTab === 'sent'" class="p-1 lg:p-4 rounded-lg">
                    <div class="w-full h-full flex flex-col gap-y-2 md:gap-y-4 lg:gap-y-6">
                        <div v-for="order in sentOrders" :key="order.id"
                            class="w-full h-fit min-h-[94px] md:min-h-[164px] lg:h-full bg-white rounded-2xl flex flex-row p-2 md:p-4 lg:py-8 lg:px-8">
                            <div class="w-[20%] hidden md:flex mr-1 lg:mr-0">
                                <img :src="getImageUrl(order.image)" alt="sent_image_product"
                                    class="h-14 md:h-32 lg:h-48 object-contain mx-auto">
                            </div>
                            <div class="w-full md:w-[80%] flex flex-col">
                                <div class="w-full h-fit md:h-1/2 lg:h-1/2 flex flex-row justify-center mt-1">
                                    <div class="md:w-[20%] md:hidden flex mr-1 lg:mr-0">
                                        <img :src="getImageUrl(order.image)" alt="sent_image_product"
                                                class="h-14 lg:h-48 object-contain mx-auto">
                                    </div>
                                    <div class="md:w-[34%] lg:w-[33%] h-full flex flex-col">
                                        <h1 class="text-black font-semibold text-[9px] md:text-xs lg:text-xl">{{ order.productName }}</h1>
                                        <p v-if="order.count > 1"
                                            class="text-black text-opacity-50 font-semibold text-[9px] md:text-xs lg:text-xl">
                                            and {{ order.count - 1 }} other items
                                        </p>
                                    </div>
                                    <div class="w-[22%] ms-auto h-full flex">
                                        <p class="text-[#3E6E7A] text-[9px] md:text-sm lg:text-xl font-semibold ml-auto">Rp {{
                                            formatPrice(order.totalPrice) }},-</p>
                                    </div>
                                </div>
                                <div class="w-full h-fit md:h-1/2 lg:h-1/2 flex flex-row mt-1 lg:mt-0">
                                    <div class="w-[52%] flex items-end">
                                        <div
                                            class="w-full h-fit lg:h-full bg-[#3E6E7A] text-white font-semibold text-[8px] md:text-[10px] lg:text-base rounded-lg lg:rounded-2xl shadow-md p-1 md:p-3 lg:p-4">
                                            <p class="my-auto">
                                                {{ order.status === 'shipment_unpaid' ? 'Waiting for payment of the shipment' : order.status === 'shipment_paid' ? 'Waiting for the shipment to be sent' : 'The order is on its way to Destination Address' }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="w-[48%] ms-auto flex flex-row justify-end items-end">
                                        <button v-if="order.status === 'shipment_unpaid' && !order.shipmentPayment"
                                            class="w-1/2 lg:w-5/12 h-fit rounded-2xl bg-white hover:bg-slate-50 border-2 border-[#3E6E7A] text-[8px] md:text-xs lg:text-xl text-[#3E6E7A] md:py-1 lg:py-3"
                                            @click="showShipmentDetail(order)">
                                            Shipment Detail
                                        </button>
                                        <button v-else-if="order.status === 'shipment_unpaid' && order.shipmentPayment"
                                            class="w-1/2 lg:w-5/12 h-fit rounded-2xl bg-white hover:bg-slate-50 border-2 border-[#3E6E7A] text-[8px] md:text-xs lg:text-xl text-[#3E6E7A] md:py-1 lg:py-3"
                                            @click="pay(order.shipmentPayment)">
                                            Pay Shipment
                                        </button>
                                        <button v-else-if="order.status === 'sent'"
                                            class="w-1/2 lg:w-5/12 h-fit rounded-2xl bg-white hover:bg-slate-50 border-2 border-[#3E6E7A] text-[8px] md:text-xs lg:text-xl text-[#3E6E7A] md:py-1 lg:py-3"
                                            @click="$inertia.get(route('order.arrived', order.id))">
                                            Confirm Arrival
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Finish Tab -->
                <div v-if="activeTab === 'finish'" class="p-1 lg:p-4 rounded-lg">
                    <div class="w-full h-full flex flex-col gap-y-2 md:gap-y-4 lg:gap-y-6">
                        <div v-for="order in finishedOrders" :key="order.id"
                            class="w-full h-fit min-h-[94px] md:min-h-[164px] lg:h-full bg-white rounded-2xl flex flex-row p-2 md:p-4 lg:py-8 lg:px-8">
                            <div class="w-[20%] hidden md:flex mr-1 lg:mr-0">
                                <img :src="getImageUrl(order.image)" alt="finish_image_product"
                                    class="h-14 md:h-32 lg:h-48 object-contain mx-auto">
                            </div>
                            <div class="w-full md:w-[80%] flex flex-col">
                                <div class="w-full h-fit md:h-1/2 lg:h-1/2 flex flex-row justify-center mt-1">
                                    <!-- ini nanti muncul pas mobile -->
                                    <div class="md:w-[20%] md:hidden flex mr-1 lg:mr-0">
                                        <img :src="getImageUrl(order.image)" alt="finish_image_product"
                                                class="h-14 lg:h-48 object-contain mx-auto">
                                    </div>
                                    <div class="md:w-[34%] lg:w-[33%] h-full flex flex-col">
                                        <h1 class="text-black font-semibold text-[9px] md:text-xs lg:text-xl cursor-pointer">{{ order.productName }}</h1>
                                        <p v-if="order.count > 1"
                                            class="text-black text-opacity-50 font-semibold text-[9px] md:text-xs lg:text-xl">
                                            and {{ order.count - 1 }} other items
                                        </p>
                                    </div>
                                    <div class="md:w-[22%] ms-auto h-full flex">
                                        <p class="text-[#3E6E7A] text-[9px] md:text-sm lg:text-xl font-semibold ml-auto">Rp {{
                                            formatPrice(order.totalPrice) }},-</p>
                                    </div>
                                </div>
                                <div v-if="!order.hasReview" class="w-full h-fit md:h-1/2 lg:h-1/2 flex flex-row mt-1 lg:mt-0">
                                    <div class="w-full flex flex-row justify-end md:items-end">
                                        <button
                                            class="w-[20%] h-fit rounded-2xl bg-white hover:bg-slate-50 border-2 border-[#3E6E7A] text-[8px] md:text-xs lg:text-xl text-[#3E6E7A] md:py-1 lg:py-3"
                                            @click="showReviewModal(order.id)">
                                            Review
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modals -->
            <!-- Detail Shipment Modal -->
            <div v-if="shipmentModalVisible"
                class="fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-50"
                @click.self="shipmentModalVisible = false">
                <div class="bg-white w-[41vw] h-auto rounded-[30px] shadow p-4">
                    <button
                        class="absolute bg-black w-6 h-6 flex items-center justify-center rounded-full -top-1 -right-1"
                        @click="shipmentModalVisible = false">
                        <p class="text-white text-md">X</p>
                    </button>
                    <div class="w-full h-full flex flex-col px-10 pt-10 pb-5">
                        <h1 class="text-black font-bold text-2xl">Detail Shipment</h1>
                        <div class="w-full h-full flex flex-col gap-y-6 mt-6">
                            <div class="w-full h-fit flex flex-row">
                                <div class="w-[67%] text-sm text-[#898383] font-bold">Expedition Name</div>
                                <div class="w-[33%] text-sm text-[#3E6E7A] font-bold">{{ selectedOrder?.shipmentService
                                    }}</div>
                            </div>
                            <div class="w-full h-fit flex flex-row">
                                <div class="w-[67%] text-sm text-[#898383] font-bold">Total Expedition Payment</div>
                                <div class="w-[33%] text-sm text-[#3E6E7A] font-bold">Rp {{
                                    formatPrice(selectedOrder?.shipmentPrice) }},-</div>
                            </div>
                            <div class="w-full h-fit flex flex-row">
                                <div class="w-[67%] text-sm text-[#898383] font-bold">Estimated Arrival Time</div>
                                <div class="w-[33%] text-sm text-[#3E6E7A] font-bold">{{
                                    selectedOrder?.shipmentArrivalEstimation }}</div>
                            </div>
                        </div>
                        <button
                            class="w-fit bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white text-lg font-semibold rounded-2xl py-2 px-16 ml-auto mt-6"
                            @click="payShipment(selectedOrder.id)">
                            Pay
                        </button>
                    </div>
                </div>
            </div>

            <!-- Review Modal -->
            <div v-if="reviewModalVisible"
                class="fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-50"
                @click.self="reviewModalVisible = false">
                <div class="bg-white w-[30vw] h-auto rounded-[30px] shadow p-4">
                    <button
                        class="absolute bg-black w-6 h-6 flex items-center justify-center rounded-full -top-1 -right-1"
                        @click="reviewModalVisible = false">
                        <p class="text-white text-md">X</p>
                    </button>
                    <div class="w-full h-full flex flex-col px-10 pt-10 pb-5">
                        <h1 class="text-black font-bold text-sm">Rating</h1>
                        <form @submit.prevent="submitReview" class="w-full h-full flex flex-col">
                            <input type="hidden" v-model="reviewForm.orderId">
                            <input type="hidden" v-model="reviewForm.rating">
                            <div class="flex flex-row gap-x-4 my-6">
                                <img v-for="n in 5" :key="n" src="/img/assets/icon/icon_review_star.svg" alt="star"
                                    class="w-[29px] h-7 cursor-pointer" :class="{ 'grayscale': n > reviewForm.rating }"
                                    @click="setRating(n)">
                            </div>
                            <textarea v-model="reviewForm.content"
                                class="rounded-2xl bg-gray-200 resize-none border-none text-sm font-semibold focus:border-0 focus:ring-0 placeholder:text-black placeholder:font-semibold placeholder:text-sm"
                                placeholder="Add Comment..." rows="5"></textarea>
                            <div class="relative w-full h-56 bg-gray-200 rounded-2xl mt-6 bg-cover bg-center"
                                :style="{ backgroundImage: `url(${reviewForm.photoPreview})` }">
                                <input id="add-review-media" type="file" accept="image/*" class="hidden"
                                    @change="changeReviewPhoto">
                                <label for="add-review-media"
                                    class="absolute inset-0 flex justify-center items-center cursor-pointer">
                                    <div v-if="!reviewForm.photoPreview" class="text-gray-500">Upload file</div>
                                </label>
                                <label for="add-review-media"
                                    class="absolute bottom-3 right-3 bg-white p-2 rounded-lg cursor-pointer">
                                    <img src="/img/assets/icon/icon_admin_category_upload.svg" alt="Upload Icon"
                                        class="h-6 w-6">
                                </label>
                            </div>
                            <button type="submit"
                                class="w-fit bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white text-lg font-semibold rounded-2xl py-2 px-16 ml-auto mt-6">Save</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Success Review Modal -->
            <div v-if="successReviewModalVisible"
                class="fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-50"
                @click="successReviewModalVisible = false">
                <div class="bg-white w-[28vw] h-auto rounded-[30px] shadow p-14">
                    <h1 class="text-black text-xl font-medium mx-auto">Your Review Has Been Added!</h1>
                    <img src="/img/assets/icon/icon_green_check.svg" alt="green_check" class="w-24 h-24 mx-auto mt-6">
                </div>
            </div>
        </div>
    </Layout>
</template>