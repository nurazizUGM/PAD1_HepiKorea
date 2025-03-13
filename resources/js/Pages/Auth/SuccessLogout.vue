<script setup>
import Layout from '../Layouts/Auth.vue';
</script>

<template>
    <Layout title="Success Logout">
        <div
            class="bg-white h-auto flex flex-col md:w-[375px] lg:w-[605px] max-w-md md:py-14 md:px-10 lg:p-10 m-auto shadow-lg rounded-2xl">
            <h1 class="text-black md:text-sm lg:text-xl font-bold mb-5 mx-auto">You have successfully logged out!</h1>
            <img src="/img/assets/icon/icon_green_check.svg" alt="User Icon"
                class="md:w-10 md:h-10 lg:h-16 lg:w-16 mx-auto">
        </div>
    </Layout>
</template>