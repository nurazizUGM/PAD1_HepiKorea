<script setup>
import { Head, usePage } from "@inertiajs/vue3";
import { computed, onBeforeMount } from 'vue';

const page = usePage();
const googleClientId = computed(() => page.props.g_client_id);
const debug = computed(() => page.props.app.debug);

function handleCredentialResponse(response) {
    if (debug.value) console.log("Encoded JWT ID token: " + response.credential);
    window.location.href = "/auth/callback?credential=" + response.credential;
}

onBeforeMount(() => {
    const script = document.createElement('script');
    script.async = true;
    script.src = "https://accounts.google.com/gsi/client";
    script.onload = () => {
        window.google.accounts.id.initialize({
            client_id: googleClientId.value,
            callback: handleCredentialResponse,
            auto_select: false,
            cancel_on_tap_outside: false,
        });
        window.google.accounts.id.prompt();
    };

    document.head.appendChild(script);
});

const props = defineProps({
    title: String,
});

</script>

<template>

    <Head>
        <title>Auth{{ props.title ? ` - ${props.title}` : '' }}</title>
        <meta name="description" content="This is the authentication page." />
    </Head>

    <main style="background-image:  url('/img/assets/bg/background_auth.svg');"
        class="w-screen min-h-screen h-screen bg-cover bg-no-repeat bg-center overflow-hidden flex flex-col justify-center align-center font-poppins">
        <slot />
    </main>
</template>
