<template>
    <Layout title="Product Confirmed">
        <div class="w-full max-w-full h-full rounded-3xl bg-[#EFEFEF] py-2 px-2 md:px-4 lg:px-[50px] relative">
            <h1 class="text-black font-semibold text-[10px] md:text-sm lg:text-2xl text-left">
                Product Confirmed
            </h1>

            <div
                class="overflow-y-scroll no-scrollbar h-[60vh] md:h-[53vh] lg:h-[50vh] mt-1 md:mt-2 mb-12 md:mb-44 lg:mb-52">
                <!-- Product Card Container -->
                <div
                    class="w-full h-fit grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 md:gap-x-5 gap-y-2 md:gap-y-5 mt-1 md:mt-2 mb-12 relative">
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
                            <div class="w-[20%] md:w-[35%] h-full">
                                <img :src="getImageUrl(item.image)" alt=""
                                    class="w-14 md:w-full md:h-full object-contain" />
                            </div>
                            <!-- Name, Variant, Price -->
                            <div class="w-[60%] md:w-[65%] h-full flex flex-col pl-5">
                                <h1 class="text-[#3E6E7A] font-semibold text-[11px] md:text-base">
                                    {{ item.name }}
                                </h1>
                                <h2 class="text-black text-opacity-50 font-semibold text-[10px] md:text-xs mt-1">
                                    {{ item.variant }}
                                </h2>
                                <h2 class="text-orange-400 font-semibold text-xs md:text-xl lg:text-xl mt-auto">
                                    Rp
                                    {{
                                        formatPrice(
                                            item.total_price ||
                                            item.estimated_price
                                        )
                                    }}
                                </h2>
                                <!-- checkbox (cuma pas mobile munculnya) -->
                                <div class="w-fit h-fit md:hidden flex flex-row items-center absolute top-1/2 right-2">
                                    <input type="checkbox" v-model="item.selected"
                                        class="w-3 h-3 rounded-sm outline outline-[#3E6E7A] bg-transparent hover:bg-slate-100 checked:bg-[#3E6E7A] hover:checked:bg-[#37626d] focus:outline-[#3E6E7A] active:ring-[#3E6E7A] focus:border-[#3E6E7A]" />
                                    <p class="text-[#3E6E7A] text-[8px] font-semibold ml-2">
                                        Add Product
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Checkbox -->
                        <div class="w-full h-[45%] hidden md:flex">
                            <div class="w-fit h-fit flex flex-row items-center my-auto ml-7">
                                <input type="checkbox" v-model="item.selected"
                                    class="w-6 h-6 rounded-sm outline outline-[#3E6E7A] bg-transparent hover:bg-slate-100 checked:bg-[#3E6E7A] hover:checked:bg-[#37626d] focus:outline-[#3E6E7A] active:ring-[#3E6E7A] focus:border-[#3E6E7A]" />
                                <p class="text-[#3E6E7A] md:text-sm lg:text-base font-semibold ml-6">
                                    Add Product
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Checkout Container -->
                <div
                    class="absolute w-[95%] md:w-[87vw] lg:w-[84.5vw] h-[75px] md:h-[20vh] lg:h-[25vh] bg-white rounded-2xl bottom-4 md:bottom-5 lg:bottom-5 z-10 flex flex-col md:py-5 md:px-10 py-2 px-2">
                    <h1 class="text-black font-semibold text-[8px] md:text-sm lg:text-2xl">
                        Checkout
                    </h1>
                    <div class="w-full h-fit flex flex-row my-auto relative">
                        <!-- Select All and Checkbox Container -->
                        <div class="w-fit h-full flex flex-row">
                            <input type="checkbox" v-model="selectAll" @change="toggleSelectAll"
                                class="w-3 h-3 md:w-6 md:h-6 hover:bg-slate-100 rounded-sm outline outline-[#3E6E7A] bg-transparent checked:bg-[#3E6E7A] hover:checked:bg-[#37626d] focus:outline-[#3E6E7A] active:ring-[#3E6E7A] focus:border-[#3E6E7A] my-auto" />
                            <p
                                class="text-black text-opacity-50 font-semibold text-[8px] md:text-xs lg:text-base ml-2 md:ml-6 my-auto">
                                Select All ({{ selectedCount }})
                            </p>

                            <!-- jumlah item yang dipilih tapi cuma muncul di mobile -->
                            <p
                                class="text-black text-opacity-50 font-semibold text-[8px] md:hidden flex absolute top-4 left-5">
                                Total ({{ items.length }}) Product
                            </p>
                            <button @click="showDeleteModal = true"
                                class="bg-white hover:bg-slate-100 outline outline-2 outline-[#3E6E7A] rounded-md md:rounded-2xl inline-flex my-auto ml-10 px-2 py-0.5 md:py-1.5 lg:py-2 md:px-8 lg:px-12">
                                <img src="/img/assets/icon/icon_customer_trashcan.svg" alt=""
                                    class="w-[7px] h-[8px] md:w-[14px] md:h-[16px] lg:w-6 lg:h-7 mr-0.5 md:mr-2 my-auto" />
                                <p class="text-[#3E6E7A] font-semibold text-[8px] md:text-xs lg:text-xl">
                                    Delete
                                </p>
                            </button>
                        </div>
                        <!-- Text Count Total Product -->
                        <p
                            class="text-black text-opacity-50 font-semibold text-[8px] md:text-xs lg:text-base mx-auto lg:ml-auto lg:mr-2 my-auto hidden md:flex">
                            Total ({{ items.length }}) Product
                        </p>
                        <!-- Total Price -->
                        <h1
                            class="text-orange-400 font-semibold text-[10px] md:text-sm lg:text-2xl ml-12 md:ml-16 my-auto">
                            Rp {{ formatPrice(totalPrice) }}
                        </h1>
                    </div>
                    <button
                        class="w-fit bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white text-[8px] md:text-xs lg:text-2xl font-semibold rounded-md md:rounded-2xl py-0.5 md:py-2 md:px-7 lg:px-10 ml-auto">
                        Checkout
                    </button>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div v-if="showDeleteModal" class="fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-50">
            <div class="bg-white w-[65vw] md:w-[50vw] lg:w-[33vw] h-auto rounded-[30px] shadow p-1 md:p-4">
                <div class="flex flex-col md:px-10 md:py-10 p-5">
                    <img src="/img/assets/icon/icon_warning.svg" alt="icon_warning"
                        class="w-10 md:w-16 h-10 md:h-16 mx-auto" />
                    <p class="text-[#376F7E] font-medium text-[10px] md:text-xl mx-auto mt-2">
                        Are you sure?
                    </p>
                    <p class="text-[#B7B7B7] font-medium text-[8px] md:text-xs mx-auto mt-1 md:mt-6">
                        You won’t be able to revert this!
                    </p>
                    <div class="w-full h-full mt-3 md:mt-6 flex flex-row justify-center">
                        <button @click="confirmDelete"
                            class="w-44 h-8 md:h-11 bg-[#376F7E] rounded-[20px] shadow-lg text-white text-[8px] md:text-lg font-semibold">
                            Yes, Delete it!
                        </button>
                        <button @click="showDeleteModal = false"
                            class="w-44 h-8 md:h-11 bg-[#FF9D66] rounded-[20px] shadow-lg text-white text-[8px] md:text-lg font-semibold ml-2">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Delete Modal -->
        <div v-if="showSuccessModal" class="fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-50">
            <div
                class="bg-white w-[65vw] md:w-[40vw] lg:w-[25vw] h-auto rounded-[30px] shadow px-3 py-7 md:p-14 flex flex-col">
                <h1 class="text-black text-[10px] md:text-xl font-medium mx-auto">
                    Successfully Deleted!
                </h1>
                <img src="/img/assets/icon/icon_green_check.svg" alt="green_check"
                    class="w-11 h-11 md:w-24 md:h-24 mx-auto mt-4 md:mt-6" />
            </div>
        </div>
    </Layout>
