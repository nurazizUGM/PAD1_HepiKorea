<script setup>
import { ref } from 'vue';
// import { useRouter } from 'vue-router';
import Layout from '../../Layouts/Customer.vue';
import Modal from '../Modal.vue';
import axios from 'axios';

// Dummy data for addresses
const addresses = ref([
  {
    id: 1,
    fullname: 'Aisyah',
    phone: '813-9230-8107',
    address: 'Bulaksumur, Caturtunggal, Kapanewon Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281',
    province: 'Daerah Istimewa Yogyakarta',
    city: 'Sleman',
    postal_code: '55281',
  },
  {
    id: 2,
    fullname: 'Budi',
    phone: '812-3456-7890',
    address: 'Jalan Kaliurang KM 5, Sleman, Daerah Istimewa Yogyakarta 55284',
    province: 'Daerah Istimewa Yogyakarta',
    city: 'Sleman',
    postal_code: '55284',
  },
  {
    id: 3,
    fullname: 'Cindy',
    phone: '811-9876-5432',
    address: 'Jalan Affandi, Sleman, Daerah Istimewa Yogyakarta 55283',
    province: 'Daerah Istimewa Yogyakarta',
    city: 'Sleman',
    postal_code: '55283',
  },
]);

// Selected address ID
const selectedAddressId = ref(null);

// Modal visibility states
const showAddModal = ref(false);
const showEditModal = ref(false);
const showDeleteModal = ref(false);
const showSuccessAddedModal = ref(false);
const showSuccessUpdatedModal = ref(false);
const showSuccessDeletedModal = ref(false);

// Current address being edited
const editingAddress = ref(null);

// Form data for add/edit
const formData = ref({
  fullname: '',
  phone: '',
  province: '',
  city: '',
  address: '',
  postal_code: '',
});

// Reset form data
const resetForm = () => {
  formData.value = {
    fullname: '',
    phone: '',
    province: '',
    city: '',
    address: '',
    postal_code: '',
  };
};

// Open modals
const openAddModal = () => {
  resetForm();
  showAddModal.value = true;
};

const openEditModal = (address) => {
  editingAddress.value = address;
  formData.value = { ...address };
  showEditModal.value = true;
};

const openDeleteModal = (address) => {
  editingAddress.value = address;
  showDeleteModal.value = true;
};

// Handle form submissions
const addAddress = async () => {
  try {
    /*
    await axios.post('/api/customer/addresses', formData.value);
    */
    // Simulate adding to dummy data
    addresses.value.push({
      id: addresses.value.length + 1,
      ...formData.value,
    });
    showAddModal.value = false;
    showSuccessAddedModal.value = true;
    setTimeout(() => (showSuccessAddedModal.value = false), 2000);
    resetForm();
  } catch (error) {
    console.error('Error adding address:', error);
  }
};

const updateAddress = async () => {
  try {
    /*
    await axios.put(`/api/customer/addresses/${editingAddress.value.id}`, formData.value);
    */
    // Simulate updating dummy data
    const index = addresses.value.findIndex(addr => addr.id === editingAddress.value.id);
    if (index !== -1) {
      addresses.value[index] = { id: editingAddress.value.id, ...formData.value };
    }
    showEditModal.value = false;
    showSuccessUpdatedModal.value = true;
    setTimeout(() => (showSuccessUpdatedModal.value = false), 2000);
    resetForm();
    editingAddress.value = null;
  } catch (error) {
    console.error('Error updating address:', error);
  }
};

const deleteAddress = async () => {
  try {
    /*
    await axios.delete(`/api/customer/addresses/${editingAddress.value.id}`);
    */
    // Simulate deleting from dummy data
    addresses.value = addresses.value.filter(addr => addr.id !== editingAddress.value.id);
    showDeleteModal.value = false;
    showSuccessDeletedModal.value = true;
    setTimeout(() => (showSuccessDeletedModal.value = false), 2000);
    editingAddress.value = null;
  } catch (error) {
    console.error('Error deleting address:', error);
  }
};

// Fetch addresses (placeholder for API)
const fetchAddresses = async () => {
  try {
    /*
    const response = await axios.get('/api/customer/addresses');
    addresses.value = response.data;
    */
  } catch (error) {
    console.error('Error fetching addresses:', error);
  }
};

// Initialize
fetchAddresses();

// const router = useRouter();
// const goBack = () => {
//   router.go(-1);
// };
</script>

