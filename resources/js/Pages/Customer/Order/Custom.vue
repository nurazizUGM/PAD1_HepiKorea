<template>
  <Layout title="Product Confirmed">
    <div class="w-full max-w-full h-full rounded-3xl bg-[#EFEFEF] py-2 px-2 md:px-6 lg:px-[50px] relative">
      <h1 class="text-black font-semibold md:text-sm lg:text-2xl text-left">Product Confirmed</h1>

      <div class="overflow-y-scroll no-scrollbar h-[51vh] lg:h-[50vh] mt-2 mb-52">
        <!-- Product Card Container -->
        <div class="relative w-full h-fit grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-5 gap-y-5 mt-2 mb-12">
          <!-- Product Cards -->
          <div v-for="item in items" :key="item.id"
            class="w-full lg:w-[420px] h-full lg:h-[279px] bg-white rounded-2xl flex flex-col p-5 relative mx-auto">
            <!-- Overlay Disabled -->
            <div v-if="item.order.status === 'unconfirmed'"
              class="absolute inset-0 bg-[#898383] bg-opacity-60 rounded-2xl flex items-center justify-center text-black text-2xl font-semibold z-10">
              Unconfirmed!
            </div>
            <div v-else-if="!item.is_available"
              class="absolute inset-0 bg-[#898383] bg-opacity-60 rounded-2xl flex items-center justify-center text-black text-2xl font-semibold z-10">
              Not Available!
            </div>

            <!-- Photo, Name, Price of Product -->
            <div class="w-full h-[65%] flex flex-row">
              <!-- Image Container -->
              <div class="w-[35%] h-full">
                <img :src="getImageUrl(item.image)" alt="" class="w-full h-full object-contain">
              </div>
              <!-- Name, Variant, Price -->
              <div class="w-[65%] h-full flex flex-col pl-5">
                <h1 class="text-[#3E6E7A] font-semibold text-base">{{ item.name }}</h1>
                <h2 class="text-black text-opacity-50 font-semibold text-xs mt-1">{{ item.variant }}</h2>
                <h2 class="text-orange-400 font-semibold text-xl mt-auto">Rp {{ formatPrice(item.price) }}</h2>
              </div>
            </div>

            <!-- Checkbox -->
            <div class="w-full h-[45%] flex">
              <div class="w-fit h-fit flex flex-row items-center my-auto ml-7">
                <input type="checkbox" v-model="item.selected"
                  class="w-6 h-6 rounded-sm outline outline-[#3E6E7A] bg-transparent hover:bg-slate-100 checked:bg-[#3E6E7A] hover:checked:bg-[#37626d] focus:outline-[#3E6E7A] active:ring-[#3E6E7A] focus:border-[#3E6E7A]">
                <p class="text-[#3E6E7A] font-semibold ml-6">Add Product</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Checkout Container -->
        <div class="absolute md:w-[125vh] lg:w-[156vh] h-[25vh] bg-white rounded-2xl bottom-10 z-10 flex flex-col py-5 px-10">
          <h1 class="text-black font-semibold text-2xl">Checkout</h1>
          <div class="w-full h-fit flex flex-row my-auto">
            <!-- Select All and Checkbox Container -->
            <div class="w-fit h-full flex flex-row">
              <input type="checkbox" v-model="selectAll" @change="toggleSelectAll"
                class="w-6 h-6 hover:bg-slate-100 rounded-sm outline outline-[#3E6E7A] bg-transparent checked:bg-[#3E6E7A] hover:checked:bg-[#37626d] focus:outline-[#3E6E7A] active:ring-[#3E6E7A] focus:border-[#3E6E7A] my-auto">
              <p class="text-black text-opacity-50 font-semibold text-base ml-6 my-auto">Select All ({{ selectedCount
                }})</p>
              <button @click="showDeleteModal = true"
                class="bg-white hover:bg-slate-100 outline outline-2 outline-[#3E6E7A] rounded-2xl inline-flex my-auto ml-10 py-2 px-12">
                <img src="/img/assets/icon/icon_customer_trashcan.svg" alt="" class="w-6 h-7 mr-2">
                <p class="text-[#3E6E7A] font-semibold text-xl">Delete</p>
              </button>
            </div>
            <!-- Text Count Total Product -->
            <p class="text-black text-opacity-50 font-semibold text-base ml-auto my-auto">Total ({{ items.length }})
              Product</p>
            <!-- Total Price -->
            <h1 class="text-orange-400 font-semibold text-2xl ml-16 my-auto">Rp {{ formatPrice(totalPrice) }}</h1>
          </div>
          <button
            class="w-fit bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white text-2xl font-semibold rounded-2xl py-2 px-10 ml-auto">
            Checkout
          </button>
        </div>
      </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div v-if="showDeleteModal" class="fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-50">
      <div class="bg-white w-[33vw] h-auto rounded-[30px] shadow p-4">
        <div class="flex flex-col px-10 py-10">
          <img src="/img/assets/icon/icon_warning.svg" alt="icon_warning" class="w-16 h-16 mx-auto">
          <p class="text-[#376F7E] font-medium text-xl mx-auto mt-2">Are you sure?</p>
          <p class="text-[#B7B7B7] font-medium text-xs mx-auto mt-6">You won’t be able to revert this!</p>
          <div class="w-full h-full mt-6 flex flex-row justify-center">
            <button @click="confirmDelete"
              class="w-44 h-11 bg-[#376F7E] rounded-[20px] shadow-lg text-white text-lg font-semibold">
              Yes, Delete it!
            </button>
            <button @click="showDeleteModal = false"
              class="w-44 h-11 bg-[#FF9D66] rounded-[20px] shadow-lg text-white text-lg font-semibold ml-2">
              Cancel
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Success Delete Modal -->
    <div v-if="showSuccessModal" class="fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-50">
      <div class="bg-white w-[25vw] h-auto rounded-[30px] shadow p-14">
        <h1 class="text-black text-xl font-medium mx-auto">Successfully Deleted!</h1>
        <img src="/img/assets/icon/icon_green_check.svg" alt="green_check" class="w-24 h-24 mx-auto mt-6">
      </div>
    </div>
  </Layout>
