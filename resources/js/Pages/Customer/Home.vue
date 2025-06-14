<template>
    <Layout title="Home">
        <div>
            <!-- Chat Button -->
            <a :href="lineUrl" target="_blank"
                class="fixed flex flex-row bottom-8 right-8 px-2 py-2 text-base md:text-2xl font-bold text-[#3E6E7A] bg-white rounded-3xl items-center shadow-md hover:shadow-lg z-30">
                <img src="/img/assets/icon/icon_customer_chat.svg" alt="icon_Chat"
                    class="w-5 h-5 md:w-10 md:h-10 mr-1" />
                <p>Chat</p>
            </a>

            <!-- Homepage Content Container -->
            <div class="w-full max-w-full rounded-3xl bg-[#EFEFEF] shadow-lg overflow-hidden">
                <!-- Carousel -->
                <div id="default-carousel" class="relative w-full rounded-t-2xl md:rounded-t-3xl" data-carousel="slide">
                    <div class="relative h-[150px] md:h-[300px] lg:h-[500px] overflow-hidden rounded-t-lg">
                        <div v-for="(carousel, index) in carousels" :key="index" class="duration-700 ease-in-out"
                            data-carousel-item>
                            <div
                                class="w-full h-full flex flex-row absolute -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                <div class="w-1/2 h-full flex flex-col bg-[#3E6E7A] p-6 md:p-16 lg:p-20 text-white">
                                    <h1 class="text-md md:text-base lg:text-5xl font-semibold">
                                        {{ carousel.title }}
                                    </h1>
                                    <h2 class="text-xs md:text-xs lg:text-2xl font-medium mt-1 md:mt-8">
                                        {{ carousel.description }}
                                    </h2>
                                </div>
                                <div class="w-1/2 h-full flex bg-white">
                                    <template v-if="carousel.media_type === 'image'">
                                        <img :src="getMediaUrl(carousel.media)" alt=""
                                            class="w-full h-full object-contain" />
                                    </template>
                                    <template v-else-if="
                                        carousel.media_type === 'video'
                                    ">
                                        <video class="w-full h-full object-contain" controls autoplay muted loop>
                                            <source :src="getMediaUrl(carousel.media)
                                                " type="video/mp4" />
                                            Your browser does not support the
                                            video tag.
                                        </video>
                                    </template>
                                    <template v-else-if="
                                        carousel.media_type === 'youtube'
                                    ">
                                        <iframe class="w-full h-full pointer-events-none"
                                            :src="`${carousel.media}&loop=1&controls=0&showinfo=0`"
                                            title="YouTube video player" frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            referrerpolicy="strict-origin-when-cross-origin"></iframe>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Slider Indicators -->
                    <div class="absolute z-30 flex -translate-x-1/2 bottom-4 left-1/2 space-x-3 scale-50 md:scale-100">
                        <button v-for="(_, index) in carousels" :key="index" type="button" class="w-3 h-3 rounded-full"
                            :aria-current="true" :data-carousel-slide-to="index"></button>
                    </div>
                    <!-- Slider controls -->
                    <button type="button"
                        class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none scale-50 md:scale-100"
                        data-carousel-prev>
                        <span
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 shadow-xl group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white">
                            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M5 1 1 5l4 4" />
                            </svg>
                            <span class="sr-only">Previous</span>
                        </span>
                    </button>
                    <button type="button"
                        class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none scale-50 md:scale-100"
                        data-carousel-next>
                        <span
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 shadow-xl group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white">
                            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="sr-only">Next</span>
                        </span>
                    </button>
                </div>

                <!-- Categories, Recent, Best Seller Container -->
                <div class="w-full flex flex-col py-5 md:py-10 px-4 md:px-8 lg:px-12">
                    <!-- Categories -->
                    <div class="w-fit md:w-2/6 lg:w-1/5 bg-white rounded-xl text-center py-2 px-4 md:px-0">
                        <h1 class="text-[#3E6E7A] text-sm md:text-lg font-semibold">
                            Category
                        </h1>
                    </div>
                    <div class="grid grid-cols-4 gap-x-3 gap-y-3 lg:gap-x-32 lg:gap-y-20 mt-4 md:mt-8 lg:mt-14">
                        <div v-for="category in categories" :key="category.id"
                            class="bg-[#FFFCFC] h-24 md:h-44 lg:h-52 flex flex-col text-center justify-center rounded-xl cursor-pointer hover:scale-105 transition-transform"
                            @click="
                                $inertia.get(
                                    route('product.index', {
                                        category: category.id,
                                    })
                                )
                                ">
                            <img :src="getCategoryIcon(category.icon)" alt="category"
                                class="w-12 h-12 md:h-36 lg:w-40 lg:h-40 mx-auto" />
                            <h2
                                class="text-black text-[10px] md:text-xs lg:text-lg font-semibold text-ellipsis overflow-hidden">
                                {{ category.name }}
                            </h2>
                        </div>
                    </div>

                    <!-- New Arrival -->
                    <div
                        class="w-fit md:w-2/6 lg:w-1/5 bg-white rounded-xl text-center py-2 px-4 md:px-0 mt-4 md:mt-14">
                        <h1 class="text-[#3E6E7A] text-sm md:text-lg font-semibold">
                            New Arrival
                        </h1>
                    </div>
                    <div class="relative mt-5 md:mt-10">
                        <div class="overflow-x-auto no-scrollbar" id="newArrivalContainer">
                            <button @click="scrollLeft('newArrivalContainer')"
                                class="absolute top-1/2 left-0 transform -translate-y-1/2 z-10 bg-orange-400 bg-opacity-50 hover:bg-opacity-80 text-white rounded-full p-2 shadow-lg">
                                <svg class="h-6 w-6 rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                            <button @click="scrollRight('newArrivalContainer')"
                                class="absolute top-1/2 right-0 transform -translate-y-1/2 z-10 bg-orange-400 bg-opacity-50 hover:bg-opacity-80 text-white rounded-full p-2 shadow-lg">
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                            <div
                                class="grid grid-flow-col auto-cols-[125px] md:auto-cols-[150px] lg:auto-cols-[175px] gap-x-5 md:gap-x7 lg:gap-x-14">
                                <div v-for="product in newProducts" :key="product.id"
                                    class="bg-white h-[200px] md:-[230px] lg:h-[250px] flex flex-col rounded-xl overflow-hidden cursor-pointer hover:scale-[101%] transition-transform"
                                    @click="
                                        $inertia.get(
                                            route('product.show', product.id)
                                        )
                                        ">
                                    <div class="w-full h-4/6 bg-cover bg-no-repeat bg-center" :style="{
                                        backgroundImage: `url(${getProductImage(
                                            product
                                        )})`,
                                    }"></div>
                                    <div class="w-full h-2/6 py-0.5 px-1.5 flex flex-col">
                                        <h1
                                            class="text-xs md: lg:text-sm text-[#3E6E7A] font-semibold text-nowrap text-ellipsis truncate overflow-hidden">
                                            {{ product.name }}
                                        </h1>
                                        <h2
                                            class="text-[10px] md:text-xs font-semibold text-black text-opacity-50 text-ellipsis overflow-hidden">
                                            {{ product.category }}
                                        </h2>
                                        <h3
                                            class="text-[10px] md:text-xs ml-auto text-orange-400 font-semibold text-ellipsis overflow-hidden">
                                            Rp {{ formatPrice(product.price) }}
                                        </h3>
                                        <a href="#" class="ml-auto my-auto">
                                            <button
                                                class="bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] rounded-xl text-white px-2 md:px-4 md:py-0.5 text-[10px] md:text-xs hover:opacity-80 active:opacity-60">
                                                Buy
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Best Seller -->
                    <div
                        class="w-fit md:w-2/6 lg:w-1/5 bg-white rounded-xl text-center py-2 px-4 md:px-0 mt-4 md:mt-14">
                        <h1 class="text-[#3E6E7A] text-sm md:text-lg font-semibold">
                            Best Seller
                        </h1>
                    </div>
                    <div class="relative mt-5 md:mt-10">
                        <div class="overflow-x-auto no-scrollbar" id="bestSellerContainer">
                            <button @click="scrollLeft('bestSellerContainer')"
                                class="absolute top-1/2 left-0 transform -translate-y-1/2 z-10 bg-orange-400 bg-opacity-50 hover:bg-opacity-80 text-white rounded-full p-2 shadow-lg">
                                <svg class="h-6 w-6 rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                            <button @click="scrollRight('bestSellerContainer')"
                                class="absolute top-1/2 right-0 transform -translate-y-1/2 z-10 bg-orange-400 bg-opacity-50 hover:bg-opacity-80 text-white rounded-full p-2 shadow-lg">
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                            <div
                                class="grid grid-flow-col auto-cols-[125px] md:auto-cols-[150px] lg:auto-cols-[175px] gap-x-5 md:gap-x7 lg:gap-x-14">
                                <div v-for="product in popularProducts" :key="product.id"
                                    class="bg-white h-[200px] md:-[230px] lg:h-[250px] flex flex-col rounded-xl overflow-hidden cursor-pointer hover:scale-[101%] transition-transform"
                                    @click="
                                        $inertia.get(
                                            route('product.show', product.id)
                                        )
                                        ">
                                    <div class="w-full h-4/6 bg-cover bg-no-repeat bg-center" :style="{
                                        backgroundImage: `url(${getProductImage(
                                            product
                                        )})`,
                                    }"></div>
                                    <div class="w-full h-2/6 py-0.5 px-1.5 flex flex-col">
                                        <h1
                                            class="text-xs lg:text-sm text-[#3E6E7A] font-semibold text-nowrap text-ellipsis truncate overflow-hidden">
                                            {{ product.name }}
                                        </h1>
                                        <h2
                                            class="text-[10px] md:text-xs font-semibold text-black text-opacity-50 text-ellipsis overflow-hidden">
                                            {{ product.category }}
                                        </h2>
                                        <h3
                                            class="text-[10px] md:text-xs ml-auto text-orange-400 font-semibold text-ellipsis overflow-hidden">
                                            Rp {{ formatPrice(product.price) }}
                                        </h3>
                                        <a href="#" class="ml-auto my-auto">
                                            <button
                                                class="bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] rounded-xl text-white px-2 md:px-4 md:py-0.5 text-[10px] md:text-xs hover:opacity-80 active:opacity-60">
                                                Buy
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script>
import { Carousel, initCarousels } from "flowbite"; // Impor Flowbite
import Layout from "../Layouts/Customer.vue";