<template>
  <Layout title="Address">
    <div class="flex flex-col flex-wrap p-2 lg:p-6 border-2 bg-[#EFEFEF] border-gray-200 rounded-lg lg:rounded-3xl w-full min-h-fit">
      <div class="w-full h-full min-h-[82vh] lg:min-h-[640px] flex flex-col py-1 px-3 md:py-2 md:px-5 lg:p-8 bg-white rounded-3xl">
        <!-- Header -->
        <div class="flex flex-row items-center w-full mb-4">
          <h1 class="text-[#3E6E7A] font-semibold text-[10px] md:text-sm lg:text-2xl w-fit mr-4 lg:mr-6">Customer Address</h1>
          <h2 class="text-black font-bold text-[10px] md:text-sm lg:text-xl">New Address</h2>
          <button class="rounded-full bg-[#3E6E7A] w-6 lg:w-8 hover:bg-[#37626d] active:bg-[#325862] my-auto ml-4"
            @click="openAddModal">
            <img src="/img/assets/icon/icon_faq_plus.svg" alt="plus Icon" class="w-6 h-6 lg:h-8 lg:w-8">
          </button>
        </div>

        <!-- Address List -->
        <div class="h-auto w-full mb-6 overflow-y-auto max-h-screen">
          <div v-for="address in addresses" :key="address.id" class="w-full h-full flex flex-row mt-1 lg:mt-5 mb-auto">
            <div class="w-8/12 md:w-3/12 lg:w-2/12 flex h-full">
              <input type="radio" v-model="selectedAddressId" :value="address.id" name="choose-address"
                class="lg:w-8 lg:h-8 border-4 border-[#3E6E7A] checked:bg-[#3E6E7A] checked:ring-0 ml-1 my-auto cursor-pointer">
              <div class="flex flex-col ml-3 md:ml-4">
                <div class="flex flex-col md:flex-row">
                  <p class="text-[#3E6E7A] font-semibold text-[10px] lg:text-lg">{{ address.fullname }} <span
                      class="text-orange-500 font-semibold text-[10px] lg:text-lg lg:hidden ml-1">(+62)</span></p>
                  <p class="text-orange-500 font-semibold text-[10px] lg:text-lg hidden lg:flex  ml-5">(+62)</p>
                </div>
                <p class="text-[#898383] font-semibold text-[10px] lg:text-lg">{{ address.phone }}</p>
                <!-- address ini nanti muncul di mobile aja -->
                <p class="text-black text-opacity-50 font-semibold text-[9px] lg:text-lg flex md:hidden">{{
                  address.address }}</p>
              </div>
            </div>
            <!-- ini nanti hidden di mobile -->
            <div class="w-8/12 max-w-4/6 hidden md:flex h-full lg:pr-14 mb-auto">
              <p class="text-black text-opacity-50 font-semibold text-[10px] lg:text-lg">{{ address.address }}</p>
            </div>
            <!-- two button container -->
            <div class="w-4/12 lg:w-1/12 h-full flex mb-auto">
              <button
                class="w-fit bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white text-[10px] lg:text-lg font-semibold rounded-md lg:rounded-2xl py-0.5 px-2 lg:py-2 lg:px-6 ml-auto"
                @click="openEditModal(address)">
                Edit
              </button>
              <button
                class="w-fit bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white text-[10px] lg:text-lg font-semibold rounded-md lg:rounded-2xl py-0.5 px-2 lg:py-2 lg:px-6 ml-2"
                @click="openDeleteModal(address)">
                Delete
              </button>
            </div>
          </div>
        </div>

        <!-- Back Button -->
        <button
          class="w-fit flex flex-row bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white text-[10px] lg:text-lg font-semibold rounded-2xl justify-center items-center py-0.5 pl-2 pr-4 lg:py-2 lg:pl-12 lg:pr-16 mr-auto mt-auto">
          <img src="/img/assets/icon/icon_arrow_back.svg" alt="back arrow" class="w-5 h-4 lg:w-10 lg:h-8">
          <p class="my-auto">Back</p>
        </button>
      </div>

      <!-- Add Address Modal -->
      <Modal :show="showAddModal" @close="showAddModal = false">
        <div class="bg-white w-[70vw] md:w-[50vw] lg:w-[55vw] rounded-[30px] shadow md:px-8 lg:px-10 lg:py-5">
          <div class="w-full h-full flex flex-col relative">
            <h1 class="text-black font-bold text-[10px] md:text-lg lg:text-xl p-5 pb-2 lg:ml-6">New Address</h1>
            <button class="absolute bg-black w-6 h-6 flex items-center justify-center rounded-full -top-1 -right-1 md:-right-8 lg:-top-5 lg:-right-10 "
              @click="showAddModal = false">
              <p class="text-white text-md">X</p>
            </button>
            <form @submit.prevent="addAddress" class="flex flex-col h-full text-center lg:py-2 lg:px-5">
              <table class="w-full text-sm">
                <tbody>
                  <tr>
                    <td class="px-1 py-1 md:py-2 lg:px-6 lg:py-3">
                      <input v-model="formData.fullname" type="text" placeholder="Full Name"
                        class="text-[10px] lg:text-base text-[#3E6E7A] lg:text-orange-400 rounded-lg lg:rounded-2xl w-full border border-[#3E6E7A] bg-white hover:bg-slate-50 h-7 lg:h-12 pr-3 pl-2 lg:pl-5 lg:pr-4 placeholder:text-[#3E6E7A] lg:placeholder:text-orange-400 focus:border-[#3E6E7A] focus:outline-none focus:ring-0"
                        required>
                    </td>
                  </tr>
                  <tr>
                    <td class="px-1 py-1 md:py-2 lg:px-6 lg:py-3">
                      <input v-model="formData.phone" type="text" placeholder="Phone Number"
                        class="text-[10px] lg:text-base text-[#3E6E7A] lg:text-orange-400 rounded-lg lg:rounded-2xl w-full border border-[#3E6E7A] bg-white hover:bg-slate-50 h-7 lg:h-12 pr-3 pl-2 lg:pl-5 lg:pr-4 placeholder:text-[#3E6E7A] lg:placeholder:text-orange-400 focus:border-[#3E6E7A] focus:outline-none focus:ring-0"
                        required>
                    </td>
                  </tr>
                  <tr>
                    <td class="px-1 py-1 md:py-2 lg:px-6 lg:py-3">
                      <div class="flex flex-col lg:flex-row gap-2 md:gap-4 lg:gap-4">
                        <input v-model="formData.province" type="text" placeholder="Province"
                          class="text-[10px] lg:text-base text-[#3E6E7A] lg:text-orange-400 rounded-lg lg:rounded-2xl w-full border border-[#3E6E7A] bg-white hover:bg-slate-50 h-7 lg:h-12 pr-3 pl-2 lg:pl-5 lg:pr-4 placeholder:text-[#3E6E7A] lg:placeholder:text-orange-400 focus:border-[#3E6E7A] focus:outline-none focus:ring-0">
                        <input v-model="formData.city" type="text" placeholder="City"
                          class="text-[10px] lg:text-base text-[#3E6E7A] lg:text-orange-400 rounded-lg lg:rounded-2xl w-full border border-[#3E6E7A] bg-white hover:bg-slate-50 h-7 lg:h-12 pr-3 pl-2 lg:pl-5 lg:pr-4 placeholder:text-[#3E6E7A] lg:placeholder:text-orange-400 focus:border-[#3E6E7A] focus:outline-none focus:ring-0"
                          required>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="px-1 py-1 md:py-2 lg:px-6 lg:py-3">
                      <textarea v-model="formData.address" placeholder="Your Address"
                        class="resize-none text-[10px] lg:text-base text-[#3E6E7A] lg:text-orange-400 rounded-lg lg:rounded-2xl w-full h-[106px] lg:h-[182px] bg-white hover:bg-slate-50 border border-[#3E6E7A] pr-3 pl-2 lg:pl-5 lg:pr-4 placeholder:text-[#3E6E7A] lg:placeholder:text-orange-400 focus:border-[#3E6E7A] focus:outline-none focus:ring-0"
                        required></textarea>
                    </td>
                  </tr>
                  <tr>
                    <td class="px-1 py-1 md:py-2 lg:px-6 lg:py-3">
                      <input v-model="formData.postal_code" type="text" placeholder="Postal Code"
                        class="text-[10px] lg:text-base text-[#3E6E7A] lg:text-orange-400 rounded-lg lg:rounded-2xl w-full border border-[#3E6E7A] bg-white hover:bg-slate-50 h-7 lg:h-12 pr-3 pl-2 lg:pl-5 lg:pr-4 placeholder:text-[#3E6E7A] lg:placeholder:text-orange-400 focus:border-[#3E6E7A] focus:outline-none focus:ring-0"
                        required>
                    </td>
                  </tr>
                </tbody>
              </table>
              <button type="submit"
                class="bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white text-xs lg:text-base font-semibold mx-auto mt-1 md:mt-3 lg:mt-3 mb-3 w-1/4 h-7 lg:h-10 rounded-lg lg:rounded-xl">
                Save
              </button>
            </form>
          </div>
        </div>
      </Modal>

      <!-- Edit Address Modal -->
      <Modal :show="showEditModal" @close="showEditModal = false">
        <div class="bg-white w-[70vw] md:w-[50vw] lg:w-[55vw] rounded-[30px] shadow md:px-8 lg:px-10 lg:py-5">
          <div class="w-full h-full flex flex-col relative">
            <h1 class="text-black font-bold text-[10px] md:text-lg lg:text-xl p-5 pb-2 lg:ml-6">Edit Address</h1>
            <button class="absolute bg-black w-6 h-6 flex items-center justify-center rounded-full -top-1 -right-1 md:-right-8 lg:-top-5 lg:-right-10"
              @click="showEditModal = false">
              <p class="text-white text-md">X</p>
            </button>
            <form @submit.prevent="updateAddress" class="flex flex-col h-full text-center lg:py-2 lg:px-5">
              <table class="w-full text-sm">
                <tbody>
                  <tr>
                    <td class="px-1 py-1 md:py-2 lg:px-6 lg:py-3">
                      <input v-model="formData.fullname" type="text" placeholder="Full Name"
                        class="text-[10px] lg:text-base text-[#3E6E7A] lg:text-orange-400 rounded-lg lg:rounded-2xl w-full border border-[#3E6E7A] bg-white hover:bg-slate-50 h-7 lg:h-12 pr-3 pl-2 lg:pl-5 lg:pr-4 placeholder:text-[#3E6E7A] lg:placeholder:text-orange-400 focus:border-[#3E6E7A] focus:outline-none focus:ring-0"
                        required>
                    </td>
                  </tr>
                  <tr>
                    <td class="px-1 py-1 md:py-2 lg:px-6 lg:py-3">
                      <input v-model="formData.phone" type="text" placeholder="Phone Number"
                        class="text-[10px] lg:text-base text-[#3E6E7A] lg:text-orange-400 rounded-lg lg:rounded-2xl w-full border border-[#3E6E7A] bg-white hover:bg-slate-50 h-7 lg:h-12 pr-3 pl-2 lg:pl-5 lg:pr-4 placeholder:text-[#3E6E7A] lg:placeholder:text-orange-400 focus:border-[#3E6E7A] focus:outline-none focus:ring-0"
                        required>
                    </td>
                  </tr>
                  <tr>
                    <td class="px-1 py-1 md:py-2 lg:px-6 lg:py-3">
                      <div class="flex flex-col lg:flex-row gap-2 md:gap-4 lg:gap-4">
                        <input v-model="formData.province" type="text" placeholder="Province"
                          class="text-[10px] lg:text-base text-[#3E6E7A] lg:text-orange-400 rounded-lg lg:rounded-2xl w-full border border-[#3E6E7A] bg-white hover:bg-slate-50 h-7 lg:h-12 pr-3 pl-2 lg:pl-5 lg:pr-4 placeholder:text-[#3E6E7A] lg:placeholder:text-orange-400 focus:border-[#3E6E7A] focus:outline-none focus:ring-0">
                        <input v-model="formData.city" type="text" placeholder="City"
                          class="text-[10px] lg:text-base text-[#3E6E7A] lg:text-orange-400 rounded-lg lg:rounded-2xl w-full border border-[#3E6E7A] bg-white hover:bg-slate-50 h-7 lg:h-12 pr-3 pl-2 lg:pl-5 lg:pr-4 placeholder:text-[#3E6E7A] lg:placeholder:text-orange-400 focus:border-[#3E6E7A] focus:outline-none focus:ring-0"
                          required>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="px-1 py-1 md:py-2 lg:px-6 lg:py-3">
                      <textarea v-model="formData.address" placeholder="Your Address" rows="8"
                        class="resize-none text-[10px] lg:text-base text-[#3E6E7A] lg:text-orange-400 rounded-lg lg:rounded-2xl w-full h-[106px] lg:h-[182px] bg-white hover:bg-slate-50 border border-[#3E6E7A] pr-3 pl-2 lg:pl-5 lg:pr-4 placeholder:text-[#3E6E7A] lg:placeholder:text-orange-400 focus:border-[#3E6E7A] focus:outline-none focus:ring-0"
                        required></textarea>
                    </td>
                  </tr>
                  <tr>
                    <td class="px-1 py-1 md:py-2 lg:px-6 lg:py-3">
                      <input v-model="formData.postal_code" type="text" placeholder="Postal Code"
                        class="text-[10px] lg:text-base text-[#3E6E7A] lg:text-orange-400 rounded-lg lg:rounded-2xl w-full border border-[#3E6E7A] bg-white hover:bg-slate-50 h-7 lg:h-12 pr-3 pl-2 lg:pl-5 lg:pr-4 placeholder:text-[#3E6E7A] lg:placeholder:text-orange-400 focus:border-[#3E6E7A] focus:outline-none focus:ring-0"
                        required>
                    </td>
                  </tr>
                </tbody>
              </table>
              <button type="submit"
                class="bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white text-xs lg:text-base font-semibold mx-auto mt-1 md:mt-3 lg:mt-3 mb-3 w-1/4 h-7 lg:h-10 rounded-lg lg:rounded-xl">
                Save
              </button>
            </form>
          </div>
        </div>
      </Modal>

      <!-- Delete Confirmation Modal -->
      <Modal :show="showDeleteModal" @close="showDeleteModal = false">
        <div class="bg-white w-[225px] md:w-[325px] lg:w-[33vw] h-auto rounded-[30px] shadow p-4">
          <div class="flex flex-col md:py-2 lg:p-10">
            <img src="/img/assets/icon/icon_warning.svg" alt="icon_warning" class="w-10 h-10 md:w-[51px] md:h-[51px] lg:w-16 lg:h-16 mx-auto">
            <p class="text-[#376F7E] font-medium text-sm lg:text-xl mx-auto mt-2">Are you sure?</p>
            <p class="text-[#B7B7B7] font-medium text-[10px] lg:text-xs mx-auto mt-2 lg:mt-6">You won’t be able to revert this!</p>
            <div class="w-full mt-3 lg:mt-6 flex flex-row justify-center">
              <button class="w-[86px] md:w-[132px] lg:w-44 h-[22px] md:h-[41px] lg:h-11 bg-[#376F7E] rounded-[20px] shadow-lg text-white text-[10px] md:text-sm lg:text-lg font-semibold"
                @click="deleteAddress">
                Yes, Delete it!
              </button>
              <button class="w-[86px] md:w-[132px] lg:w-44 h-[22px] md:h-[41px] lg:h-11 bg-[#FF9D66] rounded-[20px] shadow-lg text-white text-[10px] md:text-sm lg:text-lg font-semibold ml-2"
                @click="showDeleteModal = false">
                Cancel
              </button>
            </div>
          </div>
        </div>
      </Modal>

      <!-- Success Added Modal -->
      <Modal :show="showSuccessAddedModal" @close="showSuccessAddedModal = false">
        <div class="bg-white w-[172px] md:w-[400px] lg:w-[25vw] h-auto rounded-[30px] shadow py-7 md:py-14 lg:p-4">
          <div class="flex flex-col lg:p-14">
            <h1 class="text-black text-[10px] md:text-xl lg:text-xl font-medium mx-auto">Successfully Added!</h1>
            <img src="/img/assets/icon/icon_green_check.svg" alt="green_check" class="w-24 h-24 mx-auto mt-6">
          </div>
        </div>
      </Modal>

      <!-- Success Updated Modal -->
      <Modal :show="showSuccessUpdatedModal" @close="showSuccessUpdatedModal = false">
        <div class="bg-white w-[172px] md:w-[400px] lg:w-[25vw] h-auto rounded-[30px] shadow py-7 md:py-14 lg:p-4">
          <div class="flex flex-col lg:p-14">
            <h1 class="text-black text-[10px] md:text-xl lg:text-xl font-medium mx-auto">Successfully Updated!</h1>
            <img src="/img/assets/icon/icon_green_check.svg" alt="green_check" class="w-11 h-11 md:h-24 md:w-24 lg:w-24 lg:h-24 mx-auto mt-3 lg:mt-6">
          </div>
        </div>
      </Modal>

      <!-- Success Deleted Modal -->
      <Modal :show="showSuccessDeletedModal" @close="showSuccessDeletedModal = false">
        <div class="bg-white w-[172px] md:w-[400px] lg:w-[25vw] h-auto rounded-[30px] shadow py-7 md:py-14 lg:p-4">
          <div class="flex flex-col lg:p-14">
            <h1 class="text-black text-[10px] md:text-xl lg:text-xl font-medium mx-auto">Successfully Deleted!</h1>
            <img src="/img/assets/icon/icon_green_check.svg" alt="green_check" class="w-11 h-11 md:h-24 md:w-24 lg:w-24 lg:h-24 mx-auto mt-3 lg:mt-6">
          </div>
        </div>
      </Modal>
    </div>
  </Layout>
</template>

<style scoped>
/* Custom styles if needed */
</style>