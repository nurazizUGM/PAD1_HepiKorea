<script setup>
import { Link } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";
</script>

<template>

    <Head>
        <title>Auth Page</title>
        <meta name="description" content="This is the authentication page." />
    </Head>

    <main style="background-image:  url('/img/assets/bg/background_auth.svg');"
        class="w-screen min-h-screen h-screen bg-cover bg-no-repeat bg-center overflow-hidden flex flex-col justify-center align-center font-poppins">
        <slot />
    </main>
</template>
