<script setup>
import { ref, computed, onMounted, defineProps } from 'vue';
import Layout from '../../Layouts/Customer.vue';
import axios from 'axios';

const props = defineProps(['id']);
console.log(props.id)

const product = ref({});
const quantity = ref(1);
const modalImage = ref('');

const averageRating = computed(() => {
  if (Array.isArray(product.value.reviews) && product.value.reviews.length > 0) {
    const totalRating = product.value.reviews.reduce((sum, review) => sum + review.rating, 0);
    return (totalRating / product.value.reviews.length).toFixed(1);
  }
  return "0.0";
});

const changeMainImage = (image) => {
  modalImage.value = image || product.value.main_image;
};

const closeModal = () => {
  modalImage.value = null;
};

const buyNow = () => {
  console.log('Buying product:', product.value.id);
};

const addToCart = () => {
  console.log('Adding to cart:', product.value.id);
};

const addQuantity = () => {
  quantity.value++;
};

const reduceQuantity = () => {
  if (quantity.value > 1) {
    quantity.value--;
  }
};

onMounted(async () => {
  try {
    const response = await axios.get(`https://hepikorea.pad19.me/api/product/${props.id}`);
    // const response = await axios.get(`https://hepikorea.pad19.me/api/product/1`); 
    product.value = response.data;
    console.log("Product Data:", product.value);
  } catch (error) {
    console.error("Error fetching product:", error);
  }
});
</script>

