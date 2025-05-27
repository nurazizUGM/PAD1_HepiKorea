<template>
    <div class="px-2 pb-2 md:px-4 lg:px-10 rounded-lg lg:min-h-[80vh]" role="tabpanel" aria-labelledby="review-tab">
        <div class="w-full flex items-center">
            <!-- Search Bar -->
            <div class="flex items-center mr-auto md:ml-5 lg:ml-0">
                <div class="relative flex items-center w-full">
                    <img src="/img/assets/icon/icon_admin_search_searchbar.svg" alt="search icon"
                        class="absolute left-3 w-5 h-5 text-gray-500" />
                    <form @submit.prevent="filterReviews">
                        <input v-model="searchQuery" type="text"
                            class="block w-12/12 lg:w-[25vw] pl-10 py-2 text-gray-900 bg-white border border-white rounded-full focus:ring-0 focus:border-none placeholder:text-sm placeholder:text-start"
                            placeholder="Search..." />
                    </form>
                </div>
            </div>
        </div>
        <!-- Review Cards -->
        <div
            class="w-full lg:min-h-[49vh] mt-5 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-x-2 gap-y-3 lg:gap-8 justify-start items-start content-start">
            <div v-for="review in filteredReviews" :key="review.id"
                class="bg-white w-full h-[190px] md:w-[150px] md:h-[194px] lg:w-40 lg:h-52 rounded-lg overflow-hidden flex flex-col cursor-pointer mx-auto"
                @click="openReviewModal(review)">
                <div class="w-full h-2/3 bg-cover bg-top">
                    <img :src="review.photo || review.product.images[0].path" alt="Review Image"
                        class="w-full h-full object-cover" />
                </div>
                <div class="p-2">
                    <p class="text-sm text-[#376F7E] font-bold truncate">{{ review.product.name }}</p>
                    <p class="text-sm font-semibold">{{ review.rating }}</p>
                </div>
            </div>
        </div>

        <!-- Review Modal -->
        <Modal :show="showReviewModal" @close="closeReviewModal">
            <div class="bg-white w-[249px] h-[80vh] md:w-[664px] md:h-[260px] lg:w-[50vw] lg:h-[50vh] rounded-lg shadow relative p-2 lg:p-6">
                <!-- Close Button -->
                <button @click="closeReviewModal"
                    class="absolute bg-black w-5 h-5 flex flex-col align-middle text-center items-center rounded-full pb-3 -top-2 -right-2">
                    <p class="m-auto text-white text-sm">X</p>
                </button>
                <!-- masi error di tablet -->
                <div class="flex flex-col sm:flex-row h-full" :class="modalGridClass">
                    <!-- Review Image -->
                    <div v-if="selectedReview?.photo" class="w-full lg:w-2/5 h-fit md:h-full bg-cover bg-no-repeat bg-top rounded-lg">
                        <img :src="selectedReview.photo" alt="Review Image"
                            class="w-full h-full object-contain object-top" />
                    </div>
                    <!-- Review Content -->
                    <div :class="modalContentClass">
                        <div class="flex flex-col h-full text-center py-1 lg:py-4 px-1 lg:px-5">
                            <div class="flex items-center mt-5">
                                <img src="/img/assets/icon/icon_review_star.svg" alt="Star Icon"
                                    class="w-8 h-8 lg:h-16 lg:w-16 mr-2" />
                                <span class="text-black text-base lg:text-2xl font-bold">{{ selectedReview?.rating || '0' }}</span>
                            </div>
                            <textarea :value="selectedReview?.content" disabled
                                class="w-52 md:w-full h-full lg:h-56 bg-gray-50 border-2 border-black text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block lg:w-full mt-2 lg:mt-8 p-1 lg:p-2.5 resize-none"
                                placeholder="Product Review"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </Modal>
    </div>
</template>

<script>
import { ref, computed, onMounted } from 'vue';
import Modal from '../Modal.vue';
import axios from 'axios';

