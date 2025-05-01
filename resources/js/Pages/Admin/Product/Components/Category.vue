<template>
    <div class="h-full flex flex-col">
      <div class="w-full flex items-center">
        <h2 class="text-black text-md ml-3 font-semibold">Add Category</h2>
        <button @click="openAddModal" class="ml-10">
          <img src="/img/assets/icon/icon_admin_product_plus.svg" alt="plus icon" class="w-10 h-10" />
        </button>
      </div>
  
      <!-- Category Cards -->
      <div
        class="w-full h-[85%] mt-5 overflow-y-scroll flex flex-wrap flex-row gap-x-12 gap-y-8 justify-start items-start content-start">
        <div v-for="category in categories" :key="category.id"
          class="bg-white w-60 h-72 rounded-lg overflow-hidden flex flex-col">
          <div class="w-full h-2/3 bg-cover bg-top"
            :style="{ backgroundImage: `url(${category.icon || 'https://placehold.co/200'})` }" />
          <div class="p-2">
            <p class="text-lg text-[#3E6E7A] text-center font-bold truncate">{{ category.name }}</p>
          </div>
          <div class="flex mt-auto mx-4 mb-4">
            <button @click="openEditModal(category)" class="mr-auto">
              <img src="/img/assets/icon/icon_admin_category_edit.svg" alt="edit" class="w-7 h-7" />
            </button>
            <button @click="openDeleteModal(category.id)" class="ml-auto">
              <img src="/img/assets/icon/icon_admin_category_trash.svg" alt="delete" class="w-7 h-7" />
            </button>
          </div>
        </div>
      </div>
  
      <!-- Add Category Modal -->
      <Modal :show="showAddModal" @close="showAddModal = false">
        <div class="bg-white w-[60vw] h-[50svh] rounded-lg shadow p-6">
          <button @click="showAddModal = false"
            class="absolute bg-black w-5 h-5 flex items-center justify-center rounded-full pb-3 -top-2 -right-2">
            <p class="m-auto text-white text-sm">X</p>
          </button>
          <h1 class="text-[#376F7E] font-semibold text-3xl mb-2 ml-2">Add Category</h1>
          <div class="w-full h-full flex flex-row">
            <div class="w-[40%] h-full bg-contain bg-no-repeat bg-top rounded-lg"
              :style="{ backgroundImage: `url(${previewImage || 'https://placehold.co/200'})` }" />
            <div class="w-[60%] h-full px-4 flex flex-col">
              <form @submit.prevent="addCategory" class="flex flex-col h-full text-center py-4 px-5">
                <h1 class="text-orange-400 text-xl font-semibold text-left">Icon Category</h1>
                <div class="relative w-full mt-5">
                  <input ref="addFileInput" type="file" accept="image/*" class="hidden" @change="handleAddFile" />
                  <label @click="triggerAddFileInput"
                    class="flex items-center justify-between w-full rounded-3xl bg-gray-200 hover:bg-gray-300 h-14 pl-10 pr-4 cursor-pointer">
                    <span class="text-black font-semi">Icon</span>
                    <img src="/img/assets/icon/icon_admin_category_upload.svg" alt="Upload Icon" class="h-8 w-8" />
                  </label>
                </div>
                <h1 class="text-orange-400 text-xl font-semibold text-left mt-5">Category Name</h1>
                <input v-model="addForm.name" type="text" placeholder="Write The Category Name..."
                  class="rounded-3xl w-full bg-gray-200 hover:bg-gray-300 h-14 pl-10 pr-4 mt-5 placeholder:text-black placeholder:font-semi border-0 focus:outline-none focus:ring-0" />
                <div class="flex-grow"></div>
                <button type="submit"
                  class="bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white font-semibold mt-auto ml-auto inline-block w-1/4 h-10 rounded-2xl">
                  Save
                </button>
              </form>
            </div>
          </div>
        </div>
      </Modal>
  
      <!-- Edit Category Modal -->
      <Modal :show="showEditModal" @close="showEditModal = false">
        <div class="bg-white w-[60vw] h-[50svh] rounded-lg shadow p-6">
          <button @click="showEditModal = false"
            class="absolute bg-black w-5 h-5 flex items-center justify-center rounded-full pb-3 -top-2 -right-2">
            <p class="m-auto text-white text-sm">X</p>
          </button>
          <h1 class="text-[#376F7E] font-semibold text-3xl mb-2 ml-2">Edit Category</h1>
          <div class="w-full h-full flex flex-row">
            <div class="w-[40%] h-full bg-contain bg-no-repeat bg-top rounded-lg"
              :style="{ backgroundImage: `url(${previewImage || editForm.icon || 'https://placehold.co/200'})` }" />
            <div class="w-[60%] h-full px-4 flex flex-col">
              <form @submit.prevent="updateCategory" class="flex flex-col h-full text-center py-4 px-5">
                <h1 class="text-orange-400 text-xl font-semibold text-left">Icon Category</h1>
                <div class="relative w-full mt-5">
                  <input ref="editFileInput" type="file" accept="image/*" class="hidden" @change="handleEditFile" />
                  <label @click="triggerEditFileInput"
                    class="flex items-center justify-between w-full rounded-3xl bg-gray-200 hover:bg-gray-300 h-14 pl-10 pr-4 cursor-pointer">
                    <span class="text-black font-semi">Upload Your File...</span>
                    <img src="/img/assets/icon/icon_admin_category_upload.svg" alt="Upload Icon" class="h-8 w-8" />
                  </label>
                </div>
                <h1 class="text-orange-400 text-xl font-semibold text-left mt-5">Category Name</h1>
                <input v-model="editForm.name" type="text" placeholder="Name"
                  class="rounded-3xl w-full bg-gray-200 hover:bg-gray-300 h-14 pl-10 pr-4 mt-5 placeholder:text-black placeholder:font-semi border-0 focus:outline-none focus:ring-0" />
                <div class="flex-grow"></div>
                <button type="submit"
                  class="bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white font-semibold mt-auto ml-auto inline-block w-1/4 h-10 rounded-2xl">
                  Change
                </button>
              </form>
            </div>
          </div>
        </div>
      </Modal>
  
      <!-- Delete Confirmation Modal -->
      <Modal :show="showDeleteModal" @close="showDeleteModal = false">
        <div class="bg-white w-[33vw] h-auto rounded-[30px] shadow p-4">
          <div class="flex flex-col px-10 py-10">
            <img src="/img/assets/icon/icon_warning.svg" alt="warning" class="w-16 h-16 mx-auto" />
            <p class="text-[#376F7E] font-medium text-xl mx-auto mt-2">Are you sure?</p>
            <p class="text-[#B7B7B7] font-medium text-xs mx-auto mt-6">You won’t be able to revert this!</p>
            <div class="w-full mt-6 flex flex-row justify-center">
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
      </Modal>
  
      <!-- Success Modal -->
      <Modal :show="showSuccessModal" @close="showSuccessModal = false">
        <div class="bg-white w-[25vw] h-auto rounded-[30px] shadow p-4">
          <div class="flex flex-col p-14">
            <h1 class="text-black text-xl font-medium mx-auto">Successfully {{ successMessage }}!</h1>
            <img src="/img/assets/icon/icon_green_check.svg" alt="success" class="w-24 h-24 mx-auto mt-6" />
          </div>
        </div>
      </Modal>
    </div>
  </template>
  
  <script>
  import { ref, onMounted } from 'vue';
  import Modal from './Modal.vue';
  import axios from 'axios';
  
  export default {
    components: { Modal },
    setup() {
      // Dummy data
      const categories = ref([
        { id: 1, name: 'Electronics', icon: 'https://placehold.co/200' },
        { id: 2, name: 'Clothing', icon: 'https://placehold.co/200' },
      ]);
  
      const showAddModal = ref(false);
      const showEditModal = ref(false);
      const showDeleteModal = ref(false);
      const showSuccessModal = ref(false);
      const successMessage = ref('');
      const addForm = ref({ name: '', icon: null });
      const editForm = ref({ id: null, name: '', icon: null });
      const previewImage = ref(null);
      const addFileInput = ref(null);
      const editFileInput = ref(null);
      const categoryToDelete = ref(null);
  
      // Fetch categories
      const fetchCategories = async () => {
        try {
          /*
          const response = await axios.get('/api/admin/categories');
          categories.value = response.data;
          */
        } catch (error) {
          console.error('Error fetching categories:', error);
        }
      };
  
      // Add category
      const addCategory = async () => {
        try {
          const formData = new FormData();
          formData.append('name', addForm.value.name);
          if (addFileInput.value.files[0]) formData.append('icon', addFileInput.value.files[0]);
  
          /*
          await axios.post('/api/admin/categories', formData, {
            headers: { 'Content-Type': 'multipart/form-data' },
          });
          */
          showAddModal.value = false;
          successMessage.value = 'Added';
          showSuccessModal.value = true;
          setTimeout(() => (showSuccessModal.value = false), 2000);
          addForm.value = { name: '', icon: null };
          previewImage.value = null;
        } catch (error) {
          console.error('Error adding category:', error);
        }
      };
  
      // Edit category
      const openEditModal = (category) => {
        editForm.value = { id: category.id, name: category.name, icon: category.icon };
        previewImage.value = null;
        showEditModal.value = true;
      };
  
      const updateCategory = async () => {
        try {
          const formData = new FormData();
          formData.append('_method', 'PATCH');
          formData.append('name', editForm.value.name);
          if (editFileInput.value.files[0]) formData.append('icon', editFileInput.value.files[0]);
  
          /*
          await axios.post(`/api/admin/categories/${editForm.value.id}`, formData, {
            headers: { 'Content-Type': 'multipart/form-data' },
          });
          */
          showEditModal.value = false;
          successMessage.value = 'Updated';
          showSuccessModal.value = true;
          setTimeout(() => (showSuccessModal.value = false), 2000);
        } catch (error) {
          console.error('Error updating category:', error);
        }
      };
  
      // Delete category
      const openDeleteModal = (id) => {
        categoryToDelete.value = id;
        showDeleteModal.value = true;
      };
  
      const confirmDelete = async () => {
        try {
          /*
          await axios.delete(`/api/admin/categories/${categoryToDelete.value}`);
          categories.value = categories.value.filter(c => c.id !== categoryToDelete.value);
          */
          showDeleteModal.value = false;
          successMessage.value = 'Deleted';
          showSuccessModal.value = true;
          setTimeout(() => (showSuccessModal.value = false), 2000);
        } catch (error) {
          console.error('Error deleting category:', error);
        }
      };
  
      // File handling
      const triggerAddFileInput = () => {
        addFileInput.value.click();
      };
  
      const triggerEditFileInput = () => {
        editFileInput.value.click();
      };
  
      const handleAddFile = (event) => {
        const file = event.target.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = (e) => {
            previewImage.value = e.target.result;
          };
          reader.readAsDataURL(file);
        }
      };
  
      const handleEditFile = (event) => {
        const file = event.target.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = (e) => {
            previewImage.value = e.target.result;
          };
          reader.readAsDataURL(file);
        }
      };
  
      const openAddModal = () => {
        showAddModal.value = true;
      };
  
      onMounted(() => {
        // fetchCategories();
      });
  
      return {
        categories,
        showAddModal,
        showEditModal,
        showDeleteModal,
        showSuccessModal,
        successMessage,
        addForm,
        editForm,
        previewImage,
        addFileInput,
        editFileInput,
        categoryToDelete,
        fetchCategories,
        addCategory,
        openEditModal,
        updateCategory,
        openDeleteModal,
        confirmDelete,
        triggerAddFileInput,
        triggerEditFileInput,
        handleAddFile,
        handleEditFile,
        openAddModal,
      };
    },
  };
  </script>