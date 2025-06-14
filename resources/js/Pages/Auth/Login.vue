<script setup>
// example of composition API

import { Link, router, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import Layout from '../Layouts/Auth.vue';

defineProps({ errors: Object });
const form = useForm({
    email: '',
    password: '',
});
function submit() {
    router.post('/auth/login', form);
}

const showPassword = ref(false);
function togglePassword() {
    showPassword.value = !showPassword.value;
    console.log(showPassword.value);
}

function google() {
    window.open('/auth/google', '_blank', 'width=600,height=600');
}

</script>

<template>
    <Layout title="Login">
        <div
            class="bg-white w-[259px] md:w-[241px] lg:w-[512px] max-w-md px-4 pt-4 pb-5 md:px-5 md:pt-6 md:pb-3 lg:px-10 lg:py-10 m-auto shadow-lg rounded-2xl">
            <h1 class="text-black text-[10px] md:text-sm lg:text-xl font-extrabold mb-4 md:mb-5">Masuk Ke
                <span class="text-orange-400 cursor-pointer tracking-[-0.01rem]" onclick="window.location.href='/'">
                    <span class="text-[#3E6E7A]">Hepi</span>Korea
                </span>
            </h1>

            <div id="alert-1" v-if="errors.message"
                class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                role="alert">
                {{ errors.message }}
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-1" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>

            <form @submit.prevent="submit">
                <div class="relative w-full">
                    <span class="absolute inset-y-0 left-0 pl-2 md:pl-2 lg:pl-3 flex items-center">
                        <img src="/img/assets/icon/icon_user.svg" alt="User Icon"
                            class="w-3 h-3 md:h-4 md:w-4 lg:h-6 lg:w-6">
                    </span>
                    <input type="email" placeholder="Email" v-model="form.email" required
                        class="pl-7 md:pl-9 lg:pl-12 w-full rounded-xl bg-[#EFEFEF] shadow-md border-none h-8 md:h-8 lg:h-14 focus:outline-none focus:ring-0 placeholder:text-[#B7B7B7] placeholder:text-xs md:placeholder:text-xs lg:placeholder:text-lg">
                </div>

                <div class="relative w-full mt-4 lg:mt-5">
                    <span class="absolute inset-y-0 left-0 pl-2 md:pl-2 lg:pl-3 flex items-center">
                        <img src="/img/assets/icon/icon_lock.svg" alt="lock Icon"
                            class="w-3 h-3 md:h-4 md:w-4 lg:h-6 lg:w-6">
                    </span>
                    <input id="password" :type="showPassword ? 'text' : 'password'" placeholder="Password"
                        v-model="form.password" required
                        class="pl-7 md:pl-9 lg:pl-12 w-full rounded-xl bg-[#EFEFEF] shadow-md border-none h-8 md:h-8 lg:h-14 focus:outline-none focus:ring-0 placeholder:text-[#B7B7B7] placeholder:text-xs md:placeholder:text-xs lg:placeholder:text-lg">
                    <!-- show/hide password -->
                    <span class="absolute inset-y-0 right-0 pr-3 md:pr-2 lg:pr-6 flex items-center">
                        <img @click="togglePassword"
                            :src="showPassword ? '/img/assets/icon/icon_show_eye.svg' : '/img/assets/icon/icon_hide_eye.svg'"
                            alt="eye hide Icon" class="w-3 h-3 md:h-4 md:w-4 lg:h-6 lg:w-6 cursor-pointer">
                    </span>
                </div>

                <div class="text-right md:my-2 lg:my-3">
                    <a href="/auth/forgot_password"
                        class="text-[10px] md:text-[10px] lg:text-sm font-semibold text-blue-600 hover:opacity-80 active:opacity-60">Forgot
                        Password</a>
                </div>
                <!-- login button -->
                <button type="submit"
                    class="w-full text-center bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] h-8 md:h-8 lg:h-12 rounded-[10px] md:rounded-md lg:rounded-xl mb-2 md:mb-3 lg:mb-5 text-[8px] md:text-xs lg:text-2xl font-normal text-white">Login</button>
            </form>
            <p
                class="text-[8px] md:text-[10px] lg:text-sm md:font-normal lg:font-semibold text-center md:text-center lg:text-center text-black">
                Don't have an
                account?
                <Link href="/auth/register" class="text-blue-600 hover:opacity-80 active:opacity-60">Register</Link>
            </p>
            <div class="w-full relative">
                <hr class="border-t-2 border-slate-400 mt-6 md:mt-5 lg:mt-8 relative">
                <div
                    class="absolute -top-1.5 md:-top-3 lg:-top-5 left-[24%] md:left-[22%] lg:left-[25%] bg-[#FFFFFF] text-[8px] md:text-xs lg:text-base font-semibold text-[#B7B7B7] py-1 px-9 md:py-1 md:px-5 lg:py-2 lg:px-10">
                    or login
                    with
                </div>
            </div>
            <!-- button login google -->
            <a @click.prevent="google"
                class="w-full flex items-center justify-center bg-[#EFEFEF] h-8 md:h-8 lg:h-12 rounded-xl md:mb-2 lg:mb-5 text-[8px] md:text-xs lg:text-2xl font-bold text-black mt-8 md:mt-8 lg:mt-10 cursor-pointer hover:opacity-80 active:opacity-60">
                <img src="/img/assets/icon/icon_google.png" alt="Google Icon"
                    class="w-4 h-4 md:h-4 lg:h-6 md:w-4 lg:w-6 mr-3">
                Login With Google
            </a>
        </div>
    </Layout>
</template>
<style scoped>
::-ms-reveal {
    display: none;
}
</style>
