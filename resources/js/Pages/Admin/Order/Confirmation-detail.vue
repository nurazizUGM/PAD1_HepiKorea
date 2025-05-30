<template>
  <div class="bg-[#EFEFEF] border-gray-200 rounded-lg">
    <!-- Tab Navigation -->
    <div class="mb-1">
      <ul class="flex flex-wrap -mb-px text-xs lg:text-lg font-bold text-center text-black gap-x-14 lg:gap-x-16"
        role="tablist">
        <li class="ml-auto mr-auto" role="presentation">
          <button :class="[
            'inline-block px-4 pt-4 pb-1 border-b-2 rounded-t-lg',
            activeTab === 'order'
              ? 'text-black border-orange-400'
              : 'text-black hover:text-orange-400 border-transparent hover:border-transparent'
          ]" @click="navigateToOrderTab">
            Order
          </button>
        </li>
        <li class="ml-auto mr-auto" role="presentation">
          <button :class="[
            'inline-block px-4 pt-4 pb-1 border-b-2 rounded-t-lg',
            activeTab === 'confirmation'
              ? 'text-black border-orange-400'
              : 'text-black hover:text-orange-400 border-transparent hover:border-transparent'
          ]" @click="setActiveTab('confirmation')">
            Confirmation
          </button>
        </li>
      </ul>
    </div>

    <!-- Tab Content -->
    <div>
      <div v-if="activeTab === 'order'" class="px-5 pt-2 rounded-lg h-[80vh] overflow-y-scroll no-scrollbar">
        <div class="flex items-center justify-center w-full h-[98%] rounded-lg bg-white">
          <div role="status">
            <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin fill-blue-600" viewBox="0 0 100 101"
              fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                fill="currentColor" />
              <path
                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                fill="currentFill" />
            </svg>
            <span class="sr-only">Loading...</span>
          </div>
        </div>
      </div>
      <div v-else-if="activeTab === 'confirmation'"
        class="px-5 pt-2 rounded-lg h-[80vh] overflow-y-scroll no-scrollbar">
        <div class="flex flex-col h-full w-full pb-3">
          <!-- User Name -->
          <div class="w-1/4 lg:w-1/5 h-[7%] bg-[#3E6E7A] px-3 py-1 rounded-xl flex">
            <h1 class="md:text-base lg:text-2xl text-white font-semibold my-auto">{{ confirmation.user.fullname }}</h1>
          </div>

          <!-- Product List -->
          <div
            class="mt-3 w-full max-h-[83%] bg-white rounded-xl px-3 py-2 flex flex-col gap-y-5 overflow-y-scroll no-scrollbar">
            <h1 class="text-black font-semibold text-sm lg:text-xl">Products</h1>
            <div v-for="(product, index) in confirmation.products" :key="product.id"
              class="w-full lg:max-h-[220px] flex flex-col lg:flex-row flex-auto">
              <!-- two divider -->
              <div class="w-full lg:w-[40%] flex flex-row">
                <!-- iamge container -->
                <div class="w-[40%] md:w-[35%] lg:w-[35%] h-full flex flex-col">
                  <div class="mb-auto flex flex-col">
                    <img :src="product.image" alt="product" class="w-[85%] h-[85%] object-fill" />
                    <h1 class="text-sm lg:text-lg h-[15%] text-orange-400 font-bold">Rp {{
                      formatPrice(product.total_price) }},-</h1>
                  </div>
                </div>
                <!-- name container -->
                <div class="w-[60%] md:w-[65%] lg:w-[65%] h-full flex flex-col">
                  <h1 class="font-semibold text-[#3E6E7A] text-xs md:text-base lg:text-xl">{{ product.name }}</h1>
                  <h2 class="font-semibold text-[10px] md:text-sm lg:text-base mt-1">Rp {{ formatPrice(product.price) }},-</h2>
                  <div class="flex flex-row mt-1 md:mt-2 lg:mt-3 text-[10px] md:text-xs lg:text-base">
                    <h2 class="font-semibold">Order :</h2>
                    <span class="ml-2">{{ product.quantity }}</span>
                  </div>
                  <div v-if="product.max_order" class="flex flex-row mt-1 md:mt-2 lg:mt-5 text-[10px] md:text-xs lg:text-base">
                    <h2 class="font-semibold">Max Order :</h2>
                    <span class="ml-2">{{ product.max_order }}</span>
                  </div>
                  <!-- product link (nanti ilang pas desktop) -->
                  <p class="flex lg:hidden text-black font-semibold text-[10px] md:text-xs lg:text-sm mt-1 md:mt-2">
                        Product link: {{ product.link || '...' }}
                      </p>
                  <!-- note container (nanti ilang pas desktop ama hape) -->
                   <div class="max-w-full h-[45%] border border-[#3E6E7A] bg-white rounded-lg p-0.5 lg:p-1 my-1 text-[8px] md:text-xs lg:text-sm hidden md:flex lg:hidden flex-wrap overflow-x-clip overflow-y-auto">
                    customer note: {{ product.customer_note || '...' }}
                  </div>
                  <div v-if="product.admin_note"
                    class="w-full h-[45%] border border-[#3E6E7A] bg-white rounded-lg p-1 my-1 text-[8px] md:text-xs lg:text-sm hidden md:flex lg:hidden flex-wrap">
                    admin note: {{ product.admin_note }}
                  </div>
                </div>
              </div>
              <!-- two divider -->
              <div class="w-full lg:w-[60%] flex flex-row">
                <!-- note container -->
                <div class="w-[50%] lg:w-[40%] flex md:hidden lg:flex h-full flex-col items-center pr-10">
                  <div class="w-full h-[45%] border border-[#3E6E7A] bg-white rounded-lg p-1 my-1 text-xs lg:text-sm flex-wrap overflow-x-auto overflow-y-auto no-scrollbar">
                    customer note: {{ product.customer_note || '...' }}
                  </div>
                  <div v-if="product.admin_note"
                    class="w-full h-[45%] border border-[#3E6E7A] bg-white rounded-lg p-1 my-1 text-xs lg:text-sm flex-wrap overflow-y-auto overflow-x-auto no-scrollbar">
                    admin note: {{ product.admin_note }}
                  </div>
                </div>
                <!-- two button container -->
                <div class="w-[50%] lg:w-[60%] h-full flex flex-col ml-0 md:ml-auto lg:ml-0">
                  <div class="w-fit h-fit ml-auto text-xs lg:text-base order-2 lg:order-1">
                    <button :class="[
                      'w-[18vw] h-[4vh] md:w-[15vw] lg:w-[9vw] lg:h-[5vh] rounded-lg text-white font-semibold mr-1 lg:mr-3',
                      product.status === 'available' ? 'bg-[#3E6E7A]' : 'bg-[#3E6E7A] opacity-50'
                    ]" @click="openAvailabilityModal(product, true)">
                      Available
                    </button>
                    <button :class="[
                      'w-[18vw] h-[4vh] md:w-[15vw] lg:w-[9vw] lg:h-[5vh] rounded-lg text-white font-semibold',
                      product.status === 'unavailable' ? 'bg-[#3E6E7A]' : 'bg-[#3E6E7A] opacity-50'
                    ]" @click="openAvailabilityModal(product, false)">
                      Unavailable
                    </button>
                  </div>
                  <div class="w-full h-full flex flex-col order-1 lg:order-2 mb-4">
                    <div class="w-full h-fit mt-auto flex flex-col">
                      <p class="hidden lg:flex text-black font-semibold text-[10px] md:text-xs lg:text-sm ml-auto mb-8">
                        Product link: {{ product.link || '...' }}
                      </p>
                      <div :class="[
                        'w-[99%] lg:w-[90%] h-fit rounded-lg shadow-md text-center font-semibold ml-auto py-2 lg:mb-2 text-[9px] lg:text-sm',
                        product.status === 'available' ? 'text-black' : 'text-[#FF0000]'
                      ]">
                        {{ product.status === 'available' ? `Available until ${product.available_until}` : 'Product Not Available' }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <hr v-if="index < confirmation.products.length - 1" class="border-gray-400 border-b-2 my-4" />
          </div>

          <!-- Total Price and Submit -->
          <div class="mt-3 w-full h-[10%] bg-white rounded-xl flex flex-row p-0.5 md:p-1 lg:p-0">
            <div class="w-1/6 h-full flex lg:p-4">
              <p class="my-auto text-[10px] md:text-xs lg:text-sm text-black text-opacity-50 font-semibold">Total Price:</p>
            </div>
            <div class="w-4/6 h-full flex p-1 lg:p-4">
              <p class="ml-4 md:ml-0 my-auto text-xs md:text-base lg:text-lg font-semibold text-orange-400">Rp {{ formatPrice(confirmation.total_price) }},-
              </p>
            </div>
            <div class="w-1/6 h-full flex">
              <button class="m-auto bg-[#3E6E7A] hover:bg-[#335a64] text-white text-sm md:text-base lg:text-lg rounded-xl px-1 md:px-6 lg:px-12 md:py-1 lg:py-2"
                @click="submitConfirmation">
                Submit
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Available Confirmation Modal -->
    <Modal :show="showAvailabilityModal" @close="closeAvailabilityModal">
      <div class="bg-white w-[90vw] md:w-[60vw] lg:w-[42vw] lg:h-[64vh] rounded-xl shadow relative">
        <button
          class="absolute bg-black w-5 h-5 flex items-center justify-center rounded-full text-white text-sm -top-2 -right-2"
          @click="closeAvailabilityModal">
          X
        </button>
        <div class="w-full h-full p-5 flex flex-row">
          <form class="w-full flex flex-col lg:flex-row" @submit.prevent="saveAvailability">
            <!-- Date and Time Picker -->
            <div class="w-full lg:w-[50%] h-full flex flex-col">
              <h1 class="text-black text-sm md:text-base font-semibold">Availability</h1>
              <h1 class="text-black text-sm md:text-base font-semibold">Time</h1>
              <input v-model="modalForm.date" type="date"
                class="mt-1 w-full h-10 rounded-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-0 focus:border-gray-300" />
              <div class="flex flex-row ml-auto mt-2">
                <input v-model="modalForm.time" type="time"
                  class="rounded-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-0 focus:border-gray-300 w-[8.5rem] p-2.5"
                  min="09:00" max="18:00" />
                <div class="flex flex-col justify-center items-center ml-2">
                  <input type="checkbox" id="toggle" class="hidden" v-model="modalForm.isPm" />
                  <label for="toggle">
                    <div class="w-28 h-9 bg-gray-200 rounded-md p-0.5 flex items-center cursor-pointer relative">
                      <div :class="[
                        'w-14 h-8 bg-white rounded-md transform transition-transform duration-300 ease-in-out',
                        modalForm.isPm ? 'translate-x-[52px]' : 'translate-x-0'
                      ]"></div>
                      <span class="text-sm text-slate-500 absolute left-5">PM</span>
                      <span class="text-sm text-slate-500 absolute right-5">AM</span>
                    </div>
                  </label>
                </div>
              </div>
            </div>
            <!-- Form Fields -->
            <div class="w-full lg:w-[50%] h-full flex flex-col lg:pl-5 lg:pr-2.5">
              <h1>Product Price</h1>
              <div class="flex items-center lg:mx-auto">
                <input v-model="modalForm.price" type="text"
                  class="block w-full lg:w-[18vw] py-2 text-gray-900 bg-white shadow-md border border-white rounded-lg focus:ring-0 focus:border-none"
                  :placeholder="`Rp ${formatPrice(modalForm.price || 0)}`" />
                <button type="button"
                  class="inline-flex items-center px-4 py-2 font-semibold text-white bg-gray-500 hover:bg-gray-600 rounded-lg -ml-14 z-10">
                  IDR
                </button>
              </div>
              <h1>EMS Price</h1>
              <input v-model="modalForm.emsPrice" type="text"
                class="w-full h-10 bg-white shadow-md border border-white rounded-lg focus:ring-0 focus:border-none"
                placeholder="EMS Price" />
              <h1>Max Order</h1>
              <input v-model="modalForm.maxOrder" type="number"
                class="w-full h-10 bg-white shadow-md border border-white rounded-lg focus:ring-0 focus:border-none"
                placeholder="Max Order" />
              <h1>Note</h1>
              <textarea v-model="modalForm.note" rows="7"
                class="bg-white shadow-md border border-white rounded-lg focus:ring-0 focus:border-none"
                placeholder="Admin Note"></textarea>
              <button type="submit"
                class="rounded-lg bg-orange-400 hover:bg-orange-500 text-white block ml-auto mt-4 w-1/4 lg:w-1/2 py-2">
                Save
              </button>
            </div>
          </form>
        </div>
      </div>
    </Modal>
  </div>
