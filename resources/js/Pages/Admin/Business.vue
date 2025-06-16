<script setup>
import { ref } from 'vue';
import Layout from '../Layouts/Admin.vue';
import Modal from './Modal.vue';
import axios from 'axios';

// Dummy data for business settings
const settings = ref([
  {
    id: 1,
    name: 'Business',
    value: 'My Awesome Store',
  },
  {
    id: 2,
    name: 'Address',
    value: '123 Business Street, Jakarta, Indonesia',
  },
  {
    id: 3,
    name: 'Contact Email',
    value: 'contact@myawesomestore.com',
  },
]);

// Modal visibility state
const showEditModal = ref(false);

// Current setting being edited
const editingSetting = ref(null);

// Form data for editing
const formData = ref({
  name: '',
  value: '',
});

// Open edit modal
const openEditModal = (setting) => {
  editingSetting.value = setting;
  formData.value = { ...setting };
  showEditModal.value = true;
};

// Close edit modal
const closeEditModal = () => {
  showEditModal.value = false;
  editingSetting.value = null;
  formData.value = { name: '', value: '' };
};

// Update setting
const updateSetting = async () => {
  try {
    /*
    await axios.put(`/api/admin/settings/${editingSetting.value.id}`, formData.value);
    */
    // Simulate updating dummy data
    const index = settings.value.findIndex(s => s.id === editingSetting.value.id);
    if (index !== -1) {
      settings.value[index] = { id: editingSetting.value.id, ...formData.value };
    }
    closeEditModal();
  } catch (error) {
    console.error('Error updating setting:', error);
  }
};

// Fetch settings (placeholder for API)
const fetchSettings = async () => {
  try {
    /*
    const response = await axios.get('/api/admin/settings');
    settings.value = response.data;
    */
  } catch (error) {
    console.error('Error fetching settings:', error);
  }
};

// Initialize
fetchSettings();
</script>

<template>
  <Layout title="Test Bisnis">
    <div class="p-1 md:p-4 border-2 bg-[#EFEFEF] border-gray-200 rounded-lg dark:border-gray-700 h-[88vh] overflow-auto">
      <!-- Content Container -->
      <div class="flex flex-col items-start justify-start bg-gray-50 h-auto dark:bg-gray-800 rounded-xl shadow-lg p-0.5 md:p-4">
        <!-- Settings Table -->
        <table class="w-full table-auto text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-1 py-2 md:px-6 md:py-3">Name</th>
              <th scope="col" class="px-1 py-2 md:px-6 md:py-3">Value</th>
              <th scope="col" class="px-1 py-2 md:px-6 md:py-3">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="setting in settings"
              :key="setting.id"
              class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700"
            >
              <th scope="row" class="px-1 py-2  md:px-6 md:py-4 font-medium text-gray-900 whitespace-normal dark:text-white">
                {{ setting.name }}
              </th>
              <td class="py-2 md:px-6 md:py-4 whitespace-normal text-xs md:text-base">{{ setting.value }}</td>
              <td class="py-2 md:px-6 md:py-4">
                <button
                  class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                  @click="openEditModal(setting)"
                >
                  Edit
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Edit Setting Modal -->
      <Modal :show="showEditModal" @close="closeEditModal">
        <div class="bg-white w-[60vw] md:w-[40vw] rounded-[30px] shadow md:px-10 md:py-5">
          <div class="w-full h-full flex flex-col relative">
            <h1 class="text-black font-bold text-2xl p-4 md:p-5 pb-2 ml-6">Edit Setting</h1>
            <button
              class="absolute bg-black w-6 h-6 flex items-center justify-center rounded-full top-0 right-0"
              @click="closeEditModal"
            >
              <p class="text-white text-md">X</p>
            </button>
            <form @submit.prevent="updateSetting" class="flex flex-col h-full text-center py-2 px-5">
              <table class="w-full text-sm text-left">
                <tbody>
                  <tr>
                    <td class="md:px-6 md:py-3">
                      <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                      <input
                        v-model="formData.name"
                        type="text"
                        id="name"
                        placeholder="Setting Name"
                        class="mt-1 text-gray-900 rounded-2xl w-full border border-gray-300 bg-white hover:bg-gray-50 h-12 pl-5 pr-4 placeholder:text-gray-400 focus:border-blue-500 focus:outline-none focus:ring-0"
                        required
                      >
                    </td>
                  </tr>
                  <tr>
                    <td class="md:px-6 md:py-3">
                      <label for="value" class="block text-sm font-medium text-gray-700">Value</label>
                      <textarea
                        v-model="formData.value"
                        id="value"
                        placeholder="Setting Value"
                        rows="4"
                        class="mt-1 text-gray-900 rounded-2xl w-full bg-white hover:bg-gray-50 border border-gray-300 pl-5 pr-4 placeholder:text-gray-400 focus:border-blue-500 focus:outline-none focus:ring-0"
                        required
                      ></textarea>
                    </td>
                  </tr>
                </tbody>
              </table>
              <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white text-base font-semibold mx-auto mt-3 mb-3 w-1/4 h-10 rounded-xl"
              >
                Save
              </button>
            </form>
          </div>
        </div>
      </Modal>
    </div>
  </Layout>
</template>

<style scoped>
/* Custom styles if needed */
</style>