</template>

<script>
import { ref, computed, onMounted } from 'vue';
import Layout from '../../Layouts/Customer.vue';

export default {
  components: {
    Layout,
  },
  setup() {
    // Dummy data sementara
    const items = ref([
      {
        id: 1,
        name: 'Samsung S24 Ultra',
        variant: 'Black',
        price: 24000000,
        image: null,
        is_available: true,
        order: { status: 'confirmed' },
        selected: false,
      },
      {
        id: 2,
        name: 'Samsung S24 Ultra',
        variant: 'White',
        price: 24000000,
        image: '/img/example/admin_order_img_phone.png',
        is_available: false,
        order: { status: 'confirmed' },
        selected: false,
      },
      {
        id: 3,
        name: 'Samsung S24 Ultra',
        variant: 'Gray',
        price: 24000000,
        image: null,
        is_available: true,
        order: { status: 'unconfirmed' },
        selected: false,
      },
      {
        id: 4,
        name: 'Samsung S24 Ultra',
        variant: 'Gray',
        price: 24000000,
        image: null,
        is_available: true,
        order: { status: 'confirmed' },
        selected: false,
      },
      {
        id: 5,
        name: 'Samsung S24 Ultra',
        variant: 'Gray',
        price: 24000000,
        image: null,
        is_available: true,
        order: { status: 'confirmed' },
        selected: false,
      },
      {
        id: 6,
        name: 'Samsung S24 Ultra',
        variant: 'Gray',
        price: 24000000,
        image: null,
        is_available: true,
        order: { status: 'confirmed' },
        selected: false,
      },
      {
        id: 7,
        name: 'Samsung S24 Ultra',
        variant: 'Gray',
        price: 24000000,
        image: null,
        is_available: true,
        order: { status: 'confirmed' },
        selected: false,
      },
    ]);

    const showDeleteModal = ref(false);
    const showSuccessModal = ref(false);
    const selectAll = ref(false);

    // Fungsi untuk mengambil data dari API (placeholder)
    const fetchData = async () => {
      try {
        const response = await fetch('/api/product-confirmed'); // Ganti dengan endpoint API Anda
        items.value = await response.json();
      } catch (error) {
        console.error('Error fetching data:', error);
      }
    };

    // Handler untuk gambar
    const getImageUrl = (image) => {
      return image ? `/storage/${image}` : '/img/assets/icon/icon_admin_order_product.svg';
    };

    // Format harga
    const formatPrice = (price) => {
      return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') + ',-';
    };

    // Hitung total harga
    const totalPrice = computed(() => {
      return items.value.reduce((sum, item) => sum + (item.selected ? item.price : 0), 0);
    });

    // Hitung jumlah item yang dipilih
    const selectedCount = computed(() => {
      return items.value.filter(item => item.selected).length;
    });

    // Toggle select all
    const toggleSelectAll = () => {
      items.value.forEach(item => {
        if (item.is_available && item.order.status == 'confirmed') { // Hanya ubah status selected jika is_available true
          item.selected = selectAll.value;
        }
      });
    };

    // Konfirmasi penghapusan
    const confirmDelete = () => {
      items.value = items.value.filter(item => !item.selected);
      showDeleteModal.value = false;
      showSuccessModal.value = true;
      setTimeout(() => (showSuccessModal.value = false), 2000); // Tutup otomatis setelah 2 detik
    };

    // Inisialisasi data (gunakan fetchData saat API siap)
    onMounted(() => {
      // fetchData(); // Uncomment saat API siap
    });

    return {
      items,
      showDeleteModal,
      showSuccessModal,
      selectAll,
      getImageUrl,
      formatPrice,
      totalPrice,
      selectedCount,
      toggleSelectAll,
      confirmDelete,
    };
  },
};
</script>

<style scoped>
.no-scrollbar::-webkit-scrollbar {
  display: none;
}

.no-scrollbar {
  -ms-overflow-style: none;
  scrollbar-width: none;
}
</style>