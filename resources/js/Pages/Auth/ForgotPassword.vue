<script setup>
import { useForm } from '@inertiajs/vue3'
import Layout from '../Layouts/Auth.vue';

const form = useForm({
    email: ''
});

const submit = () => {
    form.post(route('auth.forgot_password'))
}
</script>

<template>
    <Layout title="Password Reset">
        <div class="bg-white h-auto md:w-[354px] lg:w-[520px] max-w-md md:p-9 lg:p-10 m-auto shadow-lg rounded-2xl">
            <h1 class="text-black md:text-sm lg:text-xl font-extrabold mb-5">Password Reset</h1>
            <!-- start of form -->
            <form @submit.prevent="submit">
                <!-- input text email -->
                <div class="relative w-full mt-5">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <img src="img/assets/icon/icon_email.png" alt="email Icon" class="md:h-4 md:w-4 lg:h-6 lg:w-6">
                    </span>
                    <input v-model="form.email" type="email" placeholder="Email" name="email"
                        class="pl-12 w-full rounded-xl bg-[#EFEFEF] shadow-md border-none md:h-8 lg:h-14 focus:outline-none focus:ring-0 placeholder:text-[#B7B7B7] md:placeholder:text-xs lg:placeholder:text-lg">
                </div>

                <!-- send button -->
                <button type="submit"
                    class="w-full text-center bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] md:h-8 lg:h-12 rounded-xl mb-5 md:text-xs lg:text-2xl font-bold text-white shadow-md mt-5">
                    Send
                </button>
            </form>
        </div>
    </Layout>
</template>
