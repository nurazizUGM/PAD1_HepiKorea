<script setup>
// example of composition API

import { Head, router, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import Layout from '../Layouts/Auth.vue';

defineProps({ errors: Object })
const form = useForm({
    email: '',
    password: '',
})
function submit() {
    router.post('/auth/login', form)
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
    <Layout>


        <Head title="Login" />
        <div class="bg-white w-1/2 max-w-md p-10 m-auto shadow-lg rounded-2xl">
            <h1 class="text-black text-xl font-extrabold mb-5">Masuk Ke
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
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <img src="/img/assets/icon/icon_user.svg" alt="User Icon" class="h-6 w-6">
                    </span>
                    <input type="email" placeholder="Email" v-model="form.email" required
                        class="pl-12 w-full rounded-xl bg-[#EFEFEF] shadow-md border-none h-14 focus:outline-none focus:ring-0 placeholder:text-[#B7B7B7]">
                </div>

                <div class="relative w-full mt-5">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <img src="/img/assets/icon/icon_lock.svg" alt="lock Icon" class="h-6 w-6">
                    </span>
                    <input id="password" :type="showPassword ? 'text' : 'password'" placeholder="Password"
                        v-model="form.password" required
                        class="pl-12 w-full rounded-xl bg-[#EFEFEF] shadow-md border-none h-14 focus:outline-none focus:ring-0 placeholder:text-[#B7B7B7]">
                    <!-- show/hide password -->
                    <span class="absolute inset-y-0 right-0 pr-6 flex items-center">
                        <img @click="togglePassword"
                            :src="showPassword ? '/img/assets/icon/icon_show_eye.svg' : '/img/assets/icon/icon_hide_eye.svg'"
                            alt="eye hide Icon" class="h-6 w-6 cursor-pointer">
                    </span>
                </div>

                <div class="text-right my-3">
                    <a href="/auth/forgot_password" class="text-sm font-semibold text-blue-600 ">Forgot Password</a>
                </div>
                <!-- login button -->
                <button type="submit"
                    class="w-full text-center bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] h-12 rounded-xl mb-5 text-2xl font-normal text-white">Login</button>
            </form>
            <p class="text-sm font-semibold text-center text-black">Don't have an account? <a href="/auth/register"
                    class="text-blue-600">Register</a>
            </p>
            <div class="w-full relative">
                <hr class="border-t-2 border-slate-400 mt-8 relative">
                <div class="absolute -top-5 left-[25%] bg-[#FFFCFC] font-semibold text-[#B7B7B7] py-2 px-10">or login
                    with
                </div>
            </div>
            <!-- button login google -->
            <a @click.prevent="google"
                class="w-full flex items-center justify-center bg-[#EFEFEF] h-12 rounded-xl mb-5 text-2xl font-bold text-black mt-10 cursor-pointer">
                <img src="/img/assets/icon/icon_google.png" alt="Google Icon" class="h-6 w-6 mr-3">
                Login With Google
            </a>
        </div>
    </Layout>
</template>
