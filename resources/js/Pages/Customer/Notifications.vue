<script setup>
import { router } from '@inertiajs/vue3';
import axios from 'axios';
import { onMounted, ref } from 'vue';
import Layout from '../Layouts/Customer.vue';

// Dummy data for notifications
const notifications = ref([]);

// Format date to 'd-M-Y H:i'
const formatDate = (date) => {
    return new Date(date).toLocaleString('en-GB', {
        day: '2-digit',
        month: 'short',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        hour12: false,
    }).replace(',', '');
};

// Fetch notifications (placeholder for API)
const fetchNotifications = async () => {
    try {
        const response = await axios.get('/api/notifications');
        notifications.value = response.data;
    } catch (error) {
        console.error('Error fetching notifications:', error);
    }
};

// const router = useRouter();
const handleNotificationClick = (notification) => {
    let url = notification.action_url
    if (url) {
        if (!notification.is_read) {
            url += url.includes('=') ? '&' : '?'
            url += 'notificationId=' + notification.id
        }
        router.get(url);
    }
};

// Initialize
onMounted(() => {
    fetchNotifications();
});
</script>

<template>
    <Layout title="Notification">
        <div class="w-full max-w-full h-full rounded-xl lg:rounded-3xl bg-[#EFEFEF] px-3 py-4 lg:py-8 md:px-4 lg:px-10">
            <!-- Content Container -->
            <div
                class="w-full min-h-[680px] overflow-hidden rounded-xl lg:rounded-3xl bg-white flex flex-col px-2 py-4 md:px-5 lg:px-10">
                <h1 class="text-black font-semibold md:text-xl lg:text-2xl">Notification</h1>
                <!-- List of Notification Container -->
                <div class="w-full h-full flex flex-col gap-y-2 md:gap-y-3 lg:gap-y-4 mt-4">
                    <!-- Notification -->
                    <div v-for="notification in notifications" :key="notification.id"
                        class="w-full h-fit bg-white rounded-2xl drop-shadow-md md:shadow-lg p-4" :class="{
                            'cursor-pointer': notification.action_url,
                            'cursor-auto': !notification.action_url,
                            'bg-slate-200': notification.is_read
                        }" @click="handleNotificationClick(notification)">
                        <!-- Notification Date -->
                        <p class="text-[#B7B7B7] font-semibold text-xs md:text-sm cursor-text">
                            {{ formatDate(notification.created_at) }}
                        </p>
                        <div class="w-full h-full flex flex-row mt-3 cursor-auto">
                            <!-- <img :src="notification.image" alt="img_product" class="h-20 object-contain mr-5 md:mr-10"> -->
                            <div class="flex flex-col">
                                <h1 class="text-[#3E6E7A] text-base md:text-xl font-semibold">{{ notification.title }}
                                </h1>
                                <p class="text-[#3E6E7A] text-xs md:text-base my-auto">
                                    {{ notification.message }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- End of Notification -->
                </div>
                <!-- End of List of Notification Container -->
            </div>
            <!-- End of Content Container -->
        </div>
        <div class="h-10 w-full"></div>
    </Layout>
</template>

<style scoped>
/* Custom styles if needed */
</style>