<template>
    <div
        class="w-[92%] w-max[92%] h-fit mx-auto mt-7 md:mt-14 mb-7 md:mb-14 rounded-3xl overflow-hidden bg-[#3E6E7A] text-white pt-5 md:pt-10 pb-7 md:pb-14 px-6 md:px-12 flex flex-col md:flex-row">
        <div class="w-full md:w-[25%] h-full flex flex-col mb-2 md:mb-0">
            <h1 class="text-3xl lg:text-4xl font-bold">HepiKorea</h1>
            <p class="text-sm md:text-base font-medium mt-1">Get us more on</p>
            <div class="flex flex-row mt-2 md:mt-8 md:align-middle gap-x-4">
                <a v-if="settings.instagram" :href="`https://instagram.com/${settings.instagram}`" target="_blank">
                    <img src="/img/assets/icon/icon_footer_insta.svg" alt="Instagram Icon" class="w-7 h-7 md:w-11 md:h-11">
                </a>
                <a v-if="settings.email" :href="`mailto:${settings.email}`" target="_blank">
                    <img src="/img/assets/icon/icon_footer_gmail.svg" alt="Gmail Icon" class="w-7 h-7 md:w-11 md:h-11">
                </a>
                <a v-if="settings.whatsapp" :href="`https://wa.me/${settings.whatsapp}`" target="_blank">
                    <img src="/img/assets/icon/icon_footer_wa.svg" alt="WhatsApp Icon" class="w-7 h-7 md:w-11 md:h-11">
                </a>
                <a v-if="settings.line" :href="settings.line" target="_blank">
                    <img src="/img/assets/icon/icon_footer_line.svg" alt="Line Icon" class="w-6 h-7 md:w-9 md:h-11">
                </a>
            </div>
        </div>
        <div class="w-full md:w-[50%] h-full flex flex-col md:pr-4 align-top mb-2 md:mb-0">
            <h1 class="text-sm md:text-lg font-medium mb-1 md:mb-4">ABOUT</h1>
            <p class="text-justify font-medium text-xs md:text-base">{{ settings.about }}</p>
        </div>
        <div class="w-full md:w-[25%] md:w-max-[25%] h-full flex flex-col flex-wrap md:pl-8">
            <h1 class="text-sm md:text-lg font-medium mb-1 md:mb-4">CONTACT</h1>
            <p class="text-justify font-medium text-xs md:text-base">Phone : +{{ settings.phone }}</p>
            <p class="text-justify font-medium text-xs md:text-base">Email : {{ settings.email }}</p>
            <p class="text-justify font-medium text-xs md:text-base">Address : {{ settings.address }}</p>
        </div>
    </div>
    <p class="text-center text-xs md:text-base">&copy; 2024 HepiKorea. All rights reserved</p>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { usePage } from '@inertiajs/vue3';

const settings = ref({
    instagram: '',
    email: '',
    whatsapp: '',
    line: '',
    about: '',
    phone: '',
    address: ''
});

onMounted(() => {
    const page = usePage();
    settings.value = page.props.settings;
});
</script>