<template>
  <Layout title="Product Detail">
    <div class="w-full w-max[100%] h-full rounded-3xl bg-[#EFEFEF] shadow-md overflow-hidden py-2 md:py-6 px-2 md:px-6">
      <div class="w-full h-full bg-[#FFFCFC] rounded-2xl flex flex-col md:flex-row">
        <div class="w-full md:w-[35%] h-full">
          <div class="flex flex-col space-y-4">
            <div class="w-full h-96 mr-auto bg-white p-3 rounded-xl">
              <img src="{{ product.images[0].path }}" class="w-full h-full object-contain" alt="Main Image" />
            </div>
            <div class="flex space-x-4 mx-auto overflow-x-auto" id="product-images">
              <div v-for="(image, index) in product.images" :key="index" class="relative w-14 h-14">
                <img src="{{ image.path }}"
                  class="w-full h-full object-cover rounded-lg cursor-pointer border border-gray-100"
                  @click="changeMainImage(getProductImage(image))" />
              </div>
            </div>
          </div>
        </div>
        <div class="hidden md:flex w-[5%] h-full text-transparent">.</div>
        <div
          class="w-full md:w-[60%] h-full flex-col px-4 md:px-8 pt-4 pb-8 rounded-2xl justify-center md:justify-center">
          <!-- <div v-if="product?.reviews?.length > 0" class="w-full flex flex-row"> -->
          <div class="w-full flex flex-row">
            <div class="flex flex-row">
              <img src="/img/assets/icon/icon_review_star.svg" alt="" class="h-6 w-6 md:h-12 md:w-12" />
              <p class="my-auto ml-3 text-black font-bold">{{ averageRating }}</p>
            </div>
            <p class="text-black text-sm md:text-base font-normal mr-0 md:mr-auto ml-auto md:ml-40 my-auto">
              {{ product?.reviews?.length }} Rating
            </p>
          </div>

          <h1 class="text-black text-opacity-50 font-bold text-xl md:text-3xl text-left mt-2 md:mt-8">
            {{ product.name }}
          </h1>

          <h1 class="text-[#3E6E7A] font-bold text-base md:text-3xl text-left mt-2 md:mt-6">
            <!-- Rp {{ formatPrice(product.price) }} -->
            Rp {{ product.price }}
          </h1>

          <div class="w-full mt-6 md:mt-12 flex flex-col gap-y-4 md:gap-y-8">
            <div class="flex flex-row">
              <img src="/img/assets/icon/icon_plane.svg" class="w-3 h-3 md:w-6 md:h-6" alt="" />
              <p class="text-xs md:text-base text-black font-normal ml-2">Ships Straight</p>
            </div>
            <div class="flex flex-row">
              <img src="/img/assets/icon/icon_box.svg" class="w-3 h-3 md:w-6 md:h-6" alt="" />
              <p class="text-xs md:text-base text-black font-normal ml-2">Ships straight from Korea to your address</p>
            </div>
            <div class="flex flex-row">
              <img src="/img/assets/icon/icon_fasttruck.svg" class="w-3 h-3 md:w-6 md:h-6" alt="" />
              <p class="text-xs md:text-base text-black font-normal ml-2">Quick Delivery</p>
            </div>
            <div class="flex flex-row">
              <img src="/img/assets/icon/icon_fasttime.svg" class="w-3 h-3 md:w-6 md:h-6 my-auto" alt="" />
              <p class="text-xs md:text-base text-black font-normal ml-2">Expedited Shipping—delivered in 4-10 days
                post-shipment</p>
            </div>
            <div class="flex flex-row">
              <img src="/img/assets/icon/icon_heart.svg" class="w-3 h-3 md:w-6 md:h-6" alt="" />
              <p class="text-xs md:text-base text-black font-normal ml-2">100% Authentic</p>
            </div>
            <div class="flex flex-row">
              <img src="/img/assets/icon/icon_shield.svg" class="w-3 h-3 md:w-6 md:h-6" alt="" />
              <p class="text-xs md:text-base text-black font-normal ml-2">Reliable payment methods</p>
            </div>
          </div>

          <div class="w-full h-fit flex flex-row mt-10 mx-auto">
            <div class="w-[40%] md:w-[10%] h-full text-xl">Qty</div>
            <div class="w-[60%] md:w-[90%] h-full flex flex-row">
              <div @click="reduceQuantity"
                class="border border-black rounded-full py-1 px-3.5 text-2xl cursor-pointer hover:bg-slate-100">-</div>
              <p class="my-auto text-2xl mx-6" id="product-quantity-view">{{ quantity }}</p>
              <div @click="addQuantity"
                class="border border-black rounded-full py-1 px-3 text-2xl cursor-pointer hover:bg-slate-100">+</div>
            </div>
          </div>

          <div class="w-full h-fit flex flex-row mt-10 mx-auto md:mx-0">
            <form @submit.prevent="buyNow" class="w-1/2">
              <button type="submit"
                class="w-full bg-[#FFFCFC] border border-orange-400 text-[#3E6E7A] text-lg md:text-2xl rounded-2xl py-2 hover:bg-slate-100 focus:bg-slate-200">Buy
                now</button>
            </form>

            <form @submit.prevent="addToCart" class="w-1/2 ml-5">
              <button type="submit"
                class="w-full bg-[#FFFCFC] border border-orange-400 text-[#3E6E7A] text-lg md:text-2xl rounded-2xl py-2 hover:bg-slate-100 focus:bg-slate-200">Add
                to Cart</button>
            </form>
          </div>
        </div>
      </div>

      <div class="w-[100%] max-w-[100%] h-full flex-col px-4 md:px-8 py-4 md:py-8 bg-[#FFFCFC] rounded-2xl mt-6">
        <h1 class="text-black font-bold text-lg md:text-2xl">Product Description</h1>
        <p class="text-[#898383] font-semibold text-sm md:text-lg mt-2 md:mt-8">{{ product.description }}</p>
      </div>

      <div v-if="product?.reviews?.length > 0"
        class="w-[100%] h-full flex-col px-8 pt-6 pb-8 bg-[#FFFCFC] rounded-2xl mt-6">
        <h1 class="text-black font-bold text-2xl">Product Rating</h1>
        <div class="w-full h-full flex flex-row">
          <div class="w-[38%] h-full flex flex-row px-8 py-10">
            <img src="/img/assets/icon/icon_review_star.svg" alt="" class="h-32 w-32 object-contain" />
            <h1 class="text-black text-6xl font-bold my-auto ml-5">{{ averageRating }}</h1>
          </div>
        </div>

        <div class="w-full h-full flex flex-col mt-10 pl-10">
          <div v-for="review in product.reviews" :key="review.id" class="w-full h-fit flex flex-row mb-10">
            <div class="w-[70%] flex flex-row mb-auto">
              <div class="w-[15%] h-full my-auto">
                <img :src="getUserImage(review.user.photo)" alt="" class="w-32 h-32 rounded-full" />
              </div>
              <div class="w-[75%] flex flex-col h-full my-auto pl-4">
                <h1 class="text-black font-bold text-xl my-0.5">{{ review.user.fullname }}</h1>
                <h1 class="text-[#898383] font-bold text-sm my-0.5">{{ review.content }}</h1>
              </div>
            </div>
            <img v-if="review.photo" :src="getReviewImage(review.photo)" alt=""
              class="w -24 h-24 rounded-lg object-contain border-2 border-black bg-white cursor-pointer" />
          </div>
        </div>
      </div>
    </div>

    <!-- Modal for review image -->
    <div id="image-review-view-modal" tabindex="-1" aria-hidden="true"
      class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-fit max-w-2xl max-h-full mt-20">
        <div class="bg-white w-[30vw] h-auto rounded-lg shadow">
          <div class="relative w-full h-full flex flex-row">
            <button type="button"
              class="absolute bg-black w-5 h-5 flex flex-col align-middle text-center items-center rounded-full pb-3 -top-2 -right-2"
              @click="closeModal">
              <p class="m-auto text-white text-sm">X</p>
            </button>
            <div class="w-full h-full flex flex-col p-5">
              <img :src="modalImage" class="w-full h-full object-contain" alt="Main Image" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>
