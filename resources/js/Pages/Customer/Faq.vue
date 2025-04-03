<script>
import { ref, onMounted } from 'vue';
import Layout from '../Layouts/Customer.vue';

export default {
    components: {
        Layout,
    },
    setup() {
        // Dummy data sementara
        const faqs = ref([
            {
                id: 1,
                question: 'What is the return policy?',
                answer: 'You can return products within 30 days of purchase with a receipt.',
                isOpen: true, // Pertama dibuka secara default
            },
            {
                id: 2,
                question: 'How long does shipping take?',
                answer: 'Shipping usually takes 3-7 business days depending on your location.',
                isOpen: false,
            },
            {
                id: 3,
                question: 'Do you offer international shipping?',
                answer: 'Yes, we ship to most countries worldwide. Shipping costs may vary.',
                isOpen: false,
            },
            {
                id: 4,
                question: 'Do you offer jklasdnaokdbwdbio shipping?',
                answer: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere dignissimos voluptatem quod quas, vero repellendus numquam eius assumenda doloribus, veniam iste, eum ea in cum fuga nihil sit? Magni, rerum!',
                isOpen: false,
            },
        ]);

        // Fungsi untuk mengambil data dari API (placeholder)
        const fetchData = async () => {
            try {
                const response = await fetch('/api/faqs'); // Ganti dengan endpoint API Anda
                const data = await response.json();
                faqs.value = data.map((faq, index) => ({
                    ...faq,
                    isOpen: index === 0, // Hanya item pertama yang terbuka secara default
                }));
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        };

        // Toggle accordion
        const toggleAccordion = (index) => {
            faqs.value[index].isOpen = !faqs.value[index].isOpen;
        };

        // Inisialisasi data (gunakan fetchData saat API siap)
        onMounted(() => {
            // fetchData(); // Uncomment saat API siap
        });

        return {
            faqs,
            toggleAccordion,
        };
    },
};
</script>

<template>
    <Layout title="FAQ">
        <div class="w-full max-w-full h-full rounded-3xl bg-[#EFEFEF] py-2 px-2 md:py-5 md:px-5 lg:py-8 lg:px-10">
            <!-- Content Container -->
            <div class="w-full h-fit min-h-[680px] overflow-hidden rounded-3xl bg-white flex flex-col py-3 px-4 md:py-6 md:px-8 lg:py-8 lg:px-14">
                <div class="flex flex-row">
                    <h1 class="text-[#3E6E7A] font-bold text-xs md:text-sm lg:text-3xl">FAQ</h1>
                    <h1 class="text-orange-400 font-bold text-[10px] md:text-sm lg:text-3xl ml-2 md:ml-4 lg:ml-8">(Frequently Asked Questions)</h1>
                </div>

                <!-- Accordion -->
                <div class="my-3 md:my-5 lg:my-10 shadow-md bg-none">
                    <div v-for="(faq, index) in faqs" :key="faq.id">
                        <h2 :id="`accordion-open-heading-${index + 1}`">
                            <button type="button"
                                class="flex items-center justify-between w-full px-5 py-4 md:py-6 lg:py-12 font-medium bg-[#F1EDED] rounded-t-xl focus:ring-0 gap-3"
                                :class="{ 'rounded-b-xl': !faq.isOpen, 'border-b-0': faq.isOpen }"
                                @click="toggleAccordion(index)">
                                <span class="flex items-center text-[#3E6E7A] font-medium text-[10px] md:text-sm lg:text-2xl">
                                    {{ faq.question }}
                                </span>
                                <svg class="w-3 h-3 shrink-0 transition-transform duration-300"
                                    :class="{ 'rotate-180': faq.isOpen }" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="#3E6E7A" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M9 5 5 1 1 5" />
                                </svg>
                            </button>
                        </h2>
                        <div :id="`accordion-open-body-${index + 1}`"
                            class="overflow-hidden transition-all duration-300"
                            :class="{ 'h-0': !faq.isOpen, 'h-auto': faq.isOpen }">
                            <div class="p-2 md:p-3 lg:p-5 border border-b-0 border-gray-200">
                                <p class="mb-2 text-[#3E6E7A] font-medium text-[8px] md:text-xs lg:text-2xl">{{ faq.answer }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<style scoped>
/* Tidak ada styling tambahan yang diperlukan untuk saat ini */
</style>