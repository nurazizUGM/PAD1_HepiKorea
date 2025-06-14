<script setup>
import { ref } from 'vue';
// import { useRouter } from 'vue-router';
import Layout from '../Layouts/Customer.vue';
import axios from 'axios';

// Dummy data for notifications
const notifications = ref([
  {
    id: 1,
    title: 'Order Confirmation',
    message: 'Your order #12345 has been confirmed and is being processed.',
    created_at: new Date('2025-06-10T14:30:00'),
    action_url: '/order/12345',
    image: '/img/example/admin_order_img_phone.png',
  },
  {
    id: 2,
    title: 'Shipping Update',
    message: 'Your order #12346 has been shipped. Track it here.',
    created_at: new Date('2025-06-11T09:15:00'),
    action_url: '/track/12346',
    image: '/img/example/admin_order_img_phone.png',
  },
  {
    id: 3,
    title: 'New Promotion',
    message: 'Enjoy 20% off your next purchase! Use code SUMMER20.',
    created_at: new Date('2025-06-12T08:00:00'),
    action_url: null,
    image: '/img/example/admin_order_img_phone.png',
  },
]);

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
    /*
    const response = await axios.get('/api/customer/notifications');
    notifications.value = response.data.map(notification => ({
      ...notification,
      created_at: new Date(notification.created_at),
    }));
    */
  } catch (error) {
    console.error('Error fetching notifications:', error);
  }
};

// Initialize
fetchNotifications();

// const router = useRouter();
// const handleNotificationClick = (actionUrl) => {
//   if (actionUrl) {
//     router.push(actionUrl);
//   }
// };
</script>

<template>
  <Layout title="Notification">
    <div class="w-full max-w-full h-full rounded-3xl bg-[#EFEFEF] py-8 px-10">
      <!-- Content Container -->
      <div class="w-full min-h-[680px] overflow-hidden rounded-3xl bg-white flex flex-col py-4 px-10">
        <h1 class="text-black font-semibold text-2xl">Notification</h1>
        <!-- List of Notification Container -->
        <div class="w-full h-full flex flex-col gap-y-4 mt-4">
          <!-- Notification -->
          <div
            v-for="notification in notifications"
            :key="notification.id"
            class="w-full h-fit bg-white rounded-2xl shadow-lg p-4"
            :class="{ 'cursor-pointer': notification.action_url, 'cursor-auto': !notification.action_url }"
            
          >
            <!-- Notification Date -->
            <p class="text-[#B7B7B7] font-semibold text-sm cursor-text">
              {{ formatDate(notification.created_at) }}
            </p>
            <div class="w-full h-full flex flex-row mt-3 cursor-auto">
              <img
                :src="notification.image"
                alt="img_product"
                class="h-20 object-contain"
              >
              <div class="flex flex-col ml-10">
                <h1 class="text-[#3E6E7A] text-xl font-semibold">{{ notification.title }}</h1>
                <p class="text-[#3E6E7A] my-auto">
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