</template>

<script>
import { computed, onMounted, ref } from "vue";
import Layout from "../../Layouts/Customer.vue";

export default {
    components: {
        Layout,
    },
    setup() {
        const items = ref([]);

        const showDeleteModal = ref(false);
        const showSuccessModal = ref(false);
        const selectAll = ref(false);

        const orderId = ref("");
        const params = new URLSearchParams(window.location.search);

        // Fungsi untuk mengambil data dari API (placeholder)
        const fetchData = async () => {
            try {
                const response = await fetch("/api/request-order?" + params.toString());
                items.value = await response.json();
            } catch (error) {
                console.error("Error fetching data:", error);
            }
        };

        // Handler untuk gambar
        const getImageUrl = (image) => {
            return image
                ? `/storage/${image}`
                : "/img/assets/icon/icon_admin_order_product.svg";
        };

        // Format harga
        const formatPrice = (price) => {
            return (
                price?.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + ",-"
            );
        };

        // Hitung total harga
        const totalPrice = computed(() => {
            return items.value
                .filter((item) => item.selected)
                .reduce((sum, item) => sum + item.price, 0);
        });

        // Hitung jumlah item yang dipilih
        const selectedCount = computed(() => {
            return items.value.filter((item) => item.selected).length;
        });

        // Toggle select all
        const toggleSelectAll = () => {
            items.value.forEach((item) => {
                if (item.is_available && item.order.status == "confirmed") {
                    // Hanya ubah status selected jika is_available true
                    item.selected = selectAll.value;
                }
            });
        };

        // Konfirmasi penghapusan
        const confirmDelete = () => {
            items.value = items.value.filter((item) => !item.selected);
            showDeleteModal.value = false;
            showSuccessModal.value = true;
            setTimeout(() => (showSuccessModal.value = false), 2000); // Tutup otomatis setelah 2 detik
        };

        // Inisialisasi data (gunakan fetchData saat API siap)
        onMounted(() => {
            fetchData();
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