</template>

<script>
import { ref } from 'vue';
// import { useRouter } from 'vue-router';
import Modal from '../Modal.vue';
import axios from 'axios';

export default {
  components: { Modal },
  setup() {
    // const router = useRouter();

    // Dummy data
    const confirmation = ref({
      user: { fullname: 'Aisyah' },
      total_price: 25800000,
      products: [
        {
          id: 1,
          name: 'Samsung Ultra 24',
          price: 24000000,
          total_price: 72000000,
          quantity: 3,
          max_order: 3,
          customer_note: 'notenote note note note note note',
          admin_note: 'notenotenotenotenotenotenotenote',
          status: 'available',
          image: '/img/example/admin_order_img_phone.png',
          link: 'https://example.com/product',
          available_until: '15 September 2025 23:59',
        },
        {
          id: 2,
          name: 'Samsung Ultra 24',
          price: 24000000,
          total_price: 72000000,
          quantity: 3,
          customer_note: '',
          status: 'unavailable',
          image: '/img/example/admin_order_img_phone.png',
          link: 'https://example.com/product',
        },
        {
          id: 3,
          name: 'Samsung Ultra 23',
          price: 24000000,
          total_price: 72000000,
          quantity: 3,
          customer_note: '',
          status: 'unavailable',
          image: '/img/example/admin_order_img_phone.png',
          link: 'https://example.com/product',
        },
      ],
    });

    // Tab state
    const activeTab = ref('confirmation');

    const setActiveTab = (tab) => {
      activeTab.value = tab;
    };

    const navigateToOrderTab = () => {
      router.push({ name: 'admin.order.index', query: { tab: 'order' } });
    };

    // Modal state
    const showAvailabilityModal = ref(false);
    const modalForm = ref({
      date: '',
      time: '',
      isPm: false,
      price: '',
      emsPrice: '',
      maxOrder: '',
      note: '',
      status: 'available',
      productId: null,
    });

    const openAvailabilityModal = (product, isAvailable) => {
      modalForm.value = {
        date: '',
        time: '',
        isPm: false,
        price: product.price || '',
        emsPrice: '',
        maxOrder: product.max_order || '',
        note: product.admin_note || '',
        status: isAvailable ? 'available' : 'unavailable',
        productId: product.id,
      };
      showAvailabilityModal.value = true;
    };

    const closeAvailabilityModal = () => {
      showAvailabilityModal.value = false;
      modalForm.value = {
        date: '',
        time: '',
        isPm: false,
        price: '',
        emsPrice: '',
        maxOrder: '',
        note: '',
        status: 'available',
        productId: null,
      };
    };

    const saveAvailability = () => {
      const product = confirmation.value.products.find(p => p.id === modalForm.value.productId);
      if (product) {
        product.status = modalForm.value.status;
        product.admin_note = modalForm.value.note;
        product.max_order = modalForm.value.maxOrder;
        product.price = modalForm.value.price;
        product.available_until = modalForm.value.date
          ? `${new Date(modalForm.value.date).toLocaleDateString('id-ID', {
            day: '2-digit',
            month: 'long',
            year: 'numeric',
          })} ${modalForm.value.time} ${modalForm.value.isPm ? 'PM' : 'AM'}`
          : product.available_until;
        // Simulate API call
        /*
        await axios.post(`/api/admin/confirmation/${confirmation.value.id}/product/${product.id}`, modalForm.value);
        */
      }
      closeAvailabilityModal();
    };

    const submitConfirmation = () => {
      // Simulate API call
      console.log('Submitting confirmation:', confirmation.value);
      /*
      await axios.post(`/api/admin/confirmation/${confirmation.value.id}/submit`);
      */
      router.push({ name: 'admin.order.index', query: { tab: 'confirmation' } });
    };

    // Formatting
    const formatPrice = (price) => {
      return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    };

    // Currency conversion (placeholder)
    const krwToIdrRate = ref(11.5); // Static rate for demo
    const fetchKrwToIdr = async () => {
      try {
        /*
        const response = await axios.get('https://open.er-api.com/v6/latest/KRW');
        krwToIdrRate.value = response.data.rates.IDR;
        */
      } catch (error) {
        console.error('Error fetching KRW to IDR rate:', error);
      }
    };

    // API Fetching
    const fetchConfirmation = async (confirmationId) => {
      try {
        /*
        const response = await axios.get(`/api/admin/confirmation/${confirmationId}`);
        confirmation.value = response.data.confirmation;
        */
      } catch (error) {
        console.error('Error fetching confirmation:', error);
      }
    };

    return {
      confirmation,
      activeTab,
      setActiveTab,
      navigateToOrderTab,
      showAvailabilityModal,
      modalForm,
      openAvailabilityModal,
      closeAvailabilityModal,
      saveAvailability,
      submitConfirmation,
      formatPrice,
      krwToIdrRate,
      fetchKrwToIdr,
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