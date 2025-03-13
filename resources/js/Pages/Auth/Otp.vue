<script setup>
import Layout from '../Layouts/Auth.vue';
import { ref, onMounted } from 'vue';

const email = ref('user@example.com'); // Gantilah dengan email dari props atau store
const otp = ref('');
const timeout = ref(60); // Gantilah dengan timeout dari backend jika perlu

const verifyCode = () => {
    console.log('Verifying OTP:', otp.value);
    // Lakukan request ke backend untuk verifikasi OTP
};

const resendOtp = () => {
    if (timeout.value === 0) {
        console.log('Resending OTP...');
        timeout.value = 60; // Reset timer setelah mengirim ulang
    }
};

onMounted(() => {
    const timer = setInterval(() => {
        if (timeout.value > 0) {
            timeout.value--;
        } else {
            clearInterval(timer);
        }
    }, 1000);
});
</script>

<template>
    <Layout title="OTP">

        <div class="bg-white h-auto md:w-[318px] lg:w-[446px] max-w-md p-6 lg:p-10 m-auto shadow-lg rounded-2xl">
            <img src="/img/assets/icon/icon_email_green.svg" alt="email icon"
                class="mx-auto md:scale-125 lg:scale-150 mb-6 md:mt-10 lg:mt-20 rounded-lg" />
            <h1 class="text-[#3E6E7A] md:text-sm lg:text-3xl font-extrabold md:mt-10 lg:mt-20 mb-1 text-center">Verification</h1>
            <p class="text-[#B7B7B7] md:text-xs lg:text-base text-center font-medium">
                You will get an OTP at {{ email }}
            </p>

            <h2 class="text-[#898383] md:text-sm lg:text-lg text-left font-medium md:mt-5 lg:mt-10">OTP Code</h2>

            <form @submit.prevent="verifyCode">
                <input v-model="otp" type="text" minlength="6" maxlength="6" required placeholder="Enter Your Code"
                    class="w-full rounded-xl border border-[#3E6E7A] md:h-8 lg:h-14 mt-4 focus:outline-none focus:ring-0 focus:border-[#3E6E7A]">

                <button type="submit"
                    class="w-full flex items-center justify-center bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] md:h-8 lg:h-12 rounded-xl mb-5 md:text-xs lg:text-2xl md:font-semibold lg:font-bold text-white md:mt-3 lg:mt-10">
                    Verify
                    <img src="/img/assets/icon/icon_email_white.svg" alt="mail Icon" class="md:h-3 md:w-3 lg:h-6 lg:w-6 md:ml-2 lg:ml-3" />
                </button>
            </form>

            <p class="md:text-[10px] lg:text-sm font-medium text-center text-[#B7B7B7]">
                Didn't receive the verification OTP?
                <button @click="resendOtp" :disabled="timeout > 0" class="text-blue-600 ml-2">
                    {{ timeout > 0 ? `Wait ${Math.floor(timeout / 60)}m ${timeout % 60}s` : 'Resend' }}
                </button>
            </p>
        </div>

    </Layout>
</template>