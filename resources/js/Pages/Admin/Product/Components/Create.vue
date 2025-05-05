<template>
    <AdminLayout title="Product">
      <div class="bg-[#EFEFEF] border-gray-200 rounded-lg">
        <!-- Tabs -->
        <div class="mb-3">
          <ul class="flex flex-wrap -mb-px text-lg font-bold text-center text-black gap-x-16" role="tablist">
            <li class="ml-auto" role="presentation">
              <Link :href="route('admin.product.index')"
                class="inline-block px-4 pt-4 pb-1 border-b-2 rounded-t-lg text-black border-orange-400">
                Product
              </Link>
            </li>
            <li class="md:mx-52 lg:mx-64" role="presentation">
              <Link :href="route('admin.category.index')"
                class="inline-block px-4 pt-4 pb-1 rounded-t-lg text-black hover:text-orange-400">
                Category
              </Link>
            </li>
            <li class="mr-auto" role="presentation">
              <Link :href="route('admin.carousel.index')"
                class="inline-block px-4 pt-4 pb-1 rounded-t-lg text-black hover:text-orange-400">
                Carousel
              </Link>
            </li>
          </ul>
        </div>
  
        <!-- Product Content -->
        <div class="px-10 pt-2 rounded-lg h-[80vh]">
          <div class="w-full h-full flex flex-row">
            <!-- Image Column -->
            <div class="w-3/12 h-[97%]">
              <div class="h-full flex flex-col space-y-4">
                <div class="w-full h-[20rem] mr-auto bg-white rounded-2xl p-3">
                  <img v-if="mainImage" :src="mainImage" class="w-full h-full object-contain rounded-lg"
                    alt="Main Image" />
                </div>
                <div class="flex space-x-2 mx-auto overflow-x-auto" id="product-image-preview">
                  <div v-for="(image, index) in images" :key="index" class="relative w-14 h-14">
                    <button @click="deleteImage(index)"
                      class="absolute bg-black bg-opacity-50 w-5 h-5 flex items-center justify-center rounded-full top-0 right-0">
                      <p class="text-white text-sm">x</p>
                    </button>
                    <img :src="image.path" @click="mainImage = image.path"
                      class="w-full h-full object-cover rounded-lg cursor-pointer border border-gray-100" />
                  </div>
                </div>
                <button @click="triggerFileInput"
                  class="w-[99%] flex items-center justify-center bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] h-10 rounded-2xl mb-5 text-lg font-bold text-white mx-auto">
                  <img src="/img/assets/icon/icon_admin_product_upload.svg" alt="Upload Icon" class="h-6 w-6 mr-3" />
                  Upload Photo
                </button>
                <input ref="fileInput" type="file" accept="image/*" multiple class="hidden" @change="handleFileUpload" />
                <div class="flex-grow"></div>
                <Link :href="route('admin.product.index')"
                  class="flex flex-row bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white font-semibold justify-center items-center w-2/5 h-10 rounded-2xl mb-6 mr-auto">
                  <img src="/img/assets/icon/icon_arrow_back.svg" alt="" class="w-10 h-8" />
                  <p class="my-auto">Back</p>
                </Link>
              </div>
            </div>
  
            <!-- Form Column -->
            <div class="w-9/12 h-[95%] pl-[115px] pr-10 justify-end">
              <div class="w-full h-full bg-[#FFFCFC] rounded-2xl ml-5 p-5">
                <h1 class="text-2xl font-semibold">Add Product</h1>
                <form @submit.prevent="createProduct" class="w-full h-full flex flex-col mt-8 pb-12">
                  <div class="flex items-center mb-7">
                    <div class="w-4/12">
                      <label for="nama-produk" class="text-[#898383] text-lg font-normal">Product Name</label>
                    </div>
                    <div class="w-7/12">
                      <input v-model="form.name" type="text" id="nama-produk" required
                        placeholder="Write the product name"
                        class="w-full h-12 rounded-lg px-4 border border-[#376F7E] focus:border-[#376F7E] focus:outline-none focus:ring-0" />
                    </div>
                  </div>
                  <div class="flex items-center mb-7">
                    <div class="w-4/12">
                      <label for="harga-produk" class="text-[#898383] text-lg font-normal">Price</label>
                    </div>
                    <div class="w-7/12">
                      <input v-model.number="form.price" type="number" id="harga-produk" required
                        class="w-full h-12 rounded-lg px-4 border border-[#376F7E] focus:border-[#376F7E] focus:outline-none focus:ring-0" />
                    </div>
                  </div>
                  <div class="flex items-center mb-7">
                    <div class="w-4/12">
                      <label for="category" class="text-[#898383] text-lg font-normal">Product Category</label>
                    </div>
                    <div class="w-7/12">
                      <select v-model="form.category" id="dropdown_add_category"
                        class="w-full h-12 rounded-lg px-4 text-xs border border-[#376F7E] focus:border-[#376F7E] focus:outline-none focus:ring-0">
                        <option v-for="category in categories" :key="category.id" :value="category.id">
                          {{ category.name }}
                        </option>
                      </select>
                    </div>
                  </div>
                  <div class="flex items-center">
                    <div class="w-4/12 my-auto">
                      <label for="product-description" class="text-[#898383] text-lg font-normal">Product
                        Description</label>
                    </div>
                    <div class="w-7/12">
                      <textarea v-model="form.description" id="product-description" rows="5" required
                        placeholder="Product Description"
                        class="w-full rounded-lg px-4 border border-[#376F7E] focus:border-[#376F7E] focus:outline-none focus:ring-0 text-md resize-none"></textarea>
                    </div>
                  </div>
                  <div class="flex w-full mt-auto">
                    <button type="submit"
                      class="bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white font-semibold w-1/5 h-10 rounded-2xl ml-auto mb-4 mr-16">
                      Save
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
  
        <!-- Success Modal -->
        <Modal :show="showSuccessModal" @close="showSuccessModal = false">
          <div class="bg-white w-[25vw] h-auto rounded-[30px] shadow p-4">
            <div class="flex flex-col p-14">
              <h1 class="text-black text-xl font-medium mx-auto">Successfully Added!</h1>
              <img src="/img/assets/icon/icon_green_check.svg" alt="success" class="w-24 h-24 mx-auto mt-6" />
            </div>
          </div>
        </Modal>
      </div>
    </AdminLayout>
  </template>
  
  <script>
  import { ref, onMounted } from 'vue';
  import { Link } from '@inertiajs/vue3';
  import AdminLayout from '../../../Layouts/Admin.vue';
  import Modal from './Modal.vue';
  import axios from 'axios';
  
  export default {
    components: { AdminLayout, Link, Modal },
    setup() {
      // Dummy data
      const categories = ref([
        { id: 1, name: 'Electronics' },
        { id: 2, name: 'Clothing' },
        { id: 3, name: 'Books' },
      ]);
      const images = ref([]);
      const mainImage = ref(null);
      const form = ref({
        name: '',
        price: null,
        category: null,
        description: '',
      });
      const fileInput = ref(null);
      const showSuccessModal = ref(false);
  
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
  
      // Image handling
      const triggerFileInput = () => {
        fileInput.value.click();
      };
  
      const handleFileUpload = (event) => {
        const files = event.target.files;
        Array.from(files).forEach(file => {
          const reader = new FileReader();
          reader.onload = (e) => {
            images.value.push({ path: e.target.result });
            if (!mainImage.value) mainImage.value = e.target.result;
          };
          reader.readAsDataURL(file);
        });
      };
  
      const deleteImage = (index) => {
        images.value.splice(index, 1);
        if (mainImage.value === images.value[index]?.path) {
          mainImage.value = images.value[0]?.path || null;
        }
      };
  
      // Create product
      const createProduct = async () => {
        try {
          const formData = new FormData();
          formData.append('name', form.value.name);
          formData.append('price', form.value.price);
          formData.append('category', form.value.category);
          formData.append('description', form.value.description);
          Array.from(fileInput.value.files).forEach(file => formData.append('images[]', file));
  
          /*
          await axios.post('/api/admin/products', formData, {
            headers: { 'Content-Type': 'multipart/form-data' },
          });
          */
          showSuccessModal.value = true;
          setTimeout(() => (showSuccessModal.value = false), 2000);
        } catch (error) {
          console.error('Error creating product:', error);
        }
      };
  
      onMounted(() => {
        // fetchCategories();
      });
  
      return {
        categories,
        images,
        mainImage,
        form,
        fileInput,
        showSuccessModal,
        triggerFileInput,
        handleFileUpload,
        deleteImage,
        createProduct,
      };
    },
  };
  </script>