<script setup>
import Layout from '../Layouts/Auth.vue'
import { Head } from '@inertiajs/vue3'

import { reactive } from 'vue'
import axios from 'axios'
const form = reactive({
    email: '',
    password: '',
})

async function submit() {
    const res = await axios.post('/auth/login-inertia', form)
    console.log(res.data)
}
</script>

<template>
    <Layout>

        <Head title="Anu" />

        <div class="bg-white w-1/2 max-w-md p-10 m-auto shadow-lg rounded-2xl">
            <h1 class="text-black text-xl font-extrabold mb-5">Masuk Ke
                <span class="text-orange-400 cursor-pointer tracking-[-0.01rem]"
                    onclick="window.location.href='{{ route('home') }}'">
                    <span class="text-[#3E6E7A]">Hepi</span>Korea
                </span>
            </h1>

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
                    <input id="password" type="password" placeholder="Password" v-model="form.password" required
                        class="pl-12 w-full rounded-xl bg-[#EFEFEF] shadow-md border-none h-14 focus:outline-none focus:ring-0 placeholder:text-[#B7B7B7]">
                    <!-- show/hide password -->
                    <span class="absolute inset-y-0 right-0 pr-6 flex items-center">
                        <img id="togglePassword" src="/img/assets/icon/icon_hide_eye.svg" alt="eye hide Icon"
                            class="h-6 w-6 cursor-pointer">
                    </span>
                </div>

                <div class="text-right my-3">
                    <a href="#" class="text-sm font-semibold text-blue-600 ">Forgot Password</a>
                </div>
                <!-- login button -->
                <button type="submit"
                    class="w-full text-center bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] h-12 rounded-xl mb-5 text-2xl font-normal text-white">Login</button>
            </form>
            <p class="text-sm font-semibold text-center text-black">Don't have an account? <a href="#"
                    class="text-blue-600">Register</a>
            </p>
            <div class="w-full relative">
                <hr class="border-t-2 border-slate-400 mt-8 relative">
                <div class="absolute -top-5 left-[25%] bg-[#FFFCFC] font-semibold text-[#B7B7B7] py-2 px-10">or login
                    with
                </div>
            </div>
            <!-- button login google -->
            <a href="#" id="btn-google"
                class="w-full flex items-center justify-center bg-[#EFEFEF] h-12 rounded-xl mb-5 text-2xl font-bold text-black mt-10">
                <img src="/img/assets/icon/icon_google.png" alt="Google Icon" class="h-6 w-6 mr-3">
                Login With Google
            </a>
        </div>
    </Layout>
</template>
