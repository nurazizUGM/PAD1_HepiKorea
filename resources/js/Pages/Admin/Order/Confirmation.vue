<template>
  <div class="flex flex-row">
    <!-- Year and Month Filter -->
    <div class="w-[35%] md:w-[30%] lg:w-[20%] min-h-[70vh] lg:h-[78vh] bg-white rounded-lg overflow-y-scroll no-scrollbar">
      <div>
        <button
          class="flex items-center w-full px-2 md:px-3 lg:px-5 pt-5 font-medium text-gray-500 border-b-0 rounded-xl focus:ring-0 focus:bg-white"
          @click="selectAllOrders"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="w-4 h-4 rotate-180 shrink-0"
            aria-hidden="true"
            viewBox="0 0 16 16"
          >
            <path
              fill="#000"
              fill-rule="evenodd"
              d="M2.5 5a1.25 1.25 0 1 0 0-2.5a1.25 1.25 0 0 0 0 2.5m3.25-2a.75.75 0 0 0 0 1.5h8.5a.75.75 0 0 0 0-1.5zm0 8.5a.75.75 0 0 0 0 1.5h8.5a.75.75 0 0 0 0-1.5zM5 8a.75.75 0 0 1 .75-.75h8.5a.75.75 0 0 1 0 1.5h-8.5A.75.75 0 0 1 5 8M3.75 8a1.25 1.25 0 1 1-2.5 0a1.25 1.25 0 0 1 2.5 0M2.5 13.5a1.25 1.25 0 1 0 0-2.5a1.25 1.25 0 0 0 0 2.5"
              clip-rule="evenodd"
            />
          </svg>
          <span class="text-[#376F7E] font-semibold text-[10px] md:text-base lg:text-xl inline-block ml-3">All</span>
        </button>
        <div v-for="year in years" :key="year">
          <button
            class="flex items-center w-full px-2 md:px-3 lg:px-5 pt-5 font-medium text-gray-500 border-b-0 rounded-xl focus:ring-0 focus:bg-white"
            @click="toggleYear(year)"
          >
            <svg
              class="w-3 h-3 shrink-0"
              :class="{ 'rotate-180': expandedYears.includes(year) }"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 10 6"
            >
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
            </svg>
            <span class="text-[#376F7E] font-semibold text-[10px] md:text-base lg:text-xl inline-block ml-3">{{ year }}</span>
          </button>
          <div v-if="expandedYears.includes(year)" class="px-2 md:px-3 lg:px-5">
            <ul class="ml-5 text-lg">
              <li
                v-for="month in months[year]"
                :key="month"
                class="my-0.5 md:my-1.5 lg:my-3 text-[10px] md:text-sm lg:text-base text-black text-opacity-50 font-semibold cursor-pointer"
                @click="filterOrders(year, month)"
              >
                {{ month }}
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- Confirmation Cards -->
    <div class="w-[65%] md:w-[70%] lg:w-[80%] h-fit ml-3 md:ml-6 lg:ml-6 grid grid-cols-1 lg:grid-cols-2 gap-4 justify-start items-start align-content-start">
      <div v-for="order in filteredOrders" :key="order.id" class="bg-white w-[194px] md:w-full lg:w-[26rem] h-32 md:h-[150px] lg:h-52 rounded-xl p-1 md:p-2 lg:p-2 flex flex-row">
        <!-- Image -->
        <div
          class="w-5/12 h-[90%] md:h-full bg-cover bg-center bg-no-repeat rounded-xl my-auto lg:my-0"
          :style="{ backgroundImage: `url(${order.image})` }"
        ></div>
        <!-- Details -->
        <div class="w-7/12 h-full flex flex-col px-2 md:px-5 lg:px-4 pt-1">
          <h3 class="text-black ml-3 font-semibold text-[10px] md:text-sm lg:text-base">{{ order.customOrderItems[0].name }}</h3>
          <p class="text-[#376F7E] ml-2.5 lg:ml-3 font-semibold text-[10px] md:text-sm lg:text-lg">Rp {{ formatPrice(order.total_items_price) }}</p>
          <button
            class="w-14 lg:w-28 h-6 lg:h-8 bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white text-xs md:text-sm lg:text-base font-semibold rounded-md mt-auto ml-auto"
            @click="navigateToConfirmation(order.id)"
          >
            Check
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, computed } from 'vue';
// import { useRouter } from 'vue-router';
import axios from 'axios';

export default {
  setup() {
    // const router = useRouter();

    // Dummy data
    const orders = ref([
      {
        id: 1,
        customOrderItems: [{ name: 'Samsung Ultra 24' }],
        total_items_price: 25000000,
        created_at: '2025-05-01',
        image: '/img/example/admin_order_img_phone.png',
      },
      {
        id: 2,
        customOrderItems: [{ name: 'iPhone 15 Pro' }],
        total_items_price: 18000000,
        created_at: '2025-04-15',
        image: '/img/example/admin_order_img_phone.png',
      },
    ]);

    const years = ref([2025, 2024]);
    const months = ref({
      2025: ['January', 'February', 'March', 'April', 'May'],
      2024: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
    });

    // Filters
    const selectedYear = ref(null);
    const selectedMonth = ref(null);
    const expandedYears = ref([2025]);

    const filteredOrders = computed(() => {
      if (!selectedYear.value && !selectedMonth.value) return orders.value;
      return orders.value.filter(order => {
        const date = new Date(order.created_at);
        const yearMatch = !selectedYear.value || date.getFullYear() === selectedYear.value;
        const monthMatch = !selectedMonth.value || months.value[selectedYear.value][date.getMonth()] === selectedMonth.value;
        return yearMatch && monthMatch;
      });
    });

    const toggleYear = (year) => {
      if (expandedYears.value.includes(year)) {
        expandedYears.value = expandedYears.value.filter(y => y !== year);
      } else {
        expandedYears.value.push(year);
      }
    };

    const filterOrders = (year, month) => {
      selectedYear.value = year;
      selectedMonth.value = month;
    };

    const selectAllOrders = () => {
      selectedYear.value = null;
      selectedMonth.value = null;
    };

    // Navigation
    const navigateToConfirmation = (orderId) => {
    //   router.push({ name: 'admin.order.confirmation.show', params: { id: orderId } });
    };

    // Formatting
    const formatPrice = (price) => {
      return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    };

    // API Fetching
    const fetchOrders = async () => {
      try {
        /*
        const response = await axios.get('/api/admin/confirmation', {
          params: { year: selectedYear.value, month: selectedMonth.value },
        });
        orders.value = response.data.orders;
        */
      } catch (error) {
        console.error('Error fetching confirmation orders:', error);
      }
    };

    return {
      orders,
      years,
      months,
      selectedYear,
      selectedMonth,
      expandedYears,
      filteredOrders,
      toggleYear,
      filterOrders,
      selectAllOrders,
      navigateToConfirmation,
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