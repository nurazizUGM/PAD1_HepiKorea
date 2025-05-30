<script setup>
import Layout from '../Layouts/Customer.vue';
import { ref } from 'vue';

const listTutorial = ref([
    {
        id: 1,
        title: "Place an Order",
        list: [
            "Click the 'Checkout' button to open a pop-up for selecting a payment method.",
            "Choose your preferred payment method.",
            "View the payment details, including a Virtual Account (VA) code or a QRIS code.",
        ],
    },
    {
        id: 2,
        title: "Track Your Order",
        list: [
            "Wait for payment confirmation and check the 'Order History' section.",
            "Monitor the order status as it updates to 'Processing.' Your item will be shipped from Korea to Indonesia.",
        ],
    },
    {
        id: 3,
        title: "Wait for Arrival in Indonesia",
        list: [
            "Once the package arrives in Indonesia, check the order status, which will change to 'Sent.'",
            "Do not attempt to receive the package yet. You must pay the shipment fee first.",
        ],
    },
    {
        id: 4,
        title: "Pay for Shipment",
        list: [
            "Click the 'Pay Shipment' button in the 'Sent' step.",
            "Choose a payment method from the pop-up.",
            "Review the payment details and complete the payment.",
            "Wait for confirmation, and your package will be scheduled for delivery to your address.",
        ],
    },
    {
        id: 5,
        title: "Receive and Review Your Order",
        list: [
            "When the package arrives at your address, check the order status, which will change to 'Finished.'",
            "Click the 'Review' button.",
            "Write a review and submit your feedback for the product received.",
            "Complete the process, and enjoy your purchase!",
        ],
    },
]);

// Track expanded tutorial IDs
const expandedIds = ref([]);

// Toggle tutorial visibility by ID
const toggleTutorial = (id) => {
    if (expandedIds.value.includes(id)) {
        expandedIds.value = expandedIds.value.filter(expandedId => expandedId !== id);
    } else {
        expandedIds.value.push(id);
    }
};
</script>

<template>
    <Layout title="Request Order">
        <div class="w-full max-w-full rounded-3xl bg-[#EFEFEF] shadow-md overflow-hidden py-3 md:py-6 px-3 md:px-6">
            <!-- Welcome -->
            <section class="bg-white w-full flex flex-col rounded-xl pt-2 md:pt-4 pb-4 md:pb-8 px-4 md:px-8 lg:px-16">
                <h1 class="text-lg md:text-xl lg:text-2xl font-bold">Welcome!</h1>
                <p class="font-semibold text-xs md:text-sm lg:text-lg">
                    Once you've selected your items from your preferred Korean store, complete this form to place your
                    custom order and let us handle the rest.
                </p>
                <p class="font-semibold text-xs md:text-sm lg:text-lg mt-1 lg:mt-2">
                    Not sure where to look beyond HepiKorea? Feel free to use our search engine to explore other Korean
                    stores. Say goodbye to hopping between websites!
                </p>
            </section>

            <!-- Tutorial Section -->
            <section
                class="bg-white w-full flex flex-col rounded-xl pt-2 md:pt-4 pb-4 md:pb-8 px-4 md:px-8 lg:px-16 mt-6">
                <h1 class="mx-auto text-xs md:text-base lg:text-4xl font-semibold mb-4 lg:mb-8">Let’s Know the Order Tutorial</h1>

                <!-- Tutorial List -->
                <div class="w-full h-fit flex flex-col gap-y-4 lg:gap-y-8">
                    <div v-for="tutorial in listTutorial" :key="tutorial.id"
                        class="flex w-full md:w-full lg:w-full lg:min-h-[72px] rounded-full mx-auto relative">
                        <div
                            class="w-[90%] md:w-[90%] lg:w-[90%] min-h-[30px] md:min-h-[46px] lg:min-h-[72px] bg-white rounded-[5px] md:rounded-[30px] flex flex-col items-start shadow-md lg:shadow-lg justify-center relative ml-auto">
                            <!-- Title and Toggle -->
                            <div class="w-[90%] min-h-[30px] md:min-h-[46px] lg:min-h-[72px] flex items-center justify-start pl-[10%] cursor-pointer"
                                @click="toggleTutorial(tutorial.id)">
                                <span class="text-[#15575B] text-[9px] md:text-base lg:text-2xl font-semibold">
                                    {{ tutorial.title }}
                                </span>
                                <svg class="w-3 h-3 lg:w-8 lg:h-8 text-[#15575B] my-auto ml-auto transition-transform duration-300"
                                    :class="{ 'rotate-180': expandedIds.includes(tutorial.id) }" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </div>
                            <!-- Tutorial List Items -->
                            <div v-show="expandedIds.includes(tutorial.id)" class="px-[8%] pt-2 pb-10 mt-4 w-full">
                                <ul
                                    class="list-disc flex flex-col gap-y-4 text-[9px] md:text-base lg:text-2xl text-[#15575B]">
                                    <li v-for="textTutorials in tutorial.list" :key="textTutorials">
                                        {{ textTutorials }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Number Badge -->
                        <div
                            class="absolute bg-[#15575B] w-[12%] flex items-center justify-center h-[30px] md:h-[45px] lg:h-[72px] rounded-l-[5px] md:rounded-l-[30px] lg:rounded-l-full left-0 shadow-md">
                            <div
                                class="absolute -right-[5px] lg:-right-2 top-1/2 -translate-y-1/2 w-0 h-0 border-y-[8px] xl:border-y-[15px] border-y-transparent border-l-[8px] xl:border-l-[15px] border-l-[#15575B]">
                            </div>
                            <span class="text-white text-[13px] md:text-base lg:text-2xl font-bold">
                                {{ tutorial.id }}
                            </span>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </Layout>
</template>