export default {
    data() {
        return {
            carousels: [],
            categories: [],
            newProducts: [],
            popularProducts: [],
        };
    },
    components: {
        Layout,
    },
    props: {
        lineUrl: String,
    },
    methods: {
        async fetchData() {
            try {
                await Promise.all([
                    fetch("/api/carousel").then(
                        async (res) => (this.carousels = await res.json())
                    ).then(() => {
                        // Pastikan carousels tidak kosong sebelum inisialisasi
                        if (this.carousels.length > 0) {
                            initCarousels();
                        }
                    }),
                    fetch("/api/category").then(
                        async (res) => (this.categories = await res.json())
                    ),
                    fetch("/api/product/latest").then(
                        async (res) => (this.newProducts = await res.json())
                    ),
                    fetch("/api/product/popular").then(
                        async (res) => (this.popularProducts = await res.json())
                    ),
                ]);

                // Inisialisasi carousel setelah data tersedia
                this.initCarousel();
            } catch (error) {
                console.error("Error fetching data:", error);
            }
        },
        getMediaUrl(media) {
            if (!media) return "https://placehold.co/200";
            if (/^http/.test(media)) return media;
            return `/api/file?path=${media.replace(/\/?storage\//g, "")}`;
        },
        getCategoryIcon(icon) {
            if (!icon) return "https://placehold.co/200";
            if (/^http/.test(icon)) return icon;
            return `/api/file?path=${icon.replace(/\/?storage\//g, "")}`
        },
        getProductImage(product) {
            if (!product?.image) return "https://placehold.co/200";
            let image = product.image;
            if (/^http/.test(image)) return image;
            return `/api/file?path=${image.replace(/\/?storage\//g, "")}`;
        },
        formatPrice(price) {
            // Price formatting
            return price?.toString()?.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        },
        scrollRight(containerRef) {
            // Scroll functions
            const container = containerRef === "newArrivalContainer"
                ? document.getElementById("newArrivalContainer")
                : document.getElementById("bestSellerContainer");
            container.scrollBy({ left: 400, behavior: "smooth" });
        },
        scrollLeft(containerRef) {
            const container = containerRef === "newArrivalContainer"
                ? document.getElementById("newArrivalContainer")
                : document.getElementById("bestSellerContainer");
            container.scrollBy({ left: -400, behavior: "smooth" });
        },
        initCarousel() {
            // Inisialisasi carousel
            const carouselElement = document.getElementById("default-carousel");
            if (carouselElement && this.carousels.length > 0) {
                // Otomatis berganti setiap 5 detik (opsional)
                new Carousel(carouselElement, { interval: 5000 });
            }
        },
    },
    mounted() {
        // Ambil data saat komponen dimuat
        this.fetchData();

        // Inisialisasi Flowbite (opsional, tergantung konfigurasi Anda)
        // initFlowbite();
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