export default {
    components: { Modal },
    setup() {
        // Dummy data for reviews
        const reviews = ref([
            {
                id: 1,
                product: { name: 'Product A', images: [{ path: '/img/product1.jpg' }] },
                rating: 4.5,
                photo: null,
                content: 'Great product, highly recommend!',
            },
            {
                id: 2,
                product: { name: 'Product B', images: [{ path: '/img/product2.jpg' }] },
                rating: 4.0,
                photo: '/img/example/test_blouse.png',
                content: 'Good quality, but delivery was slow.',
            },
            {
                id: 6,
                product: { name: 'Product c', images: [{ path: '/img/product2.jpg' }] },
                rating: 4.0,
                photo: '/img/example/test_shirt.jpg',
                content: 'Good quality mantap cihuy adnjanjdwbndaibwdn, but delivery was slow.',
            },
            {
                id: 3,
                product: { name: 'Product d', images: [{ path: '/img/product2.jpg' }] },
                rating: 4.0,
                photo: '/img/example/test_shirt.jpg',
                content: 'Good quality mantap cihuy adnjanjdwbndaibwdn, but delivery was slow.',
            },
            {
                id: 4,
                product: { name: 'Product E', images: [{ path: '/img/product2.jpg' }] },
                rating: 4.0,
                photo: '/img/example/test_shirt.jpg',
                content: 'Good quality mantap cihuy adnjanjdwbndaibwdn, but delivery was slow.',
            },
            {
                id: 5,
                product: { name: 'Product E', images: [{ path: '/img/product2.jpg' }] },
                rating: 4.0,
                photo: '/img/example/test_shirt.jpg',
                content: 'Good quality mantap cihuy adnjanjdwbndaibwdn, but delivery was slow.',
            },
            {
                id: 7,
                product: { name: 'Product D', images: [{ path: '/img/product2.jpg' }] },
                rating: 4.0,
                photo: '/img/example/test_shirt.jpg',
                content: 'Good quality mantap cihuy adnjanjdwbndaibwdn, but delivery was slow.',
            },
            {
                id: 7,
                product: { name: 'Product D', images: [{ path: '/img/product2.jpg' }] },
                rating: 4.0,
                photo: '/img/example/test_shirt.jpg',
                content: 'Good quality mantap cihuy adnjanjdwbndaibwdn, but delivery was slow.',
            },
            {
                id: 7,
                product: { name: 'Product D', images: [{ path: '/img/product2.jpg' }] },
                rating: 4.0,
                photo: '/img/example/test_shirt.jpg',
                content: 'Good quality mantap cihuy adnjanjdwbndaibwdn, but delivery was slow.',
            },
            {
                id: 7,
                product: { name: 'Product D', images: [{ path: '/img/product2.jpg' }] },
                rating: 4.0,
                photo: '/img/example/test_shirt.jpg',
                content: 'Good quality mantap cihuy adnjanjdwbndaibwdn, but delivery was slow.',
            },
            {
                id: 7,
                product: { name: 'Product D', images: [{ path: '/img/product2.jpg' }] },
                rating: 4.0,
                photo: '/img/example/test_shirt.jpg',
                content: 'Good quality mantap cihuy adnjanjdwbndaibwdn, but delivery was slow.',
            },
            {
                id: 7,
                product: { name: 'Product D', images: [{ path: '/img/product2.jpg' }] },
                rating: 4.0,
                photo: '/img/example/test_shirt.jpg',
                content: 'Good quality mantap cihuy adnjanjdwbndaibwdn, but delivery was slow.',
            },
            {
                id: 7,
                product: { name: 'Product D', images: [{ path: '/img/product2.jpg' }] },
                rating: 4.0,
                photo: '/img/example/test_shirt.jpg',
                content: 'Good quality mantap cihuy adnjanjdwbndaibwdn, but delivery was slow.',
            },
            {
                id: 7,
                product: { name: 'Product D', images: [{ path: '/img/product2.jpg' }] },
                rating: 4.0,
                photo: '/img/example/test_shirt.jpg',
                content: 'Good quality mantap cihuy adnjanjdwbndaibwdn, but delivery was slow.',
            },
            {
                id: 7,
                product: { name: 'Product D', images: [{ path: '/img/product2.jpg' }] },
                rating: 4.0,
                photo: '/img/example/test_tshirt3.jpg',
                content: 'Good quality mantap cihuy adnjanjdwbndaibwdn, but delivery was slow.',
            },
            {
                id: 7,
                product: { name: 'Product D', images: [{ path: '/img/product2.jpg' }] },
                rating: 4.0,
                photo: '/img/example/test_tshirt4.jpg',
                content: 'Good quality mantap cihuy adnjanjdwbndaibwdn, but delivery was slow.',
            },
            {
                id: 7,
                product: { name: 'Product D', images: [{ path: '/img/product2.jpg' }] },
                rating: 4.0,
                photo: '/img/example/test_shirt.jpg',
                content: 'Good quality mantap cihuy adnjanjdwbndaibwdn, but delivery was slow.',
            },
            {
                id: 7,
                product: { name: 'Product D', images: [{ path: '/img/product2.jpg' }] },
                rating: 4.0,
                photo: '/img/example/test_shirt.jpg',
                content: 'Good quality mantap cihuy adnjanjdwbndaibwdn, but delivery was slow.',
            },
            {
                id: 7,
                product: { name: 'Product D', images: [{ path: '/img/product2.jpg' }] },
                rating: 4.0,
                photo: '/img/example/test_shirt.jpg',
                content: 'Good quality mantap cihuy adnjanjdwbndaibwdn, but delivery was slow.',
            },
            {
                id: 7,
                product: { name: 'Product D', images: [{ path: '/img/product2.jpg' }] },
                rating: 4.0,
                photo: '/img/example/test_shirt.jpg',
                content: 'Good quality mantap cihuy adnjanjdwbndaibwdn, but delivery was slow.',
            },
            {
                id: 7,
                product: { name: 'Product D', images: [{ path: '/img/product2.jpg' }] },
                rating: 4.0,
                photo: '/img/example/test_shirt.jpg',
                content: 'Good quality mantap cihuy adnjanjdwbndaibwdn, but delivery was slow.',
            },
        ]);

        // Search query
        const searchQuery = ref('');

        // Filtered reviews
        const filteredReviews = computed(() => {
            return reviews.value.filter(review =>
                review.product.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
                review.content.toLowerCase().includes(searchQuery.value.toLowerCase())
            );
        });

        // Review modal
        const showReviewModal = ref(false);
        const selectedReview = ref(null);

        // Computed classes for modal
        const modalGridClass = computed(() => ({
            'grid-cols-[1fr_4fr]': !!selectedReview.value?.photo,
        }));

        const modalContentClass = computed(() => ({
            'w-full lg:w-3/5': !!selectedReview.value?.photo,
            'w-full': !selectedReview.value?.photo,
            'h-full': true,
            'px-1 lg:px-6': true,
            'flex': true,
            'flex-col': true,
        }));

        const openReviewModal = (review) => {
            selectedReview.value = review;
            showReviewModal.value = true;
        };

        const closeReviewModal = () => {
            showReviewModal.value = false;
            selectedReview.value = null;
        };

        // Fetch reviews
        const fetchReviews = async () => {
            try {
                /*
                const response = await axios.get('/api/admin/reviews', {
                  params: { search: searchQuery.value },
                });
                reviews.value = response.data.reviews;
                */
            } catch (error) {
                console.error('Error fetching reviews:', error);
            }
        };

        // Filter reviews
        const filterReviews = () => {
            // Local filtering is handled by computed property
            // Uncomment for API-based filtering
            // fetchReviews();
        };

        onMounted(() => {
            // fetchReviews();
        });

        return {
            reviews,
            searchQuery,
            filteredReviews,
            showReviewModal,
            selectedReview,
            modalGridClass,
            modalContentClass,
            openReviewModal,
            closeReviewModal,
            filterReviews,
        };
    },
};
</script>

<style>
.no-scrollbar::-webkit-scrollbar {
    display: none;
}

.no-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>