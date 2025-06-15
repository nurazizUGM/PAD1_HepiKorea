<template>
    <Layout title="FAQ">
        <div
            class="flex flex-col flex-wrap p-4 border-2 bg-[#EFEFEF] border-gray-200 rounded-xl w-full max-w-[99%] h-full">
            <div class="bg-white rounded-xl w-full max-w-full h-full px-4 overflow-hidden">
                <div class="flex rounded-lg items-center w-full md:mb-2 mt-2 md:mx-4 lg:mx-6 md:mt-4 lg:mt-8">
                    <!-- Text FAQ -->
                    <h1 class="text-black font-bold text-sm md:text-2xl lg:text-5xl mb-8 mr-4 md:mr-0 md:w-16 lg:mr-6">
                        FAQ</h1>
                    <!-- Button Add FAQ -->
                    <button @click="openAddModal"
                        class="rounded-full mb-8 md:ml-6 lg:ml-10 bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] p-1 md:p-2">
                        <img src="/img/assets/icon/icon_faq_plus.svg" alt="plus Icon"
                            class="w-4 h-4 md:w-6 md:h-6 lg:h-8 lg:w-8" />
                    </button>
                </div>

                <!-- FAQ List -->
                <div class="h-auto w-full max-w-[100%] overflow-y-auto max-h-[99%]">
                    <div v-for="faq in faqs" :key="faq.id"
                        class="flex flex-col bg-slate-100 h-auto rounded-xl shadow-md p-4 mb-5">
                        <div
                            class="flex flex-col lg:flex-row items-start lg:items-center justify-between md:mb-2 lg:mb-4">
                            <!-- Title FAQ -->
                            <h2
                                class="text-black font-medium md:font-bold text-xs md:text-[15px] lg:text-2xl mb-2 lg:mb-0">
                                {{ faq.question }}
                            </h2>
                            <!-- Buttons Edit/Delete -->
                            <div class="w-fit h-fit flex flex-row">
                                <button @click="openEditModal(faq)"
                                    class="flex items-center justify-center w-auto h-auto md:p-2 rounded-2xl bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-[10] md:text-xs lg:text-xl mr-4 px-3 md:px-5 py-0.5 md:py-1 lg:py-2.5 text-center text-white">
                                    Edit
                                    <img src="/img/assets/icon/icon_faq_edit.svg" alt="Edit Icon"
                                        class="w-3 h-3 lg:h-6 lg:w-6 ml-1 md:ml-2" />
                                </button>
                                <button @click="openDeleteModal(faq.id)"
                                    class="flex items-center justify-center w-auto h-auto md:p-2 rounded-2xl bg-orange-400 hover:bg-orange-500 active:bg-orange-600 text-[10] md:text-xs lg:text-xl mr-4 px-3 md:px-5 py-0.5 md:py-2.5 text-center text-white">
                                    Delete
                                    <img src="/img/assets/icon/icon_admin_faq_trash.svg" alt="Delete Icon"
                                        class="w-4 h-4 lg:h-6 lg:w-6 ml-1 md:ml-2" />
                                </button>
                            </div>
                        </div>
                        <!-- FAQ Content -->
                        <div class="flex flex-wrap max-w-[100%] w-full">
                            <h5
                                class="text-justify text-[#376F7E] font-medium text-[10px] md:text-xs lg:text-2xl break-words w-full">
                                {{ faq.answer }}
                            </h5>
                        </div>
                    </div>
                    <div class="w-full h-36"></div>
                </div>

                <!-- Add FAQ Modal -->
                <Modal :show="showAddModal" @close="showAddModal = false">
                    <div class="bg-white w-[80vw] rounded-lg shadow overflow-y-auto max-w-full">
                        <div class="w-full h-full flex flex-col">
                            <h1 class="text-black font-bold md:text-2xl lg:text-5xl p-5 pb-2">Add FAQ</h1>
                            <button @click="showAddModal = false"
                                class="absolute bg-black w-5 h-5 flex flex-col align-middle text-center items-center rounded-full pb-3 -top-2 -right-2 hover:invert-[20%] active:invert-[25%]">
                                <p class="m-auto text-white text-sm">X</p>
                            </button>
                            <div class="w-full h-full flex flex-col">
                                <form @submit.prevent="addFaq" class="flex flex-col h-full text-center lg:py-2 px-5">
                                    <input v-model="addForm.question" type="text" placeholder="FAQ Title"
                                        class="rounded-2xl w-full bg-white shadow-md h-14 pl-5 pr-4 lg:mt-5 placeholder:text-black placeholder:text-opacity-30 border-0 focus:outline-none focus:ring-0" />
                                    <p v-if="errors.question"
                                        class="mt-1 text-sm text-start text-red-600 dark:text-red-500">
                                        {{ errors.question[0] }}
                                    </p>

                                    <textarea v-model="addForm.answer" placeholder="FAQ Content" rows="12"
                                        class="rounded-2xl w-full h-96 bg-white shadow-md pl-5 pr-4 mt-5 placeholder:text-black placeholder:text-opacity-30 placeholder:font-semi border-0 focus:outline-none focus:ring-0 resize-none"></textarea>
                                    <p v-if="errors.answer"
                                        class="mt-1 text-sm text-start text-red-600 dark:text-red-500">
                                        {{ errors.answer[0] }}
                                    </p>

                                    <button type="submit"
                                        class="bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white font-semibold ml-auto mt-5 mb-3 inline-block w-3/6 md:w-1/6 h-10 lg:-14 rounded-3xl">
                                        Save
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </Modal>

                <!-- Edit FAQ Modal -->
                <Modal :show="showEditModal" @close="showEditModal = false">
                    <div class="bg-white w-[80vw] rounded-lg shadow overflow-y-auto max-w-full">
                        <div class="w-full h-full flex flex-col">
                            <h1 class="text-black font-bold md:text-2xl lg:text-5xl p-5 pb-2">Edit FAQ</h1>
                            <button @click="showEditModal = false"
                                class="absolute bg-black w-5 h-5 flex flex-col align-middle text-center items-center rounded-full pb-3 -top-2 -right-2 hover:invert-[20%] active:invert-[25%]">
                                <p class="m-auto text-white text-sm">X</p>
                            </button>
                            <div class="w-full h-full flex flex-col">
                                <form @submit.prevent="updateFaq" class="flex flex-col h-full text-center lg:y-2 px-5">
                                    <input v-model="editForm.question" type="text" placeholder="FAQ Title"
                                        class="rounded-2xl w-full bg-white shadow-md h-14 pl-5 pr-4 lg:mt-5 placeholder:text-black placeholder:text-opacity-30 border-0 focus:outline-none focus:ring-0" />
                                    <p v-if="errors.question"
                                        class="mt-1 text-sm text-start text-red-600 dark:text-red-500">
                                        {{ errors.question[0] }}
                                    </p>

                                    <textarea v-model="editForm.answer" placeholder="FAQ Content" rows="12"
                                        class="rounded-2xl w-full h-96 bg-white shadow-md pl-5 pr-4 mt-5 placeholder:text-black placeholder:text-opacity-30 placeholder:font-semi border-0 focus:outline-none focus:ring-0 resize-none"></textarea>
                                    <p v-if="errors.answer"
                                        class="mt-1 text-sm text-start text-red-600 dark:text-red-500">
                                        {{ errors.answer[0] }}
                                    </p>

                                    <button type="submit"
                                        class="bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white font-semibold ml-auto mt-5 mb-3 inline-block w-2/6 md:w-1/6 h-10 lg:h-14 rounded-3xl">
                                        Save
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </Modal>

                <!-- Delete Confirmation Modal -->
                <Modal :show="showDeleteModal" @close="showDeleteModal = false">
                    <div class="bg-white w-[225px] md:w-[325px] lg:w-[33vw] h-auto rounded-[30px] shadow p-4">
                        <div class="flex flex-col md:py-2 lg:p-10">
                            <img src="/img/assets/icon/icon_warning.svg" alt="warning" class="w-16 h-16 mx-auto" />
                            <p class="text-[#376F7E] font-medium text-sm lg:text-xl mx-auto mt-2">Are you sure?</p>
                            <p class="text-[#B7B7B7] font-medium text-[10px] lg:text-xs mx-auto mt-2 lg:mt-6">You won’t
                                be able to revert this!
                            </p>
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

                <!-- Success Delete Modal -->
                <Modal :show="showSuccessDeleteModal" @close="showSuccessDeleteModal = false">
                    <div
                        class="bg-white w-[172px] md:w-[400px] lg:w-[25vw] h-auto rounded-[30px] shadow py-7 md:py-14 lg:p-4">
                        <div class="flex flex-col lg:p-14">
                            <h1 class="text-black text-[10px] md:text-xl lg:text-xl font-medium mx-auto">Successfully
                                Deleted!</h1>
                            <img src="/img/assets/icon/icon_green_check.svg" alt="success"
                                class="w-11 h-11 md:h-24 md:w-24 lg:w-24 lg:h-24 mx-auto mt-3 lg:mt-6" />
                        </div>
                    </div>
                </Modal>

                <!-- Success Added Modal -->
                <Modal :show="showSuccessAddedModal" @close="showSuccessAddedModal = false">
                    <div
                        class="bg-white w-[172px] md:w-[400px] lg:w-[25vw] h-auto rounded-[30px] shadow py-7 md:py-14 lg:p-4">
                        <div class="flex flex-col lg:p-14">
                            <h1 class="text-black text-[10px] md:text-xl lg:text-xl font-medium mx-auto">Successfully
                                Added!</h1>
                            <img src="/img/assets/icon/icon_green_check.svg" alt="success"
                                class="w-11 h-11 md:h-24 md:w-24 lg:w-24 lg:h-24 mx-auto mt-3 lg:mt-6" />
                        </div>
                    </div>
                </Modal>

                <!-- Success Updated Modal -->
                <Modal :show="showSuccessUpdatedModal" @close="showSuccessUpdatedModal = false">
                    <div
                        class="bg-white w-[172px] md:w-[400px] lg:w-[25vw] h-auto rounded-[30px] shadow py-7 md:py-14 lg:p-4">
                        <div class="flex flex-col lg:p-14">
                            <h1 class="text-black text-[10px] md:text-xl lg:text-xl font-medium mx-auto">Successfully
                                Updated!</h1>
                            <img src="/img/assets/icon/icon_green_check.svg" alt="success"
                                class="w-11 h-11 md:h-24 md:w-24 lg:w-24 lg:h-24 mx-auto mt-3 lg:mt-6" />
                        </div>
                    </div>
                </Modal>
            </div>
        </div>
    </Layout>
