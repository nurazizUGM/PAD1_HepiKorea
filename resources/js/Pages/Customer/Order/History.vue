<script>
import axios from 'axios';
import moment from 'moment';
import { computed, onBeforeUnmount, onMounted, ref, watch } from 'vue';
import { route } from 'ziggy-js';
import Layout from '../../Layouts/Customer.vue';

export default {
    components: { Layout },
    props: {
        status: String
    },
    setup(props) {
        const activeTab = ref(props.status || 'unpaid');
        const tabs = [
            { id: 'unpaid', label: 'Unpaid' },
            { id: 'processed', label: 'Processed' },
            { id: 'sent', label: 'Sent' },
            { id: 'finished', label: 'Finished' },
        ];

        const unpaidOrders = ref([]);
        const processedOrders = ref([]);
        const sentOrders = ref([]);
        const finishedOrders = ref([]);

        // Modal States
        const reviewModalVisible = ref(false);
        const successReviewModalVisible = ref(false);

        // Review Form
        const reviewForm = ref({
            orderId: null,
            rating: 0,
            content: '',
            photo: null,
            photoPreview: null,
        });

        // Error message for review form
        const reviewError = ref('');

        // Methods
        const setActiveTab = (tab) => {
            activeTab.value = tab;
            window.history.pushState({}, '', route('order.history', { status: tab }));
            fetchData();
        };

        const getImageUrl = (image) => {
            if (!image) return '/img/assets/icon/icon_admin_order_product.svg';
            if (/^http/.test(image)) return image;
            return `/api/file?path=${image}`;
        };

        const formatPrice = (price) => {
            return price?.toString()?.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        };

        const paymentCheck = ref(null);
        const paymentModal = ref(false);
        const remainingTime = computed(() => {
            if (paymentDetails.value?.expired_at) {
                const now = moment();
                const end = moment(paymentDetails.value.expired_at);
                const duration = moment.duration(end.diff(now));
                return `${duration.days()} days, ${duration.hours()} hours, ${duration.minutes()} minutes`;
            }
            return 'N/A';
        });
        const paymentDetails = ref({
            id: null,
            expired_at: null,
            amount: 0,
            payment_method: '',
            payment_code: '',
            transaction_id: '',
        });

        const pay = (payment) => {
            paymentDetails.value = payment
            paymentModal.value = true;
            if (paymentCheck.value) {
                clearInterval(paymentCheck.value);
            }

            paymentCheck.value = setInterval(() => {
                axios.get(`/api/order/payment/${paymentDetails.value.id}`)
                    .then(({ data }) => {
                        if (data.status == 'success') {
                            clearInterval(paymentCheck.value);
                            paymentModal.value = false
                            if (data.order.status == 'shipment_paid') {
                                fetchData()
                            } else {
                                setActiveTab('processed');
                            }
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
        };

        const cancelOrderId = ref(null);
        const cancelOrder = (orderId, confirmed = false) => {
            if (confirmed) {
                axios.post(`/api/order/${orderId}/cancel`)
                    .then(() => {
                        cancelOrderId.value = null;
                        setActiveTab('finished');
                    })
                    .catch(err => {
                        console.error('Error cancelling payment:', err);
                    });
            } else {
                cancelOrderId.value = orderId;
            }
        };

        function copyPaymentCode() {
            navigator.clipboard.writeText(paymentDetails.value.payment_code)
                .then(() => {
                    console.log('Payment code copied to clipboard');
                })
                .catch(err => {
                    console.error('Failed to copy payment code:', err);
                });
        }

        const shipmentDetail = ref(null)
        const shipmentPaymentModal = ref(false);
        const shipmentPaymentMethod = ref(null);
        const payShipment = () => {
            axios.post(`/api/order/${shipmentDetail.value.order_id}/pay-shipment`, {
                payment_method: shipmentPaymentMethod.value
            }).then(({ data }) => {
                if (data?.status != 'success') {
                    return console.error(data)
                }
                shipmentDetail.value = null;
                shipmentPaymentModal.value = null
                pay(data.payment)
            })
        };

        const successReceiveModal = ref(false);
        const confirmArrival = (orderId) => {
            axios.post(`/api/order/${orderId}/arrived`).then(({ data }) => {
                successReceiveModal.value = true;
                fetchData()
                setTimeout(() => {
                    successReceiveModal.value = false;
                }, 2000);
            })
        }

        const showReviewModal = (orderId) => {
            reviewForm.value = {
                orderId: orderId,
                rating: 0,
                content: '',
                photo: null,
                photoPreview: null,
            }
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

        // const submitReview = async () => {
        //     const formData = new FormData();
        //     formData.append('rating', reviewForm.value.rating);
        //     formData.append('content', reviewForm.value.content);
        //     if (reviewForm.value.photo) {
        //         formData.append('photo', reviewForm.value.photo);
        //     }
        //     try {
        //         await axios.post(`/api/order/${reviewForm.value.orderId}/review`, formData);
        //     } catch (error) {
        //         console.error('Error submitting review:', error);
        //         return error;
        //     }

        //     reviewModalVisible.value = false;
        //     successReviewModalVisible.value = true;
        //     setTimeout(() => {
        //         fetchData();
        //         successReviewModalVisible.value = false;
        //     }, 2000);
        // };

        const submitReview = async () => {
            reviewError.value = ''; // Reset error before submission
            const formData = new FormData();
            formData.append('rating', reviewForm.value.rating);
            formData.append('content', reviewForm.value.content);
            if (reviewForm.value.photo) {
                formData.append('photo', reviewForm.value.photo);
            }
            try {
                await axios.post(`/api/order/${reviewForm.value.orderId}/review`, formData);
                reviewModalVisible.value = false;
                successReviewModalVisible.value = true;
                setTimeout(() => {
                    fetchData();
                    successReviewModalVisible.value = false;
                }, 2000);
            } catch (error) {
                if (error.response && error.response.status === 422) {
                    console.error('Error submitting review:', error);
                    const errors = error.response.data.errors || {};
                    if (errors.rating) {
                        reviewError.value = 'Please select a star rating';
                    } else {
                        reviewError.value = 'Failed to submit review. Please try again.';
                    }
                } else {
                    console.error('Error submitting review:', error);
                    reviewError.value = 'An unexpected error occurred.';
                }
            }
        };

        const orderStatus = (status) => {
            return status.replace(/_/g, ' ').replace(/\b\w/g, char => char.toUpperCase());
        }

        const orderPayment = (order) => {
            if (!order.order_payment || order.order_payment.length == 0) return null;
            return order.order_payment.find(payment => payment.status === 'pending' && moment(payment.expired_at).isAfter(moment()));
        }

        const formatTime = (date) => {
            return moment(date).locale('id').format('DD MMMM YYYY HH:mm');
        };

        // Fetch Data (Uncomment dan sesuaikan saat menggunakan API)
        const fetchData = async () => {
            try {
                fetch(`/api/order?status=${activeTab.value}`)
                    .then(response => response.json())
                    .then(data => {
                        switch (activeTab.value) {
                            case 'unpaid':
                                unpaidOrders.value = data.map(order => ({
                                    ...order,
                                    payment: orderPayment(order),
                                }));
                                break;
                            case 'processed':
                                processedOrders.value = data;
                                break;
                            case 'sent':
                                sentOrders.value = data.map(order => ({
                                    ...order,
                                    payment: orderPayment(order)
                                }));
                                break;
                            case 'finished':
                                finishedOrders.value = data;
                                break;
                        }
                    });
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        };

        onMounted(() => {
            fetchData();
        });

        onBeforeUnmount(() => {
            if (paymentCheck.value) {
                clearInterval(paymentCheck.value);
            }
        });

        watch(paymentModal, (newValue) => {
            if (!newValue) {
                if (paymentCheck.value) {
                    clearInterval(paymentCheck.value);
                }
                paymentCheck.value = null;
                paymentDetails.value = {};
            }
        });

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
            showReviewModal,
            shipmentDetail,
            shipmentPaymentModal,
            shipmentPaymentMethod,
            payShipment,
            successReceiveModal,
            confirmArrival,
            reviewModalVisible,
            successReviewModalVisible,
            reviewForm,
            setRating,
            changeReviewPhoto,
            submitReview,
            orderStatus,
            formatTime,
            remainingTime,
            pay,
            paymentModal,
            paymentDetails,
            getBankLogo,
            copyPaymentCode,
            cancelOrder,
            cancelOrderId,
            moment,
            reviewError
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
                        <button
                            class="inline-block p-4 border-b-4 rounded-t-lg text-xs md:text-sm lg:text-xl font-semibold"
                            :class="{ 'text-black border-orange-400 hover:opacity-70': activeTab === tab.id, 'text-black hover:border hover:border-b-orange-300 hover:border-b-4 hover:text-orange-400 border-transparent': activeTab !== tab.id }"
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
                            <div class="w-[20%] hidden md:flex mr-1 lg:mr-2">
                                <img :src="getImageUrl(order.image)" alt="unpaid_image_product"
                                    class="h-14 md:h-32 lg:h-48 object-contain mx-auto hover:opacity-80 cursor-pointer" @click="$inertia.get(route('order.show', order.id))">
                            </div>
                            <div class="w-full md:w-[80%] flex flex-col">
                                <div class="w-full h-fit md:h-1/2 lg:h-1/2 flex flex-row justify-center mt-1">
                                    <!-- ini nanti muncul pas mobile -->
                                    <div class="md:w-[20%] md:hidden flex mr-1 lg:mr-0">
                                        <img :src="getImageUrl(order.image)" alt="unpaid_image_product"
                                            class="h-14 lg:h-48 object-contain mx-auto">
                                    </div>
                                    <div class="md:w-[34%] lg:w-[33%] h-full flex flex-col">
                                        <h1 class="text-black font-semibold text-[9px] md:text-xs lg:text-xl cursor-pointer hover:text-orange-400"
                                            @click="$inertia.get(route('order.show', order.id))">
                                            {{ order.title }}
                                        </h1>
                                        <p v-if="order.count > 1"
                                            class="text-black text-opacity-50 font-semibold text-[9px] md:text-xs lg:text-xl">
                                            and {{ order.count - 1 }} other items
                                        </p>
                                    </div>
                                    <div class="md:w-[22%] ms-auto h-full flex">
                                        <p
                                            class="text-[#3E6E7A] text-[9px] md:text-sm lg:text-xl font-semibold ml-auto">
                                            Rp {{
                                                formatPrice(order.total_items_price) }}</p>
                                    </div>
                                </div>
                                <div class="w-full h-fit md:h-1/2 lg:h-1/2 flex flex-row mt-1 lg:mt-0">
                                    <div v-if="order.payment" class="w-1/2 mt-auto lg:my-0 mr-1 lg:mr-0">
                                        <div
                                            class="w-full h-fit lg:h-full bg-[#3E6E7A] text-white font-semibold text-[8px] md:text-[10px] lg:text-base rounded-lg lg:rounded-2xl shadow-md p-1 md:p-3 lg:p-4">
                                            <p>Bayar sebelum {{ formatTime(order.payment.expired_at)
                                                }} dengan {{ order.payment.payment_method?.toUpperCase() }}</p>
                                        </div>
                                    </div>
                                    <div
                                        class="w-1/2 ml-auto flex flex-row justify-end items-center md:mt-auto md:mb-1.5 lg:my-0">
                                        <button v-if="order.payment"
                                            class="w-1/2 lg:w-5/12 h-fit rounded-2xl bg-white hover:bg-slate-50 border-2 border-[#3E6E7A] text-[8px] md:text-xs lg:text-xl text-[#3E6E7A] md:py-1 lg:py-3"
                                            @click="pay(order.payment)">
                                            Pay Product
                                        </button>
                                        <button
                                            class="w-1/2 lg:w-5/12 h-fit rounded-2xl bg-white hover:bg-slate-50 border-2 border-[#3E6E7A] text-[8px] md:text-xs lg:text-xl text-[#3E6E7A] md:py-1 lg:py-3 ml-1 lg:ml-4"
                                            @click="cancelOrder(order.id)">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-if="unpaidOrders.length == 0"
                            class="w-full h-fit min-h-[94px] md:min-h-[164px] lg:h-full bg-white rounded-2xl flex flex-row p-2 md:p-4 lg:py-8 lg:px-8">
                            <div class="flex flex-col items-center justify-center w-full py-8">
                                <p class="text-[#B7B7B7] text-base md:text-lg font-semibold">No unpaid orders found.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Processed Tab -->
                <div v-if="activeTab === 'processed'" class="p-1 lg:p-4 rounded-lg">
                    <div class="w-full h-full flex flex-col gap-y-2 md:gap-y-4 lg:gap-y-6">
                        <div v-for="order in processedOrders" :key="order.id"
                            class="w-full h-fit min-h-[94px] md:min-h-[164px] lg:h-full bg-white rounded-2xl flex flex-row p-2 md:p-4 lg:py-8 lg:px-8">
                            <div class="w-[20%] hidden md:flex mr-1 lg:mr-2">
                                <img :src="getImageUrl(order.image)" alt="processed_image_product"
                                    class="h-14 md:h-32 lg:h-48 object-contain mx-auto hover:opacity-80 cursor-pointer" @click="$inertia.get(route('order.show', order.id))">
                            </div>
                            <div class="w-full md:w-[80%] flex flex-col">
                                <div class="w-full h-fit md:h-1/2 lg:h-1/2 flex flex-row justify-center mt-1">
                                    <!-- ini nanti muncul pas mobile -->
                                    <div class="md:w-[20%] md:hidden flex mr-1 lg:mr-0">
                                        <img :src="getImageUrl(order.image)" alt="processed_image_product"
                                            class="h-14 lg:h-48 object-contain mx-auto">
                                    </div>
                                    <div class="md:w-[34%] lg:w-[33%] h-full flex flex-col">
                                        <h1 class="text-black font-semibold text-[9px] md:text-xs lg:text-xl cursor-pointer hover:text-orange-400"
                                            @click="$inertia.get(route('order.show', order.id))">
                                            {{ order.title }}
                                        </h1>
                                        <p v-if="order.count > 1"
                                            class="text-black text-opacity-50 font-semibold text-[9px] md:text-xs lg:text-xl">
                                            and {{ order.count - 1 }} other items
                                        </p>
                                    </div>
                                    <div class="w-[22%] ms-auto h-full flex">
                                        <p
                                            class="text-[#3E6E7A] text-[9px] md:text-sm lg:text-xl font-semibold ml-auto">
                                            Rp {{
                                                formatPrice(order.total_items_price) }}</p>
                                    </div>
                                </div>
                                <div class="w-full h-fit md:h-1/2 lg:h-1/2 flex flex-row mt-1 lg:mt-0">
                                    <div class="w-4/6 md:w-1/2 mx-auto">
                                        <div
                                            class="w-full h-full flex bg-[#3E6E7A] text-white font-semibold text-[7px] md:text-xs lg:text-base rounded-lg lg:rounded-2xl shadow-md p-1 md:p-2 lg:p-4 hover:opacity-90 cursor-pointer" @click="$inertia.get(route('order.show', order.id))">
                                            <p class="my-auto">
                                                <span v-if="order.estimated_arrival">
                                                    Estimated Arrival in Indonesia:
                                                    {{ moment(order.estimated_arrival).format('DD MMMM YYYY') }}
                                                </span>
                                                <br>
                                                {{
                                                    order.status === 'processing' ?
                                                        'The order is on its way to Indonesia' :
                                                        'The order is currently awaiting administrator confirmation'
                                                }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-if="processedOrders.length == 0"
                            class="w-full h-fit min-h-[94px] md:min-h-[164px] lg:h-full bg-white rounded-2xl flex flex-row p-2 md:p-4 lg:py-8 lg:px-8">
                            <div class="flex flex-col items-center justify-center w-full py-8">
                                <p class="text-[#B7B7B7] text-base md:text-lg font-semibold">No processed orders found.
                                </p>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Sent Tab -->
                <div v-if="activeTab === 'sent'" class="p-1 lg:p-4 rounded-lg">
                    <div class="w-full h-full flex flex-col gap-y-2 md:gap-y-4 lg:gap-y-6">
                        <div v-for="order in sentOrders" :key="order.id"
                            class="w-full h-fit min-h-[94px] md:min-h-[164px] lg:h-full bg-white rounded-2xl flex flex-row p-2 md:p-4 lg:py-8 lg:px-8">
                            <div class="w-[20%] hidden md:flex mr-1 lg:mr-2">
                                <img :src="getImageUrl(order.image)" alt="sent_image_product"
                                    class="h-14 md:h-32 lg:h-48 object-contain mx-auto hover:opacity-80 cursor-pointer" @click="$inertia.get(route('order.show', order.id))">
                            </div>
                            <div class="w-full md:w-[80%] flex flex-col">
                                <div class="w-full h-fit md:h-1/2 lg:h-1/2 flex flex-row justify-center mt-1">
                                    <div class="md:w-[20%] md:hidden flex mr-1 lg:mr-0">
                                        <img :src="getImageUrl(order.image)" alt="sent_image_product"
                                            class="h-14 lg:h-48 object-contain mx-auto hover:opacity-80 cursor-pointer">
                                    </div>
                                    <div class="md:w-[34%] lg:w-[33%] h-full flex flex-col">
                                        <h1 class="text-black font-semibold text-[9px] md:text-xs lg:text-xl cursor-pointer hover:text-orange-400"
                                            @click="$inertia.get(route('order.show', order.id))">
                                            {{ order.title }}
                                        </h1>
                                        <p v-if="order.order_items > 1"
                                            class="text-black text-opacity-50 font-semibold text-[9px] md:text-xs lg:text-xl">
                                            and {{ order.order_items - 1 }} other items
                                        </p>
                                    </div>
                                    <div class="w-[22%] ms-auto h-full flex">
                                        <p
                                            class="text-[#3E6E7A] text-[9px] md:text-sm lg:text-xl font-semibold ml-auto">
                                            Rp {{
                                                formatPrice(order.total_items_price)
                                            }},-</p>
                                    </div>
                                </div>
                                <div class="w-full h-fit md:h-1/2 lg:h-1/2 flex flex-row mt-1 lg:mt-0">
                                    <div class="w-[52%] flex items-end">
                                        <div
                                            class="w-full h-fit lg:h-full bg-[#3E6E7A] text-white font-semibold text-[8px] md:text-[10px] lg:text-base rounded-lg lg:rounded-2xl shadow-md p-1 md:p-3 lg:p-4 hover:opacity-90 cursor-pointer" @click="$inertia.get(route('order.show', order.id))">
                                            <p class="my-auto">
                                                {{
                                                    order.status === 'shipment_unpaid' ?
                                                        'Waiting for payment of the shipment' :
                                                        order.status === 'shipment_paid' ?
                                                            'Waiting for the shipment to be sent' :
                                                            'The order is on its way to Destination Address'
                                                }}
                                                <span
                                                    v-if="order.status == 'sent' && order.order_shipment?.arrival_estimation">
                                                    <br>
                                                    Estimated Arrival: {{ moment(order.order_shipment.arrival_estimation)
                                                        .format('DD MMMM YYYY') }}
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="w-[48%] ms-auto flex flex-row justify-end items-end">
                                        <button v-if="order.status === 'sent'"
                                            class="w-1/2 lg:w-5/12 h-fit rounded-2xl bg-white hover:bg-slate-50 border-2 border-[#3E6E7A] text-[8px] md:text-xs lg:text-xl text-[#3E6E7A] md:py-1 lg:py-3"
                                            @click="confirmArrival(order.id)">
                                            Confirm Arrival
                                        </button>
                                        <button v-else-if="order.order_shipment"
                                            class="w-1/2 lg:w-5/12 h-fit rounded-2xl bg-white hover:bg-slate-50 border-2 border-[#3E6E7A] text-[8px] md:text-xs lg:text-xl text-[#3E6E7A] md:py-1 lg:py-3"
                                            @click="shipmentDetail = { ...order.order_shipment, status: order.status }">
                                            {{
                                                order.status === 'shipment_unpaid' ? 'Pay Shipment' : 'Shipment Detail'
                                            }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div v-if="sentOrders.length == 0"
                            class="w-full h-fit min-h-[94px] md:min-h-[164px] lg:h-full bg-white rounded-2xl flex flex-row p-2 md:p-4 lg:py-8 lg:px-8">
                            <div class="flex flex-col items-center justify-center w-full py-8">
                                <p class="text-[#B7B7B7] text-base md:text-lg font-semibold">No sent orders found.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Finish Tab -->
                <div v-if="activeTab === 'finished'" class="p-1 lg:p-4 rounded-lg">
                    <div class="w-full h-full flex flex-col gap-y-2 md:gap-y-4 lg:gap-y-6">
                        <div v-for="order in finishedOrders" :key="order.id"
                            class="w-full h-fit min-h-[94px] md:min-h-[164px] lg:h-full bg-white rounded-2xl flex flex-row p-2 md:p-4 lg:py-8 lg:px-8">
                            <div class="w-[20%] hidden md:flex mr-1 lg:mr-2">
                                <img :src="getImageUrl(order.image)" alt="finish_image_product"
                                    class="h-14 md:h-32 lg:h-48 object-contain mx-auto hover:opacity-80 cursor-pointer" @click="$inertia.get(route('order.show', order.id))">
                            </div>
                            <div class="w-full md:w-[80%] flex flex-col">
                                <div class="w-full h-fit md:h-1/2 lg:h-1/2 flex flex-row justify-center mt-1">
                                    <!-- ini nanti muncul pas mobile -->
                                    <div class="md:w-[20%] md:hidden flex mr-1 lg:mr-0">
                                        <img :src="getImageUrl(order.image)" alt="finish_image_product"
                                            class="h-14 lg:h-48 object-contain mx-auto">
                                    </div>
                                    <div class="md:w-[34%] lg:w-[33%] h-full flex flex-col">
                                        <h1 class="text-black font-semibold text-[9px] md:text-xs lg:text-xl cursor-pointer hover:text-orange-400"
                                            @click="$inertia.get(route('order.show', order.id))">
                                            {{ order.title }}
                                        </h1>
                                        <p v-if="order.count > 1"
                                            class="text-black text-opacity-50 font-semibold text-[9px] md:text-xs lg:text-xl">
                                            and {{ order.count - 1 }} other items
                                        </p>

                                    </div>
                                    <div class="md:w-[22%] ms-auto h-full flex">
                                        <p
                                            class="text-[#3E6E7A] text-[9px] md:text-sm lg:text-xl font-semibold ml-auto">
                                            Rp {{
                                                formatPrice(order.total_items_price)
                                            }},-</p>
                                    </div>
                                </div>
                                <div class="w-full h-fit md:h-1/2 lg:h-1/2 flex flex-row mt-1 lg:mt-0">
                                    <div class="w-1/2 mt-auto lg:my-0 mr-1 lg:mr-0">
                                        <div
                                            class="w-fit bg-[#3E6E7A] text-white font-semibold text-[8px] md:text-[10px] lg:text-base rounded-lg lg:rounded-2xl shadow-md p-1 md:py-2 md:px-3 hover:opacity-90 cursor-pointer" @click="$inertia.get(route('order.show', order.id))">
                                            <p>Status: {{ orderStatus(order.status) }}</p>
                                        </div>
                                    </div>
                                    <div v-if="!order.reviews?.length && order.status === 'finished'"
                                        class="w-1/2 flex flex-row justify-end md:items-end">
                                        <button
                                            class="w-[20%] h-fit rounded-2xl bg-white hover:bg-slate-50 border-2 border-[#3E6E7A] text-[8px] md:text-xs lg:text-xl text-[#3E6E7A] md:py-1 lg:py-3"
                                            @click="showReviewModal(order.id)">
                                            Review
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div v-if="finishedOrders.length == 0"
                            class="w-full h-fit min-h-[94px] md:min-h-[164px] lg:h-full bg-white rounded-2xl flex flex-row p-2 md:p-4 lg:py-8 lg:px-8">
                            <div class="flex flex-col items-center justify-center w-full py-8">
                                <p class="text-[#B7B7B7] text-base md:text-lg font-semibold">No finished orders found.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modals -->
            <!-- Payment Modal -->
            <div v-if="paymentModal" class="fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-50">
                <div class="bg-white w-[70vw] md:w-[60vw] lg:w-[50vw] h-auto rounded-[30px] shadow p-4">
                    <div class="relative w-full h-full flex flex-row">
                        <button @click="paymentModal = false"
                            class="absolute bg-black w-6 h-6 flex flex-col align-middle text-center items-center scale-90 rounded-full pb-3 -top-5 -right-4 lg:-top-5 lg:-right-5">
                            <p class="m-auto text-white text-base">X</p>
                        </button>

                        <!-- pembayaran qris -->
                        <div v-if="paymentDetails.payment_method == 'qris'"
                            class="w-full h-full flex flex-col md:px-10 md:pt-5 md:pb-5 lg:px-14 lg:pt-10 lg:pb-2">
                            <h1 class="text-black font-bold text-xs md:text-sm lg:text-2xl">Payment</h1>
                            <div class="w-full h-fit flex flex-row mt-3">
                                <div class="w-[70%]">
                                    <p
                                        class="text-[#898383] text-[8px] md:text-[10px] lg:text-sm font-bold mr-auto mb-auto">
                                        Total Payment</p>
                                </div>
                                <div class="w-[30%]">
                                    <p class="text-[#3E6E7A] text-[8px] md:text-[10px] lg:text-sm font-bold mr-auto">Rp
                                        {{
                                            formatPrice(paymentDetails.amount)
                                        }}</p>
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
                                        remainingTime
                                        }}</p>
                                    <p class="text-[#B7B7B7] text-[8px] md:text-[10px] lg:text-sm font-medium">Pay
                                        Before:
                                        <br>
                                        {{ formatTime(paymentDetails.expired_at) }}
                                    </p>
                                </div>
                            </div>
                            <!-- !!! QR CODE NYA MASI STATIS !!!! -->
                            <!-- <img src="/img/example/example_qrscan.svg" alt="" loading="lazy"
                                class="mx-auto w-[156px] lg:w-52 object-contain"> -->
                            <img :src="paymentDetails.payment_code" alt="" loading="lazy"
                                class="mx-auto w-[156px] lg:w-52 object-contain">
                            <!-- !!! QR CODE NYA MASI STATIS !!!! -->

                            <h2 class="text-black font-bold text-[8px] md:text-xs lg:text-base mt-2 md:mt-3 lg:mt-6">
                                eWallet Transfer Instructions
                            </h2>
                            <p
                                class="text-[#898383] font-bold text-[8px] md:text-[10px] lg:text-sm mt-1 md:mt-3 lg:mt-6">
                                1. Buka aplikasi eWallet Anda. <br>
                                2. Pilih menu Scan QR Code. <br>
                                3. Arahkan kamera ke QR Code di atas. <br>
                                4. Pastikan jumlah pembayaran sesuai dengan yang tertera di atas. <br>
                                5. Masukkan PIN eWallet Anda untuk menyelesaikan pembayaran. <br>
                                6. Pembayaran akan terverifikasi secara otomatis
                            </p>
                        </div>

                        <!-- Pembayaran VA -->
                        <div v-else
                            class="w-full h-full flex flex-col md:px-10 md:pt-5 md:pb-5 lg:px-14 lg:pt-10 lg:pb-2">
                            <h1 class="text-black font-bold text-xs lg:text-2xl">Payment</h1>
                            <div class="w-full h-fit flex flex-row mt-3">
                                <div class="w-[70%]">
                                    <p
                                        class="text-[#898383] text-[8px] md:text-[10px] lg:text-sm font-bold mr-auto mb-auto">
                                        Total Payment</p>
                                </div>
                                <div class="w-[30%]">
                                    <p class="text-[#3E6E7A] text-[8px] md:text-[10px] lg:text-sm font-bold mr-auto">{{
                                        formatPrice(paymentDetails.amount)
                                        }}</p>
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
                                        remainingTime
                                        }}</p>
                                    <p class="text-[#B7B7B7] text-[8px] md:text-[10px] lg:text-sm font-medium">Pay
                                        Before:
                                        <br>
                                        {{ formatTime(paymentDetails.expired_at) }}
                                    </p>
                                </div>
                            </div>
                            <div class="w-full h-fit flex flex-row">
                                <div class="w-[10%] flex">
                                    <img :src="getBankLogo(paymentDetails.payment_method)" alt=""
                                        class="w-3/5 object-contain mb-auto">
                                </div>
                                <div class="w-[90%] flex flex-col">
                                    <p class="text-[#898383] font-bold text-[8px] md:text-[10px] lg:text-sm">{{
                                        paymentDetails.payment_method }}</p>
                                    <p
                                        class="text-[#898383] font-bold text-[8px] md:text-[10px] lg:text-sm mt-2 md:mt-3 lg:mt-6">
                                        No. Virtual Account:</p>
                                    <div class="w-full h-fit flex flex-row items-center mt-1">
                                        <div class="w-[67%]">
                                            <h1 class="text-[#3E6E7A] font-bold text-xs md:text-sm lg:text-2xl">{{
                                                paymentDetails.payment_code }}
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
                            <p
                                class="text-[#898383] font-bold text-[8px] md:text-[10px] lg:text-sm mt-1 md:mt-3 lg:mt-6">
                                1. Masuk ke menu Mobile Banking. Kemudian, pilih Pembayaran / Virtual account. <br>
                                2. Masukkan {{ paymentDetails.payment_code }}. <br>
                                3. Masukkan PIN Anda kemudian pilih bayar. Apabila pesan konfirmasi untuk <br>
                                4. transaksi menggunakan SMS muncul, pilih OK. Status transaksi akan <br>
                                5. dikirimkan melalui SMS dan dapat digunakan sebagai bukti pembayaran.
                            </p>
                            <h2
                                class="text-black font-bold text-[8px] md:text-[10px] lg:text-base mt-2 md:mt-3 lg:mt-4">
                                ATM
                                Transfer Instructions</h2>
                            <p
                                class="text-[#898383] font-bold text-[8px] md:text-[10px] lg:text-sm mt-1 md:mt-3 lg:mt-6">
                                1. Pilih Transaksi Lain > Pembayaran > Lainnya > BRIVA. <br>
                                2. Masukkan Nomor BRIVA {{ paymentDetails.payment_code }} kemudian pilih Benar. <br>
                                3. Periksa informasi yang tertera di layar. Pastikan Merchant adalah *nama*, <br>
                                4. Total tagihan sudah benar dan username kamu azkialbab. Jika benar, pilih Ya.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cancel Modal -->
            <div v-if="cancelOrderId"
                class="fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-50">
                <div class="bg-white md:w-[50vw] lg:w-[33vw] h-auto rounded-[30px] shadow p-4">
                    <div class="flex flex-col px-10 py-10">
                        <img src="/img/assets/icon/icon_warning.svg" alt="icon_warning" class="w-16 h-16 mx-auto">
                        <p class="text-[#376F7E] font-medium text-xl mx-auto mt-2">Are you sure?</p>
                        <p class="text-[#B7B7B7] font-medium text-xs mx-auto mt-6">You won’t be able to revert this!</p>
                        <div class="w-full mt-6 flex flex-row justify-center">
                            <button @click="cancelOrder(cancelOrderId, true)"
                                class="w-44 h-11 bg-[#376F7E] rounded-[20px] shadow-lg text-white text-lg font-semibold">Yes,
                                Delete it!</button>
                            <button @click="cancelOrderId = null"
                                class="w-44 h-11 bg-[#FF9D66] rounded-[20px] shadow-lg text-white text-lg font-semibold ml-2">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Shipment Modal -->
            <div v-if="shipmentDetail && !shipmentPaymentModal"
                class="fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-50"
                @click.self="shipmentDetail = null">
                <div
                    class="bg-white w-[60vw] md:w-[40vw] lg:w-[41vw] h-auto rounded-[20px] lg:rounded-[30px] shadow p-4 relative">
                    <button
                        class="absolute bg-black w-6 h-6 flex items-center justify-center rounded-full -top-2 -right-2 lg:-top-1 lg:-right-1 scale-75 md:scale-[85%] lg:scale-100"
                        @click="shipmentDetail = null">
                        <p class="text-white text-md">X</p>
                    </button>
                    <div class="w-full h-full flex flex-col px-2.5 pt-3 pb-2.5 lg:px-10 lg:pt-10 lg:pb-5">
                        <h1 class="text-black font-bold text-[10px] md:text-base lg:text-2xl">Detail Shipment</h1>
                        <div class="w-full h-full flex flex-col gap-y-6 mt-6">
                            <div class="w-full h-fit flex flex-row">
                                <div class="w-[67%] text-[8px] md:text-xs lg:text-sm text-[#898383] font-bold">
                                    Expedition Name</div>
                                <div class="w-[33%] text-[8px] md:text-xs lg:text-sm text-[#3E6E7A] font-bold">{{
                                    shipmentDetail?.shipment_service
                                }}</div>
                            </div>
                            <div v-if="shipmentDetail.tracking_code" class="w-full h-fit flex flex-row">
                                <div class="w-[67%] text-[8px] md:text-xs lg:text-sm text-[#898383] font-bold">
                                    Tracking Code
                                </div>
                                <div class="w-[33%] text-[8px] md:text-xs lg:text-sm text-[#3E6E7A] font-bold">{{
                                    shipmentDetail?.tracking_code
                                }}</div>
                            </div>
                            <div class="w-full h-fit flex flex-row">
                                <div class="w-[67%] text-[8px] md:text-xs lg:text-sm text-[#898383] font-bold">Total
                                    Expedition Payment</div>
                                <div class="w-[33%] text-[8px] md:text-xs lg:text-sm text-[#3E6E7A] font-bold">Rp {{
                                    formatPrice(shipmentDetail?.price) }},-</div>
                            </div>
                            <div class="w-full h-fit flex flex-row">
                                <div class="w-[67%] text-[8px] md:text-xs lg:text-sm text-[#898383] font-bold">Estimated
                                    Arrival Time</div>
                                <div class="w-[33%] text-[8px] md:text-xs lg:text-sm text-[#3E6E7A] font-bold">{{
                                    moment(shipmentDetail?.arrival_estimation).format('DD MMM YYYY')
                                    }}</div>
                            </div>
                        </div>
                        <button v-if="shipmentDetail.status === 'shipment_unpaid'"
                            class="w-fit bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white text-[10px] md:text-xs lg:text-lg font-semibold rounded-lg lg:rounded-2xl py-1 md:py-1.5 lg:py-2 px-6 md:px-8 lg:px-16 ml-auto mt-6"
                            @click="shipmentPaymentModal = true">
                            Pay
                        </button>
                    </div>
                </div>
            </div>

            <!-- Choose Payment Modal -->
            <div v-if="shipmentPaymentModal"
                class="fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-50"
                @click.self="shipmentPaymentModal = false">
                <div class="bg-white w-[60vw] md:w-[40vw] lg:w-[25vw] h-auto rounded-[30px] shadow p-4 relative">
                    <button
                        class="absolute bg-black w-6 h-6 flex items-center justify-center rounded-full -top-2 -right-2 lg:-top-1 lg:-right-1 scale-75 md:scale-[85%] lg:scale-100"
                        @click="shipmentPaymentModal = false">
                        <p class="text-white text-md">X</p>
                    </button>
                    <div class="w-full h-full flex flex-col py-1 px-2 md:p-2 lg:px-10 lg:py-10">
                        <form @submit.prevent="payShipment" class="w-full h-full flex flex-col">
                            <h1 class="text-[#898383] text-opacity-60 font-bold text-[10px] md:text-sm lg:text-xl">Bank
                            </h1>
                            <!-- <div class="w-full h-fit flex flex-row mt-2">
                                <img src="/img/assets/icon/icon_checkout_bri.svg" alt=""
                                    class="w-[40px] h-[12px] md:-24 md:h-10 object-contain">
                                <label for="bri"
                                    class="my-auto text-black font-bold text-[8px] md:text-xs lg:text-base ml-8">Bank
                                    BRI</label>
                                <input type="radio" v-model="shipmentPaymentMethod" value="bri" id="bri"
                                    class="ml-auto my-auto w-[12px] h-[12px] md:w-7 md:h-7 border-4 border-[#3E6E7A] checked:bg-[#3E6E7A] checked:ring-[#3E6E7A]">
                            </div> -->
                            <div class="w-full h-fit flex flex-row mt-4">
                                <img src="/img/assets/icon/logo_checkout_mandiri.png" alt=""
                                    class="w-[40px] h-[22px] md:w-28 md:h-12 object-contain">
                                <label for="mandiri"
                                    class="my-auto text-black font-bold text-[8px] md:text-xs lg:text-base ml-8 md:ml-4">Mandiri</label>
                                <input type="radio" v-model="shipmentPaymentMethod" value="mandiri" id="mandiri"
                                    class="ml-auto my-auto w-[12px] h-[12px] md:w-7 md:h-7 border-4 border-[#3E6E7A] checked:bg-[#3E6E7A] checked:ring-[#3E6E7A]">
                            </div>
                            <div class="w-full h-fit flex flex-row mt-4">
                                <img src="/img/assets/icon/icon_checkout_bca.svg" alt=""
                                    class="w-[40px] h-[14px] md:w-28 md:h-12 object-contain">
                                <label for="bca"
                                    class="my-auto text-black font-bold text-[8px] md:text-xs lg:text-base ml-8 md:ml-4">BCA</label>
                                <input type="radio" v-model="shipmentPaymentMethod" value="bca" id="bca"
                                    class="ml-auto my-auto w-[12px] h-[12px] md:w-7 md:h-7 border-4 border-[#3E6E7A] checked:bg-[#3E6E7A] checked:ring-[#3E6E7A]">
                            </div>
                            <h1 class="text-[#898383] text-opacity-60 font-bold text-[10px] md:text-sm lg:text-xl mt-6">
                                E-wallet</h1>
                            <div class="w-full h-fit flex flex-row mt-2">
                                <img src="/img/assets/icon/icon_checkout_gopay.svg" alt=""
                                    class="w-[42px] h-[11px] md:w-28 md:h-12 object-contain">
                                <label for="qris"
                                    class="my-auto text-black font-bold text-[8px] md:text-xs lg:text-base ml-8 md:ml-4">QRIS</label>
                                <input type="radio" v-model="shipmentPaymentMethod" value="qris" id="qris"
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

            <!-- Success Receive -->
            <div v-if="successReceiveModal"
                class="fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-50"
                @click="successReceiveModal = false">
                <div class="bg-white w-[45vw] md:w-[32vw] lg:w-[28vw] h-auto rounded-[30px] shadow p-3 md:p-7 lg:p-14">
                    <h1 class="text-black text-sm md:text-lg lg:text-xl font-medium mx-auto text-center">
                        Your Order Has Been Received!
                    </h1>
                    <img src="/img/assets/icon/icon_green_check.svg" alt="green_check"
                        class="w-10 h-10 md:w-16 md:h-16 lg:w-24 lg:h-24 mx-auto mt-2 md:mt-4 lg:mt-6">
                </div>
            </div>

            <!-- review Modal -->
            <div v-if="reviewModalVisible"
                class="fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-50"
                @click.self="reviewModalVisible = false">
                <div
                    class="bg-white w-[60vw] md:w-[38vw] lg:w-[30vw] h-auto rounded-[10px] lg:rounded-[30px] shadow p-2 lg:p-4 relative">
                    <button
                        class="absolute bg-black w-6 h-6 flex items-center justify-center rounded-full -top-2 -right-2 lg:-top-1 lg:-right-1 scale-75 md:scale-[85%] lg:scale-100"
                        @click="reviewModalVisible = false">
                        <p class="text-white text-md">X</p>
                    </button>
                    <div class="w-full h-full flex flex-col px-4 lg:px-10 pt-4 lg:pt-10 pb-4 lg:pb-5">
                        <h1 class="text-black font-bold text-[10px] md:text-sm lg:text-sm">Rating</h1>
                        <form @submit.prevent="submitReview" class="w-full h-full flex flex-col">
                            <input type="hidden" v-model="reviewForm.orderId">
                            <input type="hidden" v-model="reviewForm.rating">
                            <div class="flex flex-row gap-x-1 md:gap-x-2.5 lg:gap-x-4 my-3 lg:my-6">
                                <img v-for="n in 5" :key="n" src="/img/assets/icon/icon_review_star.svg" alt="star"
                                    class="w-[17px] h-[16px]  lg:w-[29px] lg:h-7 cursor-pointer"
                                    :class="{ 'grayscale': n > reviewForm.rating }" @click="setRating(n)">
                            </div>
                            <textarea v-model="reviewForm.content"
                                class="rounded-[10px] lg:rounded-2xl bg-gray-200 resize-none border-none text-[10px] lg:text-sm font-semibold focus:border-0 focus:ring-0 placeholder:text-black placeholder:font-semibold placeholder:text-[10px] lg:placeholder:text-sm h-[64px] md:h-[71px] lg:h-[106px]"
                                placeholder="Add Comment..." rows="5"></textarea>
                            <div class="relative w-full h-40 md:h-44 lg:h-56 bg-gray-200 rounded-[10px] lg:rounded-2xl mt-3 lg:mt-6 bg-cover bg-center"
                                :style="{ backgroundImage: `url(${reviewForm.photoPreview})` }">
                                <input id="add-review-media" type="file" accept="image/*" class="hidden"
                                    @change="changeReviewPhoto">
                                <label for="add-review-media"
                                    class="absolute inset-0 flex justify-center items-center cursor-pointer">
                                    <div v-if="!reviewForm.photoPreview"
                                        class="text-gray-500 text-xs md:text-sm lg:text-base">Upload file</div>
                                </label>
                                <label for="add-review-media"
                                    class="absolute bottom-1.5 right-1.5 lg:bottom-3 lg:right-3 bg-white p-0.5 lg:p-2 rounded lg:rounded-lg cursor-pointer">
                                    <img src="/img/assets/icon/icon_admin_category_upload.svg" alt="Upload Icon"
                                        class="w-3 h-3 md:w-4 md:h-4 lg:h-6 lg:w-6">
                                </label>
                            </div>
                            <button type="submit"
                                class="w-fit bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white text-[10px] md:text-xs lg:text-lg font-semibold rounded-md lg:rounded-2xl py-1 md:py-1.5 lg:py-2 px-7 md:px-8 lg:px-16 mx-auto mt-2.5 lg:mt-6">Save</button>
                        </form>
                        <!-- <p v-if="reviewForm.rating === 0 && submitReview" class="text-red-500 text-[10px] md:text-xs lg:text-sm mb-2">
                            Please select a star rating
                        </p> -->
                        <p v-if="reviewError" id="reviewErrorMessage"
                            class="text-red-500 text-[10px] md:text-xs lg:text-sm font-semibold mt-2 absolute top-0 md:top-0 lg:top-2 left-[25%] lg:left-[30%]">
                            {{ reviewError }}</p>
                    </div>
                </div>
            </div>

            <!-- Success Review Modal -->
            <div v-if="successReviewModalVisible"
                class="fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-50"
                @click="successReviewModalVisible = false">
                <div class="bg-white w-[45vw] md:w-[32vw] lg:w-[28vw] h-auto rounded-[30px] shadow p-3 md:p-7 lg:p-14">
                    <h1 class="text-black text-sm md:text-lg lg:text-xl font-medium mx-auto text-center">Your Review Has
                        Been Added!</h1>
                    <img src="/img/assets/icon/icon_green_check.svg" alt="green_check"
                        class="w-10 h-10 md:w-16 md:h-16 lg:w-24 lg:h-24 mx-auto mt-2 md:mt-4 lg:mt-6">
                </div>
            </div>
        </div>
    </Layout>
</template>