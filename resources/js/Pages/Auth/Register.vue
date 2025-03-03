<template>
    <Layout title="Register">

        <!-- <Head title="Register" /> -->
        <div class="bg-white h-auto w-1/2 max-w-md p-10 m-auto shadow-lg rounded-2xl">
            <h1 class="text-black text-xl font-extrabold mb-5">Daftar di
                <span class="text-orange-400 cursor-pointer tracking-[-0.01rem]" onclick="window.location.href='/'">
                    <span class="text-[#3E6E7A]">Hepi</span>Korea
                </span>
            </h1>
            <!-- start of form -->
            <form @submit.prevent="submitForm">
                <div class="relative w-full">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <img src="/img/assets/icon/icon_user.svg" alt="User Icon" class="h-6 w-6">
                    </span>
                    <input type="text" placeholder="Fullname" v-model="form.fullname" required
                        class="pl-12 w-full rounded-xl bg-[#EFEFEF] shadow-md border-none h-14 focus:outline-none focus:ring-0 placeholder:text-[#B7B7B7]">
                </div>
                <p class="mt-2 text-sm text-red-500 dark:text-red-500" v-if="errors?.fullname">{{ errors?.fullname }}
                </p>

                <div class="relative w-full mt-5">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <img src="/img/assets/icon/icon_email_input.svg" alt="User Icon" class="h-6 w-6">
                    </span>
                    <input type="text" placeholder="Email" name="email" v-model="form.email" required
                        class="pl-12 w-full rounded-xl bg-[#EFEFEF] shadow-md border-none h-14 focus:outline-none focus:ring-0 placeholder:text-[#B7B7B7]">
                </div>
                <p class="mt-2 text-sm text-red-500 dark:text-red-500" v-if="errors?.email">{{ errors?.email }}
                </p>

                <div class="relative w-full mt-5">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <img src="/img/assets/icon/icon_lock.svg" alt="lock Icon" class="h-6 w-6">
                    </span>
                    <input id="password" :type="showPassword ? 'text' : 'password'" placeholder="Password"
                        v-model="form.password" required
                        class="pl-12 w-full rounded-xl bg-[#EFEFEF] shadow-md border-none h-14 focus:outline-none focus:ring-0 placeholder:text-[#B7B7B7]">
                    <!-- show/hide password -->
                    <span class="absolute inset-y-0 right-0 pr-6 flex items-center">
                        <img @click="showPassword = !showPassword"
                            :src="showPassword ? '/img/assets/icon/icon_hide_eye.svg' : '/img/assets/icon/icon_show_eye.svg'"
                            alt="eye hide Icon" class="h-6 w-6 cursor-pointer">
                    </span>
                </div>
                <p class="mt-2 text-sm text-red-500 dark:text-red-500" v-if="errors?.password">{{ errors?.password }}
                </p>

                <div class="relative w-full mt-5">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <img src="/img/assets/icon/icon_lock.svg" alt="User Icon" class="h-6 w-6">
                    </span>
                    <input id="confirmPassword" :type="showPassword ? 'text' : 'password'"
                        v-model="form.password_confirmation" placeholder="Confirm Password" required
                        class="pl-12 w-full rounded-xl bg-[#EFEFEF] shadow-md border-none h-14 focus:outline-none focus:ring-0 placeholder:text-[#B7B7B7]">
                    <!-- show/hide password -->
                    <span class="absolute inset-y-0 right-0 pr-6 flex items-center">
                        <img @click="showPassword = !showPassword"
                            :src="showPassword ? '/img/assets/icon/icon_hide_eye.svg' : '/img/assets/icon/icon_show_eye.svg'"
                            alt="eye hide Icon" class="h-6 w-6 cursor-pointer">
                    </span>
                </div>

                <button type="submit"
                    class="w-full text-center bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] h-12 rounded-xl mb-5 text-2xl font-bold text-white shadow-md mt-5">Register</button>
            </form>
            <p class="text-sm font-semibold text-start text-black">Have an account?
                <Link href="/auth/login" class="text-blue-600 cursor-pointer">Login</Link>
            </p>
            <div class="w-full relative">
                <hr class="border-t-2 border-slate-400 mt-8 relative">
                <div class="absolute -top-5 left-[25%] bg-[#FFFCFC] text-[#B7B7B7] py-2 px-10">or login with</div>
            </div>
            <!-- button login google -->
            <a @click="googleLogin"
                class="w-full flex items-center justify-center bg-[#EFEFEF] h-12 rounded-xl mb-5 text-2xl font-bold text-black mt-10 cursor-pointer">
                <img src="/img/assets/icon/icon_google.png" alt="Google Icon" class="h-6 w-6 mr-3">
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