</template>

<script>
import axios from 'axios';
import { onMounted, ref } from 'vue';
import AdminLayout from '../Layouts/Admin.vue';
import Modal from './/Modal.vue';

export default {
    components: { Layout: AdminLayout, Modal },
    setup() {
        // Dummy data
        const faqs = ref([]);

        // Modal states
        const showAddModal = ref(false);
        const showEditModal = ref(false);
        const showDeleteModal = ref(false);
        const showSuccessDeleteModal = ref(false);
        const showSuccessAddedModal = ref(false);
        const showSuccessUpdatedModal = ref(false);

        // Form data
        const addForm = ref({ question: '', answer: '' });
        const editForm = ref({ id: null, question: '', answer: '' });
        const faqToDelete = ref(null);

        // Error handling
        const errors = ref({});

        // Fetch FAQs
        const fetchFaqs = async () => {
            try {
                const response = await axios.get('/api/faq');
                faqs.value = response.data;
            } catch (error) {
                console.error('Error fetching FAQs:', error);
            }
        };

        // Open modals
        const openAddModal = () => {
            addForm.value = { question: '', answer: '' };
            errors.value = {};
            showAddModal.value = true;
        };

        const openEditModal = (faq) => {
            editForm.value = { id: faq.id, question: faq.question, answer: faq.answer };
            errors.value = {};
            showEditModal.value = true;
        };

        const openDeleteModal = (id) => {
            faqToDelete.value = id;
            showDeleteModal.value = true;
        };

        // Add FAQ
        const addFaq = async () => {
            try {
                await axios.post('/api/faq', addForm.value);
                fetchFaqs();
                addForm.value = { question: '', answer: '' };
                showAddModal.value = false;
                showSuccessAddedModal.value = true;
                errors.value = {};
                setTimeout(() => (showSuccessAddedModal.value = false), 2000);
            } catch (error) {
                if (error.response?.status === 422) {
                    errors.value = error.response.data.errors;
                } else {
                    console.error('Error adding FAQ:', error);
                }
            }
        };

        // Update FAQ
        const updateFaq = async () => {
            try {
                await axios.post(`/api/faq/${editForm.value.id}`, {
                    question: editForm.value.question,
                    answer: editForm.value.answer,
                });
                fetchFaqs();
                showEditModal.value = false;
                showSuccessUpdatedModal.value = true;
                errors.value = {};
                setTimeout(() => (showSuccessUpdatedModal.value = false), 2000);
            } catch (error) {
                if (error.response?.status === 422) {
                    errors.value = error.response.data.errors;
                } else {
                    console.error('Error updating FAQ:', error);
                }
            }
        };

        // Delete FAQ
        const confirmDelete = async () => {
            try {

                await axios.delete(`/api/faq/${faqToDelete.value}`);
                // Simulate deleting FAQ
                fetchFaqs();
                showDeleteModal.value = false;
                showSuccessDeleteModal.value = true;
                setTimeout(() => (showSuccessDeleteModal.value = false), 2000);
            } catch (error) {
                console.error('Error deleting FAQ:', error);
            }
        };

        onMounted(() => {
            fetchFaqs();
        });

        return {
            faqs,
            showAddModal,
            showEditModal,
            showDeleteModal,
            showSuccessDeleteModal,
            showSuccessAddedModal,
            showSuccessUpdatedModal,
            addForm,
            editForm,
            faqToDelete,
            errors,
            openAddModal,
            openEditModal,
            openDeleteModal,
            addFaq,
            updateFaq,
            confirmDelete,
        };
    },
};
</script>