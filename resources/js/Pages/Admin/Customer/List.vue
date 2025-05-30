<template>
  <div class="flex px-2 pb-2 md:px-4 lg:px-10 rounded-lg lg:min-h-[80vh]">
    <div class="h-full w-full">
      <div class="w-full flex items-center">
        <!-- Search Bar -->
        <div class="flex items-center mr-auto md:ml-5 lg:ml-0">
          <div class="relative flex items-center w-full">
            <img src="/img/assets/icon/icon_admin_search_searchbar.svg" alt="search icon"
              class="absolute left-3 w-5 h-5 text-gray-500" />
            <form @submit.prevent="filterCustomers">
              <input v-model="searchQuery" type="text"
                class="block w-12/12 lg:w-[25vw] pl-10 py-2 text-gray-900 bg-white border border-white rounded-full focus:ring-0 focus:border-none placeholder:text-sm placeholder:text-start"
                placeholder="Search..." />
            </form>
          </div>
        </div>
      </div>
      <!-- Customer Cards -->
      <div
        class="w-full lg:min-h-[49vh] h-fit mt-5 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-x-2 gap-y-3 md:gap-y-6 lg:gap-8 overflow-y-auto no-scrollbar justify-start items-start content-start">
        <div v-for="customer in filteredCustomers" :key="customer.id"
          class="bg-white w-full h-[190px] md:w-[150px] md:h-[194px] lg:w-40 lg:h-52 rounded-lg overflow-hidden flex flex-col cursor-pointer mx-auto">
          <!-- @click="$router.push(`/customer/${customer.id}`)"> -->
          <!-- Customer Image -->
          <div class="w-full h-4/6">
            <img :src="customer.photo || '/img/assets/icon/icon_user.svg'" alt="customer photo"
              class="w-full h-full object-cover object-top" />
          </div>
          <!-- Customer Details -->
          <div class="p-2 h-1/6">
            <p class="text-[#376F7E] text-xs lg:text-sm font-bold truncate">{{ customer.fullname }}</p>
          </div>
          <!-- Edit Icon -->
          <div class="flex mx-3 mb-2 h-1/6">
            <router-link :to="`/customer/${customer.id}`" class="ml-auto">
              <img src="/img/assets/icon/icon_user_profile.svg" alt="Customer Profile" class="h-full" />
            </router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, computed, onMounted } from 'vue';
// import { useRouter } from 'vue-router';
import axios from 'axios';

export default {
  setup() {
    // const router = useRouter();

    // Dummy data for customers
    const customers = ref([
      {
        id: 1,
        fullname: 'John Doe',
        photo: null,
      },
      {
        id: 2,
        fullname: 'Jane Smith',
        photo: '/img/customer2.jpg',
      },
      {
        id: 3,
        fullname: 'John silba',
        photo: null,
      },
      {
        id: 4,
        fullname: 'John silva',
        photo: null,
      },
      {
        id: 5,
        fullname: 'John cihuy',
        photo: null,
      },
      {
        id: 6,
        fullname: 'John cena',
        photo: null,
      },
      {
        id: 7,
        fullname: 'John tor',
        photo: null,
      },
      {
        id: 8,
        fullname: 'John huntelaar',
        photo: null,
      },
    ]);

    // Search query
    const searchQuery = ref('');

    // Filtered customers
    const filteredCustomers = computed(() => {
      return customers.value.filter(customer =>
        customer.fullname.toLowerCase().includes(searchQuery.value.toLowerCase())
      );
    });

    // Fetch customers
    const fetchCustomers = async () => {
      try {
        /*
        const response = await axios.get('/api/admin/customers', {
          params: { search: searchQuery.value },
        });
        customers.value = response.data.customers;
        */
      } catch (error) {
        console.error('Error fetching customers:', error);
      }
    };

    // Filter customers
    const filterCustomers = () => {
      // Local filtering is handled by computed property
      // Uncomment for API-based filtering
      // fetchCustomers();
    };

    onMounted(() => {
      // fetchCustomers();
    });

    return {
      customers,
      searchQuery,
      filteredCustomers,
      filterCustomers,
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