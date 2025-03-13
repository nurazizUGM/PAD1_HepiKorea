<script setup>
import Layout from '../Layouts/Auth.vue';
import { ref } from "vue";

const password = ref("");
const confirmPassword = ref("");
const showPassword = ref(false);
const showConfirmPassword = ref(false);

const togglePasswordVisibility = (field) => {
    if (field === "password") {
        showPassword.value = !showPassword.value;
    } else {
        showConfirmPassword.value = !showConfirmPassword.value;
    }
};

const submitForm = () => {
    console.log("Password:", password.value);
    console.log("Confirm Password:", confirmPassword.value);
    // TODO: Implement API call for password change
};
</script>

<template>
    <Layout title="Reset Password">
        <div class="bg-white md:w-[354px] lg:w-[520px] h-auto max-w-lg md:p-9 lg:p-10 m-auto shadow-lg rounded-2xl">
            <h1 class="text-black md:text-sm lg:text-xl font-bold md:mb-3 lg:mb-5">Change Password</h1>
            <form @submit.prevent="submitForm">
                <!-- Password Input -->
                <div class="relative w-full md:mt-3 lg:mt-5">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <img src="/img/assets/icon/icon_lock.svg" alt="lock Icon" class="md:h-4 md:w-4 lg:h-6 lg:w-6" />
                    </span>
                    <input v-model="password" :type="showPassword ? 'text' : 'password'" placeholder="Password"
                        class="pl-12 w-full rounded-xl bg-[#EFEFEF] shadow-md border-none md:h-8 lg:h-14 focus:outline-none focus:ring-0 placeholder:text-[#B7B7B7] md:placeholder:text-xs lg:placeholder:text-lg" />
                    <span class="absolute inset-y-0 right-0 pr-6 flex items-center cursor-pointer"
                        @click="togglePasswordVisibility('password')">
                        <img :src="showPassword ? '/img/assets/icon/icon_show_eye.svg' : '/img/assets/icon/icon_hide_eye.svg'"
                            alt="eye Icon" class="md:h-4 md:w-4 lg:h-6 lg:w-66 cursor-pointer" />
                    </span>
                </div>

                <!-- Confirm Password Input -->
                <div class="relative w-full md:mt-3 lg:mt-5">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <img src="/img/assets/icon/icon_lock.svg" alt="lock Icon" class="md:h-4 md:w-4 lg:h-6 lg:w-6" />
                    </span>
                    <input v-model="confirmPassword" :type="showConfirmPassword ? 'text' : 'password'"
                        placeholder="Confirm Password"
                        class="pl-12 w-full rounded-xl bg-[#EFEFEF] shadow-md border-none md:h-8 lg:h-14 focus:outline-none focus:ring-0 placeholder:text-[#B7B7B7] md:placeholder:text-xs lg:placeholder:text-lg" />
                    <span class="absolute inset-y-0 right-0 pr-6 flex items-center cursor-pointer"
                        @click="togglePasswordVisibility('confirm')">
                        <img :src="showConfirmPassword ? '/img/assets/icon/icon_show_eye.svg' : '/img/assets/icon/icon_hide_eye.svg'"
                            alt="eye Icon" class="md:h-4 md:w-4 lg:h-6 lg:w-6 cursor-pointer" />
                    </span>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full text-center bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] md:h-8 lg:h-12 rounded-xl md:mb-3 lg:mb-5 md:text-xs lg:text-2xl font-bold text-white shadow-md mt-5">Submit</button>
            </form>
        </div>
    </Layout>
</template>