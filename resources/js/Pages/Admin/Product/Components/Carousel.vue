<template>
    <div class="h-full flex flex-col">
        <div class="w-full flex items-center">
            <h2 class="text-black text-md ml-3 font-semibold">Add Carousel</h2>
            <button @click="showAddModal = true" class="ml-5">
                <img src="/img/assets/icon/icon_admin_product_plus.svg" alt="plus icon"
                    class="w-10 h-10 hover:invert-[20%] active:invert-[25%]" />
            </button>
        </div>

        <!-- Carousel Cards -->
        <div
            class="w-full h-[85%] mt-5 overflow-y-scroll grid grid-cols-2 md:grid-cols-3 gap-y-4 gap-x-1 lg:grid-cols-4 lg:gap-x-12 lg:gap-y-8 justify-start items-start content-start no-scrollbar">
            <div v-for="carousel in carousels" :key="carousel.id"
                class="bg-white w-auto h-[190px] md:w-[165px] md:h-[205px] lg:w-60 lg:h-72 rounded-lg overflow-hidden flex flex-col hover:scale-[102%]">
                <div class="w-full h-2/3 bg-cover">
                    <img v-if="carousel.media_type === 'image'" :src="getImageUrl(carousel.media)"
                        class="w-full h-full object-cover" />
                    <video v-else-if="carousel.media_type === 'video'" :src="getImageUrl(carousel.media)"
                        class="w-full h-full object-cover" controls muted />
                    <iframe v-else-if="carousel.media_type === 'youtube'"
                        :src="carousel.media + (carousel.media.includes('?') ? '&' : '?') + 'autoplay=0'"
                        class="w-full h-full object-cover" frameborder="0"
                        allow="accelerometer; clipboard-write; encrypted-media; gyroscope; web-share"
                        referrerpolicy="strict-origin-when-cross-origin"></iframe>
                </div>
                <div class="p-2">
                    <p class="text-sm text-black text-center font-bold truncate">{{ carousel.title }}</p>
                </div>
                <div class="flex mt-auto mx-4 mb-4">
                    <button @click="openEditModal(carousel)"
                        class="mr-auto hover:opacity-70 active:opacity-60 transition-opacity">
                        <img src="/img/assets/icon/icon_admin_category_edit.svg" alt="edit"
                            class="w-5 h-5 lg:w-7 lg:h-7" />
                    </button>
                    <button @click="openDeleteModal(carousel.id)"
                        class="ml-auto hover:opacity-70 active:opacity-60 transition-opacity">
                        <img src="/img/assets/icon/icon_admin_category_trash.svg" alt="delete"
                            class="w-4 h-5 lg:w-7 lg:h-7" />
                    </button>
                </div>
            </div>
        </div>

        <!-- Add Carousel Modal -->
        <Modal :show="showAddModal" @close="showAddModal = false">
            <div
                class="bg-white w-[258px] md:w-[480px] lg:w-[30vw] h-auto rounded-[15px] md:rounded-xl lg:rounded-2xl shadow p-2 md:p-4">
                <button @click="showAddModal = false"
                    class="absolute bg-black w-5 h-5 flex items-center justify-center rounded-full pb-3 -top-2 -right-2 hover:invert-[20%] active:invert-[25%]">
                    <p class="m-auto text-white text-sm">X</p>
                </button>
                <form @submit.prevent="addCarousel"
                    class="flex flex-col h-full text-center md:px-2 md:py-2 lg:py-3 lg:px-3">
                    <div class="relative w-full h-56 bg-gray-200 rounded-2xl" v-if="addForm.media_type != 'youtube'">
                        <input ref="addMediaInput" type="file"
                            :accept="addForm.media_type === 'image' ? 'image/*' : 'video/*'" class="hidden"
                            @change="handleAddMedia" />
                        <img v-if="previewMedia && addForm.media_type === 'image'" :src="previewMedia"
                            class="w-full h-full object-contain" />
                        <video v-else-if="previewMedia && addForm.media_type === 'video'" :src="previewMedia"
                            class="w-full h-full object-contain" controls />
                        <label v-else @click="triggerAddMediaInput"
                            class="absolute inset-0 flex justify-center items-center cursor-pointer">
                            <div class="text-gray-500">Upload file</div>
                        </label>
                        <label @click="triggerAddMediaInput"
                            class="absolute bottom-3 right-3 bg-white p-2 rounded-lg cursor-pointer">
                            <img src="/img/assets/icon/icon_admin_category_upload.svg" alt="Upload Icon"
                                class="h-6 w-6" />
                        </label>
                    </div>
                    <input v-model="addForm.title" type="text" placeholder="Title"
                        class="rounded-2xl w-full bg-gray-200 h-12 pl-5 pr-4 mt-3 md:mt-5 placeholder:text-black placeholder:font-semibold border-0 focus:outline-none focus:ring-0" />
                    <select v-model="addForm.media_type"
                        class="rounded-2xl w-full bg-gray-200 h-12 pl-5 pr-4 mt-3 md:mt-5 placeholder:text-black placeholder:font-semibold border-0 focus:outline-none focus:ring-0"
                        @change="handleMediaTypeChange">
                        <option value="image">Type: Image</option>
                        <option value="video">Type: Video</option>
                        <option value="youtube">Type: Youtube</option>
                    </select>
                    <input v-if="addForm.media_type === 'youtube'" v-model="addForm.youtube_url" type="text"
                        placeholder="Link Youtube"
                        class="rounded-2xl w-full bg-gray-200 h-12 pl-5 pr-4 mt-5 placeholder:text-black border-0 focus:outline-none focus:ring-0" />
                    <textarea v-model="addForm.description" placeholder="Add description" rows="3"
                        class="rounded-2xl w-full bg-gray-200 pl-5 pr-4 mt-3 md:mt-5 placeholder:text-black placeholder:font-semi border-0 focus:outline-none focus:ring-0"></textarea>
                    <button type="submit"
                        class="bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white font-semibold mt-5 mx-auto inline-block w-full h-8 rounded-3xl">
                        Add
                    </button>
                </form>
            </div>
        </Modal>

        <!-- Edit Carousel Modal -->
        <Modal :show="showEditModal" @close="showEditModal = false">
            <div class="bg-white w-[30vw] h-[75vh] rounded-lg shadow p-4">
                <button @click="showEditModal = false"
                    class="absolute bg-black w-5 h-5 flex items-center justify-center rounded-full pb-3 -top-2 -right-2 hover:invert-[20%] active:invert-[25%]">
                    <p class="m-auto text-white text-sm">X</p>
                </button>
                <form @submit.prevent="updateCarousel" class="flex flex-col h-full text-center py-10 px-5">
                    <input v-model="editForm.title" type="text" placeholder="Name"
                        class="rounded-2xl w-full bg-gray-200 h-14 pl-5 pr-4 mt-5 placeholder:text-black placeholder:font-semibold border-0 focus:outline-none focus:ring-0" />
                    <textarea v-model="editForm.description" placeholder="Add info" rows="3"
                        class="rounded-2xl w-full bg-gray-200 pl-5 pr-4 mt-5 placeholder:text-black placeholder:font-semi border-0 focus:outline-none focus:ring-0"></textarea>
                    <button type="submit"
                        class="bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white font-semibold mt-auto mx-auto inline-block w-full h-8 rounded-3xl">
                        Save
                    </button>
                </form>
            </div>
        </Modal>

        <!-- Delete Confirmation Modal -->
        <Modal :show="showDeleteModal" @close="showDeleteModal = false">
            <div class="bg-white w-[225px] md:w-[325px] lg:w-[33vw] h-auto rounded-[30px] shadow p-4">
                <div class="flex flex-col md:py-2 lg:p-10">
                    <img src="/img/assets/icon/icon_warning.svg" alt="warning"
                        class="w-10 h-10 md:w-[51px] md:h-[51px] lg:w-16 lg:h-16 mx-auto" />
                    <p class="text-[#376F7E] font-medium text-sm lg:text-xl mx-auto mt-2">Are you sure?</p>
                    <p class="text-[#B7B7B7] font-medium text-[10px] lg:text-xs mx-auto mt-2 lg:mt-6">You won’t be
                        able
                        to revert
                        this!</p>
                    <div class="w-full mt-3 lg:mt-6 flex flex-row justify-center">
                        <button @click="confirmDelete"
                            class="w-[86px] md:w-[132px] lg:w-44 h-[22px] md:h-[41px] lg:h-11 bg-[#376F7E] rounded-[20px] shadow-lg text-white text-[10px] md:text-sm lg:text-lg font-semibold hover:opacity-90 active:opacity-80">
                            Yes, Delete it!
                        </button>
                        <button @click="showDeleteModal = false"
                            class="w-[86px] md:w-[132px] lg:w-44 h-[22px] md:h-[41px] lg:h-11 bg-[#FF9D66] rounded-[20px] shadow-lg text-white text-[10px] md:text-sm lg:text-lg font-semibold ml-2 hover:opacity-90 active:opacity-80">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </Modal>

        <!-- Success Modal -->
        <Modal :show="showSuccessModal" @close="showSuccessModal = false">
            <div class="bg-white w-[172px] md:w-[400px] lg:w-[25vw] h-auto rounded-[30px] shadow py-7 md:py-14 lg:p-4">
                <div class="flex flex-col lg:p-14">
                    <h1 class="text-black text-[10px] md:text-xl lg:text-xl font-medium mx-auto">Successfully {{
                        successMessage }}!</h1>
                    <img src="/img/assets/icon/icon_green_check.svg" alt="success"
                        class="w-11 h-11 md:h-24 md:w-24 lg:w-24 lg:h-24 mx-auto mt-3 lg:mt-6" />
                </div>
            </div>
        </Modal>
    </div>
