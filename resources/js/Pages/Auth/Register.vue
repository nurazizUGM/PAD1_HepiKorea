<template>
    <Layout title="Register">

        <!-- <Head title="Register" /> -->
        <div
            class="bg-white h-auto w-[259px] md:w-[241px] lg:w-[520px] max-w-md px-4 pt-4 pb-5 md:px-5 md:pt-6 md:pb-3 lg:px-10 lg:py-10 m-auto shadow-lg rounded-2xl">
            <h1 class="text-black text-sm md:text-base lg:text-xl font-extrabold mb-4 md:mb-5">Daftar di
                <span class="text-orange-400 cursor-pointer tracking-[-0.01rem]" onclick="window.location.href='/'">
                    <span class="text-[#3E6E7A]">Hepi</span>Korea
                </span>
            </h1>
            <!-- start of form -->
            <form @submit.prevent="submitForm">
                <div class="relative w-full">
                    <span class="absolute inset-y-0 left-0 pl-2 md:pl-2 lg:pl-3 flex items-center">
                        <img src="/img/assets/icon/icon_user.svg" alt="User Icon" class="w-3 h-3 md:h-4 md:w-4 lg:h-6 lg:w-6">
                    </span>
                    <input type="text" placeholder="Fullname" v-model="form.fullname" required
                        class="pl-7 md:pl-9 lg:pl-12 w-full rounded-xl bg-[#EFEFEF] shadow-md border-none h-8 md:h-8 lg:h-14 focus:outline-none focus:ring-0 placeholder:text-[#B7B7B7] placeholder:text-xs md:placeholder:text-xs lg:placeholder:text-lg ">
                </div>
                <p class="mt-2 text-sm text-red-500 dark:text-red-500" v-if="errors?.fullname">{{ errors?.fullname }}
                </p>

                <div class="relative w-full mt-3.5 md:mt-4 lg:mt-5">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <img src="/img/assets/icon/icon_email_input.svg" alt="User Icon"
                            class="w-3 h-3 md:h-4 md:w-4 lg:h-6 lg:w-6">
                    </span>
                    <input type="text" placeholder="Email" name="email" v-model="form.email" required
                        class="pl-7 md:pl-9 lg:pl-12 w-full rounded-xl bg-[#EFEFEF] shadow-md border-none h-8 md:h-8 lg:h-14 focus:outline-none focus:ring-0 placeholder:text-[#B7B7B7] placeholder:text-xs md:placeholder:text-xs lg:placeholder:text-lg ">
                </div>
                <p class="mt-2 text-sm text-red-500 dark:text-red-500" v-if="errors?.email">{{ errors?.email }}
                </p>

                <div class="relative w-full mt-3.5  md:mt-4 lg:mt-5">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <img src="/img/assets/icon/icon_lock.svg" alt="lock Icon" class="w-3 h-3 md:h-4 md:w-4 lg:h-6 lg:w-6">
                    </span>
                    <input id="password" :type="showPassword ? 'text' : 'password'" placeholder="Password"
                        v-model="form.password" required
                        class="pl-7 md:pl-9 lg:pl-12 w-full rounded-xl bg-[#EFEFEF] shadow-md border-none h-8 md:h-8 lg:h-14 focus:outline-none focus:ring-0 placeholder:text-[#B7B7B7] placeholder:text-xs md:placeholder:text-xs lg:placeholder:text-lg ">
                    <!-- show/hide password -->
                    <span class="absolute inset-y-0 right-0 pr-3 md:pr-2 lg:pr-6 flex items-center">
                        <img @click="showPassword = !showPassword"
                            :src="showPassword ? '/img/assets/icon/icon_hide_eye.svg' : '/img/assets/icon/icon_show_eye.svg'"
                            alt="eye hide Icon" class="w-3 h-3 md:h-4 md:w-4 lg:h-6 lg:w-6 cursor-pointer">
                    </span>
                </div>
                <p class="mt-2 text-sm text-red-500 dark:text-red-500" v-if="errors?.password">{{ errors?.password }}
                </p>

                <div class="relative w-full mt-3.5  md:mt-4 lg:mt-5">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <img src="/img/assets/icon/icon_lock.svg" alt="User Icon" class="w-3 h-3 md:h-4 md:w-4 lg:h-6 lg:w-6">
                    </span>
                    <input id="confirmPassword" :type="showPassword ? 'text' : 'password'"
                        v-model="form.password_confirmation" placeholder="Confirm Password" required
                        class="pl-7 md:pl-9 lg:pl-12 w-full rounded-xl bg-[#EFEFEF] shadow-md border-none h-8 md:h-8 lg:h-14 focus:outline-none focus:ring-0 placeholder:text-[#B7B7B7] placeholder:text-xs md:placeholder:text-xs lg:placeholder:text-lg ">
                    <!-- show/hide password -->
                    <span class="absolute inset-y-0 right-0 pr-3 md:pr-2 lg:pr-6 flex items-center">
                        <img @click="showPassword = !showPassword"
                            :src="showPassword ? '/img/assets/icon/icon_hide_eye.svg' : '/img/assets/icon/icon_show_eye.svg'"
                            alt="eye hide Icon" class="w-3 h-3 md:h-4 md:w-4 lg:h-6 lg:w-6 cursor-pointer">
                    </span>
                </div>

                <button type="submit"
                    class="w-full text-center bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] h-8 md:h-8 lg:h-12 rounded-[10px] md:rounded-md lg:rounded-xl mb-2 md:mb-3 lg:mb-5 text-[8px] md:text-xs lg:text-2xl font-bold text-white shadow-md mt-4 md:mt-4 lg:mt-5">Register</button>
            </form>
            <p class="text-[10px] md:text-[10px] lg:text-sm md:font-normal lg:font-semibold text-right md:text-right lg:text-center text-black">Have an account?
                <Link href="/auth/login" class="text-blue-600 cursor-pointer">Login</Link>
            </p>
            <div class="w-full relative">
                <hr class="border-t-2 border-slate-400 mt-6 md:mt-5 lg:mt-8 relative">
                <div
                    class="absolute -top-1.5 md:-top-3 lg:-top-5 left-[24%] md:left-[24%] lg:left-[25%] bg-[#FFFFFF] text-[8px] md:text-xs lg:text-base font-semibold text-[#B7B7B7] py-1 px-9 md:py-1 md:px-5 lg:py-2 lg:px-10">
                    or login
                    with
                </div>
            </div>
            <!-- button login google -->
            <a @click="googleLogin"
                class="w-full flex items-center justify-center bg-[#EFEFEF] h-8  md:h-8 lg:h-12 rounded-xl md:mb-2 lg:mb-5 text-[8px] md:text-xs lg:text-2xl font-bold text-black mt-8 md:mt-8 lg:mt-10 cursor-pointer">
                <img src="/img/assets/icon/icon_google.png" alt="Google Icon" class="w-4 h-4 md:h-4 md:w-4 lg:h-6 lg:w-6 mr-3">
                Login With Google
            </a>
        </div>
    </Layout>
</template>

<script lang="ts">
// example of options API

import { Link, router } from '@inertiajs/vue3';
import Layout from '../Layouts/Auth.vue';

export default {
    props: {
        errors: Object,
    },
    data() {
        return {
            showPassword: false,
            form: {
                fullname: '',
                email: '',
                password: '',
                password_confirmation: '',
            },
            router
        };
    },
    components: {
        Layout,
        Link,
    },
    methods: {
        googleLogin() {
            window.open('/auth/google', '_blank', 'width=600,height=600');
        },
        submitForm() {
            this.$inertia.post('/auth/register', this.form, {
                onSuccess: () => {
                    this.form = {
                        fullname: '',
                        email: '',
                        password: '',
                        password_confirmation: '',
                    };
                },
                onError: (errors) => {
                    console.log(errors);
                    this.errors = errors;
                },
            });
        }
    },
};
</script>