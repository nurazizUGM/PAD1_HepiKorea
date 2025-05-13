<template>
    <Layout title="Product">
        <div class="bg-[#EFEFEF] border-gray-200 rounded-lg overflow-y-auto">
            <!-- Tabs -->
            <div class="mb-3">
                <ul class="flex flex-wrap -mb-px text-xs md:text-[13px] lg:text-lg font-bold text-center text-black gap-x-4 md:gap-x-2 lg:gap-x-16"
                    role="tablist">
                    <!-- Product Tab -->
                    <li class="ml-auto" role="presentation">
                        <button @click="setActiveTab('product')" :class="[
                            'inline-block px-4 pt-4 pb-1 border-b-2 rounded-t-lg',
                            activeTab === 'product' || activeTab === 'create' || activeTab === 'edit'
                                ? 'text-black border-orange-400'
                                : 'text-black hover:text-orange-400 border-transparent hover:border-transparent'
                        ]">
                            Product
                        </button>
                    </li>
                    <!-- Category Tab -->
                    <li class="md:mx-40 lg:mx-64" role="presentation">
                        <button @click="setActiveTab('category')" :class="[
                            'inline-block px-4 pt-4 pb-1 border-b-2 rounded-t-lg',
                            activeTab === 'category' ? 'text-black border-orange-400' : 'text-black hover:text-orange-400 border-transparent hover:border-transparent'
                        ]">
                            Category
                        </button>
                    </li>
                    <!-- Carousel Tab -->
                    <li class="mr-auto" role="presentation">
                        <button @click="setActiveTab('carousel')" :class="[
                            'inline-block px-4 pt-4 pb-1 border-b-2 rounded-t-lg',
                            activeTab === 'carousel' ? 'text-black border-orange-400' : 'text-black hover:text-orange-400 border-transparent hover:border-transparent'
                        ]">
                            Carousel
                        </button>
                    </li>
                </ul>
            </div>

            <!-- Tab Content -->
            <div id="default-tab-content">
                <div class="px-3 lg:px-10 pb-2 rounded-lg min-h-[650px] lg:h-[80vh] w-full" role="tabpanel">
                    <List v-if="activeTab === 'product'" @edit-product="editProduct" @create-product="createProduct" />
                    <Create v-else-if="activeTab === 'create'" @back="setActiveTab('product')" />
                    <Edit v-else-if="activeTab === 'edit'" :product-id="selectedProductId"
                        @back="setActiveTab('product')" />
                    <Category v-else-if="activeTab === 'category'" />
                    <Carousel v-else-if="activeTab === 'carousel'" />
                    <div v-else
                        class="flex items-center justify-center w-full h-[98%] rounded-lg bg-white dark:bg-gray-800 dark:border-gray-700">
                        <div role="status">
                            <svg aria-hidden="true"
                                class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
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
            </div>
        </div>
    </Layout>
</template>

<script>
import { defineComponent, ref } from 'vue';
import AdminLayout from '../../Layouts/Admin.vue';
import List from './Components/List.vue';
import Create from './Components/Create.vue';
import Edit from './Components/Edit.vue';
import Category from './Components/Category.vue';
import Carousel from './Components/Carousel.vue';

export default defineComponent({
    components: {
        AdminLayout,
        List,
        Create,
        Edit,
        Category,
        Carousel,
    },
    setup() {
        const activeTab = ref('product'); // Default tab
        const selectedProductId = ref(null); // Track product ID for edit

        // Set active tab
        const setActiveTab = (tab) => {
            activeTab.value = tab;
            if (tab !== 'edit') {
                selectedProductId.value = null; // Reset product ID when not in edit mode
            }
        };

        // Handle edit product event from ProductList
        const editProduct = (productId) => {
            selectedProductId.value = productId;
            activeTab.value = 'edit';
        };

        // Handle create product event from ProductList
        const createProduct = () => {
            activeTab.value = 'create';
        };

        return {
            activeTab,
            selectedProductId,
            setActiveTab,
            editProduct,
            createProduct,
        };
    },
});
</script>