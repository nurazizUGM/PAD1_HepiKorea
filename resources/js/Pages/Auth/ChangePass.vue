<template>
    <Layout title="Change Password">
        <div class="bg-white md:w-[354px] lg:w-[520px] h-auto max-w-lg md:p-9 lg:p-10 m-auto shadow-lg rounded-2xl">
            <h1 class="text-black md:text-sm lg:text-xl font-bold md:mb-3 lg:mb-5">Password Reset</h1>
            <!-- start of form -->
            <form @submit.prevent="submit">
                <!-- input text password -->
                <div class="relative w-full md:mt-3 lg:mt-5">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <img src="/img/assets/icon/icon_lock.svg" alt="lock Icon" class="md:h-4 md:w-4 lg:h-6 lg:w-6">
                    </span>
                    <input v-model="form.password" :type="showPassword ? 'text' : 'password'" placeholder="Password"
                    class="pl-12 w-full rounded-xl bg-[#EFEFEF] shadow-md border-none md:h-8 lg:h-14 focus:outline-none focus:ring-0 placeholder:text-[#B7B7B7] md:placeholder:text-xs lg:placeholder:text-lg">
                    <!-- show/hide password -->
                    <span class="absolute inset-y-0 right-0 pr-6 flex items-center">
                        <img :src="showPassword ? '/img/assets/icon/icon_show_eye.svg' : '/img/assets/icon/icon_hide_eye.svg'"
                            @click="togglePasswordVisibility('password')" alt="eye Icon" class="md:h-4 md:w-4 lg:h-6 lg:w-66 cursor-pointer">
                    </span>
                </div>

                <!-- input text password confirm -->
                <div class="relative w-full md:mt-3 lg:mt-5">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <img src="/img/assets/icon/icon_lock.svg" alt="User Icon" class="md:h-4 md:w-4 lg:h-6 lg:w-6">
                    </span>
                    <input v-model="form.confirmPassword" :type="showConfirmPassword ? 'text' : 'password'"
                        placeholder="Confirm Password"
                        class="pl-12 w-full rounded-xl bg-[#EFEFEF] shadow-md border-none md:h-8 lg:h-14 focus:outline-none focus:ring-0 placeholder:text-[#B7B7B7] md:placeholder:text-xs lg:placeholder:text-lg">
                    <!-- show/hide password -->
                    <span class="absolute inset-y-0 right-0 pr-6 flex items-center">
                        <img :src="showConfirmPassword ? '/img/assets/icon/icon_show_eye.svg' : '/img/assets/icon/icon_hide_eye.svg'"
                            @click="togglePasswordVisibility('confirmPassword')" alt="eye Icon"
                            class="md:h-4 md:w-4 lg:h-6 lg:w-6 cursor-pointer">
                    </span>
                </div>

                <!-- submit button -->
                <button type="submit"
                    class="w-full text-center bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] md:h-8 lg:h-12 rounded-xl md:mb-3 lg:mb-5 md:text-xs lg:text-2xl font-bold text-white shadow-md mt-5">Send</button>
            </form>
        </div>
    </Layout>
</template>

<script setup>
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'
import Layout from '../Layouts/Auth.vue';
// import lockIcon from '/images/assets/icon/icon_lock.svg'
// import showEyeIcon from '@/assets/icon/icon_show_eye.svg'
// import hideEyeIcon from '@/assets/icon/icon_hide_eye.svg'

const form = useForm({
    password: '',
    confirmPassword: ''
})

const showPassword = ref(false)
const showConfirmPassword = ref(false)

const togglePasswordVisibility = (field) => {
    if (field === 'password') {
        showPassword.value = !showPassword.value
    } else {
        showConfirmPassword.value = !showConfirmPassword.value
    }
}

const submit = () => {
    form.post(route('auth.change_password'))
}
</script>
