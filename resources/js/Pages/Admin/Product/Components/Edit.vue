<template>
    <div id="edit_product" class="h-full flex flex-col">
        <!-- Product Content -->
        <div class="px-2 lg:px-10 pt-2 pb-2 lg:pb-0 rounded-lg h-fit lg:h-[80vh]">
            <div class="w-full h-full flex flex-col lg:flex-row">
                <!-- Image Column -->
                <div class="w-full lg:w-3/12 h-[97%]">
                    <div class="h-full flex flex-col space-y-4">
                        <div class="w-11/12 md:w-1/2 lg:w-full h-[20rem] mx-auto lg:mr-auto bg-white rounded-2xl p-3">
                            <img :src="mainImage" class="w-full h-full object-contain rounded-lg" alt="Main Image" />
                        </div>
                        <div class="flex space-x-2 mx-auto overflow-x-auto" id="product-images">
                            <div v-for="(image, index) in product.images" :key="image.id" class="relative w-14 h-14">
                                <button @click="deleteImage(index)"
                                    class="absolute bg-black bg-opacity-50 w-5 h-5 flex items-center justify-center rounded-full top-0 right-0">
                                    <p class="text-white text-sm">x</p>
                                </button>
                                <img :src="getImageUrl(image.path)" @click="setMainImage(image.path)"
                                    class="w-full h-full object-cover rounded-lg cursor-pointer border border-gray-100" />
                            </div>
                        </div>
                        <button @click="triggerFileInput"
                            class="w-[99%] md:w-1/2 lg:w-[99%] flex items-center justify-center bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] h-10 rounded-2xl mb-5 text-lg font-bold text-white mx-auto">
                            <img src="/img/assets/icon/icon_admin_product_upload.svg" alt="Upload Icon"
                                class="h-6 w-6 mr-3" />
                            Edit Photo
                        </button>
                        <input ref="fileInput" type="file" accept="image/*" multiple class="hidden"
                            @change="handleFileUpload" />
                        <div class="flex-grow"></div>
                        <button @click="$emit('back')"
                            class="hidden lg:flex flex-row bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white font-semibold justify-center items-center w-2/5 h-10 rounded-2xl mb-6 mr-auto">
                            <img src="/img/assets/icon/icon_arrow_back.svg" alt="" class="w-10 h-8" />
                            <p class="my-auto">Back</p>
                        </button>
                    </div>
                </div>

                <!-- Form Column -->
                <div class="w-full lg:w-9/12 h-[95%] lg:pl-[115px] lg:pr-10 lg:justify-end mx-auto">
                    <div class="w-full h-full bg-[#FFFCFC] rounded-2xl lg:ml-5 px-4 pt-3 lg:p-5">
                        <h1 class="text-sm md:text-2xl font-semibold">Edit Product</h1>
                        <form @submit.prevent="updateProduct"
                            class="w-full h-full flex flex-col mt-3 lg:mt-8 pb-2 lg:pb-12">
                            <div class="flex flex-col lg:flex-row items-start lg:items-center mb-2 lg:mb-7">
                                <div class="w-full lg:w-4/12">
                                    <label for="nama-produk"
                                        class="text-[#376F7E] text-xs md:text-lg font-normal">Product Name</label>
                                </div>
                                <div class="w-full lg:w-7/12">
                                    <input v-model="form.name" type="text" id="nama-produk" required
                                        placeholder="Write the product name"
                                        class="w-full h-10 lg:h-12 rounded-lg px-1.5 lg:px-4 border border-[#376F7E] focus:border-[#376F7E] focus:outline-none focus:ring-0 placeholder:text-xs placeholder:lg:text-base" />
                                </div>
                            </div>
                            <div class="flex flex-col lg:flex-row items-start lg:items-center mb-2 lg:mb-7">
                                <div class="w-full lg:w-4/12">
                                    <label for="harga-produk"
                                        class="text-[#376F7E] text-xs md:text-lg font-normal">Price</label>
                                </div>
                                <div class="w-full lg:w-7/12">
                                    <input v-model.number="form.price" type="number" id="harga-produk" required
                                        class="w-full h-10 lg:h-12 rounded-lg px-4 border border-[#376F7E] focus:border-[#376F7E] focus:outline-none focus:ring-0" />
                                </div>
                            </div>
                            <div class="flex flex-col lg:flex-row items-start lg:items-center mb-2 lg:mb-7">
                                <div class="w-full lg:w-4/12">
                                    <label for="category" class="text-[#376F7E] text-xs md:text-lg font-normal">Product
                                        Category</label>
                                </div>
                                <div class="w-full lg:w-7/12">
                                    <select v-model="form.category" id="dropdown_add_category"
                                        class="w-full h-10 lg:h-12 rounded-lg px-4 text-xs border border-[#376F7E] focus:border-[#376F7E] focus:outline-none focus:ring-0">
                                        <option v-for="category in categories" :key="category.id" :value="category.id">
                                            {{ category.name }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="flex flex-col lg:flex-row items-start lg:items-center">
                                <div class="w-full lg:w-4/12 my-auto">
                                    <label for="product-description"
                                        class="text-[#376F7E] text-xs md:text-lg font-normal">Product
                                        Description</label>
                                </div>
                                <div class="w-full lg:w-7/12">
                                    <textarea v-model="form.description" id="product-description" rows="5" required
                                        placeholder="Product Description"
                                        class="w-full h-[91px] lg:h-[192px] rounded-lg px-1.5 lg:px-4 border border-[#376F7E] focus:border-[#376F7E] focus:outline-none focus:ring-0 text-md resize-none placeholder:text-xs placeholder:lg:text-base"></textarea>
                                </div>
                            </div>
                            <div class="flex w-full mt-auto">
                                <button type="submit"
                                    class="bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white font-semibold w-2/5 md:w-1/5 lg:w-1/5 h-8 lg:h-10 rounded-2xl ml-auto lg:mb-4 lg:mr-16">
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
                    <h1 class="text-black text-xl font-medium mx-auto">Successfully Updated!</h1>
                    <img src="/img/assets/icon/icon_green_check.svg" alt="success" class="w-24 h-24 mx-auto mt-6" />
                </div>
            </div>
        </Modal>
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import axios from 'axios';
import { onMounted, ref } from 'vue';
import AdminLayout from '../../../Layouts/Admin.vue';
import Modal from './Modal.vue';

export default {
    emits: ['back'],
    components: { AdminLayout, Link, Modal },
    props: {
        productId: { type: [Number, String], required: true },
    },
    setup(props, ctx) {
        // Dummy data
        const product = ref({
            id: props.productId,
            name: '-',
            price: 0,
            category_id: 1,
            description: '-',
            images: [],
        });
        const categories = ref([]);

        const form = ref({
            name: product.value.name,
            price: product.value.price,
            category: product.value.category_id,
            description: product.value.description,
        });
        const mainImage = ref('https://placehold.co/200');
        const fileInput = ref(null);
        const showSuccessModal = ref(false);
        const deletedImages = ref([]);

        // Fetch categories
        const fetchCategories = async () => {
            try {
                const response = await axios.get('/api/category');
                categories.value = response.data;
            } catch (error) {
                console.error('Error fetching categories:', error);
            }
        };

        // Fetch product data
        const fetchProduct = async () => {
            try {
                const response = await axios.get(`/api/product/${props.productId}`);
                product.value = response.data;
                form.value = {
                    name: product.value.name,
                    price: product.value.price,
                    category: product.value.category_id,
                    description: product.value.description,
                };
                mainImage.value = getImageUrl(product.value.images[0]?.path);
            } catch (error) {
                console.error('Error fetching product:', error);
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
                    product.value.images.push({ path: e.target.result, formData: file });
                    mainImage.value = e.target.result;
                };
                reader.readAsDataURL(file);
            });
        };

        const setMainImage = (path) => {
            mainImage.value = getImageUrl(path);
        };

        const deleteImage = (index) => {
            if (product.value.images[index].id) {
                deletedImages.value.push(product.value.images[index].id);
            }
            product.value.images.splice(index, 1);
            if (!product.value.images.some(img => img.path == mainImage.value)) {
                mainImage.value = getImageUrl(product.value.images[0]?.path);
            }
        };

        // Update product
        const updateProduct = async () => {
            try {
                const formData = new FormData();
                formData.append('name', form.value.name);
                formData.append('price', form.value.price);
                formData.append('category', form.value.category);
                formData.append('description', form.value.description);
                deletedImages.value.forEach(id => formData.append('deleted_images[]', id));
                product.value.images.filter(img => !img.id).forEach((img) => {
                    formData.append('images[]', img.formData);
                });

                await axios.post(`/api/product/${props.productId}`, formData);
                showSuccessModal.value = true;
                setTimeout(() => {
                    showSuccessModal.value = false
                    ctx.emit('back');
                }, 2000);
            } catch (error) {
                console.error('Error updating product:', error);
            }
        };

        const getImageUrl = (image) => {
            if (!image) return "https://placehold.co/200";
            if (/^http|data/.test(image)) return image;
            return `/api/file?path=${image.replace(/\/?storage\//g, "")}`;
        };

        onMounted(() => {
            fetchCategories();
            fetchProduct();
        });

        return {
            product,
            categories,
            form,
            mainImage,
            fileInput,
            showSuccessModal,
            triggerFileInput,
            handleFileUpload,
            setMainImage,
            deleteImage,
            updateProduct,
            getImageUrl,
        };
    },
};
</script>