</template>

<script>
import axios from 'axios';
import { onMounted, ref } from 'vue';
import Modal from './Modal.vue';

export default {
    components: { Modal },
    setup() {
        // Dummy data
        const carousels = ref([]);

        const showAddModal = ref(false);
        const showEditModal = ref(false);
        const showDeleteModal = ref(false);
        const showSuccessModal = ref(false);
        const successMessage = ref('');
        const addForm = ref({ title: '', media_type: 'image', youtube_url: '', description: '' });
        const editForm = ref({ id: null, title: '', description: '' });
        const previewMedia = ref(null);
        const addMediaInput = ref(null);
        const carouselToDelete = ref(null);

        // Fetch carousels
        const fetchCarousels = async () => {
            try {
                const response = await axios.get('/api/carousel');
                carousels.value = response.data;
            } catch (error) {
                console.error('Error fetching carousels:', error);
            }
        };

        // Add carousel
        const addCarousel = async () => {
            try {
                const formData = new FormData();
                formData.append('title', addForm.value.title);
                formData.append('media_type', addForm.value.media_type);
                formData.append('description', addForm.value.description);
                if (addForm.value.media_type === 'youtube') {
                    formData.append('youtube_url', addForm.value.youtube_url);
                } else if (addMediaInput.value.files[0]) {
                    formData.append('media', addMediaInput.value.files[0]);
                }

                await axios.post('/api/carousel', formData);
                showAddModal.value = false;
                successMessage.value = 'Added';
                showSuccessModal.value = true;
                fetchCarousels();
                setTimeout(() => (showSuccessModal.value = false), 2000);
                addForm.value = { title: '', media_type: 'image', youtube_url: '', description: '' };
                previewMedia.value = null;
            } catch (error) {
                console.error('Error adding carousel:', error);
            }
        };

        // Edit carousel
        const openEditModal = (carousel) => {
            editForm.value = { id: carousel.id, title: carousel.title, description: carousel.description };
            showEditModal.value = true;
        };

        const updateCarousel = async () => {
            try {
                const formData = new FormData();
                formData.append('title', editForm.value.title);
                formData.append('description', editForm.value.description);

                await axios.post(`/api/carousel/${editForm.value.id}`, formData);
                showEditModal.value = false;
                successMessage.value = 'Updated';
                showSuccessModal.value = true;
                fetchCarousels();
                setTimeout(() => (showSuccessModal.value = false), 2000);
            } catch (error) {
                console.error('Error updating carousel:', error);
            }
        };

        // Delete carousel
        const openDeleteModal = (id) => {
            carouselToDelete.value = id;
            showDeleteModal.value = true;
        };

        const confirmDelete = async () => {
            try {
                await axios.delete(`/api/carousel/${carouselToDelete.value}`);
                fetchCarousels();

                showDeleteModal.value = false;
                successMessage.value = 'Deleted';
                showSuccessModal.value = true;
                setTimeout(() => (showSuccessModal.value = false), 2000);
            } catch (error) {
                console.error('Error deleting carousel:', error);
            }
        };

        // Media handling
        const triggerAddMediaInput = () => {
            addMediaInput.value.click();
        };

        const handleAddMedia = (event) => {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    previewMedia.value = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        };

        const handleMediaTypeChange = () => {
            previewMedia.value = null;
            addMediaInput.value.value = '';
        };

        const getImageUrl = (image) => {
            if (!image) return "https://placehold.co/200";
            if (/^http/.test(image)) return image;
            return `/api/file?path=${image.replace(/\/?storage\//g, "")}`;
        };

        onMounted(() => {
            fetchCarousels();
        });

        return {
            carousels,
            showAddModal,
            showEditModal,
            showDeleteModal,
            showSuccessModal,
            successMessage,
            addForm,
            editForm,
            previewMedia,
            addMediaInput,
            carouselToDelete,
            fetchCarousels,
            addCarousel,
            openEditModal,
            updateCarousel,
            openDeleteModal,
            confirmDelete,
            triggerAddMediaInput,
            handleAddMedia,
            handleMediaTypeChange,
            getImageUrl,
        };
    },
};
</script>