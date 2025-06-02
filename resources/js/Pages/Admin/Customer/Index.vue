<template>
    <Layout title="Customer">
        <div class="bg-[#EFEFEF] border-gray-200 rounded-[20px] lg:rounded-lg">
            <!-- Tabs -->
            <div class="mb-3">
                <ul class="flex flex-wrap -mb-px text-xs lg:text-lg font-bold text-center text-black gap-x-2 md:gap-x-36 lg:gap-x-16"
                    role="tablist">
                    <!-- Customer Tab -->
                    <li class="mr-auto ml-auto" role="presentation">
                        <button @click="setActiveTab('customer')" :class="[
                            'inline-block px-4 pt-4 pb-1 border-b-2 rounded-t-lg',
                            activeTab === 'customer'
                                ? 'text-black border-orange-400'
                                : 'text-black hover:text-orange-400 border-transparent hover:border-transparent'
                        ]">
                            Customer
                        </button>
                    </li>
                    <!-- Review Tab -->
                    <li class="mr-auto ml-auto" role="presentation">
                        <button @click="setActiveTab('review')" :class="[
                            'inline-block px-4 pt-4 pb-1 border-b-2 rounded-t-lg',
                            activeTab === 'review'
                                ? 'text-black border-orange-400'
                                : 'text-black hover:text-orange-400 border-transparent hover:border-transparent'
                        ]">
                            Review
                        </button>
                    </li>
                </ul>
            </div>

            <!-- Tab Content -->
            <div id="default-tab-content">
                <!-- Customer Content -->
                <List v-if="activeTab === 'customer'" />
                <!-- Review Content -->
                <Review v-if="activeTab === 'review'" />
            </div>
        </div>
    </Layout>
</template>

<script>
import { ref } from 'vue';
import AdminLayout from '../../Layouts/Admin.vue';
import List from './List.vue';
import Review from './Review.vue';

export default {
    components: { Layout: AdminLayout, List, Review },
    setup() {
        // Tab management
        const activeTab = ref('customer');
        const setActiveTab = (tab) => {
            activeTab.value = tab;
        };

        return {
            activeTab,
            setActiveTab,
        };
    },
};
</script>